<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';

  $cuenta = trim($_GET['cuenta']);

require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosGenerales.php';
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosEmbarque.php';
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosPOCME.php';
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosCargos.php';
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosHonorarios.php';
require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/actions/consultarCapturaCuenta_datosDepositos.php';

  
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
      <a id="submenuMed" class="visualizar" accion="Ver-iUsuario" status="cerrado">USUARIO</a>
    </div>
  </div>

  <div class="col-md-2 p-3">
    <a href="1-CuentaGastos.php">
      <img class="icomediano ml-4" src="/conta6/Resources/iconos/left.svg">
    </a>
    <a href="" class="ml-4">
      <img class="icomediano" src="/conta6/Resources/iconos/printer.svg">
    </a>
  </div>

  <div class="contorno" id="detalleCliente" style="display:none">
    <form class="form1">
      <table class="table ">
        <thead>
          <tr class="row encabezado font16">
            <td class="col-md-12"><?php echo $fk_id_cliente.' '.$s_nombre;?></td>
          </tr>
          <tr class="row backpink font14">
            <td class="col-md-6">Direccion</td>
            <td class="col-md-6">Proveedor</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row m-0">
            <td class="col-md-6"><?php echo $s_calle.' '.$s_no_ext.' '.$s_no_int;?></td>
            <td class="col-md-6"><?PHP echo $s_proveedor_destinatario; ?></td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6"><?PHP echo $s_colonia; ?></td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6"><?php echo $s_ciudad.' '.$s_estado.' C.P.'.$s_codigo; ?></td>
          </tr>
          <tr class="row m-0">
            <td class="col-md-6"><?php echo $s_rfc.' '.$s_pais.' '.$s_taxid;?></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>

  <div id="detalleEmbarque" class="contorno" style="display:none">
    <form class="form1">
      <table class="table ">
        <thead>
          <tr class="row encabezado font16">
            <td class="col-md-12">INFORMACION GENERAL</td>
          </tr>
          <tr class="row backpink font14">
            <td class="col-md-4">Aduana</td>
            <td class="col-md-4">Solicitud</td>
            <td class="col-md-4">Fecha</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row borderojo">
            <td class="col-md-4"><?php echo $fk_id_aduana; ?></td>
            <td class="col-md-4"><?php echo	$pk_id_cuenta_captura; ?></td>
            <td class="col-md-4"><?php echo date_format(date_create($d_fecha_cta),"d-m-Y "); ?></td>
          </tr>
          <?php echo $datosEmbarque; ?>
        </tbody>
      </table>
    </form>
  </div>

  <div id="detalleUsuario" class="contorno" style="display:none">
    <form class="form1">
      <table  class="table " >
        <thead>
          <tr class="row encabezado font16">
            <td class="col-md-6">GENERADO POR:</td>
            <td class="col-md-6">MODIFICADO POR:</td>
          </tr>
        </thead>
        <tbody class="font14">
          <tr class="row">
            <td class="col-md-6"><?php echo $fk_usuario; ?></td>
            <td class="col-md-6"><?php echo $s_usuario_modifi; ?></td>
          </tr>
          <tr class="row">
            <td class="col-md-6"><?php echo $d_fecha_cta; ?></td>
            <td class="col-md-6"><?php echo $d_fecha_modifi; ?></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>


<!--Esta informacion si estara visible SOLICITUD DE ANTICIPO-->
<div class="contorno">
  <h5 class="titulo font16">CUENTA DE GASTOS</h5>
    <table class="form1 table ">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-6">PAGOS O CARGOS EN USD</td>
          <td class="col-md-2">IMPORTE</td>
          <td class="col-md-2">SUBTOTAL</td>
        </tr>
      </thead>
      <tbody class="font14">
        <?php echo $datosPOCME; ?>
		<tr class='row'>
          <td class='col-md-6'><?PHP echo 'Total '.number_format($n_POCME_total_gral,2,'.',',').' Al Tipo de Cambio '.$n_POCME_tipo_cambio; ?> </td>
          <td class='col-md-2'></td>
          <td class='col-md-2'>$<?php echo number_format($n_POCME_total_MN,2,'.',','); ?></td>
        </tr>
      </tbody>
    </table>

    <table class="form1 table  mt-5">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-6">PAGOS POR CUENTA CLIENTE</td>
          <td class="col-md-2"></td>
          <td class="col-md-2"></td>
          <td class="col-md-2">SUBTOTAL</td>
        </tr>
      </thead>
      <tbody class="font14">
	  	<?php echo $datosCargos; ?>
      </tbody>
    </table>

    <table class="table form1  mt-5">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-6">HONORARIOS Y SERVICIOS</td>
          <td class="col-md-2">IMPORTE</td>
          <td class="col-md-2">IVA</td>
		  <td class="col-md-2">RET</td>
          <td class="col-md-2">SUBTOTAL</td>
        </tr>
      </thead>
      <tbody class="font14">
	  	<?php echo $datosHonorarios; ?>
	   </tbody>
	 </table>
	 <table class="form1 table ">
      <thead>
        <tr class="row encabezado">
          <td class="col-md-6">DEPOSITOS</td>
          <td class="col-md-2">SUBTOTAL</td>
        </tr>
      </thead>
      <tbody class="font14">
        <?php echo $datosDepositos; ?>
      </tbody>
    </table>
	<table class="table form1 mt-5">
	   <tbody class="font14">
        <tr class="row">
          <td class="col-md-6 text-right"></td>
          <td class="col-md-2"></td>
          <td class="col-md-2"><?php echo $s_txt_gral_importe; ?></td>
          <td class="col-md-2"><?php echo $n_total_gral_importe; ?></td>
        </tr>
		<tr class="row">
          <td class="col-md-6 text-right"></td>
          <td class="col-md-2"></td>
          <td class="col-md-2"><?php echo $n_txt_gral_IVA; ?></td>
          <td class="col-md-2"><?php echo $n_total_gral_IVA; ?></td>
        </tr>
		<tr class="row">
          <td class="col-md-6 text-right"></td>
          <td class="col-md-2"></td>
          <td class="col-md-2"><?php echo $s_txt_total_honorarios; ?></td>
          <td class="col-md-2"><?php echo $n_total_honorarios; ?></td>
        </tr>
		<tr class="row">
          <td class="col-md-6 text-right"></td>
          <td class="col-md-2"></td>
          <td class="col-md-2"><?php echo $s_txt_fac_IVA_retenido; ?></td>
          <td class="col-md-2"><?php echo $s_fac_IVA_retenido; ?></td>
        </tr>
		<tr class="row">
          <td class="col-md-6 text-right">&nbsp;</td>
          <td class="col-md-2"></td>
          <td class="col-md-2"><?php echo $s_txt_total_gral; ?></td>
          <td class="col-md-2"><?php echo $n_total_gral; ?></td>
        </tr>
		<tr class="row">
          <td class="col-md-6 text-right">&nbsp;</td>
          <td class="col-md-2"></td>
          <td class="col-md-2"><?php echo $s_POCME_descripcion_gral; ?></td>
          <td class="col-md-2"><?php echo $n_total_POCME; ?></td>
        </tr>
		<tr class="row">
          <td class="col-md-6 text-right">&nbsp;</td>
          <td class="col-md-2"></td>
          <td class="col-md-2"><?php echo $s_txt_total_pagos; ?></td>
          <td class="col-md-2"><?php echo $n_total_pagos; ?></td>
        </tr>
		<tr class="row">
          <td class="col-md-6 text-right"><?php echo $s_total_cta_gastos_letra; ?></td>
          <td class="col-md-2"></td>
          <td class="col-md-2"><?php echo $s_txt_cta_gastos; ?></td>
          <td class="col-md-2"><?php echo $n_total_cta_gastos; ?></td>
        </tr>
		<tr class="row">
          <td class="col-md-6 text-right">&nbsp;</td>
          <td class="col-md-2"></td>
          <td class="col-md-2"><?php echo $s_txt_fac_saldo; ?></td>
          <td class="col-md-2"><?php echo $n_fac_saldo; ?></td>
        </tr>
		<tr class="row">
          <td class="col-md-6 text-right"></td>
          <td class="col-md-2"></td>
          <td class="col-md-2"></td>
          <td class="col-md-2"></td>
        </tr>
      </tbody>
	  </table>
	  <table class="table form1  mt-5">
	  	<tbody class="font14">
        <tr class="row encabezado">
          <td class="col-md-6 text-right">Metodo de pago</td>
          <td class="col-md-2">Forma de pago</td>
          <td class="col-md-2">Moneda</td>
          <td class="col-md-2">Tipo Cambio</td>
		  <td class="col-md-2">Uso de CFDI</td>
		  <td class="col-md-2">CUSTOMS</td>
        </tr>
		<tr class="row">
          <td class="col-md-6 text-right"><?php echo $fk_c_MetodoPago; ?></td>
          <td class="col-md-2"><?php echo $fk_id_formapago.' '.$s_numCtaPago; ?></td>
          <td class="col-md-2"><?php echo $fk_id_moneda; ?></td>
          <td class="col-md-2"><?php echo $n_tipoCambio; ?></td>
		  <td class="col-md-2"><?php echo $pk_c_UsoCFDI; ?></td>
		  <td class="col-md-2"><?php echo $fk_id_asoc; ?></td>
        </tr>
	   </tbody>
    </table>
  </div>

</div>

<script src="js/facturaElectronica.js"></script>
