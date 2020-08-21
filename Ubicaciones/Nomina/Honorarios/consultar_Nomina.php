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

  $regimenNomina = '09';
  require $root . '/Ubicaciones/Nomina/Honorarios/actions/ultimaNominaHonorarios.php';
  require $root . '/Resources/PHP/actions/consulta_nomina_anio.php';
  require $root . '/Ubicaciones/Nomina/Honorarios/modales/catalogoCompNomina.php';
require $root . '/Ubicaciones/Nomina/Honorarios/submenu_honorarios.php';
?>


<!--Comienza Generar CFDI-->
  <!-- <div id="contornogcfdiHon" style="display:none"> -->



  <table class="table text-center">
    <tr class="row mt-5">
      <td class="col-md-1 offset-md-5">
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



  <div  class="contorno mt-4">
    <div class="acordeon2">
      <div class="encabezado text-center font16 p-1" data-toggle="collapse" href="#collapseOne">
        <a href="#">DATOS GENERALES</a>
      </div>
      <div id="collapseOne" class="collapse">
        <table class="table text-center">
          <thead>
            <tr class="row m-0 backpink">
              <td class="p-1 col-md-1">Empleados</td>
              <td class="p-1 col-md-1">CFDI</td>
              <td class="p-1 col-md-2">Cancelados</td>
              <td class="p-1 col-md-2">Percepciones</td>
              <td class="p-1 col-md-2">Deducciones</td>
              <td class="p-1 col-md-2">Total</td>
              <td class="p-1 col-md-2">Total Neto</td>
            </tr>
          </thead>
          <tbody class="font14" id="resConNomGenerales"></tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="contorno mt-4 my-5">
    <table class="table text-center table-hover">
      <thead>
        <tr class="row encabezado align-items-center">
          <td class="col-md-1">No.</td>
          <td class="col-md-2">Empleado</td>
          <td class="col-md-1">Tipo</td>
          <td class="col-md-1 p-0">Documento
            <a href='#' onclick="nuevoDocNomina()">
              <img class='icomediano' src='/Resources/iconos/002-plus.svg'>
            </a>
          </td>
          <td class="col-md-1 p-0">
            <a href='#' onclick='borrarDocNominaTodos()'>
              <img class='icochico' src='/Resources/iconos/cross.svg'>
            </a>
          </td>
          <td class="col-md-1">Pol.Pago</td>
          <td class="col-md-1">Cancelar</td>
          <td class="col-md-1">Factura</td>
          <td class="col-md-1">Póliza</td>
          <td class="col-md-1">CFDI
            <a class='GenerarNominaCFDI' href='#' onclick='impresionCFDICompleto()'>
              <img class='icochico' src='/Resources/iconos/printer.svg'>
            </a>
            <a href='#catalogoComplementoNomina' data-toggle='modal'>
              <img class='icochico' src='/Resources/iconos/help.svg'>
            </a>
          </td>
        </tr>
      </thead>
      <tbody class="font14" id="resConNomDcocumentos"></tbody>
    </table>
  </div>


<script src="/Ubicaciones/Nomina/js/nomina.js"></script>
<script src="/Ubicaciones/Nomina/Honorarios/js/Honorarios.js" charset="utf-8"></script>
  <?php
    require $root . '/Ubicaciones/footer.php';
  ?>
