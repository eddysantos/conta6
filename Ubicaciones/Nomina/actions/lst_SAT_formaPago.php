<?php

$system_callback = [];
$formaPago = '';

$formaPago .="<option selected value='0'>Método de pago *</option>";
  $query = "SELECT * FROM conta_cs_sat_formapago WHERE s_activo = 'S'";

  $stmt = $db->prepare($query);
	if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
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
    $formaPago ="<option selected value='0'>Sin resultados</option>";
    $system_callback['message'] = "Script called successfully but there are no rows to display.";
    exit_script($system_callback);
  }

  while ($row = $rslt->fetch_assoc()) {
   	$s_concepto = $row['s_concepto'];
    $pk_id_formapago = $row['pk_id_formapago'];
    $formaPago .= "<option value='$pk_id_formapago'>$s_concepto</option>";
  }



 ?>
