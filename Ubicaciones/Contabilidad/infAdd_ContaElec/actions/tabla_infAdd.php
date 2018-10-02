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

  $partidaPoliza = "<div class='row infsub ml-0 mr-0 pt-2 pb-2'>
    <div class='col-md-4 p-0 text-left'>Desc : <black class='b'>$row[s_desc]</black></div>
    <div class='col-md-1'>Tipo : <black class='b'>$row[fk_tipo]</black></div>
    <div class='col-md-2'>Cuenta : <black class='b'>$fk_id_cuenta</black></div>
    <div class='col-md-2'>Cargo : <black class='b'>$row[n_cargo]</black></div>
    <div class='col-md-2'>Abono : <black class='b'>$row[n_abono]</black></div>

    <div class='col-md-1'>
      <a href=''>
        <img class='icochico' src='/conta6/Resources/iconos/001-add.svg'>
      </a>
    </div>
  </div>

  ";

  $query_consulContaElect = "SELECT * FROM conta_t_polizas_det_contaelec WHERE fk_id_poliza = ? AND fk_partidaPol = ?";
  $stmt_consulContaElect = $db->prepare($query_consulContaElect);
  if (!($stmt_consulContaElect)) {die("Error during query prepare [$db->errno]: $db->error");}
  $stmt_consulContaElect->bind_param('ss',$id_poliza,$partida);
  if (!($stmt_consulContaElect)) {die("Error during variables binding [$stmt_consulContaElect->errno]: $stmt_consulContaElect->error"); }
  if (!($stmt_consulContaElect->execute())) { die("Error during query execute [$stmt_consulContaElect->errno]: $stmt_consulContaElect->error"); }
  $rslt_consulContaElect = $stmt_consulContaElect->get_result();
  $rows_consulContaElect = $rslt_consulContaElect->num_rows;

  if ($rows_consulContaElect > 0) {
    $partidaContaElect = "


    <div class='row ml-0 mr-0 sub2' style='font-size:12px!important'>
      <div class='col-md-1'></div>
      <div class='col-md-6'>Documento Nacional</div>
      <div class='col-md-1'>Origen</div>
      <div class='col-md-1'>Destino</div>
      <div class='col-md-1'>Extranjero</div>
      <div class='col-md-2'>Doc.Extranjero</div>
    </div>


    ";

    while ($row = $rslt_consulContaElect->fetch_assoc()) {
      $partidaContaElect .= "


                    <div class='row ml-0 mr-0 borderojo'>
                      <div class='col-md-1'></div>
                      <div class='col-md-1 text-right b'>UUID :</div>
                      <div class='col-md-5 text-left'>550e8400-e29b-41d4-a716-446655440000$row[s_UUID_CFDI]</div>

                      <div class='col-md-1'>Bco : $row[s_BancoOri]</div>
                      <div class='col-md-1'>Bco : $row[s_BancoDest]</div>
                      <div class='col-md-1'>Bco : $row[s_BancoOriExt]</div>
                      <div class='col-md-1 text-right'>Tax Id : </div>
                      <div class='col-md-1 text-left'>$row[s_TaxID]</div>

                      <div class='col-md-1'><a href=''>
                        <img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'>
                      </a></div>
                      <div class='col-md-1 text-right b'>Benef :</div>
                      <div class='col-md-5 text-left'>$row[s_Beneficiario]  -- $row[s_RFC]</div>
                      <div class='col-md-1'>Cta : $row[s_ctaOri]</div>
                      <div class='col-md-1'>Cta : $row[s_CtaDest]</div>
                      <div class='col-md-1'>Cta : $row[s_BancoDestExt]</div>
                      <div class='col-md-1 text-right'>Moneda : </div>
                      <div class='col-md-1 text-left'>$row[s_moneda]</div>

                      <div class='col-md-1'>$row[s_tipoDetalle]</div>
                      <div class='col-md-1 text-right b'>Fecha :</div>
                      <div class='col-md-2 text-left'>$row[d_fecha]</div>
                      <div class='col-md-6'></div>


                      <div class='col-md-1 text-right'>TC : </div>
                      <div class='col-md-1 text-left'>$row[n_TipCamb]</div>

                      <div class='col-md-1'></div>
                      <div class='col-md-1 text-right b'>Total :</div>
                      <div class='col-md-1 text-left'>$row[n_monto]</div>
                      <div class='col-md-1 text-right b'>Ch :</div>
                      <div class='col-md-3 text-left'>$row[n_num]</div>
                      <div class='col-md-5'></div>
                    </div>";

    }
  }

/* Si los agrego, no muestra datos
<td>$row[s_BeneficiarioOpc]</td>
<td>$row[s_RFCopc]</td>
<td>$row[s_observaciones]</td>
*/
  $system_callback['data'] .= $partidaPoliza.$partidaContaElect;
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
 ?>
