<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="container-fluid">
  <div class="row submenuMed m-0">
    <div class="col-md-6 text-center" role="button" id="consul">
      <a  id="submenuMed" class="sueldosysalarios" accion="consul" status="abierto">CONSULTAR NOMINA</a>
    </div>
    <div class="col-md-6 text-center" role="button" id="gnom" style="display:none">
      <a  id="submenuMed" class="sueldosysalarios" accion="gnom" status="cerrado">GENERAR NOMINA</a>
    </div>
    <div class="col-md-6 text-center" role="button" id="gnom2" style="display:none">
      <a  id="submenuMed" class="sueldosysalarios" accion="gnom2" status="cerrado">GENERAR NOMINA</a>
    </div>
    <div class="col-md-6 text-center" role="button" id="param">
      <a id="submenuMed" class="sueldosysalarios" accion="param" status="abierto">PARAMETROS</a>
    </div>
  </div>

  <div class="brx2 contorno" id="contgenerarnom">
    <h5 class="titulo2" style="font-size:15px">MODIFICAR DATOS NOMINA</h5>

    <div class="row" style="font-size:14px" id="switchs"><!--Comienzan Switchs-->
      <div class="col-md-4 text-center">
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">
            VALES DE DESPENSA
          </label>
        </div>
      </div>
      <div class="col-md-4 text-center">
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">
            PREMIO DE PUNTUALIDAD
          </label>
        </div>
      </div>
      <div class="col-md-4 text-center">
        <div class="checkbox">
          <label>
            <input type="checkbox" data-toggle="toggle">
            PREMIO DE ASISTENCIA
          </label>
        </div>
      </div>
    </div> <!--Switchs-->

    <div class="row" style="font-size:16px" id="vprev"><!--RUTA VISTA PREVIA-->
      <div class="col-md-4 offset-md-4 brx1" role="button">
        <a href="#" class="sueldosysalarios boton btn-block text-center icochico" accion="vnomina" status="cerrado" style="border:none"> <img src= "/conta6/Resources/iconos/magnifier.svg"> VISTA PREVIA</a>
      </div>
    </div> <!--VISTA PREVIA-->

    <div class="row" style="font-size:16px; display:none" id="generarnom"><!--RUTA GENERAR NOMINA-->
      <div class="col-md-4 offset-md-4" role="button">
        <a href="#" class="sueldosysalarios boton btn-block text-center icochico" style="border:none" accion="GenerarNomina" status="cerrado">
          <img src= "/conta6/Resources/iconos/002-plus.svg"> GENERAR NOMINA
        </a>
      </div>
    </div>

    <div class="row" style="font-size:16px; display:none" id="preytimbrar"><!--RUTAS PREVISUALIZAR Y TIMBRAR CFDIS-->
      <div class="col-md-4 offset-md-2" role="button">
        <a href="#" class="boton btn-block text-center icochico" style="border:none"> <img src= "/conta6/Resources/iconos/magnifier.svg"> PREVISUALIZAR CFDI'S</a>
      </div>
      <div class="col-md-4" role="button">
        <a href="#" class="boton btn-block text-center icochico" style="border:none"> <img src= "/conta6/Resources/iconos/timbrar.svg"> TIMBRAR TODOS LOS CFDI'S</a>
      </div>
    </div>

    <table class="table table-hover" style="display:none" id="visualizarnomina"><!--tabla para modificr datos del CFDI-->
      <thead>
        <tr class="row tRepoNom">
          <td class="col-md-3 text-center">EMPLEADO</td>
          <td class="col-md-1 text-center">FALTAS</td>
          <td class="col-md-1 text-center">RETARDO</td>
          <td class="col-md-1 text-center">VACACIONES</td>
          <td class="col-md-2 text-center">COMPENSACION</td>
          <td class="col-md-1 text-center">HORAS EXTRAS</td>
          <td class="col-md-1 text-center">DIAS</td>
          <td class="col-md-1 text-center">HORAS</td>
          <td class="col-md-1 text-center">OTROS</td>
        </tr>
        <tr class="row" style="font-size:12px">
          <td class="col-md-4 iap">
            <input class="inp-nom noborder" type="text" value="Nomina : 27">
          </td>
          <td class="col-md-2 iap"></td>
          <td class="col-md-3 iap">
            <input class="inp-nom noborder" type="text" value="Fecha Inicial : 26-06-2017">
          </td>
          <td class="col-md-3 iap">
            <input class="inp-nom noborder" type="text" value="Fecha Final : 02-07-2017">
          </td>
        </tr>
      </thead>
      <tbody style="font-size:16px">
        <tr class="row  brx1">
          <td class="col-md-3 text-center">Agustin Alejandro Hernandez Uvaldo</td>
          <td class="col-md-1">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-1">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-1">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-2">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-1">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-1">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-1">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-1 text-center">
            <a href="#permanentes" data-toggle="modal">
              <img class="icomediano" src="/conta6/Resources/iconos/detalles.svg">
            </a>
          </td>
        </tr>
        <tr class="row">
          <td class="col-md-3 text-center">Jose Francisco Rodrigo Cardenas Garcia</td>
          <td class="col-md-1">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-1">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-1">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-2">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-1">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-1">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-1">
            <input class="inp-nom noborder" type="text" value="0">
          </td>
          <td class="col-md-1 text-center">
            <a href="#permanentes" data-toggle="modal">
              <img class="icomediano" src="/conta6/Resources/iconos/detalles.svg">
            </a>
          </td>
        </tr>
      </tbody>
    </table>

    <table class="table table-hover text-center" style="display:none" id="visualizaCFDI"><!--tabla (ya generada la nomina)-->
      <thead>
        <tr class="row tRepoNom">
          <td class="col-md-1 tleft">
            <a href="">
              <img class="icomediano mleft" src="/conta6/Resources/iconos/001-delete.svg">
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
      <tbody style="font-size:16px">
        <tr class="row">
          <td class="col-md-1">
            <a href=""><img class="icomediano" src="/conta6/Resources/iconos/001-delete.svg"></a>
            <a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/ModificarCFDI.php" class="mleftx2">
              <img class="icomediano" src="/conta6/Resources/iconos/003-edit.svg">
            </a>
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
            <input class="btn-block botonrow" type="button" value="GENERAR">
          </td>
        </tr>

        <tr class="row"><!--Esta fila es como se vera al Timbrar CFDI-->
          <td class="col-md-1">
            <a href=""><img class="icomediano" src="/conta6/Resources/iconos/001-delete.svg"></a>
            <a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/ModificarCFDI.php" class="mleftx2">
              <img class="icomediano" src="/conta6/Resources/iconos/copy.svg">
            </a>
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
            <a href="" class="mleftx2"><img class="icomediano" src="/conta6/Resources/iconos/xml.svg"></a><!--Estos iconos aparecen al momento de timbrar CFDI-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Nomina-->

  <!--Comienza Generar CFDI-->
  <div id="contornogcfdi" style="display:none">
    <div class="contorno brx4">
      <table class="table text-center table-hover mb-0">
        <thead>
          <tr class="row tRepoNom">
            <td class="col-md-1">ACCIONES</td>
            <td class="col-md-1">DOCUMENTO</td>
            <td class="col-md-1">NO.</td>
            <td class="col-md-3">EMPLEADO</td>
            <td class="col-md-1">POL.PAGO</td>
            <td class="col-md-1">CANCELAR</td>
            <td class="col-md-1">POL.CALCELADA</td>
            <td class="col-md-1">FACTURA</td>
            <td class="col-md-1">POLIZA</td>
            <td class="col-md-1">CFDI</td>
          </tr>
          <tr class="row">
            <td class="col-md-3 iap">
              <input class="inp-nom noborder tright" type="text" value="Nomina : 27">
            </td>
            <td class="col-md-1 iap tleft">
              <a href="">
                <img class="icomediano" src="/conta6/Resources/iconos/printer.svg">
              </a>
            </td>
            <td class="col-md-2 iap"></td>
            <td class="col-md-3  iap">
              <input class="inp-nom noborder" type="text" value="Fecha Inicial : 26-06-2017">
            </td>
            <td class="col-md-3  iap">
              <input class="inp-nom noborder" type="text" value="Fecha Final : 02-07-2017">
            </td>
          </tr>
        </thead>
        <tbody style="font-size:16px">
          <tr class="row brx1">
            <td class="col-md-1">
              <a href=""><img class="icomediano" src="/conta6/Resources/iconos/001-delete.svg"></a>
              <a class="mleftx2"><img class="icomediano" src="/conta6/Resources/iconos/copy.svg"></a>
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
          <tr class="row brx1">
            <td class="col-md-1">
              <a href=""><img class="icomediano" src="/conta6/Resources/iconos/001-delete.svg"></a>
              <a href="" class="mleftx2"><img class="icomediano" src="/conta6/Resources/iconos/copy.svg"></a>
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
  </div><!--/Comienza Generar CDFI--><!--Consultar CFDIs de nominas ya generadas-->
    <!--Consultar CFDI nueva Manera Paginacion-->
  <div id="contpagination" style="display:none">
    <form class="form1">
      <table class="table text-center">
        <tr class="row">
          <td class="col-md-2 offset-md-5 input-effect">
            <input  list="listanios" class="text-normal efecto text-center" id="anios">
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

    <div  class="contorno brx4">
      <table class="table text-center table-hover mb-0">
        <thead>
          <tr class="row tRepoNom">
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
        <tbody style="font-size:16px">
          <tr class="row" id="pag">
            <td class="col-md-1">1</td>
            <td class="col-md-1">34</td>
            <td class="col-md-1">0</td>
            <td class="col-md-1">0</td>
            <td class="col-md-2">$140,736.04</td>
            <td class="col-md-2">$31,356.08</td>
            <td class="col-md-2">$109,450.52</td>
            <td class="col-md-2">$109,450.51</td>
          </tr>
          <tr class="row" id="pag">
            <td class="col-md-1">2</td>
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
            <td class="col-md-2 offset-md-5 brx4">
              <nav>
                <ul class="pagination">
                  <li class="page-item"><a id="bread" class="page-link" href="#">Atras</a></li>
                  <li class="page-item"><a id="bread" class="page-link" href="#">1</a></li>
                  <li class="page-item active">
                    <a  id="bread" class="page-link" href="#">2<span class="sr-only"></span></a>
                  </li>
                  <li class="page-item"><a id="bread" class="page-link" href="#">3</a></li>
                  <li class="page-item"><a id="bread" class="page-link" href="#">4</a></li>
                  <li class="page-item"><a id="bread" class="page-link" href="#">5</a></li>
                  <li class="page-item"><a id="bread" class="page-link" href="#">Sig.</a></li>
                </ul>
              </nav>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<!--Comienza Consultar Parametros-->
<div id="contornoparam" style="display:none">
  <div class="contorno brx4">
    <h5 class="titulo" style="font-size:15px">PARAMETROS</h5>
    <div class="acordeon2">
      <div class="tRepo2 text-center" data-toggle="collapse" href="#colapsoArticulo80">
        <a  id="bread">ARTICULO 80</a>
      </div>
      <div class="collapse" id="colapsoArticulo80" style="padding:0rem 1.5rem!important;font-size:14px">
        <form class="form1" method="post">
          <table class="table table-hover text-center">
            <thead>
              <tr class="row submenuch">
                <td class="col-md-1">Editar</td>
                <td class="col-md-2">Inferior</td>
                <td class="col-md-2">Superior</td>
                <td class="col-md-2">Cuota</td>
                <td class="col-md-2">Porcentaje</td>
                <td class="col-md-3">Ultima Modificación</td>
              </tr>
            </thead>
            <tbody>
              <tr class="row brx1">
                <td class="col-md-1">
                  <a href="#articulo80" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-2">0.01</td>
                <td class="col-md-2"></td>
                <td class="col-md-2">0.00</td>
                <td class="col-md-2">1.92</td>
                <td class="col-md-3"></td>
              </tr>
              <tr class="row">
                <td class="col-md-1">
                  <a href="" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-2">114.25</td>
                <td class="col-md-2">969.50</td>
                <td class="col-md-2">2.17</td>
                <td class="col-md-2">6.40</td>
                <td class="col-md-3"></td>
              </tr>
              <tr class="row">
                <td class="col-md-1">
                  <a href="" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-2">969.51</td>
                <td class="col-md-2">1,703.80</td>
                <td class="col-md-2">56.91</td>
                <td class="col-md-2">10.88</td>
                <td class="col-md-3"></td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 brx1">
      <div class="tRepo2 text-center" data-toggle="collapse" href="#colapsoGenerales">
        <a  id="bread">GENERALES</a>
      </div>
      <div class="collapse" id="colapsoGenerales" style="padding:0rem 1.5rem!important;font-size:14px">
        <form class="form1" method="post">
          <table class="table table-hover text-center">
            <thead>
              <tr class="row submenuch">
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
            <tbody>
              <tr class="row brx1">
                <td class="col-md-1">
                  <a href="#paramgenerales" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-1">470</td>
                <td class="col-md-2">73.04</td>
                <td class="col-md-1">1.05</td>
                <td class="col-md-1">0.00</td>
                <td class="col-md-2">6</td>
                <td class="col-md-2">7</td>
                <td class="col-md-2"></td>
              </tr>
              <tr class="row">
                <td class="col-md-1">
                  <a href="" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-1">160</td>
                <td class="col-md-2">73.04</td>
                <td class="col-md-1">1.05</td>
                <td class="col-md-1">0.00</td>
                <td class="col-md-2">6</td>
                <td class="col-md-2">7</td>
                <td class="col-md-2"></td>
              </tr>
              <tr class="row">
                <td class="col-md-1">
                  <a href="" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-1">430</td>
                <td class="col-md-2">73.04</td>
                <td class="col-md-1">1.05</td>
                <td class="col-md-1">0.00</td>
                <td class="col-md-2">6</td>
                <td class="col-md-2">7</td>
                <td class="col-md-2"></td>
              </tr>
              <tr class="row">
                <td class="col-md-1">
                  <a href="" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-1">240</td>
                <td class="col-md-2">73.04</td>
                <td class="col-md-1">1.05</td>
                <td class="col-md-1">0.00</td>
                <td class="col-md-2">6</td>
                <td class="col-md-2">7</td>
                <td class="col-md-2"></td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 brx1">
      <div class="tRepo2 text-center" data-toggle="collapse" href="#colapsofIntegracion">
        <a  id="bread">FACTOR DE INTEGRACION</a>
      </div>
      <div class="collapse" id="colapsofIntegracion" style="padding:0rem 1.5rem!important;font-size:14px">
        <form class="form1" method="post">
          <table class="table table-hover text-center">
            <thead>
              <tr class="row submenuch">
                <td class="col-md-3">Editar</td>
                <td class="col-md-3">Año</td>
                <td class="col-md-3">Integrado</td>
                <td class="col-md-3">Ultima Modificación</td>
              </tr>
            </thead>
            <tbody>
              <tr class="row brx1">
                <td class="col-md-3">
                  <a href="#factorintegracion" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-3">1</td>
                <td class="col-md-3">1.05</td>
                <td class="col-md-3"></td>
              </tr>
              <tr class="row">
                <td class="col-md-3">
                  <a href="" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-3">2</td>
                <td class="col-md-3">1.05</td>
                <td class="col-md-3"></td>
              </tr>
              <tr class="row">
                <td class="col-md-3">
                  <a href="" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-3">3</td>
                <td class="col-md-3">1.05</td>
                <td class="col-md-3"></td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 brx1">
      <div class="tRepo2 text-center" data-toggle="collapse" href="#colapsosubsidio">
        <a  id="bread">SUBSIDIO AL EMPLEO</a>
      </div>
      <div class="collapse" id="colapsosubsidio" style="padding:0rem 1.5rem!important;font-size:14px">
        <form class="form1" method="post">
          <table class="table table-hover text-center">
            <thead>
              <tr class="row submenuch">
                <td class="col-md-2">Editar</td>
                <td class="col-md-2">Inferior</td>
                <td class="col-md-3">Superior</td>
                <td class="col-md-2">Cuota</td>
                <td class="col-md-3">Ultima Modificación</td>
              </tr>
            </thead>
            <tbody>
              <tr class="row brx1">
                <td class="col-md-2">
                  <a href="#subsidio" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-2">0.01</td>
                <td class="col-md-3">407.32</td>
                <td class="col-md-2">93.73</td>
                <td class="col-md-3"></td>
              </tr>
              <tr class="row">
                <td class="col-md-2">
                  <a href="" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-2">407.32</td>
                <td class="col-md-3">610.97</td>
                <td class="col-md-2">93.66</td>
                <td class="col-md-3"></td>
              </tr>
              <tr class="row">
                <td class="col-md-2">
                  <a href="" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-2">610.97</td>
                <td class="col-md-3">799.66</td>
                <td class="col-md-2">93.66</td>
                <td class="col-md-3"></td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

    <div class="acordeon2 brx1">
      <div class="tRepo2 text-center" data-toggle="collapse" href="#colapsoimss">
        <a  id="bread">IMSS</a>
      </div>
      <div class="collapse" id="colapsoimss" style="padding:0rem 1.5rem!important;font-size:14px">
        <form class="form1" method="post">
          <table class="table table-hover text-center">
            <thead>
              <tr class="row submenuch">
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
            <tbody style="letter-spacing:0px">
              <tr class="row brx1">
                <td class="col-md-1">
                  <a href="#imss" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-1">1</td>
                <td class="col-md-2">EM-Prestaciones en Dinero</td>
                <td class="col-md-1">1</td>
                <td class="col-md-1">99</td>
                <td class="col-md-2">0.699999988079071</td>
                <td class="col-md-2">0.25</td>
                <td class="col-md-2"></td>
              </tr>
              <tr class="row">
                <td class="col-md-1">
                  <a href="" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-1">2</td>
                <td class="col-md-2">EM-Especie-Adicional</td>
                <td class="col-md-1">3.009999990463257</td>
                <td class="col-md-1">23</td>
                <td class="col-md-2">1.100000023841858</td>
                <td class="col-md-2">0.400000059604645</td>
                <td class="col-md-2"></td>
              </tr>
              <tr class="row">
                <td class="col-md-1">
                  <a href="" data-toggle="modal">
                    <img class="icochico" src="/conta6/Resources/iconos/003-edit.svg">
                  </a>
                </td>
                <td class="col-md-1">1</td>
                <td class="col-md-2">EM-Prestaciones en Dinero</td>
                <td class="col-md-1">1</td>
                <td class="col-md-1">99</td>
                <td class="col-md-2">0.699999988079071</td>
                <td class="col-md-2">0.25</td>
                <td class="col-md-2"></td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</div><!--/Termina Consultar Parametros-->



<script src="js/SueldosySalarios.js"></script>
<script src="/conta6/Resources/bootstrap/js/bootstrap-toggle.js"></script><!--para los switchs-->
<script src="/conta6/Resources/js/Inputs.js"></script>
<?php
include_once('modales/Empleados.php');
include_once('modales/Parametros.php');
 ?>
