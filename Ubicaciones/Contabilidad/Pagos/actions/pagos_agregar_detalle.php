<?php

$pagos = $_POST['pagos'];

$query_PAGOS="INSERT INTO conta_t_pagos_captura_det(
                                                      fk_id_pago_captura,
                                                      d_fecha_docPago,
                                                      fk_id_formapago,
                                                      s_numOperacion,
                                                      fk_id_moneda,
                                                      n_tipoCambio,
                                                      n_importe,
                                                      n_deposito,
                                                      n_iva,
                                                      s_rfcOrd,
                                                      s_nomBancoOrdExt,
                                                      s_ctaOrd,
                                                      s_rfcBen,
                                                      s_ctaBen,
                                                      s_tipoCadPago,
                                                      s_certPago,
                                                      s_cadPago,
                                                      s_selloPago,
                                                      fk_id_aduanaDR,
                                                      fk_referenciaDR,
                                                      fk_id_facturaDR,
                                                      s_UUID_DR,
                                                      fk_c_MetodoPagoDR,
                                                      fk_id_monedaDR,
                                                      n_tipoCambioDR,
                                                      totalDR,
                                                      n_numParcialidad,
                                                      n_importeSaldoAnterior,
                                                      n_importePagado,
                                                      n_importeSaldoInsoluto,
                                                      s_usuario_alta
                                                    )VALUES ( ?,?,?,?,?,?,?,?,?,?,
                                                              ?,?,?,?,?,?,?,?,?,?,
                                                              ?,?,?,?,?,?,?,?,?,?,
                                                              ?)";

$stmt_PAGOS = $db->prepare($query_PAGOS);
if (!($stmt_PAGOS)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare PAGOS [$db->errno]: $db->error";
  exit_script($system_callback);
}

foreach ($pagos as $pago) {
  $aduanaDR = $pago['aduanaDR'];
  $referenciaDR = $pago['referenciaDR'];
  $uuidDR = $pago['uuidDR'];
  $facturaDR = $pago['facturaDR'];
  $monedaDR = $pago['monedaDR'];
  $tipoCambioDR = $pago['tipoCambioDR'];
  $totalDR = $pago['totalDR'];
  $metPagoDR = $pago['metPagoDR'];
  $parcialidad = $pago['parcialidad'];
  $fecha = $pago['fecha'];
  $formaPago = $pago['formaPago'];
  $operacion = $pago['operacion'];
  $moneda = $pago['moneda'];
  $tipoCambio = $pago['tipoCambio'];
  $importe = $pago['importe'];
  $iva = $pago['iva'];
  $deposito = $pago['deposito'];
  $rfcE = $pago['rfcE'];
  $ctaE = $pago['ctaE'];
  $bcoExt = $pago['bcoExt'];
  $rfcR = $pago['rfcR'];
  $ctaR = $pago['ctaR'];
  $tipoCadena = $pago['tipoCadena'];
  $certificado = $pago['certificado'];
  $cadenaOrig = $pago['cadenaOrig'];
  $sello = $pago['sello'];
  $saldoAnterior = $pago['saldoAnterior'];
  $pagado = $pago['pagado'];
  $saldoInsoluto = $pago['saldoInsoluto'];




  $stmt_PAGOS->bind_param('sssssssssssssssssssssssssssssss',$nfolio,
                                                            $fecha,
                                                            $formaPago,
                                                            $operacion,
                                                            $moneda,
                                                            $tipoCambio,
                                                            $importe,
                                                            $deposito,
                                                            $iva,
                                                            $rfcE,
                                                            $bcoExt,
                                                            $ctaE,
                                                            $rfcR,
                                                            $ctaR,
                                                            $tipoCadena,
                                                            $certificado,
                                                            $cadenaOrig,
                                                            $sello,
                                                            $aduanaDR,
                                                            $referenciaDR,
                                                            $facturaDR,
                                                            $uuidDR,
                                                            $metPagoDR,
                                                            $monedaDR,
                                                            $tipoCambioDR,
                                                            $totalDR,
                                                            $parcialidad,
                                                            $saldoAnterior,
                                                            $pagado,
                                                            $saldoInsoluto,
                                                            $usuario);
  if (!($stmt_PAGOS)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding PAGOS [$stmt_PAGOS->errno]: $stmt_PAGOS->error";
    exit_script($system_callback);
  }

  if (!($stmt_PAGOS->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution PAGOS [$stmt_PAGOS->errno]: $stmt_PAGOS->error";
  }
}

?>
