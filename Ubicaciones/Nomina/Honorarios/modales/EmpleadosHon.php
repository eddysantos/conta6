<!--MODULO 3 * MODULO 3 * MODULO 3 * MODULO 3 * MODULO 3 * MODULO 3-->

<!--Sección de Empleados Capturados SueldosySalarios/Empleados.php-->
<div class="modal fade" id="modDatosEmpHon" style="margin-top:50px">
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
          <div class="row submenuMed m-0">
            <div class="col-3 text-center" role="button">
                <a  id="submenuModal2" class="honorarios" accion="dgenHon" status="cerrado">Datos Generales</a>
              </div>
              <div class="col-3 text-center">
                <a id="submenuModal2" class="honorarios" accion="dlabHon" status="cerrado">Datos Laborales</a>
              </div>
              <div class="col-2 text-center">
                <a id="submenuModal2" class="honorarios" accion="dsalHon" status="cerrado">Distr. Salario</a>
              </div>
              <div class="col-4 text-center">
                <a id="submenuModal2" class="honorarios" accion="Hon" status="cerrado">Honorarios Asimilados a Salarios</a>
              </div>
            </div><!--Termina el Submenu-->

            <div id="hon_dg" class="contorno" style="display:none">
              <form class="form1">
                <table class="table text-center"  id="dtosgeneralesHon">
                  <tbody>
                    <tr class="row brx2">
                      <td class="col-md-3 input-effect">
                        <input id="mhon_nm" class="efecto text-center">
                        <label for="mhon_nm">Nombre</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="mhon_ap" class="efecto text-center">
                        <label for="mhon_ap">Apellido Paterno</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="mhon_am" class="efecto text-center">
                        <label for="mhon_am">Apellido Materno</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input class="efecto text-center data-date" type="text" onfocus="(this.type='date')" id="mhon_nac">
                        <label for="mhon_nac">Fecha Nacimiento</label>
                      </td>
                    </tr>

                    <tr class="row brx2">
                      <td class="col-md-3 input-effect">
                        <input id="mhon_curp" class="efecto text-center">
                        <label for="mhon_curp">Curp</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="mhon_rfc" class="efecto text-center">
                        <label for="mhon_rfc">RFC</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="mhon_tel" class="efecto text-center">
                        <label for="mhon_tel">Telefono</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="mhon_em" class="efecto text-center">
                        <label for="mhon_em">Correo Electronico</label>
                      </td>
                    </tr>

                    <tr class="row brx2">
                      <td class="col-md-3 input-effect">
                        <input id="mhon_calle" class="efecto text-center">
                        <label for="mhon_calle">Calle</label>
                      </td>
                      <td class="col-md-1 input-effect">
                        <input id="mhon_ne" class="efecto text-center">
                        <label for="mhon_ne">No.Ext</label>
                      </td>
                      <td class="col-md-1 input-effect">
                        <input id="mhon_ni" class="efecto text-center">
                        <label for="mhon_ni">No.Int</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="mhon_col" class="efecto text-center">
                        <label for="mhon_col">Colonia</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="mhon_loc" class="efecto text-center">
                        <label for="mhon_loc">Localidad</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="mhon_mun" class="efecto text-center">
                        <label for="mhon_mun">Municipio o Delegación</label>
                      </td>
                    </tr>

                    <tr class="row brx2">
                      <td class="col-md-3 input-effect">
                        <input  list="estado_hon" class="text-normal efecto text-center"  id="mhon_est">
                        <datalist id="estado_hon">
                          <option value="Aguascalientes"></option>
                          <option value="Baja California"></option>
                          <option value="Campeche"></option>
                        </datalist>
                        <label for="mhon_est">Seleccione un Estado</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="mhon_cp" class="efecto text-center">
                        <label for="mhon_cp">Codigo Postal</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input  list="entidad_hon" class="text-normal efecto text-center"  id="mhon_ent">
                        <datalist id="entidad_hon">
                          <option value="Colima --- COL"></option>
                          <option value="Ciudad de México --- DIF"></option>
                          <option value="Tamaulipas --- TAM"></option>
                          <option value="Veracruz --- VER"></option>
                        </datalist>
                        <label for="mhon_ent">Seleccione una Entidad</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input  list="h_metpago" class="text-normal efecto text-center"  id="mhon_mp">
                        <datalist id="h_metpago">
                          <option value="Cheque"></option>
                          <option value="Efectivo"></option>
                          <option value="Transferencia"></option>
                        </datalist>
                        <label for="mhon_mp">Metodo de Pago</label>
                      </td>
                    </tr>


                    <tr class="row brx2">
                      <td class="col-md-6 input-effect">
                        <input id="mhon_cin" class="efecto text-center">
                        <label for="mhon_cin">Cuenta / Clabe Interbancaria</label>
                      </td>
                      <td class="col-md-6 input-effect">
                        <input  list="h_banco" class="text-normal efecto text-center"  id="mhon_bco">
                        <datalist id="h_banco">
                          <option value="Afirme --- 062"></option>
                          <option value="American Express --- 103"></option>
                          <option value="Azteca --- 127"></option>
                          <option value="Bajio --- 030"></option>
                        </datalist>
                        <label for="mhon_bco">Banco</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
              </div>
            </div><!--termina el Container-Fluid-->

            <div id="hon_dl" class="contorno" style="display:none">
              <form class="form1">
                <table class="table text-center" id="dtoslaboralesHon">
                  <tbody>
                    <tr class="row brx2">
                      <td class="col-md-2 input-effect">
                        <input id="mhon_ofi" class="efecto text-center tiene-contenido" type="text" value="240">
                        <label for="mhon_ofi">Oficina</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input  list="h_depto" class="text-normal efecto text-center"  id="mhon_dep">
                        <datalist id="h_depto">
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
                        <label for="mhon_dep">Departamento</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input id="hon_act" class="efecto text-center">
                        <label for="hon_act">Puesto o Actividades</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input class="efecto text-center data-date" type="text" onfocus="(this.type='date')" id="mhon_fc">
                        <label for="mhon_fc">Fecha Contrato</label>
                      </td>
                    </tr>

                    <tr class="row brx2">
                      <td class="col-md-6 input-effect">
                        <input  list="hcontrato" class="text-normal efecto text-center"  id="mhon_tc">
                        <datalist id="hcontrato">
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
                        <label for="mhon_tc">Tipo de Contrato</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input  list="hjornada" class="text-normal efecto text-center"  id="mhon_j">
                        <datalist id="hjornada">
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
                        <label for="mhon_j">Jornada</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input  list="hriesgo" class="text-normal efecto text-center"  id="mhon_rt">
                        <datalist id="hriesgo">
                          <option value="01 -- Clase l"></option>
                          <option value="02 -- Clase ll"></option>
                          <option value="03 -- Clase lll"></option>
                          <option value="04 -- Clase lV"></option>
                          <option value="05 -- Clase V"></option>
                        </datalist>
                        <label for="mhon_rt">Riesgo de Trabajo</label>
                      </td>
                    </tr>

                    <tr class="row brx3">
                      <td class="col-md-4 input-effect">
                        <input  list="hperiodo" class="text-normal efecto text-center"  id="mhon_pp">
                        <datalist id="hperiodo">
                          <option value="Diario"></option>
                          <option value="Semanal"></option>
                          <option value="Catorcena"></option>
                        </datalist>
                        <label for="mhon_pp">Periodo del Págo</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input id="mhon_ca" class="efecto text-center" type="email">
                        <label for="mhon_ca">Correo Asignado</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input class="efecto text-center data-date" id="mhon_obs">
                        <label for="mhon_obs">Observaciones</label>
                      </td>
                    </tr>

                    <tr class="row brx3">
                      <td class="col-md-4 input-effect">
                        <input  list="hstatus" class="text-normal efecto text-center"  id="mhon_st">
                        <datalist id="hstatus">
                          <option value="Activo"></option>
                          <option value="Baja"></option>
                        </datalist>
                        <label for="mhon_st">Estatus</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input class="efecto text-center data-date" type="text" onfocus="(this.type='date')" id="mhon_fbaja">
                        <label for="mhon_fbaja">Fecha de Baja</label>
                      </td>
                      <td class="col-md-4 input-effect">
                        <input  list="hpago" class="text-normal efecto text-center"  id="mhon_pgo">
                        <datalist id="hpago">
                          <option value="Si"></option>
                          <option value="No"></option>
                        </datalist>
                        <label for="mhon_pgo">Pagar</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>

            <div id="hon_ds" class="contorno" style="display:none">
              <form class="form1">
                <table class="table text-center" id="distsalariosHon">
                  <tbody>
                    <tr class="row brx2">
                      <td class="col-md-2 input-effect">
                        <input id="mhon_aer" class="efecto text-center">
                        <label for="mhon_aer">Aeropuerto</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="mhon_mzo" class="efecto text-center">
                        <label for="mhon_mzo">Manzanillo</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="mhon_nl" class="efecto text-center">
                        <label for="mhon_nl">Nuevo Laredo</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="mhon_vcz" class="efecto text-center">
                        <label for="mhon_vcz">Veracruz</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="mhon_ldo" class="efecto text-center">
                        <label for="mhon_ldo">Laredo Texas</label>
                      </td>
                      <td class="col-md-2 input-effect">
                        <input id="mhon_tot" class="efecto text-center">
                        <label for="mhon_tot">Total</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>

            <div id="hon_has" class="contorno" style="display:none">
              <form class="form1">
                <table class="table text-center">
                  <tbody>
                    <tr class="row brx2 justify-content-center">
                      <td class="col-md-3 offset-md-1 input-effect">
                        <input id="mhon_sal" class="efecto text-center">
                        <label for="mhon_sal">Salario</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="mhon_isr" class="efecto text-center">
                        <label for="mhon_isr">ISR</label>
                      </td>
                      <td class="col-md-3 input-effect">
                        <input id="mhon_spgo" class="efecto text-center">
                        <label for="mhon_spgo">Salario a Pagar</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </div><!--termina el Cuerpo del Modal-->
        <div class="modal-footer">
          <a href="/conta6/Ubicaciones/Nomina/Honorarios/Empleados.php" id="btn">Aceptar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
      </div><!--termina el COntenido del Modal-->
    </div>
  </div>
</div>
