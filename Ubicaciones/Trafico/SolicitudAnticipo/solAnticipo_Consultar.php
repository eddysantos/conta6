<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';

  $cuenta = trim($_GET['cuenta']);
  $accion = trim($_GET['accion']);
  $txt_id_asoc = 'No';

  require $root . '/conta6/Ubicaciones/Trafico/SolicitudAnticipo/actions/consultarCapturaSolAnt_datosGenerales.php';
  require $root . '/conta6/Ubicaciones/Trafico/SolicitudAnticipo/actions/consultarCapturaSolAnt_datosEmbarque.php'; #$datosEmbarque
  require $root . '/conta6/Ubicaciones/Trafico/SolicitudAnticipo/actions/consultarCapturaSolAnt_datosPOCME.php'; # $datosPOCME
  require $root . '/conta6/Ubicaciones/Trafico/SolicitudAnticipo/actions/consultarCapturaSolAnt_datosCargos.php'; #$datosCargos
  require $root . '/conta6/Ubicaciones/Trafico/SolicitudAnticipo/actions/consultarCapturaSolAnt_datosHonorarios.php'; #$datosHonorarios

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

  require $root . '/conta6/Resources/PHP/actions/consultaFactura_ctaGastos.php';
  if( $rows_ctaGastos == 0 ){
    $id_ctagastos = '';
    $fecha_ctagastos = '';
    $id_polctagastos = '';
    $cancela_ctagastos = '';
    $id_polpagoaplic = '';
    $cancela_pagoaplicado = '';
    $fecha_genera = '';
  }



?>

<div class="text-center">
  <div class="row submenuMed m-0">
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
    <a href="/Conta6/Ubicaciones/Trafico/SolicitudAnticipo/SolAnticipo.php">
      <img class="icomediano" src="/conta6/Resources/iconos/left.svg">
    </a>
    <a href='#' class="ml-4" onclick='solAntImprimir(<?php echo $cuenta; ?>)'>
      <img class='icomediano ml-2' src='/conta6/Resources/iconos/printer.svg'>
    </a>
    <?php } ?>
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
        <td class="col-md-3"></td>
        <td class="col-md-3">Usuario</td>
        <td class="col-md-3">Fecha</td>
      </tr>
    </thead>
    <tbody class='font14'>
      <tr class="row">
        <td class="p-1 col-md-3 text-left"> Generada: <?php echo '<b>'.$pk_id_cuenta_captura.'</b>'; ?></td>
        <td class="p-1 col-md-3"></td>
        <td class="p-1 col-md-3"><?php echo $fk_usuario; ?></td>
        <td class="p-1 col-md-3"><?php echo $d_fecha_cta;?></td>
      </tr>
      <tr class="row">
        <td class="p-1 col-md-3 text-left"> Modificada</td>
        <td class="p-1 col-md-3"></td>
        <td class="p-1 col-md-3"><?php echo $s_usuario_modifi; ?></td>
        <td class="p-1 col-md-3"><?php echo $d_fecha_modifi; ?></td>
      </tr>
    </tbody>
  </table>
</div>


<div class="contorno">
  <h5 class="titulo font14 b">CUENTA DE GASTOS</h5>
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


  <div class="row encabezado m-0 mt-5 font14">
    <div class="col-lg-4">
      <div class="row">
        <div class="col-md-12"></div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-md-12"></div>
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

    </div>

    <div class="col-lg-4">

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
        <!-- <div class="col-md-9"></div> -->
        <div class="col-md-9 text-right"><?php echo $s_txt_fac_saldo; ?></div>
        <div class="col-md-3">$ <?php echo $n_fac_saldo; ?></div>
      </div>
    </div>
  </div>

  </div>

</div>

<?php
require $root . '/conta6/Ubicaciones/footer.php';
 ?>
