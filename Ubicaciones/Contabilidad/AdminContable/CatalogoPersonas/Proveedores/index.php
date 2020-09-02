
<?php require $root . "/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/Proveedores/modales/nuevoProveedor.php"; ?>

<div class="tab-pane fade" id="proveedores" role="tabpanel" aria-labelledby="proveedores-tab">
  <?php if( $oRst_permisos["s_catalogoPersonasPROV_g"] == 1 ){ ?>
    <div class="text-center">
      <div class="row m-0 justify-content-center mt-5 font14">
        <div class="col-md-3">
          <!-- <a href="#NuevoProveedor" data-toggle="modal" class="b"><img src="/Resources/iconos/001-add.svg" class="icochico"> AGREGAR NUEVO</a> -->
          <a href="#NuevoProveedor" data-toggle="modal" type="button" class="btn bg_gris_100 whitesmoke">[+] Agregar Nuevo</a>
        </div>
      </div>
    <?php } ?>

    <table class="table mt-4 font14">
      <tr class="row m-0 align-items-center">
        <td class="col-md-6 offset-md-3 input-effect">
          <input class="efecto popup-input" id="cat-prov" type="text" id-display="#popup-display-cat-prov" action="proveedores" db-id="" autocomplete="off">
          <div class="popup-list" id="popup-display-cat-prov" style="display:none"></div>
          <label for="cat-prov">Proveedores</label>
        </td>
        <td class="col-md-1 text-left">
          <a href="#" id="btn_printProv"><img src="/Resources/iconos/printer.svg" class="icomediano"></a>
        </td>
      </tr>
    </table>
    <div id="datosGeneralesProv"></div>

    <div class='contorno my-5 font14'>
      <div class='titulo' style="margin-top: -24px;">CUENTAS BANCARIAS</div>
      <table class='table'>
        <tbody>
          <tr class='row mt-4'>
            <td class='col-md-2 input-effect'>
              <input class='efecto tiene-contenido popup-input' id='bcoSATprov' type='text' id-display='#popup-display-bcoSATprov' action='bancosSAT' db-id='' autocomplete='off'>
              <div class='popup-list' id='popup-display-bcoSATprov' style='display:none'></div>
              <label for='bcoSATprov'>BANCOS
                <a href='#catalogoBancosSAT' data-toggle='modal'><img src='/Resources/iconos/help.svg' class="icochico"></a>
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
                <a href='#catalogoBancosEXT' data-toggle='modal'><img src='/Resources/iconos/help.svg' class="icochico"></a>
              </label>
            </td>
            <td class='col-md-3 input-effect'>
              <input id='nomBco' class='efecto tiene-contenido' type='text' onchange='eliminaBlancosIntermedios(this);' autocomplete='off' disabled>
              <label for='nomBco'>NOMBRE BANCO</label>
            </td>
            <td class='col-md-1'>
              <?php if( $oRst_permisos['s_catalogoPersonasPROV_m'] == 1 ){ ?>
                <!-- <a href='#' id="btn_agrCtaBcoProv" class='ver boton' accion='mostrarcta'> <img src= '/Resources/iconos/add.svg' class='icochico'> AGREGAR</a> -->

                <a href="#" id="btn_agrCtaBcoProv"><img class="icomediano" src="/Resources/iconos/002-plus.svg"></a>
              <?php } ?>

            </td>
          </tr>
        </tbody>
      </table>
      <div id='MostrarCuenta'>
        <table class='table font14'>
          <tr  class='row sub2 mt-4'>
            <td class='p-1 col-md-1'></td>
            <td class='p-1 col-md-2'>BANCO</td>
            <td class='p-1 col-md-2'>NOMBRE BANCO</td>
            <td class='p-1 col-md-3'>CUENTA</td>
            <td class='p-1 col-md-4'>AGREGÓ</td>
          </tr>
          <tr colspan="2" id="datosCtasProv"></tr>
        </table>
      </div>
    </div>
  </div>
</div>
