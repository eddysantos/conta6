<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

  $regimenNomina = trim($_POST['regimen']);
  $anio = trim($_POST['anio']);
  $semana = trim($_POST['nomina']);



  $query_consultaTotalEmpleados = "SELECT count(distinct fk_id_empleado) as empleados
                              FROM conta_t_nom_captura
                              WHERE fk_id_regimen = ? and fk_id_aduana = ? and n_anio = ? and n_semana = ?";
  $stmt_consultaTotalEmpleados = $db->prepare($query_consultaTotalEmpleados);
  if (!($stmt_consultaTotalEmpleados)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_consultaTotalEmpleados->bind_param('ssss',$regimenNomina,$aduana,$anio,$semana);
  if (!($stmt_consultaTotalEmpleados)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_consultaTotalEmpleados->errno]: $stmt_consultaTotalEmpleados->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaTotalEmpleados->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaTotalEmpleados->errno]: $stmt_consultaTotalEmpleados->error";
    exit_script($system_callback);
  }
  $rslt_consultaTotalEmpleados = $stmt_consultaTotalEmpleados->get_result();
  $rows_consultaTotalEmpleados = $rslt_consultaTotalEmpleados->num_rows;

  if ($rows_consultaTotalEmpleados > 0) {
      while ($row_consultaTotalEmpleados = $rslt_consultaTotalEmpleados->fetch_assoc()) {
        $totalEmpleados = $row_consultaTotalEmpleados['empleados'];
      }

  }



  $query_consultaTotalCFDI = "SELECT count(s_UUID) as CFDI
                                    FROM conta_t_nom_captura a, conta_t_nom_cfdi b
                                    WHERE a.pk_id_docNomina = b.fk_id_docNomina and b.s_UUID is not null and
                                          fk_id_regimen = ? and fk_id_aduana = ? and n_anio = ? and n_semana = ?";
  $stmt_consultaTotalCFDI = $db->prepare($query_consultaTotalCFDI);
  if (!($stmt_consultaTotalCFDI)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_consultaTotalCFDI->bind_param('ssss',$regimenNomina,$aduana,$anio,$semana);
  if (!($stmt_consultaTotalCFDI)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_consultaTotalCFDI->errno]: $stmt_consultaTotalCFDI->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaTotalCFDI->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaTotalCFDI->errno]: $stmt_consultaTotalCFDI->error";
    exit_script($system_callback);
  }
  $rslt_consultaTotalCFDI = $stmt_consultaTotalCFDI->get_result();
  $rows_consultaTotalCFDI = $rslt_consultaTotalCFDI->num_rows;

  if ($rows_consultaTotalCFDI > 0) {
      while ($row_consultaTotalCFDI = $rslt_consultaTotalCFDI->fetch_assoc()) {
        $totalCFDI = $row_consultaTotalCFDI['CFDI'];
      }

  }




  $query_consultaTotalCancelados = "SELECT count(s_selloSATcancela) as cancelados
                                    FROM conta_t_nom_captura a, conta_t_nom_cfdi b
                                    WHERE a.pk_id_docNomina = b.fk_id_docNomina and b.s_UUID is not null and b.s_selloSATcancela is not null and
                                          fk_id_regimen = ? and fk_id_aduana = ? and n_anio = ? and n_semana = ?";
  $stmt_consultaTotalCancelados = $db->prepare($query_consultaTotalCancelados);
  if (!($stmt_consultaTotalCancelados)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_consultaTotalCancelados->bind_param('ssss',$regimenNomina,$aduana,$anio,$semana);
  if (!($stmt_consultaTotalCancelados)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_consultaTotalCancelados->errno]: $stmt_consultaTotalCancelados->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaTotalCancelados->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaTotalCancelados->errno]: $stmt_consultaTotalCancelados->error";
    exit_script($system_callback);
  }
  $rslt_consultaTotalCancelados = $stmt_consultaTotalCancelados->get_result();
  $rows_consultaTotalCancelados = $rslt_consultaTotalCancelados->num_rows;

  if ($rows_consultaTotalCancelados > 0) {
      while ($row_consultaTotalCancelados = $rslt_consultaTotalCancelados->fetch_assoc()) {
        $totalCancelados = $row_consultaTotalCancelados['cancelados'];
      }

  }


  $query_consultaTotalActivos = "SELECT sum(c.n_importeGravado) as totalPercepciones,
                                       sum(c.n_totalDeducciones) as totalDeducciones,
                                       sum(n_total) as total,
                                       sum(n_totalNeto) as totalNeto
                                    FROM conta_t_nom_captura a, conta_t_nom_cfdi b, conta_t_nom_captura_det c
                                    WHERE a.pk_id_docNomina = b.fk_id_docNomina and a.pk_id_docNomina = c.fk_id_docNomina and b.s_UUID is not null and
                                          fk_id_regimen = ? and fk_id_aduana = ? and n_anio = ? and n_semana = ?";
  $stmt_consultaTotalActivos = $db->prepare($query_consultaTotalActivos);
  if (!($stmt_consultaTotalActivos)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_consultaTotalActivos->bind_param('ssss',$regimenNomina,$aduana,$anio,$semana);
  if (!($stmt_consultaTotalActivos)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_consultaTotalActivos->errno]: $stmt_consultaTotalActivos->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaTotalActivos->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaTotalActivos->errno]: $stmt_consultaTotalActivos->error";
    exit_script($system_callback);
  }
  $rslt_consultaTotalActivos = $stmt_consultaTotalActivos->get_result();
  $rows_consultaTotalActivos = $rslt_consultaTotalActivos->num_rows;

  if ($rows_consultaTotalActivos > 0) {
      while ($row_consultaTotalActivos = $rslt_consultaTotalActivos->fetch_assoc()) {
        $totalPercepciones = $row_consultaTotalActivos['totalPercepciones'];
        $totalDeducciones = $row_consultaTotalActivos['totalDeducciones'];
        $total = $row_consultaTotalActivos['total'];
        $totalNeto = $row_consultaTotalActivos['totalNeto'];
      }

  }


  $query_consultaFecha = "SELECT distinct d_fechaFinal, d_fechaInicio
                              FROM conta_t_nom_captura
                              WHERE fk_id_regimen = ? and fk_id_aduana = ? and n_anio = ? and n_semana = ?";
  $stmt_consultaFecha = $db->prepare($query_consultaFecha);
  if (!($stmt_consultaFecha)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_consultaFecha->bind_param('ssss',$regimenNomina,$aduana,$anio,$semana);
  if (!($stmt_consultaFecha)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_consultaFecha->errno]: $stmt_consultaFecha->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaFecha->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaFecha->errno]: $stmt_consultaFecha->error";
    exit_script($system_callback);
  }
  $rslt_consultaFecha = $stmt_consultaFecha->get_result();
  $rows_consultaFecha = $rslt_consultaFecha->num_rows;

  if ($rows_consultaFecha > 0) {
      while ($row_consultaFecha = $rslt_consultaFecha->fetch_assoc()) {
        $fechaInicio = $row_consultaFecha['d_fechaInicio'];
        $fechaFinal = $row_consultaFecha['d_fechaFinal'];
      }
  }

  $consultaDatosGenerales =
  "<tr class='row m-0'>
      <td class='col-md-1'>$totalEmpleados</td>
      <td class='col-md-1'>$totalCFDI</td>
      <td class='col-md-2'>$totalCancelados</td>
      <td class='col-md-2'>$totalPercepciones</td>
      <td class='col-md-2'>$totalDeducciones</td>
      <td class='col-md-2'>$total</td>
      <td class='col-md-2'>$totalNeto</td>
    </tr>
    <tr class='row m-0 mt-4'>
      <td class='col-md-12'>NÓMINA $semana $fechaInicio al $fechaFinal <a href='#' onclick='imprimirNomina($anio,$semana,&#39;Todas&#39;,&#39;$regimenNomina&#39;)' data-toggle='modal'><img class='icomediano' src='/conta6/Resources/iconos/printer.svg'></a></td>
    </tr>
    <tr class='row m-0'>
      <td class='col-md-12'>Ordinaria <a href='#' onclick='imprimirNomina($anio,$semana,&#39;O&#39;,&#39;$regimenNomina&#39;)' data-toggle='modal'><img class='icomediano' src='/conta6/Resources/iconos/printer.svg'></a>
                            Extraordinaria <a href='#' onclick='imprimirNomina($anio,$semana,&#39;E&#39;,&#39;$regimenNomina&#39;)' data-toggle='modal'><img class='icomediano' src='/conta6/Resources/iconos/printer.svg'></a></td>
    </tr>";

  $system_callback['code'] = 1;
  $system_callback['data'] = $consultaDatosGenerales;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);
?>
