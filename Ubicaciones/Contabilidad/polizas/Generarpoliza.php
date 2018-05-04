<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="container-fluid">
  <div class="row submenuMed m-0">
    <ul class="nav nav-pills nav-fill w-100" id="selecTipoPoliza">
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" accion="poldiario" status="cerrado">POLIZA DE DIARIO</a>
      </li>
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" accion="polingreso" status="cerrado">POLIZA DE INGRESO</a>
      </li>
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" accion="gcheque" status="cerrado">CHEQUES</a>
      </li>
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" accion="ganticipo" status="cerrado">ANTICIPOS</a>
      </li>
    </ul>
  </div>

  <!--Comienza Generar Poliza de Diario-->
  <div id="polizadiario" class="contorno" style="display:none">
    <table class="table">
      <thead style="font-size: 18px;font-weight: 100;">
        <tr class="row m-0 tRepo2">
          <td class="col-md-12 text-center">GENERAR POLIZA TIPO 4</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row m-0">
          <!-- <td class="col-md-3 input-effect brx3">
            <input class="efecto text-center data-date" type="text" onfocus="(this.type='date')" id="diafecha">
            <label for="diafecha">Fecha Póliza</label>
          </td> -->
          <td class="col-md-3 input-effect brx3">
            <input class="efecto text-center tiene-contenido" type="date" id="diafecha">
            <label for="diafecha">Fecha Póliza</label>
          </td>
          <td class="col-md-6 input-effect brx3">
            <input id="diaconcepto" class="efecto text-center text-normal w-100" type="text">
            <label for="diaconcepto">Concepto</label>
          </td>
          <td class="col-md-3 input-effect brx3">
            <input id="diapoliza" class="efecto text-center tiene-contenido" type="text" readonly>
            <label for="diapoliza">Póliza Generada</label>
          </td>
        </tr>
        <tr class="row brx3 justify-content-center">
          <td class="col-md-3">
            <a href="" class="boton btn-block brx1"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> GENERAR POLIZA</a>
          </td>
          <td class="col-md-3">
            <a href="DetallepolizaDiario.php" class="boton btn-block brx1"> <img src= "/conta6/Resources/iconos/detalle.svg" class="icochico"> DETALLE DE POLIZA</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Diario-->

  <!--Comienza Generar Poliza de Ingreso-->
  <div id="polizaingresos" class="contorno" style="display:none">
    <table class="table">
      <thead style="font-size: 18px;font-weight: 100;">
        <tr class="row m-0 tRepo2">
          <td class="col-md-12 text-center">GENERAR POLIZA TIPO 2</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row m-0">
          <td class="col-md-3 input-effect brx3">
            <input class="dpol2 efecto text-center tiene-contenido" type="date" id="ingrefecha">
            <label for="ingrefecha">Fecha Póliza</label>
          </td>
          <td class="col-md-6 input-effect brx3">
            <input id="ingreconcepto" class="efecto text-center" type="text">
            <label for="ingreconcepto">Concepto</label>
          </td>
          <td class="col-md-3 input-effect brx3">
            <input id="ingrepoliza" class="efecto text-center tiene-contenido" type="text"  readonly>
            <label for="ingrepoliza">Póliza Generada</label>
          </td>
        </tr>
        <tr class="row brx3 justify-content-center">
          <td class="col-md-3">
            <a href="" class="boton btn-block brx1"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> GENERAR POLIZA</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
          <td class="col-md-3">
            <a href="DetallepolizaIngreso.php" class="boton btn-block brx1"> <img src= "/conta6/Resources/iconos/detalle.svg" class="icochico"> DETALLE DE POLIZA</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->


  <div id="cheques" class="contorno" style="display:none">
    <table class="table">
      <thead style="font-size: 18px;font-weight: 100;">
        <tr class="row tRepo2">
          <td class="col-md-12 text-center">GENERAR CHEQUE</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row m-0">
          <td class="col-md-3 input-effect brx3">
            <input class="dpol2 efecto text-center tiene-contenido" type="date" id="chfecha">
            <label for="chfecha">Fecha Cheque</label>
          </td>
          <td class="col-md-9 input-effect brx3">
            <input  list="oficina" class="text-normal efecto text-center"  id="chncuenta">
            <datalist id="oficina">
              <option value="0100-00006 ---- BANAMEX CTA.7658424 NLDO"></option>
              <option value="0100-00011 ---- BANAMEX DLLS CTA.79033561 NLDO"></option>
              <option value="0100-00012 ---- BANAMEX DLLS CTA.79033561 COMPLEMENTARIA NLDO"></option>
              <option value="0100-00016 ---- BANCOMER CTA.0192655497 NLDO"></option>
              <option value="0100-00017 ---- BANAMEX CTA.7355485 NLDO"></option>
            </datalist>
            <label for="chncuenta">Seleccione una Cuenta</label>
          </td>
        </tr>
        <tr class="row m-0 ">
          <td class="col-md-3 input-effect brx2">
            <input id="chnumero" class="efecto text-center" type="text">
            <label for="chnumero">No.Cheque</label>
          </td>
          <td class="col-md-3 input-effect brx2">
            <input id="chimporte" class="efecto text-center" type="text">
            <label for="chimporte">Importe</label>
          </td>
          <td class="col-md-6 input-effect brx2">
            <input  list="beneficiarios" class="text-normal efecto text-center" id="chbeneficiarios">
            <datalist id="beneficiarios">
              <option value="BENEFICIARIO NUMERO 1"></option>
              <option value="BENEFICIARIO NUMERO 2"></option>
              <option value="BENEFICIARIO NUMERO 3"></option>
              <option value="BENEFICIARIO NUMERO 4"></option>
              <option value="BENEFICIARIO NUMERO 5"></option>
            </datalist>
            <label for="chbeneficiarios">Beneficiario</label>
          </td>
        </tr>
        <tr class="row  m-0">
          <td class="col-9 input-effect brx2">
            <input id="chconcepto" class="efecto text-center" type="text">
            <label for="chconcepto">Concepto</label>
          </td>
          <td class="col-md-3 brx2">
            <a href="/conta6/Ubicaciones/Contabilidad/cheques/Detallecheque.php" class="boton btn-block"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico noborder"> GENERAR CHEQUE</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->


  <div id="anticipos" class="contorno" style="display:none">
    <table class="table">
      <thead style="font-size: 18px;font-weight: 100;">
        <tr class="row tRepo2">
          <td class="col-md-12 text-center">GENERAR ANTICIPO</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row m-0">
          <td class="col-md-3 input-effect brx3">
            <input class="dpol2 efecto text-center tiene-contenido" type="date" id="antfecha">
            <label for="antfecha">Fecha Anticipo</label>
          </td>
          <td class="col-md-3 input-effect brx3">
            <input id="antimporte" class="efecto text-center" type="text">
            <label for="antimporte">Importe</label>
          </td>
          <td class="col-md-6 input-effect brx3">
            <input  list="antcta" class="text-normal efecto text-center"  id="antcuenta">
            <datalist id="antcta">
              <option value="0100-00006 ---- BANAMEX CTA.7658424 NLDO"></option>
              <option value="0100-00011 ---- BANAMEX DLLS CTA.79033561 NLDO"></option>
              <option value="0100-00012 ---- BANAMEX DLLS CTA.79033561 COMPLEMENTARIA NLDO"></option>
              <option value="0100-00016 ---- BANCOMER CTA.0192655497 NLDO"></option>
              <option value="0100-00017 ---- BANAMEX CTA.7355485 NLDO"></option>
            </datalist>
            <label for="antcuenta">Seleccione una Cuenta</label>
          </td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-8 input-effect brx2">
            <input  list="listaclientes" class="text-normal efecto text-center" id="antcliente">
            <datalist id="listaclientes">
              <option value="SERVICIOS INTEGRALES EN LOGISTICA INTERNACIONAL, ADUANAS Y TECNOLOGIA, S.C --- CLT_7158"></option>
              <option value="TURBO-MEX REFACCIONES,MANTENIMIENTO Y SEGURIDAD INDUSTRIAL S.A DE C.V --- CLT_7114"></option>
            </datalist>
            <label for="antcliente">Cliente</label>
          </td>
          <td class="col-md-4 input-effect brx2">
            <input  list="listacuentacliente" class="text-normal efecto text-center" id="antbcocliente">
            <datalist id="listacuentacliente">
              <option value="HSBC --- 3336"></option>
              <option value="BANAMEX --- 0192"></option>
              <option value="BANAMEX --- 9569"></option>
            </datalist>
            <label for="antbcocliente">Banco Cliente</label>
          </td>
        </tr>
        <tr class="row  m-0">
          <td class="col-9 input-effect brx2">
            <input id="antconcepto" class="efecto text-center" type="text">
            <label for="antconcepto">Concepto</label>
          </td>
          <td class="col-md-3 brx2">
            <a href="/conta6/Ubicaciones/Contabilidad/anticipos/Detalleanticipo.php" class="boton btn-block"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico noborder"> GENERAR ANTICIPO</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->
</div><!--/Termina Container FLuid-->


<script src="js/Polizas.js"></script>
