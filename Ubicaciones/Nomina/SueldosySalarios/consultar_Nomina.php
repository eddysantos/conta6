<style media="screen">
  .activogenCFDI{
    color: black!important;
    font-weight: bold;
  }
</style>

<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
  require $root . '/conta6/Resources/PHP/actions/validarFormulario.php';

  require $root . '/conta6/Ubicaciones/Nomina/SueldosySalarios/submenu_sueldos.php';


  $regimenNomina = '02';
  require $root . '/conta6/Resources/PHP/actions/consulta_nomina_anio.php';

?>

  <div class="">
    <form class="form1">
      <table class="table">
        <tr class="row mt-5">
          <td class="col-md-2 offset-md-5 input-effect">
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
        <div class="encabezado text-center font16" data-toggle="collapse" href="#collapseOne">
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

    <div class="contorno mt-4">
      <table class="table text-center m-0 table-hover">
        <thead>
          <tr class="row encabezado">
            <td class="col-md-1">No.</td>
            <td class="col-md-3">Empleado</td>
            <td class="col-md-1">Tipo</td>
            <td class="col-md-1">Documento <a href=''><img class='icomediano' src='/conta6/Resources/iconos/002-plus.svg'></a></td>
            <td class="col-md-1"><a href=''><img class='icochico' src='/conta6/Resources/iconos/cross.svg'></a></td>
            <td class="col-md-1">Pol.Pago</td>
            <td class="col-md-1">Cancelar</td>
            <td class="col-md-1">Factura</td>
            <td class="col-md-1">Póliza</td>
            <td class="col-md-1">CFDI<a href='#' > <img class='icomediano' src='/conta6/Resources/iconos/printer.svg'></a> <a href=''> <img class='icomediano' src='/conta6/Resources/iconos/help.svg'></a>
            </td>
            <td class="col-md-1"></td>
          </tr>
        </thead>
        <tbody class="font14" id="resConNomDcocumentos"></tbody>
      </table>
    </div>

    <!--div  class="contorno mt-5">
      <table class="table table-hover mb-0">
        <thead>
          <tr class="row encabezado">
            <td class="col-md-1">NOMINA</td>
            <td class="col-md-1">EMPLEADOS</td>
            <td class="col-md-1">CFDI</td>
            <td class="col-md-1">CANCELADOS</td>
            <td class="col-md-2">PERCEPCIONES</td>
            <td class="col-md-2">DEDUCCIONES</td>
            <td class="col-md-2">TOTAL</td>
            <td class="col-md-2">TOTAL NETO</td>
          </tr>
        </thead>
        <tbody class="font16">
          <tr class="row">
            <td class="col-md-1"><a href="#">1</a></td>
            <td class="col-md-1">34</td>
            <td class="col-md-1">0</td>
            <td class="col-md-1">0</td>
            <td class="col-md-2">$140,736.04</td>
            <td class="col-md-2">$31,356.08</td>
            <td class="col-md-2">$109,450.52</td>
            <td class="col-md-2">$109,450.51</td>
          </tr>
          <tr class="row">
            <td class="col-md-1"><a href="">2</a></td>
            <td class="col-md-1">34</td>
            <td class="col-md-1">0</td>
            <td class="col-md-1">0</td>
            <td class="col-md-2">$140,736.04</td>
            <td class="col-md-2">$31,356.08</td>
            <td class="col-md-2">$109,450.52</td>
            <td class="col-md-2">$109,450.51</td>
          </tr>
        </tbody>
        <tfoot>
          <tr class="row">
            <td class="col-md-2 offset-md-5 mt-5">
              <nav>
                <ul class="pagination">
                  <li class="page-item"><as class="page-link" href="#">Atras</a></li>
                  <li class="page-item"><as class="page-link" href="#">1</a></li>
                  <li class="page-item active">
                    <a href="#" class="page-link" href="#">2<span class="sr-only"></span></a>
                  </li>
                  <li class="page-item"><as class="page-link" href="#">3</a></li>
                  <li class="page-item"><as class="page-link" href="#">4</a></li>
                  <li class="page-item"><as class="page-link" href="#">5</a></li>
                  <li class="page-item"><as class="page-link" href="#">Sig.</a></li>
                </ul>
              </nav>
            </td>
          </tr>
        </tfoot>
      </table>
    </div-->


  </div>
</div>

<script src="js/SueldosySalarios.js"></script>
<!-- <script src="/conta6/Resources/bootstrap/js/bootstrap-toggle.js"></script> -->

<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
