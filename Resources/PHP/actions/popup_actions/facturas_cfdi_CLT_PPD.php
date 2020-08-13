<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$data['string'];
$text = "%" . $data['string'] . "%";
//$text = "%25%";
$query = "SELECT A.fk_id_aduana,A.fk_referencia,B.s_UUID,B.pk_id_factura,A.fk_id_moneda,A.n_tipoCambio,
                 A.fk_c_MetodoPago,a.n_total_gral,A.fk_id_cliente,A.s_nombre
          FROM conta_t_facturas_captura A, conta_t_facturas_cfdi B
          WHERE A.pk_id_cuenta_captura = B.fk_id_cuenta_captura and
                A.fk_c_MetodoPago = 'PPD' AND
                B.s_UUID IS NOT NULL AND
                B.s_selloSATcancela IS NULL AND B.pk_id_factura LIKE ?
          ORDER BY B.pk_id_factura ";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s', $text);
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
  $tipoCambio = $row[n_tipoCambio];

  if( $tipoCambio == "" ){$tipoCambio = 1; }
    $system_callback['data'] .=
  "<p db-id='$row[fk_id_aduana]+$row[fk_referencia]+$row[s_UUID]+$row[pk_id_factura]+$row[fk_id_moneda]+$tipoCambio+$row[fk_c_MetodoPago]+$row[n_total_gral]+$row[fk_id_cliente]'>
    $row[pk_id_factura] -- $row[fk_referencia] -- $row[fk_id_cliente] $row[s_nombre]</p>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


 ?>
