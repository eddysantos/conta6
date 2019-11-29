<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

  $regimenNomina = trim($_POST['regimen']);
  $anio = trim($_POST['anio']);
  $semana = trim($_POST['nomina']);


$query_consultaDoc = "SELECT pk_id_docNomina,fk_id_empleado,concat(s_nombre,' ',s_apellidoP,' ',s_apellidoM) as nombre,s_tipoNomina
                      FROM conta_t_nom_captura
                      WHERE fk_id_regimen = ? and fk_id_aduana = ? and n_anio = ? and n_semana = ?
                      ORDER BY s_nombre, pk_id_docNomina";

$stmt_consultaDoc = $db->prepare($query_consultaDoc);
if (!($stmt_consultaDoc)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt_consultaDoc->bind_param('ssss',$regimenNomina,$aduana,$anio,$semana);
if (!($stmt_consultaDoc)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_consultaDoc->errno]: $stmt_consultaDoc->error";
  exit_script($system_callback);
}
if (!($stmt_consultaDoc->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_consultaDoc->errno]: $stmt_consultaDoc->error";
  exit_script($system_callback);
}
$rslt_consultaDoc = $stmt_consultaDoc->get_result();
$rows_consultaDoc = $rslt_consultaDoc->num_rows;

if ($rows_consultaDoc == 0) {
  $consultaDocumentos .=
  "<tr class='row'>
    <td class='col-md-12'>
      NO HAY DATOS
    </td>
    <tr>";
}

if ($rows_consultaDoc > 0) {
    while ($row_consultaDoc = $rslt_consultaDoc->fetch_assoc()) {
      $idDocNomina = $row_consultaDoc['pk_id_docNomina'];
      $idEmpleado = $row_consultaDoc['fk_id_empleado'];
      $nombre = $row_consultaDoc['nombre'];
      $tipo = $row_consultaDoc['s_tipoNomina'];

      $consultaDocumentos .=
      "<tr class='row text-center'>
          <td class='col-md-1'>$idEmpleado</td>
          <td class='col-md-3 text-left'>$nombre</td>
          <td class='col-md-1'>$tipo</td>
      ";

      $query_consultaFac = "SELECT fk_id_polizaPago,s_cancela_factura,pk_id_nomina,fk_id_poliza
                                  FROM conta_t_nom_cfdi
                                  WHERE fk_id_docNomina";
      $stmt_consultaFac = $db->prepare($query_consultaFac);
      if (!($stmt_consultaFac)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmt_consultaFac->bind_param('s',$idDocNomina);
      if (!($stmt_consultaFac)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding [$stmt_consultaFac->errno]: $stmt_consultaFac->error";
        exit_script($system_callback);
      }
      if (!($stmt_consultaFac->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution [$stmt_consultaFac->errno]: $stmt_consultaFac->error";
        exit_script($system_callback);
      }
      $rslt_consultaFac = $stmt_consultaFac->get_result();
      $rows_consultaFac = $rslt_consultaFac->num_rows;

      if ($rows_consultaFac == 0) {
        if( $oRst_permisos['s_nom_has_modificar'] == 1 ){
          $linkBorrar = "<a href='#' class='ml-5' onclick='borrarDocNomina($idDocNomina)'><img class='icochico' src='/conta6/Resources/iconos/cross.svg'></a>";
          $linkEditar = "<a href='#' class='ml-5' onclick='editarDocNomina($idDocNomina)'><img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'></a>";
        }

        $consultaDocumentos .="
        <td class='col-md-1'>$idDocNomina $linkEditar</td>
        <td class='col-md-1'>$linkBorrar</td>
        <td class='col-md-1'></td>
        <td class='col-md-1'></td>
        <td class='col-md-1'></td>
        <td class='col-md-1'></td>
        <td class='col-md-1'><a href='#' class='ml-5'><img class='icomediano' src='/conta6/Resources/iconos/timbrar.svg'></a></td>
        ";
      }

      if ($rows_consultaFac > 0) {
          #while ($row_consultaFac = $rslt_consultaFac->fetch_assoc()) {
            $polPago = $row_consultaFac['fk_id_polizaPago'];
            $cancela = $row_consultaFac['s_cancela_factura'];
            $idFactura = $row_consultaFac['pk_id_nomina'];
            $idPoliza = $row_consultaFac['fk_id_poliza'];

            $consultaDocumentos .="
            <td class='col-md-1'>-</td>
            <td class='col-md-1'>$polPago</td><!--Esto debe ser un link-->
            <td class='col-md-1'>$cancela</td>
            <td class='col-md-1'>$idFactura</td><!--Esto debe ser un link-->
            <td class='col-md-1'>$idPoliza</td><!--Esto debe ser un link-->
            <td class='col-md-1'>
              <a href=''><img class='icomediano' src='/conta6/Resources/iconos/pdf.svg'></a>
              <a href='' class='ml-4'><img class='icomediano' src='/conta6/Resources/iconos/xml.svg'></a>
            </td>
            <td class='col-md-1'>-</td>";
          #}
      }


      $consultaDocumentos .= "</tr>";

    }#whileDoc
}


$system_callback['code'] = 1;
$system_callback['data'] = $consultaDocumentos;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
