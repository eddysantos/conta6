<?php


$system_callback = [];
// $data = $_POST;
//
// $data['string'];
// $text = "%" . $data['string'] . "%";
$text = "%" . $buscar . "%";
$query = "SELECT A.fk_id_cuenta_captura,A.pk_id_factura, A.fk_referencia, A.fk_id_poliza, A.s_cancela_factura,B.fk_id_cliente, B.s_nombre
          FROM conta_t_facturas_cfdi A, conta_t_facturas_captura B
          WHERE A.fk_id_cuenta_captura = B.pk_id_cuenta_captura AND
                (A.pk_id_factura LIKE ? OR A.fk_referencia LIKE ? ) AND
                A.s_UUID is not null
          ORDER BY A.pk_id_factura ";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ss', $text, $text);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$rslt = $stmt->get_result();

if ($rslt->num_rows == 0) {
  $system_callback['code'] = 1;
  $system_callback['data'] =
  "<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $fk_id_cuenta_captura = $row['fk_id_cuenta_captura'];
  $id_factura = $row['pk_id_factura'];
  $cancela_factura = $row['s_cancela_factura'];
  $id_cliente = $row['fk_id_cliente'];

  if( $cancela_factura == 1 ){ $txt_cancela = "Si"; }else{ $txt_cancela = "No"; }

  if( $oRst_permisos['CFDI_NC_Pgenerar'] == 1 && $cancela_factura == 0 ){
    $href = "<a href='#' onclick='genProfNC($fk_id_cuenta_captura,&#39;$id_cliente&#39;)'><img src='/conta6/Resources/iconos/rightred.svg'></a>";
  }else{ $href = ""; }

  $resultadoConsulta .=
  "<tr class='row borderojo font18'>
    <td class='col-md-1'>$id_factura</td>
    <td class='col-md-2'>$row[fk_referencia]</td>
    <td class='col-md-1'>$row[fk_id_poliza]</td>
    <td class='col-md-1'>$txt_cancela</td>
    <td class='col-md-6'>$id_cliente $row[s_nombre]</td>
    <td class='col-md-1 text-right'>".$href."</td>
   </tr>";
}

// $system_callback['code'] = 1;
// $system_callback['message'] = "Script called successfully!";
// exit_script($system_callback);


 ?>
