<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <div class="row font14 m-5">
    <div class="col-md-3 offset-md-9">
      <a href="#" class="boton ver" accion="mostrarDetalle" role="button" id="botondetalle"><img src= "/conta6/Resources/iconos/detalles.svg" class="icochico"> DETALLE DE PÓLIZA</a>
    </div>
  </div>

  <form id="MostrarDetPoliza" class="contorno" style="display:none">
    <table class="table font14">
      <tbody>
        <tr  class="row backpink">
          <td class="col-md-1">
            <a href="" class="ver" accion="cerrarDetalle" role="button"><img src= "/conta6/Resources/iconos/cross.svg" class="icochico"></a>
          </td>
          <td class="col-md-1">PÓLIZA</td>
          <td class="col-md-2">USUARIO</td>
          <td class="col-md-2">FECHA PÓLIZA</td>
          <td class="col-md-2">FECHA GENERACIÓN</td>
          <td class="col-md-2">ADUANA</td>
          <td class="col-md-2">CACELACIÓN</td>
        </tr>
        <tr  class="row">
          <td class="col-md-1 offset-md-1">248955</td>
          <td class="col-md-2">Estefania</td>
          <td class="col-md-2">01-06-2017</td>
          <td class="col-md-2">02-06-2017 10:48:58</td>
          <td class="col-md-2">240</td>
          <td class="col-md-2"></td>
        </tr>
      </tbody>
    </table>
  </form>

  <form class="mt-5">
    <table class="table">
      <tr class="row">
        <td class="col-md-6 offset-md-3">
          <select class="custom-select"id="opcion">
            <option>PROVEEDOR</option>
            <option value="1">7-ELEVEN MEXICO SA DE CV -- SEM980701STA -- 261</option>
            <option value="2">ABASTECEDORA Y DISTRIBUIDORA GARA SA DE CV -- ADG0802135RA</option>
            <option value="3">AEROVIAS DE MEXICO SA DE CV -- AME880912189 -- 145</option>
            <option value="4">AGENCIA ADUANAL OLTRA JIMENEZ SA DE CV -- AAO970806K45</option>
          </select>
        </td>
      </tr>
    </table>
  </form>
  <form class="contorno mt-5">
    <table class="table">
      <tr  class="row encabezado">
        <td class="col-md-1">CUENTA</td>
        <td class="col-md-4">DESCRIPCIÓN</td>
        <td class="col-md-1">CARGO</td>
        <td class="col-md-1">ABONO</td>
        <td class="col-md-4">PROVEEDOR</td>
        <td class="col-md-1">ACCIONES</td>
      </tr>
      <tr  class="row borderojo">
        <td class="col-md-1">0110-00001</td>
        <td class="col-md-4">T.DE LA FED.PTO.7003459</td>
        <td class="col-md-1">$44,981.00</td>
        <td class="col-md-1">$0.00</td>
        <td class="col-md-4">ABASTECEDORA Y DISTRIBUIDORA GARA SA DE CV</td>
        <td class="col-md-1">
          <a href=""><img src= "/conta6/Resources/iconos/add.svg" class="icochico"></a>
          <a href=""><img src= "/conta6/Resources/iconos/002-trash.svg" class="icochico ml-5"></a>
        </td>
      </tr>
    </table>
  </form>
</div>

<script src="js/Proveedores.js"></script>
