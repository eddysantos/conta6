<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_poliza = trim($_POST['id_poliza']);
$query = "SELECT * FROM conta_t_polizas_det WHERE fk_id_poliza = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s',$id_poliza);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$rslt = $stmt->get_result();

if ($rslt->num_rows == 0) {
  $system_callback['code'] = 1;
  $system_callback['data'] ="<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $fk_id_cuenta = trim($row['fk_id_cuenta']);
  $partida = $row['pk_partida'];

  if( $oRst_permisos['s_modificar_contaElect'] == 1 ){
    $urlADD = "<a href='#' onclick='infAddPartida($row[pk_partida])'>
                <img class='icochico' src='/conta6/Resources/iconos/001-add.svg'>
              </a>";
  }

  $partidaPoliza =
  "<div class='row sub fw-bold py-2'>
    <div class='col-md-4 p-0 text-left'>Desc : $row[s_desc]</div>
    <div class='col-md-1'>Tipo : $row[fk_tipo]</div>
    <div class='col-md-2'>Cuenta : $fk_id_cuenta</div>
    <div class='col-md-2'>Cargo : $row[n_cargo]</div>
    <div class='col-md-2'>Abono : $row[n_abono]</div>
    <div class='col-md-1'>$urlADD</div>
  </div>";


  $query_consulContaElect = "SELECT * FROM conta_t_polizas_det_contaelec WHERE fk_id_poliza = ? AND fk_partidaPol = ?";
  $stmt_consulContaElect = $db->prepare($query_consulContaElect);
  if (!($stmt_consulContaElect)) {die("Error during query prepare [$db->errno]: $db->error");}
  $stmt_consulContaElect->bind_param('ss',$id_poliza,$partida);
  if (!($stmt_consulContaElect)) {die("Error during variables binding [$stmt_consulContaElect->errno]: $stmt_consulContaElect->error"); }
  if (!($stmt_consulContaElect->execute())) { die("Error during query execute [$stmt_consulContaElect->errno]: $stmt_consulContaElect->error"); }
  $rslt_consulContaElect = $stmt_consulContaElect->get_result();
  $rows_consulContaElect = $rslt_consulContaElect->num_rows;

  if ($rows_consulContaElect > 0) {
    $partidaContaElect =
    "<div class='row sub2 fw-bold ls3'>
      <div class='col-md-1'></div>
      <div class='col-md-6'>Documento Nacional</div>
      <div class='col-md-1'>Origen</div>
      <div class='col-md-1'>Destino</div>
      <div class='col-md-1'>Extranjero</div>
      <div class='col-md-2'>Doc.Extranjero</div>
    </div>";


    while ($row = $rslt_consulContaElect->fetch_assoc()) {
      $uuid_captura = $row['s_UUID_CFDI'];
      $imgXML = "";
      $imgXMLdownload = "";
      if( $uuid_captura <> '' ){
        #busqueda de UUID para mostrar ruta de archivo XML
        require $root . '/conta6/Ubicaciones/Contabilidad/infAdd_ContaElec/actions/consultaXML_backupsxml.php'; #$imgXML, $imgXMLdownload
      }

      if( $oRst_permisos['s_modificar_contaElect'] == 1 ){
        $urlDELETE = "<a href='#' onclick='eliminarPartida($row[pk_id_partida])'>
                        <img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'>
                      </a>";
      }
      $partidaContaElect .=
        "<div class='row borderojo pb-3'>
          <div class='col-md-1'></div>
          <div class='col-md-1 text-right b fw-bold'>UUID :</div>
          <div class='col-md-5 text-left'>$uuid_captura</div>
          <div class='col-md-1 text-left p-0'><span class='b fw-bold'>Bco :</span> $row[s_BancoOri]</div>
          <div class='col-md-1 text-left p-0'><span class='b fw-bold'>Bco :</span> $row[s_BancoDest]</div>
          <div class='col-md-1 text-left p-0'><span class='b fw-bold'>Bco :</span> $row[s_BancoOriExt]</div>
          <div class='col-md-1 text-right b fw-bold'>Tax Id :</div>
          <div class='col-md-1 text-left'>$row[s_TaxID]</div>

          <div class='col-md-1'>$urlDELETE</div>
          <div class='col-md-1 text-right b fw-bold'>Benef :</div>
          <div class='col-md-5 text-left'>$row[s_Beneficiario]  -- $row[s_RFC]</div>
          <div class='col-md-1 text-left p-0'><span class='b fw-bold'>Cta :</span> $row[s_ctaOri]</div>
          <div class='col-md-1 text-left p-0'><span class='b fw-bold'>Cta :</span> $row[s_CtaDest]</div>
          <div class='col-md-1 text-left p-0'><span class='b fw-bold'>Cta :</span> $row[s_BancoDestExt]</div>
          <div class='col-md-1 text-right b fw-bold'>Moneda : </div>
          <div class='col-md-1 text-left'>$row[s_moneda]</div>

          <div class='col-md-1'>$row[s_tipoDetalle]</div>
          <div class='col-md-1 text-right b fw-bold'>Fecha :</div>
          <div class='col-md-2 text-left'>$row[d_fecha]</div>
          <div class='col-md-6'></div>
          <div class='col-md-1 text-right b fw-bold'>TC : </div>
          <div class='col-md-1 text-left'>$row[n_TipCamb]</div>

          <div class='col-md-1'></div>
          <div class='col-md-1 text-right b fw-bold'>Total :</div>
          <div class='col-md-1 text-left'>$row[n_monto]</div>
          <div class='col-md-1 text-right b fw-bold'>Ch :</div>
          <div class='col-md-3 text-left'>$row[n_num]</div>
          <div class='col-md-5'></div>

          <div class='col-md-1'></div>
          <div class='col-md-1 text-right b fw-bold'>Opcionales:</div>
          <div class='col-md-5 text-left'>$row[s_RFCopc] -- $row[s_BeneficiarioOpc]</div>
          <div class='col-md-1 text-left b p-0 fw-bold'>Observaciones :</div>
          <div class='col-md-2 text-left'>$row[s_observaciones] </div>
          <div class='col-md-2'>$imgXML $imgXMLdownload</div>
        </div>";
    }
  }

  $system_callback['data'] .= $partidaPoliza.$partidaContaElect;
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
 ?>
