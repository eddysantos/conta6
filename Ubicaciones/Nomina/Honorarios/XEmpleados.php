<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<!-- <div class="container-fluid">
  <div class="row submenuMed m-0">
    <div class="col-md-12 text-center" role="button">
      <a  id="submenuMed" class="honorarios" accion="eCapHon" status="cerrado">EMPLEADOS CAPTURADOS</a>
    </div>
  </div>

  <div id="contorno"  class="contorno mt-5">
    <h5 class="titulo2 font16">REGISTRO EMPLEADOS</h5>
    <div class="acordeon2 text-center">
      <div class="encabezado font16" data-toggle="collapse" href="#collapsegenerales">
        <a href="#">DATOS GENERALES</a>
      </div>
      <div id="collapsegenerales" class="card-block collapse">
        <form class="form1">
          <table class="table text-center">
            <tbody>
              <tr class="row mt-5 m-0">
                <td class="col-md-3 input-effect">
                  <input id="hon_name" class="efecto">
                  <label for="hon_name">Nombre</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="hon_ap" class="efecto">
                  <label for="hon_ap">Apellido Paterno</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="hon_am" class="efecto">
                  <label for="hon_am">Apellido Materno</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input class="efecto tiene-contenido" type="date" id="hon_fn">
                  <label for="hon_fn">Fecha Póliza</label>
                </td>
              </tr>

              <tr class="row mt-4 m-0">
                <td class="col-md-3 input-effect">
                  <input id="hon_curp" class="efecto">
                  <label for="hon_curp">Curp</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="hon_rfc" class="efecto">
                  <label for="hon_rfc">RFC</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="hon_tel" class="efecto">
                  <label for="hon_tel">Telefono</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="hon_em" class="efecto">
                  <label for="hon_em">Correo Electronico</label>
                </td>
              </tr>

              <tr class="row mt-4 m-0">
                <td class="col-md-3 input-effect">
                  <input id="hon_calle" class="efecto">
                  <label for="hon_calle">Calle</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="hon_ne" class="efecto">
                  <label for="hon_ne">No.Ext</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="hon_ni" class="efecto">
                  <label for="hon_ni">No.Int</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="hon_col" class="efecto">
                  <label for="hon_col">Colonia</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="hon_loc" class="efecto">
                  <label for="hon_loc">Localidad</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="hon_mun" class="efecto">
                  <label for="hon_mun">Municipio o Delegación</label>
                </td>
              </tr>

              <tr class="row mt-4 m-0">
                <td class="col-md-3 input-effect">
                  <input  list="estado" class="efecto" id="hon_edo">
                  <datalist id="estado">
                    <option value="Aguascalientes"></option>
                    <option value="Baja California"></option>
                    <option value="Campeche"></option>
                  </datalist>
                  <label for="hon_edo">Seleccione un Estado</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="hon_cp" class="efecto">
                  <label for="hon_cp">Codigo Postal</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input  list="entidad" class="efecto" id="hon_ent">
                  <datalist id="entidad">
                    <option value="Colima - COL"></option>
                    <option value="Ciudad de México - DIF"></option>
                    <option value="Tamaulipas - TAM"></option>
                    <option value="Veracruz - VER"></option>
                  </datalist>
                  <label for="hon_ent">Seleccione una Entidad</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input  list="metpago" class="efecto" id="hon_pgo">
                  <datalist id="metpago">
                    <option value="Cheque"></option>
                    <option value="Efectivo"></option>
                    <option value="Transferencia"></option>
                  </datalist>
                  <label for="hon_pgo">Metodo de Pago</label>
                </td>
              </tr>
              <tr class="row mt-4 m-0">
                <td class="col-md-6 input-effect">
                  <input id="hon_cin" class="efecto">
                  <label for="hon_cin">Cuenta / Clabe Interbancaria</label>
                </td>
                <td class="col-md-6 input-effect">
                  <input  list="banco" class="efecto"  id="hon_bco">
                  <datalist id="banco">
                    <option value="Afirme - 062"></option>
                    <option value="American Express - 103"></option>
                    <option value="Azteca - 127"></option>
                    <option value="Bajio - 030"></option>
                  </datalist>
                  <label for="hon_bco">Banco</label>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 text-center mt-3">
      <div class="encabezado font16" data-toggle="collapse" href="#collapselaborales">
        <a href="#">DATOS LABORALES</a>
      </div>
      <div id="collapselaborales" class="card-block collapse">
        <form  class="form1">
          <table class="table">
            <tbody>
              <tr class="row mt-5 m-0">
                <td class="col-md-2 input-effect">
                  <input id="hon_ofi" class="efecto tiene-contenido">
                  <label for="hon_ofi">Oficina</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input  list="depto" class="efecto" id="hon_dep">
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
                  <label for="hon_dep">Departamento</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="hon_act" class="efecto">
                  <label for="hon_act">Puesto o Actividades</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input class="efecto tiene-contenido" type="date" id="hon_fc">
                  <label for="hon_fc">Fecha Contrato</label>
                </td>
              </tr>

              <tr class="row mt-4 m-0">
                <td class="col-md-6 input-effect">
                  <input  list="tcontrato" class="efecto"  id="hon_con">
                  <datalist id="tcontrato">
                    <option value="01- Contrato de Trabajo por Tiempo Indeterminado"></option>
                    <option value="02- Contrato de Trabajo para Obre Determinada"></option>
                    <option value="03- Contrato de Trabajo por Tiempo Determinado"></option>
                    <option value="04- Contrato de Trabajo por Temporada"></option>
                    <option value="05- Contrato de Trabajo Sujeto a Prueba"></option>
                    <option value="06- Contrato de Trabajo con Capatización Inicial"></option>
                    <option value="07- Modalidad de Contratación por Pago de Hora Laborada"></option>
                    <option value="08- Modalidad de Trabajo por Comision Laboral"></option>
                    <option value="09- Modalidades de Contratación donde no Existe Relacion de Trabajo"></option>
                    <option value="10- Jubilación, Pensión, Retiro"></option>
                    <option value="99-  Otro Contrato"></option>
                  </datalist>
                  <label for="hon_con">Tipo de Contrato</label>
                </td>

                <td class="col-md-3 input-effect">
                  <input  list="jornada" class="efecto" id="hon_jor">
                  <datalist id="jornada">
                    <option value="01 Diurna"></option>
                    <option value="02 Nocturna"></option>
                    <option value="03 Mixta"></option>
                    <option value="04 Por Hora"></option>
                    <option value="05 Reducida"></option>
                    <option value="06 Continuada"></option>
                    <option value="07 Partida"></option>
                    <option value="08 Por Turnos"></option>
                    <option value="99 Otra Jornada"></option>
                  </datalist>
                  <label for="hon_jor">Jornada</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input  list="rtrabajo" class="efecto"  id="hon_rgo">
                  <datalist id="rtrabajo">
                    <option value="01 - Clase l"></option>
                    <option value="02 - Clase ll"></option>
                    <option value="03 - Clase lll"></option>
                    <option value="04 - Clase lV"></option>
                    <option value="05 - Clase V"></option>
                  </datalist>
                  <label for="hon_rgo">Riesgo de Trabajo</label>
                </td>
              </tr>

              <tr class="row mt-4 m-0">
                <td class="col-md-4 input-effect">
                  <input  list="perpago" class="efecto"  id="hon_pp">
                  <datalist id="perpago">
                    <option value="Diario"></option>
                    <option value="Semanal"></option>
                    <option value="Catorcena"></option>
                  </datalist>
                  <label for="hon_pp">Periodo del Págo</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="hon_ema" class="efecto" type="email">
                  <label for="hon_ema">Correo Asignado</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input class="efecto" id="hon_obs">
                  <label for="hon_obs">Observaciones</label>
                </td>
              </tr>

              <tr class="row mt-4 m-0">
                <td class="col-md-4 input-effect">
                  <input  list="estatus" class="efecto"  id="hon_st">
                  <datalist id="estatus">
                    <option value="Activo"></option>
                    <option value="Baja"></option>
                  </datalist>
                  <label for="hon_st">Estatus</label>
                </td>

                <td class="col-md-4 input-effect">
                  <input class="efecto tiene-contenido" type="date" id="hon_fb">
                  <label for="hon_fb">Fecha de Baja</label>
                </td>

                <td class="col-md-4 input-effect">
                  <input  list="Pago" class="efecto"  id="hon_pagar">
                  <datalist id="Pago">
                    <option value="Si"></option>
                    <option value="No"></option>
                  </datalist>
                  <label for="hon_pagar">Pagar</label>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 text-center mt-3">
      <div class="encabezado font16" data-toggle="collapse" href="#collapsetres">
        <a href="#">DISTRIBUCION DE SALARIO</a>
      </div>
      <div id="collapsetres" class="card-block collapse">
        <form class="form1">
          <table class="table text-center">
            <tbody>
              <tr class="row mt-5 m-0">
                <td class="col-md-2 input-effect">
                  <input id="hon_aer" class="efecto">
                  <label for="hon_aer">Aeropuerto</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="hon_mzo" class="efecto">
                  <label for="hon_mzo">Manzanillo</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="hon_nl" class="efecto">
                  <label for="hon_nl">Nuevo Laredo</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="hon_vcz" class="efecto">
                  <label for="hon_vcz">Veracruz</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="hon_ldo" class="efecto">
                  <label for="hon_ldo">Laredo Texas</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="hon_tot" class="efecto">
                  <label for="hon_tot">Total</label>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 text-center mt-3">
      <div class="encabezado font16" data-toggle="collapse" href="#collapsehonasim">
        <a href="#">HONORARIOS ASIMILADOS A SALARIOS</a>
      </div>
      <div id="collapsehonasim" class="card-block collapse">
        <form class="form1">
          <table class="table">
            <tbody>
              <tr class="row mt-5 justify-content-center">
                <td class="col-md-3 input-effect">
                  <input id="hon_sal" class="efecto">
                  <label for="hon_sal">Salario</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="hon_isr" class="efecto">
                  <label for="hon_isr">ISR</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="hon_spgo" class="efecto">
                  <label for="hon_spgo">Salario a Pagar</label>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
    <div class="col-md-4 offset-md-4 mt-5 font16 text-center">
        <a href="" class="boton"><img src= "/conta6/Resources/iconos/save.svg" class="icochico"> GUARDAR DATOS</a><!-Guardar Datos de poliza/cuando se actualizo algun dato-->
    <!-- </div>
  </div>

  <div id="contornoEmpHon" class="contorno mt-5" style="display:none">
    <h5 class="titulo2 font16">EMPLEADOS CAPTURADOS</h5>
    <table class="table text-center table-hover">
      <thead>
        <tr class="row encabezado font16">
          <td class="col-md-1">Datos</td>
          <td class="col-md-1">Estatus</td>
          <td class="col-md-1">Pagar</td>
          <td class="col-md-1">No.Emp.</td>
          <td class="col-md-6">Empleado</td>
          <td class="col-md-2">Salario</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row text-center borderojo">
          <td class="col-md-1">
            <a href="#modDatosEmpHon" data-toggle="modal">
              <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
            </a>
          </td>
          <td class="col-md-1">Activo</td>
          <td class="col-md-1">Si</td>
          <td class="col-md-1">224</td>
          <td class="col-md-6">Adriana Mariaca Dominguez</td>
          <td class="col-md-2">4200.00</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>  -->



<script src="/conta6/Resources/js/Inputs.js"></script>
<script src="js/Honorarios.js"></script>
<?php include_once('modales/EmpleadosHon.php'); ?>
