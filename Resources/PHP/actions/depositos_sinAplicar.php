<?php
$query_depositosCliente = "SELECT *
                          FROM CONTA_T_POLIZAS_DET
                          WHERE fk_tipo = 5 and fk_id_cuenta like '0208%' and fk_referencia = ? and fk_id_cliente = ?
                          ORDER BY fk_anticipo desc";

$stmt_depositosCliente = $db->prepare($query_depositosCliente);
if (!($stmt_depositosCliente)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt_depositosCliente->bind_param('ss',$id_referencia,$id_cliente);
if (!($stmt_depositosCliente)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_depositosCliente->errno]: $stmt_depositosCliente->error";
  exit_script($system_callback);
}
if (!($stmt_depositosCliente->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_depositosCliente->errno]: $stmt_depositosCliente->error";
  exit_script($system_callback);
}
$rslt_depositosCliente = $stmt_depositosCliente->get_result();
$rows_depositosCliente = $rslt_depositosCliente->num_rows;

#<div class='checkbox-xs' onclick='agregarAnticipo($deposito,$importe)'>

if( $rows_depositosCliente > 0 ){
  while ($row_depositosCliente = $rslt_depositosCliente->fetch_assoc()) {
    $deposito = $row_depositosCliente[fk_anticipo];
    $importe = $row_depositosCliente[n_abono];

    $depositosSinAplicar .= "<tr class='row'>
      <td class='col-md-6 nomCLT'>$CLT_nombre</td>
      <td class='col-md-2 noAnt'><input class='efecto h22 Txt_Anticipo id-deposito' type='text' id='T_No_Anticipo_$deposito' value='$deposito' readonly></td>
      <td class='col-md-2 impAnt'><input class='efecto h22 T_Anticipo importe' importe='$importe' type='text' id='T_Anticipo_$deposito' value='$importe' readonly></td>
      <td class='col-md-2'>
        <div class='checkbox-xs agregar-deposito' destino='#tbodyDepAplic'>
          <label>
            <input type='checkbox' data-toggle='toggle'>
          </label>
        </div>
      </td>
    </tr>";
  }
}else{
  $depositosSinAplicar = "<tr class='row'>
    <td colspan='4'>NO HAY ANTICIPOS PARA ESTA REFRENCIA</td>
  </tr>";
}
?>
