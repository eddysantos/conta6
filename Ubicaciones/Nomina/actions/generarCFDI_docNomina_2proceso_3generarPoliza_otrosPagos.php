<?php
if( isset( $ordenReporteOP )){
  $sql_detalleOtrosPagos = mysqli_query($db,"SELECT fk_id_cuenta, s_concepto, n_importeGravado, n_importeExento
                                                FROM conta_t_nom_captura_det
                                                WHERE fk_id_docNomina = $idDocNomina and s_clasificacion = 'otrosPagos' and n_ordenReporte = $ordenReporteOP");

  if( $sql_detalleOtrosPagos ){
      while( $oRst_detalleOtrosPagos = mysqli_fetch_array($sql_detalleOtrosPagos) ){
        $id_cuenta = trim($oRst_detalleOtrosPagos['fk_id_cuenta']);
        $concepto = trim($oRst_detalleOtrosPagos['s_concepto']);
        $importeGravado = $oRst_detalleOtrosPagos['n_importeGravado'];
        $importeExento = $oRst_detalleOtrosPagos['n_importeExento'];

        $totalImporte = $importeGravado + $importeExento;

        if( $distribOfic > 1 and $distribuidoOP == 'S' ){
          #$totalImporte = $totalImporte * ($salarioDistrib/100);
          $totalImporte = cortarXdecimales(floatval( $totalImporte * ($salarioDistrib/100) ),2);
          $concepto = $concepto." ".$cveDistrib;
        }
        echo '<br>'.$concepto.'<br>';
        echo 'importe';
        echo "<br>";
        echo $totalImporte;
        echo "<br>";

        if( $totalImporte > 0 ){

          if( $registroContaOP == 'pol_cargo' ){
            echo "inserto -- pol_cargo ***";
            mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta, d_fecha, fk_tipo, fk_factura, fk_gastoAduana, s_desc, n_cargo, n_abono)
            VALUES ($poliza, '$id_cuenta', '$fechaPago', $tipo, $idFactura, $oficinaDistrib, '$concepto', $totalImporte,0)");
          }else{
            echo "inserto -- pol_abono ***";
            mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta, d_fecha, fk_tipo,fk_factura, fk_gastoAduana, s_desc, n_cargo, n_abono)
            VALUES ($poliza, '$id_cuenta', '$fechaPago', $tipo, $idFactura, $oficinaDistrib, '$concepto', 0, $totalImporte )");
          }
        }

      }
    }
}
?>
