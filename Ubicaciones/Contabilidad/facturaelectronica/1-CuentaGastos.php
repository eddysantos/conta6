<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">

<!---AL INGRESAR SOLO SE MOSTRARA ESTA SECCION-->
  <div class="row submenuMed m-0" id="SeleccionarAccion">
    <div class="col-md-6">
      <a  id="submenuMed" class="fele" accion="buscarctagastos"><i class="fa fa-search"></i>BUSCAR</a>
    </div>
    <div class="col-md-6">
      <a id="submenuMed" class="fele" accion="generarctagastos"><i class="fa fa-plus"></i>GENERAR</a>
    </div>
  </div>

  <div class="mt10 contorno2" id="g-ctagastos" style="display:none">
    <div class="col-md-1 offset-sm-11 font14">
      <a href="#" class="fele" accion="cuadroGenerar">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <table class="table form1">
      <thead>
        <tr class="row encabezado font18">
          <td class="col-md-12">GENERAR CUENTA DE GASTOS</td>
        </tr>
      </thead>
      <tbody class="font18">
        <tr class="row mt-5">
          <td class="col-md-4 offset-md-3 input-effect">
            <input class="efecto"  id="ctagatos-cReferencia">
            <label for="ctagatos-cReferencia">CON REFERENCIA</label>
          </td>
          <td class="col-md-2">
            <a href="" class="boton"> <i class="fa fa-search "></i> Consultar</a>
          </td>
        </tr>
        <tr class="row mt-4">
          <td class="col-md-7 input-effect">
            <input  list="ctagtos-cli" class="efecto" id="ctagatos-sReferencia">
            <datalist id="ctagtos-cli">
              <option value="Tecnologias Relacionadas con Energia y Servicios Especializado S.A de C.V --- CLT_7517"></option>
              <option value="Servicios Integrales en Logistica Internacional, Aduanas y Tecnologias, S.C (NO USAR) -- CLT_7158"></option>
              <option value="Cliente Numero 1 Cliente Numero 1"></option>
              <option value="Cliente Numero 1 Cliente Numero 1"></option>
            </datalist>
            <label for="ctagatos-sReferencia">SELECCIONAR CLIENTE (Sin Referencia)</label>
          </td>
          <td class="col-md-2">
            <a href="" class="boton">Siguiente <i class="fa fa-angle-double-right fa-lg"></i></a>
          </td>
          <td class="col-md-3">
            <a href="" class="boton">Generar Tasa Cero <i class="fa fa-angle-double-right fa-lg"></i></a>
          </td>
        </tr>
        <tr class="row backpink mt-3">
          <td class="col-md-3">Expedir Cuenta de Gastos a: </td>
          <td class="col-md-9">Tecnologias Relacionadas con Energia y Servicios Especializado S.A de C.V --- CLT_7517</td>
        </tr>
      </tbody>
    </table>
  </div>


<!---se muestra al dar click en Buscar-->
  <div class="mt10" id="b-ctagastos" style="display:none">
    <div class="row">
      <div class="col-md-3 offset-sm-7 font14">
        <a href="#" class="fele" accion="cuadroBusqueda">
          <i class="back fa fa-arrow-left">Regresar</i>
        </a>
      </div>
    </div>
    <div class="row text-center"  id="referencia">
      <div class="offset-md-3 col-md-6 titulobuscar" style="font-size:30px!important">Referencia o Solicitud</div>
    </div>
    <div class="row transEff" id="nReferencia">
      <div class="offset-md-3 col-md-6 inputbuscar" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="bRef" type="text" autocomplete="off">
        </form>
      </div>
    </div>
  </div>


<!---se muestra al escribir la referencia y dar enter-->
  <div class="mt10 contorno2" id="m-ctagastos" style="display:none">
    <div class="col-md-1 offset-sm-11 font14">
      <a href="#" class="fele" accion="cuadroConsultar">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <table class="table font16">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-12">Solicitud de Anticipo</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row backpink font16">
          <td class="col-md-2">Solicitud</td>
          <td class="col-md-2">Referencia</td>
          <td class="col-md-7">Cliente</td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-2">280380</td>
          <td class="col-md-2">N17003012</td>
          <td class="col-md-7">CLT_6548 MOTORES ELECTRICOS SUMERGIBLES DE MEXICO, S. DE R.L DE C.V</td>
          <td class="col-md-1">
            <a href="1-CuentaGtos_Consultar.php"><img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg"></a>
            <a><img class="icomediano ml-5" src="/conta6/Resources/iconos/printer.svg"></a>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="js/facturaElectronica.js"></script>
<script src="/conta6/Resources/js/Inputs.js"></script>
