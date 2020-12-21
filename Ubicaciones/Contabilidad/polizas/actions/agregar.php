<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

// $id_poliza = trim($_POST['id_poliza']);
// $fecha = trim($_POST['fecha']);
// $id_referencia = trim($_POST['id_referencia']);
// $tipo = trim($_POST['tipo']);
// $cuenta = trim($_POST['cuenta']);
// $id_cliente = trim($_POST['id_cliente']);
// $documento = trim($_POST['documento']);
// $factura = trim($_POST['factura']);
// $anticipo = trim($_POST['anticipo']);
// $cheque = trim($_POST['cheque']);
// $cargo = trim($_POST['cargo']);
// $abono = trim($_POST['abono']);
// $desc = trim($_POST['desc']);
// $gastoOficina = trim($_POST['gastoOficina']);
// $proveedor = trim($_POST['proveedor']);

extract($_POST);

if ($cheque == '') {$cheque = NULL;}
if ($notaCred == '') {$notaCred = NULL;}
if ($ctagastos == '') {$ctagastos = NULL;}

require $root . '/Resources/PHP/actions/insertaDetallePoliza.php';

$affected = $stmt->affected_rows;
$system_callback['affected'] = $affected;
$system_callback['datos'] = $_POST;

if ($affected == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "El query no hizo ningún cambio a la base de datos";
  exit_script($system_callback);
}

$descripcion = "Se inserto Poliza: $id_poliza Cta: $cuenta Ref:$id_referencia Clt:$id_cliente Doc:$documento Fac:$factura Ant:$anticipo Ch:$cheque Des:$desc Cargo:$cargo Abono:$abono Gasto:$gastoOficina Prov:$proveedor";

$clave = 'polizas';
$folio = $id_poliza;
require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


?>
