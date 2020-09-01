<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';
$system_callback = [];
$data = $_POST;
$id_corresp = $data['dbid'];

$queryCorresp = "SELECT * FROM conta_t_corresponsales WHERE pk_id_corresp = ?";

$stmtCorresp = $db->prepare($queryCorresp);
if (!($stmtCorresp)) { die("Error during query prepare [$db->errno]: $db->error");	}
$stmtCorresp->bind_param('s', $id_corresp);

if (!($stmtCorresp)) {die("Error during variables binding [$stmtCorresp->errno]: $stmtCorresp->error");}

if (!($stmtCorresp->execute())) { die("Error during query prepare [$stmtCorresp->errno]: $stmtCorresp->error"); }
$rsltCorresp = $stmtCorresp->get_result();
$rowCorresp = $rsltCorresp->fetch_assoc();
$nombreCorresp = $rowCorresp['s_nombre'];
$system_callback['nombreCorresp'] .="
  <a href='#' onclick='asigCorrespModal($id_corresp,0)' type='button' class='btn bg_gris_100 whitesmoke py-1'>[+]</a>
";
$system_callback['nombre'] .="<span class='colorRosa'>$id_corresp - $nombreCorresp</span>";
$query = "SELECT * FROM conta_replica_clientes WHERE fk_id_corresp = ?";
$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
  exit_script($system_callback);
}
$stmt->bind_param('s',$id_corresp);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error al pasar variables [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}
if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
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
  $pk_id_cliente = utf8_encode($row['pk_id_cliente']);
  $s_nombre = utf8_encode($row['s_nombre']);

  $system_callback['data'] .="<tr class='row m-0 borderojo'>
    <td class='col-md-1'>
      <a href='#' idcliente='$pk_id_cliente' class='eliminarCorresp'><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>
    </td>
    <td class='col-md-4'>$pk_id_cliente</td>
    <td class='col-md-5'>$s_nombre</td>
  </tr>";
}
$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
