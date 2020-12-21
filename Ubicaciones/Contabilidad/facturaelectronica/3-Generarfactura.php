<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <div class="mt10" id="b-ctagastos" style="<?php echo $marginbottom ?>">
    <div class="row justify-content-center m-0"  id="referencia">
      <div class="col-md-6 titulograndetop transEff" style="font-size:30px!important">Referencia o Solicitud</div>
    </div>
    <div class="row justify-content-center m-0" id="nReferencia">
      <div class="col-md-6 intermedio transEff" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="bRef" type="text" autocomplete="off">
        </form>
      </div>
    </div>
  </div>


  <div class="mt-5 contorno" id="m-factura" style="display:none;<?php echo $marginbottom ?>">
    <table class="table font14">
      <thead>
        <tr class="row">
          <td class="col-md-1 offset-md-11 ">
            <a href="#" class="fele" accion="BuscarOtro"><i class="back fa fa-arrow-left">Regresar</i></a>
          </td>
        </tr>
        <tr class="row encabezado font16 mt-2">
          <td class="col-md-12">Cuentas de Gastos Capturadas</td>
        </tr>
        <tr class="row backpink font16">
          <td class="col-md-1">Solicitud</td>
          <td class="col-md-1">Poliza</td>
          <td class="col-md-1"></td>
          <td class="col-md-1">Factura</td>
          <td class="col-md-2">Referencia</td>
          <td class="col-md-5">Cliente</td>
          <td class="col-md-1"></td>
        </tr>
      </thead>
      <tbody id="lst_cuentasGastos_capturadas_timbrar"></tbody>
    </table>
  </div>
</div>
<?php
require $root . '/Ubicaciones/footer.php';
 ?>
