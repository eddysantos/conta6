<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
?>


<div class="text-center">
  <div class="row backpink m-0">
    <ul class="nav nav-pills nav-fill w-100" id="selecRepo">
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" accion="rOficina" status="cerrado">Por Oficina Detallado</a>
      </li>
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" accion="rCliente" status="cerrado">Por Cliente Detallado</a>
      </li>
    </ul>
  </div>

  <!--Comienza Generar Poliza de Diario-->
  <div id="RepoxOficina" class="contorno" style="display:none">
    <form class="form1">
      <table class="table">
        <thead class="font18">
          <tr class="row m-0 encabezado">
            <td class="col-md-12 p-0">Aplización de Condiciones</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row m-0 mt-4">
            <td class="col-md-4 input-effect mt-4">
              <input class="efecto tiene-contenido" type="date" id="fini">
              <label for="fini">Fecha Inicial</label>
            </td>
            <td class="col-md-4 input-effect mt-4">
              <input class="efecto tiene-contenido" type="date" id="ffinal">
              <label for="ffinal">Fecha Final</label>
            </td>
            <td class="col-md-4">
              <label class="mb-1 font14">Gasto Oficina</label>
              <select class="custom-select">
                <option value="">AEROPUERTO</option>
                <option value="">MANZANILLO</option>
                <option value="">NUEVO LAREDO</option>
                <option value="">VERACRUZ</option>
              </select>
            </td>
          </tr>
          <tr class="row mt-4">
            <td class="col-md-3 offset-md-3">
              <a href="" class="boton"><img src= "/Resources/iconos/magnifier.svg" class="icochico"> CONSULTAR</a>
            </td>
            <td class="col-md-3">
              <a href="" class="boton"> <img src= "/Resources/iconos/005-excel.svg" class="icochico"> ABRIR EN EXCEL</a><!--nueva pagina, ingresar datos en poliza-->
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div><!--/Termina Generar Poliza de Diario-->

  <!--Comienza Generar Poliza de Ingreso-->
  <div id="RepoxCliente" class="contorno" style="display:none">
    <form class="form1">
      <table class="table">
        <thead class="font18">
          <tr class="row m-0 encabezado">
            <td class="col-md-12 p-0">Aplización de Condiciones</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row m-0 mt-5">
            <td class="col-md-3 input-effect">
              <input class="efecto tiene-contenido" type="date" id="fini2">
              <label for="fini2">Fecha Inicial</label>
            </td>
            <td class="col-md-3 input-effect">
              <input class="efecto tiene-contenido" type="date" id="ffinal2">
              <label for="ffinal2">Fecha Final</label>
            </td>
            <td class="col-md-6 input-effect">
              <input  list="clientes" class="efecto" id="detpol-cliente">
              <datalist id="clientes">
                <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
              </datalist>
              <label for="detpol-cliente">Cliente</label>
            </td>
          </tr>
          <tr class="row mt-5">
            <td class="col-md-3 offset-md-3">
              <a href="" class="boton"><img src= "/Resources/iconos/magnifier.svg" class="icochico"> CONSULTAR</a>
            </td>
            <td class="col-md-3">
              <a href="" class="boton"> <img src= "/Resources/iconos/005-excel.svg" class="icochico"> ABRIR EN EXCEL</a>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div><!--/Termina Generar Poliza de Ingreso-->
</div>


<script src="/Resources/js/Inputs.js"></script>
<script src="js/NotaCredito.js"></script>
