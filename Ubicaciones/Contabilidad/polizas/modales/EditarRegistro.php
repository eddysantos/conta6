<!--Editar Registro de Polizas Diario-->
<div class="modal fade" id="detpol-editarRegPolDiario" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Registro</h5>
      </div>
      <div class="modal-body" style="padding:0px">
        <div class="container-fluid">
          <div id="contorno" class="contorno-modal">
            <form class="form1"method="post">
              <table class="table">
                <tbody class="cuerpo">
                  <tr class="row m-0">
                    <td class="col-md-10 input-effect brx3">
                      <input  list="todascuentas" class="text-normal efecto text-center"  id="detpol-cuenta1">
                      <datalist id="todascuentas">
                        <option value="0206-00648 -- COMITE PARA EL FOMENTO Y PROTECCION PRECUARIA DEL ESTA DE NUEVO LEON A.C"></option>
                        <option value="0100-00011 ---- BANAMEX DLLS CTA.79033561 NLDO"></option>
                        <option value="0100-00012 ---- BANAMEX DLLS CTA.79033561 COMPLEMENTARIA NLDO"></option>
                        <option value="0206-00808 -- CÀMARA DE COMERCIO, SERVICIOS Y TURISMO EN PEQUEÑO DE LA CIUDAD DE MÉXICO"></option>
                        <option value="0100-00017 ---- BANAMEX CTA.7355485 NLDO"></option>
                      </datalist>
                      <label for="detpol-cuenta1">Seleccione una Cuenta</label>
                    </td>
                    <td class="col-md-2 input-effect brx3">
                      <input  list="gtoficina" class="text-normal efecto text-center"  id="detpol-gtoficina1">
                      <datalist id="gtoficina">
                        <option value="AEROPUERTO"></option>
                        <option value="MANZANILLO"></option>
                        <option value="NUEVO LAREDO"></option>
                        <option value="VERACRUZ"></option>
                      </datalist>
                      <label for="detpol-gtoficina1">Gasto Oficina</label>
                    </td>
                  </tr>

                  <tr class="row m-0 text-center">
                    <td class="col-md-10 input-effect brx2">
                      <input  list="clientes" class="text-normal efecto text-center"  id="detpol-cliente1">
                      <datalist id="clientes">
                        <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                        <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                      </datalist>
                      <label for="detpol-cliente1">Cliente</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpol-referencia1">
                      <label for="detpol-referencia1">Referencia</label>
                    </td>
                  </tr>

                  <tr class="row m-0">
                    <td class="col-md-12 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpol-concepto1">
                      <label for="detpol-concepto1">Concepto</label>
                    </td>
                  </tr>

                  <tr class="row m-0">
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpol-documento1">
                      <label for="detpol-documento1">Documento</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpol-factura1">
                      <label for="detpol-factura1">Factura</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpol-anticipo1">
                      <label for="detpol-anticipo1">Anticipo</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpol-cheque1">
                      <label for="detpol-cheque1">Cheque</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpol-cargo1">
                      <label for="detpol-cargo1">Cargo</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpol-abono1">
                      <label for="detpol-abono1">Abono</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" id="btn">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>


<!--Editar Registro de Polizas Diario-->
<div class="modal fade" id="detpol-editarRegPolIngreso" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Registro</h5>
      </div>
      <div class="modal-body" style="padding:0px">
        <div class="container-fluid">
          <div id="contorno" class="contorno-modal">
            <form class="form1"method="post">
              <table class="table">
                <tbody class="cuerpo">
                  <tr class="row m-0 text-center">
                    <td class="col-md-10 input-effect brx2">
                      <input  list="clientes" class="text-normal efecto text-center"  id="detpolin-cliente">
                      <datalist id="clientes">
                        <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                        <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                      </datalist>
                      <label for="detpolin-cliente">Cliente</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpolin-referencia">
                      <label for="detpolin-referencia">Referencia</label>
                    </td>
                  </tr>

                  <tr class="row m-0">
                    <td class="col-md-8 input-effect brx2">
                      <input  list="todascuentas" class="text-normal efecto text-center"  id="detpolin-cuenta">
                      <datalist id="todascuentas">
                        <option value="0206-00648 -- COMITE PARA EL FOMENTO Y PROTECCION PRECUARIA DEL ESTA DE NUEVO LEON A.C"></option>
                        <option value="0100-00011 ---- BANAMEX DLLS CTA.79033561 NLDO"></option>
                        <option value="0100-00012 ---- BANAMEX DLLS CTA.79033561 COMPLEMENTARIA NLDO"></option>
                        <option value="0206-00808 -- CÀMARA DE COMERCIO, SERVICIOS Y TURISMO EN PEQUEÑO DE LA CIUDAD DE MÉXICO"></option>
                        <option value="0100-00017 ---- BANAMEX CTA.7355485 NLDO"></option>
                      </datalist>
                      <label for="detpolin-cuenta">Seleccione una Cuenta</label>
                    </td>
                    <td class="col-md-4 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpolin-concepto">
                      <label for="detpolin-concepto">Concepto</label>
                    </td>
                  </tr>

                  <tr class="row m-0">
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpolin-documento">
                      <label for="detpolin-documento">Documento</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpolin-factura">
                      <label for="detpolin-factura">Factura</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpolin-anticipo">
                      <label for="detpolin-anticipo">Anticipo</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpolin-cheque">
                      <label for="detpolin-cheque">Cheque</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpolin-cargo">
                      <label for="detpolin-cargo">Cargo</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="detpolin-abono">
                      <label for="detpolin-abono">Abono</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" id="btn">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
