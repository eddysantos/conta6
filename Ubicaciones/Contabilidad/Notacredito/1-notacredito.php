<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <div class="mt10" id="buscarRef">
    <div class="row justify-content-center"  id="referencia">
      <div class="col-md-6 transEff titulograndetop">Buscar</div>
    </div>
    <div class="row justify-content-center" id="nReferencia">
      <div class="col-md-6 transEff intermedio" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="bRef" type="text" autocomplete="off">
        </form>
      </div>
    </div>

    <div class="row justify-content-center mt-5">
      <div class="col-md-2">
        <a href="#" id="b-facturas" class="boton mostrarbusqueda"><img src="/conta6/Resources/iconos/magnifier.svg" class="icochico"> FACTURAS</a>
      </div>
      <div class="col-md-2">
        <a href="#" id="b-proforma" class="boton mostrarbusqueda"><img src="/conta6/Resources/iconos/magnifier.svg" class="icochico"> PROFORMAS</a>
      </div>
      <div class="col-md-2">
        <a href="#" id="b-notacredito" class="boton mostrarbusqueda"><img src="/conta6/Resources/iconos/magnifier.svg" class="icochico"> NOTA CREDITO</a>
      </div>
    </div>
  </div>

<!---se muestra al escribir la referencia y dar enter-->
  <div class="mt10 contorno" id="repoPed" style="display:none">
    <table class="table">
      <thead>
        <tr class="row">
          <td class="col-md-1 offset-sm-11 font14">
            <a href="#" class="nc" accion="datosPedimento"><i class="back fa fa-arrow-left">Regresar</i></a>
          </td>
        </tr>
        <tr class="row encabezado font18">
          <td class="col-md-12">Facturas Generadas con la misma Referencia</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row font14 backpink">
          <td class="col-md-1">FACTURA</td>
          <td class="col-md-2">REFERENCIA</td>
          <td class="col-md-1">POLIZA</td>
          <td class="col-md-1">CANCELACIÓN</td>
          <td class="col-md-6">CLIENTE</td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row borderojo font18">
          <td class="col-md-1">76854</td>
          <td class="col-md-2">N15001460R</td>
          <td class="col-md-1">234567</td>
          <td class="col-md-1">234568</td>
          <td class="col-md-6">MOTORES ELECTRICOS SUMERGIBLES S DE RL DE CV</td>
          <td class="col-md-1 text-right">
            <a href="#"><img src="/conta6/Resources/iconos/rightred.svg"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="js/NotaCredito.js"></script>
