
<style media="screen">
  .activoparam{
    color: black!important;
    font-weight: bold;
  }
</style>
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';

  require $root . '/Ubicaciones/Nomina/Honorarios/submenu_honorarios.php';
  require $root .'/Ubicaciones/Nomina/Honorarios/parametros/modales/Parametros.php';

?>

<!--Comienza Consultar Parametros-->
  <div class="contorno my-5 text-center">
    <h5 class="titulo font14">PARAMETROS</h5>
    <div class="encabezado font16 p-2">
      <a href="#">ARTICULO 113</a>
    </div>
    <table class="table table-hover text-center">
      <thead>
        <tr class="row backpink m-0">
          <td class="col-md-1">Editar</td>
          <td class="col-md-2">Inferior</td>
          <td class="col-md-2">Superior</td>
          <td class="col-md-2">Cuota</td>
          <td class="col-md-2">Porcentaje</td>
          <td class="col-md-3">Ultima Modificación</td>
        </tr>
      </thead>
      <tbody id="tablaArticulo113"></tbody>
    </table>
  </div>

<script src="/Ubicaciones/Nomina/Honorarios/parametros/js/parametros.js"></script>
<?php
  require $root . '/Ubicaciones/footer.php';
 ?>
