<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="container-fluid">
  <div class="row submenuMed">
    <div class="col-12 text-center" role="button">
      <a  id="submenuMed" class="consultar" accion="eCap" status="cerrado">CATÁLOGO DE CUENTAS</a>
    </div>
  </div>

  <div id="contorno" class="contorno">
    <div class="acordeon2 text-center">
      <div class="encabezado" data-toggle="collapse" href="#CuentasMaestras">
        <a  id="bread">GENERAR CUENTAS MAESTRAS (Primer Nivel)</a>
      </div>
      <div id="CuentasMaestras" class="card-block collapse mr-20 ml-20">
        <form class="form1">
          <table class="table mb-0">
            <tbody class="cuerpo">
              <tr class="row brx2">
                <td class="col-md-12 input-effect">
                  <input  list="cuentasSAT" class="text-normal efecto text-center"  id="ctaSAT">
                  <datalist id="cuentasSAT">
                    <option>Perdida por Deteriodo Acumulado de Maquinaria y Equipo de Generacion de Energía de fuentes Renovables o de Sistemas de Cogeneración de Electricidad Eficiente -- 172.16</option>
                    <option>Pérdida por Deteriodo Acumulado de Automoviles, Autobuses, Camiones de Carga, Tractocamiones, Montacargas y Remolques -- 172.03</option>
                    <option>Ganancia en Venta de Maquinaria y equipo de Generacion de Energía de Fuentes Renovables o de Sistemas de Cogeneración de electricidad Eficiente -- 704.17</option>
                  </datalist>
                  <label for="ctaSAT">CUENTAS SAT</label>
                </td>
              </tr>
              <tr class="row brx2">
                <td class="col-md-4 input-effect">
                  <input  list="NSAT" class="text-normal efecto text-center"  id="naturSAT">
                  <datalist id="NSAT">
                    <option>Acredora -- A</option>
                    <option>Activo -- D</option>
                    <option>Capital -- A</option>
                    <option>Costo -- D</option>
                    <option>Cuentas en Orden -- DA</option>
                    <option>Deudora -- D</option>
                    <option>Gasto -- D</option>
                    <option>Ingreso -- A</option>
                    <option>Pasivo -- A</option>
                    <option>Resultado Integral de Financiamiento</option>
                  </datalist>
                  <label for="naturSAT">NATURALEZA SAT</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input  list="cta-mtraTipo" class="text-normal efecto text-center"  id="tipo">
                  <datalist id="cta-mtraTipo">
                    <option>Activo</option>
                    <option>Pasivo</option>
                    <option>Capital</option>
                    <option>Gastos</option>
                    <option>Ingresos</option>
                    <option>Cuentas de Orden</option>
                  </datalist>
                  <label for="tipo">TIPO</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="ctamaestra" class="efecto text-center" type="text">
                  <label for="ctamaestra">CUENTA MAESTRA</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="concepto" class="efecto text-center" type="text">
                  <label for="concepto">CONCEPTO</label>
                </td>
              </tr>
              <tr class="row">
                <td class="col-md-2 offset-md-5 brx2">
                  <a href="" class="boton btn-block"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> GENERAR</a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 text-center brx1">
      <div class="encabezado" data-toggle="collapse" href="#collapsetwo">
        <a  id="bread">GENERAR CUENTAS DE DETALLE (Segundo Nivel)</a>
      </div>
      <div id="collapsetwo" class="card-block collapse mr-20 ml-20">
        <form class="form1"method="post">
          <table class="table mb-0">
            <tbody class="cuerpo">
              <tr class="row brx2">
                <td class="col-md-12 input-effect">
                  <input  list="cuentasSAT" class="text-normal efecto text-center"  id="ctaSAT1">
                  <datalist id="cuentasSAT"></datalist>
                  <label for="ctaSAT1">CUENTAS SAT</label>
                </td>
              </tr>
              <tr class="row brx2">
                <td class="col-md-3 input-effect">
                  <input  list="NSAT" class="text-normal efecto text-center"  id="naturSAT1">
                  <datalist id="NSAT"></datalist>
                  <label for="naturSAT1">NATURALEZA SAT</label>
                </td>
                <td class="col-md-6 input-effect">
                  <input  list="CuentaMaestra" class="text-normal efecto text-center"  id="tipo1">
                  <datalist id="CuentaMaestra">
                    <option>0100-00000 -- Bancos</option>
                    <option>0402-00000 -- Devolucion, Descuente o Bonificaciones sobre Ingresos</option>
                    <option>0813-00000 -- Perdida Fiscales Pendientes de Amortizar de Ejercicios Anteriores</option>
                  </datalist>
                  <label for="tipo1">CUENTA MAESTRA</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="concepto1" class="efecto text-center" type="text">
                  <label for="concepto1">CONCEPTO</label>
                </td>
              </tr>
              <tr class="row">
                <td class="col-md-4 offset-md-4 brx2">
                  <a href="" class="boton btn-block"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> GENERAR CUENTA DETALLE</a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 text-center brx1">
      <div class="encabezado" data-toggle="collapse" href="#collapsetres">
        <a  id="bread">GENERAR CUENTAS DE CLIENTES (Segundo Nivel)</a>
      </div>
      <div id="collapsetres" class="card-block collapse ml-20 mr-20">
        <form class="form1"method="post">
          <table class="table mb-0">
            <tbody class="cuerpo">
              <tr class="row">
                <td class="col-md-10 input-effect brx2">
                  <input  list="Clientes" class="text-normal efecto text-center"  id="clt">
                  <datalist id="Clientes">
                    <option>Spacio Hogar S.A de C.V --  CLT_7569</option>
                    <option>Abastos y sumplementos Agropecuarios del Sureste S.A de C.V -- CLT_7506</option>
                    <option>Adidas de México S.A de C.V CLT_6262</option>
                  </datalist>
                  <label for="clt">CUENTA MAESTRA</label>
                </td>
                <td class="col-md-2 brx2">
                  <a href="" class="boton btn-block"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> GENERAR</a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>

  <div id="contornoEmp" class="contorno" style="display:none;">
    <h5 class="titulo" style="font-size:15px">CATALOGO</h5>
    <table class="table brx2">
      <td class="col-md-12">
        <a href="#"><img class="icomediano mleft" src="/conta6/Resources/iconos/005-excel.svg"></a>
        <a href="#"><img class="icomediano mleftx2" src="/conta6/Resources/iconos/printer.svg"></a>
        <a href="#"><img class="icomediano mleftx2" src="/conta6/Resources/iconos/xml.svg"></a>
      </td>
    </table>
    <table class="table table-hover text0-center" id="empleadosCap" style="display:none;">
      <thead>
        <tr class="row  m-0 encabezado">
          <td class="col-md-1"></td>
          <td class="col-md-1">CUENTA</td>
          <td class="col-md-4">DESCRIPCION</td>
          <td class="col-md-1">TIPO</td>
          <td class="col-md-1">NIVEL</td>
          <td class="col-md-1">CAPTURA</td>
          <td class="col-md-1">CodAgrup SAT</td>
          <td class="col-md-1">NATUR SAT</td>
          <td class="col-md-1">ACTIVIDAD</td>
        </tr>
      </thead>
      <tbody class="text-normal">
        <tr class="row text-center m-0 borderojo">
          <td class="col-md-1 text-center">
            <a href="#EditarCatalogo" data-toggle="modal">
              <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
            </a>
          </td>
          <td class="col-md-1">0100-0000</td>
          <td class="col-md-4">BANCOS</td>
          <td class="col-md-1">A</td>
          <td class="col-md-1">1</td>
          <td class="col-md-1">ACTIVO</td>
          <td class="col-md-1">102</td>
          <td class="col-md-1">D</td>
          <td class="col-md-1">Con Registros</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>



<script src="/conta6/Resources/js/Inputs.js"></script>
<script src="js/AdministracionContable.js"></script>
<?php
require_once('modales/EditarCatalogo.php');
 ?>
