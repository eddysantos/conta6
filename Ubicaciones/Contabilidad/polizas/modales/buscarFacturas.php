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
      <div class="modal-body" style="padding:0px">
        <div class="container-fluid">
          <div id="contorno" class="contorno">
            <form class="form1"method="post">
              <table class="table text-center table-hover" style="margin-bottom:0px;">
                <thead>
                  <tr class="row tRepoNom">
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
                    <td id="centrar" class="col-md-1">002</td>
                    <td id="centrar" class="col-md-2">5256781310703496</td>
                    <td id="centrar" class="col-md-1">15668</td>
                    <td id="centrar" class="col-md-5">Diana Eustolia Rodriguez Ramos</td>
                    <td id="centrar" class="col-md-2">$ 1,312.18</td>
                    <td class="col-md-1">
                      <div class="">
                        <label>
                          <input type="checkbox" data-toggle="toggle">
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr class="row">
                    <td id="centrar" class="col-md-1">001</td>
                    <td id="centrar" class="col-md-2">012821015214161544</td>
                    <td id="centrar" class="col-md-1">15726</td>
                    <td id="centrar" class="col-md-5">Domingo Martinez Martinez</td>
                    <td id="centrar" class="col-md-2">$ 4,915.46</td>
                    <td class="col-md-1">
                      <div class="">
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
      <div class="modal-body" style="padding:0px">
        <div class="container-fluid">
          <div id="contorno" class="contorno">
            <form class="form1"method="post">
              <table class="table text-center table-hover" style="margin-bottom:0px;">
                <thead>
                  <tr class="row tRepoNom">
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
                    <td id="centrar" class="col-md-1">002</td>
                    <td id="centrar" class="col-md-2">5256781310703496</td>
                    <td id="centrar" class="col-md-1">15668</td>
                    <td id="centrar" class="col-md-5">Graciela Salazar Villaverde</td>
                    <td id="centrar" class="col-md-2">$ 10,000.00</td>
                    <td class="col-md-1">
                      <div class="">
                        <label>
                          <input type="checkbox" data-toggle="toggle">
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr class="row">
                    <td id="centrar" class="col-md-1">001</td>
                    <td id="centrar" class="col-md-2">012821015214161544</td>
                    <td id="centrar" class="col-md-1">15726</td>
                    <td id="centrar" class="col-md-5">Graciela Salazar Villaverde</td>
                    <td id="centrar" class="col-md-2">$ 4,915.46</td>
                    <td class="col-md-1">
                      <div class="">
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
