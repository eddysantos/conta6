<div class="modal fade text-center" id="buscar_factura">
  <div class="modal-dialog modal-med">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Buscar Factura</h5>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-md-8 titulograndetop">
            <label>FACTURA</label>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8 intermedio">
            <form class="form-group" onsubmit="return false;">
              <input class="reg border-0 w-100" type="text" onchange="validaSoloNumeros(this);" autocomplete="off">
            </form>
          </div>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="#" id="" onclick="">Buscar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
