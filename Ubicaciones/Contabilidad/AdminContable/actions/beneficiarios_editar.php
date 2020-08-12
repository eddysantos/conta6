<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

  $id_ben = trim($_POST['id_ben']);
  $ben = trim($_POST['ben']);
  $rfc = trim($_POST['rfc']);

	$system_callback = [];
	$data = $_POST;

  //********************* validaRFC
  require $root . '/conta6/Resources/PHP/actions/validarRFC_cliente.php';
  require $root . '/conta6/Resources/PHP/actions/validarRFC_proveedores.php';
  require $root . '/conta6/Resources/PHP/actions/validarRFC_empleados.php';
  require $root . '/conta6/Resources/PHP/actions/validarRFC_beneficiarios.php';
  //***********************************************************

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
