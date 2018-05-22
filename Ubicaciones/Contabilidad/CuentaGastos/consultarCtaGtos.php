<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>



<div class="container-fluid">
  <div class="contenedor" id="buscarRef">
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
          <td class="col-md-12 offset-sm-11 p0">
            <a class="atras" accion="datosPedimento">
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
          <td class="col-md-1 text-center backpink">CTA.GASTOS</td>
          <td class="col-md-1 text-center backpink">PÓLIZA</td>
          <td class="col-md-2 text-center backpink">CANCELACIÓN</td>
          <td class="col-md-1 text-center backpink">REFERENCIA</td>
          <td class="col-md-2 text-center backpink">REG.CONTABLE</td>
          <td class="col-md-5 text-center backpink">FACTURADO A: </td>
        </tr>
        <tr class="row borderojo" style="font-size:18px!important">
          <td class="col-md-1 text-center">76854</td>
          <td class="col-md-1 text-center">234567</td>
          <td class="col-md-2 text-center"></td>
          <td class="col-md-1 text-center">N15001460R</td>
          <td class="col-md-2 text-center"></td>
          <td class="col-md-5 text-center"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="js/CuentaGastos.js"></script>
