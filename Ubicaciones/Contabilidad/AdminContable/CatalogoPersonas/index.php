<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';


  // require_once('modales/nuevoProveedor.php');
  // require_once('modales/nuevoBeneficiario.php');
  //
  // require $root . '/Ubicaciones/Contabilidad/AdminContable/modales/ModalCorresponsales.php';
  // require $root . '/Ubicaciones/Contabilidad/modales/catalogoBancosSAT.php';
  // require $root . '/Ubicaciones/Contabilidad/modales/catalogoBancosExt.php';
?>


<ul class="nav backpink nav-justified" id="myTab" role="tablist">
  <?PHP if($oRst_permisos['s_catalogoPersonas_CLIENTES'] == 1){ ?>
  <li class="nav-item">
    <a class="nav-link" id="clientes-tab" data-toggle="tab" href="#clientes" role="tab" aria-controls="clientes" aria-selected="true">CLIENTES</a>
  </li>
  <?PHP } ?>
  <?PHP if($oRst_permisos['s_catalogoPersonas_PROVEEDORES'] == 1){ ?>
  <li class="nav-item">
    <a class="nav-link" id="proveedores-tab" data-toggle="tab" href="#proveedores" role="tab" aria-controls="proveedores" aria-selected="false">PROVEEDORES</a>
  </li>
  <?PHP } ?>
  <?PHP if($oRst_permisos['s_catalogoPersonas_CORRESPONSALES'] == 1){ ?>
  <li class="nav-item">
    <a class="nav-link" id="corresp-tab" data-toggle="tab" href="#corresp" role="tab" aria-controls="corresp" aria-selected="false">CORRESPONSALES</a>
  </li>
  <?PHP } ?>
  <?PHP if($oRst_permisos['s_catalogoPersonas_BENEFICIARIOS'] == 1){ ?>
  <li class="nav-item">
    <a class="nav-link" id="benef-tab" data-toggle="tab" href="#benef" role="tab" aria-controls="benef" aria-selected="false">BENEFICIARIOS</a>
  </li>
  <?PHP } ?>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show" id="clientes" role="tabpanel" aria-labelledby="clientes-tab">
    <div class="contenedor text-center" id="buscarClt" style="<?php echo $marginbottom ?>">
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
        </div>
      </div>

      <div class="row justify-content-center mt-5 m-0">
        <div class="col-md-3">
          <a href="#" id="btn-buscarClientePersonas" class="boton"> <i class="fa fa-search "></i> Consultar</a>
        </div>
      </div>
    </div>
  </div>

  <?php require $root . "/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/Proveedores/index.php"; ?>

  <div class="tab-pane fade" id="corresp" role="tabpanel" aria-labelledby="corresp-tab">
    <div class="text-center mb-10 font14">
      <div class="mt-5">
        <table class="table form1">
          <tbody>
            <tr class="row justify-content-center font14 m-0">
              <td class="col-md-3 p-0">
                <a href="#" id="genCorresponsal" class="b"><img src="/Resources/iconos/001-add.svg" class="icochico"> AGREGAR NUEVO</a>
              </td>
            </tr>
            <tr class="row m-0 align-items-center justify-content-center mt-4">
              <td class="col-md-7 input-effect">
                <input class="efecto popup-input" id="corp-cliente" type="text" id-display="#popup-display-corp-cliente" action="clientes_NoEsCorresponsal" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-corp-cliente" style="display:none"></div>
                <label for="corp-cliente">Cliente</label>
              </td>
              <!-- Aun pendiente -->
              <td class="col-md-1 text-left">
                <a href='#'><img class="icomediano ml-2" src="/Resources/iconos/printer.svg"></a>
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

  <div class="tab-pane fade" id="benef" role="tabpanel" aria-labelledby="benef-tab">
    <?php if( $oRst_permisos["s_benefGenerar_cheques"] == 1 ){ ?>
      <div class="text-center">
        <div class="row m-0 justify-content-center mt-5 font14">
          <div class="col-md-3">
            <a href="#NuevoBeneficiario" data-toggle="modal" class="b"><img src="/Resources/iconos/001-add.svg" class="icochico"> AGREGAR NUEVO</a>
          </div>
        </div>
      <?php } ?>
      <table class="table form1 mt-3 font14">
        <tr class="row m-0 mt-3 align-items-center">
          <td class="col-md-6 offset-md-3 input-effect">
            <input class="efecto popup-input" id="cat-benef" type="text" id-display="#popup-display-benef" action="beneficiarios" db-id="" autocomplete="off">
            <div class="popup-list" id="popup-display-benef" style="display:none"></div>
            <label for="cat-benef">Beneficiario</label>
          </td>
          <td class="col-md-1 text-left">
            <a href="#" id="btn_printBenef"><img src="/Resources/iconos/printer.svg" class="icomediano"></a>
          </td>
        </tr>
      </table>
      <div id="datosGeneralesBen"></div>

      <div class='contorno mt-5 font14' style="<?php echo $marginbottom ?>">
        <div class='titulo' style="margin-top: -24px;">CUENTAS BANCARIAS</div>
        <table class='table form1'>
          <tbody>
            <tr class='row mt-4'>
              <td class='col-md-2 input-effect'>
                <input class='efecto tiene-contenido popup-input' id='bcoSATben' type='text' id-display='#popup-display-bcoSAT' action='bancosSAT' db-id='' autocomplete='off'>
                <div class='popup-list' id='popup-display-bcoSAT' style='display:none'></div>
                <label for='bcoSATben'>BANCOS
                  <a href='#catalogoBancosSAT' data-toggle='modal' style='margin-top:-4px'><img src='/Resources/iconos/help.svg' style='margin-top:-4px'></a>
                </label>
              </td>
              <td class='col-md-3 input-effect'>
                <input class='efecto tiene-contenido popup-input' id='nomBcoExtjben' type='text' id-display='#popup-display-nomBcoExtjBen' action='bancosExtranjeros' db-id='' autocomplete='off' disabled>
                <div class='popup-list' id='popup-display-nomBcoExtjBen' style='display:none'></div>
                <label for='nomBcoExtj'>BANCOS EXTRANJEROS
                  <a href='#catalogoBancosEXT' data-toggle='modal' style='margin-top:-4px'><img src='/Resources/iconos/help.svg' style='margin-top:-4px'></a>
                </label>
              </td>
              <td class='col-md-3 input-effect'>
              <!-- Cuando sea seleccionado banco "999" es necesario saber el nombre del banco para establecerlo en la contabilidad electronica -->
              <!-- puede ser el caso que sea un banco mexicano que no es ta lista oficial del SAT o bien un banco extranjero -->
                <input id='nomBcoben' class='efecto tiene-contenido' type='text' onchange='eliminaBlancosIntermedios(this);' autocomplete='off' disabled>
                <label for='nomBco'>NOMBRE BANCO</label>
              </td>
              <td class='col-md-3 input-effect'>
                <input id='cinterben' class='efecto tiene-contenido' type='text' onchange='validarCtaBancaria(this);'>
                <label for='cinter'>CUENTA / INTERBANCARIA</label>
              </td>
              <td class='col-md-1 input-effect'>
              <?php if( $oRst_permisos['s_benefModificar_cheques'] == 1 ){ ?>
                <a href="#" id="btn_agrCtaBcoBen"><img class="icomediano" src="/Resources/iconos/002-plus.svg"></a>
              <?php } ?>
              </td>
            </tr>
          </tbody>
        </table>


        <table class='table font14'>
          <thead>
            <tr class='row sub2 mt-4'>
              <td class='p-1 col-md-1'></td>
              <td class='p-1 col-md-1'>BANCO</td>
              <td class='p-1 col-md-4'>NOMBRE BANCO EXTRANJERO</td>
              <td class='p-1 col-md-3'>CUENTA</td>
              <td class='p-1 col-md-3'>AGREGÓ</td>
            </tr>
          </thead>
          <tbody id="lista_datosCtasBen"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<script src="/Ubicaciones/Contabilidad/AdminContable/js/catalogoPersonas.js" charset="utf-8"></script>
<script src="/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/Proveedores/js/catalogoProveedores.js" charset="utf-8"></script>
<?php
  require $root . '/Ubicaciones/footer.php';
?>
