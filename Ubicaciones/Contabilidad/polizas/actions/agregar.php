<?php
$root = $_SERVER['DOCUMENT_ROOT'];
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

$query = "INSERT INTO conta_t_polizas_det (fk_tipo,fk_id_poliza,d_fecha,fk_id_cuenta,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_factura,fk_anticipo,fk_cheque,s_desc,n_cargo,n_abono)
          VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('sssssssssssss',$tipo,$id_poliza,$fecha,$cuenta,$id_referencia,$id_cliente,$documento,$factura,$anticipo,$cheque,$desc,$cargo,$abono);
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

$descripcion = "Se inserto Poliza: $id_poliza Cta: $cuenta Ref:$id_referencia Clt:$id_cliente Doc:$documento Fac:$factura Ant:$anticipo Ch:$cheque Des:$desc Cargo:$cargo Abono:$abono";

$clave = 'polizas';
$folio = $id_poliza;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


?>
