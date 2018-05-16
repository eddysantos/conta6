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
      <div class="modal-body" style="padding:0px">
        <div class="container-fluid">
          <div id="" class="contorno">
            <table class="table" style="margin-bottom:0px">
              <tbody class="cuerpo">
                <tr class="row brx2">
                  <td class="col-md-12 input-effect">
                    <input  list="cuentasSAT" class="text-normal efecto text-center"  id="edit-ctaSAT">
                    <datalist id="cuentasSAT"></datalist>
                    <label for="edit-ctaSAT">CUENTAS SAT</label>
                  </td>
                </tr>
                <tr class="row brx2">
                  <td class="col-md-6 input-effect">
                    <input id="concepto" class="efecto text-center" type="text">
                    <label for="concepto">CONCEPTO</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input  list="status" class="efecto"  id="medit-status">
                    <datalist id="status">
                      <option>Activa</option>
                      <option>Inactiva</option>
                    </datalist>
                    <label for="edit-status">ESTATUS CAPTURA</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input  list="NSAT" class="efecto"  id="medit-naturSAT">
                    <datalist id="NSAT"></datalist>
                    <label for="edit-naturSAT">NATURALEZA SAT</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" id="btn">GUARDAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
