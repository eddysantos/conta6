<?php

$system_callback = [];
$bancos = '';

$bancos = $bancos."<option selected value='0'>Seleccione un banco</option>";
  $query = "SELECT s_nombre,pk_id_banco FROM conta_cs_sat_bancos WHERE s_activo = 1";

  $stmt = $db->prepare($query);
	if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare bancos [$db->errno]: $db->error";
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
    $system_callback['message'] = "Script called successfully but there are no rows to display.";
    $bancos = $bancos."<option selected value='0'>Sin resultados</option>";
    exit_script($system_callback);
  }

  while ($row = $rslt->fetch_assoc()) {
   	$nombrebanco = $row['s_nombre'];
    $pk_id_banco = $row['pk_id_banco'];
    $bancos = $bancos."<option value='$pk_id_banco'>$nombrebanco -- $pk_id_banco</option>";
  }


 ?>
