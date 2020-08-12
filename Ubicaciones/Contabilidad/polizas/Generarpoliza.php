<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<input type="hidden" id="diaaduana" value="<?php echo $aduana;?>">
<input type="hidden" id="diausuario" value="<?php echo $usuario;?>">

<div class="text-center">
  <div class="row backpink m-0">
    <ul class="nav nav-fill w-100" id="selecTipoPoliza">
      <li class="nav-item">
        <a class="nav-link pol" status='cerrado' accion="poldiario">POLIZA DE DIARIO</a>
      </li>
      <li class="nav-item">
        <a class="nav-link pol" status='cerrado' accion="polingreso">POLIZA DE INGRESO</a>
      </li>
    </ul>
  </div>


  <div id="gpoliza" class="contorno" style="display:none">
    <table class="table font14">
      <thead>
        <tr class="row encabezado font18">
          <td class="col-md-12 p-1">GENERAR POLIZA</td>
        </tr>
      </thead>
      <tbody >
        <tr class="row mt-5">
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido pl-5" type="date" id="diafecha">
            <label for="diafecha">Fecha Póliza</label>
          </td>
          <td class="col-md-6 input-effect">
            <input id="diaconcepto" class="efecto" type="text" maxlength="300" onchange="eliminaBlancosIntermedios(this)">
            <label for="diaconcepto">Concepto</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="diatipo" class="efecto tiene-contenido" readonly>
            <label for="diatipo">Tipo</label>
          </td>
        </tr>
        <tr class="row justify-content-center mt-5">
          <td class="col-md-3">
            <a href="#" id="genFolioPolDia" class="boton p-1"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> GENERAR POLIZA</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
