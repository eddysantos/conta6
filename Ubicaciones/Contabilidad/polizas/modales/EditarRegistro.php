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
      <div class="modal-body p-0">
        <div class="container-fluid">
          <div id="contorno" class="contorno-modal">
            <form class="form1">
              <table class="table text-center">
                <tbody>
                  <tr class="row m-0 mt-5">
                    <td class="col-md-10 input-effect">
                      <input  list="todascuentas" class="efecto"  id="md_cuenta">
                      <datalist id="todascuentas">
                        <option value="0206-00648 -- COMITE PARA EL FOMENTO Y PROTECCION PRECUARIA DEL ESTA DE NUEVO LEON A.C"></option>
                        <option value="0100-00011 ---- BANAMEX DLLS CTA.79033561 NLDO"></option>
                        <option value="0100-00012 ---- BANAMEX DLLS CTA.79033561 COMPLEMENTARIA NLDO"></option>
                        <option value="0206-00808 -- CÀMARA DE COMERCIO, SERVICIOS Y TURISMO EN PEQUEÑO DE LA CIUDAD DE MÉXICO"></option>
                        <option value="0100-00017 ---- BANAMEX CTA.7355485 NLDO"></option>
                      </datalist>
                      <label for="md_cuenta">Seleccione una Cuenta</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  list="gtoficina" class="efecto"  id="md_gtoOficina">
                      <datalist id="gtoficina">
                        <option value="AEROPUERTO"></option>
                        <option value="MANZANILLO"></option>
                        <option value="NUEVO LAREDO"></option>
                        <option value="VERACRUZ"></option>
                      </datalist>
                      <label for="md_gtoOficina">Gasto Oficina</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-10 input-effect">
                      <input  list="clientes" class="efecto" id="md_cliente">
                      <datalist id="clientes">
                        <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                        <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                      </datalist>
                      <label for="md_cliente">Cliente</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto" id="md_referencia">
                      <label for="md_referencia">Referencia</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-12 input-effect">
                      <input  class="efecto" id="md_concepto">
                      <label for="md_concepto">Concepto</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="md_doc">
                      <label for="md_doc">Documento</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="md_fact">
                      <label for="md_fact">Factura</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="md_ant">
                      <label for="md_ant">Anticipo</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="md_che">
                      <label for="md_che">Cheque</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="md_cargo">
                      <label for="md_cargo">Cargo</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="md_abono">
                      <label for="md_abono">Abono</label>
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


<!--Editar Registro de Polizas Ingreso-->
<div class="modal fade" id="detpol-editarRegPolIngreso" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Registro</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
          <div id="contorno" class="contorno-modal">
            <form class="form1">
              <table class="table text-center">
                <tbody class="font-14">
                  <tr class="row m-0 mt-5">
                    <td class="col-md-10 input-effect">
                      <input  list="clientes" class="efecto"  id="mi_cliente">
                      <datalist id="clientes">
                        <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                        <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                      </datalist>
                      <label for="mi_cliente">Cliente</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="mi_referencia">
                      <label for="mi_referencia">Referencia</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-8 input-effect">
                      <input  list="todascuentas" class="efecto"  id="mi_cuenta">
                      <datalist id="todascuentas">
                        <option value="0206-00648 -- COMITE PARA EL FOMENTO Y PROTECCION PRECUARIA DEL ESTA DE NUEVO LEON A.C"></option>
                        <option value="0100-00011 ---- BANAMEX DLLS CTA.79033561 NLDO"></option>
                        <option value="0100-00012 ---- BANAMEX DLLS CTA.79033561 COMPLEMENTARIA NLDO"></option>
                        <option value="0206-00808 -- CÀMARA DE COMERCIO, SERVICIOS Y TURISMO EN PEQUEÑO DE LA CIUDAD DE MÉXICO"></option>
                        <option value="0100-00017 ---- BANAMEX CTA.7355485 NLDO"></option>
                      </datalist>
                      <label for="mi_cuenta">Seleccione una Cuenta</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input  class="efecto"  id="mi_concepto">
                      <label for="mi_concepto">Concepto</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-5">
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="mi_doc">
                      <label for="mi_doc">Documento</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="mi_fact">
                      <label for="mi_fact">Factura</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="mi_ant">
                      <label for="mi_ant">Anticipo</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="mi_che">
                      <label for="mi_che">Cheque</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="mi_cargo">
                      <label for="mi_cargo">Cargo</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="mi_abono">
                      <label for="mi_abono">Abono</label>
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
