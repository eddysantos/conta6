<!--Buscar Facturas de Anticipo-->
<div class="modal fade" id="detpol-buscarfacturas" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Facturas de: Nombre del CLiente (CLT_NUMERO)</h5>
      </div>
      <div class="modal-body" style="padding:0px">
        <div class="container-fluid">
          <div id="contorno" class="contorno">
            <form class="form1"method="post">
              <table class="table text-center table-hover" style="margin-bottom:0px;">
                <thead>
                  <tr class="row tRepoNom">
                    <td class="col-md-2">REFERENCIA</td>
                    <td class="col-md-2">FACTURA</td>
                    <td class="col-md-2">NOTA CREDITO</td>
                    <td class="col-md-2">SALDO FACTURA</td>
                    <td class="col-md-2">PAGO PARCIAL</td>
                    <td class="col-md-2">REGISTRO</td>
                  </tr>
                </thead>
                <tbody>
                  <tr class="row">
                    <td id="centrar" class="col-md-2">N17003469</td>
                    <td id="centrar" class="col-md-2">75729</td>
                    <td id="centrar" class="col-md-2">11111</td>
                    <td id="centrar" class="col-md-2">-3,806.66</td>
                    <td class="col-md-2"><input class="efecto input-dpol input-control text-center" type="text"></td>
                    <td class="col-md-2">
                      <div class="checkbox-xs">
                        <label>
                          <input type="checkbox" data-toggle="toggle">
                        </label>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="" id="btn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>
