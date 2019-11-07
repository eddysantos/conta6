<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Conta6/Resources/PHP/utilities/initialScript.php';
$system_callback = [];
$query = "SELECT * FROM conta_t_corresponsales order by s_nombre";
$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
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
  $pk_id_corresp = utf8_encode($row['pk_id_corresp']);
  $fk_cliente = utf8_encode($row['fk_id_cliente']);
  $nombre = utf8_encode($row['s_nombre']);

  $system_callback['data'] .='<tr class="row m-0 borderojo">
    <td class="col-md-1">
      <a class="addCorresp" href="#addCorresp"  data-toggle="modal" db-id='.$pk_id_corresp.'>
        <img class="icochico ml-5" src="/conta6/Resources/iconos/001-add.svg">
      </a>
    </td>
    <td class="col-md-2">'.$pk_id_corresp.'</td>
    <td class="col-md-2">'.$fk_cliente.'</td>
    <td class="col-md-7">'.$nombre.'</td>
  </tr>';
}
$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
?>
