<?PHP

$query_consultaPOCME = "SELECT n_cantidad,fk_id_cuenta,fk_id_concepto,s_conceptoEsp,s_conceptoEnglish,s_descripcion,n_importe,n_total,pk_id_partida
												FROM conta_t_facturas_captura_det
												WHERE fk_id_cuenta_captura = ? and s_tipoDetalle = 'POCME' ";

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

if( $total_consultaPOCME > 0 ) {
	$idFila = 0;
	while( $row_consultaPOCME = $rslt_consultaPOCME->fetch_assoc() ){
		++$idFila;

		$n_cantidad = $row_consultaPOCME['n_cantidad'];
		$fk_id_cuenta = $row_consultaPOCME['fk_id_cuenta'];
		$fk_id_concepto = $row_consultaPOCME['fk_id_concepto'];
		$s_conceptoEsp = utf8_encode($row_consultaPOCME['s_conceptoEsp']);
		$s_conceptoEnglish =$row_consultaPOCME['s_conceptoEnglish'];
		$s_descripcion = utf8_encode($row_consultaPOCME['s_descripcion']);
		$n_importe = number_format($row_consultaPOCME['n_importe'],2,'.','');
		$n_total = number_format($row_consultaPOCME['n_total'],2,'.','');
		$pk_id_partida = $row_consultaPOCME['pk_id_partida'];

		$datosPOCME = $datosPOCME."<div class='row font12 b'>
					<div class='col-md-6 text-left ls1'>$n_cantidad $s_conceptoEsp $s_descripcion</div>
					<div class='col-md-2 offset-md-2'>$ $n_importe</div>
					<div class='col-md-2'>$ $n_total</div>
				</div>";

		$datosPOCMEmodifi = $datosPOCMEmodifi."
		<tr class='row m-0 trPOCME elemento-pocme' id='$idFila'>
			<td class='col-md-1 p-2'>
		    <input type='text' id='T_POCME_Cantidad$idFila' class='T_POCME_CANTIDAD cantidad efecto h22' value='$n_cantidad' onblur='validaSoloNumeros(this);importe_POCME();' size='4'/>
				<input class='id-partida' type='hidden' id='T_partida_$pk_id_partida' value='$pk_id_partida'>
		  </td>
		  <td class='col-md-3 p-2 datos-transferibles'>
		    <input type='hidden' id='T_POCME_idTipoCta$idFila' class='T_POCME_CUENTAS id-cuenta' value='$fk_id_cuenta'>
		    <input type='hidden' id='T_POCME_idConcep$idFila' class='T_POCME_idCONCEPTOS id-concepto' value='$fk_id_concepto'>
		    <input type='text' id='T_POCME_Concepto$idFila' class='T_POCME_CONCEPTOS efecto h22 concepto-espanol' size='45' value='$s_conceptoEsp' readonly/>
		    <input type='hidden' id='T_POCME_ConceptoEng$idFila' class='T_POCME_CONCEPTOS_ENG concepto-ingles' value='$s_conceptoEnglish'>
		  </td>
		  <td class='col-md-3 p-2'>
		    <input type='text' id='T_POCME_Descripcion$idFila' class='T_POCME_DESCRIPCION descripcion efecto h22' size='45' maxlength='40' value='$s_descripcion'>
		  </td>
		  <td class='col-md-1 p-2 text-left'>
		    <a href='#' class='eliminar-POCME'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>
		  </td>
		  <td class='col-md-2 p-2'>
		    <input type='text' id='T_POCME_Importe$idFila' class='T_POCME_IMPORTES importe efecto h22' onblur='validaIntDec(this);validaDescImporte(1,$idFila);importe_POCME();cortarDecimalesObj(this,2);' size='17' value='$n_importe' >
		  </td>
		  <td class='col-md-2 p-2'>
		    <input type='text' id='T_POCME_Subtotal$idFila' class='T_POCME_SUBTOTALES subtotal efecto h22' size='17' readonly value='$n_total'>
		  </td>
		</tr>";
	}
}

?>
