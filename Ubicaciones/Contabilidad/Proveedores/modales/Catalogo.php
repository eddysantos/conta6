<!--Agregar Nuevo proveedor a Catalogo Proveedores-->
<div class="modal fade text-center" id="NuevoProveedor" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Agregar Nuevo Proveedor</h5>
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
              <tr class="row mt-4">
                <td class="col-md-4 input-effect">
                  <input  list="persona" class="efecto"  id="mper">
                  <datalist id="persona">
                    <option>Fisica</option>
                    <option>Moral</option>
                  </datalist>
                  <label for="mper">PERSONA</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="mrfc" class="efecto" type="text">
                  <label for="mrfc">RCF</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="mcurp" class="efecto" type="text">
                  <label for="mcurp">CURP</label>
                </td>
              </tr>
              <tr class="row mt-4">
                <td class="col-md-12 input-effect">
                  <input id="mdomfiscal" class="efecto" type="text">
                  <label for="mdomfiscal">DOMICILIO FISCAL</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" class="linkbtn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
