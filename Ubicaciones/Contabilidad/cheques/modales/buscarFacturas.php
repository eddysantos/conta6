<!--Buscar Facturas cheques-->
<div class="modal fade" id="detpol-buscarfacturas" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Facturas de: <input class="efecto bt border-0 h22" id="detche-cliente-nombre" type="text" readonly></h5>
      </div>
      <div class="modal-body p-0">
        <div class="contorno">
          <table class="table text-center table-hover m-0">
            <thead>
              <tr class="row encabezado">
                <td class="col-md-2">REFERENCIA</td>
                <td class="col-md-1">FACTURA</td>
                <td class="col-md-1">CTA GASTOS</td>
                <td class="col-md-1">NOTA CREDITO</td>
                <td class="col-md-2">SALDO FACTURA</td>
                <td class="col-md-2">PAGO PARCIAL</td>
                <td class="col-md-1">REGISTRO</td>
                <td class="col-md-2">CUENTA</td>
              </tr>
            </thead>
            <tbody id="detche-buscarfacturas-lista"></tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
