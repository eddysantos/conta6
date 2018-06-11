<!--MODULO 3 * MODULO 3 * MODULO 3 * MODULO 3 * MODULO 3 * MODULO 3-->

<!--Sección de Empleados Capturados SueldosySalarios/Empleados.php-->
<div class="modal fade" id="modDatosEmp" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Datos de Empleado</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
      <!--********************************Submenu*******************************-->
          <div class="row submenuMed text-center">
            <div class="col-md-3" role="button">
              <a  id="submenuModal" class="sueldosysalarios" accion="dgen" status="cerrado">Datos Generales</a>
            </div>
            <div class="col-md-3">
              <a id="submenuModal" class="sueldosysalarios" accion="dlab" status="cerrado">Datos Laborales</a>
            </div>
            <div class="col-md-3">
              <a id="submenuModal" class="sueldosysalarios" accion="dsal" status="cerrado">Distr. Salario</a>
            </div>
            <div class="col-md-3">
              <a id="submenuModal" class="sueldosysalarios" accion="suelysal" status="cerrado">Sueldos y Salarios</a>
            </div>
          </div><!--Termina el Submenu-->

            <div id="contorno1" class="contorno" style="display:none">
              <form class="form1">
                <table class="table text-center" id="dtosgenerales">
                  <tbody>
                    <tr class="row mt-4">
                      <td class="col-md-3 input-effect">
                        <input id="name1" class="efecto">
                        <label for="name1">Nombre</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="apater1" class="efecto">
                        <label for="apater1">Apellido Paterno</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="amater1" class="efecto">
                        <label for="amater1">Apellido Materno</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input class="efecto" type="date tiene-contenido" id="fechanacim1">
                        <label for="fechanacim1">Fecha Nacimiento</label>
                      </td>
                    </tr>

                    <tr class="row mt-4">
                      <td class="col-md-3 input-effect">
                        <input id="curp1" class="efecto">
                        <label for="curp1">Curp</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="rfc1" class="efecto">
                        <label for="rfc1">RFC</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="telefono1" class="efecto">
                        <label for="telefono1">Telefono</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="correo1" class="efecto">
                        <label for="correo1">Correo Electronico</label>
                      </td>
                    </tr>

                    <tr class="row mt-4">
                      <td class="col-md-3 input-effect">
                        <input id="calle1" class="efecto">
                        <label for="calle1">Calle</label>
                      </td>
                      <td class="col-md-1 input-effect">
                        <input id="nexterior1" class="efecto">
                        <label for="nexterior1">No.Ext</label>
                      </td>
                      <td class="col-md-1 input-effect">
                        <input id="ninterior1" class="efecto">
                        <label for="ninterior1">No.Int</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="colonia1" class="efecto">
                        <label for="colonia1">Colonia</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="localidad1" class="efecto">
                        <label for="localidad1">Localidad</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="municipio1" class="efecto">
                        <label for="municipio1">Municipio o Delegación</label>
                      </td>
                    </tr>

                    <tr class="row mt-4">
                      <td class="col-md-3 input-effect">
                        <input  list="estado" class="efecto"  id="est1">
                        <datalist id="estado">
                          <option value="Aguascalientes"></option>
                          <option value="Baja California"></option>
                          <option value="Campeche"></option>
                        </datalist>
                        <label for="est1">Seleccione un Estado</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="cp1" class="efecto">
                        <label for="cp1">Codigo Postal</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input  list="entidad" class="efecto"  id="ent1">
                        <datalist id="entidad">
                          <option value="Colima --- COL"></option>
                          <option value="Ciudad de México --- DIF"></option>
                          <option value="Tamaulipas --- TAM"></option>
                          <option value="Veracruz --- VER"></option>
                        </datalist>
                        <label for="ent1">Seleccione una Entidad</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input  list="metpago" class="efecto"  id="mpgo1">
                        <datalist id="metpago">
                          <option value="Cheque"></option>
                          <option value="Efectivo"></option>
                          <option value="Transferencia"></option>
                        </datalist>
                        <label for="mpgo1">Metodo de Pago</label>
                      </td>
                    </tr>

                    <tr class="row mt-4">
                      <td class="col-md-6 input-effect">
                        <input id="cuenta1" class="efecto">
                        <label for="cuenta1">Cuenta / Clabe Interbancaria</label>
                      </td>
                      <td class="col-md-6 input-effect">
                        <input  list="banco" class="efecto"  id="bco1">
                        <datalist id="banco">
                          <option value="Afirme --- 062"></option>
                          <option value="American Express --- 103"></option>
                          <option value="Azteca --- 127"></option>
                          <option value="Bajio --- 030"></option>
                        </datalist>
                        <label for="bco1">Banco</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
              </div>
            </div><!--termina el Container-Fluid-->

            <div id="contorno2" class="contorno" style="display:none">
              <form class="form1">
                <table class="table text-center" id="dtoslaborales">
                  <tbody>
                    <tr class="row mt-4">
                      <td class="col-md-2 input-effect">
                        <input id="ofi1" class="efecto tiene-contenido" type="text" value="240">
                        <label for="ofi1">Oficina</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input  list="depto" class="efecto"  id="dep">
                        <datalist id="depto">
                          <option value="Administración"></option>
                          <option value="Clasificación"></option>
                          <option value="Contabilidad"></option>
                          <option value="Contraloría"></option>
                          <option value="Dirección"></option>
                          <option value="Facturación"></option>
                          <option value="Dirección"></option>
                          <option value="Intendencia"></option>
                          <option value="Operaciones"></option>
                          <option value="Sistemas"></option>
                          <option value="Legal"></option>
                          <option value="Trafico"></option>
                          <option value="Ventas"></option>
                        </datalist>
                        <label for="dep">Departamento</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input id="act1" class="efecto">
                        <label for="act1">Puesto o Actividades</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input class="efecto tiene-contenido" type="date" id="fcontrato1">
                        <label for="fcontrato1">Fecha Contrato</label>
                      </td>
                    </tr>
                    <tr class="row mt-4">
                      <td class="col-md-6 input-effect">
                        <input  list="tcontrato" class="efecto"  id="contrato1">
                        <datalist id="tcontrato">
                          <option value="01 --- Contrato de Trabajo por Tiempo Indeterminado"></option>
                          <option value="02 --- Contrato de Trabajo para Obre Determinada"></option>
                          <option value="03 --- Contrato de Trabajo por Tiempo Determinado"></option>
                          <option value="04 --- Contrato de Trabajo por Temporada"></option>
                          <option value="05 --- Contrato de Trabajo Sujeto a Prueba"></option>
                          <option value="06 --- Contrato de Trabajo con Capatización Inicial"></option>
                          <option value="07 --- Modalidad de Contratación por Pago de Hora Laborada"></option>
                          <option value="08 --- Modalidad de Trabajo por Comision Laboral"></option>
                          <option value="09 --- Modalidades de Contratación donde no Existe Relacion de Trabajo"></option>
                          <option value="10 --- Jubilación, Pensión, Retiro"></option>
                          <option value="99 ---  Otro Contrato"></option>
                        </datalist>
                        <label for="contrato1">Tipo de Contrato</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input  list="jornada" class="efecto"  id="jornada1">
                        <datalist id="jornada">
                          <option value="01 -- Diurna"></option>
                          <option value="02 -- Nocturna"></option>
                          <option value="03 -- Mixta"></option>
                          <option value="04 -- Por Hora"></option>
                          <option value="05 -- Reducida"></option>
                          <option value="06 -- Continuada"></option>
                          <option value="07 -- Partida"></option>
                          <option value="08 -- Por Turnos"></option>
                          <option value="99 -- Otra Jornada"></option>
                        </datalist>
                        <label for="jornada1">Jornada</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input  list="rtrabajo" class="efecto"  id="riesgo1">
                        <datalist id="rtrabajo">
                          <option value="01 -- Clase l"></option>
                          <option value="02 -- Clase ll"></option>
                          <option value="03 -- Clase lll"></option>
                          <option value="04 -- Clase lV"></option>
                          <option value="05 -- Clase V"></option>
                        </datalist>
                        <label for="riesgo1">Riesgo de Trabajo</label>
                      </td>
                    </tr>
                    <tr class="row mt-4">
                      <td class="col-md-4 input-effect">
                        <input  list="perpago" class="efecto"  id="ppago1">
                        <datalist id="perpago">
                          <option value="Diario"></option>
                          <option value="Semanal"></option>
                          <option value="Catorcena"></option>
                        </datalist>
                        <label for="ppago1">Periodo del Págo</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input id="emailAsig1" class="efecto" type="email">
                        <label for="emailAsig1">Correo Asignado</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input class="efecto" id="observ1">
                        <label for="observ1">Observaciones</label>
                      </td>
                    </tr>
                    <tr class="row mt-4">
                      <td class="col-md-4 input-effect">
                        <input  list="estatus" class="efecto"  id="estatus1">
                        <datalist id="estatus">
                          <option value="Activo"></option>
                          <option value="Baja"></option>
                        </datalist>
                        <label for="estatus1">Estatus</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input class="efecto tiene-contenido" type="date" id="fbaja1">
                        <label for="fbaja1">Fecha de Baja</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input  list="Pago" class="efecto"  id="Pago1">
                        <datalist id="Pago">
                          <option value="Si"></option>
                          <option value="No"></option>
                        </datalist>
                        <label for="Pago1">Pagar</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>

            <div id="contorno3" class="contorno text-center" style="display:none">
              <form class="form1">
                <table class="table text-center" id="distsalarios">
                  <tbody>
                    <tr class="row mt-5">
                      <td class="col-md-2 input-effect">
                        <input id="aeropuerto1" class="efecto">
                        <label for="aeropuerto1">Aeropuerto</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="manzanillo1" class="efecto">
                        <label for="manzanillo1">Manzanillo</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="nlaredo1" class="efecto">
                        <label for="nlaredo1">Nuevo Laredo</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="veracruz1" class="efecto">
                        <label for="veracruz1">Veracruz</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="ltexas1" class="efecto">
                        <label for="ltexas1">Laredo Texas</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="total1" class="efecto">
                        <label for="total1">Total</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>

            <div id="contorno4" class="contorno text-center" style="display:none">
              <form class="form1" style="letter-spacing:2px">
                <table class="table text-center" id="sueldosysalarios">
                  <tbody>
                    <tr class="row mt-5">
                      <td class="col-md-3 input-effect">
                        <input id="imss1" class="efecto">
                        <label for="imss1">IMSS</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="infonavit1" class="efecto">
                        <label for="infonavit1">INFONAVIT</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="descuento1" class="efecto">
                        <label for="descuento1">Descuento %</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="cuota1" class="efecto">
                        <label for="cuota1">Cuota</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="vsm1" class="efecto">
                        <label for="vsm1">VSM</label>
                      </td>
                    </tr>

                    <tr class="row mt-4">
                      <td class="col-md-2 input-effect">
                        <input id="mensual1" class="efecto">
                        <label for="mensual1">Salario Mensual</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="diario1" class="efecto">
                        <label for="diario1">Salario Diario</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="dinter1" class="efecto">
                        <label for="dinter1">Factor de Integración</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="adsalint1" class="efecto">
                        <label for="adsalint1">Cuota Adic al Salario Intgra.</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="sintegral1" class="efecto">
                        <label for="sintegral1">Salario Integral</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </div><!--termina el Cuerpo del Modal-->
        <div class="modal-footer">
          <a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/Empleados.php" class="linkbtn">Aceptar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
      </div><!--termina el COntenido del Modal-->
    </div>
  </div>



<!--Sección de Empleados Capturados SueldosySalarios/GenerarNominaCFDI.php-->
<div class="modal fade" id="permanentes" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Datos</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
      <!--********************************Submenu*******************************-->
          <div class="row submenuMed text-center">
            <div class="col-md-6" role="button">
              <a  id="submenuModal" class="sueldosysalarios" accion="perc" status="cerrado">Percepciones</a>
            </div>
            <div class="col-md-6">
              <a id="submenuModal" class="sueldosysalarios" accion="deduc" status="cerrado">Deducciones</a>
            </div>
          </div><!--Termina el Submenu-->
            <div id="contorno5" class="contorno" style="display:none">
              <form class="form1" style="letter-spacing:2px">
                <table class="table mb-0 text-center" id="percepciones">
                  <tbody>
                    <tr class="row">
                      <td class="col-md-2 input-effect">
                        <label class="mb-0 font14" style="color: #d59f9f;">Incapacidad</label>
                        <select class="custom-select" id="inc">
                          <option value="">Si</option>
                          <option value="">No</option>
                        </select>
                      </td>
                      <td class="col-md-1 input-effect mt-3">
                        <input id="dinc" class="efecto">
                        <label for="dinc">Días</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <label class="mb-0 font14" style="color: #d59f9f;">Motivo</label>
                        <select class="custom-select" id="minc">
                          <option value="">01 -- Riesgo de Trabajo</option>
                          <option value="">02 -- Enfermedad</option>
                          <option value="">03 -- Maternidad</option>
                        </select>
                      </td>
                      <td class="col-md-1 ml-5 input-effect">
                        <label class="mb-0 font14" style="color: #d59f9f;">Vales</label>
                        <select class="custom-select" id="val">
                          <option value="">Si</option>
                          <option value="">No</option>
                        </select>
                      </td>
                      <td class="col-md-1 input-effect">
                        <label class="mb-0 font14" style="color: #d59f9f;">Días</label>
                        <select class="custom-select" id="dval">
                          <option value="">1</option>
                          <option value="">2</option>
                          <option value="">3</option>
                          <option value="">4</option>
                          <option value="">5</option>
                          <option value="">6</option>
                          <option value="">7</option>
                          <option value="">8</option>
                          <option value="">9</option>
                          <option value="">10</option>
                          <option value="">11</option>
                          <option value="">12</option>
                          <option value="">13</option>
                          <option value="">14</option>
                          <option value="">15</option>
                        </select>
                      </td>
                      <td class="col-md-1 ml-5 input-effect">
                        <label class="mb-0 font14" style="color: #d59f9f;">Renta</label>
                        <select class="custom-select" id="aren">
                          <option value="">Si</option>
                          <option value="">No</option>
                        </select>
                      </td>
                      <td class="col-md-1 input-effect mt-3">
                        <input id="impren" class="efecto">
                        <label for="impren">Importe</label>
                      </td>
                      <td class="col-md-2 ml-5 input-effect">
                        <label class="mb-0 font14" style="color: #d59f9f;">Subsidio</label>
                        <select class="custom-select" id="sub">
                          <option value="">Si</option>
                          <option value="">No</option>
                        </select>
                      </td>
                    </tr>

                    <tr class="row">
                      <td class="col-md-6 input-effect mt-4">
                        <input  list="ctaempleado" class="efecto"  id="cempleado">
                        <datalist id="ctaempleado">
                          <option value="Centro Internacional de Servicios Fitosanitarios S.A de C.V -- 0115-00077"></option>
                          <option value="Agencia Grupo CSAV México S.A de C.V"></option>
                          <option value="Amanecedora Golmex S.A de C.V"></option>
                        </datalist>
                        <label for="cempleado">Cuenta del Empleado</label>
                      </td>
                      <td class="col-md-3 input-effect mt-1">
                        <label class="mb-0 font14" style="color: #d59f9f;">Prestamo</label>
                        <select class="custom-select" id="prest">
                          <option value="">Si</option>
                          <option value="">No</option>
                        </select>
                      </td>
                      <td class="col-md-3 input-effect mt-4">
                        <input id="importepre" class="efecto text-center">
                        <label for="importepre">Importe</label>
                      </td>
                    </tr>

                    <tr class="row mt-3">
                      <td class="col-md-2 offset-md-1 mt-4">Horas Extras : </td>
                      <td class="col-md-1 input-effect">
                        <label class="mb-0 font14" style="color: #d59f9f;">Días</label>
                        <select class="custom-select" id="ddobles">
                          <option value="">1</option>
                          <option value="">2</option>
                          <option value="">3</option>
                        </select>
                      </td>
                      <td class="col-md-1 input-effect">
                        <label class="mb-0 font14" style="color: #d59f9f;">Dobles</label>
                        <select class="custom-select" id="hdobles">
                          <option value="">1</option>
                          <option value="">2</option>
                          <option value="">3</option>
                          <option value="">4</option>
                          <option value="">5</option>
                          <option value="">6</option>
                          <option value="">7</option>
                          <option value="">8</option>
                          <option value="">9</option>
                        </select>
                      </td>

                      <td class="col-md-1 ml-5 input-effect">
                        <label class="mb-0 font14" style="color: #d59f9f;">Días</label>
                        <select class="custom-select" id="dtriples">
                          <option value="">1</option>
                          <option value="">2</option>
                          <option value="">3</option>
                        </select>
                      </td>
                      <td class="col-md-1 input-effect">
                        <label class="mb-0 font14" style="color: #d59f9f;">Triples</label>
                        <select class="custom-select" id="htriples">
                          <option value="">1</option>
                          <option value="">2</option>
                          <option value="">3</option>
                          <option value="">4</option>
                          <option value="">5</option>
                          <option value="">6</option>
                          <option value="">7</option>
                          <option value="">8</option>
                          <option value="">9</option>
                        </select>
                      </td>

                      <td class="col-md-1 ml-5 input-effect">
                        <label class="mb-0 font14" style="color: #d59f9f;">Días</label>
                        <select class="custom-select" id="dsimples">
                          <option value="">1</option>
                          <option value="">2</option>
                          <option value="">3</option>
                        </select>
                      </td>
                      <td class="col-md-1 input-effect">
                        <label class="mb-0 font14" style="color: #d59f9f;">Triples</label>
                        <select class="custom-select" id="hsimples">
                          <option value="">1</option>
                          <option value="">2</option>
                          <option value="">3</option>
                          <option value="">4</option>
                          <option value="">5</option>
                          <option value="">6</option>
                          <option value="">7</option>
                          <option value="">8</option>
                          <option value="">9</option>
                        </select>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>


            <div id="contorno6" class="contorno" style="display:none">
              <form class="form1">
                <table class="table mb-0 text-center" id="deducciones">
                  <tbody>
                    <tr class="row mt-4">
                      <td class="col-md-2 input-effect">
                        <input id="descuentos" class="efecto">
                        <label for="descuentos">Descuentos</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="prestamos" class="efecto">
                        <label for="prestamos">Prestamos</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="infon" class="efecto">
                        <label for="infon">INFONAVIT</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input  list="pension" class="efecto"  id="pensionAl">
                        <datalist id="pension">
                          <option value="Si"></option>
                          <option value="No"></option>
                        </datalist>
                        <label for="pensionAl">Pensión Alimenticia</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="porcen" class="efecto">
                        <label for="porcen">Porcentaje</label>
                      </td>
                    </tr>
                    <tr class="row mt-4">
                      <td class="col-md-4 input-effect">
                        <input id="otormenor" class="efecto">
                        <label for="otormenor">Otorgado al menor:</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input id="entregadoa" class="efecto">
                        <label for="entregadoa">Entregado a:</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input  list="porrenta" class="efecto"  id="rentadesc">
                        <datalist id="porrenta">
                          <option value="Si"></option>
                          <option value="No"></option>
                        </datalist>
                        <label for="rentadesc">Por Renta</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="descrenta" class="efecto">
                        <label for="descrenta">Importe</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </div><!--termina el Cuerpo del Modal-->
        <div class="modal-footer">
          <a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/GenerarNominaCFDI.php" class="linkbtn">Aceptar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
      </div><!--termina el COntenido del Modal-->
    </div>
  </div>
</div>
