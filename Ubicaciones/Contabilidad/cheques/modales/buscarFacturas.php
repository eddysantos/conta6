<!--Buscar Facturas cheques-->
<div class="modal fade" id="detpol-buscarfacturas">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bordenegro border-radius">
      <div class="modal-header border-0 align-items-center">
        <h6 class="modal-title mx-3 s_gris_100">Facturas de:</h6>
        <div class="col-md-9">
          <input class="bt border-0 h22 w-100 fw-bold" id="detche-cliente-nombre" type="text" readonly>
        </div>
        <a href="#" type="button" class="close mr-3 actualizar_usuario" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <div class="contorno">
          <table class="table text-center table-hover m-0 fixed-table">
            <thead>
              <tr class="row encabezado fw-bold b align-items-center font14">
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
