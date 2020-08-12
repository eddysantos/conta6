<!--EDITAR CATALO DE CUENTAS-->
<div class="modal fade text-center" id="EditarCatalogo" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content m_bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>Editar Catalogo de Cuentas</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Conta6/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <div id="" class="contorno">
          <table class="table form1 m-0">
            <tbody class="font14">
              <tr class="row mt-4">
                <td class="col-md-3 input-effect">
      				  	<input class="efecto tiene-contenido disabled readonly" id="pk_id_cuenta" type="text" db-id="" autocomplete="off" disabled>
      					  <label for="pk_id_cuenta">CUENTA</label>
                </td>
                <td class="col-md-4 input-effect">
      				  	<input class="efecto tiene-contenido popup-input" id="fk_codAgrup" type="text" id-display="#medit-popup-display-cuentas_sat" action="cuentas_sat" db-id="" autocomplete="off">
      					  <div class="popup-list" id="medit-popup-display-cuentas_sat" style="display:none"></div>
      					  <label for="fk_codAgrup">CUENTAS SAT
      					  </label>
                </td>
                <td class="col-md-5 input-effect">
		              <input id="s_cta_desc" class="efecto tiene-contenido" type="text" maxlength="100">
                  <label for="s_cta_desc">CONCEPTO</label>
                </td>
              </tr>
              <tr class="row">
                <td class="col-md-3 input-effect mt-4">
			  	        <input class="efecto tiene-contenido popup-input" id="fk_id_naturaleza" type="text" id-display="#medit-popup-display-cuentas_sat_natur" action="cuentas_sat_natur" db-id="" autocomplete="off">
                	<div class="popup-list" id="medit-popup-display-cuentas_sat_natur" style="display:none"></div>
                  <label for="fk_id_naturaleza">NATURALEZA SAT</label>
                </td>
                <td class="col-md-4 input-effect">
                  <label class="mb-0 font14">STATUS</label>
                  <select class="custom-select mt-1" id="s_cta_status">
                    <option selected>ESTATUS CAPTURA</option>
                    <option value="1">Activa</option>
                    <option value="0">Inactiva</option>
                  </select>
                </td>
                <td class="col-md-5 input-effect mt-4">
                  <input class="efecto tiene-contenido popup-input" id="fk_c_ClaveProdServ" type="text" id-display="#medit-popup-display-prodServ" action="prodServ_sat" db-id="" autocomplete="off">
				          <div class="popup-list" id="medit-popup-display-prodServ" style="display:none"></div>
                  <label for="fk_c_ClaveProdServ">PRODUCTO O SERVICIO SAT</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer border-0 mt-3">
        <a href="#" id="medit-ctas">GUARDAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
