<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <div class="mt10" id="b-ctagastos"><!--antes b-factura-->
    <div class="row"  id="referencia">
      <div class="offset-md-3 col-md-6 titulobuscar" style="font-size:30px!important">Referencia o Solicitud</div>
    </div>
    <div class="row transEff" id="nReferencia">
      <div class="offset-md-3 col-md-6 inputbuscar" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="bRef" type="text" autocomplete="off">
        </form>
      </div>
    </div>
  </div>

  <!---se muestra al escribir la referencia y dar enter-->
  <div class="mt10 contorno2" id="m-factura" style="display:none">
    <table class="table form1">
      <thead>
        <tr class="row">
          <td class="col-md-1 offset-md-11 font14">
            <a href="#" class="fele" accion="BuscarOtro"><i class="back fa fa-arrow-left">Regresar</i></a>
          </td>
        </tr>
        <tr class="row encabezado font16 mt-2">
          <td class="col-md-12">Cuentas de Gastos Capturadas</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row backpink" style="font-size:16px!important">
          <td class="col-md-1">Solicitud</td>
          <td class="col-md-1">Poliza</td>
          <td class="col-md-1">&nbsp;</td>
          <td class="col-md-1">Factura</td>
          <td class="col-md-2">Referencia</td>
          <td class="col-md-5">Cliente</td>
          <td class="col-md-1"></td>
        </tr>
      </tbody>
      <tbody id="lst_cuentasGastos_capturadas_timbrar"></tbody>
    </table>
  </div>
</div>
<script src="js/facturaElectronica.js"></script>
<?php
require $root . '/conta6/Ubicaciones/footer.php';
 ?>
