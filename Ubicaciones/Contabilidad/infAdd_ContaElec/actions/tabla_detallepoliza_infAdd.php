<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

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

  $partidaPoliza = "<tr class='table-bordered sub'>
    <th colspan='3'></th>
    <th>Tipo</th>
    <th colspan='4'>Cuenta</th>
    <th colspan='10'>Descripcion</th>
    <th colspan='2'>Cargo</th>
    <th colspan='2'>Abono</th>
    <th></th>
  </tr>
  <tr>
    <td colspan='3'></td>
    <td>$row[fk_tipo]</td>
    <td colspan='4'>$fk_id_cuenta</td>
    <td colspan='10'>$row[s_desc]</td>
    <td colspan='2'>$row[n_cargo]</td>
    <td colspan='2'>$row[n_abono]</td>
    <td>
      <a href=''>
        <img class='icochico' src='/Resources/iconos/001-add.svg'>
      </a>
    </td>
  </tr>";

  $query_consulContaElect = "SELECT * FROM conta_t_polizas_det_contaelec WHERE fk_id_poliza = ? AND fk_partidaPol = ?";
  $stmt_consulContaElect = $db->prepare($query_consulContaElect);
  if (!($stmt_consulContaElect)) {die("Error during query prepare [$db->errno]: $db->error");}
  $stmt_consulContaElect->bind_param('ss',$id_poliza,$partida);
  if (!($stmt_consulContaElect)) {die("Error during variables binding [$stmt_consulContaElect->errno]: $stmt_consulContaElect->error"); }
  if (!($stmt_consulContaElect->execute())) { die("Error during query execute [$stmt_consulContaElect->errno]: $stmt_consulContaElect->error"); }
  $rslt_consulContaElect = $stmt_consulContaElect->get_result();
  $rows_consulContaElect = $rslt_consulContaElect->num_rows;

  if ($rows_consulContaElect > 0) {
    $partidaContaElect = "<tr class='sub2'>
      <th colspan='3'></th>
      <th colspan='2'>Origen</th>
      <th colspan='2'>Destino</th>
      <th colspan='8'>Documento Nacional</th>
      <th colspan='2'>Extranjero</th>
      <th colspan='3'>Doc.Extranjero</th>
      <th colspan='3'>Opcionales</th>
    </tr>
    <tr class='backpink'>
      <th colspan='2'></th>
      <th>Metodo</th>
      <th>Banco</th>
      <th>Cuenta</th>
      <th>Banco</th>
      <th>Cuenta</th>
      <th>UUID</th>
      <th>Cheque</th>
      <th>Serie</th>
      <th>CFD/CBB</th>
      <th>Razon Social</th>
      <th>RFC</th>
      <th>Fecha</th>
      <th>Importe</th>
      <th>Banco</th>
      <th>Cuenta</th>
      <th>TaxID</th>
      <th>Moneda</th>
      <th>TC</th>
      <th>&nbsp;&nbsp;Beneficiario&nbsp;&nbsp;</th>
      <th>RFC</th>
      <th>Obser</th>
    </tr>";

    while ($row = $rslt_consulContaElect->fetch_assoc()) {
      $partidaContaElect .= "
                      <tr class='borderojo'>
                        <td colspan='2'>
                          <a href=''>
                            <img class='icochico' src='/Resources/iconos/002-trash.svg'>
                          </a>
                        </td>
                        <td>$row[s_tipoDetalle]</td>
                        <td>$row[s_BancoOri]</td>
                        <td>$row[s_ctaOri]</td>
                        <td>$row[s_BancoDest]</td>
                        <td>$row[s_CtaDest]</td>
                        <td>$row[s_UUID_CFDI]</td>
                        <td>$row[n_num]</td>
                        <td>$row[s_CFD_CBB_Serie]</td>
                        <td>$row[n_CFD_CBB_NumFol]</td>
                        <td>$row[s_Beneficiario]</td>
                        <td>$row[s_RFC]</td>
                        <td>$row[d_fecha]</td>
                        <td>$row[n_monto]</td>
                        <td>$row[s_BancoOriExt]</td>
                        <td>$row[s_BancoDestExt]</td>
                        <td>$row[s_TaxID]</td>
                        <td>$row[s_moneda]</td>
                        <td>$row[n_TipCamb]</td>
                        <td></td>
                        <td></td>
                        <td></td>

                      </tr>";

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
