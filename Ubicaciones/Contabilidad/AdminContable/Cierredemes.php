<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center font14 mb-10">
  <div class="row backpink p-2">
    <div class="col-md-6" role="button">
      <a  id="submenuMed" class="aconta" accion="generar" status="cerrado">GENERAR</a>
    </div>
    <div class="col-md-6">
      <a id="submenuMed" class="aconta" accion="consultar" status="cerrado">CONSULTAR</a>
    </div>
  </div>


  <div id="contornoGen" class="contorno" style="display:none">
    <h5 class="titulo">GENERAR</h5>
    <table class="table form1">
      <tbody>
        <tr class="row m-0 mt-4">
          <td class="col-md-3 input-effect">
            <select class="custom-select" id="ofi">
              <option selected>Oficina</option>
              <option>Nuevo Laredo</option>
              <option>Manzanillo</option>
              <option>Aeropuerto</option>
              <option>Veracruz</option>
            </select>
          </td>
          <td class="col-md-3 input-effect">
            <select class="custom-select" id="mod">
              <option selected>Modulo</option>
              <option>Todos</option>
              <option>Anticipos</option>
              <option>Cheques</option>
              <option>Cuenta de Gastos</option>
              <option>Pólizas</option>
            </select>
          </td>
          <td class="col-md-3 input-effect">
            <input type="date" class="efecto tiene-contenido" id="finicial">
            <label for="finicial">FECHA INICIAL</label>
          </td>
          <td class="col-md-3 input-effect">
            <input type="date" class="efecto tiene-contenido" id="ffin">
            <label for="ffin">FECHA FINAL</label>
          </td>
        </tr>
        <tr class="row mt-4 justify-content-center">
          <td class="col-md-2">
            <a href="" class="boton p-1"><img src= "/Resources/iconos/save.svg" class="icochico"> GUARDAR</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="contornoCon" class="contorno" style="display:none;">
    <h5 class="titulo">CONSULTAR</h5>
    <table class="table form1">
      <tbody>
        <tr class="row">
          <td class="col-md-3 offset-md-2">
            <select class="custom-select" id="ofi">
              <option>Seleccione Oficina</option>
              <option>Todas</option>
              <option>Nuevo Laredo</option>
              <option>Manzanillo</option>
              <option>Aeropuerto</option>
              <option>Veracruz</option>
            </select>
          </td>
          <td class="col-md-2">
            <select class="custom-select" id="opcion">
              <option >Seleccione Año</option>
              <option value="1">2017</option>
              <option value="2">2015</option>
              <option value="3">2014</option>
              <option value="4">2011</option>
              <option value="5">2010</option>
            </select>
          </td>
          <td class="col-md-3">
            <select class="custom-select" id="opcion">
              <option >Seleccione Modulo</option>
              <option value="1">Todos los Módulos -- 0</option>
              <option value="2">Anticipos -- 5</option>
              <option value="3">Cheques -- 1</option>
              <option value="4">Cuenta de Gastos -- 3</option>
              <option value="5">Pólizas -- 4</option>
            </select>
          </td>
          <td class="col-md-2 text-left align-self-center">
            <a href=""><img src= "/Resources/iconos/magnifier.svg" class="icomediano"></a>
          </td>
        </tr>
      </tbody>
    </table>

    <table class="table table-hover mt-4">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-2">ID OFICINA</td>
          <td class="col-md-2">ID MODULO</td>
          <td class="col-md-3">FECHA INICIAL</td>
          <td class="col-md-3">FECHA FINAL</td>
          <td class="col-md-2">ACCIONES</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row borderojo">
          <td class="col-md-2">240</td>
          <td class="col-md-2">1</td>
          <td class="col-md-3">2017/07/01</td>
          <td class="col-md-3">2017/07/30</td>
          <td class="col-md-2">
            <a href="#EditarCierre" data-toggle="modal"><img src= "/Resources/iconos/003-edit.svg" class="icochico"></a>
            <a href="" class="ml-5"><img src= "/Resources/iconos/002-trash.svg" class="icochico"></a>
          </td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-2">160</td>
          <td class="col-md-2">1</td>
          <td class="col-md-3">2017/07/01</td>
          <td class="col-md-3">2017/07/30</td>
          <td class="col-md-2">
            <a href="#EditarCierre" data-toggle="modal"><img src= "/Resources/iconos/003-edit.svg" class="icochico"></a>
            <a href="" class="ml-5"><img src= "/Resources/iconos/002-trash.svg" class="icochico"></a>
          </td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-2">470</td>
          <td class="col-md-2">1</td>
          <td class="col-md-3">2017/07/01</td>
          <td class="col-md-3">2017/07/30</td>
          <td class="col-md-2">
            <a href="#EditarCierre" data-toggle="modal"><img src= "/Resources/iconos/003-edit.svg" class="icochico"></a>
            <a href="" class="ml-5"><img src= "/Resources/iconos/002-trash.svg" class="icochico"></a>
          </td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-2">430</td>
          <td class="col-md-2">1</td>
          <td class="col-md-3">2017/07/01</td>
          <td class="col-md-3">2017/07/30</td>
          <td class="col-md-2">
            <a href=""><img src= "/Resources/iconos/003-edit.svg" class="icochico"></a>
            <a href="" class="ml-5"><img src= "/Resources/iconos/002-trash.svg" class="icochico"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<?php
require_once('modales/modificarCierre.php');
require $root . '/Ubicaciones/footer.php';
 ?>
