<!--Buscar Facturas en Captura detalle de poliza-->
<div class="modal fade" id="detpol-buscarfacturas" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content m_bordenegro">
      <div class="modal-header row m-0 border-0 align-items-center">
        <div class='col-md-2 text-center'>Facturas de:</div>
        <div class="col-md-9">
          <input class="bt border-0 h22 w-100 fw-bold" id="detpol-cliente-nombre" type="text" readonly>
        </div>
        <div class="col-md-1">
          <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Conta6/Resources/iconos/close.svg"></a>
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
      </div>
    </div>
  </div>
</div>


<!--Buscar Sueldos y Salarios en Detalle de poliza-->
<div class="modal fade" id="detpol-Sueldos" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content m_bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>CFDI de Nomina Sueldos y Salarios</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Conta6/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <div id="contorno" class="contorno">
          <table class="table text-center table-hover">
            <thead>
              <tr class="row encabezado">
                <td class="p-1 col-md-1">BANCO</td>
                <td class="p-1 col-md-2">CUENTA</td>
                <td class="p-1 col-md-1">FACTURA</td>
                <td class="p-1 col-md-5">EMPLEADO</td>
                <td class="p-1 col-md-2">IMPORTE</td>
                <td class="p-1 col-md-1"></td>
              </tr>
            </thead>
            <tbody>
              <tr class="row align-items-center">
                <td class="p-1 col-md-1">002</td>
                <td class="p-1 col-md-2">5256781310703496</td>
                <td class="p-1 col-md-1">15668</td>
                <td class="p-1 col-md-5">Diana Eustolia Rodriguez Ramos</td>
                <td class="p-1 col-md-2">$ 1,312.18</td>
                <td class="p-1 col-md-1">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1"></label>
                  </div>
                </td>
              </tr>
              <tr class="row align-items-center">
                <td class="p-1 col-md-1">001</td>
                <td class="p-1 col-md-2">012821015214161544</td>
                <td class="p-1 col-md-1">15726</td>
                <td class="p-1 col-md-5">Domingo Martinez Martinez</td>
                <td class="p-1 col-md-2">$ 4,915.46</td>
                <td class="p-1 col-md-1">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1"></label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer border-0 mt-3">
        <a href="" class="linkbtn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>



<!--Buscar CFDI Honorarios en Detalle de poliza-->
<div class="modal fade" id="detpol-Honorarios" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content m_bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>CFDI de Nomina Honorarios</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Conta6/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <div id="contorno" class="contorno">
          <table class="table text-center table-hover">
            <thead>
              <tr class="row encabezado">
                <td class="p-1 col-md-1">BANCO</td>
                <td class="p-1 col-md-2">CUENTA</td>
                <td class="p-1 col-md-1">FACTURA</td>
                <td class="p-1 col-md-5">EMPLEADO</td>
                <td class="p-1 col-md-2">IMPORTE</td>
                <td class="p-1 col-md-1"></td>
              </tr>
            </thead>
            <tbody>
              <tr class="row align-items-center">
                <td class="p-1 col-md-1">002</td>
                <td class="p-1 col-md-2">5256781310703496</td>
                <td class="p-1 col-md-1">15668</td>
                <td class="p-1 col-md-5">Graciela Salazar Villaverde</td>
                <td class="p-1 col-md-2">$ 10,000.00</td>
                <td class="p-1 col-md-1">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1"></label>
                  </div>
                </td>
              </tr>
              <tr class="row align-items-center">
                <td class="p-1 col-md-1">001</td>
                <td class="p-1 col-md-2">012821015214161544</td>
                <td class="p-1 col-md-1">15726</td>
                <td class="p-1 col-md-5">Graciela Salazar Villaverde</td>
                <td class="p-1 col-md-2">$ 4,915.46</td>
                <td class="p-1 col-md-1">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1"></label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer border-0 mt-3">
        <a href="" class="linkbtn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
