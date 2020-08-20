<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$tipo = trim($_POST['tipo']);
$id_poliza = trim($_POST['id_poliza']);
$fecha = trim($_POST['fecha']);
$concepto = trim($_POST['concepto']);
$mesPoliza = date_format(date_create($fecha),'m');

$query = "UPDATE conta_t_polizas_mst SET d_fecha = ?, s_concepto = ?, d_mes = ? WHERE pk_id_poliza = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ssss',$fecha,$concepto,$mesPoliza,$id_poliza);
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

/* SE ACTUALIZA EL DETALLE DE LA POLIZA*/
mysqli_query($db,"UPDATE conta_t_polizas_det SET d_fecha= '$fecha', fk_tipo = $tipo WHERE fk_id_poliza = $id_poliza");

$descripcion = "Se Actualizo la Poliza: $id_poliza, Fecha:$fecha Concepto:$concepto Tipo:$tipo";

$clave = 'polizas';
$folio = $id_poliza;
require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
