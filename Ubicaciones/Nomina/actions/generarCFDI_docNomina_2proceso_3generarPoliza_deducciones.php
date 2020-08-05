<?php
if(isset($ordenReporteD)){
  $detalleDeduccion = mysqli_query($db,"SELECT fk_id_cuenta, s_concepto, n_importeGravado, n_importeExento
                                        FROM conta_t_nom_captura_det
                                        WHERE fk_id_docNomina = $idDocNomina and s_clasificacion = 'deduccion' and n_ordenReporte = $ordenReporteD");

  if($detalleDeduccion){

    while( $oRst_detalleDeduccion = mysqli_fetch_array($detalleDeduccion) ){
      $id_cuentaDD = $oRst_detalleDeduccion['fk_id_cuenta'];
      $conceptoDD = $oRst_detalleDeduccion['s_concepto'];
      $importeGravadoDD = $oRst_detalleDeduccion['n_importeGravado'];
      $importeExentoDD	= $oRst_detalleDeduccion['n_importeExento'];

      echo "<br>";
      
      $totalImporteDD = $importeGravadoDD + $importeExentoDD;
      if( $distribOfic > 1 and $distribuidoD == 'S' ){
        #$totalImporteDD = $totalImporteDD * ($salarioDistrib/100);
        $totalImporteDD = cortarXdecimales(floatval( $totalImporteDD * ($salarioDistrib/100) ),2);
        $conceptoDD = $conceptoDD." ".$cveDistrib;


        echo 'porcentaje: '.$salarioDistrib;
        echo " => ";
      }


      echo 'importe: '.$totalImporteDD;
      echo "<br>";

      if( $totalImporteDD > 0 ){

        if( $registroContaD == 'pol_cargo' ){
          #echo "inserto -- pol_cargo ***";
          mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta, d_fecha, fk_tipo, fk_factura,fk_gastoAduana, s_desc, n_cargo, n_abono)
          VALUES ($poliza, '$id_cuentaDD', '$fechaPago', $tipo, $idFactura, $oficinaDistrib, '$conceptoDD', $totalImporteDD,0)");
        }else{
          #echo "inserto -- pol_abono ***";
          mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta, d_fecha, fk_tipo, fk_factura,fk_gastoAduana, s_desc, n_cargo, n_abono)
          VALUES ($poliza, '$id_cuentaDD', '$fechaPago', $tipo, $idFactura, $oficinaDistrib, '$conceptoDD', 0, $totalImporteDD )");
        }
      }
    }
  }
}

?>
