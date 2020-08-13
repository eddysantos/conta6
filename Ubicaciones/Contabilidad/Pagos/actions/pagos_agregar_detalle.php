<?php

$pagos = $_POST['pagos'];
$pagosDR = $_POST['pagosDR'];

$query_PAGOS="INSERT INTO conta_t_pagos_captura_det(
                                                      fk_id_pago_captura,
                                                      d_fecha_docPago,
                                                      fk_id_formapago,
                                                      s_numOperacion,
                                                      fk_id_moneda,
                                                      n_tipoCambio,
                                                      n_importe,
                                                      s_rfcOrd,
                                                      s_nomBancoOrdExt,
                                                      s_ctaOrd,
                                                      s_rfcBen,
                                                      s_ctaBen,
                                                      s_tipoCadPago,
                                                      s_certPago,
                                                      s_cadPago,
                                                      s_selloPago,
                                                      s_usuario_alta,
                                                      n_pk_rowPago
                                                    )VALUES ( ?,?,?,?,?,?,?,?,?,?,
                                                              ?,?,?,?,?,?,?,?
                                                            )";

$stmt_PAGOS = $db->prepare($query_PAGOS);
if (!($stmt_PAGOS)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare PAGOS [$db->errno]: $db->error";
  exit_script($system_callback);
}

foreach ($pagos as $pago) {
  $fecha = $pago['fecha'];
  $formaPago = $pago['formaPago'];
  $operacion = $pago['operacion'];
  $moneda = $pago['moneda'];
  $tipoCambio = $pago['tipoCambio'];
  $importe = $pago['importe'];
  $rfcE = $pago['rfcE'];
  $ctaE = $pago['ctaE'];
  $bcoExt = $pago['bcoExt'];
  $rfcR = $pago['rfcR'];
  $tipoCadena = $pago['tipoCadena'];
  $certificado = $pago['certificado'];
  $cadenaOrig = $pago['cadenaOrig'];
  $sello = $pago['sello'];
  $pk_rowPago = $pago['pk_rowPago'];

  if( $pago['ctaR'] == 0 ){
    $ctaR = ''; 
  }else {
      $ctaR = $pago['ctaR'];
  }


  $stmt_PAGOS->bind_param('ssssssssssssssssss',$nfolio,
                                              $fecha,
                                              $formaPago,
                                              $operacion,
                                              $moneda,
                                              $tipoCambio,
                                              $importe,
                                              $rfcE,
                                              $bcoExt,
                                              $ctaE,
                                              $rfcR,
                                              $ctaR,
                                              $tipoCadena,
                                              $certificado,
                                              $cadenaOrig,
                                              $sello,
                                              $usuario,
                                              $pk_rowPago

                            );
  if (!($stmt_PAGOS)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding PAGOS [$stmt_PAGOS->errno]: $stmt_PAGOS->error";
    exit_script($system_callback);
  }

  if (!($stmt_PAGOS->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution PAGOS [$stmt_PAGOS->errno]: $stmt_PAGOS->error";
  }

  require $root . '/Ubicaciones/Contabilidad/Pagos/actions/pagos_agregar_detalle_docRel.php';

}

?>
