<?PHP

//DATOS DEL EMBARQUE ***********************************************************
$seccion = 'DatGnEmbarq';
$query_DatGnEmbarq="INSERT INTO conta_t_notacredito_captura_det(fk_id_cuenta_captura_nc,s_tipoDetalle,s_conceptoEsp,s_descripcion)
                                                    VALUES($nfolio,'$seccion','$IGET_1','$IGED_1'),
                                                          ($nfolio,'$seccion','$IGET_2','$IGED_2'),
                                                          ($nfolio,'$seccion','$IGET_3','$IGED_3'),
                                                          ($nfolio,'$seccion','$IGET_4','$IGED_4'),
                                                          ($nfolio,'$seccion','$IGET_5','$IGED_5'),
                                                          ($nfolio,'$seccion','$IGET_6','$IGED_6'),
                                                          ($nfolio,'$seccion','$IGET_7','$IGED_7'),
                                                          ($nfolio,'$seccion','$IGET_8','$IGED_8'),
                                                          ($nfolio,'$seccion','$IGET_9','$IGED_9'),
                                                          ($nfolio,'$seccion','$IGET_10','$IGED_10'),
                                                          ($nfolio,'$seccion','$IGET_11','$IGED_11'),
                                                          ($nfolio,'$seccion','$IGET_12','$IGED_12'),
                                                          ($nfolio,'$seccion','$IGET_13','$IGED_13')";

$stmt_DatGnEmbarq = $db->prepare($query_DatGnEmbarq);
if (!($stmt_DatGnEmbarq)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare DatGnEmbarq [$db->errno]: $db->error";
  exit_script($system_callback);
}
if (!($stmt_DatGnEmbarq->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution DatGnEmbarq [$stmt_DatGnEmbarq->errno]: $stmt_DatGnEmbarq->error";
}


//PAGOS O COBROS EN MONEDA EXTRANJERA ******************************************
if( $Total_POCME > 0 ){
    $seccion = 'POCME';

      $pocmes = $_POST['pocme'];

      $query_POCME="INSERT INTO conta_t_notacredito_captura_det(fk_id_cuenta_captura_nc,s_tipoDetalle,n_cantidad,fk_id_cuenta,s_conceptoEsp,s_conceptoEnglish,s_descripcion,n_importe,n_total,fk_id_concepto)
                          VALUES (?,?,?,?,?,?,?,?,?,?)";

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
        $POCME_concepto = $pocme['concepto_esp'];
        $POCME_conceptoEng = $pocme['concepto_ing'];
        $POCME_desc = $pocme['descripcion'];
        $POCME_importe = $pocme['importe'];
        $POCME_valor = $pocme['subtotal'];

        $stmt_POCME->bind_param('ssssssssss',$nfolio,$seccion,$POCME_cantidad,$POCME_idTipoCta,$POCME_concepto,$POCME_conceptoEng,$POCME_desc,$POCME_importe,$POCME_valor,$POCME_idConcep);
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
}

//PAGOS REALIZADOS POR SU CUENTA ***********************************************
if( $Total_Pagos <> 0 ){

    $seccion = 'cargos';
    $cargos = $_POST['cargos'];
    $cargo_idTipoCta = '0110-00001';
    $cargo_concepto = 'Impuestos y/o derechos pagados o garantizados al Com. Ext.';

    #Impuestos y/o derechos pagados o garantizados al Com. Ext.
    $query_cargos1="INSERT INTO conta_t_notacredito_captura_det(fk_id_cuenta_captura_nc,s_tipoDetalle,fk_id_cuenta,s_conceptoEsp,n_total)
                                                    VALUES (?,?,?,?,?) ";

    $stmt_cargos1 = $db->prepare($query_cargos1);
    if (!($stmt_cargos1)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare cargos1 [$db->errno]: $db->error";
      exit_script($system_callback);
    }


    $stmt_cargos1->bind_param('sssss',$nfolio,$seccion,$cargo_idTipoCta,$cargo_concepto,$Total_derechosPagados);
    if (!($stmt_cargos1)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding cargos1 [$stmt_cargos1->errno]: $stmt_cargos1->error";
    exit_script($system_callback);
    }

    if (!($stmt_cargos1->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution cargos1 [$stmt_cargos1->errno]: $stmt_cargos1->error";
    }


    #cargos
    $query_cargos="INSERT INTO conta_t_notacredito_captura_det(fk_id_cuenta_captura_nc,s_tipoDetalle,fk_id_concepto,fk_id_cuenta,s_conceptoEsp,n_total)
                                                    VALUES (?,?,?,?,?,?) ";

    $stmt_cargos = $db->prepare($query_cargos);
    if (!($stmt_cargos)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare cargos [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    foreach ($cargos as $cargo) {
      $cargo_idTipoCta = $cargo['idcuenta'];
      $cargo_idConcep = $cargo['idconcepto'];
      $cargo_concepto = $cargo['concepto_esp'];
      $cargo_valor = $cargo['subtotal'];

      $stmt_cargos->bind_param('ssssss',$nfolio,$seccion,$cargo_idConcep,$cargo_idTipoCta,$cargo_concepto,$cargo_valor);
      if (!($stmt_cargos)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding cargos [$stmt_cargos->errno]: $stmt_cargos->error";
        exit_script($system_callback);
      }

      if (!($stmt_cargos->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution cargos [$stmt_cargos->errno]: $stmt_cargos->error";
      }
    }

}

//HONORARIOS Y SERVICIOS *******************************************************
if( $Total_Gral_Importe > 0 ){
  $seccion = 'honorarios';
  $hon_cantidad = '1';
  $hon_cve_unidad = 'E48';
  $hon_unidad = 'Servicio';

  $query_hon1="INSERT INTO conta_t_notacredito_captura_det( fk_id_cuenta_captura_nc,
                                                          s_tipoDetalle,
                                                          n_cantidad,
                                                          fk_c_claveUnidad,
                                                          s_Unidad,
                                                          s_conceptoEsp,
                                                          fk_id_cuenta,
                                                          fk_c_ClaveProdServ,
                                                          n_importe,
                                                          n_IVA,
                                                          n_ret,
                                                          n_total,
                                                          n_porcentaje,
                                                          n_base,
                                                          n_descuento)
                                                  VALUES( ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

  $stmt_hon1 = $db->prepare($query_hon1);
  if (!($stmt_hon1)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare hon1 [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmt_hon1->bind_param('sssssssssssssss',$nfolio,$seccion,$hon_cantidad,$hon_cve_unidad,$hon_unidad,
  $Honorarios_0,$Hcta_0,$Hps_0,$Honorarios_Importe_0,$Honorarios_IVA_0,
  $Honorarios_RET_0,$Honorarios_Subtotal_0,$Honorarios_Porcentaje,$Honorarios_Base_Honorarios,$Honorarios_Descuento);

  if (!($stmt_hon1)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding hon1 [$stmt_hon1->errno]: $stmt_hon1->error";
      exit_script($system_callback);
  }

  if (!($stmt_hon1->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution hon1 [$stmt_hon1->errno]: $stmt_hon1->error";
  }

  $honorarios = $_POST['honorarios'];
  $query_hon="INSERT INTO conta_t_notacredito_captura_det( fk_id_cuenta_captura_nc,
                                                            s_tipoDetalle,
                                                            n_cantidad,
                                                            fk_c_claveUnidad,
                                                            s_Unidad,
                                                            s_conceptoEsp,
                                                            fk_id_cuenta,
                                                            fk_c_ClaveProdServ,
                                                            n_importe,
                                                            n_IVA,
                                                            n_ret,
                                                            n_total)
                                                    VALUES( ?,?,?,?,?,?,?,?,?,?,?,?)";

    $stmt_hon = $db->prepare($query_hon);
    if (!($stmt_hon)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare hon [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    foreach ($honorarios as $hon) {
      $hon_idTipoCta = $hon['idcuenta'];
      $hon_cveProd = $hon['idcveprod'];
      $hon_concepto = $hon['concepto_esp'];
      $hon_importe = $hon['importe'];
      $hon_iva = $hon['iva'];
      $hon_ret = $hon['ret'];
      $hon_valor = $hon['subtotal'];

      $stmt_hon->bind_param('ssssssssssss',$nfolio,$seccion,$hon_cantidad,$hon_cve_unidad,$hon_unidad,$hon_concepto,$hon_idTipoCta,$hon_cveProd,$hon_importe,$hon_iva,$hon_ret,$hon_valor);
      if (!($stmt_hon)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding hon [$stmt_hon->errno]: $stmt_hon->error";
        exit_script($system_callback);
      }

      if (!($stmt_hon->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution hon [$stmt_hon->errno]: $stmt_hon->error";
      }
    }
}


//DEPOSITOS ********************************************************************
if( $Total_Anticipos > 0 ){
    $seccion = 'depositos';
    $depositos = $_POST['depositos'];



    $query_depositos="INSERT INTO conta_t_notacredito_captura_det(fk_id_cuenta_captura_nc,s_tipoDetalle,n_noDeposito,n_total)
                                                        VALUES (?,?,?,?) ";

    $stmt_depositos = $db->prepare($query_depositos);
    if (!($stmt_depositos)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare anticipos [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    foreach ($depositos as $deposito) {
      $dep_id = $deposito['idDeposito'];
      $dep_importe = $deposito['importe'];


      $stmt_depositos->bind_param('ssss',$nfolio,$seccion,$dep_id,$dep_importe);
      if (!($stmt_depositos)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding hon [$stmt_depositos->errno]: $stmt_depositos->error";
        exit_script($system_callback);
      }

      if (!($stmt_depositos->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution hon [$stmt_depositos->errno]: $stmt_depositos->error";
      }
    }
}

?>
