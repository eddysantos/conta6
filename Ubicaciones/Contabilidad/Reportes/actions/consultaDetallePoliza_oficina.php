<?php
$query_detallePol = "SELECT *
                      from conta_t_polizas_det PD
                      INNER JOIN conta_t_polizas_mst PM
                      on PD.fk_id_poliza = PM.pk_id_poliza
                      where PD.fk_id_cuenta = ? AND PD.d_fecha BETWEEN ? and ? and PM.fk_id_aduana = ?";

$stmt_detallePol = $db->prepare($query_detallePol);
if (!($stmt_detallePol)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_detallePol->bind_param('ssss', $Cta_Inicial,$Cta_Inicial,$Fecha_Final,$Oficina);
if (!($stmt_detallePol)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_detallePol->errno]: $stmt_detallePol->error";
  exit_script($system_callback);
}

if (!($stmt_detallePol->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_detallePol->errno]: $stmt_detallePol->error";
  exit_script($system_callback);
}

$rslt_detallePol = $stmt_detallePol->get_result();

// if ($rslt_detallePol->num_rows == 0) {
//   $system_callback['code'] = 1;
//   $system_callback['data'] =
//   "<p db-id=''>No se encontraron resultados</p>";
//   $system_callback['message'] = "Script called successfully but there are no rows to display.";
//   exit_script($system_callback);
// }
//
// while ($row_detallePol = $rslt_detallePol->fetch_assoc()) {
      // $id_poliza = $row_detallePol['fk_id_poliza'];
      // $cuenta = $row_detallePol['fk_id_cuenta'];
      // $fecha = $row_detallePol['d_fecha'];
      // $tipo = $row_detallePol['fk_tipo'];
      // $referencia = $row_detallePol['fk_referencia'];
      // $id_cliente = $row_detallePol['fk_id_cliente'];
      // $folioCFDI = $row_detallePol['s_folioCFDIext'];
      // $anticipo = $row_detallePol['fk_anticipo'];
      // $cheque = $row_detallePol['fk_cheque'];
      // $ctagastos = $row_detallePol['fk_ctagastos'];
      // $factura = $row_detallePol['fk_factura'];
      // $pago = $row_detallePol['fk_pago'];
      // $nc = $row_detallePol['fk_nc'];
      // $desc = $row_detallePol['s_desc'];
      // $cargo = $row_detallePol['n_cargo'];
      // $abono = $row_detallePol['n_abono'];
      // $cargo_cancela = $row_detallePol['n_cargo_cancela'];
      // $abono_cancela = $row_detallePol['n_abono_cancela'];
      // $partida = $row_detallePol['pk_partida'];
      // $gastoaduana = $row_detallePol['fk_gastoAduana'];
      // $proveedor = $row_detallePol['fk_id_proveedor'];
      // $iddocumento = $row_detallePol['s_idDocumento'];
      // $idregistro = $row_detallePol['fk_idRegistro'];
      // $pol_usuario = $row_detallePol['fk_usuario'];
      // $fecha_modifi = $row_detallePol['d_fecha_ultmodif'];

      // $cancela = $row_detallePol['s_cancela'];
      // $id_aduana = $row_detallePol['fk_id_aduana'];

    // }
// }
//
// $system_callback['code'] = 1;
// $system_callback['message'] = "Script called successfully!";
// exit_script($system_callback);



 ?>
