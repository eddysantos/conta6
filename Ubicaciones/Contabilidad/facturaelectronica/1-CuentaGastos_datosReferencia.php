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
      if( $rows_facCaptRef > 0 ){
        $statusReferencia = "<input type='text' id='Txt_ExistenCuentas' size='65' class='p-0 b inputId-red font14' db-id='$rows_status' value='Ya existe cuenta de gastos con esta referencia' readonly>";
      }

      if( $rows_facCaptRef == 0 ){
        $statusReferencia = "<input type='text' id='Txt_ExistenCuentas' size='65' class='p-0 b inputId font14'  db-id='$rows_status' value='No existe cuenta de gastos con esta referencia' readonly>";
      }

      //si tiene corresponsal
      $tr_corresponsal = "";
      if( $id_corresponsal > 0 ){
        $tieneCorresp = true;
        require $root . '/conta6/Resources/PHP/actions/consultaDatosCorresponsal.php';

        $tr_corresponsal = "
        <tr class='row mt-2 align-items-center'>
          <td class='col-md-2 text-right b p-0'><b>Facturar a:</b></td>
          <td class='col-md-7 p-0'>
            <select class='custom-select-mod h25' id='DGE_Lst_Datos' onchange='asignar_facturarA()'>
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
        <tr class='row mt-2 align-items-center'>
          <td class='col-md-2 b text-right p-0'><b>Cuenta Americana:</b></td>
          <td class='p-0 col-md-4'>
            <select class='custom-select-mod h25' size='1' id='DGEctaAme' onchange='cargarCtaAme()'>
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
        <tr class='row mt-2 align-items-center'>
          <td class='col-md-2 b text-right p-0'><b>Proforma:</b></td>
          <td class='p-0 col-md-4'>
          <select class='custom-select-mod h25' size='1' id='DGEproforma' onchange='cargarSolicitudAnticipo()'>
            <option selected value='0'>Proforma</option>
            $proforma
          </select>
          </td>
        </tr>";
      }

      # CON ESTE PERMISO, SE PUEDE GENERAR UNA CUANTA DE GASTOS CON INFORMACION INCOMPLETA.
      if($oRst_permisos['s_cta_gastos_generarCR'] == 1){
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


      $tr_factura = "$tr_corresponsal
      <tr class='row mt-2 align-items-center'>
        <td class='col-md-2 text-right b p-0'><b>Facturar a otro:</b></td>
        <td class='col-md-7 p-0'>
          <input class='efecto popup-input' id='DGEcliente' type='text' id-display='#popup-display-DGEcliente' action='clientes' db-id='' autocomplete='off'>
          <div class='popup-list' id='popup-display-DGEcliente' style='display:none'></div>
        </td>
      </tr>
      $tr_ctaAme
      $tr_proforma
      <tr class='row align-items-center mt-3'>
        <td class='col-md-2 text-right b p-0'>
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
            $btn_cambioRegimen
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
