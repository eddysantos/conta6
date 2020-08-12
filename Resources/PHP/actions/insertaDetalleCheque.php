<?PHP

/* USAR
$id_poliza =
$tipo =

$id_cheque =
$cuentaMST =
$fecha =
$cuenta =
$id_referencia =
$id_cliente =
$documento =
$anticipo =
$factura =
$desc =
$cargo =
$abono =
$gastoOficina =
$proveedor =
$idcheque_folControl =


*/
$query = "INSERT INTO conta_t_cheques_det (
                          fk_idcheque_folControl,
                          fk_id_cheque,
                          fk_id_cuentaM,
                          d_fecha,
                          fk_id_cuenta,
                          fk_referencia,
                          fk_id_cliente,
                          s_folioCFDIext,
                          fk_anticipo,
                          fk_factura,
                          s_desc,
                          n_cargo,
                          n_abono,
                          fk_gastoAduana,
                          fk_id_proveedor,
                          fk_usuario,
                          fk_ctagastos,
                          fk_nc)
          VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ssssssssssssssssss',$idcheque_folControl,
                                    $id_cheque,
                                    $cuentaMST,
                                    $fecha,
                                    $cuenta,
                                    $id_referencia,
                                    $id_cliente,
                                    $documento,
                                    $anticipo,
                                    $factura,
                                    $desc,
                                    $cargo,
                                    $abono,
                                    $gastoOficina,
                                    $proveedor,
                                    $usuario,
                                    $ctagastos,
                                    $notaCred );
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
