<!--POLIZAS DE DIARIO-->
<!--MODAL Contabilidad > Polizas > Modificar -->
<div class="modal fade text-center" id="modificar-pol">
  <div class="modal-dialog modal-med">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Modificar Póliza</h5>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-md-8 titulograndetop">
            <label>POLIZA</label>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8 intermedio">
            <form class="form-group" onsubmit="return false;">
              <input id="folioPol" class="reg border-0 w-100" type="text" onchange="validaSoloNumeros(this);" autocomplete="off">
            </form>
          </div>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="#" id="btn" onclick="buscarPoliza('modificar')">Modificar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>


<!--MODAL Contabilidad > Polizas > Consultar-->
<div class="modal fade text-center" id="consultar-pol">
  <div class="modal-dialog modal-med">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Consultar Póliza</h5>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-md-8 titulograndetop">
            <label>POLIZA</label>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8 intermedio">
            <form class="form-group" onsubmit="return false;">
              <input id="folioPolconsulta" class="reg border-0 w-100" type="text" onchange="validaSoloNumeros(this)" autocomplete="off">
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" id="btn" onclick="buscarPoliza('consultar')">Consultar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>

<!--MODAL Contabilidad > Cheques > Modificar-->
<div class="modal fade text-center" id="modificar-ch">
  <div class="modal-dialog modal-med">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Modificar Cheque</h5>
      </div>
      <div class="modal-body">
        <form class="form1">
        <!-- <form class="form1" onsubmit="return false;"> -->
          <table class="table">
            <tr class="row m-0 mt-3">
              <td class="col-md-8 input-effect">
                <input class="efecto popup-input" id="mModifiChCtaMST" type="text" id-display="#popup-display-mModifiChCtaMST" action="cuentas_mst_0100_oficina" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-mModifiChCtaMST" style="display:none"></div>
                <label for="mModifiChCtaMST">Seleccione una Cuenta</label>
              </td>

              <td class="col-md-4 input-effect">
                <input id="mModifiChIdcheque" class="efecto" type="text">
                <label for="mModifiChIdcheque">Cheque</label>
              </td>
            </tr>
          </table>
        </form>
        <div class="modal-footer mt-3">
        <a href="#" id="btn_busCheModifi" class="linkbtn">Modificar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

<!--MODAL Contabilidad > Cheques > Consultar-->
<div class="modal fade text-center" id="consultar-ch">
  <div class="modal-dialog modal-med">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Consultar Cheque</h5>
      </div>
      <div class="modal-body">
        <form class="form1">
        <!-- <form class="form1" onsubmit="return false;"> -->
          <table class="table">
            <tr class="row m-0 mt-3">
              <td class="col-md-8 input-effect">
                <input class="efecto popup-input" id="mConsChCtaMST" type="text" id-display="#popup-display-mConsChCtaMST" action="cuentas_mst_0100_oficina" db-id="" autocomplete="off">
                <div class="popup-list" id="popup-display-mConsChCtaMST" style="display:none"></div>
                <label for="mConsChCtaMST">Seleccione una Cuenta</label>
              </td>

              <td class="col-md-4 input-effect">
                <input id="mConsChIdcheque" class="efecto" type="text" autocomplete="off">
                <label for="mConsChIdcheque">Cheque</label>
              </td>
            </tr>
          </table>
        </form>
        <div class="modal-footer mt-3">
          <a href="#" id="btn_busCheConsulta" class="linkbtn">Consultar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
<!--//TERMINO DE CHEQUES-->


<!--ANTICIPO-->
<!--MODAL Contabilidad > Anticipos > Modificar -->
<div class="modal fade text-center" id="modificar-ant">
  <div class="modal-dialog modal-med">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Modificar Anticipo</h5>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-md-8 titulograndetop">
            <label>ANTICIPO</label>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8 intermedio">
            <form class="form-group" onsubmit="return false;">
            <input class="reg border-0 w-100" type="text" id="folioAnt" onchange="validaSoloNumeros(this)" autocomplete="off">
          </form>
          </div>
        </div>
        <div class="modal-footer mt-3">
          <a href="#" id="btn" onclick="buscarAnticipo('modificar')">Modificar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

<!--MODAL Contabilidad > Anticipos > Consultar-->
<div class="modal fade text-center" id="consultar-ant">
  <div class="modal-dialog modal-med">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Consultar Anticipo</h5>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-md-8 titulograndetop">
            <label>ANTICIPO</label>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8 intermedio">
            <form  class="form-group" onsubmit="return false;">
            <input class="reg border-0 w-100" type="text" id="folioAntConsulta" onchange="validaSoloNumeros(this)" autocomplete="off">
          </form>
          </div>
        </div>
        <div class="modal-footer mt-3">
          <a href="#" id="btn" onclick="buscarAnticipo('consultar')">Consultar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

<!--POLIZAS-->
<!--MODAL Contabilidad > Polizas > Modificar -->
<div class="modal fade text-center" id="asignar-proveedor">
  <div class="modal-dialog modal-med">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Asignar Proveedor</h5>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-md-8 titulograndetop">
            <label>POLIZA</label>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8 intermedio">
            <form class="form-group" onsubmit="return false;">
              <input class="reg border-0 w-100" type="text" autocomplete="off">
            </form>
          </div>
        </div>
        <div class="modal-footer mt-3">
        <a href="/conta6/Ubicaciones/Contabilidad/Proveedores/AsignarProveedor.php" class="linkbtn">Modificar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>


<!--POLIZAS-->
<!--MODAL Contabilidad > Polizas > Modificar -->
<div class="modal fade text-center" id="updatetarif">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">MODIFICAR CONCEPTO DE HONORARIOS</h5>
      </div>
      <div class="modal-body">
      <table class="table modal-table3">
        <tbody>
          <tr class="row">
            <td class="col-md-12 sub">Administracion de Tarifas</td>
          </tr>
          <tr class="row borderojo">
            <td class="col-md-3">Oficina :</td>
            <td class="col-md-3">2 4 0</td>
            <td class="col-md-3">Usuario :</td>
            <td class="col-md-3">Estefania</td>
          </tr>
          <tr class="row mt-3">
            <td class="col-md-2">Concepto </td>
            <td class="col-md-10">
              <input class="efecto h22" type="text">
            </td>
          </tr>
          <tr class="row">
            <td class="col-md-2">Cuenta</td>
            <td class="col-md-2">
              <input class="efecto h22" type="text">
            </td>
            <td class="col-md-8">
              <input class="efecto h22" type="text">
            </td>
          </tr>
          <tr class="row">
            <td class="col-md-2">Tipo</td>
            <td class="col-md-2">
              <input class="efecto h22" type="text">
            </td>
            <td class="col-md-8">
              <input class="efecto h22" type="text">
            </td>
          </tr>
          <tr class="row">
            <td class="col-md-2">Observaciones</td>
            <td class="col-md-10">
              <input class="efecto h22" type="text">
            </td>
          </tr>
        </tbody>
      </table>
      </div>
      <div class="modal-footer">
        <a href="/conta6/Ubicaciones/Modulo2/TarifasAlmacenes/Conceptos.php" class="linkbtn">Aceptar<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>



<!--POLIZAS DE DIARIO-->
<!--MODAL Contabilidad > Polizas > Modificar -->
<div class="modal fade text-center" id="AsignarProveedor">
  <div class="modal-dialog modal-med">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Asignar Proveedor</h5>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-md-8 titulograndetop">
            <label>PÓLIZA</label>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8 intermedio">
            <form  class="form-group" onsubmit="return false;">
              <input class="reg border-0 w-100" type="text" autocomplete="off">
            </form>
          </div>
        </div>
        <div class="modal-footer mt-3">
          <a href="/conta6/Ubicaciones/Contabilidad/polizas/DetallepolizaDiario.php" class="linkbtn">Modificar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
