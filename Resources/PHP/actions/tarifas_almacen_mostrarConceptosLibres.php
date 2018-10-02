<?PHP
$query_ConceptosLibresAlmacen = "SELECT * FROM conta_tarifas_conceptos_libres where s_tipo_tarifa = 'almacen' ORDER BY s_descripcion";

$stmt_ConceptosLibresAlmacen = $db->prepare($query_ConceptosLibresAlmacen);
if (!($stmt_ConceptosLibresAlmacen)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_ConceptosLibresAlmacen->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_ConceptosLibresAlmacen->errno]: $stmt_ConceptosLibresAlmacen->error";
  exit_script($system_callback);
}

$rslt_ConceptosLibresAlmacen = $stmt_ConceptosLibresAlmacen->get_result();

if ($rslt_ConceptosLibresAlmacen->num_rows == 0) {
  $conceptosLibresAlmacen .= "<option selected value='0'>Sin Conceptos</option>";
}

if ($rslt_ConceptosLibresAlmacen->num_rows > 0) {
    $conceptosLibresAlmacen = "<option selected value='0'>Seleccione un concepto</option>";
  while ($row_ConceptosLibresAlmacen = $rslt_ConceptosLibresAlmacen->fetch_assoc()) {
    $pk_id_conceptolibre = trim($row_ConceptosLibresAlmacen['pk_id_conceptolibre']);
    $fk_id_cuenta = trim($row_ConceptosLibresAlmacen['fk_id_cuenta']);
    $s_descripcion = trim(utf8_encode($row_ConceptosLibresAlmacen['s_descripcion']));

    $conceptosLibresAlmacen .= "<option value='$s_descripcion+$pk_id_conceptolibre+$fk_id_cuenta'>$s_descripcion</option>";
  }
}

?>
