<?php

$tipo = 3;
$fecha = $fechaTimbre;
$concepto = "PAGO APLICADO A FACTURA - ".$r_razon_social;
require $root . '/conta6/Resources/PHP/actions/generarFolioPoliza.php';
//echo "<br>poliza aplicada: ";
$polizaAplicado = $nFolio;

require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/generarCFDI_factura_3proceso_5generarPoliza_pagoAplicadoDetalle.php';

?>
