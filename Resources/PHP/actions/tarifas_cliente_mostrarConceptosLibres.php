<?PHP
$query_ConceptosLibresCliente = "SELECT * FROM conta_tarifas_conceptos_libres where s_tipo_tarifa = 'cliente' ORDER BY s_descripcion";

$stmt_ConceptosLibresCliente = $db->prepare($query_ConceptosLibresCliente);
if (!($stmt_ConceptosLibresCliente)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_ConceptosLibresCliente->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_ConceptosLibresCliente->errno]: $stmt_ConceptosLibresCliente->error";
  exit_script($system_callback);
}

$rslt_ConceptosLibresCliente = $stmt_ConceptosLibresCliente->get_result();

if ($rslt_ConceptosLibresCliente->num_rows == 0) {
  $conceptosLibresCliente .= "<option selected value='0'>Sin Conceptos</option>";
}

if ($rslt_ConceptosLibresCliente->num_rows > 0) {
    $conceptosLibresCliente = "<option selected value='0'>Seleccione un concepto</option>";
  while ($row_ConceptosLibresCliente = $rslt_ConceptosLibresCliente->fetch_assoc()) {
    $s_descripcion = trim(utf8_encode($row_ConceptosLibresCliente[s_descripcion]));

    $conceptosLibresCliente .= "<option value='$s_descripcion'>$s_descripcion</option>";
  }
}

?>
