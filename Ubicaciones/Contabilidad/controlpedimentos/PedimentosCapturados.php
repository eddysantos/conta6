<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row submenuMed">
    <div class="col-12 text-center" role="button">
      <a  id="submenuMed" class="consultar" accion="pCap" status="cerrado">PEDIMENTOS CAPTURADOS</a>
    </div>
  </div>
  <div id="contornoPed" class="contorno brx4" style="display:none">
    <table class="table text-normal table-hover">
      <thead class="">
        <tr class="row m-0 encabezado">
          <td class="col-12 text-center">PEDIMENTOS CAPTURADOS EN EL SISTEMA</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-3 text-center backpink">ADUANA</td>
          <td class="col-md-3 text-center backpink">PRIMERO</td>
          <td class="col-md-3 text-center backpink">ÚLTIMO</td>
          <td class="col-md-3 text-center backpink">TOTAL</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row m-0 text-center">
          <td class="col-md-3">160</td>
          <td class="col-md-3">2000001</td>
          <td class="col-md-3">2000372</td>
          <td class="col-md-3">332</td>
        </tr>
        <tr class="row m-0 text-center">
          <td class="col-md-3">240</td>
          <td class="col-md-3">2000001</td>
          <td class="col-md-3">5001904</td>
          <td class="col-md-3">32243</td>
        </tr>
        <tr class="row m-0 text-center">
          <td class="col-md-3">430</td>
          <td class="col-md-3">2000001</td>
          <td class="col-md-3">5000295</td>
          <td class="col-md-3">555</td>
        </tr>
        <tr class="row m-0 text-center">
          <td class="col-md-3">470</td>
          <td class="col-md-3">2000001</td>
          <td class="col-md-3">4000934</td>
          <td class="col-md-3">2774</td>
        </tr>
      </tbody>
    </table>
  </div>
  <!---se muestra al dar clic a buscar-->
  <div class="brx4" id="buscarRef">
    <div class="row titulograndetop transEff brx2" id="referencia">
      <div class="col-12 text-center">
        <label class="transEff" for="bRef" id="labelRef">Buscar Pedimentos</label>
      </div>
    </div>
    <div class="row intermedio transEff" id="nReferencia">
      <div class="col-12" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;" method="post">
          <input class="reg form-control noborder transEff" id="bRef" type="text">
        </form>
      </div>
    </div>
  </div>
  <!---se muestra al escribir la referencia y dar enter-->
  <div class="contenedor container-fluid cont" id="repoPed" style="display:none">
    <table class="table">
      <thead>
        <tr class="row">
          <td class="col-md-12 offset-sm-11 p-0">
            <a class="regresar" accion="datosPedimento">
              <i class="back fa fa-arrow-left">Regresar</i>
            </a>
          </td>
        </tr>
        <tr class="row encabezado">
          <td class="col-md-12 text-center">DATOS IMPORTADOS DEL PEDIMENTO</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row text-normal">
          <td class="col-md-1 text-center backpink">ADUANA</td>
          <td class="col-md-2 text-center backpink">PEDIMENTO</td>
          <td class="col-md-2 text-center backpink">REFERENCIA</td>
          <td class="col-md-1 text-center backpink">CVE.DOC</td>
          <td class="col-md-2 text-center backpink">FECHA DE PAGO</td>
          <td class="col-md-4 text-center backpink">IMPORTÓ</td>
        </tr>
        <tr class="row borderojo" style="font-size:18px!important">
          <td class="col-md-1 text-center">240</td>
          <td class="col-md-2 text-center">5001904</td>
          <td class="col-md-2 text-center">N15001460R</td>
          <td class="col-md-1 text-center">RT</td>
          <td class="col-md-2 text-center">28-02-2015 00:00:00</td>
          <td class="col-md-4 text-center">XCoronado 09-03-2015 13:09:48</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="js/ControlPedimentos.js"></script>
