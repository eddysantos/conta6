<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="text-center">
<!---AL INGRESAR SOLO SE MOSTRARA ESTA SECCION-->
  <div class="row submenuMed m-0" id="SeleccionarAccion">
    <div class="col-6 ">
      <a  id="submenuMed" class="trafico" accion="buscar"><i class="fa fa-search" aria-hidden="true"></i>BUSCAR</a>
    </div>
    <div class="col-6 ">
      <a id="submenuMed" class="trafico" accion="generar"><i class="fa fa-plus" aria-hidden="true"></i>GENERAR</a>
    </div>
  </div>


<!---se muestra al dar click en Buscar-->
  <div class="contenedor "id="buscarRef" style="display:none">
    <div class="row">
      <div class="col-md-1 offset-sm-8 p-0">
        <a href="#" class="atras" accion="cuadroBusqueda">
          <i class="back fa fa-arrow-left">Regresar</i>
        </a>
      </div>
    </div>
    <div class="row titulograndetop transEff" id="referencia">
      <div class="col-md-12">
        <label class="transEff" for="bRef" id="labelRef">Referencia o Solicitud</label>
      </div>
    </div>
    <div class="row intermedio transEff" id="nReferencia">
      <div class="col-md-12" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;">
        <input class="reg border-0 transEff" id="bRef" type="text">
      </form>
      </div>
    </div>
  </div>

<!---se muestra al escribir la referencia y dar enter-->
  <div class="contenedor contorno" id="repoSol" style="display:none">
    <table class="table">
      <thead>
        <tr class="row">
          <td class="col-md-1 offset-sm-11 p-0">
            <a class="atras" accion="cuadroConsultar">
              <i class="back fa fa-arrow-left">Regresar</i>
            </a>
          </td>
        </tr>
      </thead>
      <tbody class="font16">
        <tr class="row encabezado font18">
          <td class="col-md-12">Solicitud de Anticipo</td>
        </tr>
        <tr class="row backpink">
          <td class="col-md-1"></td>
          <td class="col-md-2">SOLICITUD</td>
          <td class="col-md-2">REFERENCIA</td>
          <td class="col-md-5">CLIENTE</td>
          <td class="col-md-1"></td>
          <td class="col-md-1"></td>
        </tr>
        <tr class="row borderojo">
          <td class="col-md-1">
            <a href="SolEditar.php">
              <img class="icomediano" src="/conta6/Resources/iconos/003-edit.svg">
            </a>
          </td>
          <td class="col-md-2">280380</td>
          <td class="col-md-2">N17003012</td>
          <td class="col-md-6">CLT_6548 MOTORES ELECTRICOS SUMERGIBLES DE MEXICO, S. DE R.L DE C.V</td>
          <td class="col-md-1">
            <a href="SolConsultar.php"><img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg"></a>
            <a href="#"><img class="icomediano ml-5" src="/conta6/Resources/iconos/printer.svg"></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

<!---se muestra al dar click en referencia-->
  <div class="contenedor" id="gSolicitud" style="display:none">
    <div class="col-md-1 offset-sm-8 p-0">
      <a class="atras" accion="cuadroGenerar">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <div class="row titulograndetop transEff mt-2" id="gSolicitudRef">
      <div class="col-md-12">
        <label class="transEff" for="gRef" id="labelgRef">Generar Solicitud</label>
      </div>
      <div class="col-md-12 backpink font18">
        <label class="transEff">REFERENCIA</label>
      </div>
    </div>
    <div class="row intermedio">
      <div class="col-md-12" id="mostrarGenerar">
        <form class="form-group" onsubmit="return false;">
<<<<<<< HEAD
          <input class="reg form-control border-0 transEff" id="gRef" type="text">
=======
          <input class="reg border-0 transEff" id="gRef" type="text">
>>>>>>> CSScorresponsales
        </form>
      </div>
    </div>
  </div>

  <div class="contenedor contorno" style="display:none" id="datosSol">
    <table class="table form1">
      <thead>
        <tr class="row">
          <th class="col-md-2 offset-sm-10 p-0 text-right">
            <a class="atras" accion="cuadroDatosSol">
              <i class="back fa fa-arrow-left">Regresar</i>
            </a>
          </th>
        </tr>
      </thead>
      <tbody class="font16">
        <tr class="row encabezado font18">
          <td class="col-md-12">Generar Solicitud</td>
        </tr>
        <tr class="row mt-5">
          <td class="col-md-12 input-effect">
            <input  list="lista-clientes" class="efecto" id="clientes1">
            <datalist id="lista-clientes">
              <option value="SERVICIOS INTEGRALES EN LOGISTICA INTERNACIONAL, ADUANAS Y TECNOLOGIA, S.C --- CLT_7158"></option>
              <option value="TURBO-MEX REFACCIONES,MANTENIMIENTO Y SEGURIDAD INDUSTRIAL S.A DE C.V --- CLT_7114"></option>
            </datalist>
            <label for="clientes1">CLIENTES</label>
          </td>
        </tr>
        <tr class="row mt-4">
          <td class="col-md-12 input-effect">
            <input  list="lista-almacenes" class="efecto" id="almacenes">
            <datalist id="lista-almacenes">
              <option value="4 --- AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- AEROPUERTO"></option>
              <option value="Almacen Numero 1 Almacen Numero 1"></option>
            </datalist>
            <label for="almacenes">ALMACENES</label>
          </td>
        </tr>
        <tr class="row mt-4">
          <td class="col-md-2 input-effect">
            <input  list="lista-tipo" class="efecto" id="tipo">
            <datalist id="lista-tipo">
              <option value="Importación"></option>
              <option value="Exportación"></option>
            </datalist>
            <label for="tipo">TIPO</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="valor" class="efecto" type="text">
            <label for="valor">VALOR</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="peso" class="efecto" type="text">
            <label for="peso">PESO (KG)</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="volumen" class="efecto" type="text">
            <label for="volumen">VOLUMEN</label>
          </td>
          <td class="col-md-2 input-effect">
            <input id="dias" class="efecto" type="text">
            <label for="dias">DÍAS</label>
          </td>
          <td class="col-md-2">
            <a href="#" class="boton"><img src= "/conta6/Resources/iconos/magnifier.svg" class="icochico"> BUSCAR</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="../js/Trafico.js"></script>
