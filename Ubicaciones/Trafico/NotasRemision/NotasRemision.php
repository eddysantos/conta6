<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


  <div class="contenedor" id="b-notaRemision">
    <div class="row titulograndetop transEff brx2" id="referencia">
      <div class="col-md-12 text-center">
        <label class="transEff" for="bRef" id="labelRef">Referencia</label>
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
  <div class="contenedor container-fluid cont" id="m-Remision" style="display:none">
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
          <tr class="row tRepo">
            <td class="col-md-12">NOTA DE REMISIÓN</td>
          </tr>
        </thead>
        <tbody>
          <tr class="row">
            <td class="col-md-12 iap">CONSIGNACIÓN</td>
          </tr>
          <tr class="row" style="font-size:14px!important">
            <td class="col-md-12">MOTORES ELECTRICOS SUMERGIBLES DE MÉXICO, S DE R.L DE C.V</td>
            <td class="col-md-12">AVE.INDUSTRIA ALIMENTARIA, 2201</td>
            <td class="col-md-12">PARQUE INDUSTRIAL LINARES, CP 67735 LINARES</td>
          </tr>
          <tr class="row brx2">
            <td class="col-md-2 iap">REFERENCIA</td>
            <td class="col-md-2 iap">VALOR COMERCIAL</td>
            <td class="col-md-1 iap">PEDIMENTO</td>
            <td class="col-md-2 iap">CONTENIDO</td>
            <td class="col-md-1 iap">PESO</td>
            <td class="col-md-2 iap">TALONES,GUIA</td>
            <td class="col-md-2 iap">FLETES</td>
          </tr>
          <tr class="row text-normal">
            <td class="col-md-2">N17004726</td>
            <td class="col-md-2">2070922.562</td>
            <td class="col-md-1">7005410</td>
            <td class="col-md-2">Segun Ped. Anexo</td>
            <td class="col-md-1">13102</td>
            <td class="col-md-2">STPE0130070</td>
            <td class="col-md-2">0.0000</td>
          </tr>
          <tr class="row">
            <td class="col-md-3 input-effect brx3">
              <input id="cantidad" class="efecto text-normal w-100" type="text">
              <label for="cantidad">CANTIDAD</label>
            </td>
            <td class="col-md-8 input-effect brx3">
              <input id="observacion" class="efecto text-normal w-100" type="text">
              <label for="observacion">OBSERVACIONES</label>
            </td>
            <td class="col-md-1 brx3">
              <a><img class="icomediano" src="/conta6/Resources/iconos/printer.svg"></a>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>

<script src="../js/Trafico.js"></script>
