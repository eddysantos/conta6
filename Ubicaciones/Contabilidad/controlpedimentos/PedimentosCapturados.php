<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <div class="row backpink m-0">
    <div class="col-md-12" role="button">
      <a  id="submenuMed" class="conPed" accion="pCap" status="cerrado">PEDIMENTOS CAPTURADOS</a>
    </div>
  </div>
  <div id="contornoPed" class="contorno" style="display:none">
    <table class="table table-hover font16">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-12 ">PEDIMENTOS CAPTURADOS EN EL SISTEMA</td>
        </tr>
        <tr class="row backpink">
          <td class="col-md-3">ADUANA</td>
          <td class="col-md-3">PRIMERO</td>
          <td class="col-md-3">ÚLTIMO</td>
          <td class="col-md-3">TOTAL</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row">
          <td class="col-md-3">160</td>
          <td class="col-md-3">2000001</td>
          <td class="col-md-3">2000372</td>
          <td class="col-md-3">332</td>
        </tr>
        <tr class="row">
          <td class="col-md-3">240</td>
          <td class="col-md-3">2000001</td>
          <td class="col-md-3">5001904</td>
          <td class="col-md-3">32243</td>
        </tr>
        <tr class="row">
          <td class="col-md-3">430</td>
          <td class="col-md-3">2000001</td>
          <td class="col-md-3">5000295</td>
          <td class="col-md-3">555</td>
        </tr>
        <tr class="row">
          <td class="col-md-3">470</td>
          <td class="col-md-3">2000001</td>
          <td class="col-md-3">4000934</td>
          <td class="col-md-3">2774</td>
        </tr>
      </tbody>
    </table>
  </div>
  <!---se muestra al dar clic a buscar-->
  <div class="mt-5" id="buscarRef">
    <div class="row titulograndetop" id="referencia">
      <div class="col-md-12 ">
        <label class="transEff" for="bRef" id="labelRef">Buscar Pedimentos</label>
      </div>
    </div>
    <div class="row intermedio transEff" id="nReferencia">
      <div class="col-md-12" id="mostrarConsulta">
        <form class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="bRef" type="text">
        </form>
      </div>
    </div>
  </div>
  <!---se muestra al escribir la referencia y dar enter-->
  <div class="contenedor contorno" id="repoPed" style="display:none">
    <table class="table font16">
      <thead>
        <tr class="row">
          <td class="col-md-1 offset-sm-11 p-0">
            <a href="#" class="rg">
              <i class="back fa fa-arrow-left">Regresar</i>
            </a>
          </td>
        </tr>
        <tr class="row encabezado">
          <td class="col-md-12">DATOS IMPORTADOS DEL PEDIMENTO</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row backpink">
          <td class="col-md-1">ADUANA</td>
          <td class="col-md-2">PEDIMENTO</td>
          <td class="col-md-2">REFERENCIA</td>
          <td class="col-md-1">CVE.DOC</td>
          <td class="col-md-2">FECHA DE PAGO</td>
          <td class="col-md-4">IMPORTÓ</td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-1">240</td>
          <td class="col-md-2">5001904</td>
          <td class="col-md-2">N15001460R</td>
          <td class="col-md-1">RT</td>
          <td class="col-md-2">28-02-2015 00:00:00</td>
          <td class="col-md-4">XCoronado 09-03-2015 13:09:48</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="js/ControlPedimentos.js"></script>
