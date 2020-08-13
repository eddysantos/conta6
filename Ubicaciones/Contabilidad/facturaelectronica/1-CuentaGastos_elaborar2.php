<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Ubicaciones/barradenavegacion.php';


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
	$opcion = trim($_GET['opcion']);
	$tasa = trim($_GET['tasa']);

  $id_cliente = trim($_GET['id_cliente']);
  $id_referencia = trim($_GET['referencia']);

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

  require $root . '/Resources/PHP/actions/validarFormulario.php';


  if($referencia != "SN"){
  			require $root . '/Resources/PHP/actions/consultaDatosReferenciaProveedor.php';

        if( $rows_datosRefProv > 0 ){
          $row_datosRefProv = $rslt_datosRefProv->fetch_assoc();

            $id_clienteReferencia = $row_datosRefProv['fk_id_cliente'];
      			$status_Flete = $row_datosRefProv['s_status_flete'];
      			$valor = limpiarBlancos($row_datosRefProv['n_valor_aduana']);
      			$peso = limpiarBlancos($row_datosRefProv['n_peso']);
      			$volumen = $row_datosRefProv['n_volumen'];
      			$aduana = $row_datosRefProv['fk_id_aduana'];
      			$descripcion = cortarCadena($row_datosRefProv['s_descripcion'],25);
      			$guiaMaster = limpiarBlancos($row_datosRefProv['s_guia_master']);
      			$facturas = cortarCadena($row_datosRefProv['s_facturas'],25);
      			$procedencia = limpiarBlancos($row_datosRefProv['s_procedencia']);
      			$referenciaCliente = limpiarBlancos($row_datosRefProv['s_referencia_cliente']);
      			$pedimento = limpiarBlancos($row_datosRefProv['s_pedimento']);
      			$tipoCambio = $row_datosRefProv['n_tipo_cambio'];
            $tipo = limpiarBlancos($row_datosRefProv['s_imp_exp']);
            $almacen = limpiarBlancos($row_datosRefProv['fk_almacen_seccion']);
            $nomProv = $row_datosRefProv['s_NOMBRE'];

            $fechaEntrada =  $row_datosRefProv['d_fecha_entrada'];
            if (!is_null($fechaEntrada)){
              $fechaEntrada = date_format(date_create($fechaEntrada),"d-m-Y");
            }else{
              $fechaEntrada = '';
            }
        }

        if(!is_null($fechaEntrada)){
          $fechaEntrada = date_format(date_create($fechaEntrada),"d-m-Y");
        }else{
  				$fechaEntrada = "";
  			}

  			if( trim($tipo) == 'E'){ $tipo = "EXP"; }else{ $tipo = "IMP"; }

  			if( $almacen > 0 ){
          require $root . '/Resources/PHP/actions/consultaDatosAlmacen.php';
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
  			$aduana = $oficina;
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

      //datos del cliente
      require $root . '/Resources/PHP/actions/consultaDatosCliente.php';
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

      }

      //IVA
      require $root . '/Resources/PHP/actions/consultaDatosIVA.php';
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

      /* SACO UN FOLIO DE CALCULO DE TARIFA, ESTE FOLIO ME SERVIRA PARA PODER IDENTIFICAR LOS FILTROS DE LAS TARIFAS */
      $s_tipoDoc = 'ctaGastos';
      //require $root . '/Resources/PHP/actions/tarifas_generarFolio.php';
      $calculoTarifa = 45;


      #******************** PAGOS O COBROS EN MONEDA EXTRANJERA ********************
      //CALCULO TARIFA DEL CLIENTE - SECCION: POCME
      $id_cliente_usar = $id_cliente;
      require $root . '/Resources/PHP/actions/tarifas_calculaPOCME.php';
      require $root . '/Resources/PHP/actions/tarifas_consultaPOCME_cliente.php'; #$tarifaPOCMEcliente

      //CALCULO TARIFA GENERAL - SECCION: POCME
      $id_cliente_usar = 'CLT_5900'; #CLIENTES DIVERSOS
      $consolidado = 'LTL/FTL';
      require $root . '/Resources/PHP/actions/tarifas_calculaPOCME.php';
      require $root . '/Resources/PHP/actions/tarifas_consultaPOCME_general.php'; #$tarifaPOCMEgeneral

      //EXTRAER FACTURA-CTA AME-PROFORMA
      #PENDIENTE
      #include ("../../include/procesos/SP_CTA_AME_TARIFA_HONORARIOS_EXTRAER.php");
      // if($opcion == "Proforma"){
    	// 	# LISTA DE CONCEPTOS
    	// 	$sql_Conceptos=mysqli_query($db,"SELECT id_conceptoCta, cantidad, concepto_esp, concepto_eng, descrip, importe, total
    	// 										FROM TBL_CTA_AME_CONCEPTOS_TARIFA_ValoresExtraer
    	// 										WHERE ID_PROFORMA = $extraerfolio and id_calculo = $calculoTarifa");
      //  }
      //
      // 	if($opcion == "ctaAme"){
      // 		# LISTA DE CONCEPTOS
      // 		$sql_Conceptos=mysqli_query($db,"SELECT id_conceptoCta, cantidad, concepto_esp, concepto_eng, descrip, importe, total
      // 											FROM TBL_CTA_AME_CONCEPTOS_TARIFA_ValoresExtraer
      // 											WHERE ID_FACTURA = $extraerfolio and id_calculo = $calculoTarifa");
      // 	}

      if($opcion == "cliente" || $opcion == "clt_ame" ){
        require $root . '/Resources/PHP/actions/tarifas_calculaPOCME_delete.php';
      }

      # PARA LA OFICINA DE NUEVO LAREDO ESTOS CONCEPTOS SE CARGAN EN AUTOMATICO
      require $root . '/Resources/PHP/actions/tarifas_calculaPOCME_mostrarConceptos.php';
      $idFila=0;
      if( $oficina == 240 ){
      	while ($oRst_Conceptos = $rslt_Conceptos->fetch_assoc()) {
      		$idFila = $idFila + 1;
      		$ID_CONCEPTOcta = $oRst_Conceptos['fk_idconceptoCta'];
      		$CONCEPTOcta = trim($oRst_Conceptos['s_concepto_esp']);
      		$CONCEPTOctaEng = trim($oRst_Conceptos['s_concepto_eng']);
      		$cantidad = $oRst_Conceptos['n_cantidad'];
      		$buscar = 'flete';
      		$parteBuscar = strripos($CONCEPTOcta,$buscar);
      		$importe = number_format($oRst_Conceptos['n_importe'], 2, '.', '');
      		$subtotal = number_format($cantidad * $importe, 2, '.', '');
      		$descripcion = trim($oRst_Conceptos['s_desc_cobros']);

      		#if ($parteBuscar !== false) { $descripcion = $transporteUS; }
      		if( (is_null($descripcion) || $descripcion == '' ) && $importe == 0 ){ $descripcion = ""; }

      		if( (is_null($ID_CONCEPTOcta) || $ID_CONCEPTOcta == '' ) && $importe > 0 ){
      			$ID_CONCEPTOcta = 'HNS_11'; #Ingresos por otros conceptos total
      		}

      		if($opcion == "cliente" || $opcion == "clt_ame" || $opcion == "corresponsal"){
      			#EJEMPLO 5 entradas. se cobra: 1 entrada y 4 entradas adicionales. Para mostrar 1 entreda debe en "SI" inbond
      			if( $ID_CONCEPTOcta == 'HNS_8' and $entradasAdicionales > 0){ $cantidad = $entradasAdicionales; }
      			$subtotal = number_format($cantidad * $importe, 2, '.', '');
      		}

      	  $POCME_automatico .= "
      	  <tr id='$idFila' onmouseover='cambiar_color_over(this)' onmouseout='cambiar_color_out(this)' align='center'>
      		  <td align='center'>
              <input type='text' id='T_POCME_Cantidad$idFila' value='$cantidad' class='T_POCME_CANTIDAD' onblur='validaSoloNumeros(this);importe_POCME();' size='4' style='border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center;' >
            </td>
        		<td>
              <input type='hidden' id='T_POCME_idTipoCta$idFila' value='$ID_CONCEPTOcta' class='T_POCME_CUENTAS'/>
              <input type='text' id='T_POCME_Concepto$idFila' value='$CONCEPTOcta' class='T_POCME_CONCEPTOS' size='45' style='border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; background-color:#DCDCDC' readonly/>
              <input type='hidden' id='T_POCME_ConceptoEng$idFila' value='$CONCEPTOctaEng' class='T_POCME_CONCEPTOS_ENG'/>
            </td>
        		<td>
              <input type='text' id='T_POCME_Descripcion$idFila' value='$descripcion' maxlength='40' class='T_POCME_DESCRIPCION' size='45' style='border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; '  />
            </td>
        		<td align='center'>
              <a href='javascript:limpiarCampos(1,$idFila)'><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>
            </td>
        		<td align='center'>
              <input type='text' id='T_POCME_Importe$idFila' value='$importe' class='T_POCME_IMPORTES' onblur='validaIntDec(this);validaDescImporte(this.form.T_POCME_Concepto$idFila,this.form.T_POCME_Importe$idFila);importe_POCME();cortarDecimalesObj(this.form.T_POCME_Importe$idFila,2);' size='17' style='border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; '  />
            </td>
        		<td align='center'>
              <input type='text' id='T_POCME_Subtotal$idFila' value='$subtotal' class='T_POCME_SUBTOTALES' size='17' style='border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC' readonly/>
            </td>
      	  </tr>
      	   ";
      	}
      }

      $idFila = $idFila + 1;
    	for ($idFilaBlanco = $idFila;  $idFilaBlanco <= 8; $idFilaBlanco++) {
        $POCME_lineas .= "
    	  <tr id='$idFilaBlanco' onmouseover='cambiar_color_over(this)' onmouseout='cambiar_color_out(this)' align='center'>
      		<td align='center'>
            <input type='text' id='T_POCME_Cantidad$idFilaBlanco' class='T_POCME_CANTIDAD' onblur='validaSoloNumeros(this);importe_POCME();' size='4' style='border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center; ' value='' tabindex='$tabindex = $tabindex+1'/>
          </td>
      		<td>
            <input type='hidden' id='T_POCME_idTipoCta$idFilaBlanco' value='' class='T_POCME_CUENTAS'/>
            <input type='text' id='T_POCME_Concepto$idFilaBlanco' value='' class='T_POCME_CONCEPTOS' size='45' style='border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; background-color:#DCDCDC' readonly/>
            <input type='hidden' id='T_POCME_ConceptoEng$idFilaBlanco' value='' class='T_POCME_CONCEPTOS_ENG'/>
          </td>
      		<td>
            <input type='text' id='T_POCME_Descripcion$idFilaBlanco' class='T_POCME_DESCRIPCION' onblur='this.form.T_POCME_Subtotal$idFilaBlanco.focus();' size='45' style='border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; ' value='' maxlength='40' tabindex='$tabindex = $tabindex+1'/>
          </td>
      		<td align='center'>
            <a href='javascript:limpiarCampos(1,$idFilaBlanco)'><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>
          </td>
      		<td align='center'>
            <input type='text' id='T_POCME_Importe$idFilaBlanco' class='T_POCME_IMPORTES' onblur='validaIntDec(this);validaDescImporte(this.form.T_POCME_Concepto$idFilaBlanco,this.form.T_POCME_Importe$idFilaBlanco);importe_POCME();cortarDecimalesObj(this.form.T_POCME_Importe$idFilaBlanco,2);' size='17' style='border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; ' value='' tabindex='$tabindex = $tabindex+1' />
          </td>
      		<td align='center'>
            <input type='text' id='T_POCME_Subtotal$idFilaBlanco' class='T_POCME_SUBTOTALES' size='17' style='border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC' value='' readonly/>
          </td>
    	  </tr>
        ";
    	}



      //CALCULO TARIFA ALMACEN - SECCION: PAGOS REALIZADOS POR SU CUENTA
      require $root . '/Resources/PHP/actions/tarifas_calculaALMACEN.php'; #$custodia,$manejo,$almacenaje
        $maniobras = redondear_dos_decimal($custodia + $manejo + $almacenaje);

      require $root . '/Resources/PHP/actions/tarifas_almacen_mostrarConceptos.php'; #$ConceptosAlmacen
      require $root . '/Resources/PHP/actions/tarifas_almacen_mostrarConceptosLibres.php'; #$conceptosLibresAlmacen


      //CALCULO TARIFA CLIENTE - SECCION: HONORARIOS Y SERVICIOS AL COMERCIO EXTERIOR
      require $root . '/Resources/PHP/actions/tarifas_calculaCLIENTE.php'; #$honorarios,$factor_honorarios,$descuento
      require $root . '/Resources/PHP/actions/tarifas_cliente_mostrarConceptos.php'; #$ConceptosCliente
      require $root . '/Resources/PHP/actions/tarifas_cliente_mostrarConceptosLibres.php'; #$conceptosLibresCliente

			$oRst_consultaCve = mysqli_fetch_array(mysqli_query($db,"select fk_c_ClaveProdServ from conta_cs_cuentas_mst where pk_id_cuenta = '0400-00001'"));
			$cveProdHon = $oRst_consultaCve['fk_c_ClaveProdServ'];


      //forma de pago del cliente
      require $root . '/Resources/PHP/actions/consultaDatosCliente_formaPago.php';
      if ($rows_datosCLTformaPago > 0) {
          $datosCLTformaPago = "<option selected value='0'>Forma de pago</option>";
        while ($row_datosCLTformaPago = $rslt_datosCLTformaPago->fetch_assoc()) {
          $id_formaPago = $row_datosCLTformaPago['fk_id_formapago'];
    			$concepto = $row_datosCLTformaPago['s_concepto'];
          $datosCLTformaPago .= '<option value="'.$id_formaPago.'">'.$concepto.' --- '.$id_formaPago.'</option>';
        }
      }

      //LISTA DE MONEDAS
      require $root . '/Resources/PHP/actions/consultaMoneda.php'; #$consultaMoneda
      //LISTA DE USO DE CFDI
      require $root . '/Resources/PHP/actions/consultaUsoCFDI_facturar.php'; #$consultaUsoCFDIfac

      $tabindex = 0;
?>
<body>
<input type="hidden" id="T_ID_Cliente_Oculto" value="<?php echo $id_cliente; ?>">
<input type="hidden" id="T_ID_Aduana_Oculto" value="<?php echo $aduana; ?>">
<input type="hidden" id="Txt_Usuario" value="<?php echo $usuario; ?>">
<input type="hidden" id="T_ID_Almacen_Oculto" value="<?php echo $almacen;?>">
<input type="hidden" id="T_No_calculoTarifa" value="<?php echo $calculoTarifa;?>">
<input type="hidden" id="docto_tipo" value="<?php echo $opcion;?>">
<input type="hidden" id="docto_id" value="<?php echo $extraerfolio;?>">

<table width="100%" border="0" bgcolor="#7F7F7F" style="border-collapse:collapse; font-family: Trebuchet MS; font-size:10pt; color:#FFFFFF; text-align:center; border: 1px solid #000000;" >
  <tr>
    <td>Almac&eacute;n</td>
    <td colspan="10" bgcolor="#C0C0C0" align="left">
		<input type="text" id="T_Nombre_Almacen" size="80" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#C0C0C0" value="<?php echo $almacenNombre; ?>"/>
	</td>
  </tr>
  <tr>
    <td>Aduana</td>
    <td bgcolor="#C0C0C0">
      <input type="text" id="T_Aduana" size="5" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:center; color:#000000; background-color:#C0C0C0" value="<?php echo $aduana;?>" />
    </td>
    <td>Tipo</td>
    <td bgcolor="#C0C0C0">
	<input type="text" id="T_Tipo" size="8" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:center; color:#000000; background-color:#C0C0C0" value="<?php echo $tipo;?>"></td>
    <td>Valor</td>
    <td bgcolor="#C0C0C0">
      <input type="text" id="T_Valor" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:center; color:#000000; background-color:#C0C0C0" value="<?php echo $valor;?>" />
    </td>
    <td>Peso</td>
    <td bgcolor="#C0C0C0">
      <input type="text" id="T_Peso" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:center; color:#000000; background-color:#C0C0C0" value="<?php echo $peso;?>" />
    </td>
    <td>D&iacute;as</td>
    <td bgcolor="#C0C0C0">
      <input type="text" id="T_Dias" size="5" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:center; color:#000000; background-color:#C0C0C0" value="<?php echo $dias;?>" />
    </td>
  </tr>
</table>

<br>
<table width="100%">
  <tr>
	<td valign="top">
    <!-- ******************** CLIENTE *****************-->
		<table width="100%" border="0" bgcolor="#C0C0C0" cellpadding="0" cellspacing="1" style="font-family: Trebuchet MS; font-size:8pt; color:#FFFFFF; border: 1px solid #000000;">
			  <tr>
				<td colspan="6" align="center" bgcolor="#7F7F7F">CLIENTE</td>
	      </tr>
			  <tr>
			  	<td bgcolor="#7F7F7F">Nombre:</td>
				<td colspan="5">
          <input type="text" id="T_Nombre_Cliente" size="85" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#C0C0C0" readonly value="<?php echo $CLT_nombre;?>" onchange="validarStringSAT(this);quitarNoUsar(this);"/></td>
			  </tr>
			  <tr>
				<td bgcolor="#7F7F7F">Calle:</td>
				<td>
          <input id="T_Cliente_Calle" type="text" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#C0C0C0" readonly value="<?php echo $CLT_calle;?>" size="45" /></td>
				<td bgcolor="#7F7F7F">Ext:</td>
				<td>
          <input id="T_Cliente_No_Ext" type="text" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#C0C0C0" readonly value="<?php echo $CLT_no_ext;?>" size="15" /></td>
				<td bgcolor="#7F7F7F">Int:</td>
				<td>
          <input id="T_Cliente_No_Int" type="text" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#C0C0C0" readonly value="<?php echo $CLT_no_int;?>" size="15" /></td>
			  </tr>
			  <tr>
				<td bgcolor="#7F7F7F">Col.:</td>
				<td colspan="3">
          <input id="T_Cliente_Colonia" type="text" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#C0C0C0" readonly value="<?php echo $CLT_colonia;?>" size="55" /></td>
				<td bgcolor="#7F7F7F">C.P.</td>
				<td>
          <input id="T_Cliente_CP" type="text" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#C0C0C0" readonly value="<?php echo $CLT_codigo;?>" size="15" /></td>
			  </tr>
			  <tr>
				<td bgcolor="#7F7F7F">Ciudad:</td>
				<td colspan="5">
          <input id="T_Cliente_Ciudad" type="text" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#C0C0C0" readonly value="<?php echo $CLT_ciudad;?>" size="85" /></td>
			  </tr>
			  <tr>
				<td bgcolor="#7F7F7F">Estado:</td>
				<td>
          <input id="T_Cliente_Estado" type="text" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#C0C0C0" readonly value="<?php echo $CLT_estado;?>" size="45" /></td>
				<td bgcolor="#7F7F7F">País:</td>
				<td>
          <input id="T_Cliente_Pais" type="text" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#C0C0C0" readonly value="<?php echo $CLT_pais;?>" size="15" /></td>
				<td bgcolor="#7F7F7F">R.F.C.</td>
				<td>
          <input id="T_Cliente_RFC" type="text" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:left; color:#000000; background-color:#C0C0C0" readonly onchange="validarRFCfac(this);" value="<?php echo $CLT_rfc;?>" size="15" /></td>
			  </tr>
		</table>

			<br>
      <!--************************ PROVEEDOR ***************** -->
			<table width="100%" border="0" bgcolor="#C0C0C0" style="border-collapse:collapse; font-family: Trebuchet MS; font-size:10pt; color:#FFFFFF; border: 1px solid #000000;" >
			  <tr align="center">
				<td colspan="3" bgcolor="#7F7F7F">PROVEEDOR (IMP) O DESTINATARIO (EXP)</td>
			  </tr>
			  <tr align="center">
				<td colspan="3"><input type="text" id="T_Proveedor_Destinatario" size="85" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; text-align:center; background-color:#C0C0C0;" value="<?php echo $nomProv;?>" readonly></td>
			  </tr>
			</table>
	</td>
  <td valign="top">
<!--******************* DATOS REFERENCIA ******************* -->
				<table border="0" width="100%" id="table81" cellspacing="0" style="border-collapse: collapse;  font-family: Trebuchet MS; font-size:10pt; border: 1px solid #000000;">
					<tr>
						<td colspan="2" bgcolor="#808080" align="center" style="color:#FFFFFF">INFORMACI&Oacute;N GENERAL DEL EMBARQUE</td>
					</tr>
					<tr>
						<td width="50%" align="right">
						<input type="text" id="T_IGET_0" size="30" maxlength="60" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; background-color:#C0C0C0;" value="Aduana:" readonly></td>
						<td width="50%">
						<input type="text" id="T_IGED_0" size="30" maxlength="60" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:left; background-color:#C0C0C0;" value="<?php echo $aduana;?>" readonly></td>
					</tr>
					<tr>
						<td width="50%" align="right">
						<input type="text" onblur="Valores_Nokia()" id="T_IGET_1" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this;" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " value="Nuestra Referencia:"></td>
						<td width="50%">
						<input type="text" id="T_IGED_1" size="30" maxlength="60" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:left; background-color:#C0C0C0;" value="<?php echo $id_referencia;?>" readonly></td>
					</tr>
					<tr>
						<td width="50%" align="right">
						<input type="text" id="T_IGET_2" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " value="Descripción General:"></td>
						<td width="50%"><input type="text" id="T_IGED_2" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; " tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $descripcion; ?>..."/></td>
					</tr>
					<tr>
						<td width="50%" align="right"><input type="text" id="T_IGET_3" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " value="Peso en Kg.:"></td>
						<td width="50%"><input type="text" id="T_IGED_3" size="30" maxlength="150" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; " tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $peso; ?>"></td>
					</tr>
					<tr>
						<td width="50%" align="right"><input type="text" id="T_IGET_4" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " value="Tipo de Operación:" /></td>
						<td width="50%"><input type="text" id="T_IGED_4" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; " tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $tipo;?>"></td>
					</tr>
					<tr>
						<td width="50%" align="right"><input type="text" id="T_IGET_5" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " value="Talones, Guía o B/Ls:"></td>
						<td width="50%"><input id="T_IGED_5" type="text" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; " tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $guiaMaster;?>" size="30" maxlength="60"></td>
					</tr>
					<tr>
						<td width="50%" align="right"><input type="text" id="T_IGET_6" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " value="Facturas:"></td>
						<td width="50%"><input id="T_IGED_6" type="text" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; " tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $facturas;?>..." size="30" maxlength="60"></td>
					</tr>
					<tr>
						<td width="50%" align="right"><input type="text" id="T_IGET_7" size="30" maxlength="100" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " value="Fecha Arribo o Salida:"></td>
						<td width="50%"><input id="T_IGED_7" type="text" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; " tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $fechaEntrada; ?>" size="30" maxlength="100"></td>
					</tr>
					<tr>
						<td width="50%" align="right"><input type="text" id="T_IGET_8" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " value="Procedencia o Destino:"></td>
						<td width="50%"><input id="T_IGED_8" type="text" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; " tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $procedencia;?>" size="30" maxlength="60"></td>
					</tr>
					<tr>
						<td width="50%" align="right"><input type="text" id="T_IGET_9" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " value="No. Pedimento:"></td>
						<td width="50%"><input id="T_IGED_9" type="text" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; " tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $pedimento;?>" size="30" maxlength="250"></td>
					</tr>
					<tr>
						<td width="50%" align="right"><input type="text" id="T_IGET_10" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " value="Su Referencia:"></td>
						<td width="50%"><input id="T_IGED_10" type="text" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; " tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $referenciaCliente;?>" size="30" maxlength="250"></td>
					</tr>
					<tr>
						<td width="50%" align="right"><input type="text" id="T_IGET_12" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " value="Clase de Mercancía:"></td>
						<td width="50%"><input id="T_IGED_12" type="text" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; " tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="" size="30" maxlength="250"></td>
					</tr>
					<tr>
						<td width="50%" align="right"><input type="text" id="T_IGET_13" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " value="Bill of lading:"></td>
						<td width="50%"><input id="T_IGED_13" type="text" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; " tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="" size="30" maxlength="250"></td>
					</tr>
					<tr>
						<td width="50%" align="right"><input type="text" id="T_IGET_11" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " value="Valor en M.N.:"></td>
						<td width="50%"><input id="T_IGED_11" type="text" onblur="validaIntDec(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:9pt; text-align:right; " tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $valor;?>" size="30" maxlength="60" /></td>
					</tr>
				</table>
	</td>
  </tr>
</table>
<br>
<table width="100%" border="0" style="font-family: Trebuchet MS; font-size: 10pt; border-style: solid; border-width: 1px; color:#FFFFFF" bordercolor="#000000" cellspacing="0">
  <tr bgcolor="#808080" align="center">
  <td colspan="4">PAGOS O CARGOS EN MONEDA EXTRANJERA</td>
  </tr>

  <tr>
  <td colspan="2" align="center" bgcolor="#C0C0C0">
      <select size="1" id="Lst_tarifa_cliente" style="font-family: Trebuchet MS; font-size: 10pt" onChange="tarifaCliente()">
        <?php echo $tarifaPOCMEcliente; ?>
      </select>
    </select></td>
  <td colspan="2" align="center" bgcolor="#C0C0C0"><select size="1" id="Lst_tarifa_general" style="font-family: Trebuchet MS; font-size: 10pt" onchange="tarifaGeneral()">
    <?php echo $tarifaPOCMEgeneral; ?>
  </select></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#DCDCDC">
      <input type="text" id="T_no_calculo" onBlur="validaSoloNumeros(this);" size="4" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center; " value="">
      <input type="hidden" id="T_POCME_Cta" />
    </td>
    <td align="center" bgcolor="#DCDCDC">
    	 <input type="text" id="T_POCME" size="60" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; background-color:#DCDCDC">
  	   <input type="hidden" id="T_POCME_Eng"></td>
    <td align="center" bgcolor="#DCDCDC">
    	<input type="text" id="T_POCME_Valor" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;" onblur="validaIntDec(this);cortarDecimalesObj(this,2);" size="15" />
    </td>
    <td align="center" bgcolor="#DCDCDC">
      <input type="button" id="Btn_agregar" style="font-size: 10pt; font-family:Trebuchet MS" title="Agregar"  onclick="agregarImporte()" value="Add" />
    </td>
  </tr>
</table>


<p style="font-family: Trebuchet MS; font-size: 5pt;"></p>
<table width="100%" border="0" style="font-family: Trebuchet MS; font-size: 10pt; border-style: solid; border-width: 1px;" bordercolor="#000000" cellspacing="0">
	   <tr align="center" bgcolor="#C0C0C0">
		<td>SERVI.</td>
		<td>CONCEPTO</td>
		<td>DESCRIPCI&Oacute;N</td>
		<td>&nbsp;</td>
		<td>IMPORTE</td>
		<td>SUBTOTAL</td>
	  </tr>
    <?php echo $POCME_automatico; ?>
    <?php echo $POCME_lineas; ?>
</table>

<p style="font-family: Trebuchet MS; font-size: 5pt;"></p>
<!-- ******************** TIPO DE CAMBIO ***************-->
<table  width="100%" border="0" style="border-collapse:collapse; font-family: Trebuchet MS; font-size:10pt; border: 1px solid #000000;" >
  <tr bgcolor="#C0C0C0">
    <td align="center" width="10%">&nbsp;</td>
    <td align="center" width="30%">
      <input type="text" id="Txt_POCME_Total" size="15"  style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center; background-color:#C0C0C0;" value="Total" readonly >
      <input type="text" id="T_POCME_Total" size="17" onBlur="validaIntDec(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; background-color:#DCDCDC" value="0" readonly>
    </td>
    <td align="center" width="40%">
      <input id="Txt_POCME_Tipo_Cambio" type="text" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center; background-color:#C0C0C0;" value="Al Tipo de Cambio" size="25" readonly>
      <input id="T_POCME_Tipo_Cambio" type="text" style="font-family: Trebuchet MS; font-size:10pt; text-align:right;" tabindex="<?php echo $tabindex = $tabindex+1; ?>" onBlur="validaIntDec(this);Suma_POCME();Conversion_Tipo_Cambio();" value="<?php echo $tipoCambio;?>" size="17" />
    </td>
    <td align="center" width="20%">Total MN
      <input type="text" id="T_POCME_Total_MN" size="17" onBlur="validaIntDec(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; background-color:#DCDCDC" value="0" readonly>
    </td>
  </tr>
</table>

<p style="font-family: Trebuchet MS; font-size: 5pt;"></p>
<!-- ******************** CARGOS A LA CUENTA "TARIFA DE ALMACENES" ***************************-->
<table border="0" width="100%" style="font-family: Trebuchet MS; font-size:10pt; background-color:#C0C0C0; border: 1px solid #000000;" >
  <tr>
    <td colspan="5" style="color:#FFFFFF; background-color:#808080;" align="center">PAGOS REALIZADOS POR SU CUENTA</td>
  </tr>
  <tr>
    <td>Almacen&nbsp;</td>
		<td><select size="1" id="Lst_Conceptos" style="font-family: Trebuchet MS; font-size: 10pt" onchange ="document.Proforma_1.T_Valor_Concepto_Gral.value= document.Proforma_1.Lst_Conceptos.value; document.Proforma_1.T_CA.value = document.Proforma_1.Lst_Conceptos.options[document.Proforma_1.Lst_Conceptos.selectedIndex].text;">
          <?php echo $ConceptosAlmacen; ?>
        </select></td>
		<td align="center">Custodia</td>
		<td align="center">Maniobras</td>
		<td align="center">Almacenaje</td>
  </tr>

  <tr>
    <td>Libres&nbsp;</td>
		<td><select size="1" id="Lst_CA" style="font-family: Trebuchet MS; font-size:10pt;" onchange="document.Proforma_1.T_CA.value = document.Proforma_1.Lst_CA.options[document.Proforma_1.Lst_CA.selectedIndex].text; document.Proforma_1.T_Valor_Concepto_Gral.value=0;">
          <?php echo $conceptosLibresAlmacen; ?>
        </select></td>
		<td align="center"><input type="text" id="T_Valor_Custodia_Aer" size="13" onblur="cortarDecimalesObj(this.form.T_Valor_Custodia_Aer,2);this.form.T_Valor_Manejo_Aer.focus();totalManiobras();" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="<?php echo $custodia; ?>" /></td>
		<td align="center"><input type="text" id="T_Valor_Manejo_Aer" size="13" onblur="cortarDecimalesObj(this.form.T_Valor_Manejo_Aer,2);this.form.T_Valor_Almacenaje_Aer.focus();totalManiobras();" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="<?php echo $manejo; ?>" /></td>
		<td align="center"><input type="text" id="T_Valor_Almacenaje_Aer" size="13" onblur="cortarDecimalesObj(this.form.T_Valor_Almacenaje_Aer,2);this.form.T_Valor_Total_Maniobras.focus();totalManiobras();" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;"  value="<?php echo $almacenaje; ?>" /></td>
  </tr>
  <tr align="center">
      <td align="right">CONCEPTO&nbsp;&nbsp;&nbsp;</td>
      <td align="left">&nbsp;&nbsp;&nbsp;IMPORTE</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Total</td>
    </tr>
    <tr align="center">
      <td align="right">
        <input type="text" id="T_CA" size="60" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; " readonly>
      </td>
      <td align="left">
        <input type="text" id="T_Valor_Concepto_Gral" onblur="cortarDecimalesObj(this.form.T_Valor_Concepto_Gral,2)" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center; ">&nbsp;</td>
      <td><input type=button value="Add" id="Btn_Cargo" onclick="agregarCargo();sumaGeneral();" style="font-family: Trebuchet MS; font-size: 10pt; color: #000000;" /></td>
      <td>&nbsp;</td>
      <td><input type="text" id="T_Valor_Total_Maniobras" onblur="Pasa_Valor_Maniobras()" size="13" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="<?php echo $maniobras;?>" readonly /></td>
    </tr>
</table>

<br>
<table border="0" width="100%" style="font-family: Trebuchet MS; font-size:10pt; border: 1px solid #000000;" cellspacing="0">
		<tr align="center" bgcolor="#C0C0C0">
			<td width="55%" colspan="2" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONCEPTOS</td>
			<td width="15%">&nbsp;</td>
			<td width="15%">&nbsp;</td>
			<td width="15%">SUBTOTAL</td>
		</tr>


		<tr id="9" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td colspan="2" align="left" style="color:#000000;"><b>&nbsp;&nbsp;Impuestos Afianzados o Subsidiados</b></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td align="center"><input type="text" id="T_Subsidio" size="20" onblur="validaIntDec(this);cortarDecimalesObj(this,2);Suma_Subtotales();" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"></td>
		</tr>


		<tr id="10" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td><input type="text" id="T_Cargo_1" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Cargo_1);eliminaBlancoFin(this.form.T_Cargo_1);eliminaBlancosIntermedios(this.form.T_Cargo_1);" class="T_Cargo" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;" value="Impuestos y/o derechos pagados o garantizados al Com. Ext." readonly>&nbsp;</td>
			<td><a href="javascript:limpiarCampos('C1')"><img class='icochico' src='/Resources/iconos/002-trash.svg' /></a></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="15%" align="center"><input type="text" id="T_Cargo_13" size="20" onblur="validaIntDec(this);cortarDecimalesObj(this.form.T_Cargo_13,2);Suma_Subtotales();" class="T_Cargo_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"></td>
		</tr>


		<tr id="11" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
		  <td width="25%"><input type="text" id="T_Cargo_2" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Cargo_2);eliminaBlancoFin(this.form.T_Cargo_2);eliminaBlancosIntermedios(this.form.T_Cargo_2);" class="T_Cargo" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;" /></td>
			<td width="25%"><a href="javascript:limpiarCampos('C2')"><img class='icochico' src='/Resources/iconos/002-trash.svg' /></a></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="15%" align="center">
			<input type="text" id"T_Cargo_23" size="20" onblur="validaIntDec(this);validaDescImporte(this.form.T_Cargo_2,this.form.T_Cargo_23);cortarDecimalesObj(this.form.T_Cargo_23,2);Suma_Subtotales();" class="T_Cargo_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"></td>
		</tr>


		<tr id="12" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td width="25%"><input type="text" id="T_Cargo_3" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Cargo_3);eliminaBlancoFin(this.form.T_Cargo_3);eliminaBlancosIntermedios(this.form.T_Cargo_3);" class="T_Cargo" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;">&nbsp;</td>
			<td width="25%"><a href="javascript:limpiarCampos('C3')"><img class='icochico' src='/Resources/iconos/002-trash.svg' /></a></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="15%" align="center"><input type="text" id"T_Cargo_33" size="20" onblur="validaIntDec(this);validaDescImporte(this.form.T_Cargo_3,this.form.T_Cargo_33);cortarDecimalesObj(this.form.T_Cargo_33,2);Suma_Subtotales();" class="T_Cargo_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"/></td>
		</tr>


		<tr id="13" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td width="25%"><input type="text" id="T_Cargo_4" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Cargo_4);eliminaBlancoFin(this.form.T_Cargo_4);eliminaBlancosIntermedios(this.form.T_Cargo_4);" class="T_Cargo" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;">&nbsp;</td>
			<td width="25%"><a href="javascript:limpiarCampos('C4')"><img class='icochico' src='/Resources/iconos/002-trash.svg' /></a></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="15%" align="center"><input type="text" id"T_Cargo_43" size="20" onblur="validaIntDec(this);validaDescImporte(this.form.T_Cargo_4,this.form.T_Cargo_43);cortarDecimalesObj(this.form.T_Cargo_43,2);Suma_Subtotales();" class="T_Cargo_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"></td>
		</tr>


		<tr id="14" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td width="25%"><input type="text" id="T_Cargo_5" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Cargo_5);eliminaBlancoFin(this.form.T_Cargo_5);eliminaBlancosIntermedios(this.form.T_Cargo_5);" class="T_Cargo" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;">&nbsp;</td>
			<td width="25%"><a href="javascript:limpiarCampos('C5')"><img class='icochico' src='/Resources/iconos/002-trash.svg' /></a></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="15%" align="center"><input type="text" id"T_Cargo_53" size="20" onblur="validaIntDec(this);validaDescImporte(this.form.T_Cargo_5,this.form.T_Cargo_53);cortarDecimalesObj(this.form.T_Cargo_53,2);Suma_Subtotales();" class="T_Cargo_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"></td>
		</tr>


		<tr id="15" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td width="25%"><input type="text" id="T_Cargo_6" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Cargo_6);eliminaBlancoFin(this.form.T_Cargo_6);eliminaBlancosIntermedios(this.form.T_Cargo_6);" class="T_Cargo" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;">&nbsp;</td>
			<td width="25%"><a href="javascript:limpiarCampos('C6')"><img class='icochico' src='/Resources/iconos/002-trash.svg' /></a></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="15%" align="center"><input type="text" id"T_Cargo_63" size="20" onblur="validaIntDec(this);validaDescImporte(this.form.T_Cargo_6,this.form.T_Cargo_63);cortarDecimalesObj(this.form.T_Cargo_63,2);Suma_Subtotales();" class="T_Cargo_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"></td>
		</tr>


		<tr id="16" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td width="25%"><input type="text" id="T_Cargo_7" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Cargo_7);eliminaBlancoFin(this.form.T_Cargo_7);eliminaBlancosIntermedios(this.form.T_Cargo_7);" class="T_Cargo" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;">&nbsp;</td>
			<td width="25%"><a href="javascript:limpiarCampos('C7')"><img class='icochico' src='/Resources/iconos/002-trash.svg' /></a></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="15%" align="center"><input type="text" id"T_Cargo_73" size="20" onblur="validaIntDec(this);validaDescImporte(this.form.T_Cargo_7,this.form.T_Cargo_73);cortarDecimalesObj(this.form.T_Cargo_73,2);Suma_Subtotales();" class="T_Cargo_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"></td>
		</tr>


		<tr id="17" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td width="25%"><input type="text" id="T_Cargo_8" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Cargo_8);eliminaBlancoFin(this.form.T_Cargo_8);eliminaBlancosIntermedios(this.form.T_Cargo_8);" class="T_Cargo" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;">&nbsp;</td>
			<td width="25%"><a href="javascript:limpiarCampos('C8')"><img class='icochico' src='/Resources/iconos/002-trash.svg' /></a></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="15%" align="center"><input type="text" id"T_Cargo_83" size="20" onblur="validaIntDec(this);validaDescImporte(this.form.T_Cargo_8,this.form.T_Cargo_83);cortarDecimalesObj(this.form.T_Cargo_83,2);Suma_Subtotales();" class="T_Cargo_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"></td>
		</tr>
</table>


<!--******************* HONORARIOS DE LA CUENTA ** TARIFA DE HONORARIOS ***********************-->
<br>
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-family: Trebuchet MS; font-size:10pt; background-color:#C0C0C0; border: 1px solid #000000;">
  <tr>
    <td colspan="7" align="center" style="color:#FFFFFF; background-color:#808080">HONORARIOS Y SERVICIOS AL COMERCIO EXTERIOR</td>
    </tr>
  <tr>
  <tr>
    <td>Honorarios&nbsp;</td>
    <td colspan="6"><select size="1" id"Lst_Conceptos_Honorarios" style="font-family: Trebuchet MS; font-size: 10pt" onchange ="asignarTarifaH()">
      <?php echo $ConceptosCliente; ?>
    </select></td>
  </tr>
  <tr>
    <td>Libres&nbsp;</td>
    <td colspan="6"><select size="1"  onchange="asignarTarifaHlibres()" id"Lst_CHL" style="font-family: Trebuchet MS; font-size: 10pt">
      <?php echo $conceptosLibresCliente; ?>
    </select></td>
  </tr>
  <tr align="center">
      <td colspan="3" align="right">CONCEPTO&nbsp;&nbsp;&nbsp;</td>
      <td colspan="3" align="left">&nbsp;&nbsp;&nbsp;IMPORTE</td>
      <td>Mínimo de Honorarios</td>
  </tr>
  <tr align="center">
      <td align="right"><input type="text" id"T_Hcta" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly/></td>
      <td align="right"><input type="text" id"T_Hps" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly/></td>
      <td align="right"><input type="text" id="T_CH" size="42" style="font-family: Trebuchet MS; font-size:10pt;" onchange="validarStringSAT(this.form.T_CH);" onkeypress="return validarStringSATteclaPulsada(event);" onblur="limpia()"/></td>
      <td align="left"><input type="text" id"T_Valor_Concepto_Honorarios" onblur="validaIntDec(this);cortarDecimalesObj(this.form.T_Valor_Concepto_Honorarios,2);" size="15" style="font-family: Trebuchet MS; font-size:10pt; text-align:center; ">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      </td>
  	  <td align="left"><input type=button value="Add" id"Btn_Honorarios" onclick="agregarHonorarios()" style="font-family: Trebuchet MS; font-size: 10pt; color: #000000;" /></td>
  	  <td align="left"><a href="javascript:ayudaPermitidos();">Caracteres permitidos  <img class='icochico' src='/Resources/iconos/help.svg'></a></td>
    <td>
      <input type= text id"T_Honorarios_Minimo_Honorarios" onblur="validaIntDec(this);cortarDecimalesObj(this.form.T_Honorarios_Minimo_Honorarios,2);" size="7" style="font-family: Trebuchet MS; font-size:10pt; text-align:right;" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $honorarios; ?>">    </td>
  </tr>
</table>

<p style="font-family: Trebuchet MS; font-size: 5pt;"></p>
<!-- COBRO DE HONORARIOS -->
<table border="0" width="100%" style="font-family: Trebuchet MS; font-size:10pt; border: 1px solid #000000;" cellspacing="0">
		<tr bgcolor="#C0C0C0" align="center">
			<td width="40%" colspan="5" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONCEPTOS</td>
			<td width="10%">noIdentificación</td>
			<td width="10%">cveServProd</td>
			<td width="10%">IMPORTE</td>
			<td width="10%"><input type="text" id"T_IVA_Porcentaje" size="2" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:8pt; background-color:#C0C0C0" readonly value="<?PHP echo redondear_dos_decimal($iva*100)?>" >% IVA</td>
			<td width="10%">RETENCIÓN 4% </td>
			<td width="10%">SUBTOTAL</td>
		</tr>


		<tr id="18" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
		  <td>
        <input type="text" id"T_Honorarios_Porcentaje" onblur="Suma_Valor_Honorarios()" size="10" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;" value="<?php echo cortarDecimales($factor_honorarios); ?>" tabindex="<?php echo $tabindex = $tabindex+1; ?>" />	      </td>
		  <td><input type="text" id"Txt_Honorarios" class="T_Honorarios" readonly size="32" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; background-color:#DCDCDC;"  value="% de Honorarios sobre la base de:" readonly /></td>
		  <td><input type="text" id"T_Honorarios_Base_Honorarios" onblur="calculoHonorarios();" size="18" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>" /></td>
		  <td><input type="text" id"T_Honorarios_Descuento" onblur="calculoHonorarios();" size="10" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;" value="<?php echo cortarDecimales($descuento); ?>" tabindex="<?php echo $tabindex = $tabindex+1; ?>" /></td>
		  <td><input type="text" id"Txt_Descuento" size="32" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; background-color:#DCDCDC;" value="% de Descuento" readonly /></td>
		  <td align="center"><input type="text" id="T_Hcta0" class="T_Honorarios_idcta" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0400-00001" readonly/></td>
		  <td align="center"><input type="text" id="T_Hps0" class="T_Honorarios_idps" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="<?php echo $cveProdHon;?>" readonly/></td>
		  <td align="center">
		  <input type="text" id"T_Honorarios_Importe" onblur="validaIntDec(this);cortarDecimalesObj(this.form.T_Honorarios_Importe,2);Iva_Importe_Hon();" size="18" class="T_Honorarios_Importe" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>">			</td>
		  <td align="center"><input type="text" id"T_Honorarios_IVA" size="20" class="T_Honorarios_IVA" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly></td>
		  <td align="center"><input type="text" id"T_Honorarios_RET" size="20" class="T_Honorarios_RET" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly></td>
		  <td align="center"><input type="text" id"T_Honorarios_Total" size="20" class="T_Honorarios_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly></td>
    </tr>


		<tr id="19" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td colspan="4"><input type="text" id="T_Honorarios_1" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Honorarios_1);eliminaBlancoFin(this.form.T_Honorarios_1);eliminaBlancosIntermedios(this.form.T_Honorarios_1);validarStringSAT(this.form.T_Honorarios_1);" class="T_Honorarios" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;" tabindex="75"></td>
			<td><a href="javascript:limpiarCampos('H1')"><img class='icochico' src='/Resources/iconos/002-trash.svg'></a></td>
			<td align="center"><input type="text" id"T_Hcta1" class="T_Honorarios_idcta" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly /></td>
			<td align="center"><input type="text" id"T_Hps1" class="T_Honorarios_idps" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly /></td>
			<td align="center"><input type="text" id"T_Honorarios_11" onblur="validaIntDec(this);validaDescImporte(this.form.T_Honorarios_1,this.form.T_Honorarios_11);cortarDecimalesObj(this.form.T_Honorarios_11,2);Iva_Importe_Hon1()" size="18" class="T_Honorarios_Importe" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"></td>
			<td align="center"><input type="text" id"T_Honorarios_12" size="20" class="T_Honorarios_IVA" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly></td>
		    <td align="center"><input type="text" id"T_Honorarios_14" size="20" class="T_Honorarios_RET" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly></td>
	      <td width="15%" align="center"><input type="text" id"T_Honorarios_13" size="20" class="T_Honorarios_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly></td>
		</tr>



		<tr id="20" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td colspan="4"><input type="text" id="T_Honorarios_2" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Honorarios_2);eliminaBlancoFin(this.form.T_Honorarios_2);eliminaBlancosIntermedios(this.form.T_Honorarios_2);validarStringSAT(this.form.T_Honorarios_2);" class="T_Honorarios" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;" tabindex="79"></td>
			<td><a href="javascript:limpiarCampos('H2')"><img class='icochico' src='/Resources/iconos/002-trash.svg'></a></td>
			<td align="center"><input type="text" id"T_Hcta2" class="T_Honorarios_idcta" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly /></td>
			<td align="center"><input type="text" id"T_Hps2" class="T_Honorarios_idps" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly /></td>
			<td align="center"><input type="text" id"T_Honorarios_21" size="18" onblur="validaIntDec(this);validaDescImporte(this.form.T_Honorarios_2,this.form.T_Honorarios_21);cortarDecimalesObj(this.form.T_Honorarios_21,2);Iva_Importe_Hon2();" class="T_Honorarios_Importe" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"></td>
			<td align="center"><input type="text" id"T_Honorarios_22" size="20" class="T_Honorarios_IVA" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly></td>
			<td align="center"><input type="text" id"T_Honorarios_24" size="20" class="T_Honorarios_RET" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly></td>
			<td align="center"><input type="text" id"T_Honorarios_23" size="20" class="T_Honorarios_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly></td>
		</tr>


		<tr id="21" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td colspan="4"><input type="text" id="T_Honorarios_3" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Honorarios_3);eliminaBlancoFin(this.form.T_Honorarios_3);eliminaBlancosIntermedios(this.form.T_Honorarios_3);validarStringSAT(this.form.T_Honorarios_3);" class="T_Honorarios" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;" tabindex="83"></td>
			<td><a href="javascript:limpiarCampos('H3')"><img class='icochico' src='/Resources/iconos/002-trash.svg'></a></td>
			<td align="center"><input type="text" id="T_Hcta3" class="T_Honorarios_idcta" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly /></td>
			<td align="center"><input type="text" id="T_Hps3" class="T_Honorarios_idps" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly /></td>
			<td align="center"><input type="text" id"T_Honorarios_31" size="18" onblur="validaIntDec(this);validaDescImporte(this.form.T_Honorarios_3,this.form.T_Honorarios_31);cortarDecimalesObj(this.form.T_Honorarios_31,2);Iva_Importe_Hon3();" class="T_Honorarios_Importe" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"></td>
			<td align="center"><input type="text" id"T_Honorarios_32" size="20" class="T_Honorarios_IVA" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly></td>
			<td align="center"><input type="text" id"T_Honorarios_34" size="20" class="T_Honorarios_RET" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly></td>
			<td align="center"><input type="text" id"T_Honorarios_33" size="20" class="T_Honorarios_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly></td>
		</tr>




		<tr id="22" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td colspan="4"><input type="text" id="T_Honorarios_4" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Honorarios_4);eliminaBlancoFin(this.form.T_Honorarios_4);eliminaBlancosIntermedios(this.form.T_Honorarios_4);validarStringSAT(this.form.T_Honorarios_4);" class="T_Honorarios" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;" tabindex="87"></td>
			<td><a href="javascript:limpiarCampos('H4')"><img class='icochico' src='/Resources/iconos/002-trash.svg'></a></td>
			<td align="center"><input type="text" id="T_Hcta4" class="T_Honorarios_idcta" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly /></td>
			<td align="center"><input type="text" id="T_Hps4" class="T_Honorarios_idps" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly /></td>
			<td align="center"><input type="text" id"T_Honorarios_41" size="18" onblur="validaIntDec(this);validaDescImporte(this.form.T_Honorarios_4,this.form.T_Honorarios_41);cortarDecimalesObj(this.form.T_Honorarios_41,2);Iva_Importe_Hon4();" class="T_Honorarios_Importe" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"></td>
			<td align="center"><input type="text" id"T_Honorarios_42" size="20" class="T_Honorarios_IVA" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly></td>
			<td align="center"><input type="text" id"T_Honorarios_44" size="20" class="T_Honorarios_RET" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly></td>
			<td align="center"><input type="text" id"T_Honorarios_43" size="20" class="T_Honorarios_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly></td>
		</tr>


		<tr id="23" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td width="20%" colspan="4"><input type="text" id="T_Honorarios_5" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Honorarios_5);eliminaBlancoFin(this.form.T_Honorarios_5);eliminaBlancosIntermedios(this.form.T_Honorarios_5);validarStringSAT(this.form.T_Honorarios_5);" class="T_Honorarios" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;" tabindex="91"></td>
			<td width="20%"><a href="javascript:limpiarCampos('H5')"><img class='icochico' src='/Resources/iconos/002-trash.svg'></a></td>
			<td align="center"><input type="text" id="T_Hcta5" class="T_Honorarios_idcta" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly /></td>
			<td align="center"><input type="text" id="T_Hps5" class="T_Honorarios_idps" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly /></td>
			<td align="center"><input type="text" id"T_Honorarios_51" size="18" onblur="validaIntDec(this);validaDescImporte(this.form.T_Honorarios_5,this.form.T_Honorarios_51);cortarDecimalesObj(this.form.T_Honorarios_51,2);Iva_Importe_Hon5();" class="T_Honorarios_Importe" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>"></td>
			<td align="center"><input type="text" id"T_Honorarios_52" size="20" class="T_Honorarios_IVA" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly></td>
			<td align="center"><input type="text" id"T_Honorarios_54" size="20" class="T_Honorarios_RET" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly></td>
			<td align="center"><input type="text" id"T_Honorarios_53" size="20" class="T_Honorarios_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly></td>
		</tr>


		<tr id="24" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td colspan="4">
        <input type="text" id="T_Honorarios_6" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Honorarios_6);eliminaBlancoFin(this.form.T_Honorarios_6);eliminaBlancosIntermedios(this.form.T_Honorarios_6);validarStringSAT(this.form.T_Honorarios_6);" class="T_Honorarios" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;" tabindex="95">
      </td>
			<td><a href="javascript:limpiarCampos('H6')"><img class='icochico' src='/Resources/iconos/002-trash.svg'></a></td>
			<td align="center">
        <input type="text" id="T_Hcta6" class="T_Honorarios_idcta" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly />
      </td>
			<td align="center">
        <input type="text" id="T_Hps6" class="T_Honorarios_idps" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly />
      </td>
			<td align="center">
        <input type="text" id"T_Honorarios_61" size="18" onblur="validaIntDec(this);validaDescImporte(this.form.T_Honorarios_6,this.form.T_Honorarios_61);cortarDecimalesObj(this.form.T_Honorarios_61,2);Iva_Importe_Hon6();" class="T_Honorarios_Importe" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
      </td>
			<td align="center">
        <input type="text" id"T_Honorarios_62" size="20" class="T_Honorarios_IVA" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly>
      </td>
			<td align="center">
        <input type="text" id"T_Honorarios_64" size="20" class="T_Honorarios_RET" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly>
      </td>
			<td align="center">
        <input type="text" id"T_Honorarios_63" size="20" class="T_Honorarios_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly>
      </td>
		</tr>


		<tr id="25" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
			<td width="20%" colspan="4">
        <input type="text" id="T_Honorarios_7" size="60" maxlength="60" onchange="javascript:eliminaBlancoIni(this.form.T_Honorarios_7);eliminaBlancoFin(this.form.T_Honorarios_7);eliminaBlancosIntermedios(this.form.T_Honorarios_7);validarStringSAT(this.form.T_Honorarios_7);" class="T_Honorarios" readonly style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;" tabindex="99">
      </td>
			<td width="20%"><a href="javascript:limpiarCampos('H7')"><img class='icochico' src='/Resources/iconos/002-trash.svg'></a></td>
			<td align="center">
        <input type="text" id="T_Hcta7" class="T_Honorarios_idcta" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly />
      </td>
			<td align="center">
        <input type="text" id"T_Hps7" class="T_Honorarios_idps" size="15" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="" readonly />
      </td>
			<td width="15%" align="center">
        <input type="text" id"T_Honorarios_71" size="18" onblur="validaIntDec(this);validaDescImporte(this.form.T_Honorarios_7,this.form.T_Honorarios_71);cortarDecimalesObj(this.form.T_Honorarios_71,2);Iva_Importe_Hon7();" class="T_Honorarios_Importe" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right;" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
      </td>
			<td width="7%" align="center">
        <input type="text" id"T_Honorarios_72" size="20" class="T_Honorarios_IVA" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly>
      </td>
			<td width="8%" align="center">
        <input type="text" id"T_Honorarios_74" size="20" class="T_Honorarios_RET" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0"  readonly>
      </td>
			<td width="15%" align="center">
        <input type="text" id"T_Honorarios_73" size="20" class="T_Honorarios_Subtotal" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly>
      </td>
		</tr>



    <tr style="font-family: Trebuchet MS; font-size:8pt; color:#FFFFFF">
      <td colspan="7" rowspan="4">
      		<table border="0" width="100%" cellspacing="1" cellpadding="0" style="font-family: Trebuchet MS; font-size:10pt; color:#FFFFFF; border: 1px solid #000000;" bgcolor="#C0C0C0">
      		  <tr bgcolor="#7F7F7F" align="center">
      			<td>&nbsp;</td>
      			<td>P&oacute;liza</td>
      			<td>Usuario</td>
      			<td>Fecha</td>
      		  </tr>
      		  <tr>
      			<td bgcolor="#7F7F7F">Cta. generada </td>
      			<td align="center">&nbsp;</td>
      			<td align="center"><input type="text" id"T_Usuario" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center; color:#000000; background-color:#C0C0C0" value="<?php echo $usuario; ?>" readonly></td>
      			<td align="center">
      				<input type="text" id"T_Fecha_Cta" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center; color:#000000; background-color:#C0C0C0" value="<?php $fecha = time (); echo date ( "d-m-Y h:i:s" , $fecha );
      //echo date('d/m/Y');
      ?>" readonly>			</td>
      		  </tr>
      		  <tr>
      			<td bgcolor="#7F7F7F">Cta. modificada </td>
      			<td>&nbsp;</td>
      			<td>&nbsp;</td>
      			<td>&nbsp;</td>
      		  </tr>
      		  <tr>
      			<td bgcolor="#7F7F7F">Factura generada </td>
      			<td>&nbsp;</td>
      			<td>&nbsp;</td>
      			<td>&nbsp;</td>
      		  </tr>
      		  <tr>
      			<td bgcolor="#7F7F7F">Factura cancelada </td>
      			<td>&nbsp;</td>
      			<td>&nbsp;</td>
      			<td>&nbsp;</td>
      		  </tr>
      		</table>      </td>
    	<td colspan="3" bgcolor="#7F7F7F"><input type="text" id"Txt_Total_Importe" size="40" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#FFFFFF; background-color:#808080" readonly value="Total Honorarios y Servicios"></td>
        <td align="center"><input type="text" id"T_Total_Importes" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly></td>
      </tr>
      <tr style="font-family: Trebuchet MS; font-size:8pt; color:#FFFFFF">
      	<td colspan="3" bgcolor="#7F7F7F">
          <input type="text" id"Txt_Total_IVA" size="40" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#FFFFFF; background-color:#808080" readonly value="<?PHP echo $iva*100?>% IVA sobre Honorarios y Servicios">        </td>
        <td align="center">
          <input type="text" id"T_Total_IVA" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly>        </td>
      </tr>
      <tr style="font-family: Trebuchet MS; font-size:8pt; color:#FFFFFF">
        <td colspan="3" bgcolor="#7F7F7F">
          <input type="text" id"Txt_SUBTOTAL_HON" size="40" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#FFFFFF; background-color:#808080" readonly value="Subtotal Honorarios y Servicios">        </td>
        <td align="center">
          <input type="text" id"T_SUBTOTAL_HON" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly/>        </td>
      </tr>
      <tr style="font-family: Trebuchet MS; font-size:8pt; color:#FFFFFF">
        <td colspan="3" bgcolor="#7F7F7F">
          <input type="text" id"Txt_IVA_RETENIDO" size="40" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#FFFFFF; background-color:#808080" readonly value="Retenci&oacute;n (4%) Impto. IVA">        </td>
        <td align="center">
          <input type="text" id"T_IVA_RETENIDO" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly/>        </td>
      </tr>


      <tr style="font-family: Trebuchet MS; font-size:10pt; color:#FFFFFF">
        <td colspan="7"></td>
      	<td colspan="3" bgcolor="#7F7F7F">
          <input type="text" id"Txt_Total_Gral" size="40" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#FFFFFF; background-color:#808080" readonly value="Total">        </td>
        <td align="center">
          <input type="text" id"T_Total_Gral" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly>        </td>
      </tr>

      <tr style="font-family: Trebuchet MS; font-size:8pt; color:#FFFFFF">
        <td colspan="7">&nbsp;</td>
      	<td colspan="3" bgcolor="#7F7F7F">
          <input type="text" id"Txt_Total_MN_Extranjera" size="48" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#FFFFFF; background-color:#808080" readonly value="Total Pagos o Cargos en Moneda Extranjera">        </td>
        <td align="center">
          <input type="text" id"T_Total_MN_Extranjera" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly>        </td>
      </tr>
      <tr style="font-family: Trebuchet MS; font-size:8pt; color:#FFFFFF">
        <td colspan="7">&nbsp;</td>
      	<td colspan="3" bgcolor="#7F7F7F">
          <input type="text" id"Txt_Total_Pagos" size="45" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#FFFFFF; background-color:#808080" readonly value="Total Pagos Realizados por su Cuenta" />        </td>
      	<td align="center">
          <input type="text" id"T_Total_Pagos" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly>        </td>
      </tr>
      <tr style="font-family: Trebuchet MS; font-size:8pt; color:#FFFFFF">
        <td colspan="7" align="center" bgcolor="#C0C0C0">
          <div id="total_CuentaGastos" style="width: 140px; height: auto; text-align:left"></div>        </td>
    	  <td colspan="3" bgcolor="#7F7F7F">
          <input type="text" id"Txt_Cta_Gastos" size="40" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#FFFFFF; background-color:#808080" readonly value="Total Cuenta de Gastos">        </td>
        <td align="center">
          <input type="text" id"T_Cta_Gastos" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly>        </td>
      </tr>
      <tr style="font-family: Trebuchet MS; font-size:10pt; color:#FFFFFF">
        <td colspan="7">&nbsp;</td>
    	  <td bgcolor="#7F7F7F">Anticipo 1 <a href="javascript:Btn_Busca_Anticipo('1')" tabindex="<?php echo $tabindex = $tabindex+1; ?>"><img class='icochico' src='/Resources/iconos/magnifier.svg' /></a>&nbsp;&nbsp;<a href="javascript:limpiarCampos('A1')"><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>      </td>
    	<td colspan="2" align="center" bgcolor="#7F7F7F">
        <input type="text" id"T_No_Anticipo_1" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center; background-color:#DCDCDC">      </td>
        <td align="center">
          <input type="text" id"T_Anticipo_1" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly />        </td>
      </tr>
      <tr style="font-family: Trebuchet MS; font-size:10pt; color:#FFFFFF">
        <td colspan="7" style="color:#000000;">CUSTOMS DC
          <select id"CUSTOMS" style="font-family: Trebuchet MS; font-size: 10pt" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
    					<option value='1'>Si</option>
    					<option value='0' selected>No</option>
    		  </select>      </td>
    	<td bgcolor="#7F7F7F">Anticipo 2
        <a href="javascript:Btn_Busca_Anticipo('2')" tabindex="<?php echo $tabindex = $tabindex+1; ?>"><img class='icochico' src='/Resources/iconos/magnifier.svg' /></a>&nbsp;&nbsp;<a href="javascript:limpiarCampos('A2')"><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>      </td>
    	<td colspan="2" align="center" bgcolor="#7F7F7F"><input type="text" id"T_No_Anticipo_2" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center; background-color:#DCDCDC"></td>
        <td align="center">
          <input type="text" id"T_Anticipo_2" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly>        </td>
      </tr>



      <tr style="font-family: Trebuchet MS; font-size:8pt; color:#FFFFFF">
        <td colspan="7" rowspan="6">

          <table border="0" style="border-collapse:collapse; font-family: Trebuchet MS; font-size:10pt; color:#000000">
            <tr>
              <td colspan="2">
                <select id"Lst_metodoPago" onchange="asignarMetodoPago()" style="border-collapse:collapse; font-family: Trebuchet MS; font-size:10pt;">
                  <option value="PUE" selected>Seleccione m&eacute;todo de pago</option>
                  <option value="PUE">Pago en una sola exhibici&oacute;n --- PUE</option>
                  <option value="PPD">Pago en parcialidades o diferido --- PPD</option>
                </select>              </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr bgcolor="DCDCDC">
              <td bgcolor="#C0C0C0">M&eacute;todo de pago</td>
              <td>
                <input type="text" id"T_metodoPago" size="20" value="PUE" style="border:1px solid #DCDCDC; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#000000; background-color:#DCDCDC" readonly />              </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr align="center">
            <td colspan="2"><b>Seleccione forma y cuenta de pago</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><b>Uso de CFDI</b></td>
            </tr>
            <tr>
              <td>
                <select id"Lst_formaPago" onchange="asignarFormaPago()" style="border-collapse:collapse; font-family: Trebuchet MS; font-size:10pt;">
                    <?php echo $datosCLTformaPago; ?>
                </select>
              </td>
              <td>
                <div id="numerosCuenta"></div>              </td>
              <td>&nbsp;</td>
              <td>
                <?php if( $oRst_permisos["CFD_cta_gastos_generarT0"] == 0){ ?>
                  <select id"Lst_moneda" onchange="asignarMoneda()" style="border-collapse:collapse; font-family: Trebuchet MS; font-size:10pt;">
                    <?php echo $consultaMoneda; ?>
                  </select>
                <?php } ?></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>
                <select id"Lst_usoCFDI" onchange="asignarUsoCFDI()" style="border-collapse:collapse; font-family: Trebuchet MS; font-size:10pt;">
                  <?php echo $consultaUsoCFDIfac; ?>
                </select>
              </td>
            </tr>
            <tr bgcolor="#C0C0C0">
              <td>Forma de pago</td>
              <td>N&uacute;mero de cuenta</td>
              <td>&nbsp;</td>
              <td>Moneda</td>
              <td>Tipo Cambio (4 dec.)</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr bgcolor="DCDCDC">
              <td>
                <input type="text" id"T_FormaPago" size="20" style="border:1px solid #DCDCDC; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#000000; background-color:#DCDCDC" readonly />              </td>
              <td>
                <input type="text" id"T_CuentaPago" size="20" style="border:1px solid #DCDCDC; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#000000; background-color:#DCDCDC" readonly />              </td>
              <td>&nbsp;</td>
              <td>
                <input type="text" id"T_Moneda" size="6" value="MXN" style="border:1px solid #DCDCDC; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#000000; background-color:#DCDCDC" readonly />              </td>
              <td>
                <input type="text" id"T_monedaTipoCambio" readonly size="18" onblur="validaIntDec(this);" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt;"/>              </td>
              <td>&nbsp;</td>
              <td>
                <input type="text" id"T_usoCFDI" size="20" style="border:1px solid #DCDCDC; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#000000; background-color:#DCDCDC" readonly />              </td>
            </tr>
          </table>        </td>
        <td bgcolor="#7F7F7F" style="font-family: Trebuchet MS; font-size:10pt; color:#FFFFFF">
          Anticipo 3 <a href="javascript:Btn_Busca_Anticipo('3')" tabindex="<?php echo $tabindex = $tabindex+1; ?>"><img class='icochico' src='/Resources/iconos/magnifier.svg' /></a>&nbsp;&nbsp;<a href="javascript:limpiarCampos('A3')"><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>        </td>
    	  <td colspan="2" align="center" bgcolor="#7F7F7F">
          <input type="text" id"T_No_Anticipo_3" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center; background-color:#DCDCDC">        </td>
        <td align="center">
          <input type="text" id"T_Anticipo_3" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly>        </td>
      </tr>

      <tr style="font-family: Trebuchet MS; font-size:10pt; color:#FFFFFF">
        <td bgcolor="#7F7F7F">
          Anticipo 4 <a href="javascript:Btn_Busca_Anticipo('4')" tabindex="<?php echo $tabindex = $tabindex+1; ?>"><img class='icochico' src='/Resources/iconos/magnifier.svg' /></a>&nbsp;&nbsp;<a href="javascript:limpiarCampos('A4')"><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>        </td>
    	  <td colspan="2" align="center" bgcolor="#7F7F7F">
          <input type="text" id"T_No_Anticipo_4" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center; background-color:#DCDCDC">        </td>
        <td align="center">
          <input type="text" id"T_Anticipo_4" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly>        </td>
      </tr>

      <tr style="font-family: Trebuchet MS; font-size:10pt; color:#FFFFFF">
      	<td bgcolor="#7F7F7F">
          Anticipo 5 <a href="javascript:Btn_Busca_Anticipo('5')" tabindex="<?php echo $tabindex = $tabindex+1; ?>"><img class='icochico' src='/Resources/iconos/magnifier.svg' /></a>&nbsp;&nbsp;<a href="javascript:limpiarCampos('A5')"><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>        </td>
      	<td colspan="2" align="center" bgcolor="#7F7F7F">
          <input type="text" id"T_No_Anticipo_5" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center; background-color:#DCDCDC">        </td>
        <td align="center">
          <input type="text" id"T_Anticipo_5" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly>        </td>
      </tr>
      <tr style="font-family: Trebuchet MS; font-size:10pt; color:#FFFFFF">
    	   <td bgcolor="#7F7F7F">
           Anticipo 6 <a href="javascript:Btn_Busca_Anticipo('6')" tabindex="<?php echo $tabindex = $tabindex+1; ?>"><img class='icochico' src='/Resources/iconos/magnifier.svg' /></a>&nbsp;&nbsp;<a href="javascript:limpiarCampos('A6')"><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>         </td>
    	   <td colspan="2" align="center" bgcolor="#7F7F7F"><input type="text" id"T_No_Anticipo_6" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:center; background-color:#DCDCDC"></td>
         <td align="center"><input type="text" id"T_Anticipo_6" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly></td>
      </tr>
      <tr style="font-family: Trebuchet MS; font-size:8pt; color:#FFFFFF">
        <td colspan="3" bgcolor="#7F7F7F">
          <input type="text" id"Txt_Total_Anticipos" size="40" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#FFFFFF; background-color:#808080" readonly value="Total Dep&oacute;sitos">   (-)        </td>
        <td align="center">
          <input type="text" id"T_Total_Anticipos" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly>        </td>
      </tr>
      <tr style="font-family: Trebuchet MS; font-size:8pt; color:#FFFFFF">
        <td bgcolor="#7F7F7F">
          <input type=button value="Calcular" onclick="guardarCta('Calcular');validarStringSAT(this.form.T_Nombre_Cliente);quitarNoUsar(this.form.T_Nombre_Cliente);"  id"Btn_Calcular" style="font-family: Trebuchet MS; font-size: 10pt; color: #000000;" tabindex="<?php echo $tabindex = $tabindex+1; ?>">        </td>
    	  <td colspan="2" align="right" bgcolor="#7F7F7F">
          <input type="text" id"Txt_Saldo_Gral" size="10" style="border:1px solid #808080; font-family: Trebuchet MS; font-size:10pt; text-align:left; color:#FFFFFF; background-color:#808080" readonly value="Saldo">        </td>
        <td align="center">
          <input type="text" id"T_SALDO_GRAL" size="20" style="border:1px solid #C0C0C0; font-family: Trebuchet MS; font-size:10pt; text-align:right; background-color:#DCDCDC" value="0" readonly/>        </td>
      </tr>
      <tr style="font-family: Trebuchet MS; font-size:8pt; color:#FFFFFF">
        <td colspan="7" align="center">&nbsp;</td>
        <td colspan="4">&nbsp;	</td>
      </tr>
</table>
<br>
<table width="100%" border="0" style="border-collapse:collapse;">
  <tr>
    	<td colspan="2" width="48%"></td>
		<td valign="top"></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><input type='button' value="Guardar" onclick="guardarCta('Guardar');validarStringSAT(this.form.T_Nombre_Cliente);quitarNoUsar(this.form.T_Nombre_Cliente);" id="guardar" style="font-family: Trebuchet MS; font-size: 10pt; color: #000000;" tabindex="<?php echo $tabindex = $tabindex+1; ?>"/>	</td>
  </tr>
  <tr>
    <td align="right" style="font-family: Trebuchet MS; font-size:10pt;"></td>
    <td align="center"></td>
	<td><div id="mensaje"></div></td>
  </tr>
</table>






<p style="font-family: Trebuchet MS; font-size: 5pt;">*************</p>
<p style="font-family: Trebuchet MS; font-size: 5pt;">*************</p>
<p style="font-family: Trebuchet MS; font-size: 5pt;">*************</p>
<p style="font-family: Trebuchet MS; font-size: 5pt;">*************</p>
<p style="font-family: Trebuchet MS; font-size: 5pt;">*************</p>
<p style="font-family: Trebuchet MS; font-size: 5pt;">*************</p>
<p style="font-family: Trebuchet MS; font-size: 5pt;">*************</p>
</body>
<?php
  require $root . '/Ubicaciones/footer.php';
?>
