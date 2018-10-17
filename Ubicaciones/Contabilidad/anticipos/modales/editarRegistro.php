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
        <div class="contorno-modal">
          <table class="table form1 font14">
            <tbody>
              <tr class="row m-0 mt-5">
                <td class="col-md-4 input-effect">
                  <input id="pk_partida" type="hidden" db-id="">
                  <input id="fk_id_anticipo" type="hidden" db-id="">

                  <input class="efecto popup-input" id="fk_referencia" type="text" id-display="#medit-popup-display-fk_referencia" action="referencias" value="SN" db-id="SN" autocomplete="off">
                  <div class="popup-list" id="medit-popup-display-fk_referencia" style="display:none"></div>
                  <label for="fk_referencia">Referencia</label>
                </td>

                <td class="col-md-8 input-effect">
                  <div id="lstClientesPartida" style="display:none">
                    <input class="efecto tiene-contenido popup-input" id="fk_id_cliente_antdet" type="text" id-display="#medit-popup-display-fk_id_cliente_antdet" action="clientes" db-id="" autocomplete="off" readonly>
                    <div class="popup-list" id="medit-popup-display-fk_id_cliente_antdet" style="display:none"></div>
                    <label for="fk_id_cliente_antdet">Cliente</label>
                  </div>

                  <div id="lstClientesCorrespPartida" style="display:none">
                    <select class="custom-select" size='1' id='fk_id_corresp'>
                        <option selected value='0'>Seleccione Cliente/Corresponsal</option>
                    </select>
                  </div>
                </td>
              </tr>


              <tr class="row m-0 mt-4">
                <td class="col-md-2 input-effect">
                  <div id="lstClientesCorrespCtas-ModalAnt">
                    <select class="custom-select" size='1' id="fk_id_cuenta">
                      <option selected value='0'>Seleccione</option>
                    </select>
                  </div>
                </td>
                <td class="col-md-6">
                  <input class="efecto" id="s_desc" onchange="eliminaBlancosIntermedios(this)">
                  <label for="s_desc">Descripcion</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input  class="efecto" id="n_cargo" onchange="validaIntDec(this);">
                  <label for="n_cargo">Cargo</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input  class="efecto" id="n_abono" onchange="validaIntDec(this);">
                  <label for="n_abono">Abono</label>
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
