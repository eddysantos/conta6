<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$id_cliente = trim($_POST['id_cliente']);
$dias = trim($_POST['dias']);
$cvepaisOficina = 'MEX'; # indicando que es para las oficinas en Mexico

$query = "INSERT INTO conta_cs_diasCredito_clientes ( n_dias , fk_usuario_alta , fk_id_cliente, s_credito ) values (?,?,?,?) ";


$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ssss',$dias,$usuario,$id_cliente,$cvepaisOficina);
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

$descripcion = "Guardo dias de credito: $dias, del cliente $id_cliente";

$clave = 'admonPersonas';
$folio = $id_cliente;
require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



 ?>
