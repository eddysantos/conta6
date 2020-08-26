<!--CATALO DE CUENTAS-->
<div class="modal fade" id="catalogoSAT">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bordenegro border-radius">
      <div class="modal-header border-0">
        <h3 class="modal-title mx-3 s_gris_100">Catálogo SAT</h3>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <div class="contorno">
          <table class='table text-center table-hover fixed-table'>
            <thead>
              <tr class='row encabezado m-0'>
                <td class='col-md-1'>Nivel</td>
                <td class='col-md-1'>Código Agrupador</td>
                <td class='col-md-4'>Nombre de la Cuenta</td>
                <td class='col-md-1'>Activa</td>
                <td class='col-md-2'>Publicación Diario Oficial</td>
                <td class='col-md-2'>Clasificación</td>
                <td class='col-md-1'>Cuenta de Balance</td>
              </tr>
            </thead>
            <tbody id="catalogo-sat-helper"></tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
    </div><!--termina el COntenido del Modal-->
  </div>
</div>

<!--CATALO DE FORMA DE PAGO-->
<div class="modal fade" id="formaPagoSAT" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Forma de pago SAT</h5>
      </div>
      <div class="modal-body p-0">
        <div id="" class="contorno">
          <table class='table text-center table-hover fixed-table'>
            <thead>
              <tr class='row encabezado m-0'>
                <td class='col-md-1'>Clave</td>
                <td class='col-md-1'>Concepto</td>
                <td class='col-md-2'>Publicacion Diario Oficial</td>
                <td class='col-md-1'>Activa</td>
              </tr>
            </thead>
            <tbody id="formaPago-sat-helper"></tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
