<div class="modal fade text-center" id="buscar_factura">
  <div class="modal-dialog modal-med">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Buscar Factura</h5>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-md-8 titulograndetop">
            <label>FACTURA (PPD)</label>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8 intermedio">
            <form class="form-group" onsubmit="return false;">
             <input class="efecto popup-input " id="pagos-factura" type="text" id-display="#popup-display-pagos-factura" action="facturas_cfdi_CLT_PPD" db-id="" autocomplete="off">
             <div class="popup-list" id="popup-display-pagos-factura" style="display:none"></div>
             <!--label for="pagos-factura">Factura</label-->
             <!--input class="reg border-0 w-100" type="text" onchange="validaSoloNumeros(this);" autocomplete="off"-->
           </form>
          </div>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        Parcialidad <input id="pagos-factura-parcialidad" type="text" class="efecto h22 p-0" size="5" value="" readonly>
        Saldo Anterior <input id="pagos-factura-saldoAnterior" type="text" class="efecto h22 p-0" value="" readonly >
        <a href="#" id="btn_buscarFactura_pagos" onclick="">Buscar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
