<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="container-fluid text-center">
  <div class="row submenuMed">
    <div class="col-md-6" role="button" id="consul">
      <a  id="submenuMed" class="sueldosysalarios" accion="consul" status="abierto">CONSULTAR NOMINA</a>
    </div>
    <div class="col-md-6" role="button" id="gnom" style="display:none">
      <a  id="submenuMed" class="sueldosysalarios" accion="gnom" status="cerrado">GENERAR NOMINA</a>
    </div>
    <div class="col-md-6" role="button" id="gnom2" style="display:none">
      <a  id="submenuMed" class="sueldosysalarios" accion="gnom2" status="cerrado">GENERAR NOMINA</a>
    </div>
    <div class="col-md-6" role="button" id="param">
      <a id="submenuMed" class="sueldosysalarios" accion="param" status="abierto">PARAMETROS</a>
    </div>
  </div>

  <div class="contorno mt-5" id="contgenerarnom">
    <h5 class="titulo2 font14">MODIFICAR DATOS NOMINA</h5>
    <div class="row font14" id="switchs"><!--Comienzan Switchs-->
      <div class="col-md-4">
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">VALES DE DESPENSA
          </label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">PREMIO DE PUNTUALIDAD
          </label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">PREMIO DE ASISTENCIA
          </label>
        </div>
      </div>
    </div> <!--Switchs-->

    <div class="row font16" id="vprev"><!--RUTA VISTA PREVIA-->
      <div class="col-md-4 offset-md-4 mt-3" role="button">
        <a href="#" class="sueldosysalarios boton icochico" accion="vnomina" status="cerrado" style="border:none"> <img src= "/conta6/Resources/iconos/magnifier.svg"> VISTA PREVIA</a>
      </div>
    </div> <!--VISTA PREVIA-->

    <div class="row font16" style="display:none" id="generarnom"><!--RUTA GENERAR NOMINA-->
      <div class="col-md-4 offset-md-4" role="button">
        <a href="#" class="sueldosysalarios boton icochico border-0" accion="GenerarNomina" status="cerrado">
          <img src= "/conta6/Resources/iconos/002-plus.svg"> GENERAR NOMINA
        </a>
      </div>
    </div>

    <div class="row font16" style="display:none" id="preytimbrar"><!--RUTAS PREVISUALIZAR Y TIMBRAR CFDIS-->
      <div class="col-md-4 offset-md-2" role="button">
        <a href="#" class="boton icochico border-0"> <img src= "/conta6/Resources/iconos/magnifier.svg"> PREVISUALIZAR CFDI'S</a>
      </div>
      <div class="col-md-4" role="button">
        <a href="#" class="boton icochico border-0"> <img src= "/conta6/Resources/iconos/timbrar.svg"> TIMBRAR TODOS LOS CFDI'S</a>
      </div>
    </div>

    <table class="table table-hover" style="display:none" id="visualizarnomina"><!--tabla para modificr datos del CFDI-->
      <thead>
        <tr class="row encabezado">
          <td class="col-md-3">EMPLEADO</td>
          <td class="col-md-1">FALTAS</td>
          <td class="col-md-1">RETARDO</td>
          <td class="col-md-1">VACACIONES</td>
          <td class="col-md-2">COMPENSACION</td>
          <td class="col-md-1">HORAS EXTRAS</td>
          <td class="col-md-1">DIAS</td>
          <td class="col-md-1">HORAS</td>
          <td class="col-md-1">OTROS</td>
        </tr>
        <tr class="row backpink font14">
          <td class="col-md-4">Nomina : 27
          </td>
          <td class="col-md-2"></td>
          <td class="col-md-3">Fecha Inicial : 26-06-2017
          </td>
          <td class="col-md-3">Fecha Final : 02-07-2017
          </td>
        </tr>
      </thead>
      <tbody class="font16">
        <tr class="row">
          <td class="col-md-3">Agustin Alejandro Hernandez Uvaldo</td>
          <td class="col-md-1">0</td>
          <td class="col-md-1">0</td>
          <td class="col-md-1">0</td>
          <td class="col-md-2">0</td>
          <td class="col-md-1">0</td>
          <td class="col-md-1">0</td>
          <td class="col-md-1">0</td>
          <td class="col-md-1">
            <a href="#permanentes" data-toggle="modal">
              <img class="icomediano" src="/conta6/Resources/iconos/detalles.svg">
            </a>
          </td>
        </tr>
        <tr class="row">
          <td class="col-md-3">Jose Francisco Rodrigo Cardenas Garcia</td>
          <td class="col-md-1">0</td>
          <td class="col-md-1">0</td>
          <td class="col-md-1">0</td>
          <td class="col-md-2">0</td>
          <td class="col-md-1">0</td>
          <td class="col-md-1">0</td>
          <td class="col-md-1">0</td>
          <td class="col-md-1">
            <a href="#permanentes" data-toggle="modal">
              <img class="icomediano" src="/conta6/Resources/iconos/detalles.svg">
            </a>
          </td>
        </tr>
      </tbody>
    </table>


    <table class="table table-hover" style="display:none" id="visualizaCFDI"><!--tabla (ya generada la nomina)-->
      <thead>
        <tr class="row encabezado">
          <td class="col-md-1 text-left">
            <a href="">
              <img class="icomediano ml-3" src="/conta6/Resources/iconos/001-delete.svg">
            </a>
          </td>
          <td class="col-md-1">DOCUMENTO</td>
          <td class="col-md-1">NO.</td>
          <td class="col-md-3">EMPLEADO</td>
          <td class="col-md-1">POL.PAGO</td>
          <td class="col-md-1">CANCELAR</td>
          <td class="col-md-1">POL.CANCEL</td>
          <td class="col-md-1">FACTURA</td>
          <td class="col-md-1">POLIZA</td>
          <td class="col-md-1">CFDI</td>
        </tr>
      </thead>
      <tbody class="font16">
        <tr class="row">
          <td class="col-md-1">
            <a href=""><img class="icomediano" src="/conta6/Resources/iconos/001-delete.svg"></a>
            <a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/ModificarCFDI.php" class="ml-5">
              <img class="icomediano" src="/conta6/Resources/iconos/003-edit.svg">
            </a>
          </td>
          <td class="col-md-1">38089</td>
          <td class="col-md-1">426</td>
          <td class="col-md-3">Agustin Alejandro Hernandez Uvaldo</td>
          <td class="col-md-1"><a href="">248040</a></td><!--Esto debe ser un link-->
          <td class="col-md-1"></td>
          <td class="col-md-1"><a href="">234567</a></td><!--Esto debe ser un link-->
          <td class="col-md-1">15804</td>
          <td class="col-md-1"><a href="">248092</a></td><!--Esto debe ser un link-->
          <td class="col-md-1">
            <a href="#" class="boton font12">GENERAR</a>
          </td>
        </tr>
        <tr class="row"><!--Esta fila es como se vera al Timbrar CFDI-->
          <td class="col-md-1">
            <a href=""><img class="icomediano" src="/conta6/Resources/iconos/001-delete.svg"></a>
            <a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/ModificarCFDI.php" class="ml-5">
              <img class="icomediano" src="/conta6/Resources/iconos/copy.svg">
            </a>
          </td>
          <td class="col-md-1">38089</td>
          <td class="col-md-1">426</td>
          <td class="col-md-3">Agustin Alejandro Hernandez Uvaldo</td>
          <td class="col-md-1"><a href="">248040</a></td><!--Esto debe ser un link-->
          <td class="col-md-1"></td>
          <td class="col-md-1"><a href="">234567</a></td><!--Esto debe ser un link-->
          <td class="col-md-1">15804</td>
          <td class="col-md-1"><a href="">248092</a></td><!--Esto debe ser un link-->
          <td class="col-md-1">
            <a href=""><img class="icomediano" src="/conta6/Resources/iconos/pdf.svg"></a>
            <a href="" class="ml-5"><img class="icomediano" src="/conta6/Resources/iconos/xml.svg"></a><!--Estos iconos aparecen al momento de timbrar CFDI-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Nomina-->

    <!--Consultar CFDI nueva Manera Paginacion-->
  <div id="contpagination" style="display:none">
    <form class="form1">
      <table class="table">
        <tr class="row mt-5">
          <td class="col-md-2 offset-md-5 input-effect">
            <input  list="listanios" class="font14 efecto" id="anios">
            <datalist id="listanios">
              <option value="1"></option>
              <option value="2"></option>
              <option value="3"></option>
              <option value="3"></option>
              <option value="3"></option>
            </datalist>
            <label for="anios">Buscar</label>
          </td>
        </tr>
      </table>
    </form>

    <div  class="contorno mt-5">
      <table class="table table-hover mb-0">
        <thead>
          <tr class="row encabezado">
            <td class="col-md-1">NOMINA</td>
            <td class="col-md-1">EMPLEADOS</td>
            <td class="col-md-1">CFDI</td>
            <td class="col-md-1">CANCELADOS</td>
            <td class="col-md-2">PERCEPCIONES</td>
            <td class="col-md-2">DEDUCCIONES</td>
            <td class="col-md-2">TOTAL</td>
            <td class="col-md-2">TOTAL NETO</td>
          </tr>
        </thead>
        <tbody class="font16">
          <tr class="row">
            <td class="col-md-1"><a href="#">1</a></td>
            <td class="col-md-1">34</td>
            <td class="col-md-1">0</td>
            <td class="col-md-1">0</td>
            <td class="col-md-2">$140,736.04</td>
            <td class="col-md-2">$31,356.08</td>
            <td class="col-md-2">$109,450.52</td>
            <td class="col-md-2">$109,450.51</td>
          </tr>
          <tr class="row">
            <td class="col-md-1"><a href="">2</a></td>
            <td class="col-md-1">34</td>
            <td class="col-md-1">0</td>
            <td class="col-md-1">0</td>
            <td class="col-md-2">$140,736.04</td>
            <td class="col-md-2">$31,356.08</td>
            <td class="col-md-2">$109,450.52</td>
            <td class="col-md-2">$109,450.51</td>
          </tr>
        </tbody>
        <tfoot>
          <tr class="row">
            <td class="col-md-2 offset-md-5 mt-5">
              <nav>
                <ul class="pagination">
                  <li class="page-item"><as class="page-link" href="#">Atras</a></li>
                  <li class="page-item"><as class="page-link" href="#">1</a></li>
                  <li class="page-item active">
                    <a href="#" class="page-link" href="#">2<span class="sr-only"></span></a>
                  </li>
                  <li class="page-item"><as class="page-link" href="#">3</a></li>
                  <li class="page-item"><as class="page-link" href="#">4</a></li>
                  <li class="page-item"><as class="page-link" href="#">5</a></li>
                  <li class="page-item"><as class="page-link" href="#">Sig.</a></li>
                </ul>
              </nav>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <!--Comienza Consultar Parametros-->
  <div id="contornoparam" style="display:none">
    <div class="contorno mt-5">
      <h5 class="titulo font14">PARAMETROS</h5>
      <div class="acordeon2">
        <div class="encabezado font16" data-toggle="collapse" href="#colapsoArticulo80">
          <a href="#">ARTICULO 80</a>
        </div>
        <div class="collapse font14" id="colapsoArticulo80" style="padding:0rem 1.5rem!important;">
          <form class="form1">
            <table class="table table-hover">
              <thead>
                <tr class="row backpink">
                  <td class="col-md-1">Editar</td>
                  <td class="col-md-2">Inferior</td>
                  <td class="col-md-2">Superior</td>
                  <td class="col-md-2">Cuota</td>
                  <td class="col-md-2">Porcentaje</td>
                  <td class="col-md-3">Ultima Modificación</td>
                </tr>
              </thead>
              <tbody id="tablaArticulo80"></tbody>
            </table>
          </form>
        </div>
      </div>

      <div class="acordeon2 mt-3">
        <div class="encabezado font16" data-toggle="collapse" href="#colapsoGenerales">
          <a href="#">GENERALES</a>
        </div>
        <div class="collapse font14" id="colapsoGenerales" style="padding:0rem 1.5rem!important;">
          <form class="form1">
            <table class="table table-hover">
              <thead>
                <tr class="row backpink">
                  <td class="col-md-1">Editar</td>
                  <td class="col-md-1">Oficina</td>
                  <td class="col-md-2">Salario Mínimo</td>
                  <td class="col-md-1">IMSS</td>
                  <td class="col-md-1">Subsidio</td>
                  <td class="col-md-2">Días Trabajados</td>
                  <td class="col-md-2">Días por Pagar</td>
                  <td class="col-md-2">Ultima Modificación</td>
                </tr>
              </thead>
              <tbody id="tablaGenerales"></tbody>
            </table>
          </form>
        </div>
      </div>

      <div class="acordeon2 mt-3">
        <div class="encabezado font16" data-toggle="collapse" href="#colapsofIntegracion">
          <a href="#">FACTOR DE INTEGRACION</a>
        </div>
        <div class="collapse font14" id="colapsofIntegracion" style="padding:0rem 1.5rem!important;">
          <form class="form1">
            <table class="table table-hover">
              <thead>
                <tr class="row backpink">
                  <td class="col-md-3">Editar</td>
                  <td class="col-md-3">Año</td>
                  <td class="col-md-3">Integrado</td>
                  <td class="col-md-3">Ultima Modificación</td>
                </tr>
              </thead>
              <tbody id="f-integracion"></tbody>
            </table>
          </form>
        </div>
      </div>

      <div class="acordeon2 mt-3">
        <div class="encabezado font16" data-toggle="collapse" href="#colapsosubsidio">
          <a href="#">SUBSIDIO AL EMPLEO</a>
        </div>
        <div class="collapse font14" id="colapsosubsidio" style="padding:0rem 1.5rem!important;">
          <form class="form1">
            <table class="table table-hover">
              <thead>
                <tr class="row backpink">
                  <td class="col-md-2">Editar</td>
                  <td class="col-md-2">Inferior</td>
                  <td class="col-md-3">Superior</td>
                  <td class="col-md-2">Cuota</td>
                  <td class="col-md-3">Ultima Modificación</td>
                </tr>
              </thead>
              <tbody id="tablaSubsidio"></tbody>
            </table>
          </form>
        </div>
      </div>

      <div class="acordeon2 mt-3">
        <div class="encabezado font16" data-toggle="collapse" href="#colapsoimss">
          <a href="#">IMSS</a>
        </div>
        <div class="collapse font14" id="colapsoimss" style="padding:0rem 1.5rem!important;">
          <form class="form1">
            <table class="table table-hover">
              <thead>
                <tr class="row backpink">
                  <td class="col-md-1">Editar</td>
                  <td class="col-md-1">Ramo</td>
                  <td class="col-md-2">Descripción</td>
                  <td class="col-md-1">Base</td>
                  <td class="col-md-1">Tope</td>
                  <td class="col-md-2">Patrón</td>
                  <td class="col-md-2">Trabajador</td>
                  <td class="col-md-2">Ultima Modificación</td>
                </tr>
              </thead>
              <tbody class="ls0" id="tablaImss"></tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div><!--/Termina Consultar Parametros-->
</div>


<script src="js/SueldosySalarios.js"></script>
<script src="/Conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/js/parametros.js"></script>
<script src="/conta6/Resources/bootstrap/js/bootstrap-toggle.js"></script><!--para los switchs-->
<script src="/conta6/Resources/js/Inputs.js"></script>
<?php
// include_once('modales/Empleados.php');
require $root .'/conta6/Ubicaciones/Nomina/SueldosySalarios/parametros/modales/Parametros.php';
 ?>
