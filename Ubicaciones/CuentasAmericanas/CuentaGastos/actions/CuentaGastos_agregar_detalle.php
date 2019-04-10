<?PHP
$tipoDetalle = 'pocme';
$pocmes = $_POST['pocme'];
$query_POCME="INSERT INTO contame_t_facturas_det( fk_id_ctaAme,
                                                  n_cantidad,
                                                  fk_id_cuenta,
                                                  fk_id_concepto,
                                                  s_conceptoEsp,
                                                  s_conceptoEnglish,
                                                  s_descripcion,
                                                  n_importe,
                                                  n_total,
                                                  s_marca,
                                                  n_gasto,
                                                  n_gana,
                                                  s_tipoDetalle)
                    VALUES (?,?,?,?,?,?,?,?,?,?,
                            ?,?,?)";

$stmt_POCME = $db->prepare($query_POCME);
if (!($stmt_POCME)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare POCME [$db->errno]: $db->error";
  exit_script($system_callback);
}

foreach ($pocmes as $pocme) {
  $POCME_cantidad = $pocme['cantidad'];
  $POCME_idTipoCta = $pocme['idcuenta'];
  $POCME_idConcep = $pocme['idconcepto'];
  $POCME_concepto = utf8_decode($pocme['concepto_esp']);
  $POCME_conceptoEng = $pocme['concepto_ing'];
  $POCME_desc = utf8_decode($pocme['descripcion']);
  $POCME_importe = $pocme['importe'];
  $POCME_valor = $pocme['subtotal'];
  $POCME_check = $pocme['check'];
  $POCME_gasto = $pocme['gasto'];
  $POCME_ganancia = $pocme['ganancia'];

  $stmt_POCME->bind_param('sssssssssssss', $nfolio,
                                          $POCME_cantidad,
                                          $POCME_idTipoCta,
                                          $POCME_idConcep,
                                          $POCME_concepto,
                                          $POCME_conceptoEng,
                                          $POCME_desc,
                                          $POCME_importe,
                                          $POCME_valor,
                                          $POCME_check,
                                          $POCME_gasto,
                                          $POCME_ganancia,
                                          $tipoDetalle);
  if (!($stmt_POCME)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding POCME [$stmt_POCME->errno]: $stmt_POCME->error";
    exit_script($system_callback);
  }

  if (!($stmt_POCME->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution POCME [$stmt_POCME->errno]: $stmt_POCME->error";
  }
}


$tipoDetalle = 'anticipo';
$anticipos = $_POST['anticipos'];
$query_ANT="INSERT INTO contame_t_facturas_det( fk_id_ctaAme,
                                                n_noDeposito,
                                                n_importe,
                                                s_tipoDetalle)
                    VALUES (?,?,?,?)";

$stmt_ANT = $db->prepare($query_ANT);
if (!($stmt_ANT)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare ANT [$db->errno]: $db->error";
  exit_script($system_callback);
}

foreach ($anticipos as $anticipo) {
  $ANT_num = $anticipo['anticipo'];
  $ANT_importe = $anticipo['importe'];


  $stmt_ANT->bind_param('ssss', $nfolio,
                               $ANT_num,
                               $ANT_importe,
                               $tipoDetalle);
  if (!($stmt_ANT)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding ANT [$stmt_ANT->errno]: $stmt_ANT->error";
    exit_script($system_callback);
  }

  if (!($stmt_ANT->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution ANT [$stmt_ANT->errno]: $stmt_ANT->error";
  }
}
?>
