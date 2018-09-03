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
        $statusReferencia = "<input type='text' id='Txt_ExistenCuentas' size='65' class='b border-0 font14' db-id='$rows_status' value='Ya existe cuenta de gastos con esta referencia' readonly";
      }

      if( $rows_facCaptRef == 0 ){
        $statusReferencia = "<input type='text' id='Txt_ExistenCuentas' size='65' class='b border-0 font14'  db-id='$rows_status' value='No existe cuenta de gastos con esta referencia' readonly";
      }

      //si tiene corresponsal
      $tr_corresponsal = "";
      if( $id_corresponsal > 0 ){
        $tieneCorresp = true;
        require $root . '/conta6/Resources/PHP/actions/consultaDatosCorresponsal.php';

        $tr_corresponsal = "
        <tr class='row'>
          <td class='col-md-2 text-right b mt-3'>Facturar a:</td>
          <td class='col-md-10'>
            <select class='custom-select' id='DGE_Lst_Datos' onchange='asignar_facturarA()'>
          				<option selected value='0'>Cliente / Corresponsal</option>
          				<option value='$id_cliente'>$nom_cliente</option>
          				<option value='$idcliente_corresp'>$nom_corresp</option>
          	</select>
          </td>
        </tr>";
      }


      //Si tiene cuentas americanas
      require $root . '/conta6/Resources/PHP/actions/facturas_ctaAme_referencia.php';
      if ($rslt_ctaAme->num_rows > 0) {
        $tr_ctaAme = "
        <tr class='row'>
      		<td class='col-md-6'>
            <select class='custom-select' size='1' id='DGEctaAme' onchange='cargarCtaAme()'>
              <option selected value='0'>Cuenta Americana</option>
              $facCtaAme
            </select>
  		    </td>";
      }


      //Si tiene $tr_proforma
      require $root . '/conta6/Resources/PHP/actions/proforma_referencia.php';
      if ($rslt_proforma->num_rows > 0) {
        $tr_proforma = "
          <td class='col-md-6'>
          <select class='custom-select' size='1' id='DGEproforma' onchange='cargarSolicitudAnticipo()'>
            <option selected value='0'>Proforma</option>
            $proforma
          </select>
          </td>
        </tr>";
      }

      # CON ESTE PERMISO, SE PUEDE GENERAR UNA CUANTA DE GASTOS CON INFORMACION INCOMPLETA.
      if($oRst_permisos['CFDI_cta_gastos_generarCR'] == 1){
        $btn_cambioRegimen = "
        <tr class='row justify-content-center font14'>
          <td class='col-md-3'>
            <a href='#' id='Btn_cambioRegimen' onclick='validaDatosReferencia()' class='boton'> Generar con cambio de régimen</a>
          </td>";


        //onclick='validaDatosReferencia('$id_referencia','$consolidado',$entradas,$shipper,'$inbond',$flete)'
      }

      // solo cuando la informacion este completa se muestra el boton siguiente
      $btn = "
          <td class='col-md-1'>
            <a href='#' id='Btn_conReferencia' onclick='validaDatosReferencia()' class='boton'> Siguiente</a>
          </td>
        </tr>";

          //onclick='validaDatosReferencia('$id_referencia','$consolidado',$entradas,$shipper,'$inbond',$flete)'


      $btn_siguiente = "";
      if($tieneProv == true && $tieneNumFact == true && $tienePeso == true && $tieneValor == true && $tieneTipoCambio == true){
        if( $tieneAlmacen == false && $aduana == 240 ){ $btn_siguiente = $btn; } // Nuevo Laredo no maneja tarifas de almacen.
        if( $tieneAlmacen == true && $aduana != 240 ){ $btn_siguiente = $btn; } // debe tener asignado un almacen
      }





      #$id_cliente = '';
      #$nombre_cliente = '';

      $datosEmbarque .= "
        <tr class='row'>
          <td class='col-md-12 sub'>INFORMACIÓN GENERAL DEL EMBARQUE</td>
        </tr>

        <tr class='row'>
          <td class='col-md-1 text-right b'>Cliente:</td>
          <td class='col-md-5 text-left'>$nom_cliente -- $id_cliente</td>
          <td class='col-md-1 text-right b'>Proveedor:</td>
          <td class='col-md-5 text-left'>$nom_proveedor --  $id_prov</td>
        </tr>
        <tr class='row borderojo'>
           <td class='col-md-1 text-right b'>Almacén:</td>
           <td class='col-md-5 text-left'>$nom_almacen -- Id: $id_almacen</td>
           <td class='col-md-1 text-right b'>Descripción: </td>
           <td class='col-md-5 text-left'>$descripcion</td>
        </tr>

        <tr class='row'>
          <td class='col-md-2 text-right b'>Aduana:</td>
          <td class='col-md-2 text-left'>$id_aduanaReferencia</td>
          <td class='col-md-2 text-right b'>Procedencia o destino:</td>
          <td class='col-md-2 text-left'>$row_buscaRef[procedencia]</td>
          <td class='col-md-2 text-right b'>Tipo de operación:</td>
      	  <td class='col-md-2 text-left'>$row_buscaRef[s_tipo]</td>
        </tr>

        <tr class='row'>
          <td class='col-md-2 text-right b'>Tipo:</td>
          <td class='col-md-2 text-left'>$txt_tipo</td>
          <td class='col-md-2 text-right b p-0 pt-3'>Fecha de arribo o salida:</td>
          <td class='col-md-2 text-left'>$fecha_entrada</td>
          <td class='col-md-2 text-right b'>Talones, Guia o B/Ls:</td>
      	  <td class='col-md-2 text-left'>$row_buscaRef[s_guia_master]</td>
        </tr>

        <tr class='row'>
          <td class='col-md-2 text-right b pt-4'>Nuestra referencia:</td>
          <td class='col-md-2 text-left'>
            <input class='efecto h22 border-0 bt text-left p-0' type='text' id='DGE_referencia' value='$id_referencia' readonly>
          </td>
          <td class='col-md-2 text-right b pt-4'>Peso en Kg.:</td>
          <td class='col-md-2 text-left pt-4'>$peso</td>
          <td class='col-md-2 text-right b pt-4'>Valor Aduana M.N.:</td>
      	  <td class='col-md-2 text-left pt-4'>$valor</td>
        </tr>

        <tr class='row borderojo'>
          <td class='col-md-2 text-right b'>Su Referencia:</td>
          <td class='col-md-2 text-left'>$refCli</td>
          <td class='col-md-2 text-right b'>No. Pedimento:</td>
          <td class='col-md-2 text-left'>$row_buscaRef[s_pedimento]</td>
          <td class='col-md-2 text-right b'>Tipo de cambio:</td>
      	  <td class='col-md-2 text-left'>$tipoCambio</td>
        </tr>

        <tr class='row'>
          <td class='col-md-2 text-right b pt-4'>Días en almacen: </td>
          <td class='col-md-1'><input type='text' id='T_Dias' name='T_Dias' class='efecto h22' tabindex='<?php echo $tabindex = $tabindex+1; ?>'></td>
          <td class='col-md-1'></td>
          <td class='col-md-2 text-right b'>Núm. de Facturas: </td>
      	  <td class='col-md-6 text-left'>$facturas</td>
        </tr>

       <tr class='row'>
          <td class='col-md-2 text-right b pt-3'>Shipper:</td>
          <td class='col-md-1'><input class='text-left bt border-0' type='text' id='DGE_shipper' value='$shipper' readonly></td>
          <td class='col-md-2 text-right b pt-3'>InBond:</td>
          <td class='col-md-1'><input class='text-left bt border-0' type='text' id='DGE_inbond' value='$inbond' readonly></td>
          <td class='col-md-2 text-right b'>Trailer de Salida:</td>
          <td class='col-md-1 text-left'>$row_buscaRef[s_trailerOut]</td>
          <td class='col-md-2 text-right b'>Reexpedición:</td>
          <td class='col-md-1 text-left'>$row_buscaRef[reexpedicion]</td>
        </tr>
        <tr class='row'>
          <td class='col-md-2 text-right b pt-3'>Consolidado:</td>
          <td class='col-md-1'><input class='text-left bt border-0' type='text' id='DGE_consolidado' value='$consolidado' readonly></td>
          <td class='col-md-2 text-right b pt-3'>Entradas:</td>
          <td class='col-md-1'><input class='text-left bt border-0' type='text' id='DGE_entradas' value='$entradas' readonly></td>
          <td class='col-md-2 text-right b pt-3'>Flete: $status_flete</td>
          <td class='col-md-1'><input class='text-left bt border-0' type='text' id='DGE_flete' value='$flete' readonly></td>
          <td class='col-md-2 text-right b pt-4'>Cobrar:</td>
          <td class='col-md-1 text-left'>$fleteOption</td>
        </tr>
        <tr class='row'>
      		<td class='col-md-2 text-right b pt-3'>Estatus:</td>
      		<td class='col-md-10 text-left'>$statusReferencia</td>
      	</tr>
        $tr_corresponsal
        <tr class='row mt-3'>
      		<td class='col-md-2 text-right b mt-3'>Facturar a otro:</td>
          <td class='col-md-10 input-effect'>
            <input class='efecto popup-input' id='DGEcliente' type='text' id-display='#popup-display-DGEcliente' action='clientes' db-id='' autocomplete='off' onchange='cargarOtroCliente()'>
            <div class='popup-list' id='popup-display-DGEcliente' style='display:none'></div>
            <label for='DGEcliente'>Cliente</label>
          </td>
      	</tr>
        $tr_ctaAme
        $tr_proforma
        <tr class='row'>
          <td class='col-md-2 text-right b pt-4 p-0'>
            Expedir cta de gastos a:
            <input type='hidden' id='opcion' value='cliente' readonly>
            <input type='hidden' id='docto' value='ctagastos' readonly>
            <input id='no_cliente_oculto' type='hidden' value='$id_cliente'>
            <input id='nombre_cliente_oculto' type='hidden' value='$nom_cliente'>
          </td'>
          <td class='col-md-1 text-left'>
            <input id='DGE_idcliente' type='text' value='$id_cliente' readonly class='efecto h22 border-0'>
          </td>
          <td class='col-md-9 text-left pt-4'>
            <div id='nombreCliente'>$nom_cliente</div>
            <input type='hidden' name='folio' id='folio' value='0' readonly>
          </td>
        </tr>
        <tr class='row'>
          <td class='col-md-12'>
              $btn_cambioRegimen
              $btn_siguiente
          </td>
        </tr>";

?>
