<?php
$query = "SELECT A.fk_id_cuenta_captura,A.pk_id_factura, A.fk_referencia, A.fk_id_poliza, A.s_cancela_factura,B.fk_id_cliente, B.s_nombre
          FROM conta_t_facturas_cfdi A, conta_t_facturas_captura B
          WHERE A.fk_id_cuenta_captura = B.pk_id_cuenta_captura AND
                A.fk_referencia = ?  AND
                A.s_UUID is not null
          ORDER BY A.pk_id_factura ";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s',$id_referencia);
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
  $system_callback['code'] = 1;
  $system_callback['data'] =
  "<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $facCFDI .= "<option value='$row[pk_id_factura]'>$row[pk_id_factura]</option>";
}

// $system_callback['code'] = 1;
// $system_callback['message'] = "Script called successfully!";
// exit_script($system_callback);


 ?>
