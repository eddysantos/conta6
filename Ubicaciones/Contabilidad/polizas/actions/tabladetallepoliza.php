<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

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
  $partida = $row['pk_partida'];
  $abono = number_format($row['n_abono'],2);
  $cargo = number_format($row['n_cargo'],2);


  $system_callback['data'] .=
  "<tr class='row borderojo'>
      <td class='p-0 pt-2' width='3%'>
        <a href='#' onclick='borrarRegistro($partida)'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>
      </td>
      <td class='p-0' width='8%'>$fk_id_cuenta</td>
      <td class='p-0' width='8%'>$row[fk_gastoAduana]</td>
      <td class='p-0' width='8%'>$row[fk_id_proveedor]</td>
      <td class='p-0' width='8%'>$row[fk_referencia]</td>
      <td class='p-0' width='8%'>$row[fk_id_cliente]</td>
      <td class='p-0' width='8%'>$row[s_folioCFDIext]</td>
      <td class='p-0' width='8%'>$row[fk_factura]</td>
      <td class='p-0' width='8%'>$row[fk_nc]</td>
      <td class='p-0' width='8%'>$row[fk_anticipo]</td>
      <td class='p-0' width='6%'>$row[fk_cheque]</td>
      <td class='p-0' width='8%'>$ $cargo</td>
      <td class='p-0' width='8%'>$ $abono</td>
      <td class='p-0 pt-2' width='3%'>
        <a href='#detpol-editarRegPolDiario' class='editar-partidaPol' db-id='$partida' role='button'>
          <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
        </a>
      </td>
      <td class='p-0' width='3%'></td>
      <td class='p-0' width='8%'><b class='b'>Descripción:</b></td>
      <td class='p-0 text-left' width='70%'>$row[s_desc]</td>
    </tr>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
 ?>
