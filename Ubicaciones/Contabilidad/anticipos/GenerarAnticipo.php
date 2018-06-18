<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

  <div class="row submenuMed m-0">
    <ul class="nav nav-pills nav-fill w-100" id="selecTipoPoliza">
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed">GENERAR ANTICIPO</a>
      </li>
    </ul>
  </div>

<input type="hidden" id="txt_usuario" value="<?php echo $usuario;?>">
<input type="hidden" id="txt_aduana" value="<?php echo $aduana;?>">

<div id="anticipos" class="contorno text-center">
  <table class="table form1 font14">
    <tbody>
      <tr class="row m-0 mt-5">
        <td class="col-md-3 input-effect">
          <input class="efecto tiene-contenido" type="date" id="antfecha">
          <label for="antfecha">Fecha Anticipo</label>
        </td>
        <td class="col-md-3 input-effect">
          <input id="antimporte" class="efecto" type="text" onchange="validaSoloNumeros(this);">
          <label for="antimporte">Importe</label>
        </td>
        <tr class="row m-0 mt-4">
          <td class="col-md-8 input-effect">
            <input class="efecto popup-input" id="antcliente" type="text" id-display="#popup-display-antcliente" action="clientes" db-id="" autocomplete="new-password" onblur="Actualiza_Expedido_Cliente()">
            <div class="popup-list" id="popup-display-antcliente" style="display:none"></div>
            <label for="antcliente">Cliente</label>
          </td>
          <td class="col-md-4 input-effect">
            <select size='1' name='antbcocliente' id='antbcocliente'>
              <option selected value='0'>Seleccione Banco</option>
            </select>
          </td>
        </tr>
        <td class="col-md-6 input-effect">
          <select size='1' name='antcuenta' id='antcuenta'>
              <option selected value='0'>Seleccione una Cuenta</option>
            </select>
        </td>
      </tr>
      <tr class="row  m-0 mt-4">
        <td class="col-9 input-effect">
          <input id="antconcepto" class="efecto" type="text">
          <label for="antconcepto">Concepto</label>
        </td>
        <td class="col-md-3">
          <a href="#" id="genFolioAnticipo" class="boton"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> GENERAR ANTICIPO</a><!--nueva pagina, ingresar datos en poliza-->
        </td>
      </tr>
    </tbody>
  </table>
</div><!--/Termina Generar Poliza de Ingreso-->
</div><!--/Termina Container FLuid-->

<!--***************ESTILOS*****************-->
<link rel="stylesheet" href="/conta6/Resources/css/sweetalert.css">
<link rel="stylesheet" href="/conta6/Resources/bootstrap/alertifyjs/css/alertify.min.css">
<link rel="stylesheet" href="/conta6/Resources/bootstrap/alertifyjs/css/themes/default.css">

<!--***************SCRIPTS*****************-->
<script src="/conta6/Ubicaciones/Contabilidad/anticipos/js/Anticipos.js"></script>
<script src="/conta6/Ubicaciones/Contabilidad/js/validarFechaCierre.js"></script>
<script src="/conta6/Resources/js/validaSoloNumeros.js"></script>

<script src="/conta6/Resources/js/popup-list-plugin.js"></script>
<script src="/conta6/Resources/js/table-fetch-plugin.js"></script>
