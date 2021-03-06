<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Ubicaciones/barradenavegacion.php';

$buscar = trim($_GET['bRef']);
$accion = trim($_GET['accion']);
?>


<?php
if( $accion == 'pagosElect' ){
  require $root . '/Resources/PHP/actions/consultaPagoTimbrada2.php';
?>
<div class="contorno text-center" style="<?php echo $marginbottom ?>">
  <table class="table">
    <thead>
      <tr class="row">
        <td class="col-md-1 offset-sm-11 font14">
          <a href="/Ubicaciones/Contabilidad/Pagos/pagos.php"><i class="fa fa-arrow-left">Regresar</i></a>
        </td>
      </tr>
      <tr class="row encabezado font18">
        <td class="col-md-12">Pagos Electrónicos con la misma Referencia</td>
      </tr>
    </thead>
    <tbody>
      <tr class="row font14 backpink">
        <td class="col-md-1"></td>
        <td class="col-md-1">FECHA</td>
        <td class="col-md-1">PAGO CFDI</td>
        <td class="col-md-1">PÓLIZA</td>
        <td class="col-md-1">CANCELA</td>
        <td class="col-md-5">CLIENTE</td>
        <td class="col-md-2"></td>
      </tr>
      <?php echo $pagosCFDI; ?>
    </tbody>
  </table>
</div>
<?php } ?>

<?php
if( $accion == 'facturas' ){
  require $root . '/Resources/PHP/actions/facturas_cfdi_PPD.php';
?>
<div class="contorno text-center" style="<?php echo $marginbottom ?>">
  <table class="table">
    <thead>
      <tr class="row">
        <td class="col-md-1 offset-sm-11 font14">
          <a href="/Ubicaciones/Contabilidad/Pagos/pagos.php"><i class="fa fa-arrow-left">Regresar</i></a>
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
<?php } ?>


<?php
if( $accion == 'pagosCaptura' ){
  $text = $buscar;
  require $root . '/Ubicaciones/Contabilidad/Pagos/actions/pagos_lst_capturados.php';
?>
<div class="contorno text-center" style="<?php echo $marginbottom ?>">
  <table class="table">
    <thead>
      <tr class="row">
        <td class="col-md-1 offset-sm-11 font14">
          <a href="/Ubicaciones/Contabilidad/Pagos/pagos.php"><i class="fa fa-arrow-left">Regresar</i></a>
        </td>
      </tr>
      <tr class="row encabezado font18">
        <td class="col-md-12">Pagos capturados con la misma Referencia</td>
      </tr>
    </thead>
    <tbody>
      <tr class="row font14 backpink">
        <td class="col-md-1"></td>
        <td class="col-md-2">SOLICITUD</td>
        <td class="col-md-6">CLIENTE</td>
        <td class="col-md-3"></td>
      </tr>
      <?php echo $pagosCaptura; ?>
    </tbody>
  </table>
</div>
<?php } ?>

<!-- pagosElect -->

<?php
require $root . '/Ubicaciones/footer.php';
?>
