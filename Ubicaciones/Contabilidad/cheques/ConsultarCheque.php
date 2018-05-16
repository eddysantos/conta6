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


  <div id="datoscheque" class="contorno brx3" style="display:none"><!--Comienza DETALLE DATOS DE POLIZA-->
    <h5 class="titulo">DATOS DEL CHEQUE</h5>
    <form class="form1" method="post">
      <table class="table text-center">
        <thead style="font-size: 18px;font-weight: 100;">
          <tr class="row tRepoNom" style="font-size:14px">
            <td class="col-md-1  text-center">POLIZA</td>
            <td class="col-md-1  text-center">USUARIO</td>
            <td class="col-md-1  text-center">NO.CHEQUE</td>
            <td class="col-md-2  text-center">FECHA CHEQUE</td>
            <td class="col-md-1  text-center">IMPORTE</td>
            <td class="col-md-2  text-center">MODIFICACION</td>
            <td class="col-md-1  text-center">CANCELACION</td>
            <td class="col-md-2  text-center">NOTA</td>
            <td class="col-md-1  text-center">OFICINA</td>
          </tr>
        </thead>
        <tbody class="">
          <tr class="row">
            <td class="col-md-1">
              <input class="noborder text-center" type="text" readonly value="234567">
            </td>
            <td class="col-md-1">
              <input class="noborder text-center" type="text" readonly value="Estefania">
            </td>
            <td class="col-md-1">
              <input class="noborder text-center" type="text"  value="3345">
            </td>
            <td class="col-md-2">
              <input class="noborder text-center data-date" type="text" value="28-06-2017">
            </td>
            <td class="col-md-1">
              <input class="noborder text-center" type="text" value="$123,456">
            </td>
            <td class="col-md-2">
              <input class="noborder text-center data-date" type="text" value="28-06-2017 14:24:58">
            </td>
            <td class="col-md-1">
              <input class="noborder text-center" type="text" readonly value="234577">
            </td>
            <td class="col-md-2">
              <input class="noborder text-center" type="text" value="Ninguna">
            </td>
            <td class="col-md-1">
              <input class="noborder text-center" type="text" readonly value="240">
            </td>

          </tr>
          <tr class="row ">
            <td class="col-md-12 brx2">
              <input id="ch-concep" class="text-normal noborder efecto text-center tiene-contenido" value="CONCEPTO DE LA POLIZA CONCEPTO DE LA POLIZA" type="text">
              <label for="ch-concep">CONCEPTO</label>
            </td>
          </tr>
          <tr class="row">
            <td class="col-md-1 pt-10 iap" style="font-size:16px!important;">111</td>
            <td class="col-md-4 pt-10 iap" style="font-size:16px!important;">RAER8708025X3</td>
            <td class="col-md-7 iap">
              <input class="inp-nom noborder" value="ROSENDO ISAAC RANGEL ESTRADA" type="text">
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->


  <form style="font-size:13px" method="post">
    <div class="row"><!--DETALLE DE POLIZAS-->
      <div class="col-md-2 offset-md-7 text-center">SUMA DE CARGOS</div>
      <div class="col-md-2 text-center">SUMA DE ABONOS</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <a  class="boton btn-block" style="border:none"><img class="icomediano mleftx5" src= "/conta6/Resources/iconos/printer.svg" style="border:none"></a>
      </div>
      <div class="col-md-2 offset-md-5 input-effect brx1">
        <input  class="text-normal form-control efecto text-center tiene-contenido" value="$ 15, 932.08" readonly>
      </div>
      <div class="col-md-2 input-effect brx1">
        <input  class="text-normal form-control efecto text-center tiene-contenido" value="$ 15, 932.08" readonly>
      </div>
    </div>
  </form>
  <div id="detallepoliza" class="contorno brx1">
    <table class="table table-hover text-center">
      <thead style="font-size: 18px;font-weight: 100;">
        <tr class="row tRepo2">
          <td class="col-md-12 text-center">DETALLE DE CHEQUE</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row">
          <td class="xs backpink"></td>
          <td class="small backpink">CUENTA</td>
          <td class="small backpink">GASTO</td>
          <td class="small backpink">PROV</td>
          <td class="small backpink">REFERENCIA</td>
          <td class="small backpink">CLIENTE</td>
          <td class="small backpink">DOCUMENTO</td>
          <td class="small backpink">FACTURA</td>
          <td class="small backpink">NOTACRED</td>
          <td class="small backpink">ANTICIPO</td>
          <td class="small backpink">CHEQUE</td>
          <td class="med backpink">DESCRIPCION</td>
          <td class="small backpink">CARGO</td>
          <td class="small backpink">ABONO</td>
          <td class="xs backpink"></td>
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
