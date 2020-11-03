<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;
$system_callback['data'] = '';

$data['string'] = '';
$text = "%" . $data['string'] . "%";
$query = "SELECT * FROM conta_cs_cuentas_mst WHERE (pk_id_cuenta LIKE ?)  OR (s_cta_desc LIKE ?)";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ss', $text, $text);
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
  $system_callback['data'] ="<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $system_callback['data'] .=
  "<p db-id='$row[pk_id_cuenta]'>$row[pk_id_cuenta] - $row[s_cta_desc]</p>";
  $id = $row['pk_id_cuenta'];

  $system_callback['data'] .=
  "<tr class='row text-center m-0 borderojo'>
   <td class='col-md-1 text-center'>
      <a href='#EditarCatalogo' data-toggle='modal'>
      <a href='#EditarCatalogo' class='editar-cuenta' db-id='$id' role='button'>
        <img class='icochico' src='/Resources/iconos/003-edit.svg'>
      </a>
    </td>
    <td class='col-md-1'>$row[pk_id_cuenta]</td>
    <td class='col-md-4 text-left'>$row[s_cta_desc]</td>
    <td class='col-md-1'>$row[s_cta_tipo]</td>
    <td class='col-md-1'>$row[s_cta_nivel]</td>
    <td class='col-md-1'>$row[s_cta_status]</td>
    <td class='col-md-1'>$row[fk_codAgrup]</td>
    <td class='col-md-1'>$row[fk_id_naturaleza]</td>
    <td class='col-md-1'>
    </td>
  </tr>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
 ?>
