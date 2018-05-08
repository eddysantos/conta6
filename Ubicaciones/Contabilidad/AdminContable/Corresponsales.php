<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="contorno brx4">
  <h5 class="titulo" style="font-size:15px">CATÁLOGO</h5>
  <table class="table">
    <tbody class="cuerpo">
      <tr class="row m-0">
        <td class="col-md-1">
          <a><img class="icomediano ml-2" src="/conta6/Resources/iconos/printer.svg"></a>
        </td>
        <td class="col-md-3 offset-md-8">
          <a href="#NuevoCorresponsal"  data-toggle="modal" class="boton btn-block"><img class="icochico" src="/conta6/Resources/iconos/add.svg"> AGREGAR NUEVO</a>
        </td>
      </tr>
    </tbody>
  </table>
  <table class="table table-hover">
    <thead>
      <tr class="row m-0 encabezado colorRosa">
        <td class="col-md-1"></td>
        <td class="col-md-5">CORRESPONSAL</td>
        <td class="col-md-4">CONTACTO</td>
        <td class="col-md-2">TELEFONO</td>
      </tr>
    </thead>
    <tbody class="text-normal">
      <tr class="row text-center m-0 borderojo">
        <td class="col-md-1 text-center">
          <a href="#EditarCorresponsal" data-toggle="modal">
            <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
          </a>
          <a>
            <img class="icochico mleftx2" src="/conta6/Resources/iconos/001-add.svg">
          </a>
        </td>
        <td class="col-md-5">Servicios Integrales en Logistica Internacional, Aduanas y Tecnologia S.C</td>
        <td class="col-md-4">Jose Luis jvalencia@sologiat.com</td>
        <td class="col-md-2">62 * 11 * 1717 * 5</td>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</div>

 <?php
 require_once('modales/ModalCorresponsales.php');
  ?>
