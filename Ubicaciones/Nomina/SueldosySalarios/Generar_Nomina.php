<style media="screen">
  .activogenom{
    color: black!important;
    font-weight: bold;
  }
</style>

<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
  require $root . '/conta6/Resources/PHP/actions/validarFormulario.php';

  $regimenNomina = '02';
  require $root . '/conta6/Ubicaciones/Nomina/SueldosySalarios/actions/ultimaNominaSueldos.php';
  require $root . '/conta6/Resources/PHP/actions/consulta_nomina_anio.php';

  require $root . '/conta6/Ubicaciones/Nomina/SueldosySalarios/submenu_sueldos.php';

?>
  <div class="contorno mt-5" id="contgenerarnom">
    <div class="titulo font16" style="margin-top: -26px;">Nómina Ordinaria</div>
    <table class="table text-center font14" id="generarnominaHon">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-3"><?php echo $anioFI." tiene ".$ultimaSemAnio." semanas";?></td>
          <td class="col-md-1">Nómina</td>
          <td class="col-md-2">Fecha Inicio</td>
          <td class="col-md-2">Fecha Final</td>
          <td class="col-md-2">Fecha de Pago</td>
          <td class="col-md-2">Mes</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row align-items-center">
          <td class="col-md-3">Ultima Nómina Generada</td>
          <td class="col-md-1"><input id="num_nomgen" class="efecto h22" type="text" readonly value="<?php echo $ULTNOM; ?>"></td>
          <td class="col-md-2"><input id="fi_nomgen" class="efecto h22" type="date" readonly value="<?php echo $FIUNG; ?>"></td>
          <td class="col-md-2"><input id="ff_nomgen" class="efecto h22" type="date" readonly value="<?php echo $FFUNG; ?>"></td>
          <td class="col-md-2"></td>
          <td class="col-md-2"></td>
        </tr>
        <tr class="row align-items-center">
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
        <tr class="row justify-content-center mt-5">
          <td class="col-md-2">VALES DE DESPENSA</td>
          <td class="col-md-2">PREMIO DE ASISTENCIA</td>
        </tr>
        <tr class="row justify-content-center">
          <td class="col-md-2">
            <select class="custom-select-s" id="pagarVales">
              <option value="N" selected>No</option>
              <option value="S">Si</option>
            </select>
          </td>
          <td class="col-md-2">
            <select class="custom-select-s" id="pagarAsistencia">
              <option value="N" selected>No</option>
              <option value="S">Si</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>


    <div class="row font16 justify-content-center" id="vprev"><!--RUTA VISTA PREVIA-->
      <div class="col-md-3 mt-4 text-center" role="button">
        <a href="#" class="boton icochico" id="generarDocNominaSuel"> <img src= "/conta6/Resources/iconos/001-add.svg"> GENERAR NOMINA</a>
        <input id="nom_regimen" type="hidden" value="<?php echo $regimenNomina; ?>">
      </div>
    </div> <!--VISTA PREVIA-->
    <div id="resGenNomSuel"></div>
  </div>


  <div class="contorno mt-5 text-center" style="<?php echo $marginbottom ?>">
    <div class="titulo" style='margin-top: -26px;width:200px'>Nómina Extraordinaria</div>
    <div class="row sub2 font16 my-3 justify-content-center">
      <div class="col-md-2 ">Nomina</div>
      <div class="col-md-2 ">Fecha Inicio</div>
      <div class="col-md-2 ">Fecha Final</div>
      <div class="col-md-2 ">Fecha Pago</div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-2">
        <select class="custom-select-s" name="">
          <option value="1">1</option>
          <option value="50">50</option>
        </select>
      </div>
      <div class="col-md-2">
        <input class="efecto h22" type="date" value="">
      </div>
      <div class="col-md-2">
        <input class="efecto h22" type="date" value="">
      </div>
      <div class="col-md-2">
        <input class="efecto h22" type="date" value="">
      </div>
    </div>

    <div class="row font16 justify-content-center"><!--RUTA VISTA PREVIA-->
      <div class="col-md-3 mt-4 p-1" role="button">
        <a href="#" class="boton icochico"> <img src= "/conta6/Resources/iconos/001-add.svg"> GENERAR AGUINALDO</a>
      </div>
    </div> <!--VISTA PREVIA-->
  </div>






<script src="js/SueldosySalarios.js"></script>
<!-- <script src="/conta6/Resources/bootstrap/js/bootstrap-toggle.js"></script> -->

<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
