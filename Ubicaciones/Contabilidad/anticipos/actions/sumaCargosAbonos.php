<?php

  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Resources/PHP/Utilities/initialScript.php';

  $system_callback = [];
  $data = $_POST;

  $id_anticipo = $_POST['id_anticipo'];
  $importeAnt = $_POST['importeAnt'];

  //totales
  $oRst_STPD_sql = "SELECT fk_id_anticipo,SUM(n_cargo) AS SUMA_CARGOS, SUM(n_abono) AS SUMA_ABONOS FROM conta_t_anticipos_det WHERE fk_id_anticipo = ? GROUP BY fk_id_anticipo ";
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

    $txtStatus = 'DESCUADRADA';
    if( $Status_Anticipo == 0 ){
      $txtStatus = 'CUADRADA';
      $statusGeneraPoliza = true;
    }else{
      $txtStatus = 'DESCUADRADA';
      $statusGeneraPoliza = false;
    }
  }else{
    $sumaCargos = 0;
    $sumaAbonos = 0;
    $sumaC = 0;
    $Status_Anticipo = 0;
  }

  $system_callback['statusGeneraPoliza'] = $txtStatus;
  $system_callback['cargos'] = $sumaC;
  $system_callback['abonos'] = $sumaAbonos;
  exit_script($system_callback);

?>
