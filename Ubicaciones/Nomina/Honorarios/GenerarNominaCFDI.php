<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row submenuMed m-0">
    <div class="col-md-4 text-center" role="button">
      <a  id="submenuMed" class="honorarios" accion="gnominaHon" status="cerrado">GENERAR NOMINA</a>
    </div>
    <div class="col-md-4 text-center">
      <a id="submenuMed" class="honorarios" accion="gcfdiHon" status="cerrado">GENERAR CFDI</a>
    </div>
    <div class="col-md-4 text-center">
      <a id="submenuMed" class="honorarios" accion="paramHon" status="cerrado">PARAMETROS</a>
    </div>
  </div>

  <!--Comienza Generar Nomina-->
  <div id="contornognomHon" class="contorno brx4" style="display:none">
    <h5 class="titulo" style="font-size:15px">Documento Ordinario</h5>
    <table class="table" id="generarnominaHon">
      <thead>
        <tr class="row m-0 encabezado">
          <td class="col-md-4 text-center">2017 Tiene 52 Semanas</td>
          <td class="col-md-2 text-center">Nómina</td>
          <td class="col-md-2 text-center">Fecha Inicio</td>
          <td class="col-md-2 text-center">Fecha Final</td>
          <td class="col-md-2 text-center">Fecha de Pago</td>
        </tr>
      </thead>
      <tbody class="contenidorow cuerpo">
        <tr class="row">
          <td class="col-md-4 text-center">Ultima Nómina Generada</td>
          <td class="col-md-2 text-center">25</td>
          <td class="col-md-2 text-center">19/06/2017</td>
          <td class="col-md-2 text-center">23/06/2017</td>
          <td class="col-md-2 text-center"></td>
        </tr>
        <tr class="row">
          <td class="col-md-4 text-center">Nómina Siguiente</td>
          <td class="col-md-2 text-center">26</td>
          <td class="col-md-2 text-center">26/06/2017</td>
          <td class="col-md-2 text-center">30/06/2017</td>
          <td class="col-md-2 text-center">30/06/2017</td>
        </tr>
        <tr class="row">
          <td class="col-md-12">
            <input class="btn btn-block btn-dpol brx2" type="submit" value="GENERAR NOMINA"><!--Guardar Datos de poliza/cuando se actualizo algun dato-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Nomina-->

<!--Comienza Generar CFDI-->
  <div id="contornogcfdiHon" style="display:none">
    <form style="line-height: 0.8;letter-spacing: 3px">
      <table class="table text-center">
        <tr class="row brx3">
          <td class="col-md-1 offset-md-5 input-effect">
            <input  list="anio" class="text-normal efecto text-center" id="buscaranio">
            <datalist id="anio">
              <option value="2017"></option>
              <option value="2016"></option>
              <option value="2015"></option>
              <option value="2014"></option>
            </datalist>
            <label for="buscaranio">Año</label>
          </td>
          <td class="col-md-1 input-effect">
            <input  list="semnomina" class="text-normal efecto text-center" id="buscarsemnom">
            <datalist id="semnomina">
              <option value="25"></option>
              <option value="24"></option>
              <option value="23"></option>
              <option value="23"></option>
              <option value="21"></option>
            </datalist>
            <label for="buscarsemnom">Nómina</label>
          </td>
        </tr>
      </table>
    </form>
    <div  class="contorno brx4">
      <div class="acordeon2">
        <div class="encabezado text-center" data-toggle="collapse" href="#collapseOne">
          <a  id="bread">DATOS GENERALES</a>
        </div>
        <div id="collapseOne" class="collapse" style="padding:0rem 1.5rem!important;font-size:14px">
          <form class="form1"method="post">
            <table class="table text-center mb-0">
              <thead>
                <tr class="row submenuch">
                  <td class="col-md-1">Empleados</td>
                  <td class="col-md-1">CFDI</td>
                  <td class="col-md-2">Cancelados</td>
                  <td class="col-md-2">Percepciones</td>
                  <td class="col-md-2">Deducciones</td>
                  <td class="col-md-2">Total</td>
                  <td class="col-md-2">Total Neto</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row">
                  <td class="col-md-1">4</td>
                  <td class="col-md-1">4</td>
                  <td class="col-md-2">0</td>
                  <td class="col-md-2">$39,142.22</td>
                  <td class="col-md-2">$8,582.97</td>
                  <td class="col-md-2">$30,559.25</td>
                  <td class="col-md-2">$30,559.25</td>
                </tr>
                <tr class="row brx3">
                  <td class="col-md-12 text-center">
                    Nómina 25
                    <a href="#permanentes" data-toggle="modal">
                      <img class="icomediano" src="/conta6/Resources/iconos/printer.svg">
                    </a>
                  </td>
                </tr>
                <tr class="row">
                  <td class="col-md-12">19/06/2017 al 23/06/2017</td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>

    <div class="contorno brx4">
      <table class="table text-center m-0">
        <thead>
          <tr class="row encabezado">
            <td class="col-md-1"></td>
            <td class="col-md-1">Documento</td>
            <td class="col-md-1">No.</td>
            <td class="col-md-3">Empleado</td>
            <td class="col-md-1">Pol.Pago</td>
            <td class="col-md-1">Cancelar</td>
            <td class="col-md-1">Pol.Cancel</td>
            <td class="col-md-1">Factura</td>
            <td class="col-md-1">Póliza</td>
            <td class="col-md-1">CFDI</td>
          </tr>
        </thead>
        <tbody style="font-size:16px">
          <tr class="row m-0">
            <td class="col-md-1">
              <a href=""><img class="icomediano" src="/conta6/Resources/iconos/001-delete.svg"></a>
              <a href="" class="mleftx2"><img class="icomediano" src="/conta6/Resources/iconos/003-edit.svg"></a>
            </td>
            <td class="col-md-1">38089</td>
            <td class="col-md-1">426</td>
            <td class="col-md-3">Agustin Alejandro Hernandez Uvaldo</td>
            <td class="col-md-1">248040</td><!--Esto debe ser un link-->
            <td class="col-md-1"></td>
            <td class="col-md-1">234567</td><!--Esto debe ser un link-->
            <td class="col-md-1">15804</td>
            <td class="col-md-1">248092</td><!--Esto debe ser un link-->
            <td class="col-md-1">
              <a href=""><img class="icomediano" src="/conta6/Resources/iconos/pdf.svg"></a>
              <a href="" class="mleftx2"><img class="icomediano" src="/conta6/Resources/iconos/xml.svg"></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div><!--/Comienza Generar CDFI-->

<!--Comienza Consultar Parametros-->
  <div id="contornoparamHon" style="display:none">
    <div class="contorno brx4">
      <div class="acordeon2">
        <div class="encabezado text-center">
          <a  id="bread">ARTICULO 113</a>
        </div>
          <form class="form1">
            <table class="table table-hover text-center">
              <thead>
                <tr class="row submenuch m-0">
                  <td class="col-md-1">Editar</td>
                  <td class="col-md-2">Inferior</td>
                  <td class="col-md-2">Superior</td>
                  <td class="col-md-2">Cuota</td>
                  <td class="col-md-2">Porcentaje</td>
                  <td class="col-md-3">Ultima Modificación</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row brx1 m-0">
                  <td class="col-md-1">
                    <a href="#articulo113" data-toggle="modal"><img class="icochico" src="/conta6/Resources/iconos/003-edit.svg"></a>
                  </td>
                  <td class="col-md-2">0.01</td>
                  <td class="col-md-2">114.24</td>
                  <td class="col-md-2">0.00</td>
                  <td class="col-md-2">1.92</td>
                  <td class="col-md-3"></td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-1">
                    <a href="#articulo113" data-toggle="modal"><img class="icochico" src="/conta6/Resources/iconos/003-edit.svg"></a>
                  </td>
                  <td class="col-md-2">114.25</td>
                  <td class="col-md-2">969.50</td>
                  <td class="col-md-2">2.17</td>
                  <td class="col-md-2">6.40</td>
                  <td class="col-md-3"></td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div><!--/Termina Consultar Parametros-->
  </div>




<script src="js/Honorarios.js"></script>
<script src="/conta6/Resources/js/Inputs.js"></script>
<?php include_once('modales/ParametrosHon.php'); ?>
