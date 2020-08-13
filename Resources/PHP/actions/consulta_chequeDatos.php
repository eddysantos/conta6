<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];

$idcta = trim($_POST['idcta']);
$numcheque = trim($_POST['numcheque']);

$query = "select * FROM conta_t_cheques_mst where fk_id_cuentaMST = ? and pk_id_cheque = ? ";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ss', $idcta,$numcheque);
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

$rslt = $stmt->get_result();

if ($rslt->num_rows == 0) {
  $system_callback['code'] = 1;
  $system_callback['data'] =
  "<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

if ($rslt->num_rows > 0) {
  $row = $rslt->fetch_assoc();
    $system_callback['valor'] = $row['n_valor'];
    $system_callback['fecha'] = $row['d_fechache'];
    $system_callback['nombre'] = $row['s_nomOrd'];
    $system_callback['rfc'] = $row['s_rfc'];
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


 ?>
