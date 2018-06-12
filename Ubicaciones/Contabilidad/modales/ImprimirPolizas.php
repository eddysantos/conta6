<!--Imprimir Polizas-->
<div class="modal fade" id="imprimir-pol" style="margin-top:50px">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Imprimir Pólizass</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
          <div id="contorno" class="contorno-modal">
            <form class="form1">
              <table class="table text-center">
                <tbody>
                  <tr class="row m-0 mt-3">
                    <td class="col-md-4 input-effect mt-4">
                      <input class="efecto tiene-contenido" type="date" id="imp-fechaIn">
                      <label for="imp-fechaIn">Fecha Inicial</label>
                    </td>
                    <td class="col-md-4 input-effect mt-4">
                      <input class="efecto tiene-contenido" type="date" id="imp-fechaFin">
                      <label for="imp-fechaFin">Fecha Final</label>
                    </td>
                    <td class="col-md-4">
                      <label class="mb-1 font14" style="color: #d59f9f;">Gasto Oficina</label>
                      <select class="custom-select">
                        <option value="">1 - Cheques</option>
                        <option value="">2 - Ingresos</option>
                        <option value="">3 - Facturas / NC</option>
                        <option value="">4 - Diario</option>
                        <option value="">5 - Anticipos</option>
                      </select>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" class="linkbtn">Consultar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>

<script src="/conta6/Resources/js/Inputs.js"></script>
