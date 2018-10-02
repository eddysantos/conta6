<?PHP
$nfolio = trim($_POST['folio']);

//DATOS GENERALES DEL EMBARQUE ******************************************
    $seccion = 'dge';
    $dges = $_POST['dge'];

    $query_DGE="UPDATE conta_t_facturas_captura_det SET s_conceptoEsp = ?, s_descripcion = ?
                      WHERE pk_id_partida = ?";

    $stmt_DGE = $db->prepare($query_DGE);
    if (!($stmt_DGE)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare DGE [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    foreach ($dges as $dge) {
      $DGE_concepto = utf8_decode($dge['concepto_esp']);
      $DGE_desc = utf8_decode($dge['descripcion']);
      $DGE_idpartida = $dge['idpartida'];

      $stmt_DGE->bind_param('sss',$DGE_concepto,$DGE_desc,$DGE_idpartida);
      if (!($stmt_DGE)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding DGE [$stmt_DGE->errno]: $stmt_DGE->error";
        exit_script($system_callback);
      }

      if (!($stmt_DGE->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution DGE [$stmt_DGE->errno]: $stmt_DGE->error";
      }
    }




//PAGOS O COBROS EN MONEDA EXTRANJERA ******************************************
if( $Total_POCME > 0 ){
    $seccion = 'POCME';
    $pocmes = $_POST['pocme'];

    foreach ($pocmes as $pocme) {
      $POCME_cantidad = $pocme['cantidad'];
      $POCME_idTipoCta = $pocme['idcuenta'];
      $POCME_concepto = utf8_decode($pocme['concepto_esp']);
      $POCME_conceptoEng = $pocme['concepto_ing'];
      $POCME_desc = utf8_decode($pocme['descripcion']);
      $POCME_importe = $pocme['importe'];
      $POCME_valor = $pocme['subtotal'];
      $POCME_idConcep = $pocme['idconcepto'];
      $POCME_idpartida = $pocme['idpartida'];

      if( $POCME_idpartida > 0 ){
        $query_POCME="UPDATE conta_t_facturas_captura_det SET
                                                              n_cantidad = ?,
                                                              fk_id_cuenta = ?,
                                                              s_conceptoEsp = ?,
                                                              s_conceptoEnglish = ?,
                                                              s_descripcion = ?,
                                                              n_importe = ?,
                                                              n_total = ?,
                                                              fk_id_concepto = ?
                        WHERE pk_id_partida = ?";

        $stmt_POCME = $db->prepare($query_POCME);
        if (!($stmt_POCME)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query prepare POCME [$db->errno]: $db->error";
          exit_script($system_callback);
        }

        $stmt_POCME->bind_param('sssssssss',$POCME_cantidad,$POCME_idTipoCta,$POCME_concepto,$POCME_conceptoEng,$POCME_desc,$POCME_importe,$POCME_valor,$POCME_idConcep,$POCME_idpartida);
        if (!($stmt_POCME)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during variables binding POCME [$stmt_POCME->errno]: $stmt_POCME->error";
          exit_script($system_callback);
        }
      }else{
        $query_POCME="INSERT INTO conta_t_facturas_captura_det(fk_id_cuenta_captura,s_tipoDetalle,n_cantidad,fk_id_cuenta,s_conceptoEsp,s_conceptoEnglish,s_descripcion,n_importe,n_total,fk_id_concepto)
                            VALUES (?,?,?,?,?,?,?,?,?,?)";

        $stmt_POCME = $db->prepare($query_POCME);
        if (!($stmt_POCME)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query prepare POCME [$db->errno]: $db->error";
          exit_script($system_callback);
        }
        $stmt_POCME->bind_param('ssssssssss',$nfolio,$seccion,$POCME_cantidad,$POCME_idTipoCta,$POCME_concepto,$POCME_conceptoEng,$POCME_desc,$POCME_importe,$POCME_valor,$POCME_idConcep);
        if (!($stmt_POCME)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during variables binding POCME [$stmt_POCME->errno]: $stmt_POCME->error";
          exit_script($system_callback);
        }

      }

      if (!($stmt_POCME->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution POCME [$stmt_POCME->errno]: $stmt_POCME->error";
      }

    }
}

    #BORRAR
    $pocmesDelete = $_POST['pocmeDelete'];

    $query_POCMEdelete="DELETE FROM conta_t_facturas_captura_det WHERE pk_id_partida = ?";

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

//PAGOS REALIZADOS POR SU CUENTA ***********************************************
if( $Total_Pagos <> 0 ){
    $seccion = 'cargos';
    $cargos = $_POST['cargos'];

    foreach ($cargos as $cargo) {
      $cargo_idTipoCta = $cargo['idcuenta'];
      $cargo_idConcep = $cargo['idconcepto'];
      $cargo_concepto = utf8_decode($cargo['concepto_esp']);
      $cargo_valor = $cargo['subtotal'];
      $cargo_idpartida = $cargo['idpartida'];

      if( $cargo_idpartida > 0 ){
        $query_cargos="UPDATE conta_t_facturas_captura_det SET
                                                              fk_id_concepto = ?,
                                                              fk_id_cuenta = ?,
                                                              s_conceptoEsp = ?,
                                                              n_total = ?
                        WHERE pk_id_partida = ?";

        $stmt_cargos = $db->prepare($query_cargos);
        if (!($stmt_cargos)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query prepare cargos [$db->errno]: $db->error";
          exit_script($system_callback);
        }

        $stmt_cargos->bind_param('sssss',$cargo_idConcep,$cargo_idTipoCta,$cargo_concepto,$cargo_valor,$cargo_idpartida);
        if (!($stmt_cargos)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during variables binding cargos [$stmt_cargos->errno]: $stmt_cargos->error";
          exit_script($system_callback);
        }
      }else{
        $query_cargos="INSERT INTO conta_t_facturas_captura_det(fk_id_cuenta_captura,s_tipoDetalle,fk_id_concepto,fk_id_cuenta,s_conceptoEsp,n_total)
                                                        VALUES (?,?,?,?,?,?) ";

        $stmt_cargos = $db->prepare($query_cargos);
        if (!($stmt_cargos)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query prepare cargos [$db->errno]: $db->error";
          exit_script($system_callback);
        }

        $stmt_cargos->bind_param('ssssss',$nfolio,$seccion,$cargo_idConcep,$cargo_idTipoCta,$cargo_concepto,$cargo_valor);
        if (!($stmt_cargos)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during variables binding cargos [$stmt_cargos->errno]: $stmt_cargos->error";
          exit_script($system_callback);
        }
      }

      if (!($stmt_cargos->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution cargos [$stmt_cargos->errno]: $stmt_cargos->error";
      }
    }

}

    #BORRAR
    $cargosDelete = $_POST['cargoDelete'];

    $query_cargodelete="DELETE FROM conta_t_facturas_captura_det WHERE pk_id_partida = ?";

    $stmt_cargodelete = $db->prepare($query_cargodelete);
    if (!($stmt_cargodelete)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare cargo delete [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    foreach ($cargosDelete as $cargoD) {
      $cargo_idpartida = $cargoD['idpartida'];

      $stmt_cargodelete->bind_param('s',$cargo_idpartida);
      if (!($stmt_cargodelete)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding cargo delete [$stmt_cargodelete->errno]: $stmt_cargodelete->error";
        exit_script($system_callback);
      }

      if (!($stmt_cargodelete->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution cargo delete [$stmt_cargodelete->errno]: $stmt_cargodelete->error";
      }

    }

//HONORARIOS Y SERVICIOS *******************************************************
if( $Total_Gral_Importe > 0 ){
  $seccion = 'honorarios';
  $honorarios = $_POST['honorarios'];

  foreach ($honorarios as $hon) {
      $hon_idTipoCta = $hon['idcuenta'];
      $hon_cveProd = $hon['idcveprod'];
      $hon_concepto = utf8_decode($hon['concepto_esp']);
      $hon_importe = $hon['importe'];
      $hon_iva = $hon['iva'];
      $hon_ret = $hon['ret'];
      $hon_valor = $hon['subtotal'];
      $hon_idpartida = $hon['idpartida'];

      if( $hon_idpartida > 0 ){
        if( $hon_idTipoCta == '0400-00001' ){
          $query_hon="UPDATE conta_t_facturas_captura_det SET    s_conceptoEsp = ?,
                                                                  fk_id_cuenta = ?,
                                                                  fk_c_ClaveProdServ = ?,
                                                                  n_importe = ?,
                                                                  n_IVA = ?,
                                                                  n_ret = ?,
                                                                  n_total = ?,
                                                                  n_porcentaje = ?,
                                                                  n_base = ?,
                                                                  n_descuento = ?
                            WHERE pk_id_partida = ?";

            $stmt_hon = $db->prepare($query_hon);
            if (!($stmt_hon)) {
              $system_callback['code'] = "500";
              $system_callback['message'] = "Error during query prepare hon [$db->errno]: $db->error";
              exit_script($system_callback);
            }

            $stmt_hon->bind_param('sssssssssss',$hon_concepto,$hon_idTipoCta,$hon_cveProd,$hon_importe,$hon_iva,$hon_ret,$hon_valor,
                                               $Honorarios_Porcentaje,$Honorarios_Base_Honorarios,$Honorarios_Descuento,$hon_idpartida);
            if (!($stmt_hon)) {
              $system_callback['code'] = "500";
              $system_callback['message'] = "Error during variables binding hon [$stmt_hon->errno]: $stmt_hon->error";
              exit_script($system_callback);
            }
        }else{
          $query_hon="UPDATE conta_t_facturas_captura_det set      s_conceptoEsp = ?,
                                                                    fk_id_cuenta = ?,
                                                                    fk_c_ClaveProdServ = ?,
                                                                    n_importe = ?,
                                                                    n_IVA = ?,
                                                                    n_ret = ?,
                                                                    n_total = ?
                      WHERE pk_id_partida = ?";

            $stmt_hon = $db->prepare($query_hon);
            if (!($stmt_hon)) {
              $system_callback['code'] = "500";
              $system_callback['message'] = "Error during query prepare hon [$db->errno]: $db->error";
              exit_script($system_callback);
            }
            $stmt_hon->bind_param('ssssssss',$hon_concepto,$hon_idTipoCta,$hon_cveProd,$hon_importe,$hon_iva,$hon_ret,$hon_valor,$hon_idpartida);
            if (!($stmt_hon)) {
              $system_callback['code'] = "500";
              $system_callback['message'] = "Error during variables binding hon [$stmt_hon->errno]: $stmt_hon->error";
              exit_script($system_callback);
            }

        }
      }else{
        $hon_cantidad = '1';
        $hon_cve_unidad = 'E48';
        $hon_unidad = 'Servicio';

        $query_hon="INSERT INTO conta_t_facturas_captura_det( fk_id_cuenta_captura,
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

          $stmt_hon->bind_param('ssssssssssss',$nfolio,$seccion,$hon_cantidad,$hon_cve_unidad,$hon_unidad,$hon_concepto,$hon_idTipoCta,$hon_cveProd,$hon_importe,$hon_iva,$hon_ret,$hon_valor);
          if (!($stmt_hon)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during variables binding hon [$stmt_hon->errno]: $stmt_hon->error";
            exit_script($system_callback);
          }
      }
      if (!($stmt_hon->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution hon [$stmt_hon->errno]: $stmt_hon->error";
      }
  }
}

    #BORRAR
    $honsDelete = $_POST['honDelete'];

    $query_hondelete="DELETE FROM conta_t_facturas_captura_det WHERE pk_id_partida = ?";

    $stmt_hondelete = $db->prepare($query_hondelete);
    if (!($stmt_hondelete)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare hon delete [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    foreach ($honsDelete as $honD) {
      $hon_idpartida = $honD['idpartida'];

      $stmt_hondelete->bind_param('s',$hon_idpartida);
      if (!($stmt_hondelete)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding hon delete [$stmt_hondelete->errno]: $stmt_hondelete->error";
        exit_script($system_callback);
      }

      if (!($stmt_hondelete->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution hon delete [$stmt_hondelete->errno]: $stmt_hondelete->error";
      }

    }

//DEPOSITOS *******************************************************
    if( $Total_Anticipos > 0 ){
        $seccion = 'depositos';
        $depositos = $_POST['depositos'];

        $query_depositos="INSERT INTO conta_t_facturas_captura_det(fk_id_cuenta_captura,s_tipoDetalle,n_noDeposito,n_total)
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
          $dep_idpartida = $deposito['idpartida'];

          if( $dep_idpartida == 0 || $dep_idpartida == "" ){
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
    }



    #BORRAR
    $depositosDelete = $_POST['depositosDisponibles'];

    $query_depositosdelete="DELETE FROM conta_t_facturas_captura_det WHERE pk_id_partida = ?";

    $stmt_depositosdelete = $db->prepare($query_depositosdelete);
    if (!($stmt_depositosdelete)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare depositos delete [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    foreach ($depositosDelete as $depositosD) {
      $depositos_idpartida = $depositosD['idpartida'];
      if( $depositos_idpartida > 0 ){
        $stmt_depositosdelete->bind_param('s',$depositos_idpartida);
        if (!($stmt_depositosdelete)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during variables binding depositos delete [$stmt_depositosdelete->errno]: $stmt_depositosdelete->error";
          exit_script($system_callback);
        }

        if (!($stmt_depositosdelete->execute())) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query execution depositos delete [$stmt_depositosdelete->errno]: $stmt_depositosdelete->error";
        }
      }
    }
?>
