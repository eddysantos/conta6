<?PHP
$query_ConceptosCliente = "SELECT * FROM conta_tem_tarifas_calculodetalle where s_seccion = 'cliente' and fk_id_tarifa = $calculoTarifa ORDER BY s_descripcion";

$stmt_ConceptosCliente = $db->prepare($query_ConceptosCliente);
if (!($stmt_ConceptosCliente)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_ConceptosCliente->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_ConceptosCliente->errno]: $stmt_ConceptosCliente->error";
  exit_script($system_callback);
}

$rslt_ConceptosCliente = $stmt_ConceptosCliente->get_result();

if ($rslt_ConceptosCliente->num_rows == 0) {
  $ConceptosCliente .= "<option selected value='0'>Sin tarifa</option>";
}

if ($rslt_ConceptosCliente->num_rows > 0) {
    $ConceptosCliente = "<option selected value='0'>Seleccione un concepto</option>";
  while ($row_ConceptosCliente = $rslt_ConceptosCliente->fetch_assoc()) {
    $s_descripcion = trim(utf8_encode($row_ConceptosCliente[s_descripcion]));

    $ConceptosCliente .= "<option value='$s_descripcion'>$s_descripcion</option>";
  }
}

?>
