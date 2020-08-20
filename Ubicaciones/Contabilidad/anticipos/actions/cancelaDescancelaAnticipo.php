<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$id_poliza = trim($_POST['id_poliza']);
$id_anticipo = trim($_POST['id_anticipo']);
$status = trim($_POST['status']);

$fechaActual = date("Y-m-d H:i:s");

//CANCELA ANTICIPO
$query_antCancMST = "UPDATE conta_t_anticipos_mst SET s_cancela = ?,d_fecha_cancela = ? WHERE pk_id_anticipo = ?";
$stmt_antCancMST = $db->prepare($query_antCancMST);
if (!($stmt_antCancMST)) { die("Error during query prepare [$db->errno]: $db->error"); }
$stmt_antCancMST->bind_param('sss',$status,$fechaActual,$id_anticipo);
if (!($stmt_antCancMST)) { die("Error during variables binding [$stmt_antCancMST->errno]: $stmt_antCancMST->error"); }
if (!($stmt_antCancMST->execute())) { die("Error during query execute [$stmt_antCancMST->errno]: $stmt_antCancMST->error"); }
$affected = $stmt_antCancMST->affected_rows;
if ($affected == 0) { die("El query no hizo ningún cambio a la base de datos  [$stmt_antCancMST->errno]: $stmt_antCancMST->error"); }

if( $status == 0 ){ $status_txt = "Activo"; }
if( $status == 1 ){ $status_txt = "Cancelado"; }

$descripcion = "Se Actualizo el Anticipo: $id_anticipo, Estatus: $status_txt";

$clave = 'anticipos';
$folio = $id_anticipo;
require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

//CANCELA DETALLE
if( $status == 1 ){
    $query_antCancDET = "UPDATE conta_t_anticipos_det
                        SET n_cargo_cancela = n_cargo,
                            n_abono_cancela = n_abono
                        WHERE  fk_id_anticipo = ?";
    $stmt_antCancDET = $db->prepare($query_antCancDET);
    if (!($stmt_antCancDET)) { die("Error during query prepare cancela1 [$db->errno]: $db->error"); }
    $stmt_antCancDET->bind_param('s',$id_anticipo);
    if (!($stmt_antCancDET)) { die("Error during variables binding cancela1 [$stmt_antCancDET->errno]: $stmt_antCancDET->error"); }
    if (!($stmt_antCancDET->execute())) { die("Error during query execute cancela1 [$stmt_antCancDET->errno]: $stmt_antCancDET->error"); }


    $query_antCancDET_2 = "UPDATE conta_t_anticipos_det
                        SET n_cargo = 0,
                            n_abono = 0
                        WHERE  fk_id_anticipo = ?";
    $stmt_antCancDET_2 = $db->prepare($query_antCancDET_2);
    if (!($stmt_antCancDET_2)) { die("Error during query prepare cancela2 [$db->errno]: $db->error"); }
    $stmt_antCancDET_2->bind_param('s',$id_anticipo);
    if (!($stmt_antCancDET_2)) { die("Error during variables binding cancela2 [$stmt_antCancDET_2->errno]: $stmt_antCancDET_2->error"); }
    if (!($stmt_antCancDET_2->execute())) { die("Error during query execute cancela2 [$stmt_antCancDET_2->errno]: $stmt_antCancDET_2->error"); }
}



//DESCANCELA DETALLE
if( $status == 0 ){
  $query_antCancDET = "UPDATE conta_t_anticipos_det
                      SET n_cargo = n_cargo_cancela,
                          n_abono = n_abono_cancela
                      WHERE  fk_id_anticipo = ?";
  $stmt_antCancDET = $db->prepare($query_antCancDET);
  if (!($stmt_antCancDET)) { die("Error during query prepare descancela3 [$db->errno]: $db->error"); }
  $stmt_antCancDET->bind_param('s',$id_anticipo);
  if (!($stmt_antCancDET)) { die("Error during variables binding descancela3 [$stmt_antCancDET->errno]: $stmt_antCancDET->error"); }
  if (!($stmt_antCancDET->execute())) { die("Error during query execute descancela3 [$stmt_antCancDET->errno]: $stmt_antCancDET->error"); }


  $query_antCancDET_2 = "UPDATE conta_t_anticipos_det
                      SET n_cargo_cancela = 0,
                          n_abono_cancela = 0
                      WHERE  fk_id_anticipo = ?";
  $stmt_antCancDET_2 = $db->prepare($query_antCancDET_2);
  if (!($stmt_antCancDET_2)) { die("Error during query prepare descancela4 [$db->errno]: $db->error"); }
  $stmt_antCancDET_2->bind_param('s',$id_anticipo);
  if (!($stmt_antCancDET_2)) { die("Error during variables binding descancela4 [$stmt_antCancDET_2->errno]: $stmt_antCancDET_2->error"); }
  if (!($stmt_antCancDET_2->execute())) { die("Error during query execute descancela4 [$stmt_antCancDET_2->errno]: $stmt_antCancDET_2->error"); }
}



// CANCELO LA POLIZA DEL ANTICIPO*********************************************************
if( $id_poliza > 0 ){
  require $root . '/Resources/PHP/actions/cancelarPoliza.php';
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


/*
$query = "UPDATE conta_t_anticipos_mst SET s_cancela = ? WHERE pk_id_anticipo = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ss',$status,$id_anticipo);
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

if( $status == 0 ){ $status_txt = "Activo"; }
if( $status == 1 ){ $status_txt = "Cancelado"; }

$descripcion = "Se Actualizo el Anticipo: $id_anticipo, Estatus: $status_txt";

$clave = 'anticipos';
$folio = $id_anticipo;
require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';
*/





?>
