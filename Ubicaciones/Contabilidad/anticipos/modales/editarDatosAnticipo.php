<!--Editar Datos de Anticipo-->
<div class="modal fade text-center" id="ant-editarRegMST" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Datos de Anticipo</h5>
      </div>
      <div class="modal-body">
        <div class="contorno-modal" id="contorno">
          <table class="table form1 font14">
            <tbody>
              <tr class="row m-0 mt-5">
                <td class="col-md-3">
                  <input type="hidden" id="fk_id_aduana">
                  <input type="hidden" id="pk_id_anticipo">
                  <input class="efecto tiene-contenido" type="date" id="d_fecha" db-id="">
                  <label for="ant-cliente">Fecha Anticipo</label>
                </td>

                <td class="col-md-3">
                  <input id="n_valor" class="efecto tiene-contenido" type="text" db-id="" autocomplete="new-password" onchange="validaSoloNumeros(this)">
                  <label for="n_valor">Valor</label>
                </td>

                <td class="col-md-6 input-effect">
                  <input class="efecto tiene-contenido" type="text" id='fk_id_cuentaMST' db-id="">
                  <label for="fk_id_cuentaMST">Cuenta</label>
          			  <!-- <select class="custom-select" size='1' name='fk_id_cuentaMST' id='fk_id_cuentaMST' db-id="">
          				  <option selected value='0'>Seleccione una Cuenta</option>
                    <option value=""></option>
          				</select> -->
          			</td>
              </tr>
              <tr class="row m-0 mt-5">
                <td class="col-md-3">
                  <!-- <input type="text" id="fk_id_cliente_antmst" db-id=""> -->
    			        <input class="efecto tiene-contenido popup-input" id="fk_id_cliente_antmst" type="text" id-display="#popup-display-ant-cliente" action="clientes" db-id="" autocomplete="new-password" onblur="Actualiza_Expedido_Cliente_MST()">
                  <div class="popup-list" id="popup-display-ant-cliente" style="display:none"></div>
                  <label for="fk_id_cliente_antmst">Cliente</label>
                </td>

                <td class="col-md-3">
                  <!-- <input type="text" id='s_bancoOri' db-id=""> -->
                  <select class="custom-select" size='1' id='s_bancoOri' db-id="">
                  	<option selected value='0'>Seleccione Banco</option>
                  </select>
    			      </td>

                <td class="col-md-6">
                  <input id="s_concepto" class="efecto tiene-contenido" type="text" db-id="" autocomplete="new-password">
                  <label for="s_concepto">CONCEPTO</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" id="medit-anticipoMST">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>
