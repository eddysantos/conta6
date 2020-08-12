<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';
$partida = trim($_POST['partida']);
$prov = trim($_POST['prov']);
$query = "DELETE FROM conta_cs_bancos_proveedores WHERE pk_id_banco_prov = ?";
$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt->bind_param('s',$partida);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}
if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution detAnt [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}
$affected = $stmt->affected_rows;
$system_callback['affected'] = $affected;
$system_callback['datos'] = $_POST;
if ($affected == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "El query no hizo ningún cambio a la base de datos";
  exit_script($system_callback);
}
$descripcion = "Se elimino en bancos Partida: $partida del Proveedore: $prov";
$clave = 'prov';
$folio = $prov;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';
$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
