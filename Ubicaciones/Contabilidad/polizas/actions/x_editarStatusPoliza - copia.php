<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';


$id_poliza = trim($_POST['id_poliza']);
$statusPoliza = trim($_POST['statusPoliza']);

$query = "UPDATE conta_t_polizas_mst SET s_cancela = ? WHERE pk_id_poliza = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ss',$statusPoliza,$id_poliza);
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

$affected = $stmt->affected_rows;
$system_callback['affected'] = $affected;
$system_callback['datos'] = $_POST;

if ($affected == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "El query no hizo ningún cambio a la base de datos";
  exit_script($system_callback);
}

if( $statusPoliza == 0 ){ $status_txt = "Activo"; }
if( $statusPoliza == 1 ){ $status_txt = "Cancelado"; }

$descripcion = "Se Actualizo la Poliza: $id_poliza, Estatus: $status_txt";

$clave = 'polizas';
$folio = $id_poliza;
require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

?>
