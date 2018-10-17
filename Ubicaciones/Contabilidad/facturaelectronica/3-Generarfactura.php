<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <div class="mt10" id="b-ctagastos"><!--antes b-factura-->
    <div class="row justify-content-center"  id="referencia">
      <div class="col-md-6 titulograndetop transEff" style="font-size:30px!important">Referencia o Solicitud</div>
    </div>
    <div class="row justify-content-center" id="nReferencia">
      <div class="col-md-6 intermedio transEff" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="bRef" type="text" autocomplete="off">
        </form>
      </div>
    </div>
  </div>

  <!---se muestra al escribir la referencia y dar enter-->
  <div class="mt-5 contorno" id="m-factura" style="display:none">
    <table class="table form1">
      <thead>
        <tr class="row">
          <td class="col-md-1 offset-md-11 font14">
            <a href="#" class="fele" accion="BuscarOtro"><i class="back fa fa-arrow-left">Regresar</i></a>
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

<!-- prueba modificar -->
