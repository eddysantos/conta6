<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];

$query = "SELECT * FROM conta_cs_sat_cuentas ORDER BY n_id_partida";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$rslt = $stmt->get_result();

if ($rslt->num_rows == 0) {
  $system_callback['code'] = 2;
  $system_callback['message'] = "Hubo un error al mostar el catálogo completo del SAT.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $system_callback['data'] .=
  '<tr class="row m-0 borderojo"><td class="col-md-1">'. utf8_encode($row[s_nivel]).'</td>'.
  '<td class="col-md-1">'.utf8_encode($row[pk_codAgrup]).'</td>'.
  '<td class="col-md-4">'.utf8_encode($row[s_ctaNombre]).'</td>'.
  '<td class="col-md-1">'.$row[s_activo].'</td>'.
  '<td class="col-md-2">'.$row[d_fechaInicioVigencia].'</td>'.
  '<td class="col-md-2">'.$row[s_clasificacion].'</td>'.
  '<td class="col-md-1">'.$row[s_ctaBalance].'</td></tr>';
}



$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
// echo json_encode($system_callback);
// die();

exit_script($system_callback);

?>
