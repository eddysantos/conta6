<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];

$id_captura = trim($_POST['id_captura']);
$accion = trim($_POST['accion']);

if(is_numeric($id_captura)) {
	$query_ctaGastos = "SELECT * FROM conta_t_facturas_captura WHERE pk_id_cuenta_captura = ? ";
}else{
	$query_ctaGastos = "SELECT * FROM conta_t_facturas_captura WHERE fk_referencia = ? ORDER BY pk_id_cuenta_captura ";
}

$stmt_ctaGastos = $db->prepare($query_ctaGastos);
if (!($stmt_ctaGastos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare ctaGastos [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_ctaGastos->bind_param('s',$id_captura);
if (!($stmt_ctaGastos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding ctaGastos [$stmt_ctaGastos->errno]: $stmt_ctaGastos->error";
	exit_script($system_callback);
}
if (!($stmt_ctaGastos->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution ctaGastos [$stmt_ctaGastos->errno]: $stmt_ctaGastos->error";
	exit_script($system_callback);
}

$rslt_ctaGastos = $stmt_ctaGastos->get_result();
$total_ctaGastos = $rslt_ctaGastos->num_rows;

while( $row_ctaGastos = $rslt_ctaGastos->fetch_assoc() ){

	$id_captura = $row_ctaGastos['pk_id_cuenta_captura'];
	$id_referencia = $row_ctaGastos['fk_referencia'];
	$id_cliente = $row_ctaGastos['fk_id_cliente'];
	$dias = $row_ctaGastos['n_diasEnAlmacen'];
	$id_almacen = $row_ctaGastos['fk_id_almacen'];
	$tipo = $row_ctaGastos['s_imp_exp'];
	$valor = $row_ctaGastos['n_valor'];
	$peso = $row_ctaGastos['n_peso'];


	if($id_referencia == "SN"){
				$consolidado = "FTL";
				$entradas = 1;
				$entradasAdicionales = 0;
				$shipper = 0;
				$inbond = "NO";
				$flete = 0;
				$status_Flete = "PAGADO";
				$transporteUS = "";
				$reexpedicion = "No";
				$cobrarFlete = "si";
	}else{

		require $root . '/conta6/Resources/PHP/actions/consultaDatosReferencia.php';

		if( $rows_buscaRef > 0 ){
				$row_buscaRef = $rslt_buscaRef->fetch_assoc();

				$consolidado = trim($row_buscaRef['s_consolidado']);
				$entradas = trim($row_buscaRef['s_bodegaIn']);
				$shipper = trim( preg_replace('[a-zA-Z]', '', $row_buscaRef['s_shipper'] ) );
				$inbond = trim($row_buscaRef['s_inBond']);
				$flete = $row_buscaRef['n_valor_flete'];
				$entradasAdicionales = 0;

				if($inbond == ""){ $inbond = 'NO'; }
				if(!is_numeric($shipper)) { $shipper = 0; }

				if($consolidado == "LTL"){ $consolidado = "LTL"; }else{ $consolidado = "FTL"; }

				if( is_null($flete) ){
					$flete = 0;
				}

				$cobrarFlete = "si";
				$reexpedicion = $row_buscaRef['s_reexpedicion'];
				$status_Flete = $row_buscaRef['s_status_flete'];

				if($flete > 0 and ($status_Flete == 'COBRAR' or $status_Flete == 'C') ){
					$transporteUS = $row_buscaRef['s_transportUs'];
				}else{
					$transporteUS = "";
				}

				if($entradas > 1){
					$entradasAdicionales = $entradas - 1;
					$entradas = 1;
				}
		}
	}




	$id_factura = '';
	$id_poliza = '';
	$s_cancela_factura = 0;

	require $root . '/conta6/Resources/PHP/actions/consultaFacturaTimbrada.php';

	if( $oRst_permisos['CFDI_cta_gastos_modificar'] == 1 && $row_ctaGastos['fk_id_aduana'] == $aduana &&
			$id_factura == 0 && $id_poliza == 0 && $s_cancela_factura == 0 ){
			$cadena = "ctaGastosCapturaModificar(&#39;".$id_referencia."&#39;,".$dias.",&#39;".$id_cliente."&#39;,".$id_almacen.",&#39;".$tipo."&#39;,".$valor.",".$peso.",".$id_captura.",".$shipper.",&#39;".$consolidado."&#39;,&#39;".$inbond."&#39;,".$entradas.",".$flete.",&#39;".$reexpedicion."&#39;,&#39;".$cobrarFlete."&#39;,&#39;".$status_Flete."&#39;,".$entradasAdicionales.")";
			$hrefmodificar = "<a href='#' onclick='".$cadena."'><img class='icomediano' src='/conta6/Resources/iconos/003-edit.svg'></a>";
	}

	if( $oRst_permisos['CFDI_cta_gastos_consultar'] == 1 ){
		$hrefconsultar = "<a href='#' onclick='ctaGastosCapturaConsultar($id_captura,&#39;consulta&#39;)'><img class='icomediano ml-2' src='/conta6/Resources/iconos/magnifier.svg'></a>
									<a href='#' onclick='ctaGastosCapturaImprimir($id_captura)'><img class='icomediano ml-2' src='/conta6/Resources/iconos/printer.svg'></a>";
	}
	if( $oRst_permisos['CFDI_cta_gastos_cancelar'] == 1 && $row_ctaGastos['fk_id_aduana'] == $aduana &&
		$id_factura == 0 && $id_poliza == 0 && $s_cancela_factura == 0 ){
		$hrefcancelar = "<a href='#' onclick='ctaGastosCapturaEliminar($id_captura)'><img class='icomediano' src='/conta6/Resources/iconos/002-trash.svg'></a>";
	}

	if( $accion == 'consulMod' ){
		$system_callback['data'] .="
		<tr class='row borderojo'>
			<td class='col-md-1'>$id_captura</td>
			<td class='col-md-1'></td>
			<td class='col-md-1'>$hrefcancelar</td>
			<td class='col-md-1'>$id_factura</td>
			<td class='col-md-2'>$row_ctaGastos[fk_referencia]</td>
			<td class='col-md-5'>$row_ctaGastos[fk_id_cliente] $row_ctaGastos[s_nombre]</td>
			<td class='col-md-1'>$hrefmodificar $hrefconsultar</td>
		</tr>";
	}
	if( $accion == 'timbrar' ){
		if( $s_cancela_factura == 1 ){
			$txt_cancela = 'cancelada';
		}else{
			$txt_cancela = '';
		}

		if( is_null($s_UUID) && $oRst_permisos['CFDI_generar'] ){
			$id_factura = '';
			$hrefTimbrar = "<a href='#' onclick='ctaGastosCapturaConsultar($id_captura,&#39;timbrar&#39;)'><img class='icomediano' src='/conta6/Resources/iconos/timbrar.svg'></a>";
		}

		$system_callback['data'] .="
		<tr class='row borderojo'>
			<td class='col-md-1'>$id_captura</td>
			<td class='col-md-1'>$id_poliza</td>
			<td class='col-md-1'>$txt_cancela</td>
			<td class='col-md-1'>$id_factura</td>
			<td class='col-md-2'>$row_ctaGastos[fk_referencia]</td>
			<td class='col-md-5'>$row_ctaGastos[fk_id_cliente] $row_ctaGastos[s_nombre]</td>
			<td class='col-md-1'>$hrefTimbrar</td>
		</tr>";
	}





}//fin while

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



?>
