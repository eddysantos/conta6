<!--MODULO 1 * MODULO 1 * MODULO 1 * MODULO 1 * MODULO 1 * MODULO 1-->

<!--Sección de Reportes Contbilidad-->
<div class="modal fade text-center" id="ReportesCont" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content m_bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>Reportes Contabilidad</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <div class="row sub2 m-0">
          <ul class="nav nav-pills nav-fill font12" id="selecRepoCont">
            <li class="nav-item">
              <a style="cursor:pointer" class="nav-link Consul" accion="cobranza" status="cerrado">COBRANZA</a>
            </li>
            <li class="nav-item">
              <a style="cursor:pointer" class="nav-link Consul" accion="conta" status="cerrado">CONTABILIDAD</a>
            </li>
            <li class="nav-item">
              <a style="cursor:pointer" class="nav-link Consul" accion="contaElec" status="cerrado">CONTABILIDAD ELECTRONICA</a>
            </li>
            <li class="nav-item">
              <a style="cursor:pointer" class="nav-link Consul" accion="Fact" status="cerrado">FACTURACION</a>
            </li>
            <li class="nav-item">
              <a style="cursor:pointer" class="nav-link Consul" accion="Finan" status="cerrado">FINANCIEROS</a>
            </li>
            <li class="nav-item">
              <a style="cursor:pointer" class="nav-link Consul" accion="Impuestos" status="cerrado">IMPUESTOS</a>
            </li>
            <li class="nav-item">
              <a style="cursor:pointer" class="nav-link Consul" accion="Revisiones" status="cerrado">REVISIONES</a>
            </li>
          </ul>
        </div>

        <div id="RepoCobranza" style="display:none">
          <div id="contorno" class="contorno">
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <select class="custom-select" id="opcion">
                  <option >Selecciona un Reporte</option>
                  <option value="1">COBRANZA EFECTIVA</option>
                  <option value="2">DETALLE DE PAGOS POR CLIENTE</option>
                  <option value="3">ESTADO DE CUENTA DE CLIENTE</option>
                  <option value="4">ESTADO DE CUENTA DETALLADO</option>
                  <option value="5">SALDO A FAVOR</option>
                  <option value="6">SALDO A FAVOR -- CFDI</option>
                  <option value="7">SALDOS PENDIENTES POR CLIENTE</option>
                  <option value="8">SALDOS PENDIENTES POR OFICINA</option>
                  <option value="9">SALDOS PENDIENTES TODOS LOS CLIENTES - DETALLE POR OFICINA</option>
                </select>
              </div>
            </div>
            <form class="form1 mt-4">
              <table class="table">
                <thead>
                  <tr class="row encabezado font14">
                    <th class="col-md-12">REPORTE COBRANZA EFECTIVA</th>
                  </tr>
                </thead>
                <tbody class="font14">
                  <tr class="row mt-5">
                    <td class="col-md-4 input-effect">
                      <input  list="oficinas" class="oficina efecto"  id="repo-oficinas" >
                      <datalist id="oficinas">
                        <option value="AEROPUERTO"></option>
                        <option value="MANZANILLO"></option>
                        <option value="NUEVO LAREDO"></option>
                        <option value="VERACRUZ"></option>
                      </datalist>
                      <label for="repo-oficinas">Oficina</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input class="fechas efecto tiene-contenido" type="date" id="fini">
                      <label for="fini">Fecha Inicial</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input class="fechas efecto tiene-contenido" type="date" id="ffinal">
                      <label for="ffinal">Fecha Final</label>
                    </td>
                  </tr>
                  <tr class="row mt-4">
                    <td class="col-md-12 input-effect">
                      <input list="listaclientes" class="clientes efecto" id="repo-clientes">
                      <datalist id="listaclientes">
                        <option value="SERVICIOS INTEGRALES EN LOGISTICA INTERNACIONAL, ADUANAS Y TECNOLOGIA, S.C --- CLT_7158"></option>
                        <option value="TURBO-MEX REFACCIONES,MANTENIMIENTO Y SEGURIDAD INDUSTRIAL S.A DE C.V --- CLT_7114"></option>
                      </datalist>
                      <label for="repo-clientes">Cliente</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div><!--termina el Container-Fluid-->
        </div>

        <div id="RepoConta" style="display:none">
          <div id="contorno" class="contorno">
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <select class="custom-select" id="opcion">
                  <option >Selecciona un Reporte</option>
                  <option value="10">AUXILIARES</option>
                  <option value="11">BALANZA DE COMPROBACIÓN</option>
                  <option value="12">COMPROBANTES</option>
                  <option value="13">ESTADO DE CUENTA DEL CLIENTE</option>
                  <option value="14">LIBRO DIARIO</option>
                </select>
              </div>
            </div>
            <form class="form1 mt-4">
              <table class="table">
                <thead>
                  <tr class="row encabezado font18">
                    <td class="col-md-12 p-1">REPORTES CONTABILIDAD</td>
                  </tr>
                </thead>
                <tbody class="font-14">
                  <tr class="row mt-5">
                    <td class="col-md-4 input-effect">
                      <input  list="oficinas" class="oficina efecto" id="oficina1">
                      <datalist id="oficinas"></datalist>
                      <label for="oficina1">Oficina</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input class="fechas efecto tiene-contenido" type="date" id="fini1">
                      <label for="fini1">Fecha Inicial</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input class="fechas efecto tiene-contenido" type="date" id="ffinal1">
                      <label for="ffinal1">Fecha Final</label>
                    </td>
                  </tr>
                  <tr class="row mt-3">
                    <td class="col-md-12 input-effect">
                      <input  list="listaclientes" class="clientes efecto" id="cliente1">
                      <datalist id="listaclientes"></datalist>
                      <label for="cliente1">Cliente</label>
                    </td>
                  </tr>
                  <tr class="row mt-3">
                    <td class="col-md-12 input-effect">
                      <input  list="listacuentas" class="cuentas efecto" id="cuentas">
                      <datalist id="listacuentas">
                        <option value="0100-00006 -- BANAMEX CTA.7658424 NUEVO LAREDO"></option>
                        <option value="0115-00022 -- REPRESENTACIONES TRANSPACIFICAS TRANSPAC, S.A DE C.V"></option>
                      </datalist>
                      <label for="cuentas">Cuenta</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div><!--termina el Container-Fluid-->
        </div>

        <div id="RepoFact" style="display:none">
          <div id="contorno" class="contorno">
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <select class="custom-select" id="opcion">
                  <option >Selecciona un Reporte</option>
                  <option value="15">POR OFICINA -- CFD</option>
                  <option value="16">POR OFICINA -- CFD POR FECHA DE PAGO</option>
                  <option value="17">POR OFICINA -- CFD POR FECHA DE PAGO - COMPLETO</option>
                  <option value="18">POR OFICINA DETALLADO -- CFD</option>
                  <option value="19">POR OFICINA DETALLADO CON FACTURAS CANCELADAS -- CFD</option>
                  <option value="20">POR OFICINA DETALLADO SEMANAL -- CFD</option>
                  <option value="21">POR CLIENTE -- CFD</option>
                  <option value="22">POR CLIENTE DETALLADO -- CFD</option>
                  <option value="23">POR CORRESPONSAL -- CFD</option>
                  <option value="24">COMISIONES POR CLIENTE -- CFD</option>
                  <option value="25">COMISIONES POR OFICINA -- CFD</option>
                  <option value="26">FACTURAS SIN PÓLIZAS -- CFD</option>
                  <option value="27">FACTURAS CANCELADAS -- CFD</option>
                  <option value="28">FACTURAS CUSTOMS DC -- CFD</option>
                  <option value="29">REFERENCIAS CON MAS DE 1 FACTURA</option>
                  <option value="30">REFERENCIAS NO FACTURADAS (ACUMULADO)</option>
                  <option value="31">REFERENCIAS NO FACTURADAS (MENSUL)</option>
                  <option value="32">SIN REFERENCIA -- CFD</option>
                  <option>____________________FACTURACIÓN IMPRESA AL (31-12-2010)_____________________</option>
                  <option value="33">POR OFICINA</option>
                  <option value="34">POR OFICINA DETALLADO</option>
                  <option value="35">POR CLIENTE</option>
                  <option value="36">POR CLIENTE DETALLADO</option>
                  <option value="37">POR CORRESPONSAL</option>
                  <option value="38">SIN REFERENCIA</option>
                  <option value="39">FACTURAS CANCELADAS</option>
                  <option value="40">FACTURAS CUSTOMS DC</option>
                </select>
              </div>
            </div>
            <form class="form1 mt-4">
              <table class="table">
                <thead>
                  <tr class="row font18 encabezado">
                    <td class="col-md-12 p-1">REPORTES FACTURACIÓN</td>
                  </tr>
                </thead>
                <tbody class="font14">
                  <tr class="row mt-5">
                    <td class="col-md-4 input-effect">
                      <input  list="oficinas" class="oficina efecto"  id="f-oficina">
                      <datalist id="oficinas"></datalist>
                      <label for="f-oficina">Oficina</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input class="fechas efecto tiene-contenido" type="date" id="fini3">
                      <label for="fini3">Fecha Inicial</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input class="fechas efecto tiene-contenido" type="date" id="ffinal3">
                      <label for="ffinal3">Fecha Final</label>
                    </td>
                  </tr>
                  <tr class="row mt-3">
                    <td class="col-md-12 input-effect">
                      <input  list="listaclientes" class="clientes efecto" id="f-cliente">
                      <datalist id="listaclientes"></datalist>
                      <label for="f-cliente">Cliente</label>
                    </td>
                  </tr>
                  <tr class="row mt-3">
                    <td class="col-md-12 input-effect">
                      <input  list="listacorresponsal" class="corres efecto" id="corresponsal">
                      <datalist id="listacorresponsal">
                        <option value="SERVICIOS INTEGRALES EN LOGISTICA INTERNACIONAL, ADUANAS Y TECNOLOGIA, S.C --- CLT_7158"></option>
                        <option value="TURBO-MEX REFACCIONES,MANTENIMIENTO Y SEGURIDAD INDUSTRIAL S.A DE C.V --- CLT_7114"></option>
                      </datalist>
                      <label for="corresponsal">Corresponsales</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div><!--termina el Container-Fluid-->
        </div>

        <div id="RepoFinan" style="display:none">
          <div id="contorno" class="contorno">
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <select class="custom-select" id="opcion">
                  <option >Selecciona un Reporte</option>
                  <option value="40">BALANCE GENERAL</option>
                  <option value="41">BALANCE DE COMPROBACION ANUAL</option>
                  <option value="42">ESTADO DE RESULTADOS</option>
                  <option value="43">ESTADO DE RESULTADOS POR OFICINA</option>
                  <option value="44">INGRESOS POR CLIENTE</option>
                </select>
              </div>
            </div>
            <form class="form1 mt-4">
              <table class="table">
                <thead>
                  <tr class="row encabezado font18">
                    <td class="col-md-12 p-1">REPORTES FINANCIEROS</td>
                  </tr>
                </thead>
                <tbody class="font14">
                  <tr class="row mt-5">
                    <td class="col-md-4 input-effect">
                      <input  list="oficinas" class="oficina efecto"  id="finan-oficina">
                      <datalist id="oficinas"></datalist>
                      <label for="finan-oficina">Oficina</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input class="fechas efecto tiene-contenido" type="date" id="fini4">
                      <label for="fini4">Fecha Inicial</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input class="fechas efecto tiene-contenido" type="date" id="ffinal4">
                      <label for="ffinal4">Fecha Final</label>
                    </td>
                  </tr>
                  <tr class="row mt-3">
                    <td class="col-md-12 input-effect">
                      <input  list="listaclientes" class="clientes efecto" id="finan-cliente">
                      <datalist id="listaclientes"></datalist>
                      <label for="finan-cliente">Cliente</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div><!--termina el Container-Fluid-->
        </div>

        <div id="RepoImpuestos" style="display:none">
          <div id="contorno" class="contorno">
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <select class="custom-select" id="opcion">
                  <option >Selecciona un Reporte</option>
                  <option value="45">ADQUISICIONES DE ACTIVO FIJO</option>
                  <option value="46">DETERMINACIÓN DE AJUSTE ANUAL</option>
                  <option value="47">INFORMATIVAS</option>
                  <option value="48">INFORMATIVAS DETALLADO</option>
                  <option value="49">NOTAS A LAS CUENTAS DE ACTIVO FIJO</option>
                  <option value="50">PÓLIZAS SIN PROVEEDOR ASIGNADO</option>
                  <option value="51">PÓLIZAS SIN PROVEEDOR ASIGNADO A RETENCIONES</option>
                  <option value="52">RETENCIONES</option>
                  <option value="53">RETENCIONES DETALLADO</option>
                </select>
              </div>
            </div>
            <form class="form1 mt-4">
              <table class="table">
                <thead>
                  <tr class="row font18 encabezado">
                    <td class="col-md-12 p-1">REPORTES IMPUESTOS</td>
                  </tr>
                </thead>
                <tbody class="font14">
                  <tr class="row mt-5">
                    <td class="col-md-4 input-effect">
                      <input  list="oficinas" class="oficina efecto"  id="oficina5">
                      <datalist id="oficinas"></datalist>
                      <label for="oficina5">Oficina</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input class="fechas efecto tiene-contenido" type="date" id="fini5">
                      <label for="fini5">Fecha Inicial</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input class="fechas efecto tiene-contenido" type="date" id="ffinal5">
                      <label for="ffinal5">Fecha Final</label>
                    </td>
                  </tr>
                  <tr class="row mt-3">
                    <td class="col-md-12 input-effect">
                      <input  list="listaclientes" class="clientes efecto" id="clientes5">
                      <datalist id="listaclientes"></datalist>
                      <label for="clientes5">Cliente</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div><!--termina el Container-Fluid-->
        </div>

        <!-- <div id="RepoRevisiones" style="display:none"> -->
        <div id="RepoRevisiones">
          <div id="contorno" class="contorno">
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <select class="custom-select" id="opcion">
                  <option >Selecciona un Reporte</option>
                  <option value="54">ANALISIS DE LA 110</option>
                  <option value="55">ANALISIS DE LA 110 DETALLADO</option>
                  <option value="56">ANTICIPOS REGISTRADOS EN EL PERIODO</option>
                  <option value="57">CARGOS POR CUENTA DEL CLIENTE DUPLICADOS</option>
                  <option value="58">CHEQUES REGISTRADOS EN EL PERIODO</option>
                  <option value="59">ESTADO DE CUENTA ANTICIPOS</option>
                  <option value="60">FACTURAS CON SALDO</option>
                  <option value="61">FACTURAS CON SALDO POR CLIENTE</option>
                  <option value="62">FACTURAS DETALLADO POR OFICINA</option>
                  <option value="63">IMPRESIÓN DE PÓLIZAS</option>
                  <option value="64">NOTA DE CREDITO DETALLADO POR OFICINA</option>
                  <option value="65">PÓLIZAS DE GASTO SIN OFICINA ASIGNADO</option>
                  <option value="66">PÓLIZAS REGISTRASDAS EN EL PERIODO</option>
                  <option value="67">POLIZAS SIN CUADRAR</option>
                  <option value="68">POLIZAS SIN USAR</option>
                  <option value="69">RELACIÓN DE PÓLIZAS</option>
                  <option value="70">REVISIÓN DE CUENTAS DE MAYOR</option>
                </select>
              </div>
            </div>
            <form class="form1 mt-4">
              <table class="table">
                <thead>
                  <tr class="row font18 encabezado">
                    <td class="col-md-12 p-1">REPORTES PARA REVISIONES</td>
                  </tr>
                </thead>
                <tbody class="font14">
                  <tr class="row mt-5">
                    <td class="col-md-4 input-effect">
                      <input  list="oficinas" class="oficina efecto"  id="oficina6">
                      <datalist id="oficinas"></datalist>
                      <label for="oficina6">Oficina</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input class="fechas efecto tiene-contenido" type="date" id="fini6">
                      <label for="fini6">Fecha Inicial</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input class="fechas efecto tiene-contenido" type="date" id="ffinal6">
                      <label for="ffinal6">Fecha Final</label>
                    </td>
                  </tr>
                  <tr class="row mt-3">
                    <td class="col-md-12 input-effect">
                      <input  list="listaclientes" class="clientes efecto" id="clientes6">
                      <datalist id="listaclientes"></datalist>
                      <label for="clientes6">Cliente</label>
                    </td>
                  </tr>
                  <tr class="row mt-3">
                    <td class="col-md-12 input-effect">
                      <input list="ctaMayor" class="ctasMayor efecto" id="lista-ctasmayor">
                      <datalist id="ctaMayor">
                        <option value="SERVICIOS INTEGRALES EN LOGISTICA INTERNACIONAL, ADUANAS Y TECNOLOGIA, S.C --- CLT_7158"></option>
                        <option value="TURBO-MEX REFACCIONES,MANTENIMIENTO Y SEGURIDAD INDUSTRIAL S.A DE C.V --- CLT_7114"></option>
                      </datalist>
                      <label for="lista-ctasmayor">Cuentas de Mayor</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div><!--termina el Container-Fluid-->
        </div>
      </div><!--termina el COntenido del Modal-->
      <div class="modal-footer border-0 mt-3">
        <table class="table">
          <tbody class="font14">
            <tr class="row align-items-center justify-content-center">
              <td class="col-md-3">
                <a href="" class="boton"><img src= "/Resources/iconos/magnifier.svg" class="icochico"> CONSULTAR</a>
              </td>
              <td class="col-md-3">
                <a href="" class="boton"> <img src= "/Resources/iconos/005-excel.svg" class="icochico"> ABRIR EN EXCEL</a><!--nueva pagina, ingresar datos en poliza-->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<script src="/Ubicaciones/Contabilidad/Reportes/js/Reportes.js"></script>
