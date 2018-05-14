<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="container-fluid">
  <div class="row submenuMed m-0">
    <ul class="nav nav-pills nav-fill w-100" id="AsignarEntregas">
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" accion="Entregas" status="cerrado">OTRAS ENTREGAS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" accion="AgregarFactura" status="cerrado">AGREGAR FACTURA</a>
      </li>
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" accion="Consultas" status="cerrado">CONSULTAS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" accion="Recorrido" status="cerrado">RECORRIDO</a>
      </li>
    </ul>
  </div>

  <div id="otrasEntregas" style="display:none">
    <form class="opcion brx4">
      <table class="table">
        <tr class="row">
          <td class="col-md-6 offset-md-3">
            <select class="input-dpol form-control" name="selector" id="opcion">
              <option >Selecciona</option>
              <option value="1">MOTORES FRANKLIN S.A DE C.V -- CLT_6967</option>
              <option value="2">MOTORES ELECTRICOS SUMERGIBLES S. DE R.L DE C.V -- CLT_6548</option>
            </select>
          </td>
        </tr>
      </table>
    </form>
    <div class="contorno">
      <form class="form1">
        <table class="table text-center">
          <thead style="font-size: 18px;font-weight: 100;">
            <tr class="row m-0 encabezado">
              <td class="col-md-12">Otras Facturas</td>
            </tr>
          </thead>
          <tbody class="cuerpo">
            <tr class="row m-0">
              <td class="col-md-4 input-effect brx2">
                <input id="calle" class="efecto text-center" type="text">
                <label for="calle">Calle</label>
              </td>
              <td class="col-md-1 input-effect brx2">
                <input id="next" class="efecto text-center" type="text">
                <label for="next">No Ext.</label>
              </td>
              <td class="col-md-4 input-effect brx2">
                <input id="colonia" class="efecto text-center" type="text">
                <label for="colonia">Colonia</label>
              </td>
              <td class="col-md-3 input-effect brx2">
                <input id="otro" class="efecto text-center" type="text">
                <label for="otro">Otro</label>
              </td>
            </tr>
            <tr class="row m-0">
              <td class="col-md-3 input-effect brx2">
                <input id="factura" class="efecto text-center" type="text">
                <label for="factura">Factura</label>
              </td>
              <td class="col-md-3 input-effect brx2">
                <input id="referencia" class="efecto text-center" type="text">
                <label for="referencia">Referencia</label>
              </td>
              <td class="col-md-3 input-effect brx2">
                <input id="cheque" class="efecto text-center" type="text">
                <label for="cheque">cheque</label>
              </td>
              <td class="col-md-3 input-effect brx2">
                <input id="importe" class="efecto text-center" type="text">
                <label for="importe">Importe</label>
              </td>
            </tr>
            <tr class="row m-0">
              <td class="col-md-8 input-effect brx2">
                <input id="concepto" class="efecto text-center" type="text">
                <label for="concepto">Concepto</label>
              </td>
              <td class="col-md-2 brx2">
                <a href="" class="boton"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> AGREGAR</a>
              </td>
              <td class="col-md-2 brx2">
                <a href="" class="boton"><img src= "/conta6/Resources/iconos/delete.svg" class="icochico"> CANCELAR</a>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
  </div>


  <div id="Afacturas"  style="display:none">
    <div class="contenedor">
      <div class="row titulograndetop transEff brx2" id="factura">
        <div class="col-12 text-center">
          <label class="transEff" for="afact" id="labelFact">Agregar Factura</label>
        </div>
      </div>
      <div class="row intermedio transEff">
        <div class="col-12">
          <form  class="form-group" onsubmit="return false;">
          <input class="reg form-control noborder transEff" id="afact" type="text">
        </form>
        </div>
      </div>
    </div>
  </div>

  <div id="Consul" style="display:none">
    <div class="contorno">
      <table class="table">
        <thead style="font-size: 18px;font-weight: 100;">
          <tr class="row encabezado">
            <td class="col-md-12 text-center">Consultas</td>
          </tr>
        </thead>
        <tbody class="cuerpo">
          <tr class="row m-0">
            <td class="col-md-3"></td>
            <td class="col-md-3 input-effect brx2">
              <input id="factura" class="efecto text-center" type="text">
              <label for="factura">Factura</label>
            </td>
            <td class="col-md-3 input-effect brx2">
              <input id="referencia" class="efecto text-center" type="text">
              <label for="referencia">Referencia</label>
            </td>
            <td class="col-md-3 brx2 text-left">
              <a href=""><img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg"></a>
            </td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-2"></td>
            <td class="col-md-2 input-effect brx3">
              <input list="Estatus" class="text-normal efecto text-center" id="status">
              <datalist id="Estatus">
                <option value="Entregado"></option>
                <option value="Pendiente"></option>
                <option value="Recorrido"></option>
              </datalist>
              <label for="status">Estatus</label>
            </td>
            <td class="col-md-3 input-effect brx3">
              <input class="dpol2 efecto text-center data-date" type="text" onfocus="(this.type='date')" id="finicial">
              <label for="finicial">Fecha Inicial</label>
            </td>
            <td class="col-md-3 input-effect brx3">
              <input class="dpol2 efecto text-center data-date" type="text" onfocus="(this.type='date')" id="ffinal1">
              <label for="ffinal1">Fecha Final</label>
            </td>
            <td class="col-md-2 brx3 text-left">
              <a href=""><img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg"></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="container-fluid cont">
      <table class="table text-center">
        <tbody class="text-normal">
          <tr class="row m-0">
            <td class="col-md-8 text-center sub2">CLIENTE</td>
            <td class="col-md-1 text-center sub2">FACTURA</td>
            <td class="col-md-1 text-center sub2">REFERENCIA</td>
            <td class="col-md-1 text-center sub2">ESTATUS</td>
            <td class="col-md-1 text-center sub2">RECORRIDO</td>
          </tr>
          <tr class="row m-0 borderojo">
            <td class="col-md-8 text-center">CLT_6029 -- EUROTECNICA TEXTIL, S.A DE C.V</td>
            <td class="col-md-1 text-center">63080</td>
            <td class="col-md-1 text-center">A16000029</td>
            <td class="col-md-1 text-center">Entregado</td>
            <td class="col-md-1 text-center">
              <div class="checkbox-xs">
                <label>
                  <input type="checkbox" data-toggle="toggle">
                </label>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div id="Recor" class="contorno" style="display:none">
    <table class="table text-center">
      <thead style="font-size: 18px;font-weight: 100;">
        <tr class="row encabezado">
          <td class="col-md-12 text-center">CUENTAS PARA RECORRIDO
            <a href=""><img class="icomediano" src="/conta6/Resources/iconos/printer.svg"></a>
          </td>
        </tr>
      </thead>
      <tbody class="text-normal">
        <tr class="row m-0">
          <td class="col-md-1 text-center iap">PENDIENTE</td>
          <td class="col-md-1 text-center iap">RECORRIDO</td>
          <td class="col-md-6 text-center iap">CLIENTE</td>
          <td class="col-md-1 text-center iap">FACTURA</td>
          <td class="col-md-1 text-center iap">REFERENCIA</td>
          <td class="col-md-1 text-center iap">ENTREGADO</td>
          <td class="col-md-1 text-center iap"></td>
        </tr>

        <tr class="row m-0 borderojo">
          <td class="col-md-1 text-center">
            <div class="checkbox-xs">
              <label>
                <input type="checkbox" data-toggle="toggle">
              </label>
            </div>
          </td>
          <td class="col-md-1 text-center"></td>
          <td class="col-md-6 text-center">CLT_6029 -- EUROTECNICA TEXTIL, S.A DE C.V</td>
          <td class="col-md-1 text-center">63080</td>
          <td class="col-md-1 text-center">A16000029</td>
          <td class="col-md-1 text-center">
            <div class="checkbox-xs">
              <label>
                <input type="checkbox" data-toggle="toggle">
              </label>
            </div>
          </td>
          <td class="col-md-1 text-center">
            <a href=""><img class="icomediano" src="/conta6/Resources/iconos/003-edit.svg"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->
</div><!--/Termina Container FLuid-->


<script src="js/Recorrido.js"></script>
<script src="/conta6/Resources/js/Inputs.js"></script>
<script src="/conta6/Resources/bootstrap/js/bootstrap-checkbox-toggle.js"></script>
