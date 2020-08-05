<?php
if( isset($ordenReporteP)){
  $sql_detallePercepcion = mysqli_query($db,"SELECT fk_id_cuenta, s_concepto, n_importeGravado, n_importeExento
                        FROM conta_t_nom_captura_det
                        WHERE fk_id_docNomina = $idDocNomina and (s_clasificacion = 'percepcion' or s_clasificacion = 'separacionIndemnizacion') and n_ordenReporte = $ordenReporteP");

  if($sql_detallePercepcion){
    while( $oRst_detallePercepcion = mysqli_fetch_array($sql_detallePercepcion) ){
      $id_cuentaPP = trim($oRst_detallePercepcion['fk_id_cuenta']);
      $conceptoPP = trim($oRst_detallePercepcion['s_concepto']);
      $importeGravadoPP = $oRst_detallePercepcion['n_importeGravado'];
      $importeExentoPP = $oRst_detallePercepcion['n_importeExento'];

      #--PROVISIONAR "VALES DE DESPENSA"
      $provisionarVales = 0;
      if( $conceptoPP == 'Vales de despensa' ){ $provisionarVales = 1; }

      $totalImportePP = $importeGravadoPP + $importeExentoPP;

      echo "<br>";
      if( $distribOfic > 1 and $distribuidoP == 'S' ){
        #$totalImportePP = $totalImportePP * ($salarioDistrib/100);
        $totalImportePP = cortarXdecimales(floatval( $totalImportePP * ($salarioDistrib/100) ),2);
        $conceptoPP = $conceptoPP." ".$cveDistrib;


        echo 'porcentaje: '.$salarioDistrib;
        echo " => ";
      }


      echo 'importe: '.$totalImportePP;
      echo "<br>";

      if( $totalImportePP > 0 ){

        #--PROVISIONAR "VALES DE DESPENSA"
        if( $provisionarVales == 1 ){
          #echo "inserto -- PROVISIONAR VALES DE DESPENSA ***";
          mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta,d_fecha, fk_tipo,fk_factura, fk_gastoAduana, s_desc, n_cargo, n_abono)
          VALUES ($poliza, '0213-00001', '$fechaPago', $tipo, $idFactura, $oficinaDistrib, '$conceptoPP', 0, $totalImportePP )");
        }

        if( $registroContaP == 'pol_cargo' ){
          $cargoPP = $totalImportePP;
          $abonoPP = 0;
          #echo "inserto -- pol_cargo ***";
          #mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta,d_fecha, fk_tipo,fk_factura, fk_gastoAduana, s_desc, n_cargo, n_abono)
          #VALUES ($poliza, '$id_cuentaPP', '$fechaPago', $tipo, $idFactura, $oficinaDistrib, '$conceptoPP', $totalImportePP,0)");
        }else{
          $cargoPP = 0;
          $abonoPP = $totalImportePP;
          #echo "inserto -- pol_abono ***";
          #mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta,d_fecha, fk_tipo,fk_factura, fk_gastoAduana, s_desc, n_cargo, n_abono)
          #VALUES ($poliza, '$id_cuentaPP', '$fechaPago', $tipo, $idFactura, $oficinaDistrib, '$conceptoPP', 0, $totalImportePP )");
        }
        mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta,d_fecha, fk_tipo,fk_factura, fk_gastoAduana, s_desc, n_cargo, n_abono)
        VALUES ($poliza, '$id_cuentaPP', '$fechaPago', $tipo, $idFactura, $oficinaDistrib, '$conceptoPP', $cargoPP, $abonoPP )");
      }
    }
  }
}
?>
