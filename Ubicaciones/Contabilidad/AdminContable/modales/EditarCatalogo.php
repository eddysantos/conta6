<!--EDITAR CATALO DE CUENTAS-->
<div class="modal fade" id="EditarCatalogo" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Catalogo de Cuentas</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
          <div id="" class="contorno">
            <table class="table m-0">
              <tbody class="cuerpo">
                <tr class="row mt-4">
                  <td class="col-md-12 input-effect">
        				  	<input class="efecto disabled readonly" id="pk_id_cuenta" type="text" db-id="" autocomplete="new-password" disabled>
        					  <label for="pk_id_cuenta" style="padding-top:.10rem">CUENTA</label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-12 input-effect">
        				  	<input class="efecto popup-input" id="fk_codAgrup" type="text" id-display="#medit-popup-display-cuentas_sat" action="cuentas_sat" db-id="" autocomplete="new-password">
        					  <div class="popup-list" id="medit-popup-display-cuentas_sat" style="display:none"></div>
        					  <label for="pk_id_cuenta" style="padding-top:.10rem">CUENTAS SAT
        						<a href="#"><img src="/conta6/Resources/iconos/help.svg"></a>
        					  </label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-6 input-effect">
                    <!--input id="mconcepto" class="efecto" type="text"-->
				              <input id="s_cta_desc" class="efecto" type="text" maxlength="100">
                      <label for="s_cta_desc">CONCEPTO</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <select class="custom-select" id="s_cta_status">
                      <option selected>ESTATUS CAPTURA</option>
                      <option value="1">Activa</option>
                      <option value="0">Inactiva</option>
                    </select>
                  </td>
                  <td class="col-md-3 input-effect">
				  	        <input class="efecto popup-input" id="fk_id_naturaleza" type="text" id-display="#medit-popup-display-cuentas_sat_natur" action="cuentas_sat_natur" db-id="" autocomplete="new-password">
                  	<div class="popup-list" id="medit-popup-display-cuentas_sat_natur" style="display:none"></div>
                    <label for="fk_id_naturaleza">NATURALEZA SAT</label>
                  </td>
                </tr>
				        <tr class="row mt-4">
                  <td class="col-md-12 input-effect">
                    <input class="efecto popup-input" id="fk_c_ClaveProdServ" type="text" id-display="#medit-popup-display-prodServ" action="prodServ_sat" db-id="" autocomplete="new-password">
					          <div class="popup-list" id="medit-popup-display-prodServ" style="display:none"></div>
                    <label for="medit-prodServ">PRODUCTO O SERVICIO SAT</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="#" id="medit-ctas">GUARDAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
