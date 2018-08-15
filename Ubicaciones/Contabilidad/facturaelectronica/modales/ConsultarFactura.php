<!--Buscar Facturas en Captura detalle de poliza-->
<div class="modal fade text-center" id="ConsultarFactura" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Consultar Factura</h5>
      </div>
      <div class="modal-body">
        <div class="contorno">
          <table class="table form1">
            <thead>
              <tr class="row encabezado">
                <td class="col-md-12">BUSCAR FACTURA</td>
              </tr>
            </thead>
            <tbody class="font14">
              <tr class="row mt-5">
                <td class="col-md-2 input-effect">
                  <input id="b-referencia" class="efecto" type="text">
                  <label for="b-referencia">Por Referencia</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="b-factura" class="efecto" type="text">
                  <label for="b-factura">Por Factura</label>
                </td>
                <td class="col-md-8 input-effect">
                  <input  list="clientes" class="efecto"  id="b-cliente">
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
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="/conta6/Ubicaciones/Contabilidad/facturaelectronica/4-Consultarfactura.php" class="linkbtn">Buscar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>


<!--Cancelar Factura-->
<div class="modal fade text-center" id="CancelarFactura" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Cancelar Factura</h5>
      </div>
      <div class="modal-body">
        <div class="contorno">
          <table class="table form1">
            <thead>
              <tr class="row encabezado">
                <td class="col-md-12">BUSCAR FACTURA</td>
              </tr>
            </thead>
            <tbody class="font14">
              <tr class="row mt-5">
                <td class="col-md-2 input-effect">
                  <input id="b-referencia1" class="efecto" type="text">
                  <label for="b-referencia1">Por Referencia</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="b-factura1" class="efecto" type="text">
                  <label for="b-factura1">Por Factura</label>
                </td>
                <td class="col-md-8 input-effect">
                  <input  list="clientes" class="efecto"  id="b-cliente1">
                  <datalist id="clientes">
                    <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                    <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                  </datalist>
                  <label for="b-cliente1">Cliente</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="/conta6/Ubicaciones/Contabilidad/facturaelectronica/5-Cancelarfactura.php" class="linkbtn">Buscar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
