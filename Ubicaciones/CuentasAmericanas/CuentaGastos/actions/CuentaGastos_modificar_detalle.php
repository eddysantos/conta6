<?PHP
$tipoDetalle = 'pocme';
$pocmes = $_POST['pocme'];

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
  $POCME_idpartida = $pocme['idpartida'];




  if( $POCME_idpartida > 0 ){
    $system_callback['hon'] .= $POCME_idpartida.'->'.$POCME_importe.'='.$POCME_valor.'Actualizado/';
    $query_POCME_update="UPDATE contame_t_facturas_det SET n_cantidad = ?,
                                                          fk_id_cuenta = ?,
                                                          fk_id_concepto = ?,
                                                          s_conceptoEsp = ?,
                                                          s_conceptoEnglish = ?,
                                                          s_descripcion = ?,
                                                          n_importe = ?,
                                                          n_total = ?,
                                                          s_marca = ?,
                                                          n_gasto = ?,
                                                          n_gana = ?
                                                    WHERE pk_id_partida = ?";

    $stmt_POCME_update = $db->prepare($query_POCME_update);
    if (!($stmt_POCME_update)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare POCME_update [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    $stmt_POCME_update->bind_param('ssssssssssss',$POCME_cantidad,
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
                                                  $POCME_idpartida);


    if (!($stmt_POCME_update)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding POCME_update [$stmt_POCME_update->errno]: $stmt_POCME_update->error";
      exit_script($system_callback);
    }

    if (!($stmt_POCME_update->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution POCME [$stmt_POCME_update->errno]: $stmt_POCME_update->error";
    }

  }else{
    $system_callback['hon'] .= $POCME_idpartida.'->'.$POCME_importe.'='.$POCME_valor.'INSERTADO/';
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

    $stmt_POCME->bind_param('sssssssssssss',$T_Invoice_No,
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

}# fin foreach ($pocmes as $pocme)


#BORRAR
$pocmesDelete = $_POST['pocmeDelete'];

$query_POCMEdelete="DELETE FROM contame_t_facturas_det WHERE pk_id_partida = ?";

$stmt_POCMEdelete = $db->prepare($query_POCMEdelete);
if (!($stmt_POCMEdelete)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare POCME delete [$db->errno]: $db->error";
  exit_script($system_callback);
}

foreach ($pocmesDelete as $pocmeD) {
  $POCME_idpartida = $pocmeD['idpartida'];

  $stmt_POCMEdelete->bind_param('s',$POCME_idpartida);
  if (!($stmt_POCMEdelete)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding POCME delete [$stmt_POCMEdelete->errno]: $stmt_POCMEdelete->error";
    exit_script($system_callback);
  }

  if (!($stmt_POCMEdelete->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution POCME delete [$stmt_POCMEdelete->errno]: $stmt_POCMEdelete->error";
  }

}





$tipoDetalleAnt = 'anticipo';
$anticipos = $_POST['anticipos'];
$query_ANT="UPDATE contame_t_facturas_det SET   n_noDeposito = ?,
                                                n_importe = ?,
                                                s_tipoDetalle = ?
                                          WHERE pk_id_partida = ? ";
$stmt_ANT = $db->prepare($query_ANT);
if (!($stmt_ANT)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare ANT [$db->errno]: $db->error";
  exit_script($system_callback);
}

foreach ($anticipos as $anticipo) {
  $ANT_num = $anticipo['anticipo'];
  $ANT_importe = $anticipo['importe'];


  $stmt_ANT->bind_param('ssss',$ANT_num,
                               $ANT_importe,
                               $tipoDetalleAnt,
                               $POCME_idpartida);
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
