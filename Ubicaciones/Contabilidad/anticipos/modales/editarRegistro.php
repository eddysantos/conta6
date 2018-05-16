<!--Editar Registro de Anticipo-->
<div class="modal fade" id="detpol-editar" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Registro</h5>
      </div>
      <div class="modal-body" style="padding:0px">
        <div class="container-fluid">
          <div id="contorno" class="contorno-modal">
            <form class="form1"method="post">
              <table class="table">
                <tbody class="cuerpo">
                  <tr class="row m-0">
                    <td class="col-md-4 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="ant-referencia1">
                      <label for="ant-referencia1">Referencia</label>
                    </td>
                    <td class="col-md-8 input-effect brx2">
                      <input  list="ant-cli" class="text-normal efecto text-center"  id="ant-clientes1">
                      <datalist id="ant-cli">
                        <option value="REPRESENTACIONES ASESORIA MANTENIMIENTO Y SERVICIOS ANEXOS S.A DE C.V -- CLT_6921"></option>
                        <option value="SERVICIOS INTEGRALES EEN LOGISTICA INTERNACIONAL, ADUANAS Y TECNOLOGIA S.C -- CLT_7596"></option>
                        <option value="AGENTES ADUANALES ASOCIADOS PARA EL COMERCIO EXTERIOR S.A DE C.V --- CLT 6109"></option>
                        <option value="INTERNATIONAL FREIGHT FORWARDER AND ADVISOR CUSTOMS DELIVERY S.A DE C.V --- CLT_7663"></option>
                      </datalist>
                      <label for="ant-clientes1">Seleccione un Cliente</label>
                    </td>
                  </tr>

                  <tr class="row m-0 text-center">
                    <td class="col-md-8 input-effect brx2">
                      <input  list="ant-cta" class="text-normal efecto text-center"  id="ant-cuenta1">
                      <datalist id="ant-cta">
                        <option value="0108-06967 -- MOTORES FRANKLIN S.A DE C.V"></option>
                        <option value="0207-00004 -- CUENTAS AMERICANAS"></option>
                        <option value="0207-00005 -- TRANSFER"></option>
                        <option value="0208-06967 -- MOTORES FRANKLIN S.A DE CV"></option>
                      </datalist>
                      <label for="ant-cuenta1">Seleccione una Cuenta</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="ant-cargo1">
                      <label for="ant-cargo1">Cargo</label>
                    </td>
                    <td class="col-md-2 input-effect brx2">
                      <input  class="text-normal efecto text-center"  id="ant-abono1">
                      <label for="ant-abono1">Abono</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="" id="btn">Actualizar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>
