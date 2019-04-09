<?php
$id_ctagastos = $folioCtaGastos;
$fecha = $fechaTimbre;
$concepto = "CUENTA DE GASTOS - ".$r_razon_social;
require $root . '/conta6/Resources/PHP/actions/generarFolioPoliza.php';
$poliza_CtaGastos = $nFolio;

  require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_det_ctaGastos.php';
?>
