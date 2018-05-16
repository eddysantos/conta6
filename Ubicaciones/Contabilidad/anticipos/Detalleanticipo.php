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
</div>

<div id="datosanticipo" class="contorno brx3" style="display:none"><!--Comienza DETALLE DATOS DE POLIZA-->
  <h5 class="titulo">DATOS DE ANTICIPO</h5>
  <form class="form1">
    <table class="table text-center">
      <thead>
        <tr class="row m-0 encabezado colorRosa">
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
      <tbody class="">
        <tr class="row m-0">
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
            <input class="efecto text-center" type="text" value="28-06-2017">
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
        <tr class="row m-0">
          <td class="col-md-2 brx2">
            <input id="ant-valor" class="text-normal efecto text-center tiene-contenido" value="$21,027.00" type="text">
            <label for="ant-valor">VALOR</label>
          </td>
          <td class="col-md-1 brx2">
            <input id="ant-cliente" class="text-normal efecto text-center tiene-contenido" value="CLT_7634" type="text">
            <label for="ant-cliente">CLIENTE</label>
          </td>
          <td class="col-md-1 brx2">
            <input id="ant-banco" class="text-normal noborder efecto text-center tiene-contenido" value="044" type="text">
            <label for="ant-banco">BANCO</label>
          </td>
          <td class="col-md-1 brx2">
            <input id="ant-cuenta" class="text-normal efecto noborder text-center tiene-contenido" value="8933" type="text">
            <label for="ant-cuenta">CUENTA</label>
          </td>
          <td class="col-md-6 brx2">
            <input id="ch-concep" class="text-normal efecto text-center tiene-contenido" value="CONCEPTO DE LA POLIZA CONCEPTO DE LA POLIZA" type="text">
            <label for="ch-concep">CONCEPTO</label>
          </td>
          <td class="col-md-1 brx2">
            <a href="" class="btn-block"> <img src= "/conta6/Resources/iconos/save.svg" class="icomediano"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div><!--/Termina DETALLE DATOS DE POLIZA-->



<div class="container-fluid movible">
  <nav>
    <ul class="nav nav-pills nav-fill w-100"  style="margin: 15px;">
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
          <table class="table">
            <thead class="cuerpo">
              <tr class="row m-0 encabezado">
                <td class="col-md-12">CAPTURA DETALLE DE ANTICIPO</td>
              </tr>
            </thead>
            <tbody class="cuerpo">

              <tr class="row m-0">
                <td class="col-md-2 input-effect brx3">
                  <input  class="text-normal efecto text-center"  id="ant-referencia">
                  <label for="ant-referencia">Referencia</label>
                </td>
                <td class="col-md-8 input-effect brx3">
                  <input  list="ant-cli" class="text-normal efecto text-center"  id="ant-clientes">
                  <datalist id="ant-cli">
                    <option value="REPRESENTACIONES ASESORIA MANTENIMIENTO Y SERVICIOS ANEXOS S.A DE C.V -- CLT_6921"></option>
                    <option value="SERVICIOS INTEGRALES EEN LOGISTICA INTERNACIONAL, ADUANAS Y TECNOLOGIA S.C -- CLT_7596"></option>
                    <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                    <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                  </datalist>
                  <label for="ant-clientes">Seleccione un Cliente</label>
                </td>
                <td class="col-md-2 brx3" role="button">
                  <a  href="#detpol-buscarfacturas" data-toggle="modal" class="boton text-center icochico"  style="border:none"> <img src= "/conta6/Resources/iconos/magnifier.svg"> Buscar Facturas</a>
                </td>
              </tr>


              <tr class="row m-0 text-center">
                <td class="col-md-8 input-effect brx2">
                  <input  list="ant-cta" class="text-normal efecto text-center"  id="ant-cuenta2">
                  <datalist id="ant-cta">
                    <option value="0108-06967 -- MOTORES FRANKLIN S.A DE C.V"></option>
                    <option value="0207-00004 -- CUENTAS AMERICANAS"></option>
                    <option value="0207-00005 -- TRANSFER"></option>
                    <option value="0208-06967 -- MOTORES FRANKLIN S.A DE CV"></option>
                  </datalist>
                  <label for="ant-cuenta2">Seleccione una Cuenta</label>
                </td>
                <td class="col-md-2 input-effect brx2">
                  <input  class="text-normal efecto text-center"  id="ant-cargo">
                  <label for="ant-cargo">Cargo</label>
                </td>
                <td class="col-md-2 input-effect brx2">
                  <input  class="text-normal efecto text-center"  id="ant-abono">
                  <label for="ant-abono">Abono</label>
                </td>
              </tr>
              <tr class="row">
                <td class="col-md-2 offset-md-5 brx2">
                  <a href="" class="boton brx1"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> REGISTRAR</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>


        <div class="row brx1">
          <div class="col-md-2 offset-md-4 text-center">SUMA DE CARGOS</div>
          <div class="col-md-2 text-center">SUMA DE ABONOS</div>
        </div>
        <div class="row">
          <div class="col-md-2 offset-md-4  brx1">
            <input  class="text-normal form-control efecto text-center " value="$ 15, 932.08" readonly>
          </div>
          <div class="col-md-2  brx1">
            <input  class="text-normal form-control efecto text-center " value="$ 15, 932.08" readonly>
          </div>
        </div>
      </div>

      <div id="two"><!--DETALLE DE POLIZAS-->
        <div class="row">
          <div class="col-md-2 offset-md-8 text-center">SUMA DE CARGOS</div>
          <div class="col-md-2 text-center">SUMA DE ABONOS</div>
        </div>
        <div class="row">
          <div class="col-md-3 text-center">
            <a href="#" class="text-normal boton"><img src= "/conta6/Resources/iconos/refresh-button.svg"> ACTUALIZAR ANTICIPO</a>
          </div>
          <div class="col-md-3 text-center">
            <a href="#" class="text-normal boton"><img src= "/conta6/Resources/iconos/add.svg"> GENERAR ANTICIPO</a>
          </div>
          <div class="col-md-2">
            <a href="#" class="boton" style="border:none"><img class="icomediano" src= "/conta6/Resources/iconos/printer.svg" style="border:none"></a>
          </div>
          <div class="col-md-2 input-effect brx1">
            <input  class="text-normal form-control efecto text-center tiene-contenido" value="$ 15, 932.08" readonly>
          </div>
          <div class="col-md-2 input-effect brx1">
            <input  class="text-normal form-control efecto text-center tiene-contenido" value="$ 15, 932.08" readonly>
          </div>
        </div>

        <div id="detallepoliza" class="contorno-mov brx1">
          <table class="table table-hover text-center">
            <thead class="cuerpo">
              <tr class="row encabezado m-0">
                <td class="col-md-12">DETALLE ANTICIPO</td>
              </tr>
            </thead>
            <tbody class="">
              <tr class="row m-0">
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

              <tr class="row m-0 borderojo">
                <td class="xs">
                  <a href="">
                    <img class="icochico" src="/conta6/Resources/iconos/002-trash.svg">
                  </a>
                </td>
                <td class="sm text-normal">0110-00001</td>
                <td class="sm text-normal">N17008098</td>
                <td class="sm text-normal">CLT_7118</td>
                <td class="sm text-normal">2222</td>
                <td class="sm text-normal">2222</td>
                <td class="sm text-normal">2222</td>
                <td class="med">T.DE LA FED.PTO.7003459</td>
                <td class="sm text-normal">111,133,299</td>
                <td class="sm text-normal">33,299</td>
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



<footer>
  <script src="js/Anticipos.js"></script>
  <script src="/conta6/ubicaciones/Contabilidad/js/contenedor-movible.js"></script>
  <script src="/conta6/Resources/bootstrap/js/bootstrap-checkbox-toggle.js"></script>


 <?php
   require_once('modales/editarRegistro.php');
   require_once('modales/buscarFacturas.php');
  ?>

 </footer>
