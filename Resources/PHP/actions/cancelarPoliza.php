<?PHP
/*
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_poliza = 2;
$status = 0;

$id_poliza = trim($_POST['id_poliza']);
$status = trim($_POST['statusPoliza']);
*/

$fechaActual = date("Y-m-d H:i:s");

//CANCELA POLIZA
$query_polCancMST = "UPDATE conta_t_polizas_mst SET s_cancela = ?, d_fecha_cancela = ? WHERE pk_id_poliza = ?";
$stmt_polCancMST = $db->prepare($query_polCancMST);
if (!($stmt_polCancMST)) { die("Error during query prepare [$db->errno]: $db->error"); }
$stmt_polCancMST->bind_param('sss',$status,$fechaActual,$id_poliza);
if (!($stmt_polCancMST)) { die("Error during variables binding [$stmt_polCancMST->errno]: $stmt_polCancMST->error"); }
if (!($stmt_polCancMST->execute())) { die("Error during query execute [$stmt_polCancMST->errno]: $stmt_polCancMST->error"); }
$affected = $stmt_polCancMST->affected_rows;
if ($affected == 0) { die("El query no hizo ningún cambio a la base de datos  [$stmt_polCancMST->errno]: $stmt_polCancMST->error"); }

if( $status == 0 ){ $status_txt = "Activo"; }
if( $status == 1 ){ $status_txt = "Cancelado"; }

$descripcion = "Se Actualizo la Poliza: $id_poliza, Estatus: $status_txt";

$clave = 'polizas';
$folio = $id_poliza;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';



//CANCELA DETALLE
if( $status == 1 ){
    $query_polCancDET = "UPDATE conta_t_polizas_det
                        SET n_cargo_cancela = n_cargo,
                            n_abono_cancela = n_abono
                        WHERE  fk_id_poliza = ?";
    $stmt_polCancDET = $db->prepare($query_polCancDET);
    if (!($stmt_polCancDET)) { die("Error during query prepare cancela1 [$db->errno]: $db->error"); }
    $stmt_polCancDET->bind_param('s',$id_poliza);
    if (!($stmt_polCancDET)) { die("Error during variables binding cancela1 [$stmt_polCancDET->errno]: $stmt_polCancDET->error"); }
    if (!($stmt_polCancDET->execute())) { die("Error during query execute cancela1 [$stmt_polCancDET->errno]: $stmt_polCancDET->error"); }


    $query_polCancDET_2 = "UPDATE conta_t_polizas_det
                        SET n_cargo = 0,
                            n_abono = 0
                        WHERE  fk_id_poliza = ?";
    $stmt_polCancDET_2 = $db->prepare($query_polCancDET_2);
    if (!($stmt_polCancDET_2)) { die("Error during query prepare cancela2 [$db->errno]: $db->error"); }
    $stmt_polCancDET_2->bind_param('s',$id_poliza);
    if (!($stmt_polCancDET_2)) { die("Error during variables binding cancela2 [$stmt_polCancDET_2->errno]: $stmt_polCancDET_2->error"); }
    if (!($stmt_polCancDET_2->execute())) { die("Error during query execute cancela2 [$stmt_polCancDET_2->errno]: $stmt_polCancDET_2->error"); }
}



//DESCANCELA DETALLE
if( $status == 0 ){
  $query_polCancDET = "UPDATE conta_t_polizas_det
                      SET n_cargo = n_cargo_cancela,
                          n_abono = n_abono_cancela
                      WHERE  fk_id_poliza = ?";
  $stmt_polCancDET = $db->prepare($query_polCancDET);
  if (!($stmt_polCancDET)) { die("Error during query prepare descancela3 [$db->errno]: $db->error"); }
  $stmt_polCancDET->bind_param('s',$id_poliza);
  if (!($stmt_polCancDET)) { die("Error during variables binding descancela3 [$stmt_polCancDET->errno]: $stmt_polCancDET->error"); }
  if (!($stmt_polCancDET->execute())) { die("Error during query execute descancela3 [$stmt_polCancDET->errno]: $stmt_polCancDET->error"); }


  $query_polCancDET_2 = "UPDATE conta_t_polizas_det
                      SET n_cargo_cancela = 0,
                          n_abono_cancela = 0
                      WHERE  fk_id_poliza = ?";
  $stmt_polCancDET_2 = $db->prepare($query_polCancDET_2);
  if (!($stmt_polCancDET_2)) { die("Error during query prepare descancela4 [$db->errno]: $db->error"); }
  $stmt_polCancDET_2->bind_param('s',$id_poliza);
  if (!($stmt_polCancDET_2)) { die("Error during variables binding descancela4 [$stmt_polCancDET_2->errno]: $stmt_polCancDET_2->error"); }
  if (!($stmt_polCancDET_2->execute())) { die("Error during query execute descancela4 [$stmt_polCancDET_2->errno]: $stmt_polCancDET_2->error"); }
}
?>
