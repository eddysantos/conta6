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
    <form class="form1" method="post">
      <table class="table text-center">
        <thead>
          <tr class="row tRepo2">
            <td class="col-md-12 text-center">GENERAR CUENTA DE GASTOS</td>
          </tr>
        </thead>
        <tbody>
          <tr class="row brx1">
            <td class="col-md-4 offset-md-3 input-effect brx2">
              <input class="efecto text-center text-normal"  id="ctagatos-cReferencia">
              <label for="ctagatos-cReferencia">CON REFERENCIA</label>
            </td>
            <td class="col-md-2 brx2" role="button">
              <a href="" class="boton btn-block" style="font-size:17px"> <i class="fa fa-search "></i> Consultar</a>
            </td>
          </tr>
          <tr class="row brx1">
            <td class="col-md-7 input-effect brx2">
              <input  list="ctagtos-cli" class="efecto text-center text-normal"  id="ctagatos-sReferencia">
              <datalist id="ctagtos-cli">
                <option value="Tecnologias Relacionadas con Energia y Servicios Especializado S.A de C.V --- CLT_7517"></option>
                <option value="Servicios Integrales en Logistica Internacional, Aduanas y Tecnologias, S.C (NO USAR) -- CLT_7158"></option>
                <option value="Cliente Numero 1 Cliente Numero 1"></option>
                <option value="Cliente Numero 1 Cliente Numero 1"></option>
              </datalist>
              <label for="ctagatos-sReferencia">SELECCIONAR CLIENTE (Sin Referencia)</label>
            </td>
            <td class="col-md-2 brx2">
              <a href="" class="boton btn-block" style="font-size:17px">Siguiente <i class="fa fa-angle-double-right fa-lg"></i></a>
            </td>
            <td class="col-md-3 brx2">
              <a href="" class="boton btn-block" style="font-size:17px">Generar Tasa Cero <i class="fa fa-angle-double-right fa-lg"></i></a>
            </td>
          </tr>
          <tr class="row">
            <td class="col-md-3 brx1 iap" style="font-size:17px!important">Expedir Cuenta de Gastos a: </td>
            <td class="col-md-9 brx1 iap" style="font-size:17px!important">Tecnologias Relacionadas con Energia y Servicios Especializado S.A de C.V --- CLT_7517</td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>


<!---se muestra al dar click en Buscar-->
  <div class="contenedor" id="b-ctagastos" style="display:none">
    <div class="row">
      <div class="col-md-12 offset-sm-8 p0">
        <a href="#" class="atras" accion="cuadroBusqueda">
          <i class="back fa fa-arrow-left">Regresar</i>
        </a>
      </div>
    </div>
    <div class="row titulograndetop transEff brx2" id="referencia">
      <div class="col-md-12 text-center">
        <label class="transEff" for="bRef" id="labelRef">Referencia o Solicitud</label>
      </div>
    </div>
    <div class="row intermedio transEff" id="nReferencia">
      <div class="col-md-12" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;" method="post">
        <input class="reg form-control noborder transEff" id="bRef" type="text">
      </form>
      </div>
    </div>
  </div>




<!---se muestra al escribir la referencia y dar enter-->
  <div class="contenedor container-fluid cont" id="m-ctagastos" style="display:none">
    <div class="col-md-12 offset-sm-11 p0">
      <a class="atras" accion="cuadroConsultar">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <div class="row tRepo">
      <div class="col-md-12 text-center">
        <label class="">Solicitud de Anticipo</label>
      </div>
    </div>
    <div class="row iap" style="font-size:22px!important">
      <div class="col-md-2 text-center">Solicitud</div>
      <div class="col-md-2 text-center">Referencia</div>
      <div class="col-md-6 text-center">Cliente</div>
      <div class="col-md-1 text-center"></div>
      <div class="col-md-1 text-center"></div>
    </div>
    <div class="row borderojo" style="font-size:18px!important">
      <div class="col-md-2 text-center">280380</div>
      <div class="col-md-2 text-center">N17003012</div>
      <div class="col-md-6 text-center">CLT_6548 MOTORES ELECTRICOS SUMERGIBLES DE MEXICO, S. DE R.L DE C.V</div>
      <div class="col-md-1 text-center" style="padding:5px">
        <a href="1-CuentaGtos_Consultar.php">
          <img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg">
        </a>
      </div>
      <div class="col-md-1 text-center" style="padding:5px">
        <a>
          <img class="icomediano" src="/conta6/Resources/iconos/printer.svg">
        </a>
      </div>
    </div>
  </div>
</div>

<script src="js/facturaElectronica.js"></script>
<script src="/conta6/Resources/js/Inputs.js"></script>
