<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';

  // require_once('modales/nuevoBeneficiario.php');
  //
  // require $root . '/Ubicaciones/Contabilidad/AdminContable/modales/ModalCorresponsales.php';
  require $root . '/Ubicaciones/Contabilidad/modales/catalogoBancosSAT.php';
  require $root . '/Ubicaciones/Contabilidad/modales/catalogoBancosExt.php';
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

  <?php
    $rutaModulo = "/Ubicaciones/Contabilidad/AdminContable/";
    require $root . $rutaModulo ."CatalogoPersonas/Proveedores/index.php";
    require $root . $rutaModulo ."CatalogoPersonas/Corresponsales/index.php";
    require $root . $rutaModulo ."CatalogoPersonas/Beneficiarios/index.php";
  ?>




</div>


<script src="/Ubicaciones/Contabilidad/AdminContable/js/catalogoPersonas.js" charset="utf-8"></script>
<script src="/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/Proveedores/js/catalogoProveedores.js" charset="utf-8"></script>
<script src="/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/Corresponsales/js/catalogoCorresponsales.js" charset="utf-8"></script>
<script src="/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/Beneficiarios/js/catalogoBeneficiarios.js" charset="utf-8"></script>
<?php
  require $root . '/Ubicaciones/footer.php';
?>
