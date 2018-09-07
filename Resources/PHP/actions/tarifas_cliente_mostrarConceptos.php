<?PHP
$query_ConceptosAlmacen = "SELECT * FROM conta_tem_tarifas_calculodetalle where s_seccion = 'almacen' and fk_id_tarifa = $calculoTarifa ORDER BY s_descripcion";

$stmt_ConceptosAlmacen = $db->prepare($query_ConceptosAlmacen);
if (!($stmt_ConceptosAlmacen)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_ConceptosAlmacen->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_ConceptosAlmacen->errno]: $stmt_ConceptosAlmacen->error";
  exit_script($system_callback);
}

$rslt_ConceptosAlmacen = $stmt_ConceptosAlmacen->get_result();

if ($rslt_ConceptosAlmacen->num_rows == 0) {
  $ConceptosAlmacen .= "<option selected value='0'>Sin tarifa</option>";
}

if ($rslt_ConceptosAlmacen->num_rows > 0) {
    $ConceptosAlmacen = "<option selected value='0'>Seleccione un concepto</option>";
  while ($row_ConceptosAlmacen = $rslt_ConceptosAlmacen->fetch_assoc()) {
    $s_descripcion = trim(utf8_encode($row_ConceptosCliente[s_descripcion]));
    $id_cuenta =  trim($row_ConceptosCliente[fk_id_cuenta]);
    $c_ClaveProdServ =  trim($row_ConceptosCliente[fk_c_ClaveProdServ]);
    $importe =  trim($row_ConceptosCliente[n_importe]);

    $ConceptosCliente .= "<option value='$id_cuenta+$c_ClaveProdServ+$importe+$s_descripcion'>$s_descripcion $importe</option>";
  }
}

?>
