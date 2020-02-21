<?php
#**************************
# CONSULTA XML - nomina
#**************************
  //PENDIENTE



#**************************
# CONSULTA XML - backupsxml
#**************************
$query_backupsxml = "SELECT DISTINCT s_nombre_archivo FROM conta_t_polizas_det_contaelec_backupsxml WHERE s_uuid = ? ";

$stmt_backupsxml = $db->prepare($query_backupsxml);
if (!($stmt_backupsxml)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt_backupsxml->bind_param('s',$uuid_captura);
if (!($stmt_backupsxml)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding backupsxml [$stmt_backupsxml->errno]: $stmt_backupsxml->error";
  exit_script($system_callback);
}
if (!($stmt_backupsxml->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution backupsxml [$stmt_backupsxml->errno]: $stmt_backupsxml->error";
  exit_script($system_callback);
}

$rslt_backupsxml = $stmt_backupsxml->get_result();
$total_backupsxml = $rslt_backupsxml->num_rows;


if( $total_backupsxml > 0 ) {
    $row_backupsxml = $rslt_backupsxml->fetch_assoc();
    $nombreArchivo = trim($row_backupsxml['s_nombre_archivo']);

    $imgXML .= "<a href='#' onclick='cargarXML_backupsxml(&#39;$nombreArchivo&#39;,$id_poliza,&#39;V&#39;)' title='consulta'><img class='icochico' src='/conta6/Resources/iconos/xml.svg'></a>";
    $imgXMLdownload .= "<a href='#' onclick='cargarXML_backupsxml(&#39;$nombreArchivo&#39;,$id_poliza,&#39;D&#39;)' title='consulta'><img class='ml-3 icochico' src='/conta6/Resources/iconos/descargar-2.svg'></a>";
}


#**************************
# CONSULTA XML - facturas
#**************************
$query_facturas = "select b.fk_referencia,b.fk_id_cliente,a.pk_id_factura,a.d_fecha_fac
                     from conta_t_facturas_cfdi a, conta_t_facturas_captura b
                     where a.fk_id_cuenta_captura = b.pk_id_cuenta_captura and s_UUID = ? ";

$stmt_facturas = $db->prepare($query_facturas);
if (!($stmt_facturas)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt_facturas->bind_param('s',$uuid_captura);
if (!($stmt_facturas)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding facturas [$stmt_facturas->errno]: $stmt_facturas->error";
  exit_script($system_callback);
}
if (!($stmt_facturas->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution facturas [$stmt_facturas->errno]: $stmt_facturas->error";
  exit_script($system_callback);
}

$rslt_facturas = $stmt_facturas->get_result();
$total_facturas = $rslt_facturas->num_rows;


if( $total_facturas > 0 ) {
    $row_facturas = $rslt_facturas->fetch_assoc();
    $id_cliente = $row_facturas['fk_id_cliente'];
		$id_referencia = $row_facturas['fk_referencia'];
		$id_factura = $row_facturas['pk_id_factura'];
		$fecha = $row_facturas['d_fecha_fac'];
		$anio = date_format(date_create($fecha),"Y");


    $imgXML .= "<a href='#' onclick='cargarXML_factura($anio,&#39;$id_cliente&#39;,&#39;$id_referencia&#39;,&#39;$id_factura&#39;,$id_poliza,&#39;V&#39;)' title='factura'><img class='icochico mr-4' src='/conta6/Resources/iconos/xml.svg'></a>";
    $imgXMLdownload .= "<a href='#' onclick='cargarXML_factura($anio,&#39;$id_cliente&#39;,&#39;$id_referencia&#39;,&#39;$id_factura&#39;,$id_poliza,&#39;D&#39;)' title='factura'><img class='ml-3 icochico' src='/conta6/Resources/iconos/descargar-2.svg'></a>";
}


#**************************
# CONSULTA XML - pagos
#**************************
$query_pagos = "SELECT a.fk_id_cliente,b.d_FechaTimbrado,b.s_nombrearchivo
                   FROM conta_t_pagos_captura a, conta_t_pagos_cfdi b
                   where a.pk_id_pago_captura = b.fk_id_pago_captura and b.s_UUID = ? ";

$stmt_pagos = $db->prepare($query_pagos);
if (!($stmt_pagos)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt_pagos->bind_param('s',$uuid_captura);
if (!($stmt_pagos)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding pagos [$stmt_pagos->errno]: $stmt_pagos->error";
  exit_script($system_callback);
}
if (!($stmt_pagos->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution pagos [$stmt_pagos->errno]: $stmt_pagos->error";
  exit_script($system_callback);
}

$rslt_pagos = $stmt_pagos->get_result();
$total_pagos = $rslt_pagos->num_rows;


if( $total_pagos > 0 ) {
    $row_pagos = $rslt_pagos->fetch_assoc();
		$id_cliente = $row_pagos['fk_id_cliente'];
		$fecha = $row_pagos['d_FechaTimbrado'];
		$anio = date_format(date_create($fecha),"Y");
    $nombreArchivo = trim($row_pagos['s_nombrearchivo']);

    $imgXML .= "<a href='#' onclick='cargarXML_pago($anio,&#39;$id_cliente&#39;,&#39;$nombreArchivo&#39;,$id_poliza,&#39;V&#39;)' title='pago'><img class='icochico' src='/conta6/Resources/iconos/xml.svg'></a>";
    $imgXMLdownload .= "<a href='#' onclick='cargarXML_pago($anio,&#39;$id_cliente&#39;,&#39;$nombreArchivo&#39;,$id_poliza,&#39;D&#39;)' title='pago'><img class='ml-3 icochico' src='/conta6/Resources/iconos/descargar-2.svg'></a>";
}

#**************************
# CONSULTA XML - nc
#**************************
$query_nc = "SELECT a.fk_id_cliente,a.fk_referencia,b.pk_id_notacredito,b.d_fecha_fac
                FROM conta_t_notacredito_captura a, conta_t_notacredito_cfdi b
                WHERE a.pk_id_cuenta_captura_nc = b.fk_id_cuenta_captura_nc and b.s_UUID = ? ";

$stmt_nc = $db->prepare($query_nc);
if (!($stmt_nc)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt_nc->bind_param('s',$uuid_captura);
if (!($stmt_nc)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding nc [$stmt_nc->errno]: $stmt_nc->error";
  exit_script($system_callback);
}
if (!($stmt_nc->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution nc [$stmt_nc->errno]: $stmt_nc->error";
  exit_script($system_callback);
}

$rslt_nc = $stmt_nc->get_result();
$total_nc = $rslt_nc->num_rows;


if( $total_nc > 0 ) {
    $row_nc = $rslt_nc->fetch_assoc();
		$id_cliente = $row_nc['fk_id_cliente'];
    $id_referencia = $row_nc['fk_referencia'];
    $id_NC = $row_nc['pk_id_notacredito'];
		$fecha = $row_nc['d_fecha_fac'];
		$anio = date_format(date_create($fecha),"Y");

    $imgXML .= "<a href='#' onclick='cargarXML_nc($anio,&#39;$id_cliente&#39;,&#39;$id_referencia&#39;,&#39;$id_NC&#39;,$id_poliza,&#39;V&#39;)' title='nc'><img class='icochico' src='/conta6/Resources/iconos/xml.svg'></a>";
    $imgXMLdownload .= "<a href='#' onclick='cargarXML_nc($anio,&#39;$id_cliente&#39;,&#39;$id_referencia&#39;,&#39;$id_NC&#39;,$id_poliza,&#39;D&#39;)' title='nc'><img class='ml-3 icochico' src='/conta6/Resources/iconos/descargar-2.svg'></a>";
}
?>
