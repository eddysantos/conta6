<?php

$query_consultaDeduc = "SELECT fk_id_deduccion, fk_id_cuenta, s_descripcion, n_ordenReporte, s_clasificacion
                         FROM conta_cs_sat_tipodeduccion_ctamst WHERE fk_id_regimen = ? ORDER BY n_ordenReporte";

$stmt_consultaDeduc = $db->prepare($query_consultaDeduc);
if (!($stmt_consultaDeduc)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare consultaDeduc [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_consultaDeduc->bind_param('s',$id_regimen);

if (!($stmt_consultaDeduc)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding consultaDeduc [$stmt_consultaDeduc->errno]: $stmt_consultaDeduc->error";
  exit_script($system_callback);
}

if (!($stmt_consultaDeduc->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution consultaDeduc [$stmt_consultaDeduc->errno]: $stmt_consultaDeduc->error";
  exit_script($system_callback);
}

$rslt_consultaDeduc = $stmt_consultaDeduc->get_result();

if ($rslt_consultaDeduc->num_rows > 0) {
  while ($row_consultaDeduc = $rslt_consultaDeduc->fetch_assoc()) {
    $ID_deduccion = $row_consultaDeduc['fk_id_deduccion'];
    $id_cuentaD = $row_consultaDeduc['fk_id_cuenta'];
    $descripcionD = $row_consultaDeduc['s_descripcion'];
    $ordenReporteD = $row_consultaDeduc['n_ordenReporte'];
    $clasificacionD = $row_consultaDeduc['s_clasificacion'];
    $tipoElementoD = 'deduccion';

    if( $descripcionD == 'IMSS' and $IMSS > 0 ){
          $query_genDeduc = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeExento,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?)";

          $stmt_genDeduc = $db->prepare($query_genDeduc);
          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query prepare genDeduc [$db->errno]: $db->error";
            exit_script($system_callback);
          }

          $stmt_genDeduc->bind_param('ssssssss',$id_docNomina,$tipoElementoD,$ID_deduccion,$id_cuentaD,$descripcionD,$IMSS,$ordenReporteD,$clasificacionD );

          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during variables binding genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }

          if (!($stmt_genDeduc->execute())) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query execution genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }
    }


    if( $descripcionD == 'INFONAVIT' and $INFONAVIT > 0 ){
          $query_genDeduc = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeExento,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?)";

          $stmt_genDeduc = $db->prepare($query_genDeduc);
          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query prepare genDeduc [$db->errno]: $db->error";
            exit_script($system_callback);
          }

          $stmt_genDeduc->bind_param('ssssssss',$id_docNomina,$tipoElementoD,$ID_deduccion,$id_cuentaD,$descripcionD,$INFONAVIT,$ordenReporteD,$clasificacionD );

          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during variables binding genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }

          if (!($stmt_genDeduc->execute())) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query execution genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }
    }


    if( $descripcionD == 'Descuentos prestamos fondo de ahorro' and $DFONDO > 0 ){
          $query_genDeduc = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeExento,n_descuento,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?,?)";

          $stmt_genDeduc = $db->prepare($query_genDeduc);
          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query prepare genDeduc [$db->errno]: $db->error";
            exit_script($system_callback);
          }

          $stmt_genDeduc->bind_param('sssssssss',$id_docNomina,$tipoElementoD,$ID_deduccion,$id_cuentaD,$descripcionD,$DFONDO,$DFONDO,$ordenReporteD,$clasificacionD );

          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during variables binding genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }

          if (!($stmt_genDeduc->execute())) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query execution genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }
    }


    if( $descripcionD == 'Descuentos 1' and $DESCUENTO_1 > 0 ){
          $query_genDeduc = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeExento,n_descuento,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?,?)";

          $stmt_genDeduc = $db->prepare($query_genDeduc);
          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query prepare genDeduc [$db->errno]: $db->error";
            exit_script($system_callback);
          }

          $stmt_genDeduc->bind_param('sssssssss',$id_docNomina,$tipoElementoD,$ID_deduccion,$id_cuentaD,$descripcionD,$DESCUENTO_1,$DESCUENTO_1,$ordenReporteD,$clasificacionD );

          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during variables binding genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }

          if (!($stmt_genDeduc->execute())) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query execution genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }
    }


    if( $descripcionD == 'Pago de abonos INFONACOT' and $DESC_FONACOT > 0 ){
          $query_genDeduc = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeExento,n_descuento,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?,?)";

          $stmt_genDeduc = $db->prepare($query_genDeduc);
          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query prepare genDeduc [$db->errno]: $db->error";
            exit_script($system_callback);
          }

          $stmt_genDeduc->bind_param('sssssssss',$id_docNomina,$tipoElementoD,$ID_deduccion,$id_cuentaD,$descripcionD,$DESC_FONACOT,$DESC_FONACOT,$ordenReporteD,$clasificacionD );

          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during variables binding genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }

          if (!($stmt_genDeduc->execute())) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query execution genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }
    }


    if( $descripcionD == 'Descuentos por prestamo' and $DESCUENTO_PRESTAMO > 0 ){
          $query_genDeduc = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeExento,n_descuento,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?,?)";

          $stmt_genDeduc = $db->prepare($query_genDeduc);
          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query prepare genDeduc [$db->errno]: $db->error";
            exit_script($system_callback);
          }

          $stmt_genDeduc->bind_param('sssssssss',$id_docNomina,$tipoElementoD,$ID_deduccion,$id_cuentaD,$descripcionD,$DESCUENTO_PRESTAMO,$DESCUENTO_PRESTAMO,$ordenReporteD,$clasificacionD );

          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during variables binding genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }

          if (!($stmt_genDeduc->execute())) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query execution genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }
    }


    if( $descripcionD == 'ISPT' and $ISPT > 0 ){
          $query_genDeduc = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeGravado,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?)";

          $stmt_genDeduc = $db->prepare($query_genDeduc);
          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query prepare genDeduc [$db->errno]: $db->error";
            exit_script($system_callback);
          }

          $stmt_genDeduc->bind_param('ssssssss',$id_docNomina,$tipoElementoD,$ID_deduccion,$id_cuentaD,$descripcionD,$ISPT,$ordenReporteD,$clasificacionD );

          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during variables binding genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }

          if (!($stmt_genDeduc->execute())) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query execution genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }
    }


    if( $descripcionD == 'Renta' and $DESC_RENTA > 0 ){
          $query_genDeduc = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeGravado,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?)";

          $stmt_genDeduc = $db->prepare($query_genDeduc);
          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query prepare genDeduc [$db->errno]: $db->error";
            exit_script($system_callback);
          }

          $stmt_genDeduc->bind_param('ssssssss',$id_docNomina,$tipoElementoD,$ID_deduccion,$id_cuentaD,$descripcionD,$DESC_RENTA,$ordenReporteD,$clasificacionD );

          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during variables binding genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }

          if (!($stmt_genDeduc->execute())) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query execution genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }
    }


    if( $descripcionD == 'Pension Alimenticia' and $DESC_PENSIONALIMEN > 0 ){
          $descripcionD = $descripcionD.' '.number_format(($DESC_PENSIONALIMEN_PORCENT * 100),0,'.','').'%';
          $descripcionD = substr($descripcionD,0,100);
          $query_genDeduc = "INSERT INTO conta_t_nom_captura_det (fk_id_docNomina,s_tipoElemento,fk_claveSAT,fk_id_cuenta,s_concepto,n_importeExento,n_base,n_porcentaje,n_descuento,n_ordenReporte,s_clasificacion )VALUES (?,?,?,?,?,?,?,?,?,?,?)";

          $stmt_genDeduc = $db->prepare($query_genDeduc);
          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query prepare genDeduc [$db->errno]: $db->error";
            exit_script($system_callback);
          }

          $stmt_genDeduc->bind_param('sssssssssss',$id_docNomina,$tipoElementoD,$ID_deduccion,$id_cuentaD,$descripcionD,$DESC_PENSIONALIMEN,$BASE,$DESC_PENSIONALIMEN_PORCENT,$DESC_PENSIONALIMEN,$ordenReporteD,$clasificacionD );

          if (!($stmt_genDeduc)) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during variables binding genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }

          if (!($stmt_genDeduc->execute())) {
            $system_callback['code'] = "500";
            $system_callback['message'] = "Error during query execution genDeduc [$stmt_genDeduc->errno]: $stmt_genDeduc->error";
            exit_script($system_callback);
          }
    }




  }
}

?>
