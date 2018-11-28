<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/barradenavegacion.php';
$pk_c_UsoCFDI = '';
$selected_usoCFDI = '';
$cliente = trim($_GET['id_cliente']);
$dias = trim($_GET['dias']);
$referencia = trim($_GET['referencia']);
$consolidado = trim($_GET['consolidado']);
$entradas = trim($_GET['entradas']);
$shipper = trim($_GET['shipper']);
$inbond = trim($_GET['inbond']);
$flete = trim($_GET['flete']);
$extraerfolio = trim($_GET['extraerfolio']);
$cobrarFlete = trim($_GET['cobrarFlete']);
$opcion = trim($_GET['opcionDoc']);
$docto = trim($_GET['docto']);
$tasa = trim($_GET['tasa']);
$id_cliente = trim($_GET['id_cliente']);
$id_referencia = trim($_GET['referencia']);

$fechaActual = date ("d-m-Y" , time() );

$PME_1 = 0;
$PME_2 = 0;
$PME_3 = 0;
$PME_4 = 0;
$PME_5 = 0;
$PME_6 = 0;
$custodia = 0;
$manejo = 0;
$almacenaje = 0;
$maniobras = 0;
require $root . '/conta6/Resources/PHP/actions/validarFormulario.php';
if($referencia != "SN"){
      require $root . '/conta6/Resources/PHP/actions/consultaDatosReferenciaProveedor.php';
      if( $rows_datosRefProv > 0 ){
        $row_datosRefProv = $rslt_datosRefProv->fetch_assoc();
          $id_clienteReferencia = $row_datosRefProv['fk_id_cliente'];
          $status_Flete = $row_datosRefProv['s_status_flete'];
          $valor = limpiarBlancos($row_datosRefProv['n_valor_aduana']);
          $peso = limpiarBlancos($row_datosRefProv['n_peso']);
          $volumen = $row_datosRefProv['n_volumen'];
          #$aduana = $row_datosRefProv['fk_id_aduana'];
          $descripcion = cortarCadena($row_datosRefProv['s_descripcion'],25);
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
      $descripcion = "";
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
	
/*    
    //IVA
    require $root . '/conta6/Resources/PHP/actions/consultaDatosIVA.php';
    if( $rows_datosIVA > 0 ){
      $iva = trim($row_datosIVA["n_IVA"]);
      $retencion = trim($row_datosIVA["n_IVA_retencion"]);
      $iva_menos_retencion = $row_datosIVA['n_IVA_menos_retencion'];
      $ivaGral = $row_datosIVA['n_IVA_general'] - $retencion; //IMPUESTO GENERAL - APLICADO AL CONCEPTO Flete Terrestre cuando es la oficina de Nuevo Laredo
    }
    if( $tasa == "sinIVA" ){
      $iva = 0;
      $retencion = 0;
      $iva_menos_retencion = 0;
    }
*/	
    /* SACO UN FOLIO DE CALCULO DE TARIFA, ESTE FOLIO ME SERVIRA PARA PODER IDENTIFICAR LOS FILTROS DE LAS TARIFAS */
    $s_tipoDoc = 'ctaGastos';
    require $root . '/conta6/Resources/PHP/actions/tarifas_generarFolio.php';
    //$calculoTarifa = 45;
	echo $calculoTarifa;

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
    //EXTRAER PROFORMA - SECCION: POCME
    if($docto == "Proforma"){
      require $root . '/conta6/Resources/PHP/actions/consulta_proforma_det.php'; #$proforma_POCME
    }
    //EXTRAER CTA AME - SECCION: POCME
    if($docto == "ctaAme"){
      require $root . '/conta6/Resources/PHP/actions/consulta_ctaAme_det.php'; #$ctaAme_POCME
    }
    if($docto == "cliente" || $docto == "clt_ame" ){
      require $root . '/conta6/Resources/PHP/actions/tarifas_calculaPOCME_delete.php';
    }
    //PARA LA OFICINA DE NUEVO LAREDO ESTOS CONCEPTOS SE CARGAN EN AUTOMATICO
    if( $aduana == 240 ){
      #require $root . '/conta6/Resources/PHP/actions/tarifas_consultaPOCME_cliente_cobroAutomatico.php';  #$POCME_automatico
    }
    //CALCULO TARIFA ALMACEN - SECCION: PAGOS REALIZADOS POR SU CUENTA
    require $root . '/conta6/Resources/PHP/actions/tarifas_calculaALMACEN.php'; #$custodia,$manejo,$almacenaje
      $maniobras = redondear_dos_decimal($custodia + $manejo + $almacenaje);
    require $root . '/conta6/Resources/PHP/actions/tarifas_almacen_mostrarConceptos.php'; #$ConceptosAlmacen
    require $root . '/conta6/Resources/PHP/actions/tarifas_almacen_mostrarConceptosLibres.php'; #$conceptosLibresAlmacen
    //CALCULO TARIFA CLIENTE - SECCION: HONORARIOS Y SERVICIOS AL COMERCIO EXTERIOR
    require $root . '/conta6/Resources/PHP/actions/tarifas_calculaCLIENTE.php'; #$honorarios,$factor_honorarios,$descuento
    require $root . '/conta6/Resources/PHP/actions/tarifas_cliente_mostrarConceptos.php'; #$ConceptosCliente
    require $root . '/conta6/Resources/PHP/actions/tarifas_cliente_mostrarConceptosLibres.php'; #$conceptosLibresCliente
    $oRst_consultaCve = mysqli_fetch_array(mysqli_query($db,"select fk_c_ClaveProdServ from conta_cs_cuentas_mst where pk_id_cuenta = '0400-00001'"));
    $cveProdHon = $oRst_consultaCve['fk_c_ClaveProdServ'];
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
    //LISTA DE MONEDAS
    require $root . '/conta6/Resources/PHP/actions/consultaMoneda.php'; #$consultaMoneda
    //LISTA DE USO DE CFDI
    require $root . '/conta6/Resources/PHP/actions/consultaUsoCFDI_facturar.php'; #$consultaUsoCFDIfac
    $tabindex = 0;
?>

    <input type="hidden" id="tipoDocumento" value="elaborar">
    <input type="hidden" id="T_ID_Aduana_Oculto" value="<?php echo $aduana; ?>">
    <input type="hidden" id="Txt_Usuario" value="<?php echo $usuario; ?>">
    <input type="hidden" id="T_ID_Almacen_Oculto" value="<?php echo $almacen;?>">
    <input type="hidden" id="T_No_calculoTarifa" value="<?php echo $calculoTarifa;?>">
    <input type="hidden" id="docto_tipo" value="<?php echo $opcionDoc;?>">
    <input type="hidden" id="docto_id" value="<?php echo $extraerfolio;?>">
    <input type="hidden" id="IVA" value="<?PHP echo $iva;?>">
    <input type="hidden" id="IVARETENIDO" value="<?PHP echo $retencion;?>">
    <input type="hidden" id="IVA_MENOS_RETENCION" value="<?PHP echo $iva_menos_retencion;?>">
    <input type="hidden" id="IVA_GRAL" value="<?PHP echo $ivaGral;?>">


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
            <tr class='row justify-content-center encabezado font16'>
              <td class="col-md-2 text-right w-50">
                <input class="h22 text-right border-0 bt" type="text" id="T_ID_Cliente_Oculto" readonly value="<?php echo $id_cliente; ?>">
                <input class="h22 text-left border-0 bt w-50" type="text" id="T_Nombre_Cliente" readonly value="<?php echo $CLT_nombre;?>" onchange="validarStringSAT(this);quitarNoUsar(this);">
              </td>
              <td class="col-md-6 text-left w-50">
                <input class="h22 text-right border-0 bt" type="text" id="T_ID_Proveedor" readonly value="<?php echo $idProv; ?>">
                <input class="border-0 bt text-center w-100" type="text" id="T_Proveedor_Destinatario" value="<?php echo $nomProv;?>" readonly>
              </td>
            </tr>
            <tr class='row backpink' style="font-size:14px!important">
              <td class='col-md-6'>Direccion Cliente</td>
              <td class='col-md-6'>Direccion Proveedor</td>
            </tr>
          </thead>
          <tbody class='font14'>
		  	<table>
			<tr class='row'>
              <td class="w-50">
			  	<table>
					<tr class='row'>
					  <td class="col-md-4 p-0">
						<input class="w-100 border-0 bt text-left" id="T_Cliente_Calle" type="text" readonly value="<?php echo $CLT_calle;?>">
						<input class="h22 border-0 bt" id="T_Cliente_No_Ext" type="text" readonly value="<?php echo $CLT_no_ext;?>" size="5">
						<input class="h22 border-0 bt" id="T_Cliente_No_Int" type="text" readonly value="<?php echo $CLT_no_int;?>" size="25">
					  </td>
					</tr>
					</tr>
					<tr class='row'>
					  <td class='col-md-4 p-0 text-left'>
						<input class="h22 border-0 bt" id="T_Cliente_Colonia" type="text" readonly value="<?php echo $CLT_colonia;?>">
					  </td>
					</tr>
					<tr class="row">
					  <td class="p-0 text-left">
						<input class="h22 border-0 bt" id="T_Cliente_CP" type="text" readonly value="<?php echo $CLT_codigo;?>" size="6"></td>
					  </td>
					  <td class="col-md-1 p-0 text-left"><input class="h22 border-0 bt text-left p-0" id="T_Cliente_Ciudad" type="text" readonly value="<?php echo $CLT_ciudad;?>"></td>
					</tr>
					<tr class='row'>					  
					  <td class='col-md-3 p-0 text-left'>
						<input class="h22 border-0 bt" id="T_Cliente_Estado" type="text" readonly value="<?php echo $CLT_estado;?>">,
					  </td>
					</tr>
					<tr class="row">
					  <td class="col-md-4 p-0 text-left">
						<input class="h22 border-0 bt" id="T_Cliente_RFC" type="text" readonly onchange="validarRFCfac(this);" value="<?php echo $CLT_rfc;?>">
					  </td>
					</tr>
				</table>
			  </td>
              <td class="w-50">
			  	<table>
					<tr class='row'>
					  <td class="col-md-4 p-0">
						<input class="w-100 border-0 bt text-left" id="T_Proveedor_Calle" type="text" readonly value="<?php echo $calleProv;?>">
					  </td>
					</tr>
					<tr class="row">
					  <td class="text-left p-0">
						<input class="h22 border-0 bt" id="T_Proveedor_No_Ext" type="text" readonly value="<?php echo $noExtProv;?>" size="5">
					  	<input class="h22 border-0 bt" id="T_Proveedor_No_Int" type="text" readonly value="<?php echo $noIntProv;?>" size="25">
						<input class="h22 border-0 bt" id="T_Proveedor_Colonia" type="text" readonly value="<?php echo $codProv;?>">
						<input class="h22 border-0 bt" id="T_Proveedor_Pais" type="text" value="<?php echo $paisProv; ?>">
						<input class="h22 border-0 bt" id="T_Proveedor_Entidad" type="text" value="<?php echo $entidadProv; ?>">
					  </td>
					  <td class="col-md-2 text-left p-0">
						<input class="h22 border-0 bt text-left p-0" id="T_Proveedor_Ciudad" type="text" readonly value="<?php echo $ciudadProv;?>">
					  </td>
					</tr>
					<tr>
					  <td class="p-0 b text-right"><b>Phone: </b></td>
					  <td class="col-md-1 p-0 text-left">
						<input type="text" class="h22 border-0 bt" id="T_Proveedor_tel" value="<?php echo $telProv; ?>">
					  </td>
					</tr>
					<tr>
					  <td class="p-0 b text-right"><b>Fax: </b></td>
					  <td class="col-md-1 p-0 text-left">
						<input type="text" class="h22 border-0 bt" id="T_Proveedor_fax" value="<?php echo $faxProv; ?>">
					  </td>
					</tr>
				</table>
			  </td>
            </tr>
			
            
			</table>
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
              <td class="col-md-3">Póliza</td>
              <td class="col-md-3">Usuario</td>
              <td class="col-md-3">Fecha</td>
            </tr>
          </thead>
          <tbody class='font14'>
            <tr class="row">
              <td class="p-1 col-md-3 text-left b"><b>Cta. generada</b></td>
              <td class="p-1 col-md-3"></td>
              <td class="p-1 col-md-3">
                <input class="h22 bt border-0 text-center" type="text" id="T_Usuario" size="20"value="<?php echo $usuario; ?>" readonly>
              </td>
              <td class="p-1 col-md-3">
                <input class="h22 bt border-0 text-center" type="text" id="T_Fecha_Cta" size="20" value="<?php $fecha = time (); echo date ( "d-m-Y h:i:s" , $fecha );?>" readonly>
              </td>
            </tr>

            <tr class="row">
              <td class="p-1 col-md-3 text-left b"><b>Cta. modificada</b></td>
              <td class="p-1 col-md-3"></td>
              <td class="p-1 col-md-3"></td>
              <td class="p-1 col-md-3"></td>
            </tr>
            <tr class="row">
              <td class="p-1 col-md-3 text-left b"><b>Factura generada</b></td>
              <td class="p-1 col-md-3"></td>
              <td class="p-1 col-md-3"></td>
              <td class="p-1 col-md-3"></td>
            </tr>
            <tr class="row borderojo">
              <td class="p-1 col-md-3 text-left b"><b>Factura cancelada</b></td>
              <td class="p-1 col-md-3"></td>
              <td class="p-1 col-md-3"></td>
              <td class="p-1 col-md-3"></td>
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
            
            <tr class="row">
              <td class="col-md-6 p-1">Referencia: </td>
              <td class="col-md-4 p-1">
                <input class="efecto h22 text-left" type="text" id="T_Referencia" size="30" maxlength="60" value="<?php echo $id_referencia;?>" readonly>
				<input class="efecto h22 text-left" type="text" id="T_Tipo" size="4" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $tipo;?>" readonly>
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">Freight Bill: </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" type="text" id="T_Freight" maxlength="40" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $guiaMaster; ?>">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">Quantity:</td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" type="text" id="T_Quantity" size="30" maxlength="150" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php $entradas; ?>">
				Type: <input class="efecto h22 text-left" type="text" id="T_Type" size="30" maxlength="60" value="<?php echo $s_tipo; ?>" readonly>
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                Description:
              </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" id="T_Descripction" type="text" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $descripcion;?>" size="40" readonly>
              </td>
            </tr>
          </tbody>
        </table>
      </div>


      <div class='contorno'>
        <h5 class='titulo font14'>CTA. GASTOS</h5>
		
		<table width="100%" border="0" style="font-family: Trebuchet MS; font-size: 10pt; border-style: solid; border-width: 1px" bordercolor="#000000" cellspacing="0" bgcolor="#DCDCDC">
		  <tr bgcolor="#C0C0C0">
			<td colspan="3" align="center">General</td>
		  </tr>
		  <tr>
			<td>Invoice No:</td>
			<td>Invoice Value: </td>
			<td align="right"><input type="text" name="T_Invoice_Value" size="15" style="border:1px inset #808080; font-family: Trebuchet MS; font-size:10pt; text-align:right; " value="<?php echo $valor;?>" tabindex="2"></td>
		  </tr>
		  <tr>
			<td><input type="text" name="T_Invoice_No" size="15" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:10pt; text-align:center; color:#FFFFFF; background-color:#808080" readonly></td>
			<td>Date:</td>
			<td align="right">dd-mm-yyyy <input type="text" name="T_Date" size="15" style="border:1px inset #808080; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="<?php echo $fechaActual;?>" tabindex="3" required></td>
		  </tr>
		  <tr>
			<td><?php if( $opcion == "CFD" or $opcion == "Proforma" ){ echo $opcion.": ".$extraerfolio; }?></td>
			<td>Weight:</td>
			<td align="right"><input type="text" name="T_Weight" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; color:#000000; background-color:#DCDCDC" value="<?php echo number_format($peso,2,'.','');?>" readonly></td>
		  </tr>
		  <tr>
			<td>Customer Invoice:</td>
			<td colspan="2"><input type="text" name="T_Customer_Order" size="40" style="border:1px inset #808080; font-family: Trebuchet MS; font-size:10pt; text-align:left;" tabindex="4" value="<?php echo $facturas;?>"></td>
		  </tr>
		</table>
		
        <div class=''>
          <div class='acordeon2'>
            <div class='encabezado font16' data-toggle='collapse' href='#collapseOne'>
              <a href="#" id='bread'>ACCOUNT CHARGES</a>
            </div>
            <div id='collapseOne' class='card-block collapse divisor'>
    		    <!--div div id='collapseOne' -->
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
                    <a onclick="agregarImporte()" id="Btn_agregar">
                      <img src='/conta6/Resources/iconos/002-plus.svg' class='icomediano'>
                    </a>
                  </div>
                  <div class='col-md-1'></div>
                </div>
              </div>
              <form class='form1' onsubmit="return false">
                <table class='table'>
                  <thead>
                    <tr class='row mt-4 m-0 backpink'>
                      <td class='col-md-1'>SERV.</td>
                      <td class='col-md-3'>CONCEPTO</td>
                      <td class='col-md-3'>DESCRIPCION</td>
                      <td class='col-md-1'></td>
                      <td class='col-md-2'>IMPORTE</td>
                      <td class='col-md-2'>SUBTOTAL</td>
                    </tr>
                  </thead>
                  <tbody id='tbodyPOCME'>
                    <?php echo $proforma_POCME.$ctaAme_POCME.$POCME_automatico; ?>
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
      </div>
      <div class="contorno" style="margin-bottom:100px!important">
        <table class="table w-100">
          <tr>
            <td class="w-50">
              <table class="table">
                <tr class="row">
                  <td class="col-md-3 text-left pt-4"> PAGADA </td>
                  <td class="col-md-3">
                    <select id="CUSTOMS" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                        <option value='1'>Si</option>
                        <option value='0' selected>No</option>
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
                    <td class="p-1 col-md-8">
                      <input class="h22 w-100 bt text-right border-0" type="text" id="Txt_Total_Importe" size="40"readonly value="Total Honorarios y Servicios :">
                    </td>
                    <td class="col-md-2"></td>
                    <td class="p-1 col-md-2">
                      <input class="efecto h22" type="text" id="T_Total_Importes" size="20" value="0" readonly>
                    </td>
                  </tr>
                  <tr class="row">
                    <td class="p-1 col-md-8">
                      <input class="h22 w-100 bt text-right border-0" type="text" id="Txt_Total_IVA" size="40" readonly value="<?PHP echo $iva*100?>% IVA sobre Honorarios y Servicios :">
                    </td>
                    <td class="col-md-2"></td>
                    <td class="p-1 col-md-2">
                      <input class="efecto h22" type="text" id="T_Total_IVA" size="20" value="0" readonly>
                    </td>
                  </tr>

                  <tr class="row">
                    <td class="p-1 col-md-8">
                      <input class="h22 w-100 bt text-right border-0" type="text" id="Txt_SUBTOTAL_HON" size="40" readonly value="Subtotal Honorarios y Servicios :">
                    </td>
                    <td class="col-md-2"></td>
                    <td class="p-1 col-md-2">
                      <input class="efecto h22" type="text" id="T_SUBTOTAL_HON" size="20" value="0" readonly>
                    </td>
                  </tr>

                  <tr class="row">
                    <td class="p-1 col-md-8">
                      <input class="h22 w-100 bt text-right border-0" type="text" id="Txt_IVA_RETENIDO" size="40" readonly value="Retención (4%) Impto. IVA :">
                    </td>
                    <td class="col-md-2"></td>
                    <td class="p-1 col-md-2">
                      <input class="efecto h22" type="text" id="T_IVA_RETENIDO" size="20" value="0" readonly>
                    </td>
                  </tr>

                  <tr class="row">
                    <td class="p-1 col-md-8">
                      <input class="h22 w-100 bt text-right border-0" type="text" id="Txt_Total_Gral" size="40" readonly value="Total :">
                    </td>
                    <td class="col-md-2"></td>
                    <td class="p-1 col-md-2">
                      <input class="efecto h22" type="text" id="T_Total_Gral" size="20" value="0" readonly>
                    </td>
                  </tr>

                  <tr class="row">
                    <td class="p-1 col-md-8">
                      <input class="h22 w-100 bt text-right border-0" type="text" id="Txt_Total_MN_Extranjera" size="48" readonly value="Total Pagos o Cargos en Moneda Extranjera :">
                    </td>
                    <td class="col-md-2"></td>
                    <td class="p-1 col-md-2">
                      <input class="efecto h22" type="text" id="T_Total_MN_Extranjera" size="20" readonly>
                    </td>
                  </tr>

                  <tr class="row">

                    <td class="p-1 col-md-8">
                      <input class="h22 w-100 bt text-right border-0" type="text" id="Txt_Total_Pagos" size="45" readonly value="Total Pagos Realizados por su Cuenta :">
                    </td>
                    <td class="col-md-2"></td>
                    <td class="p-1 col-md-2">
                      <input class="efecto h22" type="text" id="T_Total_Pagos" size="20" value="0" readonly>
                    </td>
                  </tr>
                  <tr class="row">
                    <td class="col-md-12">
                      <input class="h22 w-100 bt text-center border-0" type="text" id="total_CuentaGastos" readonly value="<?php echo $s_total_cta_gastos_letra; ?>">
                    </td>
                  </tr>

                  <tr class="row">
                    <td class="p-1 col-md-8">
                      <input class="h22 w-100 bt text-right border-0" type="text" id="Txt_Cta_Gastos" size="40" readonly value="Total Cuenta de Gastos :">
                    </td>
                    <td class="col-md-2"></td>
                    <td class="p-1 col-md-2">
                      <input class="h22 w-100 efecto" type="text" id="T_Cta_Gastos" size="20" value="0" readonly>
                    </td>
                  </tr>
                  <tr class="row">
                    <td class="p-1 col-md-8">
                      <input class="h22 bt border-0 text-right efecto" type="text" id="Txt_Total_Anticipos" size="40" readonly value="Total Depósitos :">
                    </td>
                    <td class="col-md-2 p-1 text-right">
                      <a href="#agregarDepositos" data-toggle="modal">
                        <img src="/conta6/Resources/iconos/002-plus.svg" class="icochico">
                      </a>
                    </td>
                    <td class="p-1 col-md-2">
                      <input class="h22 w-100 efecto" type="text" id="T_Total_Anticipos" size="20" value="0" readonly>
                    </td>
                  </tr>

                  <tr class="row">
                    <td class="p-1 col-md-8">
                      <input class="h22 bt border-0 text-right efecto" type="text" id="Txt_Saldo_Gral" size="10" readonly value="Saldo :">
                    </td>
                    <td class="col-md-2 p-1 text-right"></td>
                    <td class="p-1 col-md-2">
                      <input class="h22 efecto" type="text" id="T_SALDO_GRAL" size="20" value="0" readonly>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </table>

        <div class="row justify-content-center">
          <div class="col-md-3">
            <input class="efecto boton validarstring" type='button' value="GUARDAR" onclick="validarStringSAT(this);quitarNoUsar(this);" id="guardar-cta" tabindex="<?php echo $tabindex = $tabindex+1; ?>"/>
          </div>
          <!-- <div id="mensaje"></div> -->
        </div>
      </div>
    </div>


    <?php
      require $root . '/conta6/Resources/PHP/actions/depositos_sinAplicar.php';
      require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/modales/depositos.php';
      require $root . '/conta6/Ubicaciones/footer.php';
    ?>
