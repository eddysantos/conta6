<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="text-center">
  <div class="row submenuMed m-0 font16">
    <div class="col-md-6">
      <a href="/Conta6/Ubicaciones/Nomina/SueldosySalarios/consultar_Nomina.php" >CONSULTAR NOMINA</a>
    </div>
    <div class="col-md-6">
      <a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/Parametros.php" >PARAMETROS</a>
    </div>
  </div>

  <div class="contorno mt-5" id="contgenerarnom">
    <h5 class="titulo font14">Nómina Ordinaria</h5>


    <div class="row font14" id="switchs"><!--Comienzan Switchs-->
      <div class="col-md-4">
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">VALES DE DESPENSA
          </label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">PREMIO DE PUNTUALIDAD
          </label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">PREMIO DE ASISTENCIA
          </label>
        </div>
      </div>
    </div> <!--Switchs-->


    <div class="row sub2 mb-3 mt-5" style="font-size:16px!important">
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
    </div>

    <div class="row font16" id="vprev"><!--RUTA VISTA PREVIA-->
      <div class="col-md-4 offset-md-4 mt-5" role="button">
        <!-- <a href="#" class="sueldosysalarios boton icochico border-0" accion="vnomina" status="cerrado"> <img src= "/conta6/Resources/iconos/magnifier.svg"> VISTA PREVIA</a> -->

        <a href="/Conta6/Ubicaciones/Nomina/SueldosySalarios/vistaPrevia_Nomina.php" class="boton icochico border-0"> <img src= "/conta6/Resources/iconos/magnifier.svg"> VISTA PREVIA</a>

      </div>
    </div> <!--VISTA PREVIA-->
  </div>


  <div class="contorno mt-5" style="margin-bottom:100px!important">
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
