
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
  require $root . '/conta6/Resources/PHP/actions/validarFormulario.php';

  $regimenNomina = '09';
  require $root . '/conta6/Ubicaciones/Nomina/Honorarios/actions/ultimaNominaHonorarios.php';
  require $root . '/conta6/Resources/PHP/actions/consulta_nomina_anio.php';
?>

<div class="container-fluid">
<?php require $root . '/conta6/Ubicaciones/Nomina/Honorarios/submenu_honorarios.php'; ?>
  <!--Comienza Generar Nomina-->
  <div id="contornognomHon" class="contorno mx-0 mt-4" style="display:none">
    <div class="titulo font16" style='margin-top: -28px;'>Documento Ordinario</div>
    <table class="table text-center" id="generarnominaHon">
      <thead>
        <tr class="row font14 encabezado">
          <td class="col-md-3"><?php echo $anioFI." tiene ".$ultimaSemAnio." semanas";?></td>
          <td class="col-md-1">Nómina</td>
          <td class="col-md-2">Fecha Inicio</td>
          <td class="col-md-2">Fecha Final</td>
          <td class="col-md-2">Fecha de Pago</td>
          <td class="col-md-2">Mes</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row">
          <td class="col-md-3">Ultima Nómina Generada</td>
          <td class="col-md-1"><input id="num_nomgen" class="efecto h22" type="text" readonly value="<?php echo $ULTNOM; ?>"></td>
          <td class="col-md-2"><input id="fi_nomgen" class="efecto h22" type="date" readonly value="<?php echo $FIUNG; ?>"></td>
          <td class="col-md-2"><input id="ff_nomgen" class="efecto h22" type="date" readonly value="<?php echo $FFUNG; ?>"></td>
          <td class="col-md-2"></td>
          <td class="col-md-2"></td>
        </tr>
        <tr class="row">
          <td class="col-md-3">Nómina Siguiente</td>
          <td class="col-md-1"><input id="num_nomsig" class="efecto h22" type="text" readonly value="<?php echo $NOM_SIG; ?>"><input id="anio_nomsig" type="hidden" value="<?php echo $anioFI; ?>"></td>
          <td class="col-md-2"><input id="fi_nomsig" class="efecto h22" type="date" readonly value="<?php echo $FINS; ?>"></td>
          <td class="col-md-2"><input id="ff_nomsig" class="efecto h22" type="date" readonly value="<?php echo $FFNS; ?>"></td>
          <td class="col-md-2"><input id="fp_nomsig" class="efecto h22" type="date" value="<?php echo $FFNS; ?>"></td>
          <td class="col-md-2">
            <select class="custom-select-s" id="mesCorresponde">
              <option value="" selected>Corresponde</option>
              <option value="1">Enero</option>
              <option value="2">Febrero</option>
              <option value="3">Marzo</option>
              <option value="4">Abril</option>
              <option value="5">Mayo</option>
              <option value="6">Junio</option>
              <option value="7">Julio</option>
              <option value="8">Agosto</option>
              <option value="9">Septiembre</option>
              <option value="10">Octubre</option>
              <option value="11">Noviembre</option>
              <option value="12">Diciembre</option>
            </select>
          </td>
        </tr>
        <tr class="row justify-content-center">
          <td class="col-md-3 mt-4">
            <input class="efecto" type="submit" id="generarDocNominaHon" value="Generar Nomina">
            <input id="nom_regimen" type="hidden" value="<?php echo $regimenNomina; ?>">
          </td>
        </tr>
      </tbody>
    </table>
    <div id="resGenNomHon"></div>
  </div><!--/Termina Generar Nomina-->

<!--Comienza Generar CFDI-->
  <!-- <div id="contornogcfdiHon" style="display:none"> -->
  <div id="contornogcfdiHon" style="display:none">
    <table class="table text-center">
      <tr class="row mt-5">
        <td class="col-md-1 offset-md-5">
          <select class="custom-select" id="buscaranio">
            <?php echo $consultaAnioNomina; ?>
          </select>
        </td>
        <td class="col-md-1">
          <div id="resConNomSem"></div>
        </td>
      </tr>
    </table>

    <div  class="contorno mt-4 mx-0">
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

    <div class="contorno mt-4 mx-0">
      <table class="table text-center m-0 table-hover">
        <thead>
          <tr class="row encabezado align-items-center">
            <td class="col-md-1">No.</td>
            <td class="col-md-2">Empleado</td>
            <td class="col-md-1">Tipo</td>
            <td class="col-md-1">Documento
              <a href='#' onclick="nuevoDocNomina()">
                <img class='icomediano' src='/conta6/Resources/iconos/002-plus.svg'>
              </a>
            </td>
            <td class="col-md-1">
              <a href='#' onclick='borrarDocNominaTodos()'>
                <img class='icochico' src='/conta6/Resources/iconos/cross.svg'>
              </a>
            </td>
            <td class="col-md-1">Pol.Pago</td>
            <td class="col-md-1">Cancelar</td>
            <td class="col-md-1">Factura</td>
            <td class="col-md-1">Póliza</td>
            <td class="col-md-1">CFDI
              <a class='GenerarNominaCFDI' href='#' onclick='impresionCFDICompleto()'>
                <img class='icochico' src='/conta6/Resources/iconos/printer.svg'>
              </a>
              <a href='#catalogoComplementoNomina' data-toggle='modal'>
                <img class='icochico' src='/conta6/Resources/iconos/help.svg'>
              </a>
            </td>
            <!-- <td class="col-md-1"></td> -->
          </tr>
        </thead>
        <tbody class="font14" id="resConNomDcocumentos"></tbody>
      </table>
    </div>
  </div><!--/Comienza Generar CDFI-->

<!--Comienza Consultar Parametros-->
  <div id="contornoparamHon" style="display:none">
    <div class="contorno mx-0">
      <div class="acordeon2">
        <div class="encabezado text-center font16">
          <a href="#">ARTICULO 113</a>
        </div>
          <form class="form1">
            <table class="table table-hover text-center">
              <thead>
                <tr class="row backpink m-0">
                  <td class="p-1 col-md-1">Editar</td>
                  <td class="p-1 col-md-2">Inferior</td>
                  <td class="p-1 col-md-2">Superior</td>
                  <td class="p-1 col-md-2">Cuota</td>
                  <td class="p-1 col-md-2">Porcentaje</td>
                  <td class="p-1 col-md-3">Ultima Modificación</td>
                </tr>
              </thead>
              <tbody id="tablaArticulo113"></tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php
include_once('modales/ParametrosHon.php');
include_once('modales/catalogoCompNomina.php');
require $root . '/conta6/Ubicaciones/footer.php';
?>
