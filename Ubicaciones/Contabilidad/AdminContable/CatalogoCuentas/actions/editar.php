<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$pk_id_cuenta = trim($_POST['id_cuenta']);
$s_cta_desc = trim($_POST['concepto']);
$fk_codAgrup = trim($_POST['prodServ']);
$cuenta_sat = trim($_POST['cuenta_sat']);
$fk_id_naturaleza = trim($_POST['naturSAT']);
$s_cta_status = trim($_POST['status']);
$s_usuario_modifi = trim($_POST['s_usuario_modifi']);
$d_fecha_modifi = date("Y-m-d H:i:s",time());


$PARTE = substr($Cuenta_Mta_Detalle,0,4);
if( $PARTE == '0400' || $PARTE == '0402' || $PARTE == '0405' ){
			//mysqli_query($link,"UPDATE TBL_CUENTAS_MST SET Cta_desc = '$Descripcion_CTA_Det', codAgrup = '$ctaSAT' , natur = '$natur', cta_status = $status, c_ClaveProdServ = '$prodServSAT' WHERE Id_cuenta = '$Cuenta_Mta_Detalle' ");
			//mysqli_query($link,"UPDATE TBL_CONCEPTOS_HONORARIOS SET c_ClaveProdServ = '$prodServSAT'  Where ID_CUENTA = '$Cuenta_Mta_Detalle'");
			//mysqli_query($link,"UPDATE TBL_CONCEPTOS_HONORARIOS_libres SET c_ClaveProdServ = '$prodServSAT'  Where ID_CUENTA = '$Cuenta_Mta_Detalle'");
}else{
		//mysqli_query($link,"UPDATE TBL_CUENTAS_MST SET Cta_desc = '$Descripcion_CTA_Det', codAgrup = '$ctaSAT' , natur = '$natur', cta_status = $status WHERE Id_cuenta = '$Cuenta_Mta_Detalle' ");
    $query = "UPDATE conta_cs_cuentas_mst SET s_cta_desc = ?,fk_codAgrup = ?,fk_id_naturaleza = ?,s_cta_status = ?,s_usuario_modifi = ?,d_fecha_modifi = ?, fk_codAgrup = ? WHERE pk_id_cuenta = ?";
}

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
require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



 ?>
