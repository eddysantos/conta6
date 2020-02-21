<!--MODULO 3 * MODULO 3 * MODULO 3 * MODULO 3 * MODULO 3 * MODULO 3-->

<!--Sección Parametros para Modificar Articulo 80-->

<div class="modal fade" id="articulo80">
  <div class="modal-dialog modal-med" style="margin-top:150px">
    <div class="modal-content m_bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>Modificar</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Conta6/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <form class="form1" method="post">
          <table class="table text-center">
            <thead>
              <tr class="row sub2 m-0 align-items-center">
                <td class="col-md-3">Inferior</td>
                <td class="col-md-3">Superior</td>
                <td class="col-md-3">Cuota</td>
                <td class="col-md-3">Porcentaje</td>
              </tr>
            </thead>
            <tbody>
              <tr class="row m-0 text-center">
                <td class="col-md-3 input-effect">
                  <input type="hidden" db-id="" id="s_nombreTabla">
                  <input type="hidden" db-id="" id="pk_id_partida">
                  <input  class="efecto" id="n_inferior">
                </td>
                <td class="col-md-3 input-effect">
                  <input  class="efecto" id="n_superior">
                </td>
                <td class="col-md-3 input-effect">
                  <input  class="efecto" id="n_cuota">
                </td>
                <td class="col-md-3 input-effect">
                  <input  class="efecto" id="n_porcentaje">
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
      <div class="modal-footer border-0 mt-3">
        <a href="#" class="linkbtn m-editar">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>

<!--Sección Parametros para Modificar Generales-->

<div class="modal fade" id="paramgenerales">
  <div class="modal-dialog modal-lg" style="margin-top:150px">
    <div class="modal-content m_bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>Modificar</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Conta6/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <table class="table text-center">
          <thead>
            <tr class="row sub2 m-0 align-items-center">
              <td class="p-1 col-md-2">Oficina</td>
              <td class="p-1 col-md-2">Salario Min</td>
              <td class="p-1 col-md-2">IMSS</td>
              <td class="p-1 col-md-2">Subsidio</td>
              <td class="p-1 col-md-2">D. Trabajados</td>
              <td class="p-1 col-md-2">D. Pagar</td>
            </tr>
          </thead>
          <tbody>
            <tr class="row m-0">
              <td class="col-md-2">
                <input type="hidden" db-id="" id="s_nombreTabla">
                <input type="hidden" id="pk_id_partida">
                <input  class="efecto" id="fk_id_aduana">
              </td>
              <td class="col-md-2">
                <input  class="efecto" id="n_salarioMinimo">
              </td>
              <td class="col-md-2">
                <input  class="efecto" id="n_IMSS">
              </td>
              <td class="col-md-2">
                <input  class="efecto" id="n_subsidio">
              </td>
              <td class="col-md-2">
                <input  class="efecto" id="n_diasTrabajados">
              </td>
              <td class="col-md-2">
                <input  class="efecto" id="n_diasPagar">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer border-0 mt-3">
        <a href="#" class="linkbtn m-editar">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>


<!--Sección Parametros para Modificar Generales-->

<div class="modal fade" id="factorintegracion">
  <div class="modal-dialog modal-ch" style="margin-top:150px">
    <div class="modal-content m_bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>Modificar</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Conta6/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <form class="form1">
          <table class="table text-center">
            <thead>
              <tr class="row sub2 m-0 align-items-center">
                <td class="p-1 col-md-6">Oficina</td>
                <td class="p-1 col-md-6">Integración</td>
              </tr>
            </thead>
            <tbody>
              <tr class="row m-0">
                <td class="col-md-6">
                  <input type="hidden" db-id="" id="s_nombreTabla">
                  <input  type="hidden" id="pk_id_partida">
                  <input  class="efecto" id="n_anio">
                </td>
                <td class="col-md-6">
                  <input  class="efecto" id="n_integrado">
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
      <div class="modal-footer border-0 mt-3">
        <a href="#" class="linkbtn m-editar">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>


<!--Sección Parametros para Subsidio al Empleo-->

<div class="modal fade" id="subsidio">
  <div class="modal-dialog modal-med" style="margin-top:150px">
    <div class="modal-content m_bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>Modificar</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Conta6/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <form class="form1">
          <table class="table text-center">
            <thead>
              <tr class="row sub2 m-0 align-items-center">
                <td class="p-1 col-md-4">Interior</td>
                <td class="p-1 col-md-4">Superior</td>
                <td class="p-1 col-md-4">Cuota</td>
              </tr>
            </thead>
            <tbody>
              <tr class="row m-0">
                <td class="col-md-4">
                  <input type="hidden" db-id="" id="s_nombreTabla">
                  <input type="hidden" id="pk_id_partida">
                  <input  class="efecto" id="n_inferior_b">
                </td>
                <td class="col-md-4">
                  <input  class="efecto" id="n_superior_b">
                </td>
                <td class="col-md-4">
                  <input  class="efecto" id="n_cuota_b">
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
      <div class="modal-footer border-0 mt-3">
        <a href="#" class="linkbtn m-editar">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>


<!--Sección Parametros para IMSS-->

<div class="modal fade" id="imss">
  <div class="modal-dialog modal-xl" style="margin-top:150px">
    <div class="modal-content m_bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>Modificar</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Conta6/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <form class="form1">
          <table class="table text-center">
            <thead>
              <tr class="row sub2 m-0 align-items-center">
                <td class="col-md-1">Ramo</td>
                <td class="col-md-3">Descripción</td>
                <td class="col-md-2">Base</td>
                <td class="col-md-1">Tope</td>
                <td class="col-md-3">Patron</td>
                <td class="col-md-2">Trabajador</td>
              </tr>
            </thead>
            <tbody>
              <tr class="row m-0">
                <td class="col-md-1">
                  <input type="hidden" db-id="" id="s_nombreTabla">
                  <input type="hidden" id="pk_id_partida">
                  <input  class="efecto" id="n_ramo">
                </td>
                <td class="col-md-3">
                  <input  class="efecto" id="s_descripcion">
                </td>
                <td class="col-md-2">
                  <input  class="efecto" id="n_baseSalarial">
                </td>
                <td class="col-md-1">
                  <input  class="efecto" id="n_topeSalarial">
                </td>
                <td class="col-md-3">
                  <input  class="efecto" id="n_patron">
                </td>
                <td class="col-md-2">
                  <input  class="efecto" id="n_trabajador">
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
      <div class="modal-footer border-0 mt-3">
        <a href="#" class="linkbtn m-editar">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>
