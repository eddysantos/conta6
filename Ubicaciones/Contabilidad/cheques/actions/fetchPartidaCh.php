<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$query = "SELECT  fk_idcheque_folControl AS che_idctrl,
                  fk_id_cheque AS che_id_cheque,
                  fk_id_cuentaM AS che_cuantaM,
                  d_fecha AS che_fecha,
                  fk_id_cuenta AS che_cuenta,
                  fk_referencia AS che_referencia,
                  fk_id_cliente AS che_cliente,
                  s_folioCFDIext AS che_documento,
                  fk_anticipo AS che_anticipo,
                  fk_ctagastos AS che_ctagastos,
                  fk_factura AS che_factura,
                  fk_pago AS che_pago,
                  fk_nc AS che_nc,
                  s_desc AS che_desc,
                  n_cargo AS che_cargo,
                  n_abono AS che_abono,
                  pk_partida AS che_partida,
                  fk_gastoAduana AS che_gastoaduana,
                  fk_id_proveedor AS che_proveedor,
                  fk_usuario AS che_usuario,
                  d_fecha_ultmodif AS che_ultmodif
          FROM conta_t_cheques_det WHERE pk_partida = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s', $data['dbid']);
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
$rows = $rslt->num_rows;

if ($rows == 0) {
  $system_callback['code'] = 2;
  $system_callback['data'] = $_POST;
  exit_script($system_callback);
} elseif ($rows == 1) {
  $system_callback['code'] = 1;
  $system_callback['data'] = $rslt->fetch_assoc();
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);
} else {
  $system_callback = 3;
  exit_script($system_callback);
}



 ?>
