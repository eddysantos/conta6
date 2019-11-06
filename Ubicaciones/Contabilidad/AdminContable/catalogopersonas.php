<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="text-center">
<!-- -AL INGRESAR SOLO SE MOSTRARA ESTA SECCION-->
  <!-- <?PHP if($oRst_permisos['s_catalogoPersonas_CLIENTES'] == 1){ ?>
  <div class="row submenuMed m-0 font14" id="SeleccionarAccion">
    <div class="col-md-3">
      <a  href="#" class="personas" accion="clientes"><i class="fa fa-search" aria-hidden="true"></i>Clientes</a>
    </div><?PHP } ?>

    <?PHP if($oRst_permisos['s_catalogoPersonas_PROVEEDORES'] == 1){ ?>
    <div class="col-md-3">
      <a href="#" class="personas" accion="proveedores"><i class="fa fa-search" aria-hidden="true"></i>Proveedores</a>
    </div><?PHP } ?>

    <?PHP if($oRst_permisos['s_catalogoPersonas_CORRESPONSALES'] == 1){ ?>
    <div class="col-md-3">
      <a href="#" class="personas" accion="corresponsales"><i class="fa fa-search" aria-hidden="true"></i>Corresponsales</a>
    </div><?PHP } ?>

    <?PHP if($oRst_permisos['s_catalogoPersonas_BENEFICIARIOS'] == 1){ ?>
    <div class="col-md-3">
      <a href="#" class="personas" accion="Beneficiarios"><i class="fa fa-search" aria-hidden="true"></i>Beneficiarios</a>
    </div><?PHP } ?>
  </div> -->



  <ul class="nav row backpink p-3 m-0 font14 list-style-none align-items-center" id="myTab" role="tablist">
    <?PHP if($oRst_permisos['s_catalogoPersonas_CLIENTES'] == 1){ ?>
    <li class="nav-item pills col">
      <a class="nav-link" id="uno-tab" data-toggle="tab" href="#uno" role="tab" aria-controls="uno" aria-selected="true">
        CLIENTES
      </a>
    </li>
    <?PHP } ?>
    <?PHP if($oRst_permisos['s_catalogoPersonas_PROVEEDORES'] == 1){ ?>
    <li class="nav-item pills col">
      <a class="nav-link" id="dos-tab" data-toggle="tab" href="#dos" role="tab" aria-controls="dos" aria-selected="false">
        PROVEEDORES
      </a>
    </li>
    <?PHP } ?>
    <?PHP if($oRst_permisos['s_catalogoPersonas_CORRESPONSALES'] == 1){ ?>
    <li class="nav-item pills col">
      <a class="nav-link" id="tres-tab" data-toggle="tab" href="#tres" role="tab" aria-controls="tres" aria-selected="false">
        CORRESPONSALES
      </a>
    </li>
    <?PHP } ?>
    <?PHP if($oRst_permisos['s_catalogoPersonas_BENEFICIARIOS'] == 1){ ?>
    <li class="nav-item pills col">
      <a class="nav-link" id="cuatro-tab" data-toggle="tab" href="#cuatro" role="tab" aria-controls="cuatro" aria-selected="false">
        BENEFICIARIOS
      </a>
    </li>
    <?PHP } ?>
  </ul>


<!---se muestra al dar click en Clientes-->
  <!-- <div class="contenedor" id="buscarClt" style="display:none;<?php echo $marginbottom ?>">
    <div class="row m-0">
      <div class="col-md-1 offset-sm-8 p-0">
        <a href="#" class="atras" accion="cuadroBusqueda">
          <i class="back fa fa-arrow-left">Regresar</i>
        </a>
      </div>
    </div>
    <div class="row justify-content-center" id="referencia">
      <div class="col-md-6 transEff titulograndetop">Cliente</div>
    </div>
    <div class="row justify-content-center" id="nReferencia">
      <div class="col-md-8 intermedio">
        <form class="form-group" onsubmit="return false;">
          <input class="efecto popup-input" id="bClt-persona" type="text" id-display="#popup-display-bClt-persona" action="clientes" db-id="" autocomplete="off">
          <div class="popup-list" id="popup-display-bClt-persona" style="display:none"></div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#" id="btn-buscarClientePersonas">Consultar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
    </div>
  </div> -->



  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="uno" role="tabpanel" aria-labelledby="uno-tab">
      <div class="contenedor" id="buscarClt" style="<?php echo $marginbottom ?>">
        <div class="row justify-content-center m-0" id="referencia">
          <div class="col-md-6 titulograndetop transEff">
            <label class="transEff" for="bRef" id="labelRef">Cliente</label>
          </div>
        </div>

        <div class="row justify-content-center m-0" id="nReferencia">
          <div class="col-md-6 intermedio transEff">

            <form  class="form-group" onsubmit="return false;">
              <input class="reg border-0 transEff w-100 popup-input" id="bClt-persona" type="text" id-display="#popup-display-bClt-persona" action="clientes" db-id="" autocomplete="off">
              <div class="popup-list" id="popup-display-bClt-persona" style="display:none"></div>
            </form>

            <!-- <form class="form-group" onsubmit="return false;">
              <input class="efecto popup-input" id="bClt-persona" type="text" id-display="#popup-display-bClt-persona" action="clientes" db-id="" autocomplete="off">
              <div class="popup-list" id="popup-display-bClt-persona" style="display:none"></div>
            </form> -->
          </div>
        </div>

        <div class="row justify-content-center mt-5 m-0">
          <div class="col-md-3">
            <a href="#" id="btn-buscarClientePersonas" class="boton"> <i class="fa fa-search "></i> Consultar</a>
          </div>
        </div>
      </div>
    </div>


    <div class="tab-pane fade text-center" id="dos" role="tabpanel" aria-labelledby="dos-tab">
      <?php if( $oRst_permisos["s_catalogoPersonasPROV_g"] == 1 ){ ?>
        <div class="text-center">
          <div class="row m-0 justify-content-center mt-5 font14">
            <div class="col-md-3">
              <a href="#NuevoProveedor" data-toggle="modal" class="b"><img src="/conta6/Resources/iconos/001-add.svg" class="icochico"> AGREGAR NUEVO</a>
            </div>
          </div>
        <?php } ?>

        <table class="table form1 mt-5 font14">
          <tr class="row m-0">
            <td class="col-md-6 offset-md-3 input-effect">
              <input class="efecto popup-input" id="cat-prov" type="text" id-display="#popup-display-cat-prov" action="proveedores" db-id="" autocomplete="off">
              <div class="popup-list" id="popup-display-cat-prov" style="display:none"></div>
              <label for="cat-prov">Proveedores</label>
            </td>
            <td class="col-md-1 text-left">
              <a href="#" id="btn_printProv"><img src="/conta6/Resources/iconos/printer.svg" class="icomediano"></a>
            </td>
          </tr>
        </table>
        <div id="datosGeneralesProv"></div>

        <div class='contorno mt-5 font14' style="<?php echo $marginbottom ?>">
          <h5 class='titulo'>CUENTAS BANCARIAS</h5>
          <table class='table form1'>
            <tbody>
              <tr class='row mt-4'>
                <td class='col-md-2 input-effect'>
                  <input class='efecto tiene-contenido popup-input' id='bcoSATprov' type='text' id-display='#popup-display-bcoSATprov' action='bancosSAT' db-id='' autocomplete='off'>
                  <div class='popup-list' id='popup-display-bcoSATprov' style='display:none'></div>
                  <label for='bcoSATprov'>BANCOS
                    <a href='#catalogoBancosSAT' data-toggle='modal'><img src='/conta6/Resources/iconos/help.svg' class="icochico"></a>
                  </label>
                </td>

                <td class='col-md-3 input-effect'>
                  <input id='cinter' class='efecto tiene-contenido' type='text' onchange='validarCtaBancaria(this);'>
                  <label for='cinter'>CUENTA / INTERBANCARIA</label>
                </td>
                <td class='col-md-3 input-effect'>
                  <input class='efecto tiene-contenido popup-input' id='nomBcoExtj' type='text' id-display='#popup-display-nomBcoExtj' action='bancosExtranjeros' db-id='' autocomplete='off' disabled>
                  <div class='popup-list' id='popup-display-nomBcoExtj' style='display:none'></div>
                  <label for='nomBcoExtj'>BANCOS EXTRANJEROS
                    <a href='#catalogoBancosEXT' data-toggle='modal'><img src='/conta6/Resources/iconos/help.svg' class="icochico"></a>
                  </label>
                </td>
                <td class='col-md-3 input-effect'>
                  <input id='nomBco' class='efecto tiene-contenido' type='text' onchange='eliminaBlancosIntermedios(this);' autocomplete='off' disabled>
                  <label for='nomBco'>NOMBRE BANCO</label>
                </td>
                <td class='col-md-1'>
                  <?php if( $oRst_permisos['s_catalogoPersonasPROV_m'] == 1 ){ ?>
                    <!-- <a href='#' id="btn_agrCtaBcoProv" class='ver boton' accion='mostrarcta'> <img src= '/conta6/Resources/iconos/add.svg' class='icochico'> AGREGAR</a> -->

                    <a href="#" id="btn_agrCtaBcoProv"><img class="icomediano" src="/conta6/Resources/iconos/002-plus.svg"></a>
                  <?php } ?>

                </td>
              </tr>
            </tbody>
          </table>
          <div id='MostrarCuenta'>
            <table class='table font14'>
              <tr  class='row backpink mt-4'>
                <td class='col-md-1'></td>
                <td class='col-md-2'>BANCO</td>
                <td class='col-md-2'>NOMBRE BANCO</td>
                <td class='col-md-3'>CUENTA</td>
                <td class='col-md-4'>AGREGÓ</td>
              </tr>
              <tr colspan="2" id="datosCtasProv"></tr>
            </table>
          </div>
        </div>
      </div>
    </div>



    <div class="tab-pane fade" id="tres" role="tabpanel" aria-labelledby="tres-tab">
      <div class="text-center mb-10 font14">
        <div class="mt-5">
          <table class="table form1">
            <tbody>
              <tr class="row justify-content-center font14 m-0">
                <td class="col-md-3">
                  <a href="#" id="genCorresponsal" class="b"><img src= "/conta6/Resources/iconos/add.svg" class="icochico"> AGREGAR NUEVO</a>
                </td>
              </tr>
              <tr class="row m-0 align-items-center justify-content-center mt-5">
                <td class="col-md-7 input-effect">
                  <input class="efecto popup-input" id="corp-cliente" type="text" id-display="#popup-display-corp-cliente" action="clientes_NoEsCorresponsal" db-id="" autocomplete="off">
                  <div class="popup-list" id="popup-display-corp-cliente" style="display:none"></div>
                  <label for="corp-cliente">Cliente</label>
                </td>
                <!-- Aun pendiente -->
                <td class="col-md-1 text-left">
                  <a href='#'><img class="icomediano ml-2" src="/conta6/Resources/iconos/printer.svg"></a>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="contorno mt-5">
            <table class="table table-hover fixed-table">
              <thead>
                <tr class="row m-0 encabezado">
                  <td class="col-md-1"></td>
                  <td class="col-md-2">CORRESPONSAL</td>
                  <td class="col-md-2">CLIENTE</td>
                  <td class="col-md-7">NOMBRE</td>
                </tr>
              </thead>
              <tbody  id="tablaCorresponsales"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>




  </div> <!-- fin del navegador -->
</div> <!-- fin del text center -->








<footer class="footer mt-3">
  <table class="table">
    <tr class="row font14">
      <td class="col-md-3 offset-md-1">Bienvenido, <b><?php echo $usuario;?></b></td>
      <td class="col-md-6"></td>
      <td class="col-md-2">Oficina Activa: <b><?php echo $aduana;?></b> </td>
    </tr>
  </table>

  <script src="/Conta6/Ubicaciones/Contabilidad/js/helperContabilidad.js"></script>
  <script src="/Conta6/Ubicaciones/Contabilidad/AdminContable/js/catalogoPersonas.js"></script>
  <script src="/Conta6/Resources/js/validarFormulario.js"></script>
  <script src="/Conta6/Resources/js/calculadora.js"></script>

  <script src="/Conta6/Ubicaciones/Contabilidad/js/contenedor-movible.js"></script>
  <script src="/Conta6/Resources/js/popup-list-plugin.js"></script>
  <script src="/Conta6/Resources/js/table-fetch-plugin.js"></script>
  <script src="/Conta6/Resources/js/Inputs.js"></script>


</footer>
<?php
// require $root . '/conta6/Ubicaciones/footer.php';

require_once('modales/nuevoProveedor.php');

require $root . '/Conta6/Ubicaciones/Contabilidad/AdminContable/modales/ModalCorresponsales.php';
require $root . '/Conta6/Ubicaciones/Contabilidad/modales/catalogoBancosSAT.php';
require $root . '/Conta6/Ubicaciones/Contabilidad/modales/catalogoBancosExt.php';

?>
