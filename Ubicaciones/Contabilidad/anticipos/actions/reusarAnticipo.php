<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_poliza = trim($_POST['id_poliza']);
$id_anticipo = trim($_POST['id_anticipo']);


#********** borrando detalle de anticipo **********

$query = "DELETE FROM conta_t_anticipos_det WHERE fk_id_anticipo= ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s',$id_anticipo);
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
  $system_callback['message'] = "El query no hizo ningún cambio a la base de datos al borrar datos del anticipo";
  exit_script($system_callback);
}

$descripcion = "Se elimino detalle del Anticipo $id_anticipo desde btn_reusarAnt";

$clave = 'anticipos';
$folio = $id_anticipo;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';



//********** borrando póliza en el anticipo **********//

$queryUpdateAnt = "UPDATE conta_t_anticipos_mst SET fk_id_poliza = null WHERE pk_id_anticipo= ?";

$stmtUpdateAnt = $db->prepare($queryUpdateAnt);
if (!($stmtUpdateAnt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtUpdateAnt->bind_param('s',$id_anticipo);
if (!($stmtUpdateAnt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmtUpdateAnt->errno]: $stmtUpdateAnt->error";
  exit_script($system_callback);
}

if (!($stmtUpdateAnt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmtUpdateAnt->errno]: $stmtUpdateAnt->error";
  exit_script($system_callback);
}

$affected = $stmtUpdateAnt->affected_rows;
$system_callback['affected'] = $affected;
$system_callback['datos'] = $_POST;

if ($affected == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "El query no hizo ningún cambio a la base de datos al quitar póliza del anticipo";
  exit_script($system_callback);
}

$descripcion = "Se elimino Póliza:$id_poliza del Anticipo $id_anticipo desde btn_reusarAnt";

$clave = 'anticipos';
$folio = $id_anticipo;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';





//********** borrando detalle de póliza **********//

if( $id_poliza > 0 ){

  $queryBorrarPolDet = "DELETE FROM conta_t_polizas_det WHERE fk_id_poliza = ?";

  $stmtBorrarPolDet = $db->prepare($queryBorrarPolDet);
  if (!($stmtBorrarPolDet)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmtBorrarPolDet->bind_param('s',$id_poliza);
  if (!($stmtBorrarPolDet)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmtBorrarPolDet->errno]: $stmtBorrarPolDet->error";
    exit_script($system_callback);
  }

  if (!($stmtBorrarPolDet->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmtBorrarPolDet->errno]: $stmtBorrarPolDet->error";
    exit_script($system_callback);
  }

  $affected = $stmtBorrarPolDet->affected_rows;
  $system_callback['affected'] = $affected;
  $system_callback['datos'] = $_POST;

  if ($affected == 0) {
    $system_callback['code'] = 2;
    $system_callback['message'] = "El query no hizo ningún cambio a la base de datos al quitar detalle de póliza";
    exit_script($system_callback);
  }

  $descripcion = "Se elimino detalle en Póliza: $id_poliza del Anticipo $id_anticipo desde btn_reusarAnt";

  $clave = 'anticipos';
  $folio = $id_anticipo;
  require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


  #'**************** BORRANDO - CONTABILIDAD ELECTRONICA *******************************
  $queryBorrarContaElect = "DELETE FROM conta_t_polizas_det_contaelec WHERE fk_id_poliza = ?";

  $stmtBorrarContaElect = $db->prepare($queryBorrarContaElect);
  if (!($stmtBorrarContaElect)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmtBorrarContaElect->bind_param('s',$id_poliza);
  if (!($stmtBorrarContaElect)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmtBorrarContaElect->errno]: $stmtBorrarContaElect->error";
    exit_script($system_callback);
  }

  if (!($stmtBorrarContaElect->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmtBorrarContaElect->errno]: $stmtBorrarContaElect->error";
    exit_script($system_callback);
  }

  $affected = $stmtBorrarContaElect->affected_rows;
  $system_callback['affected'] = $affected;
  $system_callback['datos'] = $_POST;

  if ($affected == 0) {
    $system_callback['code'] = 2;
    $system_callback['message'] = "El query no hizo ningún cambio a la base de datos al quitar detalle de póliza";
    exit_script($system_callback);
  }
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
