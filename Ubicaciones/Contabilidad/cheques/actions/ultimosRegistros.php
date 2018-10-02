<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_cheque = trim($_POST['id_cheque']);
$id_ctaMST = trim($_POST['id_ctaMST']);
$idcheque_folControl = $_POST['idcheque_folControl'];

$query = "SELECT * FROM conta_t_cheques_det WHERE fk_idcheque_folControl = ? ORDER BY pk_partida DESC limit 3";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

//$stmt->bind_param('ss',$id_cheque,$id_ctaMST);
$stmt->bind_param('s',$idcheque_folControl);
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
  $system_callback['data'] = "<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $partida = $row['pk_partida'];

  $system_callback['data'] .=
  "<tr class='row m-0 borderojo  pb-2 p-0' style='font-size:12px!important'>
      <td class='xs'>
        <a href='#' onclick='borrarRegistroCheque($partida)'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>
      </td>
      <td class='pt-3 small p-0'>$row[fk_id_cuenta]</td>
      <td class='pt-3 ssm p-0'>$row[fk_gastoAduana]</td>
      <td class='pt-3 ssm p-0'>$row[fk_id_proveedor]</td>
      <td class='pt-3 small p-0'>$row[fk_referencia]</td>
      <td class='pt-3 small p-0'>$row[fk_id_cliente]</td>
      <td class='pt-3 small p-0'>$row[s_folioCFDIext]</td>
      <td class='pt-3 ssm p-0'>$row[fk_factura]</td>
      <td class='pt-3 ssm p-0'>$row[fk_ctagastos]</td>
      <td class='pt-3 ssm p-0'>$row[fk_pago]</td>
      <td class='pt-3 small p-0'>$row[fk_nc]</td>
      <td class='pt-3 small p-0'>$row[fk_anticipo]</td>
      <td class='pt-3 ssm p-0'>$row[fk_id_cheque]</td>
      <td class='pt-3 med p-0'>$row[s_desc]</td>
      <td class='pt-3 small p-0'>$row[n_cargo]</td>
      <td class='pt-3 small p-0'>$row[n_abono]</td>
      <td class='pt-3 xxs'>
        <a href='#editarRegCheque' class='editar-partidaCh' db-id='$partida' data-toggle='modal'>
          <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
        </a>
      </td>
    </tr>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
 ?>
