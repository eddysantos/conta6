<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a class="nav-link visualizar" id="submenuMed" status="cerrado" accion="dtosch">DATOS DEL CHEQUE</a>
      </li>
    </ul>
  </div>
</div>

<div id="datoscheque" class="contorno mt-5" style="display:none"><!--Comienza DETALLE DATOS DE POLIZA-->
  <h5 class="titulo">DATOS DEL CHEQUE</h5>
  <form class="form1">
    <table class="table text-center">
      <thead>
        <tr class="row m-0 encabezado colorRosa">
          <td class="col-md-1">POLIZA</td>
          <td class="col-md-1">USUARIO</td>
          <td class="col-md-1">NO.CHEQUE</td>
          <td class="col-md-2">FECHA CHEQUE</td>
          <td class="col-md-1">IMPORTE</td>
          <td class="col-md-2">MODIFICACION</td>
          <td class="col-md-1">CANCELACION</td>
          <td class="col-md-2">NOTA</td>
          <td class="col-md-1">OFICINA</td>
        </tr>
      </thead>
      <tbody style="font-size:14px">
        <tr class="row m-0">
          <td class="col-md-1 pt-4">
            <input class="noborder" type="text" readonly value="234567">
          </td>
          <td class="col-md-1 pt-4">
            <input class="noborder" type="text" readonly value="Estefania">
          </td>
          <td class="col-md-1">
            <input class="efecto" type="text"  value="3345">
          </td>
          <td class="col-md-2">
            <input class="efecto" type="date">
          </td>
          <td class="col-md-1">
            <input class="efecto" type="text" value="$123,456">
          </td>
          <td class="col-md-2 pt-4">
            <input class="noborder" type="text" value="28-06-2017 14:24:58">
          </td>
          <td class="col-md-1 pt-4">
            <input class="noborder" type="text" readonly value="234577">
          </td>
          <td class="col-md-2 pt-4">
            <input class="noborder" type="text" value="Ninguna">
          </td>
          <td class="col-md-1 pt-4">
            <input class="noborder" type="text" readonly value="240">
          </td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-1 mt-4">
            <input id="ch-cuenta" class="efecto tiene-contenido" value="0100-00006" type="text">
            <label for="ch-cuenta">CUENTA</label>
          </td>
          <td class="col-md-6 input-effect mt-4">
            <input  list="ch-benef" class="efecto"  id="ch-beneficiario">
            <datalist id="ch-benef">
              <option value="SERVICIO NACIONAL DE SANIDAD, INOCUIDAD Y CALIDAD AGROALIMENTARIA -- SPM860820CF5"></option>
              <option value="CAMINOS Y PUENTES FEDERALES DE INGRESOS Y SERVICIOS CONEXOS -- CPF6307036N8"></option>
            </datalist>
            <label for="ch-beneficiario">SELECCIONE BENEFICIARIO</label>
          </td>
          <td class="col-md-5 mt-4">
            <input id="ch-concep" class="efecto tiene-contenido" value="CONCEPTO DE LA POLIZA CONCEPTO DE LA POLIZA" type="text">
            <label for="ch-concep">CONCEPTO</label>
          </td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-1 backpink pt-3">111</td>
          <td class="col-md-3 backpink pt-3">RAER8708025X3</td>
          <td class="col-md-7 backpink pt-3">ROSENDO ISAAC RANGEL ESTRADA</td>
          <td class="col-md-1 pt-1">
            <a href="" class="btn-block"> <img src= "/conta6/Resources/iconos/save.svg" class="icomediano"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div><!--/Termina DETALLE DATOS DE POLIZA-->

<div class="container-fluid movible mt-5">
  <nav>
    <ul class="nav nav-pills nav-fill w-100 m-15">
      <li class="nav-item">
        <a class="nav-link" id="pills">Captura Detalle de Cheque</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills">Detalle del Cheque</a>
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
            <thead style="font-size: 14px;">
              <tr class="row m-0 encabezado">
                <td class="col-md-12">CAPTURA DETALLE DE CHEQUE</td>
              </tr>
            </thead>
            <tbody class="cuerpo">
              <tr class="row m-0">
                <td class="col-md-10 input-effect mt-5">
                  <input  list="todascuentas" class="text-normal efecto"  id="detpol-cuenta">
                  <datalist id="todascuentas">
                    <option value="0206-00648 -- COMITE PARA EL FOMENTO Y PROTECCION PRECUARIA DEL ESTA DE NUEVO LEON A.C"></option>
                    <option value="0100-00011 ---- BANAMEX DLLS CTA.79033561 NLDO"></option>
                    <option value="0100-00012 ---- BANAMEX DLLS CTA.79033561 COMPLEMENTARIA NLDO"></option>
                    <option value="0206-00808 -- CÀMARA DE COMERCIO, SERVICIOS Y TURISMO EN PEQUEÑO DE LA CIUDAD DE MÉXICO"></option>
                    <option value="0100-00017 ---- BANAMEX CTA.7355485 NLDO"></option>
                  </datalist>
                  <label for="detpol-cuenta">Seleccione una Cuenta</label>
                </td>
                <td class="col-md-2 input-effect mt-5">
                  <input  list="gtoficina" class="text-normal efecto"  id="detpol-gtoficina">
                  <datalist id="gtoficina">
                    <option value="AEROPUERTO"></option>
                    <option value="MANZANILLO"></option>
                    <option value="NUEVO LAREDO"></option>
                    <option value="VERACRUZ"></option>
                  </datalist>
                  <label for="detpol-gtoficina">Gasto Oficina</label>
                </td>
              </tr>
              <tr class="row m-0">
                <td class="col-md-10 input-effect mt-4">
                  <input  list="clientes" class="text-normal efecto"  id="detpol-cliente">
                  <datalist id="clientes">
                    <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                    <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                  </datalist>
                  <label for="detpol-cliente">Cliente</label>
                </td>
                <td class="col-md-2 mt-4" role="button">
                  <a  href="#detpol-buscarfacturas" data-toggle="modal" class="boton btn-block text-center icochico"  style="border:none"> <img src= "/conta6/Resources/iconos/magnifier.svg"> Buscar Facturas</a>
                </td>
              </tr>

              <tr class="row m-0">
                <td class="col-md-12 input-effect mt-4">
                  <input  class="text-normal efecto"  id="detpol-concepto">
                  <label for="detpol-concepto">Concepto</label>
                </td>
              </tr>

              <tr class="row m-0">
                <td class="col-md-2 input-effect mt-4">
                  <input  class="text-normal efecto"  id="detpol-referencia">
                  <label for="detpol-referencia">Referencia</label>
                </td>
                <td class="col-md-2 input-effect mt-4">
                  <input  class="text-normal efecto"  id="detpol-documento">
                  <label for="detpol-documento">Documento</label>
                </td>
                <td class="col-md-2 input-effect mt-4">
                  <input  class="text-normal efecto"  id="detpol-factura">
                  <label for="detpol-factura">Factura</label>
                </td>
                <td class="col-md-2 input-effect mt-4">
                  <input  class="text-normal efecto"  id="detpol-anticipo">
                  <label for="detpol-anticipo">Anticipo</label>
                </td>
                <td class="col-md-2 input-effect mt-4">
                  <input  class="text-normal efecto"  id="detpol-cargo">
                  <label for="detpol-cargo">Cargo</label>
                </td>
                <td class="col-md-2 input-effect mt-4">
                  <input  class="text-normal efecto"  id="detpol-abono">
                  <label for="detpol-abono">Abono</label>
                </td>
              </tr>
              <tr class="row">
                <td class="col-md-2 offset-md-5 mt-4">
                  <a href="" class="boton btn-block mt-3"><img src= "/conta6/Resources/iconos/001-add.svg" class="icochico"> REGISTRAR</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row mt-3">
          <div class="col-md-2 offset-md-4 text-center">SUMA DE CARGOS</div>
          <div class="col-md-2 text-center">SUMA DE ABONOS</div>
        </div>
        <div class="row">
          <div class="col-md-2 offset-md-4 mt-3">
            <input  class="text-normal form-control efecto " value="$ 15, 932.08" readonly>
          </div>
          <div class="col-md-2 mt-3">
            <input  class="text-normal form-control efecto " value="$ 15, 932.08" readonly>
          </div>
        </div>
      </div>

      <div id="two" class="text-center"><!--DETALLE DE POLIZAS-->
        <div class="row">
          <div class="col-md-2 offset-md-8">SUMA DE CARGOS</div>
          <div class="col-md-2">SUMA DE ABONOS</div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <a href="#detpol-Sueldos" data-toggle="modal" class="text-normal boton btn-block"><img src= "/conta6/Resources/iconos/refresh-button.svg"> ACTUALIZAR CHEQUE</a>
          </div>
          <div class="col-md-3">
            <a href="#detpol-Honorarios" data-toggle="modal" class="text-normal boton btn-block"><img src= "/conta6/Resources/iconos/add.svg"> GENERAR POLIZA DE CHEQUE</a>
          </div>
          <div class="col-md-2">
            <a  class="boton btn-block" style="border:none"><img class="icomediano" src= "/conta6/Resources/iconos/printer.svg" style="border:none"></a>
          </div>
          <div class="col-md-2 mt-3">
            <input  class="text-normal form-control efecto" value="$ 15, 932.08" readonly>
          </div>
          <div class="col-md-2 mt-3">
            <input  class="text-normal form-control efecto" value="$ 15, 932.08" readonly>
          </div>
        </div>

        <div id="detallepoliza" class="contorno-mov mt-3">
          <table class="table table-hover text-center">
            <thead style="font-size: 14px;">
              <tr class="row encabezado m-0">
                <td class="col-md-12">DETALLE CHEQUE</td>
              </tr>
            </thead>
            <tbody>
              <tr class="row m-0 backpink">
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

              <tr class="row m-0 borderojo">
                <td class="xs">
                  <a href="">
                    <img class="icochico" src="/conta6/Resources/iconos/002-trash.svg">
                  </a>
                </td>
                <td class="small pt-3 p-0">0110-00001</td>
                <td class="small pt-3 p-0">2222</td>
                <td class="small pt-3 p-0">2222</td>
                <td class="small pt-3 p-0">CLT_7118</td>
                <td class="small pt-3 p-0">2222</td>
                <td class="small pt-3 p-0">2222</td>
                <td class="small pt-3 p-0">2222</td>
                <td class="small pt-3 p-0">2222</td>
                <td class="small pt-3 p-0">2222</td>
                <td class="small pt-3 p-0">2222</td>
                <td class="med pt-3 p-0">T.DE LA FED.PTO.7003459</td>
                <td class="small pt-3 p-0">111,133,299</td>
                <td class="small pt-3 p-0">33,299</td>
                <td class="xs">
                  <a href="#editarRegCheque" data-toggle="modal">
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
          <form class="form1">
            <table class="table text-center">
              <thead>
                <tr class="row m-0 encabezado font18">
                  <td class="col-md-12">CFD / CBB</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0">
                  <td class="col-md-2 input-effect mt-4">
                    <input id="dpol-rfc" class="efecto" type="text">
                    <label for="dpol-rfc">RFC</label>
                  </td>
                  <td class="col-md-6 input-effect mt-4">
                    <input id="dpol-razonsocial" class="efecto" type="text">
                    <label for="dpol-razonsocial">Razón Social</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="dpol-serie" class="efecto" type="text">
                    <label for="dpol-serie">Serie</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="dpol-folio" class="efecto" type="text">
                    <label for="dpol-folio">Folio</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-3 input-effect mt-4">
                    <input id="dpol-subtotal" class="efecto" type="text">
                    <label for="dpol-subtotal">Subtotal</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="dpol-iva" class="efecto" type="text">
                    <label for="dpol-iva">IVA</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="dpol-total" class="efecto" type="text">
                    <label for="dpol-total">Total</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="dpol-aplicar" class="efecto" type="text">
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
              <thead style="font-size: 14px" >
                <tr class="row encabezado m-0">
                  <td class="col-md-12">CFDI</td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-12 mt-3">
                    <input class="" type="file">
                  </td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0">
                  <td class="col-md-2 input-effect mt-3">
                    <input id="cfdi-rfc" class="efecto" type="text">
                    <label for="cfdi-rfc">RFC</label>
                  </td>
                  <td class="col-md-5 input-effect mt-3">
                    <input id="cfdi-razonsocial" class="efecto" type="text">
                    <label for="cfdi-razonsocial">Nombre / Razón Social</label>
                  </td>
                  <td class="col-md-5 input-effect mt-3">
                    <input id="cfdi-uuid" class="efecto" type="text">
                    <label for="cfdi-uuid">UUID</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-3 input-effect mt-4">
                    <input id="cfdi-subtotal" class="efecto" type="text">
                    <label for="cfdi-subtotal">Subtotal</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="cfdi-iva" class="efecto" type="text">
                    <label for="cfdi-iva">IVA</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="cfdi-total" class="efecto" type="text">
                    <label for="cfdi-total">Total</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="cfdi-aplicar" class="efecto" type="text">
                    <label for="cfdi-aplicar">Aplicar</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>

        <div id="capturapoliza" class="contorno-mov cheque"><!--solo aparece al seleccionar CHEQUES-->
          <form class="form1" method="post">
            <table class="table text-center">
              <thead style="font-size: 14px" >
                <tr class="row m-0 encabezado">
                  <td class="col-md-12">CHEQUES</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0 mt-1">
                  <td class="col-md-5 input-effect mt-4">
                    <input  list="ch-origen" class="text-normal efecto"  id="chorigen">
                    <datalist id="ch-origen">
                      <option value="Banamex - 002 - 7658424"></option>
                      <option value="Banamex - 002 - 79033561"></option>
                      <option value="Banamex - 002 - 7355485"></option>
                      <option value="Bancomer - 012 - 0192655497"></option>
                    </datalist>
                    <label for="chorigen">Seleccione una Cuenta (Origen)</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="ch-banco" class="efecto tiene-contenido" type="text" value="002">
                    <label for="ch-banco">Banco</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="ch-ncuenta" class="efecto tiene-contenido" type="text" value="7865432">
                    <label for="ch-ncuenta">No.Cuenta</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input  list="numcheques" class="text-normal efecto"  id="ch-cheques">
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
                  <td class="col-md-5 input-effect mt-4">
                    <input id="ch-emextran" class="efecto" type="text">
                    <label for="ch-emextran">Emisor Extranjero</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="ch-tc" class="efecto" type="text">
                    <label for="ch-tc">Tipo de Cambio</label>
                  </td>
                  <td class="col-md-5 input-effect mt-4">
                    <input  list="chmoneda" class="text-normal efecto"  id="ch-moneda">
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
                  <td class="col-md-1 input-effect mt-4">
                    <input id="ch-cheque1" class="efecto" type="text">
                    <label for="ch-cheque1">Cheque</label>
                  </td>
                  <td class="col-md-1 input-effect mt-4">
                    <input id="ch-importe" class="efecto" type="text">
                    <label for="ch-importe">Importe</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input class="efecto " type="text" onfocus="(this.type='date')" id="ch-fecha">
                    <label for="ch-fecha">Fecha</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="ch-rfcbenef" class="efecto" type="text">
                    <label for="ch-rfcbenef">RCF</label>
                  </td>
                  <td class="col-md-5 input-effect mt-4">
                    <input id="ch-nombrebenef" class="efecto" type="text">
                    <label for="ch-nombrebenef">Nombre Beneficiario</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>

        <div id="capturapoliza" class="contorno-mov compext"><!--solo aparece al seleccionar Comprobante Extranjero-->
          <form class="form1" method="post">
            <table class="table text-center">
              <thead style="font-size: 14px" >
                <tr class="row m-0 encabezado">
                  <td class="col-md-12">Comprobante Extranjero</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0 mt-1">
                  <td class="col-md-4 input-effect mt-4">
                    <input id="comext-tax" class="efecto" type="text">
                    <label for="comext-tax">Tax ID</label>
                  </td>
                  <td class="col-md-8 input-effect mt-4">
                    <input id="comext-razsocial" class="efecto" type="text">
                    <label for="comext-razsocial">Nombre / Razón Social</label>
                  </td>
                </tr>

                <tr class="row m-0">
                  <td class="col-md-3 input-effect mt-4">
                    <input id="comext-fact" class="efecto" type="text">
                    <label for="comext-fact">Número de Factura</label>
                  </td>
                  <td class="col-md-5 input-effect mt-4">
                    <input  list="comext-mon" class="text-normal efecto"  id="comext-moneda">
                    <datalist id="comext-mon">
                      <option value="Peso Mexicano -- MXN"></option>
                      <option value="Peso Cubano -- CUP"></option>
                      <option value="Boliviano -- BOB"></option>
                      <option value="Peso Filipino -- PHP"></option>
                    </datalist>
                    <label for="comext-moneda">Seleccione una Cuenta</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="comext-tc" class="efecto" type="text">
                    <label for="comext-tc">Tipo de Cambio</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="comext-total" class="efecto" type="text">
                    <label for="comext-total">Total</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>

        <div id="capturapoliza" class="contorno-mov otro"><!--solo aparece al seleccionar Otro-->
          <form class="form1" method="post">
            <table class="table text-center">
              <thead style="font-size: 14px" >
                <tr class="row m-0 encabezado">
                  <td class="col-md-12">Otro</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0 mt-1">
                  <td class="col-md-3 input-effect mt-4">
                    <input  list="otr-metpago" class="text-normal efecto"  id="otr-pago">
                    <datalist id="otr-metpago">
                      <option value="Bienes -- 09"></option>
                      <option value="Cancelacion -- 16"></option>
                      <option value="Compesacion -- 17"></option>
                      <option value="Dacion en Pago -- 12"></option>
                    </datalist>
                    <label for="otr-pago">Metodo Pago</label>
                  </td>
                  <td class="col-md-3 input-effect mt-4">
                    <input id="otr-rfc" class="efecto" type="text">
                    <label for="otr-rfc">RFC</label>
                  </td>
                  <td class="col-md-6 input-effect mt-4">
                    <input id="otr-benef" class="efecto" type="text">
                    <label for="otr-benef">Beneficiario</label>
                  </td>
                </tr>

                <tr class="row m-0">
                  <td class="col-md-3 input-effect mt-4">
                    <input class=" efecto " type="text" onfocus="(this.type='date')" id="otr-fecha">
                    <label for="otr-fecha">Fecha</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="otr-imp" class="efecto" type="text">
                    <label for="otr-imp">Importe</label>
                  </td>
                  <td class="col-md-5 input-effect mt-4">
                    <input  list="otr-mon" class="text-normal efecto"  id="otr-moneda">
                    <datalist id="otr-mon">
                      <option value="Peso Mexicano -- MXN"></option>
                      <option value="Boliviano -- BOB"></option>
                      <option value="Peso Cubano -- CUP"></option>
                      <option value="Peso Filipino -- PHP"></option>
                    </datalist>
                    <label for="otr-moneda">Moneda</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="otr-tc" class="efecto" type="text">
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
              <thead>
                <tr class="row m-0 encabezado font14">
                  <td class="col-md-12">Transferencia</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0 mt-1">
                  <td class="col-md-6 input-effect mt-4">
                    <input  list="transf-bsat" class="efecto input-dpol"  id="transf-bancossat">
                    <datalist id="transf-bsat">
                      <option value="Afirme"></option>
                      <option value="American Express"></option>
                      <option value="Azteca"></option>
                      <option value="Banamex"></option>
                      <option value="Bancopel"></option>
                    </datalist>
                    <label class="pt-1" for="transf-bancossat">BANCOS SAT</label>
                  </td>

                  <td class="col-md-6 input-effect mt-4">
                    <input  list="transf-bplaa" class="efecto input-dpol"  id="transf-bancosplaa">
                    <datalist id="transf-bplaa">
                      <option value="BBVA BANCOMER -- 0109722246 -- 430"></option>
                      <option value="BBVA BANCOMER -- 0166627773 -- 430"></option>
                      <option value="BBVA BANCOMER -- 0166795056 -- 160"></option>
                      <option value="BBVA BANCOMER -- 166721346 -- 470"></option>
                      <option value="BBVA BANCOMER -- 0192655497 -- 240"></option>
                    </datalist>
                    <label class="pt-1" for="transf-bancosplaa">BANCOS PLAA</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-6 input-effect mt-4">
                    <input  list="transf-ben" class="efecto input-dpol"  id="transf-benef">
                    <datalist id="transf-ben">
                      <option value="Administracion Portuaria Integral de Manzanillo SA de CV -- API931215862 -- SANTANDER -- 014095655008263897"></option>
                      <option value="AAADAM A.C -- AAA8711107K5 -- BANAMEX -- 2801662"></option>
                    </datalist>
                    <label class="pt-1" for="transf-benef">BANCOS BENEFICIARIOS</label>
                  </td>
                  <td class="col-md-6 input-effect mt-4">
                    <input  list="transf-cli" class="efecto input-dpol"  id="transf-clientes">
                    <datalist id="transf-cli">
                      <option value="Fabricaciones Industriales Computarizadas SA de CV -- FIC980227TCA -- BANORTE -- 1260"></option>
                      <option value="Geiko Maiko Industrial S.A de C.V -- GMI120928KU4 -- BBVA BANCOMER -- 2554"></option>
                    </datalist>
                    <label class="pt-1" for="transf-clientes">BANCOS CLIENTES</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-6 input-effect mt-4">
                    <input  list="transf-emp" class="efecto input-dpol"  id="transf-empleados">
                    <datalist id="transf-emp">
                      <option value="PINALES AVALOS -- PIAA911122Lp2 -- BANAMEX -- 5256781310675298"></option>
                      <option value="MARTINEZ MARTINEZ -- MAMD800330DQ3 -- BBVA BANCOMER -- 012821015214161544"></option>
                    </datalist>
                    <label class="pt-1" for="transf-empleados">EMPLEADOS</label>
                  </td>

                  <td class="col-md-6 input-effect mt-4">
                    <input  list="transf-prov" class="efecto input-dpol"  id="transf-proveedores">
                    <datalist id="transf-prov">
                      <option value="Control Integrado de Tratamiendos Cuarentenarios y Plagas S.A de C.V -- CIT0010198Y0 -- 012821001069756749"></option>
                      <option value="Banco Monex S.A Institución de Banca Multiple, Mone Grupo Financiero -- BMI9704113pa -- 6580894"></option>
                    </datalist>
                    <label class="pt-1" for="transf-proveedores">PROVEEDORES</label>
                  </td>
                </tr>
                <tr class="row m-0 backpink mt-3">
                  <th class="col-md-1">BANCO</th>
                  <th class="col-md-4">NO. CUENTA / INTERBANCARIA</th>
                  <th class="col-md-5">NOMBRE / RAZON SOCIAL</th>
                  <th class="col-md-2">RFC</th>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-1">
                    <input class="noborder" type="text" value="012">
                  </td>
                  <td class="col-md-4">
                    <input class="input-control p-1 text-center" type="text" value="012821011521461544">
                  </td>
                  <td class="col-md-5">
                    <input  class="input-control p-1 text-center" type="text" value="Martinez Martinez">
                  </td>
                  <td class="col-md-2">
                    <input class="input-control p-1 text-center" type="text" value="MAMD800330DQ3">
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-4 mt-3"></td>
                  <td class="col-md-2 mt-3">
                    <button  type="button" class="btn">
                      <i class="fa fa-plus-circle"></i> ORIGEN
                    </button>
                  </td>
                  <td class="col-md-2 mt-3">
                    <button  type="button" class="btn">
                      <i class="fa fa-plus-circle"></i> DESTINO
                    </button>
                  </td>
                  <td class="col-md-4 mt-3"></td>
                </tr>
                <tr class="row m-0 mt-3 sub">
                  <td class="col-md-12">Origen</td>
                </tr>
                <tr class="row m-0 sub2">
                  <th class="col-md-1">BANCO</th>
                  <th class="col-md-4">NO. CUENTA / INTERBANCARIA</th>
                  <th class="col-md-4">NOMBRE / RAZON SOCIAL (opcional)</th>
                  <th class="col-md-3">RFC (opcional)</th>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-1">
                    <input class="noborder" type="text" value="012">
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
                <tr class="row m-0 sub2">
                  <th class="col-md-1">BANCO</th>
                  <th class="col-md-4">NO. CUENTA / INTERBANCARIA</th>
                  <th class="col-md-4">NOMBRE / RAZON SOCIAL</th>
                  <th class="col-md-3">RFC</th>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-1">
                    <input class="noborder" type="text" value="012">
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
                  <td class="col-md-3 input-effect mt-4">
                    <input id="trans-emext" class="efecto input-dpol" type="text">
                    <label class="pt-1" for="trans-emext">Bco. Emisor Extranjero</label>
                  </td>

                  <td class="col-md-3 input-effect mt-4">
                    <input id="trans-desext" class="efecto input-dpol" type="text">
                    <label class="pt-1" for="trans-desext">Bco. Destino Extranjero</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="trans-tc" class="efecto input-dpol" type="text">
                    <label class="pt-1" for="trans-tc">Tipo de Cambio</label>
                  </td>
                  <td class="col-md-4 input-effect mt-4">
                    <input  list="trans-mon" class="efecto input-dpol"  id="trans-moneda">
                    <datalist id="trans-mon">
                      <option value="Peso Mexicano -- MXN"></option>
                      <option value="Boliviano -- BOB"></option>
                      <option value="Peso Cubano -- CUP"></option>
                      <option value="Peso Filipino -- PHP"></option>
                    </datalist>
                    <label class="pt-1" for="trans-moneda">Moneda</label>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-3 input-effect mt-4">
                    <input class=" efecto input-dpol" type="text" onfocus="(this.type='date')" id="trans-fecha">
                    <label class="pt-1" for="trans-fecha">Fecha</label>
                  </td>
                  <td class="col-md-2 input-effect mt-4">
                    <input id="trans-imp" class="efecto input-dpol" type="text">
                    <label class="pt-1" for="trans-imp">Importe</label>
                  </td>
                  <td class="col-md-7 input-effect mt-4">
                    <input id="trans-observ" class="efecto input-dpol" type="text">
                    <label class="pt-1" for="trans-observ">Observaciones</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>


        <div class="container-fluid xl mt-4">
          <form>
            <table class="notable text-center">
              <tbody>
                <tr class="table-bordered sub">
                  <th colspan="3"></th>
                  <th>Tipo</th>
                  <th colspan="4">Cuenta</th>
                  <th colspan="10">Descripcion</th>
                  <th colspan="2">Cargo</th>
                  <th colspan="2">Abono</th>
                  <th></th>
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
                <tr class="table-bordered sub">
                  <th colspan="3"></th>
                  <th colspan="2">Origen</th>
                  <th colspan="2">Destino</th>
                  <th colspan="8">Documento Nacional</th>
                  <th colspan="2">Extranjero</th>
                  <th colspan="3">Doc.Extranjero</th>
                  <th colspan="3">Opcionales</th>
                </tr>

                <tr class="backpink">
                  <th colspan="2"></th>
                  <th>Metodo</th>
                  <th>Banco</th>
                  <th>Cuenta</th>
                  <th>Banco</th>
                  <th>Cuenta</th>
                  <th>UUID</th>
                  <th>Cheque</th>
                  <th>Serie</th>
                  <th>CFD/CBB</th>
                  <th>Razon Social</th>
                  <th>RFC</th>
                  <th>Fecha</th>
                  <th>Importe</th>
                  <th>Banco</th>
                  <th>Cuenta</th>
                  <th>TaxID</th>
                  <th>Moneda</th>
                  <th>TC</th>
                  <th>&nbsp;&nbsp;Beneficiario&nbsp;&nbsp;</th>
                  <th>RFC</th>
                  <th>Obser</th>
                </tr>
                <tr>
                  <td colspan="2">
                    <a href="">
                      <img class="icochico" src="/conta6/Resources/iconos/002-trash.svg">
                    </a>
                  </td>
                  <td>CompNal</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>0084882-k202-op01-2344826181903kj</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>SAG950408LE8</td>
                  <td></td>
                  <td>$3,000</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>MXN</td>
                  <td>1</td>
                  <td>Servicio Ancira Garza S.A de C.V</td>
                  <td></td>
                  <td></td>
                </tr>
                <tr style="border-top:1px solid rgba(190, 91, 106, 0.33)">
                  <td colspan="2">
                    <a href="">
                      <img class="icochico" src="/conta6/Resources/iconos/002-trash.svg">
                    </a>
                  </td>
                  <td>CompNal</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>0084882-k202-op01-2344826181903kj</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>SAG950408LE8</td>
                  <td></td>
                  <td>$3,000</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>MXN</td>
                  <td>1</td>
                  <td>Servicio Ancira Garza S.A de C.V</td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div><!--Termina desplazamiento numero 3-->
    </div><!--/Termina contenedor-movible-->
  </div><!--/Termina continermov-->
</div><!--/Termina container-fluid movible-->



<footer>
  <script src="js/Cheques.js"></script>
  <script src="/conta6/Ubicaciones/Contabilidad/js/contenedor-movible.js"></script>
  <script src="/conta6/Ubicaciones/Contabilidad/js/OpcionesSelect.js"></script>
  <script src="/conta6/Resources/bootstrap/js/bootstrap-checkbox-toggle.js"></script>

  <?php
    require_once('modales/editarRegistro.php');
    require_once('modales/buscarFacturas.php');
   ?>
</footer>
