<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <div class="mt10 contorno" id="repoPed" style="display:none">
    <table class="table">
      <thead>
        <tr class="row">
          <td class="col-md-1 offset-sm-11 font14">
            <a href="#" class="nc" accion="datosPedimento"><i class="back fa fa-arrow-left">Regresar</i></a>
          </td>
        </tr>
        <tr class="row encabezado font18">
          <td class="col-md-12">Facturas Generadas con la misma Referencia</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row font14 backpink">
          <td class="col-md-1">FACTURA</td>
          <td class="col-md-2">REFERENCIA</td>
          <td class="col-md-1">POLIZA</td>
          <td class="col-md-1">CANCELACIÓN</td>
          <td class="col-md-6">CLIENTE</td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row borderojo font18">
          <td class="col-md-1">76854</td>
          <td class="col-md-2">N15001460R</td>
          <td class="col-md-1">234567</td>
          <td class="col-md-1">234568</td>
          <td class="col-md-6">MOTORES ELECTRICOS SUMERGIBLES S DE RL DE CV</td>
          <td class="col-md-1 text-right">
            <a href="#"><img src="/conta6/Resources/iconos/rightred.svg"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
