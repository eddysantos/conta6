<?php
$_SESSION['user_name'] = 'admado';
$usuario = $_SESSION['user_name'];
$aduana = 470;

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Databases/conexion.php';
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_poliza = trim($_POST['id_poliza']);
$fecha = trim($_POST['fecha']);
$id_referencia = trim($_POST['id_referencia']);
$tipo = trim($_POST['tipo']);
$cuenta = trim($_POST['cuenta']);
$id_cliente = trim($_POST['id_cliente']);
$documento = trim($_POST['documento']);
$factura = trim($_POST['factura']);
$anticipo = trim($_POST['anticipo']);
$cheque = trim($_POST['cheque']);
$cargo = trim($_POST['cargo']);
$abono = trim($_POST['abono']);
$desc = trim($_POST['desc']);
$gastoOficina = trim($_POST['gastoOficina']);

$query = "INSERT INTO tbl_polizas_det (pol_tipo,id_poliza,pol_fecha,pol_cuenta,pol_referencia,pol_cliente,pol_doc,pol_factura,pol_anticipo,pol_cheque,pol_desc,pol_cargo,pol_abono)
          VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";



?>
