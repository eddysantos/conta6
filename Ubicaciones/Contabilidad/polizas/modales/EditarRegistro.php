<!--Editar Registro de Polizas-->
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
                      <?php if( $oRst_permisos["s_lstCompletaCtas_polizas"] == 1 ){
                      echo '<input class="efecto popup-input" id="fk_id_cuenta" type="text" id-display="#popup-display-cuentas_mst_2niv" action="cuentas_mst_2niv" db-id="" autocomplete="new-password" onchange="Actualiza_Cuenta()">';
                      }else{
                        if( $tipo == 2){
                          echo '<input class="efecto popup-input" id="detpol-cuenta" type="text" id-display="#popup-display-cuentas_mst_2niv" action="cuentas_mst_2niv_limitada_paraTipo2" db-id="" autocomplete="new-password" onchange="Actualiza_Cuenta()">';
                        }else{
                          echo '<input class="efecto popup-input" id="detpol-cuenta" type="text" id-display="#popup-display-cuentas_mst_2niv" action="cuentas_mst_2niv_limitada" db-id="" autocomplete="new-password" onchange="Actualiza_Cuenta()">';
                        }
                      }?>
                      <div class="popup-list" id="popup-display-cuentas_mst_2niv" style="display:none"></div>
                      <label for="fk_id_cuenta" style="padding-top:.10rem">Seleccione una Cuenta</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input class="efecto popup-input" id="fk_gastoAduana" type="text" id-display="#popup-display-oficina" action="oficinas" db-id="" autocomplete="new-password" onChange="valDescripOficina()">
                      <div class="popup-list" id="popup-display-oficina" style="display:none"></div>
                      <label for="fk_gastoAduana">Gasto Oficina</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-10 input-effect">
                      <input class="efecto popup-input" id="fk_id_cliente" type="text" id-display="#popup-display-clientes_sinCtaDet" action="clientes" db-id="" autocomplete="new-password">
                      <div class="popup-list" id="popup-display-clientes_sinCtaDet" style="display:none"></div>
                      <label for="fk_id_cliente">Cliente</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input class="efecto popup-input" id="fk_referencia" type="text" id-display="#popup-display-referencia" action="referencias" db-id="" autocomplete="new-password" onchange="eliminaBlancosIntermedios(this);todasMayusculas(this);validaReferencia(this);">
                      <div class="popup-list" id="popup-display-referencia" style="display:none"></div>
                      <label for="fk_referencia">Referencia</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-12 input-effect">
                      <input class="efecto popup-input" id="fk_id_proveedor" type="text" id-display="#popup-display-proveedores" action="proveedores" db-id="" autocomplete="new-password">
                      <div class="popup-list" id="popup-display-proveedores" style="display:none"></div>
                      <label for="fk_id_proveedor">Proveedor</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-12 input-effect">
                      <input  class="efecto" id="s_desc" onchange="valDescripOficina();eliminaBlancosIntermedios(this);todasMayusculas(this);">
                      <label for="s_desc">Concepto</label>
                    </td>
                  </tr>

                  <tr class="row m-0 mt-4">
                    <td class="col-md-2 input-effect">
                      <input class="efecto" id="s_folioCFDIext" onchange="validaSoloNumeros(this);">
                      <label for="s_folioCFDIext">Documento</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input class="efecto popup-input" id="fk_factura" type="text" id-display="#popup-display-factura" action="facturas_cfdi" db-id="" autocomplete="new-password">
                      <div class="popup-list" id="popup-display-factura" style="display:none"></div>
                      <label for="fk_factura">Factura</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input class="efecto popup-input" id="fk_anticipo" type="text" id-display="#popup-display-anticipo" action="anticipos_mst" db-id="" autocomplete="new-password">
                      <div class="popup-list" id="popup-display-anticipo" style="display:none"></div>
                      <label for="fk_anticipo">Anticipo</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input class="efecto popup-input" id="fk_cheque" type="text" id-display="#popup-display-cheque" action="cheques_mst" db-id="" autocomplete="new-password">
                      <div class="popup-list" id="popup-display-cheque" style="display:none"></div>
                      <label for="fk_cheque">Cheque</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input class="efecto" id="n_cargo" value="0" onchange="validaIntDec(this);">
                      <label for="n_cargo">Cargo</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input class="efecto" id="n_abono" value="0" onchange="validaIntDec(this);">
                      <label for="n_abono">Abono</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
	  <div class="modal-footer">
        <a href="" id="medit-partida">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>


<!--Editar Registro de Polizas Ingreso-->
<!-- no se usa -->
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
