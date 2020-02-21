<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="text-center">
  <div class="row backpink m-0">
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
    <form class="opcion mt-5">
      <div class=" row justify-content-center">
        <div class="col-md-6">
          <select class="custom-select" id="opcion">
            <option >Selecciona</option>
            <option value="1">MOTORES FRANKLIN S.A DE C.V -- CLT_6967</option>
            <option value="2">MOTORES ELECTRICOS SUMERGIBLES S. DE R.L DE C.V -- CLT_6548</option>
          </select>
        </div>
      </div>
    </form>
    <div class="contorno">
      <form class="form1">
        <table class="table">
          <thead class="font18">
            <tr class="row encabezado m-0">
              <td class="col-md-12">Otras Facturas</td>
            </tr>
          </thead>
          <tbody class="font14">
            <tr class="row m-0 mt-5">
              <td class="col-md-4 input-effect">
                <input id="calle" class="efecto" type="text">
                <label for="calle">Calle</label>
              </td>
              <td class="col-md-1 input-effect">
                <input id="next" class="efecto" type="text">
                <label for="next">No Ext.</label>
              </td>
              <td class="col-md-4 input-effect">
                <input id="colonia" class="efecto" type="text">
                <label for="colonia">Colonia</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="otro" class="efecto" type="text">
                <label for="otro">Otro</label>
              </td>
            </tr>
            <tr class="row m-0 mt-4">
              <td class="col-md-3 input-effect">
                <input id="factura" class="efecto" type="text">
                <label for="factura">Factura</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="referencia" class="efecto" type="text">
                <label for="referencia">Referencia</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="cheque" class="efecto" type="text">
                <label for="cheque">cheque</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="importe" class="efecto" type="text">
                <label for="importe">Importe</label>
              </td>
            </tr>
            <tr class="row m-0 mt-4">
              <td class="col-md-8  input-effect">
                <input id="concepto" class="efecto" type="text">
                <label for="concepto">Concepto</label>
              </td>
              <td class="col-md-2">
                <a href="" class="boton"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> AGREGAR</a>
              </td>
              <td class="col-md-2">
                <a href="" class="boton"><img src= "/conta6/Resources/iconos/delete.svg" class="icochico"> CANCELAR</a>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
  </div>


  <div id="Afacturas" style="display:none">
    <div class="contenedor">
      <div class="row titulograndetop transEff" id="factura">
        <div class="col-12 ">
          <label class="transEff" for="afact" id="labelFact">Agregar Factura</label>
        </div>
      </div>
      <div class="row intermedio transEff">
        <div class="col-12">
          <form  class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="afact" type="text">
        </form>
        </div>
      </div>
    </div>
  </div>

  <div id="Consul" style="display:none">
    <div class="contorno">
      <form class="form1">
        <table class="table">
          <thead class="font18">
            <tr class="row encabezado">
              <td class="col-md-12">Consultas</td>
            </tr>
          </thead>
          <tbody class="font14">
            <tr class="row m-0 mt-5">
              <td class="col-md-3"></td>
              <td class="col-md-3 input-effect">
                <input id="factura" class="efecto" type="text">
                <label for="factura">Factura</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="referencia" class="efecto" type="text">
                <label for="referencia">Referencia</label>
              </td>
              <td class="col-md-3 text-left">
                <a href=""><img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg"></a>
              </td>
            </tr>
            <tr class="row m-0">
              <td class="col-md-2 offset-md-2 input-effect">
                <label class="mb-2 font14">Estatus</label>
                <select class="custom-select">
                  <option value="">Entregado</option>
                  <option value="">Pendiente</option>
                  <option value="">Recorrido</option>
                </select>
              </td>
              <td class="col-md-3 input-effect mt-4">
                <input class="efecto tiene-contenido" type="date" id="finicial">
                <label for="finicial">Fecha Inicial</label>
              </td>
              <td class="col-md-3 input-effect mt-4">
                <input class="efecto tiene-contenido" type="date" id="ffinal1">
                <label for="ffinal1">Fecha Final</label>
              </td>
              <td class="col-md-2 text-left mt-4">
                <a href=""><img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg"></a>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
    <div class="contorno">
      <table class="table table-hover">
        <thead>
          <tr class="row sub2 font12">
            <td class="col-md-8">CLIENTE</td>
            <td class="col-md-1">FACTURA</td>
            <td class="col-md-1">REFERENCIA</td>
            <td class="col-md-1">ESTATUS</td>
            <td class="col-md-1">RECORRIDO</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row borderojo">
            <td class="col-md-8">CLT_6029 -- EUROTECNICA TEXTIL, S.A DE C.V</td>
            <td class="col-md-1">63080</td>
            <td class="col-md-1">A16000029</td>
            <td class="col-md-1">Entregado</td>
            <td class="col-md-1">
              <div class="checkbox-xs">
                <label><input type="checkbox" data-toggle="toggle"></label>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div id="Recor" class="contorno" style="display:none">
    <table class="table  table-hover">
      <thead class="font18">
        <tr class="row encabezado">
          <td class="col-md-12">CUENTAS PARA RECORRIDO
            <a href="" class="ml-2"><img class="icomediano" src="/conta6/Resources/iconos/printer.svg"></a>
          </td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row backpink">
          <td class="col-md-1">PENDIENTE</td>
          <td class="col-md-1">RECORRIDO</td>
          <td class="col-md-6">CLIENTE</td>
          <td class="col-md-1">FACTURA</td>
          <td class="col-md-1">REFERENCIA</td>
          <td class="col-md-1">ENTREGADO</td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-1">
            <div class="checkbox-xs">
              <label>
                <input type="checkbox" data-toggle="toggle">
              </label>
            </div>
          </td>
          <td class="col-md-1"></td>
          <td class="col-md-6">CLT_6029 -- EUROTECNICA TEXTIL, S.A DE C.V</td>
          <td class="col-md-1">63080</td>
          <td class="col-md-1">A16000029</td>
          <td class="col-md-1">
            <div class="checkbox-xs">
              <label>
                <input type="checkbox" data-toggle="toggle">
              </label>
            </div>
          </td>
          <td class="col-md-1">
            <a href=""><img class="icomediano" src="/conta6/Resources/iconos/003-edit.svg"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->
</div><!--/Termina Container FLuid-->


<script src="js/Recorrido.js"></script>
<script src="/conta6/Resources/js/Inputs.js"></script>
<!-- <script src="/conta6/Resources/bootstrap/js/bootstrap-checkbox-toggle.js"></script> -->
