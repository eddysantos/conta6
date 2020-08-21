<style media="screen">
  .activogenCFDI{
    color: black!important;
    font-weight: bold;
  }
</style>

<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
  require $root . '/Resources/PHP/actions/validarFormulario.php';
  require $root . '/Ubicaciones/Nomina/SueldosySalarios/submenu_sueldos.php';
  $regimenNomina = '02';
  require $root . '/Resources/PHP/actions/consulta_nomina_anio.php';

?>

  <div class="">
    <form class="form1">
      <table class="table">
        <tr class="row mt-5 justify-content-center">
          <td class="col-md-1 input-effect">
            <input id="nom_regimen" type="hidden" value="<?php echo $regimenNomina; ?>">
            <select class="custom-select" id="buscaranio">
              <?php echo $consultaAnioNomina; ?>
            </select>
          </td>
          <td class="col-md-1">
            <div id="resConNomSem"></div>
          </td>
        </tr>
      </table>
    </form>

    <div  class="contorno mt-4">
      <div class="acordeon2">
        <div class="encabezado text-center font16 p-2" data-toggle="collapse" href="#collapseOne">
          <a href="#">DATOS GENERALES</a>
        </div>
        <div id="collapseOne" class="collapse">
          <form class="form1">
            <table class="table text-center">
              <thead>
                <tr class="row m-0 backpink">
                  <td class="col-md-1">Empleados</td>
                  <td class="col-md-1">CFDI</td>
                  <td class="col-md-2">Cancelados</td>
                  <td class="col-md-2">Percepciones</td>
                  <td class="col-md-2">Deducciones</td>
                  <td class="col-md-2">Total</td>
                  <td class="col-md-2">Total Neto</td>
                </tr>
              </thead>
              <tbody class="font14" id="resConNomGenerales"></tbody>
            </table>
          </form>
        </div>
      </div>
    </div>

    <div class="contorno mt-4" style="<?php echo $marginbottom ?>">
      <table class="table text-center m-0 table-hover">
        <thead>
          <tr class="row encabezado align-items-center">
            <td class="col-md-1">No.</td>
            <td class="col-md-2">Empleado</td>
            <td class="col-md-1">Tipo</td>
            <td class="col-md-1 p-0">Documento
              <a href='#' onclick="nuevoDocNomina()" class='ml-2'>
                <img class='w-5' src='/Resources/iconos/002-plus.svg'>
              </a>
            </td>
            <td class="col-md-1">
              <a href='#' onclick='borrarDocNominaTodos()'>
                <img class='w-5' src='/Resources/iconos/cross.svg'>
              </a>
            </td>
            <td class="col-md-1">Pol.Pago</td>
            <td class="col-md-1">Cancelar</td>
            <td class="col-md-1">Factura</td>
            <td class="col-md-1">Póliza</td>
            <td class="col-md-1 p-0">
              CFDI
              <a href='#'>
                <img class='w-5 ml-2' src='/Resources/iconos/printer.svg'>
              </a>
              <a href='#'>
                <img class='w-5' src='/Resources/iconos/help.svg'>
              </a>
            </td>
            <td class="col-md-1"></td>
          </tr>
        </thead>
        <tbody class="font14" id="resConNomDcocumentos"></tbody>
      </table>
    </div>


  </div>
</div>

<script src="/Ubicaciones/Nomina/js/nomina.js"></script>

<script src="js/SueldosySalarios.js"></script>

<!-- <script src="/Resources/bootstrap/js/bootstrap-toggle.js"></script> -->

<?php
require $root . '/Ubicaciones/footer.php';
?>
