<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Conta6/Resources/PHP/Utilities/initialScript.php';
  $ben = trim($_POST['ben']);
  $rfc = trim($_POST['rfc']);
  $taxid = trim($_POST['taxid']);
/*
  $ben = "AMERICAN PRESIDEN LINES";
  $rfc = "XEXX010101000";
  $taxid = "94-0434900";
*/
	$system_callback = [];
	$data = $_POST;
//********************* validaRFC
if( $rfc != 'XEXX010101000' && $rfc != 'XAXX010101000' ){
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
    if ($rows_BEN > 0) {
      $row_BEN = $rslt_BEN->fetch_assoc();
      $id_BEN = $row_BEN['pk_id_benef'];
      $nom_BEN = trim($row_BEN['s_nombre']);
      $system_callback['code'] = "500";
      $system_callback['data'] = "El RFC pertenece a BEN $id_BEN $nom_BEN";
      $system_callback['message'] = "Error RFC pertenece a BEN $id_BEN $nom_BEN [$stmt_BEN->errno]: $stmt_BEN->error";
      exit_script($system_callback);
    }
  if( $rfc == 'XEXX010101000' && $rfc == 'XAXX010101000' ){
    if( $oRst_permisos['s_benefGenerarlibre_cheques'] == 1 || $rows_BEN == 0 ){
      generarBeneficiario($db,$ben,$rfc,$taxid,$usuario);
    }
  }else{
    if( $rows_CLT == 0 && $rows_PROV == 0 && $rows_EMPL == 0 ){
      if( $oRst_permisos['s_benefGenerarlibre_cheques'] == 1 || $rows_BEN == 0 ){
        generarBeneficiario($db,$ben,$rfc,$taxid,$usuario);
      }
    }
  }
  function generarBeneficiario($db,$ben,$rfc,$taxid,$usuario){
    $query_INSERT = "INSERT INTO conta_cs_beneficiarios (s_nombre,s_rfc,s_taxid,s_usuario_alta) VALUES (?,?,?,?)";
    $stmt_INSERT = $db->prepare($query_INSERT);
    if (!($stmt_INSERT)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare INSERT [$db->errno]: $db->error";
      exit_script($system_callback);
    }
    $stmt_INSERT->bind_param('ssss',$ben,$rfc,$taxid,$usuario);
    if (!($stmt_INSERT)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding INSERT [$stmt_INSERT->errno]: $stmt_INSERT->error";
      exit_script($system_callback);
    }
    if (!($stmt_INSERT->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution INSERT [$stmt_INSERT->errno]: $stmt_INSERT->error";
      exit_script($system_callback);
    }
    $affected_INSERT = $stmt_INSERT->affected_rows;
    $system_callback['affected'] = $affected_INSERT;
    $system_callback['datos'] = $_POST;
    if ($affected_INSERT == 0) {
      $system_callback['code'] = 2;
      $system_callback['message'] = "Algo fallo, No se agrego el beneficiario";
      exit_script($system_callback);
    }
    $id_benef = $db->insert_id;
    $descripcion = "Se genero Beneficiario: $id_benef Nombre: $ben RFC: $rfc TaxID: $taxid";
    error_log($id_benef);
    $clave = 'benef';
    $folio = $id_benef;

    mysqli_query($db,"INSERT INTO conta_bitacora (fk_usuario,fk_id_operacion,s_folio,s_descripcion) values ('$usuario','$clave','$folio','$descripcion')");
    
    // require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';
    $system_callback['code'] = 1;
    $system_callback['message'] = "Script called successfully!";
    exit_script($system_callback);
  }
?>
