<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Resources/PHP/Utilities/initialScript.php';

  $regimenNomina = trim($_POST['regimen']);
  $anio = trim($_POST['anio']);
  $semana = trim($_POST['nomina']);

  if($regimenNomina =='02'){
  	$permisoGenerarNomina = $oRst_permisos['s_nom_suel_generar'];
    $permisoModificarNomina = $oRst_permisos['s_nom_suel_modificar'];
  	$permisoCancelarCFDI = $oRst_permisos['s_nom_suel_cancelar'];
  	$permisoCancelarLibreCFDI = $oRst_permisos['s_nom_suel_cancelarLibre'];
  }
  if($regimenNomina == '09'){
  	$permisoGenerarNomina = $oRst_permisos['s_nom_has_generar'];
    $permisoModificarNomina = $oRst_permisos['s_nom_has_modificar'];
  	$permisoCancelarCFDI = $oRst_permisos['s_nom_has_cancelar'];
  	$permisoCancelarLibreCFDI = $oRst_permisos['s_nom_has_cancelarLibre'];
  }

  $permisoConsultarPolizaNomina = $oRst_permisos['s_consulta_polizasNomina'];
  $permisoModificarPolizaNomina = $oRst_permisos['s_modifica_polizasNomina'];

  if( $permisoModPolNom == 1 ){ ?><a href="javascript:modificarPoliza(<?php echo $poliza;?>);" title="Imprimir"><?php echo $poliza;?></a><?php }else{
if( $permisoConPolNom == 1 ){ ?><a href="javascript:imprimirPoliza(<?php echo $poliza;?>);" title="Modificar"><?php echo $poliza;?></a><?php }}

$query_consultaDoc = "SELECT pk_id_docNomina,fk_id_empleado,concat(s_nombre,' ',s_apellidoP,' ',s_apellidoM) as nombre,s_tipoNomina,s_descNomina,s_RFC
                      FROM conta_t_nom_captura
                      WHERE fk_id_regimen = ? and fk_id_aduana = ? and n_anio = ? and n_semana = ?
                      ORDER BY s_nombre, pk_id_docNomina ";

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

$consultaDocumentos = '';

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
      $nombre = utf8_encode($row_consultaDoc['nombre']);
      $tipo = $row_consultaDoc['s_tipoNomina'];
      $descNomina = $row_consultaDoc['s_descNomina'];
      $RFC = $row_consultaDoc['s_RFC'];

      $txtFiniquito = '';
      if( $descNomina == 'Finiquito' ){ $txtFiniquito = " (".$descNomina.")"; }

      $consultaDocumentos .=
      "<tr class='row text-center elemento-docNomina align-items-center'>
          <td class='col-md-1'>$idEmpleado</td>
          <td class='col-md-2 text-left'>$nombre$txtFiniquito</td>
          <td class='col-md-1'>$tipo</td>
          <td class='col-md-1'>$idDocNomina</td>
      ";

      # CONSULTO SI TIENE DETALLE
      $query_consultaDet = "SELECT fk_id_docNomina
                            FROM conta_t_nom_captura_det
                            WHERE fk_id_docNomina = ? ";

      $stmt_consultaDet = $db->prepare($query_consultaDet);
      if (!($stmt_consultaDet)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmt_consultaDet->bind_param('s',$idDocNomina);
      if (!($stmt_consultaDet)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding [$stmt_consultaDet->errno]: $stmt_consultaDet->error";
        exit_script($system_callback);
      }
      if (!($stmt_consultaDet->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution [$stmt_consultaDet->errno]: $stmt_consultaDet->error";
        exit_script($system_callback);
      }
      $rslt_consultaDet = $stmt_consultaDet->get_result();
      $rows_consultaDet = $rslt_consultaDet->num_rows;

      if( $permisoModificarNomina == 1 ){
        $linkBorrar = "<a href='#' class='remove-docNomina' onclick='borrarDocNomina($idDocNomina)'>
                        <img class='icochico' src='/Resources/iconos/delete.svg'>
                      </a>
                      <input class='id-docNomina' type='hidden' id='T_partida_$idDocNomina' value='$idDocNomina'>";
        $linkEditar = "<a href='#' class='' onclick='editarDocNomina($idDocNomina)'><img class='icochico' src='/Resources/iconos/003-edit.svg'></a>";
      }

      if ($rows_consultaDet == 0) {
        $linkEditar = "<a href='#' class='' onclick='editarDocNomina($idDocNomina)'><img class='icochico ml-4' src='/Resources/iconos/003-edit.svg'></a>";
        $consultaDocumentos .="
        <td class='col-md-2'>$linkBorrar Sin detalle $linkEditar</td>";
      }

      if ($rows_consultaDet > 0) {
        # CONSULTO SI TIENE UN CFDI
        $query_consultaFac = "SELECT fk_id_polizaPago,s_cancela_factura,pk_id_nomina,fk_id_poliza
                                    FROM conta_t_nom_cfdi
                                    WHERE fk_id_docNomina = ?";
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

          if( $permisoGenerarNomina == 1 ){
            $linkTimbrar = "<a href='#' class='ml-5' onclick='timbrarDocNomina($idDocNomina,$regimenNomina)'><img class='icomediano' src='/Resources/iconos/timbrar.svg'></a>";
          }
          $consultaDocumentos .="
          <td class='col-md-1'>$linkBorrar</td>
          <td class='col-md-1'>$linkEditar</td>
          <td class='col-md-1'></td>
          <td class='col-md-1'></td>
          <td class='col-md-1'></td>
          <td class='col-md-1'></td>
          <td class='col-md-1'>$linkTimbrar</td>
          ";
        }

        if ($rows_consultaFac > 0) {
              $linkCancelar = "&nbsp;";
              $linkBorrar = "&nbsp;";
              $linkEditar = "&nbsp;";
              $linkPoliza = "&nbsp;";
              $linkTimbrar = "&nbsp;";
              $linkPolizaPago = "&nbsp;";

              $row_consultaFac = $rslt_consultaFac->fetch_assoc();
              $polPago = $row_consultaFac['fk_id_polizaPago'];
              $cancela = $row_consultaFac['s_cancela_factura'];
              $idFactura = $row_consultaFac['pk_id_nomina'];
              $idPoliza = $row_consultaFac['fk_id_poliza'];
              $d_fechaTimbrado = $row_consultaFac['d_FechaTimbrado'];

              #rutas de consulta
              $folioFactura = $idFactura;
              $anioActual = date_format(date_create($d_fechaTimbrado),"Y");
              $rutaAnioActual = $root . '/CFDI_nomina/'.$anioActual.'/CFDI/';
                    #nombre archivos
              if($aduana == 470){ $cveOficina = "AER"; }
              if($aduana == 240){ $cveOficina = "NL"; }
              if($aduana == 430){ $cveOficina = "VER"; }
              if($aduana == 160){ $cveOficina = "MAN"; }
              if($regimenNomina == '02'){ $cveIdRegimen = "Sueldos"; }
              if($regimenNomina == '09'){ $cveIdRegimen = "Honorarios"; }
              $nombre_archivo = $folioFactura."_".$cveOficina."_".$semana."_".$cveIdRegimen."_".$anio."_".$RFC;
              $fileXML = $nombre_archivo.'.xml';
              $nombre_archivoCancela = $nombre_archivo.'_cancelado';
              $rutaFileXML = $rutaAnioActual.'/'.$nombre_archivo.'.xml';
              $rutaFileHTML = $rutaAnioActual.'/'.$nombre_archivo.'.html';
              $rutaFilePDF = $rutaAnioActual.'/'.$nombre_archivo.'.pdf';
              $rutaFileXMLcancela = $rutaAnioActual.'/'.$nombre_archivoCancela.'.xml';
              $rutaFilePDFcancela = $rutaAnioActual.'/'.$nombre_archivoCancela.'.pdf';

              if( $cancela > 0 ){
                $linkCancelar = "
                <a href='#' onclick='docTimbrado_download(&#39;$nombre_archivoCancela.xml&#39;,&#39;$rutaFileXMLcancela&#39;)'>
                  <img class='icomediano' src='/Resources/iconos/xml.svg'>
                </a>
    						<a href='#' onclick='docTimbrado_download(&#39;$nombre_archivoCancela.pdf&#39;,&#39;$rutaFilePDFcancela&#39;)'>
                  <img class='icomediano ml-4' src='/Resources/iconos/pdf.svg'>
                </a>
                <a href='#' onclick='sustituirDocNomina($idDocNomina)'>
                  <img class='icomediano' src='/Resources/iconos/copy.svg'>
                </a>";
              }else{
                if( $permisoCancelarCFDI == 1 ){
                  $linkCancelar = "<a href='' class='ml-4'><img class='icomediano' src='/Resources/iconos/001-delete.svg'></a>"; }
                if( $permisoCancelarLibreCFDI == 1 ){
                  $linkCancelar = "<a href='' class='ml-4'><img class='icomediano' src='/Resources/iconos/001-delete.svg'></a>"; }
              }

              if( $idPoliza > 0 ){
                if( $permisoConsultarPolizaNomina == 1 && $permisoModificarPolizaNomina == 0 ){
                  $linkPoliza = "<a href='#' onclick='btn_printPoliza($idPoliza,$aduana)' class=''>
                    <img class='w-5' src='/Resources/iconos/printer.svg'>$idPoliza
                  </a>";
                }
                if( $permisoConsultarPolizaNomina == 0 && $permisoModificarPolizaNomina == 1 ){
                  $linkPoliza = "<a href='#' onclick='modificarPolizaNomina($idPoliza)' class='ml-2'>
                    $idPoliza
                  </a>";
                }
                if( $permisoConsultarPolizaNomina == 1 && $permisoModificarPolizaNomina == 1 ){
                  $linkPoliza = "<a href='#' onclick='btn_printPoliza($idPoliza,$aduana)'>
                    <img class='w-5' src='/Resources/iconos/printer.svg'>
                  </a>
                  <a href='#' onclick='modificarPolizaNomina($idPoliza)' class='ml-2'>$idPoliza</a>";
                }
                if( $permisoConsultarPolizaNomina == 0 && $permisoModificarPolizaNomina == 0 ){
                  $linkPoliza = $idPoliza;
                }
              }
              if( $polPago > 0 ){
                if( $permisoConsultarPolizaNomina == 1 && $permisoModificarPolizaNomina == 0 ){
                  $linkPolizaPago = "<a href='#' onclick='btn_printPoliza($polPago,$aduana)' class=''>
                    <img class='w-5' src='/Resources/iconos/printer.svg'>$polPago
                  </a>";
                }
                if( $permisoConsultarPolizaNomina == 0 && $permisoModificarPolizaNomina == 1 ){
                  $linkPolizaPago = "<a href='#' onclick='modificarPolizaNomina($polPago)' class='ml-2'>$polPago</a>";
                }
                if( $permisoConsultarPolizaNomina == 1 && $permisoModificarPolizaNomina == 1 ){
                  $linkPolizaPago = "<a href='#' onclick='btn_printPoliza($polPago,$aduana)' class=''>
                    <img class='w-5' src='/Resources/iconos/printer.svg'>
                  </a>
                  <a href='#' onclick='modificarPolizaNomina($idPoliza)' class=''>$polPago</a>";
                }
                if( $permisoConsultarPolizaNomina == 0 && $permisoModificarPolizaNomina == 0 ){
                  $linkPolizaPago = $polPago;
                }
              }

              $consultaDocumentos .="
              <td class='col-md-1'>&nbsp;</td>
              <td class='col-md-1'>&nbsp;</td>
              <td class='col-md-1'>$linkPolizaPago</td>
              <td class='col-md-1'>$linkCancelar</td>
              <td class='col-md-1'>$idFactura</td>
              <td class='col-md-1'>$linkPoliza</td>
              <td class='col-md-1'>
                <a href='#' onclick='docTimbrado_download(&#39;$nombre_archivo.xml&#39;,&#39;$rutaFileXML&#39;)'><img class='icomediano' src='/Resources/iconos/xml.svg'></a>
    						<a href='#' onclick='docTimbrado_download(&#39;$nombre_archivo.pdf&#39;,&#39;$rutaFilePDF&#39;)'><img class='icomediano ml-4' src='/Resources/iconos/pdf.svg'></a>
              </td>";
        }
      }# FIN TIENE DETALLE

      $consultaDocumentos .= "</tr>";

    }#whileDoc
}


$system_callback['code'] = 1;
$system_callback['data'] = $consultaDocumentos;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
