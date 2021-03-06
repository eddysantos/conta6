<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';


$system_callback = [];

$id_ben = trim($_POST['id_ben']);
$query = "SELECT * FROM conta_cs_bancos_beneficiarios WHERE fk_id_benef = ?";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('s',$id_ben);
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
  $fk_id_banco = utf8_encode($row['fk_id_banco']);
  $s_nomBanExt = utf8_encode($row['s_nomBanExt']);
  $s_cta_banco = utf8_encode($row['s_cta_banco']);
  $s_usuario_alta = utf8_encode($row['s_usuario_alta']);
  $d_fecha_alta = utf8_encode($row['d_fecha_alta']);
  $id_banco_ben = utf8_encode($row['pk_id_banco_ben']);
  $id_benef = utf8_encode($row['fk_id_benef']);

  if( $oRst_permisos["s_benefGenerar_cheques"] == 1 ){
    $btnborrar = "<a href='#' onclick='btn_bcben($id_banco_ben,$id_benef)'><img src= '/Resources/iconos/002-trash.svg' class='icochico'></a>";
  }else{ $bntborrar = "";}

  $system_callback['data'] .=
    "<tr class='row borderojo'>
      <td class='col-md-1'>$btnborrar</td>
      <td class='col-md-1'>$fk_id_banco</td>
      <td class='col-md-4'>$s_nomBanExt</td>
      <td class='col-md-3'>$s_cta_banco</td>
      <td class='col-md-3'>$s_usuario_alta $d_fecha_alta</td>
     </tr>";
}




  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);

?>
