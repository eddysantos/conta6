<?PHP
error_reporting(E_ALL);
//ini_set('display_errors',1);

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';
require $root . '/Resources/PHP/actions/validarFormulario.php';
#limpiarBlancos($txt) <-- eliminaBlancos($cadena)

#SEGUN LAS ESPECIFICICAIONES DEL ANEXO20 VERSION 3.3 SE TIENE QUE USAR EL CATALOGO DE MONEDA PARA LOS DECIMALES, PERO COMO SOLO EXPEDIMOS EN MXN,USD Y AMBOS TIENEN DOS DECIMALES, POR LO TANTO, NUESTROS CALCULOS SE HARAN A DOS DECIMALES.
$cuenta = $_POST['cuenta'];
$referencia = $_POST['referencia'];
$id_cliente = $_POST['cliente'];
$fechaActual = date("Y-m-d H:i:s");
$fechaFactura = date("Y-m-d\TH:i:s");
$id_referencia = $_POST['referencia'];

/*
$cuenta =15;
$referencia = 'N13003036';
$id_cliente = 'CLT_6548';
$fechaActual = date("Y-m-d H:i:s");
$fechaFactura = date("Y-m-d\TH:i:s");
$id_referencia = 'N13003039';
*/

#PRUEBAS
#EJECUTA SAT

if( $oRst_permisos['s_rPElect_timbrar'] == 1 ){
  # VALIDACION 1: CERTIFICADO VIGENTE
  error_log("Just testing");
  require $root . '/Resources/PHP/actions/consultaDatosCertificado.php'; #$total_datosCert
  if( $total_datosCert > 0 ){
    $noCertificado = $row_datosCert['pk_id_certificado'];
  	$certificado = $row_datosCert['s_certificado'];

    $system_callback['code'] = 1;
    $system_callback['message'] .= "✓ Certificado: Vigente \n";




    # VALIDACION 2: CONSULTO FOLIO DE CFDI
    //obtener folio de PagoCFDI
    require $root . '/Ubicaciones/Contabilidad/actions/consultaDatosCFDI_pagos.php';
    if( $total_consultaDatosCFDI == 0 ){
      require $root . '/Ubicaciones/Contabilidad/Pagos/actions/generarCFDI_pago_2genFactura.php'; #$folioFactura
      $idFactura = $folioFactura;
      echo "se genero pago folio CFDI: ".$folioFactura;
      // echo "<br>";
      //echo "generar factura y timbrar";
      $system_callback['code'] = 1;
      $system_callback['message'] .= "✓ Pago: ".$folioFactura."\n";

      require $root . '/Ubicaciones/Contabilidad/Pagos/actions/generarCFDI_pago_3proceso.php';
      $system_callback['code'] = 1;
      //$system_callback['message'] .= $mensajeTimbre.' ---'.$mensaje_xmlGen."***\n";
      exit_script($system_callback);
    }else{
          $row_consultaDatosCFDI = $rslt_consultaDatosCFDI->fetch_assoc();
          $UUID = $row_consultaDatosCFDI['s_UUID'];
          $folioFactura = $row_consultaDatosCFDI['pk_id_pago'];

          $system_callback['code'] = 1;
          $system_callback['message'] .= "✓ Pago: ".$folioFactura."\n";

          # VALIDACION 3: CONSULTO EL UUID
          if( is_null($UUID) ){
            require $root . '/Ubicaciones/Contabilidad/Pagos/actions/generarCFDI_pago_3proceso.php';

            $system_callback['code'] = 1;
            //$system_callback['message'] .= $mensajeTimbre;
            exit_script($system_callback);
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
}





















?>
