<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$fecha = trim($_POST['antfecha']);
$valor = trim($_POST['antvalor']);
$cliente = trim($_POST['antcliente']);
$banco = trim($_POST['antbanco']);
$bancocta = trim($_POST['bancocta']);
$cta = trim($_POST['antcuenta']);
$concepto = trim($_POST['antconcepto']);
$aduana = trim($_POST['antaduana']);
$usuario = trim($_POST['antusuario']);


$fechaDoc = date_format(date_create($fecha),'Y-m-d');


#'******* CTA ORIGEN ***************************
$parteCuenta = explode('-',$cta);
$bcoDest = "999"; //999 -	N/A - No identificado
$ctaDest = "NA";

if( $parteCuenta[0] == "0100" ){
	$query = "SELECT fk_id_banco AS id_banco,s_ctaOri AS ctaOri FROM conta_cs_bancos_cia WHERE fk_id_cuenta = ?";

}else{
	$query = "SELECT a.fk_id_banco AS id_banco,a.s_cta_banco AS ctaOri
						FROM conta_cs_bancos_clientes A, conta_cs_cuentas_mst B
						WHERE A.fk_id_cliente = B.s_cta_identificador AND B.pk_id_cuenta = ? ";
}

$stmt = $db->prepare($query);
if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}

$stmt->bind_param('s', $cta);
if (!($stmt)) { die("Error during query prepare [$stmt->errno]: $stmt->error");	}

if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }

$rslt = $stmt->get_result();
$rows = $rslt->num_rows;
$row = $rslt->fetch_assoc();
$bcoDest = $row['id_banco'];
$ctaDest = $row['ctaOri'];
#'******* FIN CTA ORIGEN ******************************



$system_callback = [];
//$data = $_POST;

$queryInsert = "INSERT INTO conta_t_anticipos_mst(d_fecha,
	fk_usuario,
	n_valor,
	fk_id_aduana,
	fk_id_cliente_antmst,
	fk_id_cuentaMST,
	s_concepto,
	s_bancoOri,
	s_ctaOri,
	s_bancoDest,
	s_ctaDest)
VALUES (?,?,?,?,?,?,?,?,?,?,?)";

$stmtInsert = $db->prepare($queryInsert);
if (!($stmtInsert)) {
	$system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmtInsert->bind_param('sssssssssss', $fecha,$usuario,$valor,$aduana,$cliente,$cta,$concepto,$banco,$bancocta,$bcoDest,$ctaDest);
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


$descripcion = "Se Genero el Anticipo: $nFolio Concepto: $concepto Fecha: $fecha Valor: $valor Cuenta:$cta Cliente:$cliente";
$clave = 'anticipos';
$folio = $nFolio;
require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';


$system_callback['data'] .= $nFolio;
$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);





?>
