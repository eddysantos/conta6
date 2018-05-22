<?php
#http://localhost:88/conta6/Ubicaciones/Contabilidad/AdminContable/catalogocuentas.php?usuario=admado
#  $usuario = trim($_GET['usuario']);
//session_start();
$_SESSION['user_name'] = 'admado';
$usuario = $_SESSION['user_name'];
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Databases/conexion.php';
  require $root . '/conta6/Resources/PHP/actions/consultaPermisos.php';
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>
<div class="container-fluid">
  <div class="row submenuMed m-0">
    <div class="col-md-12 text-center" role="button">
      <a  id="submenuMed" class="consultar" accion="eCap" status="cerrado">CATÁLOGO DE CUENTAS</a>
    </div>
  </div>

  <div id="contorno" class="contorno">
    <div class="acordeon2">
      <div class="encabezado font16" data-toggle="collapse" href="#CuentasMaestras">
        <a  id="bread">GENERAR CUENTAS MAESTRAS (Primer Nivel)</a>
      </div>
      <div id="CuentasMaestras" class="card-block collapse mr-20 ml-20">
        <form class="form1">
          <table class="table text-center mb-0">
            <tbody class="font14">
              <tr class="row m-0 mt-5">
                <td class="col-md-12 input-effect">
                  <input class="efecto popup-input" id="ctaSAT" type="text" id-display="#popup-display-cuentas_sat" action="cuentas_sat" db-id="" autocomplete="new-password">
                  <div class="popup-list" id="popup-display-cuentas_sat" style="display:none"></div>
                  <label for="ctaSAT" style="padding-top:.10rem">CUENTAS SAT
                    <a href='#catalogoSAT' data-toggle='modal'><img src="/conta6/Resources/iconos/help.svg"></a>
                  </label>
                </td>
              </tr>
              <tr class="row m-0 mt-4">
                <td class="col-md-4 input-effect">
                  <input class="efecto popup-input" id="naturSAT" type="text" id-display="#popup-display-cuentas_sat_natur" action="cuentas_sat_natur" db-id="" autocomplete="new-password">
                  <div class="popup-list" id="popup-display-cuentas_sat_natur" style="display:none"></div>
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
				  <input id="ctamaestra" class="efecto" type="text" autocomplete="new-password" maxlength="10" onblur="valida_ctamaestra()">
				  <label for="ctamaestra">CUENTA MAESTRA</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="concepto" class="efecto" type="text" maxlength="100">
                  <label for="concepto">CONCEPTO</label>
                </td>
              </tr>
              <tr class="row justify-content-center mt-5">
                <td class="col-md-2">
                  <a href="#" id="generarCtaMst" class="boton"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> GENERAR</a>
                  <div id="respuestaCtasMST"></div>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 mt-4">
      <div class="encabezado font16" data-toggle="collapse" href="#collapsetwo">
        <a  id="bread">GENERAR CUENTAS DE DETALLE (Segundo Nivel)</a>
      </div>
      <div id="collapsetwo" class="card-block collapse mr-20 ml-20">
        <form class="form1">
          <table class="table m-0 mt-4 text-center">
            <tbody class="font14">
              <tr class="row m-0 mt-4">
                <td class="col-md-12 input-effect">
                  <input class="efecto popup-input" id="ctaSAT1" type="text" id-display="#popup-display-cuentas_sat1" action="cuentas_sat" db-id="" autocomplete="new-password">
                  <div class="popup-list" id="popup-display-cuentas_sat1" style="display:none"></div>
                  <label for="ctaSAT1" style="padding-top:.10rem">CUENTAS SAT
                    <a href="#catalogoSAT" data-toggle="modal"><img src="/conta6/Resources/iconos/help.svg"></a>
                  </label>
                </td>
              </tr>
              <tr class="row m-0 mt-4">
                <td class="col-md-3 input-effect">
                  <input class="efecto popup-input" id="naturSAT1" type="text" id-display="#popup-display-cuentas_sat_natur1" action="cuentas_sat_natur" db-id="" autocomplete="new-password">
                  <div class="popup-list" id="popup-display-cuentas_sat_natur1" style="display:none"></div>
                  <label for="naturSAT1">NATURALEZA SAT</label>
                </td>
                <td class="col-md-9 input-effect">
                  <input class="efecto popup-input" id="ctamaestra1" type="text" id-display="#popup-display-cuentas_mst_1niv1" action="cuentas_mst_1niv" db-id="" autocomplete="new-password">
                  <div class="popup-list" id="popup-display-cuentas_mst_1niv1" style="display:none"></div>
                  <label for="tipo1">CUENTA MAESTRA</label>
                </td>
              </tr>

    <!-- SOLO ESTARA VISIBLE CUANDO SELECCIONEN CUENTA 0100-0 -->

              <tr class="row m-0 mt-4" style="display:none">
                <td class="col-md-3 input-effect">
                  <input class="efecto popup-input" id="banSAT" type="text" id-display="" db-id="" autocomplete="new-password">
                  <div class="popup-list" style="display:none"></div>

                  <!-- <input  list="bcoSAT" class="efecto" id="banSAT">
                  <datalist id="bcoSAT">
                    <option value="EJEMPLO DE BANCOS SAT"></option>
                  </datalist> -->
                  <label for="banSAT" style="padding-top:.10rem">BANCOS SAT
                    <a href="#catalogoSAT" data-toggle="modal"><img src="/conta6/Resources/iconos/help.svg"></a>
                  </label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="noCuenta" class="efecto" type="text">
                  <label for="noCuenta">No. CUENTA</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input class="efecto popup-input" id="oficina" type="text" id-display="" db-id="" autocomplete="new-password">
                  <div class="popup-list" style="display:none"></div>

                  <!-- <input  list="ofi" class="efecto" id="oficina">
                  <datalist id="ofi">
                    <option value="Nuevo Laredo"></option>
                  </datalist> -->
                  <label for="oficina">OFICINA</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="obser" class="efecto" type="text">
                  <label for="obser">OBSERVACIONES</label>
                </td>
              </tr>
    <!-- termina CUENTA 0100-0   -->


    <!-- SOLO ESTARA VISIBLE CUANDO SELECCIONEN CUENTA 0115-0   -->

              <tr class="row m-0 mt-4" style="display:none">
                <td class="col-md-6 input-effect">
                  <input class="efecto popup-input" id="client" type="text" id-display="" db-id="" autocomplete="new-password">
                  <div class="popup-list" style="display:none"></div>

                  <!-- <input  list="clientes" class="efecto" id="client">
                  <datalist id="clientes"></datalist> -->
                  <label for="client">CLIENTES</label>
                </td>
                <td class="col-md-6 input-effect">
                  <input class="efecto popup-input" id="emp" type="text" id-display="" db-id="" autocomplete="new-password">
                  <div class="popup-list" style="display:none"></div>

                  <!-- <input  list="empleados" class="efecto" id="emp">
                  <datalist id="empleados">
                    <option value="EJEMPLO DE BANCOS SAT"></option>
                  </datalist> -->
                  <label for="emp">EMPLEADOS</label>
                </td>
              </tr>
    <!-- termina CUENTA 0115-0   -->

              <tr class="row justify-content-center m-0 mt-4">

    <!-- SOLO ESTARA VISIBLE CUANDO SELECCIONEN CUENTA 0206-0   -->
                <td class="col-md-4 input-effect" style="display:none">
                  <input class="efecto popup-input" id="proveedores" type="text" id-display="" db-id="" autocomplete="new-password">
                  <div class="popup-list" style="display:none"></div>

                  <!-- <input  list="prov" class="efecto" id="proveedores">
                  <datalist id="prov">
                    <option value="Proveedores sin Cuenta"></option>
                  </datalist> -->
                  <label for="proveedores">PROVEEDORES</label>
                </td>
      <!-- termina CUENTA 0206-0   -->

                <td class="col-md-8 input-effect">
                  <input id="concepto1" class="efecto" type="text">
                  <label for="concepto1">CONCEPTO</label>
                </td>
              </tr>
              <tr class="row justify-content-center mt-5">
                <td class="col-md-4">
                  <a href="#" id="generarCtaDet" class="boton"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> GENERAR CUENTA DETALLE</a>
				  <div id="respuestaCtasDET"></div>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 mt-4">
      <div class="encabezado font16" data-toggle="collapse" href="#collapsetres">
        <a  id="bread">GENERAR CUENTAS DE CLIENTES (Segundo Nivel)</a>
      </div>
      <div id="collapsetres" class="card-block collapse ml-20 mr-20">
        <form class="form1">
          <table class="table text-center ">
            <tbody class="cuerpo">
              <tr class="row m-0 mt-4">
                <td class="col-md-10 input-effect mt-4">
				  <input class="efecto popup-input" id="clt" type="text" id-display="#popup-display-clientes_sinCtaDet" action="clientes_sinCtaDet" db-id="" autocomplete="new-password">
                  <div class="popup-list" id="popup-display-clientes_sinCtaDet" style="display:none"></div>
                  <label for="clt">CLIENTES</label>
                </td>
                <td class="col-md-2 mt-4">
                  <a href="#" id="generarCtaCLT" class="boton btn-block"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> GENERAR</a>
				  <div id="respuestaCtasClientes"></div>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>

  <div id="contornoEmp" class="contorno" style="display:none;">
    <h5 class="titulo font16">CATALOGO</h5>
    <table class="table mt-4">
      <tr class="row m-0">
        <td class="col-md-6">
          <a href="#"><img class="icomediano" src="/conta6/Resources/iconos/005-excel.svg"></a>
          <a href="#"><img class="icomediano ml-4" src="/conta6/Resources/iconos/printer.svg"></a>
          <a href="#"><img class="icomediano ml-4" src="/conta6/Resources/iconos/xml.svg"></a>
		  <a href="#"><img class="icomediano ml-4" src="/conta6/Resources/iconos/refresh-button.svg"></a>
        </td>
        <td class="col-md-3 offset-md-3">
          <input class="efecto real-time-search" type="text" name="search" placeholder="Buscar..." table-body="#tabla_cuentas"  action="tablacuentasDet">
       </td>
      </tr>
    </table>
    <table class="table table-hover" id="empleadosCap" style="display:none;">
      <thead>
        <tr class="row m-0 encabezado font14">
          <td class="col-md-1"></td>
          <td class="col-md-1">CUENTA</td>
          <td class="col-md-4">DESCRIPCION</td>
          <td class="col-md-1">TIPO</td>
          <td class="col-md-1">NIVEL</td>
          <td class="col-md-1">CAPTURA</td>
          <td class="col-md-1">CodAgrup SAT</td>
          <td class="col-md-1">NATUR SAT</td>
          <td class="col-md-1">ACTIVIDAD</td>
        </tr>
      </thead>
      <tbody id="tabla_cuentas">
        <tr>
          <td colspan="9">No hay resultados</td>
        </tr>
      </tbody>
    </table>
    <ul class="pagination justify-content-center font16 mt-5">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul>
  </div>
</div>

<?php
require_once('modales/EditarCatalogo.php');
require_once('modales/catalogoSAT.php');
 ?>

<!--***************ESTILOS*****************-->
<!-- <link rel="stylesheet" href="/conta6/Resources/css/sweetalert.css">
<link rel="stylesheet" href="/conta6/Resources/bootstrap/alertifyjs/css/alertify.min.css">
<link rel="stylesheet" href="/conta6/Resources/bootstrap/alertifyjs/css/themes/default.css"> -->



<!--***************SCRIPTS*****************-->
<script src="/conta6/Resources/js/popup-list-plugin.js"></script>
<script src="/conta6/Resources/js/table-fetch-plugin.js"></script>
<script src="js/AdministracionContable.js"></script>

<?php
	$db->close();
?>
