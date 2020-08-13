<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$id_poliza = trim($_POST['id_poliza']);
$query = "SELECT * FROM conta_t_polizas_det WHERE fk_id_poliza = ? ORDER BY pk_partida DESC";

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
  $idProveedor = $row['fk_id_proveedor'];
  $desc = $row['s_desc'];
  $nom_proveedor = '';

  if( $idProveedor > 0 ){
    require $root . '/Resources/PHP/actions/consultaDatosProveedorContabilidad.php';
  }




  $system_callback['data'] .=
  "<tr class='row m-0 borderojo'>
    <td class='col-md-1'>$fk_id_cuenta</td>
    <td class='col-md-4'>$desc</td>
    <td class='col-md-1'>$cargo</td>
    <td class='col-md-1'>$abono</td>
    <td class='col-md-4'>$nom_proveedor</td>
    <td class='col-md-1'>
      <a href='#' id='addProvpartpol' onclick='asignarProvRegPol($partida)'><img src= '/Resources/iconos/add.svg' class='icochico'></a>
      <a href='#' id='borrarProvpartpol' onclick='borrarProvRegPol($partida)' ><img src= '/Resources/iconos/002-trash.svg' class='icochico ml-5'></a>
    </td>
  </tr>";
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
 ?>
