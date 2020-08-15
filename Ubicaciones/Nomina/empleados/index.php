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


$fecha = strftime( "%Y-%m-%d-%H-%M-%S",time());
?>

<!-- <link rel="stylesheet" href="/Resources/css/inputs.css"> -->
<!-- <title>Spectrum Worldwide</title> -->
<body class="d-flex flex-column h-100">
  <div class="row d-flex justify-content-end my-4 mx-3">
    <div class="col-md-2">
      <select id="filtroRegimen" class="custom-select">
       <option value="02" selected>Sueldos y Salarios</option>
       <option value="09">Honorarios Asimilados</option>
      </select>
    </div>
    <div class="col-md-3">
      <input class="efecto real-time-search" type="text" name="search" placeholder="Buscar..." id='empleados_rt_search' table-body="#registrosEmpleados"  action="mostrar" data-fk_id_aduana="<?php echo $aduana ?>" data-regimen="2">
    </div>
  </div>

  <div class="container-fluid px-1 py-1 flex-grow-1 overflow-auto">
    <table class="table table-striped">
      <thead id="registrosEncabezado"></thead>
      <tbody id="registrosEmpleados" class='font15'></tbody>
    </table>
  </div>
</body>



<script src="js/empleados.js"></script>
<!-- <script src="/Resources/js/table_filter.js" charset="utf-8"></script> -->
<?php
  include_once('modales/Empleados.php');
  include_once('modales/AgregarEmpleado.php');
  require $root . '/Ubicaciones/footer.php';
 ?>
