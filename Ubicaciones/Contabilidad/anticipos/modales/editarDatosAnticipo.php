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
                  <input id="n_valor" class="efecto tiene-contenido" type="text" db-id="" autocomplete="off" onchange="validaSoloNumeros(this)">
                  <label for="n_valor">Valor</label>
                </td>

                <td class="col-md-6 input-effect">
    			        <input class="efecto tiene-contenido popup-input" id="fk_id_cliente_antmst" type="text" id-display="#popup-display-fk_id_cliente_antmst" action="clientes" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-fk_id_cliente_antmst" style="display:none"></div>
                  <label for="fk_id_cliente_antmst">Cliente</label>
          			</td>
              </tr>
              <tr class="row m-0 mt-5">
                <td class="col-md-3">
                  <select class="custom-select" size='1' id="antbcoclienteMST">
                    <option selected value='0'>Seleccione Banco</option>
                  </select>
                </td>

                <td class="col-md-3">
                  <select class="custom-select" size='1' id='antcuentaMST'>
                    <option selected value='0'>Seleccione una Cuenta</option>
                  </select>
    			      </td>

                <td class="col-md-6">
                  <input id="s_concepto" class="efecto tiene-contenido" type="text" db-id="" autocomplete="off">
                  <label for="s_concepto">CONCEPTO</label>
                </td>

                <!-- <td class="col-md-6">&nbsp;</td> -->
              </tr>
              <tr class="row m-0 mt-5">
                <td class="col-md-4">
                  <input id="s_bancoOri" class="efecto tiene-contenido" type="text" db-id="" autocomplete="off" disabled>
                  <label for="s_bancoOri">BANCO</label>
                </td>

                <td class="col-md-4">
                  <input id="s_ctaOri" class="efecto tiene-contenido" type="text" db-id="" autocomplete="off" disabled>
                  <label for="s_ctaOri">CUENTA/INTERBANCARIA</label>
                </td>

                <td class="col-md-4">
                  <input id="fk_id_cuentaMST" class="efecto tiene-contenido" type="text" db-id="" autocomplete="off" disabled>
                  <label for="fk_id_cuentaMST">CUENTA</label>
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
