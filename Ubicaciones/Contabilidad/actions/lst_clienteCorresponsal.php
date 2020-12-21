<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
// $data = $_POST;

$referencia = trim($_POST['referencia']);
$cltRef = "";
$cltRefNom = "";
$cltRefCor = "";
$system_callback['data'] .="<option selected value='0'>Seleccione Cliente/Corresponsal</option>";


error_log('entre a la pagina y tengo referencia ' . $referencia);


$query = "SELECT pk_id_cliente, s_nombre, fk_id_corresp
FROM conta_replica_clientes
WHERE pk_id_cliente IN(SELECT fk_id_cliente FROM conta_replica_referencias WHERE pk_referencia = '$referencia')";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
  exit_script($system_callback);
}
// $stmt->bind_param('s',$referencia);
// if (!($stmt)) { die("Error during query prepare [$stmt->errno]: $stmt->error");	}
error_log('query : ' . $query);
if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}
$rslt = $stmt->get_result();
$rows = $rslt->num_rows;
if( $rows > 0 ){
  $rowCLT = $rslt->fetch_assoc();
	$cltRef = $rowCLT['pk_id_cliente'];
  $cltRefNom = utf8_encode($rowCLT['s_nombre']);
  $cltRefCor = $rowCLT['fk_id_corresp'];
  $system_callback['data'] .= "<option value='$cltRef'>$cltRef -- $cltRefNom -- $referencia</option>";
  error_log('$cltRefCor : ' . $cltRefCor);

}

if( $cltRefCor > 0 ){
  error_log('entre en soy mayor a cero');

  $queryCor = "SELECT * FROM conta_t_corresponsales WHERE pk_id_corresp ='$cltRefCor'";
  $stmtCor = $db->prepare($queryCor);
  if (!($stmtCor)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
    exit_script($system_callback);
  }
	// $stmtCor->bind_param('s',$cltRefCor);
	// if (!($stmtCor)) { die("Error during query prepare [$stmtCor->errno]: $stmtCor->error");	}
  error_log($queryCor);
	if (!($stmtCor->execute())) { die("Error during query prepare [$stmtCor->errno]: $stmtCor->error"); }
	$rsltCor = $stmtCor->get_result();
	$rowsCor = $rsltCor->num_rows;
  if( $rowsCor > 0 ){
    error_log('entre a soy mayor a cero en conta_t_corresponsales');

    $rowCor = $rsltCor->fetch_assoc();
		$cltCor = $rowCor['fk_id_cliente'];
    $cltCorNom = utf8_encode($rowCor['s_nombre']);
    $system_callback['data'] .= "<option value='$cltCor'>$cltCor -- $cltCorNom</option>";
  }
}


$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


 ?>
