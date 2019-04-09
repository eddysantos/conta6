<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';

  $buscar = trim($_GET['buscar']);
  $accion = trim($_GET['accion']);

  require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/4-Consultarfactura_lstFacturasTimbradas.php';
?>

  <div id="buscarfactura" class="text-center">
    <div class="col-md-1 offset-md-11 p-0 mt-5">
      <a  href="#ConsultarFactura" data-toggle="modal">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>

    <div class="contorno" id="m-factura">
      <form>
        <table class="table">
          <thead>
            <tr class="row encabezado">
              <td class="col-md-12 font18">FACTURAS</td>
            </tr>
          </thead>
          <tbody>
            <tr class="row backpink">
              <td class="col-md-1"></td>
              <td class="col-md-1">FECHA</td>
              <td class="col-md-1">FACTURA</td>
              <td class="col-md-1">POLIZA</td>
              <td class="col-md-1">CANCELADA</td>
              <td class="col-md-1">SOLICITUD</td>
              <td class="col-md-1">REFERENCIA</td>
              <td class="col-md-4">CLIENTE</td>
              <td class="col-md-1"></td>
            </tr>
            <?php echo $listaFacturas; ?>
          </tbody>
        </table>
      </form>
    </div>
  </div>

<?php
require $root . '/conta6/Ubicaciones/footer.php';
 ?>
