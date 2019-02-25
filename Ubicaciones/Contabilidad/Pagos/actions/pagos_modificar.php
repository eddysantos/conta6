<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$nfolio = $_POST['folio'];
$pagos = $_POST['pagos'];
$pagosDR = $_POST['pagosDR'];
$pagosDelete = $_POST['pagosDelete'];
$pagosDRDelete = $_POST['pagosDRDelete'];


# Agregar Pagos *************************************************************************************************************************************
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
  $ctaR = $pago['ctaR'];
  $tipoCadena = $pago['tipoCadena'];
  $certificado = $pago['certificado'];
  $cadenaOrig = $pago['cadenaOrig'];
  $sello = $pago['sello'];
  $pk_rowPago = $pago['pk_rowPago'];
  $pk_id_pago_det = $pago['pk_id_pago_det'];


  if( $pk_id_pago_det == "-" ){


    $stmt_PAGOS = $db->prepare($query_PAGOS);
    if (!($stmt_PAGOS)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare PAGOS [$db->errno]: $db->error";
      exit_script($system_callback);
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
  }

}


# Agregar Documeto Relacionado *************************************************************************************************************************************
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
  $pk_id_DR = $pagoDR['pk_id_DR'];


  if( $pk_id_DR == "-" ){


    $stmt_PAGOS_DR = $db->prepare($query_PAGOS_DR);
    if (!($stmt_PAGOS_DR)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare PAGOS [$db->errno]: $db->error";
      exit_script($system_callback);
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

}


#Borrar Pagos *************************************************************************************************************************************
$query_pagoDelete="DELETE FROM conta_t_pagos_captura_det WHERE pk_id_pago_det = ?";

$stmt_pagoDelete = $db->prepare($query_pagoDelete);
if (!($stmt_pagoDelete)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare pagoDet delete [$db->errno]: $db->error";
  exit_script($system_callback);
}

foreach ($pagosDelete as $id_pago) {
  $pago_idpartida = $id_pago['idpartida'];

  $stmt_pagoDelete->bind_param('s',$pago_idpartida);
  if (!($stmt_pagoDelete)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding pagoDet delete [$stmt_pagoDelete->errno]: $stmt_pagoDelete->error";
    exit_script($system_callback);
  }

  if (!($stmt_pagoDelete->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution pagoDet delete [$stmt_pagoDelete->errno]: $stmt_pagoDelete->error";
  }

}

#Borrar Facturas Relacionadas ************************************************************************************************************************
$query_pagoDRDelete="DELETE FROM conta_t_pagos_captura_det_dr WHERE pk_id_DR = ?";

$stmt_pagoDRDelete = $db->prepare($query_pagoDRDelete);
if (!($stmt_pagoDRDelete)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare pagoDR delete [$db->errno]: $db->error";
  exit_script($system_callback);
}

foreach ($pagosDRDelete as $id_pagoDR) {
  $pago_idpartidaDR = $id_pagoDR['idpartidaDR'];

  $stmt_pagoDRDelete->bind_param('s',$pago_idpartidaDR);
  if (!($stmt_pagoDRDelete)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding pagoDR delete [$stmt_pagoDRDelete->errno]: $stmt_pagoDRDelete->error";
    exit_script($system_callback);
  }

  if (!($stmt_pagoDRDelete->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution pagoDR delete [$stmt_pagoDRDelete->errno]: $stmt_pagoDRDelete->error";
  }

}






$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";

exit_script($system_callback);

?>
