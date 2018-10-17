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

  <div class="contorno" id="g-ctagastos" style="display:none; margin-bottom:100px!important">
    <div class="col-md-1 offset-sm-11 p-0">
      <a href="#" class="bg" accion="cuadroGenerar">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <form class="form1">
      <table class="table">
        <thead>
          <tr class="row encabezado font18">
            <td class="col-md-12">GENERAR CUENTA DE GASTOS</td>
          </tr>
        </thead>
        <tbody class="font18">
          <tr class="row mt-5">
            <td class="col-md-4 offset-md-3 input-effect">
              <input class="efecto tiene-contenido popup-input" maxlength="9" id="ctagatos-cReferencia" type="text" id-display="#popup-display-ctagatos-cReferencia" action="referencias" db-id="" autocomplete="off">
              <div class="popup-list" id="popup-display-ctagatos-cReferencia" style="display:none"></div>
              <label for="ctagatos-cReferencia">CON REFERENCIA</label>
            </td>
            <td class="col-md-2">
              <a href="#" id="btn_buscarDatosEmbarque" class="boton"> <i class="fa fa-search "></i> Consultar</a>
            </td>
          </tr>
          <tr class="row mt-4">
            <td class="col-md-7 input-effect">
              <input class="efecto popup-input" id="ctagatos-sReferencia" type="text" id-display="#popup-display-ctagatos-sReferencia" action="clientes" db-id="" autocomplete="off" onchange="cargarClienteSinReferencia()">
              <div class="popup-list" id="popup-display-ctagatos-sReferencia" style="display:none"></div>
              <label for="ctagatos-sReferencia">SELECCIONAR CLIENTE (Sin Referencia)</label>
            </td>
            <td class="col-md-2">
              <a href="#" class="boton" id="Btn_Busca_Ref_Cta_Gtos_2" onclick="cargarCuentaSinReferencia('IVA')">Siguiente <i class="fa fa-angle-double-right fa-lg"></i></a>
            </td>
            <td class="col-md-3">
              <?PHP if($oRst_permisos['CFDI_cta_gastos_generarT0'] == 1){ ?>
              <a href="#" class="boton" id="Btn_Busca_Ref_Cta_Gtos_3" onclick="cargarCuentaSinReferencia('sinIVA')">Generar Tasa Cero <i class="fa fa-angle-double-right fa-lg"></i></a>
              <?PHP } ?>
            </td>
          </tr>
          <tr class="row mt-4">
            <td class='col-md-9 text-left'>
              <div id="nombreCliente_sinReferencia"></div>
            </td>
          </tr>
        </tbody>
      </table>
      <div id="datosEmbarque"></div>
    </form>
  </div>


<!---se muestra al dar click en Buscar-->
  <div class="contenedor" id="b-ctagastos" style="display:none">
    <div class="row">
      <div class="col-md-12 offset-sm-8">
        <a href="#" class="fele" accion="cuadroBusqueda">
          <i class="back fa fa-arrow-left">Regresar</i>
        </a>
      </div>
    </div>
    <div class="row titulograndetop transEff" id="referencia">
      <div class="col-md-12 ">
        <label class="transEff" for="bRef" id="labelRef">Referencia o Solicitud</label>
      </div>
    </div>
    <div class="row intermedio transEff" id="nReferencia">
      <div class="col-md-12" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;">
        <input class="reg border-0 transEff" id="bRef" type="text" autocomplete="off">
      </form>
      </div>
    </div>
  </div>




<!---se muestra al escribir la referencia y dar enter-->
  <div class="mt-5 contorno" id="m-ctagastos" style="display:none;margin-bottom: 8rem!important;">
    <div class="col-md-1 offset-sm-11">
      <a href="#" class="fele" accion="cuadroConsultar">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <table class="table font16">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-12">Cuentas de Gastos Capturadas</td>
        </tr>
        <tr class="row backpink" style="font-size:16px!important">
          <td class="col-md-1">Solicitud</td>
          <td class="col-md-1">Poliza</td>
          <td class="col-md-1">Cancelar</td>
          <td class="col-md-1">Factura</td>
          <td class="col-md-2">Referencia</td>
          <td class="col-md-5">Cliente</td>
          <td class="col-md-1"></td>
        </tr>
      </thead>
      <tbody id="lst_cuentasGastos_capturadas"></tbody>
    </table>
  </div>
</div>

<script src="js/facturaElectronica.js"></script>
<script src="/conta6/Resources/js/Inputs.js"></script>

<?php
  require $root . '/conta6/Ubicaciones/footer.php';
?>
