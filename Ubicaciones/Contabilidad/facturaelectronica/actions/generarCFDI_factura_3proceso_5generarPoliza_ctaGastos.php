<?php
#http://localhost:88/ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_ctaGastos.php
/*
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Resources/PHP/Utilities/initialScript.php';

  $cuenta = 228;
  $folioCtaGastos = 46;
  $idFactura = 51;
  $fechaTimbre = '2020-12-17 11:24:36';
  $moneda = 'MXN';
  $Hono_Total = 1160;
  $Total_POCME = 0;
  $POCME_Total_MN = 0;
  $Total_Pagos = 1160;
  $total_pagosCLT = $Total_POCME + $Total_Pagos;
  $Total_Anticipos = 0;
  $referencia = 'SN';
  $cliente = 'CLT_6548';
  $id_cliente = $cliente;
  $totalGral = 2494;
  $Total_Gral = $totalGral;
  $r_razon_social = 'MOTORES ELECTRICOS SUMERGIBLES DE MEXICO, S DE RL DE CV';
*/

$id_ctagastos = $folioCtaGastos;
$fecha = $fechaTimbre;
$concepto = "CUENTA DE GASTOS - ".$r_razon_social;
require $root . '/Resources/PHP/actions/generarFolioPoliza.php';
$poliza_CtaGastos = $nFolio;

  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_det_ctaGastos.php';
?>
