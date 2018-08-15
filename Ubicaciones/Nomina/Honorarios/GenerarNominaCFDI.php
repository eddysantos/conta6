<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<div class="container-fluid">
  <div class="row submenuMed text-center m-0">
    <div class="col-md-4" role="button">
      <a  id="submenuMed" class="honorarios" accion="gnominaHon" status="cerrado">GENERAR NOMINA</a>
    </div>
    <div class="col-md-4">
      <a id="submenuMed" class="honorarios" accion="gcfdiHon" status="cerrado">GENERAR CFDI</a>
    </div>
    <div class="col-md-4">
      <a id="submenuMed" class="honorarios" accion="paramHon" status="cerrado">PARAMETROS</a>
    </div>
  </div>

  <!--Comienza Generar Nomina-->
  <div id="contornognomHon" class="contorno" style="display:none">
    <h5 class="titulo font16">Documento Ordinario</h5>
    <table class="table form1 text-center" id="generarnominaHon">
      <thead>
        <tr class="row font14 encabezado">
          <td class="col-md-4">2017 Tiene 52 Semanas</td>
          <td class="col-md-2">Nómina</td>
          <td class="col-md-2">Fecha Inicio</td>
          <td class="col-md-2">Fecha Final</td>
          <td class="col-md-2">Fecha de Pago</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row">
          <td class="col-md-4">Ultima Nómina Generada</td>
          <td class="col-md-2">25</td>
          <td class="col-md-2">19/06/2017</td>
          <td class="col-md-2">23/06/2017</td>
          <td class="col-md-2"></td>
        </tr>
        <tr class="row">
          <td class="col-md-4">Nómina Siguiente</td>
          <td class="col-md-2">26</td>
          <td class="col-md-2">26/06/2017</td>
          <td class="col-md-2">30/06/2017</td>
          <td class="col-md-2">30/06/2017</td>
        </tr>
        <tr class="row">
          <td class="col-md-2 offset-md-5 mt-4">
            <input class="boton" type="submit" value="GENERAR NOMINA"><!--Guardar Datos de poliza/cuando se actualizo algun dato-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Nomina-->

<!--Comienza Generar CFDI-->
  <!-- <div id="contornogcfdiHon" style="display:none"> -->
  <div id="contornogcfdiHon" style="display:none">
    <table class="table text-center">
      <tr class="row mt-5">
        <td class="col-md-1 offset-md-5">
          <select class="custom-select" id="buscaranio">
            <option selected>Año</option>
            <option>2018</option>
            <option>2017</option>
            <option>2016</option>
            <option>2015</option>
            <option>2014</option>
          </select>
        </td>
        <td class="col-md-1">
          <select class="custom-select" id="buscaranio">
            <option selected>Nomina</option>
            <option>25</option>
            <option>24</option>
            <option>23</option>
            <option>22</option>
            <option>21</option>
          </select>
        </td>
      </tr>
    </table>

    <div  class="contorno mt-4">
      <div class="acordeon2">
        <div class="encabezado text-center font16" data-toggle="collapse" href="#collapseOne">
          <a href="#">DATOS GENERALES</a>
        </div>
        <div id="collapseOne" class="collapse">
          <form class="form1">
            <table class="table text-center">
              <thead>
                <tr class="row m-0 backpink">
                  <td class="col-md-1">Empleados</td>
                  <td class="col-md-1">CFDI</td>
                  <td class="col-md-2">Cancelados</td>
                  <td class="col-md-2">Percepciones</td>
                  <td class="col-md-2">Deducciones</td>
                  <td class="col-md-2">Total</td>
                  <td class="col-md-2">Total Neto</td>
                </tr>
              </thead>
              <tbody class="font14">
                <tr class="row m-0">
                  <td class="col-md-1">4</td>
                  <td class="col-md-1">4</td>
                  <td class="col-md-2">0</td>
                  <td class="col-md-2">$39,142.22</td>
                  <td class="col-md-2">$8,582.97</td>
                  <td class="col-md-2">$30,559.25</td>
                  <td class="col-md-2">$30,559.25</td>
                </tr>
                <tr class="row m-0 mt-4">
                  <td class="col-md-12">Nómina 25
                    <a href="#permanentes" data-toggle="modal">
                      <img class="icomediano" src="/conta6/Resources/iconos/printer.svg">
                    </a>
                  </td>
                </tr>
                <tr class="row m-0">
                  <td class="col-md-12">19/06/2017 al 23/06/2017</td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>

    <div class="contorno mt-4">
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
        <tbody class="font14">
          <tr class="row">
            <td class="col-md-1">
              <a href=""><img class="icomediano" src="/conta6/Resources/iconos/001-delete.svg"></a>
              <a href="" class="ml-5"><img class="icomediano" src="/conta6/Resources/iconos/003-edit.svg"></a>
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
              <a href="" class="ml-4"><img class="icomediano" src="/conta6/Resources/iconos/xml.svg"></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div><!--/Comienza Generar CDFI-->

<!--Comienza Consultar Parametros-->
  <div id="contornoparamHon" style="display:none">
    <div class="contorno">
      <div class="acordeon2">
        <div class="encabezado text-center font16">
          <a href="#">ARTICULO 113</a>
        </div>
          <form class="form1">
            <table class="table table-hover text-center">
              <thead>
                <tr class="row backpink m-0">
                  <td class="col-md-1">Editar</td>
                  <td class="col-md-2">Inferior</td>
                  <td class="col-md-2">Superior</td>
                  <td class="col-md-2">Cuota</td>
                  <td class="col-md-2">Porcentaje</td>
                  <td class="col-md-3">Ultima Modificación</td>
                </tr>
              </thead>
              <tbody>
                <tr class="row m-0">
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
