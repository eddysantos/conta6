<?php


$query_PAGOS_DR="INSERT INTO conta_t_pagos_captura_det_dr(
                                                        fk_id_pago_captura,
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
                                                        n_deposito,
                                                        n_iva,
                                                        s_usuario_alta,
                                                        n_fk_rowPago
                                                    )VALUES ( ?,?,?,?,?,?,?,?,?,?,
                                                              ?,?,?,?,?,?,?
                                                            )";

$stmt_PAGOS_DR = $db->prepare($query_PAGOS_DR);
if (!($stmt_PAGOS_DR)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare PAGOS [$db->errno]: $db->error";
  exit_script($system_callback);
}

foreach ($pagosDR as $pagoDR) {
  $aduanaDR = $pagoDR['aduanaDR'];
  $referenciaDR = $pagoDR['referenciaDR'];
  $facturaDR = $pagoDR['facturaDR'];
  $uuidDR = $pagoDR['uuidDR'];
  $metPagoDR = $pagoDR['metPagoDR'];
  $monedaDR = $pagoDR['monedaDR'];
  $tipoCambioDR = $pagoDR['tipoCambioDR'];
  $totalDR = $pagoDR['totalDR'];
  $parcialidad = $pagoDR['parcialidad'];
  $saldoAnterior = $pagoDR['saldoAnterior'];
  $pagado = $pagoDR['pagado'];
  $saldoInsoluto = $pagoDR['saldoInsoluto'];
  $iva = $pagoDR['iva'];
  $deposito = $pagoDR['deposito'];
  $fk_rowPago = $pagoDR['fk_rowPago'];

  if( $opcionDoc == 'sustituir' ){
    $fk_rowPago = '-';
  }


  $stmt_PAGOS_DR->bind_param('sssssssssssssssss',$nfolio,
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
                                                $deposito,
                                                $iva,
                                                $usuario,
                                                $fk_rowPago
                                                            );

  if( $pk_rowPago == $fk_rowPago ){ # Deben ser iguales para evitar duplicidad
    if (!($stmt_PAGOS_DR)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding PAGOS [$stmt_PAGOS_DR->errno]: $stmt_PAGOS_DR->error";
      exit_script($system_callback);
    }

    if (!($stmt_PAGOS_DR->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution PAGOS [$stmt_PAGOS_DR->errno]: $stmt_PAGOS_DR->error";
    }
  }

  echo $pk_rowPago.'/'.$fk_rowPago

  // if( $pk_rowPago == '-' ){ # Para sustituir y modificar se usa el mismo formulario. En sustituir $pk_rowPago == '-', en modificar $pk_rowPago == 52 fk_id_pago_captura
  //   if (!($stmt_PAGOS_DR)) {
  //     $system_callback['code'] = "500";
  //     $system_callback['message'] = "Error during variables binding PAGOS [$stmt_PAGOS_DR->errno]: $stmt_PAGOS_DR->error";
  //     exit_script($system_callback);
  //   }
  //
  //   if (!($stmt_PAGOS_DR->execute())) {
  //     $system_callback['code'] = "500";
  //     $system_callback['message'] = "Error during query execution PAGOS [$stmt_PAGOS_DR->errno]: $stmt_PAGOS_DR->error";
  //   }
  // }

}

?>
