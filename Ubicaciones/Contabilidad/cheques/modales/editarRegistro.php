<!--Editar Registro de Cheque-->
<div class="modal fade" id="editarRegCheque" style="margin-top:50px">
  <div class="modal-dialog modal-lg">
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
                  <tr class="row m-0 mt-4">
                    <td class="col-md-10 input-effect">
                      <input  list="todascuentas" class="efecto"  id="ch-cuenta1">
                      <datalist id="todascuentas">
                        <option value="0206-00648 -- COMITE PARA EL FOMENTO Y PROTECCION PRECUARIA DEL ESTA DE NUEVO LEON A.C"></option>
                        <option value="0100-00011 ---- BANAMEX DLLS CTA.79033561 NLDO"></option>
                        <option value="0100-00012 ---- BANAMEX DLLS CTA.79033561 COMPLEMENTARIA NLDO"></option>
                        <option value="0206-00808 -- CÀMARA DE COMERCIO, SERVICIOS Y TURISMO EN PEQUEÑO DE LA CIUDAD DE MÉXICO"></option>
                        <option value="0100-00017 ---- BANAMEX CTA.7355485 NLDO"></option>
                      </datalist>
                      <label for="ch-cuenta1">Seleccione una Cuenta</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  list="gtoficina" class="efecto"  id="ch-gtoficina1">
                      <datalist id="gtoficina">
                        <option value="AEROPUERTO"></option>
                        <option value="MANZANILLO"></option>
                        <option value="NUEVO LAREDO"></option>
                        <option value="VERACRUZ"></option>
                      </datalist>
                      <label for="ch-gtoficina1">Gto.Oficina</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-12 input-effect">
                      <input  list="clientes" class="efecto"  id="ch-cliente1">
                      <datalist id="clientes">
                        <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                        <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                      </datalist>
                      <label for="ch-cliente1">Cliente</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-12 input-effect">
                      <input  class="efecto"  id="ch-concepto1">
                      <label for="ch-concepto1">Concepto</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="ch-referencia1">
                      <label for="ch-referencia1">Referencia</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="ch-documento1">
                      <label for="ch-documento1">Documento</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="ch-factura1">
                      <label for="ch-factura1">Factura</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="ch-anticipo1">
                      <label for="ch-anticipo1">Anticipo</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="ch-cargo1">
                      <label for="ch-cargo1">Cargo</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input  class="efecto"  id="ch-abono1">
                      <label for="ch-abono1">Abono</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" class="linkbtn">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
