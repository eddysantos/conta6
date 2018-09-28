<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_referencia = $_POST['id_referencia'];

require $root . '/conta6/Resources/PHP/actions/consultaDatosReferencia.php';


if( $rows_buscaRef > 0 ){
  $row_buscaRef = $rslt_buscaRef->fetch_assoc();
  $id_aduanaReferencia = $row_buscaRef['fk_id_aduana'];

  if ($id_aduanaReferencia == $aduana){ //VALIDO QUE LA ADUANA EN LA REFERENCIA CORRESPONDA A LA OFICINA ACTIVA

      $datosEmbarque = "<table class='table font12'>";
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
