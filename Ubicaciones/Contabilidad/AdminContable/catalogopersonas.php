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
  </div>

</div>







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
?>
