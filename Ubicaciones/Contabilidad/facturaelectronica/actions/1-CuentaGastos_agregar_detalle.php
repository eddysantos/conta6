<?PHP

//DATOS DEL EMBARQUE
$seccion = 'DatGnEmbarq';
$query_DatGnEmbarq="INSERT INTO conta_t_facturas_captura_det(fk_id_cuenta_captura,s_tipoDetalle,s_conceptoEsp,s_descripcion)
                                                    VALUES($nfolio,'$seccion','$IGET_0','$IGED_0'),
                                                          ($nfolio,'$seccion','$IGET_1','$IGED_1'),
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







if( $Total_POCME > 0 ){
    //PAGOS O COBROS EN MONEDA EXTRANJERA
    $seccion = 'POCME';
    if( $POCME_Total_Gral > 0 ){

      $concepPOCME = '';

      if( $POCME_concepto1 <> "" && $POCME_valor1 > 0 ){
        $concepPOCME .= "(".$nfolio.",'".$seccion."',".$POCME_cantidad1.",'".$POCME_idTipoCta1."','".$POCME_concepto1."','".$POCME_conceptoEng1."','".$POCME_desc1."',".$POCME_importe1.",".$POCME_valor1."),";
      }
      if( $POCME_concepto2 <> "" && $POCME_valor2 > 0 ){
        $concepPOCME .= "(".$nfolio.",'".$seccion."',".$POCME_cantidad2.",'".$POCME_idTipoCta2."','".$POCME_concepto2."','".$POCME_conceptoEng2."','".$POCME_desc2."',".$POCME_importe2.",".$POCME_valor2."),";
      }
      if( $POCME_concepto3 <> "" && $POCME_valor3 > 0 ){
        $concepPOCME .= "(".$nfolio.",'".$seccion."',".$POCME_cantidad3.",'".$POCME_idTipoCta3."','".$POCME_concepto3."','".$POCME_conceptoEng3."','".$POCME_desc3."',".$POCME_importe3.",".$POCME_valor3."),";
      }
      if( $POCME_concepto4 <> "" && $POCME_valor4 > 0 ){
        $concepPOCME .= "(".$nfolio.",'".$seccion."',".$POCME_cantidad4.",'".$POCME_idTipoCta4."','".$POCME_concepto4."','".$POCME_conceptoEng4."','".$POCME_desc4."',".$POCME_importe4.",".$POCME_valor4."),";
      }
      if( $POCME_concepto5 <> "" && $POCME_valor5 > 0 ){
        $concepPOCME .= "(".$nfolio.",'".$seccion."',".$POCME_cantidad5.",'".$POCME_idTipoCta5."','".$POCME_concepto5."','".$POCME_conceptoEng5."','".$POCME_desc5."',".$POCME_importe5.",".$POCME_valor5."),";
      }
      if( $POCME_concepto6 <> "" && $POCME_valor6 > 0 ){
        $concepPOCME .= "(".$nfolio.",'".$seccion."',".$POCME_cantidad6.",'".$POCME_idTipoCta6."','".$POCME_concepto6."','".$POCME_conceptoEng6."','".$POCME_desc6."',".$POCME_importe6.",".$POCME_valor6."),";
      }
      if( $POCME_concepto7 <> "" && $POCME_valor7 > 0 ){
        $concepPOCME .= "(".$nfolio.",'".$seccion."',".$POCME_cantidad7.",'".$POCME_idTipoCta7."','".$POCME_concepto7."','".$POCME_conceptoEng7."','".$POCME_desc7."',".$POCME_importe7.",".$POCME_valor7."),";
      }
      if( $POCME_concepto8 <> "" && $POCME_valor8 > 0 ){
        $concepPOCME .= "(".$nfolio.",'".$seccion."',".$POCME_cantidad8.",'".$POCME_idTipoCta8."','".$POCME_concepto8."','".$POCME_conceptoEng8."','".$POCME_desc8."',".$POCME_importe8.",".$POCME_valor8."),";
      }
      $concepPOCME = rtrim($concepPOCME,',');

      $query_POCME="INSERT INTO conta_t_facturas_captura_det(fk_id_cuenta_captura,s_tipoDetalle,n_cantidad,fk_id_concepto,s_conceptoEsp,s_conceptoEnglish,s_descripcion,n_importe,n_total)                VALUES $concepPOCME";

      $stmt_POCME = $db->prepare($query_POCME);
      if (!($stmt_POCME)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare POCME [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      if (!($stmt_POCME->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution POCME [$stmt_POCME->errno]: $stmt_DatGnEmbarq->error";
      }
    }
}



if( $Total_Pagos <> 0 ){
    //PAGOS REALIZADOS POR SU CUENTA
    $seccion = 'cargos';
    $conceptosCargos = '';

    $conceptosCargos .= "(".$nfolio.",'".$seccion."','Impuestos Afianzados o Subsidiados',".$Total_Subsidiado."),";
    $conceptosCargos .= "(".$nfolio.",'".$seccion."','Impuestos y/o derechos pagados o garantizados al Com. Ext.',".$Cargo_Total_1."),";

    if( $Cargo_Desc_2 <> '' && $Cargo_Total_2 > 0){
      $conceptosCargos .= "(".$nfolio.",'".$seccion."','".$Cargo_Desc_2."',".$Cargo_Total_2."),";
    }
    if( $Cargo_Desc_3 <> '' && $Cargo_Total_3 > 0){
      $conceptosCargos .= "(".$nfolio.",'".$seccion."','".$Cargo_Desc_3."',".$Cargo_Total_3."),";
    }
    if( $Cargo_Desc_4 <> '' && $Cargo_Total_4 > 0){
      $conceptosCargos .= "(".$nfolio.",'".$seccion."','".$Cargo_Desc_4."',".$Cargo_Total_4."),";
    }
    if( $Cargo_Desc_5 <> '' && $Cargo_Total_5 > 0){
      $conceptosCargos .= "(".$nfolio.",'".$seccion."','".$Cargo_Desc_5."',".$Cargo_Total_5."),";
    }
    if( $Cargo_Desc_6 <> '' && $Cargo_Total_6 > 0){
      $conceptosCargos .= "(".$nfolio.",'".$seccion."','".$Cargo_Desc_6."',".$Cargo_Total_6."),";
    }
    if( $Cargo_Desc_7 <> '' && $Cargo_Total_7 > 0){
      $conceptosCargos .= "(".$nfolio.",'".$seccion."','".$Cargo_Desc_7."',".$Cargo_Total_7."),";
    }
    if( $Cargo_Desc_8 <> '' && $Cargo_Total_8 > 0){
      $conceptosCargos .= "(".$nfolio.",'".$seccion."','".$Cargo_Desc_8."',".$Cargo_Total_8."),";
    }

    $conceptosCargos = rtrim($conceptosCargos,',');
    $query_cargos="INSERT INTO conta_t_facturas_captura_det(fk_id_cuenta_captura,s_tipoDetalle,s_conceptoEsp,n_total)
                                                        VALUES $conceptosCargos ";

    $stmt_cargos = $db->prepare($query_cargos);
    if (!($stmt_cargos)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare cargos [$db->errno]: $db->error";
      exit_script($system_callback);
    }
    if (!($stmt_cargos->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution cargos [$stmt_cargos->errno]: $stmt_cargos->error";
    }
}



if( $Total_Gral_Importe > 0 ){
    //HONORARIOS Y SERVICIOS
    $seccion = 'honorarios';

    $query_hon1="INSERT INTO conta_t_facturas_captura_det(  fk_id_cuenta_captura,
                                                            s_tipoDetalle,
                                                            n_cantidad,
                                                            fk_c_claveUnidad,
                                                            s_Unidad,
                                                            n_porcentaje,
                                                            s_conceptoEsp,
                                                            n_base,
                                                            n_descuento,
                                                            s_descripcion,
                                                            fk_id_cuenta,
                                                            fk_c_ClaveProdServ,
                                                            n_importe,
                                                            n_IVA,
                                                            n_ret,
                                                            n_total)
                                                    VALUES( $nfolio,
                                                            '$seccion',
                                                            1,
                                                            'E48',
                                                            'Servicio',
                                                            $Porcentaje_Descuento,
                                                            '$Honorarios_Txt',
                                                            $Honorarios_Base,
                                                            $Porcentaje_Descuento,
                                                            '$Descuento_Txt',
                                                            '$noIdentificacion0',
                                                            '$c_claveprodserv0',
                                                            $Honorarios_Importe,
                                                            $Honorarios_Iva,
                                                            $Honorarios_ret,
                                                            $Honorarios_Total)";

    $stmt_hon1 = $db->prepare($query_hon1);
    if (!($stmt_hon1)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare hon1 [$db->errno]: $db->error";
      exit_script($system_callback);
    }
    if (!($stmt_hon1->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution hon1 [$stmt_hon1->errno]: $stmt_hon1->error";
    }



    $conceptosHon = "";
    if( $Honorarios_Desc_1 <> '' && $Honorarios_Total_1 <> 0 ){
      $conceptosHon .= "(".$nfolio.",'".$seccion."',1,'E48','Servicio','".$Honorarios_Desc_1."','".$noIdentificacion1."','".$c_claveprodserv1."',".$Honorarios_Importe_1.",".$Honorarios_Iva_1.",".$Honorarios_ret_1.",".$Honorarios_Total_1."),";
    }
    if( $Honorarios_Desc_2 <> '' && $Honorarios_Total_2 <> 0 ){
      $conceptosHon .= "(".$nfolio.",'".$seccion."',1,'E48','Servicio','".$Honorarios_Desc_2."','".$noIdentificacion2."','".$c_claveprodserv2."',".$Honorarios_Importe_2.",".$Honorarios_Iva_2.",".$Honorarios_ret_2.",".$Honorarios_Total_2."),";
    }

    if( $Honorarios_Desc_3 <> '' && $Honorarios_Total_3 <> 0 ){
      $conceptosHon .= "(".$nfolio.",'".$seccion."',1,'E48','Servicio','".$Honorarios_Desc_3."','".$noIdentificacion3."','".$c_claveprodserv3."',".$Honorarios_Importe_3.",".$Honorarios_Iva_3.",".$Honorarios_ret_3.",".$Honorarios_Total_3."),";
    }

    if( $Honorarios_Desc_4 <> '' && $Honorarios_Total_4 <> 0 ){
      $conceptosHon .= "(".$nfolio.",'".$seccion."',1,'E48','Servicio','".$Honorarios_Desc_4."','".$noIdentificacion4."','".$c_claveprodserv4."',".$Honorarios_Importe_4.",".$Honorarios_Iva_4.",".$Honorarios_ret_4.",".$Honorarios_Total_4."),";
    }
    if( $Honorarios_Desc_5 <> '' && $Honorarios_Total_5 <> 0 ){
      $conceptosHon .= "(".$nfolio.",'".$seccion."',1,'E48','Servicio','".$Honorarios_Desc_5."','".$noIdentificacion5."','".$c_claveprodserv5."',".$Honorarios_Importe_5.",".$Honorarios_Iva_5.",".$Honorarios_ret_5.",".$Honorarios_Total_5."),";
    }
    if( $Honorarios_Desc_6 <> '' && $Honorarios_Total_6 <> 0 ){
      $conceptosHon .= "(".$nfolio.",'".$seccion."',1,'E48','Servicio','".$Honorarios_Desc_6."','".$noIdentificacion6."','".$c_claveprodserv6."',".$Honorarios_Importe_6.",".$Honorarios_Iva_6.",".$Honorarios_ret_6.",".$Honorarios_Total_6."),";
    }
    if( $Honorarios_Desc_7 <> '' && $Honorarios_Total_7 <> 0 ){
      $conceptosHon .= "(".$nfolio.",'".$seccion."',1,'E48','Servicio','".$Honorarios_Desc_7."','".$noIdentificacion7."','".$c_claveprodserv7."',".$Honorarios_Importe_7.",".$Honorarios_Iva_7.",".$Honorarios_ret_7.",".$Honorarios_Total_7."),";
    }
    if( $Honorarios_Desc_8 <> '' && $Honorarios_Total_8 <> 0 ){
      $conceptosHon .= "(".$nfolio.",'".$seccion."',1,'E48','Servicio','".$Honorarios_Desc_8."','".$noIdentificacion8."','".$c_claveprodserv8."',".$Honorarios_Importe_8.",".$Honorarios_Iva_8.",".$Honorarios_ret_8.",".$Honorarios_Total_8."),";
    }

    $query_hon="INSERT INTO conta_t_facturas_captura_det(  fk_id_cuenta_captura,
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
                                                    VALUES $conceptosHon";

    $query_hon = rtrim($query_hon,',');
    $stmt_hon = $db->prepare($query_hon);
    if (!($stmt_hon)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare hon [$db->errno]: $db->error";
      exit_script($system_callback);
    }
    if (!($stmt_hon->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution hon [$stmt_hon->errno]: $stmt_hon->error";
    }
}





if( $Total_Anticipos > 0 ){
    //ANTICIPOS
    $seccion = 'anticipos';
    $conceptosAnticipos = '';

    if( $No_Anticipo_1 <> '' && $Val_Anticipo_1 > 0){
      $conceptosAnticipos .= "(".$nfolio.",'".$seccion."',".$No_Anticipo_1.",".$Val_Anticipo_1."),";
    }
    if( $No_Anticipo_2 <> '' && $Val_Anticipo_2 > 0){
      $conceptosAnticipos .= "(".$nfolio.",'".$seccion."',".$No_Anticipo_2.",".$Val_Anticipo_2."),";
    }
    if( $No_Anticipo_3 <> '' && $Val_Anticipo_3 > 0){
      $conceptosAnticipos .= "(".$nfolio.",'".$seccion."',".$No_Anticipo_3.",".$Val_Anticipo_3."),";
    }
    if( $No_Anticipo_4 <> '' && $Val_Anticipo_4 > 0){
      $conceptosAnticipos .= "(".$nfolio.",'".$seccion."',".$No_Anticipo_4.",".$Val_Anticipo_4."),";
    }
    if( $No_Anticipo_5 <> '' && $Val_Anticipo_5 > 0){
      $conceptosAnticipos .= "(".$nfolio.",'".$seccion."',".$No_Anticipo_5.",".$Val_Anticipo_5."),";
    }
    if( $No_Anticipo_6 <> '' && $Val_Anticipo_6 > 0){
      $conceptosAnticipos .= "(".$nfolio.",'".$seccion."',".$No_Anticipo_6.",".$Val_Anticipo_6."),";
    }

    $conceptosAnticipos = rtrim($conceptosAnticipos,',');
    $query_cargos="INSERT INTO conta_t_facturas_captura_det(fk_id_cuenta_captura,s_tipoDetalle,n_noDeposito,n_total)
                                                        VALUES $conceptosAnticipos ";

    $stmt_cargos = $db->prepare($query_cargos);
    if (!($stmt_cargos)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare anticipos [$db->errno]: $db->error";
      exit_script($system_callback);
    }
    if (!($stmt_cargos->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution anticipos [$stmt_cargos->errno]: $stmt_cargos->error";
    }
}
?>
