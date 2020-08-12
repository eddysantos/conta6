<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_cliente = trim($_POST['id_cliente']);
$idbanco = trim($_POST['idbanco']);
$nomBanco = trim($_POST['nomBanco']);
$cta_banco = trim($_POST['cta_banco']);

$query = "INSERT INTO conta_cs_bancos_clientes ( fk_id_banco, fk_id_cliente, s_nomBanExt, s_cta_banco, fk_usuario ) values (?,?,?,?,?) ";


$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('sssss',$idbanco,$id_cliente,$nomBanco,$cta_banco,$usuario);
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

$descripcion = "Guardo cuenta bancaria: $cta_banco, Banco: $idbanco $nomBanco, del cliente $id_cliente";

$clave = 'admonPersonas';
$folio = $id_cliente;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
