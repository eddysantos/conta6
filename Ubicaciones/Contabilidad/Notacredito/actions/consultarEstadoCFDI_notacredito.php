<?PHP

$query_estadoCancela = "SELECT *
 														 FROM conta_t_facturas_cfdi_edocancela
                             WHERE s_tipoDoc = 'notacredito' and n_folio = ?
                             ORDER BY pk_id_partida";

$stmt_estadoCancela = $db->prepare($query_estadoCancela);
if (!($stmt_estadoCancela)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare estadoCancela [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_estadoCancela->bind_param('s',$id_factura);
if (!($stmt_estadoCancela)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding estadoCancela [$stmt_estadoCancela->errno]: $stmt_estadoCancela->error";
	exit_script($system_callback);
}
if (!($stmt_estadoCancela->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution estadoCancela [$stmt_estadoCancela->errno]: $stmt_estadoCancela->error";
	exit_script($system_callback);
}

$rslt_estadoCancela = $stmt_estadoCancela->get_result();
$total_estadoCancela = $rslt_estadoCancela->num_rows;

$datosEdoCancela = '';

if( $total_estadoCancela > 0 ) {
	while( $row_estadoCancela = $rslt_estadoCancela->fetch_assoc() ){
    $pk_id_partida = $row_estadoCancela['pk_id_partida'];
    $s_tipoDoc = $row_estadoCancela['s_tipoDoc'];
    $n_folio = $row_estadoCancela['n_folio'];
    $s_estado = $row_estadoCancela['s_estado'];
    $s_estatus_pac = $row_estadoCancela['s_estatus_pac'];
    $d_fecha = $row_estadoCancela['d_fecha'];

    $hrefcancela = "<a href='#' onclick='cancelarFactura_status($id_factura)'><img class='icomediano ml-4' src='/Resources/iconos/refresh-button.svg'>$txt_evaluar</a>";

		$datosEdoCancela = $datosEdoCancela."<div class='row b font12 ls1'>
      <div class='col-md-4 text-center'></div>
      <div class='col-md-2'>$s_estado</div>
      <div class='col-md-2'></div>
      <div class='col-md-2'>$hrefcancela $s_estatus_pac</div>
      <div class='col-md-2'>$d_fecha</div>
    </div>";

  }
}

?>
