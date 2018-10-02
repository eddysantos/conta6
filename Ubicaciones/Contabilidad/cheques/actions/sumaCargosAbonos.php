<?php

  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

  $system_callback = [];
  $data = $_POST;

  $id_cheque = $_POST['id_cheque'];
  $id_ctaMST = $_POST['id_ctaMST'];
  $importeChe = $_POST['importeChe'];
  //totales
  $oRst_STPD_sql = "SELECT fk_id_cheque,SUM(n_cargo)as SUMA_CARGOS,SUM(n_abono)as SUMA_ABONOS
                    from conta_t_cheques_det
                    where fk_id_cheque = ? AND fk_id_cuentaM = ?
                    group by fk_id_cheque";
  $stmtTotales = $db->prepare($oRst_STPD_sql);
  if (!($stmtTotales)) { die("Error during query prepare [$db->errno]: $db->error");	}
  $stmtTotales->bind_param('ss',$id_cheque,$id_ctaMST);
  if (!($stmtTotales)) { die("Error during query prepare [$stmtTotales->errno]: $stmtTotales->error");	}
  if (!($stmtTotales->execute())) { die("Error during query prepare [$stmtTotales->errno]: $stmtTotales->error"); }
  $rsltTotales = $stmtTotales->get_result();
  $rowsTotales = $rsltTotales->num_rows;
  if( $rowsTotales > 0 ){
    $oRst_STPD = $rsltTotales->fetch_assoc();
    $sumaCargos = $oRst_STPD['SUMA_CARGOS'];
    $sumaAbonos = $oRst_STPD['SUMA_ABONOS'];
    $sumaC = number_format($sumaAbonos,2,'.','') + number_format($importeChe,2,'.','') ;
    $Status_Cheque =  number_format($sumaC - $sumaCargos,2,'.','');
    $statusGeneraPoliza = false;

    if( $Status_Cheque == 0 ){
      $txtStatus = '<b><font face="Trebuchet MS" size="2" color="#000000">CUADRADA</font></b>';
      $statusGeneraPoliza = true;
    }else{
      $txtStatus = '<b><font color="#E52727" face="Trebuchet MS" size="2"><?php echo $Status_Cheque; ?> CHEQUE SIN CUADRAR</font></b>';
      $statusGeneraPoliza = false;
    }
  }else{
    $sumaCargos = 0;
    $sumaAbonos = 0;
    $sumaC = 0;
    $Status_Cheque = 0;
  }

  $system_callback['cargos'] = $sumaCargos;
  $system_callback['abonos'] = $sumaC;
  exit_script($system_callback);

?>
