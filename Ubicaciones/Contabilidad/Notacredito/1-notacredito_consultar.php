<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';

  $cuenta = trim($_GET['cuenta']);
  $accion = trim($_GET['accion']);
  $txt_id_asoc = 'No';

  require $root . '/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosGenerales.php';
  require $root . '/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosEmbarque.php'; #$datosEmbarqueModifi
  require $root . '/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosPOCME.php'; # $datosPOCMEmodifi
  require $root . '/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosCargos.php'; #$datosCargosModifi
  require $root . '/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosHonorarios.php'; #$datosHonorariosModifi
  require $root . '/Ubicaciones/Contabilidad/Notacredito/actions/consultarCapturaCuenta_datosDepositos.php'; #$datosDepositos

  $id_captura = $cuenta;
  require $root . '/Resources/PHP/actions/consultaNotaCreditoTimbrada.php';
  if( $rows_facTimbrada == 0 ){
    $s_UUID = '';
    $id_factura = '';
    $id_poliza = '';
    $s_UUID = '';
    $usuario_timbra = '';
    $fechaTimbre = '';

    $s_cancela_factura = '';
    $fechaTimbreCancela = '';
    $usuario_Cancela = '';
    $s_selloSATcancela = '';
  }



  #if( $s_UUID == '' && $oRst_permisos['CFDI_NC_generar'] && $accion == 'consultar' ){
  if( $s_UUID == '' && $oRst_permisos['s_NC_timbrar'] && $accion == 'timbrar' ){
      if( $fk_c_MetodoPago == 'PPD' && $fk_id_formapago != 99 ){
        $hrefTimbrar = "Error: Para método de pago 'PPD' use forma de pago '99'";
      }elseif( $fk_id_formapago == 'No Identificado' ){
          $hrefTimbrar = "Error: Use forma de pago 99";
        }elseif( ($fk_id_formapago == '02' || $fk_id_formapago == '03') && $s_numCtaPago == "" ){
            $hrefTimbrar = "Error: Asigne un número de cuenta bancaria";
          }elseif( $n_total_gral_importe <= 0 ){
              $hrefTimbrar = "Error: Es requerido cobro de honorarios";
            }else{
              $hrefTimbrar = "<a href='#' class='ml-4' onclick='timbrarNC($cuenta,&#39;$fk_referencia&#39;,&#39;$fk_id_cliente&#39;)'>
                <img class='icomediano' src='/Resources/iconos/timbrar.svg'>
              </a>";
            }
  }

  if( $s_UUID != '' && $s_selloSATcancela == '' && $accion == 'cancelar'){
    if( $fk_id_aduana == $aduana ){
      if( $oRst_permisos['s_NC_cancelarLibre'] == 1 ){

      }else if( $oRst_permisos['s_NC_cancelar'] == 1 ){

      }

      if( $fk_c_MetodoPago == 'PPD' && $fk_id_formapago != 99 ){
        $hrefTimbrar = "Error: Para método de pago 'PPD' use forma de pago '99'";
      }elseif( $fk_id_formapago == 'No Identificado' ){
          $hrefTimbrar = "Error: Use forma de pago 99";
        }elseif( ($fk_id_formapago == '02' || $fk_id_formapago == '03') && $s_numCtaPago == "" ){
            $hrefTimbrar = "Error: Asigne un número de cuenta bancaria";
          }elseif( $n_total_gral_importe <= 0 ){
              $hrefTimbrar = "Error: Es requerido cobro de honorarios";
            }else{
              $hrefTimbrar = "<a href='#' class='ml-4' onclick='timbrarNC($cuenta,&#39;$fk_referencia&#39;,&#39;$fk_id_cliente&#39;)'>
                <img class='icomediano' src='/Resources/iconos/timbrar.svg'>
              </a>";
            }
    }


  }
  require $root . '/Ubicaciones/Contabilidad/Notacredito/actions/consultarEstadoCFDI_notacredito.php'; #$datosEdoCancela
?>

<div class="text-center">
  <div class="row backpink m-0">
    <div class="col-md-4" role="button">
      <a  id="submenuMed" class="visualizar" accion="Ver-cliente" status="cerrado">DATOS CLIENTE</a>
    </div>
    <div class="col-md-4">
      <a id="submenuMed" class="visualizar" accion="Ver-iEmbarque" status="cerrado">INFO. DEL EMBARQUE</a>
    </div>
    <div class="col-md-4">
      <a id="submenuMed" class="visualizar" accion="Ver-iUsuario" status="cerrado">INFO. GENERAL</a>
    </div>
  </div>

  <div class="col-md-12 p-3 text-left">
    <?php if( $accion == 'consulta' ){ ?>
    <a href="/Ubicaciones/Contabilidad/Notacredito/1-notacredito.php">
      <img class="icomediano" src="/Resources/iconos/left.svg">
    </a>
    <a href='#' class="ml-4" onclick='imprimeProfNC(<?php echo $cuenta; ?>)'>
      <img class='icomediano ml-2' src='/Resources/iconos/printer.svg'>
    </a>
    <?php } ?>

    <?php if( $accion == 'timbrar' ){ ?>
    <a href="/Ubicaciones/Contabilidad/Notacredito/1-notacredito.php">
      <img class="icomediano" src="/Resources/iconos/left.svg">
    </a>
    <a href="#" class="ml-4" onclick='imprimeProfNC(<?php echo $cuenta ?>)'>
      <img class="icomediano" src="/Resources/iconos/printer.svg">
    </a>
    <?php echo $hrefTimbrar; } ?>
  </div>

  <div class="contorno b font12" id="detalleCliente" style="display:none">
    <div class="row encabezado font16">
      <div class="col-md-12"><?php echo $fk_id_cliente.' '.$s_nombre;?></div>
    </div>
    <div class="row backpink font14">
      <div class="col-md-6">Dirección</div>
      <div class="col-md-6">Proveedor</div>
    </div>
    <div class="row">
      <div class="col-md-3 text-right">Calle :</div>
      <div class="col-md-3 text-left p-0"><?PHP echo $s_calle; ?></div>

      <div class="col-md-3 text-right">Nombre :</div>
      <div class="col-md-3 text-left p-0"><?PHP echo $s_proveedor_destinatario; ?></div>
    </div>
    <div class="row">
      <div class="col-md-3 text-right">Num. Ext / Int :</div>
      <div class="col-md-3 text-left p-0"><?PHP echo $s_no_ext.' / '.$s_no_int; ?></div>
    </div>
    <div class="row">
      <div class="col-md-3 text-right">Colonia :</div>
      <div class="col-md-3 text-left p-0"><?PHP echo $s_colonia; ?></div>
    </div>

    <div class="row">
      <div class="col-md-3 text-right">Ciudad / Estado :</div>
      <div class="col-md-3 text-left p-0"><?PHP echo $s_ciudad.', '.$s_estado; ?></div>
    </div>

    <div class="row">
      <div class="col-md-3 text-right">CP :</div>
      <div class="col-md-3 text-left p-0"><?PHP echo $s_codigo; ?></div>
    </div>
    <div class="row">
      <div class="col-md-3 text-right">Pais :</div>
      <div class="col-md-3 text-left p-0"><?PHP echo $s_pais; ?></div>
    </div>

    <div class="row">
      <div class="col-md-3 text-right">RFC :</div>
      <div class="col-md-3 text-left p-0"><?PHP echo $s_rfc; ?></div>
    </div>
    <div class="row">
      <div class="col-md-3 text-right">TAX ID :</div>
      <div class="col-md-3 text-left p-0"><?PHP echo $s_taxid; ?></div>
    </div>
  </div>

  <div id="detalleEmbarque" class="contorno font12 b" style="display:none">
    <div class="row encabezado font16">
      <div class="col-md-12">INFORMACIÓN GENERAL</div>
    </div>
    <div class="row backpink font14">
      <div class="col-md-4">Aduana</div>
      <div class="col-md-4">Solicitud</div>
      <div class="col-md-4">Fecha</div>
    </div>
    <div class="row borderojo">
      <div class="col-md-4"><?php echo $fk_id_aduana; ?></div>
      <div class="col-md-4"><?php echo	$pk_id_cuenta_captura; ?></div>
      <div class="col-md-4"><?php echo date_format(date_create($d_fecha_cta),"d-m-Y"); ?></div>
    </div>
    <?php echo $datosEmbarque; ?>
  </div>

  <div id="detalleUsuario" class="contorno b font12" style="display:none">
  <table class='table mt-5' id='eInfo'>
    <thead>
      <tr class='row encabezado font16'>
        <td class='col-md-12 p-0'>INFORMACION DEL USUARIO</td>
      </tr>
      <tr class="row backpink">
        <td class="col-md-3"></td>
        <td class="col-md-3">Póliza</td>
        <td class="col-md-3">Usuario</td>
        <td class="col-md-3">Fecha</td>
      </tr>
    </thead>
    <tbody class='font14'>
      <tr class="row">
        <td class="p-1 col-md-3 text-left"> Solicitud generada: <?php echo '<b>'.$pk_id_cuenta_captura.'</b>'; ?></td>
        <td class="p-1 col-md-3"></td>
        <td class="p-1 col-md-3"><?php echo $fk_usuario; ?></td>
        <td class="p-1 col-md-3"><?php echo $d_fecha_cta;?></td>
      </tr>
      <tr class="row">
        <td class="p-1 col-md-3 text-left"> Solicitud modificada</td>
        <td class="p-1 col-md-3"></td>
        <td class="p-1 col-md-3"><?php echo $s_usuario_modifi; ?></td>
        <td class="p-1 col-md-3"><?php echo $d_fecha_modifi; ?></td>
      </tr>
      <tr class="row">
        <td class="p-1 col-md-3 text-left"> Nota crédito generada: <?php echo '<b>'.$id_factura.'</b> --- '.$s_UUID; ?></td>
        <td class="p-1 col-md-3"><?php echo $id_poliza; ?></td>
        <td class="p-1 col-md-3"><?php echo $usuario_timbra; ?></td>
        <td class="p-1 col-md-3"><?php echo $fechaTimbre; ?></td>
      </tr>
      <tr class="row">
        <td class="p-1 col-md-3 text-left"> Nota crédito cancelada</td>
        <td class="p-1 col-md-3"></td>
        <td class="p-1 col-md-3"><?php echo $usuario_Cancela; ?></td>
        <td class="p-1 col-md-3"><?php echo $fechaTimbreCancela; ?></td>
      </tr>
    </tbody>
  </table>
</div>

<!--Esta informacion si estara visible SOLICITUD-->
<?php
if( $s_UUID != '' ){ ?>
<div class="contorno">
  <h5 class="titulo w2 font14 b">ESTADO DEL COMPROBANTE</h5>

  <div class="row encabezado mt-2 m-0 font14">
    <div class="col-md-4">Total Nota Crédito</div>
    <div class="col-md-2">Estado</div>
    <div class="col-md-2">Es cancelable</div>
    <div class="col-md-2">Estatus</div>
    <div class="col-md-2">Fecha</div>
  </div>
  <div class="divisor">
    <div class='row b font12 ls1'>
      <div class='col-md-4 text-center'>$ <?php echo number_format($n_total_gral,2,'.',','); ?></div>
      <div class='col-md-2'>Vigente</div>
      <div class='col-md-2'></div>
      <div class='col-md-2'></div>
      <div class='col-md-2'><?php echo $fechaTimbre; ?></div>
    </div>

    <?php
    if( $s_selloSATcancela == '' ){
        $fechaTimbrado = date_format(date_create($fechaTimbre),"Y-m-d");
        $fechaActual = date("Y/m", time());
        $fechaActual2 = date("Y/m/d h:m:s", time());
        $txt_evaluar = evaluarCancelarNC($fechaTimbrado,$n_total_gral);
        $hrefcancela = "<a href='#' onclick='cancelarNC($id_factura)'><img class='icoxs' src='/Resources/iconos/cross.svg'>$txt_evaluar</a>";

      if( $total_estadoCancela == 0 ){
        echo "
          <div class='row b font12 ls1'>
            <div class='col-md-4 text-center'></div>
            <div class='col-md-2'>Vigente</div>
            <div class='col-md-2'>$hrefcancela</div>
            <div class='col-md-2'></div>
            <div class='col-md-2'>$fechaActual2</div>
          </div>";
      }
      echo $datosEdoCancela;
    } ?>


  </div>
</div>
<?php } ?>

<div class="contorno" style="<?php echo $marginbottom ?>">
  <h5 class="titulo font14 b">NOTA DE CRÉDITO</h5>
  <div class="row encabezado font14 m-0">
    <div class="col-md-6">PAGOS O CARGOS EN USD</div>
    <div class="col-md-2 offset-md-2">IMPORTE</div>
    <div class="col-md-2">SUBTOTAL</div>
  </div>
  <div class="divisor">
    <?php echo $datosPOCME; ?>
    <div class="row font12 b sub2 m-0 mt-3" style="font-size:14px!important">
      <div class="col-md-2 text-right">Total :</div>
      <div class="col-md-2 text-left"><?php echo number_format($n_POCME_total_gral,2,'.',','); ?></div>
      <div class="col-md-2 text-right">Tipo de Cambio:</div>
      <div class="col-md-2 text-left"><?php echo $n_POCME_tipo_cambio ?></div>
      <div class="col-md-2 text-right">Total MN:</div>
      <div class="col-md-2 text-left">$<?php echo number_format($n_POCME_total_MN,2,'.',','); ?></div>
    </div>
  </div>


  <div class="row mt-5 encabezado font14 m-0">
    <div class="col-md-6">PAGOS POR CUENTA DEL CLIENTE</div>
    <div class="col-md-4"></div>
    <div class="col-md-2">SUBTOTAL</div>
  </div>
  <div class="divisor">
    <div class='row b font12'>
			<div class='col-md-6 text-left ls1'>Impuestos Afianzados o Subsidiados</div>
			<div class='col-md-4'></div>
			<div class='col-md-2'>$ <?php echo $n_total_subsidiado; ?></div>
		</div>
    <?php echo $datosCargos; ?>
  </div>


  <div class="row encabezado mt-5 m-0 font14">
    <div class="col-md-4">HONORARIOS Y SERVICIOS</div>
    <div class="col-md-2">IMPORTE</div>
    <div class="col-md-2">IVA</div>
    <div class="col-md-2">RET</div>
    <div class="col-md-2">SUBTOTAL</div>
  </div>
  <div class="divisor">
    <?php echo $datosHonorarios; ?>
  </div>

  <div class="contorno m-0 mt-5">
    <!-- <table class="table w-100">
     <tr align="center">
       <td class="col-md-12 backpink" colspan="6">Concepto General en la Nota de Crédito</td>
     </tr>
     <tr bgcolor="#C0C0C0" align="center">
       <td class="w-16">Cantidad</td>
       <td class="w-16">Cve. Unidad</td>
       <td class="w-16">cveServProd</td>
       <td class="w-20">Descripción</td>
       <td class="w-16">Valor Unitario</td>
       <td class="w-16">Importe</td>
     </tr>
     <tr align="center">
       <td><input class="efecto h22" type="text" id="T_cantidadNC" size="15" value="<?php echo $n_cantidadNC; ?>" readonly /></td>
       <td><input class="efecto h22" type="text" id="T_cveUnidadNC" size="15" value="<?php echo $fk_cveUnidadNC; ?>" readonly /></td>
       <td><input class="efecto h22" type="text" id="T_cveProdNC" size="15" value="<?php echo $fk_c_ClaveProdServ; ?>" readonly /></td>
       <td><input class="efecto h22" type="text" id="T_descripNC" size="60" maxlength="60" value="<?php echo $s_descripNC; ?>" readonly></td>
       <td><input class="efecto h22" type="text" id="T_valorUnitNC" class="T_valorUnitNC" size="20" value="<?php echo $n_valorUnitNC;?>" readonly></td>
       <td><input class="efecto h22" type="text" id="T_importeNC" class="T_importeNC" size="20" value="<?php echo $n_importeNC;?>" readonly></td>
     </tr>
     <tr align="center">
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr bgcolor="#C0C0C0" align="center">
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>Factura</td>
       <td>CFDI Relacionado </td>
       <td>Total</td>
       <td>&nbsp;</td>
       </tr>
     <tr align="center">
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><input class="efecto h22" type="text" id="T_idFactura" size="14" value="<?php echo $id_factura;?>" readonly></td>
       <td><input class="efecto h22" type="text" id="T_UUIDFactura" size="60" value="<?php echo $s_UUID;?>" readonly></td>
       <td><input class="efecto h22" type="text" id="T_totalFactura" size="20" value="<?php echo $n_total_factura;?>" readonly /></td>
       <td>&nbsp;</td>
       </tr>
   </table> -->



     <div class="row backpink">
       <div class="col-md-12">Concepto General en la Nota de Crédito</div>
     </div>
     <div class="row sub2 p-1">
       <div class="col-md-1">Cantidad</div>
       <div class="col-md-2">Cve. Unidad</div>
       <div class="col-md-1">cveServProd</div>
       <div class="col-md-5">Descripción</div>
       <div class="col-md-2">Valor Unitario</div>
       <div class="col-md-1">Importe</div>
     </div>

     <div class="row mt-3">
       <div class="col-md-1 p-0">
         <input class="efecto h22" type="text" id="T_cantidadNC" size="15" value="<?php echo $n_cantidadNC; ?>" readonly />
       </div>
       <div class="col-md-2">
         <input class="efecto h22" type="text" id="T_cveUnidadNC" size="15" value="<?php echo $fk_cveUnidadNC; ?>" readonly />
       </div>
       <div class="col-md-1 p-0">
         <input class="efecto h22" type="text" id="T_cveProdNC" size="15" value="<?php echo $fk_c_ClaveProdServ; ?>" readonly /></div>
       <div class="col-md-5">
         <input class="efecto h22" type="text" id="T_descripNC" size="60" maxlength="60" value="<?php echo $s_descripNC; ?>" readonly>
       </div>
       <div class="col-md-2">
         <input class="efecto h22" type="text" id="T_valorUnitNC" class="T_valorUnitNC" size="20" value="<?php echo $n_valorUnitNC;?>" readonly>
       </div>
       <div class="col-md-1 p-0">
         <input class="efecto h22" type="text" id="T_importeNC" class="T_importeNC" size="20" value="<?php echo $n_importeNC;?>" readonly>
       </div>
     </div>

     <div class="row sub2 p-1 justify-content-center mt-5">
       <div class="col-md-1">Factura</div>
       <div class="col-md-5">CFDI Relacionado </div>
       <div class="col-md-1">Total</div>
     </div>

     <div class="row justify-content-center mt-3">
       <div class="col-md-1">
         <input class="efecto h22" type="text" id="T_idFactura" size="14" value="<?php echo $id_factura;?>" readonly>
       </div>
       <div class="col-md-5">
         <input class="efecto h22" type="text" id="T_UUIDFactura" size="60" value="<?php echo $s_UUID;?>" readonly>
       </div>
       <div class="col-md-1">
         <input class="efecto h22" type="text" id="T_totalFactura" size="20" value="<?php echo $n_total_factura;?>" readonly>
       </div>
     </div>
  </div>

  <div class="row encabezado m-0 mt-5 font14">
    <div class="col-lg-4">
      <div class="row">
        <div class="col-md-12">MÉTODO DE PAGO</div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-md-12">DEPÓSITOS</div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="row">
        <div class="col-md-9">CONCEPTO</div>
        <div class="col-md-3 pl-0">TOTALES</div>
      </div>
    </div>
  </div>
  <div class="row divisor font12 b ls1 m-0">
    <div class="col-lg-4">
      <div class="row">
        <div class="col-md-6 text-right">Método de pago :</div>
        <div class="col-md-6 text-left"><?php echo $fk_c_MetodoPago; ?></div>
      </div>
      <div class="row">
        <div class="col-md-6 text-right">Forma de pago :</div>
        <div class="col-md-6 text-left"><?php echo $fk_id_formapago.' '.$s_numCtaPago; ?></div>
      </div>
      <div class="row">
        <div class="col-md-6 text-right">Moneda :</div>
        <div class="col-md-6 text-left"><?php echo $fk_id_moneda; ?></div>
      </div>
      <div class="row">
        <div class="col-md-6 text-right">Tipo Cambio :</div>
        <div class="col-md-6 text-left"><?php echo $n_tipoCambio; ?></div>
      </div>
      <div class="row">
        <div class="col-md-6 text-right">Uso de CFDI :</div>
  		  <div class="col-md-6 text-left"><?php echo $pk_c_UsoCFDI; ?></div>
      </div>
      <div class="row">
        <div class="col-md-6 text-right">CUSTOMS :</div>
        <div class="col-md-6 text-left"><?php echo $txt_id_asoc; ?></div>
      </div>
    </div>

    <div class="col-lg-4">
      <?php echo $datosDepositos; ?>
    </div>



    <div class="col-lg-4">
      <div class="row">
        <div class="col-md-9 text-right"><?php echo $s_txt_gral_importe; ?></div>
        <div class="col-md-3">$ <?php echo $n_total_gral_importe; ?></div>
      </div>

      <div class="row">
        <div class="col-md-9 text-right"><?php echo $n_txt_gral_IVA; ?></div>
        <div class="col-md-3">$ <?php echo $n_total_gral_IVA; ?></div>
      </div>

      <div class="row">
        <div class="col-md-9 text-right"><?php echo $s_txt_total_honorarios; ?></div>
        <div class="col-md-3">$ <?php echo $n_total_honorarios; ?></div>
      </div>
  		<div class="row">
        <div class="col-md-9 text-right"><?php echo $s_txt_fac_IVA_retenido; ?></div>
        <div class="col-md-3">$ <?php echo $s_fac_IVA_retenido; ?></div>
      </div>
      <div class="row">
        <div class="col-md-9 text-right"><?php echo $s_txt_total_gral; ?></div>
        <div class="col-md-3">$ <?php echo $n_total_gral; ?></div>
      </div>
  		<div class="row">
        <div class="col-md-9 text-right ls0"><?php echo $s_POCME_descripcion_gral; ?></div>
        <div class="col-md-3">$ <?php echo $n_total_POCME; ?></div>
      </div>
  		<div class="row">
        <!-- <div class="col-md-9"></div> -->
        <div class="col-md-9 text-right"><?php echo $s_txt_total_pagos; ?></div>
        <div class="col-md-3">$ <?php echo $n_total_pagos; ?></div>
      </div>
  		<div class="row">
        <!-- <div class="col-md-9"></div> -->
        <div class="col-md-9 text-right"><?php echo $s_txt_cta_gastos; ?></div>
        <div class="col-md-3">$ <?php echo $n_total_cta_gastos; ?></div>
      </div>
      <div class="row">
        <div class="col-md-9 text-right"><?php echo $s_txt_total_depositos; ?></div>
        <div class="col-md-3">$ <?php echo $n_total_depositos; ?></div>
      </div>
  		<div class="row">
        <!-- <div class="col-md-9"></div> -->
        <div class="col-md-9 text-right"><?php echo $s_txt_fac_saldo; ?></div>
        <div class="col-md-3">$ <?php echo $n_fac_saldo; ?></div>
      </div>
    </div>
  </div>

  </div>

</div>

<!--script src="js/facturaElectronica.js"></script-->
<?php
function evaluarCancelarNC($d_fechaTimbrado,$n_total_gral){
	#falta validar que no tenga NotaCredito o PagosElectronicos. -- NO CANCELABLE
	$fechaTimbrado = date_format(date_create($d_fechaTimbrado),"Y/m/d");
	$fachaSinAceptar = date("Y/m/d",strtotime ( '+3 day' , strtotime ( $d_fechaTimbrado ) ));
	#El total de la factura debe ser maximo 5,000 y se otorgan 3 dias despues del timbrado para cancelar -- SIN ACEPTACION por parte del cliente
	if( $fechaTimbrado <= $fechaSinAceptar && $n_total_gral <= 5000 ){
		return "Sin aceptación";
	}else{
		return "Con aceptación";
	}
}

require $root . '/Ubicaciones/footer.php';
 ?>
