<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_poliza = trim($_POST['id_poliza']);
$id_cheque = trim($_POST['id_cheque']);
$id_cuentaMST = trim($_POST['id_cuentaMST']);
$status = trim($_POST['status']);

$fechaActual = date("Y-m-d H:i:s");

/*
$query = "UPDATE conta_t_cheques_mst SET s_cancela = ? WHERE pk_id_cheque = ? AND fk_id_cuentaMST = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('sss',$status,$id_cheque,$id_cuentaMST);
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
*/

//CANCELA CHEQUE
$query_cheCancMST = "UPDATE conta_t_cheques_mst SET s_cancela = ?,d_fecha_cancela = ? WHERE pk_id_cheque = ? AND fk_id_cuentaMST = ?";
$stmt_cheCancMST = $db->prepare($query_cheCancMST);
if (!($stmt_cheCancMST)) { die("Error during query prepare [$db->errno]: $db->error"); }
$stmt_cheCancMST->bind_param('ssss',$status,$fechaActual,$id_cheque,$id_cuentaMST);
if (!($stmt_cheCancMST)) { die("Error during variables binding [$stmt_cheCancMST->errno]: $stmt_cheCancMST->error"); }
if (!($stmt_cheCancMST->execute())) { die("Error during query execute [$stmt_cheCancMST->errno]: $stmt_cheCancMST->error"); }
$affected = $stmt_cheCancMST->affected_rows;
if ($affected == 0) { die("El query no hizo ningún cambio a la base de datos  [$stmt_cheCancMST->errno]: $stmt_cheCancMST->error"); }

if( $status == 0 ){ $status_txt = "Activo"; }
if( $status == 1 ){ $status_txt = "Cancelado"; }

$descripcion = "Se Actualizo el Cheque: $id_cheque, Cta: $id_cuentaMST Estatus: $status_txt";

$clave = 'cheques';
$folio = $id_cheque;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


//CANCELA DETALLE
if( $status == 1 ){
    $query_cheCancDET = "UPDATE conta_t_cheques_det
                        SET n_cargo_cancela = n_cargo,
                            n_abono_cancela = n_abono
                        WHERE  fk_id_cheque = ? AND fk_id_cuentaM = ?";
    $stmt_cheCancDET = $db->prepare($query_cheCancDET);
    if (!($stmt_cheCancDET)) { die("Error during query prepare cancela1 [$db->errno]: $db->error"); }
    $stmt_cheCancDET->bind_param('ss',$id_cheque,$id_cuentaMST);
    if (!($stmt_cheCancDET)) { die("Error during variables binding cancela1 [$stmt_cheCancDET->errno]: $stmt_cheCancDET->error"); }
    if (!($stmt_cheCancDET->execute())) { die("Error during query execute cancela1 [$stmt_cheCancDET->errno]: $stmt_cheCancDET->error"); }


    $query_cheCancDET_2 = "UPDATE conta_t_cheques_det
                        SET n_cargo = 0,
                            n_abono = 0
                        WHERE  fk_id_cheque = ? AND fk_id_cuentaM = ?";
    $stmt_cheCancDET_2 = $db->prepare($query_cheCancDET_2);
    if (!($stmt_cheCancDET_2)) { die("Error during query prepare cancela2 [$db->errno]: $db->error"); }
    $stmt_cheCancDET_2->bind_param('ss',$id_cheque,$id_cuentaMST);
    if (!($stmt_cheCancDET_2)) { die("Error during variables binding cancela2 [$stmt_cheCancDET_2->errno]: $stmt_cheCancDET_2->error"); }
    if (!($stmt_cheCancDET_2->execute())) { die("Error during query execute cancela2 [$stmt_cheCancDET_2->errno]: $stmt_cheCancDET_2->error"); }
}



//DESCANCELA DETALLE
if( $status == 0 ){
  $query_cheCancDET = "UPDATE conta_t_cheques_det
                      SET n_cargo = n_cargo_cancela,
                          n_abono = n_abono_cancela
                      WHERE  fk_id_cheque = ? AND fk_id_cuentaM = ?";
  $stmt_cheCancDET = $db->prepare($query_cheCancDET);
  if (!($stmt_cheCancDET)) { die("Error during query prepare descancela3 [$db->errno]: $db->error"); }
  $stmt_cheCancDET->bind_param('ss',$id_cheque,$id_cuentaMST);
  if (!($stmt_cheCancDET)) { die("Error during variables binding descancela3 [$stmt_cheCancDET->errno]: $stmt_cheCancDET->error"); }
  if (!($stmt_cheCancDET->execute())) { die("Error during query execute descancela3 [$stmt_cheCancDET->errno]: $stmt_cheCancDET->error"); }


  $query_cheCancDET_2 = "UPDATE conta_t_cheques_det
                      SET n_cargo_cancela = 0,
                          n_abono_cancela = 0
                      WHERE  fk_id_cheque = ? AND fk_id_cuentaM = ?";
  $stmt_cheCancDET_2 = $db->prepare($query_cheCancDET_2);
  if (!($stmt_cheCancDET_2)) { die("Error during query prepare descancela4 [$db->errno]: $db->error"); }
  $stmt_cheCancDET_2->bind_param('ss',$id_cheque,$id_cuentaMST);
  if (!($stmt_cheCancDET_2)) { die("Error during variables binding descancela4 [$stmt_cheCancDET_2->errno]: $stmt_cheCancDET_2->error"); }
  if (!($stmt_cheCancDET_2->execute())) { die("Error during query execute descancela4 [$stmt_cheCancDET_2->errno]: $stmt_cheCancDET_2->error"); }
}



// CANCELO LA POLIZA DEL CHEQUE *********************************************************
if( $id_poliza > 0 ){
  require $root . '/conta6/Resources/PHP/actions/cancelarPoliza.php';
}



$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

?>
