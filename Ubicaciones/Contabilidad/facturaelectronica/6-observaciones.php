<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <div class="contenedor" id="b-cfdi">
    <div class="row justify-content-center" id="referencia">
      <div class="col-md-6 titulograndetop">
        <label class="transEff" for="bRef" id="labelRef">Buscar CFDI</label>
      </div>
    </div>
    <div class="row justify-content-center" id="nReferencia">
      <div class="col-md-6 intermedio transEff" id="mostrarConsultaObserv">
        <form  class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="bRef" type="text" autocomplete="off">
        </form>
      </div>
    </div>
  </div>


  <div class="contenedor contorno" id="m-cfdi" style="display:none">
    <div class="col-md-1 offset-sm-11">
      <a href="#" class="fele" accion="cuadroObservaciones">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <table class="table form1">
      <thead>
        <tr class="row encabezado font18">
          <td class="col-md-12">CFDI</td>
        </tr>
        <tr class="row backpink font14">
          <td class="col-md-1"></td>
          <td class="col-md-2">REFERENCIA</td>
          <td class="col-md-2">CFDI</td>
          <td class="col-md-2">PÓLIZA</td>
          <td class="col-md-2">CANCELA</td>
          <td class="col-md-2">OFICINA</td>
          <td class="col-md-1"></td>
        </tr>
      </thead>
      <tbody class="font14">
        <!--
        <tr class="row">
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
            <form class="form-group" onsubmit="return false;">
              <input id="concepto" class="efecto" type="text">
              <label for="concepto">CONCEPTO</label>
            </form>
          </td>
        </tr>
        <tr class="row font14 backpink mt-4">
          <td class="col-md-6">CAPTURÓ</td>
          <td class="col-md-6">MODIFICÓ</td>
        </tr>
        <tr class="row">
          <td class="col-md-6">Apinales 18-07-2017 16:30:14</td>
          <td class="col-md-6">Apinales 18-07-2017 16:30:14</td>
        </tr>
      -->
      </tbody>
      <tbody id="lst_cfdi_capturadas"></tbody>
    </table>
  </div>
</div>
<?php
  require $root . '/Ubicaciones/footer.php';
?>
<!-- prueba modificar  -->
