<!--EDITAR Cierre de mes-->
<div class="modal fade" id="EditarCierre" style="margin-top:50px">
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
            <form class="form1">
              <table class="table text-center">
                <tbody class="font14">
                  <tr class="row mt-4">
                    <td class="col-md-2 input-effect">
                      <select class="custom-select" id="oficina">
                        <option selected>Seleccione Oficina</option>
                        <option>Todas</option>
                        <option>Nuevo Laredo</option>
                        <option>Manzanillo</option>
                        <option>Aeropuerto</option>
                        <option>Veracruz</option>
                      </select>
                    </td>
                    <td class="col-md-1 input-effect">
                      <select class="custom-select" id="año">
                        <option selected>Año</option>
                        <option value="1">2017</option>
                        <option value="2">2015</option>
                        <option value="3">2014</option>
                        <option value="4">2011</option>
                        <option value="5">2010</option>
                      </select>
                    </td>
                    <td class="col-md-1 input-effect">
                      <input id="modulo" class="efecto tiene-contenido" type="text">
                      <label class="font12" for="modulo">MÓDULO</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="idcierre" class="efecto tiene-contenido" type="text">
                      <label class="font12" for="idcierre">ID CIERRE</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input class="efecto tiene-contenido" id="fini1" type="date">
                      <label class="font12" for="fini1">FECHA INICIAL</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input class="efecto tiene-contenido" id="ffin1" type="date">
                      <label class="font12" for="ffin1">FECHA FINAL</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" id="btn">ACTUALIZAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
