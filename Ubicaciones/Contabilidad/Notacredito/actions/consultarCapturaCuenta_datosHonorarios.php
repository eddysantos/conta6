<?PHP

$query_consultaHonorarios = "SELECT pk_id_partida,fk_c_claveUnidad,s_unidad,fk_c_ClaveProdServ,fk_id_cuenta,s_conceptoEsp,
                                    n_porcentaje,n_base,n_descuento,n_cantidad,n_importe,n_IVA,n_ret,n_total
 															FROM conta_t_notacredito_captura_det WHERE fk_id_cuenta_captura_nc = ? and s_tipoDetalle = 'honorarios' ";

$stmt_consultaHonorarios = $db->prepare($query_consultaHonorarios);
if (!($stmt_consultaHonorarios)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaHonorarios->bind_param('s',$cuenta);
if (!($stmt_consultaHonorarios)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaHonorarios->errno]: $stmt_consultaHonorarios->error";
	exit_script($system_callback);
}
if (!($stmt_consultaHonorarios->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaHonorarios->errno]: $stmt_consultaHonorarios->error";
	exit_script($system_callback);
}

$rslt_consultaHonorarios = $stmt_consultaHonorarios->get_result();
$total_consultaHonorarios = $rslt_consultaHonorarios->num_rows;

$datosHonorarios = '';
$datosHonorariosPrint = '';
$datosHonorariosImprimir = '';
$datosHonorariosXML = '';
$datosHonorariosModifi = '';
$botonEliminar = '';

if( $total_consultaHonorarios > 0 ) {
  $idFila = 0;
	while( $row_consultaHonorarios = $rslt_consultaHonorarios->fetch_assoc() ){
    ++$idFila;
		$n_cantidad = $row_consultaHonorarios['n_cantidad'];
		$fk_c_ClaveProdServ = $row_consultaHonorarios['fk_c_ClaveProdServ'];
		$fk_id_cuenta = $row_consultaHonorarios['fk_id_cuenta'];
		$s_conceptoEsp = utf8_encode($row_consultaHonorarios['s_conceptoEsp']);
		$n_importe = number_format($row_consultaHonorarios['n_importe'],2,'.',',');
		$n_IVA = number_format($row_consultaHonorarios['n_IVA'],2,'.',',');
		$n_ret = number_format($row_consultaHonorarios['n_ret'],2,'.',',');
		$n_total = number_format($row_consultaHonorarios['n_total'],2,'.',',');
    $pk_id_partida = $row_consultaHonorarios['pk_id_partida'];
    $fk_c_claveUnidad = $row_consultaHonorarios['fk_c_claveUnidad'];
    $s_unidad = $row_consultaHonorarios['s_unidad'];

    if( $fk_id_cuenta == '0400-00001' ){
      $porcentajeModifi = $row_consultaHonorarios['n_porcentaje'];
      $baseModifi = $row_consultaHonorarios['n_base'];
      $descuentoModifi = $row_consultaHonorarios['n_descuento'];
    }

    if( $moneda <> 'MXN' ){
    	$Hono_Total = $n_importe * $tipoCambio;
    }else{ $Hono_Total = $n_importe;}

    $detallePoliza .= "(".$poliza.",'".$fecha."',".$idFactura.",'".$fk_id_cuenta."',3,'".$s_conceptoEsp."','".$id_cliente."','".$referencia."',0,".$Hono_Total."),";

		$datosHonorarios = $datosHonorarios."<div class='row b font12 ls1'>
          <div class='col-md-4 text-left'>$s_conceptoEsp</div>
          <div class='col-md-2'>$n_importe</div>
          <div class='col-md-2'>$n_IVA</div>
          <div class='col-md-2'>$n_ret</div>
          <div class='col-md-2'>$ $n_total</div>
        </div>";

    if( $idFila == 1 && $s_conceptoEsp == 'Honorarios' ){
      if( $porcentajeModifi > 0 ){ $porcentajeModifi = number_format($porcentajeModifi,4,'.',''); }else{ $porcentajeModifi = "0.00"; }
      $s_conceptoEspPrint = '% de Honorarios sobre la base de:';
      $s_conceptoEspPrint = $porcentajeModifi.' '.$s_conceptoEspPrint.' '.number_format($baseModifi,2,'.',',');
    }else{
      $s_conceptoEspPrint = $s_conceptoEsp;
    }


    $datosHonorariosPrint = $datosHonorariosPrint."<div class='row b font12 ls1'>
          <div class='col-md-4 text-left'>$s_conceptoEspPrint</div>
          <div class='col-md-2'>$n_importe</div>
          <div class='col-md-2'>$n_IVA</div>
          <div class='col-md-2'>$n_ret</div>
          <div class='col-md-2'>$ $n_total</div>
        </div>";


    $datosHonorariosXML = $datosHonorariosXML.'<tr>
          <td width="10%">'.$n_cantidad.'</td>
          <td width="15%">'.$fk_c_claveUnidad.' '.$s_unidad.'</td>
          <td width="10%">'.$fk_c_ClaveProdServ.'</td>
          <td width="45%" align="left">'.$s_conceptoEsp.'</td>
          <td width="20%" align="right">'.$n_importe.'</td>
        </tr>';

    $datosHonorariosImprimir = $datosHonorariosImprimir.'<tr>
          <td width="52%">'.$s_conceptoEsp.'</td>
          <td width="12%">'.$n_importe.'</td>
          <td width="12%">'.$n_IVA.'</td>
          <td width="12%">'.$n_ret.'</td>
          <td width="12%">$ '.$n_total.'</td>
        </tr>';

    if( $idFila > 1 ){ $botonEliminar = "<a href='#' class='eliminar-Honorarios'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>";}
    $datosHonorariosModifi = $datosHonorariosModifi."
    <tr class='row m-0 trHonorarios elemento-honorarios' id='$idFila'>
      <td class='col-md-4 p-1'>
        <input class='id-partida' type='hidden' id='T_partida_$pk_id_partida' value='$pk_id_partida'>
        <input class='efecto h22 T_Honorarios concepto-espanol' type='text' id='T_Honorarios_$idFila' value='$s_conceptoEsp' size='60' maxlength='60' onchange='javascript:eliminaBlancosIntermedios(this);validarStringSAT(this);' readonly tabindex='75'>
      </td>
      <td class='col-md-2 p-1 text-left'>".$botonEliminar."</td>
      <td class='col-md-1 p-1'>
        <input class='efecto h22 T_Honorarios_idcta id-cuenta' type='text' id='T_Hcta_$idFila' value='$fk_id_cuenta' size='15' readonly>
      </td>
      <td class='col-md-1 p-1'>
        <input class='efecto h22 T_Honorarios_idps id-cveProd' type='text' id='T_Hps_$idFila' value='$fk_c_ClaveProdServ' size='15' readonly>
      </td>
      <td class='col-md-1 p-1'>
        <input class='efecto h22 T_Honorarios_Importe importe' type='text' id='T_Honorarios_Importe_$idFila' value='$n_importe' onblur='validaIntDec(this);validaDescImporte(3,$idFila);cortarDecimalesObj(this,2);Iva_Importe_Hon($idFila)' size='18' value='0'>
      </td>
      <td class='col-md-1 p-1'>
        <input class='efecto h22 T_Honorarios_IVA iva' type='text' id='T_Honorarios_IVA_$idFila' value='$n_IVA' size='20' value='0' readonly>
      </td>
      <td class='col-md-1 p-1'>
        <input class='efecto h22 T_Honorarios_RET ret' type='text' id='T_Honorarios_RET_$idFila' value='$n_ret' size='20' value='0' readonly>
      </td>
      <td class='col-md-1 p-1'>
        <input class='efecto h22 T_Honorarios_Subtotal subtotal' type='text' id='T_Honorarios_Subtotal_$idFila' value='$n_total' size='20' value='0' readonly>
      </td>
    </tr>";
	}
}

?>
