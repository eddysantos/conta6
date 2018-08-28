<?PHP

mysqli_query($db,"INSERT INTO conta_tem_tarifas_calculo (fk_usuario,s_tipoDoc)VALUES ('$usuario','$s_tipoDoc')");

$calculoTarifa = mysqli_insert_id($db);

/*
$system_callback = [];
$data = $_POST;

$query_genFolTarifa = "INSERT INTO conta_tem_tarifas_calculo (fk_usuario,s_tipoDoc)VALUES (?,?)";

$stmt_genFolTarifa = $db->prepare($query_genFolTarifa);
if (!($stmt_genFolTarifa)) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_genFolTarifa->bind_param('ss',$usuario,$s_tipoDoc);
if (!($stmt_genFolTarifa)) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_genFolTarifa->errno]: $stmt_genFolTarifa->error";
  exit_script($system_callback);
}

if (!($stmt_genFolTarifa->execute())) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_genFolTarifa->errno]: $stmt_genFolTarifa->error";
  exit_script($system_callback);
}

echo $calculoTarifa = $db->_genFolTarifa_id;


$system_callback['data'] = $calculoTarifa;
 $system_callback['code'] = 1;
 //$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
*/
?>
