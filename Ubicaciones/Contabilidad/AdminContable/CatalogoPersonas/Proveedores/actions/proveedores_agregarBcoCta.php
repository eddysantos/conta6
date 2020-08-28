<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Resources/PHP/Utilities/initialScript.php';


  $id_prov = trim($_POST['id_prov']);
  $banco = trim($_POST['banco']);
  $cuenta = trim($_POST['cuenta']);
  $nomBan = trim($_POST['nomBan']);

	$system_callback = [];
	$data = $_POST;


        $query_INSERT = "INSERT INTO conta_cs_bancos_proveedores (fk_id_proveedor,fk_id_banco,s_nomBanExt,s_cta_banco,s_usuario_alta) VALUES (?,?,?,?,?)";
        $stmt_INSERT = $db->prepare($query_INSERT);
        if (!($stmt_INSERT)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query prepare INSERT [$db->errno]: $db->error";
          exit_script($system_callback);
        }
        $stmt_INSERT->bind_param('sssss',$id_prov,$banco,$nomBan,$cuenta,$usuario);
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


        $descripcion = "Se agrego bco/cta al Proveedor: $id_prov Banco: $banco Nombre: $nomBan Cuenta: $cuenta";

        $clave = 'provConta';
        $folio = $id_prov;
        require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

        $system_callback['code'] = 1;
        $system_callback['message'] = "Script called successfully!";
        exit_script($system_callback);


?>
