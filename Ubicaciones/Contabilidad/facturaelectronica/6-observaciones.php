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
        <form  class="form-group" onsubmit="return false;" method="post">
          <input class="reg form-control noborder transEff" id="bRef" type="text">
        </form>
      </div>
    </div>
  </div>


<!---se muestra al escribir la referencia y dar enter-->

  <div class="contenedor container-fluid cont" id="m-ctagastos" style="display:none">
    <div class="col-md-12 offset-sm-11 p0">
      <a class="atras" accion="cuadroObservaciones">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <table class="table text-center form1">
      <thead>
        <tr class="row tRepoNom" style="font-size:20px">
          <td class="col-md-12 text-center">Motores Electricos Sumergibles de México S. de R.L de C.V</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row" style="font-size:18px!important">
          <td class="col-md-1 iap"></td>
          <td class="col-md-2 text-center iap">REFERENCIA</td>
          <td class="col-md-2 text-center iap">CFD</td>
          <td class="col-md-2 text-center iap">PÓLIZA</td>
          <td class="col-md-2 text-center iap">CANCELA</td>
          <td class="col-md-2 text-center iap">OFICINA</td>
          <td class="col-md-1 iap"></td>
        </tr>
        <tr class="row" style="font-size:18px!important">
          <td class="col-md-1"></td>
          <td class="col-md-2 text-center">N17004084</td>
          <td class="col-md-2 text-center">76048</td>
          <td class="col-md-2 text-center">249691</td>
          <td class="col-md-2 text-center">0</td>
          <td class="col-md-2 text-center">240</td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row">
          <td class="col-md-12 input-effect brx3" id="mostrar">
            <form class="form-group" onsubmit="return false;" method="post">
              <input id="concepto" class="efecto text-center text-normal w-100" type="text">
              <label for="concepto">CONCEPTO</label>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
    <table id="capmod" class="table" style="display:none">
      <tr class="row" style="font-size:18px!important">
        <td class="col-md-6 text-center iap">CAPTURÓ</td>
        <td class="col-md-6 text-center iap">MODIFICÓ</td>
      </tr>
      <tr class="row">
        <td class="col-md-6 text-center">Apinales 18-07-2017 16:30:14</td>
        <td class="col-md-6 text-center">Apinales 18-07-2017 16:30:14</td>
      </tr>
    </table>
  </div>
</div>

<script src="js/facturaElectronica.js"></script>
<script src="/conta6/Resources/js/Inputs.js"></script>
