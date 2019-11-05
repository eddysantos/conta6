<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$s_nombreTabla = trim($_POST['s_nombreTabla']);
$pk_id_partida = trim($_POST['pk_id_partida']);
$n_inferior = trim($_POST['n_inferior']);
$n_superior = trim($_POST['n_superior']);
$n_cuota = trim($_POST['n_cuota']);
$n_porcentaje = trim($_POST['n_porcentaje']);
$fk_id_aduana = trim($_POST['fk_id_aduana']);
$n_salarioMinimo = trim($_POST['n_salarioMinimo']);
$n_diasTrabajados = trim($_POST['n_diasTrabajados']);
$n_diasPagar = trim($_POST['n_diasPagar']);
$n_anio = trim($_POST['n_anio']);
$n_integrado = trim($_POST['n_integrado']);
$n_inferior_b = trim($_POST['n_inferior_b']);
$n_superior_b = trim($_POST['n_superior_b']);
$n_cuota_b = trim($_POST['n_cuota_b']);
$n_ramo = trim($_POST['n_ramo']);
$s_descripcion = trim($_POST['s_descripcion']);
$n_baseSalarial = trim($_POST['n_baseSalarial']);
$n_topeSalarial = trim($_POST['n_topeSalarial']);
$n_patron = trim($_POST['n_patron']);
$n_trabajador = trim($_POST['n_trabajador']);
$fk_usuario_modifi = $_SESSION['user']['pk_usuario'];
$d_fecha_modifi = date("Y-m-d H:i:s",time());

$query = "UPDATE conta_cs_imss
SET n_inferior = ?,
n_superior = ?,
n_cuota = ?,
n_porcentaje = ?,
fk_id_aduana = ?,
n_salarioMinimo = ?,
n_diasTrabajados = ?,
n_diasPagar = ?,
n_anio = ?,
n_integrado = ?,
n_inferior_b = ?,
n_superior_b = ?,
n_cuota_b = ?,
n_ramo = ?,
s_descripcion = ?,
n_baseSalarial = ?,
n_topeSalarial = ?,
n_patron = ?,
n_trabajador = ?,
fk_usuario_modifi = ?,
d_fecha_modifi = ?
WHERE pk_id_partida = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ssssssssssssssssssssss',$n_inferior,
                                           $n_superior,
                                           $n_cuota,
                                           $n_porcentaje,
                                           $fk_id_aduana,
                                           $n_salarioMinimo,
                                           $n_diasTrabajados,
                                           $n_diasPagar,
                                           $n_anio,
                                           $n_integrado,
                                           $n_inferior_b,
                                           $n_superior_b,
                                           $n_cuota_b,
                                           $n_ramo,
                                           $s_descripcion,
                                           $n_baseSalarial,
                                           $n_topeSalarial,
                                           $n_patron,
                                           $n_trabajador,
                                           $usuario,
                                           $d_fecha_modifi,
                                           $pk_id_partida);

/*
$query = "UPDATE conta_cs_imss
SET n_inferior = ?,
n_superior = ?,
n_cuota = ?,
n_porcentaje = ?,
fk_id_aduana = ?,
n_salarioMinimo = ?,
n_diasTrabajados = ?,
n_diasPagar = ?,
n_anio = ?,
n_integrado = ?,
n_inferior_b = ?,
n_superior_b = ?,
n_cuota_b = ?,
n_ramo = ?,
s_descripcion = ?,
n_baseSalarial = ?,
n_topeSalarial = ?,
n_patron = ?,
n_trabajador = ?,
fk_usuario_modifi = ?,
d_fecha_modifi = ?
WHERE pk_id_partida = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ssssssssssssssssssssss',$n_inferior,
                                           $n_superior,
                                           $n_cuota,
                                           $n_porcentaje,
                                           $fk_id_aduana,
                                           $n_salarioMinimo,
                                           $n_diasTrabajados,
                                           $n_diasPagar,
                                           $n_anio,
                                           $n_integrado,
                                           $n_inferior_b,
                                           $n_superior_b,
                                           $n_cuota_b,
                                           $n_ramo,
                                           $s_descripcion,
                                           $n_baseSalarial,
                                           $n_topeSalarial,
                                           $n_patron,
                                           $n_trabajador,
                                           $fk_usuario_modifi,
                                           $d_fecha_modifi,
                                           $pk_id_partida);
*/
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

$descripcion = "Se modifico PARAMETRO: $s_nombreTabla, PARTIDA: $pk_id_partida, DATOS: $n_inferior,$n_superior,$n_cuota,$n_porcentaje,$fk_id_aduana,$n_salarioMinimo,$n_diasTrabajados,$n_diasPagar,$n_anio,$n_integrado,$n_inferior_b,$n_superior_b,$n_cuota_b,$n_ramo,$s_descripcion,$n_baseSalarial,$n_topeSalarial,$n_patron,$n_trabajador";
$clave = 'parametros';
$folio = $pk_id_partida;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

 ?>
