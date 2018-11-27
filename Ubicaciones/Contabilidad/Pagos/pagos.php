<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="text-center">
  <div class="mt10">
    <div class="row justify-content-center">
      <div class="col-md-6 transEff titulograndetop">Buscar</div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6 transEff intermedio">
        <form  class="form-group" onsubmit="return false;">
          <input class="reg border-0 transEff" id="bRef" type="text" autocomplete="off">
        </form>
      </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-2">
          <a href="pagos_buscar.php" id="b-facturasPagos" class="boton mostrarbusqueda"><img src="/conta6/Resources/iconos/magnifier.svg" class="icochico"> FACTURAS</a>
        </div>
        <div class="col-md-2">
          <a href="#" id="b-pagos" class="boton mostrarbusqueda"><img src="/conta6/Resources/iconos/magnifier.svg" class="icochico"> PAGOS</a>
        </div>
        <div class="col-md-2">
          <a href="#" id="b-pagosElect" class="boton mostrarbusqueda"><img src="/conta6/Resources/iconos/magnifier.svg" class="icochico"> PAGOS ELECTRONICOS</a>
        </div>
    </div>
  </div>
</div>




<?php require $root . '/conta6/Ubicaciones/footer.php'; ?>
