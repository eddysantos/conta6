<?php
$id_ctagastos = $folioCtaGastos;
$tipo = 3;
$fecha = $fechaTimbre;
$concepto = "CUENTA DE GASTOS - ".$r_razon_social;
require $root . '/conta6/Resources/PHP/actions/generarFolioPoliza.php';
echo $poliza_CtaGastos = $nFolio;


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

  #mysqli_query($link,"INSERT INTO tbl_polizas_det (id_poliza, pol_fecha, pol_factura, pol_cuenta, pol_tipo, pol_desc, pol_cliente, pol_referencia, pol_ctagastos,pol_cargo, pol_abono)

if( $Total_Anticipos > $Total_Gral or $Total_Anticipos == $Total_Gral ){#CASO1
  #--Se inserta el Movimiento en la 208 del cliente
  #mysqli_query($link,"INSERT INTO tbl_polizas_det (id_poliza, pol_fecha, pol_factura, pol_cuenta, pol_tipo, pol_desc, pol_cliente, pol_referencia, pol_anticipo, pol_ctagastos,pol_cargo, pol_abono)
  #VALUES ($poliza,'$Fecha',$idFactura,'$ID_Cta_Cli_208',3,'CARGO A LA CUENTA POR ANTICIPO','$ID_Cliente','$idReferencia',0,$id_ctagastos,$Total_Anticipos,0)");
  $detPolCtaGastos .= "(".$poliza_CtaGastos.",'".$fecha."',".$idFactura.",'".$cta208."',3,'CARGO A LA CUENTA POR ANTICIPO','".$id_cliente."','".$referencia.  "',".$id_ctagastos.",".$Total_Anticipos.",0),";
}

if( $Total_Anticipos > 0 && $Total_Anticipos < $Total_Gral){#CASO2
		#--Se inserta el Movimiento en la 208 del cliente
    #mysqli_query($link,"INSERT INTO tbl_polizas_det (id_poliza, pol_fecha, pol_factura, pol_cuenta, pol_tipo, pol_desc, pol_cliente, pol_referencia,pol_cargo, pol_abono, pol_anticipo, pol_ctagastos)
    #VALUES ($poliza_CtaGastos,'$Fecha',$idFactura,'$ID_Cta_Cli_208',3,'CARGO A LA CUENTA POR ANTICIPO','$ID_Cliente','$idReferencia',$Total_Anticipos,0,0,$id_ctagastos)");
    $detPolCtaGastos .= "(".$poliza_CtaGastos.",'".$fecha."',".$idFactura.",'".$cta208."',3,'CARGO A LA CUENTA POR ANTICIPO','".$id_cliente."','".$referencia.  "',".$id_ctagastos.",".$Total_Anticipos.",0),";
}

if( $Total_Anticipos == 0 ){#CASO3
  $saldoPorCobrar = $Total_Gral;
  #--Se inserta el Movimiento en la 106 del cliente
  #mysqli_query($link,"INSERT INTO tbl_polizas_det (id_poliza, pol_fecha, pol_factura, pol_cuenta, pol_tipo, pol_desc, pol_cliente, pol_referencia,pol_cargo, pol_abono, pol_anticipo, pol_ctagastos)
  #VALUES ($poliza,'$Fecha',$idFactura,'$CUENTA_106',3,'SALDO POR COBRAR','$ID_Cliente','$idReferencia',$saldoPorCobrar,0,0,$id_ctagastos)");
  $detPolCtaGastos .= "(".$poliza_CtaGastos.",'".$fecha."',".$idFactura.",'".$cta106."',3,'SALDO POR COBRAR','".$id_cliente."','".$referencia.  "',".$id_ctagastos.",".$saldoPorCobrar.",0),";
}

##--Se inserta el movimiento CUENTA CORRESPONSAL EXTRANJERO
if( $POCME_Total_MN <> 0 ){
  #mysqli_query($link,"INSERT INTO tbl_polizas_det (id_poliza, pol_fecha, pol_factura, pol_cuenta, pol_tipo, pol_desc, pol_cliente, pol_referencia,pol_cargo, pol_abono, pol_anticipo, pol_ctagastos)
  #VALUES ($poliza,'$Fecha',$idFactura,'0110-00003',3,'CUENTA CORRESPONSAL EXTRANJERO','$ID_Cliente','$idReferencia',0,$POCME_Total_MN,0,$id_ctagastos)");
  $detPolCtaGastos .= "(".$poliza_CtaGastos.",'".$fecha."',".$idFactura.",'0110-00003',3,'CUENTA CORRESPONSAL EXTRANJERO','".$id_cliente."','".$referencia.  "',".$id_ctagastos.",0,".$POCME_Total_MN."),";
}


#Registros de los cargos a cuenta del cliente
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosCargos.php';



if( $Total_Anticipos > $Total_Gral ){ #CASO1
  $docPorCobrar = $Total_Anticipos - $Total_Gral;
  #--Se inserta el Movimiento en la 208 del cliente
  #mysqli_query($link,"INSERT INTO tbl_polizas_det (id_poliza, pol_fecha, pol_factura, pol_cuenta, pol_tipo, pol_desc, pol_cliente, pol_referencia, pol_anticipo, pol_ctagastos, pol_cargo, pol_abono)
  #VALUES ($poliza,'$Fecha',$idFactura,'$CUENTA_203',3,'DOCUMENTOS POR COBRAR','$ID_Cliente','$idReferencia',0,$id_ctagastos,0,$docPorCobrar)");
  $detPolCtaGastos .= "(".$poliza_CtaGastos.",'".$fecha."',".$idFactura.",'".$cta203."',3,'DOCUMENTOS POR COBRAR','".$id_cliente."','".$referencia."',".$id_ctagastos.",0,".$docPorCobrar."),";
}

if( $Total_Anticipos > 0 && $Total_Anticipos < $Total_Gral){#CASO2
  $saldoPorCobrar = $Total_Gral - $Total_Anticipos;
  #--Se inserta el Movimiento en la 106 del cliente
  #mysqli_query($link,"INSERT INTO tbl_polizas_det (id_poliza, pol_fecha, pol_factura, pol_cuenta, pol_tipo, pol_desc, pol_cliente, pol_referencia,pol_cargo, pol_abono, pol_anticipo, pol_ctagastos)
  #VALUES ($poliza,'$Fecha',$idFactura,'$CUENTA_106',3,'SALDO POR COBRAR','$ID_Cliente','$idReferencia',$saldoPorCobrar,0,0,$id_ctagastos)");
  $detPolCtaGastos .= "(".$poliza_CtaGastos.",'".$fecha."',".$idFactura.",'".$cta106."',3,'DOCUMENTOS POR COBRAR','".$id_cliente."','".$referencia."',".$id_ctagastos.",0,".$saldoPorCobrar."),";
}
echo "<br>CG: ";
echo $detPolCtaGastos = rtrim($detPolCtaGastos,',');

$query_polDetCG = "INSERT INTO conta_t_polizas_det(fk_id_poliza,d_fecha,fk_factura,fk_id_cuenta,fk_tipo,s_desc,fk_id_cliente,fk_referencia,fk_ctagastos,n_cargo,n_abono)
          VALUES $detPolCtaGastos";

$stmt_polDetCG = $db->prepare($query_polDetCG);
if (!($stmt_polDetCG)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare polDetCG [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_polDetCG->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution polDetCG [$stmt_polDetCG->errno]: $stmt_polDetCG->error";
  exit_script($system_callback);
}

#falta guardar poliza



?>
