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
  <div id="buscarRef" class="contenedor" style="display:none;<?php echo $marginbottom ?>">
    <div class="row m-0">
      <div class="col-md-1 offset-sm-8 font14">
        <a href="#" class="atras" accion="cuadroBusqueda">
          <i class="back fa fa-arrow-left">Regresar</i>
        </a>
      </div>
    </div>
    <div class="row justify-content-center m-0" id="referencia">
      <div class="col-md-6 titulograndetop transEff">
        <label class="transEff" for="bRef" id="labelRef">Referencia o Solicitud</label>
      </div>
    </div>
    <div class="row justify-content-center m-0" id="nReferencia">
      <div class="col-md-6 intermedio transEff" id="mostrarConsulta_ame">
        <form  class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="bRef" type="text" autocomplete="off">
        </form>
      </div>
    </div>
  </div>

<!---se muestra al escribir la referencia y dar enter-->
  <div class="mt-5 contenedor contorno" id="repoSol" style="display:none;margin-bottom: 8rem!important;">
    <div class="col-md-1 offset-sm-11 font14">
      <a href="#" class="fele" accion="cuadroConsultar">
        <i class="back fa fa-arrow-left">Regresar</i>
      </a>
    </div>
    <table class="table font16">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-12">Cuentas de Gastos</td>
        </tr>
        <tr class="row backpink" style="font-size:16px!important">
          <td class="col-md-1"></td>
          <td class="col-md-1">Cta. Ame</td>
          <td class="col-md-1">Estatus</td>
          <td class="col-md-1">Referencia</td>
          <td class="col-md-7">Cliente</td>
          <td class="col-md-1"></td>
        </tr>
      </thead>
      <tbody id="lst_cuentasGastos_ame"></tbody>
    </table>
  </div>


  <div class="contenedor" id="gctaGastos" style="display:none;margin-bottom:100px">
    <div class="col-md-1 offset-sm-8 p-0 font14">
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
    <!-- <div class="row justify-content-center m-0 mb-5">
      <div class="col-md-6 transEff intermedio">
        <form class="form-group btn_buscarDatos">

          <input class="efecto tiene-contenido popup-input" maxlength="9" id="btn_ctaAme" type="text" id-display="#popup-display-btn_ctaAme" action="referencias" db-id="" autocomplete="off">
          <div class="popup-list" id="popup-display-btn_ctaAme" style="display:none"></div>


        </form>
      </div>
    </div> -->

    <div class="row justify-content-center m-0">
      <div class="col-md-6 intermedio transEff">
        <form  class="form-group btn_buscarDatos" onsubmit="return false;">
          <input class="reg border-0 transEff popup-input" maxlength="9" id="btn_ctaAme" type="text" id-display="#popup-display-btn_ctaAme" action="referencias" db-id="" autocomplete="off">
          <div class="popup-list" id="popup-display-btn_ctaAme" style="display:none"></div>

        </form>
      </div>
    </div>


    <div class="row justify-content-center mt-5 m-0">
      <div class="col-md-3">
        <a href="#" id="btn_buscarDatosEmbarque_ctaAme" class="boton"> <i class="fa fa-search "></i> Consultar</a>
      </div>
    </div>
  </div>
  <div class="contorno" id="datosEmbarque" style="<?php echo $marginbottom ?>;display:none"></div>
</div>

<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
