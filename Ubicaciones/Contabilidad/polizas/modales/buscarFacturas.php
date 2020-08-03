<!--Buscar Facturas en Captura detalle de poliza-->
<div class="modal fade" id="detpol-buscarfacturas" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header row font14 m-0 align-items-center">
        <div class="col-md-1">
          <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
            <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
          </button>
        </div>
        <div class="col-md-2 text-center">Facturas de:</div>
        <div class="col-md-9">
          <input class="bt border-0 h22 w-100 fw-bold" id="detpol-cliente-nombre" type="text" readonly>
        </div>
      </div>
      <div class="modal-body p-0">
        <div id="contorno" class="contorno">
          <table class="table text-center table-hover m-0 fixed-table">
            <thead>
              <tr class="row encabezado fw-bold b align-items-center">
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
            <tbody id="detpol-buscarfacturas-lista"></tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
    </div><!--termina el COntenido del Modal-->
  </div>
</div>


<!--Buscar Sueldos y Salarios en Detalle de poliza-->
<div class="modal fade" id="detpol-Sueldos" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">CFDI de Nomina Sueldos y Salarios</h5>
      </div>
      <div class="modal-body p-0">
        <div id="contorno" class="contorno">
          <table class="table text-center table-hover">
            <thead>
              <tr class="row encabezado">
                <td class="col-md-1">SEMANA</td>
                <td class="col-md-1">BANCO</td>
                <td class="col-md-2">CUENTA</td>
                <td class="col-md-1">FACTURA</td>
                <td class="col-md-5">EMPLEADO</td>
                <td class="col-md-1">IMPORTE</td>
                <td class="col-md-1"></td>
              </tr>
            </thead>
            <tbody id="detpol-Sueldos-lista"></tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <!--div class="modal-footer">
        <a href="" class="linkbtn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div-->
    </div><!--termina el COntenido del Modal-->
  </div>
</div>



<!--Buscar CFDI Honorarios en Detalle de poliza-->
<div class="modal fade" id="detpol-Honorarios" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">CFDI de Nomina Honorarios</h5>
      </div>
      <div class="modal-body p-0">
        <div id="contorno" class="contorno">
          <table class="table text-center table-hover">
            <thead>
              <tr class="row encabezado">
                <td class="col-md-1">SEMANA</td>
                <td class="col-md-1">BANCO</td>
                <td class="col-md-2">CUENTA</td>
                <td class="col-md-1">FACTURA</td>
                <td class="col-md-5">EMPLEADO</td>
                <td class="col-md-1">IMPORTE</td>
                <td class="col-md-1"></td>
              </tr>
            </thead>
            <tbody id="detpol-Honorarios-lista"></tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <!--div class="modal-footer">
        <a href="" class="linkbtn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div-->
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
