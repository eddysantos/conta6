<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/barradenavegacion.php';

$cuenta = trim($_GET['cuenta']);

require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_consultaDatosGenerales.php';
$cliente = $fk_id_cliente;
$id_cliente = $fk_id_cliente;
if( $s_pagada == 1 ){
  $datosPAGADA = "<option value='1' selected style='color:#0000000'>Si</option>$fk_id_asoc</option>
                   <option value='0'>No</option>";
}else{
  $datosPAGADA = "<option value='1' >Si</option>
                   <option value='0' selected>No</option>";
}

require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_consultaDatosPOCME.php'; # $datosPOCMEmodificar
require $root . '/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/actions/CuentaGastos_consultaDatosAnticipos.php'; # $datosANTICIPOmodificar

require $root . '/conta6/Resources/PHP/actions/validarFormulario.php';
$referencia = $fk_referencia;
$id_referencia = $fk_referencia;
if($referencia != "SN"){
      require $root . '/conta6/Resources/PHP/actions/consultaDatosReferenciaProveedor.php';
      if( $rows_datosRefProv > 0 ){
        $row_datosRefProv = $rslt_datosRefProv->fetch_assoc();
        $id_clienteReferencia = $row_datosRefProv['fk_id_cliente'];
        $status_Flete = $row_datosRefProv['s_status_flete'];
        $valor = limpiarBlancos($row_datosRefProv['n_valor_aduana']);
        $valor_usd = $row_datosRefProv['n_valor_USD'];
        $peso = limpiarBlancos($row_datosRefProv['n_peso']);
        $volumen = $row_datosRefProv['n_volumen'];
        #$aduana = $row_datosRefProv['fk_id_aduana'];
        $descripcionRef = cortarCadena($row_datosRefProv['s_descripcion'],25);
        $guiaMaster = limpiarBlancos($row_datosRefProv['s_guia_master']);
        $facturas = cortarCadena($row_datosRefProv['s_facturas'],25);
        $procedencia = limpiarBlancos($row_datosRefProv['s_procedencia']);
        $referenciaCliente = limpiarBlancos($row_datosRefProv['s_referencia_cliente']);
        $pedimento = limpiarBlancos($row_datosRefProv['s_pedimento']);
        $tipoCambio = $row_datosRefProv['n_tipo_cambio'];
        $tipo = limpiarBlancos($row_datosRefProv['s_imp_exp']);
        $s_tipo = limpiarBlancos($row_datosRefProv['s_tipo']);
        $almacen = limpiarBlancos($row_datosRefProv['fk_almacen_seccion']);
        $fechaEntrada =  $row_datosRefProv['d_fecha_entrada'];
        if (!is_null($fechaEntrada)){
          $fechaEntrada = date_format(date_create($fechaEntrada),"d-m-Y");
        }else{
          $fechaEntrada = '';
        }

  		  $idProv = $row_datosRefProv['pk_id_prov'];
  		  $nomProv = $row_datosRefProv['s_nombre'];
  		  $calleProv = $row_datosRefProv['s_calle'];
  		  $noExtProv = $row_datosRefProv['s_no_ext'];
  		  $noIntProv = $row_datosRefProv['s_no_int'];
  		  $codProv = $row_datosRefProv['s_codigo'];
  		  $paisProv = $row_datosRefProv['s_pais'];
  		  $entidadProv = $row_datosRefProv['s_entidad'];
  		  $ciudadProv = $row_datosRefProv['s_ciudad'];
  		  $telProv = $row_datosRefProv['s_telefono'];
  		  $faxProv = $row_datosRefProv['s_fax'];
    }
      if(!is_null($fechaEntrada)){
        $fechaEntrada = date_format(date_create($fechaEntrada),"d-m-Y");
      }else{
        $fechaEntrada = "";
      }
      if( trim($tipo) == 'E'){ $tipo = "EXP"; }else{ $tipo = "IMP"; }
      if( $almacen > 0 ){
        require $root . '/conta6/Resources/PHP/actions/consultaDatosAlmacen.php';
        $almacenNombre = trim($row_datosAlmacen['s_almacen']);
      }else{ $almacen = 0; $almacenNombre = "SIN NOMBRE";}
      $nomProv = limpiarBlancos($nomProv);
}else{
      $id_clienteReferencia =  $cliente;
      $status_Flete = "P";
      $almacen = 0;
      $valor = 0;
      $peso = 0;
      $volumen = 0;
      $tipo = "EXP";
      #$aduana = $oficina;
      $almacenNombre = "SIN ALMACEN";
      $nomProv = "";
      $descripcionRef = "";
      $guiaMaster = "";
      $facturas = "";
      $fechaEntrada = date ( "d-m-Y h:i:s" , time () );
      $procedencia = "";
      $referenciaCliente = "";
      $pedimento = "";
      $tipoCambio = 0;
}

$entradasAdicionales = 0;
if($entradas > 1){
  $entradasAdicionales = $entradas - 1;
  $entradas = 1;
}


	$parteCliente = trim( preg_replace('/[0-9]/', '', $cliente ) );
	if( $parteCliente == "CLT_" ){
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
		  $CLT_taxid = limpiarBlancos($row_datosCLT["s_taxid"]);
		}
	}else{
		require $root . '/conta6/Resources/PHP/actions/consultaDatosCliente_americano.php';
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
		  $CLT_rfc = limpiarBlancos($row_datosCLT["s_tax_id"]);
		}
	}

  /* SACO UN FOLIO DE CALCULO DE TARIFA, ESTE FOLIO ME SERVIRA PARA PODER IDENTIFICAR LOS FILTROS DE LAS TARIFAS */
  $tipoDocumento == 'elaborar';
  $s_tipoDoc = 'ctaGastosAME';
  require $root . '/conta6/Resources/PHP/actions/tarifas_generarFolio.php'; #$calculoTarifa


  #******************** PAGOS O COBROS EN MONEDA EXTRANJERA ********************
  //CALCULO TARIFA DEL CLIENTE - SECCION: POCME
  $id_cliente_usar = $id_cliente;
  require $root . '/conta6/Resources/PHP/actions/tarifas_calculaPOCME.php';
  require $root . '/conta6/Resources/PHP/actions/tarifas_consultaPOCME_cliente.php'; #$tarifaPOCMEcliente
  //CALCULO TARIFA GENERAL - SECCION: POCME
  $id_cliente_usar = 'CLT_5900'; #CLIENTES DIVERSOS
  $consolidado = 'LTL/FTL';
  require $root . '/conta6/Resources/PHP/actions/tarifas_calculaPOCME.php';
  require $root . '/conta6/Resources/PHP/actions/tarifas_consultaPOCME_general.php'; #$tarifaPOCMEgeneral



?>
<input type="hidden" id="tipoDocumento" value="modificar">
<input type="hidden" id="T_ID_Aduana_Oculto" value="<?php echo $aduana; ?>">
<input type="hidden" id="Txt_Usuario" value="<?php echo $usuario; ?>">
<input type="hidden" id="docto_tipo" value="<?php echo $opcionDoc;?>">

<input type="hidden" id="cta_ame_marcarPagada" value="<?PHP echo $oRst_permisos['s_cta_ame_marcarPagada'];?>">
<input type="hidden" id="cta_ame_verGstoGana" value="<?PHP echo $oRst_permisos['s_cta_ame_verGstoGana'];?>">
<input type="hidden" id="cta_ame_editGstoGana" value="<?PHP echo $oRst_permisos['s_cta_ame_editGstoGana'];?>">


<div class='text-center'>
  <div class='row m-0 submenuMed'>
    <div class='col-md-4' role='button'>
      <a  id="submenuMed" class="visualizar" accion="Ver-cliente" status="cerrado">DATOS CLIENTE</a>
    </div>
    <div class='col-md-4'>
      <a id="submenuMed" class="visualizar" accion="datinfo" status="cerrado">INFO. GENERAL</a>
    </div>
    <div class="col-md-4">
      <a id="submenuMed" class="visualizar" accion="Ver-iEmbarque" status="cerrado">INFO. DEL EMBARQUE</a>
    </div>
  </div>
  <div id="detalleCliente" class="contorno" style="display:none">
    <h5 class='titulo font14'>DATOS CLIENTES</h5>
    <table class='table' id='eCliente'>
      <thead>
        <tr class='row font14 encabezado'>
          <td class="col-md-1">
            <input class="w-100 h22  border-0 bt" type="text" id="T_ID_Cliente_Oculto" readonly value="<?php echo $fk_id_cliente; ?>">
          </td>
          <td class="col-md-5">
            <input class="w-100 h22 border-0 bt" type="text" id="T_Nombre_Cliente" readonly value="<?php echo trim($CLT_nombre);?>" onchange="validarStringSAT(this);quitarNoUsar(this);">
          </td>
          <td class="col-md-1"></td>
          <td class="col-md-1">
            <input class="w-100 h22 border-0 bt" type="text" id="T_ID_Proveedor" readonly value="<?php echo $idProv; ?>">
          </td>
          <td class="col-md-4">
            <input class="w-100 h22 border-0 bt" type="text" id="T_Proveedor_Destinatario" value="<?php echo $nomProv;?>" readonly>
          </td>
        </tr>
        <tr class='row backpink' style="font-size:14px!important">
          <td class='col-md-6 p-1'>Direccion Cliente</td>
          <td class="col-md-1 p-1"></td>
          <td class='col-md-5 p-1'>Direccion Proveedor</td>
        </tr>
      </thead>
      <tbody class='font14'>
        <tr class="row">
          <!-- cliente -->
          <td class="col-md-4 p-1">
            <input class="efecto h22 bt text-left" id="T_Cliente_Calle" type="text" readonly value="<?php echo $CLT_calle;?>">
          </td>
          <td class="col-md-1 p-1">
            <input class="efecto h22 bt" id="T_Cliente_No_Ext" type="text" readonly value="<?php echo $CLT_no_ext;?>" size="5" placeholder="#Ext">
          </td>
          <td class="col-md-1 p-1">
            <input class="efecto h22 bt" id="T_Cliente_No_Int" type="text" readonly value="<?php echo $CLT_no_int;?>" size="25" placeholder="#Int">
          </td>

          <!-- Proveedor -->
          <td class="col-md-1 p-1"></td>
          <td class="col-md-5 p-1">
            <input class="efecto h22 bt text-left" id="T_Proveedor_Calle" type="text" readonly value="<?php echo $calleProv;?>">
          </td>
        </tr>

        <tr class="row">
          <td class="col-md-6 p-1">
            <input class="h22 efecto bt" id="T_Cliente_Colonia" type="text" readonly value="<?php echo $CLT_colonia;?>">
          </td>

          <td class="col-md-1 p-1 offset-md-1 ">
            <input class="h22 efecto bt" id="T_Proveedor_No_Ext" type="text" readonly value="<?php echo $noExtProv;?>" size="5" placeholder="#Ext">
          </td>
          <td class="col-md-1 p-1">
            <input class="h22 efecto bt" id="T_Proveedor_No_Int" type="text" readonly value="<?php echo $noIntProv;?>" size="25" placeholder="#Int">
          </td>
          <td class="col-md-1 p-1">
            <input class="h22 efecto bt" id="T_Proveedor_Colonia" type="text" readonly value="<?php echo $codProv;?>" placeholder="C.P">
          </td>
          <td class="col-md-1 p-1">
            <input class="h22 efecto bt" id="T_Proveedor_Pais" type="text" value="<?php echo $paisProv; ?>" placeholder="País">
          </td>
          <td class="col-md-1 p-1">
            <input class="h22 efecto bt" id="T_Proveedor_Entidad" type="text" value="<?php echo $entidadProv; ?>" placeholder="Entidad">
          </td>
        </tr>
        <tr class="row">
          <td class="col-md-6 p-1">
            <input class="h22 efecto bt" id="T_Cliente_CP" type="text" readonly value="<?php echo $CLT_codigo;?>" size="6">
          </td>

          <td class="col-md-5 p-1 offset-md-1">
            <input class="h22 efecto bt" id="T_Proveedor_Ciudad" type="text" readonly value="<?php echo $ciudadProv;?>">
          </td>

        </tr>

        <tr class="row">
          <td class="col-md-6 p-1">
            <input class="h22 efecto bt" id="T_Cliente_Ciudad" type="text" readonly value="<?php echo $CLT_ciudad;?>">
          </td>

          <td class="col-md-1 p-1 b text-right"><b>Phone: </b></td>
          <td class="col-md-5 p-1">
          <input type="text" class="h22 efecto bt" id="T_Proveedor_tel" value="<?php echo $telProv; ?>">
          </td>
        </tr>

        <tr class="row">
          <td class="col-md-6 p-1">
            <input class="h22 efecto bt" id="T_Cliente_Estado" type="text" readonly value="<?php echo $CLT_estado;?>">
          </td>

          <td class="col-md-1 p-1 b text-right"><b>Fax: </b></td>
          <td class="col-md-5 p-1">
          <input type="text" class="h22 efecto bt" id="T_Proveedor_fax" value="<?php echo $faxProv; ?>">
          </td>
        </tr>

        <tr class="row">
          <td class="col-md-3 p-1">
            <input class="h22 efecto bt" id="T_Cliente_RFC" type="text" readonly onchange="validarRFCfac(this);" value="<?php echo $CLT_rfc;?>">
          </td>
          <td class="col-md-3 p-1"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id='contornoInfo' class='contorno' style="display:none">
    <h5 class='titulo font16'>INFO GENERAL</h5>
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
          <td class="p-1 col-md-3 text-left b"><b>Cta. generada</b></td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"><?php echo $s_usuario; ?></td>
          <td class="p-1 col-md-3"><?php echo $d_fecha_alta; ?></td>
        </tr>

        <tr class="row">
          <td class="p-1 col-md-3 text-left b"><b>Cta. modificada</b></td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"><?php echo $s_usuario_modifi; ?></td>
          <td class="p-1 col-md-3"><?php echo $d_fecha_modifi; ?></td>
        </tr>
        <tr class="row borderojo">
          <td class="p-1 col-md-3 text-left b"><b>cta. cancelada</b></td>
          <td class="p-1 col-md-3"></td>
          <td class="p-1 col-md-3"><?php echo $s_cancela_usuario; ?></td>
          <td class="p-1 col-md-3"><?php echo $d_cancela_fecha; ?></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="detalleEmbarque" class="contorno" style="display:none">
    <table class="table form1">
      <thead>
        <tr class="row encabezado font16">
          <td class="col-md-12">INFORMACION DEL EMBARQUE</td>
        </tr>

      </thead>
      <tbody class="font14" id='tbodyDGE'>

        <tr class="row justify-content-center">
          <td class="col-md-1 text-right pt-3 ls0 b">Referencia: </td>
          <td class="col-md-2 p-1">
            <input class="efecto h22 text-left" type="text" id="T_Referencia" size="30" maxlength="60" value="<?php echo $fk_referencia;?>" readonly>
          </td>
          <td class="col-md-1 p-1">
            <input class="efecto h22 text-left" type="text" id="T_Tipo" size="4" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $s_imp_exp;?>" readonly>
          </td>
        </tr>

        <tr class="row justify-content-center">
          <td class="col-md-1 text-right pt-3 ls0 b">Freight Bill : </td>
          <td class="col-md-3 p-1">
            <input class="efecto h22 text-left" type="text" id="T_Freight" maxlength="40" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $s_guia_master; ?>">
          </td>
        </tr>
        <tr class="row justify-content-center">
          <td class="col-md-1 text-right pt-3 ls0 b">Quantity : </td>
          <td class="col-md-1 p-1">
            <input class="efecto h22 text-left" type="text" id="T_Quantity" size="30" maxlength="150" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $n_bodegaIn; ?>">
          </td>
          <td class="col-md-1 pt-3 ls0 b text-right">Type : </td>
          <td class="col-md-1">
            <input class="efecto h22 text-left" type="text" id="T_Type" size="30" maxlength="60" value="<?php echo $s_tipoRegimen; ?>" readonly>
          </td>

        </tr>
        <tr class="row justify-content-center">
          <td class="col-md-1 text-right pt-3 ls0 b">Description : </td>
          <td class="col-md-3 p-1">
            <input class="efecto h22 text-left" id="T_Descripction" type="text" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $s_descripcion;?>" size="40" readonly>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


  <div class='contorno'>
    <h5 class='titulo font14'>CTA. GASTOS</h5>
    <div class="row encabezado font16 m-0">
      <div class="col-md-12">GENERAL</div>
    </div>
    <div class="sub2 row m-0" style="font-size:12px!important">
      <div class="col-md-2"><b>Inovice No</b> </div>
      <div class="col-md-2"><b>Inovice Value</b></div>
      <div class="col-md-2"><b>Date</b></div>
      <div class="col-md-2"><b>Weight</b></div>
      <div class="col-md-4"><b>Customer Invoice</b></div>
    </div>
    <div class="row m-0 mt-3">
      <div class="col-md-2">
        <input class="efecto h22" type="text" id="T_Invoice_No" size="15" value="<?php echo $pk_id_ctaAme; ?>" readonly>
      </div>
      <div class="col-md-2">
        <input class="efecto h22" type="text" id="T_Invoice_Value" size="15"  value="<?php echo number_format($n_valor_usd,2,'.','');?>">
      </div>
      <div class="col-md-2">
        <input class="efecto h22" type="date" id="T_Date" size="15" value="<?php echo $d_fecha; ?>" required>
      </div>
      <div class="col-md-2">
        <?php if( $opcion == "CFD" or $opcion == "Proforma" ){ echo $opcion.": ".$extraerfolio; }?>
        <input class="efecto h22" type="text" id="T_Weight" size="15" value="<?php echo number_format($peso,2,'.','');?>" readonly>
      </div>
      <div class="col-md-4">
        <input class="efecto h22" type="text" id="T_Customer_Order" size="40" value="<?php echo $s_customerOrder;?>">
      </div>
    </div>


    <div class='mt-5'>
      <div class='acordeon2'>
        <div class='encabezado font16' href='#collapseOne'>ACCOUNT CHARGES</div>
        <div id='collapseOne' class='card-block  divisor mb-4'>
          <div>
            <div class="row mt-3">
              <div class="col-md-6">
                <select class="custom-select" size="1" id="Lst_tarifa_cliente" onChange="tarifaCliente()">
                  <?php echo $tarifaPOCMEcliente; ?>
                </select>
              </div>
              <div class="col-md-6">
                <select class="custom-select" size="1" id="Lst_tarifa_general" onchange="tarifaGeneral()">
                  <?php echo $tarifaPOCMEgeneral; ?>
                </select>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-md-1"></div>
              <div class='col-md-1'>
                <input class="efecto h22" type="text" id="T_no_calculo" onBlur="validaSoloNumeros(this);" size="4">
                <input type="hidden" id="T_POCME_idConcep">
                <input type="hidden" id="T_POCME_Cta">
              </div>
              <div class='col-md-6'>
                <input class="efecto h22" type="text" id="T_POCME" size="60" readonly>
                <input type="hidden" id="T_POCME_Eng">
              </div>
              <div class='col-md-2'>
                <input class="efecto h22" type="text" id="T_POCME_Valor" onblur="validaIntDec(this);cortarDecimalesObj(this,2);" size="15" >
              </div>
              <div class='col-md-1 text-left'>
                <a onclick="agregarImporte_ctaAme()" id="Btn_agregar">
                  <img src='/conta6/Resources/iconos/002-plus.svg' class='icomediano'>
                </a>
              </div>
              <div class='col-md-1'></div>
            </div>
          </div>
          <form class='form1' onsubmit="return false">
            <table class='table'>
              <thead>
                <tr class='row mt-4 m-0 backpink justify-content-center'>
                  <td class='col-md-1'>SERV.</td>
                  <td class='col-md-3'>CONCEPTO</td>
                  <td class='col-md-3'>DESCRIPCION</td>
                  <td class=''></td>
                  <td class=''></td>
                  <td class='col-md-1 sub ml-4 spend'>SPEND</td>
                  <td class='col-md-1 sub gain'>GAIN</td>
                  <td class='col-md-1'>IMPORTE</td>
                  <td class='col-md-1'>SUBTOTAL</td>
                </tr>
              </thead>
              <tbody id='tbodyPOCME'>
                <?php echo $datosPOCMEmodificar; ?>
              </tbody>
              <tfoot>
              </tfoot>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="contorno" style="<?php echo $marginbottom ?>">
  <table class="table w-100">
    <tr>
      <td class="w-50">
        <table class="table">
          <tr class="row">
            <td class="col-md-3 text-right pt-3 font12 b"> PAGADA :</td>
            <td class="col-md-3">
              <select class="custom-select-s" id="T_pagada" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                  <?PHP echo $datosPAGADA; ?>
              </select>
            </td>
            <td class="col-md-3"></td>
           <td class="col-md-3"></td>
          </tr>
        </table>
      </td>
      <td class="w-50">
        <table class="table font14">
          <tbody>
            <tr class="row">
              <!-- totales de SPEND y GAIN -->
              <td class="p-1 col-md-2 offset-md-3">
                <input class="efecto h22 ml-5" type="text" id="T_gasto_Total" size="20" value="<?php echo $n_gasto; ?>" readonly>
              </td>
              <td class="p-1 col-md-2">
                <input class="efecto h22 ml-5" type="text" id="T_gana_Total" size="20" value="<?php echo $n_ganancia; ?>" readonly>
              </td>

              <td class="p-1 col-md-3">
                <input class="h22 w-100 bt text-right border-0" type="text" id="Txt_SubCtaAme" size="40"readonly value="Subtotal :">
              </td>
              <td class="p-1 col-md-2">
                <input class="efecto h22" type="text" id="T_Sub_Total" size="20" value="<?php echo $n_subtotal; ?>" readonly>
              </td>
            </tr>

            <?php echo $datosANTICIPOmodificar; ?>

            <tr class="row">
              <td class="p-1 col-md-3 offset-md-7">
                <input class="h22 w-100 bt text-right border-0" type="text" id="Txt_TotCtaAme" size="40"readonly value="Total :">
              </td>
              <td class="p-1 col-md-2">
                <input class="efecto h22" type="text" id="T_Total" size="20" value="<?php echo $n_total; ?>" readonly>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </table>

  <div class="row justify-content-center">
    <div class="col-md-3">
      <input class="efecto boton validarstring" type='button' value="MODIFICAR" id="modificar-ctaAme" tabindex="<?php echo $tabindex = $tabindex+1; ?>"/>
    </div>
    <div id="print" style="display:none">
      <a id="Btn_print_ctaAme"><img src='/conta6/Resources/iconos/printer.svg' class='icomediano'></a>
      <a id="Btn_new_ctaAme"><img src='/conta6/Resources/iconos/hoja2.svg' class='icomediano'></a>
    </div>
  </div>
</div>
</div>

<?php
  require $root . '/conta6/Ubicaciones/footer.php';
?>
