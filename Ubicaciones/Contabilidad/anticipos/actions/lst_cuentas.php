<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$id_cliente = trim($_POST['id_cliente']);
$modulo = trim($_POST['modulo']);

$query = "SELECT * FROM conta_cs_cuentas_mst WHERE s_cta_status = 1 and s_cta_nivel=2 and (
           (pk_id_cuenta like '0108%' and s_cta_identificador = ?) or
					 (pk_id_cuenta like '0208%' and s_cta_identificador = ?) or
            (pk_id_cuenta like '0100%' or pk_id_cuenta = '0207-00004') )";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ss', $id_cliente,$id_cliente);
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
		"<option value='$row[pk_id_cuenta]'>$row[pk_id_cuenta] -- $row[s_cta_desc]</option>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



 ?>
