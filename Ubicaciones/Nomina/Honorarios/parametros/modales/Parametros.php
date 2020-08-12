<!--MODULO 3 * MODULO 3 * MODULO 3 * MODULO 3 * MODULO 3 * MODULO 3-->

<!--Sección Parametros para Modificar Articulo 113-->
<div class="modal fade" id="articulo113">
  <div class="modal-dialog modal-med" style="margin-top:150px">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Modificar</h5>
      </div>
      <div class="modal-body p-0">
        <form class="form1" method="post">
          <table class="table text-center">
            <thead>
              <tr class="row sub3 m-0 h30 align-items-center">
                <td class="col-md-3">Inferior</td>
                <td class="col-md-3">Superior</td>
                <td class="col-md-3">Cuota</td>
                <td class="col-md-3">Porcentaje</td>
              </tr>
            </thead>
            <tbody>
              <tr class="row m-0 text-center">
                <td class="col-md-3 input-effect">
                  <input type="hidden" db-id="" id="s_nombreTabla">
                  <input type="hidden" db-id="" id="pk_id_partida">
                  <input  class="efecto" id="n_inferior">
                </td>
                <td class="col-md-3 input-effect">
                  <input  class="efecto" id="n_superior">
                </td>
                <td class="col-md-3 input-effect">
                  <input  class="efecto" id="n_cuota">
                </td>
                <td class="col-md-3 input-effect">
                  <input  class="efecto" id="n_porcentaje">
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
      <div class="modal-footer">
        <a href="#" class="linkbtn m-editar">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>
