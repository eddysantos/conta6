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
  if( $rfc != 'XEXX010101000' && $rfc != 'XAXX010101000' ){
    require $root . '/Resources/PHP/actions/validarRFC_cliente.php';
    require $root . '/Resources/PHP/actions/validarRFC_proveedores.php';
    require $root . '/Resources/PHP/actions/validarRFC_empleados.php';
    require $root . '/Resources/PHP/actions/validarRFC_beneficiarios.php';
  }
  //***********************************************************

  if( $rfc == 'XEXX010101000' && $rfc == 'XAXX010101000' ){
    if( $oRst_permisos['s_catalogoPersonasPROV_g_libre'] == 1 || $rows_PROV == 0 ){
      generarProveedor($db,$nombre,$persona,$rfc,$curp,$taxid,$direccion,$usuario,$usuario);
      $system_callback['code'] = 1;
      $system_callback['message'] = "Script called successfully!";
      exit_script($system_callback);

    }
  }else{
    if( $rows_CLT == 0 && $rows_BEN == 0 && $rows_EMPL == 0 ){
      if( $oRst_permisos['s_catalogoPersonasPROV_g_libre'] == 1 || $rows_PROV == 0 ){
        generarProveedor($db,$nombre,$persona,$rfc,$curp,$taxid,$direccion,$usuario,$usuario);
        $system_callback['code'] = 1;
        $system_callback['message'] = "Script called successfully!";
        exit_script($system_callback);

      }
    }
  }


  function generarProveedor($db,$nombre,$persona,$rfc,$curp,$taxid,$direccion,$usuario,$usuario){
    $query_INSERT = "INSERT INTO conta_cs_proveedores (s_nombre,s_persona,s_rfc,s_curp,s_taxid,s_direccion,s_usuario_alta) VALUES (?,?,?,?,?,?,?)";
    $stmt_INSERT = $db->prepare($query_INSERT);
    if (!($stmt_INSERT)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare INSERT [$db->errno]: $db->error";
      exit_script($system_callback);
    }
    $stmt_INSERT->bind_param('sssssss',$nombre,$persona,$rfc,$curp,$taxid,$direccion,$usuario);
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

    $idprov = $db->insert_id;

    $descripcion = "Se genero Proveedor: $idprov Nombre: $nombre RFC: $rfc CURP: $curp TAXID: $taxid DIRECCION: $direccion PERSONA: $persona";

    $clave = 'provConta';
    $folio = $idprov;
    require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';
  }



?>
