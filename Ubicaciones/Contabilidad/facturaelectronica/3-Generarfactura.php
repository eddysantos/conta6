<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="contenedor" id="b-ctagastos"><!--antes b-factura-->
  <div class="row titulograndetop transEff brx2" id="referencia">
    <div class="col-md-12 text-center">
      <label class="transEff" for="bRef" id="labelRef">Referencia o Solicitud</label>
    </div>
  </div>
  <div class="row intermedio transEff" id="nReferencia">
    <div class="col-md-12" id="mostrarConsulta">
      <form  class="form-group" onsubmit="return false;">
        <input class="reg form-control noborder transEff" id="bRef" type="text">
      </form>
    </div>
  </div>
</div>


<!---se muestra al escribir la referencia y dar enter-->
<div class="contenedor container-fluid cont" id="m-factura" style="display:none"><!--antes m-factura-->
  <form class="form1">
    <table class="table text-center">
      <thead>
        <tr class="row">
          <td class="col-md-1 offset-md-11 p-0">
            <a class="atras" accion="BuscarOtro">
              <i class="back fa fa-arrow-left">Regresar</i>
            </a>
          </td>
        </tr>
        <tr class="row encabezado cuerpo mt-2">
          <td class="col-md-12">SOLICITUD DE ANTICIPO</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row backpink">
          <td class="col-md-2">SOLICITUD</td>
          <td class="col-md-2">REFERENCIA</td>
          <td class="col-md-7">CLIENTE</td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row borderojo" style="font-size:14px!important">
          <td class="col-md-2">280380</td>
          <td class="col-md-2">N17003012</td>
          <td class="col-md-7">CLT_6548 MOTORES ELECTRICOS SUMERGIBLES DE MEXICO, S. DE R.L DE C.V</td>
          <td class="col-md-1" style="padding:5px">
            <a href=""><img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg"></a>
            <a href=""><img class="icomediano mleftx2" src="/conta6/Resources/iconos/printer.svg"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div>

<script src="js/facturaElectronica.js"></script>
