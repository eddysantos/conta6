<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Ubicaciones/barradenavegacion.php';


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

    /* SACO UN FOLIO DE CALCULO DE TARIFA, ESTE FOLIO ME SERVIRA PARA PODER IDENTIFICAR LOS FILTROS DE LAS TARIFAS */
    $s_tipoDoc = 'ctaGastos';
    //require $root . '/conta6/Resources/PHP/actions/tarifas_generarFolio.php';
    $calculoTarifa = 45;


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
          require $root . '/conta6/Resources/PHP/actions/tarifas_calculaPOCME_delete.php';
        }

        # PARA LA OFICINA DE NUEVO LAREDO ESTOS CONCEPTOS SE CARGAN EN AUTOMATICO
        require $root . '/conta6/Resources/PHP/actions/tarifas_calculaPOCME_mostrarConceptos.php';
        $idFila=0;
        if( $oficina == 240 ){
          while ($oRst_Conceptos = $rslt_Conceptos->fetch_assoc()) {
            $idFila = $idFila + 1;
            $ID_CONCEPTOcta = $oRst_Conceptos['fk_id_cuenta'];
            $CONCEPTOcta = trim($oRst_Conceptos['s_conceptoesp']);
            $CONCEPTOctaEng = trim($oRst_Conceptos['s_conceptoEnglish']);
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
            <tr class='row m-0 trPOCME elemento-pocme' id='$idFila'>
              <td class='col-md-1 p-2'>
                <input type='text' id='T_POCME_Cantidad$idFila' value='$cantidad' class='T_POCME_CANTIDAD cantidad efecto h22' onblur='validaSoloNumeros(this);importe_POCME();' size='4'>
              </td>
              <td class='col-md-3 p-2'>
                <input type='hidden' id='T_POCME_idTipoCta$idFila' value='$ID_CUENTA' class='T_POCME_CUENTAS id-cuenta'>
                <input type='hidden' id='T_POCME_idConcep$idFilaBlanco' class='T_POCME_idCONCEPTOS id_concepto'>
                <input type='text' id='T_POCME_Concepto$idFila' value='$CONCEPTOcta' class='T_POCME_CONCEPTOS concepto-espanol efecto h22' size='45' readonly>
                <input type='hidden' id='T_POCME_ConceptoEng$idFila' value='$CONCEPTOctaEng' class='T_POCME_CONCEPTOS_ENG concepto-ingles'/>
              </td>
              <td class='col-md-3 p-2'>
                <input type='text' id='T_POCME_Descripcion$idFila' value='$descripcion' maxlength='40' class='T_POCME_DESCRIPCION descripcion efecto h22' size='45'>
              </td>
              <td class='col-md-1 p-2 text-left'>
                <a href='#' class='remove-POCME'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>
              </td>
              <td class='col-md-2 p-2'>
                <input type='text' id='T_POCME_Importe$idFila' value='$importe' class='T_POCME_IMPORTES importe efecto h22' onblur='validaIntDec(this);validaDescImporte(1,$idFila);importe_POCME();cortarDecimalesObj(this,2);' size='17'>
              </td>
              <td class='col-md-2 p-2'>
                <input type='text' id='T_POCME_Subtotal$idFila' value='$subtotal' class='T_POCME_SUBTOTALES subtotal efecto h22' size='17' readonly/>
              </td>
            </tr>
             ";
          }
        }
    /*
        $idFila = $idFila + 1;
        for ($idFilaBlanco = $idFila;  $idFilaBlanco <= 8; $idFilaBlanco++) {
          $POCME_lineas .= "";

    	  $POCME_lineas .= "
          <tr class='row m-0' id='$idFilaBlanco'>
            <td class='col-md-1 p-2'>
              <input type='text' id='T_POCME_Cantidad$idFilaBlanco' class='T_POCME_CANTIDAD efecto h22' onblur='validaSoloNumeros(this);importe_POCME();' size='4' tabindex='$tabindex = $tabindex+1'/>
            </td>
            <td class='col-md-3 p-2'>
              <input type='hidden' id='T_POCME_idTipoCta$idFilaBlanco' class='T_POCME_CUENTAS'>
              <input type='hidden' id='T_POCME_idConcep$idFilaBlanco' class='T_POCME_idCONCEPTOS'>
              <input type='text' id='T_POCME_Concepto$idFilaBlanco' class='T_POCME_CONCEPTOS efecto h22' size='45' readonly/>
              <input type='hidden' id='T_POCME_ConceptoEng$idFilaBlanco' class='T_POCME_CONCEPTOS_ENG'>
            </td>
            <td class='col-md-3 p-2'>
              <input type='text' id='T_POCME_Descripcion$idFilaBlanco' class='T_POCME_DESCRIPCION efecto h22' onblur='this.form.T_POCME_Subtotal$idFilaBlanco.focus();' size='45' maxlength='40' tabindex='$tabindex = $tabindex+1'>
            </td>
            <td class='col-md-1 p-2 text-left'>
              <a href='javascript:limpiarCampos(1,$idFilaBlanco)'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>
            </td>
            <td class='col-md-2 p-2'>
              <input type='text' id='T_POCME_Importe$idFilaBlanco' class='T_POCME_IMPORTES efecto h22' onblur='validaIntDec(this);validaDescImporte(1,$idFila);importe_POCME();cortarDecimalesObj(this,2);' size='17' tabindex='$tabindex = $tabindex+1'>
            </td>
            <td class='col-md-2 p-2'>
              <input type='text' id='T_POCME_Subtotal$idFilaBlanco' class='T_POCME_SUBTOTALES efecto h22' size='17' readonly>
            </td>
          </tr>";

        }
    */



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


    <input type="hidden" id="T_ID_Aduana_Oculto" value="<?php echo $aduana; ?>">
    <input type="hidden" id="Txt_Usuario" value="<?php echo $usuario; ?>">
    <input type="hidden" id="T_ID_Almacen_Oculto" value="<?php echo $almacen;?>">
    <input type="hidden" id="T_No_calculoTarifa" value="<?php echo $calculoTarifa;?>">
    <input type="hidden" id="docto_tipo" value="<?php echo $opcion;?>">
    <input type="hidden" id="docto_id" value="<?php echo $extraerfolio;?>">
    <input type="hidden" id="IVA" value="<?PHP echo $iva;?>">
    <input type="hidden" id="IVARETENIDO" value="<?PHP echo $retencion;?>">
    <input type="hidden" id="IVA_MENOS_RETENCION" value="<?PHP echo $iva_menos_retencion;?>">
    <input type="hidden" id="IVA_GRAL" value="<?PHP echo $ivaGral;?>">


    <div class='text-center'>
      <div class='row m-0 submenuMed '>
        <div class='col-md-4' role='button'>
          <a  id='submenuMed' class='visualizar' accion='Ver-cliente' status='cerrado'>DATOS CLIENTE</a>
        </div>
        <div class='col-md-4'>
          <a id='submenuMed' class='visualizar' accion='datinfo' status='cerrado'>INFO. GENERAL</a>
        </div>
        <div class='col-md-4'>
          <a id="submenuMed" class="visualizar" accion="Ver-iEmbarque" status="cerrado">INFO. DEL EMBARQUE</a>
        </div>
      </div>
      <div id='detalleCliente' class='contorno' style='display:none'>
        <h5 class='titulo font14'>DATOS CLIENTES</h5>
        <table class='table ' id='eCliente'>
          <thead>
            <tr class='row encabezado font16'>
              <td class='col-md-12 p-0'>
                <input class="eff h22 border-0 bt p-0" type="text" id="T_ID_Cliente_Oculto" value="<?php echo $id_cliente; ?>">
                <input class="eff h22 border-0 bt" type="text" id="T_Nombre_Cliente" readonly value="<?php echo $CLT_nombre;?>" onchange="validarStringSAT(this);quitarNoUsar(this);">
              </td>
            </tr>
            <tr class='row backpink' style="font-size:14px!important">
              <td class='col-md-6'>Direccion</td>
              <td class='col-md-6'>Proveedor</td>
            </tr>
          </thead>
          <tbody class='font14'>
            <tr class='row'>
              <td class="col-md-3 p-0">
                <input class="w-100 border-0 bt text-right" id="T_Cliente_Calle" type="text" readonly value="<?php echo $CLT_calle;?>">
              </td>
              <td class="col-md-3 p-0">
                Ext. #<input class="border-0 bt" id="T_Cliente_No_Ext" type="text" readonly value="<?php echo $CLT_no_ext;?>" size="5">
                Int: <input class="border-0 bt" id="T_Cliente_No_Int" type="text" readonly value="<?php echo $CLT_no_int;?>" size="25">
              </td>
              <td class='col-md-6 p-0'>
                <input class="border-0 bt text-center w-100" type="text" id="T_Proveedor_Destinatario" value="<?php echo $nomProv;?>" readonly>
              </td>
            </tr>
            <tr class='row'>
              <td class='col-md-6 p-0'>
                <input class="efecto h22 border-0 bt" id="T_Cliente_Colonia" type="text" readonly value="<?php echo $CLT_colonia;?>">
              </td>
            </tr>
            <tr class='row'>
              <td class='col-md-6 p-0'>
                <input class="eff h22 border-0 bt text-right p-0" id="T_Cliente_Ciudad" type="text" readonly value="<?php echo $CLT_ciudad;?>">,
                <input class="eff h22 border-0 bt p-0" id="T_Cliente_Estado" type="text" readonly value="<?php echo $CLT_estado;?>">
                C.P :<input class="eff h22 border-0 bt p-0 text-left" id="T_Cliente_CP" type="text" readonly value="<?php echo $CLT_codigo;?>">
              </td>
            </tr>
            <tr class='row'>
              <td class='col-md-6 p-0'>
                <input class="eff h22 border-0 bt p-0" id="T_Cliente_RFC" type="text" readonly onchange="validarRFCfac(this);" value="<?php echo $CLT_rfc;?>">
                Pais :<input class="eff h22 border-0 bt" id="T_Cliente_Pais" value="<?php echo $CLT_pais; ?>">
                Tax ID :<input class="eff h22 border-0 bt" id="T_Cliente_taxid" value="<?php echo $CLT_taxid; ?>">
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div id='contornoInfo' class='contorno' style='display:none'>
        <h5 class='titulo font16'>INFO GENERAL</h5>
        <table class='table' id='eInfo'>
          <thead>
            <tr class='row encabezado font16'>
              <td class='col-md-12 p-0'>INFORMACION GENERAL NO EDITABLE</td>
            </tr>
            <tr class='row backpink font14'>
              <td class='col-md-4'>Almacen</td>
              <td class='col-md-1'>Aduana</td>
              <td class='col-md-1'>Tipo</td>
              <td class='col-md-2'>Valor</td>
              <td class='col-md-1'>Peso</td>
              <td class='col-md-1'>Dias</td>
            </tr>
          </thead>
          <tbody class='font14'>
            <tr class='row'>
              <td class='col-md-4 p-0'><input class="efecto h22 border-0" type="text" id="T_Nombre_Almacen" value="<?php echo $almacenNombre; ?>"></td>
              <td class='col-md-1 p-0'><input class="efecto h22 border-0" type="text" id="T_Aduana" value="<?php echo $aduana;?>"></td>
              <td class='col-md-1 p-0'><input class="efecto h22 border-0" type="text" id="T_Tipo" value="<?php echo $tipo;?>"></td>
              <td class='col-md-2 p-0'><input class="efecto h22 border-0" type="text" id="T_Valor" value="<?php echo $valor;?>"></td>
              <td class='col-md-1 p-0'><input class="efecto h22 border-0" type="text" id="T_Peso" value="<?php echo $peso;?>"></td>
              <td class='col-md-1 p-0'><input class="efecto h22 border-0" type="text" id="T_Dias" value="<?php echo $dias;?>"></td>
            </tr>
          </tbody>
        </table>


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
              <td class="p-1 col-md-3 text-left"> Cta. generada</td>
              <td class="p-1 col-md-3"></td>
              <td class="p-1 col-md-3">
                <input class="h22 bt border-0" type="text" id="T_Usuario" size="20"value="<?php echo $usuario; ?>" readonly>
              </td>
              <td class="p-1 col-md-3">
                <input class="h22 bt border-0" type="text" id="T_Fecha_Cta" size="20" value="<?php $fecha = time (); echo date ( "d-m-Y h:i:s" , $fecha );?>" readonly>
              </td>
            </tr>

            <tr class="row">
              <td class="p-1 col-md-3 text-left"> Cta. modificada</td>
              <td class="p-1 col-md-3"></td>
              <td class="p-1 col-md-3"></td>
              <td class="p-1 col-md-3"></td>
            </tr>
            <tr class="row">
              <td class="p-1 col-md-3 text-left"> Factura generada</td>
              <td class="p-1 col-md-3"></td>
              <td class="p-1 col-md-3"></td>
              <td class="p-1 col-md-3"></td>
            </tr>
            <tr class="row borderojo">
              <td class="p-1 col-md-3 text-left"> Factura cancelada</td>
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
            <tr class="row backpink font16">
              <td class="col-md-4">Aduana</td>
              <td class="col-md-4">Solicitud</td>
              <td class="col-md-4">Fecha</td>
            </tr>
          </thead>
          <tbody class="font14">
            <tr class="row borderojo">
              <td class="col-md-4"><?php echo $aduana;?></td>
              <td class="col-md-4"></td>
              <td class="col-md-4"></td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                <input class="efecto bt border-0 h22 text-right" type="text" onblur="Valores_Nokia()" id="T_IGET_1" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" value="Nuestra Referencia:">
              </td>
              <td class="col-md-4 p-1">
                <input class="efecto bt border-0 h22 text-left" type="text" id="T_IGED_1" size="30" maxlength="60" value="<?php echo $id_referencia;?>" readonly>
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                <input class="efecto border-0 h22 text-right" type="text" id="T_IGET_2" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" value="Descripción General:">
              </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" type="text" id="T_IGED_2" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $descripcion; ?>...">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                <input class="efecto border-0 h22 text-right" type="text" id="T_IGET_3" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" value="Peso en Kg.:">
              </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" type="text" id="T_IGED_3" size="30" maxlength="150" onchange="eliminaBlancosIntermedios(this);" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $peso; ?>">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                <input class="efecto border-0 h22 text-right" type="text" id="T_IGET_4" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" value="Tipo de Operación:">
              </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" type="text" id="T_IGED_4" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $tipo;?>">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                <input class="efecto border-0 h22 text-right" type="text" id="T_IGET_5" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" value="Talones, Guía o B/Ls:">
              </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" id="T_IGED_5" type="text" onchange="eliminaBlancosIntermedios(this);" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $guiaMaster;?>" size="30" maxlength="60">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                <input class="efecto border-0 h22 text-right" type="text" id="T_IGET_6" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);"  value="Facturas:">
              </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" id="T_IGED_6" type="text" onchange="eliminaBlancosIntermedios(this);" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $facturas;?>..." size="30" maxlength="60">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                <input class="efecto border-0 h22 text-right" type="text" id="T_IGET_7" size="30" maxlength="100" onchange="eliminaBlancosIntermedios(this);" value="Fecha Arribo o Salida:">
              </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" id="T_IGED_7" type="text" onchange="eliminaBlancosIntermedios(this);" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $fechaEntrada; ?>" size="30" maxlength="100">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                <input class="efecto border-0 h22 text-right" type="text" id="T_IGET_8" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);"  value="Procedencia o Destino:">
              </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" id="T_IGED_8" type="text" onchange="eliminaBlancosIntermedios(this);" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $procedencia;?>" size="30" maxlength="60">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                <input class="efecto border-0 h22 text-right" type="text" id="T_IGET_9" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" value="No. Pedimento:">
              </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" id="T_IGED_9" type="text" onchange="eliminaBlancosIntermedios(this);" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $pedimento;?>" size="30" maxlength="250">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                <input class="efecto border-0 h22 text-right" type="text" id="T_IGET_10" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" value="Su Referencia:">
              </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" id="T_IGED_10" type="text" onchange="eliminaBlancosIntermedios(this);" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $referenciaCliente;?>" size="30" maxlength="250">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                <input class="efecto border-0 h22 text-right" type="text" id="T_IGET_12" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" value="Clase de Mercancía:">
              </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" id="T_IGED_12" type="text" onchange="eliminaBlancosIntermedios(this);" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="" size="30" maxlength="250">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                <input class="efecto border-0 h22 text-right" type="text" id="T_IGET_13" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" value="Bill of lading:">
              </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" id="T_IGED_13" type="text" onchange="eliminaBlancosIntermedios(this);" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="" size="30" maxlength="250">
              </td>
            </tr>
            <tr class="row">
              <td class="col-md-6 p-1">
                <input class="efecto border-0 h22 text-right" type="text" id="T_IGET_11" size="30" maxlength="60" onchange="eliminaBlancosIntermedios(this);" value="Valor en M.N.:">
              </td>
              <td class="col-md-3 p-1">
                <input class="efecto h22 text-left" id="T_IGED_11" type="text" onblur="validaIntDec(this);" tabindex="<?php echo $tabindex = $tabindex+1; ?>" value="<?php echo $valor;?>" size="30" maxlength="60">
              </td>
            </tr>
          </tbody>
        </table>
      </div>


      <div class='contorno'>
        <h5 class='titulo font14'>CTA. GASTOS</h5>
        <div class=''>
          <div class='acordeon2'>
            <div class='encabezado font16' data-toggle='collapse' href='#collapseOne'>
              <a href="#" id='bread'>PAGOS O CARGOS EN MONEDA EXTRANJERA</a>
            </div>
            <div id='collapseOne' class='card-block collapse'>
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
                    <?php echo $POCME_automatico; ?>
                  </tbody>
                  <tfoot>
                    <tr class='row mt-4 m-0 sub2'>
                      <th class='col-md-2 pt-4'>Total</th>
                      <td class='col-md-2'>
                        <input class="efecto h22 bt" type="text" id="T_POCME_Total" size="17" onBlur="validaIntDec(this);" value="0" readonly>
                      </td>
                      <th class='col-md-2 pt-4'>Al Tipo de Cambio</th>
                      <td class='col-md-2'>
                        <input class="efecto h22" id="T_POCME_Tipo_Cambio" type="text" tabindex="<?php echo $tabindex = $tabindex+1; ?>" onBlur="validaIntDec(this);Suma_POCME();Conversion_Tipo_Cambio();" value="<?php echo $tipoCambio;?>" size="17">
                      </td>
                      <th class='col-md-2 pt-4'>Total MN</th>
                      <td class='col-md-2'>
                        <input class="efecto h22 bt" type="text" id="T_POCME_Total_MN" size="17" onBlur="validaIntDec(this);" value="0" readonly>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </form>
            </div>
          </div>

          <div class='acordeon2 mt-3'>
            <div class='encabezado font16' data-toggle='collapse' href='#collapseTwo'>
              <a href="#" id='bread'>PAGOS REALIZADOS POR SU CUENTA</a>
            </div>
            <div id='collapseTwo' class='card-block collapse'>
    		<!--div id='collapseTwo'-->
              <form class='form1' onsubmit="return false">
                <div>
                  <div class="row mt-3">
                    <div class='col-md-1 text-right pt-2 b'>Almacen :</div>
                    <div class='col-md-4'>
                      <select size="1" id="Lst_Conceptos" onchange ="tarifaAlmacen()">
                      <?php echo $ConceptosAlmacen; ?>
                      </select>
                    </div>
                    <div class='col-md-3'></div>
                    <div class='col-md-1 pt-2'>CUSTODIA</div>
                    <div class='col-md-1 pt-2'>MANIOBRAS</div>
                    <div class='col-md-1 pt-2'>ALMACENAJE</div>
                    <div class='col-md-1 pt-2'>TOTAL</div>
                  </div>
                  <div class='row mt-3'>
                    <div class='col-md-1 text-right pt-2 b'>Libres :</div>
                    <div class='col-md-4 pt-0'>
                      <select size="1" id="Lst_CA" onchange="tarifaAlmacenLibre()">
                        <?php echo $conceptosLibresAlmacen; ?>
                      </select>
                    </div>
                    <div class='col-md-3'></div>
                    <div class='col-md-1 pt-0'>
                      <input class="h22 efecto" type="text" id="T_Valor_Custodia_Aer" size="13" onblur="cortarDecimalesObj(this,2);totalManiobras();" value="<?php echo $custodia; ?>">
                    </div>
                    <div class='col-md-1 pt-0'>
                      <input class="h22 efecto" type="text" id="T_Valor_Manejo_Aer" size="13" onblur="cortarDecimalesObj(this,2);totalManiobras();" value="<?php echo $manejo; ?>" />
                    </div>
                    <div class='col-md-1 pt-0'>
                      <input class="h22 efecto" type="text" id="T_Valor_Almacenaje_Aer" size="13" onblur="cortarDecimalesObj(this,2);totalManiobras();" value="<?php echo $almacenaje; ?>" />
                    </div>
                    <div class='col-md-1 pt-0'>
                      <input class="h22 efecto border-0" type="text" id="T_Valor_Total_Maniobras" onblur="Pasa_Valor_Maniobras()" size="13" value="0" readonly>
                    </div>
                  </div>
                  <div class='row mt-4 sub2 justify-content-center m-0 p-2'>
                    <div class='col-md-6 font12'>CONCEPTO</div>
                    <div class='col-md-1 font12'>IMPORTE</div>
                    <div class='col-md-1'></div>
                  </div>

                  <div class='row m-0 justify-content-center mt-3 mb-3'>
                    <div class='col-md-6'>
    				  <input type="hidden" id="T_CA_idconcepto">
                      <input type="hidden" id="T_CA_idcuenta">
                      <input class="efecto" type="text" id="T_CA" size="60" readonly>
                    </div>
                    <div class='col-md-1'>
                      <input class="efecto" type="text" id="T_Valor_Concepto_Gral" onblur="cortarDecimalesObj(this,2)" size="15">
                    </div>
                    <div class='col-md-1 text-left'>
                      <a href='#' id="Btn_Cargo" onclick="agregarCargo();">
                        <img src='/conta6/Resources/iconos/002-plus.svg' class='icomediano'>
                      </a>
                    </div>
                  </div>
                </div>

                <table class='table'>
                  <thead>
                    <tr class='row mt-3 m-0 sub backpink'>
                      <th class='col-md-6'>CONCEPTOS</th>
                      <th class='col-md-4'></th>
                      <th class='col-md-2'>SUBTOTAL</th>
                    </tr>
                  </thead>
                  <tbody id="tbodyCargos">
                    <tr id="9" class="row m-0">
                      <td class='col-md-6 p-1 pt-3 b font12 ls1'>Impuestos Afianzados o Subsidiados</td>
                      <td class='col-md-4 p-1'></td>
                      <td class='col-md-2 p-1'>
                        <input class="efecto h22" type="text" id="T_Subsidio" size="20" onblur="validaIntDec(this);cortarDecimalesObj(this,2);Suma_Subtotales();" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                      </td>
                    </tr>
                    <tr id="10" class="row m-0">
                      <td class='col-md-6 p-1 pt-3 b font12 ls1'>Impuestos y/o derechos pagados o garantizados al Com. Ext.</td>
                      <td class='col-md-4 p-1'></td>
                      <td class='col-md-2 p-1'>
                        <input class="efecto h22" type="text" id="T_derechosPagados" size="20" onblur="validaIntDec(this);cortarDecimalesObj(this,2);Suma_Subtotales();" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
              <br><br><br>
    		</div>
          </div>

          <div class='acordeon2 mt-3'>
            <div class='encabezado font16' data-toggle='collapse' href='#collapseThree'>
              <a href="#" id='bread'>HONORARIOS Y SERVICIOS AL COMERCIO EXTERIOR</a>
            </div>
            <!--div id='collapseThree' class='panel-collapse collapse'-->
    		<div id='collapseThree'>
              <div class='card-block'>
                <form class='form1'>
                  <div class="">
                    <div class="row mt-3">
    				          <div class='col-md-1 pt-2  p-0 text-right b'>Honorarios :</div>
                      <div class='col-md-4'>
                        <select size="1" id="Lst_Conceptos_Honorarios" onchange="asignarTarifaH()">
                          <?php echo $ConceptosCliente; ?>
                        </select>
                      </div>
                      <div class="col-md-3"></div>
                      <div class="col-md-2 pt-2 text-right b p-0">% de Honorarios :</div>
                      <div class="col-md-2">
                        <input class="efecto h22" type="text" id="T_Honorarios_Porcentaje" onblur="Suma_Valor_Honorarios()" size="10" value="<?php echo cortarDecimales($factor_honorarios); ?>" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                      </div>
                    </div>

                    <div class='row mt-3'>
                      <div class='col-md-1 pt-2 p-0 text-right b'>Libres :</div>
                      <div class='col-md-4'>
                        <select size="1" onchange="asignarTarifaHlibres()" id="Lst_CHL">
                          <?php echo $conceptosLibresCliente; ?>
                        </select>
                      </div>
                      <div class="col-md-3"></div>
                      <div class="col-md-2 pt-2 text-right b p-0">Base :</div>
                      <div class="col-md-2">
                        <input class="efecto h22" type="text" id="T_Honorarios_Base_Honorarios" onblur="calculoHonorarios();" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                      </div>
                    </div>

                    <div class='row mt-3'>
                      <div class='col-md-8'></div>
                      <div class="col-md-2 pt-2 text-right b p-0">% Descuento :</div>
                      <div class="col-md-2">
                        <input class="efecto h22" type="text" id="T_Honorarios_Descuento" onblur="calculoHonorarios();" size="10" value="<?php echo cortarDecimales($descuento); ?>" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                      </div>
                    </div>

                    <div class='row mt-3'>
                      <div class='col-md-8'></div>
                      <div class="col-md-2 pt-2 text-right b p-0">Minimo de Hon :</div>
                      <div class="col-md-2">
                        <input class="efecto h22" type= text id="T_Honorarios_Minimo_Honorarios" onblur="validaIntDec(this);cortarDecimalesObj(this,2);" size="7" tabindex="<?php echo $tabindex = $tabindex+1;?>" value="<?php echo $honorarios; ?>">
                      </div>
                    </div>

                    <div class='row m-0 mt-4 backpink p-2 justify-content-center'>
                      <div class='col-md-2'></div>
                      <div class='col-md-4'>CONCEPTO</div>
                      <div class='col-md-1'>IMPORTE</div>
                      <div class='col-md-1'></div>
                      <div class='col-md-2'></div>
                      <!-- <div class='col-md-2'>MINIMO DE HON</div> -->
                    </div>
                    <div class='row m-0 mt-3 mb-3 justify-content-center'>
                      <div class='col-md-1'>
                        <input class="efecto" type="text" id="T_Hcta" size="15" readonly>
                      </div>
                      <div class='col-md-1'>
                        <input class="efecto" type="text" id="T_Hps" size="15" readonly>
                      </div>

                      <div class='col-md-4'>
                        <input class="efecto" type="text" id="T_CH" size="42" onchange="validarStringSAT(this);" onkeypress="return validarStringSATteclaPulsada(event);" onblur="limpia()">
                      </div>
                      <div class='col-md-1'>
                        <input class="efecto" type="text" id="T_Valor_Concepto_Honorarios" onblur="validaIntDec(this);cortarDecimalesObj(this,2);" size="15">
                      </div>
                      <div class='col-md-1 text-left'>
                        <a href='#' id="Btn_Honorarios" onclick="agregarHonorarios()"><img src='/conta6/Resources/iconos/002-plus.svg' class='icomediano'></a>
                      </div>

                      <div class='col-md-2 p-0 pt-2'>
                        <a href="javascript:ayudaPermitidos();">Caracteres permitidos <img class='icochico' src='/conta6/Resources/iconos/help.svg'></a>
                      </div>

                      <!-- <div class='col-md-2'>
                        <input class="efecto" type= text id="T_Honorarios_Minimo_Honorarios" onblur="validaIntDec(this);cortarDecimalesObj(this,2);" size="7" tabindex="<?php echo $tabindex = $tabindex+1;?>" value="<?php echo $honorarios; ?>">
                      </div> -->
                    </div>
                  </div>

                  <form onsubmit="return false">
                    <table class='table'>
                      <thead>
                        <tr class='row m-0 mt-4 sub2'>
                          <th class='col-md-4 p-1'>CONCEPTOS</th>
                          <th class='col-md-2 p-1'></th>
                          <th class='col-md-1 p-1'>noIdent</th>
                          <th class='col-md-1 p-1'>cveServProd</th>
                          <th class='col-md-1 p-1'>IMPORTE</th>
                          <th class='col-md-1 p-1'>
                            <input class="bt border-0" type="text" id="T_IVA_Porcentaje" size="2" readonly value="<?PHP echo redondear_dos_decimal($iva*100)?>">%IVA
                          </th>
                          <th class='col-md-1 p-1'>Retención 4%</th>
                          <th class='col-md-1 p-1'>SUBTOTAL</th>
                        </tr>
                      </thead>
                      <tbody id="tbodyHonorarios">
                        <tr id="18" class='row m-0'>
                          <td class="col-md-4 pt-3 b">
    					  	          <input class='efecto h22 T_Honorarios' type='text' id='T_Honorarios_0' size='60' onchange='javascript:eliminaBlancosIntermedios(this);validarStringSAT(this);' value="Honorarios" readonly tabindex='75'></td>
                          <td class="col-md-2"></td>
                          <td class='col-md-1 p-1'>
                            <input class="efecto h22 T_Honorarios_idcta" type="text" id="T_Hcta_0" size="15" value="0400-00001" readonly>
                          </td>
                          <td class='col-md-1 p-1'>
                            <input class="efecto h22 T_Honorarios_idps" type="text" id="T_Hps_0" size="15" value="<?php echo $cveProdHon;?>" readonly>
                          </td>
                          <td class="col-md-1 p-1">
                            <input class="efecto h22 T_Honorarios_Importe" type="text" id="T_Honorarios_Importe_0" onblur="validaIntDec(this);cortarDecimalesObj(this,2);Iva_Importe_Hon(0);" size="18" value="0" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                          </td>

                          <td class='col-md-1 p-1'>
                            <input class="efecto h22 T_Honorarios_IVA" type="text" id="T_Honorarios_IVA_0" size="20" value="0" readonly>
                          </td>
                          <td class='col-md-1 p-1'>
                            <input class="efecto h22 T_Honorarios_RET" type="text" id="T_Honorarios_RET_0" size="20" value="0" readonly>
                          </td>
                          <td class='col-md-1 p-1'>
                            <input class="efecto h22 T_Honorarios_Subtotal" type="text" id="T_Honorarios_Subtotal_0" size="20" value="0"  readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
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
                <!-- <tr class="row sub2">
                  <td class="col-md-3"></td>
                  <td class="col-md-3">Póliza</td>
                  <td class="col-md-3">Usuario</td>
                  <td class="col-md-3">Fecha</td>
                </tr>
                <tr class="row">
                  <td class="col-md-3 text-left"> Cta. generada</td>
                  <td class="p-1 col-md-3"></td>
                  <td class="p-1 col-md-3">
                    <input class="h22 bt border-0" type="text" id="T_Usuario" size="20"value="<?php echo $usuario; ?>" readonly>
                  </td>
                  <td class="p-1 col-md-3">
                    <input class="h22 bt border-0" type="text" id="T_Fecha_Cta" size="20" value="<?php $fecha = time (); echo date ( "d-m-Y h:i:s" , $fecha );?>" readonly>
                  </td>
                </tr>

                <tr class="row">
                  <td class="col-md-3 text-left"> Cta. modificada</td>
                  <td class="col-md-3"></td>
                  <td class="col-md-3"></td>
                  <td class="col-md-3"></td>
                </tr>
                <tr class="row">
                  <td class="col-md-3 text-left"> Factura generada</td>
                  <td class="col-md-3"></td>
                  <td class="col-md-3"></td>
                  <td class="col-md-3"></td>
                </tr>
                <tr class="row borderojo">
                  <td class="col-md-3 text-left"> Factura cancelada</td>
                  <td class="col-md-3"></td>
                  <td class="col-md-3"></td>
                  <td class="col-md-3"></td>
                </tr> -->


                <tr class="row">
                  <td class="col-md-3 text-left pt-4"> CUSTOMS DC </td>
                  <td class="col-md-3">
                    <select id="CUSTOMS" tabindex="<?php echo $tabindex = $tabindex+1; ?>">
                        <option value='1'>Si</option>
                        <option value='0' selected>No</option>
                    </select>
                  </td>
                  <td class="col-md-3">
                    <select id="Lst_metodoPago" onchange="asignarMetodoPago()">
                      <option value="PUE" selected>Seleccione método de pago</option>
                      <option value="PUE">Pago en una sola exhibición --- PUE</option>
                      <option value="PPD">Pago en parcialidades o diferido --- PPD</option>
                    </select>
                    <input class="efecto h22" type="text" id="T_metodoPago" value="PUE" readonly>
                 </td>
    			       <td class="col-md-3">
                   <select name="select" id="Lst_usoCFDI" onchange="asignarUsoCFDI()">
                    <?php echo $consultaUsoCFDIfac; ?>
                  </select>
    			        <input class="efecto h22" type="text" id="T_usoCFDI" size="20" readonly>
                </td>
                </tr>
                <tr class="row">
                  <td class="col-md-12 backpink">Seleccione forma y cuenta de pago</td>
                </tr>
                <tr class="row">
                  <td class="col-md-3">
                    <select id="Lst_formaPago" onchange="asignarFormaPago()">
                        <?php echo $datosCLTformaPago; ?>
                    </select>              </td>
                  <td class="col-md-3"><select size='1' id='Lst_cuentaPago' onChange="asignarCtaBanco()">
                    <option selected value='0'>Seleccione Banco</option>
                    </select>
                    <div id="numerosCuenta"></div>              </td>
                  <td class="col-md-3">
                    <?php if( $oRst_permisos["CFD_cta_gastos_generarT0"] == 0){ ?>
                    <select name="select2" id="lst_moneda" onchange="asignarMoneda()">
                      <?php echo $consultaMoneda; ?>
                    </select>
                    <?php } ?>              </td>
                  <td class="col-md-3">              </td>
                </tr>

                <tr class="row sub2">
                  <td class="col-md-3">Forma de pago</td>
                  <td class="col-md-3">Número de cuenta</td>
                  <td class="col-md-3">Moneda</td>
                  <td class="col-md-3 p-0 pt-3">Tipo Cambio (4 dec.)</td>
                </tr>

                <tr class="row">
                  <td class="col-md-3">
                    <input class="efecto h22" type="text" id="T_FormaPago" size="20" readonly>
                  </td>
                  <td class="col-md-3">
                    <input class="efecto h22" type="text" id="T_CuentaPago" size="20" readonly>
                  </td>
                  <td class="col-md-3">
                    <input class="efecto h22" type="text" id="T_Moneda" size="6" value="MXN" readonly>
                  </td>
                  <td class="col-md-3">
                    <input type="text" id="T_monedaTipoCambio" class="efecto h22" readonly size="18" onBlur="validaIntDec(this);" />
                  </td>
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
                      <div id="total_CuentaGastos"></div>
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
          <div id="mensaje"></div>
        </div>
      </div>
    </div>


    <?php
      require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/modales/depositos.php';
      require $root . '/conta6/Ubicaciones/footer.php';
    ?>



?>
