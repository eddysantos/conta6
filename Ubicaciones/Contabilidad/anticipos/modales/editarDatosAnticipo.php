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
                  <input class="efecto tiene-contenido" type="date" value="<?php echo $rowMST['d_fecha']; ?>">
                  <label for="ant-cliente">Fecha Anticipo</label>
                </td>

                <td class="col-md-3">
                  <input id="ant-valor" class="efecto tiene-contenido" value="<?php echo $rowMST['n_valor']; ?>" type="text">
                  <label for="ant-valor">Valor</label>
                </td>

                <td class="col-md-6 input-effect">
          			  <select class="custom-select" size='1' name='ant-cuenta' id='ant-cuenta'>
          				  <option selected value='0'>Seleccione una Cuenta</option>
          				</select>
          			</td>
              </tr>
              <tr class="row m-0 mt-5">
                <td class="col-md-3">
    			        <input class="efecto tiene-contenido popup-input" id="ant-cliente" type="text" id-display="#popup-display-ant-cliente" action="clientes" value="<?php echo $rowMST['fk_id_cliente']; ?>" db-id="<?php echo $rowMST['fk_id_cliente']; ?>" autocomplete="new-password" onblur="Actualiza_Expedido_Cliente_MST()">
                  <div class="popup-list" id="popup-display-ant-cliente" style="display:none"></div>
                  <label for="ant-cliente">Cliente</label>
                </td>

                <td class="col-md-3">
                  <select class="custom-select" size='1' name='ant-bcocliente' id='ant-bcocliente'>
                  	<option selected value='0'>Seleccione Banco</option>
                  </select>
    			      </td>

                <td class="col-md-6">
                  <input id="ch-concep" class="efecto tiene-contenido" value="<?php echo $rowMST['s_concepto']; ?>" type="text">
                  <label for="ch-concep">CONCEPTO</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <a href="" class="linkbtn">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>
