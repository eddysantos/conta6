<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="container-fluid">
  <div class="row submenuMed m-0">
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
    <table class="table">
      <thead style="font-size: 18px;font-weight: 100;">
        <tr class="row m-0 tRepo2">
          <td class="col-md-12 text-center">Aplización de Condiciones</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row m-0">
          <td class="col-md-4 input-effect brx3">
            <input class="efecto text-center data-date" type="text" onfocus="(this.type='date')" id="fini">
            <label for="fini">Fecha Inicial</label>
          </td>
          <td class="col-md-4 input-effect brx3">
            <input class="efecto text-center data-date" type="text" onfocus="(this.type='date')" id="ffinal">
            <label for="ffinal">Fecha Final</label>
          </td>
          <td class="col-md-4 input-effect brx3">
            <input  list="gtoficina" class="text-normal efecto text-center"  id="detpol-gtoficina">
            <datalist id="gtoficina">
              <option value="AEROPUERTO"></option>
              <option value="MANZANILLO"></option>
              <option value="NUEVO LAREDO"></option>
              <option value="VERACRUZ"></option>
            </datalist>
            <label for="detpol-gtoficina">Gasto Oficina</label>
          </td>
        </tr>
        <tr class="row brx3">
          <td class="col-md-3 offset-md-3">
            <a href="" class="boton btn-block brx1"><img src= "/conta6/Resources/iconos/magnifier.svg" class="icochico"> CONSULTAR</a>
          </td>
          <td class="col-md-3">
            <a href="" class="boton btn-block brx1"> <img src= "/conta6/Resources/iconos/005-excel.svg" class="icochico"> ABRIR EN EXCEL</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Diario-->

  <!--Comienza Generar Poliza de Ingreso-->
  <div id="RepoxCliente" class="contorno" style="display:none">
    <table class="table">
      <thead style="font-size: 18px;font-weight: 100;">
        <tr class="row m-0 tRepo2">
          <td class="col-md-12 text-center">Aplización de Condiciones</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row m-0">
          <td class="col-md-3 input-effect brx3">
            <input class="dpol2 efecto text-center data-date" type="text" onfocus="(this.type='date')" id="fini2">
            <label for="fini2">Fecha Inicial</label>
          </td>
          <td class="col-md-3 input-effect brx3">
            <input class="dpol2 efecto text-center data-date" type="text" onfocus="(this.type='date')" id="ffinal2">
            <label for="ffinal2">Fecha Final</label>
          </td>
          <td class="col-md-6 input-effect brx3">
            <input  list="clientes" class="text-normal efecto text-center"  id="detpol-cliente">
            <datalist id="clientes">
              <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
              <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
            </datalist>
            <label for="detpol-cliente">Cliente</label>
          </td>
        </tr>
        <tr class="row brx3">
          <td class="col-md-3 offset-md-3">
            <a href="" class="boton btn-block brx1"><img src= "/conta6/Resources/iconos/magnifier.svg" class="icochico"> CONSULTAR</a>
          </td>
          <td class="col-md-3">
            <a href="" class="boton btn-block brx1"> <img src= "/conta6/Resources/iconos/005-excel.svg" class="icochico"> ABRIR EN EXCEL</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->
</div><!--/Termina Container FLuid-->


<script src="/conta6/Resources/js/Inputs.js"></script>
<script src="js/NotaCredito.js"></script>
