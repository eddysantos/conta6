<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>



<div class="text-center">
  <div class="contenedor" id="buscarRef">
    <div class="row titulograndetop transEff" id="referencia">
      <div class="col-md-12 ">
        <label class="transEff" for="bRef" id="labelRef">Buscar Pedimentos</label>
      </div>
    </div>
    <div class="row intermedio transEff" id="nReferencia">
      <div class="col-md-12" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;">
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
            <a class="atras" accion="datosPedimento">
              <i class="back fa fa-arrow-left">Regresar</i>
            </a>
          </td>
        </tr>
        <tr class="row encabezado">
          <td class="col-md-12 ">DATOS IMPORTADOS DEL PEDIMENTO</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row backpink">
          <td class="col-md-1">CTA.GASTOS</td>
          <td class="col-md-1">PÓLIZA</td>
          <td class="col-md-2">CANCELACIÓN</td>
          <td class="col-md-1">REFERENCIA</td>
          <td class="col-md-2">REG.CONTABLE</td>
          <td class="col-md-5">FACTURADO A: </td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-1">76854</td>
          <td class="col-md-1">234567</td>
          <td class="col-md-2"></td>
          <td class="col-md-1">N15001460R</td>
          <td class="col-md-2"></td>
          <td class="col-md-5"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="js/CuentaGastos.js"></script>
