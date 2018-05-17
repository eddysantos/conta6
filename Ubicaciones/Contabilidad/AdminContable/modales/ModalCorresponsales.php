<!--AGREGAR NUEVO CORRESPONSAL-->
<div class="modal fade" id="NuevoCorresponsal" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Agregar Nuevo Corresposal</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
          <div id="" class="contorno">
            <form class="form1">
              <table class="table text-center font14">
                <tbody>
                  <tr class="row mt-4">
                    <td class="col-md-12 input-effect">
                      <input id="correponsal" class="efecto" type="text">
                      <label for="correponsal">CORRESPOSAL</label>
                    </td>
                  </tr>
                  <tr class="row mt-4">
                    <td class="col-md-4 input-effect">
                      <input id="calle" class="efecto" type="text">
                      <label for="calle">CALLE</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="numext" class="efecto" type="text">
                      <label for="numext">NUM.EXT</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="numint" class="efecto" type="text">
                      <label for="numint">NUM.INT</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input id="colinia" class="efecto" type="text">
                      <label for="colinia">COLONIA</label>
                    </td>
                  </tr>
                  <tr class="row mt-4">
                    <td class="col-md-3 input-effect">
                      <input id="codigo" class="efecto" type="text">
                      <label for="codigo">CODIGO</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="ciudad" class="efecto" type="text">
                      <label for="ciudad">CIUDAD</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="estado" class="efecto" type="text">
                      <label for="estado">ESTADO</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="rfc" class="efecto" type="text">
                      <label for="rfc">RFC</label>
                    </td>
                  </tr>
                  <tr class="row mt-4">
                    <td class="col-md-4 input-effect">
                      <input id="reprlegal" class="efecto" type="text">
                      <label for="reprlegal">REPRESENTANTE LEGAL</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="repRFC" class="efecto" type="text">
                      <label for="repRFC">RCF</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="contacto" class="efecto" type="text">
                      <label for="contacto">CONTACTO</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input id="mail" class="efecto" type="text">
                      <label for="mail">CORREO ELECTRONICO</label>
                    </td>
                  </tr>
                  <tr class="row mt-4">
                    <td class="col-md-2 input-effect">
                      <input id="telefono" class="efecto" type="text">
                      <label for="telefono">TELEFONO</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="fax" class="efecto" type="text">
                      <label for="fax">FAX</label>
                    </td>
                    <td class="col-md-8 input-effect">
                      <input id="observaciones" class="efecto" type="text">
                      <label for="observaciones">OBSERVACIONES</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" id="btn">REGISTRAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>


<!--EDITAR DATOS DEL CORRESPONSAL-->
<div class="modal fade" id="EditarCorresponsal" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Editar Corresposal</h5>
      </div>
      <div class="modal-body p-0">
        <div class="container-fluid">
          <div class="contorno">
            <form class="form1">
              <table class="table text-center font14">
                <tbody>
                  <tr class="row mt-4">
                    <td class="col-md-12 input-effect">
                      <input id="correponsal1" class="efecto tiene-contenido" type="text">
                      <label for="correponsal1">CORRESPOSAL</label>
                    </td>
                  </tr>
                  <tr class="row mt-4">
                    <td class="col-md-4 input-effect">
                      <input id="calle1" class="efecto tiene-contenido" type="text">
                      <label for="calle1">CALLE</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="numext1" class="efecto tiene-contenido" type="text">
                      <label for="numext1">NUM.EXT</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="numint1" class="efecto tiene-contenido" type="text">
                      <label for="numint1">NUM.INT</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input id="colinia1" class="efecto tiene-contenido" type="text">
                      <label for="colinia1">COLONIA</label>
                    </td>
                  </tr>
                  <tr class="row mt-4">
                    <td class="col-md-3 input-effect">
                      <input id="codigo1" class="efecto tiene-contenido" type="text">
                      <label for="codigo1">CODIGO</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="ciudad1" class="efecto tiene-contenido" type="text">
                      <label for="ciudad1">CIUDAD</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="estado1" class="efecto tiene-contenido" type="text">
                      <label for="estado1">ESTADO</label>
                    </td>
                    <td class="col-md-3 input-effect">
                      <input id="rfc1" class="efecto tiene-contenido" type="text">
                      <label for="rfc1">RFC</label>
                    </td>
                  </tr>
                  <tr class="row mt-4">
                    <td class="col-md-4 input-effect">
                      <input id="reprlegal1" class="efecto tiene-contenido" type="text">
                      <label for="reprlegal1">REPRESENTANTE LEGAL</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="repRFC1" class="efecto tiene-contenido" type="text">
                      <label for="repRFC1">RCF</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="contacto1" class="efecto tiene-contenido" type="text">
                      <label for="contacto1">CONTACTO</label>
                    </td>
                    <td class="col-md-4 input-effect">
                      <input id="mail1" class="efecto tiene-contenido" type="text">
                      <label for="mail1">CORREO ELECTRONICO</label>
                    </td>
                  </tr>
                  <tr class="row mt-4">
                    <td class="col-md-2 input-effect">
                      <input id="telefono1" class="efecto tiene-contenido" type="text">
                      <label for="telefono1">TELEFONO</label>
                    </td>
                    <td class="col-md-2 input-effect">
                      <input id="fax1" class="efecto tiene-contenido" type="text">
                      <label for="fax1">FAX</label>
                    </td>
                    <td class="col-md-8 input-effect">
                      <input id="observaciones1" class="efecto tiene-contenido" type="text">
                      <label for="observaciones1">OBSERVACIONES</label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" id="btn">ACEPTAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
