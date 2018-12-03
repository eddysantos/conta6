<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="text-center">

<!---AL INGRESAR SOLO SE MOSTRARA ESTA SECCION-->
  <div class="row submenuMed m-0" id="SeleccionarAccion">
    <div class="col-md-6">
      <a  id="submenuMed" class="ctagastos" accion="buscar"><i class="fa fa-search" aria-hidden="true"></i>BUSCAR</a>
    </div>
    <div class="col-md-6">
      <a id="submenuMed" class="ctagastos" accion="generar"><i class="fa fa-plus" aria-hidden="true"></i>GENERAR</a>
    </div>
  </div>


<!---se muestra al dar click en Buscar-->
  <div id="buscarRef" class="contenedor" style="display:none">
    <div class="row m-0">
      <div class="col-md-1 offset-sm-8 ">
        <a href="#" class="atras" accion="cuadroBusqueda">
          <i class="back fa fa-arrow-left">Regresar</i>
        </a>
      </div>
    </div>
    <div class="row justify-content-center" id="referencia">
      <div class="col-md-6 titulograndetop transEff">
        <label class="transEff" for="bRef" id="labelRef">Referencia o Solicitud</label>
      </div>
    </div>
    <div class="row justify-content-center" id="nReferencia">
      <div class="col-md-6 intermedio transEff" id="mostrarConsulta">
        <form  class="form-group" onsubmit="return false;">
        <input class="reg border-0 transEff" id="bRef" type="text" autocomplete="off">
      </form>
      </div>
    </div>
  </div>

<!---se muestra al escribir la referencia y dar enter-->
  <div class="contenedor contorno" id="repoSol" style="display:none">
    <table class="table font18">
      <tr class="row">
        <td class="col-md-1 offset-sm-11 p-0">
          <a class="atras" accion="cuadroConsultar">
            <i class="back fa fa-arrow-left">Regresar</i>
          </a>
        </td>
      </tr>
      <tr class="row encabezado">
        <td class="col-md-12 ">Cuenta de Gastos</td>
      </tr>
      <tr class="row backpink font16">
        <td class="col-md-1"></td>
        <td class="col-md-2">CTA AMERICANA</td>
        <td class="col-md-2">CANCELACIÓN</td>
        <td class="col-md-2">REFERENCIA</td>
        <td class="col-md-4">CLIENTE</td>
        <td class="col-md-1"></td>
      </tr>
      <tr class="row">
        <td class="col-md-1">
          <a href="/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/Editarcta.php">
            <img class="icomediano" src="/conta6/Resources/iconos/003-edit.svg">
          </a>
        </td>
        <td class="col-md-2">280380</td>
        <td class="col-md-2">222222</td>
        <td class="col-md-2">N17003012</td>
        <td class="col-md-4">CLT_6548 MOTORES ELECTRICOS SUMERGIBLES DE MEXICO, S. DE R.L DE C.V</td>
        <td class="col-md-1">
          <a href="/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/Consultarcta.php">
            <img class="icomediano" src="/conta6/Resources/iconos/magnifier.svg">
          </a>
          <a><img class="icomediano ml-5" src="/conta6/Resources/iconos/printer.svg"></a>
        </td>
      </tr>
    </table>
  </div>



  <div class="mt-5" id="gctaGastos" style="display:none;margin-bottom:100px">
    <div class="col-md-1 offset-sm-8 p-0">
      <a href="#" class="atras" accion="cuadroGenerar">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <div class="row justify-content-center m-0" id="gctaGastosRef">
      <div class="col-md-6 transEff titulograndetop">
        <label class="transEff" for="gRef" id="labelgRef">Generar Solicitud</label>
      </div>
    </div>
    <div class="row justify-content-center m-0">
      <div class="col-md-6 backpink font18">
        <label class="transEff">REFERENCIA</label>
      </div>
    </div>

    <div class="row justify-content-center m-0 mb-5">
      <div class="col-md-6 transEff intermedio">
        <form class="form-group btn_buscarDatos">
          <input class="reg border-0 transEff popup-input" maxlength="9" id="btn_ctaAme" type="text" id-display="#popup-display-ctaAme" action="referencias" db-id="" autocomplete="off">
          <div class="popup-list" id="popup-display-ctaAme" style="display:none"></div>
        </form>
      </div>
    </div>
    <div class="contorno" id="">
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

            <!-- <tr class="row borderojo pb-4 pt-3"> -->

            <!-- </tr> -->

            <tr class='row mt-4 align-items-center'>
              <!-- <td class='p-0 col-md-2 text-right b'><b>Días en almacen:</b></td>
              <td class='p-0 col-md-1'>
                <input type='text' id='' class='efecto h18' autocomplete='off'>
              </td> -->

              <td class='p-0 col-md-1 offset-md-1 text-right b'><b>Shipper:</b></td>
              <td class='p-0 col-md-1'>
                <input class='text-left bt inputId p-0' type='text' id='' readonly>
              </td>

              <td class='p-0 col-md-2 offset-md-1 text-right b'><b>InBond:</b></td>
              <td class='p-0 col-md-1'><input class='text-left bt inputId p-0' type='text' id='' value="NO" readonly></td>

              <td class='p-0 col-md-2 offset-md-1 text-right b'><b>Trailer de Salida:</b></td>
              <td class='p-0 col-md-1 text-left'>249DS1</td>


            </tr>

            <tr class='row mt-2 align-items-center'>
              <td class='p-0 col-md-2 text-right b'><b>Consolidado:</b></td>
              <td class='p-0 col-md-1'>
                <input class='text-left bt inputId p-0' type='text' id='' value="LTL" readonly>
              </td>

              <td class='p-0 col-md-2 offset-md-1 text-right b'><b>Entradas:</b></td>
              <td class='p-0 col-md-1'><input class='text-left bt inputId p-0' type='text' id='' value="1" readonly></td>

              <td class='p-0 col-md-3 text-right b'><b>Flete:</b></td>
              <td class='p-0 col-md-1'><input class='text-left bt inputId p-0' type='text' id='' readonly></td>
           </tr>

           <tr class='row pt-2 align-items-center'>
             <td class='p-0 col-md-2 text-right b'><b>Núm. de Facturas:</b></td>
             <td class='p-0 col-md-2 text-left'>41790933,41790960</td>

             <td class='p-0 col-md-2 text-right b'><b>Cobrar:</b></td>
             <td class='p-0 col-md-1 text-left'></td>

             <td class='p-0 col-md-2 offset-md-1 text-right b'><b>Reexpedición:</b></td>
             <td class='p-0 col-md-1 text-left'></td>


           </tr>

           <!-- <tr class='row pt-2 align-items-center'>
             <td class='p-0 col-md-2 text-right b'><b>Consolidado:</b></td>
             <td class='p-0 col-md-1'>
               <input class='text-left bt inputId p-0' type='text' id='' value="LTL" readonly>
             </td>
           </tr> -->

           <tr class='row mt-5 align-items-center'>
             <td class='p-0 col-md-2 text-right b'><b>Estatus:</b></td>
             <td class='p-0 col-md-4 text-left'><span>Ya existe cuenta de gastos con esta referencia</span></td>
           </tr>
           <tr class='row mt-2 align-items-center'>
             <td class='p-0 col-md-2 text-right b'><b>Facturar a:</b></td>
             <td class='p-0 col-md-4 text-left'>
              <select class="custom-select-s">
                <option value="">Cliente / Corresponsal</option>
              </select>
             </td>
           </tr>

           <tr class='row mt-2 align-items-center'>
             <td class='p-0 col-md-2 text-right b'><b>Facturar a otro:</b></td>
             <td class='p-0 col-md-4 text-left'>
              <select class="custom-select-s">
                <option value="">Seleccion un Cliente Americano</option>
              </select>
             </td>
           </tr>

           <tr class='row mt-2 align-items-center'>
             <td class='p-0 col-md-2 text-right b'><b>Extraer:</b></td>
             <td class='p-0 col-md-4 text-left'>
              <select class="custom-select-s">
                <option value="">Factura Electronica</option>
              </select>
             </td>
           </tr>

           <tr class='row mt-2 align-items-center'>
             <td class='p-0 col-md-2 text-right b'><b>Extraer:</b></td>
             <td class='p-0 col-md-4 text-left'>
              <select class="custom-select-s">
                <option value="">Solicitud de Anticipo</option>
              </select>
             </td>
           </tr>
           <tr class='row justify-content-center mt-5'>
             <td class="col-md-1">
                <a href='#' id=' onclick=' class='boton'> Siguiente</a>
              </td>
           </tr>
          </table>
        </form>
      </div>
  </div>




  </div>
<div>


<script src="js/CuentaGastos.js"></script>
<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
