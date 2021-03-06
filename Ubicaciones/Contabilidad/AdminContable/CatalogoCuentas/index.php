<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';

  require $root . '/Ubicaciones/Contabilidad/AdminContable/CatalogoCuentas/modales/EditarCatalogo.php';
  require $root . '/Ubicaciones/Contabilidad/AdminContable/modales/catalogoSAT.php';
  require $root . '/Ubicaciones/Contabilidad/modales/catalogoBancosSAT.php';
  require $root . '/Ubicaciones/Contabilidad/modales/catalogoBancosEXT.php';
?>
<div class="text-center mb-10">
  <!-- <div class="row backpink m-0">
    <div class="col-md-12 p-2" role="button">
      <a  id="submenuMed" class="aconta" accion="eCap" status="cerrado">CATÁLOGO DE CUENTAS</a>
    </div>
  </div> -->
  <ul class="nav backpink justify-content-center" role="tablist">
    <li class="nav-item">
      <a class="nav-link" id="catCuentas-tab" data-toggle="tab" href="#catCuentas" role="tab" aria-controls="catCuentas" aria-selected="true">CATÁLOGO DE CUENTAS</a>
    </li>
  </ul>


  <div id="contorno" class="contorno">
    <div class="acordeon2">
      <div class="encabezado font16" data-toggle="collapse" href="#CuentasMaestras">
        <a href="#">GENERAR CUENTAS MAESTRAS (Primer Nivel)</a>
      </div>
      <div id="CuentasMaestras" class="collapse">
        <!-- <form class="form1" id="LimpiezaCuentasMaestras"> -->
          <table class="table mb-0">
            <tbody class="font14">
              <tr class="row m-0 mt-4">
                <td class="col-md-12 input-effect">
                  <input class="efecto popup-input" id="ctaSAT" type="text" id-display="#popup-display-ctaSAT" action="cuentas_sat" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-ctaSAT" style="display:none"></div>
                  <label for="ctaSAT">CUENTAS SAT
                    <a href='#catalogoSAT' data-toggle='modal'><img src="/Resources/iconos/help.svg" style="margin-top:-4px"></a>
                  </label>
                </td>
              </tr>
              <tr class="row m-0 mt-4">
                <td class="col-md-4 input-effect">
                  <input class="efecto popup-input" id="naturSAT" type="text" id-display="#popup-display-naturSAT" action="cuentas_sat_natur" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-naturSAT" style="display:none"></div>
                  <label for="naturSAT">NATURALEZA SAT</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input list="cta-mtraTipo" class="efecto" id="tipo">
                  <datalist id="cta-mtraTipo">
                    <option value="A">Activo -- A</option>
              			<option value="P">Pasivo -- P</option>
              			<option value="C">Capital -- C</option>
              			<option value="G">Gastos -- G</option>
              			<option value="I">Ingresos -- I</option>
              			<option value="O">Cuentas de Orden -- O</option>
                  </datalist>
                  <label for="tipo">TIPO</label>
                </td>
                <td class="col-md-2 input-effect">
        				  <input id="ctamaestra" class="efecto" type="text" autocomplete="off" maxlength="10" onblur="valida_ctamaestra()">
        				  <label for="ctamaestra">CUENTA MAESTRA</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="concepto" class="efecto" type="text" maxlength="100" onchange="eliminaBlancosIntermedios(this)">
                  <label for="concepto">CONCEPTO</label>
                </td>
              </tr>
              <tr class="row justify-content-center mt-3">
                <td class="col-md-2">
                  <a href="#" id="generarCtaMst" class="boton p-1 ls3"><img src= "/Resources/iconos/add.svg" class="icochico"> GENERAR</a>
                  <div id="respuestaCtasMST"></div>
                </td>
              </tr>
            </tbody>
          </table>
        <!-- </form> -->
      </div>
    </div>

    <div class="acordeon2 mt-4">
      <div class="encabezado font16" data-toggle="collapse" href="#collapsetwo">
        <a href="#">GENERAR CUENTAS DE DETALLE (Segundo Nivel)</a>
      </div>
      <div id="collapsetwo" class="collapse">
        <form class="form1" id="Cuentas2doNivel">
          <table class="table m-0">
            <tbody class="font14">
              <tr class="row m-0 mt-4">
                <td class="col-md-12 input-effect">
                  <input class="efecto popup-input" id="ctaSAT1" type="text" id-display="#popup-display-ctaSAT1" action="cuentas_sat" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-ctaSAT1" style="display:none"></div>
                  <label for="ctaSAT1">CUENTAS SAT
                    <a href="#catalogoSAT" data-toggle="modal" style="margin-top:-4px"><img src="/Resources/iconos/help.svg" style="margin-top:-4px"></a>
                  </label>
                </td>
              </tr>
              <tr class="row m-0 mt-3">
                <td class="col-md-3 input-effect">
                  <input class="efecto popup-input" id="naturSAT1" type="text" id-display="#popup-display-naturSAT1" action="cuentas_sat_natur" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-naturSAT1" style="display:none"></div>
                  <label for="naturSAT1">NATURALEZA SAT</label>
                </td>
                <td class="col-md-9 input-effect">
                  <input class="efecto popup-input" id="ctamaestra1" type="text" id-display="#popup-display-ctamaestra1" action="cuentas_mst_1niv" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-ctamaestra1" style="display:none"></div>
                  <label for="ctamaestra1">CUENTA MAESTRA</label>
                </td>
              </tr>

    <!-- SOLO ESTARA VISIBLE CUANDO SELECCIONEN CUENTA 0100-0 -->

              <tr class="row m-0 mt-4" id="form0100" style="display:none">
                <td class="col-md-4 input-effect">
                  <input class="efecto popup-input" id="banSAT" type="text" id-display="#popup-display-banSAT" action="bancosSAT" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-banSAT" style="display:none"></div>
                  <label for='banSAT'>BANCOS
                    <a href='#catalogoBancosSAT' data-toggle='modal' style='margin-top:-4px'><img src='/Resources/iconos/help.svg' style='margin-top:-4px'></a>
                  </label>
                </td>
                <td class="col-md-4 input-effect">
                  <input class='efecto tiene-contenido popup-input' id='nomBcoExt' type='text' id-display='#popup-display-nomBcoExt' action='bancosExtranjeros' db-id='' autocomplete='new-password'>
                  <div class='popup-list' id='popup-display-nomBcoExt' style='display:none'></div>
                  <label for='nomBcoExt'>BANCOS EXTRANJEROS
                    <a href='#catalogoBancosEXT' data-toggle='modal' style='margin-top:-4px'><img src='/Resources/iconos/help.svg' style='margin-top:-4px'></a>
                  </label>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="noCuenta" class="efecto" type="text" onchange='validarCtaBancaria(this);'>
                  <label for="noCuenta">CUENTA / INTERBANCARIA</label>
                </td>
                <td class="col-md-6 input-effect mt-4">
                  <input class="efecto popup-input" id="oficina" type="text" id-display="#popup-display-oficina" action="oficinas" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-oficina" style="display:none"></div>
                  <label for="oficina">OFICINA</label>
                </td>
                <td class="col-md-6 input-effect mt-4">
                  <input id="obser" class="efecto" type="text" onchange="eliminaBlancosIntermedios(this)">
                  <label for="obser">OBSERVACIONES</label>
                </td>
              </tr>
    <!-- termina CUENTA 0100-0   -->


    <!-- SOLO ESTARA VISIBLE CUANDO SELECCIONEN CUENTA 0115-0   -->
              <tr class="row m-0 mt-4" id="form0115" style="display:none">
                <td class="col-md-6 input-effect">
                  <input class="efecto popup-input" id="client0115" type="text" id-display="#popup-display-client0115" action="clientes0115NOdeudores" db-id="" autocomplete="off"
                    onchange="CLTasignado()">
                  <div class="popup-list" id="popup-display-client0115" style="display:none"></div>
                  <label for="client0115">CLIENTES</label>
                </td>
                <td class="col-md-6 input-effect">
                  <input class="efecto popup-input" id="emp0115" type="text" id-display="#popup-display-emp0115" action="empleados0115NOdeudores" db-id="" autocomplete="off"
                    onchange="empAsignado()">
          	      <div class="popup-list" id="popup-display-emp0115" style="display:none"></div>
                  <label for="emp0115">EMPLEADOS</label>
                </td>
              </tr>
    <!-- termina CUENTA 0115-0   -->

              <tr class="row justify-content-center m-0 mt-3">
    <!-- SOLO ESTARA VISIBLE CUANDO SELECCIONEN CUENTA 0206-0   -->
                <td class="col-md-4 input-effect" id="form0206" style="display:none">
                  <input class="efecto popup-input" id="prov0206" type="text" id-display="#popup-display-prov0206" action="proveedores0206" db-id="" autocomplete="off"
                  onchange="provAsignado()">
          	      <div class="popup-list" id="popup-display-prov0206" style="display:none"></div>
                  <label for="prov0206">PROVEEDORES</label>
                </td>
      <!-- termina CUENTA 0206-0   -->

                <td class="col-md-8 input-effect">
                  <input id="concepto1" class="efecto" type="text" onchange="eliminaBlancosIntermedios(this)">
                  <label for="concepto1">CONCEPTO</label>
                </td>
              </tr>
              <tr class="row justify-content-center mt-3">
                <td class="col-md-4">
                  <a href="#" id="generarCtaDet" class="boton p-1"><img src= "/Resources/iconos/add.svg" class="icochico"> GENERAR CUENTA DETALLE</a>
                  <input type="hidden" id="identTipo">
                  <input type="hidden" id="identID">
				          <!-- <div id="respuestaCtasDET"></div> -->
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 mt-4">
      <div class="encabezado font16" data-toggle="collapse" href="#collapsetres">
        <a href="#">GENERAR CUENTAS DE CLIENTES (Segundo Nivel)</a>
      </div>
      <div id="collapsetres" class="collapse">
        <form class="form1">
          <table class="table">
            <tbody class="font14">
              <tr class="row m-0 mt-4">
                <td class="col-md-10 input-effect mt-4">
				          <input class="efecto popup-input" id="clt" type="text" id-display="#popup-display-clt" action="clientes_sinCtaDet" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-clt" style="display:none"></div>
                  <label for="clt">CLIENTES</label>
                </td>
                <td class="col-md-2 mt-4">
                  <a href="#" id="generarCtaCLT" class="boton p-1"><img src= "/Resources/iconos/add.svg" class="icochico"> GENERAR</a>
				          <!-- <div id="respuestaCtasClientes"></div> -->
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>



  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade" id="catCuentas" role="tabpanel" aria-labelledby="catCuentas-tab">
      <div class="contorno">
        <h5 class="titulo font16">CATALOGO</h5>
        <table class="table mt-4">
          <tr class="row m-0">
            <td class="col-md-6 text-left align-self-center">
              <a href="#" id="printCatCuentas"><img class="icomediano ml-4" src="/Resources/iconos/printer.svg"></a>
            </td>
            <td class="col-md-3 offset-md-3 p-0">
              <input class="efecto real-time-search" type="text" name="search" placeholder="Buscar..." table-body="#tabla_cuentas"  action="tablacuentasDet">
           </td>
          </tr>
        </table>
        <table class="table table-hover fixed-table" id="empleadosCap">
          <thead>
            <tr class="row m-0 encabezado font14 align-items-center">
              <td class="col-md-1"></td>
              <td class="col-md-1">CUENTA</td>
              <td class="col-md-4">DESCRIPCION</td>
              <td class="col-md-1">TIPO</td>
              <td class="col-md-1">NIVEL</td>
              <td class="col-md-1">CAPTURA</td>
              <td class="col-md-1 p-0">CodAgrup SAT</td>
              <td class="col-md-1">NATUR SAT</td>
              <td class="col-md-1">ACTIVIDAD</td>
            </tr>
          </thead>
          <tbody id="tabla_cuentas" class="font12">
            <tr>
              <td colspan="9">No hay resultados</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>



<!-- <script src="/Ubicaciones/Contabilidad/AdminContable/js/AdministracionContable.js" charset="utf-8"></script> -->
<script src="/Ubicaciones/Contabilidad/AdminContable/CatalogoCuentas/js/catalogoCuentas.js" charset="utf-8"></script>

<?php
  require $root . '/Ubicaciones/footer.php';
?>
