<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';
$system_callback = [];
$system_callback['data'] = "";

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

// $stmt->bind_param('ss',$idcheque_folControl,$id_cheque);
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
  $fk_id_cuenta = trim($row['fk_id_cuenta']);
  $partida = $row['pk_partida'];
  $abono = number_format($row['n_abono'],2);
  $cargo = number_format($row['n_cargo'],2);

  $system_callback['data'] .=
  "<tr class='row m-0 borderojo p-0' style='font-size:12px!important'>
      <td width='3%' class='p-0 pt-2'>
        <a href='#' onclick='borrarRegistroCheque($partida)'><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>
      </td>
      <td width='7%' class='p-0'>$fk_id_cuenta</td>
      <td width='6%' class='p-0'>$row[fk_gastoAduana]</td>
      <td width='6%' class='p-0'>$row[fk_id_proveedor]</td>
      <td width='7%' class='p-0'>$row[fk_referencia]</td>
      <td width='7%' class='p-0'>$row[fk_id_cliente]</td>
      <td width='7%' class='p-0'>$row[s_folioCFDIext]</td>
      <td width='6%' class='p-0'>$row[fk_factura]</td>
      <td width='7%' class='p-0'>$row[fk_ctagastos]</td>
      <td width='7%' class='p-0'>$row[fk_pago]</td>
      <td width='6%' class='p-0'>$row[fk_nc]</td>
      <td width='7%' class='p-0'>$row[fk_anticipo]</td>
      <td width='7%' class='p-0'>$row[fk_id_cheque]</td>
      <td width='7%' class='p-0'>$ $cargo</td>
      <td width='7%' class='p-0'>$ $abono</td>
      <td width='3%' class='p-0 pt-2'>
        <a href='#editarRegCheque' class='editar-partidaCh' db-id='$partida' data-toggle='modal'>
          <img class='icochico' src='/Resources/iconos/003-edit.svg'>
        </a>
      </td>

      <td width='3%' class='p-0'></td>
      <td width='7%' class='p-0'><b class='b'>Descripción : </b></td>
      <td width='70%' class='text-left p-0'>$row[s_desc]</td>
    </tr>";
}


$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
 ?>
