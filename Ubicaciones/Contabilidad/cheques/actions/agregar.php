<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$id_poliza = trim($_POST['id_poliza']);
$tipo = trim($_POST['tipo']);

$id_cheque = trim($_POST['id_cheque']);
$cuentaMST = trim($_POST['cuentaMST']);
$fecha = trim($_POST['fecha']);
$cuenta = trim($_POST['cuenta']);
$id_referencia = trim($_POST['id_referencia']);
$id_cliente = trim($_POST['id_cliente']);
$documento = trim($_POST['documento']);
$anticipo = trim($_POST['anticipo']);
$factura = trim($_POST['factura']);
$desc = trim($_POST['desc']);
$cargo = trim($_POST['cargo']);
$abono = trim($_POST['abono']);
$gastoOficina = trim($_POST['gastoOficina']);
$proveedor = trim($_POST['proveedor']);
$idcheque_folControl = trim($_POST['idcheque_folControl']);
$ctagastos = 0;
$notaCred = 0;

require $root . '/Resources/PHP/actions/insertaDetalleCheque.php';
$partida = $db->insert_id;

$affected = $stmt->affected_rows;
$system_callback['affected'] = $affected;
$system_callback['datos'] = $_POST;

if ($affected == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "El query no hizo ningún cambio a la base de datos";
  exit_script($system_callback);
}

$descripcion = "Se Genero Partida:$partida Ch:$id_cheque CtaMST:$cuentaMST Cta: $cuenta Ref:$id_referencia Clt:$id_cliente Doc:$documento Fac:$factura Ant:$anticipo Des:$desc Cargo:$cargo Abono:$abono Gasto:$gastoOficina Prov:$proveedor";

$clave = 'cheques';
$folio = $id_cheque;
require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';




if( $id_poliza > 0 ){

  $idDocumento = 'chequeDET';
  $queryDET = "INSERT INTO conta_t_polizas_det
  (fk_id_poliza,fk_id_cuenta,d_fecha,fk_tipo,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_anticipo,fk_cheque,fk_ctagastos,fk_factura,
  fk_pago,fk_nc,s_desc,n_cargo,n_abono,s_idDocumento,fk_idRegistro,fk_usuario)
  SELECT $id_poliza,fk_id_cuenta,d_fecha,fk_tipo,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_anticipo,fk_id_cheque,fk_ctagastos,fk_factura,
  fk_pago,fk_nc,s_desc,n_cargo,n_abono,'$idDocumento',pk_partida,'$usuario'
  FROM conta_t_cheques_det WHERE pk_partida = $partida";
  $stmtDET = $db->prepare($queryDET);
  if (!($stmtDET)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  if (!($stmtDET->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmtDET->errno]: $stmtDET->error";
    exit_script($system_callback);
  }
  $partidaPoliza = $db->insert_id;
  $rsltDET = $stmtDET->get_result();
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


?>
