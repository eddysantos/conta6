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

  <div id="contorno" class="contorno brx2">
  <h5 class="titulo2" style="font-size:15px">REGISTRO EMPLEADOS</h5>
    <div class="acordeon2 text-center">
      <div class="encabezado" data-toggle="collapse" href="#datosGen">
        <a  id="bread">DATOS GENERALES</a>
      </div>
      <div id="datosGen" class="card-block collapse">
        <form style="line-height: 0.4;letter-spacing: 3px">
          <table class="table new">
            <tbody>
              <tr class="row brx4">
                <td class="col-md-3 input-effect">
                  <input id="name" class="efecto text-center">
                  <label for="name">Nombre</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="apater" class="efecto text-center">
                  <label for="apater">Apellido Paterno</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="amater" class="efecto text-center">
                  <label for="amater">Apellido Materno</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input class="efecto text-center data-date" type="text" onfocus="(this.type='date')" id="fechanacim">
                  <label for="fechanacim">Fecha Póliza</label>
                </td>
              </tr>

              <tr class="row brx3">
                <td class="col-md-3 input-effect">
                  <input id="curp" class="efecto text-center">
                  <label for="curp">Curp</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="rfc" class="efecto text-center">
                  <label for="rfc">RFC</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="telefono" class="efecto text-center">
                  <label for="telefono">Telefono</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="correo" class="efecto text-center">
                  <label for="correo">Correo Electronico</label>
                </td>
              </tr>

              <tr class="row brx3">
                <td class="col-md-3 input-effect">
                  <input id="calle" class="efecto text-center">
                  <label for="calle">Calle</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="nexterior" class="efecto text-center">
                  <label for="nexterior">No.Ext</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="ninterior" class="efecto text-center">
                  <label for="ninterior">No.Int</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="colonia" class="efecto text-center">
                  <label for="colonia">Colonia</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="localidad" class="efecto text-center">
                  <label for="localidad">Localidad</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="municipio" class="efecto text-center">
                  <label for="municipio">Municipio o Delegación</label>
                </td>
              </tr>

              <tr class="row brx3">
                <td class="col-md-3 input-effect">
                  <input  list="estado" class="text-normal efecto text-center"  id="est">
                  <datalist id="estado">
                    <option value="Aguascalientes"></option>
                    <option value="Baja California"></option>
                    <option value="Campeche"></option>
                  </datalist>
                  <label for="est">Seleccione un Estado</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="cp" class="efecto text-center">
                  <label for="cp">Codigo Postal</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input  list="entidad" class="text-normal efecto text-center"  id="ent">
                  <datalist id="entidad">
                    <option value="Colima --- COL"></option>
                    <option value="Ciudad de México --- DIF"></option>
                    <option value="Tamaulipas --- TAM"></option>
                    <option value="Veracruz --- VER"></option>
                  </datalist>
                  <label for="ent">Seleccione una Entidad</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input  list="metpago" class="text-normal efecto text-center"  id="mpgo">
                  <datalist id="metpago">
                    <option value="Cheque"></option>
                    <option value="Efectivo"></option>
                    <option value="Transferencia"></option>
                  </datalist>
                  <label for="mpgo">Metodo de Pago</label>
                </td>
              </tr>
              <tr class="row brx3">
                <td class="col-md-6 input-effect">
                  <input id="cuenta" class="efecto text-center">
                  <label for="cuenta">Cuenta / Clabe Interbancaria</label>
                </td>
                <td class="col-md-6 input-effect">
                  <input  list="banco" class="text-normal efecto text-center"  id="bco">
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
    </div>

    <div class="acordeon2 text-center brx1">
      <div class="encabezado" data-toggle="collapse" href="#datosLaborales">
        <a  id="bread">DATOS LABORALES</a>
      </div>
      <div id="datosLaborales" class="card-block collapse">
        <form method="post" style="line-height: 0.4;letter-spacing: 3px">
          <table class="table new">
            <tbody>
              <tr class="row brx4">
                <td class="col-md-2 input-effect">
                  <input id="ofi" class="efecto text-center tiene-contenido">
                  <label for="ofi">Oficina</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input  list="depto" class="text-normal efecto text-center"  id="depa">
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
                  <input id="act" class="efecto text-center">
                  <label for="act">Puesto o Actividades</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input class="efecto text-center data-date" type="text" onfocus="(this.type='date')" id="fcontrato">
                  <label for="fcontrato">Fecha Contrato</label>
                </td>
              </tr>

              <tr class="row brx3">
                <td class="col-md-6 input-effect">
                  <input  list="tcontrato" class="text-normal efecto text-center"  id="contrato">
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
                  <input  list="jornada" class="text-normal efecto text-center"  id="jornada">
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
                  <input  list="rtrabajo" class="text-normal efecto text-center"  id="riesgo">
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

              <tr class="row brx3">
                <td class="col-md-4 input-effect">
                  <input  list="perpago" class="text-normal efecto text-center"  id="ppago">
                  <datalist id="perpago">
                    <option value="Diario"></option>
                    <option value="Semanal"></option>
                    <option value="Catorcena"></option>
                  </datalist>
                  <label for="ppago">Periodo del Págo</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="emailAsig" class="efecto text-center" type="email">
                  <label for="emailAsig">Correo Asignado</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input class="efecto text-center data-date" id="observ">
                  <label for="observ">Observaciones</label>
                </td>
              </tr>

              <tr class="row brx3">
                <td class="col-md-4 input-effect">
                  <input  list="estatus" class="text-normal efecto text-center"  id="estatus">
                  <datalist id="estatus">
                    <option value="Activo"></option>
                    <option value="Baja"></option>
                  </datalist>
                  <label for="estatus">Estatus</label>
                </td>

                <td class="col-md-4 input-effect">
                  <input class="efecto text-center data-date" type="text" onfocus="(this.type='date')" id="fbaja">
                  <label for="fbaja">Fecha de Baja</label>
                </td>

                <td class="col-md-4 input-effect">
                  <input  list="Pago" class="text-normal efecto text-center"  id="Pago">
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
    </div>

    <div class="acordeon2 text-center brx1">
      <div class="encabezado" data-toggle="collapse" href="#distSalario">
        <a  id="bread">DISTRIBUCION DE SALARIO</a>
      </div>
      <div id="distSalario" class="card-block collapse ml-20">
        <form method="post" style="line-height: 0.4;letter-spacing: 3px">
          <table class="table new m-0">
            <tbody>
              <tr class="row brx3">
                <td class="col-md-2 input-effect">
                  <input id="aeropuerto" class="efecto text-center">
                  <label for="aeropuerto">Aeropuerto</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="manzanillo" class="efecto text-center">
                  <label for="manzanillo">Manzanillo</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="nlaredo" class="efecto text-center">
                  <label for="nlaredo">Nuevo Laredo</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="veracruz" class="efecto text-center">
                  <label for="veracruz">Veracruz</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="ltexas" class="efecto text-center">
                  <label for="ltexas">Laredo Texas</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="total" class="efecto text-center">
                  <label for="total">Total</label>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 text-center brx1">
      <div class="encabezado" data-toggle="collapse" href="#suelysal">
        <a  id="bread">SUELDOS Y SALARIOS</a>
      </div>
      <div id="suelysal" class="card-block collapse">
        <form style="line-height: 0.4;letter-spacing: 3px">
          <table class="table new">
            <tbody>
              <tr class="row brx3">
                <td class="col-md-3 input-effect">
                  <input id="imss" class="efecto text-center">
                  <label for="imss">IMSS</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="infonavit" class="efecto text-center">
                  <label for="infonavit">INFONAVIT</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="descuento" class="efecto text-center">
                  <label for="descuento">Descuento %</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="cuota" class="efecto text-center">
                  <label for="cuota">Cuota</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="vsm" class="efecto text-center">
                  <label for="vsm">VSM</label>
                </td>
              </tr>

              <tr class="row brx2">
                <td class="col-md-2 input-effect">
                  <input id="mensual" class="efecto text-center">
                  <label for="mensual">Salario Mensual</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="diario" class="efecto text-center">
                  <label for="diario">Salario Diario</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="dinter" class="efecto text-center">
                  <label for="dinter">Factor de Integración</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="adsalint" class="efecto text-center">
                  <label for="adsalint">Cuota Adic al Salario Intgra.</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="sintegral" class="efecto text-center">
                  <label for="sintegral">Salario Integral</label>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="col-md-4 offset-md-4 text-center brx2" style="font-size: 16px;">
        <a href="" class="boton btn-block "> <img src= "/conta6/Resources/iconos/save.svg" class="icochico"> GUARDAR DATOS</a><!--Guardar Datos de poliza/cuando se actualizo algun dato-->
    </div>
  </div>

  <div id="contornoEmp" class="contorno brx4" style="display:none">
    <h5 class="titulo2" style="font-size:15px">EMPLEADOS CAPTURADOS</h5>
    <table class="table table-hover" id="empleadosCap">
      <thead>
        <tr class="row m-0 encabezado">
          <td class="col-md-1 text-center">Datos</td>
          <td class="col-md-1 text-center">Estatus</td>
          <td class="col-md-1 text-center">Pagar</td>
          <td class="col-md-1 text-center">No.Emp.</td>
          <td class="col-md-6 text-center">Empleado</td>
          <td class="col-md-1 text-center">Salario</td>
          <td class="col-md-1 text-center">Integrado</td>
        </tr>
      </thead>
      <tbody>
        <tr class="row text-center m0b0">
          <td class="col-md-1">
            <a href="#modDatosEmp" data-toggle="modal">
              <img class="icomediano" src="/conta6/Resources/iconos/003-edit.svg">
            </a>
          </td>
          <td class="col-md-1 text-normal">Activo</td>
          <td class="col-md-1 text-normal">Si</td>
          <td class="col-md-1 text-normal">426</td>
          <td class="col-md-6 text-normal">Agustin Alejandro Hernandez Uvaldo</td>
          <td class="col-md-1 text-normal">250.00</td>
          <td class="col-md-1 text-normal">261.00</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>



<script src="/conta6/Resources/js/Inputs.js"></script>
<script src="js/SueldosySalarios.js"></script>
<?php include_once('modales/Empleados.php'); ?>
