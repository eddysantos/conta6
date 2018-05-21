<?php
$_SESSION['user_name'] = 'admado';
$usuario = $_SESSION['user_name'];


$accion = trim($_POST['accion']);

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Databases/conexion.php';
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';


$ctaSAT = trim($_POST['ctaSAT']);
$natur = trim($_POST['naturSAT']);
$status = trim($_POST['status']);
$naturSAT = trim($_POST['naturSAT']);
$prodServ = trim($_POST['prodServ']);



$PARTE = substr($Cuenta_Mta_Detalle,0,4);
if( $PARTE == '0400' || $PARTE == '0402' || $PARTE == '0405' ){
			mysqli_query($link,"UPDATE TBL_CUENTAS_MST SET Cta_desc = '$Descripcion_CTA_Det', codAgrup = '$ctaSAT' , natur = '$natur', cta_status = $status, c_ClaveProdServ = '$prodServSAT' WHERE Id_cuenta = '$Cuenta_Mta_Detalle' ");
			mysqli_query($link,"UPDATE TBL_CONCEPTOS_HONORARIOS SET c_ClaveProdServ = '$prodServSAT'  Where ID_CUENTA = '$Cuenta_Mta_Detalle'");
			mysqli_query($link,"UPDATE TBL_CONCEPTOS_HONORARIOS_libres SET c_ClaveProdServ = '$prodServSAT'  Where ID_CUENTA = '$Cuenta_Mta_Detalle'");
}else{
		mysqli_query($link,"UPDATE TBL_CUENTAS_MST SET Cta_desc = '$Descripcion_CTA_Det', codAgrup = '$ctaSAT' , natur = '$natur', cta_status = $status WHERE Id_cuenta = '$Cuenta_Mta_Detalle' ");
}


$descripcion = "Se Actualizo la Cuenta de Detalle: $Descripcion_CTA_Det, de la cuenta $Cuenta_Mta_Detalle, Codigo SAT:$ctaSAT, Naturaleza: $natur";

$clave = 'admonCtas';
$folio = $Cta_Mta;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

 ?>
