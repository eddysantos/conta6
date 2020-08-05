<?php
if(isset($ordenReporte_DT)){
  $detalleDeduccion_DDT = mysqli_query($db,"SELECT fk_id_cuenta, s_concepto, n_importeGravado, n_importeExento
                                        FROM conta_t_nom_captura_det
                                        WHERE fk_id_docNomina = $idDocNomina and s_clasificacion = 'desctoDespTotal' and n_ordenReporte = $ordenReporte_DT");
  if($detalleDeduccion_DDT){
    while( $oRst_detalleDeduccion_DDT = mysqli_fetch_array($detalleDeduccion_DDT) ){
      $id_cuenta_DDT = $oRst_detalleDeduccion_DDT['fk_id_cuenta,'];
      $concepto_DDT = $oRst_detalleDeduccion_DDT['s_concepto'];
      $importeGravado_DDT = $oRst_detalleDeduccion_DDT['n_importeGravado'];
      $importeExento_DDT = $oRst_detalleDeduccion_DDT['n_importeExento'];

      $totalImporte_DDT = $importeGravado_DDT + $importeExento_DDT;
      if( $distribOfic > 1 and $distribuidoP == 'S' ){
        #$totalImporte_DDT = $totalImporte_DDT * ($salarioDistrib/100);
        $totalImporteDDT = cortarXdecimales(floatval( $totalImporteDDT * ($salarioDistrib/100) ),2);
        $concepto_DDT = $concepto_DDT." ".$cveDistrib;
      }

      echo 'importe';
      echo $totalImporte_DDT;

      if( $totalImporte_DDT > 0 ){
        if( $registroContaP == 'pol_cargo' ){
          mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta, d_fecha, fk_tipo, fk_factura, fk_gastoAduana, s_desc, n_cargo, n_abono)
          VALUES ($poliza, '$id_cuenta_DDT', '$fechaPago', $tipo, $idFactura, $oficinaDistrib, '$concepto_DDT', $totalImporte_DDT,0)");
        }else{
          mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta, d_fecha, fk_tipo, fk_factura, fk_gastoAduana, s_desc, n_cargo, n_abono)
          VALUES ($poliza, '$id_cuenta_DDT', '$fechaPago', $tipo, $idFactura, $oficinaDistrib, '$concepto_DDT', 0, $totalImporte_DDT )");
        }
      }
    }
  }
}
?>
$ordenReporte_DT
