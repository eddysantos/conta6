<?php
	require $root . '/Resources/PHP/Databases/conexion.php';
	require $root . '/Resources/PHP/DatabasesRemote/conexionGlobalPCnet.php';
	require $root . '/Resources/PHP/DatabasesRemote/conexionSemillero.php';
	require $root . '/Resources/PHP/DatabasesRemote/conexionADUANET.php';

	$FI = '2013-01-01';
	$FF = '2013-12-31 23:59:59';

 $sql_referencias = mysqli_query($linkPCnet,"SELECT t.sCveTrafico, t.sUsuarioIngreso, t.sReferenciaCliente, t.dFechaIngreso, t.sNumEntradaRecintoFiscal, t.dFechaEntradaRecintoFiscal, t.sNumPedimento,
(SELECT COUNT(factura.sCveTrafico) FROM cb_factura factura WHERE factura.sCveTrafico = t .sCveTrafico) AS iNumFacturas,
(SELECT GROUP_CONCAT(sNumero) FROM cb_factura WHERE cb_factura.sCveTrafico = t .sCveTrafico GROUP BY sCveTrafico) AS sFacturas,
(SELECT SUM(factura.iValorComercial) FROM cb_factura factura WHERE factura.sCveTrafico = t .sCveTrafico) AS iValFactura,
f.sCveMoneda,
(SELECT SUM(iValorComercial * iFactorMonedaExtranjera) FROM cb_factura WHERE cb_factura.sCveTrafico = t .sCveTrafico) AS iValUSD,
t .sCveCliente, f.sCveProveedor,
(SELECT ((SUM(iValorComercial) + SUM(iFlete) + SUM(iSeguros) + SUM(iEmbalajes) + SUM(iIncrementables) + SUM(iDeducibles)) * iFactorMonedaExtranjera * t .iTipoCambio) AS iValorAduana FROM cb_factura WHERE cb_factura.sCveTrafico = t .sCveTrafico) AS iValorAduana,
t .iTipoCambio, t .sCveAduana, t .iCveRecinto, t .iCantidadBultosRecibidos,
CASE WHEN t .ePesoBruto = '1' THEN ROUND(t.iPesoBruto * 0.4535924, 3) ELSE ROUND(t .iPesoBruto, 3) END AS iPesoBrutoKgs,
CASE WHEN t .ePesoNeto = '1' THEN ROUND(t .iPesoNeto * 0.4535924, 3) ELSE ROUND(t .iPesoNeto, 3) END AS iPesoNetoKgs,
t .sDescripcionMercancia, t .sNumContenedor, t .bFletePagadoAmericano, t .iImporteFleteAmericano, t .sCveLineaConsolidadora, t .sCveProcedencia, t .eTipoOperacion, f.sCvePaisFacturacion, p.sCvePaisProveedor, t .sCveDocumento, t .sNumTalonIn, t .sNumGuiaHouse, t .sNumCajaTrailerIn, t .sNumCajaTrailerOut, t .sMarcas,
CASE WHEN t .bFletePagadoAmericano = '0' THEN 'COBRAR' ELSE 'PAGADO' END AS 'StatusFlete',
t .iImporteFleteAmericano AS 'Flete',
CASE WHEN t.bInBond = '0' THEN 'NO' ELSE 'SI' END AS 'InBond',
CASE WHEN t.eConsolidado = '1' THEN 'TRAILER COMPLETO' ELSE 'LTL' END AS 'Consolidado',
CASE WHEN t.bReexpedicion = '0' THEN 'NO' ELSE 'SI' END AS 'Reexpedicion',
(SELECT count(*) FROM cb_bulto WHERE cb_bulto.sCveTrafico = t.sCveTrafico) AS 'Entradas',
CASE WHEN  REPLACE (t.sComentariosSolicitudImpuestos, 'SHIPPERS', '') = '' THEN '0' ELSE REPLACE (t.sComentariosSolicitudImpuestos, 'SHIPPERS', '') END as 'Shipper',
t.sCveTransportistaMexicano, t.sCveTransportistaAmericano,
cu_linea_transportista_americana.sNombre as 'TransportistaAmericano',
cu_linea_transportista_mexicana.sNombre as 'TransportistaMexicano'
FROM cb_trafico t
LEFT JOIN cb_factura f ON t .sCveTrafico = f.sCveTrafico
LEFT JOIN cu_cliente_proveedor p ON f.sCveCliente = p.sCveCliente AND f.sCveProveedor = p.sCveProveedor
LEFT JOIN cb_bulto ON t.sCveTrafico = cb_bulto.sCveTrafico
LEFT JOIN cu_linea_transportista_americana ON t.sCveTransportistaAmericano = cu_linea_transportista_americana.sCveTransportista
LEFT JOIN cu_linea_transportista_mexicana ON t.sCveTransportistaMexicano = cu_linea_transportista_mexicana.sCveTransportista
GROUP BY sCveTrafico ");
#WHERE t.dFechaIngreso BETWEEN '$FI' AND '$FF'

while($oRst_referencias = mysqli_fetch_array($sql_referencias) ){

	$Referencia = trim($oRst_referencias['sCveTrafico']);
	$usuario = trim($oRst_referencias['sUsuarioIngreso']);
	$Referencia_Cliente = trim($oRst_referencias['sReferenciaCliente']);
	$fecha_alta = trim($oRst_referencias['dFechaIngreso']);
	$entrada = trim($oRst_referencias['sNumEntradaRecintoFiscal']);
	$Fecha_Entrada = trim($oRst_referencias['dFechaEntradaRecintoFiscal']);
	$Pedimento = trim($oRst_referencias['sNumPedimento']);
	$Num_Fac = trim($oRst_referencias['iNumFacturas']);
	$Facturas = trim($oRst_referencias['sFacturas']);
	$Val_Factura = trim($oRst_referencias['iValFactura']);
	$moneda = trim($oRst_referencias['sCveMoneda']);
	$Valor_USD = trim($oRst_referencias['iValUSD']);
	$id_cliente = trim($oRst_referencias['sCveCliente']);
	$id_proveedor = trim($oRst_referencias['sCveProveedor']);
	$Valor_Aduana = trim($oRst_referencias['iValorAduana']);
	$Tipo_Cambio = trim($oRst_referencias['iTipoCambio']);
	$aduana = trim($oRst_referencias['sCveAduana']);
	$Almacen_Seccion = trim($oRst_referencias['iCveRecinto']);
	$cantidad = trim($oRst_referencias['iCantidadBultosRecibidos']);
	$peso = trim($oRst_referencias['iPesoBrutoKgs']);
	$Volumen = trim($oRst_referencias['iPesoNetoKgs']);
	$descripcion = trim($oRst_referencias['sDescripcionMercancia']);
	$Num_Contenedor = trim($oRst_referencias['sNumContenedor']);
	$status_Flete = trim($oRst_referencias['StatusFlete']);
	$Valor_Flete = trim($oRst_referencias['Flete']);
	$Linea_Consolidadora = trim($oRst_referencias['sCveLineaConsolidadora']);
	$Procedencia = trim($oRst_referencias['sCveProcedencia']);
	$IMP_EXP = trim($oRst_referencias['eTipoOperacion']);
	$origen = trim($oRst_referencias['sCvePaisFacturacion']);
	$Pais_Vendedor = trim($oRst_referencias['sCvePaisProveedor']);
	$tipo = trim($oRst_referencias['sCveDocumento']);
	$Guia_Master = trim($oRst_referencias['sNumTalonIn']);
	$Guia_House = trim($oRst_referencias['sNumGuiaHouse']);
	$TrailerIn = trim($oRst_referencias['sNumCajaTrailerIn']);
	$TrailerOut = trim($oRst_referencias['sNumCajaTrailerOut']);
	$Marcas = trim($oRst_referencias['sMarcas']);
	$InBond = trim($oRst_referencias['InBond']);
	$consolidado = trim($oRst_referencias['Consolidado']);
	$Reexpedicion = trim($oRst_referencias['Reexpedicion']);
	$bodegaIn = trim($oRst_referencias['Entradas']);
	$Shipper = trim($oRst_referencias['Shipper']);
	$TransportUs = trim($oRst_referencias['TransportistaAmericano']);
	$TransportMx = trim($oRst_referencias['TransportistaMexicano']);

	# valorAduana en el pedimento
	$sql_referenciasPedimento = mysqli_query($aduanet,"SELECT AT001.N001VALADU valor_aduana FROM AT001 WHERE AT001.C001REFPED = '$Referencia'");
	$oRst_referenciasPedimento = mysqli_fetch_array($sql_referenciasPedimento);
	if(count($oRst_referenciasPedimento)==0){
		$sql_referenciasPedimentoSemillero = mysqli_query($semillero,"SELECT reg501.valoraduanamxp valor_aduana FROM reg501 WHERE reg501.referencia = '$Referencia'");
		$oRst_referenciasPedimento = mysqli_fetch_array($sql_referenciasPedimentoSemillero);
	}

	$Valor_Aduana = trim($oRst_referenciasPedimento['valor_aduana']);


	#**************
	# REFERENCIAS *
	#**************
	$sql_consRef = mysqli_query($db,"select * from conta_replica_referencias where pk_referencia = '$Referencia' ");
	$total_consRef = mysqli_num_rows($sql_consRef);

	if( $total_consRef > 0 ){
		mysqli_query($db,"UPDATE conta_replica_referencias SET
															fk_usuario = '$usuario',
															s_referencia_cliente = '$Referencia_Cliente',
															d_fecha_alta = '$fecha_alta',
															s_entrada = '$entrada',
															d_fecha_entrada = '$Fecha_Entrada',
															s_pedimento = '$Pedimento',
															n_num_fac = '$Num_Fac',
															s_facturas = '$Facturas',
															n_val_factura = '$Val_Factura',
															s_moneda = '$moneda',
															n_valor_USD = '$Valor_USD',
															fk_id_cliente = '$id_cliente',
															fk_id_proveedor = '$id_proveedor',
															n_valor_aduana = '$Valor_Aduana',
															n_tipo_cambio = '$Tipo_Cambio',
															fk_id_aduana = '$aduana',
															fk_almacen_seccion = '$Almacen_Seccion',
															n_cantidad = '$cantidad',
															n_peso = '$peso',
															n_volumen = '$Volumen',
															s_descripcion = '$descripcion',
															s_num_contenedor = '$Num_Contenedor',
															s_status_flete = '$status_Flete',
															n_valor_flete = '$Valor_Flete',
															s_linea_consolidadora = '$Linea_Consolidadora',
															s_procedencia = '$Procedencia',
															s_imp_exp = '$IMP_EXP',
															s_origen = '$origen',
															s_pais_vendedor = '$Pais_Vendedor',
															s_tipo = '$tipo',
															s_guia_master = '$Guia_Master',
															s_guia_house = '$Guia_House',
															s_trailerIn = '$TrailerIn',
															s_trailerOut = '$TrailerOut',
															s_marcas = '$Marcas',
															s_inBond = '$InBond',
															s_consolidado = '$consolidado',
															s_reexpedicion = '$Reexpedicion',
															s_bodegaIn = '$bodegaIn',
															s_shipper = '$Shipper',
															s_transportUs = '$TransportUs',
															s_transportMx = '$TransportMx'
															WHERE pk_referencia = '$Referencia'");
	}else{
		mysqli_query($db,"INSERT INTO conta_replica_referencias (
																pk_referencia,
																fk_usuario,
																s_referencia_cliente,
																d_fecha_alta,
																s_entrada,
																d_fecha_entrada,
																s_pedimento,
																n_num_fac,
																s_facturas,
																n_val_factura,
																s_moneda,
																n_valor_USD,
																fk_id_cliente,
																fk_id_proveedor,
																n_valor_aduana,
																n_tipo_cambio,
																fk_id_aduana,
																fk_almacen_seccion,
																n_cantidad,
																n_peso,
																n_volumen,
																s_descripcion,
																s_num_contenedor,
																s_status_flete,
																n_valor_flete,
																s_linea_consolidadora,
																s_procedencia,
																s_imp_exp,
																s_origen,
																s_pais_vendedor,
																s_tipo,
																s_guia_master,
																s_guia_house,
																s_trailerIn,
																s_trailerOut,
																s_marcas,
																s_inBond,
																s_consolidado,
																s_reexpedicion,
																s_bodegaIn,
																s_shipper,
																s_transportUs,
																s_transportMx
													)VALUES(
															'$Referencia',
															'$usuario',
															'$Referencia_Cliente',
															'$fecha_alta',
															'$entrada',
															'$Fecha_Entrada',
															'$Pedimento',
															'$Num_Fac',
															'$Facturas',
															'$Val_Factura',
															'$moneda',
															'$Valor_USD',
															'$id_cliente',
															'$id_proveedor',
															'$Valor_Aduana',
															'$Tipo_Cambio',
															'$aduana',
															'$Almacen_Seccion',
															'$cantidad',
															'$peso',
															'$Volumen',
															'$descripcion',
															'$Num_Contenedor',
															'$status_Flete',
															'$Valor_Flete',
															'$Linea_Consolidadora',
															'$Procedencia',
															'$IMP_EXP',
															'$origen',
															'$Pais_Vendedor',
															'$tipo',
															'$Guia_Master',
															'$Guia_House',
															'$TrailerIn',
															'$TrailerOut',
															'$Marcas',
															'$InBond',
															'$consolidado',
															'$Reexpedicion',
															'$bodegaIn',
															'$Shipper',
															'$TransportUs',
															'$TransportMx' )");
	}
}
echo "SE ACTUALIZARON TODAS LAS REFERENCIAS";
?>
