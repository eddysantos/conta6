<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row submenuMed m-0">
    <div class="col-md-4 text-center" role="button">
      <a  id="submenuMed" class="dtosOficina" accion="dFiscal" status="cerrado">DOMICILIO FISCAL</a>
    </div>
    <div class="col-md-4 text-center">
      <a id="submenuMed" class="dtosOficina" accion="eDomicilio" status="cerrado">MODIFICAR DOMICILIO</a>
    </div>
    <div class="col-md-4 text-center">
      <a id="submenuMed" class="dtosOficina" accion="dOficina" status="cerrado">DATOS DE OFICINA</a>
    </div>
  </div>

  <div id="contornoDom" class="contorno brx4" style="display:none">
    <h5 class="titulo" style="font-size:15px">DOMICILIO FISCAL</h5>
    <table class="table" id="DomicilioFiscal">
      <thead>
        <tr class="row m-0 tRepo2">
          <td class="col-md-12 text-center">PROYECCION LOGISTICA AGENCIA ADUANAL S.A DE C.V</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row m-0">
          <td class="col-md-6 text-right">RFC :</td>
          <td class="col-md-6 text-left">PLA090609N21</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Calle :</td>
          <td class="col-md-6 text-left">Fundidora Monterrey 62 P.A</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Colonia :</td>
          <td class="col-md-6 text-left">Peñon de los Baños</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Ciudad :</td>
          <td class="col-md-6 text-left">México C.P 15520</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Telefono :</td>
          <td class="col-md-6 text-left">57 85 63 85</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Fax :</td>
          <td class="col-md-6 text-left">57 85 69 49</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="contornoEdit" class="contorno" style="display:none;">
    <h5 class="titulo2" style="font-size:15px">MODIFICAR DOMICILIO FISCAL</h5>
    <table class="table" id="EditarDomicilio">
      <thead>
        <tr class="row m-0 tRepo2" style="height:40px">
          <td class="col-md-6 text-center">RAZON SOCIAL</td>
          <td class="col-md-3 text-center">RFC</td>
          <td class="col-md-3 text-center">OFICINA</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row m-0">
          <td class="col-md-6 text-center">
            <input class="inpReg" type="text" value="Proyeccion Logistica Agencia Aduanal S.A de C.V">
          </td>
          <td class="col-md-3 text-center">
            <input class="inpReg" type="text" value="PLA090609N21">
          </td>
          <td class="col-md-3 text-center">
            <select class="inpReg">
              <option selected>Seleccione</option>
              <option>Nuevo Laredo</option>
              <option>Aeropuerto</option>
              <option>Manzanillo</option>
              <option>Veracruz</option>
            </select>
          </td>
          <td class="col-md-4 offset-md-4">
            <a href="" class="boton btn-block brx2"> <img src= "/conta6/Resources/iconos/refresh-button.svg" class="icochico"> ACTUALIZAR</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="contornoDatos" class="contorno" style="display:none;">
    <h5 class="titulo" style="font-size:15px">DATOS DE OFICINA</h5>
    <table class="table" id="DatosOficina">
      <thead>
        <tr class="row m-0">
          <td class="col-md-12 text-center tRepo2">SUCURSAL 240 NUEVO LAREDO</td>
        </tr>
      </thead>
      <tbody class="cuerpo">
        <tr class="row m-0">
          <td class="col-md-6 text-right">Calle :</td>
          <td class="col-md-6 text-left">Melvin Jones 4040</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Colonia :</td>
          <td class="col-md-6 text-left">Burocratas</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Ciudad :</td>
          <td class="col-md-6 text-left">Nuevo Laredo Tamaulipas C.P 88280</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Telefono :</td>
          <td class="col-md-6 text-left">867 713 4646</td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-6 text-right">Registro Patronal :</td>
          <td class="col-md-6 text-left">E97-34803-10-4</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="js/DatosOficina.js"></script>
