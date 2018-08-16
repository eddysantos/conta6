<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<link rel="stylesheet" href="/conta6/Resources/css/inputs.css">

<div class="container-fluid">
  <div class="row submenuMed m-0">
    <div class="col-md-12 text-center" role="button">
      <a  id="submenuMed" class="sueldosysalarios" accion="eCap" status="cerrado">EMPLEADOS CAPTURADOS</a>
    </div>
  </div>

  <div id="contorno" class="contorno">
    <h5 class="titulo2 font14">REGISTRO EMPLEADOS</h5>

<!-- COMIENZA DATOS GENERALES  -->
    <div class="encabezado font16" data-toggle="collapse" href="#datosGen">
      <a href="#">DATOS GENERALES</a>
    </div>
    <div id="datosGen" class="card-block collapse">
      <form class="form1">
        <table class="table  text-center">
          <tbody>
            <tr class="row mt-5 m-0">
              <td class="col-md-3 input-effect">
                <input id="name" class="efecto">
                <label for="name">Nombre</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="apater" class="efecto">
                <label for="apater">Apellido Paterno</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="amater" class="efecto">
                <label for="amater">Apellido Materno</label>
              </td>
              <td class="col-md-3 input-effect">
                <input class="efecto tiene-contenido" type="date" id="fechanacim">
                <label for="fechanacim">Fecha Póliza</label>
              </td>
            </tr>

            <tr class="row mt-4 m-0">
              <td class="col-md-3 input-effect">
                <input id="curp" class="efecto">
                <label for="curp">Curp</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="rfc" class="efecto">
                <label for="rfc">RFC</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="telefono" class="efecto">
                <label for="telefono">Telefono</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="correo" class="efecto">
                <label for="correo">Correo Electronico</label>
              </td>
            </tr>

            <tr class="row mt-4 m-0">
              <td class="col-md-3 input-effect">
                <input id="calle" class="efecto">
                <label for="calle">Calle</label>
              </td>
              <td class="col-md-1 input-effect">
                <input id="nexterior" class="efecto">
                <label for="nexterior">No.Ext</label>
              </td>
              <td class="col-md-1 input-effect">
                <input id="ninterior" class="efecto">
                <label for="ninterior">No.Int</label>
              </td>
              <td class="col-md-2 input-effect">
                <input id="colonia" class="efecto">
                <label for="colonia">Colonia</label>
              </td>
              <td class="col-md-2 input-effect">
                <input id="localidad" class="efecto">
                <label for="localidad">Localidad</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="municipio" class="efecto">
                <label for="municipio">Municipio o Delegación</label>
              </td>
            </tr>

            <tr class="row mt-4 m-0">
              <td class="col-md-3 input-effect">
                <input  list="estado" class="efecto" id="est">
                <datalist id="estado">
                  <option value="Aguascalientes"></option>
                  <option value="Baja California"></option>
                  <option value="Campeche"></option>
                </datalist>
                <label for="est">Seleccione un Estado</label>
              </td>
              <td class="col-md-2 input-effect">
                <input id="cp" class="efecto">
                <label for="cp">Codigo Postal</label>
              </td>
              <td class="col-md-4 input-effect">
                <input  list="entidad" class="efecto" id="ent">
                <datalist id="entidad">
                  <option value="Colima --- COL"></option>
                  <option value="Ciudad de México --- DIF"></option>
                  <option value="Tamaulipas --- TAM"></option>
                  <option value="Veracruz --- VER"></option>
                </datalist>
                <label for="ent">Seleccione una Entidad</label>
              </td>
              <td class="col-md-3 input-effect">
                <input  list="metpago" class="efecto" id="mpgo">
                <datalist id="metpago">
                  <option value="Cheque"></option>
                  <option value="Efectivo"></option>
                  <option value="Transferencia"></option>
                </datalist>
                <label for="mpgo">Metodo de Pago</label>
              </td>
            </tr>
            <tr class="row mt-4 m-0">
              <td class="col-md-6 input-effect">
                <input id="cuenta" class="efecto">
                <label for="cuenta">Cuenta / Clabe Interbancaria</label>
              </td>
              <td class="col-md-6 input-effect">
                <input  list="banco" class="efecto"  id="bco">
                <datalist id="banco">
                  <option value="Afirme --- 062"></option>
                  <option value="American Express --- 103"></option>
                  <option value="Azteca --- 127"></option>
                  <option value="Bajio --- 030"></option>
                </datalist>
                <label for="bco">Banco</label>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>

<!--COMIENZA DATOS LABORALES  -->
    <div class="encabezado font16 mt-3" data-toggle="collapse" href="#datosLaborales">
      <a href="#">DATOS LABORALES</a>
    </div>
    <div id="datosLaborales" class="card-block collapse">
      <form class="form1">
        <table class="table text-center">
          <tbody>
            <tr class="row mt-5 m-0">
              <td class="col-md-2 input-effect">
                <input id="ofi" class="efecto tiene-contenido">
                <label for="ofi">Oficina</label>
              </td>
              <td class="col-md-3 input-effect">
                <input  list="depto" class="efecto" id="depa">
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
                <label for="depa">Departamento</label>
              </td>
              <td class="col-md-4 input-effect">
                <input id="act" class="efecto">
                <label for="act">Puesto o Actividades</label>
              </td>
              <td class="col-md-3 input-effect">
                <input class="efecto tiene-contenido" type="date" id="fcontrato">
                <label for="fcontrato">Fecha Contrato</label>
              </td>
            </tr>

            <tr class="row mt-4 m-0">
              <td class="col-md-6 input-effect">
                <input  list="tcontrato" class="efecto" id="contrato">
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
                <label for="contrato">Tipo de Contrato</label>
              </td>

              <td class="col-md-3 input-effect">
                <input  list="jornada" class="efecto" id="jornada">
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
                <label for="jornada">Jornada</label>
              </td>
              <td class="col-md-3 input-effect">
                <input  list="rtrabajo" class="efecto" id="riesgo">
                <datalist id="rtrabajo">
                  <option value="01 -- Clase l"></option>
                  <option value="02 -- Clase ll"></option>
                  <option value="03 -- Clase lll"></option>
                  <option value="04 -- Clase lV"></option>
                  <option value="05 -- Clase V"></option>
                </datalist>
                <label for="riesgo">Riesgo de Trabajo</label>
              </td>
            </tr>

            <tr class="row mt-4 m-0">
              <td class="col-md-4 input-effect">
                <input  list="perpago" class="efecto" id="ppago">
                <datalist id="perpago">
                  <option value="Diario"></option>
                  <option value="Semanal"></option>
                  <option value="Catorcena"></option>
                </datalist>
                <label for="ppago">Periodo del Págo</label>
              </td>
              <td class="col-md-4 input-effect">
                <input id="emailAsig" class="efecto" type="email">
                <label for="emailAsig">Correo Asignado</label>
              </td>
              <td class="col-md-4 input-effect">
                <input class="efecto" id="observ">
                <label for="observ">Observaciones</label>
              </td>
            </tr>

            <tr class="row mt-4 m-0">
              <td class="col-md-4 input-effect">
                <input  list="estatus" class="efecto" id="estatus">
                <datalist id="estatus">
                  <option value="Activo"></option>
                  <option value="Baja"></option>
                </datalist>
                <label for="estatus">Estatus</label>
              </td>

              <td class="col-md-4 input-effect">
                <input class="efecto tiene-contenido" type="date" id="fbaja">
                <label for="fbaja">Fecha de Baja</label>
              </td>

              <td class="col-md-4 input-effect">
                <input  list="Pago" class="efecto" id="Pago">
                <datalist id="Pago">
                  <option value="Si"></option>
                  <option value="No"></option>
                </datalist>
                <label for="Pago">Pagar</label>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>


<!--COMIENZA DISTRIBUCION DE SALARIO  -->
    <div class="encabezado font16 mt-3" data-toggle="collapse" href="#distSalario">
      <a href="#">DISTRIBUCION DE SALARIO</a>
    </div>
    <div id="distSalario" class="card-block collapse">
      <form class="form1">
        <table class="table text-center">
          <tbody>
            <tr class="row mt-5 m-0">
              <td class="col-md-2 input-effect">
                <input id="aeropuerto" class="efecto">
                <label for="aeropuerto">Aeropuerto</label>
              </td>
              <td class="col-md-2 input-effect">
                <input id="manzanillo" class="efecto">
                <label for="manzanillo">Manzanillo</label>
              </td>
              <td class="col-md-2 input-effect">
                <input id="nlaredo" class="efecto">
                <label for="nlaredo">Nuevo Laredo</label>
              </td>
              <td class="col-md-2 input-effect">
                <input id="veracruz" class="efecto">
                <label for="veracruz">Veracruz</label>
              </td>
              <td class="col-md-2 input-effect">
                <input id="ltexas" class="efecto">
                <label for="ltexas">Laredo Texas</label>
              </td>
              <td class="col-md-2 input-effect">
                <input id="total" class="efecto">
                <label for="total">Total</label>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>

<!--COMIENZA SUELDOS Y SALARIOS  -->
    <div class="encabezado font16 mt-3" data-toggle="collapse" href="#suelysal">
      <a href="#">SUELDOS Y SALARIOS</a>
    </div>
    <div id="suelysal" class="card-block collapse">
      <form class="form1">
        <table class="table text-center">
          <tbody>
            <tr class="row mt-5 m-0">
              <td class="col-md-3 input-effect">
                <input id="imss" class="efecto">
                <label for="imss">IMSS</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="infonavit" class="efecto">
                <label for="infonavit">INFONAVIT</label>
              </td>
              <td class="col-md-2 input-effect">
                <input id="descuento" class="efecto">
                <label for="descuento">Descuento %</label>
              </td>
              <td class="col-md-2 input-effect">
                <input id="cuota" class="efecto">
                <label for="cuota">Cuota</label>
              </td>
              <td class="col-md-2 input-effect">
                <input id="vsm" class="efecto">
                <label for="vsm">VSM</label>
              </td>
            </tr>

            <tr class="row mt-4 m-0">
              <td class="col-md-2 input-effect">
                <input id="mensual" class="efecto">
                <label for="mensual">Salario Mensual</label>
              </td>
              <td class="col-md-2 input-effect">
                <input id="diario" class="efecto">
                <label for="diario">Salario Diario</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="dinter" class="efecto">
                <label for="dinter">Factor de Integración</label>
              </td>
              <td class="col-md-3 input-effect">
                <input id="adsalint" class="efecto">
                <label for="adsalint">Cuota Adic al Salario Intgra.</label>
              </td>
              <td class="col-md-2 input-effect">
                <input id="sintegral" class="efecto">
                <label for="sintegral">Salario Integral</label>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>

    <div class="col-md-4 offset-md-4 text-center mt-4 font16">
        <a href="" class="boton "> <img src= "/conta6/Resources/iconos/save.svg" class="icochico"> GUARDAR DATOS</a><!--Guardar Datos de poliza/cuando se actualizo algun dato-->
    </div>
  </div>

  <div id="contornoEmp" class="contorno mt-5" style="display:none">
    <h5 class="titulo2 font16">EMPLEADOS CAPTURADOS</h5>
    <table class="table text-center table-hover" id="empleadosCap">
      <thead>
        <tr class="row encabezado font14">
          <td class="col-md-1">Datos</td>
          <td class="col-md-1">Estatus</td>
          <td class="col-md-1">Pagar</td>
          <td class="col-md-1">No.Emp.</td>
          <td class="col-md-6">Empleado</td>
          <td class="col-md-1">Salario</td>
          <td class="col-md-1">Integrado</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row borderojo">
          <td class="col-md-1">
            <a href="#modDatosEmp" data-toggle="modal">
              <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
            </a>
          </td>
          <td class="col-md-1">Activo</td>
          <td class="col-md-1">Si</td>
          <td class="col-md-1">426</td>
          <td class="col-md-6">Agustin Alejandro Hernandez Uvaldo</td>
          <td class="col-md-1">250.00</td>
          <td class="col-md-1">261.00</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>



<script src="/conta6/Resources/js/Inputs.js"></script>
<script src="js/SueldosySalarios.js"></script>
<?php include_once('modales/Empleados.php'); ?>
