<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$id_poliza = trim($_POST['id_poliza']);
$fecha = trim($_POST['fecha']);
$id_referencia = trim($_POST['id_referencia']);
$cuenta = trim($_POST['cuenta']);
$id_cliente = trim($_POST['id_cliente']);
$documento = trim($_POST['documento']);
$factura = trim($_POST['factura']);
$anticipo = trim($_POST['anticipo']);
$cargo = trim($_POST['cargo']);
$abono = trim($_POST['abono']);
$desc = trim($_POST['desc']);
$gastoOficina = trim($_POST['gastoOficina']);
$proveedor = trim($_POST['proveedor']);
$id_cheque = trim($_POST['id_cheque']);
$cuentaMST = trim($_POST['cuentaMST']);
$partidaCheque = trim($_POST['partidaCheque']);

$fechaActual = date ("Y-m-d H:i:s",time ());

$query = "UPDATE conta_t_cheques_det SET
fk_id_cuenta = ?,
fk_referencia = ?,
fk_id_cliente = ?,
s_folioCFDIext = ?,
fk_anticipo = ?,
fk_factura = ?,
s_desc = ?,
n_cargo = ?,
n_abono = ?,
fk_gastoAduana = ?,
fk_id_proveedor = ?,
fk_usuario = ?,
d_fecha_ultmodif = ?
WHERE pk_partida = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ssssssssssssss',
$cuenta,
$id_referencia,
$id_cliente,
$documento,
$anticipo,
$factura,
$desc,
$cargo,
$abono,
$gastoOficina,
$proveedor,
$usaurio,
$fechaActual,
$partidaCheque);
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





if( $id_poliza > 0 ){
    $mesPoliza = date_format(date_create($fecha),'m');

    $query_actualiza = "UPDATE conta_t_polizas_det
    SET fk_id_cuenta = ?,
    fk_referencia = ?,
    fk_id_cliente = ?,
    s_folioCFDIext = ?,
    fk_anticipo = ?,
    fk_factura = ?,
    s_desc = ?,
    n_cargo = ?,
    n_abono = ?,
    fk_gastoAduana = ?,
    fk_id_proveedor = ?,
    fk_usuario = ?,
    d_fecha_ultmodif = ?,
    d_mes = ?
    WHERE s_idDocumento = 'chequeDET' and fk_idRegistro = ?";

    $stmt_actualiza = $db->prepare($query_actualiza);
    if (!($stmt_actualiza)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    $stmt_actualiza->bind_param('sssssssssssssss',
    $cuenta,
    $id_referencia,
    $id_cliente,
    $documento,
    $anticipo,
    $factura,
    $desc,
    $cargo,
    $abono,
    $gastoOficina,
    $proveedor,
    $usaurio,
    $fechaActual,
    $mesPoliza,
    $partidaCheque);



    if (!($stmt_actualiza)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding [$stmt_actualiza->errno]: $stmt_actualiza->error";
      exit_script($system_callback);
    }

    if (!($stmt_actualiza->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution [$stmt_actualiza->errno]: $stmt_actualiza->error";
      exit_script($system_callback);
    }

    $affected = $stmt_actualiza->affected_rows;
    $system_callback['affected'] = $affected;
    $system_callback['datos'] = $_POST;

    if ($affected == 0) {
      $system_callback['code'] = 2;
      $system_callback['message'] = "El query no hizo ningún cambio a la base de datos";
      exit_script($system_callback);
    }

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


 ?>
