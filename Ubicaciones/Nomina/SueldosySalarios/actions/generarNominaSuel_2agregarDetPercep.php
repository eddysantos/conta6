<?php

$query_consultaPercep = "SELECT fk_id_percepcion, fk_id_cuenta, s_descripcion, n_ordenReporte, s_clasificacion
                         FROM conta_cs_nom_tipopercepcion_ctamst WHERE fk_id_regimen = ? ORDER BY n_ordenReporte";

$stmt_consultaPercep = $db->prepare($query_consultaPercep);
if (!($stmt_consultaPercep)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare consultaPercep [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_consultaPercep->bind_param('s',$id_regimen);

if (!($stmt_consultaPercep)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding consultaPercep [$stmt_consultaPercep->errno]: $stmt_consultaPercep->error";
  exit_script($system_callback);
}

if (!($stmt_consultaPercep->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution consultaPercep [$stmt_consultaPercep->errno]: $stmt_consultaPercep->error";
  exit_script($system_callback);
}

$rslt_consultaPercep = $stmt_consultaPercep->get_result();

if ($rslt_consultaPercep->num_rows > 0) {
  while ($row_consultaPercep = $rslt_consultaPercep->fetch_assoc()) {
    $ID_percepcion = $row_consultaPercep['fk_id_percepcion'];
    $id_cuentaP = $row_consultaPercep['fk_id_cuenta'];
    $descripcionP = $row_consultaPercep['s_descripcion'];
    $ordenReporteP = $row_consultaPercep['n_ordenReporte'];
    $clasificacionP = $row_consultaPercep['s_clasificacion'];
    $tipoElementoP = 'percepcion';


    if( $descripcionP == 'Sueldo' and $SALARIO_SEMANAL > 0 ){
      $query_genPer = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeGravado,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?)";
      $stmt_genPer = $db->prepare($query_genPer);
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare genPer [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmt_genPer->bind_param('ssssssss',$id_docNomina,$tipoElementoP,$ID_percepcion,$id_cuentaP,$descripcionP,$SALARIO_SEMANAL,$ordenReporteP,$clasificacionP );
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
      if (!($stmt_genPer->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
    }


    if( $descripcionP == 'Premio de puntualidad' and $PCOMPENSA > 0 ){
        $query_genPer = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeGravado,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?)";
        $stmt_genPer = $db->prepare($query_genPer);
        if (!($stmt_genPer)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query prepare genPer [$db->errno]: $db->error";
          exit_script($system_callback);
        }
        $stmt_genPer->bind_param('ssssssss',$id_docNomina,$tipoElementoP,$ID_percepcion,$id_cuentaP,$descripcionP,$PCOMPENSA,$ordenReporteP,$clasificacionP );
        if (!($stmt_genPer)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during variables binding genPer [$stmt_genPer->errno]: $stmt_genPer->error";
          exit_script($system_callback);
        }
        if (!($stmt_genPer->execute())) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query execution genPer [$stmt_genPer->errno]: $stmt_genPer->error";
          exit_script($system_callback);
        }
		}


    if( $descripcionP == 'Premio de asistencia' and $PREMIO_ASISTENCIA > 0 ){
        $query_genPer = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeGravado,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?)";
        $stmt_genPer = $db->prepare($query_genPer);
        if (!($stmt_genPer)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query prepare genPer [$db->errno]: $db->error";
          exit_script($system_callback);
        }
        $stmt_genPer->bind_param('ssssssss',$id_docNomina,$tipoElementoP,$ID_percepcion,$id_cuentaP,$descripcionP,$PREMIO_ASISTENCIA,$ordenReporteP,$clasificacionP );
        if (!($stmt_genPer)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during variables binding genPer [$stmt_genPer->errno]: $stmt_genPer->error";
          exit_script($system_callback);
        }
        if (!($stmt_genPer->execute())) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query execution genPer [$stmt_genPer->errno]: $stmt_genPer->error";
          exit_script($system_callback);
        }
    }

    if( $descripcionP == 'Vales de despensa' and $VALES_DESPENSA > 0 ){ # 2018-Abr-03 evillegas se envia a exento
      $query_genPer = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeExento,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?)";
      $stmt_genPer = $db->prepare($query_genPer);
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare genPer [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmt_genPer->bind_param('ssssssss',$id_docNomina,$tipoElementoP,$ID_percepcion,$id_cuentaP,$descripcionP,$VALES_DESPENSA,$ordenReporteP,$clasificacionP );
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
      if (!($stmt_genPer->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
    }


    if( $descripcionP == 'Ayuda de renta' and $AYUDA_RENTA > 0 ){
      $query_genPer = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeGravado,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?)";
      $stmt_genPer = $db->prepare($query_genPer);
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare genPer [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmt_genPer->bind_param('ssssssss',$id_docNomina,$tipoElementoP,$ID_percepcion,$id_cuentaP,$descripcionP,$AYUDA_RENTA,$ordenReporteP,$clasificacionP );
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
      if (!($stmt_genPer->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
    }


    if( $descripcionP == 'Vacaciones' and $PVACACIONES > 0 ){
      $query_genPer = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeGravado,n_dias_vacaciones,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?,?)";
      $stmt_genPer = $db->prepare($query_genPer);
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare genPer [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmt_genPer->bind_param('sssssssss',$id_docNomina,$tipoElementoP,$ID_percepcion,$id_cuentaP,$descripcionP,$PVACACIONES,$DIAS_VACACIONES,$ordenReporteP,$clasificacionP );
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
      if (!($stmt_genPer->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
    }


    if( $descripcionP == 'Prima vacacional' and $PRIMA_VACIONES > 0 ){
      $query_genPer = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeGravado,n_PprimVacE,n_PprimVacG,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?,?,?)";
      $stmt_genPer = $db->prepare($query_genPer);
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare genPer [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmt_genPer->bind_param('ssssssssss',$id_docNomina,$tipoElementoP,$ID_percepcion,$id_cuentaP,$descripcionP,$PRIMA_VACIONES,$PRIMA_VACIONES_E,$PRIMA_VACIONES_G,$ordenReporteP,$clasificacionP);
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
      if (!($stmt_genPer->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
    }


    if( $descripcionP == 'Compensacion' and $GRATIF3 > 0 ){
      $query_genPer = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeGravado,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?)";
      $stmt_genPer = $db->prepare($query_genPer);
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare genPer [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmt_genPer->bind_param('ssssssss',$id_docNomina,$tipoElementoP,$ID_percepcion,$id_cuentaP,$descripcionP,$GRATIF3,$ordenReporteP,$clasificacionP );
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
      if (!($stmt_genPer->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
    }


    if( $descripcionP == 'Prestamo' and $PRESTAMO > 0 ){
      $query_genPer = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeExento,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?)";
      $stmt_genPer = $db->prepare($query_genPer);
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare genPer [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmt_genPer->bind_param('ssssssss',$id_docNomina,$tipoElementoP,$ID_percepcion,$id_cuentaP,$descripcionP,$PRESTAMO,$ordenReporteP,$clasificacionP );
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
      if (!($stmt_genPer->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
    }

    if( $descripcionP == 'Dobles' and $hrsExtra_dobles_pgo > 0 ){
      $tipoElementoP = 'horasExtras';
      $tipoHoras = '01';
      $query_genPer = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,
                                                            s_tipoHoras,n_dias_horasExtra,n_horasExtra,n_importeGravado,
                                                            n_importeExento,n_importePagado,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $stmt_genPer = $db->prepare($query_genPer);
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare genPer [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmt_genPer->bind_param('sssssssssssss',$id_docNomina,$tipoElementoP,$ID_percepcion,$id_cuentaP,$descripcionP,
                                               $tipoHoras,$hrsExtra_dobles_dias,$hrsExtra_dobles,$hrsExtra_dobles_pgoG,
                                               $hrsExtra_dobles_pgoE,$hrsExtra_dobles_pgo,$ordenReporteP,$clasificacionP );
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
      if (!($stmt_genPer->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
    }


    if( $descripcionP == 'Triples' and $hrsExtra_triples_pgo > 0 ){
      $tipoElementoP = 'horasExtras';
      $tipoHoras = '02';
      $query_genPer = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,
                                                            s_tipoHoras,n_dias_horasExtra,n_horasExtra,n_importeGravado,
                                                            n_importePagado,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
      $stmt_genPer = $db->prepare($query_genPer);
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare genPer [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmt_genPer->bind_param('ssssssssssss',$id_docNomina,$tipoElementoP,$ID_percepcion,$id_cuentaP,$descripcionP,
                                               $tipoHoras,$hrsExtra_triples_dias,$hrsExtra_triples,$hrsExtra_triples_pgo,
                                               $hrsExtra_triples_pgo,$ordenReporteP,$clasificacionP );
      if (!($stmt_genPer)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
      if (!($stmt_genPer->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution genPer [$stmt_genPer->errno]: $stmt_genPer->error";
        exit_script($system_callback);
      }
    }



  }
}

?>
