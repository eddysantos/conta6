<?php
//LISTA DE MONEDAS
require $root . '/conta6/Resources/PHP/actions/consultaMoneda.php'; #$consultaMoneda
require $root . '/conta6/Resources/PHP/actions/lst_conta_cs_sat_formapago.php'; #  $consultaFormapago
?>
<?php if( $oRst_permisos['s_modificar_contaElect'] == 1 ){ ?>
<div id="three"><!--INFORMACION DE LA PARTIDA-->
  <form class="opcion">
    <table class="table">
      <tr class="row justify-content-center m-0">
        <td class="col-md-4">
          <select class="custom-select" id="opcionespolizas">
            <option >Selecciona</option>
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
<?php } ?>
  <!--solo aparece al seleccionar CFD / CBB-->
  <!--div id="capturapoliza" class="contorno-mov cfdcbb">
    <table class="table form1">
      <thead>
        <tr class="row m-0 encabezado font18">
          <td class="col-md-12">CFD / CBB</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row m-0 mt-4">
          <td class="col-md-2 input-effect">
            <input id="dpol-rfc" class="efecto" type="text">
            <label for="dpol-rfc">RFC</label>
          </td>
          <td class="col-md-6 input-effect">
            <input id="dpol-razonsocial" class="efecto" type="text">
            <label for="dpol-razonsocial">Razón Social</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="dpol-serie" class="efecto" type="text">
            <label for="dpol-serie">Serie</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="dpol-folio" class="efecto" type="text">
            <label for="dpol-folio">Folio</label>
          </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-md-3 input-effect">
            <input id="dpol-subtotal" class="efecto" type="text">
            <label for="dpol-subtotal">Subtotal</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="dpol-iva" class="efecto" type="text">
            <label for="dpol-iva">IVA</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="dpol-total" class="efecto" type="text">
            <label for="dpol-total">Total</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="dpol-aplicar" class="efecto" type="text">
            <label for="dpol-aplicar">Aplicar</label>
          </td>
        </tr>
      </tbody>
    </table>
  </div-->

  <div id="capturapoliza" class="contorno cfdi"><!--solo aparece al seleccionar CFDI-->
    <table class="table form1">
      <thead>
        <tr class="row encabezado m-0 font18">
          <td class="col-md-12">CFDI</td>
        </tr>
        <tr class="row m-0 mt-3 justify-content-center">
          <td class="col-md-4 custom-file">
            <input type="file" class="custom-file-input" id="archivo" onChange="processFiles(this.files)">
            <label class="custom-file-label" for="customFile">Selecciona un archivo</label>
          </td>
          <td class="col-md-12 m-3 p-0">
            <div class="m-2 b p-2 sub2" id="datosUUID"></div>
          </td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row m-0 mt-3">
          <td class="col-md-2 input-effect">
            <input id="cfdi-rfc" class="efecto tiene-contenido" type="text" onchange="eliminaBlancosIntermedios(this);todasMayusculas(this);validaRFC(this);">
            <label for="cfdi-rfc">RFC</label>
          </td>
          <td class="col-md-5 input-effect">
            <input id="cfdi-razonsocial" class="efecto tiene-contenido" type="text" onchange="eliminaBlancosIntermedios(this);todasMayusculas(this);">
            <label for="cfdi-razonsocial">Nombre / Razón Social</label>
          </td>
          <td class="col-md-5 input-effect">
            <input id="cfdi-uuid" class="efecto tiene-contenido" type="text" onchange="eliminaBlancosIntermedios(this);">
            <label for="cfdi-uuid">UUID</label>
          </td>
        </tr>
        <tr class="row m-0 align-items-center">
          <td class="col-md-2 input-effect mt-4">
            <input id="cfdi-subtotal" class="efecto tiene-contenido" type="text" value="0" onchange="validaIntDec(this);">
            <label for="cfdi-subtotal">Subtotal</label>
          </td>
          <td class="col-md-2 input-effect mt-4">
            <input id="cfdi-ivatrasladado" class="efecto tiene-contenido" type="text" value="0" onchange="validaIntDec(this);">
            <label for="cfdi-ivatrasladado">IVA Trasladado</label>
          </td>
          <td class="col-md-2 input-effect mt-4">
            <input id="cfdi-ivaretenido" class="efecto tiene-contenido" type="text" value="0" onchange="validaIntDec(this);">
            <label for="cfdi-ivaretenido">IVA Retenido</label>
          </td>
          <td class="col-md-2 input-effect mt-4">
            <input id="cfdi-isrretenido" class="efecto tiene-contenido" type="text" value="0" onchange="validaIntDec(this);">
            <label for="cfdi-isrretenido">ISR Retenido</label>
          </td>
          <td class="col-md-2 input-effect mt-4">
            <input id="cfdi-total" class="efecto tiene-contenido" type="text" value="0" onchange="validaIntDec(this);">
            <label for="cfdi-total">Total</label>
            <input id="cfdi-moneda" type="hidden" value="">
            <input id="cfdi-tc" type="hidden" value="">
          </td>
          <td class="col-md-2">
            <label class="mb-1" style="color: #d59f9f;">Aplicar</label>
            <select class="custom-select tiene-contenido" id="cfdi-aplicar">
              <option value="iva">IVA Trasladado</option>
          		<option value="ivaRet">IVA Retenido</option>
          		<option value="isr">ISR Retenido</option>
          		<option value="subtotal">Subtotal</option>
          		<option selected="selected" value="total">Total</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="capturapoliza" class="contorno cheque"><!--solo aparece al seleccionar CHEQUES-->
    <table class="table form1">
      <thead>
        <tr class="row m-0 encabezado font18">
          <td class="col-md-12">CHEQUES</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row m-0 mt-4 justify-content-center">
          <td class="col-md-5 input-effect">
            <input class="efecto popup-input" id="ch-origen" type="text" id-display="#popup-display-ch-origen" action="cuentas_mst_0100_oficina" db-id="" autocomplete="off">
          	<div class="popup-list" id="popup-display-ch-origen" style="display:none"></div>
          	<label for="ch-origen">Seleccione una Cuenta (Origen)</label>
          </td>
          <td class="col-md-2 input-effect">
            <input list="numcheques" class="efecto" id="ch-cheques">
            <datalist id="numcheques">
            </datalist>
            <label for="ch-cheques">Cheques</label>
          </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-md-5 input-effect">
            <input id="ch-emextran" class="efecto" type="text" onchange="eliminaBlancosIntermedios(this);" autocomplete="off">
            <label for="ch-emextran">* Banco Emisor Extranjero</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="ch-tc" class="efecto" type="text" onchange="validaIntDec(this);" autocomplete="off">
            <label for="ch-tc">* Tipo de Cambio</label>
          </td>
          <td class="col-md-5 input-effect">
            <select class="custom-select" name="chmoneda" id="ch-moneda">
              <?php echo $consultaMoneda; ?>
            </select>
          </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-md-1 input-effect">
            <input id="ch-cheque1" class="efecto h22 tiene-contenido" type="text" disabled>
            <label for="ch-cheque1">Cheque</label>
          </td>
          <td class="col-md-1 input-effect">
            <input id="ch-importe" class="efecto h22 tiene-contenido" type="text" disabled>
            <label for="ch-importe">Importe</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto h22 tiene-contenido" type="date" id="ch-fecha" disabled>
            <label for="ch-fecha">Fecha</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="ch-rfcbenef" class="efecto h22 tiene-contenido" type="text" disabled>
            <label for="ch-rfcbenef">RCF</label>
          </td>
          <td class="col-md-5 input-effect">
            <input id="ch-nombrebenef" class="efecto h22 tiene-contenido" type="text" disabled>
            <label for="ch-nombrebenef">Nombre Beneficiario</label>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="capturapoliza" class="contorno compext"><!--solo aparece al seleccionar Comprobante Extranjero-->
    <table class="table form1">
      <thead>
        <tr class="row m-0 encabezado font18">
          <td class="col-md-12">Comprobante Extranjero</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row m-0 mt-4">
          <td class="col-md-4 input-effect">
            <input id="comext-tax" class="efecto" type="text" onchange="todasMayusculas(this);eliminaBlancosIntermedios(this);" autocomplete="off">
            <label for="comext-tax">Tax ID</label>
          </td>
          <td class="col-md-8 input-effect">
            <input id="comext-razsocial" class="efecto" type="text" onchange="todasMayusculas(this);eliminaBlancosIntermedios(this);" autocomplete="off">
            <label for="comext-razsocial">Nombre / Razón Social</label>
          </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-md-3 input-effect">
            <input id="comext-fact" class="efecto" type="text" onchange="eliminaBlancosIntermedios(this);" autocomplete="off">
            <label for="comext-fact">Número de Factura</label>
          </td>
          <td class="col-md-5 input-effect">
            <select id="comext-moneda" class="custom-select" name="comext-mon">
              <?php echo $consultaMoneda; ?>
            </select>
          </td>
          <td class="col-md-2 input-effect">
            <input id="comext-tc" class="efecto" type="text" onchange="validaIntDec(this);" autocomplete="off">
            <label for="comext-tc">Tipo de Cambio</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="comext-total" class="efecto" type="text" onchange="validaIntDec(this);" autocomplete="off">
            <label for="comext-total">Total</label>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="capturapoliza" class="contorno otro"><!--solo aparece al seleccionar Otro-->
    <form class="form1">
      <table class="table ">
        <thead>
          <tr class="row m-0 encabezado font18">
            <td class="col-md-12">Otro</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row m-0 mt-4 justify-content-center">
            <td class="col-md-3 input-effect">
              <select id="otr-pago" class="custom-select" name="otr-metpago">
                <?php echo $consultaFormapago; ?>
              </select>
              <input type="hidden" id="pagadoA">
            </td>
          </tr>
          <tr class="row mt-3 m-0">
            <td class="col-md-12 sub2" style="font-size:14px!important">Pagado a la orden de:</td>
          </tr>
          <tr class="row m-0 mt-1">
            <td class="col-md-3">
              <!-- <input class="infAddbeneficiario efecto" type="button" value="Beneficiario"> -->
              <button class="infAddbeneficiario efecto btn-light border" type="button">Beneficiario</button>
            </td>
            <td class="col-md-3">
              <button class="infAddcliente efecto btn-light border" type="button">Cliente</button>
              <!-- <input class="infAddcliente efecto" type="button" value="Cliente"> -->
            </td>
            <td class="col-md-3">
              <button class="infAddempleado efecto btn-light border" type="button">Empleado</button>
              <!-- <input class="infAddempleado efecto" type="button" value="Empleado"> -->
            </td>
            <td class="col-md-3">
              <button class="infAddproveedor efecto btn-light border" type="button">Proveedor</button>
              <!-- <input class="infAddproveedor efecto" type="button" value="Proveedor"> -->
            </td>
          </tr>
          <tr class="row m-0 mt-4">
            <td class="col-md-12 input-effect" style="display:none" id="infAddbeneficiario1">
              <input class="efecto popup-input" id="infAddbeneficiario" type="text" id-display="#popup-display-infAddbeneficiario" action="beneficiarios" db-id="" autocomplete="off">
              <div class="popup-list" id="popup-display-infAddbeneficiario" style="display:none"></div>
              <label for="infAddbeneficiario">Beneficiario</label>
            </td>

            <td class="col-md-12 input-effect" style="display:none" id="infAddcliente1">
              <input class="efecto popup-input" id="infAddcliente" type="text" id-display="#popup-display-infAddcliente" action="clientes" db-id="" autocomplete="off">
              <div class="popup-list" id="popup-display-infAddcliente" style="display:none"></div>
              <label for="infAddcliente">Cliente</label>
            </td>

            <td class="col-md-12 input-effect" style="display:none" id="infAddempleado1">
              <input class="efecto popup-input" id="infAddempleado" type="text" id-display="#popup-display-infAddempleado" action="empleados" db-id="" autocomplete="off">
              <div class="popup-list" id="popup-display-infAddempleado" style="display:none"></div>
              <label for="infAddempleado">Empleado</label>
            </td>

            <td class="col-md-12 input-effect" style="display:none" id="infAddproveedor1">
              <input class="efecto popup-input" id="infAddproveedor" type="text" id-display="#popup-display-infAddproveedor" action="proveedores" db-id="" autocomplete="off">
              <div class="popup-list" id="popup-display-infAddproveedor" style="display:none"></div>
              <label for="infAddproveedor">Proveedor</label>
            </td>
          </tr>
          <tr class="row m-0 mt-4">
            <td class="col-md-3 input-effect">
              <input class="efecto tiene-contenido" type="date" id="otr-fecha">
              <label for="otr-fecha">Fecha</label>
            </td>
            <td class="col-md-2 input-effect">
              <input id="otr-imp" class="efecto" type="text" onchange="validaIntDec(this);"  autocomplete="off">
              <label for="otr-imp">Importe</label>
            </td>
            <td class="col-md-5 input-effect">
              <select class="custom-select" name="otr-mon" id="otr-moneda">
                <?php echo $consultaMoneda; ?>
              </select>
            </td>
            <td class="col-md-2 input-effect">
              <input id="otr-tc" class="efecto" type="text" onchange="validaIntDec(this);"  autocomplete="off">
              <label for="otr-tc">Tipo de Cambio</label>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>

  <div id="capturapoliza" class="contorno transferencia"><!--solo aparece al seleccionar Transferencia-->
    <table class="table form1">
      <thead>
        <tr class="row m-0 encabezado font18">
          <td class="col-md-12">Transferencia</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row m-0 mt-4">
          <td class="col-md-4 input-effect">
            <input class="efecto popup-input" id="transf-bancossat" type="text" id-display="#popup-display-transf-bancossat" action="bancosSAT" db-id="" autocomplete="off">
            <div class="popup-list" id="popup-display-transf-bancossat" style="display:none"></div>
            <label for='transf-bancossat'>Bancos SAT
              <a href='#catalogoBancosSAT' data-toggle='modal' style='margin-top:-4px'><img src='/conta6/Resources/iconos/help.svg' style='margin-top:-4px'></a>
            </label>
          </td>

          <td class="col-md-8 input-effect">
            <input class="efecto popup-input" id="transf-bancosplaa" type="text" id-display="#popup-display-transf-bancosplaa" action="cuentas_mst_0100_oficinaTodas" db-id="" autocomplete="off">
          	<div class="popup-list ls0" id="popup-display-transf-bancosplaa" style="display:none"></div>
          	<label for="transf-bancosplaa">Bancos PLAA</label>
          </td>
        </tr>
        <!-- <tr class="row m-0 mt-4">

        </tr> -->
        <tr class="row m-0 mt-4">
          <td class="col-md-12 input-effect">
            <input class="efecto popup-input" id="transf-benef" type="text" id-display="#popup-display-transf-benef" action="beneficiariosBancos" db-id="" autocomplete="off">
            <div class="popup-list" id="popup-display-transf-benef" style="display:none"></div>
            <label for="transf-benef">Bancos Beneficiarios</label>
          </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-md-12 input-effect">
            <input class="efecto popup-input" id="transf-clientes" type="text" id-display="#popup-display-transf-clientes" action="clientesBancos" db-id="" autocomplete="off">
            <div class="popup-list" id="popup-display-transf-clientes" style="display:none"></div>
            <label for="transf-clientes">Bancos Clientes</label>
          </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-md-12 input-effect">
            <input  list="transf-emp" class="efecto"  id="transf-empleados">
            <datalist id="transf-emp">
              <option value="PINALES AVALOS -- PIAA911122Lp2 -- BANAMEX -- 5256781310675298"></option>
              <option value="MARTINEZ MARTINEZ -- MAMD800330DQ3 -- BBVA BANCOMER -- 012821015214161544"></option>
            </datalist>
            <label class="l22" for="transf-empleados">Empleados</label>
          </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-md-12 input-effect">
            <input class="efecto popup-input" id="transf-proveedores" type="text" id-display="#popup-display-transf-proveedores" action="proveedoresBancos" db-id="" autocomplete="off">
            <div class="popup-list" id="popup-display-transf-proveedores" style="display:none"></div>
            <label for="transf-proveedores">Bancos Proveedores</label>
          </td>
        </tr>

        <tr class="row m-0 backpink mt-3">
          <th class="col-md-1">Banco</th>
          <th class="col-md-4">No. Cuenta / Interbancaria</th>
          <th class="col-md-5">Nombre / Razón Social</th>
          <th class="col-md-2">RFC</th>
        </tr>
        <tr class="row m-0">
          <td class="col-md-1">
            <input id="transf-idbanco" class="efecto h22" type="text" disabled>
            <input id="transf-nombancoextj" class="efecto h22" type="hidden">
          </td>
          <td class="col-md-4">
            <input id="transf-nocuenta" class="efecto h22" type="text" disabled>
          </td>
          <td class="col-md-5">
            <input id="transf-nombre" class="efecto h22" type="text" disabled>
          </td>
          <td class="col-md-2">
            <input id="transf-rfc" class="efecto h22" type="text" disabled>
          </td>
        </tr>

        <tr class="row m-0 mt-3">
          <td class="col-md-4"></td>
          <td class="col-md-2">
            <button id="trans-embtn" type="button" class="boton">
              <i class="fa fa-plus-circle"></i> ORIGEN
            </button>
          </td>
          <td class="col-md-2">
            <button id="trans-desbtn" type="button" class="boton">
              <i class="fa fa-plus-circle"></i> DESTINO
            </button>
          </td>
          <td class="col-md-4"></td>
        </tr>
        <tr class="row m-0 mt-3">
          <td class="col-md-12 sub">Origen</td>
        </tr>
        <tr class="row m-0 sub2">
          <th class="col-md-1">Banco</th>
          <th class="col-md-4">No. Cuenta / Interbancaria</th>
          <th class="col-md-4">Nombre / Razón Social (opcional)</th>
          <th class="col-md-3">RFC (opcional)</th>
        </tr>
        <tr class="row m-0">
          <td class="col-md-1">
            <input id="trans-emidbanco" class="efecto h22" type="text" disabled>
          </td>
          <td class="col-md-4">
            <input id="trans-emnocuenta" class="efecto h22" type="text" disabled>
          </td>
          <td class="col-md-4">
            <input id="trans-emnombre" class="efecto h22" type="text" disabled>
          </td>
          <td class="col-md-3">
            <input id="trans-emrfc" class="efecto h22" type="text" disabled>
          </td>
        </tr>
        <tr class="row m-0">
          <td class="col-md-12 sub">Destino</td>
        </tr>
        <tr class="row m-0 sub2">
          <th class="col-md-1">Banco</th>
          <th class="col-md-4">No. Cuenta / Interbancaria</th>
          <th class="col-md-4">Nombre / Razón Social</th>
          <th class="col-md-3">RFC</th>
        </tr>
        <tr class="row m-0">
          <td class="col-md-1">
            <input id="trans-desidbanco" class="efecto h22" type="text" disabled>
          </td>
          <td class="col-md-4">
            <input id="trans-desnocuenta" class="efecto h22" type="text" disabled>
          </td>
          <td class="col-md-4">
            <input id="trans-desnombre" class="efecto h22" type="text" disabled>
          </td>
          <td class="col-md-3">
            <input id="trans-desrfc" class="efecto h22" type="text" disabled>
          </td>
        </tr>

        <tr class="row m-0 mt-4">
          <td class="col-md-3">
            <input id="trans-emext" class="efecto tiene-contenido h22" type="text" disabled>
            <label class="l22" for="trans-emext">Bco. Emisor Extranjero</label>
          </td>

          <td class="col-md-3">
            <input id="trans-desext" class="efecto tiene-contenido h22" type="text" disabled>
            <label class="l22" for="trans-desext">Bco. Destino Extranjero</label>
          </td>
          <td class="col-md-2">
            <input id="trans-tc" class="efecto h22" type="text" onchange="validaIntDec(this);">
            <label class="l22" for="trans-tc">Tipo de Cambio</label>
          </td>
          <td class="col-md-4">
            <select class="custom-select-s" name="trans-moneda" id="trans-mon">
              <?php echo $consultaMoneda; ?>
            </select>
          </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-md-3">
            <input class="efecto h22 tiene-contenido" type="date" id="trans-fecha">
            <label class="l22" for="trans-fecha">Fecha</label>
          </td>
          <td class="col-md-2">
            <input id="trans-imp" class="efecto h22" type="text" onchange="validaIntDec(this);">
            <label class="l22" for="trans-imp">Importe</label>
          </td>
          <td class="col-md-7">
            <input id="trans-observ" class="efecto h22" type="text">
            <label class="l22" for="trans-observ">Observaciones</label>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

<!-- DETALLE DE LA POLIZA -->

  <div class="contorno mt-4">
    <div class="table table-hover mt-4">
      <div id="infAddtabla_detallePoliza" class="font12"></div>
    </div>
  </div>
</div>
<!--Termina desplazamiento numero 3-->

 <!-- prueba modificar -->
<?php
require $root . '/conta6/Ubicaciones/Contabilidad/modales/catalogoBancosSAT.php';
?>
