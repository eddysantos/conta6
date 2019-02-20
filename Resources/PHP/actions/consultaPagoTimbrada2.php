<?PHP
  $query_pagoTimbrada = "SELECT *
                        From conta_t_pagos_cfdi a, conta_t_pagos_captura b
                        Where a.fk_id_pago_captura = b.pk_id_pago_captura and a.pk_id_pago = ?";

  $stmt_pagoTimbrada = $db->prepare($query_pagoTimbrada);
  if (!($stmt_pagoTimbrada)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_pagoTimbrada->bind_param('s',$buscar);
  if (!($stmt_pagoTimbrada)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_pagoTimbrada->errno]: $stmt_pagoTimbrada->error";
    exit_script($system_callback);
  }
  if (!($stmt_pagoTimbrada->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_pagoTimbrada->errno]: $stmt_pagoTimbrada->error";
    exit_script($system_callback);
  }
  $rslt_pagoTimbrada = $stmt_pagoTimbrada->get_result();
  $rows_pagoTimbrada = $rslt_pagoTimbrada->num_rows;

  if( $rows_pagoTimbrada > 0 ){
    while( $row_pagoTimbrada = $rslt_pagoTimbrada->fetch_assoc() ){
      $id_pago_captura = $row_pagoTimbrada['fk_id_pago_captura'];
      $pk_id_pago = $row_pagoTimbrada['pk_id_pago'];
      $id_poliza = $row_pagoTimbrada['fk_id_poliza'];
      $d_fechaTimbrado = $row_pagoTimbrada['d_fechaTimbrado'];
      $s_cancela = $row_pagoTimbrada['s_cancela'];
      $id_cliente = $row_pagoTimbrada['fk_id_cliente'];
      $nombre = $row_pagoTimbrada['s_nombre'];
      $cancela = $row['s_selloSATcancela'];

      #rutas de consulta
      $anioActual = date_format(date_create($d_fechaTimbrado),"Y");
      $rutaAnioActual = $root . '/conta6/CFDI_generados/'.$anioActual;
      $rutaCLT = $rutaAnioActual.'/'.$id_cliente;
      //$nombre_archivo = $referencia.'_'.$id_factura.'_pago';
      $nombre_archivo = $row_pagoTimbrada['s_nombrearchivo'];
      $nombre_archivoCancela = $nombre_archivo.'_cancela';
      $rutaFileXML = $rutaCLT.'/'.$nombre_archivo.'.xml';
      $rutaFileHTML = $rutaCLT.'/'.$nombre_archivo.'.html';
      $rutaFilePDF = $rutaCLT.'/'.$nombre_archivo.'.pdf';
      $rutaFilePDFcancela = $rutaCLT.'/'.$nombre_archivoCancela.'.pdf';

      if( $cancela <> "" ){
        $hrefcancela = "<a href='#' onclick='docTimbrado_download(&#39;$nombre_archivoCancela.xml&#39;,&#39;$rutaFilePDFcancela&#39;)'><img class='icomediano ml-4' src='/conta6/Resources/iconos/pdf.svg'></a>";
        $status = $hrefcancela;
      }else{ $status = "Activo"; }

      $hrefSig = "
      <a href='#' class='ver' accion='cuadroConsultar' onclick='pagosConsultar($id_pago_captura,&#39;$id_cliente&#39;)'><img class='icomediano' src='/conta6/Resources/iconos/magnifier.svg'></a>
      <a href='#' onclick='docTimbrado_ver(&#39;$nombre_archivo.xml&#39;,&#39;$rutaFilePDF&#39;)'><img class='icomediano ml-5' src='/conta6/Resources/iconos/printer.svg'></a>";

      $pagosCFDI .= "<tr class='row font14 borderojo'>
        <td class='col-md-1'>
          <a href='#' onclick='docTimbrado_download(&#39;$nombre_archivo.xml&#39;,&#39;$rutaFileXML&#39;)'><img class='icomediano' src='/conta6/Resources/iconos/xml.svg'></a>
          <a href='#' onclick='docTimbrado_download(&#39;$nombre_archivo.pdf&#39;,&#39;$rutaFilePDF&#39;)'><img class='icomediano ml-4' src='/conta6/Resources/iconos/pdf.svg'></a>
        </td>
        <td class='col-md-1'>$d_fechaTimbrado</td>
        <td class='col-md-1'>$pk_id_pago</td>
        <td class='col-md-1'>$id_poliza</td>
        <td class='col-md-1'>$status</td>
        <td class='col-md-4'>$id_cliente $nombre</td>
        <td class='col-md-1 text-right'>$hrefSig</td>
      </tr>";
    }
  }

?>
