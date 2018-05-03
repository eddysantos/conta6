<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>



<div class="container-fluid">
  <div class="contenedor" id="buscarRef">
    <div class="row titulograndetop transEff brx2" id="referencia">
      <div class="col-12 text-center">
        <label class="transEff" for="bRef" id="labelRef">Buscar</label>
      </div>
    </div>
    <div class="row intermedio transEff" id="nReferencia">
      <div class="col-12" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;">
        <input class="reg form-control noborder transEff" id="bRef" type="text" autocomplete="off">
      </form>
      </div>
    </div>
  </div>


<!---se muestra al escribir la referencia y dar enter-->
  <div class="contenedor container-fluid cont" id="repoPed" style="display:none">
    <table class="table">
      <thead>
        <tr class="row">
          <td class="col-md-12 offset-sm-11 p0">
            <a href="" class="atras" accion="datosPedimento"><i class="back fa fa-arrow-left">Regresar</i></a>
          </td>
        </tr>
        <tr class="row tRepo">
          <td class="col-md-12 text-center">Facturas Generadas con la misma Referencia</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row text-normal">
          <td class="col-md-1 text-center iap">FACTURA</td>
          <td class="col-md-1 text-center iap">REFERENCIA</td>
          <td class="col-md-2 text-center iap">POLIZA</td>
          <td class="col-md-1 text-center iap">CANCELACIÓN</td>
          <td class="col-md-6 text-center iap">CLIENTE</td>
          <td class="col-md-1 text-center iap"></td>
        </tr>
        <tr class="row borderojo" style="font-size:18px!important">
          <td class="col-md-1 text-center">76854</td>
          <td class="col-md-1 text-center">N15001460R</td>
          <td class="col-md-2 text-center">234567</td>
          <td class="col-md-1 text-center">234568</td>
          <td class="col-md-6 text-center">MOTORES ELECTRICOS SUMERGIBLES S DE RL DE CV</td>
          <td class="col-md-1 text-center">
            <input class="btn-block botonrow" type="button" value="Siguiente">
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="js/NotaCredito.js"></script>
