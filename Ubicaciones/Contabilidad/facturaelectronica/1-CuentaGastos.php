<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="continer-fluid">

<!---AL INGRESAR SOLO SE MOSTRARA ESTA SECCION-->
  <div class="row submenu m-0" id="SeleccionarAccion">
    <div class="col-md-6 text-center">
      <a id="submenu" class="mostrar" accion="generarctagastos"><i class="fa fa-plus"></i>GENERAR</a>
    </div>
    <div class="col-md-6 text-center">
      <a  id="submenu" class="mostrar" accion="buscarctagastos"><i class="fa fa-search"></i>BUSCAR</a>
    </div>
  </div>

  <div class="contenedor container-fluid cont" style="display:none" id="g-ctagastos">
    <div class="col-md-12 offset-sm-11 p0">
      <a class="atras" accion="cuadroGenerar">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <form class="form1">
      <table class="table text-center">
        <thead>
          <tr class="row encabezado cuerpo">
            <td class="col-md-12">GENERAR CUENTA DE GASTOS</td>
          </tr>
        </thead>
        <tbody>
          <tr class="row brx1">
            <td class="col-md-4 offset-md-3 input-effect mt-3">
              <input class="efecto text-center text-normal"  id="ctagatos-cReferencia">
              <label for="ctagatos-cReferencia">CON REFERENCIA</label>
            </td>
            <td class="col-md-2 mt-3" role="button">
              <a href="" class="boton" style="font-size:17px"> <i class="fa fa-search "></i> Consultar</a>
            </td>
          </tr>
          <tr class="row brx1">
            <td class="col-md-7 input-effect mt-3">
              <input  list="ctagtos-cli" class="efecto text-center text-normal"  id="ctagatos-sReferencia">
              <datalist id="ctagtos-cli">
                <option value="Tecnologias Relacionadas con Energia y Servicios Especializado S.A de C.V --- CLT_7517"></option>
                <option value="Servicios Integrales en Logistica Internacional, Aduanas y Tecnologias, S.C (NO USAR) -- CLT_7158"></option>
                <option value="Cliente Numero 1 Cliente Numero 1"></option>
                <option value="Cliente Numero 1 Cliente Numero 1"></option>
              </datalist>
              <label for="ctagatos-sReferencia">SELECCIONAR CLIENTE (Sin Referencia)</label>
            </td>
            <td class="col-md-2 mt-3">
              <a href="" class="boton" style="font-size:17px">Siguiente <i class="fa fa-angle-double-right fa-lg"></i></a>
            </td>
            <td class="col-md-3 mt-3">
              <a href="" class="boton" style="font-size:17px">Generar Tasa Cero <i class="fa fa-angle-double-right fa-lg"></i></a>
            </td>
          </tr>
          <tr class="row backpink mt-1">
            <td class="col-md-3">Expedir Cuenta de Gastos a: </td>
            <td class="col-md-9">Tecnologias Relacionadas con Energia y Servicios Especializado S.A de C.V --- CLT_7517</td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>


<!---se muestra al dar click en Buscar-->
  <div class="contenedor" id="b-ctagastos" style="display:none">
    <div class="row">
      <div class="col-md-12 offset-sm-8">
        <a href="#" class="atras" accion="cuadroBusqueda">
          <i class="back fa fa-arrow-left">Regresar</i>
        </a>
      </div>
    </div>
    <div class="row titulograndetop transEff mt-3" id="referencia">
      <div class="col-md-12 text-center">
        <label class="transEff" for="bRef" id="labelRef">Referencia o Solicitud</label>
      </div>
    </div>
    <div class="row intermedio transEff" id="nReferencia">
      <div class="col-md-12" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;">
        <input class="reg form-control border-0 transEff" id="bRef" type="text">
      </form>
      </div>
    </div>
  </div>




<!---se muestra al escribir la referencia y dar enter-->
  <div class="contenedor container-fluid cont" id="m-ctagastos" style="display:none">
    <div class="col-md-12 offset-sm-11">
      <a class="atras" accion="cuadroConsultar">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <table class="table text-center cuerpo">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-12">Solicitud de Anticipo</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row backpink">
          <td class="col-md-2">Solicitud</td>
          <td class="col-md-2">Referencia</td>
          <td class="col-md-6">Cliente</td>
          <td class="col-md-1"></td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-2">280380</td>
          <td class="col-md-2">N17003012</td>
          <td class="col-md-6">CLT_6548 MOTORES ELECTRICOS SUMERGIBLES DE MEXICO, S. DE R.L DE C.V</td>
          <td class="col-md-1">
            <a href="1-CuentaGtos_Consultar.php">
              <img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg">
            </a>
          <td class="col-md-1">
            <a><img class="icomediano" src="/conta6/Resources/iconos/printer.svg"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="js/facturaElectronica.js"></script>
<script src="/conta6/Resources/js/Inputs.js"></script>
