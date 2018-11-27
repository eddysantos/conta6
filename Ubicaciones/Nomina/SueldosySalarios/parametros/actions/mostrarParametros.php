<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$data['string'];
$text = "%" . $data['string'] . "%";
$queryArt80 = "SELECT * FROM conta_cs_imss WHERE s_nombreTabla = 'art80'  ORDER BY pk_id_partida";


$stmt = $db->prepare($queryArt80);
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
  $pk_id_art80 = $row['pk_id_partida'];
  $n_inferior = $row['n_inferior'];
  $n_superior = $row['n_superior'];
  $n_cuota = $row['n_cuota'];
  $n_porcentaje = $row['n_porcentaje'];
  $d_fecha_modifi = $row['d_fecha_modifi'];

  $system_callback['articulo'] .="<tr class='row borderojo'>
    <td class='col-md-1'>
      <a href='#articulo80' data-toggle='modal' db-id='$pk_id_art80' class='editar'>
        <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
      </a>
    </td>
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



$queryGenerales = "SELECT * FROM conta_cs_imss WHERE s_nombreTabla = 'infoGral'  ORDER BY pk_id_partida";
$stmt = $db->prepare($queryGenerales);
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
  //generales
  $pk_id_gen = $row['pk_id_partida'];
  $fk_id_aduana = $row['fk_id_aduana'];
  $n_salarioMinimo = $row['n_salarioMinimo'];
  $n_IMSS = $row['n_IMSS'];
  $n_subsidio = $row['n_subsidio'];
  $n_diasTrabajados = $row['n_diasTrabajados'];
  $n_diasPagar = $row['n_diasPagar'];
  $d_fecha_modifi = $row['d_fecha_modifi'];




  $system_callback['generales'] .="<tr class='row borderojo'>
    <td class='col-md-1'>
      <a href='#paramgenerales' data-toggle='modal' db-id='$pk_id_gen' class='editar'>
        <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
      </a>
    </td>
    <td class='col-md-1'>$fk_id_aduana</td>
    <td class='col-md-2'>$n_salarioMinimo</td>
    <td class='col-md-1'>$n_IMSS</td>
    <td class='col-md-1'>$n_subsidio</td>
    <td class='col-md-2'>$n_diasTrabajados</td>
    <td class='col-md-2'>$n_diasPagar</td>
    <td class='col-md-2'>$d_fecha_modifi</td>
  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";




$queryGenerales = "SELECT * FROM conta_cs_imss WHERE s_nombreTabla = 'factorintegracion'  ORDER BY pk_id_partida";
$stmt = $db->prepare($queryGenerales);
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
  //generales
  $pk_id_factor = $row['pk_id_partida'];
  $n_anio = $row['n_anio'];
  $n_integrado = $row['n_integrado'];
  $d_fecha_modifi = $row['d_fecha_modifi'];





  $system_callback['factor'] .="<tr class='row borderojo'>
    <td class='col-md-3'>
      <a href='#factorintegracion' data-toggle='modal' db-id='$pk_id_factor' class='editar'>
        <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
      </a>
    </td>
    <td class='col-md-3'>$n_anio</td>
    <td class='col-md-3'>$n_integrado</td>
    <td class='col-md-3'>$d_fecha_modifi</td>
  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";





$queryGenerales = "SELECT * FROM conta_cs_imss WHERE s_nombreTabla = 'art80_b'  ORDER BY pk_id_partida";
$stmt = $db->prepare($queryGenerales);
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
  //generales
  $pk_id_subsidio = $row['pk_id_partida'];
  $n_inferior = $row['n_inferior_b'];
  $n_superior = $row['n_superior_b'];
  $n_cuota = $row['n_cuota_b'];
  $d_fecha_modifi = $row['d_fecha_modifi'];


  $system_callback['subsidio'] .="<tr class='row borderojo'>
    <td class='col-md-2'>
      <a href='#subsidio' data-toggle='modal' db-id='$pk_id_subsidio'  class='editar'>
        <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
      </a>
    </td>
    <td class='col-md-2'>$n_inferior</td>
    <td class='col-md-3'>$n_superior</td>
    <td class='col-md-2'>$n_cuota</td>
    <td class='col-md-3'>$d_fecha_modifi</td>
  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";




$queryGenerales = "SELECT * FROM conta_cs_imss WHERE s_nombreTabla = 'ramoSeguro'  ORDER BY pk_id_partida";
$stmt = $db->prepare($queryGenerales);
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
  //generales
  $pk_id_imss = $row['pk_id_partida'];
  $n_ramo = $row['n_ramo'];
  $s_descripcion = $row['s_descripcion'];
  $n_baseSalarial = $row['n_baseSalarial'];
  $n_topeSalarial = $row['n_topeSalarial'];
  $n_patron = $row['n_patron'];
  $n_trabajador = $row['n_trabajador'];
  $d_fecha_modifi = $row['d_fecha_modifi'];


  $system_callback['imss'] .="<tr class='row borderojo'>
    <td class='col-md-1'>
      <a href='#imss' data-toggle='modal' db-id='$pk_id_imss'  class='editar'>
        <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
      </a>
    </td>
    <td class='col-md-1'>$n_ramo</td>
    <td class='col-md-2 text-left'>$s_descripcion</td>
    <td class='col-md-1'>$n_baseSalarial</td>
    <td class='col-md-1'>$n_topeSalarial</td>
    <td class='col-md-2'>$n_patron</td>
    <td class='col-md-2'>$n_trabajador</td>
    <td class='col-md-2'>$d_fecha_modifi</td>
  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);


 ?>