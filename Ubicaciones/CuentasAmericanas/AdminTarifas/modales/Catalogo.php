<!--AGREGAR NUEVO CORRESPONSAL-->
<div class="modal fade" id="catalogo" style="margin-top:50px">
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
            <form class="form1">
              <table class="table text-center m-0">
                <tbody>
                  <tr class="row  m-0">
                    <td class="col-md-12 brx1 input-effect">
                      <input id="cat_con" class="efecto text-center">
                      <label for="cat_con">Concepto General</label>
                    </td>
                  </tr>
                  <tr class="row  m-0">
                    <td class="col-md-12 brx2 input-effect">
                      <input id="cat_obs" class="efecto text-center">
                      <label for="cat_obs">Observaciones</label>
                    </td>
                  </tr>
                  <tr class="row m-0">
                    <td class="col-md-12 brx2 input-effect">
                      <input  list="cat_tip" class="text-normal efecto text-center"  id="tipoing">
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
            </form>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" id="btn">Aceptar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
