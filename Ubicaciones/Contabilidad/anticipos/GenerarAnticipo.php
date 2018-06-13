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


<div id="anticipos" class="contorno text-center">
  <table class="table form1 font14">
    <!-- <thead>
      <tr class="row m-0 encabezado font18">
        <td class="col-md-12">GENERAR ANTICIPO</td>
      </tr>
    </thead> -->
    <tbody>
      <tr class="row m-0 mt-5">
        <td class="col-md-3 input-effect">
          <input class="efecto tiene-contenido" type="date" id="antfecha">
          <label for="antfecha">Fecha Anticipo</label>
        </td>
        <td class="col-md-3 input-effect">
          <input id="antimporte" class="efecto" type="text">
          <label for="antimporte">Importe</label>
        </td>
        <td class="col-md-6 input-effect">
          <input  list="antcta" class="efecto"  id="antcuenta">
          <datalist id="antcta">
            <option value="0100-00006 ---- BANAMEX CTA.7658424 NLDO"></option>
            <option value="0100-00011 ---- BANAMEX DLLS CTA.79033561 NLDO"></option>
            <option value="0100-00012 ---- BANAMEX DLLS CTA.79033561 COMPLEMENTARIA NLDO"></option>
            <option value="0100-00016 ---- BANCOMER CTA.0192655497 NLDO"></option>
            <option value="0100-00017 ---- BANAMEX CTA.7355485 NLDO"></option>
          </datalist>
          <label for="antcuenta">Seleccione una Cuenta</label>
        </td>
      </tr>
      <tr class="row m-0 mt-4">
        <td class="col-md-8 input-effect">
          <input  list="listaclientes" class="efecto" id="antcliente">
          <datalist id="listaclientes">
            <option value="SERVICIOS INTEGRALES EN LOGISTICA INTERNACIONAL, ADUANAS Y TECNOLOGIA, S.C --- CLT_7158"></option>
            <option value="TURBO-MEX REFACCIONES,MANTENIMIENTO Y SEGURIDAD INDUSTRIAL S.A DE C.V --- CLT_7114"></option>
          </datalist>
          <label for="antcliente">Cliente</label>
        </td>
        <td class="col-md-4 input-effect">
          <input  list="listacuentacliente" class="efecto" id="antbcocliente">
          <datalist id="listacuentacliente">
            <option value="HSBC --- 3336"></option>
            <option value="BANAMEX --- 0192"></option>
            <option value="BANAMEX --- 9569"></option>
          </datalist>
          <label for="antbcocliente">Banco Cliente</label>
        </td>
      </tr>
      <tr class="row  m-0 mt-4">
        <td class="col-9 input-effect">
          <input id="antconcepto" class="efecto" type="text">
          <label for="antconcepto">Concepto</label>
        </td>
        <td class="col-md-3">
          <a href="/conta6/Ubicaciones/Contabilidad/anticipos/Detalleanticipo.php" class="boton"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> GENERAR ANTICIPO</a><!--nueva pagina, ingresar datos en poliza-->
          <div id="respuesta"></div>
        </td>
      </tr>
    </tbody>
  </table>
</div><!--/Termina Generar Poliza de Ingreso-->
</div><!--/Termina Container FLuid-->
