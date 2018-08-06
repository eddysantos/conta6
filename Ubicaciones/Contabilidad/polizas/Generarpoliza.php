<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<input type="hidden" id="diaaduana" value="<?php echo $aduana;?>">
<input type="hidden" id="diausuario" value="<?php echo $usuario;?>">

<div class="text-center">
  <div class="row submenuMed m-0">
    <ul class="nav nav-pills nav-fill w-100" id="selecTipoPoliza">
      <li class="nav-item">
        <a class="nav-link pol" id="submenuMed" accion="poldiario" status="cerrado">POLIZA DE DIARIO</a>
      </li>
      <li class="nav-item">
        <a class="nav-link pol" id="submenuMed" accion="polingreso" status="cerrado">POLIZA DE INGRESO</a>
      </li>
    </ul>
  </div>

  <!--Comienza Generar Poliza de Diario e Ingreso-->
  <div id="gpoliza" class="contorno" style="display:none">
    <table class="table form1">
      <thead>
        <tr class="row m-0 encabezado font18">
          <td class="col-md-12">GENERAR POLIZA</td>
        </tr>
      </thead>
      <tbody >
        <tr class="row m-0 mt-5">
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido" type="date" id="diafecha">
            <label for="diafecha">Fecha Póliza</label>
          </td>
          <td class="col-md-6 input-effect">
            <input id="diaconcepto" class="efecto" type="text" maxlength="300" onchange="eliminaBlancosIntermedios(this)">
            <label for="diaconcepto">Concepto</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="diatipo" class="efecto tiene-contenido" type="text" db-id="" autocomplete="new-password" readonly>
            <label for="diatipo">Tipo</label>
          </td>
        </tr>
        <tr class="row justify-content-center mt-5">
          <td class="col-md-3">
            <a href="#" id="genFolioPolDia" class="boton"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> GENERAR POLIZA</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Diario e Ingreso-->


<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
