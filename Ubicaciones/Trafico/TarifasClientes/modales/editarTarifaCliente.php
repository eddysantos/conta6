<!--MODIFICAR REGISTRO DE TARIFA-->
<div class="modal fade" id="EditarRegTarifaCliente" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Modificar Registro de Tarifa</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
          <div id="" class="contorno">
            <form class="form2" >
              <table class="table text-center">
                <tbody>
                  <tr class="row">
                    <td class="col-md-1 input-effect brx2" >
                      <input  list="lista-uni" class="text-normal efecto" id="m-unidad1">
                      <datalist id="lista-uni"></datalist>
                      <label style="left:1px!important" for="m-unidad1">Unidad</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="m-liminf1" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-liminf1">Lim.Inferior</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input id="m-limsup1" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-limsup1">Lim.Superior</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="m-impo" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-impo">Importe 1</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="m-infdia1" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-infdia1">Inf.Día</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="m-supdia1" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-supdia1">Sup.Día</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="m-impo2" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="m-impo2">Importe 2</label>
                    </td>
                    <td class="col-md-1 input-effect brx2" >
                      <input  list="lista-ope" class="text-normal efecto" id="m-operacion1">
                      <datalist id="lista-ope"></datalist>
                      <label style="left:1px!important" for="m-operacion1">Operación</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="mt-fact1" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="mt-fact1">Factor 1</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="mt-fact2" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="mt-fact2">Factor 2</label>
                    </td>
                    <td class="col-md-1 input-effect brx2">
                      <input id="mt-fact3" class="efecto text-normal w-100" type="text">
                      <label style="left:1px!important" for="mt-fact3">Factor 3</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" id="btn">ACEPTAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
