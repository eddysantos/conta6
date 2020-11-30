<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$system_callback['data'] = '';

$idcta = trim($_POST['idcta']);
$idbanco = trim($_POST['idbanco']);

$query = "select * FROM conta_t_cheques_mst where fk_id_cuentaMST = ? ORDER BY pk_id_cheque desc limit 20 ";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s', $idcta);
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
  $system_callback['data'] = "<option db-id='0'>No se encontraron datos</option>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

if ($rslt->num_rows > 0) {
  while ($row = $rslt->fetch_assoc()) {
    $system_callback['data'] .=
    "<option db-id='$row[pk_id_cheque]'>$row[pk_id_cheque]</option>";
  }
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


 ?>
