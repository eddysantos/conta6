<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid text-center">


  <div class="contenedor" id="b-notaRemision">
    <div class="row justify-content-center" id="referencia">
      <div class="col-md-6 transEff titulograndetop" id="labelRef">Referencia</div>
    </div>
    <div class="row justify-content-center" id="nReferencia">
      <div class="col-md-6 transEff intermedio" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="bRef" type="text" autocomplete="off">
        </form>
      </div>
    </div>
  </div>


  <div class="contenedor contorno" id="m-Remision" style="display:none;<?php echo $marginbottom ?>">
    <table class="table">
      <thead>
        <tr class="row justify-content-end">
          <td class="col-md-2 text-right">
            <a href="#" class="atras" accion="BuscarOtro">
              <i class="back fa fa-arrow-left"></i>Regresar
            </a>
          </td>
        </tr>
        <tr class="row encabezado font16">
          <td class="col-md-12">NOTA DE REMISIÓN</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row backpink">
          <td class="col-md-12 p-1">CONSIGNACIÓN</td>
        </tr>
        <tr class="row">
          <td class="p-1 col-md-12">MOTORES ELECTRICOS SUMERGIBLES DE MÉXICO, S DE R.L DE C.V</td>
          <td class="p-1 col-md-12">AVE.INDUSTRIA ALIMENTARIA, 2201</td>
          <td class="p-1 col-md-12">PARQUE INDUSTRIAL LINARES, CP 67735 LINARES</td>
        </tr>
        <tr class="row mt-4 sub2">
          <td class="p-1 col-md-2">REFERENCIA</td>
          <td class="p-1 col-md-2">VALOR COMERCIAL</td>
          <td class="p-1 col-md-1">PEDIMENTO</td>
          <td class="p-1 col-md-2">CONTENIDO</td>
          <td class="p-1 col-md-1">PESO</td>
          <td class="p-1 col-md-2">TALONES,GUIA</td>
          <td class="p-1 col-md-2">FLETES</td>
        </tr>
        <tr class="row">
          <td class="p-1 col-md-2">N17004726</td>
          <td class="p-1 col-md-2">2070922.562</td>
          <td class="p-1 col-md-1">7005410</td>
          <td class="p-1 col-md-2">Segun Ped. Anexo</td>
          <td class="p-1 col-md-1">13102</td>
          <td class="p-1 col-md-2">STPE0130070</td>
          <td class="p-1 col-md-2">0.0000</td>
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
  </div>
</div>
<!-- <script src="../js/Trafico.js"></script> -->
<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
