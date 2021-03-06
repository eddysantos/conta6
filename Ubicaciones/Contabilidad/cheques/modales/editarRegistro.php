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
        <div class="contorno">
          <table class="table form1 text-center">
            <tbody>
              <tr class="row mt-4">
                <td class="col input-effect">
                  <input id="che_partida" type="hidden" db-id="">
                  <input class="efecto popup-input" id="che_cuenta" type="text" id-display="#popup-display-che_cuenta" action="cuentas_mst_2niv" db-id="" autocomplete="off"
                  onchange="Actualiza_CuentaCapCh_modal()">
                  <div class="popup-list" id="popup-display-che_cuenta" style="display:none"></div>
                  <label for="che_cuenta">Seleccione una Cuenta</label>
                </td>
                <td class="che_gastoaduana col-md-2 input-effect" style="display:none">
                  <input class="efecto popup-input" id="che_gastoaduana" type="text" id-display="#popup-display-che_gastoaduana" action="oficinas" db-id="" autocomplete="off"
                  onChange="valDescripOficinaCapCh_modal()">
                  <div class="popup-list" id="popup-display-che_gastoaduana" style="display:none"></div>
                  <label for="detpol-che_gastoaduana">Gasto Oficina</label>
                </td>
              </tr>

              <tr class="row mt-4">
                <!-- <td class="col-md-12 input-effect">
                  <input class="efecto popup-input" id="che_cliente" type="text" id-display="#popup-display-che_cliente" action="clientes" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-che_cliente" style="display:none"></div>
                  <label for="che_cliente">Cliente</label>
                </td> -->
                <td class="col-md-2 input-effect">
                  <input class="efecto popup-input" id="che_referencia" type="text" id-display="#popup-display-che_referencia" action="referencias" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-che_referencia" style="display:none"></div>
                  <label for="che_referencia">Referencia</label>
                </td>

                <td class="col-md-10">
                  <div id="modalCh-lstClientes">
                    <input class="efecto popup-input" id="che_cliente" type="text" id-display="#popup-display-che_cliente" action="clientes" db-id="" autocomplete="off" readonly>
                    <div class="popup-list" id="popup-display-che_cliente" style="display:none"></div>
                    <label for="che_cliente">Cliente</label>
                  </div>
                  <div id="modalCh-lstClientesCorresp" style="display:none">
                    <select class="custom-select" size='1' id="modalCh-clienteCorresp">
                      <option selected value='0'>Seleccione Cliente/Corresponsal</option>
                    </select>
                  </div>
                </td>
              </tr>

              <tr class="che_proveedor row mt-4" style="display:none">
                <td class="col-md-12 input-effect">
                  <input class="efecto popup-input" id="che_proveedor" type="text" id-display="#popup-display-che_proveedor" action="proveedores" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-che_proveedor" style="display:none"></div>
                  <label for="che_proveedor">Proveedor</label>
                </td>
              </tr>

              <tr class="row mt-4">
                <td class="col-md-12 input-effect">
                  <input  class="efecto" id="che_desc" onchange="valDescripOficina();eliminaBlancosIntermedios(this);todasMayusculas(this);">
                  <label for="che_desc">Concepto</label>
                </td>
              </tr>

              <tr class="row mt-4">
                <td class="col-md-2 input-effect">
                  <input  class="efecto" id="che_documento" onchange="validaSoloNumeros(this);">
                  <label for="che_documento">Documento</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input class="efecto popup-input" id="che_factura" type="text" id-display="#popup-display-che_factura" action="facturas_cfdi" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-che_factura" style="display:none"></div>
                  <label for="che_factura">Factura</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input class="efecto popup-input" id="che_anticipo" type="text" id-display="#popup-display-che_anticipo" action="anticipos_mst" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-che_anticipo" style="display:none"></div>
                  <label for="che_anticipo">Anticipo</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input class="efecto tiene-contenido" id="che_cargo" value="0" onchange="validaIntDec(this);">
                  <label for="che_cargo">Cargo</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input class="efecto tiene-contenido" id="che_abono" value="0" onchange="validaIntDec(this);">
                  <label for="che_abono">Abono</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="#" id="btnRegDetChPartida" class="linkbtn">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
