<?php


$query_permisosReportesOficina = "select * from conta_cu_permisos_reportes_oficinas where fk_usuario = ? and fk_id_reporte = ? and fk_id_aduana = ? ";

$stmt_permisosReportesOficina = $db->prepare($query_permisosReportesOficina);
if (!($stmt_permisosReportesOficina)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_permisosReportesOficina->bind_param('sss', $usuario,$numreporte,$Oficina);
if (!($stmt_permisosReportesOficina)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_permisosReportesOficina->errno]: $stmt_permisosReportesOficina->error";
  exit_script($system_callback);
}

if (!($stmt_permisosReportesOficina->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_permisosReportesOficina->errno]: $stmt_permisosReportesOficina->error";
  exit_script($system_callback);
}

$rslt_permisosReportesOficina = $stmt_permisosReportesOficina->get_result();

if ($rslt_permisosReportesOficina->num_rows == 0) {
  echo "No se encontraron resultados";
}

// if ($rslt_permisosReportesOficina->num_rows > 0) {
//   $row = $rslt_permisosReportesOficina->fetch_assoc();
//     $system_callback['valor'] = $row['n_valor'];
//     $system_callback['fecha'] = $row['d_fechache'];
//     $system_callback['nombre'] = $row['s_nomOrd'];
//     $system_callback['rfc'] = $row['s_rfc'];
// }

?>
