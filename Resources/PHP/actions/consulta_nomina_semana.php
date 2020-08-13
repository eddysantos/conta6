<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Resources/PHP/Utilities/initialScript.php';

  $regimenNomina = trim($_POST['regimen']);
  $anio = trim($_POST['anio']);


  $query_consultaSemNomina = "SELECT DISTINCT n_semana FROM conta_t_nom_captura WHERE fk_id_regimen = ? and fk_id_aduana = ? and n_anio = ? order by n_semana desc";
  $stmt_consultaSemNomina = $db->prepare($query_consultaSemNomina);
  if (!($stmt_consultaSemNomina)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_consultaSemNomina->bind_param('sss',$regimenNomina,$aduana,$anio);
  if (!($stmt_consultaSemNomina)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_consultaSemNomina->errno]: $stmt_consultaSemNomina->error";
    exit_script($system_callback);
  }
  if (!($stmt_consultaSemNomina->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_consultaSemNomina->errno]: $stmt_consultaSemNomina->error";
    exit_script($system_callback);
  }
  $rslt_consultaSemNomina = $stmt_consultaSemNomina->get_result();
  $rows_consultaSemNomina = $rslt_consultaSemNomina->num_rows;

  if( $rows_consultaSemNomina == 0 ){
    $system_callback['code'] = 1;
    $system_callback['data'] =
    "<p db-id=''>No se encontraron resultados</p>";
    $system_callback['message'] = "Script called successfully but there are no rows to display.";
    exit_script($system_callback);
  }

  if ($rows_consultaSemNomina > 0) {
      $consultaSemNomina = "<select class='custom-select' id='buscarsem' onChange='consultaDocNominas()'>";
      $consultaSemNomina .= "<option class='custom-select' selected>Nómina</option>";
      while ($row_consultaSemNomina = $rslt_consultaSemNomina->fetch_assoc()) {
        $semNomina = $row_consultaSemNomina['n_semana'];
        $consultaSemNomina .= '<option value="'.$semNomina.'">'.$semNomina.'</option>';
      }
      $consultaSemNomina .= "</selec>";

      $system_callback['code'] = 1;
      $system_callback['data'] = $consultaSemNomina;
      $system_callback['message'] = "Script called successfully!";
      exit_script($system_callback);
  }


?>
