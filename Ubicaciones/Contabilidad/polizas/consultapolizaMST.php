<?php
/*
$_SESSION['user_name'] = 'admado';
$usuario = $_SESSION['user_name'];


$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Databases/conexion.php';
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$dia_fecha = trim($_POST['dia_fecha']);
$dia_concepto = trim($_POST['dia_concepto']);
$dia_poliza = trim($_POST['dia_poliza']);


$query = "UPDATE conta_cs_cuentas_mst SET s_cta_desc = ?,fk_codAgrup = ?,fk_id_naturaleza = ?,s_cta_status = ?,s_usuario_modifi = ?,d_fecha_modifi = ?, fk_codAgrup = ? WHERE pk_id_cuenta = ?";


$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ssssssss',$s_cta_desc,$fk_codAgrup,$fk_id_naturaleza,$s_cta_status,$usuario,$d_fecha_modifi, $cuenta_sat,$pk_id_cuenta);
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

$descripcion = "Se Actualizo la Cuenta de Detalle: $s_cta_desc, de la cuenta $pk_id_cuenta, Codigo SAT:$fk_codAgrup, Naturaleza: $fk_id_naturaleza";

$clave = 'admonCtas';
$folio = $Cta_Mta;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


*/
 ?>
