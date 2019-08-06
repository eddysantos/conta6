<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_referencia = $_POST['id_referencia'];

require $root . '/conta6/Resources/PHP/actions/consultaDatosReferencia.php';


if( $rows_buscaRef > 0 ){
  $row_buscaRef = $rslt_buscaRef->fetch_assoc();
  $id_aduanaReferencia = $row_buscaRef['fk_id_aduana'];

  if ($id_aduanaReferencia == $aduana){ //VALIDO QUE LA ADUANA EN LA REFERENCIA CORRESPONDA A LA OFICINA ACTIVA


    $datosEmbarque = "<table class='table font12'>";
      require $root . '/conta6/Resources/PHP/actions/datosGeneralesEmbarque.php';

      //consulto si ya tiene cuentas capturadas
      require $root . '/conta6/Resources/PHP/actions/consultaFacturaCapturaReferencia.php';
      if( $rows_ctaAmetRef > 0 ){
        $statusReferencia = "<input type='text' id='Txt_ExistenCuentas' size='65' class='p-0 b inputId-red font14' db-id='$rows_status' value='Ya existe cuenta de gastos con esta referencia' readonly>";
      }

      if( $rows_ctaAmetRef == 0 ){
        $statusReferencia = "<input type='text' id='Txt_ExistenCuentas' size='65' class='p-0 b inputId font14'  db-id='$rows_status' value='No existe cuenta de gastos con esta referencia' readonly>";
      }

      //si tiene corresponsal
      $tr_corresponsal = "";
      if( $id_corresponsal > 0 ){
        $tieneCorresp = true;
        require $root . '/conta6/Resources/PHP/actions/consultaDatosCorresponsal.php';

        $tr_corresponsal = "
        <tr class='row mt-2 align-items-center'>
          <td class='col-md-2 text-right b pt-0 pb-0'><b>Facturar a:</b></td>
          <td class='col-md-7 p-0'>
            <select class='custom-select-mod h25' id='DGE_Lst_Datos' onchange='asignar_facturarA()'>
                  <option selected value='0'>Cliente / Corresponsal</option>
                  <option value='$id_cliente'>$nom_cliente</option>
                  <option value='$idcliente_corresp'>$nom_corresp</option>
            </select>
          </td>
        </tr>";
      }

      //Si tiene $tr_proforma
      require $root . '/conta6/Resources/PHP/actions/proforma_referencia.php';
      if ($rslt_proforma->num_rows > 0) {
        $tr_proforma = "
        <tr class='row mt-2 align-items-center'>
          <td class='col-md-2 b text-right pt-0 pb-0'><b>Proforma:</b></td>
          <td class='p-0 col-md-4'>
          <select class='custom-select-mod h25' size='1' id='DGEproforma' onchange='cargarSolicitudAnticipo()'>
            <option selected value='0'>Proforma</option>
            $proforma
          </select>
          </td>
        </tr>";
      }

      require $root . '/conta6/Resources/PHP/actions/lst_clientes.php';
      if ($rslt_clientes->num_rows > 0) {
        $tr_facturarOtro = "
        <tr class='row mt-2 align-items-center'>
          <td class='col-md-2 b text-right pt-0 pb-0'><b>Facturar a otro:</b></td>
          <td class='col-md-7 p-0'>
            <select class='custom-select-mod h25' size='1' id='DGEcliente' onchange='cargarOtroCliente()'>
              <option selected value='0'>Facturar a otro</option>
              $clientes
            </select>
          </td>
        </tr>";
      }


      //Si tiene factura electrónica
      require $root . '/conta6/Resources/PHP/actions/consultaFactura_timbradas_porReferencia.php';
      if ($rslt->num_rows > 0) {
        $tr_facturaCFDI = "
        <tr class='row mt-2 align-items-center'>
          <td class='col-md-2 b text-right pb-0 pt-0'><b>Factura CFDI:</b></td>
          <td class='p-0 col-md-4'>
            <select class='custom-select-mod h25' size='1' id='DGEfacturas' onchange='cargarFactura()'>
              <option selected value='0'>Facturas</option>
              $facCFDI
            </select>
          </td>
        </tr>";
      }




      // solo cuando la informacion este completa se muestra el boton siguiente
      $btn = "<tr class='row justify-content-center'>
          <td class='col-md-1'>
            <a href='#' id='Btn_conReferencia' onclick='validaDatosReferencia_ctaAme()' class='boton'> Siguiente</a>
          </td>
        </tr>";

          //onclick='validaDatosReferencia('$id_referencia','$consolidado',$entradas,$shipper,'$inbond',$flete)'


      $btn_siguiente = "";
      if($tieneProv == true && $tieneNumFact == true && $tienePeso == true && $tieneValor == true && $tieneTipoCambio == true){
        if( $tieneAlmacen == false && $aduana == 240 ){ $btn_siguiente = $btn; } // Nuevo Laredo no maneja tarifas de almacen.
        if( $tieneAlmacen == true && $aduana != 240 ){ $btn_siguiente = $btn; } // debe tener asignado un almacen
      }
      // <tr class='row mt-2 align-items-center'>
      //   <td class='col-md-2 text-right b p-0'><b>Facturar a otro:</b></td>
      //   <td class='col-md-7 p-0'>
      //     <input class='efecto popup-input h25' id='DGEclienteAme' type='text' id-display='#popup-display-DGEclienteAme' action='clientes_Ame' db-id='' autocomplete='off'>
      //     <div class='popup-list' id='popup-display-DGEclienteAme' style='display:none'></div>
      //   </td>
      // </tr>

      $tr_factura = "$tr_corresponsal
      $tr_facturarOtro
      $tr_facturaCFDI
      $tr_proforma
      <tr class='row align-items-center mt-3'>
        <td class='col-md-2 text-right b pt-0 pb-0'>
          <b>Expedir cta de gastos a:</b>
          <input type='hidden' id='docto' value='cliente'>
          <input type='hidden' id='opcionDoc' value='ctagastos'>
          <input id='no_cliente_oculto' type='hidden' value='$id_cliente'>
          <input id='nombre_cliente_oculto' type='hidden' value='$nom_cliente'>
        </td'>
        <td class='col-md-1 text-left'>
          <input id='DGE_idcliente' type='text' value='$id_cliente' readonly class='efecto h22 border-0'>
        </td>
        <td class='col-md-9 text-left'>
          <div id='nombreCliente'>$nom_cliente</div>
          <input type='hidden' name='folio' id='folio' value='0' readonly>
        </td>
      </tr>
      <tr class='row'>
        <td class='col-md-12'>
            $btn_siguiente
        </td>
      </tr>";


    $datosEmbarque .= $tr_factura."</table>";

    $system_callback['code'] = 1;
    $system_callback['data'] = $datosEmbarque;
    $system_callback['message'] = "Script called successfully!";
    exit_script($system_callback);

  }else{
    $system_callback['code'] = 1;
    $system_callback['data'] ="<p align='center'>Se capturo mal la ADUANA en TR&Aacute;FICO O ES DE OTRA OFICINA</p><BR><center><B>".$id_referencia.' - '.$id_aduanaReferencia;
    $system_callback['message'] = "Script called successfully!";
    exit_script($system_callback);
  }//fin si corresponde la aduana de la referencia con la oficina



}//fin $rows_buscaRef

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
