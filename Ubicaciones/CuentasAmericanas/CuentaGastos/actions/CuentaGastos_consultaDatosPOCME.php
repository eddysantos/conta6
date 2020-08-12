<?PHP

$query_consultaPOCME = "SELECT *
												FROM contame_t_facturas_det
												WHERE fk_id_ctaAme = ? and s_tipoDetalle = 'pocme' ";

$stmt_consultaPOCME = $db->prepare($query_consultaPOCME);
if (!($stmt_consultaPOCME)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaPOCME->bind_param('s',$cuenta);
if (!($stmt_consultaPOCME)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaPOCME->errno]: $stmt_consultaPOCME->error";
	exit_script($system_callback);
}
if (!($stmt_consultaPOCME->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaPOCME->errno]: $stmt_consultaPOCME->error";
	exit_script($system_callback);
}

$rslt_consultaPOCME = $stmt_consultaPOCME->get_result();
$total_consultaPOCME = $rslt_consultaPOCME->num_rows;

#$oRst_permisos
$verGstoGana = $oRst_permisos['s_cta_ame_verGstoGana'];
$txt_verGstoGana = '';
if( $verGstoGana == 0 ){ $txt_verGstoGana = "style='display:none'"; }
$editGstoGana = $oRst_permisos['s_cta_ame_editGstoGana'];
$txt_editGstoGana = '';
$txt_editGstoGana_check = '';
if( $editGstoGana == 0 ){
  $txt_editGstoGana = 'readOnly';
  $txt_editGstoGana_check = 'disabled';
}


$datosPOCME = '';
$datosPOCMEImprimir = '';
$datosPOCMEmodifi;
if( $total_consultaPOCME > 0 ) {
	$idFila = 0;

	while( $row_consultaPOCME = $rslt_consultaPOCME->fetch_assoc() ){
		++$idFila;

		$pk_id_partida = $row_consultaPOCME['pk_id_partida'];
		$n_cantidad = $row_consultaPOCME['n_cantidad'];
		$fk_id_cuenta = $row_consultaPOCME['fk_id_cuenta'];
		$fk_id_concepto = $row_consultaPOCME['fk_id_concepto'];
		$s_conceptoEsp = utf8_encode($row_consultaPOCME['s_conceptoEsp']);
		$s_conceptoEnglish =$row_consultaPOCME['s_conceptoEnglish'];
		$s_descripcionConcepto = utf8_encode($row_consultaPOCME['s_descripcion']);
		$n_importeConcepto = $row_consultaPOCME['n_importe'];
		$n_totalConcepto = $row_consultaPOCME['n_total'];
		$s_marca = $row_consultaPOCME['s_marca'];
		$n_gastoConcepto = $row_consultaPOCME['n_gasto'];
		$n_ganaConcepto = $row_consultaPOCME['n_gana'];

		$n_gastoConcepto_2 = number_format($row_consultaPOCME['n_gasto'],2,'.',',');
		$n_ganaConcepto_2 = number_format($row_consultaPOCME['n_gana'],2,'.',',');
		$n_importeConcepto_2 = number_format($row_consultaPOCME['n_importe'],2,'.',',');
		$n_totalConcepto_2 = number_format($row_consultaPOCME['n_total'],2,'.',',');
		if( $n_cantidad > 1 ){ $n_cantidad_2 = $n_cantidad; }

		if( $s_marca == 1 ){ $txt_activado = " checked "; }else{ $txt_activado = ''; }

		$datosPOCMEImprimir .=
				'<tr>
					<td>'.$n_cantidad_2.' '.$s_conceptoEnglish.' '.$s_descripcionConcepto.'</td>
					<td align="right">'.$n_importeConcepto_2.' </td>
				</tr>';

		$datosPOCMEconsultar .=
				'<tr class="row m-0">
					<td class="col-md-1">'.$n_cantidad.'</td>
					<td class="col-md-3">'.$s_conceptoEnglish.'</td>
					<td class="col-md-3">'.$s_descripcionConcepto.'</td>
					<td class="col-md-3"></td>
					<td class="col-md-1">'.$n_importeConcepto_2.'</td>
					<td class="col-md-1">'.$n_totalConcepto_2.'</td>
				</tr>';

		$datosPOCMEmodificar .=
			"<tr class='row m-0 trPOCME elemento-pocme justify-content-center' id='$idFila'>
				<td class='col-md-1 p-2'>
						<input type='text' id='T_POCME_Cantidad$idFila' value='$n_cantidad' class='T_POCME_CANTIDAD cantidad efecto h22' onblur='validaSoloNumeros(this);importe_POCME_ctaAme();' size='4'/>
						<input class='id-partida' type='hidden' id='T_partida_$pk_id_partida' value='$pk_id_partida'>
					</td>
					<td class='col-md-3 p-2 datos-transferibles'>
						<input type='hidden' id='T_POCME_idTipoCta$idFila'  value='$fk_id_cuenta' class='T_POCME_CUENTAS id-cuenta'>
						<input type='hidden' id='T_POCME_idConcep$idFilaBlanco' value='$fk_id_concepto' class='T_POCME_idCONCEPTOS id-concepto'>
						<input type='text' id='T_POCME_Concepto$idFila' value='$s_conceptoEsp' class='T_POCME_CONCEPTOS efecto h22 concepto-espanol' size='45' readonly/>
						<input type='hidden' id='T_POCME_ConceptoEng$idFila' value='$s_conceptoEnglish' class='T_POCME_CONCEPTOS_ENG concepto-ingles'>
					</td>
					<td class='col-md-3 p-2'>
						<input type='text' id='T_POCME_Descripcion$idFila' value='$s_descripcionConcepto' class='T_POCME_DESCRIPCION descripcion efecto h22' size='45' maxlength='40'>
					</td>
					<td class=' p-2 text-left'>
						<a href='#' class='eliminar-POCME-ame'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>
					</td>
					<td class='pt-2 mt-2' $txt_verGstoGana>
						<input type='checkbox' class='check' $txt_activado $txt_editGstoGana_check>
					</td>
					<td class='col-md-1 p-2 text-left' id='spend_ctaAme' $txt_verGstoGana>
						<input type='text' class='efecto h22 T_POCME_GASTO gasto' name='T_POCME_gasto_$idFila' value='$n_gastoConcepto' onblur='validaIntDec(this);gasto_POCME()' $txt_editGstoGana>
					</td>
					<td class='col-md-1 p-2 text-left' id='gain_ctaAme' $txt_verGstoGana>
						<input type='text' class='efecto h22 T_POCME_GANA ganancia' name='T_POCME_gana_$idFila' value='$n_ganaConcepto' onblur='validaIntDec(this);gana_POCME()' $txt_editGstoGana>
					</td>
					<td class='col-md-1 p-2'>
						<input type='text' id='T_POCME_Importe$idFila' value='$n_importeConcepto' class='T_POCME_IMPORTES importe efecto h22' onblur='validaIntDec(this);validaDescImporte(1,$idFila);importe_POCME_ctaAme();cortarDecimalesObj(this,2);' size='17' >
					</td>
					<td class='col-md-1 p-2'>
						<input type='text' id='T_POCME_Subtotal$idFila' value='$n_totalConcepto' class='T_POCME_SUBTOTALES subtotal efecto h22' size='17' readonly>
					</td>
				</tr>";

	}
}

?>
