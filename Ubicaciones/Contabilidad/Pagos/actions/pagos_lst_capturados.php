<?php

$query = "SELECT * from conta_t_pagos_captura where fk_id_aduana = ? and pk_id_pago_captura LIKE ? ";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ss',$aduana,$text);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$rslt = $stmt->get_result();

if ($rslt->num_rows == 0) {
  $pagosCaptura = "<tr class='row font14 borderojo'><td class='col-md-12 text-center'>No se encontraron resultados</td></tr>";
}

while ($row = $rslt->fetch_assoc()) {
  $id_pago_captura = $row['pk_id_pago_captura'];
  $id_cliente = $row['fk_id_cliente'];
  $nombre = $row['s_nombre'];

  $hrefTimbrar = ''; $hrefEliminar = ''; $hrefMod = '';

  require $root . '/conta6/Ubicaciones/Contabilidad/Pagos/actions/pagos_lst_timbrados.php';
  if ($rslt_cfdi->num_rows == 0) {
    if( $oRst_permisos['s_rPgo_modificar'] == 1 ){ $hrefMod = "<a href='#' onclick='pagosModificar($id_pago_captura,&#39;$id_cliente&#39;,&#39;modificar&#39;)'><img class='icomediano' src='/conta6/Resources/iconos/003-edit.svg'></a>"; }
    if( $oRst_permisos['s_rPElect_timbrar'] == 1 ){ $hrefTimbrar = "<a href='#' onclick='pagosTimbrar($id_pago_captura,&#39;$id_cliente&#39;)' class='ml-3'><img class='icomediano' src='/conta6/Resources/iconos/timbrar.svg'></a>"; }
    if( $oRst_permisos['s_rPgo_cancelar'] == 1 ){ $hrefEliminar = "<a href='#' onclick='pagosCapturaEliminar($id_pago_captura)' class='ml-3'><img class='icomediano' src='/conta6/Resources/iconos/002-trash.svg'></a>"; }
  }

  if( $oRst_permisos['s_rPgo_consultar'] == 1 ){
    $hrefConsulta = "<a href='#' onclick='pagosConsultar($id_pago_captura,&#39;$id_cliente&#39;)' class='ml-3'><img class='icomediano' src='/conta6/Resources/iconos/magnifier.svg'></a>
    <a href='#' onclick='pagosImprimir($id_pago_captura)' class='ml-3'><img class='icomediano' src='/conta6/Resources/iconos/printer.svg'></a>";
  }

  $pagosCaptura .= "<tr class='row font14 borderojo'>
    <td class='col-md-1'>$hrefEliminar</td>
    <td class='col-md-2'>$id_pago_captura</td>
    <td class='col-md-6'>$id_cliente $nombre</td>
    <td class='col-md-3 text-right'>$hrefMod $hrefConsulta $hrefTimbrar</td>
  </tr>";
}


 ?>
