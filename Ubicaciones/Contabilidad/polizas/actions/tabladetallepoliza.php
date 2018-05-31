<?php
$_SESSION['user_name'] = 'admado';
$usuario = $_SESSION['user_name'];

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Databases/conexion.php';
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

//$system_callback = [];
//$data = $_POST;

$id_poliza = trim($_POST['id_poliza']);
$query = "SELECT * FROM conta_t_polizas_det WHERE fk_id_poliza = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s',$id_poliza);
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
  $fk_id_cuenta = trim($row['fk_id_cuenta']);

  $system_callback['data'] .=
  "<tr class='row m-0 borderojo'>
    <td class='xs'>
      <a href='#'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>
    </td>
    <td class='small pt-3 p-0'>$fk_id_cuenta</td>
    <td class='small pt-3 p-0'>gasto</td>
    <td class='small pt-3 p-0'>proveedor</td>
    <td class='small pt-3 p-0'>$row[fk_referencia]</td>
    <td class='small pt-3 p-0'>$row[fk_id_cliente]</td>
    <td class='small pt-3 p-0'>$row[s_folioCFDIext]</td>
    <td class='small pt-3 p-0'>$row[fk_factura]</td>
    <td class='small pt-3 p-0'>$row[fk_nc]</td>
    <td class='small pt-3 p-0'>$row[fk_anticipo]</td>
    <td class='small pt-3 p-0'>$row[fk_cheque]</td>
    <td class='med pt-3 p-0'>$row[s_desc]</td>
    <td class='small pt-3 p-0'>$row[n_cargo]</td>
    <td class='small pt-3 p-0'>$row[n_abono]</td>
    <td class='xs'>
      <a href='#detpol-editarRegPolDiario' data-toggle='modal'>
        <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
      </a>
    </td>
  </tr>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
 ?>
