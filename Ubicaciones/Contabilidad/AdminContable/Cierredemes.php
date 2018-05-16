
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row submenuMed text-center m-0">
    <div class="col-md-4" role="button">
      <a  id="submenuMed" class="consultar" accion="generar" status="cerrado">GENERAR</a>
    </div>
    <div class="col-md-4">
      <a id="submenuMed" class="consultar" accion="modificar" status="cerrado">MODIFICAR</a>
    </div>
    <div class="col-md-4">
      <a id="submenuMed" class="consultar" accion="consultar" status="cerrado">CONSULTAR</a>
    </div>
  </div>
</div>


<div class="container-fluid">
  <div id="contornoGen" class="contorno" style="display:none">
    <h5 class="titulo font14">GENERAR</h5>
    <table class="table text-center">
      <tbody class="cuerpo">
        <tr class="row m-0 mt-4">
          <td class="col-md-3 input-effect">
            <input  list="oficinas" class="text-normal efecto text-center"  id="ofi">
            <datalist id="oficinas">
              <option>Nuevo Laredo</option>
              <option>Manzanillo</option>
              <option>Aeropuerto</option>
              <option>Veracruz</option>
            </datalist>
            <label for="ofi">OFICINAS</label>
          </td>
          <td class="col-md-3 input-effect">
            <input  list="modulos" class="text-normal efecto text-center"  id="mod">
            <datalist id="modulos">
              <option>Todos</option>
              <option>Anticipos</option>
              <option>Cheques</option>
              <option>Cuenta de Gastos</option>
              <option>Pólizas</option>
            </datalist>
            <label for="mod">MÓDULOS</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido" id="finicial">
            <label for="finicial">FECHA INICIAL</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido" id="ffin">
            <label for="ffin">FECHA FINAL</label>
          </td>
        </tr>
        <tr class="row mt-4 justify-content-center">
          <td class="col-md-2">
            <a href="" class="boton"><img src= "/conta6/Resources/iconos/save.svg" class="icochico"> GUARDAR</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="contornoMod" class="contorno" style="display:none;">
    <h5 class="titulo2 font14">MODIFICAR</h5>
    <table class="table text-center">
      <tbody class="cuerpo">
        <tr class="row m-0 mt-4">
          <td class="col-md-2 input-effect">
            <input id="Oficina" class="efecto tiene-contenido" type="text">
            <label for="Oficina">OFICINA</label>
          </td>
          <td class="col-md-1 input-effect">
            <input id="año" class="efecto tiene-contenido" type="text">
            <label for="año">AÑO</label>
          </td>
          <td class="col-md-1 input-effect">
            <input id="modulo" class="efecto tiene-contenido" type="text">
            <label for="modulo">MÓDULO</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="idcierre" class="efecto tiene-contenido" type="text">
            <label for="idcierre">ID CIERRE</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido" id="fini1" type="text">
            <label for="fini1">FECHA INICIAL</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido" id="ffin1" type="text">
            <label for="ffin1">FECHA FINAL</label>
          </td>
        </tr>
        <tr class="row mt-4 justify-content-center">
          <td class="col-md-2">
            <a href="" class="boton"><img src= "/conta6/Resources/iconos/003-edit.svg" class="icochico"> MODIFICAR</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


  <div id="contornoCon" class="contorno" style="display:none;">
    <h5 class="titulo font14">CONSULTAR</h5>
    <table class="table text-center">
      <tbody class="cuerpo">
        <tr class="row">
          <td class="col-md-3 offset-md-2">
            <select name="selector" id="opcion">
              <option >Seleccione Oficina</option>
              <option value="1">Todas</option>
              <option value="2">Aeropuerto</option>
              <option value="3">Manzanillo</option>
              <option value="4">Nuevo Laredo</option>
              <option value="5">Veracruz</option>
            </select>
          </td>
          <td class="col-md-2">
            <select name="selector" id="opcion">
              <option >Seleccione Año</option>
              <option value="1">2017</option>
              <option value="2">2015</option>
              <option value="3">2014</option>
              <option value="4">2011</option>
              <option value="5">2010</option>
            </select>
          </td>
          <td class="col-md-3">
            <select name="selector" id="opcion">
              <option >Seleccione Año</option>
              <option value="1">Todos los Módulos -- 0</option>
              <option value="2">Anticipos -- 5</option>
              <option value="3">Cheques -- 1</option>
              <option value="4">Cuenta de Gastos -- 3</option>
              <option value="5">Pólizas -- 4</option>
            </select>
          </td>
          <td class="col-md-2 text-left">
            <a href=""><img src= "/conta6/Resources/iconos/magnifier.svg" class="icochico"></a>
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
      <tbody class="cuerpo text-normal">
        <tr class="row borderojo">
          <td class="col-md-2">240</td>
          <td class="col-md-2">1</td>
          <td class="col-md-3">2017/07/01</td>
          <td class="col-md-3">2017/07/30</td>
          <td class="col-md-2">
            <a href=""><img src= "/conta6/Resources/iconos/003-edit.svg" class="icochico"></a>
            <a href="" class="ml-4"><img src= "/conta6/Resources/iconos/002-trash.svg" class="icochico"></a>
          </td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-2">160</td>
          <td class="col-md-2">1</td>
          <td class="col-md-3">2017/07/01</td>
          <td class="col-md-3">2017/07/30</td>
          <td class="col-md-2">
            <a href=""><img src= "/conta6/Resources/iconos/003-edit.svg" class="icochico"></a>
            <a href="" class="ml-4"><img src= "/conta6/Resources/iconos/002-trash.svg" class="icochico"></a>
          </td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-2">470</td>
          <td class="col-md-2">1</td>
          <td class="col-md-3">2017/07/01</td>
          <td class="col-md-3">2017/07/30</td>
          <td class="col-md-2">
            <a href=""><img src= "/conta6/Resources/iconos/003-edit.svg" class="icochico"></a>
            <a href="" class="ml-4"><img src= "/conta6/Resources/iconos/002-trash.svg" class="icochico"></a>
          </td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-2">430</td>
          <td class="col-md-2">1</td>
          <td class="col-md-3">2017/07/01</td>
          <td class="col-md-3">2017/07/30</td>
          <td class="col-md-2">
            <a href=""><img src= "/conta6/Resources/iconos/003-edit.svg" class="icochico"></a>
            <a href="" class="ml-4"><img src= "/conta6/Resources/iconos/002-trash.svg" class="icochico"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<script src="js/AdministracionContable.js"></script>
