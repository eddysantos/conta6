<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$id_anticipo = trim($_POST['id_anticipo']);
$query = "SELECT * FROM conta_t_anticipos_det WHERE fk_id_anticipo = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s',$id_anticipo);
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
  $partida = $row['pk_partida'];
  $cargo = number_format($row['n_cargo'],2);
  $abono = number_format($row['n_abono'],2);


  $system_callback['data'] .=
  "<tr class='row m-0 borderojo'>
      <td width='4%' class='p-0 pt-2'>
        <a href='#' onclick='borrarRegistroAnticipo($partida)'><img class='icochico' src='/conta6/Resources/iconos/002-trash.svg'></a>
      </td>
      <td width='10%' class='p-0'>$row[fk_id_cuenta]</td>
      <td width='10%' class='p-0'>$row[fk_referencia]</td>
      <td width='10%' class='p-0'>$row[fk_id_cliente_antdet]</td>
      <td width='10%' class='p-0'>$row[fk_factura]</td>
      <td width='10%' class='p-0'>$row[fk_ctagastos]</td>
      <td width='10%' class='p-0'>$row[fk_pago]</td>
      <td width='10%' class='p-0'>$row[fk_nc]</td>
      <td width='11%' class='p-0'>$ $cargo</td>
      <td width='11%' class='p-0'>$ $abono</td>
      <td width='4%' class='p-0 pt-2'>
        <a href='#detant-editar' class='editar-partidaAnt' db-id='$partida' data-toggle='modal'>
          <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
        </a>
      </td>

      <td class='p-0' width='4%'></td>
      <td class='p-0' width='10%'><b class='b'>Descripción:</b></td>
      <td class='p-0 text-left' width='70%'>$row[s_desc]</td>
    </tr>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
 ?>
