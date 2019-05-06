<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';


  require $root . '/conta6/Ubicaciones/Nomina/actions/lst_departamentos.php';
  require $root . '/conta6/Ubicaciones/Nomina/actions/lst_SAT_bancos.php';
  require $root . '/conta6/Ubicaciones/Nomina/actions/lst_SAT_EntFed.php';
  require $root . '/conta6/Ubicaciones/Nomina/actions/lst_SAT_formaPago.php';
  require $root . '/conta6/Ubicaciones/Nomina/actions/lst_SAT_incapacidad.php';
  require $root . '/conta6/Ubicaciones/Nomina/actions/lst_SAT_jornada.php';
  require $root . '/conta6/Ubicaciones/Nomina/actions/lst_SAT_periodoPago.php';
  require $root . '/conta6/Ubicaciones/Nomina/actions/lst_SAT_riesgoTrabajo.php';
  require $root . '/conta6/Ubicaciones/Nomina/actions/lst_SAT_tipoContrato.php';
  require $root . '/conta6/Ubicaciones/Nomina/actions/lst_ctasDeudores.php';


  $fecha = strftime( "%Y-%m-%d-%H-%M-%S",time());
?>

<link rel="stylesheet" href="/conta6/Resources/css/inputs.css">

<div class="row submenuMed m-0 text-center">
  <div class="col-md-12 text-center" role="button">
    <a href="#agregar" data-toggle="modal"  id="submenuMed">AGREGAR EMPLEADO</a>
  </div>
</div>

<div id="contornoEmp" class="contorno" style="<?php echo $marginbottom ?>;">
  <h5 class="titulo w2 font16">EMPLEADOS CAPTURADOS</h5>
  <table class="table mt-4">
    <tr class="row m-0 justify-content-end">
      <td class="col-md-2">
        <select id="filtroRegimen" class="custom-select">
         <option value="2" selected>Sueldos y Salarios</option>
         <option value="9">Honorarios Asimilados</option>
        </select>
       </td>
      <td class="col-md-3">
        <input class="efecto real-time-search" type="text" name="search" placeholder="Buscar..." id='empleados_rt_search' table-body="#registrosEmpleados"  action="mostrar" data-fk_id_aduana="<?php echo $aduana ?>" data-regimen="2">
     </td>
    </tr>
  </table>
  <table class='table table-hover fixed-table'>
    <thead id="registrosEncabezado"></thead>
    <tbody id="registrosEmpleados" class='font12'></tbody>
  </table>
</div>



<!-- <script src="/conta6/Resources/js/Inputs.js"></script> -->
<script src="js/empleados.js"></script>
<?php
  include_once('modales/Empleados.php');
  include_once('modales/AgregarEmpleado.php');
  require $root . '/conta6/Ubicaciones/footer.php';
 ?>
