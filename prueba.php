$system_callback['data'] .=
"<div class='row m-0 align-items-center elemento-facpendientes' id='$idFila'>
  <div class='col-md-2'><input type='text' id='facpendref$idFila' class='efecto bt border-0 h22 facpend-referencia' size='10' value='$fk_referencia' readonly></div>
  <div class='col-md-1'><input type='text' id='facpendfac$idFila' class='efecto bt border-0 h22 facpend-factura' size='10' value='$fk_factura2' readonly></div>
  <div class='col-md-1'><input type='text' id='facpendctagastos$idFila' class='efecto bt border-0 h22 facpend-ctagastos' size='10' value='$fk_ctagastos2' readonly></div>
  <div class='col-md-1'><input type='text' id='facpendnc$idFila' class='efecto bt border-0 h22 facpend-nc' size='10' value='$fk_nc2' readonly></div>
  <div class='col-md-2'><input type='text' id='facpendsaldo$idFila' class='efecto bt border-0 h22 facpend-saldo' size='10' value='$saldo' readonly></div>
  <div class='col-md-2'><input type='text' id='facpendpago$idFila' class='efecto h22 facpend-pago' onchange='validaIntDec(this);'></div>
  <div class='col-md-1'>
    <div class='custom-control custom-switch'>
      <input type='checkbox' class='custom-control-input checkbox-facpend facpend-check' id='generada$idFila'>
      <input type='hidden' id='facpendpartida$idFila' class='efecto h22 facpend-partida' value=''>
      <label class='custom-control-label' for='generada$idFila'></label>
    </div>
  </div>
  <div class='col-md-2'><input type='text' id='facpendcta$idFila' class='efecto bt border-0 h22 facpend-cta' size='10' value='$fk_id_cuenta' readonly></div>
</div>";










<!-- original -->
$system_callback['data'] .=
"<tr class='row m-0 align-items-center elemento-facpendientes' id='$idFila'>
  <td class='col-md-2'><input type='text' id='facpendref$idFila' class='efecto bt border-0 h22 facpend-referencia' size='10' value='$fk_referencia' readonly></td>
  <td class='col-md-1'><input type='text' id='facpendfac$idFila' class='efecto bt border-0 h22 facpend-factura' size='10' value='$fk_factura2' readonly></td>
  <td class='col-md-1'><input type='text' id='facpendctagastos$idFila' class='efecto bt border-0 h22 facpend-ctagastos' size='10' value='$fk_ctagastos2' readonly></td>
  <td class='col-md-1'><input type='text' id='facpendnc$idFila' class='efecto bt border-0 h22 facpend-nc' size='10' value='$fk_nc2' readonly></td>
  <td class='col-md-2'><input type='text' id='facpendsaldo$idFila' class='efecto bt border-0 h22 facpend-saldo' size='10' value='$saldo' readonly></td>
  <td class='col-md-2'><input type='text' id='facpendpago$idFila' class='efecto h22 facpend-pago' onchange='validaIntDec(this);'></td>
  <td class='col-md-1'>
    <div class='custom-control custom-switch'>
      <input type='checkbox' class='custom-control-input checkbox-facpend facpend-check' id='generada$idFila'>
      <input type='hidden' id='facpendpartida$idFila' class='efecto h22 facpend-partida' value=''>
      <label class='custom-control-label' for='generada$idFila'></label>
    </div>
  </td>
  <td class='col-md-2'><input type='text' id='facpendcta$idFila' class='efecto bt border-0 h22 facpend-cta' size='10' value='$fk_id_cuenta' readonly></td>
</tr>";
