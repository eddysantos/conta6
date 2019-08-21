<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/barradenavegacion.php';

$id_cliente = trim($_GET['id_cliente']);
$CLT_status = 0;


require $root . '/conta6/Resources/PHP/actions/validarFormulario.php';

//datos del cliente
require $root . '/conta6/Resources/PHP/actions/consultaDatosCliente.php';
if( $rows_datosCLT > 0 ){
  $CLT_nombre = htmlentities(limpiarNOUSAR($row_datosCLT["s_nombre"]));
  $CLT_calle = limpiarBlancos($row_datosCLT["s_calle"]);
  $CLT_no_ext = limpiarBlancos($row_datosCLT["s_no_ext"]);
  $CLT_no_int = limpiarBlancos($row_datosCLT["s_no_int"]);
  $CLT_colonia = limpiarBlancos($row_datosCLT["s_colonia"]);
  $CLT_codigo = limpiarBlancos($row_datosCLT["s_codigo"]);
  $CLT_ciudad = limpiarBlancos($row_datosCLT["s_ciudad"]);
  $CLT_estado = limpiarBlancos($row_datosCLT["s_estado"]);
  $CLT_pais = limpiarBlancos($row_datosCLT["s_pais"]);
  $CLT_rfc = limpiarBlancos($row_datosCLT["s_rfc"]);
  $CLT_telefono = limpiarBlancos($row_datosCLT["s_telefono"]);
  $CLT_fax = limpiarBlancos($row_datosCLT["s_fax"]);
  $CLT_fecha = limpiarBlancos($row_datosCLT["d_alta_fecha"]);
  $CLT_taxid = limpiarBlancos($row_datosCLT["s_taxid"]);

  $CLT_nomContacto = limpiarBlancos($row_datosCLT["s_contacto"]);
  $CLT_email = limpiarBlancos($row_datosCLT["s_email"]);
  $CLT_repLegal = limpiarBlancos($row_datosCLT["s_rep_legal"]);
  $CLT_rfcLegal = limpiarBlancos($row_datosCLT["s_rfc_legal"]);

  $CLT_email = limpiarBlancos($row_datosCLT["s_email_envio"]);
  $CLT_status = $row_datosCLT['s_status'];
  $CLT_status_pdf = $row_datosCLT['s_envio_pdf'];
  $CLT_status_xml = $row_datosCLT['s_envio_xml'];
  $CLT_usuario_modifi = $row_datosCLT['s_modifico_usuario'];
  $CLT_fecha_modifi = $row_datosCLT['s_modifico_fecha'];
}

//tarifas capturadas
require $root . '/conta6/Resources/PHP/actions/tarifas_cliente_consultaOficinaCapturadas.php'; # $consultaOficinaTarifa

//cuentas contables
require $root . '/conta6/Resources/PHP/actions/consultaCtas108y208_cliente.php';
if( $rows_ctasCliente == 0 ){
  $consultaCuantasCliente = 'NO TIENE CUENTAS CONTABLES';
}
if( $rows_ctasCliente > 0 ){
  while ($row_ctasCliente = $rslt_ctasCliente->fetch_assoc()) {
    $id_cuenta = trim($row_ctasCliente['pk_id_cuenta']);
    $ctadesc =  trim($row_ctasCliente['s_cta_desc']);

    $consultaCuantasCliente .= "<tr class='row'>
      <td class='col-md-4 p-0'><input class='efecto h22 border-0' type='text' value='$id_cuenta'></td>
      <td class='col-md-4 p-0'><input class='efecto h22 border-0' type='text' size='60' value='$ctadesc'></td>
    </tr>";
  }

}

//corresponsal
require $root . '/conta6/Resources/PHP/actions/consulta_corresponsal.php'; # $consultaCorresponsal
// días de crédito
require $root . '/conta6/Resources/PHP/actions/consultaDatosCliente_diasCredito.php';# $rows_diasCredCLT
if( $rows_diasCredCLT > 0 ){
  $btn_actualizarDiasCredito = 'btn_actualizarDiasCredito';
}
if( $rows_diasCredCLT == 0 ){
  $n_dias = '';
  $u_altaDiasCred = '';
  $f_altaDiasCred = '';
  $u_modifiDiasCred = '';
  $f_modifiDiasCred = '';
  $btn_actualizarDiasCredito = 'btn_guaradrDiasCredito';
}

//Cliente activo para facturar. Se activa hasta que tenga su documentación completa.
if( $CLT_status == 1 ){
  $txtStatus_activo = 'selected';
  $txtStatus_inactivo = '';
}else{
  $txtStatus_activo = '';
  $txtStatus_inactivo = 'selected';
}

//se activa para enviar PDF al cliente
if( $CLT_status_pdf == 1 ){
  $txtStatus_activo_pdf = 'selected';
  $txtStatus_inactivo_pdf = '';
}else{
  $txtStatus_activo_pdf = '';
  $txtStatus_inactivo_pdf = 'selected';
}

//se activa para enviar xml al cliente
if( $CLT_status_xml == 1 ){
  $txtStatus_activo_xml = 'selected';
  $txtStatus_inactivo_xml = '';
}else{
  $txtStatus_activo_xml = '';
  $txtStatus_inactivo_xml = 'selected';
}

//Lista forma de pago
require $root . '/conta6/Resources/PHP/actions/lst_conta_cs_sat_formapago_activos.php'; # $consultaFormapago

//Lista forma de pago del cliente
require $root . '/conta6/Resources/PHP/actions/consultaDatosCliente_formaPago.php';
if( $rows_datosCLTformaPago > 0 ){
  while( $row_datosCLTformaPago = $rslt_datosCLTformaPago->fetch_assoc() ) {

    $id_formapago = $row_datosCLTformaPago['fk_id_formapago'];
    $concepto = $row_datosCLTformaPago['s_concepto'];
    $usuario_alta = $row_datosCLTformaPago['fk_usuario'];
    $fecha_alta = $row_datosCLTformaPago['d_fecha_alta'];
    $partida_formapago = $row_datosCLTformaPago['pk_id_partida'];

    $trFormaPagoCLT .= "<tr class='row mt-4 m-0 align-items-center elemento-metPagoCLT'>
                        <td class='col-md-2 p-0 text-right'>
                          <a href='#' class='remove-metPagoCLT'><img class='icomediano ml-2' src='/conta6/Resources/iconos/002-trash.svg'></a>
                          <input type='hidden' class='partidaMetPago' value='$partida_formapago'>
                        </td>
                        <td class='col-md-2 p-0 text-left'>$id_formapago $concepto</td>
                        <td class='col-md-2 p-0 text-left'>$usuario_alta $fecha_alta</td>
                      </tr>";
  }
}
if( $rows_datosCLTformaPago == 0 ){
  $trFormaPagoCLT = "<tr class='row mt-4 m-0 align-items-center'>
                      <td class='col-md-6 p-0 text-center'>NO TIENE DATOS</td>
                    </tr>";
}

//Lista bancos autorizados para uso
require $root . '/conta6/Resources/PHP/actions/lst_conta_cs_sat_bancos_activos.php'; # $consultaBancos

//Lista de bancos con cuentas asignados al cliente
require $root . '/conta6/Resources/PHP/actions/lst_bancos_clientes_2.php'; # $trCtasBancosCLT

$tabindex = 0;

?>

    <!-- //**************************** si cambio los nombres .visualizar Ver-cliente  ya no funciona ****** revisar -->
    <div class='text-center'>
      <div class='row m-0 submenuMed '>
        <div class='col-md-3' role='button'>
          <a  id='submenuMed' class='visualizar' accion='Ver-cliente' status='cerrado'>DATOS CLIENTE</a>
        </div>
        <div class='col-md-3'>
          <a id='submenuMed' class='visualizar' accion='datinfo' status='cerrado'>TARIFAS CAPTURADAS</a>
        </div>
        <div class='col-md-3'>
          <a id="submenuMed" class="visualizar" accion="Ver-iEmbarque" status="cerrado">CUENTAS CONTABLES</a>
        </div>
        <div class='col-md-3'>
          <a id="submenuMed" class="visualizar" accion="Ver-iUsuario" status="cerrado">CORRESPONSAL</a>
        </div>
      </div>
      <div id='detalleCliente' class='contorno' style='display:none'>
        <h5 class='titulo font14'>DATOS CLIENTES</h5>
        <table class='table ' id='eCliente'>
          <thead>
            <tr class='row encabezado font16'>
              <td class='col-md-12 p-0'>
                <input class="eff h22 text-right border-0 bt p-0" type="text" id="T_ID_Cliente_Oculto" value="<?php echo $id_cliente; ?>">
                <input class="eff w-50 h22 text-left border-0 bt" type="text" id="T_Nombre_Cliente" readonly value="<?php echo $CLT_nombre;?>" onchange="validarStringSAT(this);quitarNoUsar(this);">
              </td>
            </tr>
            <tr class='row backpink font14'>
              <td class='col-md-6'>Direccion</td>
              <td class='col-md-6'>Contacto</td>
            </tr>
          </thead>
          <tbody class='font14'>
            <tr class='row'>
              <td class="col-md-2 text-right b p-0"><b>Calle y No :</b></td>
              <td class="col-md-4 p-0">
                <input class="w-100 border-0 bt text-left" id="T_Cliente_Calle" type="text" readonly value="<?php echo $CLT_calle;?>">
              </td>
              <td class="col-md-2 text-right b p-0"><b>Nombre :</b></td>
              <td class='col-md-4 p-0'>
                <input class="border-0 bt text-left w-100" type="text" value="<?php echo $CLT_nomContacto;?>" readonly>
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-2 p-0 text-right b"> <b># Ext :</b></td>
              <td class="text-left p-0">
                <input class="h22 border-0 bt" id="T_Cliente_No_Ext" type="text" readonly value="<?php echo $CLT_no_ext;?>" size="5">
              </td>
              <td class="text-right p-0 b"><b># Int :</b></td>
              <td class="col-md-2 text-left p-0">
                <input class="h22 border-0 bt" id="T_Cliente_No_Int" type="text" readonly value="<?php echo $CLT_no_int;?>" size="25">
              </td>
              <td class="col-md-2 text-right b p-0"><b>Email :</b></td>
              <td class='col-md-4 p-0'>
                <input class="border-0 bt text-left w-100" type="text" value="<?php echo $CLT_email;?>" readonly>
              </td>
            </tr>
            <tr class='row'>
              <td class="col-md-2 text-right b p-0"><b>Colonia :</b></td>
              <td class='col-md-4 p-0 text-left'>
                <input class="h22 border-0 bt" id="T_Cliente_Colonia" type="text" readonly size="40" value="<?php echo $CLT_colonia;?>">
              </td>
              <td class="col-md-2 text-right b p-0"><b>Representante legal :</b></td>
              <td class='col-md-4 p-0'>
                <input class="border-0 bt text-left w-100" type="text" value="<?php echo $CLT_repLegal;?>" readonly>
              </td>
            </tr>
            <tr class='row'>
              <td class="col-md-2 p-0 b text-right"><b>Estado/Ciudad :</b> </td>
              <td class='col-md-3 p-0 text-left'>
                <input class="h22 border-0 bt" id="T_Cliente_Estado" type="text" readonly value="<?php echo $CLT_estado;?>">,
                <input class="h22 border-0 bt text-left p-0" id="T_Cliente_Ciudad" type="text" readonly value="<?php echo $CLT_ciudad;?>">
              </td>
              <td class="col-md-2 text-right b p-0"><b>RFC :</b></td>
              <td class='col-md-4 p-0'>
                <input class="border-0 bt text-left w-100" type="text" value="<?php echo $CLT_rfcLegal;?>" readonly>
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-2 p-0 b text-right"><b>CP :</b></td>
              <td class="p-0 text-left">
                <input class="h22 border-0 bt" id="T_Cliente_CP" type="text" readonly value="<?php echo $CLT_codigo;?>" size="6"></td>
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-2 p-0 b text-right"><b>RFC :</b></td>
              <td class="col-md-4 p-0 text-left">
                <input class="h22 border-0 bt" id="T_Cliente_RFC" type="text" readonly value="<?php echo $CLT_rfc;?>">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-2 p-0 b text-right"><b>Teléfono / Fax :</b></td>
              <td class="col-md-4 p-0 text-left">
                <input  type="text" class="h22 border-0 bt" value="<?php echo $CLT_telefono; ?>"> , <input  type="text" class="h22 border-0 bt" value="<?php echo $CLT_fax;?>">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-2 p-0 b text-right"><b>Fecha Alta :</b></td>
              <td class="col-md-4 p-0 text-left">
                <input  type="text" class="h22 border-0 bt" value="<?php echo $CLT_fecha;?>">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-2 p-0 b text-right"><b>País Origen :</b></td>
              <td class="p-0 text-left">
                <input  type="text" class="h22 border-0 bt" id="T_Cliente_Pais" value="<?php echo $CLT_pais; ?>"></td>
              </td>
              <td class="p-0 b text-right"><b>Tax ID :</b></td>
              <td class="col-md-1 p-0 text-left">
                <input type="text" class="efecto h22" id="T_Cliente_taxid" value="<?php echo $CLT_taxid; ?>">
              </td>
              <td class="col-md-1 p-0 text-left">
                <a href="#" id="btn_guardarTaxID"><img class="icomediano ml-2" src="/conta6/Resources/iconos/save.svg"></a>
              </td>
            </tr>

          </tbody>
        </table>
      </div>

      <div id='contornoInfo' class='contorno' style='display:none'>
        <h5 class='titulo font16'>TARIFAS</h5>
        <table class='table' id='eInfo'>
          <thead>
            <tr class='row encabezado font16'>
              <td class='col-md-12 p-0'>TARIFAS CAPTURADAS</td>
            </tr>
            <tr class='row backpink font14'>
              <td class='col-md-1'>Aduana</td>
              <td class='col-md-1'>Nombre</td>
          </thead>
          <tbody class='font14'>
            <?php echo $consultaOficinaTarifa; ?>
          </tbody>
        </table>
      </div>

      <div id="detalleEmbarque" class="contorno" style="display:none">
        <table class="table form1">
          <thead>
            <tr class="row encabezado font16">
              <td class="col-md-12">CUENTAS CONTABLES</td>
            </tr>
            <tr class="row backpink font16">
              <td class="col-md-4">Cuenta</td>
              <td class="col-md-4">Descripción</td>
            </tr>
          </thead>
          <tbody class="font14" id='tbodyDGE'>
            <?php echo $consultaCuantasCliente; ?>
          </tbody>
        </table>
      </div>

      <div id="detalleUsuario" class="contorno" style="display:none">
        <table class="table form1">
          <thead>
            <tr class="row encabezado font16">
              <td class="col-md-12">CORRESPONSAL</td>
            </tr>
            <tr class="row backpink font16">
              <td class="col-md-4">ID</td>
              <td class="col-md-4">Nombre</td>
            </tr>
          </thead>
          <tbody class="font14" id='tbodyDGE'>
            <?php echo $consultaCorresponsal; ?>
          </tbody>
        </table>
      </div>


      <div class='contorno'>
        <div class=''>
          <div class='acordeon2'>
            <div class='encabezado font16' data-toggle='collapse' href='#collapseOne'>
              <a href="#" id='bread'>CRÉDITO</a>
            </div>
            <div id='collapseOne' class='card-block collapse divisor'>
    		<!--div div id='collapseOne' -->
              <form class='form1' onsubmit="return false">
                <table class='table'>
                  <thead>
                    <tr class='row mt-4 m-0 backpink'>
                      <td class='col-md-2'>Número de días</td>
                      <td class='col-md-2'>Agregó</td>
                      <td class='col-md-2'>Modificó</td>
                      <td class='col-md-2'></td>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class='row mt-4 m-0 sub2 align-items-center'>
                      <td class='col-md-2'>
                        <input class='efecto h22' id='diasCredito' type='text' onBlur='validaSoloNumeros(this);' value='<?php echo $n_dias; ?>'>
                      </td>
                      <td class='col-md-2'>
                        <input class='w-100 border-0 bt text-left' type='text' value='<?php echo $u_altaDiasCred.' '.$f_altaDiasCred; ?>' readonly>
                      </td>
                      <td class='col-md-2'>
                        <input class='w-100 border-0 bt text-left' type='text' value='<?php echo $u_modifiDiasCred.' '.$f_modifiDiasCred; ?>' readonly>
                      </td>
                      <td class='col-md-2 p-0 text-left'>
                        <a href='#' id='<?php echo $btn_actualizarDiasCredito; ?>'><img class='icomediano ml-2' src='/conta6/Resources/iconos/save.svg'></a>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </form>
            </div>
          </div>

          <div class='acordeon2 mt-4'>
            <div class='encabezado font16' data-toggle='collapse' href='#collapseTwo'>
              <a href="#" id='bread'>DATOS DE CFDI</a>
            </div>
            <div id='collapseTwo' class='card-block collapse divisor'>
    		<!--div id='collapseTwo'-->
              <form class='form1' onsubmit="return false">
                <table class='table'>
                  <thead>
                    <tr class='row mt-4 m-0 backpink'>
                      <td class='col-md-2'>Email Receptor</td>
                      <td class='col-md-1'>Estatus</td>
                      <td class='col-md-2'>Envío de CFD</td>
                      <td class='col-md-2'>Modificó</td>
                      <td class='col-md-2'></td>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class='row mt-4 m-0 sub2 align-items-center'>
                      <td class='col-md-2'>
                        <input class="efecto h22" id="email_Factura" type="text" value="<?php echo $CLT_email; ?>">
                      </td>
                      <td class='col-md-1'>
                        <select size="1" id="ID_status">
                          <option value="1" <?php echo $txtStatus_activo; ?>>Activo</option>
                          <option value="0" <?php echo $txtStatus_inactivo; ?>>Inactivo</option>
                        </select>
                      </td>
                      <td class='col-md-1'>
                        PDF <select size="1" id="envio_PDF">
                              <option value="1" <?php echo $txtStatus_activo_pdf; ?>>Si</option>
                              <option value="0" <?php echo $txtStatus_inactivo_pdf; ?>>No</option>
                            </select>
                      </td>
                      <td class='col-md-1'>
                        XML <select size="1" id="envio_xml">
                              <option value="1" <?php echo $txtStatus_activo_xml; ?>>Si</option>
                              <option value="0" <?php echo $txtStatus_inactivo_xml; ?>>No</option>
                            </select>
                      </td>
                      <td class='col-md-2'>
                        <input class="w-100 border-0 bt text-left" type="text" value="<?php echo $CLT_usuario_modifi.' '.$CLT_fecha_modifi;?>" readonly>
                      </td>
                      <td class="col-md-2 p-0 text-left">
                        <a href="#" id="btn_actualizarDatosCFDI"><img class="icomediano ml-2" src="/conta6/Resources/iconos/save.svg"></a>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </form>
              <br>
    		    </div>
          </div>

          <div class='acordeon2 mt-4'>
            <div class='encabezado font16' data-toggle='collapse' href='#collapseThree'>
              <a href="#" id='bread'>FORMA DE PAGO</a>
            </div>
            <div id='collapseThree' class='panel-collapse collapse divisor mb-4'>
    		    <!--div id='collapseThree'-->
              <div class='card-block'>
                <form class='form1'>
                  <table class='table'>
                    <thead>
                      <tr class='row mt-4 m-0 backpink'>
                        <td class='col-md-4'>Agregar Forma de Pago</td>
                      </tr>
                      <tr class='row mt-4 m-0 align-items-center'>
                        <td class="col-md-1 p-0 text-right">
                          <a href="#formaPagoSAT" data-toggle="modal"><img src="/conta6/Resources/iconos/help.svg" style="margin-top:-4px"></a>
                        </td>
                        <td class='col-md-2'>
                          <select id="Lst_metPago" class="custom-select-s">
                            <?php echo $consultaFormapago; ?>
                          </select>
                        </td>
                        <td class="col-md-1 p-0 text-left">
                          <a href="#" id="btn_agregarMetPago"><img class="icomediano ml-2" src="/conta6/Resources/iconos/002-plus.svg"></a>
                        </td>
                      </tr>
                      <tr class='row mt-4 m-0 sub2 align-items-center'>
                        <td class="col-md-2 p-0 text-left"></td>
                        <td class="col-md-2 p-0 text-center">Concepto</td>
                        <td class="col-md-2 p-0 text-center">Agregó</td>
                      </tr>
                    </thead>
                    <tfoot id='metPagoCLT'> <?PHP echo $trFormaPagoCLT; ?> </tfoot>
                  </table>
                </form>
              </div>

              <div class='card-block'>
                <form class='form2'>
                  <table class='table'>
                    <thead>
                      <tr class='row mt-4 m-0 backpink'>
                        <td class='col-md-4'>Agregar cuenta bancaria</td>
                      </tr>
                      <tr class='row mt-4 m-0 align-items-center'>
                        <td class="col-md-1 p-0 text-right">
                            <a href='#catalogoBancosSAT' data-toggle='modal' style='margin-top:-4px'><img src='/conta6/Resources/iconos/help.svg' style='margin-top:-4px'></a>
                        </td>
                        <td class='col-md-2'>
                          <select id="Lst_Bancos" class="custom-select-s">
                            <?php echo $consultaBancos; ?>
                          </select>
                        </td>
                        <td class='col-md-2'>
                          <input class="efecto h22" id="cta_banco" type="text" size="20" maxlength="50" onblur="validaSoloNumeros(this);" autocomplete="off">
                          <div class="popup-list" id="popup-display-cta_banco" style="display:none"></div>
                          <label for="cta_banco">Cuenta Bancaria(min 10 dígitos)</label>
                        </td>
                        <td class='col-md-2'>
                          <input class="efecto h22" id="nom_banco_ext" type="text" size="20" maxlength="50" onblur="eliminaBlancosIntermedios(this);" autocomplete="off" disabled>
                          <div class="popup-list" id="popup-display-nom_banco_ext" style="display:none"></div>
                          <label for="nom_banco_ext">Nombre Banco</label>
                        </td>
                        <td class="col-md-2 p-0 text-left">
                          <a href="#" id="btn_agregarctasbancosCLT"><img class="icomediano ml-2" src="/conta6/Resources/iconos/002-plus.svg"></a>
                        </td>
                      </tr>
                      <tr class='row mt-4 m-0 sub2 align-items-center'>
                        <td class="col-md-2 p-0 text-left"></td>
                        <td class="col-md-2 p-0 text-left">Banco</td>
                        <td class="col-md-2 p-0 text-left">Cuenta</td>
                        <td class="col-md-2 p-0 text-left">Agregó</td>
                        <td class="col-md-2 p-0 text-left">Modificó</td>
                      </tr>
                    </thead>
                    <tfoot>
                      <?php echo $trCtasBancosCLT; ?>
                    </tfoot>
                  </table>
                </form>
              </div>

            </div>
          </div>

          <div class='acordeon2 mt-4'>
            <div class='encabezado font16' data-toggle='collapse' href='#collapseFour'>
              <a href="#" id='bread'>VENDEDOR / EVENTOS</a>
            </div>
            <div id='collapseFour' class='card-block collapse divisor'>
    		<!--div id='collapseFour'-->
              <form class='form1' onsubmit="return false">
                <table class='table'>
                    <tr class='row mt-4 m-0 align-items-center'>
                      <td class='col-md-2'>Vendedores:</td>
                      <td class='col-md-2'>
                        <input class="efecto popup-input" id="clt" type="text" id-display="#popup-display-clt" action="vendedores" db-id="" autocomplete="off">
                        <div class="popup-list" id="popup-display-clt" style="display:none"></div>
                        <label for="clt">VENDEDORES</label>
                      </td>
                      <td class='col-md-2'>Eventos:</td>
                      <td class='col-md-2'></td>
                      <td class='col-md-2'>Observaciones:</td>
                      <td class='col-md-2'></td>
                      <td class='col-md-2'>
                        <a href="#" onclick=""><img class="icomediano ml-2" src="/conta6/Resources/iconos/save.svg"></a>
                      </td>
                    </tr>
                </table>
              </form>
              <br>
    		    </div>
          </div>

        </div>
      </div>

    </div>


<?php
require $root . '/conta6/Ubicaciones/Contabilidad/modales/catalogoSAT.php';
require $root . '/conta6/Ubicaciones/Contabilidad/modales/catalogoBancosSAT.php';
require $root . '/conta6/Ubicaciones/footer.php';
?>
