<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$id_factura = trim($_POST['id_factura']);
//$id_factura = 25;
$query = "SELECT MAX(n_numParcialidad) AS n_numParcialidad, n_importeSaldoInsoluto from conta_t_pagos_captura_det where fk_id_facturaDR = ?";

//$query = "SELECT n_numParcialidad, n_importeSaldoInsoluto from conta_t_pagos_captura_det where fk_id_facturaDR = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s', $id_factura);
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
  $system_callback['code'] = 2;
  $system_callback['data'] =  "0";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

if ($rslt->num_rows > 0) {
  while ($row = $rslt->fetch_assoc() ) {
    //$row = $rslt->fetch_assoc();
    $parcialidad = $row[n_numParcialidad];
    $saldoInsoluto = $row[n_importeSaldoInsoluto];
    // if( $parcialidad >= 1 ){
    //   $parcialidad++ ;
    // }else{
    //   $parcialidad = 1;
    //   $saldoInsoluto = 0;
    // }
    $system_callback['data'] = $parcialidad."+".$saldoInsoluto."+".$id_factura;
  }
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



 ?>
