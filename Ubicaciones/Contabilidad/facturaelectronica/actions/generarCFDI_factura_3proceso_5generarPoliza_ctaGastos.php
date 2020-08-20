<?php
$id_ctagastos = $folioCtaGastos;
$fecha = $fechaTimbre;
$concepto = "CUENTA DE GASTOS - ".$r_razon_social;
require $root . '/Resources/PHP/actions/generarFolioPoliza.php';
$poliza_CtaGastos = $nFolio;

  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_det_ctaGastos.php';
?>
