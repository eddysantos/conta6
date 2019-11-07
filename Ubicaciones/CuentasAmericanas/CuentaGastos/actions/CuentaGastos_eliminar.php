<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$cuenta = trim($_POST['cuenta']);

//borrando captura de cuenta de gastos MST
$query_CG_mst = "DELETE FROM contame_t_facturas WHERE pk_id_ctaAme = ?";
$stmt_CG_mst = $db->prepare($query_CG_mst);
if (!($stmt_CG_mst)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare CG_mst [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_CG_mst->bind_param('s',$cuenta);
if (!($stmt_CG_mst)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding CG_mst [$stmt_CG_mst->errno]: $stmt_CG_mst->error";
  exit_script($system_callback);
}

if (!($stmt_CG_mst->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution CG_mst [$stmt_CG_mst->errno]: $stmt_CG_mst->error";
  exit_script($system_callback);
}
/*
$affected = $stmt_CG_mst->affected_rows;
$system_callback['affected'] = $affected;
$system_callback['datos'] = $_POST;

if ($affected == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "primer query El query no hizo ningún cambio a la base de datos";
  exit_script($system_callback);
}
*/

//borrando captura de cuenta de gastos DET
$query_CG_det = "DELETE FROM contame_t_facturas_det WHERE fk_id_ctaAme = ?";
$stmt_CG_det = $db->prepare($query_CG_det);
if (!($stmt_CG_det)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare CG_det [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_CG_det->bind_param('s',$cuenta);
if (!($stmt_CG_det)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding CG_det [$stmt_CG_det->errno]: $stmt_CG_det->error";
  exit_script($system_callback);
}

if (!($stmt_CG_det->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution CG_det [$stmt_CG_det->errno]: $stmt_CG_det->error";
  exit_script($system_callback);
}
/*
$affected = $stmt_CG_det->affected_rows;
$system_callback['affected'] = $affected;
$system_callback['datos'] = $_POST;

if ($affected == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "segundo query El query no hizo ningún cambio a la base de datos";
  exit_script($system_callback);
}
*/



$descripcion = "Se elimino id_cuenta: $cuenta ";

$clave = 'ctaAme';
$folio = $cuenta;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>