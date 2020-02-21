<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="row backpink m-0">
  <ul class="nav nav-pills nav-fill w-100">
    <li class="nav-item">
      <a class="nav-link" id="submenuMed">GENERAR ANTICIPO</a>
    </li>
  </ul>
</div>

<input type="hidden" id="txt_usuario" value="<?php echo $usuario;?>">
<input type="hidden" id="txt_aduana" value="<?php echo $aduana;?>">

<div id="anticipos" class="contorno text-center">
  <table class="table form1 font14">
    <tbody>
      <tr class="row m-0 mt-3">
        <td class="col-md-2 input-effect">
          <input class="efecto tiene-contenido" type="date" id="antfecha">
          <label for="antfecha">Fecha Anticipo</label>
        </td>
        <td class="col-md-2 input-effect">
          <input id="antimporte" class="efecto" type="text" onchange="validaSoloNumeros(this)">
          <label for="antimporte">Importe</label>
        </td>
        <td class="col-md-8 input-effect">
          <input class="efecto popup-input" id="antcliente" type="text" id-display="#popup-display-antcliente" action="clientes" db-id="" autocomplete="off"
            onblur="Actualiza_Expedido_Cliente()">
          <div class="popup-list" id="popup-display-antcliente" style="display:none"></div>
          <label for="antcliente">Cliente</label>
        </td>
      </tr>
      <tr class="row m-0 mt-4">
        <td class="col-md-4 input-effect">
          <select class="custom-select" size='1' name='antbcocliente' id='antbcocliente'>
            <option selected value='0'>Seleccione Banco</option>
          </select>
        </td>
        <td class="col-md-8 input-effect">
          <select class="custom-select" size='1' name='antcuenta' id='antcuenta'>
            <option selected value='0'>Seleccione una Cuenta</option>
          </select>
        </td>
      </tr>
      <tr class="row  m-0 mt-4">
        <td class="col-9 input-effect">
          <input id="antconcepto" class="efecto" type="text" onchange="eliminaBlancosIntermedios(this)">
          <label for="antconcepto">Concepto</label>
        </td>
        <td class="col-md-3">
          <a href="#" id="genFolioAnticipo" class="boton"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> GENERAR ANTICIPO</a><!--nueva pagina, ingresar datos en poliza-->
        </td>
      </tr>
    </tbody>
  </table>
</div><!--/Termina Generar Poliza de Ingreso-->

<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
