<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/barradenavegacion.php';

// $buscar = trim($_GET['buscar']);
// $accion = trim($_GET['accion']);

?>
  <div class="contorno text-center">
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
          <td class="col-md-6">CLIENTE</td>
          <td class="col-md-1"></td>
        </tr>

        <tr class="row font14 borderojo">
          <td class="col-md-1">1</td>
          <td class="col-md-2">N13003036</td>
          <td class="col-md-2">PUE</td>
          <td class="col-md-6">CLT_6548 MOTORES ELECTRICOS SUMERGIBLES DE MEXICO, S DE RL DE CV</td>
          <td class="col-md-1 text-right"><a href="pagos_generar.php" onclick=""><img src="/conta6/Resources/iconos/rightred.svg"></a></td>
        </tr>
      </tbody>
    </table>
  </div>

<?php
  require $root . '/Conta6/Ubicaciones/footer.php';
?>
