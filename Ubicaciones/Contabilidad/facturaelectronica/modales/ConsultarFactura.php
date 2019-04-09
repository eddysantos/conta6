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
                  <input class="efecto popup-input" id="b-referencia" type="text" id-display="#popup-display-b-referencia" action="facturas_cfdi_referencia" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-b-referencia" style="display:none"></div>
                  <label for="b-referencia">Por Referencia</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input class="efecto popup-input" id="b-factura" type="text" id-display="#popup-display-b-factura" action="facturas_cfdi" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-b-factura" style="display:none"></div>
                  <label for="b-factura">Por Factura</label>
                </td>
                <?php if( $oRst_permisos['s_facturas_lista'] == 1) {?>
                <td class="col-md-8 input-effect">
                  <input class="efecto popup-input" id="b-cliente" type="text" id-display="#popup-display-b-cliente" action="facturas_cfdi_cliente" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-b-cliente" style="display:none"></div>
                  <label for="b-cliente">Por Cliente</label>
                </td>
              <?php } ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="#" id="btn_buscarFacturasTimbradas" class="linkbtn">Buscar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
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
                  <input class="efecto popup-input" id="b-referencia1" type="text" id-display="#popup-display-b-referencia1" action="facturas_cfdi_referencia" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-b-referencia1" style="display:none"></div>
                  <label for="b-referencia1">Por Referencia</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input class="efecto popup-input" id="b-factura1" type="text" id-display="#popup-display-b-factura1" action="facturas_cfdi" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-b-factura1" style="display:none"></div>
                  <label for="b-factura1">Por Factura</label>
                </td>
                <?php if( $oRst_permisos['CFDI_lista_facturas'] == 1) {?>
                <td class="col-md-8 input-effect">
                  <input class="efecto popup-input" id="b-cliente1" type="text" id-display="#popup-display-b-cliente1" action="facturas_cfdi_cliente" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-b-cliente1" style="display:none"></div>
                  <label for="b-cliente1">Por Cliente</label>
                </td>
              <?php } ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="#" id="btn_buscarFacturasTimbradas_cancela" class="linkbtn">Buscar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        <!--a href="/conta6/Ubicaciones/Contabilidad/facturaelectronica/5-Cancelarfactura.php" class="linkbtn">Buscar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a-->
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
