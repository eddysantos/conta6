<?PHP

$query_consultaCargos = "SELECT pk_id_partida,n_cantidad,fk_id_cuenta, fk_id_concepto, s_conceptoEsp,n_total FROM conta_t_facturas_captura_det WHERE fk_id_cuenta_captura = ? and s_tipoDetalle = 'cargos' ";

$stmt_consultaCargos = $db->prepare($query_consultaCargos);
if (!($stmt_consultaCargos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaCargos->bind_param('s',$cuenta);
if (!($stmt_consultaCargos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaCargos->errno]: $stmt_consultaCargos->error";
	exit_script($system_callback);
}
if (!($stmt_consultaCargos->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaCargos->errno]: $stmt_consultaCargos->error";
	exit_script($system_callback);
}

$rslt_consultaCargos = $stmt_consultaCargos->get_result();
$total_consultaCargos = $rslt_consultaCargos->num_rows;

if( $total_consultaCargos > 0 ) {
	$idFila = 0;
	while( $row_consultaCargos = $rslt_consultaCargos->fetch_assoc() ){
		++$idFila;
		$pk_id_partida = $row_consultaCargos['pk_id_partida'];
		$n_cantidad = $row_consultaCargos['n_cantidad'];
		$fk_id_cuenta = $row_consultaCargos['fk_id_cuenta'];
		$fk_id_concepto = $row_consultaCargos['fk_id_concepto'];
		$s_conceptoEsp = utf8_encode($row_consultaCargos['s_conceptoEsp']);
		$n_total = number_format($row_consultaCargos['n_total'],2,'.',',');

		$datosCargos = $datosCargos."<div class='row b font12'>
					<div class='col-md-6 text-left ls1'>$s_conceptoEsp</div>
					<div class='col-md-4'></div>
					<div class='col-md-2'>$ $n_total</div>
				</div>";

		$datosCargosImpresion = $datosCargosImpresion.'<tr>
					<td width="10%"></td>
					<td width="65%">'.$s_conceptoEsp.'</td>
					<td width="15%">$ '.$n_total.'</td>
					<td width="10%"></td>
				</tr>';

		// $pagosCuentaCliente = '<style>
		//    .border{
		//      border-top:1px solid black;
		//      border-left:1px solid black;
		//      border-right:1px solid black;
		//      border-bottom:1px solid black;
		//     }
		// </style>
		// <table class="border">
		//   <thead>
		//     <tr bgcolor="#9f9f9f" color="rgb(255, 255, 255)">
		//       <td width="10%"></td>
		//       <td width="65%">PAGOS REALIZADOS POR SU CUENTA</td>
		//       <td width="15%">SUBTOTAL</td>
		//       <td width="10%"></td>
		//     </tr>
		//   </thead>
		//   <tbody>
		//     '.$datosCargosImpresion .'
		//   </tbody>
		// </table>'

		if( $idFila > 1 ){ $botonEliminar = "<a href='#' class='eliminar-Cargos'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";}
		$datosCargosModifi = $datosCargosModifi."<tr class='row m-0 trCargos elemento-cargos' id='$idFila'>
		                <td class='col-md-6 p-1'>
											<input class='id-partida' type='hidden' id='T_partida_$pk_id_partida' value='$pk_id_partida'>
		                  <input class='T_Cargo_idconcepto id-concepto' type='hidden' id='T_Cargo_idconcepto_$idFila' value='$fk_id_concepto'>
		                  <input class='T_Cargo_idcuenta id-cuenta' type='hidden' id='T_Cargo_idcuenta_$idFila' value='$fk_id_cuenta'>
		                  <input class='efecto h22 T_Cargo concepto-espanol' type='text' id='T_Cargo_$idFila' size='60' maxlength='60' value='$s_conceptoEsp'  onchange='javascript:eliminaBlancosIntermedios(this);' readonly>
		                </td>
		                <td class='col-md-4 p-1 text-left'>".$botonEliminar."</td>
		                <td class='col-md-2 p-1'>
		                  <input class='efecto h22 T_Cargo_Subtotal subtotal' type='text' id='T_Cargo_3$idFila' size='20' value='$n_total' onblur='validaIntDec(this);validaDescImporte(2,$idFila);cortarDecimalesObj(this,2);Suma_Subtotales();'>
		                </td>
		              </tr>
						</div>";
	}
}

?>
