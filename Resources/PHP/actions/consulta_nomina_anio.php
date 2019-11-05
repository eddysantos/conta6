<?PHP

  $query_consultaAnioNomina = "SELECT DISTINCT n_anio FROM conta_t_nom_captura WHERE fk_id_regimen = ? and fk_id_aduana = ? order by n_anio desc";
  $stmt_consultaAnioNomina = $db->prepare($query_consultaAnioNomina);
  if (!($stmt_consultaAnioNomina)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_consultaAnioNomina->bind_param('ss',$regimenNomina,$aduana);
  if (!($stmt_consultaAnioNomina)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_consultaAnioNomina->errno]: $stmt_consultaAnioNomina->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaAnioNomina->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaAnioNomina->errno]: $stmt_consultaAnioNomina->error";
    exit_script($system_callback);
  }
  $rslt_consultaAnioNomina = $stmt_consultaAnioNomina->get_result();
  $rows_consultaAnioNomina = $rslt_consultaAnioNomina->num_rows;

  if ($rows_consultaAnioNomina > 0) {
      $consultaAnioNomina = "<option selected id='buscaranio'>Año</option>";
      while ($row_consultaAnioNomina = $rslt_consultaAnioNomina->fetch_assoc()) {
        $anioNomina = $row_consultaAnioNomina['n_anio'];
        $consultaAnioNomina .= '<option value="'.$anioNomina.'">'.$anioNomina.'</option>';
      }
  }

  /*
  <select id=" ">
      <?php echo $consultaAnioNomina; ?>
  </select>
  */

?>
