<?php

  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

  $system_callback = [];
  $data = $_POST;

  $id_anticipo = $_POST['id_anticipo'];

  //totales
  $oRst_STPD_sql = "select fk_id_anticipo,SUM(n_cargo)as SUMA_CARGOS, SUM(n_abono)as SUMA_ABONOS from conta_t_anticipos_det where fk_id_anticipo = ? group by fk_id_anticipo ";
  $stmtTotales = $db->prepare($oRst_STPD_sql);
  if (!($stmtTotales)) { die("Error during query prepare [$db->errno]: $db->error");	}
  $stmtTotales->bind_param('s', $id_anticipo);
  if (!($stmtTotales)) { die("Error during query prepare [$stmtTotales->errno]: $stmtTotales->error");	}
  if (!($stmtTotales->execute())) { die("Error during query prepare [$stmtTotales->errno]: $stmtTotales->error"); }
  $rsltTotales = $stmtTotales->get_result();
  $rowsTotales = $rsltTotales->num_rows;
  if( $rowsTotales > 0 ){
    $oRst_STPD = $rsltTotales->fetch_assoc();
    $sumaCargos = $oRst_STPD['SUMA_CARGOS'];
    $sumaAbonos = $oRst_STPD['SUMA_ABONOS'];
    $sumaC = number_format($sumaCargos,2,'.','') + number_format($importeAnt,2,'.','') ;
    $Status_Anticipo =  number_format($sumaC - $sumaAbonos,2,'.','');
    $statusGeneraPoliza = false;

    if( $Status_Anticipo == 0 ){
      $txtStatus = '<b><font face="Trebuchet MS" size="2" color="#000000">CUADRADA</font></b>';
      $statusGeneraPoliza = true;
    }else{
      $txtStatus = '<b><font color="#E52727" face="Trebuchet MS" size="2"><?php echo $Status_Anticipo; ?> ANTICIPO SIN CUADRAR</font></b>';
      $statusGeneraPoliza = false;
    }
  }else{
    $sumaCargos = 0;
    $sumaAbonos = 0;
    $sumaC = 0;
    $Status_Anticipo = 0;
  }

  $system_callback['cargos'] = $sumaC;
  $system_callback['abonos'] = $sumaAbonos;
  exit_script($system_callback);

?>
