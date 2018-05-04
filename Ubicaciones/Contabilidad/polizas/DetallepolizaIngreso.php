<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="container-fluid">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link consultar" id="submenuMed" status="cerrado" accion="dtospol">DATOS DE POLIZA</a>
      </li>
    </ul>
  </div>
</div>

<div id="datospoliza" class="contorno brx3" style="display:none"><!--Comienza DETALLE DATOS DE POLIZA-->
  <h5 class="titulo">DATOS DE LA POLIZA</h5>
  <form class="form1">
    <table class="table text-center">
      <thead style="font-size: 18px;font-weight: 100;">
        <tr class="row m-0 tRepoNom" style="font-size:14px">
          <td class="col-md-2  text-center">POLIZA</td>
          <td class="col-md-2  text-center">USUARIO</td>
          <td class="col-md-2  text-center">FECHA POLIZA</td>
          <td class="col-md-2  text-center">GENERACION</td>
          <td class="col-md-2  text-center">ADUANA</td>
          <td class="col-md-2  text-center">CANCELACION</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row m-0">
          <td class="col-md-2">
            <input class="efecto text-center" type="text" readonly value="234567">
          </td>
          <td class="col-md-2">
            <input class="efecto text-center" type="text" readonly value="Estefania">
          </td>
          <td class="col-md-2">
            <input class="efecto text-center" type="date">
          </td>
          <td class="col-md-2">
            <input class="efecto text-center" type="date">
          </td>
          <td class="col-md-2">
            <input class="efecto text-center" type="text" readonly value="Nuevo Laredo">
          </td>
          <td class="col-md-2">
            <input class="efecto text-center" type="text" readonly value="234567">
          </td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-11 brx2">
            <input id="concep" class="text-normal efecto text-center tiene-contenido" value="CONCEPTO DE LA POLIZA CONCEPTO DE LA POLIZA" type="text">
            <label for="concep">CONCEPTO</label>
          </td>
          <td class="col-md-1 brx1">
            <a href="" class="btn-block brx1"> <img src= "/conta6/Resources/iconos/save.svg" class="icomediano"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div><!--/Termina DETALLE DATOS DE POLIZA-->


<div class="container-fluid movible m-5">
  <nav>
    <ul class="nav nav-pills nav-fill w-100 m-15">
      <li class="nav-item">
        <a class="nav-link" id="pills">Captura Detalle Póliza</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills">Detalle de Póliza</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills">Información Adicional</a>
      </li>
    </ul>
  </nav> <!--links de desplazamiento-->
  <div class="containermov">
    <div class="contenedor-movible">
      <div id="one"><!--CAPTURA DE POLIZAS-->
        <div id="capturapoliza" class="contorno-mov">
          <table class="table">
            <thead style="font-size: 18px;font-weight: 100;">
              <tr class="row m-0 tRepo2">
                <td class="col-md-12 text-center">CAPTURA DETALLE POLIZA</td>
              </tr>
            </thead>
            <tbody class="cuerpo">
              <tr class="row m-0 text-center">
                <td class="col-md-10 input-effect brx2">
                  <input  list="clientes" class="text-normal efecto text-center"  id="detpol-cliente">
                  <datalist id="clientes">
                    <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                    <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                  </datalist>
                  <label for="detpol-cliente">Cliente</label>
                </td>
                <td class="col-md-2 brx2" role="button">
                  <a  href="#detpol-buscarfacturas" data-toggle="modal" class="boton btn-block text-center icochico"  style="border:none"> <img src= "/conta6/Resources/iconos/magnifier.svg"> Buscar Facturas</a>
                </td>
              </tr>

              <tr class="row m-0">
                <td class="col-md-8 input-effect brx2">
                  <input list="todascuentas" class="text-normal efecto text-center" id="detpol-cuenta">
                  <datalist id="todascuentas">
                    <option value="0206-00648 -- COMITE PARA EL FOMENTO Y PROTECCION PRECUARIA DEL ESTA DE NUEVO LEON A.C"></option>
                    <option value="0100-00011 ---- BANAMEX DLLS CTA.79033561 NLDO"></option>
                    <option value="0100-00012 ---- BANAMEX DLLS CTA.79033561 COMPLEMENTARIA NLDO"></option>
                    <option value="0206-00808 -- CÀMARA DE COMERCIO, SERVICIOS Y TURISMO EN PEQUEÑO DE LA CIUDAD DE MÉXICO"></option>
                    <option value="0100-00017 ---- BANAMEX CTA.7355485 NLDO"></option>
                  </datalist>
                  <label for="detpol-cuenta">Seleccione una Cuenta</label>
                </td>
                <td class="col-md-4 input-effect brx2">
                  <input class="text-normal efecto text-center" id="detpol-concepto">
                  <label for="detpol-concepto">Concepto</label>
                </td>
              </tr>

              <tr class="row m-0">
                <td class="col-md-2 input-effect brx2">
                  <input class="text-normal efecto text-center" id="detpol-referencia">
                  <label for="detpol-referencia">Referencia</label>
                </td>
                <td class="col-md-2 input-effect brx2">
                  <input class="text-normal efecto text-center" id="detpol-documento">
                  <label for="detpol-documento">Documento</label>
                </td>
                <td class="col-md-2 input-effect brx2">
                  <input class="text-normal efecto text-center" id="detpol-factura">
                  <label for="detpol-factura">Factura</label>
                </td>
                <td class="col-md-1 input-effect brx2">
                  <input class="text-normal efecto text-center" id="detpol-anticipo">
                  <label for="detpol-anticipo">Anticipo</label>
                </td>
                <td class="col-md-1 input-effect brx2">
                  <input class="text-normal efecto text-center" id="detpol-cheque">
                  <label for="detpol-cheque">Cheque</label>
                </td>
                <td class="col-md-2 input-effect brx2">
                  <input class="text-normal efecto text-center"  id="detpol-cargo">
                  <label for="detpol-cargo">Cargo</label>
                </td>
                <td class="col-md-2 input-effect brx2">
                  <input class="text-normal efecto text-center"  id="detpol-abono">
                  <label for="detpol-abono">Abono</label>
                </td>
              </tr>
              <tr class="row">
                <td class="col-md-2 offset-md-5 brx2">
                  <a href="" class="boton btn-block brx1"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> REGISTRAR</a>
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
          <div class="col-md-2">
            <a href="" class="boton btn-block" style="border:none"><img class="icomediano" src= "/conta6/Resources/iconos/printer.svg" style="border:none"></a>
          </div>
          <div class="col-md-2 offset-md-6 input-effect brx1">
            <input  class="text-normal form-control efecto text-center tiene-contenido" value="$ 15, 932.08" readonly>
          </div>
          <div class="col-md-2 input-effect brx1">
            <input  class="text-normal form-control efecto text-center tiene-contenido" value="$ 15, 932.08" readonly>
          </div>
        </div>

        <div id="detallepoliza" class="contorno-mov brx1">
          <table class="table table-hover text-center">
            <thead style="font-size: 18px;font-weight: 100;">
              <tr class="row tRepo2">
                <td class="col-md-12 text-center">DETALLE POLIZA</td>
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
                <td class="xs">
                  <a href="">
                    <img class="icochico" src="/conta6/Resources/iconos/002-trash.svg">
                  </a>
                </td>
                <td class="small">0110-00001</td>
                <td class="small">2222</td>
                <td class="small">2222</td>
                <td class="small">CLT_7118</td>
                <td class="small">2222</td>
                <td class="small">2222</td>
                <td class="small">2222</td>
                <td class="small">2222</td>
                <td class="small">2222</td>
                <td class="small">2222</td>
                <td class="med">T.DE LA FED.PTO.7003459</td>
                <td class="small">111,133,299</td>
                <td class="small">33,299</td>
                <td class="xs">
                  <a href="#detpol-editarRegPolIngreso" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div id="three"><!--INFORMACION DE LA PARTIDA-->
        <form class="opcion">
          <table class="table">
            <tr class="row">
              <td class="col-md-4 offset-md-4">
                <select class="input-dpol form-control" name="selector" id="opcionespolizas">
                  <option >Selecciona</option>
                  <option value="1">CFD/CBB</option>
                  <option value="2">CFDI</option>
                  <option value="3">Cheque</option>
                  <option value="4">Comprobante Extranjero</option>
                  <option value="5">Otro</option>
                  <option value="6">Transferencia</option>
                </select>
              </td>
            </tr>
          </table>
        </form>
        <div id="capturapoliza" class="contorno-mov cfdcbb"><!--solo aparece al seleccionar CFD / CBB-->
          <form class="form1" method="post">
            <table class="table text-center">
              <thead style="font-size: 18px;font-weight: 100;">
                <tr class="row m-0 tRepo2">
                  <td class="col-md-12">CFD / CBB</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0">
                  <td class="col-md-2 input-effect brx2">
                    <input id="dpol-rfc" class="efecto text-center" type="text">
                    <label for="dpol-rfc">RFC</label>
                  </td>
                  <td class="col-md-6 input-effect brx2">
                    <input id="dpol-razonsocial" class="efecto text-center" type="text">
                    <label for="dpol-razonsocial">Razón Social</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="dpol-serie" class="efecto text-center" type="text">
                    <label for="dpol-serie">Serie</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="dpol-folio" class="efecto text-center" type="text">
                    <label for="dpol-folio">Folio</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-3 input-effect brx2">
                    <input id="dpol-subtotal" class="efecto text-center" type="text">
                    <label for="dpol-subtotal">Subtotal</label>
                  </td>
                  <td class="col-md-3 input-effect brx2">
                    <input id="dpol-iva" class="efecto text-center" type="text">
                    <label for="dpol-iva">IVA</label>
                  </td>
                  <td class="col-md-3 input-effect brx2">
                    <input id="dpol-total" class="efecto text-center" type="text">
                    <label for="dpol-total">Total</label>
                  </td>
                  <td class="col-md-3 input-effect brx2">
                    <input id="dpol-aplicar" class="efecto text-center" type="text">
                    <label for="dpol-aplicar">Aplicar</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>

        <div id="capturapoliza" class="contorno-mov cfdi"><!--solo aparece al seleccionar CFDI-->
          <form class="form1">
            <table class="table text-center">
              <thead style="font-size: 18px;font-weight: 100;">
                <tr class="row tRepo2 m-0">
                  <td class="col-md-12">CFDI</td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-12 brx1">
                    <input type="file">
                  </td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0">
                  <td class="col-md-2 input-effect brx1">
                    <input id="cfdi-rfc" class="efecto text-center" type="text">
                    <label for="cfdi-rfc">RFC</label>
                  </td>
                  <td class="col-md-5 input-effect brx1">
                    <input id="cfdi-razonsocial" class="efecto text-center" type="text">
                    <label for="cfdi-razonsocial">Nombre / Razón Social</label>
                  </td>
                  <td class="col-md-5 input-effect brx1">
                    <input id="cfdi-uuid" class="efecto text-center" type="text">
                    <label for="cfdi-uuid">UUID</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-3 input-effect brx2">
                    <input id="cfdi-subtotal" class="efecto text-center" type="text">
                    <label for="cfdi-subtotal">Subtotal</label>
                  </td>
                  <td class="col-md-3 input-effect brx2">
                    <input id="cfdi-iva" class="efecto text-center" type="text">
                    <label for="cfdi-iva">IVA</label>
                  </td>
                  <td class="col-md-3 input-effect brx2">
                    <input id="cfdi-total" class="efecto text-center" type="text">
                    <label for="cfdi-total">Total</label>
                  </td>
                  <td class="col-md-3 input-effect brx2">
                    <input id="cfdi-aplicar" class="efecto text-center" type="text">
                    <label for="cfdi-aplicar">Aplicar</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>

        <div id="capturapoliza" class="contorno-mov cheque"><!--solo aparece al seleccionar CHEQUES-->
          <form class="form1">
            <table class="table text-center">
              <thead style="font-size: 18px;font-weight: 100;">
                <tr class="row m-0 tRepo2">
                  <td class="col-md-12">CHEQUES</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0">
                  <td class="col-md-5 input-effect brx2">
                    <input  list="ch-origen" class="text-normal efecto text-center"  id="chorigen">
                    <datalist id="ch-origen">
                      <option value="Banamex - 002 - 7658424"></option>
                      <option value="Banamex - 002 - 79033561"></option>
                      <option value="Banamex - 002 - 7355485"></option>
                      <option value="Bancomer - 012 - 0192655497"></option>
                    </datalist>
                    <label for="chorigen">Seleccione una Cuenta (Origen)</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="ch-banco" class="efecto text-center tiene-contenido" type="text" value="002">
                    <label for="ch-banco">Banco</label>
                  </td>
                  <td class="col-md-3 input-effect brx2">
                    <input id="ch-ncuenta" class="efecto text-center tiene-contenido" type="text" value="7865432">
                    <label for="ch-ncuenta">No.Cuenta</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input  list="numcheques" class="text-normal efecto text-center"  id="ch-cheques">
                    <datalist id="numcheques">
                      <option value="3421"></option>
                      <option value="3422"></option>
                      <option value="3423"></option>
                      <option value="3424"></option>
                    </datalist>
                    <label for="ch-cheques">Cheques</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-5 input-effect brx2">
                    <input id="ch-emextran" class="efecto text-center" type="text">
                    <label for="ch-emextran">Emisor Extranjero</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="ch-tc" class="efecto text-center" type="text">
                    <label for="ch-tc">Tipo de Cambio</label>
                  </td>
                  <td class="col-md-5 input-effect brx2">
                    <input  list="chmoneda" class="text-normal efecto text-center"  id="ch-moneda">
                    <datalist id="chmoneda">
                      <option value="Peso Mexicano -- MXN"></option>
                      <option value="Boliviano -- BOB"></option>
                      <option value="Peso Cubano -- CUP"></option>
                      <option value="Peso Filipino -- PHP"></option>
                    </datalist>
                    <label for="ch-moneda">Moneda</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-1 input-effect brx2">
                    <input id="ch-cheque1" class="efecto text-center" type="text">
                    <label for="ch-cheque1">Cheque</label>
                  </td>
                  <td class="col-md-1 input-effect brx2">
                    <input id="ch-importe" class="efecto text-center" type="text">
                    <label for="ch-importe">Importe</label>
                  </td>
                  <td class="col-md-3 input-effect brx2">
                    <input class=" efecto text-center data-date" type="text" onfocus="(this.type='date')" id="ch-fecha">
                    <label for="ch-fecha">Fecha</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="ch-rfcbenef" class="efecto text-center" type="text">
                    <label for="ch-rfcbenef">RCF</label>
                  </td>
                  <td class="col-md-5 input-effect brx2">
                    <input id="ch-nombrebenef" class="efecto text-center" type="text">
                    <label for="ch-nombrebenef">Nombre Beneficiario</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>

        <div id="capturapoliza" class="contorno-mov compext"><!--solo aparece al seleccionar Comprobante Extranjero-->
          <form class="form1">
            <table class="table text-center">
              <thead style="font-size: 18px;font-weight: 100;">
                <tr class="row m-0 tRepo2">
                  <td class="col-md-12">Comprobante Extranjero</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0">
                  <td class="col-md-4 input-effect brx2">
                    <input id="comext-tax" class="efecto text-center" type="text">
                    <label for="comext-tax">Tax ID</label>
                  </td>
                  <td class="col-md-8 input-effect brx2">
                    <input id="comext-razsocial" class="efecto text-center" type="text">
                    <label for="comext-razsocial">Nombre / Razón Social</label>
                  </td>
                </tr>

                <tr class="row m-0">
                  <td class="col-md-3 input-effect brx2">
                    <input id="comext-fact" class="efecto text-center" type="text">
                    <label for="comext-fact">Número de Factura</label>
                  </td>
                  <td class="col-md-5 input-effect brx2">
                    <input  list="comext-mon" class="text-normal efecto text-center"  id="comext-moneda">
                    <datalist id="comext-mon">
                      <option value="Peso Mexicano -- MXN"></option>
                      <option value="Peso Cubano -- CUP"></option>
                      <option value="Boliviano -- BOB"></option>
                      <option value="Peso Filipino -- PHP"></option>
                    </datalist>
                    <label for="comext-moneda">Seleccione una Cuenta</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="comext-tc" class="efecto text-center" type="text">
                    <label for="comext-tc">Tipo de Cambio</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="comext-total" class="efecto text-center" type="text">
                    <label for="comext-total">Total</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>

        <div id="capturapoliza" class="contorno-mov otro"><!--solo aparece al seleccionar Otro-->
          <form class="form1">
            <table class="table text-center">
              <thead style="font-size: 18px;font-weight: 100;">
                <tr class="row m-0 tRepo2">
                  <td class="col-md-12">Otro</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0">
                  <td class="col-md-3 input-effect brx2">
                    <input  list="otr-metpago" class="text-normal efecto text-center" id="otr-pago">
                    <datalist id="otr-metpago">
                      <option value="Bienes -- 09"></option>
                      <option value="Cancelacion -- 16"></option>
                      <option value="Compesacion -- 17"></option>
                      <option value="Dacion en Pago -- 12"></option>
                    </datalist>
                    <label for="otr-pago">Metodo Pago</label>
                  </td>
                  <td class="col-md-3 input-effect brx2">
                    <input id="otr-rfc" class="efecto text-center" type="text">
                    <label for="otr-rfc">RFC</label>
                  </td>
                  <td class="col-md-6 input-effect brx2">
                    <input id="otr-benef" class="efecto text-center" type="text">
                    <label for="otr-benef">Beneficiario</label>
                  </td>
                </tr>

                <tr class="row m-0">
                  <td class="col-md-3 input-effect brx2">
                    <input class=" efecto text-center data-date" type="text" onfocus="(this.type='date')" id="otr-fecha">
                    <label for="otr-fecha">Fecha</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="otr-imp" class="efecto text-center" type="text">
                    <label for="otr-imp">Importe</label>
                  </td>
                  <td class="col-md-5 input-effect brx2">
                    <input  list="otr-mon" class="text-normal efecto text-center"  id="otr-moneda">
                    <datalist id="otr-mon">
                      <option value="Peso Mexicano -- MXN"></option>
                      <option value="Boliviano -- BOB"></option>
                      <option value="Peso Cubano -- CUP"></option>
                      <option value="Peso Filipino -- PHP"></option>
                    </datalist>
                    <label for="otr-moneda">Moneda</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="otr-tc" class="efecto text-center" type="text">
                    <label for="otr-tc">Tipo de Cambio</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>

        <div id="capturapoliza" class="contorno-mov transferencia"><!--solo aparece al seleccionar Transferencia-->
          <form class="form1">
            <table class="table text-center">
              <thead style="font-size: 18px;font-weight: 100;">
                <tr class="row m-0 tRepo2">
                  <td class="col-md-12">Transferencia</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0">
                  <td class="col-md-6 input-effect brx2">
                    <input  list="transf-bsat" class="efecto input-dpol input-control text-center"  id="transf-bancossat">
                    <datalist id="transf-bsat">
                      <option value="Afirme"></option>
                      <option value="American Express"></option>
                      <option value="Azteca"></option>
                      <option value="Banamex"></option>
                      <option value="Bancopel"></option>
                    </datalist>
                    <label for="transf-bancossat">BANCOS SAT</label>
                  </td>

                  <td class="col-md-6 input-effect brx2">
                    <input list="transf-bplaa" class="efecto input-dpol input-control text-center"  id="transf-bancosplaa">
                    <datalist id="transf-bplaa">
                      <option value="BBVA BANCOMER -- 0109722246 -- 430"></option>
                      <option value="BBVA BANCOMER -- 0166627773 -- 430"></option>
                      <option value="BBVA BANCOMER -- 0166795056 -- 160"></option>
                      <option value="BBVA BANCOMER -- 166721346 -- 470"></option>
                      <option value="BBVA BANCOMER -- 0192655497 -- 240"></option>
                    </datalist>
                    <label for="transf-bancosplaa">BANCOS PLAA</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-6 input-effect brx2">
                    <input  list="transf-ben" class="efecto input-dpol input-control text-center"  id="transf-benef">
                    <datalist id="transf-ben">
                      <option value="Administracion Portuaria Integral de Manzanillo SA de CV -- API931215862 -- SANTANDER -- 014095655008263897"></option>
                      <option value="AAADAM A.C -- AAA8711107K5 -- BANAMEX -- 2801662"></option>
                    </datalist>
                    <label for="transf-benef">BANCOS BENEFICIARIOS</label>
                  </td>

                  <td class="col-md-6 input-effect brx2">
                    <input  list="transf-cli" class="efecto input-dpol input-control text-center"  id="transf-clientes">
                    <datalist id="transf-cli">
                      <option value="Fabricaciones Industriales Computarizadas SA de CV -- FIC980227TCA -- BANORTE -- 1260"></option>
                      <option value="Geiko Maiko Industrial S.A de C.V -- GMI120928KU4 -- BBVA BANCOMER -- 2554"></option>
                    </datalist>
                    <label for="transf-clientes">BANCOS CLIENTES</label>
                  </td>
                </tr>

                <tr class="row m-0">
                  <td class="col-md-6 input-effect brx2">
                    <input  list="transf-emp" class="efecto input-dpol input-control text-center"  id="transf-empleados">
                    <datalist id="transf-emp">
                      <option value="PINALES AVALOS -- PIAA911122Lp2 -- BANAMEX -- 5256781310675298"></option>
                      <option value="MARTINEZ MARTINEZ -- MAMD800330DQ3 -- BBVA BANCOMER -- 012821015214161544"></option>
                    </datalist>
                    <label for="transf-empleados">EMPLEADOS</label>
                  </td>

                  <td class="col-md-6 input-effect brx2">
                    <input  list="transf-prov" class="efecto input-dpol input-control text-center"  id="transf-proveedores">
                    <datalist id="transf-prov">
                      <option value="Control Integrado de Tratamiendos Cuarentenarios y Plagas S.A de C.V -- CIT0010198Y0 -- 012821001069756749"></option>
                      <option value="Banco Monex S.A Institución de Banca Multiple, Mone Grupo Financiero -- BMI9704113pa -- 6580894"></option>
                    </datalist>
                    <label for="transf-proveedores">PROVEEDORES</label>
                  </td>

                </tr>
                <tr class="row m-0">
                  <th class="col-md-1 iap brx1 text-center">BANCO</th>
                  <th class="col-md-4 iap brx1 text-center">NO. CUENTA / INTERBANCARIA</th>
                  <th class="col-md-5 iap brx1 text-center">NOMBRE / RAZON SOCIAL</th>
                  <th class="col-md-2 iap brx1 text-center">RFC</th>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-1">
                    <input class="input-dpol input-control dpol noborder" type="text" value="012">
                  </td>
                  <td class="col-md-4">
                    <input class="input-dpol input-control" type="text" value="012821011521461544">
                  </td>
                  <td class="col-md-5">
                    <input  class="input-dpol input-control" type="text" value="Martinez Martinez">
                  </td>
                  <td class="col-md-2">
                    <input class="input-dpol input-control" type="text" value="MAMD800330DQ3">
                  </td>
                </tr>

                <tr class="row m-0">
                  <td class="col-md-4 brx1"></td>
                  <td class="col-md-2 brx1">
                    <button type="button" class="btn">
                      <i class="fa fa-plus-circle"></i> ORIGEN
                    </button>
                  </td>
                  <td class="col-md-2 brx1">
                    <button  type="button" class="btn">
                      <i class="fa fa-plus-circle"></i> DESTINO
                    </button>
                  </td>
                  <td class="col-md-4 brx1"></td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-12 sub brx1">Origen</td>
                </tr>
                <tr class="row m-0">
                  <th class="col-md-1 text-center sub2">BANCO</th>
                  <th class="col-md-4 text-center sub2">NO. CUENTA / INTERBANCARIA</th>
                  <th class="col-md-4 text-center sub2">NOMBRE / RAZON SOCIAL (opcional)</th>
                  <th class="col-md-3 text-center sub2">RFC (opcional)</th>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-1">
                    <input class="input-dpol input-control dpol noborder" type="text" value="012">
                  </td>
                  <td class="col-md-4">
                    <input class="input-dpol input-control" type="text" value="012821011521461544">
                  </td>
                  <td class="col-md-4">
                    <input  class="input-dpol input-control" type="text" value="Martinez Martinez">
                  </td>
                  <td class="col-md-3">
                    <input class="input-dpol input-control" type="text" value="MAMD800330DQ3">
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-12 sub">Destino</td>
                </tr>
                <tr class="row m-0">
                  <th class="col-md-1 text-center sub2">BANCO</th>
                  <th class="col-md-4 text-center sub2">NO. CUENTA / INTERBANCARIA</th>
                  <th class="col-md-4 text-center sub2">NOMBRE / RAZON SOCIAL</th>
                  <th class="col-md-3 text-center sub2">RFC</th>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-1">
                    <input class="input-dpol input-control dpol noborder" type="text" value="012">
                  </td>
                  <td class="col-md-4">
                    <input class="input-dpol input-control" type="text" value="012821011521461544">
                  </td>
                  <td class="col-md-4">
                    <input  class="input-dpol input-control" type="text" value="Martinez Martinez">
                  </td>
                  <td class="col-md-3">
                    <input class="input-dpol input-control" type="text" value="MAMD800330DQ3">
                  </td>
                </tr>

                <tr class="row m-0">
                  <td class="col-md-2 input-effect brx2">
                    <input id="trans-emext" class="efecto input-dpol input-control text-center" type="text">
                    <label for="trans-emext">Bco. Emisor Extranjero</label>
                  </td>

                  <td class="col-md-3 input-effect brx2">
                    <input id="trans-desext" class="efecto input-dpol input-control text-center" type="text">
                    <label for="trans-desext">Bco. Destino Extranjero</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="trans-tc" class="efecto input-dpol input-control text-center" type="text">
                    <label for="trans-tc">Tipo de Cambio</label>
                  </td>
                  <td class="col-md-5 input-effect brx2">
                    <input  list="trans-mon" class="efecto input-dpol input-control text-center"  id="trans-moneda">
                    <datalist id="trans-mon">
                      <option value="Peso Mexicano -- MXN"></option>
                      <option value="Boliviano -- BOB"></option>
                      <option value="Peso Cubano -- CUP"></option>
                      <option value="Peso Filipino -- PHP"></option>
                    </datalist>
                    <label for="trans-moneda">Moneda</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-3 input-effect brx2">
                    <input class=" efecto input-dpol input-control text-center" type="text" onfocus="(this.type='date')" id="trans-fecha">
                    <label for="trans-fecha">Fecha</label>
                  </td>
                  <td class="col-md-2 input-effect brx2">
                    <input id="trans-imp" class="efecto input-dpol input-control text-center" type="text">
                    <label for="trans-imp">Importe</label>
                  </td>
                  <td class="col-md-7 input-effect brx2">
                    <input id="trans-observ" class="efecto input-dpol input-control text-center" type="text">
                    <label for="trans-observ">Observaciones</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>


        <div class="container-fluid xl brx2">
          <form>
            <table class="notable">
              <tbody>
                <tr class="table-bordered">
                  <th class="sub text-center" colspan="3"></th>
                  <th class="sub text-center">Tipo</th>
                  <th class="sub text-center" colspan="4">Cuenta</th>
                  <th class="sub text-center" colspan="10">Descripcion</th>
                  <th class="sub text-center" colspan="2">Cargo</th>
                  <th class="sub text-center" colspan="2">Abono</th>
                  <th class="sub text-center"></th>
                </tr>
                <tr>
                  <td colspan="3"></td>
                  <td>
                    <input class="input-dpol form-control  noborder" type="text" readonly value="4">
                  </td>
                  <td colspan="4">
                    <input class="input-dpol form-control  noborder" type="text" readonly value="0206-00929">
                  </td>
                  <td colspan="10">
                    <input class="input-dpol form-control  noborder" type="text" readonly value="Servicio Ancira Garza S.A de C.V">
                  </td>
                  <td colspan="2">
                    <input class="input-dpol form-control  noborder" type="text" readonly value="$3,000">
                  </td>
                  <td colspan="2">
                    <input class="input-dpol form-control  noborder" type="text" readonly value="0.00">
                  </td>
                  <td class="text-center">
                    <a href="">
                      <img class="icochico" src="/conta6/Resources/iconos/001-add.svg">
                    </a>
                  </td>
                </tr>
                <tr class="table-bordered">
                  <th class="sub text-center" colspan="3"></th>
                  <th class="sub text-center" colspan="2">Origen</th>
                  <th class="sub text-center" colspan="2">Destino</th>
                  <th class="sub text-center" colspan="8">Documento Nacional</th>
                  <th class="sub text-center" colspan="2">Extranjero</th>
                  <th class="sub text-center" colspan="3">Doc.Extranjero</th>
                  <th class="sub text-center" colspan="3">Opcionales</th>
                </tr>

                <tr>
                  <th class="iap text-center" colspan="2"></th>
                  <th class="iap text-center">Metodo</th>
                  <th class="iap text-center">Banco</th>
                  <th class="iap text-center">Cuenta</th>
                  <th class="iap text-center">Banco</th>
                  <th class="iap text-center">Cuenta</th>
                  <th class="iap text-center">UUID</th>
                  <th class="iap text-center">Cheque</th>
                  <th class="iap text-center">Serie</th>
                  <th class="iap text-center">CFD/CBB</th>
                  <th class="iap text-center">Razon Social</th>
                  <th class="iap text-center">RFC</th>
                  <th class="iap text-center">Fecha</th>
                  <th class="iap text-center">Importe</th>
                  <th class="iap text-center">Banco</th>
                  <th class="iap text-center">Cuenta</th>
                  <th class="iap text-center">TaxID</th>
                  <th class="iap text-center">Moneda</th>
                  <th class="iap text-center">TC</th>
                  <th class="iap text-center">&nbsp;&nbsp;Beneficiario&nbsp;&nbsp;</th>
                  <th class="iap text-center">RFC</th>
                  <th class="iap text-center">Obser</th>
                </tr>
                <tr>
                  <td colspan="2">
                    <a href="">
                      <img class="icochico" src="/conta6/Resources/iconos/002-trash.svg">
                    </a>
                  </td>
                  <td class="text-center">CompNal</td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center">0084882-k202-op01-2344826181903kj</td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center">SAG950408LE8</td>
                  <td class="text-center"></td>
                  <td class="text-center">$3,000</td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center">MXN</td>
                  <td class="text-center">1</td>
                  <td class="text-center">Servicio Ancira Garza S.A de C.V</td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                </tr>
                <tr style="border-top:1px solid rgba(190, 91, 106, 0.33)">
                  <td colspan="2">
                    <a href="">
                      <img class="icochico" src="/conta6/Resources/iconos/002-trash.svg">
                    </a>
                  </td>
                  <td class="text-center">CompNal</td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center">0084882-k202-op01-2344826181903kj</td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center">SAG950408LE8</td>
                  <td class="text-center"></td>
                  <td class="text-center">$3,000</td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center">MXN</td>
                  <td class="text-center">1</td>
                  <td class="text-center">Servicio Ancira Garza S.A de C.V</td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div><!--Termina desplazamiento numero 3-->
    </div><!--/Termina contenedor-movible-->
  </div><!--/Termina continermov-->
</div><!--/Termina container-fluid movible-->



 <script src="js/Polizas.js"></script>
 <script src="/conta6/Ubicaciones/Contabilidad/js/contenedor-movible.js"></script>
 <script src="/conta6/Resources/bootstrap/js/bootstrap-checkbox-toggle.js"></script>
 <script src="/conta6/Ubicaciones/Contabilidad/js/OpcionesSelect.js"></script>

 <?php
 require_once('modales/EditarRegistro.php');
 require_once('modales/buscarFacturas.php');
  ?>
