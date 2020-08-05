<?php
$detallePercepcion = mysqli_query($db,"SELECT fk_id_cuenta, s_concepto, n_totalNeto
                                      FROM conta_t_nom_captura_det
                                      WHERE fk_id_docNomina = $idDocNomina and s_tipoElemento = 'totales'");

while( $oRst_detallePercepcion = mysqli_fetch_array($detallePercepcion) ){
  $id_cuenta = $oRst_detallePercepcion['fk_id_cuenta'];
  $concepto = $oRst_detallePercepcion['s_concepto'];
  $importePagado = $oRst_detallePercepcion['n_totalNeto'];

  $totalImporte = $importePagado;
  if( $distribOfic > 1 and $distribuidoP == 'S' ){
    #$totalImporte = $totalImporte * ($salarioDistrib/100);
    $totalImporte = cortarXdecimales(floatval( $totalImporte * ($salarioDistrib/100) ),2);
    $concepto = $concepto." ".$cveDistrib;
  }

  echo 'importe';
  echo $totalImporte;  echo "<br>";

  if( $totalImporte > 0 ){
    if( $id_regimen == 9 ){ $concepto = 'HONORARIOS ASIMILABLES A SUELDOS SEMANA '.$semana; }
    if( $id_regimen == 2 ){ $concepto = 'SUELDOS POR PAGAR NOMINA '.$semana; }

    if( $registroContaP == 'pol_cargo' ){
      mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta, d_fecha, fk_tipo, fk_factura, s_desc, n_cargo, n_abono)
      VALUES ($poliza, '$id_cuenta', '$fechaPago', $tipo, $idFactura, '$concepto', $totalImporte,0)");
    }else{
      mysqli_query($db,"INSERT INTO conta_t_polizas_det (fk_id_poliza, fk_id_cuenta, d_fecha, fk_tipo, fk_factura, s_desc, n_cargo, n_abono)
      VALUES ($poliza, '$id_cuenta', '$fechaPago', $tipo, $idFactura, '$concepto', 0, $totalImporte )");
    }
  }
}

?>
