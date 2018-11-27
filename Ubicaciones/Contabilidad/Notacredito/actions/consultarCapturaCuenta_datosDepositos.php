<?PHP
$depositosAplicados = '';
$query_consultaDepositos = "SELECT pk_id_partida,n_noDeposito,n_total FROM conta_t_notacredito_captura_det WHERE fk_id_cuenta_captura_nc = ? and s_tipoDetalle = 'depositos' ";

$stmt_consultaDepositos = $db->prepare($query_consultaDepositos);
if (!($stmt_consultaDepositos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaDepositos->bind_param('s',$cuenta);
if (!($stmt_consultaDepositos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaDepositos->errno]: $stmt_consultaDepositos->error";
	exit_script($system_callback);
}
if (!($stmt_consultaDepositos->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaDepositos->errno]: $stmt_consultaDepositos->error";
	exit_script($system_callback);
}

$rslt_consultaDepositos = $stmt_consultaDepositos->get_result();
$total_consultaDepositos = $rslt_consultaDepositos->num_rows;
$datosDepositos = '';
$datosDepositosImprimir = '';
$depositosAplicados = '';
if( $total_consultaDepositos > 0 ) {
	while( $row_consultaDepositos = $rslt_consultaDepositos->fetch_assoc() ){
		$pk_id_partida = $row_consultaDepositos['pk_id_partida'];
		$n_noDeposito = $row_consultaDepositos['n_noDeposito'];
		$n_total = $row_consultaDepositos['n_total'];

		$n_total_2 = number_format($row_consultaDepositos['n_total'],2,'.',',');

		$detallePoliza .= "(".$poliza.",'".$fecha."',".$idFactura.",'".$cta108."',3,'ABONO A LA CUENTA POR ANTICIPO','".$id_cliente."','".$referencia."',".$id_facturaRelacionada.",".$n_noDeposito.",0,".$n_total."),";
		$detallePoliza .= "(".$poliza.",'".$fecha."',".$idFactura.",'".$cta208."',3,'CARGO A LA CUENTA POR ANTICIPO','".$id_cliente."','".$referencia."',".$id_facturaRelacionada.",".$n_noDeposito.",".$n_total.",0),";
		#--Se inserta el Movimiento en la 108 del cliente
		// mysqli_query($link,"INSERT INTO tbl_polizas_det (id_poliza, pol_fecha, pol_factura, pol_nc, pol_cuenta, pol_tipo, pol_desc, pol_cliente, pol_referencia,pol_cargo, pol_abono, pol_anticipo)
		// VALUES ($poliza,'$Fecha',$Id_factura,$idFactura,'$ID_Cta_Cli_108',3,'ABONO A LA CUENTA POR ANTICIPO','$ID_Cliente','$idReferencia',0,$Anticipo_Val,$Anticipo_Num)");
		// #--Se inserta el Movimiento en la 208 del cliente
		// mysqli_query($link,"INSERT INTO tbl_polizas_det (id_poliza, pol_fecha, pol_factura, pol_nc, pol_cuenta, pol_tipo, pol_desc, pol_cliente, pol_referencia,pol_cargo, pol_abono, pol_anticipo)
		// VALUES ($poliza,'$Fecha',$Id_factura,$idFactura,'$ID_Cta_Cli_208',3,'CARGO A LA CUENTA POR ANTICIPO','$ID_Cliente','$idReferencia',$Anticipo_Val,0,$Anticipo_Num)");

		$datosDepositos .= "<div class='row ls1'>
							<div class='col-md-6 text-right'>$n_noDeposito :</div>
							<div class='col-md-6 text-left'>$ $n_total</div>
						</div>";


		$datosDepositosImprimir .= '<tr>
				<td width ="50%">'.$n_noDeposito.':</td>
				<td width ="50%">$ '.$n_total_2.'</td>
			</tr>';

		$depositosAplicados .= "<tr class='row elemento-depositos'>
      <td class='col-md-6 nomCLT'>$CLT_nombre</td>
      <td class='col-md-2 noAnt'>
				<input class='efecto h22 Txt_Anticipo id-deposito' type='text' id='T_No_Anticipo_$n_noDeposito' value='$n_noDeposito' readonly>
				<input class='id-partida' type='hidden' id='T_partida_$pk_id_partida' value='$pk_id_partida'>
			</td>
      <td class='col-md-2 impAnt'><input class='efecto h22 T_Anticipo importe' importe='$importe' type='text' id='T_Anticipo_$n_noDeposito' value='$n_total' readonly></td>
      <td class='col-md-2'>
        <div class='checkbox-xs agregar-deposito' destino='#depositos-disponibles'>
          <label>
            <input type='checkbox' data-toggle='toggle'>
          </label>
        </div>
      </td>
    </tr>";
	}
}

//prueba modificar

?>