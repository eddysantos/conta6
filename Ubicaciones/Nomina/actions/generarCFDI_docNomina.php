<?PHP
error_reporting(E_ALL);
//ini_set('display_errors',1);

$root = $_SERVER['DOCUMENT_ROOT'];
//$root = 'C:\\xampp\htdocs';
require $root . '/Resources/PHP/Utilities/initialScript.php';
require $root . '/Resources/PHP/actions/validarFormulario.php';
#limpiarBlancos($txt) <-- eliminaBlancos($cadena)

#SEGUN LAS ESPECIFICICAIONES DEL ANEXO20 VERSION 3.3 SE TIENE QUE USAR EL CATALOGO DE MONEDA PARA LOS DECIMALES, PERO COMO SOLO EXPEDIMOS EN MXN,USD Y AMBOS TIENEN DOS DECIMALES, POR LO TANTO, NUESTROS CALCULOS SE HARAN A DOS DECIMALES.
$idDocNomina = $_GET['idDocNomina'];
$regimenNomina = trim($_GET['regimen']);
$fechaActual = date("Y-m-d H:i:s");
$fechaFactura = date("Y-m-d\TH:i:s");

$poliza = 0;

if($regimenNomina =='02'){
  $permisoGenerarNomina = $oRst_permisos['s_nom_suel_generar'];
}
if($regimenNomina == '09'){
  $permisoGenerarNomina = $oRst_permisos['s_nom_has_generar'];
}

if( $permisoGenerarNomina == 1 ){
  # VALIDACION 1: CERTIFICADO VIGENTE
  error_log("Just testing");
  require $root . '/Resources/PHP/actions/consultaDatosCertificado.php'; #$total_datosCert
  if( $total_datosCert > 0 ){
    $noCertificado = $row_datosCert['pk_id_certificado'];
    $certificado = $row_datosCert['s_certificado'];

    $system_callback['code'] = 1;
    $system_callback['message'] .= "✓ Certificado: Vigente \n";

    //obtener folio de factura
    require $root . '/Ubicaciones/Nomina/actions/consultaDatosCFDI_docNomina.php';
    if( $total_consultaDatosCFDI == 0 ){
      require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_1genFactura.php'; #$folioFactura
      $idFactura = $folioFactura;
      // echo "se genero factura: ".$folioFactura;
      // echo "<br>";
      //echo "generar factura y timbrar";
      $system_callback['code'] = 1;
      $system_callback['message'] .= "✓ Factura: ".$folioFactura."\n";

      require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso.php';
      $system_callback['code'] = 1;
      //$system_callback['message'] .= $mensajeTimbre.' ---'.$mensaje_xmlGen."***\n";
      exit_script($system_callback);
    }else{
          $row_consultaDatosCFDI = $rslt_consultaDatosCFDI->fetch_assoc();
          $UUID = $row_consultaDatosCFDI['s_UUID'];
          $folioFactura = $row_consultaDatosCFDI['pk_id_nomina'];
          $idFactura = $folioFactura;
          $fk_id_poliza = $row_consultaDatosCFDI['fk_id_poliza'];

          $system_callback['code'] = 1;
          $system_callback['message'] .= "✓ Factura: ".$folioFactura."\n";

          # VALIDACION 3: CONSULTO EL UUID
          if( is_null($UUID) ){
            $tipoProceso = "nomina";
            # array con todos los datos a timbrar
            require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_2array.php';
            # funciones para timbrar cfdi
            require_once $root . '/Resources/PHP/actions/generarCFDI_proceso_functionTimbrar.php';
            # nombre de carpetas y rutas de almacenamiento
            require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso_1path.php';

            if( file_exists($rutaRepFileXML) && $fk_id_poliza == 0 ) {
              abrirTimbrado($rutaRepFileXML);
            }else{
              require $root . '/Ubicaciones/Nomina/actions/generarCFDI_docNomina_2proceso.php';

              $system_callback['code'] = 1;
              //$system_callback['message'] .= $mensajeTimbre;
              exit_script($system_callback);
            }
          }else{
            $system_callback['code'] = 2;
            $system_callback['message'] = "YA TIENE UUID";
            exit_script($system_callback);
          }# fin VALIDACION 3
    }






  }else{
    $system_callback['code'] = 2;
    $system_callback['message'] = "El Certificado a caducado, reportelo a Contabilidad";
    exit_script($system_callback);
  }#fin VALIDACION 1
}else{
  $system_callback['code'] = 2;
  $system_callback['message'] = "Permiso para timbrar denegado";
  exit_script($system_callback);
}#fin sin permiso para timbrar




?>
