<?PHP
//$aduana = 240;

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
      $fleteOption = "<select id='cobrarFlete' class='custom-select-mod h18 p-0'>
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


      #$id_cliente = '';
      #$nombre_cliente = '';

      $datosEmbarque .= "
        <tr class='row'>
          <td class='col-md-12 sub'>INFORMACIÓN GENERAL DEL EMBARQUE</td>
        </tr>

        <tr class='row'>
          <td class='col-md-1 text-right b'><b>Cliente:</b></td>
          <td class='col-md-5 text-left'>$nom_cliente -- $id_cliente</td>
          <td class='col-md-1 text-right b'><b>Proveedor:</b></td>
          <td class='col-md-5 text-left'>$nom_proveedor --  $id_prov</td>
        </tr>
        <tr class='row borderojo'>
           <td class='col-md-1 text-right b'><b>Almacén:</b></td>
           <td class='col-md-5 text-left'>$nom_almacen -- Id: $id_almacen</td>
           <td class='col-md-1 text-right b'><b>Descripción:</b></td>
           <td class='col-md-5 text-left'>$descripcion</td>
        </tr>

        <tr class='row pt-4'>
          <td class='p-0 col-md-2 text-right b'><b>Aduana:</b></td>
          <td class='p-0 col-md-2 text-left'>$id_aduanaReferencia</td>
          <td class='p-0 col-md-2 text-right b'><b>Procedencia o destino:</b></td>
          <td class='p-0 col-md-2 text-left'>$row_buscaRef[procedencia]</td>
          <td class='p-0 col-md-2 text-right b'><b>Tipo de operación:</b></td>
      	  <td class='p-0 col-md-2 text-left'>$row_buscaRef[s_tipo]</td>
        </tr>

        <tr class='row pt-3'>
          <td class='p-0 col-md-2 text-right b'><b>Tipo:</b></td>
          <td class='p-0 col-md-2 text-left'>$txt_tipo</td>
          <td class='p-0 col-md-2 text-right b pl-0'><b>Fecha arribo o salida:</b></td>
          <td class='p-0 col-md-2 text-left'>$fecha_entrada</td>
          <td class='p-0 col-md-2 text-right b'><b>Talones, Guia o B/Ls:</b></td>
      	  <td class='p-0 col-md-2 text-left'>$row_buscaRef[s_guia_master]</td>
        </tr>

        <tr class='row align-items-center' style='padding-top: .7rem!important;'>
          <td class='p-0 col-md-2 text-right b'><b>Nuestra referencia:</b></td>
          <td class='p-0 col-md-2 text-left'>
            <input class='inputId bt text-left p-0' type='text' id='DGE_referencia' value='$id_referencia' readonly>
          </td>
          <td class='p-0 col-md-2 text-right b'><b>Peso en Kg:</b></td>
          <td class='p-0 col-md-2 text-left'>$peso</td>
          <td class='p-0 col-md-2 text-right b'><b>Valor Aduana M.N.:</b></td>
      	  <td class='p-0 col-md-2 text-left'>$valor</td>
        </tr>

        <tr class='row borderojo pb-4 pt-3'>
          <td class='p-0 col-md-2 text-right b'><b>Su Referencia:</b></td>
          <td class='p-0 col-md-2 text-left'>$refCli</td>
          <td class='p-0 col-md-2 text-right b'><b>No. Pedimento:</b></td>
          <td class='p-0 col-md-2 text-left'>$row_buscaRef[s_pedimento]</td>
          <td class='p-0 col-md-2 text-right b'><b>Tipo de cambio:</b></td>
      	  <td class='p-0 col-md-2 text-left'>$tipoCambio</td>
        </tr>

        <tr class='row mt-4 align-items-center'>
          <td class='p-0 col-md-2 text-right b'><b>Días en almacen:</b></td>
          <td class='p-0 col-md-1'>
            <input type='text' id='T_Dias' name='T_Dias' class='efecto h18' tabindex='<?php echo $tabindex = $tabindex+1; ?>' autocomplete='off'>
          </td>

          <td class='p-0 col-md-2 offset-md-1 text-right b'><b>Shipper:</b></td>
          <td class='p-0 col-md-1'>
            <input class='text-left bt inputId p-0' type='text' id='DGE_shipper' value='$shipper' readonly>
          </td>

          <td class='p-0 col-md-2 offset-md-1 text-right b'><b>Núm. de Facturas:</b></td>
      	  <td class='p-0 col-md-2 text-left'>$facturas

          </td>
        </tr>

         <tr class='row mt-2 align-items-center'>
           <td class='p-0 col-md-2 text-right b'><b>Flete: $status_flete</b></td>
           <td class='p-0 col-md-1'><input class='text-left bt inputId p-0' type='text' id='DGE_flete' value='$flete' readonly></td>

           <td class='p-0 col-md-2 offset-md-1 text-right b'><b>InBond:</b></td>
           <td class='p-0 col-md-1'><input class='text-left bt inputId p-0' type='text' id='DGE_inbond' value='$inbond' readonly></td>

           <td class='p-0 col-md-2 offset-md-1 text-right b'><b>Trailer de Salida:</b></td>
           <td class='p-0 col-md-1 text-left'>$row_buscaRef[s_trailerOut]</td>
        </tr>


        <tr class='row pt-2 align-items-center'>
          <td class='p-0 col-md-2 text-right b'><b>Cobrar:</b></td>
          <td class='p-0 col-md-1 text-left'>$fleteOption</td>

          <td class='p-0 col-md-2 offset-md-1 text-right b'><b>Reexpedición:</b></td>
          <td class='p-0 col-md-1 text-left'>$row_buscaRef[reexpedicion]</td>

          <td class='p-0 col-md-2 offset-md-1 text-right b'><b>Entradas:</b></td>
          <td class='p-0 col-md-1'><input class='text-left bt inputId p-0' type='text' id='DGE_entradas' value='$entradas' readonly></td>
        </tr>

        <tr class='row pt-2 align-items-center'>
          <td class='p-0 col-md-2 text-right b'><b>Consolidado:</b></td>
          <td class='p-0 col-md-1'>
            <input class='text-left bt inputId p-0' type='text' id='DGE_consolidado' value='$consolidado' readonly>
          </td>
      	</tr>

        <tr class='row mt-5 align-items-center'>
          <td class='p-0 col-md-2 text-right b'><b>Estatus:</b></td>
          <td class='p-0 col-md-4 text-left'>$statusReferencia</td>
        </tr>";

?>
