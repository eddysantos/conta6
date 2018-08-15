<!--AGREGAR NUEVO CORRESPONSAL-->
<div class="modal fade text-center" id="catalogo" style="margin-top:50px">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Generar Concepto</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
          <div id="" class="contorno">
            <table class="table form1">
              <tbody>
                <tr class="row mt-3">
                  <td class="col-md-12 input-effect">
                    <input id="cat_con" class="efecto">
                    <label for="cat_con">Concepto General</label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-12 input-effect">
                    <input id="cat_obs" class="efecto">
                    <label for="cat_obs">Observaciones</label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-12 input-effect">
                    <input  list="cat_tip" class="font14 efecto" id="tipoing">
                    <datalist id="cat_tip">
                      <option value="I --- Ingresos"></option>
                      <option value="PTP --- Pago a Terceros Parcial"></option>
                      <option value="PTT --- Pago a Terceros Total"></option>
                    </datalist>
                    <label for="tipoing">Tipo de Ingreso</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" class="linkbtn">Aceptar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
