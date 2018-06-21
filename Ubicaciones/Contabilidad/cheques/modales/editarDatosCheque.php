<!--Editar Datos de Anticipo-->
<div class="modal fade text-center" id="ch-editarRegMST" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Datos de Cheque</h5>
      </div>
      <div class="modal-body">
        <div class="contorno-modal" id="contorno">
          <table class="table form1 font14">
            <tbody>
              <tr class="row m-0 mt-5">
                <td class="col-md-3">
                  <input class="efecto tiene-contenido" type="text"  value="3345">
                  <label for="ch-fecha">Cheque</label>
                </td>

                <td class="col-md-3">
                  <input id="ch-fecha" class="efecto tiene-contenido" type="date">
                  <label for="ch-fecha">Fecha</label>
                </td>

                <td class="col-md-3">
                  <input class="efecto tiene-contenido" type="text" value="$123,456">
                  <label for="ch-fecha">Importe</label>
                </td>

                <td class="col-md-3">
                  <input id="ch-cuenta" class="efecto tiene-contenido" value="0100-00006" type="text">
                  <label for="ch-cuenta">Cuenta</label>
                </td>
              </tr>
              <tr class="row mt-5 m-0">
                <td class="col-md-6">
                  <input  list="ch-benef" class="efecto tiene-contenido" id="ch-beneficiario">
                  <datalist id="ch-benef">
                    <option value="SERVICIO NACIONAL DE SANIDAD, INOCUIDAD Y CALIDAD AGROALIMENTARIA -- SPM860820CF5"></option>
                    <option value="CAMINOS Y PUENTES FEDERALES DE INGRESOS Y SERVICIOS CONEXOS -- CPF6307036N8"></option>
                  </datalist>
                  <label for="ch-beneficiario">Beneficiatrio</label>
                </td>
                <td class="col-md-6">
                  <input id="ch-concep" class="efecto tiene-contenido" value="CONCEPTO DE LA POLIZA CONCEPTO DE LA POLIZA" type="text">
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
