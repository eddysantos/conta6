<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';


$id_cheque = trim($_POST['id_cheque']);
$id_cuentaMST = trim($_POST['id_cuentaMST']);
$status = trim($_POST['status']);

$query = "UPDATE conta_t_cheques_mst SET s_cancela = ? WHERE pk_id_cheque = ? AND fk_id_cuentaMST = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('sss',$status,$id_cheque,$id_cuentaMST);
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

if( $status == 0 ){ $status_txt = "Activo"; }
if( $status == 1 ){ $status_txt = "Cancelado"; }

$descripcion = "Se Actualizo el Cheque: $id_cheque, Estatus: $status_txt";

$clave = 'cheques';
$folio = $id_cheque;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

?>
