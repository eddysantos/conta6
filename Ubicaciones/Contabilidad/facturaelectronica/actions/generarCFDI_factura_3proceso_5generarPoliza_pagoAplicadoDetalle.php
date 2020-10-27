<?php

require $root . '/Resources/PHP/actions/consultaCtas108y208_cliente.php';
if( $rows_ctasCliente > 0 ){
  while($row_ctasCliente = $rslt_ctasCliente->fetch_assoc()){
    $cta = $row_ctasCliente['pk_id_cuenta'];
    if( strpos($cta,'0203-') !==  false ){ $cta203 = $cta; }
    if( strpos($cta,'0108-') !==  false ){ $cta108 = $cta; }
  }
}


#DETALLE DE LA POLIZA ***
if( $moneda <> 'MXN' ){
  $Hono_Total = $totalGralImporte * $tipoCambio;
  $Total_Gral = $totalGral * $tipoCambio;
}else{
  $Hono_Total = $totalGralImporte;
  $Total_Gral = $totalGral;
}

  if( $iva_aplicado_2 == 8 ){
    $ctaIVA_porPagar = '0202-00008';
    $ctaIVA_noCobrado = '0202-00009';
  }
  if( $iva_aplicado_2 == 16 ){
    $ctaIVA_porPagar = '0202-00002';
    $ctaIVA_noCobrado = '0202-00007';
  }

  $detallePolizaAplicado = "(".$polizaAplicado.",'".$fecha."',".$idFactura.",'".$cta203."',3,'CARGO A LA CUENTA POR PAGAR','".$id_cliente."','".$referencia."',".$Total_Gral.",0),";
  $detallePolizaAplicado .= "(".$polizaAplicado.",'".$fecha."',".$idFactura.",'".$ctaIVA_noCobrado."',3,'IVA TRASLADADO NO COBRADO','".$id_cliente."','".$referencia."',".$totaGralIVA.",0),";
  $detallePolizaAplicado .= "(".$polizaAplicado.",'".$fecha."',".$idFactura.",'".$cta108."',3,'ABONO A LA CUENTA POR ANTICIPO','".$id_cliente."','".$referencia."',0,".$Total_Gral."),";
  $detallePolizaAplicado .= "(".$polizaAplicado.",'".$fecha."',".$idFactura.",'".$ctaIVA_porPagar."',3,'IVA POR PAGAR','".$id_cliente."','".$referencia."',0,".$totaGralIVA."),";


#--Movimiento Contable RETENIDO
if( $IVAretenido <> 0 ){
  $detallePolizaAplicado .= "(".$polizaAplicado.",'".$fecha."',".$idFactura.",'0216-00002',3,'CARGO IVA RETENIDO (4%)','".$id_cliente."','".$referencia."',0,".$IVAretenido."),";
  $detallePolizaAplicado .= "(".$polizaAplicado.",'".$fecha."',".$idFactura.",'0216-00001',3,'ABONO IVA RETENIDO (4%)','".$id_cliente."','".$referencia."',".$IVAretenido.",0),";
}
//echo "<br>poliza aplicado:<br>"
$detallePolizaAplicado = rtrim($detallePolizaAplicado,',');

$query_polDetAplicado = "INSERT INTO conta_t_polizas_det(fk_id_poliza,d_fecha,fk_factura,fk_id_cuenta,fk_tipo,s_desc,fk_id_cliente,fk_referencia,n_cargo,n_abono)
          VALUES $detallePolizaAplicado";

$stmt_polDetAplicado = $db->prepare($query_polDetAplicado);
if (!($stmt_polDetAplicado)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare polDet [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_polDetAplicado->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution polDet [$stmt_polDetAplicado->errno]: $stmt_polDetAplicado->error";
  exit_script($system_callback);
}
?>
