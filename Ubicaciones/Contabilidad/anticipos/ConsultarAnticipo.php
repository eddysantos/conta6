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

<div id="datosanticipo" class="contorno brx3" style="display:none"><!--Comienza DETALLE DATOS DE POLIZA-->
  <h5 class="titulo">DATOS DE ANTICIPO</h5>
  <form class="form1" method="post">
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
      <tbody>
        <tr class="row">
          <td class="col-md-1">
            <input class="noborder text-center" type="text" readonly value="234567">
          </td>
          <td class="col-md-1">
            <input class="noborder text-center" type="text" readonly value="Estefania">
          </td>
          <td class="col-md-1">
            <input class="noborder text-center" type="text"  value="33452">
          </td>
          <td class="col-md-2">
            <input class="noborder text-center" type="text" value="30-06-2017">
          </td>
          <td class="col-md-2">
            <input class="noborder text-center" type="text" value="28-06-2017">
          </td>
          <td class="col-md-1">
            <input class="noborder text-center" type="text" value="240">
          </td>
          <td class="col-md-2">
            <input class="noborder text-center" type="text" readonly value="234577">
          </td>
          <td class="col-md-2">
            <input class="noborder text-center" type="text" value="Ninguna">
          </td>
        </tr>
        <tr class="row">
          <td class="col-md-2 brx2">
            <input id="ant-valor" class="noborder text-normal efecto text-center tiene-contenido" value="$21,027.00" type="text">
            <label for="ant-valor">VALOR</label>
          </td>
          <td class="col-md-1 brx2">
            <input id="ant-cliente" class="noborder text-normal efecto text-center tiene-contenido" value="CLT_7634" type="text">
            <label for="ant-cliente">CLIENTE</label>
          </td>
          <td class="col-md-1 brx2">
            <input id="ant-banco" class="noborder text-normal noborder efecto text-center tiene-contenido" value="044" type="text">
            <label for="ant-banco">BANCO</label>
          </td>
          <td class="col-md-1 brx2">
            <input id="ant-cuenta" class="noborder text-normal efecto noborder text-center tiene-contenido" value="8933" type="text">
            <label for="ant-cuenta">CUENTA</label>
          </td>
          <td class="col-md-7 brx2">
            <input id="ch-concep" class="noborder text-normal efecto text-center tiene-contenido" value="CONCEPTO DE LA POLIZA CONCEPTO DE LA POLIZA" type="text">
            <label for="ch-concep">CONCEPTO</label>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div><!--/Termina DETALLE DATOS DE POLIZA-->

  <form style="font-size:13px" method="post">
    <div class="row">
      <div class="col-md-2 offset-md-7 text-center">SUMA DE CARGOS</div>
      <div class="col-md-2 text-center">SUMA DE ABONOS</div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <a href="" class="boton btn-block" style="border:none"><img class="icomediano mleftx5" src= "/conta6/Resources/iconos/printer.svg" style="border:none"></a>
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
        <tr class="row encabezado">
          <td class="col-md-12 text-center">DETALLE POLIZA</td>
        </tr>
      </thead>
      <tbody class="">
        <tr class="row">
          <td class="xs backpink"></td>
          <td class="sm text-normal backpink">CUENTA</td>
          <td class="sm text-normal backpink">REFERENCIA</td>
          <td class="sm text-normal backpink">CLIENTE</td>
          <td class="sm text-normal backpink">FACTURA</td>
          <td class="sm text-normal backpink">NOTACRED</td>
          <td class="sm text-normal backpink">ANTICIPO</td>
          <td class="med backpink">DESCRIPCION</td>
          <td class="sm text-normal backpink">CARGO</td>
          <td class="sm text-normal backpink">ABONO</td>
          <td class="xs backpink"></td>
        </tr>

        <tr class="row borderojo">
          <td class="xs"></td>
          <td class="sm text-normal">0110-00001</td>
          <td class="sm text-normal">N17008098</td>
          <td class="sm text-normal">CLT_7118</td>
          <td class="sm text-normal">2222</td>
          <td class="sm text-normal">2222</td>
          <td class="sm text-normal">2222</td>
          <td class="med">T.DE LA FED.PTO.7003459</td>
          <td class="sm text-normal">111,133,299</td>
          <td class="sm text-normal">33,299</td>
          <td class="xs"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


  <script src="js/Anticipos.js"></script>
