<!--Editar Registro de Anticipo-->
<div class="modal fade text-center" id="detpol-editar" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Registro</h5>
      </div>
      <div class="modal-body">
        <div class="contorno-modal" id="contorno">
          <table class="table form1 font14">
            <tbody>
              <tr class="row m-0 mt-5">
                <td class="col-md-4 input-effect">
                  <input  class="efecto" id="ant-referencia1">
                  <label for="ant-referencia1">Referencia</label>
                </td>
                <td class="col-md-8 input-effect">
                  <input  list="ant-cli" class="efecto" id="ant-clientes1">
                  <datalist id="ant-cli">
                    <option value="REPRESENTACIONES ASESORIA MANTENIMIENTO Y SERVICIOS ANEXOS S.A DE C.V -- CLT_6921"></option>
                    <option value="SERVICIOS INTEGRALES EEN LOGISTICA INTERNACIONAL, ADUANAS Y TECNOLOGIA S.C -- CLT_7596"></option>
                    <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                    <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                  </datalist>
                  <label for="ant-clientes1">Seleccione un Cliente</label>
                </td>
              </tr>

              <tr class="row m-0 mt-4">
                <td class="col-md-8 input-effect">
                  <input  list="ant-cta" class="efecto" id="ant-cuenta1">
                  <datalist id="ant-cta">
                    <option value="0108-06967 -- MOTORES FRANKLIN S.A DE C.V"></option>
                    <option value="0207-00004 -- CUENTAS AMERICANAS"></option>
                    <option value="0207-00005 -- TRANSFER"></option>
                    <option value="0208-06967 -- MOTORES FRANKLIN S.A DE CV"></option>
                  </datalist>
                  <label for="ant-cuenta1">Seleccione una Cuenta</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input  class="efecto" id="ant-cargo1">
                  <label for="ant-cargo1">Cargo</label>
                </td>
                <td class="col-md-2 input-effect">
                  <input  class="efecto" id="ant-abono1">
                  <label for="ant-abono1">Abono</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <a href="" class="linkbtn">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>
