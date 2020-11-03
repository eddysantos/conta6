<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$partida = trim($_POST['partida']);
$id_poliza = trim($_POST['id_poliza']);

#*** PAGO DE NOMINA
# SI LA CUENTA ES 0213-01 OR 0213-3 SE TIENE QUE QUITAR LA POLIZA DE PAGO EN NOMINA
require $root . '/Ubicaciones/Contabilidad/polizas/actions/consulta_datosPartida.php'; # $fk_id_cuenta, $fk_factura
$regimen = '';
require $root . '/Ubicaciones/Contabilidad/polizas/actions/buscarFacturasNomina_ctas0213pagos.php'; #$cuentaSuel,$cuentaHon


$query_eliminaPartPol = "DELETE FROM conta_t_polizas_det WHERE pk_partida = ?";

$stmt_eliminaPartPol = $db->prepare($query_eliminaPartPol);
if (!($stmt_eliminaPartPol)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_eliminaPartPol->bind_param('s',$partida);
if (!($stmt_eliminaPartPol)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_eliminaPartPol->errno]: $stmt_eliminaPartPol->error";
  exit_script($system_callback);
}

if (!($stmt_eliminaPartPol->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_eliminaPartPol->errno]: $stmt_eliminaPartPol->error";
  exit_script($system_callback);
}

$affected_eliminaPartPol = $stmt_eliminaPartPol->affected_rows;
$system_callback['affected'] = $affected_eliminaPartPol;
$system_callback['datos'] = $_POST;

if ($affected_eliminaPartPol == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "El query eliminaPartPol no hizo ningún cambio a la base de datos";
  exit_script($system_callback);
}

if ($affected_eliminaPartPol > 0) {

  if( $fk_id_cuenta == $cuentaHon || $fk_id_cuenta == $cuentaSuel ){
    $factura = $fk_factura;
    $system_callback['message2'] = 'llego3: '.$factura;
    require $root . '/Ubicaciones/Contabilidad/polizas/actions/buscarFacturasNomina_actualizaPagos.php';
  }


  #*** ELIMINAR EN CONTABILIDAD ELECTRONICA LOS REGISTROS DE LA PARTIDA QUE SE BORRA
  require $root . '/Resources/PHP/actions/contaElect_eliminarPartidaPol.php';

  $descripcion = "Se elimino la Partida: $partida de la Poliza: $id_poliza";

  $clave = 'polizas';
  $folio = $id_poliza;
  require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);
}
?>
