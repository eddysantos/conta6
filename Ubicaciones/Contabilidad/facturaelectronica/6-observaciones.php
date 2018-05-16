<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="continer-fluid">

<!---se muestra al dar click en Buscar-->
  <div class="contenedor" id="b-ctagastos">
    <div class="row titulograndetop transEff brx2" id="referencia">
      <div class="col-md-12 text-center">
        <label class="transEff" for="bRef" id="labelRef">Buscar CFD/CFI</label>
      </div>
    </div>
    <div class="row intermedio transEff" id="nReferencia">
      <div class="col-md-12" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;" >
          <input class="reg form-control noborder transEff" id="bRef" type="text">
        </form>
      </div>
    </div>
  </div>


<!---se muestra al escribir la referencia y dar enter-->

  <div class="contenedor container-fluid cont" id="m-ctagastos" style="display:none">
    <div class="col-md-12 offset-sm-11">
      <a class="atras" accion="cuadroObservaciones">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <table class="table text-center form1">
      <thead>
        <tr class="row encabezado font18">
          <td class="col-md-12">Motores Electricos Sumergibles de México S. de R.L de C.V</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row backpink font14">
          <td class="col-md-1"></td>
          <td class="col-md-2">REFERENCIA</td>
          <td class="col-md-2">CFD</td>
          <td class="col-md-2">PÓLIZA</td>
          <td class="col-md-2">CANCELA</td>
          <td class="col-md-2">OFICINA</td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row font14">
          <td class="col-md-1"></td>
          <td class="col-md-2">N17004084</td>
          <td class="col-md-2">76048</td>
          <td class="col-md-2">249691</td>
          <td class="col-md-2">0</td>
          <td class="col-md-2">240</td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row">
          <td class="col-md-12 input-effect mt-5" id="mostrar">
            <form class="form-group" onsubmit="return false;" >
              <input id="concepto" class="efecto text-center text-normal w-100" type="text">
              <label for="concepto">CONCEPTO</label>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
    <table id="capmod" class="table text-center" style="display:none">
      <tr class="row font18 backpink">
        <td class="col-md-6">CAPTURÓ</td>
        <td class="col-md-6">MODIFICÓ</td>
      </tr>
      <tr class="row">
        <td class="col-md-6">Apinales 18-07-2017 16:30:14</td>
        <td class="col-md-6">Apinales 18-07-2017 16:30:14</td>
      </tr>
    </table>
  </div>
</div>

<script src="js/facturaElectronica.js"></script>
<script src="/conta6/Resources/js/Inputs.js"></script>
