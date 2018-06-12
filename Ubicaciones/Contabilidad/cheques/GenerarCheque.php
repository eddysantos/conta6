<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

  <div class="row submenuMed m-0">
    <ul class="nav nav-pills nav-fill w-100" id="selecTipoPoliza">
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed">GENERAR CHEQUE</a>
      </li>
    </ul>
  </div>


<!--COMIENZA CHEQUES  -->
  <div id="cheques" class="contorno text-center">
    <table class="table form1 font14">
      <tbody>
        <tr class="row m-0 mt-5">
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido" type="date" id="chfecha">
            <label for="chfecha">Fecha Cheque</label>
          </td>
          <td class="col-md-9 input-effect">
            <input  list="oficina" class="efecto"  id="chncuenta">
            <datalist id="oficina">
              <option value="0100-00006 ---- BANAMEX CTA.7658424 NLDO"></option>
              <option value="0100-00011 ---- BANAMEX DLLS CTA.79033561 NLDO"></option>
              <option value="0100-00012 ---- BANAMEX DLLS CTA.79033561 COMPLEMENTARIA NLDO"></option>
              <option value="0100-00016 ---- BANCOMER CTA.0192655497 NLDO"></option>
              <option value="0100-00017 ---- BANAMEX CTA.7355485 NLDO"></option>
            </datalist>
            <label for="chncuenta">Seleccione una Cuenta</label>
          </td>
        </tr>
        <tr class="row m-0 mt-5">
          <td class="col-md-3 input-effect">
            <input id="chnumero" class="efecto" type="text">
            <label for="chnumero">No.Cheque</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="chimporte" class="efecto" type="text">
            <label for="chimporte">Importe</label>
          </td>
          <td class="col-md-6 input-effect">
            <input  list="beneficiarios" class="efecto" id="chbeneficiarios">
            <datalist id="beneficiarios">
              <option value="BENEFICIARIO NUMERO 1"></option>
              <option value="BENEFICIARIO NUMERO 2"></option>
              <option value="BENEFICIARIO NUMERO 3"></option>
              <option value="BENEFICIARIO NUMERO 4"></option>
              <option value="BENEFICIARIO NUMERO 5"></option>
            </datalist>
            <label for="chbeneficiarios">Beneficiario</label>
          </td>
        </tr>
        <tr class="row m-0 mt-5">
          <td class="col-9 input-effect">
            <input id="chconcepto" class="efecto" type="text">
            <label for="chconcepto">Concepto</label>
          </td>
          <td class="col-md-3">
            <a href="/conta6/Ubicaciones/Contabilidad/cheques/Detallecheque.php" class="boton"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> GENERAR CHEQUE</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->
