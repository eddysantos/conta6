<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_referencia = $_POST['id_referencia'];

$query_buscaRef = "SELECT * FROM conta_replica_referencias WHERE pk_referencia = ?";

$stmt_buscaRef = $db->prepare($query_buscaRef);
if (!($stmt_buscaRef)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare buscaRef [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt_buscaRef->bind_param('s',$id_referencia);
if (!($stmt_buscaRef)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding buscaRef [$stmt_buscaRef->errno]: $stmt_buscaRef->error";
  exit_script($system_callback);
}
if (!($stmt_buscaRef->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution buscaRef [$stmt_buscaRef->errno]: $stmt_buscaRef->error";
  exit_script($system_callback);
}
$rslt_buscaRef = $stmt_buscaRef->get_result();
$rows_buscaRef = $rslt_buscaRef->num_rows;

if( $rows_buscaRef == 0 ){
  $system_callback['code'] = "1";
  $system_callback['message'] = "La referencia no existe";
  exit_script($system_callback);
}

if( $rows_buscaRef > 0 ){
  $row_buscaRef = $rslt_buscaRef->fetch_assoc();
  $id_aduanaReferencia = $row_buscaRef['fk_id_aduana'];

  if ($id_aduanaReferencia == $aduana){ //VALIDO QUE LA ADUANA EN LA REFERENCIA CORRESPONDA A LA OFICINA ACTIVA

      $datosEmbarque = "<table width='100%' border='0' style='border-collapse:collapse; font-family: Trebuchet MS; font-size: 10pt;' bgcolor='#DCDCDC'>";
        require $root . '/conta6/Resources/PHP/actions/datosGeneralesEmbarque.php';
      $datosEmbarque .= "</table>";

      $system_callback['code'] = 1;
      $system_callback['data'] = $datosEmbarque;
      $system_callback['message'] = "Script called successfully!";
      exit_script($system_callback);





  }else{
    $system_callback['code'] = 1;
    $system_callback['data'] ="<p align='center'>Se capturo mal la ADUANA en TR&Aacute;FICO O ES DE OTRA OFICINA</p><BR><center><B>".$id_referencia.' - '.$id_aduanaReferencia;
    $system_callback['message'] = "Script called successfully!";
    exit_script($system_callback);
  }//fin si corresponde la aduana de la referencia con la oficina



}//fin $rows_buscaRef

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
