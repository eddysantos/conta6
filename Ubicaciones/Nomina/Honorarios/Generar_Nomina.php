<style media="screen">
  .activogenom{
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



<div class="container-fluid">


  <div id="contornognomHon" class="contorno mx-0 mt-4">
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
      </tbody>
    </table>

    <div class="row font16 justify-content-center">
      <div class="col-md-3 mt-4 text-center" role="button">
        <a href="#" class="boton icochico p-1" id="generarDocNominaHon"> <img src= "/Resources/iconos/001-add.svg"> GENERAR NOMINA</a>
      </div>
    </div>
  </div>

  <script src="/Ubicaciones/Nomina/js/nomina.js"></script>
  <script src="/Ubicaciones/Nomina/Honorarios/js/Honorarios.js" charset="utf-8"></script>

<?php
  require $root . '/Ubicaciones/footer.php';
?>
