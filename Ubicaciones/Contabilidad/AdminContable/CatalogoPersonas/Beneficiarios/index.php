<?php require $root . "/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/Beneficiarios/modales/nuevoBeneficiario.php"; ?>


<div class="tab-pane fade" id="benef" role="tabpanel" aria-labelledby="benef-tab">
  <?php if( $oRst_permisos["s_benefGenerar_cheques"] == 1 ){ ?>
    <div class="text-center">
      <div class="row m-0 justify-content-center mt-5 font14">
        <div class="col-md-3">
          <a href="#NuevoBeneficiario" data-toggle="modal" type="button" class="btn bg_gris_100 whitesmoke">[+] Agregar Nuevo</a>
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

    <div class='contorno my-5 font14'>
      <div class='titulo' style="margin-top: -24px;">CUENTAS BANCARIAS</div>
      <form id="ctasBancarias">
        <table class='table'>
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
      </form>


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
