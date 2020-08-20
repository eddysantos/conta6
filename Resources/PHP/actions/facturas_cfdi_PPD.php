<?php
$text = $buscar;

$query = "SELECT a.pk_id_factura,a.fk_referencia,b.fk_id_cliente,b.s_nombre,b.fk_c_MetodoPago,a.s_selloSATcancela,a.fk_id_cuenta_captura
          FROM conta_t_facturas_cfdi a, conta_t_facturas_captura b
          WHERE b.pk_id_cuenta_captura = a.fk_id_cuenta_captura and
                a.s_UUID is not null and b.fk_id_aduana = ? and
                (a.fk_referencia LIKE ? or a.pk_id_factura = ?)";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('sss',$aduana,$text, $text);
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
  $facturasPPD = "<p db-id=''>No se encontraron resultados</p>";
}

while ($row = $rslt->fetch_assoc()) {
  $cuenta = $row['fk_id_cuenta_captura'];
  $id_factura = $row['pk_id_factura'];
  $id_referencia = $row['fk_referencia'];
  $id_cliente = $row['fk_id_cliente'];
  $nombre = $row['s_nombre'];
  $metodo_pago = $row['fk_c_MetodoPago'];
  $cancela = $row['s_selloSATcancela'];

  if( $cancela <> "" ){ $status = "Cancelado"; }else{ $status = "Activo"; }
  if( $metodo_pago == "PPD" && $cancela == "" ){
    $hrefSig = "<a href='#' onclick='pagosGenerar($cuenta,&#39;$id_cliente&#39;)'><img src='/Resources/iconos/rightred.svg'></a>";
  }
  $facturasPPD .= "<tr class='row font14 borderojo'>
    <td class='col-md-1'>$id_factura</td>
    <td class='col-md-2'>$id_referencia</td>
    <td class='col-md-2'>$metodo_pago</td>
    <td class='col-md-4'>$id_cliente $nombre</td>
    <td class='col-md-2'>$status</td>
    <td class='col-md-1 text-right'>$hrefSig</td>
  </tr>";
}


 ?>
