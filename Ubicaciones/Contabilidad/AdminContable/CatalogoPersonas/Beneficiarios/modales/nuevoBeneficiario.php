<!--Agregar Nuevo beneficiario a Catalogo Beneficiario-->
<div class="modal fade text-center" id="NuevoBeneficiario">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>Agregar Nuevo Beneficiario</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <div id="contorno" class="contorno">
          <table class="table">
            <tbody class="font14">
                <tr class="row">
                  <td class="col-md-12 input-effect mt-3">
                    <input id="ben_razonsocial" class="efecto" type="text">
                    <label for="ben_razonsocial">RAZÓN SOCIAL</label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-6 input-effect">
                    <input id="ben_mrfc" class="efecto" type="text">
                    <label for="ben_mrfc">RFC</label>
                  </td>
                  <td class="col-md-6 input-effect">
                    <input id="ben_taxid" class="efecto" type="text">
                    <label for="ben_taxid">Tax ID</label>
                  </td>
                </tr>
            </tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="#" id="btn_genBen" class="btn_agregarBeneficiario linkbtn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
