<?PHP
error_reporting(E_ALL);
//ini_set('display_errors',1);

$root = $_SERVER['DOCUMENT_ROOT'];

require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';
require $root . '/conta6/Resources/PHP/actions/validarFormulario.php';
#limpiarBlancos($txt) <-- eliminaBlancos($cadena)

// $id_factura = $_POST['id_factura'];
// $cuenta = $_POST['id_cuenta'];
// $s_UUID = $_POST['UUID'];
// $totalFac = $_POST['total'];
// $id_cliente = $_POST['id_cliente'];
// $referencia = $_POST['id_referencia'];
// $rfcR = $_POST['rfc'];
// $accion = $_POST['accion'];

# http://localhost:88/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/cancelarCFDI_factura.php
$id_factura = 14;
$id_captura = 177;
$cuenta = 177;
$s_UUID = '647BF312-7E57-4177-BAC1-947FCAEEB89F';
$totalFac = 1102.00;
$id_cliente = 'CLT_6548';
$referencia = 'SN';
$rfcR = 'MES0204122KA';
$accion = 'cancelarCFDI';
#$accion = 'estadoCFDI';

# nombre de carpetas y rutas de almacenamiento
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_1path.php'; #$nombre_archivoCancela,$nombre_archivoCancelaTest
require $root . '/conta6/Resources/PHP/actions/generarCFDI_proceso_functionTimbrar.php';

$modo = true; #test
#$modo = false; #produccion

//global $root;
require $root . '/conta6/Resources/PHP/actions/generarCFDI_proceso_rutaKeyCer.php'; #$fileKey,$fileCer
require $root . '/conta6/Resources/PHP/actions/consultaDatosCertificado.php'; #$total_datosCert
$pswdCerts = $row_datosCert['s_cve'];
$s_rfcE = $row_datosCert['s_RFC'];
$s_userPAC = $row_datosCert['s_userPAC'];
$s_pwdPAC = $row_datosCert['s_pwdPAC'];


if( $accion == 'cancelarCFDI'){
  echo cancelarCFDI($rfcR,$s_UUID,$totalFac,$modo);
}

if( $accion == 'estadoCFDI'){
  echo $respuesta = estadoCFDI($rfcR,$s_UUID,$totalFac,$modo);
}








?>
