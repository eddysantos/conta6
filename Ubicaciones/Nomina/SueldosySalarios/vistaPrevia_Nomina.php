<style media="screen">
  .activopermanentes{
    color: black!important;
    font-weight: bold;
  }
</style>

<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';

  require $root . '/conta6/Ubicaciones/Nomina/SueldosySalarios/submenu_sueldos.php';

?>

<div class="contorno text-center">
  <h5 class="titulo w-25 font14">MODIFICAR DATOS PERMANENTES</h5>
  <table class="table table-hover font12"><!--tabla para modificr datos del CFDI-->
    <thead>
      <tr class="row encabezado text-center">
        <td class="col-md-3">EMPLEADO</td>
        <td class="col-md-1">FALTAS</td>
        <td class="col-md-1">RETARDO</td>
        <td class="col-md-1">VACACIONES</td>
        <td class="col-md-2">COMPENSACION</td>
        <td class="col-md-1">HORAS EXTRAS</td>
        <td class="col-md-1">DIAS</td>
        <td class="col-md-1">HORAS</td>
        <td class="col-md-1">OTROS</td>
      </tr>
    </thead>
    <tbody>
      <tr class="row borderojo">
        <td class="col-md-3">Agustin Alejandro Hernandez Uvaldo</td>
        <td class="col-md-1"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-1"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-1"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-2"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-1"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-1"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-1"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-1 text-center">
          <a href="#permanentes" data-toggle="modal">
            <img class="icomediano" src="/conta6/Resources/iconos/detalles.svg">
          </a>
        </td>
      </tr>
      <tr class="row borderojo">
        <td class="col-md-3">Jose Francisco Rodrigo Cardenas Garcia</td>
        <td class="col-md-1"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-1"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-1"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-2"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-1"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-1"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-1"><input class="efecto h22" type="text" value="0"></td>
        <td class="col-md-1 text-center">
          <a href="#permanentes" data-toggle="modal">
            <img class="icomediano" src="/conta6/Resources/iconos/detalles.svg">
          </a>
        </td>
      </tr>
    </tbody>
  </table>


  <div class="row font16 mt-5 justify-content-center"><!--RUTA GENERAR NOMINA-->
    <div class="col-md-4" role="button">
      <!--a href="/Conta6/Ubicaciones/Nomina/SueldosySalarios/GenerarNominaCFDI.php" class="boton icochico border-0">
        <img src= "/conta6/Resources/iconos/002-plus.svg"> GENERAR NOMINA
      </a-->
    </div>
  </div>
</div>


<!-- <script src="js/SueldosySalarios.js"></script> -->
<!-- <script src="/Conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/js/parametros.js"></script> -->
<!-- <script src="/conta6/Resources/bootstrap/js/bootstrap-toggle.js"></script> -->
<script src="/Conta6/Ubicaciones/Nomina/empleados/js/empleados.js"></script>

<?php
require $root .'/conta6/Ubicaciones/Nomina/empleados/modales/Empleados.php';
// require $root .'/conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/modales/Parametros.php';
require $root . '/conta6/Ubicaciones/footer.php';
 ?>
