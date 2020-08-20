<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];
$data = $_POST;

$data['string'];
$text = "%" . $data['string'] . "%";
// $aduana = $data['fk_id_aduana'];
$regimen = $data['regimen'];



$query = "SELECT  pk_id_empleado, s_activo, s_pagar, s_nombre, s_apellidoP, s_apellidoM, n_salario_semanal,n_salario_integrado
          FROM conta_t_nom_empleados
          WHERE fk_id_regimen = ? AND fk_id_aduana = ? AND (s_nombre LIKE ?  OR s_apellidoP LIKE ?)
          ORDER BY s_activo DESC,s_nombre,s_apellidoP";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('isss',$regimen, $aduana, $text, $text);

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
    $pk_id_empleado = $row['pk_id_empleado'];
    $salario_semanal = $row['n_salario_semanal'];
    $salario_integrado = $row['n_salario_integrado'];
    $status = $row['s_activo'];
    $pagar = $row['s_pagar'];
    $nombre = utf8_encode($row['s_nombre'].' '.$row['s_apellidoP'].' '.$row['s_apellidoM']);
    $acciones = "";

    if ($status == 'S') {
      $status = "<span class='badge badge-success'>Activo</span>";
    }else {
      $status = "<span class='badge badge-danger'>Baja</span>";
    }
    if ($pagar == 'S') {
      $pagar = "<span class='badge badge-success'>Si Pagar</span>";
    }else {
      $pagar = "<span class='badge badge-danger'>No pagar</span>";
    }



  if ($regimen == 2 || $regimen == '02') {
    $acciones  = "
      <button type='button' class='btn btn-outline-secondary btn-sm editar-empleado' name='button' data-target='#permanentes' data-toggle='modal' db-id='$pk_id_empleado' regimen='$regimen'>Permanentes</button>

      <button data-target='#modDatosEmp' data-toggle='modal' type='button' class='btn btn-outline-secondary btn-sm editar-empleado' name='button' db-id='$pk_id_empleado' regimen='$regimen'>Datos</button>";

    $system_callback['data'] .= "
    <tr class='row  align-items-center px-3'>
      <td class='col-md-6'>
        [#$pk_id_empleado] $nombre
        </a>
        <span class='font-weight-light text-black-50 d-block'>$status  $pagar </span>
      </td>
      <td class='col-md-4'>
        Salario Semanal :<span class='font-weight-light text-black-50 '>$ $salario_semanal</span><br />
        Salario Integrado :<span class='font-weight-light text-black-50 '>$ $salario_integrado</span>
      </td>
      <td class='col-md-2 text-center'>
        $acciones
      </td>
    </tr>";
  }elseif ($regimen == '09' || $regimen == 9) {
    $acciones = "<button data-target='#modDatosEmp' data-toggle='modal' type='button' class='btn btn-outline-secondary btn-sm editar-empleado' name='button' db-id='$pk_id_empleado' regimen='$regimen'>Datos</button>";


    $system_callback['data'] .="
    <tr class='row  align-items-center px-3'>
      <td class='col-md-6'>
        [#$pk_id_empleado] $nombre
        </a>
        <span class='font-weight-light text-black-50 d-block'>$status  $pagar </span>
      </td>
      <td class='col-md-4'>
        Salario Semanal :
        <span class='font-weight-light text-black-50 d-block'>$ $salario_semanal</span>
      </td>
      <td class='col-md-2 text-center '>
        $acciones
      </td>
    </tr>";
  }

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);

 ?>
