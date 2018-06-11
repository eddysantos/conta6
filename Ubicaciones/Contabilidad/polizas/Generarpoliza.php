<?php
$_SESSION['user_name'] = 'admado';
$usuario = $_SESSION['user_name'];

  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Databases/conexion.php';
  require $root . '/conta6/Resources/PHP/actions/consultaPermisos.php';
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
    <table class="table text-center">
      <thead>
        <tr class="row m-0 encabezado font18">
          <td class="col-md-12">GENERAR POLIZA TIPO 4</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row m-0 mt-5">
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido" type="date" id="diafecha">
            <label for="diafecha">Fecha Póliza</label>
          </td>
          <td class="col-md-6 input-effect">
            <input id="diaconcepto" class="efecto" type="text" maxlength=300>
            <label for="diaconcepto">Concepto</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="diapoliza" class="efecto tiene-contenido" type="text" db-id="" readonly>
            <label for="diapoliza">Póliza Generada</label>
          </td>
        </tr>
        <tr class="row justify-content-center mt-5">
          <td class="col-md-3">
            <a href="#" id="genFolioPolDia" class="boton"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> GENERAR POLIZA</a>
          </td>
          <td class="col-md-3">
            <!--a href="#" id="btn_detallePoliza" class="boton"> <img src= "/conta6/Resources/iconos/detalle.svg" class="icochico"> DETALLE DE POLIZA</a--><!--nueva pagina, ingresar datos en poliza-->
            <!--a href='#DetallepolizaDiario' data-toggle='modal'-->
            <a href='#DetallepolizaDiario' class='consultar-polizaMST boton' db-id='' role='button'><img src= "/conta6/Resources/iconos/detalle.svg" class="icochico"> DETALLE DE POLIZA</a-->
            <!--a href="DetallepolizaDiario.php" id="btn_detallePoliza" class="boton"> <img src= "/conta6/Resources/iconos/detalle.svg" class="icochico"> DETALLE DE POLIZA</a--><!--nueva pagina, ingresar datos en poliza-->
            <div id="respuesta"></div>
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Diario-->

  <!--Comienza Generar Poliza de Ingreso-->
  <div id="polizaingresos" class="contorno" style="display:none">
    <table class="table text-center">
      <thead>
        <tr class="row m-0 encabezado font18">
          <td class="col-md-12">GENERAR POLIZA TIPO 2</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row m-0  mt-5">
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido" type="date" id="ingrefecha">
            <label for="ingrefecha">Fecha Póliza</label>
          </td>
          <td class="col-md-6 input-effect">
            <input id="ingreconcepto" class="efecto" type="text">
            <label for="ingreconcepto">Concepto</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ingrepoliza" class="efecto tiene-contenido" type="text"  readonly>
            <label for="ingrepoliza">Póliza Generada</label>
          </td>
        </tr>
        <tr class="row mt-5 justify-content-center">
          <td class="col-md-3">
            <a href="" class="boton"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> GENERAR POLIZA</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
          <td class="col-md-3">
            <a href="DetallepolizaIngreso.php" class="boton"> <img src= "/conta6/Resources/iconos/detalle.svg" class="icochico"> DETALLE DE POLIZA</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->


  <div id="cheques" class="contorno" style="display:none">
    <table class="table text-center">
      <thead>
        <tr class="row encabezado font18">
          <td class="col-md-12">GENERAR CHEQUE</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row m-0 mt-5">
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido" type="date" id="chfecha">
            <label for="chfecha">Fecha Cheque</label>
          </td>
          <td class="col-md-9 input-effect">
            <input  list="oficina" class="efecto"  id="chncuenta">
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
        <tr class="row m-0 mt-5">
          <td class="col-md-3 input-effect">
            <input id="chnumero" class="efecto" type="text">
            <label for="chnumero">No.Cheque</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="chimporte" class="efecto" type="text">
            <label for="chimporte">Importe</label>
          </td>
          <td class="col-md-6 input-effect">
            <input  list="beneficiarios" class="efecto" id="chbeneficiarios">
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
        <tr class="row m-0 mt-5">
          <td class="col-9 input-effect">
            <input id="chconcepto" class="efecto" type="text">
            <label for="chconcepto">Concepto</label>
          </td>
          <td class="col-md-3">
            <a href="/conta6/Ubicaciones/Contabilidad/cheques/Detallecheque.php" class="boton"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> GENERAR CHEQUE</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->


  <div id="anticipos" class="contorno" style="display:none">
    <table class="table text-center">
      <thead>
        <tr class="row m-0 encabezado font18">
          <td class="col-md-12">GENERAR ANTICIPO</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row m-0 mt-5">
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido" type="date" id="antfecha">
            <label for="antfecha">Fecha Anticipo</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="antimporte" class="efecto" type="text">
            <label for="antimporte">Importe</label>
          </td>
          <td class="col-md-6 input-effect">
            <input  list="antcta" class="efecto"  id="antcuenta">
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
        <tr class="row m-0 mt-4">
          <td class="col-md-8 input-effect">
            <input  list="listaclientes" class="efecto" id="antcliente">
            <datalist id="listaclientes">
              <option value="SERVICIOS INTEGRALES EN LOGISTICA INTERNACIONAL, ADUANAS Y TECNOLOGIA, S.C --- CLT_7158"></option>
              <option value="TURBO-MEX REFACCIONES,MANTENIMIENTO Y SEGURIDAD INDUSTRIAL S.A DE C.V --- CLT_7114"></option>
            </datalist>
            <label for="antcliente">Cliente</label>
          </td>
          <td class="col-md-4 input-effect">
            <input  list="listacuentacliente" class="efecto" id="antbcocliente">
            <datalist id="listacuentacliente">
              <option value="HSBC --- 3336"></option>
              <option value="BANAMEX --- 0192"></option>
              <option value="BANAMEX --- 9569"></option>
            </datalist>
            <label for="antbcocliente">Banco Cliente</label>
          </td>
        </tr>
        <tr class="row  m-0 mt-4">
          <td class="col-9 input-effect">
            <input id="antconcepto" class="efecto" type="text">
            <label for="antconcepto">Concepto</label>
          </td>
          <td class="col-md-3">
            <a href="/conta6/Ubicaciones/Contabilidad/anticipos/Detalleanticipo.php" class="boton"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> GENERAR ANTICIPO</a><!--nueva pagina, ingresar datos en poliza-->
            <div id="respuesta"></div>
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->
</div><!--/Termina Container FLuid-->

<?php
//require_once('DetallepolizaDiario.php');
?>

<!--***************ESTILOS*****************-->
<link rel="stylesheet" href="/conta6/Resources/css/sweetalert.css">
<link rel="stylesheet" href="/conta6/Resources/bootstrap/alertifyjs/css/alertify.min.css">
<link rel="stylesheet" href="/conta6/Resources/bootstrap/alertifyjs/css/themes/default.css">

<!--***************SCRIPTS*****************-->
<script src="js/Polizas.js"></script>
