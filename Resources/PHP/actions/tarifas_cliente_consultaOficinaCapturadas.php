<?PHP
$query_consultaOficinaTarifa = "SELECT pk_id_aduana,s_nombre FROM conta_t_oficinas WHERE pk_id_aduana in (
SELECT distinct fk_id_aduana FROM conta_tarifas where fk_id_cliente = '$id_cliente' and fk_c_pais = 'MEX') ORDER BY s_nombre";

$stmt_consultaOficinaTarifa = $db->prepare($query_consultaOficinaTarifa);
if (!($stmt_consultaOficinaTarifa)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_consultaOficinaTarifa->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_consultaOficinaTarifa->errno]: $stmt_consultaOficinaTarifa->error";
  exit_script($system_callback);
}

$rslt_consultaOficinaTarifa = $stmt_consultaOficinaTarifa->get_result();

if ($rslt_consultaOficinaTarifa->num_rows == 0) {
  $consultaOficinaTarifa = "NO HAY TARIFAS CAPTURADAS";
}

if ($rslt_consultaOficinaTarifa->num_rows > 0) {
  while ($row_consultaOficinaTarifa = $rslt_consultaOficinaTarifa->fetch_assoc()) {
    $tarifa_idaduana = trim($row_consultaOficinaTarifa['pk_id_aduana']);
    $tarifa_nomaduana =  trim($row_consultaOficinaTarifa['s_nombre']);

    $consultaOficinaTarifa .= "<tr class='row'>
      <td class='col-md-6 p-0'>$tarifa_idaduana</td>
      <td class='col-md-6 p-0'>$tarifa_nomaduana</td>
    </tr>";
  }
}

?>
