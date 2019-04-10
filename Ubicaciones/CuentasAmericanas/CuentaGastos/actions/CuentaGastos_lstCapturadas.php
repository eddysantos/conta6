<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];

$id_captura = trim($_POST['id_captura']);
$accion = trim($_POST['accion']);

if(is_numeric($id_captura)) {
	$query_ctaGastos = "SELECT * FROM contame_t_facturas WHERE pk_id_ctaAme = ? ";
}else{
	$query_ctaGastos = "SELECT * FROM contame_t_facturas WHERE fk_referencia = ? ORDER BY pk_id_ctaAme ";
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

	$id_captura = $row_ctaGastos['pk_id_ctaAme'];
	$id_referencia = $row_ctaGastos['fk_referencia'];
	$id_cliente = $row_ctaGastos['fk_id_cliente'];
	$dias = 1;
	$id_almacen = 0;
	$tipo = $row_ctaGastos['s_imp_exp'];
	$valor = $row_ctaGastos['n_valor_USD'];
	$peso = $row_ctaGastos['n_peso'];
	$cancela = $row_ctaGastos['n_cancela'];

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


	if( $oRst_permisos['s_cta_ame_modificar'] == 1 && $cancela == 0 ){
		$cadena = "ctaGastosAmeModificar($id_captura)";
		$hrefmodificar = "<a href='#' onclick='$cadena'><img class='icomediano' src='/conta6/Resources/iconos/003-edit.svg'></a>";
	}
	if( $oRst_permisos['s_cta_ame_consultar'] == 1 ){
		$hrefconsultar = "<a href='#' onclick='ctaGastosAmeConsultar($id_captura)'><img class='icomediano ml-2' src='/conta6/Resources/iconos/magnifier.svg'></a>
		<a href='#' onclick='ctaGastosAmeImprimir($id_captura)'><img class='icomediano ml-2' src='/conta6/Resources/iconos/printer.svg'></a>";
	}
	if( $oRst_permisos['s_cta_ame_borrar'] == 1 ){
		$hrefBorrar = "<a href='#' onclick='ctaGastosAmeBorrar($id_captura)'><img class='icomediano' src='/conta6/Resources/iconos/002-trash.svg'></a>";
	}

	if( $cancela == 1 ){ $txt_cancela = 'Cancelada'; }else{ $txt_cancela = 'Activa'; }
	if( $accion == 'consulMod' ){
		$system_callback['data'] .="
		<tr class='row borderojo'>
			<td class='col-md-1'>$hrefBorrar</td>
			<td class='col-md-1'>$id_captura</td>
			<td class='col-md-1'>$txt_cancela</td>
			<td class='col-md-2'>$row_ctaGastos[fk_referencia]</td>
			<td class='col-md-5'>$row_ctaGastos[fk_id_cliente] $row_ctaGastos[s_nombre]</td>
			<td class='col-md-1'>$hrefmodificar $hrefconsultar</td>
			<td class='col-md-1'></td>
		</tr>";
	}

}//fin while

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



?>
