<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';
$system_callback = [];
$query = "SELECT * FROM conta_cs_sat_bancos ORDER BY s_activo desc,s_nombre";


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
  $activo = $row[s_activo];
  if( $activo == 1 ){ $txt_activo = "Si"; }else{ $txt_activo = "No"; }

  $system_callback['data'] .=
  '<tr class="row m-0 borderojo"><td class="col-md-1">'. utf8_encode($row[pk_id_banco]).'</td>'.
  '<td class="col-md-2">'.utf8_encode($row[s_nombre]).'</td>'.
  '<td class="col-md-6 text-left">'.utf8_encode($row[s_descripcion]).'</td>'.
  '<td class="col-md-1">'.$txt_activo.'</td>'.
  '<td class="col-md-2">'.$row[d_fechaInicioVigencia].'</td></tr>';
}
$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
// echo json_encode($system_callback);
// die();
exit_script($system_callback);
?>
