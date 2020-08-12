
<!-- <div class="modal fade text-center" id="NuevoProveedor" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Agregar Nuevo Proveedor</h5>
      </div>
      <div class="modal-body p-0">
        <div id="contorno" class="contorno">
          <table class="table form1">
            <tbody class="font14">
              <tr class='row mt-4'>
                <td class='col-md-4 input-effect'>
                  <input id='nombreN_prov' class='efecto tiene-contenido' type='text' value='' onblur='eliminaBlancosIntermedios(this);todasMayusculas(this);'>
                  <label for='nombreN_prov'>Nombre o Razón Social</label>
                </td>
                <td class='col-md-4 input-effect'>
                  <label for='personaN_prov'>Persona</label>
                  <select size='1' id='personaN_prov'>
                  <option value='fisica'>Fisica</option>
                  <option value='moral' selected>Moral</option>
                  </select>
                </td>
              </tr>
              <tr class='row mt-4'>
                <td class='col-md-4 input-effect'>
                  <input id='rfcN_prov' class='efecto tiene-contenido' type='text' value='' onblur='eliminaBlancosIntermedios(this);todasMayusculas(this);validaRFC(this);'>
                  <label for='rfcN_prov'>RCF</label>
                </td>
                <td class='col-md-4 input-effect'>
                  <input id='curpN_prov' class='efecto tiene-contenido' type='text' value='' onblur='eliminaBlancosIntermedios(this);todasMayusculas(this);validaCURP(this);'>
                  <label for='curpN_prov'>CURP</label>
                </td>
                <td class='col-md-3 input-effect'>
                  <input id='taxidN_prov' class='efecto tiene-contenido' type='text' value='' onblur='eliminaBlancosIntermedios(this);'>
                  <label for='taxidN_prov'>Tax ID</label>
                </td>
              </tr>
              <tr class='row mt-4'>
                <td class='col-md-10 input-effect'>
                  <input id='direccionN_prov' class='efecto tiene-contenido' type='text' value='' onblur='eliminaBlancosIntermedios(this);'>
                  <label for='direccionN_prov'>Dirección</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" id="btn_genProv" class="linkbtn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div> -->



<!--Agregar Nuevo beneficiario a Catalogo Beneficiario-->
<div class="modal fade text-center" id="NuevoProveedor" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Agregar Nuevo Proveedor</h5>
      </div>
      <div class="modal-body p-0">
        <div id="contorno" class="contorno">
          <table class="table form1">
            <tbody class="font14">
              <tr class='row'>
                <td class='col-md-4 input-effect  mt-4'>
                  <input id='nombreN_prov' class='efecto tiene-contenido' type='text' value='' onblur='eliminaBlancosIntermedios(this);todasMayusculas(this);'>
                  <label for='nombreN_prov'>Nombre o Razón Social</label>
                </td>
                <td class='col-md-2 input-effect'>
                  <label for='personaN_prov'>Persona</label>
                  <select size='1' id='personaN_prov' class="custom-select">
                  <option value='fisica'>Fisica</option>
                  <option value='moral' selected>Moral</option>
                  </select>
                </td>
                <td class='col-md-3 input-effect  mt-4'>
                  <input id='rfcN_prov' class='efecto tiene-contenido' type='text' value='' onblur='eliminaBlancosIntermedios(this);todasMayusculas(this);validaRFC(this);'>
                  <label for='rfcN_prov'>RCF</label>
                </td>
                <td class='col-md-3 input-effect  mt-4'>
                  <input id='curpN_prov' class='efecto tiene-contenido' type='text' value='' onblur='eliminaBlancosIntermedios(this);todasMayusculas(this);validaCURP(this);'>
                  <label for='curpN_prov'>CURP</label>
                </td>
              </tr>
              <tr class='row mt-4'>
                <td class='col-md-2 input-effect'>
                  <input id='taxidN_prov' class='efecto tiene-contenido' type='text' value='' onblur='eliminaBlancosIntermedios(this);'>
                  <label for='taxidN_prov'>Tax ID</label>
                </td>
                <td class='col-md-10 input-effect'>
                  <input id='direccionN_prov' class='efecto tiene-contenido' type='text' value='' onblur='eliminaBlancosIntermedios(this);'>
                  <label for='direccionN_prov'>Dirección</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="#" id="btn_genProv" class="linkbtn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
