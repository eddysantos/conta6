<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid text-center">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link visualizar" id="submenuMed" status="cerrado" accion="dtosant">DATOS DE ANTICIPO</a>
      </li>
    </ul>
  </div>

  <!--Comienza DETALLE DATOS DE POLIZA-->
  <div id="datosanticipo" class="contorno" style="display:none">
    <h5 class="titulo">DATOS DE ANTICIPO</h5>
    <form class="form1">
      <table class="table">
        <thead>
          <tr class="row m-0 encabezado">
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
        <tbody class="font14">
          <tr class="row m-0">
            <td class="col-md-1 pt-3">234567</td>
            <td class="col-md-1 pt-3">Estefania</td>
            <td class="col-md-1 pt-3">33452</td>
            <td class="col-md-2 pt-3">30-06-2017</td>
            <td class="col-md-2">
              <input class="efecto h22" type="date" value="2018-06-30">
            </td>
            <td class="col-md-1 pt-3">240</td>
            <td class="col-md-2 pt-3">234577</td>
            <td class="col-md-2 pt-3">Ninguna</td>
          </tr>
          <tr class="row m-0 mt-5">
            <td class="col-md-2">
              <input id="ant-valor" class="efecto tiene-contenido h22" value="$21,027.00" type="text">
              <label for="ant-valor">VALOR</label>
            </td>
            <td class="col-md-1">
              <input id="ant-cliente" class="efecto tiene-contenido h22" value="CLT_7634" type="text">
              <label for="ant-cliente">CLIENTE</label>
            </td>
            <td class="col-md-1">
              <input id="ant-banco" class="efecto border-0 h22 tiene-contenido" value="044" type="text">
              <label for="ant-banco">BANCO</label>
            </td>
            <td class="col-md-1">
              <input id="ant-cuenta" class="efecto border-0 h22 tiene-contenido" value="8933" type="text">
              <label for="ant-cuenta">CUENTA</label>
            </td>
            <td class="col-md-6">
              <input id="ch-concep" class="efecto tiene-contenido h22" value="CONCEPTO DE LA POLIZA CONCEPTO DE LA POLIZA" type="text">
              <label for="ch-concep">CONCEPTO</label>
            </td>
            <td class="col-md-1 text-left">
              <a href=""> <img src= "/conta6/Resources/iconos/save.svg" class="icomediano"></a>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div><!--/Termina DETALLE DATOS DE POLIZA-->

  <div class="movible container-fluid">
    <nav>
      <ul class="nav nav-pills nav-fill w-100 mt-5 mb-3">
        <li class="nav-item">
          <a class="nav-link" id="pills">Captura Detalle de Anticipo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills">Detalle de Anticipo</a>
        </li>
      </ul>
    </nav> <!--links de desplazamiento-->
    <div class="containermov">
      <div class="contenedor-movible">
        <div id="one"><!--CAPTURA DE POLIZAS-->
          <div id="capturapoliza" class="contorno-mov">
            <table class="table form1 ">
              <thead>
                <tr class="row m-0 encabezado font16">
                  <td class="col-md-12">CAPTURA DETALLE DE ANTICIPO</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0 mt-5">
                  <td class="col-md-2 input-effect">
                    <input  class="efecto" id="ant-referencia">
                    <label for="ant-referencia">Referencia</label>
                  </td>
                  <td class="col-md-8 input-effect">
                    <input  list="ant-cli" class="efecto" id="ant-clientes">
                    <datalist id="ant-cli">
                      <option value="REPRESENTACIONES ASESORIA MANTENIMIENTO Y SERVICIOS ANEXOS S.A DE C.V -- CLT_6921"></option>
                      <option value="SERVICIOS INTEGRALES EEN LOGISTICA INTERNACIONAL, ADUANAS Y TECNOLOGIA S.C -- CLT_7596"></option>
                      <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                      <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                    </datalist>
                    <label for="ant-clientes">Seleccione un Cliente</label>
                  </td>
                  <td class="col-md-2" role="button">
                    <a  href="#detpol-buscarfacturas" data-toggle="modal" class="boton icochico border-0"> <img src= "/conta6/Resources/iconos/magnifier.svg"> Buscar Facturas</a>
                  </td>
                </tr>
                <tr class="row m-0 mt-4">
                  <td class="col-md-8 input-effect">
                    <input  list="ant-cta" class="efecto"  id="ant-cuenta2">
                    <datalist id="ant-cta">
                      <option value="0108-06967 -- MOTORES FRANKLIN S.A DE C.V"></option>
                      <option value="0207-00004 -- CUENTAS AMERICANAS"></option>
                      <option value="0207-00005 -- TRANSFER"></option>
                      <option value="0208-06967 -- MOTORES FRANKLIN S.A DE CV"></option>
                    </datalist>
                    <label for="ant-cuenta2">Seleccione una Cuenta</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input  class="efecto"  id="ant-cargo">
                    <label for="ant-cargo">Cargo</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input  class="efecto"  id="ant-abono">
                    <label for="ant-abono">Abono</label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-2 offset-md-5">
                    <a href="" class="boton"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> REGISTRAR</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>


          <div class="row mt-5 ">
            <div class="col-md-2 offset-md-4">SUMA DE CARGOS</div>
            <div class="col-md-2">SUMA DE ABONOS</div>
          </div>
          <div class="row">
            <div class="col-md-2 offset-md-4">
              <input  class="efecto" value="$ 15, 932.08" readonly>
            </div>
            <div class="col-md-2">
              <input  class="efecto" value="$ 15, 932.08" readonly>
            </div>
          </div>
        </div>

        <div id="two" class=""><!--DETALLE DE POLIZAS-->
          <div class="row">
            <div class="col-md-2 offset-md-8">SUMA DE CARGOS</div>
            <div class="col-md-2">SUMA DE ABONOS</div>
          </div>
          <div class="row font14">
            <div class="col-md-3 mt-3">
              <a href="#" class="boton"><img src= "/conta6/Resources/iconos/refresh-button.svg"> ACTUALIZAR ANTICIPO</a>
            </div>
            <div class="col-md-3 mt-3">
              <a href="#" class="boton"><img src= "/conta6/Resources/iconos/add.svg"> GENERAR ANTICIPO</a>
            </div>
            <div class="col-md-2 mt-3">
              <a href="#" class="boton border-0"><img class="icomediano" src= "/conta6/Resources/iconos/printer.svg"></a>
            </div>
            <div class="col-md-2 mt-3">
              <input  class="efecto" value="$ 15, 932.08" readonly>
            </div>
            <div class="col-md-2 mt-3">
              <input  class="efecto" value="$ 15, 932.08" readonly>
            </div>
          </div>

          <div id="detallepoliza" class="contorno-mov mt-4">
            <table class="table table-hover">
              <thead>
                <tr class="row encabezado font16 m-0">
                  <td class="col-md-12">DETALLE ANTICIPO</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row backpink m-0">
                  <td class="xs"></td>
                  <td class="sm">CUENTA</td>
                  <td class="sm">REFERENCIA</td>
                  <td class="sm">CLIENTE</td>
                  <td class="sm">FACTURA</td>
                  <td class="sm">NOTACRED</td>
                  <td class="sm">ANTICIPO</td>
                  <td class="med">DESCRIPCION</td>
                  <td class="sm">CARGO</td>
                  <td class="sm">ABONO</td>
                  <td class="xs"></td>
                </tr>

                <tr class="row m-0 borderojo">
                  <td class="xs">
                    <a href=""><img class="icochico" src="/conta6/Resources/iconos/002-trash.svg"></a>
                  </td>
                  <td class="sm">0110-00001</td>
                  <td class="sm">N17008098</td>
                  <td class="sm">CLT_7118</td>
                  <td class="sm">2222</td>
                  <td class="sm">2222</td>
                  <td class="sm">2222</td>
                  <td class="med">T.DE LA FED.PTO.7003459</td>
                  <td class="sm">111,133,299</td>
                  <td class="sm">33,299</td>
                  <td class="xs">
                    <a href="#detpol-editar" data-toggle="modal">
                      <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div><!--/Termina contenedor-movible-->
    </div><!--/Termina continermov-->
  </div><!--/Termina container-fluid movible-->
</div>


<footer>
  <script src="js/Anticipos.js"></script>
  <script src="/conta6/ubicaciones/Contabilidad/js/contenedor-movible.js"></script>
  <script src="/conta6/Resources/bootstrap/js/bootstrap-checkbox-toggle.js"></script>

 <?php
   require_once('modales/editarRegistro.php');
   require_once('modales/buscarFacturas.php');
  ?>
 </footer>
