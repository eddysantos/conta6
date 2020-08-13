<?PHP
  $text = "%" . $buscar . "%";

  $query_ncTimbrada = "SELECT *
                        FROM conta_t_notacredito_captura a INNER JOIN conta_t_notacredito_cfdi b
                        	ON a.pk_id_cuenta_captura_nc = b.fk_id_cuenta_captura_nc
                        WHERE b.pk_id_notacredito like ? or b.fk_referencia like ?";


  $stmt_ncTimbrada = $db->prepare($query_ncTimbrada);
  if (!($stmt_ncTimbrada)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_ncTimbrada->bind_param('ss',$text,$text);
  if (!($stmt_ncTimbrada)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_ncTimbrada->errno]: $stmt_ncTimbrada->error";
    exit_script($system_callback);
  }
  if (!($stmt_ncTimbrada->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_ncTimbrada->errno]: $stmt_ncTimbrada->error";
    exit_script($system_callback);
  }
  $rslt_ncTimbrada = $stmt_ncTimbrada->get_result();
  $rows_ncTimbrada = $rslt_ncTimbrada->num_rows;

  if ($rslt_ncTimbrada->num_rows == 0) {
    $resultadoConsulta =
    "<tr class='row borderojo font14'>
      <td class='col-md-4 text-right'>No se encontraron resultados</td>
     </tr>";

    // $system_callback['code'] = 1;
    // $system_callback['data'] =
    // "<p db-id=''>No se encontraron resultados</p>";
    // $system_callback['message'] = "Script called successfully but there are no rows to display.";
    // exit_script($system_callback);
  }

  if( $rows_ncTimbrada > 0 ){
    while( $row_ncTimbrada = $rslt_ncTimbrada->fetch_assoc() ){
      $id_factura = $row_ncTimbrada['pk_id_notacredito'];
      $id_poliza_nc = $row_ncTimbrada['fk_id_poliza'];
      $id_poliza_nc = $row_ncTimbrada['fk_id_poliza'];
      $fk_referencia =  $row_ncTimbrada['fk_referencia'];
      $s_selloSATcancela = $row_ncTimbrada['s_selloSATcancela'];
      $id_cliente = $row_ncTimbrada['fk_id_cliente'];
      $nombre = $row_ncTimbrada['s_nombre'];
      $fk_id_cuenta_captura_nc = $row_ncTimbrada['fk_id_cuenta_captura_nc'];
      $d_fechaTimbrado = $row_ncTimbrada['d_fecha_fac'];

      #rutas de consulta
      $anioActual = date_format(date_create($d_fechaTimbrado),"Y");
      $rutaAnioActual = $root . '/CFDI_generados/'.$anioActual;
      $rutaCLT = $rutaAnioActual.'/'.$id_cliente;
      $nombre_archivo = $fk_referencia.'_'.$id_factura.'_notacredito';
      $nombre_archivoCancela = $nombre_archivo.'_cancela';
      $rutaFileXML = $rutaCLT.'/'.$nombre_archivo.'.xml';
      $rutaFileHTML = $rutaCLT.'/'.$nombre_archivo.'.html';
      $rutaFilePDF = $rutaCLT.'/'.$nombre_archivo.'.pdf';
      $rutaFilePDFcancela = $rutaCLT.'/'.$nombre_archivoCancela.'.pdf';

      if( $s_selloSATcancela <> '' ){
        $hrefcancela = "<a href='#' onclick='docTimbrado_download(&#39;$nombre_archivoCancela.xml&#39;,&#39;$rutaFilePDFcancela&#39;)'><img class='icomediano ml-4' src='/Resources/iconos/pdf.svg'></a>";
        $status = $hrefcancela;
      }else{ $status = "Activo"; }

      if( $oRst_permisos['s_NC_consultar'] == 1 ){
        $hreConsultaCFDI = "
        <a href='#' class='ver' accion='cuadroConsultar' onclick='ncConsultar($fk_id_cuenta_captura_nc,&#39;$id_cliente&#39;)'><img class='icomediano' src='/Resources/iconos/magnifier.svg'></a>
        <a href='#' onclick='docTimbrado_ver(&#39;$nombre_archivo.xml&#39;,&#39;$rutaFilePDF&#39;)'><img class='icomediano ml-5' src='/Resources/iconos/printer.svg'></a>";
      }


      $s_UUID = $row_ncTimbrada['s_UUID'];
      $usuario_timbra = $row_ncTimbrada['fk_usuario'];
      $fechaTimbre = $row_ncTimbrada['d_fechaTimbrado'];
      $s_cancela_factura = $row_ncTimbrada['s_cancela_factura'];
      $fechaTimbreCancela = $row_ncTimbrada['d_fechaTimbradoCancela'];
      $usuario_Cancela = $row_ncTimbrada['s_usuario_cancela'];
      $n_cantidadNC = $row_ncTimbrada['n_cantidadNC'];
      $fk_cveUnidadNC = $row_ncTimbrada['fk_cveUnidadNC'];
      $fk_c_ClaveProdServ = $row_ncTimbrada['fk_c_ClaveProdServ'];
      $s_descripNC = $row_ncTimbrada['s_descripNC'];
      $n_valorUnitNC = $row_ncTimbrada['n_valorUnitNC'];
      $n_importeNC = $row_ncTimbrada['n_importeNC'];



      $resultadoConsulta .=
      "<tr class='row borderojo font14'>
        <td class='col-md-1 text-right'>
          <a href='#' onclick='docTimbrado_download(&#39;$nombre_archivo.xml&#39;,&#39;$rutaFileXML&#39;)'><img class='icomediano' src='/Resources/iconos/xml.svg'></a>
          <a href='#' onclick='docTimbrado_download(&#39;$nombre_archivo.pdf&#39;,&#39;$rutaFilePDF&#39;)'><img class='icomediano ml-4' src='/Resources/iconos/pdf.svg'></a>
        </td>
        <td class='col-md-2'>$id_factura</td>
        <td class='col-md-1'>$fk_referencia</td>
        <td class='col-md-1'>$fk_id_cuenta_captura_nc</td>
        <td class='col-md-1'>$id_poliza_nc</td>
        <td class='col-md-1'>$status</td>
        <td class='col-md-4'>$id_cliente $nombre</td>
        <td class='col-md-1 text-right'>".$hreConsultaCFDI."</td>
       </tr>";

    }
  }

?>
