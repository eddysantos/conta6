<?php
if(isset($ordenReporteHE)){
  $detallePercepcionHE = mysqli_query($db,"SELECT fk_id_cuenta, s_concepto, n_importePagado
                                        FROM conta_t_nom_captura_det
                                        WHERE fk_id_docNomina = $idDocNomina and s_clasificacion = 'horasExtras' and n_ordenReporte = $ordenReporteHE");

  if($detallePercepcionHE){
    while( $oRst_detallePercepcionHE = mysqli_fetch_array($detallePercepcionHE) ){
      $id_cuenta_HE = $oRst_detallePercepcionHE['fk_id_cuenta,'];
      $concepto_HE = $oRst_detallePercepcionHE['s_concepto'];
      $importePagado_HE = $oRst_detallePercepcionHE['n_importePagado'];

      $totalImporte_HE = $importePagado_HE;

      if( $distribOfic > 1 and $distribuidoP == 'S' ){
        #$totalImporte_HE = $totalImporte_HE * ($salarioDistrib/100);
        $totalImporte_HE = cortarXdecimales(floatval( $totalImporte_HE * ($salarioDistrib/100) ),2);
        $concepto_HE = $concepto_HE." ".$cveDistrib;
      }

      echo 'importe ';
      echo $totalImporte_HE; echo "<br>";

      if( $totalImporte_HE > 0 ){

        if( $registroContaP == 'pol_cargo' ){
          mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta, d_fecha, fk_tipo, fk_factura, fk_gastoAduana, s_desc, n_cargo, n_abono)
          VALUES ($poliza, '$id_cuenta_HE', '$fechaPago', $tipo, $idFactura, $oficinaDistrib, '$concepto_HE', $totalImporte_HE,0)");
        }else{
          mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta, d_fecha, fk_tipo, fk_factura, fk_gastoAduana, s_desc, n_cargo, n_abono)
          VALUES ($poliza, '$id_cuenta_HE', '$fechaPago', $tipo, $idFactura, $oficinaDistrib, '$concepto_HE', 0, $totalImporte_HE )");
        }
      }
    }
  }
}

?>
