<?PHP
error_reporting(E_ALL);
//ini_set('display_errors',1);

$root = $_SERVER['DOCUMENT_ROOT'];
//$root = 'C:\\xampp\htdocs';
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';
require $root . '/conta6/Resources/PHP/actions/validarFormulario.php';
#limpiarBlancos($txt) <-- eliminaBlancos($cadena)

#SEGUN LAS ESPECIFICICAIONES DEL ANEXO20 VERSION 3.3 SE TIENE QUE USAR EL CATALOGO DE MONEDA PARA LOS DECIMALES, PERO COMO SOLO EXPEDIMOS EN MXN,USD Y AMBOS TIENEN DOS DECIMALES, POR LO TANTO, NUESTROS CALCULOS SE HARAN A DOS DECIMALES.
$cuenta = $_POST['cuenta'];
$referencia = $_POST['referencia'];
$id_cliente = $_POST['cliente'];
$fechaActual = date("Y-m-d H:i:s");
$fechaFactura = date("Y-m-d\TH:i:s");
$id_referencia = $_POST['referencia'];

// $cuenta =172;
// $referencia = 'N13003039';
// $id_cliente = 'CLT_7345';
// $fechaActual = date("Y-m-d H:i:s");
// $fechaFactura = date("Y-m-d\TH:i:s");
// $id_referencia = 'N13003039';
#PRUEBAS
#EJECUTA SAT

if( $oRst_permisos['s_facturas_timbrar'] == 1 ){
  # VALIDACION 1: CERTIFICADO VIGENTE
  error_log("Just testing");
  require $root . '/conta6/Resources/PHP/actions/consultaDatosCertificado.php'; #$total_datosCert
  if( $total_datosCert > 0 ){
    $noCertificado = $row_datosCert['pk_id_certificado'];
  	$certificado = $row_datosCert['s_certificado'];

    $system_callback['code'] = 1;
    $system_callback['message'] .= "✓ Certificado: Vigente \n";

    # VALIDACION 2: CONSULTO EXISTAN LAS CUENTAS 108,208,103,206 DEL CLIENTE
    require $root . '/conta6/Resources/PHP/actions/consultaCtas108y208_cliente.php';
    if( $rows_ctasCliente > 0 ){
      // $system_callback['code'] = 1;
      // $system_callback['message'] .= "✓ Cuentas del cliente: 108,208,106,203 \n";

      //obtener folio de cuenta de gastos
      require $root . '/conta6/Ubicaciones/Contabilidad/actions/consultaDatosCFDI_factura_ctaGastos.php';
      if( $total_consultaDatosCtaGastos == 0 ){
        require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_1genCtaGastos.php'; #$folioCtaGastos
        // echo "se genero cuenta gastos: ".$folioCtaGastos;
        // echo "\n";
        $system_callback['code'] = 1;
        $system_callback['message'] .= "✓ Cuenta Gastos: ".$folioCtaGastos."\n";
      }else{
        $row_consultaDatosCtaGastos = $rslt_consultaDatosCtaGastos->fetch_assoc();
        $folioCtaGastos = $row_consultaDatosCtaGastos['id_ctagastos'];
        // echo "ya tiene cuenta gastos: ".$folioCtaGastos;
        // echo "<br>";
        $system_callback['code'] = 1;
        $system_callback['message'] .= "✓ Cuenta Gastos: ".$folioCtaGastos."\n";

      }


      //obtener folio de factura
      require $root . '/conta6/Ubicaciones/Contabilidad/actions/consultaDatosCFDI_factura.php';
      if( $total_consultaDatosCFDI == 0 ){
        require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_2genFactura.php'; #$folioFactura
        $idFactura = $folioFactura;
        // echo "se genero factura: ".$folioFactura;
        // echo "<br>";
        //echo "generar factura y timbrar";
        $system_callback['code'] = 1;
        $system_callback['message'] .= "✓ Factura: ".$folioFactura."\n";

        require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso.php';
        $system_callback['code'] = 1;
        //$system_callback['message'] .= $mensajeTimbre.' ---'.$mensaje_xmlGen."***\n";
        exit_script($system_callback);
      }else{
            $row_consultaDatosCFDI = $rslt_consultaDatosCFDI->fetch_assoc();
            $UUID = $row_consultaDatosCFDI['s_UUID'];
            $folioFactura = $row_consultaDatosCFDI['pk_id_factura'];

            $system_callback['code'] = 1;
            $system_callback['message'] .= "✓ Factura: ".$folioFactura."\n";

            # VALIDACION 3: CONSULTO EL UUID EN LA CUENTA DE GASTOS
            if( is_null($UUID) ){
              require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso.php';

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
      $system_callback['message'] = "El cliente no tiene cuentas contables";
      exit_script($system_callback);
    }#fin VALIDACION 2
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
