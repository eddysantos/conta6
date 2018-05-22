<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" status="cerrado" accion="dtospol">DATOS DE POLIZA</a>
      </li>
    </ul>
  </div>
  <div id="datospoliza" class="contorno" style="display:none"><!--Comienza DETALLE DATOS DE POLIZA-->
    <h5 class="titulo">DATOS DE LA POLIZA</h5>
    <form class="form1">
      <table class="table text-center">
        <thead>
          <tr class="row  encabezado font16">
            <td class="col-md-2">POLIZA</td>
            <td class="col-md-2">USUARIO</td>
            <td class="col-md-2">FECHA POLIZA</td>
            <td class="col-md-2">GENERACION</td>
            <td class="col-md-2">ADUANA</td>
            <td class="col-md-2">CANCELACIÓN</td>
          </tr>
        </thead>
        <tbody class="font16">
          <tr class="row">
            <td class="col-md-2">234567</td>
            <td class="col-md-2">Estefania</td>
            <td class="col-md-2">22/11/2017</td>
            <td class="col-md-2">30/12/2017</td>
            <td class="col-md-2">Nuevo Laredo</td>
            <td class="col-md-2">234567</td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-12 mt-5">
              <input id="concep" class="border-0 efecto tiene-contenido" value="Ejemplo del contenido Ejemplo del contenido" type="text">
              <label for="concep">CONCEPTO</label>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->

  <form  class="font14">
    <div class="row text-center"><!--DETALLE DE POLIZAS-->
      <div class="col-md-2 offset-md-7">SUMA DE CARGOS</div>
      <div class="col-md-2">SUMA DE ABONOS</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <a  class="boton" style="border:none"><img class="icomediano ml-5" src= "/conta6/Resources/iconos/printer.svg" style="border:none"></a>
      </div>
      <div class="col-md-2 offset-md-5 mt-3">
        <input  class="text-normal form-control efecto" value="$ 15, 932.08" readonly>
      </div>
      <div class="col-md-2 input-effect mt-3">
        <input  class="text-normal form-control efecto" value="$ 15, 932.08" readonly>
      </div>
    </div>
  </form>


  <div id="detallepoliza" class="contorno mt-5">
    <table class="table table-hover text-center">
      <thead>
        <tr class="row encabezado font18">
          <td class="col-md-12">DETALLE POLIZA</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row backpink">
          <td class="xs"></td>
          <td class="small">CUENTA</td>
          <td class="small">GASTO</td>
          <td class="small">PROV</td>
          <td class="small">REFERENCIA</td>
          <td class="small">CLIENTE</td>
          <td class="small">DOCUMENTO</td>
          <td class="small">FACTURA</td>
          <td class="small">NOTACRED</td>
          <td class="small">ANTICIPO</td>
          <td class="small">CHEQUE</td>
          <td class="med">DESCRIPCION</td>
          <td class="small">CARGO</td>
          <td class="small">ABONO</td>
          <td class="xs"></td>
        </tr>

        <tr class="row borderojo">
          <td class="xs"></td>
          <td class="small">0110-00001</td>
          <td class="small">2222</td>
          <td class="small">2222</td>
          <td class="small">CLT_7118</td>
          <td class="small">2222</td>
          <td class="small">2222</td>
          <td class="small">2222</td>
          <td class="small">2222</td>
          <td class="small">2222</td>
          <td class="small">2222</td>
          <td class="med">T.DE LA FED.PTO.7003459</td>
          <td class="small">111,133,299</td>
          <td class="small">33,299</td>
          <td class="xs"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div><!--/Termina continermov-->


<script src="js/Polizas.js"></script>
