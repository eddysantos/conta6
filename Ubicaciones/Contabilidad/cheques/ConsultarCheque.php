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
          <tr class="row encabezado colorRosa">
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
        <tbody style="font-size:14px">
          <tr class="row">
            <td class="col-md-1">
              <input class="noborder" type="text" readonly value="234567">
            </td>
            <td class="col-md-1">
              <input class="noborder" type="text" readonly value="Estefania">
            </td>
            <td class="col-md-1">
              <input class="noborder" type="text"  value="3345">
            </td>
            <td class="col-md-2">
              <input class="noborder data-date" type="text" value="28-06-2017">
            </td>
            <td class="col-md-1">
              <input class="noborder" type="text" value="$123,456">
            </td>
            <td class="col-md-2">
              <input class="noborder data-date" type="text" value="28-06-2017 14:24:58">
            </td>
            <td class="col-md-1">
              <input class="noborder" type="text" readonly value="234577">
            </td>
            <td class="col-md-2">
              <input class="noborder" type="text" value="Ninguna">
            </td>
            <td class="col-md-1">
              <input class="noborder text-center" type="text" readonly value="240">
            </td>

          </tr>
          <tr class="row pt-4">
            <td class="col-md-12">
              <input id="ch-concep" class="noborder efecto tiene-contenido" value="CONCEPTO DE LA POLIZA CONCEPTO DE LA POLIZA" type="text">
              <label for="ch-concep">CONCEPTO</label>
            </td>
          </tr>
          <tr class="row">
            <td class="col-md-1 pt-3 backpink">111</td>
            <td class="col-md-4 pt-3 backpink">RAER8708025X3</td>
            <td class="col-md-7 backpink">
              <input class="noborder" value="ROSENDO ISAAC RANGEL ESTRADA" type="text">
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->


  <form style="font-size:13px" >
    <div class="row text-center"><!--DETALLE DE POLIZAS-->
      <div class="col-md-2 offset-md-7">SUMA DE CARGOS</div>
      <div class="col-md-2">SUMA DE ABONOS</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <a  class="boton" style="border:none"><img class="icomediano mleftx5" src= "/conta6/Resources/iconos/printer.svg" style="border:none"></a>
      </div>
      <div class="col-md-2 offset-md-5 pt-3">
        <input  class="text-normal form-control text-center" value="$ 15, 932.08" readonly>
      </div>
      <div class="col-md-2 input-effect pt-3">
        <input  class="text-normal form-control text-center" value="$ 15, 932.08" readonly>
      </div>
    </div>
  </form>
  <div id="detallepoliza" class="contorno">
    <table class="table table-hover text-center">
      <thead class="cuerpo">
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
