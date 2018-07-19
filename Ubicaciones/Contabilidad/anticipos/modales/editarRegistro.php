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
                  <!-- <input id="d_fecha" type="text" db-id=""> -->

                  <input class="efecto popup-input" id="fk_referencia" type="text" id-display="#medit-popup-display-referencia" action="referencias" value="SN" db-id="SN" autocomplete="new-password">
                  <div class="popup-list" id="medit-popup-display-referencia" style="display:none"></div>
                  <label for="fk_referencia">Referencia</label>
                </td>

                <td class="col-md-8 input-effect">
                  <div id="lstClientesPartida">
                    <input class="efecto tiene-contenido popup-input" id="fk_id_cliente_antdet" type="text" id-display="#medit-popup-display-ant-cliente" action="clientes" db-id="" autocomplete="new-password">
                    <div class="popup-list" id="medit-popup-display-ant-cliente" style="display:none"></div>
                    <label for="fk_id_cliente_antdet">Cliente</label>
                  </div>


                  <div id="lstClientesCorrespPartida">
                    <select class="custom-select" size='1' id='fk_id_corresp'>
                        <option selected value='0'>Seleccione Cliente/Corresponsal</option>
                    </select>
                  </div>
                </td>

              </tr>


              <tr class="row m-0 mt-4">
                <td class="col-md-2 input-effect">
                  <input class="efecto" id="fk_id_cuenta">
                  <label for="fk_id_cuenta">Cuenta</label>

                  <!-- <div id="lstClientesCorrespCtas">
                    <select class="custom-select" size='1' id='ant-clienteCorrespCtas'>
                        <option selected value='0'>Seleccione</option>
                    </select>
                  </div> -->
                </td>
                <td class="col-md-6">
                  <input class="efecto" id="s_desc">
                  <label for="s_desc">Descripcion</label>
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
