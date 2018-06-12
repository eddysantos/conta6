<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid text-center">


  <div class="contenedor" id="b-notaRemision">
    <div class="row titulograndetop transEff" id="referencia">
      <div class="col-md-12">
        <label class="transEff" for="bRef" id="labelRef">Referencia</label>
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
  <div class="contenedor contorno" id="m-Remision" style="display:none">
    <form class="form1">
      <table class="table">
        <thead>
          <tr class="row">
            <td class="col-md-1 offset-md-11 p-0 mb-2">
              <a class="atras" accion="BuscarOtro">
                <i class="back fa fa-arrow-left">Regresar</i>
              </a>
            </td>
          </tr>
          <tr class="row encabezado font16">
            <td class="col-md-12">NOTA DE REMISIÓN</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row backpink">
            <td class="col-md-12">CONSIGNACIÓN</td>
          </tr>
          <tr class="row">
            <td class="col-md-12">MOTORES ELECTRICOS SUMERGIBLES DE MÉXICO, S DE R.L DE C.V</td>
            <td class="col-md-12">AVE.INDUSTRIA ALIMENTARIA, 2201</td>
            <td class="col-md-12">PARQUE INDUSTRIAL LINARES, CP 67735 LINARES</td>
          </tr>
          <tr class="row mt-4 backpink">
            <td class="col-md-2">REFERENCIA</td>
            <td class="col-md-2">VALOR COMERCIAL</td>
            <td class="col-md-1">PEDIMENTO</td>
            <td class="col-md-2">CONTENIDO</td>
            <td class="col-md-1">PESO</td>
            <td class="col-md-2">TALONES,GUIA</td>
            <td class="col-md-2">FLETES</td>
          </tr>
          <tr class="row">
            <td class="col-md-2">N17004726</td>
            <td class="col-md-2">2070922.562</td>
            <td class="col-md-1">7005410</td>
            <td class="col-md-2">Segun Ped. Anexo</td>
            <td class="col-md-1">13102</td>
            <td class="col-md-2">STPE0130070</td>
            <td class="col-md-2">0.0000</td>
          </tr>
          <tr class="row mt-5">
            <td class="col-md-3 input-effect">
              <input id="cantidad" class="efecto" type="text">
              <label for="cantidad">CANTIDAD</label>
            </td>
            <td class="col-md-8 input-effect">
              <input id="observacion" class="efecto" type="text">
              <label for="observacion">OBSERVACIONES</label>
            </td>
            <td class="col-md-1">
              <a><img class="icomediano" src="/conta6/Resources/iconos/printer.svg"></a>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>
<script src="../js/Trafico.js"></script>
