<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_referencia = $_POST['id_referencia'];

require $root . '/conta6/Resources/PHP/actions/consultaDatosReferencia.php';


if( $rows_buscaRef > 0 ){
  $row_buscaRef = $rslt_buscaRef->fetch_assoc();
  $id_aduanaReferencia = $row_buscaRef['fk_id_aduana'];

  if ($id_aduanaReferencia == $aduana){ //VALIDO QUE LA ADUANA EN LA REFERENCIA CORRESPONDA A LA OFICINA ACTIVA

    //consulto si ya tiene cuentas capturadas
    require $root . '/conta6/Resources/PHP/actions/consultaSolAnticipoCapturaReferencia.php';
    if( $rows_solAntCaptRef > 0 ){
      $statusReferencia = "<input type='text' id='Txt_ExistenCuentas' size='65' class='p-0 b inputId-red font14' db-id='$rows_status' value='Ya existe proforma con esta referencia' readonly >";
    }
    if( $rows_solAntCaptRef == 0 ){
      $statusReferencia = "<input type='text' id='Txt_ExistenCuentas' size='65' class='p-0 b inputId font14'  db-id='$rows_status' value='No existe proforma con esta referencia' readonly>";
    }


      $datosEmbarque = "<table class='table font12'>";
        require $root . '/conta6/Resources/PHP/actions/datosGeneralesEmbarque.php';

        // solo cuando la informacion este completa se muestra el boton siguiente
        $btn = "<tr class='row justify-content-center font14'>
            <td class='col-md-1'>
              <a href='#' id='Btn_conReferencia' onclick='solAntGenerar()' class='boton'> Siguiente</a>
            </td>
          </tr>";



        $btn_siguiente = "";
        if($tieneProv == true && $tieneNumFact == true && $tienePeso == true && $tieneValor == true && $tieneTipoCambio == true){
          if( $tieneAlmacen == false && $aduana == 240 ){ $btn_siguiente = $btn; } // Nuevo Laredo no maneja tarifas de almacen.
          if( $tieneAlmacen == true && $aduana != 240 ){ $btn_siguiente = $btn; } // debe tener asignado un almacen
        }

      $datosEmbarque .= "<tr class='row align-items-center mt-3'>
                          <td class='col-md-2 text-right b p-0'>
                            <b>Expedir proforma a:</b>
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
                        </tr></table>";

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
