<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/barradenavegacion.php';

$cuenta = trim($_GET['cuenta']);
$id_cliente = trim($_GET['id_cliente']);

require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosGenerales.php';
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosEmbarque.php'; #$datosEmbarqueModifi
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosPOCME.php'; # $datosPOCMEmodifi
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosCargos.php'; #$datosCargosModifi
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosHonorarios.php'; #$datosHonorariosModifi
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarFactura.php'; #$pk_id_factura

//LISTA DE MONEDAS
require $root . '/conta6/Resources/PHP/actions/consultaMoneda.php'; #$consultaMoneda

//LISTA CTAS BANCARIAS DE COMPAÑIA
require $root . '/conta6/Resources/PHP/actions/lst_bancos_cia.php'; #$ctasCIA

$parcialidad = 1;
// if( is_null($oRst_Pago['numParcialidad']) ){
//   $sql_parcialidad = mysqli_query($link,"SELECT max(numParcialidad) as numParcialidad from TBL_PAGOS_CFDI WHERE id_facturaDR = '$id_factura' and id_docPago <> $id_docPago");
//   $total_parcialidad = mysqli_num_rows($sql_parcialidad);
//   if( $total_parcialidad > 0 ){
//     $oRst_parcialidad = mysqli_fetch_array($sql_parcialidad);
//     $parcialidad = $oRst_parcialidad['numParcialidad'] + 1;
//   }
// }else{
//   $parcialidad = $oRst_Pago['numParcialidad'];
// }


//forma de pago del cliente
require $root . '/conta6/Resources/PHP/actions/consultaDatosCliente_formaPago.php';
if ($rows_datosCLTformaPago > 0) {
    $datosCLTformaPago = "<option selected value='0'>Forma de pago</option>";
  while ($row_datosCLTformaPago = $rslt_datosCLTformaPago->fetch_assoc()) {
    $id_formaPago = $row_datosCLTformaPago['fk_id_formapago'];
    $concepto = $row_datosCLTformaPago['s_concepto'];
    $datosCLTformaPago .= '<option value="'.$id_formaPago.'">'.$concepto.' --- '.$id_formaPago.'</option>';
  }
}
?>

<input type="hidden" id="tipoDocumento" value="elaborar">

<div class="text-center">
  <div class='row m-0 submenuMed text-center' style="font-size:13px">
    <div class='col-md-3 mt-2' role='button'>
      <a href="#" class='pgos' accion='Ver-cliente' status='cerrado'>DATOS CLIENTE</a>
    </div>
    <div class='col-md-3 mt-2'>
      <a href="#" class='pgos' accion='datinfo' status='cerrado'>INFO. GENERAL</a>
    </div>
    <div class='col-md-3 mt-2'>
      <a href="#" class="pgos" accion="pgos-factura" status="cerrado">PAGOS DE LA MISMA FACTURA</a>
    </div>
    <div class='col-md-3 mt-2'>
      <a href="#" class="pgos" accion="folio" status="cerrado">FOLIO A SUSTITUIR</a>
    </div>
  </div>

  <div id='detalleCliente' class='contorno' style='display:none'>
    <h5 class='titulo font14'>DATOS CLIENTES</h5>
    <table class='table' id='eCliente'>
      <thead>
        <tr class='row encabezado font16'>
          <td class='col-md-12 p-0'>
            <input class="eff h22 text-right border-0 bt p-0" type="text" id="T_ID_Cliente_Oculto" value="<?php echo $fk_id_cliente; ?>">
            <input class="eff w-50 h22 text-left border-0 bt" type="text" id="T_Nombre_Cliente" readonly value="<?php echo $s_nombre;?>" onchange="validarStringSAT(this);quitarNoUsar(this);">
          </td>
        </tr>
        <tr class="row sub3 font12 b" style="background-color:rgba(173, 173, 173, 0.1)!important">
          <td class='col-md-6 p-1'>Direccion</td>
          <td class='col-md-6 p-1'></td>
        </tr>
      </thead>
      <tbody class='font14'>
        <tr class='row'>
          <td class="col-md-2 text-right b p-0"><b>Calle y No :</b></td>
          <td class="col-md-4 p-0">
            <input class="w-100 border-0 bt text-left" id="T_Cliente_Calle" type="text" readonly value="<?php echo $s_calle;?>">
          </td>
          <td class='col-md-6 p-0'>
            <input class="border-0 bt text-center w-100" type="text" id="T_Proveedor_Destinatario" value="<?php echo $nomProv;?>" readonly>
          </td>
        </tr>
        <tr class="row">
          <td class="col-md-2 p-0 text-right b"> <b># Ext :</b></td>
          <td class="text-left p-0">
            <input class="h22 border-0 bt" id="T_Cliente_No_Ext" type="text" readonly value="<?php echo $s_no_ext;?>" size="5">
          </td>
          <td class="text-right p-0 b"><b># Int :</b></td>
          <td class="col-md-2 text-left p-0">
            <input class="h22 border-0 bt" id="T_Cliente_No_Int" type="text" readonly value="<?php echo $s_no_int;?>" size="25">
          </td>
        </tr>
        <tr class='row'>
          <td class="col-md-2 text-right b p-0"><b>Colonia :</b></td>
          <td class='col-md-4 p-0 text-left'>
            <input class="h22 border-0 bt" id="T_Cliente_Colonia" type="text" readonly value="<?php echo $s_colonia;?>">
          </td>
        </tr>
        <tr class='row'>
          <td class="col-md-2 p-0 b text-right"><b>Ciudad/Estado :</b> </td>
          <td class='col-md-3 p-0 text-left'>
            <input class="h22 border-0 bt" id="T_Cliente_Estado" type="text" readonly value="<?php echo $s_estado;?>">,
            <input class="h22 border-0 bt text-left p-0" id="T_Cliente_Ciudad" type="text" readonly value="<?php echo $s_ciudad;?>">
          </td>
        </tr>
        <tr class="row">
          <td class="col-md-2 p-0 b text-right"><b>País :</b></td>
          <td class="col-md-4 p-0 text-left">
            <input  type="text" class="h22 border-0 bt" id="T_Cliente_Pais" value="<?php echo $s_pais; ?>">
          </td>
        </tr>
        <tr class="row">
          <td class="col-md-2 p-0 b text-right"><b>CP :</b></td>
          <td class="p-0 text-left">
            <input class="h22 border-0 bt" id="T_Cliente_CP" type="text" readonly value="<?php echo $s_codigo;?>" size="6"></td>
          </td>
          <td class="p-0 b text-right"><b>Tax ID :</b></td>
          <td class="col-md-1 p-0 text-left">
            <input type="text" class="h22 border-0 bt" id="T_Cliente_taxid" value="<?php echo $s_taxid; ?>">
          </td>
        </tr>
        <tr class="row">
          <td class="col-md-2 p-0 b text-right"><b>RFC :</b></td>
          <td class="col-md-4 p-0 text-left">
            <input class="h22 border-0 bt" id="T_Cliente_RFC" type="text" readonly onchange="validarRFCfac(this);" value="<?php echo $s_rfc;?>">
          </td>
        </tr>
      </tbody>
    </table>
  </div>



  <div id='InfoPagos' class='contorno' style='display:none'>
    <h5 class='titulo font16'>INFO GENERAL</h5>
    <table class='table mt-5' id='eInfo'>
      <thead>
        <tr class='row encabezado font16'>
          <td class='col-md-12 p-0'>INFORMACION DEL USUARIO</td>
        </tr>
        <tr class="row sub3 font12 b" style="background-color:rgba(173, 173, 173, 0.1)!important">
          <td class="col-md-3 p-1"></td>
          <td class="col-md-3 p-1">Póliza</td>
          <td class="col-md-3 p-1">Usuario</td>
          <td class="col-md-3 p-1">Fecha</td>
        </tr>
      </thead>
      <tbody class='font14 text-center'>
        <tr class="row">
          <td class="p-1 col-md-3 text-left b"><b>Generada <?php #echo $pk_id_cuenta_captura; ?></b> </td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3">
            <input class="h22 bt border-0 text-center" type="text" id="T_Usuario" size="20"value="<?php #echo $fk_usuario; ?>" readonly>
          </td>
          <td class="p-1 col-md-3">
            <input class="h22 bt border-0 text-center" type="text" id="T_Fecha_Cta" size="20" value="<?php #echo date_format(date_create($d_fecha_cta),"d-m-Y h:i:s");?>" readonly>
          </td>
        </tr>

        <tr class="row b">
          <td class="p-1 col-md-3 text-left b"><b>Modificada</b> </td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"><?php #echo $s_usuario_modifi; ?></td>
          <td class="p-1 col-md-3"><?php #echo $d_fecha_modifi; ?></td>
        </tr>
        <tr class="row b">
          <td class="p-1 col-md-3 text-left b"><b>Pago generado</b> </td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"></td>
        </tr>
        <tr class="row b borderojo">
          <td class="p-1 col-md-3 text-left b"><b></b> </td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id='folioSustituir' class='contorno' style='display:none'>
    <h5 class='titulo font16'>Folio a Sustituir</h5>
    <table class='table'>
      <thead>
        <tr class='row encabezado font16'>
          <td class="col-md-4 p-1">Sustituye al pago</td>
          <td class="col-md-4 p-1">UUID</td>
          <td class="col-md-4 p-1">Tipo de relación</td>
        </tr>
      </thead>
      <tbody class='font14 text-center'>
        <tr class="row">
          <td class="p-1 col-md-4"><input class="h22 bt border-0 efecto" type="text" id="idPago_sust" size="20" value="" readonly></td>
          <td class="p-1 col-md-4"><input class="h22 bt border-0 efecto" type="text" id="uuid_sust" size="20" value="" readonly></td>
          <td class="p-1 col-md-4"><input class="h22 bt border-0 efecto" type="text" id="tipoRel_sust" size="20" value="" readonly></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="pagosMismaFact" class='contorno' style="display:none">
    <table class='table'>
      <thead>
        <tr class='row encabezado font14'>
          <td class="col-md-12">PAGOS DE LA MISMA FACTURA</td>
        </tr>
        <tr class="row font12 b sub3" style="background-color:rgba(173, 173, 173, 0.1)!important">
          <td class="col-md-1 p-1">fecha UUID</td>
          <td class="col-md-1 p-1">No.Pago</td>
          <td class="col-md-1 p-1">Parcialidad</td>
          <td class="col-md-1 p-1">Póliza</td>
          <td class="col-md-1 p-1">no.Doc.Pago</td>
          <td class="col-md-1 p-1">FacturaR</td>
          <td class="col-md-1 p-1">Sust.Pago</td>
          <td class="col-md-1 p-1">Fecha</td>
          <td class="col-md-1 p-1">Pol.Cancela</td>
          <td class="col-md-1 p-1">Saldo Anterior</td>
          <td class="col-md-1 p-1">Importe Pagado</td>
          <td class="col-md-1 p-1">Saldo Insoluto</td>

        </tr>
      </thead>
      <tbody class='font14 text-center'>
        <tr class="row borderojo">
          <td class="col-md-1"></td>
          <td class="col-md-1"></td>
          <td class="col-md-2"></td>
          <td class="col-md-1"></td>
          <td class="col-md-1"></td>
          <td class="col-md-1"></td>
          <td class="col-md-2"></td>
          <td class="col-md-1"></td>
          <td class="col-md-2"></td>
        </tr>
      </tbody>
    </table>
  </div>


  <!--div class='contorno'>
  </div-->

  <div class="contorno mt-5">
    <h5 class='titulo font16'>Captura</h5>

    <table class='table '>
      <thead>
        <tr class='row encabezado font14'>
          <td class="col-md-12">Captura detalle de pago</td>
        </tr>
        <tr class="row backpink justify-content-center">
          <td class="col-md-3 p-1"><span>*</span> Fecha y Hr.</td>
          <td class="col-md-2 p-1"><span>*</span> Forma de Pago</td>
          <td class="col-md-1 p-1"># Autorización</td>
          <td class="col-md-2 p-1"><span>*</span> Moneda</td>
          <td class="col-md-1 p-1"><span>*</span> Tipo de Cambio</td>
          <td class="col-md-1 p-1"><span>*</span> Importe</td>
          <td class="col-md-1 p-1">&nbsp;</td>
          <td class="col-md-1 p-1 pl-3"></td>
        </tr>
      </thead>
      <tbody class='font14 text-center'>
        <tr class="row borderojo pb-3 mt-3 justify-content-center">
          <td class="col-md-2 p-1">
            <input type="date" class="efecto h22" id="fecha" size="10">
          </td>
          <td class="col-md-1 p-1">
            <input type="time" class="efecto h22" id="hora" min="12:00">
          </td>
          <td class="col-md-2 p-1">
            <select id="Lst_formaPago" class="custom-select-s">
              <?php echo $datosCLTformaPago; ?>
            </select>
          </td>
          <td class="col-md-1 p-1">
            <input type="text" class="efecto h22" id="Txt_numOper">
          </td>
          <td class="col-md-2 p-1">
            <select class="custom-select-s" name="select2" id="lst_moneda" onchange="asignarMonedaPago()">
              <?php echo $consultaMoneda; ?>
            </select>
          </td>
          <td class="col-md-1 p-1">
            <input type="text" id="T_monedaTipoCambio" class="efecto h22" onchange=""="validaIntDec(this);" value="1" />
          </td>
          <td class="col-md-1 p-1">
            <input class="efecto h22" type="text" id="T_importe" value="0" onchange="buscarNumeroCuentaBanco('<?php echo $id_cliente; ?>')">
          </td>
          <td class="col-md-1 p-1">&nbsp;</td>
          <td class="col-md-1 p-1 pl-3">
            <a href="#" id="Btn_agregarPago" onclick="Btn_agregarPago()"><img class="icochico" src="/conta6/Resources/iconos/001-add.svg"></a>
          </td>
        </tr>

        <tr class="row sub2 mt-3">
          <td class="p-1 col-md-1 ls1">RFC Emisor</td>
          <td class="p-1 col-md-3">Cuenta Emisor (min 10 dig.)</td>
          <td class="p-1 col-md-3">Banco Emisor Extranjero</td>
          <td class="p-1 col-md-1 ls1">RFC Receptor</td>
          <td class="p-1 col-md-4">Cuenta (min 10 dig)</td>
        </tr>
        <tr class="row font12">
          <td class="col-md-1 p-1">
            <input class="efecto h22 p-0" type="text" id="T_RFCemisor" value="<?php echo $s_rfc;?>" readonly>
          </td>
          <td class="col-md-3 p-1">
            <select class="custom-select-s" size='1' id='Lst_cuentaPago'>
              <option selected value='0'>Seleccione Banco</option>
            </select>
          </td>
          <td class="col-md-3 p-1">
            <input class="efecto h22" type="text" id="T_nomBancoExt" onchange="eliminaBlancosIntermedios(this);validarStringSAT(this);">
          </td>
          <td class="col-md-1 p-1">
            <input class="efecto h22 p-0" type="text" id="T_RFCreceptor" value="<?php echo $rfcCIA; ?>" readonly>
          </td>
          <td class="col-md-4 p-1">
            <select class="custom-select-s" id="lst_bancoCIA">
              <option value="0">Bancos PLAA</option>
              <?php echo $ctasCIA; ?>
            </select>
          </td>
        </tr>


        <tr class="row sub2 mt-3">
          <td class="col-md-3 p-1">Tipo Cadena</td>
          <td class="col-md-3 p-1">Certificado</td>
          <td class="col-md-3 p-1">Cadena Original</td>
          <td class="col-md-3 p-1">Sello</td>
        </tr>
        <tr class="row font12">
          <td class="col-md-3">
            <select class="custom-select-s" id="Lst_tipoCadena">
              <option value="">Tipo Cadena</option>
			        <option value="01">SPEI</option>
            </select>
          </td>
          <td class="col-md-3"><input class="efecto h22" type="text" id="Txt_cert"></td>
          <td class="col-md-3"><input class="efecto h22" type="text" id="Txt_cadOrig"></td>
          <td class="col-md-3"><input class="efecto h22" type="text" id="Txt_sello"></td>
        </tr>
      </tbody>
    </table>

    <table class='table'>
      <thead>
        <tr class='row encabezado font14'>
          <td class="col-md-12">Datos de Factura Electronica
          <a href="#buscar_factura" data-toggle="modal"><img class='icochico' src='/conta6/Resources/iconos/magnifier.svg' /></a></td>
        </tr>
        <tr class="row sub3 b font12" style="background-color:rgba(173, 173, 173, 0.1)!important">
          <td class="col-md-1 p-1">Aduana</td>
          <td class="col-md-1 p-1">Referencia</td>
          <td class="col-md-2 p-1">UUID</td>
          <td class="col-md-1 p-1">Factura</td>
          <td class="col-md-1 p-1">Moneda</td>
          <td class="col-md-1 p-1">Tipo Cambio</td>
          <td class="col-md-2 p-1">Total Honorarios</td>
          <td class="col-md-1 p-1">Metodo Pago</td>
          <td class="col-md-2 p-1">Numero de Parcialidad</td>
        </tr>
      </thead>
      <tbody class='font14 text-center'>
        <tr class="row borderojo text-center">
          <td class="col-md-1">
            <input class="h22 bt border-0 efecto" type="text" id="aduana_DR" size="20" value="<?php echo $fk_id_aduana; ?>" readonly>
          </td>
          <td class="col-md-1">
            <input class="h22 bt border-0 efecto" type="text" id="referencia_DR" size="20" value="<?php echo $fk_referencia; ?>" readonly>
          </td>
          <td class="col-md-1">
            <input class="h22 bt border-0 efecto" type="text" id="UUID_DR" size="20" value="<?php echo $s_UUID; ?>" readonly>
          </td>
          <td class="col-md-2">
            <input class="h22 bt border-0 efecto" type="text" id="factura_DR" size="20" value="<?php echo $pk_id_factura; ?>" readonly>
          </td>
          <td class="col-md-1">
            <input class="h22 bt border-0 efecto" type="text" id="moneda_DR" size="20" value="<?php echo $fk_id_moneda; ?>" readonly>
          </td>
          <td class="col-md-1">
            <input class="h22 bt border-0 efecto" type="text" id="tipoCambio_DR" size="20" value="<?php echo $n_tipoCambio; ?>" readonly>
          </td>
          <td class="col-md-2">
            <input class="h22 bt border-0 efecto" type="text" id="totalHon_DR" size="20" value="<?php echo $n_total_gral; ?>" readonly>
          </td>
          <td class="col-md-1">
            <input class="h22 bt border-0 efecto" type="text" id="metPago_DR" size="20" value="<?php echo $fk_c_MetodoPago; ?>" readonly>
          </td>
          <td class="col-md-2">
            <input class="h22 bt border-0 efecto" type="text" id="parcialidad" size="20" value="<?php echo $parcialidad; ?>" readonly>
          </td>
        </tr>
        <tr class='row mt-4 sub2'>
          <th class='col-md-1 pt-2'>Saldo Anterior</th>
          <td class='col-md-2'>
            <input class="efecto h22" type="text" id="T_saldoAnterior" size="10" onBlur="validaIntDec(this);suma_saldoInsoluto();" value="<?php echo $n_total_gral; ?>" <?php if( $oRst_permisos["s_rPgo_editSaldoAnterior"] == 0){ echo "readonly"; }?>>
          </td>
          <th class='col-md-1 pt-2'>Importe Pagado</th>
          <td class='col-md-2'>
            <input class="efecto h22" id="T_importePagado" onchange="validaIntDec(this);calculaDepIVA()" type="text" size="10" value="0">
          </td>
          <th class='col-md-1 pt-2'>IVA</th>
          <td class='col-md-2'>
            <input class="efecto h22" type="text" id="T_iva" onchange="validaIntDec(this)" value="0" readonly>
            <input class="efecto h22" type="hidden" id="T_deposito" value="0">
          </td>
          <th class='col-md-1 pt-2'>Saldo Insoluto</th>
          <td class='col-md-2'>
            <input class="efecto h22" type="text" id="T_saldoInsoluto" size="10" onBlur="validaIntDec(this);" value="0" readonly>
          </td>
        </tr>
      </tbody>
    </table>

  </div>

  <div class="contorno mt-5" >
    <form onsubmit="return false">
      <table class='table'>
        <thead>
          <tr class='row m-0 mt-4 sub2'>
            <th class='col-md-12 p-1 font14'>Detalle de Pagos</th>
          </tr>
        </thead>
        <tbody id="tbodyPagos">
        </tbody>
      </table>
    </form>
  </div>


  </div>
  <div class="row justify-content-center" style="margin-bottom:100px!important">
    <div class="col-md-3">
      <input class="efecto boton" type='button' value="GUARDAR" id="guardar-pago" />
    </div>
  </div>

<!--/div-->

<?php
require_once('modales/buscar_factura.php');
require $root . '/conta6/Ubicaciones/footer.php';?>
