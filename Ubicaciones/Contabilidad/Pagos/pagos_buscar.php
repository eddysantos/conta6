<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/barradenavegacion.php';

$buscar = trim($_GET['bRef']);
// $accion = trim($_GET['accion']);

require $root . '/conta6/Resources/PHP/actions/facturas_cfdi_PPD.php';


?>
<div class="contorno text-center" style="margin-bottom:100px!important">
  <table class="table">
    <thead>
      <tr class="row">
        <td class="col-md-1 offset-sm-11 font14">
          <a href="/conta6/Ubicaciones/Contabilidad/Pagos/pagos.php"><i class="fa fa-arrow-left">Regresar</i></a>
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
        <td class="col-md-2">METODO PAGO</td>
        <td class="col-md-4">CLIENTE</td>
        <td class="col-md-2">ESTADO</td>
        <td class="col-md-1"></td>
      </tr>
      <?php echo $facturasPPD; ?>
    </tbody>
  </table>
</div>

<?php
require $root . '/Conta6/Ubicaciones/footer.php';
?>
