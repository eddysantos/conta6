<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';
$system_callback = [];

  $query_consultaFormapago = "SELECT * FROM conta_cs_sat_formapago ORDER BY s_concepto";
  $stmt_consultaFormapago = $db->prepare($query_consultaFormapago);
  if (!($stmt_consultaFormapago)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaFormapago->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaFormapago->errno]: $stmt_consultaFormapago->error";
    exit_script($system_callback);
  }
  $rslt_consultaFormapago = $stmt_consultaFormapago->get_result();
  $rows_consultaFormapago = $rslt_consultaFormapago->num_rows;

  if ($rows_consultaFormapago == 0) {
    $system_callback['code'] = 2;
    $system_callback['message'] = "Hubo un error al mostar el catálogo completo del SAT.";
    exit_script($system_callback);
  }

  if ($rows_consultaFormapago > 0) {
      while ($row_consultaFormapago = $rslt_consultaFormapago->fetch_assoc()) {
        $id_Formapago = $row_consultaFormapago['pk_id_formapago'];
        $concepto = utf8_encode($row_consultaFormapago['s_concepto']);

        $system_callback['data'] .=
        '<tr class="row m-0 borderojo">
          <td class="p-1 col-md-1">'.$row_consultaFormapago['pk_id_formapago'].'</td>'.
          '<td class="p-1 col-md-6">'.utf8_encode($row_consultaFormapago['s_concepto']).'</td>'.
          '<td class="p-1 col-md-4">'.$row_consultaFormapago['d_fecha_diarioOficial'].'</td>'.
          '<td class="p-1 col-md-1">'.$row_consultaFormapago['s_activo'].'</td></tr>';
      }
  }

  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);

?>
