<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/barradenavegacion.php';

$buscar = trim($_GET['buscar']);
$accion = trim($_GET['accion']);


if( $accion == 'notacredito' ){
  require $root . '/conta6/Resources/PHP/actions/consultaNotaCreditoTimbrada2.php';

?>
    <div class="contorno text-center" style="<?php echo $marginbottom ?>">
      <table class="table">
        <thead>
          <tr class="row">
            <td class="col-md-1 offset-sm-11 font14">
              <a href="/conta6/Ubicaciones/Contabilidad/Notacredito/1-notacredito.php" class="nc" accion="datosPedimento"><i class="back fa fa-arrow-left">Regresar</i></a>
            </td>
          </tr>
          <tr class="row encabezado font18">
            <td class="col-md-12">Notas de Crédito con la misma Referencia</td>
          </tr>
        </thead>
        <tbody>
          <tr class="row font14 backpink">
            <td class="col-md-1"></td>
            <td class="col-md-2">Nota de Crédito</td>
            <td class="col-md-1">Referencia</td>
            <td class="col-md-1">Proforma</td>
            <td class="col-md-1">Póliza</td>
            <td class="col-md-1">Cancela</td>
            <td class="col-md-4">CLIENTE</td>
            <td class="col-md-1"></td>
          </tr>
          <?php echo $resultadoConsulta; ?>
        </tbody>
      </table>
    </div>
<?php
}


if( $accion == 'facturas' ){
  require $root . '/conta6/Resources/PHP/actions/consultaFactura_timbradas.php';

?>
  <div class="contorno text-center" style="<?php echo $marginbottom ?>">
    <table class="table">
      <thead>
        <tr class="row">
          <td class="col-md-1 offset-sm-11 font14">
            <a href="/conta6/Ubicaciones/Contabilidad/Notacredito/1-notacredito.php" class="nc" accion="datosPedimento"><i class="back fa fa-arrow-left">Regresar</i></a>
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
        <?php echo $resultadoConsulta; ?>
      </tbody>
    </table>
  </div>

<?php
}




if( $accion == 'proformaNC' ){
  require $root . '/conta6/Ubicaciones/Contabilidad/Notacredito/actions/consultaNotacredito_proforma.php';
?>
  <table class="table">
    <thead>
      <tr class="row">
        <td class="col-md-1 offset-sm-11 font14">
          <a href="/conta6/Ubicaciones/Contabilidad/Notacredito/1-notacredito.php" class="nc" accion="datosPedimento"><i class="back fa fa-arrow-left">Regresar</i></a>
        </td>
      </tr>
      <tr class="row encabezado font18">
        <td class="col-md-12">Proformas de Nota de Crédito Generadas </td>
      </tr>
    </thead>
    <tbody>
      <tr class="row font14 backpink">
        <td class="col-md-1"></td>
        <td class="col-md-1">PROFORMA</td>
        <td class="col-md-2">REFERENCIA</td>
        <td class="col-md-1">FACTURA RELACIONADA</td>
        <td class="col-md-6">CLIENTE</td>
        <td class="col-md-1"></td>
      </tr>
      <?php echo $resultadoConsulta; ?>
    </tbody>
  </table>

<?php
}


  require $root . '/conta6/Ubicaciones/footer.php';
?>
