<!--Editar Registro de Anticipo-->
<div class="modal fade text-center" id="detant-editar" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Registro</h5>
      </div>
      <div class="modal-body">
        <div class="contorno-modal" id="contorno">
          <table class="table form1 font14">
            <tbody>
              <tr class="row m-0 mt-5">
                <td class="col-md-4 input-effect">
                  <input id="pk_partida" type="hidden" db-id="">
                  <input id="fk_id_anticipo" type="hidden" db-id="">
                  <input class="efecto popup-input" id="fk_referencia" type="text" id-display="#popup-display-referencia" action="referencias" value="" db-id="" autocomplete="new-password">
                  <div class="popup-list" id="popup-display-referencia" style="display:none"></div>
                  <label for="fk_referencia">Referencia</label>
                </td>
                <td class="col-md-8 input-effect">
                  <div id="lstClientesPartida">
                    <input class="efecto popup-input" id="fk_id_cliente" type="text" id-display="#popup-display-clientes" action="clientes" db-id="" autocomplete="new-password">
                    <div class="popup-list" id="popup-display-clientes" style="display:none"></div>
                    <label for="fk_id_cliente">Cliente</label>
                  </div>
                  <div id="lstClientesCorrespPartida">
                    <select class="custom-select" size='1' id='ant-clienteCorresp'>
                        <option selected value='0'>Seleccione Cliente/Corresponsal</option>
                    </select>
                  </div>
                </td>
              </tr>

              <tr class="row m-0 mt-4">
                <td class="col-md-8 input-effect">
                  <div id="lstClientesCorrespCtas">
                    <select class="custom-select" size='1' id='ant-clienteCorrespCtas'>
                        <option selected value='0'>Seleccione</option>
                    </select>
                  </div>
                </td>
                <td class="col-md-2 input-effect">
                  <input  class="efecto" id="n_cargo">
                  <label for="ant-cargo1">Cargo</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input  class="efecto" id="n_abono">
                  <label for="ant-abono1">Abono</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" id="btnRegDetAntPartida" class="linkbtn">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>
