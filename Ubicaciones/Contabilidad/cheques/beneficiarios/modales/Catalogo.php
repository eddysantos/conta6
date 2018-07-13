<!--Agregar Nuevo beneficiario a Catalogo Beneficiario-->
<div class="modal fade text-center" id="NuevoBeneficiario" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Agregar Nuevo Beneficiario</h5>
      </div>
      <div class="modal-body p-0">
        <div id="contorno" class="contorno">
          <table class="table form1">
            <tbody class="font14">
                <tr class="row">
                  <td class="col-md-12 input-effect mt-3">
                    <input id="razonsocial" class="efecto" type="text">
                    <label for="razonsocial">RAZÓN SOCIAL</label>
                  </td>
                </tr>
                <td class="col-md-4 input-effect">
                  <input id="mrfc" class="efecto" type="text">
                  <label for="mrfc">RCF</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="taxid" class="efecto" type="text">
                  <label for="taxid">Tax ID</label>
                </td>
            </tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="#" id="btn_genBen" class="linkbtn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
