
<div class="modal fade" id="addCorresp">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bordenegro">
      <div class="modal-header border-0 align-items-center">
        <div class='text-left ml-4' style='width:900px'>
          <h5>Corresponsales</h5>
        </div>
        <a href="#" type="button" class="close mr-3" data-dismiss="modal" aria-label="Close"><img style='width:35px' src="/Resources/iconos/close.svg"></a>
      </div>
      <div class="modal-body p-0">
        <div class="text-center font14">
          <div class="contorno mt-3">
            <table class="table">
              <!-- <input id='dbCorresp' type='text' value=''> -->
              <tbody>
                <tr class='row m-0 justify-content-center align-items-center mt-3'>
                  <td class='col-md-8 input-effect'>
                    <input class='efecto popup-input' id='corp-clientem' type='text' id-display='#popup-corp-clienteM' action='clientes_NoTieneCorresponsal' db-id='' autocomplete='off'>
                    <div class='popup-list' id='popup-corp-clienteM' style='display:none'></div>
                    <label for='corp-clientem'>Cliente</label>
                  </td>
                  <td id='nombreCorresp'></td>
                </tr>
              </tbody>
            </table>
            <table class="table table-hover fixed-table mt-5">
              <thead>
                <tr class="row m-0 encabezado">
                  <td class="col-md-6 text-right">CLIENTES ASIGNADOS AL CORRESPONSAL //</td>
                  <td class="col-md-6 text-left" id="nombre"></td>
                </tr>
                <tr class="row m-0 sub2 font14">
                  <td class="p-1 col-md-1"></td>
                  <td class="p-1 col-md-4">CLIENTE</td>
                  <td class="p-1 col-md-5">NOMBRE</td>
                </tr>
              </thead>
              <tbody id="tablaClienteCorresponsales"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!--EDITAR DATOS DEL CORRESPONSAL-->
<div class="modal fade text-center" id="EditarCorresponsal" style="margin-top:50px">
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
          <div id="" class="contorno">
            <table class="table form1 m-0">
              <tbody class="font14">
                <tr class="row mt-4">
                  <td class="col-md-12 input-effect">
                    <input id="correponsal1" class="efecto tiene-contenido" type="text">
                    <label for="correponsal1">Corresponsal</label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-4 input-effect">
                    <input id="calle1" class="efecto tiene-contenido" type="text">
                    <label for="calle1">Calle</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="numext1" class="efecto tiene-contenido" type="text">
                    <label for="numext1">Num.Ext</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="numint1" class="efecto tiene-contenido" type="text">
                    <label for="numint1">Num.Int</label>
                  </td>
                  <td class="col-md-4 input-effect">
                    <input id="colinia1" class="efecto tiene-contenido" type="text">
                    <label for="colinia1">Colonia</label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-3 input-effect">
                    <input id="codigo1" class="efecto tiene-contenido" type="text">
                    <label for="codigo1">Codigo</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="ciudad1" class="efecto tiene-contenido" type="text">
                    <label for="ciudad1">Ciudad</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="estado1" class="efecto tiene-contenido" type="text">
                    <label for="estado1">Estado</label>
                  </td>
                  <td class="col-md-3 input-effect">
                    <input id="rfc1" class="efecto tiene-contenido" type="text">
                    <label for="rfc1">RFC</label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-4 input-effect">
                    <input id="reprlegal1" class="efecto tiene-contenido" type="text">
                    <label for="reprlegal1">Representante Legal</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="repRFC1" class="efecto tiene-contenido" type="text">
                    <label for="repRFC1">RCF</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="contacto1" class="efecto tiene-contenido" type="text">
                    <label for="contacto1">Contacto</label>
                  </td>
                  <td class="col-md-4 input-effect">
                    <input id="mail1" class="efecto tiene-contenido" type="text">
                    <label for="mail1">Correo Electronico</label>
                  </td>
                </tr>
                <tr class="row mt-4">
                  <td class="col-md-2 input-effect">
                    <input id="telefono1" class="efecto tiene-contenido" type="text">
                    <label for="telefono1">Telefono</label>
                  </td>
                  <td class="col-md-2 input-effect">
                    <input id="fax1" class="efecto tiene-contenido" type="text">
                    <label for="fax1">Fax</label>
                  </td>
                  <td class="col-md-8 input-effect">
                    <input id="observaciones1" class="efecto tiene-contenido" type="text">
                    <label for="observaciones1">Observaciones</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div><!--termina el Container-Fluid-->
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="" class="linkbtn">ACEPTAR <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
