<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

  $partida = trim($_POST['partida']);
  $id_poliza = trim($_POST['id_poliza']);

	$system_callback = [];
	$data = $_POST;

  $query_UPDATE = "UPDATE conta_t_polizas_det SET fk_id_proveedor = null WHERE pk_partida = ?";
  $stmt_UPDATE = $db->prepare($query_UPDATE);
  if (!($stmt_UPDATE)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare INSERT [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_UPDATE->bind_param('s',$partida);
  if (!($stmt_UPDATE)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding INSERT [$stmt_UPDATE->errno]: $stmt_UPDATE->error";
    exit_script($system_callback);
  }
  if (!($stmt_UPDATE->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution INSERT [$stmt_UPDATE->errno]: $stmt_UPDATE->error";
    exit_script($system_callback);
  }

  $descripcion = "Se modifico POLIZA: $id_poliza PARTIDA: $partida PROVEEDOR: borrado ";

  $clave = 'polizas';
  $folio = $id_poliza;
  require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);

?>
