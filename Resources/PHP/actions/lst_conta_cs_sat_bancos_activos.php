<?PHP

$query_consultaBancos = "SELECT * FROM conta_cs_sat_bancos where s_activo = 1 ORDER BY s_nombre";

$stmt_consultaBancos = $db->prepare($query_consultaBancos);
if (!($stmt_consultaBancos)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_consultaBancos->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_consultaBancos->errno]: $stmt_consultaBancos->error";
  exit_script($system_callback);
}

$rslt_consultaBancos = $stmt_consultaBancos->get_result();
$rows_consultaBancos = $rslt_consultaBancos->num_rows;

if ($rows_consultaBancos > 0) {
    $consultaBancos = "<option selected value=''>Bancos</option>";
    while ($row_consultaBancos = $rslt_consultaBancos->fetch_assoc()) {
      $idBanco = $row_consultaBancos['pk_id_banco'];
      $nombreBanco = utf8_encode($row_consultaBancos['s_nombre']);
      $consultaBancos .= '<option value="'.$idBanco.'+'.$nombreBanco.'">'.$nombreBanco.' --- '.$idBanco.'</option>';
    }
}


?>
