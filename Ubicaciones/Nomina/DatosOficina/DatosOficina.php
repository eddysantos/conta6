<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
?>

<div class="text-center">
  <ul class="nav row submenuMed" role="tablist">
    <li class="nav-item col-md-4">
      <a class="nav-link active" data-toggle="tab" href="#dom-fiscal" role="tab">DOMICILIO FISCAL</a>
    </li>
    <li class="nav-item col-md-4">
      <a class="nav-link" data-toggle="tab" href="#dom-modif" role="tab">MODIFICAR DOMICILIO</a>
    </li>
    <li class="nav-item col-md-4">
      <a class="nav-link" data-toggle="tab" href="#datos-ofi" role="tab">DATOS DE OFICINA</a>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane fade show active" id="dom-fiscal" role="tabpanel">
      <div id="contornoDom" class="contorno">
        <div class="titulo font16 p-1" style='margin-top: -30px;'>DOMICILIO FISCAL</div>
        <table class="table" id="DomicilioFiscal">
          <thead>
            <tr class="row m-0 encabezado">
              <td class="col-md-12 font16 p-1">PROYECCION LOGISTICA AGENCIA ADUANAL S.A DE C.V</td>
            </tr>
          </thead>
          <tbody class="font14">
            <tr class="row">
              <td class="col-md-6 text-right">RFC :</td>
              <td class="col-md-6 text-left">PLA090609N21</td>
            </tr>
            <tr class="row">
              <td class="col-md-6 text-right">Calle :</td>
              <td class="col-md-6 text-left">Fundidora Monterrey 62 P.A</td>
            </tr>
            <tr class="row">
              <td class="col-md-6 text-right">Colonia :</td>
              <td class="col-md-6 text-left">Peñon de los Baños</td>
            </tr>
            <tr class="row">
              <td class="col-md-6 text-right">Ciudad :</td>
              <td class="col-md-6 text-left">México C.P 15520</td>
            </tr>
            <tr class="row">
              <td class="col-md-6 text-right">Telefono :</td>
              <td class="col-md-6 text-left">57 85 63 85</td>
            </tr>
            <tr class="row">
              <td class="col-md-6 text-right">Fax :</td>
              <td class="col-md-6 text-left">57 85 69 49</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="tab-pane fade" id="dom-modif" role="tabpanel">
      <div id="contornoEdit" class="contorno">
        <div class="titulo font16 p-1 w2" style='margin-top: -30px;'>MODIFICAR DOMICILIO FISCA</div>
        <table class="table" id="EditarDomicilio">
          <thead>
            <tr class="row encabezado font16">
              <td class="p-1 col-md-6">RAZON SOCIAL</td>
              <td class="p-1 col-md-3">RFC</td>
              <td class="p-1 col-md-3">OFICINA</td>
            </tr>
          </thead>
          <tbody class="font14">
            <tr class="row">
              <td class="col-md-6">
                <input class="efecto" type="text" value="Proyeccion Logistica Agencia Aduanal S.A de C.V">
              </td>
              <td class="col-md-3">
                <input class="efecto" type="text" value="PLA090609N21">
              </td>
              <td class="col-md-3">
                <select class="custom-select">
                  <option selected>Seleccione</option>
                  <option>Nuevo Laredo</option>
                  <option>Aeropuerto</option>
                  <option>Manzanillo</option>
                  <option>Veracruz</option>
                </select>
              </td>
            </tr>
            <tr class="row m-0 justify-content-center">
              <td class="col-md-3">
                <a href="" class="boton mt-4"> <img src= "/Resources/iconos/refresh-button.svg" class="icochico"> ACTUALIZAR</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane fade" id="datos-ofi" role="tabpanel">
      <div id="contornoDatos" class="contorno">
        <div class="titulo font16" style='margin-top:-28px'>DATOS DE OFICINA</div>
        <table class="table" id="DatosOficina">
          <thead>
            <tr class="row encabezado">
              <td class="col-md-12 font16 p-1">SUCURSAL 240 NUEVO LAREDO</td>
            </tr>
          </thead>
          <tbody class="font14">
            <tr class="row">
              <td class="col-md-6 text-right">Calle :</td>
              <td class="col-md-6 text-left">Melvin Jones 4040</td>
            </tr>
            <tr class="row">
              <td class="col-md-6 text-right">Colonia :</td>
              <td class="col-md-6 text-left">Burocratas</td>
            </tr>
            <tr class="row">
              <td class="col-md-6 text-right">Ciudad :</td>
              <td class="col-md-6 text-left">Nuevo Laredo Tamaulipas C.P 88280</td>
            </tr>
            <tr class="row">
              <td class="col-md-6 text-right">Telefono :</td>
              <td class="col-md-6 text-left">867 713 4646</td>
            </tr>
            <tr class="row">
              <td class="col-md-6 text-right">Registro Patronal :</td>
              <td class="col-md-6 text-left">E97-34803-10-4</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    </div>
  </div>

  <!-- <div class="row submenuMed m-0 ">
    <div class="col-md-4" role="button">
      <a  id="submenuMed" class="dtosOficina" accion="dFiscal" status="cerrado">DOMICILIO FISCAL</a>
    </div>
    <div class="col-md-4">
      <a id="submenuMed" class="dtosOficina" accion="eDomicilio" status="cerrado">MODIFICAR DOMICILIO</a>
    </div>
    <div class="col-md-4">
      <a id="submenuMed" class="dtosOficina" accion="dOficina" status="cerrado">DATOS DE OFICINA</a>
    </div>
  </div> -->







<script src="js/DatosOficina.js"></script>
