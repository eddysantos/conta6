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
    <h5 class="titulo font14">Nómina Ordinaria</h5>

    <table class="table form1 text-center" id="generarnominaHon">
      <thead>
        <tr class="row font14 encabezado">
          <td class="col-md-4"><?php echo $anioFI." tiene ".$ultimaSemAnio." semanas";?></td>
          <td class="col-md-1">Nómina</td>
          <td class="col-md-2">Fecha Inicio</td>
          <td class="col-md-2">Fecha Final</td>
          <td class="col-md-2">Fecha de Pago</td>
          <td class="col-md-1">Mes</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row">
          <td class="col-md-4">Ultima Nómina Generada</td>
          <td class="col-md-1"><input id="num_nomgen" class="efecto" type="text" readonly value="<?php echo $ULTNOM; ?>"></td>
          <td class="col-md-2"><input id="fi_nomgen" class="efecto" type="date" readonly value="<?php echo $FIUNG; ?>"></td>
          <td class="col-md-2"><input id="ff_nomgen" class="efecto" type="date" readonly value="<?php echo $FFUNG; ?>"></td>
          <td class="col-md-2"></td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row">
          <td class="col-md-4">Nómina Siguiente</td>
          <td class="col-md-1"><input id="num_nomsig" class="efecto" type="text" readonly value="<?php echo $NOM_SIG; ?>"><input id="anio_nomsig" type="hidden" value="<?php echo $anioFI; ?>"></td>
          <td class="col-md-2"><input id="fi_nomsig" class="efecto" type="date" readonly value="<?php echo $FINS; ?>"></td>
          <td class="col-md-2"><input id="ff_nomsig" class="efecto" type="date" readonly value="<?php echo $FFNS; ?>"></td>
          <td class="col-md-2"><input id="fp_nomsig" class="efecto" type="date" value="<?php echo $FFNS; ?>"></td>
          <td class="col-md-1">
            <select class="custom-select" id="mesCorresponde">
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
        <tr class="row">
          <td class="col-md-4"></td>
          <td class="col-md-1"></td>
          <td class="col-md-2">VALES DE DESPENSA</td>
          <td class="col-md-2">PREMIO DE ASISTENCIA</td>
          <td class="col-md-2"></td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row">
          <td class="col-md-4"></td>
          <td class="col-md-1"></td>
          <td class="col-md-2">
            <select class="custom-select" id="pagarVales">
              <option value="N" selected>No</option>
              <option value="S">Si</option>
            </select>
          </td>
          <td class="col-md-2">
            <select class="custom-select" id="pagarAsistencia">
              <option value="N" selected>No</option>
              <option value="S">Si</option>
            </select>
          </td>
          <td class="col-md-2"></td>
          <td class="col-md-1"></td>
        </tr>
      </tbody>
    </table>


    <!--Comienzan Switchs-->
    <!--div class="row font14" id="switchs">
      <div class="col-md-4">
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">VALES DE DESPENSA
          </label>
        </div>
      </div-->
      <!--div class="col-md-4">
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">PREMIO DE PUNTUALIDAD
          </label>
        </div>
      </div-->
      <!--div class="col-md-4">
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">PREMIO DE ASISTENCIA
          </label>
        </div>
      </div>
    </div-->
    <!--Switchs-->

    <!-- EN LA BD NO SE USA DESDE EL 2014, NO LO VOY A APLICAR -->
    <!--div class="row sub2 mb-3 mt-5" style="font-size:16px!important">
      <div class="col-md-12">Descontar Faltas del Periodo</div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-2">
        <select class="custom-select-s" name="">
          <option value="1">1</option>
          <option value="50">50</option>
        </select>
      </div>
      <div class="col-md-2">
        <select class="custom-select-s" name="">
          <option value="1">1</option>
          <option value="50">50</option>
        </select>
      </div>
    </div-->


    <div class="row font16" id="vprev"><!--RUTA VISTA PREVIA-->
      <div class="col-md-4 offset-md-4 mt-5" role="button">
        <tr class="row">
          <td class="col-md-2 offset-md-5 mt-4">
            <input class="efecto" type="submit" id="generarDocNominaSuel" value="GENERAR NOMINA"><!--Guardar Datos de poliza/cuando se actualizo algun dato-->
            <input id="nom_regimen" type="hidden" value="<?php echo $regimenNomina; ?>">
          </td>
        </tr>
        <!--a href="/Conta6/Ubicaciones/Nomina/SueldosySalarios/GenerarNominaCFDI.php" class="boton icochico border-0">
          <img src="/conta6/Resources/iconos/002-plus.svg"> GENERAR NOMINA
        </a-->
      </div>
      <!--div class="col-md-4 offset-md-4 mt-5" role="button">
        <a href="/Conta6/Ubicaciones/Nomina/SueldosySalarios/vistaPrevia_Nomina.php" class="boton icochico border-0"> <img src= "/conta6/Resources/iconos/magnifier.svg"> VISTA PREVIA</a>
      </div-->
    </div> <!--VISTA PREVIA-->
    <div id="resGenNomSuel"></div>
  </div>


  <div class="contorno mt-5" style="<?php echo $marginbottom ?>">
    <h5 class="titulo">Nómina Extraordinaria</h5>
    <div class="row sub2  mb-3 mt-5 justify-content-center" style="font-size:16px!important">
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

    <div class="row font16"><!--RUTA VISTA PREVIA-->
      <div class="col-md-4 offset-md-4 mt-5" role="button">
        <a href="#" class="boton icochico border-0"> <img src= "/conta6/Resources/iconos/001-add.svg"> GENERAR AGUINALDO</a>
      </div>
    </div> <!--VISTA PREVIA-->
  </div>






<script src="js/SueldosySalarios.js"></script>
<script src="/conta6/Resources/bootstrap/js/bootstrap-toggle.js"></script>

<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
