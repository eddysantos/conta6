<!--EDITAR CIERRE DE MES-->
<div class="modal fade text-center" id="EditarCierre" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content m_bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>Editar Cierre de Mes</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Conta6/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <div class="contorno">
          <table class="table form1 m-0">
            <tbody class="font14">
              <tr class="row">
                <td class="col-md-3 input-effect">
                  <input type="text" class="efecto tiene-contenido" id="idoficina">
                  <label for="idoficina">ID Oficina</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input type="text" class="efecto tiene-contenido" id="idmodulo">
                  <label for="idmodulo">ID Modulo</label>
                </td>
                <td class="col-md-3 input-effect" id="fechaIni">
                  <input type="date" class="efecto tiene-contenido">
                  <label for="fechaIni">Fecha Inicial</label>
                </td>
                <td class="col-md-3 input-effect">
                  <input type="date" class="efecto tiene-contenido" id="fechaFin">
                  <label for="fechaFin">Fecha Final</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer border-0 mt-3">
        <a href="#" id="medit-ctas">ACTUALIZAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
