<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row submenuMed m-0">
    <div class="col-md-6 text-center" role="button">
      <a  id="submenuMed" class="sueldosysalarios" accion="dgenerales" status="cerrado">DATOS GENERALES</a>
    </div>
    <div class="col-md-6 text-center">
      <a id="submenuMed" class="sueldosysalarios" accion="dlaborales" status="cerrado">DATOS LABORALES</a>
    </div>
  </div>

  <div class="col-md-1 brx2">
    <a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/GenerarNominaCFDI.php">
      <img class="icomediano" src="/conta6/Resources/iconos/left.svg">
    </a>
  </div>

  <div id="contornogen" class="contorno brx4" style="display:none">
    <h5 class="titulo" style="font-size:15px">DATOS GENERALES</h5>
    <table class="table">
      <thead>
        <tr class="row m-0 tRepo2 text-center">
          <td class="col-md-1">No.</td>
          <td class="col-md-2">Nombre</td>
          <td class="col-md-3">Apellidos</td>
          <td class="col-md-2">CURP</td>
          <td class="col-md-1">RFC</td>
          <td class="col-md-2">No. IMSS</td>
          <td class="col-md-1">Infonavit</td>
        </tr>
      </thead>
      <tbody style="font-size:16px">
        <tr class="row m-0 text-center">
          <td class="col-md-1">296</td>
          <td class="col-md-2">Azeneth Estefania</td>
          <td class="col-md-3">Pinales Avalos</td>
          <td class="col-md-2">PIAA911122MTSNVZ05</td>
          <td class="col-md-1">PIAA911122LP2</td>
          <td class="col-md-2">03149100178</td>
          <td class="col-md-1"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="contornolab" class="contorno brx4" style="display:none">
    <h5 class="titulo" style="font-size:15px">DATOS LABORALES</h5>
    <table class="table">
      <thead>
        <tr class="row m-0 tRepo2 text-center">
          <td class="col-md-2">Periosidad del Pagó</td>
          <td class="col-md-2">Riesgo de Trabajo</td>
          <td class="col-md-2">Departamento</td>
          <td class="col-md-1">Regimen</td>
          <td class="col-md-2">Fecha Contrato</td>
          <td class="col-md-2">Antiguedad Semanas</td>
          <td class="col-md-1">Puesto</td>
        </tr>
      </thead>
      <tbody style="font-size:16px">
        <tr class="row m-0 text-center">
          <td class="col-md-2">Semanal</td>
          <td class="col-md-2">Clase l</td>
          <td class="col-md-2">Contabilidad</td>
          <td class="col-md-1">02</td>
          <td class="col-md-2">13/01/2013</td>
          <td class="col-md-2">P233W</td>
          <td class="col-md-1">Auxiliar</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="contorno" class="contorno brx4">
    <div class="acordeon2">
      <div class="tRepo2 text-center" data-toggle="collapse" href="#datospago">
        <a  id="bread">DATOS DEL PAGO</a>
      </div>
      <div id="datospago" class="card-block collapse">
        <form style="line-height: 0.95;letter-spacing: 3px">
          <table class="table text-center">
            <tbody>
              <tr class="row brx3  mr-0 ml-0">
                <td class="col-md-2 input-effect">
                  <input id="nom" class="efecto">
                  <label for="nom">Nomina</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="tip" class="efecto">
                  <label for="tip">Tipo</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input class="efecto text-center data-date" type="text" onfocus="(this.type='date')" id="finicial">
                  <label for="finicial">Fecha Inicial</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input class="efecto text-center data-date" type="text" onfocus="(this.type='date')" id="ffin">
                  <label for="ffin">Fecha Final</label>
                </td>

                <td class="col-md-2 input-effect">
                  <input class="efecto text-center data-date" type="text" onfocus="(this.type='date')" id="fpago">
                  <label for="fpago">Fecha Pago</label>
                </td>

                <td class="col-md-2 input-effect">
                  <input id="doc" class="efecto">
                  <label for="doc">Documento</label>
                </td>
              </tr>
              <tr class="row brx2  mr-0 ml-0">
                <td class="col-md-3 input-effect">
                  <input id="mpago" class="efecto">
                  <label for="mpago">Método Pago</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="bco" class="efecto">
                  <label for="bco">Banco</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input id="clabe" class="efecto">
                  <label for="clabe">Cuenta/Clabe Interbancaria</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="salbase" class="efecto">
                  <label for="salbase">Salario Base</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="saldiario" class="efecto">
                  <label for="saldiario">Salario Diario</label>
                </td>
              </tr>
              <tr class="row brx2 text-center mr-0 ml-0">
                <td class="col-md-1 iap">CANTIDAD</td>
                <td class="col-md-1 iap">UNIDAD</td>
                <td class="col-md-4 iap">DESCRIPCION</td>
                <td class="col-md-3 iap">VALOR UNITARIO</td>
                <td class="col-md-3 iap">IMPORTE</td>
              </tr>
              <tr class="row text-center m-0">
                <td class="col-md-1">1</td>
                <td class="col-md-1">ACT</td>
                <td class="col-md-4">Pago de Nómina</td>
                <td class="col-md-3">$ 6,039.01</td>
                <td class="col-md-3">$ 6,39.01</td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

<!--ACORDEON DE PERCEPCIONES-->
    <div class="acordeon2 brx1">
      <div class="tRepo2 text-center" data-toggle="collapse" href="#percep">
        <a  id="bread">PERCEPCIONES</a>
      </div>
      <div id="percep" class="card-block collapse">
        <form class="form1">
          <table class="table text-center">
            <tbody>
              <tr class="row brx3">
                <td class="col-md-6 offset-md-3 text-center">
                  <select class="form-control ">
                    <option selected>Tipo (Agrupar) SAT</option>
                    <option>Aguinaldo Exento -- 002 -- 0530-00007</option>
                    <option>Aguinaldo Gravado -- 002 -- 0530-00008</option>
                    <option>Ayuda Renta -- 033 -- 0530-00078</option>
                    <option>Compensación -- 038 -- 0530-00010</option>
                    <option>Gastos Funerarios -- 026 -- 0560-00004</option>
                    <option>Participación de Trabajadores en las Utilidades PTU -- 003 -- 0530-00011</option>
                    <option>Premio de Asistencia -- 049 -- 0530-00021</option>
                    <option>Premio de Puntualidad -- 010 -- 0530-00018</option>
                    <option>Prestamo -- 038 -- 0115-00001</option>
                    <option>Prima Dominical -- 020 -- 0530-00080</option>
                    <option>Prima Vacacional -- 021 -- 0530-00005</option>
                    <option>Sueldo -- 001 -- 0530-00001</option>
                    <option>Vacaciones -- 001 -- 0530-00004</option>
                    <option>Vacaciones Exentas -- 021 -- 0530-00006</option>
                    <option>Vales de Despensa -- 029 -- 0530-00013</option>
                  </select>
                </td>
              </tr>

              <tr class="row brx2  mr-0 ml-0">
                <td class="col-md-1 input-effect">
                  <input id="cve" class="efecto">
                  <label for="cve">Cve.SAT</label>
                </td>

                <td class="col-md-2 input-effect">
                  <input id="ctacon" class="efecto">
                  <label for="ctacon">Cuenta Contable</label>
                </td>

                <td class="col-md-4 input-effect">
                  <input id="concdesc" class="efecto">
                  <label for="concdesc">Concepto o Descripción</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="impgrav" class="efecto">
                  <label for="impgrav">Importe Gravado</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="impex" class="efecto">
                  <label for="impex">Importe Exento</label>
                </td>
                <td>
                  <a>
                    <img class="icomediano mleftx3" src="/conta6/Resources/iconos/add-cuadro.svg">
                  </a>
                </td>
              </tr>

              <tr class="row brx3 mr-0 ml-0">
                <td class="col-md-1 input-effect" readonly>
                  <input class="efecto">
                </td>
                <td class="col-md-2 input-effect" readonly>
                  <input class="efecto">
                </td>
                <td class="col-md-4 input-effect" readonly>
                  <input class="efecto">
                </td>
                <td class="col-md-2 input-effect" readonly>
                  <input class="efecto">
                </td>
                <td class="col-md-2 input-effect" readonly>
                  <input class="efecto">
                </td>
                <td>
                  <a>
                    <img class="icomediano" src="/conta6/Resources/iconos/delete.svg">
                  </a>
                  <a>
                    <img class="icomediano mleftx2" src="/conta6/Resources/iconos/save.svg">
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

<!--ACORDEON DE OTROS PAGOS-->
    <div class="acordeon2 brx1">
      <div class="tRepo2 text-center" data-toggle="collapse" href="#otrospagos">
        <a  id="bread">OTROS PAGOS</a>
      </div>
      <div id="otrospagos" class="card-block collapse">
        <form class="form1"method="post">
          <table class="table text-center">
            <tbody>
              <tr class="row brx1">
                <td class="col-md-6 offset-md-3">
                  <select class="form-control ">
                    <option selected>Tipo (Agrupar) SAT</option>
                    <option>ISR a Favor Ejercicios Anteriores -- 004 -- 0115-00001</option>
                    <option>Subsidio al Empleo -- 002 -- 0167-00004</option>
                  </select>
                </td>
              </tr>
              <tr class="row brx2  mr-0 ml-0">
                <td class="col-md-1 input-effect">
                  <input id="cve1" class="efecto">
                  <label for="cve1">Cve.SAT</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="ctacon1" class="efecto">
                  <label for="ctacon1">Cuenta Contable</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="concdesc1" class="efecto">
                  <label for="concdesc1">Concepto o Descripción</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="importe" class="efecto">
                  <label for="importe">Importe</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="anio" class="efecto">
                  <label for="anio">Año</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="sfav" class="efecto">
                  <label for="sfav">Saldo a Favor</label>
                </td>
                <td>
                  <a>
                    <img class="icomediano mleftx3" src="/conta6/Resources/iconos/add-cuadro.svg">
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

<!--ACORDEON HORAS EXTRAS-->
    <div class="acordeon2 brx1">
      <div class="tRepo2 text-center" data-toggle="collapse" href="#horasextras">
        <a  id="bread">HORAS EXTRAS</a>
      </div>
      <div id="horasextras" class="card-block collapse">
        <form class="form1"method="post">
          <table class="table text-center">
            <tbody>
              <tr class="row brx1">
                <td class="col-md-6 offset-md-3">
                  <select class="form-control">
                    <option selected>Tipo (Agrupar) SAT</option>
                    <option>Dobles -- 019 -- 0530-00002</option>
                    <option>Triples -- 019 -- 0530-00003</option>
                  </select>
                </td>
              </tr>

              <tr class="row brx2  mr-0 ml-0">
                <td class="col-md-1 input-effect">
                  <input id="cve2" class="efecto">
                  <label for="cve2">Cve.SAT</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="ctacon2" class="efecto">
                  <label for="ctacon2">Cuenta Contable</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="concdesc2" class="efecto">
                  <label for="concdesc2">Concepto o Descripción</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="dias" class="efecto">
                  <label for="dias">Días</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="horas" class="efecto">
                  <label for="horas">Horas</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="gravado" class="efecto">
                  <label for="gravado">$ Gravado</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="exento" class="efecto">
                  <label for="exento">$ Exento</label>
                </td>
                <td><a><img class="icomediano mleftx3" src="/conta6/Resources/iconos/add-cuadro.svg"></a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

<!--ACORDEON DEDUCCIONES-->
    <div class="acordeon2 brx1">
      <div class="tRepo2 text-center" data-toggle="collapse" href="#deduc">
        <a  id="bread">DEDUCCIONES</a>
      </div>
      <div id="deduc" class="card-block collapse">
        <form class="form1"method="post">
          <table class="table text-center">
            <tbody>
              <tr class="row brx1">
                <td class="col-md-6 offset-md-3">
                  <select class="form-control ">
                    <option selected>Tipo (Agrupar) SAT</option>
                    <option>Descuentos 1 -- 015 -- 0115-00001</option>
                    <option>Descuentos por Prestamo -- 015 -- 0115-00001</option>
                    <option>Descuentos Prestamos Fondo de Ahorro -- 009 -- 0213-00002</option>
                    <option>IMSS -- 001 -- 0201-00009</option>
                    <option>INFONAVIT -- 010 -- 0201-00011</option>
                    <option>ISPT -- 002 -- 0201-00001</option>
                    <option>Pago de Abonos INFONACOT -- 011 -- 0201-00016</option>
                    <option>Renta -- 008 -- 0201-00018</option>
                  </select>
                </td>
              </tr>

              <tr class="row brx2  mr-0 ml-0">
                <td class="col-md-1 input-effect">
                  <input id="cve3" class="efecto">
                  <label for="cve3">Cve.SAT</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="ctacon3" class="efecto">
                  <label for="ctacon3">Cuenta Contable</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="concdesc3" class="efecto">
                  <label for="concdesc3">Concepto o Descripción</label>
                </td>

                <td class="col-md-2 input-effect">
                  <input id="gravado1" class="efecto">
                  <label for="gravado1">Importe Gravado</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="exento1" class="efecto">
                  <label for="exento1">Importe Exento</label>
                </td>
                <td>
                  <a><img class="icomediano mleftx3" src="/conta6/Resources/iconos/add-cuadro.svg"></a>
                </td>
              </tr>

              <tr class="row brx3 mr-0 ml-0">
                <td class="col-md-1 input-effect" readonly>
                  <input class="efecto">
                </td>
                <td class="col-md-2 input-effect" readonly>
                  <input class="efecto">
                </td>
                <td class="col-md-4 input-effect" readonly>
                  <input class="efecto">
                </td>
                <td class="col-md-2 input-effect" readonly>
                  <input class="efecto">
                </td>
                <td class="col-md-2 input-effect" readonly>
                  <input class="efecto">
                </td>
                <td>
                  <a><img class="icomediano mleft" src="/conta6/Resources/iconos/delete.svg"></a>
                  <a><img class="icomediano mleftx2" src="/conta6/Resources/iconos/save.svg"></a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

<!--ACORDEON DEDUCCIONES-->
    <div class="acordeon2 brx1">
      <div class="tRepo2 text-center" data-toggle="collapse" href="#pension">
        <a  id="bread">PENSIÓN ALIMENTICIA</a>
      </div>
      <div id="pension" class="card-block collapse">
        <form class="form1"method="post">
          <table class="table text-center">
            <tbody>
              <tr class="row brx1">
                <td class="col-md-6 offset-md-3">
                  <select class="form-control ">
                    <option selected>Tipo (Agrupar) SAT</option>
                    <option>Pensión Alimenticia -- 007 -- 0213-00005</option>
                  </select>
                </td>
              </tr>
              <tr class="row brx2  mr-0 ml-0">
                <td class="col-md-1 input-effect">
                  <input id="cve4" class="efecto">
                  <label for="cve4">Cve.SAT</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="ctacon4" class="efecto">
                  <label for="ctacon4">Cuenta Contable</label>
                </td>
                <td class="col-md-4 input-effect">
                  <input id="concdesc4" class="efecto">
                  <label for="concdesc4">Concepto o Descripción</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="base" class="efecto">
                  <label for="base">Base</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="porcent" class="efecto">
                  <label for="porcent">Porcentaje</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="gravado2" class="efecto">
                  <label for="gravado2">$ Gravado</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="exento2" class="efecto">
                  <label for="exento2">$ Exento</label>
                </td>
                <td>
                  <a><img class="icomediano mleftx3" src="/conta6/Resources/iconos/add-cuadro.svg"></a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

<!--ACORDEON TOTALES-->
    <div class="acordeon2 brx1">
      <div class="tRepo2 text-center" data-toggle="collapse" href="#totales">
        <a  id="bread">TOTALES</a>
      </div>
      <div id="totales" class="card-block collapse">
        <form class="form1">
          <table class="table text-center">
            <tbody>
              <tr class="row brx3 ml-0 mr-0">
                <td class="col-md-4 iap">INCAPACIDAD</td>
                <td class="col-md-1 input-effect">
                  <input id="tipo" class="efecto">
                  <label for="tipo">Tipo</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="indias" class="efecto">
                  <label for="indias">Días</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="indescontar" class="efecto">
                  <label for="indescontar">Descontar</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="inpagar" class="efecto">
                  <label for="inpagar">Pagar</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="totvac" class="efecto">
                  <label for="totvac">Vacaciones</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="totfaltas" class="efecto">
                  <label for="totfaltas">Faltas</label>
                </td>
              </tr>

              <tr class="row brx2 ml-0 mr-0">
                <td class="col-md-2 input-effect">
                  <input id="totpagar" class="efecto">
                  <label for="totpagar">Días a Pagar</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="totpercep" class="efecto">
                  <label for="totpercep">Percepciones</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="totdeduc" class="efecto">
                  <label for="totdeduc">Deducciones</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="tottotal" class="efecto">
                  <label for="tottotal">Total</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input id="otrosgtos" class="efecto">
                  <label for="otrosgtos">Otros Gastos</label>
                </td>
                <td class="col-md-1 input-effect">
                  <input id="totneto" class="efecto">
                  <label for="totneto">Neto</label>
                </td>
                <td>
                  <a><img class="icomediano mleftx2" src="/conta6/Resources/iconos/save.svg"></a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 offset-md-4 text-center brx2" style="font-size: 16px;">
          <a href="" class="boton btn-block">REGREGAR</a>
      </div>
    </div>
  </div> <!--Termina el contorno-->
</div> <!--Termina el Container-Fluid-->

<script src="/conta6/Resources/js/Inputs.js"></script>
<script src="js/SueldosySalarios.js"></script>
