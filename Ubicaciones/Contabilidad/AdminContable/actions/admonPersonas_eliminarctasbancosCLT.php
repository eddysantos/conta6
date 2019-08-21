<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$partida = trim($_POST['partida']);

$query = "DELETE FROM conta_cs_bancos_clientes WHERE pk_id_banco_clt = ?";
$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare CG_mst [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s',$partida);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding CG_mst [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution CG_mst [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}


$descripcion = "Elimino cuenta bancaria partida: $partida, del cliente $id_cliente";

$clave = 'admonPersonas';
$folio = $id_cliente;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
