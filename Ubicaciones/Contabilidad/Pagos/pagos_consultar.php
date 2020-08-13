<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';

  $cuenta = trim($_GET['cuenta']);
  $id_cliente = trim($_GET['id_cliente']);
  $accion = trim($_GET['accion']);
  $txt_id_asoc = 'No';

  require $root . '/Ubicaciones/Contabilidad/Pagos/actions/consultarCapturaPago_datosGenerales.php';
  require $root . '/Ubicaciones/Contabilidad/Pagos/actions/consultarCapturaPago_detalle.php'; # $pagosDetalle_consulta


  $id_captura = $cuenta;
  require $root . '/Resources/PHP/actions/consultaPagoTimbrada.php';
  if( $rows_pagoTimbrada == 0 ){
    $s_UUID = '';
    $pk_id_pago = '';
    $id_poliza = '';
    $s_UUID = '';
    $usuario_timbra = '';
    $fechaTimbre = '';

    $s_cancela_factura = '';
    $fechaTimbreCancela = '';
    $usuario_Cancela = '';
    $s_selloSATcancela = '';
  }


  if( $s_UUID == '' && $oRst_permisos['s_rPElect_timbrar'] && $accion == 'timbrar' ){
    $hrefTimbrar = "<a href='#' class='ml-4' onclick='timbrarPago($cuenta,&#39;$fk_referencia&#39;,&#39;$fk_id_cliente&#39;)'>
                      <img class='icomediano' src='/Resources/iconos/timbrar.svg'>
                    </a>";

  }
/*
  if( $s_UUID != '' && $s_selloSATcancela == '' && $accion == 'cancelar'){
    if( $fk_id_aduana == $aduana ){
      if( $oRst_permisos['CFDI_cancelar_libre'] == 1 ){

      }else if( $oRst_permisos['CFDI_cancelar'] == 1 ){

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
              $hrefTimbrar = "<a href='#' class='ml-4' onclick='timbrarFactura($cuenta,&#39;$fk_referencia&#39;,&#39;$fk_id_cliente&#39;)'>
                <img class='icomediano' src='/Resources/iconos/timbrar.svg'>
              </a>";
            }
    }


  }*/
  #require $root . '/Ubicaciones/Contabilidad/Pagos/actions/consultarEstadoCFDI_factura.php'; #$datosEdoCancela
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
    <a href="/Ubicaciones/Contabilidad/Pagos/pagos.php">
      <img class="icomediano" src="/Resources/iconos/left.svg">
    </a>
    <a href='#' class="ml-4" onclick='pagosImprimir(<?php echo $cuenta; ?>)'>
      <img class='icomediano ml-2' src='/Resources/iconos/printer.svg'>
    </a>
    <?php } ?>

    <?php if( $accion == 'timbrar' ){ ?>
    <a href="/Ubicaciones/Contabilidad/Pagos/pagos.php">
      <img class="icomediano" src="/Resources/iconos/left.svg">
    </a>
    <a href="#" class="ml-4" onclick='pagosImprimir(<?php echo $cuenta ?>)'>
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
      <div class="col-md-6"></div>
    </div>
    <div class="row">
      <div class="col-md-3 text-right">Calle :</div>
      <div class="col-md-3 text-left p-0"><?PHP echo $s_calle; ?></div>

      <div class="col-md-3 text-right"></div>
      <div class="col-md-3 text-left p-0"></div>
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
      <div class="col-md-4"></div>
    </div>
    <div class="row borderojo">
      <div class="col-md-4"><?php echo $fk_id_aduana; ?></div>
      <div class="col-md-4"><?php echo $pk_id_pago_captura; ?></div>
      <div class="col-md-4"></div>
    </div>
  </div>

  <div id='detalleUsuario' class='contorno' style='display:none'>
    <h5 class='titulo font16'>INFO GENERAL</h5>
    <table class='table' id='eInfo'>
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
          <td class="p-1 col-md-3 text-left b"><b>Generada <?php echo $pk_id_pago_captura; ?></b> </td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3">
            <input class="h22 bt border-0 text-center" type="text" id="T_Usuario" size="20"value="<?php echo $fk_usuario_alta; ?>" readonly>
          </td>
          <td class="p-1 col-md-3">
            <input class="h22 bt border-0 text-center" type="text" id="T_Fecha_Cta" size="20" value="<?php echo $d_fecha_alta;?>" readonly>
          </td>
        </tr>

        <tr class="row b">
          <td class="p-1 col-md-3 text-left b"><b>Modificada</b> </td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"><?php echo $s_usuario_modifi; ?></td>
          <td class="p-1 col-md-3"><?php echo $d_fecha_modifi; ?></td>
        </tr>
    		<tr class="row">
    			<td class="p-1 col-md-3 text-left b"><b>Pago generado: <?php echo $pk_id_pago.'</b> --- '.$s_UUID; ?></td>
    			<td class="p-1 col-md-3"><?php echo $id_poliza; ?></td>
    			<td class="p-1 col-md-3"><?php echo $usuario_timbra; ?></td>
    			<td class="p-1 col-md-3"><?php echo $fechaTimbre; ?></td>
    		</tr>
  		  <tr class="row">
    			<td class="p-1 col-md-3 text-left b"><b>Pago cancelado:</b></td>
    			<td class="p-1 col-md-3"></td>
    			<td class="p-1 col-md-3"><?php echo $usuario_Cancela; ?></td>
    			<td class="p-1 col-md-3"><?php echo $fechaTimbreCancela; ?></td>
  		  </tr>
      </tbody>
    </table>
  </div>


<!--Esta informacion si estara visible SOLICITUD-->
<?php
/*if( $s_UUID != '' && $accion == 'cancelar' ){ ?>
<div class="contorno">
  <h5 class="titulo font14 b">ESTADO DEL COMPROBANTE</h5>

  <div class="row encabezado mt-5 m-0 font14">
    <div class="col-md-4">Total Factura</div>
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
        $txt_evaluar = evaluarCancelarFactura($fechaTimbrado,$n_total_gral);
          $hrefcancela = "<a href='#' onclick='cancelarFactura($id_factura)'><img class='icomediano ml-4' src='/Resources/iconos/cross.svg'>$txt_evaluar</a>";

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

<?php
*/
#}
?>

<div class="contorno mt-5" style="<?php echo $marginbottom ?>">
  <form onsubmit="return false">
    <div class="row sub2 m-0 mt-4">
      <div class="col-md-12 p-1 font14"><b>Detalle de Pagos</b></div>
    </div>
    <div id="tbodyPagos">
      <?php echo $pagosDetalle_consulta; ?>
    </div>
  </form>
</div>
  <!--div class="contorno mt-5" >
    <form onsubmit="return false">
      <table class='table'>
        <thead>
          <tr class='row m-0 mt-4 sub2'>
            <th class='col-md-12 p-1 font14'>Detalle de Pagos</th>
          </tr>
        </thead>
        <tbody id="tbodyPagos">
          <?php #echo $pagosDetalle_consulta; ?>
        </tbody>
      </table>
    </form>
  </div-->





</div>

<?php

require $root . '/Ubicaciones/footer.php';
 ?>
