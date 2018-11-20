<?PHP
$query_ctaGastos = "SELECT a.d_fechaTimbrado,a.pk_id_factura,a.s_UUID,a.s_selloSATcancela,a.fk_id_poliza,a.s_cancela_factura,
													 b.pk_id_cuenta_captura,b.fk_referencia,b.fk_id_cliente,b.s_nombre,b.n_total_gral
										FROM conta_t_facturas_cfdi a, conta_t_facturas_captura b
										WHERE b.pk_id_cuenta_captura = a.fk_id_cuenta_captura and a.s_UUID is not null
										and (b.fk_id_cliente like ? or b.fk_referencia like ? or a.pk_id_factura like ?)
										ORDER BY a.pk_id_factura";


$stmt_ctaGastos = $db->prepare($query_ctaGastos);
if (!($stmt_ctaGastos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare ctaGastos [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_ctaGastos->bind_param('sss',$buscar,$buscar,$buscar);
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

if( $total_ctaGastos == 0 ){
	$listaFacturas = "No hay resultados";
}

$txt_cancela = '';

if( $total_ctaGastos > 0 ){
	while( $row_ctaGastos = $rslt_ctaGastos->fetch_assoc() ){
		$hrefcancela = '';
		$fechaTimbrado = '';


		$d_fechaTimbrado = $row_ctaGastos['d_fechaTimbrado'];
		$id_factura = $row_ctaGastos['pk_id_factura'];
		$pk_id_cuenta_captura = $row_ctaGastos['pk_id_cuenta_captura'];
		$s_UUID = $row_ctaGastos['s_UUID'];
		$s_selloSATcancela = $row_ctaGastos['s_selloSATcancela'];
		$fk_id_poliza = $row_ctaGastos['fk_id_poliza'];
		$s_cancela_factura = $row_ctaGastos['s_cancela_factura'];
		$referencia = $row_ctaGastos['fk_referencia'];
		$id_cliente = $row_ctaGastos['fk_id_cliente'];
		$s_nombre = $row_ctaGastos['s_nombre'];
		$n_total_gral = $row_ctaGastos['n_total_gral'];

		#rutas de consulta
		$anioActual = date_format(date_create($d_fechaTimbrado),"Y");
		$rutaAnioActual = $root . '/conta6/CFDI_generados/'.$anioActual;
		$rutaCLT = $rutaAnioActual.'/'.$id_cliente;
		$nombre_archivo = $referencia.'_'.$id_factura.'_factura';
		$nombre_archivoCancela = $referencia.'_'.$id_factura.'_factura_cancela';
		$rutaFileXML = $rutaCLT.'/'.$nombre_archivo.'.xml';
		$rutaFileHTML = $rutaCLT.'/'.$nombre_archivo.'.html';
		$rutaFilePDF = $rutaCLT.'/'.$nombre_archivo.'.pdf';
		$rutaFilePDFcancela = $rutaCLT.'/'.$nombre_archivoCancela.'.pdf';


		if( $accion == 'consultar' ){
			if( $s_cancela_factura == 1){
				$hrefcancela = "<a href='#' onclick='docTimbrado_download(&#39;$nombre_archivoCancela.xml&#39;,&#39;$rutaFilePDFcancela&#39;)'><img class='icomediano ml-4' src='/conta6/Resources/iconos/pdf.svg'></a>";
			}

			$listaFacturas .= "
				<tr class='row borderojo font14'>
					<td class='col-md-1'>
						<a href='#' onclick='docTimbrado_download(&#39;$nombre_archivo.xml&#39;,&#39;$rutaFileXML&#39;)'><img class='icomediano' src='/conta6/Resources/iconos/xml.svg'></a>
						<a href='#' onclick='docTimbrado_download(&#39;$nombre_archivo.pdf&#39;,&#39;$rutaFilePDF&#39;)'><img class='icomediano ml-4' src='/conta6/Resources/iconos/pdf.svg'></a>
					</td>
					<td class='col-md-1'>$d_fechaTimbrado</td>
					<td class='col-md-1'>$id_factura</td>
					<td class='col-md-1'>$fk_id_poliza</td>
					<td class='col-md-1'>$hrefcancela</td>
					<td class='col-md-1'>$pk_id_cuenta_captura</td>
					<td class='col-md-1'>$referencia</td>
					<td class='col-md-4'>$id_cliente $s_nombre</td>
					<td class='col-md-1'>
						<a href='#' class='ver' accion='cuadroConsultar' onclick='ctaGastosCapturaConsultar($pk_id_cuenta_captura,&#39;consulta&#39;)'><img class='icomediano' src='/conta6/Resources/iconos/magnifier.svg'></a>
						<a href='#' onclick='docTimbrado_ver(&#39;$nombre_archivo.xml&#39;,&#39;$rutaFilePDF&#39;)'><img class='icomediano ml-5' src='/conta6/Resources/iconos/printer.svg'></a>
					</td>";
		}


		if( $accion == 'cancelar' ){
			if( $s_cancela_factura == 1){ #si la factura esta cancelada, download Acuse de cancelacion
				$hrefcancela = "<a href='#' onclick='docTimbrado_download(&#39;$nombre_archivoCancela.xml&#39;,&#39;$rutaFileXMLcancela&#39;)'><img class='icomediano ml-4' src='/conta6/Resources/iconos/xml.svg'></a>";
				$hrefcancela = "<a href='#' onclick='docTimbrado_download(&#39;$nombre_archivoCancela.pdf&#39;,&#39;$rutaFilePDFcancela&#39;)'><img class='icomediano ml-4' src='/conta6/Resources/iconos/pdf.svg'></a>";
			}

			if( $s_cancela_factura == 0 ){ #si la factura esta activa
				if( $oRst_permisos['CFDI_cancelar_libre'] == 1 ){
					$txt_evaluar = evaluarCancelarFactura($d_fechaTimbrado,$n_total_gral);
				}else if( $oRst_permisos['CFDI_cancelar'] == 1 ){ #solo pueden cancelar las facturas del mes en curso
					$fechaTimbrado = date_format(date_create($d_fechaTimbrado),"Y/m");
					$fechaActual = date("Y/m", time());
					if( $fechaTimbrado == $fechaActual ){
						$txt_evaluar = evaluarCancelarFactura($d_fechaTimbrado,$n_total_gral);
						#$hrefcancela = "<a href='#' onclick='ctaGastosCapturaConsultar($pk_id_cuenta_captura,&#39;cancelar&#39;)'><img class='icomediano ml-4' src='/conta6/Resources/iconos/cross.svg'>$txt_evaluar</a>";
					}
				}
				$hrefcancela = "<a href='#' onclick='ctaGastosCapturaConsultar($pk_id_cuenta_captura,&#39;cancelar&#39;)'><img class='icomediano ml-4' src='/conta6/Resources/iconos/cross.svg'>$txt_evaluar</a>";
			}

			$listaFacturas .= "
				<tr class='row borderojo font14'>
					<td class='col-md-1'>
						<a href='#' onclick='docTimbrado_download(&#39;$nombre_archivo.xml&#39;,&#39;$rutaFileXML&#39;)'><img class='icomediano' src='/conta6/Resources/iconos/xml.svg'></a>
						<a href='#' onclick='docTimbrado_download(&#39;$nombre_archivo.xml&#39;,&#39;$rutaFilePDF&#39;)'><img class='icomediano ml-4' src='/conta6/Resources/iconos/pdf.svg'></a>
					</td>
					<td class='col-md-1'>$d_fechaTimbrado</td>
					<td class='col-md-1'>$id_factura</td>
					<td class='col-md-1'>$fk_id_poliza</td>
					<td class='col-md-1'>$hrefcancela</td>
					<td class='col-md-1'>$pk_id_cuenta_captura</td>
					<td class='col-md-1'>$referencia</td>
					<td class='col-md-4'>$id_cliente $s_nombre</td>
					<td class='col-md-1'>
						<a href='#' onclick='ctaGastosCapturaConsultar($pk_id_cuenta_captura,&#39;consulta&#39;)'><img class='icomediano' src='/conta6/Resources/iconos/magnifier.svg'></a>
						<a href='#' onclick='docTimbrado_ver(&#39;$nombre_archivo.xml&#39;,&#39;$rutaFilePDF&#39;)'><img class='icomediano ml-5' src='/conta6/Resources/iconos/printer.svg'></a>
					</td>";

		}//if( $accion == 'cancelar'
	}//fin while
}//termina if( $total_ctaGastos > 0 ){

function evaluarCancelarFactura($d_fechaTimbrado,$n_total_gral){
	#falta validar que no tenga NotaCredito o PagosElectronicos. -- NO CANCELABLE
	$fechaTimbrado = date_format(date_create($d_fechaTimbrado),"Y/m/d");
	$fachaSinAceptar = date("Y/m/d",strtotime ( '+3 day' , strtotime ( $d_fechaTimbrado ) ));
	#El total de la factura debe ser maximo 5,000 y se otorgan 3 dias despues del timbrado para cancelar -- SIN ACEPTACION por parte del cliente
	if( $fechaTimbrado <= $fechaSinAceptar && $n_total_gral <= 5000 ){
		return "Sin aceptación";
	}else{
		return "Con aceptación";
	}
}
?>
<?php
require $root . '/conta6/Ubicaciones/footer.php';
 ?>
