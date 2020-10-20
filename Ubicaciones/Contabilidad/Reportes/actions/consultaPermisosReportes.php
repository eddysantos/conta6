<?php


$query_permisosReportes = "select * from conta_cu_permisos_reportes where fk_usuario = ? and fk_id_reporte = ? ";

$stmt_permisosReportes = $db->prepare($query_permisosReportes);
if (!($stmt_permisosReportes)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_permisosReportes->bind_param('ss', $usuario,$numreporte);
if (!($stmt_permisosReportes)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt_permisosReportes->errno]: $stmt_permisosReportes->error";
  exit_script($system_callback);
}

if (!($stmt_permisosReportes->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_permisosReportes->errno]: $stmt_permisosReportes->error";
  exit_script($system_callback);
}

$rslt_permisosReportes = $stmt_permisosReportes->get_result();

if ($rslt_permisosReportes->num_rows == 0) {
  echo "No se encontraron resultados";
}

// if ($rslt_permisosReportes->num_rows > 0) {
//   $row = $rslt_permisosReportes->fetch_assoc();
//     $system_callback['valor'] = $row['n_valor'];
//     $system_callback['fecha'] = $row['d_fechache'];
//     $system_callback['nombre'] = $row['s_nomOrd'];
//     $system_callback['rfc'] = $row['s_rfc'];
// }

?>
