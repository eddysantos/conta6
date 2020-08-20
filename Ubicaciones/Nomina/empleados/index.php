<?php
$root = $_SERVER['DOCUMENT_ROOT'];

require $root . '/Ubicaciones/barradenavegacion.php';


require $root . '/Ubicaciones/Nomina/actions/lst_departamentos.php';
require $root . '/Ubicaciones/Nomina/actions/lst_SAT_bancos.php';
require $root . '/Ubicaciones/Nomina/actions/lst_SAT_EntFed.php';
require $root . '/Ubicaciones/Nomina/actions/lst_SAT_formaPago.php';
require $root . '/Ubicaciones/Nomina/actions/lst_SAT_incapacidad.php';
require $root . '/Ubicaciones/Nomina/actions/lst_SAT_jornada.php';
require $root . '/Ubicaciones/Nomina/actions/lst_SAT_periodoPago.php';
require $root . '/Ubicaciones/Nomina/actions/lst_SAT_riesgoTrabajo.php';
require $root . '/Ubicaciones/Nomina/actions/lst_SAT_tipoContrato.php';
require $root . '/Ubicaciones/Nomina/actions/lst_ctasDeudores.php';

require $root . '/Ubicaciones/Nomina/empleados/modales/Empleados.php';
require $root . '/Ubicaciones/Nomina/empleados/modales/AgregarEmpleado.php';



$fecha = strftime( "%Y-%m-%d-%H-%M-%S",time());
?>

  <div class="d-flex justify-content-between m-4 align-items-center">
    <div class="d-flex">
      <select id="filtroRegimen" class="custom-select mx-3">
       <option value="02" selected>Sueldos y Salarios</option>
       <option value="09">Honorarios Asimilados</option>
      </select>

      <input class="efecto real-time-search" type="text" name="search" placeholder="Buscar..." id='empleados_rt_search' table-body="#registrosEmpleados"  action="mostrar" data-fk_id_aduana="<?php echo $aduana ?>" data-regimen="2">
    </div>
    <div>
      <a href="#agregar" data-toggle="modal" type="button" class="btn bg_gris_100 whitesmoke">[+] Nuevo Usuario</a>
    </div>
  </div>

  <div class="container-fluid">
    <table class="table table-striped">
      <tbody id="registrosEmpleados" class='font15'></tbody>
    </table>
  </div>



<script src="js/empleados.js"></script>
<?php require $root . '/Ubicaciones/footer.php';?>
