
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
        <div class="row titulograndetop-modal">
          <div class="col-md-12">
            <label>POLIZA</label>
          </div>
        </div>
        <div class="row intermedio-modal">
          <div class="col-12">
            <form  class="form-group"  method="post">
            <input id="folioPol" class="modif text-center form-control noborder" type="text" autocomplete="new-password" onchange="validaSoloNumeros(this);">
          </form>
          </div>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer brx1">
      <!--a href="/conta6/Ubicaciones/Contabilidad/polizas/DetallepolizaDiario.php" id="btn">Modificar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a-->
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
        <div class="row titulograndetop-modal">
          <div class="col-md-12">
            <label>POLIZA</label>
          </div>
        </div>
        <div class="row intermedio-modal">
          <div class="col-12">
            <form  class="form-group"  method="post">
            <input id="folioPolconsulta" class="modif text-center form-control noborder" type="text">
          </form>
          </div>
        </div>
        <div class="modal-footer brx1">
        <!--a href="/conta6/Ubicaciones/Contabilidad/polizas/ConsultarPoliza.php" id="btn">Consultar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a-->
        <a href="#" id="btn" onclick="buscarPoliza('consultar')">Consultar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
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
        <div class="row titulograndetop-modal">
          <div class="col-md-2">
            <label>CHEQUE</label>
          </div>
        </div>
        <div class="row intermedio-modal">
          <div class="col-md-12">
            <form class="form-group">
            <input class="modif text-center border-0" type="text">
          </form>
          </div>
        </div>
        <div class="modal-footer mt-3">
        <a href="/conta6/Ubicaciones/Contabilidad/cheques/Detallecheque.php" class="linkbtn">Modificar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
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
        <h5 class="modal-tittle">Modificar Cheque</h5>
      </div>
      <div class="modal-body">
        <div class="row titulograndetop-modal">
          <div class="col-md-12">
            <label>CHEQUE</label>
          </div>
        </div>
        <div class="row intermedio-modal">
          <div class="col-md-12">
            <form class="form-group">
            <input class="modif text-center border-0" type="text">
          </form>
          </div>
        </div>
        <div class="modal-footer mt-3">
        <a href="/conta6/Ubicaciones/Contabilidad/cheques/ConsultarCheque.php" class="linkbtn">Modificar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
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
        <div class="row titulograndetop-modal">
          <div class="col-md-12">
            <label>ANTICIPO</label>
          </div>
        </div>
        <div class="row intermedio-modal">
          <div class="col-md-12">
            <form class="form-group">
            <input class="modif text-center border-0" type="text">
          </form>
          </div>
        </div>
        <div class="modal-footer mt-3">
        <a href="/conta6/Ubicaciones/Contabilidad/anticipos/Detalleanticipo.php" class="linkbtn">Modificar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
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
        <div class="row titulograndetop-modal">
          <div class="col-md-12">
            <label>ANTICIPO</label>
          </div>
        </div>
        <div class="row intermedio-modal">
          <div class="col-md-12">
            <form  class="form-group">
            <input class="modif text-center border-0" type="text">
          </form>
          </div>
        </div>
        <div class="modal-footer mt-3">
        <a href="/conta6/Ubicaciones/Contabilidad/anticipos/ConsultarAnticipo.php" class="linkbtn">Modificar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
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
        <div class="row titulograndetop-modal">
          <div class="col-md-12">
            <label>POLIZA</label>
          </div>
        </div>
        <div class="row intermedio-modal">
          <div class="col-md-12">
            <form  class="form-group">
            <input class="modif text-center border-0" type="text">
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
<div class="modal fade" id="AsignarProveedor">
  <div class="modal-dialog modal-med">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Asignar Proveedor</h5>
      </div>
      <div class="modal-body">
        <div class="row titulograndetop-modal">
          <div class="col-md-12 text-center">
            <label>PÓLIZA</label>
          </div>
        </div>
        <div class="row intermedio-modal">
          <div class="col-md-12">
            <form  class="form-group">
            <input class="modif text-center border-0" type="text">
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
