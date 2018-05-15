<!--Buscar Facturas en Captura detalle de poliza-->
<div class="modal fade" id="detpol-buscarfacturas" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Facturas de: Nombre del CLiente (CLT_NUMERO)</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
          <div id="contorno" class="contorno">
            <form>
              <table class="table text-center table-hover m-0">
                <thead>
                  <tr class="row encabezado">
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
                    <td class="col-md-2 centrar pt-3">N17003469</td>
                    <td class="col-md-2 centrar pt-3">75729</td>
                    <td class="col-md-2 centrar pt-3">11111</td>
                    <td class="col-md-2 centrar pt-3">-3,806.66</td>
                    <td class="col-md-2 centrar pt-2"><input class="efecto h22" type="text"></td>
                    <td class="col-md-2 centrar pt-1">
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
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" id="btn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
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
        <div class="container-fluid">
          <div id="contorno" class="contorno">
            <form>
              <table class="table text-center table-hover">
                <thead>
                  <tr class="row encabezado">
                    <td class="col-md-1">BANCO</td>
                    <td class="col-md-2">CUENTA</td>
                    <td class="col-md-1">FACTURA</td>
                    <td class="col-md-5">EMPLEADO</td>
                    <td class="col-md-2">IMPORTE</td>
                    <td class="col-md-1"></td>
                  </tr>
                </thead>
                <tbody>
                  <tr class="row">
                    <td class="col-md-1 centrar pt-3">002</td>
                    <td class="col-md-2 centrar pt-3">5256781310703496</td>
                    <td class="col-md-1 centrar pt-3">15668</td>
                    <td class="col-md-5 centrar pt-3">Diana Eustolia Rodriguez Ramos</td>
                    <td class="col-md-2 centrar pt-3">$ 1,312.18</td>
                    <td class="col-md-1 centrar pt-1">
                      <div class="checkbox-xs">
                        <label>
                          <input type="checkbox" data-toggle="toggle">
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr class="row">
                    <td class="col-md-1 centrar pt-3">001</td>
                    <td class="col-md-2 centrar pt-3">012821015214161544</td>
                    <td class="col-md-1 centrar pt-3">15726</td>
                    <td class="col-md-5 centrar pt-3">Domingo Martinez Martinez</td>
                    <td class="col-md-2 centrar pt-3">$ 4,915.46</td>
                    <td class="col-md-1 centrar pt-1">
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
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" id="btn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
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
        <div class="container-fluid">
          <div id="contorno" class="contorno">
            <form>
              <table class="table text-center table-hover">
                <thead>
                  <tr class="row encabezado">
                    <td class="col-md-1">BANCO</td>
                    <td class="col-md-2">CUENTA</td>
                    <td class="col-md-1">FACTURA</td>
                    <td class="col-md-5">EMPLEADO</td>
                    <td class="col-md-2">IMPORTE</td>
                    <td class="col-md-1"></td>
                  </tr>
                </thead>
                <tbody>
                  <tr class="row">
                    <td class="col-md-1 centrar pt-3">002</td>
                    <td class="col-md-2 centrar pt-3">5256781310703496</td>
                    <td class="col-md-1 centrar pt-3">15668</td>
                    <td class="col-md-5 centrar pt-3">Graciela Salazar Villaverde</td>
                    <td class="col-md-2 centrar pt-3">$ 10,000.00</td>
                    <td class="col-md-1 centrar pt-1">
                      <div class="checkbox-xs">
                        <label>
                          <input type="checkbox" data-toggle="toggle">
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr class="row">
                    <td class="col-md-1 centrar pt-3">001</td>
                    <td class="col-md-2 centrar pt-3">012821015214161544</td>
                    <td class="col-md-1 centrar pt-3">15726</td>
                    <td class="col-md-5 centrar pt-3">Graciela Salazar Villaverde</td>
                    <td class="col-md-2 centrar pt-3">$ 4,915.46</td>
                    <td class="col-md-1 centrar pt-1">
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
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" id="btn">Agregar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
