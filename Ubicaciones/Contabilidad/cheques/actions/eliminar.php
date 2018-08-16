<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$partida = trim($_POST['partida']);
$idcheque_folControl = trim($_POST['idcheque_folControl']);
$id_poliza = trim($_POST['id_poliza']);
$id_cheque = trim($_POST['id_cheque']);
$id_ctaMST = trim($_POST['id_ctaMST']);

//borrando en el detalle del anticipo
$query = "DELETE FROM conta_t_cheques_det WHERE pk_partida = ?";
$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s',$partida);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution detAnt [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$affected = $stmt->affected_rows;
$system_callback['affected'] = $affected;
$system_callback['datos'] = $_POST;

if ($affected == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "primer query El query no hizo ningún cambio a la base de datos";
  exit_script($system_callback);
}


$descripcion = "Se elimino la Partida: $partida del Cheque: $id_cheque ctaMST: $id_ctaMST";

$clave = 'cheques';
$folio = $id_cheque;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


if( $id_poliza > 0 ){
  //consulto partida en polizas
  $queryConsPartPol = "SELECT * FROM conta_t_polizas_det WHERE fk_id_poliza = ? and s_idDocumento = 'chequeDET' and fk_idRegistro = ? ";
  $stmtConsPartPol = $db->prepare($queryConsPartPol);
  if (!($stmtConsPartPol)) { die("Error during query prepare [$db->errno]: $db->error"); }
  $stmtConsPartPol->bind_param('ss',$id_poliza,$partida);
  if (!($stmtConsPartPol)) { die("Error during query prepare [$stmtConsPartPol->errno]: $stmtConsPartPol->error"); }
  if (!($stmtConsPartPol->execute())) { die("Error during query prepare [$stmtConsPartPol->errno]: $stmtConsPartPol->error"); }
  $rsltConsPartPol = $stmtConsPartPol->get_result();
  $rowConsPartPol = $rsltConsPartPol->fetch_assoc();
  $partidaPol = trim($rowConsPartPol['pk_partida']);

  if( $partidaPol > 0 ){
      #'**************** BORRANDO - CONTABILIDAD ELECTRONICA *******************************
      $queryBorrarContaElect = "DELETE FROM conta_t_polizas_det_contaelec WHERE fk_id_poliza = ? and fk_partidaPol = ?";
      $stmtBorrarContaElect = $db->prepare($queryBorrarContaElect);
      if (!($stmtBorrarContaElect)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
        exit_script($system_callback);
      }

      $stmtBorrarContaElect->bind_param('ss',$id_poliza,$partidaPol);
      if (!($stmtBorrarContaElect)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding [$stmtBorrarContaElect->errno]: $stmtBorrarContaElect->error";
        exit_script($system_callback);
      }

      if (!($stmtBorrarContaElect->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution ContaElec [$stmtBorrarContaElect->errno]: $stmtBorrarContaElect->error";
        exit_script($system_callback);
      }

      $affected = $stmtBorrarContaElect->affected_rows;
      $system_callback['affected'] = $affected;
      $system_callback['datos'] = $_POST;

      // if ($affected == 0) {
      //   $system_callback['code'] = 2;
      //   $system_callback['message'] = "El registro no existe en contabilidad electronica";
      //   //exit_script($system_callback);
      // }
  }

  //borrando detalle del polizas
  $queryBorrarPolDet = "DELETE FROM conta_t_polizas_det WHERE fk_id_poliza = ? and s_idDocumento = 'chequeDET' and fk_idRegistro = ? ";

  $stmtBorrarPolDet = $db->prepare($queryBorrarPolDet);
  if (!($stmtBorrarPolDet)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  // $stmtBorrarPolDet->bind_param('s',$id_poliza,$partida);
  $stmtBorrarPolDet->bind_param('ss',$id_poliza,$partida);
  if (!($stmtBorrarPolDet)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmtBorrarPolDet->errno]: $stmtBorrarPolDet->error";
    exit_script($system_callback);
  }

  if (!($stmtBorrarPolDet->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution detPol [$stmtBorrarPolDet->errno]: $stmtBorrarPolDet->error";
    exit_script($system_callback);
  }

  $affected = $stmtBorrarPolDet->affected_rows;
  $system_callback['affected'] = $affected;
  $system_callback['datos'] = $_POST;

  // if ($affected == 0) {
  //   $system_callback['code'] = 2;
  //   $system_callback['message'] = "El registro no existe en detalle de póliza";
  //   //exit_script($system_callback);
  // }

  $descripcion = "Se elimino detalle en Póliza: $id_poliza del Anticipo $id_anticipo";

  $clave = 'anticipos';
  $folio = $id_anticipo;
  require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';
}


$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
