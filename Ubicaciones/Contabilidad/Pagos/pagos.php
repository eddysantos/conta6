<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';
?>


<div class="text-center">
  <div class="mt10" style="<?php echo $marginbottom ?>">
    <div class="row justify-content-center m-0">
      <div class="col-md-6 transEff titulograndetop">Buscar</div>
    </div>
    <div class="row justify-content-center m-0">
      <div class="col-md-6 transEff intermedio">
        <form  class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="bRef" type="text" autocomplete="off">
        </form>
      </div>
    </div>

    <div class="row justify-content-center mt-5 m-0">
        <?php if( $oRst_permisos["s_rPgo_generar"] == 1){ ?>
        <div class="col-md-2">
          <a href="#" id="b-facturasPagos" class="boton mostrarbusqueda"><img src="/Resources/iconos/magnifier.svg" class="icochico"> FACTURAS</a>
        </div>
        <?php } ?>

        <?php if( $oRst_permisos["s_rPgo"] == 1){ ?>
        <div class="col-md-2">
          <a href="#" id="b-pagos" class="boton mostrarbusqueda"><img src="/Resources/iconos/magnifier.svg" class="icochico"> PAGOS</a>
        </div>
        <?php } ?>

        <?php if( $oRst_permisos["s_rPElect"] == 1){ ?>
        <div class="col-md-2">
          <a href="#" id="b-pagosElect" class="boton mostrarbusqueda"><img src="/Resources/iconos/magnifier.svg" class="icochico"> PAGOS ELECTRONICOS</a>
        </div>
        <?php } ?>
    </div>

  </div>
</div>




<?php require $root . '/Ubicaciones/footer.php'; ?>
