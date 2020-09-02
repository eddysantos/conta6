<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Resources/PHP/Utilities/initialScript.php';

  $idprov = trim($_POST['idprov']);
  $nombre = trim($_POST['nombre']);
  $persona = trim($_POST['persona']);
  $rfc = trim($_POST['rfc']);
  $curp = trim($_POST['curp']);
  $taxid = trim($_POST['taxid']);
  $direccion = trim(utf8_decode($_POST['direccion']));

	$system_callback = [];
	$data = $_POST;

  //********************* validaRFC
  require $root . '/Resources/PHP/actions/validarRFC_cliente.php';
  require $root . '/Resources/PHP/actions/validarRFC_proveedores.php';
  require $root . '/Resources/PHP/actions/validarRFC_empleados.php';
  require $root . '/Resources/PHP/actions/validarRFC_beneficiarios.php';
  //***********************************************************

  if( $rows_CLT == 0 && $rows_BEN == 0 && $rows_EMPL == 0 ){
    if( $oRst_permisos['s_catalogoPersonasPROV_g_libre'] == 1 || $rows_PROV == 1 ){
        $d_fecha_modifi = date("Y-m-d H:i:s",time());

        $query_UPDATE = "UPDATE conta_cs_proveedores SET s_nombre = ?, s_persona = ?, s_rfc = ?, s_curp = ?, s_taxid = ?, s_direccion = ?, s_usuario_modifi = ?, d_fecha_modifi = ? WHERE pk_id_proveedor = ?";
        $stmt_UPDATE = $db->prepare($query_UPDATE);
        if (!($stmt_UPDATE)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query prepare INSERT [$db->errno]: $db->error";
          exit_script($system_callback);
        }
        $stmt_UPDATE->bind_param('sssssssss',$nombre,$persona,$rfc,$curp,$taxid,$direccion,$usuario,$d_fecha_modifi,$idprov);
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

        $descripcion = "Se modifico Proveedor: $idprov Nombre: $nombre RFC: $rfc CURP: $curp TAXID: $taxid DIRECCION: $direccion PERSONA: $persona";

        $clave = 'provConta';
        $folio = $idprov;
        require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

        $system_callback['code'] = 1;
        $system_callback['message'] = "Script called successfully!";
        exit_script($system_callback);
    }
  }


?>
