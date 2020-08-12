<?php

$tipo = 3;
$fecha = $fechaTimbre;
$concepto = "NOTA DE CREDITO - ".$r_razon_social;
require $root . '/conta6/Resources/PHP/actions/generarFolioPoliza.php';
$poliza = $nFolio;
$detallePoliza = '';

require $root . '/conta6/Resources/PHP/actions/consultaCtas108y208_cliente.php';
if( $rows_ctasCliente > 0 ){
  while($row_ctasCliente = $rslt_ctasCliente->fetch_assoc()){
    $cta = $row_ctasCliente['pk_id_cuenta'];
    if( strpos($cta,'0108-') !==  false ){ $cta108 = $cta; }
    if( strpos($cta,'0208-') !==  false ){ $cta208 = $cta; }
    if( strpos($cta,'0203-') !==  false ){ $cta203 = $cta; }
    if( strpos($cta,'0106-') !==  false ){ $cta106 = $cta; }
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


##--Se inserta el movimiento CUENTA CORRESPONSAL EXTRANJERO
if( $POCME_Total_MN <> 0 ){
    $detallePoliza .= "(".$poliza.",'".$fecha."',".$idFactura.",'0110-00003',3,'CUENTA CORRESPONSAL EXTRANJERO','".$id_cliente."','".$referencia."',".$id_facturaRelacionada.",0,".$Total_Gral.",0),";
}


#Registros de los conceptos
require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosCargos.php';
require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosHonorarios.php';

if( $totaGralIVA > 0 ){
  $detallePoliza .= "(".$poliza.",'".$fecha."',".$idFactura.",'0202-00002',3,'IVA SOBRE HONORARIOS','".$id_cliente."','".$referencia."',".$id_facturaRelacionada.",0,".$totaGralIVA.",0),";
}
if( $IVAretenido > 0 ){
  $detallePoliza .= "(".$poliza.",'".$fecha."',".$idFactura.",'0167-00005',3,'IVA Retenido (4%)','".$id_cliente."','".$referencia."',".$id_facturaRelacionada.",0,".$IVAretenido.",0),";
}
require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosDepositos.php';

if( $totalGral <> 0 ){
  $detallePoliza .= "(".$poliza.",'".$fecha."',".$idFactura.",'".$cta108."',3,'IMPORTE DE LA NOTA DE CREDITO','".$id_cliente."','".$referencia."',".$id_facturaRelacionada.",0,0,".$totalGral."),";
}

//echo "<br>poliza factura: <br>";
$detallePoliza = rtrim($detallePoliza,',');

$query_polDet = "INSERT INTO conta_t_polizas_det(fk_id_poliza,d_fecha,fk_nc,fk_id_cuenta,fk_tipo,s_desc,fk_id_cliente,fk_referencia,fk_factura,fk_anticipo,n_cargo,n_abono)
          VALUES $detallePoliza";

$stmt_polDet = $db->prepare($query_polDet);
if (!($stmt_polDet)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "X No guardo el detalle de poliza de factura - Error during query prepare polDetFac [$db->errno]: $db->error";
  //exit_script($system_callback);
}

if (!($stmt_polDet->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "X No guardo el detalle de poliza de factura - Error during query execution polDetFac [$stmt_polDet->errno]: $stmt_polDet->error";
  //exit_script($system_callback);
}


?>
