<!--Agregar Nuevo proveedor a Catalogo Proveedores-->
<div class="modal fade" id="NuevoProveedor" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Agregar Nuevo Proveedor</h5>
      </div>
      <div class="modal-body" style="padding:0px">
        <div class="container-fluid">
          <div id="contorno" class="contorno">
            <form class="form1"method="post">
              <table class="table">
                <tbody class="cuerpo">
                  <tr class="row">
                    <td class="col-md-12 input-effect brx1">
                      <input id="razonsocial" class="efecto text-center text-normal" type="text">
                      <label for="razonsocial">RAZÓN SOCIAL</label>
                    </td>
                  </tr>
                  <tr class="row">
                    <td class="col-md-4 input-effect brx2">
                      <input  list="persona" class="text-normal efecto text-center"  id="per">
                      <datalist id="persona">
                        <option>Fisica</option>
                        <option>Moral</option>
                      </datalist>
                      <label for="per">PERSONA</label>
                    </td>
                    <td class="col-md-4 input-effect brx2">
                      <input id="rfc" class="efecto text-center text-normal" type="text">
                      <label for="rfc">RCF</label>
                    </td>
                    <td class="col-md-4 input-effect brx2">
                      <input id="curp" class="efecto text-center text-normal" type="text">
                      <label for="curp">CURP</label>
                    </td>
                  </tr>
                  <tr class="row">
                    <td class="col-md-12 input-effect brx2">
                      <input id="domfiscal" class="efecto text-center text-normal" type="text">
                      <label for="domfiscal">DOMICILIO FISCAL</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" id="btn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
