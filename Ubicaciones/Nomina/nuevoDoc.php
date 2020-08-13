<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
  $regimenNomina = trim($_GET['regimen']);
  $anio = trim($_GET['anio']);
  $semana = trim($_GET['semana']);

  require $root . '/Resources/PHP/actions/lst_empleados_activos.php';

  if($regimenNomina == '02'){
    $txt_regimenNomina = "<option value='Sueldos'>Sueldos y salarios</option>";
  }
  if($regimenNomina == '09'){
    $txt_regimenNomina = "<option value='Honorarios'>Honorarios asimilados</option>";
  }
?>
<form class="form1" id="nuevoDocumento">
  <input type="hidden" id="semana" value="<?php echo $semana;?>">
  <input type="hidden" id="anio" value="<?php echo $anio;?>">
  <input type="hidden" id="nom_regimen" value="<?php echo $regimenNomina; ?>">

  <table class="table mb-0">
    <tbody class="font14">
      <tr class="row m-0 mt-5">
        <td class="col-md-4 input-effect">Tipo Nómina</td>
        <td class="col-md-4 input-effect">
          <select class="custom-select" id="opcionestipo">
            <option >Selecciona</option>
            <option value="O">Ordinaria</option>
            <option value="E">Extraordinaria</option>
          </select>
        </td>
      </tr>
      <tr class="row m-0 mt-5">
        <td class="col-md-4 input-effect">Nómina</td>
        <td class="col-md-4 input-effect">
          <select class="custom-select" id="opcionesdescNom">
            <option >Selecciona</option>
            <?php echo $txt_regimenNomina; ?>
            <option value="Finiquito">Finiquito</option>
          </select>
        </td>
      </tr>
      <tr class="row m-0 mt-5">
        <td class="col-md-4 input-effect">Empleado</td>
        <td class="col-md-4 input-effect">
          <input list="empleado-nombre" class="efecto" id="empleado">
          <datalist id="empleado-nombre">
            <?php echo $empleados; ?>
          </datalist>
          <label for="empleado">Empleado</label>
        </td>
      </tr>
      <tr class="row justify-content-center mt-5">
        <td class="col-md-2">
          <a href="#" id="generarNuevoDocumento" class="boton"><img src= "/Resources/iconos/add.svg" class="icochico"> GENERAR</a>
        </td>
      </tr>
    </tbody>
  </table>
</form>
<?php
require $root . '/Ubicaciones/footer.php';
?>
