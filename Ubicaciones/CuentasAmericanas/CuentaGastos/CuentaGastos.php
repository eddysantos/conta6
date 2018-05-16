<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="continer-fluid">

<!---AL INGRESAR SOLO SE MOSTRARA ESTA SECCION-->
  <div class="row submenu m-0" id="SeleccionarAccion">
    <div class="col-6 text-center">
      <a  id="submenu" class="ctagastos" accion="buscar"><i class="fa fa-search" aria-hidden="true"></i>BUSCAR</a>
    </div>
    <div class="col-6 text-center">
      <a id="submenu" class="ctagastos" accion="generar"><i class="fa fa-plus" aria-hidden="true"></i>GENERAR</a>
    </div>
  </div>


<!---se muestra al dar click en Buscar-->
  <div class="contenedor "id="buscarRef" style="display:none">
    <div class="row">
      <div class="col-md-1 offset-sm-8 p-0">
        <a href="#" class="atras" accion="cuadroBusqueda">
          <i class="back fa fa-arrow-left">Regresar</i>
        </a>
      </div>
    </div>
    <div class="row titulograndetop transEff brx2" id="referencia">
      <div class="col-md-12 text-center">
        <label class="transEff" for="bRef" id="labelRef">Referencia o Solicitud</label>
      </div>
    </div>
    <div class="row intermedio transEff" id="nReferencia">
      <div class="col-md-12" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;">
        <input class="reg form-control noborder transEff" id="bRef" type="text" autocomplete="off">
      </form>
      </div>
    </div>
  </div>

<!---se muestra al escribir la referencia y dar enter-->
  <div class="contenedor container-fluid cont" id="repoSol" style="display:none">
    <table class="table text-center">
      <tr class="row">
        <td class="col-md-1 offset-sm-11 p-0">
          <a class="atras" accion="cuadroConsultar">
            <i class="back fa fa-arrow-left">Regresar</i>
          </a>
        </td>
      </tr>
      <tr class="row encabezado font18">
        <td class="col-md-12 text-center">Cuenta de Gastos</td>
      </tr>
      <tr class="row backpink" style="font-size:16px!important">
        <td class="col-md-1"></td>
        <td class="col-md-2">CTA AMERICANA</td>
        <td class="col-md-2">CANCELACIÓN</td>
        <td class="col-md-2">REFERENCIA</td>
        <td class="col-md-3">CLIENTE</td>
        <td class="col-md-1"></td>
        <td class="col-md-1"></td>
      </tr>
      <tr class="row borderojo font18">
        <td class="col-md-1">
          <a href="/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/Editarcta.php">
            <img class="icomediano" src="/conta6/Resources/iconos/003-edit.svg">
          </a>
        </td>
        <td class="col-md-2">280380</td>
        <td class="col-md-2">222222</td>
        <td class="col-md-2">N17003012</td>
        <td class="col-md-3">CLT_6548 MOTORES ELECTRICOS SUMERGIBLES DE MEXICO, S. DE R.L DE C.V</td>
        <td class="col-md-1">
          <a href="/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/Consultarcta.php">
            <img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg">
          </a>
        </td>
        <td class="col-md-1">
          <a>
            <img class="icomediano" src="/conta6/Resources/iconos/printer.svg">
          </a>
        </td>
      </tr>
    </table>
  </div>

<!---se muestra al dar click en referencia-->
  <div class="contenedor text-center" id="gctaGastos" style="display:none">
    <div class="col-md-1 offset-sm-8 p-0">
      <a class="atras" accion="cuadroGenerar">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <div class="row titulograndetop transEff brx2" id="gctaGastosRef">
      <div class="col-md-12">
        <label class="transEff" for="gRef" id="labelgRef">Generar Cta de Gastos</label>
      </div>
      <div class="col-md-12 backpink" style="font-size:22px!important">
        <label class="transEff">REFERENCIA</label>
      </div>
    </div>
    <div class="row intermedio">
      <div class="col-md-12" id="mostrarGenerar">
        <form class="form-group" onsubmit="return false;">
          <input class="reg form-control noborder transEff" id="gRef" type="text">
        </form>
      </div>
    </div>
  </div>


<script src="js/CuentaGastos.js"></script>
