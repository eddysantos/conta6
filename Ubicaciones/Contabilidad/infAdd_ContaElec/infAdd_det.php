<div id="three"><!--INFORMACION DE LA PARTIDA-->
  <form class="opcion">
    <table class="table">
      <tr class="row justify-content-center">
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

  <div id="capturapoliza" class="contorno-mov cfdi"><!--solo aparece al seleccionar CFDI-->
    <table class="table form1">
      <thead>
        <tr class="row encabezado m-0 font18">
          <td class="col-md-12">CFDI</td>
        </tr>
        <tr class="row m-0 mt-3 justify-content-center">
          <td class="col-md-3 custom-file">
            <input type="file" class="custom-file-input" id="archivo" onChange="processFiles(this.files)">
            <label class="custom-file-label" for="customFile">Selecciona un archivo</label>
          </td>
          <td class="col-md-12 m-3 sub2 p-0">
            <div class="m-2 b" id="datosUUID"></div>
          </td>
        </tr>

        <!-- <form>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>
        </form> -->
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
            <!-- <label for="cfdi-aplicar">Aplicar</label> -->
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="capturapoliza" class="contorno-mov cheque"><!--solo aparece al seleccionar CHEQUES-->
    <table class="table form1">
      <thead>
        <tr class="row m-0 encabezado font18">
          <td class="col-md-12">CHEQUES</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row m-0 mt-4">
          <td class="col-md-5 input-effect">
            <input list="ch-origen" class="efecto" id="chorigen">
            <datalist id="ch-origen">
              <option value="Banamex - 002 - 7658424"></option>
              <option value="Banamex - 002 - 79033561"></option>
              <option value="Banamex - 002 - 7355485"></option>
              <option value="Bancomer - 012 - 0192655497"></option>
            </datalist>
            <label for="chorigen">Seleccione una Cuenta (Origen)</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="ch-banco" class="efecto tiene-contenido" type="text" disabled>
            <label for="ch-banco">Banco</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ch-ncuenta" class="efecto tiene-contenido" type="text" disabled>
            <label for="ch-ncuenta">No.Cuenta</label>
          </td>
          <td class="col-md-2 input-effect">
            <input  list="numcheques" class="efecto" id="ch-cheques">
            <datalist id="numcheques">
              <option value="3421"></option>
              <option value="3422"></option>
              <option value="3423"></option>
              <option value="3424"></option>
            </datalist>
            <label for="ch-cheques">Cheques</label>
          </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-md-5 input-effect">
            <input id="ch-emextran" class="efecto" type="text" onchange="eliminaBlancosIntermedios(this);">
            <label for="ch-emextran">* Banco Emisor Extranjero</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="ch-tc" class="efecto" type="text" onchange="validaIntDec(this);">
            <label for="ch-tc">* Tipo de Cambio</label>
          </td>
          <td class="col-md-5 input-effect">
            <input  list="chmoneda" class="efecto" id="ch-moneda">
            <datalist id="chmoneda">
              <option value="Peso Mexicano -- MXN"></option>
              <option value="Boliviano -- BOB"></option>
              <option value="Peso Cubano -- CUP"></option>
              <option value="Peso Filipino -- PHP"></option>
            </datalist>
            <label for="ch-moneda">* Moneda</label>
          </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-md-1 input-effect">
            <input id="ch-cheque1" class="efecto tiene-contenido" type="text" disabled>
            <label for="ch-cheque1">Cheque</label>
          </td>
          <td class="col-md-1 input-effect">
            <input id="ch-importe" class="efecto tiene-contenido" type="text" disabled>
            <label for="ch-importe">Importe</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido" type="date" id="ch-fecha" disabled>
            <label for="ch-fecha">Fecha</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="ch-rfcbenef" class="efecto tiene-contenido" type="text" disabled>
            <label for="ch-rfcbenef">RCF</label>
          </td>
          <td class="col-md-5 input-effect">
            <input id="ch-nombrebenef" class="efecto tiene-contenido" type="text" disabled>
            <label for="ch-nombrebenef">Nombre Beneficiario</label>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="capturapoliza" class="contorno-mov compext"><!--solo aparece al seleccionar Comprobante Extranjero-->
    <table class="table form1">
      <thead>
        <tr class="row m-0 encabezado font18">
          <td class="col-md-12">Comprobante Extranjero</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row m-0 mt-4">
          <td class="col-md-4 input-effect">
            <input id="comext-tax" class="efecto" type="text" onchange="todasMayusculas(this);eliminaBlancosIntermedios(this);">
            <label for="comext-tax">Tax ID</label>
          </td>
          <td class="col-md-8 input-effect">
            <input id="comext-razsocial" class="efecto" type="text" onchange="todasMayusculas(this);eliminaBlancosIntermedios(this);">
            <label for="comext-razsocial">Nombre / Razón Social</label>
          </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-md-3 input-effect">
            <input id="comext-fact" class="efecto" type="text" onchange="eliminaBlancosIntermedios(this);">
            <label for="comext-fact">Número de Factura</label>
          </td>
          <td class="col-md-5 input-effect">
            <input  list="comext-mon" class="efecto" id="comext-moneda">
            <datalist id="comext-mon">
              <option value="Peso Mexicano -- MXN"></option>
              <option value="Peso Cubano -- CUP"></option>
              <option value="Boliviano -- BOB"></option>
              <option value="Peso Filipino -- PHP"></option>
            </datalist>
            <label for="comext-moneda">Seleccione una Cuenta</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="comext-tc" class="efecto" type="text" onchange="validaIntDec(this);">
            <label for="comext-tc">Tipo de Cambio</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="comext-total" class="efecto" type="text" onchange="validaIntDec(this);">
            <label for="comext-total">Total</label>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="capturapoliza" class="contorno-mov otro"><!--solo aparece al seleccionar Otro-->
    <form class="form1">
      <table class="table ">
        <thead>
          <tr class="row m-0 encabezado font18">
            <td class="col-md-12">Otro</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row m-0 mt-4">
            <td class="col-md-3 input-effect">
              <input  list="otr-metpago" class="efecto"  id="otr-pago">
              <datalist id="otr-metpago">
                <option value="Bienes -- 09"></option>
                <option value="Cancelacion -- 16"></option>
                <option value="Compesacion -- 17"></option>
                <option value="Dacion en Pago -- 12"></option>
              </datalist>
              <label for="otr-pago">Metodo Pago</label>
            </td>
            <td class="col-md-3 input-effect">
              <input id="otr-rfc" class="efecto" type="text" onchange="eliminaBlancosIntermedios(this);todasMayusculas(this);validaRFC(this);">
              <label for="otr-rfc">RFC</label>
            </td>
            <td class="col-md-6 input-effect">
              <input id="otr-benef" class="efecto" type="text">
              <label for="otr-benef">Beneficiario</label>
            </td>
          </tr>
          <tr class="row m-0 mt-4">
            <td class="col-md-3 input-effect">
              <input class="efecto tiene-contenido" type="date" id="otr-fecha">
              <label for="otr-fecha">Fecha</label>
            </td>
            <td class="col-md-2 input-effect">
              <input id="otr-imp" class="efecto" type="text" onchange="validaIntDec(this);">
              <label for="otr-imp">Importe</label>
            </td>
            <td class="col-md-5 input-effect">
              <input  list="otr-mon" class="efecto"  id="otr-moneda">
              <datalist id="otr-mon">
                <option value="Peso Mexicano -- MXN"></option>
                <option value="Boliviano -- BOB"></option>
                <option value="Peso Cubano -- CUP"></option>
                <option value="Peso Filipino -- PHP"></option>
              </datalist>
              <label for="otr-moneda">Moneda</label>
            </td>
            <td class="col-md-2 input-effect">
              <input id="otr-tc" class="efecto" type="text" onchange="validaIntDec(this);">
              <label for="otr-tc">Tipo de Cambio</label>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>

  <div id="capturapoliza" class="contorno-mov transferencia"><!--solo aparece al seleccionar Transferencia-->
    <table class="table form1">
      <thead>
        <tr class="row m-0 encabezado font18">
          <td class="col-md-12">Transferencia</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row m-0 mt-4">
          <td class="col-md-6 input-effect">
            <input  list="transf-bsat" class="efecto h22"  id="transf-bancossat">
            <datalist id="transf-bsat">
              <option value="Afirme"></option>
              <option value="American Express"></option>
              <option value="Azteca"></option>
              <option value="Banamex"></option>
              <option value="Bancopel"></option>
            </datalist>
            <label class="l22" for="transf-bancossat">BANCOS SAT</label>
          </td>
          <td class="col-md-6 input-effect">
            <input  list="transf-bplaa" class="efecto h22"  id="transf-bancosplaa">
            <datalist id="transf-bplaa">
              <option value="BBVA BANCOMER -- 0109722246 -- 430"></option>
              <option value="BBVA BANCOMER -- 0166627773 -- 430"></option>
              <option value="BBVA BANCOMER -- 0166795056 -- 160"></option>
              <option value="BBVA BANCOMER -- 166721346 -- 470"></option>
              <option value="BBVA BANCOMER -- 0192655497 -- 240"></option>
            </datalist>
            <label class="l22" for="transf-bancosplaa">BANCOS PLAA</label>
          </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-md-6 input-effect">
            <input  list="transf-ben" class="efecto h22"  id="transf-benef">
            <datalist id="transf-ben">
              <option value="Administracion Portuaria Integral de Manzanillo SA de CV -- API931215862 -- SANTANDER -- 014095655008263897"></option>
              <option value="AAADAM A.C -- AAA8711107K5 -- BANAMEX -- 2801662"></option>
            </datalist>
            <label class="l22" for="transf-benef">BANCOS BENEFICIARIOS</label>
          </td>
          <td class="col-md-6 input-effect">
            <input  list="transf-cli" class="efecto h22"  id="transf-clientes">
            <datalist id="transf-cli">
              <option value="Fabricaciones Industriales Computarizadas SA de CV -- FIC980227TCA -- BANORTE -- 1260"></option>
              <option value="Geiko Maiko Industrial S.A de C.V -- GMI120928KU4 -- BBVA BANCOMER -- 2554"></option>
            </datalist>
            <label class="l22" for="transf-clientes">BANCOS CLIENTES</label>
          </td>
        </tr>
        <tr class="row m-0 mt-4">
          <td class="col-md-6 input-effect">
            <input  list="transf-emp" class="efecto h22"  id="transf-empleados">
            <datalist id="transf-emp">
              <option value="PINALES AVALOS -- PIAA911122Lp2 -- BANAMEX -- 5256781310675298"></option>
              <option value="MARTINEZ MARTINEZ -- MAMD800330DQ3 -- BBVA BANCOMER -- 012821015214161544"></option>
            </datalist>
            <label class="l22" for="transf-empleados">EMPLEADOS</label>
          </td>
          <td class="col-md-6 input-effect">
            <input  list="transf-prov" class="efecto h22"  id="transf-proveedores">
            <datalist id="transf-prov">
              <option value="Control Integrado de Tratamientos Cuarentenarios y Plagas S.A de C.V -- CIT0010198Y0 -- 012821001069756749"></option>
              <option value="Banco Monex S.A Institución de Banca Multiple, Mone Grupo Financiero -- BMI9704113pa -- 6580894"></option>
            </datalist>
            <label class="l22" for="transf-proveedores">PROVEEDORES</label>
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
            <input class="border-0 efecto h22" type="text" value="012">
          </td>
          <td class="col-md-4">
            <input class="efecto h22" type="text" value="012821011521461544">
          </td>
          <td class="col-md-5">
            <input  class="efecto h22" type="text" value="Martinez Martinez">
          </td>
          <td class="col-md-2">
            <input class="efecto h22" type="text" value="MAMD800330DQ3" onchange="eliminaBlancosIntermedios(this);todasMayusculas(this);validaRFC(this);">
          </td>
        </tr>

        <tr class="row m-0 mt-3">
          <td class="col-md-4"></td>
          <td class="col-md-2">
            <button  type="button" class="boton">
              <i class="fa fa-plus-circle"></i> ORIGEN
            </button>
          </td>
          <td class="col-md-2">
            <button  type="button" class="boton">
              <i class="fa fa-plus-circle"></i> DESTINO
            </button>
          </td>
          <td class="col-md-4"></td>
        </tr>
        <tr class="row m-0 mt-3">
          <td class="col-md-12 sub">Origen</td>
        </tr>
        <tr class="row m-0 sub2">
          <th class="col-md-1">BANCO</th>
          <th class="col-md-4">NO. CUENTA / INTERBANCARIA</th>
          <th class="col-md-4">NOMBRE / RAZON SOCIAL (opcional)</th>
          <th class="col-md-3">RFC (opcional)</th>
        </tr>
        <tr class="row m-0">
          <td class="col-md-1">
            <input class="border-0 efecto h22" type="text" value="012">
          </td>
          <td class="col-md-4">
            <input class="efecto h22" type="text" value="012821011521461544">
          </td>
          <td class="col-md-4">
            <input  class="efecto h22" type="text" value="Martinez Martinez">
          </td>
          <td class="col-md-3">
            <input class="efecto h22" type="text" value="MAMD800330DQ3" onchange="eliminaBlancosIntermedios(this);todasMayusculas(this);validaRFC(this);">
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
            <input class="border-0 efecto h22" type="text" value="012">
          </td>
          <td class="col-md-4">
            <input class="efecto h22" type="text" value="012821011521461544">
          </td>
          <td class="col-md-4">
            <input  class="efecto h22" type="text" value="Martinez Martinez">
          </td>
          <td class="col-md-3">
            <input class="efecto h22" type="text" value="MAMD800330DQ3">
          </td>
        </tr>

        <tr class="row m-0 mt-4">
          <td class="col-md-3">
            <input id="trans-emext" class="efecto h22" type="text">
            <label class="l22" for="trans-emext">Bco. Emisor Extranjero</label>
          </td>

          <td class="col-md-3">
            <input id="trans-desext" class="efecto h22" type="text">
            <label class="l22" for="trans-desext">Bco. Destino Extranjero</label>
          </td>
          <td class="col-md-2">
            <input id="trans-tc" class="efecto h22" type="text" onchange="validaIntDec(this);">
            <label class="l22" for="trans-tc">Tipo de Cambio</label>
          </td>
          <td class="col-md-4">
            <input  list="trans-mon" class="efecto h22"  id="trans-moneda">
            <datalist id="trans-mon">
              <option value="Peso Mexicano -- MXN"></option>
              <option value="Boliviano -- BOB"></option>
              <option value="Peso Cubano -- CUP"></option>
              <option value="Peso Filipino -- PHP"></option>
            </datalist>
            <label class="l22" for="trans-moneda">Moneda</label>
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

  <div class="contorno-mov mt-4">
    <div class="table table-hover mt-4">
      <div id="infAddtabla_detallePoliza" class="font12"></div>
    </div>
  </div>
</div>
<!--Termina desplazamiento numero 3-->

 <!-- prueba modificar -->
