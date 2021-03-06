<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$system_callback['data'] = array();
$data = $_POST;

$query = "SELECT * FROM conta_t_nom_empleados WHERE pk_id_empleado = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s', $data['dbid']);
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
$rows = $rslt->num_rows;

if ($rows == 0) {
  $system_callback['code'] = 2;
  $system_callback['data'] = $_POST;
  exit_script($system_callback);
} elseif ($rows == 1) {
  $system_callback['code'] = 1;
  while ($row = $rslt->fetch_assoc()) {
    foreach ($row as $key => $value) {
      $system_callback['data'][$key] = utf8_encode($value);
    }
  }
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);
} else {
  $system_callback = 3;
  exit_script($system_callback);
}



 ?>
