<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$data['string'];
$text = "%" . $data['string'] . "%";
$aduana = $data['fk_id_aduana'];
$regimen = $data['regimen'];
$query = "SELECT * FROM conta_t_nom_empleados WHERE fk_id_regimen = ? AND fk_id_aduana = ? AND (s_nombre LIKE ?  OR s_apellidoP LIKE ?) ORDER BY s_activo DESC,s_nombre,s_apellidoP";

// $query = "SELECT * FROM conta_t_nom_empleados WHERE  fk_id_regimen = ? AND fk_id_aduana = ?  ORDER BY s_activo DESC,s_nombre,s_apellidoP";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ssss',$regimen, $aduana, $text, $text);
// $stmt->bind_param('ss',$regimen, $aduana);
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

if ($regimen == 2) {
  $system_callback['encabezado'] .= "<tr class='row m-0 encabezado font14'>
                                      <td class='col-md-1'>Permanentes</td>
                                      <td class='col-md-1'>Datos</td>
                                      <td class='col-md-1'>Estatus</td>
                                      <td class='col-md-1'>Pagar</td>
                                      <td class='col-md-1'>No.Emp.</td>
                                      <td class='col-md-5'>Empleado</td>
                                      <td class='col-md-1'>Salario</td>
                                      <td class='col-md-1'>Integrado</td>
                                    </tr>";
}elseif ($regimen == 9) {
  $system_callback['encabezado'] .= "<tr class='row m-0 encabezado font14'>
                                      <td class='col-md-1'>Datos</td>
                                      <td class='col-md-1'>Estatus</td>
                                      <td class='col-md-1'>Pagar</td>
                                      <td class='col-md-1'>No.Emp.</td>
                                      <td class='col-md-7'>Empleado</td>
                                      <td class='col-md-1'>Salario</td>
                                    </tr>";
}

while ($row = $rslt->fetch_assoc()) {
  $pk_id_empleado = $row['pk_id_empleado'];
  $status = $row['s_activo'];
  $pagar = $row['s_pagar'];
  if ($status == 'S') {
    $status = 'Activo';
  }else {
    $status = 'Baja';
  }
  if ($pagar == 'S') {
    $pagar = "Si";
  }else {
    $pagar = "No";
  }

  if ($regimen == 2) {
    $system_callback['data'] .="<tr class='row text-center m-0 borderojo'>
      <td class='col-md-1'>
        <a href='#permanentes' class='editar-empleado' db-id='$pk_id_empleado' regimen='$regimen'>
          <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
        </a>
      </td>
      <td class='col-md-1'>
        <a href='#modDatosEmp' class='editar-empleado'  db-id='$pk_id_empleado' regimen='$regimen'>
          <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
        </a>
      </td>
      <td class='col-md-1'>$status</td>
      <td class='col-md-1'>$pagar</td>
      <td class='col-md-1'>$pk_id_empleado</td>
      <td class='col-md-5'>".$row['s_nombre']." ".$row['s_apellidoP']." ".$row['s_apellidoM']."</td>
      <td class='col-md-1'>".$row['n_salario_semanal']."</td>
      <td class='col-md-1'>".$row['n_salario_integrado']."</td>
    </tr>";
  }elseif ($regimen == 9) {
    $system_callback['data'] .="<tr class='row text-center m-0 borderojo'>
      <td class='col-md-1'>
        <a href='#modDatosEmp' class='editar-empleado'  db-id='$pk_id_empleado' regimen='$regimen'>
          <img class='icochico' src='/conta6/Resources/iconos/003-edit.svg'>
        </a>
      </td>
      <td class='col-md-1'>$status</td>
      <td class='col-md-1'>$pagar</td>
      <td class='col-md-1'>$pk_id_empleado</td>
      <td class='col-md-7'>".$row['s_nombre']." ".$row['s_apellidoP']." ".$row['s_apellidoM']."</td>
      <td class='col-md-1'>".$row['n_salario_semanal']."</td>
    </tr>";
  }
}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);
 ?>
