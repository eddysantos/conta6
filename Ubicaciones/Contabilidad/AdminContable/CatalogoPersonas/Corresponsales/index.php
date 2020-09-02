
<?php require $root . "/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/Corresponsales/modales/ModalCorresponsales.php"; ?>

<div class="tab-pane fade" id="corresp" role="tabpanel" aria-labelledby="corresp-tab">
  <div class="text-center mb-10 font14">
    <!-- <div class="row m-0 justify-content-center mt-5 font14">
      <div class="col-md-3">

      </div>
    </div> -->
    <div class="mt-5">
      <table class="table">
        <tbody>
          <tr class="row m-0 align-items-center justify-content-center mt-4">
            <td class="col-md-6 input-effect">
              <input class="efecto popup-input" id="corp-cliente" type="text" id-display="#popup-display-corp-cliente" action="clientes_NoEsCorresponsal" db-id="" autocomplete="off">
              <div class="popup-list" id="popup-display-corp-cliente" style="display:none"></div>
              <label for="corp-cliente">Cliente</label>
            </td>
            <td class="col-md-1 text-left">
              <a href="#" id="genCorresponsal" type="button" class="btn bg_gris_100 whitesmoke py-1">[+]</a>
            </td>
            <?php // TODO: <!-- boton de imprimir corresponsales -->  ?>
            <!-- <td class='col-md-1'>
              <a href='#'><img class="icomediano ml-2" src="/Resources/iconos/printer.svg"></a>
            </td> -->
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
