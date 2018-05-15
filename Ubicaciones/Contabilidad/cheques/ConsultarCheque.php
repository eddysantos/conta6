<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link visualizar" id="submenuMed" status="cerrado" accion="dtosch">DATOS DEL CHEQUE</a>
      </li>
    </ul>
  </div>

  <div id="datoscheque" class="contorno" style="display:none"><!--Comienza DETALLE DATOS DE POLIZA-->
    <h5 class="titulo">DATOS DEL CHEQUE</h5>
    <form class="form1">
      <table class="table text-center">
        <thead>
          <tr class="row encabezado">
            <td class="col-md-1">POLIZA</td>
            <td class="col-md-1">USUARIO</td>
            <td class="col-md-1">NO.CHEQUE</td>
            <td class="col-md-2">FECHA CHEQUE</td>
            <td class="col-md-1">IMPORTE</td>
            <td class="col-md-2">MODIFICACION</td>
            <td class="col-md-1">CANCELACION</td>
            <td class="col-md-2">NOTA</td>
            <td class="col-md-1">OFICINA</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row">
            <td class="col-md-1">234567</td>
            <td class="col-md-1">Estefania</td>
            <td class="col-md-1">3345</td>
            <td class="col-md-2">28-06-2017</td>
            <td class="col-md-1">$ 123,456</td>
            <td class="col-md-2">28-06-2017 14:24:58</td>
            <td class="col-md-1">234577</td>
            <td class="col-md-2">Ninguna</td>
            <td class="col-md-1">240</td>

          </tr>
          <tr class="row pt-4">
            <td class="col-md-12">
              <input id="ch-concep" class="border-0 efecto tiene-contenido" value="CONCEPTO DE LA POLIZA CONCEPTO DE LA POLIZA" type="text">
              <label for="ch-concep">CONCEPTO</label>
            </td>
          </tr>
          <tr class="row backpink">
            <td class="col-md-1 pt-3">111</td>
            <td class="col-md-4 pt-3">RAER8708025X3</td>
            <td class="col-md-7">ROSENDO ISAAC RANGEL ESTRADA</td>
          </tr>
        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->

  <form class="font14">
    <div class="row text-center mt-4"><!--DETALLE DE POLIZAS-->
      <div class="col-md-2 offset-md-7">SUMA DE CARGOS</div>
      <div class="col-md-2">SUMA DE ABONOS</div>
    </div>
    <div class="row pt-3">
      <div class="col-md-2">
        <a  class="boton border-0"><img class="icomediano ml-5" src= "/conta6/Resources/iconos/printer.svg"></a>
      </div>
      <div class="col-md-2 offset-md-5">
        <input  class="efecto" value="$ 15, 932.08" readonly>
      </div>
      <div class="col-md-2">
        <input  class="efecto" value="$ 15, 932.08" readonly>
      </div>
    </div>
  </form>
  <div id="detallepoliza" class="contorno">
    <table class="table table-hover text-center">
      <thead class="font18">
        <tr class="row encabezado">
          <td class="col-md-12">DETALLE DE CHEQUE</td>
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
          <td class="small">N17009854</td>
          <td class="small">CLT_7118</td>
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

<script src="js/Cheques.js"></script>
