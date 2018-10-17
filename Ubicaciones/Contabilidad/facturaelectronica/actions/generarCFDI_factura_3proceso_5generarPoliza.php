<?php

$tipo = 3;
$fecha = $fechaTimbre;
$concepto = "FACTURA ELECTRONICA - ".$r_razon_social;
require $root . '/conta6/Resources/PHP/actions/generarFolioPoliza.php';
echo $poliza = $nFolio;


require $root . '/conta6/Resources/PHP/actions/consultaCtas108y208_cliente.php';
if( $rows_ctasCliente > 0 ){
  while($row_ctasCliente = $rslt_ctasCliente->fetch_assoc()){
    $cta = $row_ctasCliente['pk_id_cuenta'];
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

#--Movimiento Contable del Subtotal
if( $Total_Gral > 0 ){
  $detallePoliza .= "(".$poliza.",'".$fecha."',".$idFactura.",'".$cta108."',3,'IMPORTE DE LA FACTURA ELECTRONICA','".$id_cliente."','".$referencia."',".$Total_Gral.",0),";
}

#Registros de los conceptos de honorarios
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosHonorarios.php';

#--Movimiento Contable IVA
if( $totaGralIVA <> 0 ){
	$detallePoliza .= "(".$poliza.",'".$fecha."',".$idFactura.",'0202-00007',3,'IVA SOBRE HONORARIOS','".$id_cliente."','".$referencia."',0,".$totaGralIVA."),";
}


#--Movimiento Contable RETENIDO
if( $IVAretenido <> 0 ){
	$detallePoliza .= "(".$poliza.",'".$fecha."',".$idFactura.",'0216-00001',3,'IVA Retenido (4%)','".$id_cliente."','".$referencia."',".$IVAretenido.",0),";
}

echo "<br>poliza factura: <br>";
echo $detallePoliza = rtrim($detallePoliza,',');

$query_polDet = "INSERT INTO conta_t_polizas_det(fk_id_poliza,d_fecha,fk_factura,fk_id_cuenta,fk_tipo,s_desc,fk_id_cliente,fk_referencia,n_cargo,n_abono)
          VALUES $detallePoliza";

$stmt_polDet = $db->prepare($query_polDet);
if (!($stmt_polDet)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare polDet [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_polDet->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution polDet [$stmt_polDet->errno]: $stmt_polDet->error";
  exit_script($system_callback);
}

#falta guardar poliza

?>
