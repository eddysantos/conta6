<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

  $base = trim($_POST['salario_diario']);

  $sql_ISR = "SELECT truncate(n_inferior,2) AS inferior,
                     truncate(n_porcentaje,2) AS porcentaje,
                     truncate(n_cuota,2) AS cuota
              FROM conta_cs_imss_t113
              WHERE n_inferior <= ? AND n_superior >= ?";

  $stmt = $db->prepare($sql_ISR);
  if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmt->bind_param('ss',$base, $base);
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
    $exedente = $base - $row['inferior'];
    $porcentaje = $row['porcentaje']/100;
    $impuesto_Marginal = $exedente * $porcentaje;
    $ISR_Tarifa = $impuesto_Marginal + $row['cuota'];



    $system_callback['data'] .="$ISR_Tarifa";
  }

  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);

 ?>
