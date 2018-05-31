<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link visualizar" id="submenuMed" status="cerrado" accion="dtosant">DATOS DE ANTICIPO</a>
      </li>
    </ul>
  </div>
<!--Comienza DETALLE DATOS DE POLIZA-->
  <div id="datosanticipo" class="contorno" style="display:none">
    <h5 class="titulo">DATOS DE ANTICIPO</h5>
    <form class="form1">
      <table class="table text-center">
        <thead>
          <tr class="row encabezado colorRosa">
            <td class="col-md-1">POLIZA</td>
            <td class="col-md-1">USUARIO</td>
            <td class="col-md-1">ANTICIPO</td>
            <td class="col-md-2">FECHA REGISTRO</td>
            <td class="col-md-2">FECHA ANTICIPO</td>
            <td class="col-md-1">OFICINA</td>
            <td class="col-md-2">CANCELACION</td>
            <td class="col-md-2">NOTA</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row">
            <td class="col-md-1">234567</td>
            <td class="col-md-1">Estefania</td>
            <td class="col-md-1">33452</td>
            <td class="col-md-2">30-06-2017</td>
            <td class="col-md-2">28-06-2017</td>
            <td class="col-md-1">240</td>
            <td class="col-md-2">234577</td>
            <td class="col-md-2">Ninguna</td>
          </tr>
          <tr class="row sub2 mt-4">
            <td class="col-md-2">Valor</td>
            <td class="col-md-1">Cliente</td>
            <td class="col-md-1">Banco</td>
            <td class="col-md-1">Cuenta</td>
            <td class="col-md-7">Concepto</td>
          </tr>
          <tr class="row">
            <td class="col-md-2">$21,027.00</td>
            <td class="col-md-1">$21,027.00</td>
            <td class="col-md-1">044</td>
            <td class="col-md-1">8933</td>
            <td class="col-md-7">CONCEPTO DE LA POLIZA CONCEPTO DE LA POLIZA</td>
          </tr>
        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->

  <form class="font14">
    <div class="row text-center mt-4">
      <div class="col-md-2 offset-md-7">SUMA DE CARGOS</div>
      <div class="col-md-2">SUMA DE ABONOS</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <a href="" class="boton border-0"><img class="icomediano ml-5" src= "/conta6/Resources/iconos/printer.svg"></a>
      </div>
      <div class="col-md-2 offset-md-5">
        <input class="efecto" value="$ 15, 932.08" readonly>
      </div>
      <div class="col-md-2">
        <input class="efecto" value="$ 15, 932.08" readonly>
      </div>
    </div>
  </form>
  <div id="detallepoliza" class="contorno">
    <table class="table table-hover text-center">
      <thead class="font18">
        <tr class="row encabezado">
          <td class="col-md-12">DETALLE POLIZA</td>
        </tr>
        <tr class="row backpink">
          <th class="xs"></th>
          <th class="sm">CUENTA</th>
          <th class="sm">REFERENCIA</th>
          <th class="sm">CLIENTE</th>
          <th class="sm">FACTURA</th>
          <th class="sm">NOTACRED</th>
          <th class="sm">ANTICIPO</th>
          <th class="med">DESCRIPCION</th>
          <th class="sm">CARGO</th>
          <th class="sm">ABONO</th>
          <th class="xs"></th>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row borderojo">
          <td class="xs"></td>
          <td class="sm">0110-00001</td>
          <td class="sm">N17008098</td>
          <td class="sm">CLT_7118</td>
          <td class="sm">2222</td>
          <td class="sm">2222</td>
          <td class="sm">2222</td>
          <td class="med">T.DE LA FED.PTO.7003459</td>
          <td class="sm">111,133,299</td>
          <td class="sm">33,299</td>
          <td class="xs"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="js/Anticipos.js"></script>
