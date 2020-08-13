<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$id_cliente = trim($_POST['id_cliente']);
$query = "SELECT A.fk_id_banco,A.s_cta_banco,B.s_nombre
          FROM conta_cs_bancos_clientes A, conta_cs_sat_bancos B
          WHERE A.fk_id_banco = B.pk_id_banco AND A.fk_id_cliente = ? ORDER BY B.s_nombre";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s', $id_cliente);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
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
  $system_callback['data'] .=
		"<option value='$row[fk_id_banco]+$row[s_cta_banco]'>$row[s_nombre] -- $row[s_cta_banco]</option>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



 ?>
