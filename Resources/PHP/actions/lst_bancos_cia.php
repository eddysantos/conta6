<?php

// $root = $_SERVER['DOCUMENT_ROOT'];
// require $root . '/Resources/PHP/Utilities/initialScript.php';
//
// $system_callback = [];
// $data = $_POST;

$query = "SELECT b.s_nombre AS nomBanco, A.fk_id_banco,a.s_ctaOri,a.fk_id_aduana,a.s_nombre,a.s_RFC
          FROM conta_cs_bancos_cia a, conta_cs_sat_bancos b
          where a.fk_id_banco = b.pk_id_banco
          ORDER BY a.s_nombre,a.fk_id_aduana";

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
  $system_callback['data'] =
  "<option value=''>No se encontraron resultados</option>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

$system_callback['data'] .="<option selected value='0'>Seleccione una Cuenta</option>";
while ($row = $rslt->fetch_assoc()) {
  $ctasCIA.= "<option value='$row[s_ctaOri]'>$row[nomBanco] -- $row[s_ctaOri] -- $row[fk_id_aduana]</option>";
}

// $system_callback['code'] = 1;
// $system_callback['message'] = "Script called successfully!";
// exit_script($system_callback);



 ?>
