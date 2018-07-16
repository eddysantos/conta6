<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

  $id_ben = trim($_POST['id_ben']);
  $ben = trim($_POST['ben']);
  $rfc = trim($_POST['rfc']);

	$system_callback = [];
	$data = $_POST;

  //********************* validaRFC
  $query_CLT = "SELECT * FROM conta_replica_clientes WHERE s_rfc = ?";
  $stmt_CLT = $db->prepare($query_CLT);
  if (!($stmt_CLT)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare CLT [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_CLT->bind_param('s', $rfc);
  if (!($stmt_CLT)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding CLT [$stmt_CLT->errno]: $stmt_CLT->error";
    exit_script($system_callback);
  }
  if (!($stmt_CLT->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution CLT [$stmt_CLT->errno]: $stmt_CLT->error";
    exit_script($system_callback);
  }
  $rslt_CLT = $stmt_CLT->get_result();
  $rows_CLT = $rslt_CLT->num_rows;
  if ($rows_CLT > 0) {
    $row_CLT = $rslt_CLT->fetch_assoc();
    $id_CLT = $row_CLT['pk_id_cliente'];
    $nom_CLT= trim($row_CLT['s_nombre']);
    $system_callback['code'] = "500";
    $system_callback['data'] = "El RFC pertenece a $id_CLT $nom_CLT";
    $system_callback['message'] = "Error RFC pertenece a $id_CLT $nom_CLT [$stmt_CLT->errno]: $stmt_CLT->error";
    exit_script($system_callback);
  }


  $query_PROV = "SELECT * FROM conta_cs_proveedores WHERE s_rfc = ?";
    $stmt_PROV = $db->prepare($query_PROV);
    if (!($stmt_PROV)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare PROV [$db->errno]: $db->error";
      exit_script($system_callback);
    }
    $stmt_PROV->bind_param('s', $rfc);
    if (!($stmt_PROV)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding PROV [$stmt_PROV->errno]: $stmt_PROV->error";
      exit_script($system_callback);
    }
    if (!($stmt_PROV->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution PROV [$stmt_PROV->errno]: $stmt_PROV->error";
      exit_script($system_callback);
    }
    $rslt_PROV = $stmt_PROV->get_result();
    $rows_PROV = $rslt_PROV->num_rows;
    if ($rows_PROV > 0) {
      $row_PROV = $rslt_PROV->fetch_assoc();
      $id_PROV = $row_PROV['pk_id_proveedor'];
      $nom_PROV = trim($row_PROV['s_nombre']);
      $system_callback['code'] = "500";
      $system_callback['data'] = "El RFC pertenece a PROV $id_PROV $nom_PROV";
      $system_callback['message'] = "Error RFC pertenece a PROV $id_PROV $nom_PROV [$stmt_PROV->errno]: $stmt_PROV->error";
      exit_script($system_callback);
    }


  $query_EMPL = "SELECT * FROM conta_cs_empleados WHERE s_rfc = ?";
    $stmt_EMPL = $db->prepare($query_EMPL);
    if (!($stmt_EMPL)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare EMPL [$db->errno]: $db->error";
      exit_script($system_callback);
    }
    $stmt_EMPL->bind_param('s', $rfc);
    if (!($stmt_EMPL)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding EMPL [$stmt_EMPL->errno]: $stmt_EMPL->error";
      exit_script($system_callback);
    }
    if (!($stmt_EMPL->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution EMPL [$stmt_EMPL->errno]: $stmt_EMPL->error";
      exit_script($system_callback);
    }
    $rslt_EMPL = $stmt_EMPL->get_result();
    $rows_EMPL = $rslt_EMPL->num_rows;
    if ($rows_EMPL > 0) {
      $row_EMPL = $rslt_EMPL->fetch_assoc();
      $id_EMPL = $row_EMPL['pk_id_empleado'];
      $nom_EMPL = trim($row_EMPL['s_nombre'].' '.$row_EMPL['s_apellidoP'].' '.$row_EMPL['s_apellidoM']);
      $system_callback['code'] = "500";
      $system_callback['data'] = "El RFC pertenece a EMPL $id_EMPL $nom_EMPL";
      $system_callback['message'] = "Error RFC pertenece a EMPL $id_EMPL $nom_EMPL [$stmt_EMPL->errno]: $stmt_EMPL->error";
      exit_script($system_callback);
    }
    //***********************************************************



    $query_BEN = "SELECT * FROM conta_cs_beneficiarios WHERE s_rfc = ?";
    $stmt_BEN = $db->prepare($query_BEN);
    if (!($stmt_BEN)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare BEN [$db->errno]: $db->error";
      exit_script($system_callback);
    }
    $stmt_BEN->bind_param('s', $rfc);
    if (!($stmt_BEN)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding BEN [$stmt_BEN->errno]: $stmt_BEN->error";
      exit_script($system_callback);
    }
    if (!($stmt_BEN->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution BEN [$stmt_BEN->errno]: $stmt_BEN->error";
      exit_script($system_callback);
    }
    $rslt_BEN = $stmt_BEN->get_result();
    $rows_BEN = $rslt_BEN->num_rows;
    if ($rows_BEN > 1) {
      $row_BEN = $rslt_BEN->fetch_assoc();
      $id_BEN = $row_BEN['pk_id_benef'];
      $nom_BEN = trim($row_BEN['s_nombre']);
      $system_callback['code'] = "500";
      $system_callback['data'] = "El RFC existe más de una vez";
      $system_callback['message'] = "Error RFC pertenece a BEN $id_BEN $nom_BEN [$stmt_BEN->errno]: $stmt_BEN->error";
      //exit_script($system_callback);
    }



  if( $rows_CLT == 0 && $rows_PROV == 0 && $rows_EMPL == 0 ){
    if( $oRst_permisos['s_benefGenerarlibre_cheques'] == 1 || $rows_BEN == 1 ){
        $d_fecha_modifi = date("Y-m-d H:i:s",time());

        $query_UPDATE = "UPDATE conta_cs_beneficiarios SET s_nombre = ?, s_rfc = ?, s_usuario_modifi = ?, d_fecha_modifi = ? WHERE pk_id_benef = ?";
        $stmt_UPDATE = $db->prepare($query_UPDATE);
        if (!($stmt_UPDATE)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query prepare INSERT [$db->errno]: $db->error";
          exit_script($system_callback);
        }
        $stmt_UPDATE->bind_param('sssss',$ben,$rfc,$usuario,$d_fecha_modifi,$id_ben);
        if (!($stmt_UPDATE)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during variables binding INSERT [$stmt_UPDATE->errno]: $stmt_UPDATE->error";
          exit_script($system_callback);
        }
        if (!($stmt_UPDATE->execute())) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query execution INSERT [$stmt_UPDATE->errno]: $stmt_UPDATE->error";
          exit_script($system_callback);
        }

        //$id_benef = $db->insert_id;

        $descripcion = "Se modifico Beneficiario: $id_ben Nombre: $ben RFC: $rfc";

        $clave = 'benef';
        $folio = $id_benef;
        require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

        $system_callback['code'] = 1;
        $system_callback['message'] = "Script called successfully!";
        exit_script($system_callback);
    }
  }


?>
