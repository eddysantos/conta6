<!--Buscar Facturas en Captura detalle de poliza-->
<div class="modal fade" id="ConsultarFactura" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Consultar Factura</h5>
      </div>
      <div class="modal-body" style="padding:0px">
        <div class="container-fluid">
          <div id="" class="contorno">
            <table class="table text-center">
              <thead>
                <tr class="row encabezado">
                  <td class="col-md-12">BUSCAR FACTURA</td>
                </tr>
              </thead>
              <tbody class="cuerpo">
                <tr class="row mt-5">
                  <td class="col-md-2 input-effect">
                    <input id="b-referencia" class="efecto text-center text-normal" type="text">
                    <label for="b-referencia">Por Referencia</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="b-factura" class="efecto text-center text-normal" type="text">
                    <label for="b-factura">Por Factura</label>
                  </td>
                  <td class="col-md-8 input-effect">
                    <input  list="clientes" class="text-normal efecto text-center"  id="b-cliente">
                    <datalist id="clientes">
                      <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                      <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                    </datalist>
                    <label for="b-cliente">Cliente</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="/conta6/Ubicaciones/Contabilidad/facturaelectronica/4-Consultarfactura.php" id="btn">Buscar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>


<!--Cancelar Factura-->
<div class="modal fade" id="CancelarFactura" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Cancelar Factura</h5>
      </div>
      <div class="modal-body" style="padding:0px">
        <div class="container-fluid">
          <div id="" class="contorno">
            <table class="table">
              <thead>
                <tr class="row encabezado">
                  <td class="col-md-12 text-center">BUSCAR FACTURA</td>
                </tr>
              </thead>
              <tbody class="cuerpo">
                <tr class="row mt-5">
                  <td class="col-md-2 input-effect">
                    <input id="b-referencia" class="efecto text-center text-normal" type="text" >
                    <label for="b-referencia">Por Referencia</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="b-factura" class="efecto text-center text-normal" type="text" >
                    <label for="b-factura">Por Factura</label>
                  </td>
                  <td class="col-md-8 input-effect">
                    <input  list="clientes" class="text-normal efecto text-center"  id="b-cliente">
                    <datalist id="clientes">
                      <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                      <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                    </datalist>
                    <label for="b-cliente">Cliente</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="/conta6/Ubicaciones/Contabilidad/facturaelectronica/5-Cancelarfactura.php" id="btn">Buscar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
