<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

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
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $system_callback['data'] .=
  '<td class="col-md-1">'.$row[s_nivel].'</td>'.
  '<td class="col-md-1">'.$row[pk_codAgrup].'</td>'.
  '<td class="col-md-1">'.$row[s_ctaNombre].'</td>'.
  '<td class="col-md-1">'.$row[s_activo].'</td>'.
  '<td class="col-md-1">'.$row[d_fechaInicioVigencia].'</td>'.
  '<td class="col-md-1">'.$row[s_clasificacion].'</td>'.
  '<td class="col-md-1">'.$row[s_ctaBalance].'</td>';
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

?>
