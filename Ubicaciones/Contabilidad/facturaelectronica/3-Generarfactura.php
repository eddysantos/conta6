<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <div class="contenedor" id="b-ctagastos"><!--antes b-factura-->
    <div class="row titulograndetop transEff" id="referencia">
      <div class="col-md-12">
        <label class="transEff" for="bRef" id="labelRef">Referencia o Solicitud</label>
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
  <div class="contenedor contorno" id="m-factura" style="display:none">
    <table class="table form1">
      <thead>
        <tr class="row">
          <td class="col-md-1 offset-md-11 p-0">
            <a class="bg" accion="BuscarOtro"><i class="back fa fa-arrow-left">Regresar</i></a>
          </td>
        </tr>
        <tr class="row encabezado font16 mt-2">
          <td class="col-md-12">SOLICITUD DE ANTICIPO</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row backpink">
          <td class="col-md-2">SOLICITUD</td>
          <td class="col-md-2">REFERENCIA</td>
          <td class="col-md-7">CLIENTE</td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-2">280380</td>
          <td class="col-md-2">N17003012</td>
          <td class="col-md-7">CLT_6548 MOTORES ELECTRICOS SUMERGIBLES DE MEXICO, S. DE R.L DE C.V</td>
          <td class="col-md-1 p-2">
            <a href=""><img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg"></a>
            <a href=""><img class="icomediano ml-5" src="/conta6/Resources/iconos/printer.svg"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<script src="js/facturaElectronica.js"></script>
