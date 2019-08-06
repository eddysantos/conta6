<?PHP
#*******************
# DATOS DE ADUANET *
#*******************
$valAduana_aduanet = 0;
$tc_aduanet = 0;
$cve_pago = 0;
$importe_impuesto = 0;
$impuesto_CEXT = 0;
$iva_CEXT = 0;


$query_consultaReferenciasPedimento = "SELECT fk_referencia,n_valor_aduana,n_valor_comercial,n_tipo_cambio, s_cve_pago,sum(n_importe_impuesto) as n_importe_impuesto
                        FROM conta_replica_referencias_pedimento
                        WHERE s_cve_pago = 0 and fk_referencia = ?
                        GROUP BY fk_referencia,s_pedimento";

$stmt_consultaReferenciasPedimento = $db->prepare($query_consultaReferenciasPedimento);
if (!($stmt_consultaReferenciasPedimento)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare consultaReferenciasPedimento [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaReferenciasPedimento->bind_param('s',$referencia);
if (!($stmt_consultaReferenciasPedimento)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding consultaReferenciasPedimento [$stmt_consultaReferenciasPedimento->errno]: $stmt_consultaReferenciasPedimento->error";
	exit_script($system_callback);
}
if (!($stmt_consultaReferenciasPedimento->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution consultaReferenciasPedimento [$stmt_consultaReferenciasPedimento->errno]: $stmt_consultaReferenciasPedimento->error";
	exit_script($system_callback);
}

$rslt_consultaReferenciasPedimento = $stmt_consultaReferenciasPedimento->get_result();
$total_consultaReferenciasPedimento = $rslt_consultaReferenciasPedimento->num_rows;

if( $total_consultaReferenciasPedimento > 0 ){

  $row_consultaReferenciasPedimento = $rslt_consultaReferenciasPedimento->fetch_assoc();

  $valAduana_aduanet = trim($row_consultaReferenciasPedimento['n_valor_aduana']);
  $valComercial_aduanet = trim($row_consultaReferenciasPedimento['n_valor_comercial']);
  $tc_aduanet = trim($row_consultaReferenciasPedimento['n_tipo_cambio']);
  $cve_pago = trim($row_consultaReferenciasPedimento['s_cve_pago']);
  $importe_impuesto = trim($row_consultaReferenciasPedimento['n_importe_impuesto']);
  $iva_sacar = $iva + 1;

  if( $tipo == 'IMP' ){ $valor = $valAduana_aduanet; }
  if( $tipo == 'EXP' ){ $valor = $valComercial_aduanet; }

  $tipo_cambio = $tc_aduanet;
  if( $cve_pago == 0 ){
    if( $pagaImpuestosComExt == 1 ){ #el cliente se encarga de pagar sus impuestos al comercio exterior desde sus cuentas bancarias 2019-05-03
      $impuesto_CEXT = 0;
      $iva_CEXT = 0;
    }else{
      $iva_CEXT = $importe_impuesto / $iva_sacar;
      $impuesto_CEXT = $importe_impuesto - $iva_CEXT;
    }
  }else{
    $impuesto_CEXT = $importe_impuesto;
    $iva_CEXT = 0;
  }
}


?>
