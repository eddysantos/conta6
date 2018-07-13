<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>

<?php if( $oRst_permisos["s_benefGenerar_cheques"] == 1 ){ ?>
<div class="text-center">
  <div class="row m-0 submenuMed">
    <ul class="nav nav-pills nav-fill w-100">
      <li class="nav-item">
        <a href="#NuevoBeneficiario" data-toggle="modal" class="nav-link" id="submenuMed">AGREGAR NUEVO</a>
      </li>
    </ul>
  </div>
<?php } ?>


  <div class="row mt-5">
    <div class="col-md-6 offset-md-3">
      <input class="efecto popup-input" id="cat-benef" type="text" id-display="#popup-display-benef" action="beneficiarios" db-id="" autocomplete="new-password">
      <div class="popup-list" id="popup-display-benef" style="display:none"></div>
      <label for="cat-benef">Beneficiario</label>
    </div>
    <div class="col-md-1 text-left">
      <a href="#" id="btn_printBenef"><img src="/conta6/Resources/iconos/printer.svg" class="icomediano"></a>
    </div>
  </div>


  <div id="datosGeneralesBen"></div>

  <div class='contorno mt-5 font14'>
    <h5 class='titulo'>CUENTAS BANCARIAS</h5>
    <table class='table form1'>
      <tbody>
        <tr class='row mt-4'>
          <td class='col-md-4 input-effect'>
            <input class='efecto popup-input' id='bcoSAT' type='text' id-display='#popup-display-bcoSAT' action='bancosSAT' db-id='' autocomplete='new-password'>
            <div class='popup-list' id='popup-display-bcoSAT' style='display:none'></div>
            <label for='bcoSAT'>BANCOS
              <a href='#catalogoBancosSAT' data-toggle='modal' style='margin-top:-4px'><img src='/conta6/Resources/iconos/help.svg' style='margin-top:-4px'></a>
            </label>
          </td>
          <td class='col-md-6 input-effect'>
            <input id='cinter' class='efecto' type='text' onchange='validarCtaBancaria(this);'>
            <label for='cinter'>CUENTA / INTERBANCARIA</label>
          </td>
          <td class='col-md-2 input-effect'>
            <?php if( $oRst_permisos['s_benefModificar_cheques'] == 1 ){ ?>
              <a href='#' id="btn_agrCtaBcoBen" class='ver boton' accion='mostrarcta'> <img src= '/conta6/Resources/iconos/add.svg' class='icochico'> AGREGAR</a>
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
          <td class='col-md-3'>CUENTA</td>
          <td class='col-md-3'>AGREGÓ</td>
        </tr>
        <tr colspan="2" id="datosCtasBen"></tr>
      </table>
    </div>
  </div>
  </div>





<?php
require $root . '/conta6/Ubicaciones/footer.php';
require_once('modales/Catalogo.php');
require_once('/conta6/Ubicaciones/Contabilidad/modales/catalogoBancosSAT.php');
 ?>
