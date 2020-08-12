<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$tipo = trim($_POST['diatipo']);
$aduana = trim($_POST['diaaduana']);
$fecha = trim($_POST['diafecha']);
$concepto = trim($_POST['diaconcepto']);

$fechaDoc = date_format(date_create($fecha),'Y-m-d');

if(!isset($mesPoliza)){
  $mesPoliza = date_format(date_create($fecha),'m');
}

$system_callback = [];

$queryInsert = "INSERT INTO conta_t_polizas_mst (d_fecha,fk_usuario,fk_id_aduana,s_concepto,d_mes)
           		 VALUES (?,?,?,?,?)";

$stmtInsert = $db->prepare($queryInsert);
if (!($stmtInsert)) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtInsert->bind_param('sssss',$fechaDoc,$usuario,$aduana,$concepto,$mesPoliza);
if (!($stmtInsert)) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmtInsert->errno]: $stmtInsert->error";
  exit_script($system_callback);
}

if (!($stmtInsert->execute())) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmtInsert->errno]: $stmtInsert->error";
  exit_script($system_callback);
}

$nFolio = $db->insert_id;


$descripcion = "Se Genero la Poliza: $nFolio Concepto: $concepto";
$clave = 'polizas';
$folio = $nFolio;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

$system_callback['data'] .= $nFolio;
$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

?>
