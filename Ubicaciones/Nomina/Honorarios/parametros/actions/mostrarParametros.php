<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$data['string'];
$text = "%" . $data['string'] . "%";
$queryArt113 = "SELECT * FROM conta_cs_imss WHERE s_nombreTabla = 'art113'  ORDER BY pk_id_partida";


$stmt = $db->prepare($queryArt113);
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
  $pk_id_art113 = $row['pk_id_partida'];
  $n_inferior = $row['n_inferior'];
  $n_superior = $row['n_superior'];
  $n_cuota = $row['n_cuota'];
  $n_porcentaje = $row['n_porcentaje'];
  $d_fecha_modifi = $row['d_fecha_modifi'];

  if($oRst_permisos['s_nom_has_mod_tab_113'] == 1){
    $linkModifi_113 = "<a href='#articulo113' data-toggle='modal' db-id='$pk_id_art113' class='editar'>
      <img class='icochico' src='/Resources/iconos/003-edit.svg'>
    </a>";
  }

  $system_callback['articulo113'] .="<tr class='row borderojo align-items-center'>
    <td class='col-md-1'>$linkModifi_113</td>
    <td class='col-md-2'>$n_inferior</td>
    <td class='col-md-2'>$n_superior</td>
    <td class='col-md-2'>$n_cuota</td>
    <td class='col-md-2'>$n_porcentaje</td>
    <td class='col-md-3'>$d_fecha_modifi</td>
  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
// exit_script($system_callback);



# art113 de honorarios
// $queryGenerales = "SELECT * FROM conta_cs_imss WHERE s_nombreTabla = 'art113'  ORDER BY pk_id_partida";
// $stmt = $db->prepare($queryGenerales);
// if (!($stmt)) {
//   $system_callback['code'] = "500";
//   $system_callback['message'] = "Error durante la preparacion del query [$db->errno]: $db->error";
//   exit_script($system_callback);
// }
//
// if (!($stmt->execute())) {
//   $system_callback['code'] = "500";
//   $system_callback['message'] = "Error durante la ejecucion [$stmt->errno]: $stmt->error";
//   exit_script($system_callback);
// }
//
// $rslt = $stmt->get_result();
//
// if ($rslt->num_rows == 0) {
//   $system_callback['code'] = 1;
//   $system_callback['data'] ="<p db-id=''>No se encontraron resultados</p>";
//   $system_callback['message'] = "Script called successfully but there are no rows to display.";
//   exit_script($system_callback);
// }
//
// while ($row = $rslt->fetch_assoc()) {
//   //generales
//   $pk_id_art113 = $row['pk_id_partida'];
//   $n_inferior = $row['n_inferior'];
//   $n_superior = $row['n_superior'];
//   $n_cuota = $row['n_cuota'];
//   $n_porcentaje = $row['n_porcentaje'];
//   $d_fecha_modifi = $row['d_fecha_modifi'];
//
//   if($oRst_permisos['s_nom_has_mod_tab_113'] == 1){
//     $linkModifi_113 = "  <a href='#articulo113' data-toggle='modal' db-id='$pk_id_art113'  class='editar'>
//         <img class='icochico' src='/Resources/iconos/003-edit.svg'>
//       </a>";
//   }
//
//   $system_callback['articulo113'] .="<tr class='row borderojo align-items-center'>
//     <td class='col-md-1'>$linkModifi_113</td>
//     <td class='col-md-2'>$n_inferior</td>
//     <td class='col-md-2'>$n_superior</td>
//     <td class='col-md-2'>$n_cuota</td>
//     <td class='col-md-2'>$n_porcentaje</td>
//     <td class='col-md-3'>$d_fecha_modifi</td>
//   </tr>";
//
// }
//
// $system_callback['code'] = 1;
// $system_callback['message'] = "Script called successfully!";

//exit_script($system_callback);


 ?>
