<?PHP
$aduana = 240;

      $refCli = $row_buscaRef['s_referencia_cliente'];
      $descripcion = $row_buscaRef['s_descripcion'];
      $entradas = $row_buscaRef['s_bodegaIn'];
      $inbond = trim($row_buscaRef['s_inBond']);
      $status_flete = $row_buscaRef['s_status_flete'];


      //INICIALIZO LAS VARIABLES QUE ACTIVARAN EL BOTON SIGUIENTE SI TODAS SON "TRUE", ES INFORMACION NECESARIA PARA FACTURAR
      $tieneProv = false;
      $tieneNumFact = false;
      $tieneAlmacen = false;
      $tieneCtasCliente = false;
      $tieneCorresp = false;
      $tieneCtasCorresp = false;
      $tienePeso = false;
      $tieneValor = false;
      $tieneTipoCambio = false;
      $tiene_metodoPagoCliente = false;
      //////////////////////////////////////////////////////////


      $id_cliente = $row_buscaRef['fk_id_cliente'];
      $nom_cliente = "<font color='#F73A4A'><b>No Capturado (SISTEMA DE TRAFICO)</b></font>";

      $id_prov = $row_buscaRef['fk_id_proveedor'];
      $nom_proveedor = "<font color='#F73A4A'><b>No Capturado (SISTEMA DE TRAFICO)</b></font>";

      $id_almacen = $row_buscaRef['fk_almacen_seccion'];
      $nom_almacen = "<font color='#F73A4A'><b>No Capturado (SISTEMA DE TRAFICO)</b></font>";

      $tipo = $row_buscaRef['s_imp_exp'];
      if( $tipo == 'I' ){ $txt_tipo = "Importación"; }
      if( $tipo == 'E' ){ $txt_tipo = "Exportación"; }

      $peso = $row_buscaRef['n_peso'];
      if( $peso == "" ){
        $peso = "<font color='#F73A4A'><b>No Capturado (SISTEMA DE TRAFICO)</b></font>";
      }else{
        $peso = number_format($peso,2,'.',',');
        $tienePeso = true;
      }

      $fecha_entrada = $row_buscaRef['d_fecha_entrada'];
      if (!is_null($fecha_entrada)){ $fecha_entrada = date_format(date_create($fecha_entrada),"d-m-Y"); }else{ $fecha_entrada = '';}

      $valor = $row_buscaRef['n_valor_aduana'];
      if($valor == ""){
          $valor = "<font color='#F73A4A'><b>No Capturado (SISTEMA DE TRAFICO)</b></font>";
      }else{
          $valor = number_format($valor,2,'.',',');
          $tieneValor = true;
      }

      $tipoCambio = $row_buscaRef['n_tipo_cambio'];
      if ($tipoCambio == ""){
        $tipoCambio = "<font color='#F73A4A'><b>No Capturado (SISTEMA DE TRAFICO)</b></font>";
      }else{
        $tipoCambio = number_format($tipoCambio,2,'.',',');
        $tieneTipoCambio = true;
      }

      $facturas = $row_buscaRef['s_facturas'];
      if ($facturas == ''){
        $facturas = "<font color='#F73A4A'><b>No Capturado (SISTEMA DE TRAFICO)</b></font>";
      }else{
        $tieneNumFact = true;
      }

			$flete = $row_buscaRef['n_valor_flete'];
			if( is_null($flete) ){
				$flete = 0;
			}else{
        $flete = number_format($flete,2,'.',',');
      }
      $fleteOption = "<select id='cobrarFlete'>
                        <option value='si' selected>Si</option>
                        <option value='no'>No</option>
                      </select>";

      $shipper = trim( preg_replace('[a-zA-Z]', '', $row_buscaRef['s_shipper'] ) );
      if(is_numeric($shipper)) {
        $shipper = $shipper;
      }else{
        $shipper = 0;
      }

      $consolidado = trim($row_buscaRef['s_consolidado']);
      if ($consolidado == ''){
        $consolidado = "<font color='#F73A4A'><b>No Capturado (SISTEMA DE TRAFICO)</b></font>";
      }else{
        if($consolidado == "LTL"){ $consolidado = "LTL"; }else{ $consolidado = "FTL"; }
        $tieneConsolidado = true;
      }


      //consulto datos del cliente
      require $root . '/conta6/Resources/PHP/actions/consultaDatosCliente.php';

      //consulto datos del Proveedor
      require $root . '/conta6/Resources/PHP/actions/consultaDatosProveedorReplica.php';
      if( $rows_datosPROV > 0 ){
        $tieneProv = true;
      }

      //consulto nombre del almacen
      if( $id_aduanaReferencia == 240 ){ $nom_almacen = "Ninguno"; }
      if( $id_aduanaReferencia != 240 ){

        require $root . '/conta6/Resources/PHP/actions/consultaDatosAlmacen.php';

        if( $rows_datosAlmacen > 0 ){
            $tieneAlmacen = true;
        }
        if( $rows_datosAlmacen == 0 ){
          $nom_almacen = "<font color='#F73A4A'><b>El Almacen no Existe en Contabilidad</b></font>";
        }
      }
      if( $id_almacen == "" ){ $id_almacen = 0; }


      //consulto si ya tiene cuentas capturadas
      require $root . '/conta6/Resources/PHP/actions/consultaFacturaCapturaReferencia.php';
      if( $rows_facCaptRef > 0 ){
        $statusReferencia = "<input type='text' id='Txt_ExistenCuentas' size='65' style='font-family: Trebuchet MS; font-size: 10pt; border: 0px solid #C0C0C0; background-color:#F73A4A; color:#ffffff;' db-id='$rows_status' value='Ya existe cuenta de gastos con esta referencia' readonly";
      }

      if( $rows_facCaptRef == 0 ){
        $statusReferencia = "<input type='text' id='Txt_ExistenCuentas' size='65' style='font-family: Trebuchet MS; font-size: 10pt; border: 0px solid #C0C0C0;'  db-id='$rows_status' value='No existe cuenta de gastos con esta referencia' readonly";
      }

      //si tiene corresponsal
      $tr_corresponsal = "";
      if( $id_corresponsal > 0 ){
        $tieneCorresp = true;
        require $root . '/conta6/Resources/PHP/actions/consultaDatosCorresponsal.php';

        $tr_corresponsal = "
        <tr>
        <td align='right'>Facturar a:</td>
        <td colspan='8'>
          <select size='1' id='DGE_Lst_Datos' style='font-family: Trebuchet MS; font-size: 10pt' onchange='asignar_facturarA()'>
        				<option selected value='0'>Cliente / Corresponsal</option>
        				<option value='$id_cliente'>$nom_cliente</option>
        				<option value='$idcliente_corresp'>$nom_corresp</option>
        	</select></td>
        </tr>";
      }


      //Si tiene cuentas americanas
      require $root . '/conta6/Resources/PHP/actions/facturas_ctaAme_referencia.php';
      if ($rslt_ctaAme->num_rows > 0) {
        $tr_ctaAme = "
        <tr bgcolor='#FFFFFF'>
      		<td align='right'>Extraer POCME:</td>
      		<td colspan='8' >
            <select class='custom-select' size='1' id='DGEctaAme' onchange='cargarCtaAme()'>
              <option selected value='0'>Cuenta Americana</option>
              $facCtaAme
            </select>
  		    </td>
      	</tr>";
      }


      //Si tiene $tr_proforma
      require $root . '/conta6/Resources/PHP/actions/proforma_referencia.php';
      if ($rslt_proforma->num_rows > 0) {
        $tr_proforma = "
        <tr bgcolor='#FFFFFF'>
          <td align='right'>Extraer POCME:</td>
          <td colspan='8' >
          <select class='custom-select' size='1' id='DGEproforma' onchange='cargarSolicitudAnticipo()'>
            <option selected value='0'>Proforma</option>
            $proforma
          </select>
          </td>
        </tr>";
      }

      # CON ESTE PERMISO, SE PUEDE GENERAR UNA CUANTA DE GASTOS CON INFORMACION INCOMPLETA.
      if($oRst_permisos['CFDI_cta_gastos_generarCR'] == 1){
        $btn_cambioRegimen = "<input type='button' value='Generar con cambio de régimen' id='Btn_cambioRegimen'
        onclick='validaDatosReferencia()'
        style='font-family: Trebuchet MS; font-size: 10pt; color: #000000;'/>";
        //onclick='validaDatosReferencia('$id_referencia','$consolidado',$entradas,$shipper,'$inbond',$flete)'
      }

      // solo cuando la informacion este completa se muestra el boton siguiente
      $btn = "<input type='button' value='Siguiente' id='Btn_conReferencia'
          onclick='validaDatosReferencia()'
					style='font-family: Trebuchet MS; font-size: 10pt; color: #000000;'>";
          //onclick='validaDatosReferencia('$id_referencia','$consolidado',$entradas,$shipper,'$inbond',$flete)'


      $btn_siguiente = "";
      if($tieneProv == true && $tieneNumFact == true && $tienePeso == true && $tieneValor == true && $tieneTipoCambio == true){
        if( $tieneAlmacen == false && $aduana == 240 ){ $btn_siguiente = $btn; } // Nuevo Laredo no maneja tarifas de almacen.
        if( $tieneAlmacen == true && $aduana != 240 ){ $btn_siguiente = $btn; } // debe tener asignado un almacen
      }





      #$id_cliente = '';
      #$nombre_cliente = '';

      $datosEmbarque .= "
        <tr>
          <td bgcolor='#C0C0C0' colspan='8' align='center'>I N F O R M A C I &Oacute; N &nbsp;&nbsp; G E N E R A L &nbsp;&nbsp;  D E L &nbsp;&nbsp; E M B A R Q U E </td>
        </tr>
        <tr>
          <td bgcolor='#C0C0C0'>Cliente:</td>
          <td colspan='5'>$nom_cliente</td>
          <td bgcolor='#C0C0C0'>ID Cliente: </td>
          <td>$id_cliente</td>
        </tr>
        <tr>
          <td bgcolor='#C0C0C0'>Proveedor:</td>
          <td colspan='5'>$nom_proveedor</td>
          <td bgcolor='#C0C0C0'>ID Proveedor:</td>
          <td>$id_prov</td>
        </tr>
        <tr>
           <td bgcolor='#C0C0C0'>Almac&eacute;n:</td>
           <td colspan='5'>$nom_almacen</td>
           <td bgcolor='#C0C0C0'>ID Almacen: </td>
           <td>$id_almacen</td>
        </tr>
        <tr>
          <td bgcolor='#C0C0C0'>Aduana:</td>
          <td>$id_aduanaReferencia</td>
          <td bgcolor='#C0C0C0'>Tipo:</td>
          <td>$txt_tipo</td>
          <td bgcolor='#C0C0C0'>Nuestra referencia: </td>
      	  <td><input type='text' id='DGE_referencia' value='$id_referencia' readonly></td>
          <td bgcolor='#C0C0C0'>Su Referencia:</td>
          <td>$refCli</td>
        </tr>
        <tr>
          <td bgcolor='#C0C0C0'>Descripci&oacute;n general: </td>
          <td colspan='7'>$descripcion</td>
        </tr>
        <tr>
           <td bgcolor='#C0C0C0'>Procedencia o destino: </td>
           <td>$row_buscaRef[procedencia]</td>
           <td bgcolor='#C0C0C0'>Fecha de arribo o salida: </td>
           <td>$fecha_entrada</td>
           <td bgcolor='#C0C0C0'>Peso en Kg.: </td>
         <td>$peso</td>
           <td bgcolor='#C0C0C0'>No. Pedimento: </td>
           <td>$row_buscaRef[s_pedimento]</td>
         </tr>
         <tr>
            <td bgcolor='#C0C0C0'>Tipo de operaci&oacute;n:</td>
            <td>$row_buscaRef[s_tipo]</td>
            <td bgcolor='#C0C0C0'>Talones, Guia o B/Ls: </td>
            <td>$row_buscaRef[s_guia_master]</td>
            <td bgcolor='#C0C0C0'>Valor Aduana M.N.: </td>
        	  <td>$valor</td>
            <td bgcolor='#C0C0C0'>Tipo de cambio: </td>
            <td>$tipoCambio</td>
          </tr>
          <tr>
            <td bgcolor='#C0C0C0'>D&iacute;as en almacen: </td>
            <td><input type='text' id='T_Dias' name='T_Dias' size='5' style='border-style:inset; border-width:3px; font-family: Trebuchet MS; font-size:10pt; text-align:center; font-weight:bold;' tabindex='<?php echo $tabindex = $tabindex+1; ?>'></td>
            <td bgcolor='#C0C0C0'>N&uacute;m. de Facturas: </td>
        	<td colspan='5'>$facturas</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
            <td bgcolor='#C0C0C0'>Shipper:</td>
            <td><input type='text' id='DGE_shipper' value='$shipper' readonly></td>
            <td bgcolor='#C0C0C0'>InBond:</td>
            <td><input type='text' id='DGE_inbond' value='$inbond' readonly></td>
            <td bgcolor='#C0C0C0'>Trailer de Salida:</td>
            <td>$row_buscaRef[s_trailerOut]</td>
            <td bgcolor='#C0C0C0'>Reexpedici&oacute;n:</td>
            <td bgcolor='#C0C0C0'>$row_buscaRef[reexpedicion]</td>
          </tr>
          <tr>
            <td bgcolor='#C0C0C0'>Consolidado:</td>
            <td><input type='text' id='DGE_consolidado' value='$consolidado' readonly></td>
            <td bgcolor='#C0C0C0'>Entradas:</td>
            <td><input type='text' id='DGE_entradas' value='$entradas' readonly></td>
            <td bgcolor='#C0C0C0'>Flete: $status_flete</td>
            <td><input type='text' id='DGE_flete' value='$flete' readonly></td>
            <td>Cobrar</td>
            <td>$fleteOption</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
        	  <td>&nbsp;</td>
        	  <td>&nbsp;</td>
        	  <td>&nbsp;</td>
        	  <td>&nbsp;</td>
        	  <td>&nbsp;</td>
        	  <td>&nbsp;</td>
        	  <td>&nbsp;</td>
        	  <td>&nbsp;</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
        		<td align='right'>Estatus:</td>
        		<td colspan='8'>$statusReferencia</td>
        	</tr>
          $tr_corresponsal
          <tr bgcolor='#FFFFFF'>
        		<td align='right'>Facturar a otro:</td>
            <td class='col-md-2 input-effect' colspan='8'>
              <input class='efecto popup-input' id='DGEcliente' type='text' id-display='#popup-display-DGEcliente' action='clientes' db-id='' autocomplete='off' onchange='cargarOtroCliente()'>
              <div class='popup-list' id='popup-display-DGEcliente' style='display:none'></div>
              <label for='DGEcliente'>Cliente</label>
            </td>
        	</tr>
          $tr_ctaAme
          $tr_proforma
          <tr bgcolor='#FFFFFF'>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan='6'>&nbsp;</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td align='right' colspan='2'>
              Expedir cuenta de gastos a:
              <input type='text' id='opcion' size='12' value='cliente' readonly>
              <input type='text' id='docto' size='12' value='ctagastos' readonly>
              <input id='DGE_idcliente' type='text' size='10' value='$id_cliente' readonly style='font-family: Trebuchet MS; font-size: 10pt; border: 0px solid #7F7F7F; background-color: #7F7F7F;>
              <input id='no_cliente_oculto' type='hidden' size='10' value='$id_cliente'>
              <input id='nombre_cliente_oculto' type='hidden' size='10' value='$nom_cliente'>
            </td>
            <td colspan='6'>
              <div id='nombreCliente'>$nom_cliente</div>
              <input type='hidden' name='folio' id='folio'  size='10' value='0' readonly>
            </td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan='6'>&nbsp;</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td colspan='8'>
                $btn_cambioRegimen
                $btn_siguiente
            </td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan='6'>&nbsp;</td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan='6'>&nbsp;</td>
          </tr>
          ";

?>
