<style media="screen">
  .activoparam{
    color: black!important;
    font-weight: bold;
  }
</style>

<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';

  require $root . '/conta6/Ubicaciones/Nomina/SueldosySalarios/submenu_sueldos.php';
?>

<!--Comienza Consultar Parametros-->
  <div id="contornoparam" style="<?php echo $marginbottom ?>">
    <div class="contorno mt-5 text-center">
      <div class="titulo font16" style="margin-top: -26px;">PARAMETROS</div>
      <div class="acordeon2">
        <div class="encabezado font16 p-1" data-toggle="collapse" href="#colapsoArticulo80">
          <a href="#">ARTICULO 80</a>
        </div>
        <div class="collapse font14" id="colapsoArticulo80">
          <table class="table table-hover">
            <thead>
              <tr class="row backpink font14 b fw-bold m-0">
                <td class="col-md-1">Editar</td>
                <td class="col-md-2">Inferior</td>
                <td class="col-md-2">Superior</td>
                <td class="col-md-2">Cuota</td>
                <td class="col-md-2">Porcentaje</td>
                <td class="col-md-3">Ultima Modificación</td>
              </tr>
            </thead>
            <tbody id="tablaArticulo80"></tbody>
          </table>
        </div>
      </div>

      <div class="acordeon2 mt-3">
        <div class="encabezado font16 p-1" data-toggle="collapse" href="#colapsoGenerales">
          <a href="#">GENERALES</a>
        </div>
        <div class="collapse font14" id="colapsoGenerales">
          <form class="form1">
            <table class="table table-hover text-center">
              <thead>
                <tr class="row backpink font14 b fw-bold m-0">
                  <td class="col-md-1">Editar</td>
                  <td class="col-md-1">Oficina</td>
                  <td class="col-md-2">Salario Mínimo</td>
                  <td class="col-md-1">IMSS</td>
                  <td class="col-md-1">Subsidio</td>
                  <td class="col-md-2">Días Trabajados</td>
                  <td class="col-md-2">Días por Pagar</td>
                  <td class="col-md-2">Ultima Modificación</td>
                </tr>
              </thead>
              <tbody id="tablaGenerales"></tbody>
            </table>
          </form>
        </div>
      </div>

      <div class="acordeon2 mt-3">
        <div class="encabezado font16 p-1" data-toggle="collapse" href="#colapsofIntegracion">
          <a href="#">FACTOR DE INTEGRACION</a>
        </div>
        <div class="collapse font14" id="colapsofIntegracion">
          <table class="table table-hover">
            <thead>
              <tr class="row backpink font14 b fw-bold m-0">
                <td class="col-md-3">Editar</td>
                <td class="col-md-3">Año</td>
                <td class="col-md-3">Integrado</td>
                <td class="col-md-3">Ultima Modificación</td>
              </tr>
            </thead>
            <tbody id="f-integracion"></tbody>
          </table>
        </div>
      </div>

      <div class="acordeon2 mt-3">
        <div class="encabezado font16 p-1" data-toggle="collapse" href="#colapsosubsidio">
          <a href="#">SUBSIDIO AL EMPLEO</a>
        </div>
        <div class="collapse font14" id="colapsosubsidio">
          <form class="form1">
            <table class="table table-hover">
              <thead>
                <tr class="row backpink font14 b fw-bold m-0">
                  <td class="col-md-2">Editar</td>
                  <td class="col-md-2">Inferior</td>
                  <td class="col-md-3">Superior</td>
                  <td class="col-md-2">Cuota</td>
                  <td class="col-md-3">Ultima Modificación</td>
                </tr>
              </thead>
              <tbody id="tablaSubsidio"></tbody>
            </table>
          </form>
        </div>
      </div>

      <div class="acordeon2 mt-3">
        <div class="encabezado font16 p-1" data-toggle="collapse" href="#colapsoimss">
          <a href="#">IMSS</a>
        </div>
        <div class="collapse font14" id="colapsoimss">
          <table class="table table-hover">
            <thead>
              <tr class="row backpink font14 b fw-bold m-0">
                <td class="col-md-1">Editar</td>
                <td class="col-md-1">Ramo</td>
                <td class="col-md-4">Descripción</td>
                <td class="col-md-1">Base</td>
                <td class="col-md-1">Tope</td>
                <td class="col-md-1">Patrón</td>
                <td class="col-md-1">Trabajador</td>
                <td class="col-md-2">Ultima Modificación</td>
              </tr>
            </thead>
            <tbody class="ls0" id="tablaImss"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div><!--/Termina Consultar Parametros-->
</div>

<?php
// require $root .'/conta6/Ubicaciones/Nomina/empleados/modales/Empleados.php';
require $root .'/conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/modales/Parametros.php';
require $root . '/conta6/Ubicaciones/footer.php';
 ?>
