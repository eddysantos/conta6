<?php
#comentar
/*
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';
$fechaTimbre = '2019-01-22';
$r_razon_social = 'pruebas';
$id_cliente = 'CLT_6548';
$cuenta =33;
$poliza = 1;
$idFactura = 28;
*/



$tipo = 3;
$fecha = $fechaTimbre;
$concepto = "CFDI PAGO - ".$r_razon_social;
require $root . '/Resources/PHP/actions/generarFolioPoliza.php';
$poliza = $nFolio;
$detallePoliza = '';

require $root . '/Resources/PHP/actions/consultaCtas108y208_cliente.php';
if( $rows_ctasCliente > 0 ){
  while($row_ctasCliente = $rslt_ctasCliente->fetch_assoc()){
    $cta = $row_ctasCliente['pk_id_cuenta'];
    if( strpos($cta,'0108-') !==  false ){ $cta108 = $cta; }
    if( strpos($cta,'0208-') !==  false ){ $cta208 = $cta; }
  }
}


#DETALLE DE LA POLIZA ***
// if( $moneda <> 'MXN' ){
// 	$Hono_Total = $totalGralImporte * $tipoCambio;
// 	$Total_Gral = $totalGral * $tipoCambio;
// }else{
//   $Hono_Total = $totalGralImporte;
//   $Total_Gral = $totalGral;
// }

#Registros de los pagos
require $root . '/Ubicaciones/Contabilidad/Pagos/actions/consultarCapturaPago_detalle_2.php';
if( $total_consultaDetalle > 0 ) {
  $idFila = 0;
  while(  $row_consultaDetalle = $rslt_consultaDetalle->fetch_assoc() ){
    ++$idFila;

    $pk_rowPago = $row_consultaDetalle['n_pk_rowPago'];
    $d_fecha_docPago = $row_consultaDetalle['d_fecha_docPago'];
    $d_fecha_docPago = date_format(date_create($d_fecha_docPago),"Y-m-d");


    require $root . '/Ubicaciones/Contabilidad/Pagos/actions/consultarCapturaPago_detalle_DR.php';
    if( $total_consultaDetalle_DR > 0 ){
      while( $row_consultaDetalle_DR = $rslt_consultaDetalle_DR->fetch_assoc()  ){
        $importe = $row_consultaDetalle_DR['n_importePagado'];
    		$iva = $row_consultaDetalle_DR['n_iva'];
        $idReferencia = $row_consultaDetalle_DR['fk_referenciaDR'];
        $numParcialidad = $row_consultaDetalle_DR['n_numParcialidad'];
        $id_facturaDR = $row_consultaDetalle_DR['fk_id_facturaDR'];
        $moneda = $row_consultaDetalle_DR['fk_id_monedaDR'];
        $tipoCambio = $row_consultaDetalle_DR['n_tipoCambioDR'];

        if( $moneda <> 'MXN' ){
    			$importe = $importe * $tipoCambio;
    			$iva = $iva * $tipoCambio;
    		}


    		$detallePoliza .= "(".$poliza.",'".$cta208."','".$d_fecha_docPago."',3,'".$idReferencia."','".$id_cliente."',0,".$id_facturaDR.",0,".$idFactura.",0,0,'CARGO A LA CUENTA POR ANTICIPO PARCIALIDAD ".$numParcialidad."',".$importe.",0),";
        if( $iva > 0 ){
    		$detallePoliza .= "(".$poliza.",'0202-00007','".$d_fecha_docPago."',3,'".$idReferencia."','".$id_cliente."',0,".$id_facturaDR.",0,".$idFactura.",0,0,'IVA SOBRE HONORARIOS PARCIALIDAD ".$numParcialidad."',".$iva.",0),";
        }
    		$detallePoliza .= "(".$poliza.",'".$cta108."','".$d_fecha_docPago."',3,'".$idReferencia."','".$id_cliente."',0,".$id_facturaDR.",0,".$idFactura.",0,0,'ABONO A LA CUENTA POR ANTICIPO PARCIALIDAD ".$numParcialidad."',0,".$importe."),";
        if( $iva > 0 ){
    		$detallePoliza .= "(".$poliza.",'0202-00002','".$d_fecha_docPago."',3,'".$idReferencia."','".$id_cliente."',0,".$id_facturaDR.",0,".$idFactura.",0,0,'IVA SOBRE HONORARIOS PARCIALIDAD ".$numParcialidad."',0,".$iva."),";
        }
      }
    }

  }
}

$detallePoliza = rtrim($detallePoliza,',');
$query_polDet = "INSERT INTO conta_t_polizas_det(fk_id_poliza,fk_id_cuenta,d_fecha,fk_tipo,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_factura,fk_nc,fk_pago,fk_anticipo,fk_cheque,s_desc,n_cargo,n_abono)
                  VALUES $detallePoliza";


$stmt_polDet = $db->prepare($query_polDet);
if (!($stmt_polDet)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "X No guardo el detalle de poliza de pago - Error during query prepare polDetPago [$db->errno]: $db->error";
  //exit_script($system_callback);
}

if (!($stmt_polDet->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "X No guardo el detalle de poliza de pago - Error during query execution polDetPago [$stmt_polDet->errno]: $stmt_polDet->error";
  //exit_script($system_callback);
}

mysqli_query($db,"UPDATE conta_t_polizas_mst SET d_fecha = '$d_fecha_docPago' WHERE pk_id_poliza = $poliza");

?>
