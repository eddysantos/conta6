<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';
$system_callback['data'] = '';

$dbGlobal = new Queryi('db_global');
$system_callback = [];
$data = $_POST;
$system_callback['data'] = '';

$data['string'];
$text = "%" . $data['string'] . "%";
$query = "SELECT sCveTrafico FROM cb_trafico WHERE sCveTrafico LIKE ? limit 5";

$stmt = $dbGlobal->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$dbGlobal->errno]: $dbGlobal->error";
  exit_script($system_callback);
}

$stmt->bind_param('s', $text);
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

while ($row = $rslt->fetch_assoc()) {
  $sCveTrafico = utf8_encode($row['sCveTrafico']);
  $system_callback['data'] .=
  "<p db-id='$sCveTrafico'>$sCveTrafico</p>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

 ?>
