<?php

$system_callback = [];
$jornada = '';
$jornada .="<option selected value='0'>Jornada *</option>";

  $query = "SELECT pk_id_jornada,s_descripcion FROM conta_cs_sat_tipojornada";

  $stmt = $db->prepare($query);
	if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare jornada [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  if (!($stmt->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
    exit_script($system_callback);
  }


	$rslt = $stmt->get_result();

  if ($rslt->num_rows == 0) {
    $system_callback['code'] = 1;
    $jornada ="<option selected value='0'>No hay datos</option>";
    $system_callback['message'] = "Script called successfully but there are no rows to display.";
    exit_script($system_callback);
  }

  while ($row = $rslt->fetch_assoc()) {
    $pk_id_jornada = $row['pk_id_jornada'];
    $s_descripcion = $row['s_descripcion'];
    $jornada .= "<option value='$pk_id_jornada'>$pk_id_jornada -- $s_descripcion</option>";
  }

 ?>
