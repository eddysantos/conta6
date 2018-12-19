<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <div class="row submenuMed font16 m-0">
    <div class="col-md-6">
      <a href="/Conta6/Ubicaciones/Nomina/SueldosySalarios/consultar_Nomina.php" >CONSULTAR NOMINA</a>
    </div>
    <div class="col-md-6">
      <a  href="/Conta6/Ubicaciones/Nomina/SueldosySalarios/Generar_Nomina.php">GENERAR NOMINA</a>
    </div>
  </div>

<!--Comienza Consultar Parametros-->
  <div id="contornoparam">
    <div class="contorno mt-5">
      <h5 class="titulo font14">PARAMETROS</h5>
      <div class="acordeon2">
        <div class="encabezado font16" data-toggle="collapse" href="#colapsoArticulo80">
          <a href="#">ARTICULO 80</a>
        </div>
        <div class="collapse font14" id="colapsoArticulo80" style="padding:0rem 1.5rem!important;">
          <form class="form1">
            <table class="table table-hover">
              <thead>
                <tr class="row backpink">
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
          </form>
        </div>
      </div>

      <div class="acordeon2 mt-3">
        <div class="encabezado font16" data-toggle="collapse" href="#colapsoGenerales">
          <a href="#">GENERALES</a>
        </div>
        <div class="collapse font14" id="colapsoGenerales" style="padding:0rem 1.5rem!important;">
          <form class="form1">
            <table class="table table-hover">
              <thead>
                <tr class="row backpink">
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
        <div class="encabezado font16" data-toggle="collapse" href="#colapsofIntegracion">
          <a href="#">FACTOR DE INTEGRACION</a>
        </div>
        <div class="collapse font14" id="colapsofIntegracion" style="padding:0rem 1.5rem!important;">
          <form class="form1">
            <table class="table table-hover">
              <thead>
                <tr class="row backpink">
                  <td class="col-md-3">Editar</td>
                  <td class="col-md-3">Año</td>
                  <td class="col-md-3">Integrado</td>
                  <td class="col-md-3">Ultima Modificación</td>
                </tr>
              </thead>
              <tbody id="f-integracion"></tbody>
            </table>
          </form>
        </div>
      </div>

      <div class="acordeon2 mt-3">
        <div class="encabezado font16" data-toggle="collapse" href="#colapsosubsidio">
          <a href="#">SUBSIDIO AL EMPLEO</a>
        </div>
        <div class="collapse font14" id="colapsosubsidio" style="padding:0rem 1.5rem!important;">
          <form class="form1">
            <table class="table table-hover">
              <thead>
                <tr class="row backpink">
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
        <div class="encabezado font16" data-toggle="collapse" href="#colapsoimss">
          <a href="#">IMSS</a>
        </div>
        <div class="collapse font14" id="colapsoimss" style="padding:0rem 1.5rem!important;">
          <form class="form1">
            <table class="table table-hover">
              <thead>
                <tr class="row backpink">
                  <td class="col-md-1">Editar</td>
                  <td class="col-md-1">Ramo</td>
                  <td class="col-md-2">Descripción</td>
                  <td class="col-md-1">Base</td>
                  <td class="col-md-1">Tope</td>
                  <td class="col-md-2">Patrón</td>
                  <td class="col-md-2">Trabajador</td>
                  <td class="col-md-2">Ultima Modificación</td>
                </tr>
              </thead>
              <tbody class="ls0" id="tablaImss"></tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div><!--/Termina Consultar Parametros-->
</div>

<script src="/Conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/js/parametros.js"></script>
<?php
// require $root .'/conta6/Ubicaciones/Nomina/empleados/modales/Empleados.php';
require $root .'/conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/modales/Parametros.php';
require $root . '/conta6/Ubicaciones/footer.php';
 ?>
