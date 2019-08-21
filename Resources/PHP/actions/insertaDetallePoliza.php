<?PHP

/* USAR
$tipo =
$id_poliza =
$fecha =
$cuenta =
$id_referencia =
$id_cliente =
$documento =
$factura =
$anticipo =
$cheque =
$desc =
$cargo =
$abono =
$gastoOficina =
$proveedor =
$usuario = 
*/
$query = "INSERT INTO conta_t_polizas_det (fk_tipo,fk_id_poliza,d_fecha,fk_id_cuenta,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_factura,fk_anticipo,fk_cheque,s_desc,n_cargo,n_abono,fk_gastoAduana,fk_id_proveedor,fk_usuario)
          VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('sssssssssssssss',$tipo,$id_poliza,$fecha,$cuenta,$id_referencia,$id_cliente,$documento,$factura,$anticipo,$cheque,$desc,$cargo,$abono,$gastoOficina,$proveedor,$usuario);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}


?>
