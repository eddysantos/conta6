<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="text-center">
<!---AL INGRESAR SOLO SE MOSTRARA ESTA SECCION-->
  <div class="row submenuMed m-0 font14" id="SeleccionarAccion">
    <div class="col-md-4">
      <a  href="#" class="trafico" accion="buscar"><i class="fa fa-search" aria-hidden="true"></i>Buscar</a>
    </div>
    <div class="col-md-4">
      <a href="#" class="trafico" accion="generar"><i class="fa fa-plus" aria-hidden="true"></i>Generar</a>
    </div>
    <div class="col-md-4">
      <a href="#" class="trafico" accion="generarST"><i class="fa fa-plus" aria-hidden="true"></i>Generar sin datos tranferidos</a>
    </div>
  </div>


<!---se muestra al dar click en Buscar-->
  <div class="contenedor "id="buscarRef" style="display:none">
    <div class="row m-0">
      <div class="col-md-1 offset-sm-8 p-0">
        <a href="#" class="atras" accion="cuadroBusqueda">
          <i class="back fa fa-arrow-left">Regresar</i>
        </a>
      </div>
    </div>
    <div class="row justify-content-center" id="referencia">
      <div class="col-md-6 transEff titulograndetop">Referencia o Proforma</div>
    </div>
    <div class="row justify-content-center" id="nReferencia">
      <div class="col-md-6 transEff intermedio" id="mostrarConsulta-trafico">
        <form  class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="bRef-trafico" type="text" autocomplete="off">
        </form>
      </div>
    </div>
  </div>

<!---se muestra al escribir la referencia y dar enter-->
  <div class="contenedor contorno" id="repoSol-trafico" style="display:none">
    <table class="table">
      <thead>
        <tr class="row">
          <td class="col-md-1 offset-sm-11 p-0">
            <a href="#" class="atras" accion="cuadroConsultar">
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
      </tbody>
      <tbody id="lst_proformas"></tbody>
    </table>
  </div>



<!---se muestra al dar click en GENERAR-->
  <div class="mt-5" id="gSolicitud" style="display:none;margin-bottom:100px">
    <div class="col-md-1 offset-sm-8 p-0">
      <a href="#" class="atras" accion="cuadroGenerar">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <div class="row justify-content-center m-0" id="gSolicitudRef">
      <div class="col-md-6 transEff titulograndetop">
        <label class="transEff" for="gRef" id="labelgRef">Generar Solicitud</label>
      </div>
    </div>
    <!--div class="row justify-content-center m-0">
      <div class="col-md-6 backpink font18">
        <label class="transEff">REFERENCIA</label>
      </div>
    </div-->
    <div class="row justify-content-center m-0">
      <table class="table">
        <tbody class="font18">
          <tr class="row mt-5">
            <td class="col-md-4 offset-md-3 input-effect">
              <input class="efecto tiene-contenido popup-input" maxlength="9" id="gRef" type="text" id-display="#popup-display-gRef" action="referencias" db-id="" autocomplete="off">
              <div class="popup-list" id="popup-display-gRef" style="display:none"></div>
              <label for="gRef">CON REFERENCIA</label>
            </td>
            <td class="col-md-2">
              <a href="#" id="btn_buscarDatosEmbarque_solAnt" class="boton"> <i class="fa fa-search "></i> Consultar</a>
            </td>
          </tr>
        </tbody>
      </table>
      <!--div class="col-md-6 transEff intermedio" id="mostrarGenerar">
        <form  class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="gRef" type="text" autocomplete="off" maxlength="9">
        </form>
      </div-->
    </div>

    <div id="datosSol"></div>
    <!--div class="contorno" id="datosSol" style="display:none">
      <form class="form1">
        <table class="table font12">
          <tr class='row'>
            <td class='col-md-12 sub'>INFORMACIÓN GENERAL DEL EMBARQUE</td>
          </tr>
          <tr class='row'>
            <td class='col-md-1 text-right b'><b>Cliente:</b></td>
            <td class='col-md-5 text-left'>LIBRERIA GANDHI, S.A. DE C.V. -- CLT_7345</td>
            <td class='col-md-1 text-right b'><b>Proveedor:</b></td>
            <td class='col-md-5 text-left'>HACHETTE BOOK GROUP -- PRV_11737</td>
          </tr>
          <tr class='row borderojo'>
             <td class='col-md-1 text-right b'><b>Almacén:</b></td>
             <td class='col-md-5 text-left'>Ninguno -- Id: 0</td>
             <td class='col-md-1 text-right b'><b>Descripción:</b></td>
             <td class='col-md-5 text-left'>BOOKS</td>
          </tr>
          <tr class='row pt-4'>
            <td class='p-0 col-md-2 text-right b'><b>Aduana:</b></td>
            <td class='p-0 col-md-2 text-left'>240</td>
            <td class='p-0 col-md-2 text-right b'><b>Procedencia o destino:</b></td>
            <td class='p-0 col-md-2 text-left'></td>
            <td class='p-0 col-md-2 text-right b'><b>Tipo de operación:</b></td>
        	  <td class='p-0 col-md-2 text-left'>A1</td>
          </tr>
          <tr class='row pt-3'>
            <td class='p-0 col-md-2 text-right b'><b>Tipo:</b></td>
            <td class='p-0 col-md-2 text-left'>Importación</td>
            <td class='p-0 col-md-2 text-right b pl-0'><b>Fecha arribo o salida:</b></td>
            <td class='p-0 col-md-2 text-left'>01-01-2000</td>
            <td class='p-0 col-md-2 text-right b'><b>Talones, Guia o B/Ls:</b></td>
        	  <td class='p-0 col-md-2 text-left'>889160506</td>
          </tr>
          <tr class='row align-items-center' style='padding-top: .7rem!important;'>
            <td class='p-0 col-md-2 text-right b'><b>Nuestra referencia:</b></td>
            <td class='p-0 col-md-2 text-left'>
              <input class='inputId bt text-left p-0' type='text' id='' value ="N13003039" readonly>
            </td>
            <td class='p-0 col-md-2 text-right b'><b>Peso en Kg:</b></td>
            <td class='p-0 col-md-2 text-left'>2,145.00</td>
            <td class='p-0 col-md-2 text-right b'><b>Valor Aduana M.N.:</b></td>
        	  <td class='p-0 col-md-2 text-left'>293,207.00</td>
          </tr>

          <tr class='row borderojo pb-4 pt-3'>
            <td class='p-0 col-md-2 text-right b'><b>Su Referencia:</b></td>
            <td class='p-0 col-md-2 text-left'></td>
            <td class='p-0 col-md-2 text-right b'><b>No. Pedimento:</b></td>
            <td class='p-0 col-md-2 text-left'>3003012</td>
            <td class='p-0 col-md-2 text-right b'><b>Tipo de cambio:</b></td>
        	  <td class='p-0 col-md-2 text-left'>12.00</td>
          </tr>

          <tr class='row mt-4 align-items-center'>
            <td class='p-0 col-md-2 text-right b'><b>Días en almacen:</b></td>
            <td class='p-0 col-md-1'>
              <input type='text' id='' class='efecto h18' autocomplete='off'>
            </td>

            <td class='p-0 col-md-2 offset-md-1 text-right b'><b>Shipper:</b></td>
            <td class='p-0 col-md-1'>
              <input class='text-left bt inputId p-0' type='text' id='' readonly>
            </td>

            <td class='p-0 col-md-2 offset-md-1 text-right b'><b>Núm. de Facturas:</b></td>
        	  <td class='p-0 col-md-2 text-left'>41790933,41790960</td>
          </tr>

          <tr class='row mt-2 align-items-center'>
            <td class='p-0 col-md-2 text-right b'><b>Flete:</b></td>
            <td class='p-0 col-md-1'><input class='text-left bt inputId p-0' type='text' id='' readonly></td>

            <td class='p-0 col-md-2 offset-md-1 text-right b'><b>InBond:</b></td>
            <td class='p-0 col-md-1'><input class='text-left bt inputId p-0' type='text' id='' value="NO" readonly></td>

            <td class='p-0 col-md-2 offset-md-1 text-right b'><b>Trailer de Salida:</b></td>
            <td class='p-0 col-md-1 text-left'>249DS1</td>
         </tr>

         <tr class='row pt-2 align-items-center'>
           <td class='p-0 col-md-2 text-right b'><b>Cobrar:</b></td>
           <td class='p-0 col-md-1 text-left'></td>

           <td class='p-0 col-md-2 offset-md-1 text-right b'><b>Reexpedición:</b></td>
           <td class='p-0 col-md-1 text-left'></td>

           <td class='p-0 col-md-2 offset-md-1 text-right b'><b>Entradas:</b></td>
           <td class='p-0 col-md-1'><input class='text-left bt inputId p-0' type='text' id='' value="1" readonly></td>
         </tr>

         <tr class='row pt-2 align-items-center'>
           <td class='p-0 col-md-2 text-right b'><b>Consolidado:</b></td>
           <td class='p-0 col-md-1'>
             <input class='text-left bt inputId p-0' type='text' id='' value="LTL" readonly>
           </td>
         </tr>

         <tr class='row mt-5 align-items-center'>
           <td class='p-0 col-md-2 text-right b'><b>Estatus:</b></td>
           <td class='p-0 col-md-4 text-left'>Ya existe cuenta de gastos con esta referencia</td>
         </tr>
         <tr class="row justify-content-center">
           <td class="col-md-1">
              <a href="#" id="" onclick="" class="boton"> Siguiente</a>
            </td>
         </tr>
        </table>
      </form>
    </div-->
  </div>




    <div id="generarSinDatos" class="contorno" style="margin-top:50px!important;display:none">
      <table class="table form1">
        <thead>
          <tr class="row">
            <th class="col-md-2 offset-sm-10 p-0 text-right">
              <a href="#" class="atras" accion="cuadroDatosSol">
                <i class="back fa fa-arrow-left">Regresar</i>
              </a>
            </th>
          </tr>
        </thead>
        <tbody class="font16">
          <tr class="row encabezado font18 mt-2">
            <td class="col-md-12">Generar Solicitud</td>
          </tr>
          <tr class="row mt-5">
            <td class="col-md-12 input-effect">
              <input class="efecto tiene-contenido popup-input" maxlength="9" id="lista-clientes" type="text" id-display="#popup-display-lista-clientes" action="clientes" db-id="" autocomplete="off">
              <div class="popup-list" id="popup-display-lista-clientes" style="display:none"></div>
              <label for="lista-clientes">CLIENTES</label>
            </td>
          </tr>
          <tr class="row mt-4">
            <td class="col-md-12 input-effect">
              <input class="efecto tiene-contenido popup-input" maxlength="9" id="lista-almacenes" type="text" id-display="#popup-display-lista-almacenes" action="almacenes" db-id="" autocomplete="off">
              <div class="popup-list" id="popup-display-lista-almacenes" style="display:none"></div>
              <label for="lista-almacenes">ALMACENES</label>
            </td>
          </tr>
          <tr class="row mt-4">
            <td class="col-md-2 input-effect">
              <select class="custom-select-ch" size="1" id="tipo">
                <option value="I" selected>Importación</option>
                <option value="E">Exportación</option>
              </select>
              <!--input  list="lista-tipo" class="efecto" id="tipo">
              <datalist id="lista-tipo">
                <option value="I" selected>Importación</option>
                <option value="E">Exportación</option>
              </datalist>
              <label for="tipo">TIPO</label-->
            </td>
            <td class="col-md-2 input-effect">
              <input class="efecto tiene-contenido" id="valor" value="0" onchange="validaIntDec(this);">
              <label for="valor">VALOR</label>
            </td>
            <td class="col-md-2 input-effect">
              <input class="efecto tiene-contenido" id="peso" value="0" onchange="validaIntDec(this);">
              <label for="peso">PESO (KG)</label>
            </td>
            <td class="col-md-2 input-effect">
              <input class="efecto tiene-contenido" id="volumen" value="0" onchange="validaIntDec(this);">
              <label for="volumen">VOLUMEN</label>
            </td>
            <td class="col-md-2 input-effect">
              <input class="efecto tiene-contenido" id="dias" value="0" onchange="validaSoloNumeros(this);">
              <label for="dias">DÍAS</label>
            </td>
            <td class="col-md-2">
              <a href="#" class="boton" onclick="solAntGenerarSinRef()"><img src= "/conta6/Resources/iconos/magnifier.svg" class="icochico"> BUSCAR</a><!--nueva pagina, ingresar datos en poliza-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
</div>

<script src="/conta6/Resources/js/Inputs.js"></script>

<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
