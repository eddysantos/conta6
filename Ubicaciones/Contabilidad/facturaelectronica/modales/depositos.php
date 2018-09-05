<!--Buscar Facturas en Captura detalle de poliza-->
<div class="modal fade text-center" id="agregarDepositos" style="margin-top:50px">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" name="button" data-dismiss="modal" area-label="close">
          <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
        </button>
        <h5 class="modal-tittle">Agregar Depositos</h5>
      </div>
      <div class="modal-body">
        <div class="contorno">
          <table class="table mt-4" id="vclientes">
            <thead>
              <tr class="row encabezado">
                <td class="col-md-12">DEPOSITOS DISPONIBLES</td>
              </tr>
              <tr class="row sub2">
                <td class="col-md-6">Cliente</td>
                <td class="col-md-2">Anticipo</td>
                <td class="col-md-2">Importe</td>
                <td class="col-md-2">Aplicar</td>
              </tr>
            </thead>
            <tbody>
              <tr class="row">
                <td class="col-md-6">LIBRERIA GANDHI, SA DE CV</td>
                <td class="col-md-2">22222</td>
                <td class="col-md-2">$34,640</td>
                <td class="col-md-2">
                  <div class="checkbox-xs">
                    <label>
                      <input type="checkbox" data-toggle="toggle">
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>


          <table class="table mt-4">
            <thead>
              <tr class="row encabezado">
                <td class="col-md-12">DEPOSITOS APLICADOS PARA CUENTA DE GASTOS</td>
              </tr>
              <tr class="row sub2">
                <td class="col-md-6">Cliente</td>
                <td class="col-md-2">Anticipo</td>
                <td class="col-md-2">Importe</td>
                <td class="col-md-2"></td>
              </tr>
            </thead>
            <tbody>
              <tr class="row">
                <td class="col-md-6">LIBRERIA GANDHI, SA DE CV</td>
                <td class="col-md-2">22222</td>
                <td class="col-md-2">$34,640</td>
                <td class="col-md-2">
                  <a href="#">
                    <img class='mr-3 icochico' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- <table class="table mt-4">
            <tbody>

              <tr class="row">
                <td class="p-1 col-md-8 text-right">
                  Anticipo 1 :
                  <a href="javascript:Btn_Busca_Anticipo('1')" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                    <img class='mr-3 icochico' src='/conta6/Resources/iconos/magnifier.svg'>
                  </a>
                  <a href="javascript:limpiarCampos(4,1)">
                    <img class='mr-3 icochico' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_No_Anticipo_1" size="20" readonly>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_Anticipo_1" size="20" value="0" readonly>
                </td>
              </tr>

              <tr class="row">
                <td class="p-1 col-md-8 text-right">
                  Anticipo 2 :
                  <a href="javascript:Btn_Busca_Anticipo('2')" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                    <img class='mr-3 icochico' src='/conta6/Resources/iconos/magnifier.svg' /></a>
                  <a href="javascript:limpiarCampos(4,2)">
                    <img class='mr-3 icochico' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_No_Anticipo_2" size="20" readonly>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_Anticipo_2" size="20" value="0" readonly>
                </td>
              </tr>

              <tr class="row">
                <td class="p-1 col-md-8 text-right">
                  Anticipo 3 :
                  <a href="javascript:Btn_Busca_Anticipo('3')" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/magnifier.svg'>
                  </a>
                  <a href="javascript:limpiarCampos(4,3)">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_No_Anticipo_3" size="20" readonly>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_Anticipo_3" size="20" value="0" readonly>
                </td>
              </tr>

              <tr class="row">
                <td class="p-1 col-md-8 text-right">
                  Anticipo 4 :
                  <a href="javascript:Btn_Busca_Anticipo('4')" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/magnifier.svg'>
                  </a>
                  <a href="javascript:limpiarCampos(4,4)">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
                <td class="p-1 col-md-2">
                <input class="w-100 efecto h22" type="text" id="T_No_Anticipo_4" size="20" readonly>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_Anticipo_4" size="20" value="0" readonly>
                </td>
              </tr>

              <tr class="row">
                <td class="p-1 col-md-8 text-right">
                  Anticipo 5 :
                  <a href="javascript:Btn_Busca_Anticipo('5')" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/magnifier.svg'>
                  </a>
                  <a href="javascript:limpiarCampos(4,5)">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
                <td class="p-1 col-md-2">
                <input class="w-100 efecto h22" type="text" id="T_No_Anticipo_5" size="20" readonly>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_Anticipo_5" size="20" value="0" readonly>
                </td>
              </tr>

              <tr class="row">
                <td class="p-1 col-md-8 text-right">
                  Anticipo 6 :
                  <a href="javascript:Btn_Busca_Anticipo('6')" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/magnifier.svg'>
                  </a>
                  <a href="javascript:limpiarCampos(4,6)">
                    <img class='icochico mr-3' src='/conta6/Resources/iconos/002-trash.svg'>
                  </a>
                </td>
                <td class="p-1 col-md-2">
                <input class="w-100 efecto h22" type="text" id="T_No_Anticipo_6" size="20" readonly>
                </td>
                <td class="p-1 col-md-2">
                  <input class="w-100 efecto h22" type="text" id="T_Anticipo_6" size="20" value="0" readonly>
                </td>
              </tr>
            </tbody>
          </table> -->
        </div>
      </div><!--termina el Cuerpo del Modal-->
      <div class="modal-footer">
        <a href="#" class="linkbtn"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
      </div>
    </div><!--termina el COntenido del Modal-->
  </div>
</div>
