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

<!--Buscar Facturas en Captura detalle de poliza-->
<div class="modal fade text-center" id="agregarDepositos" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Agregar Depositos</h5>
      </div>
      <div class="modal-body">
        <div class="contorno">
          <table class="table mt-4" id="vclientes">
            <thead>
              <tr class="row encabezado">
                <td class="col-md-12">DEPOSITOS DISPONIBLES</td>
              </tr>
              <tr class="row sub2">
                <td class="col-md-6">Cliente</td>
                <td class="col-md-2">Anticipo</td>
                <td class="col-md-2">Importe</td>
                <td class="col-md-2">Aplicar</td>
              </tr>
            </thead>
            <tbody id="depositos-disponibles">
              <?php echo $depositosSinAplicar; ?>
            </tbody>
          </table>


          <table class="table mt-4">
            <thead>
              <tr class="row encabezado">
                <td class="col-md-12">DEPOSITOS APLICADOS PARA CUENTA DE GASTOS</td>
              </tr>
              <tr class="row sub2">
                <td class="col-md-6">Cliente</td>
                <td class="col-md-2">Anticipo</td>
                <td class="col-md-2">Importe</td>
                <td class="col-md-2"></td>
              </tr>
            </thead>
            <tbody id="tbodyDepAplic">
              <!--tr class="row">
                <td class="col-md-6">LIBRERIA GANDHI, SA DE CV</td>
                <td class="col-md-2">22222</td>
                <td class="col-md-2">$34,640</td>
                <td class="col-md-2">
                  <a href="#">
                    <img class='mr-3 icochico' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
              </tr-->
            </tbody>
          </table>

          <!-- <table class="table mt-4">
            <tbody>

              <tr class="row">
                <td class="p-1 col-md-8 text-right">
                  Anticipo 1 :
                  <a href="javascript:Btn_Busca_Anticipo('1')" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                    <img class='mr-3 icochico' src='/conta6/Resources/iconos/magnifier.svg'>
                  </a>
                  <a href="javascript:limpiarCampos(4,1)">
                    <img class='mr-3 icochico' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_No_Anticipo_1" size="20" readonly>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_Anticipo_1" size="20" value="0" readonly>
                </td>
              </tr>

              <tr class="row">
                <td class="p-1 col-md-8 text-right">
                  Anticipo 2 :
                  <a href="javascript:Btn_Busca_Anticipo('2')" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                    <img class='mr-3 icochico' src='/conta6/Resources/iconos/magnifier.svg' /></a>
                  <a href="javascript:limpiarCampos(4,2)">
                    <img class='mr-3 icochico' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_No_Anticipo_2" size="20" readonly>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_Anticipo_2" size="20" value="0" readonly>
                </td>
              </tr>

              <tr class="row">
                <td class="p-1 col-md-8 text-right">
                  Anticipo 3 :
                  <a href="javascript:Btn_Busca_Anticipo('3')" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/magnifier.svg'>
                  </a>
                  <a href="javascript:limpiarCampos(4,3)">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_No_Anticipo_3" size="20" readonly>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_Anticipo_3" size="20" value="0" readonly>
                </td>
              </tr>

              <tr class="row">
                <td class="p-1 col-md-8 text-right">
                  Anticipo 4 :
                  <a href="javascript:Btn_Busca_Anticipo('4')" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/magnifier.svg'>
                  </a>
                  <a href="javascript:limpiarCampos(4,4)">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
                <td class="p-1 col-md-2">
                <input class="w-100 efecto h22" type="text" id="T_No_Anticipo_4" size="20" readonly>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_Anticipo_4" size="20" value="0" readonly>
                </td>
              </tr>

              <tr class="row">
                <td class="p-1 col-md-8 text-right">
                  Anticipo 5 :
                  <a href="javascript:Btn_Busca_Anticipo('5')" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/magnifier.svg'>
                  </a>
                  <a href="javascript:limpiarCampos(4,5)">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
                <td class="p-1 col-md-2">
                <input class="w-100 efecto h22" type="text" id="T_No_Anticipo_5" size="20" readonly>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_Anticipo_5" size="20" value="0" readonly>
                </td>
              </tr>

              <tr class="row">
                <td class="p-1 col-md-8 text-right">
                  Anticipo 6 :
                  <a href="javascript:Btn_Busca_Anticipo('6')" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/magnifier.svg'>
                  </a>
                  <a href="javascript:limpiarCampos(4,6)">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
                <td class="p-1 col-md-2">
                <input class="w-100 efecto h22" type="text" id="T_No_Anticipo_6" size="20" readonly>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_Anticipo_6" size="20" value="0" readonly>
                </td>
              </tr>
            </tbody>
          </table> -->
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="#" class="linkbtn"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
