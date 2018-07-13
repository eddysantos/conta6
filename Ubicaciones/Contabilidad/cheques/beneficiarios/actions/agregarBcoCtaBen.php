<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';


  $id_ben = trim($_POST['id_ben']);
  $banco = trim($_POST['banco']);
  $cuenta = trim($_POST['cuenta']);


	$system_callback = [];
	$data = $_POST;


        $query_INSERT = "INSERT INTO conta_cs_bancos_beneficiarios (fk_id_benef,fk_id_banco,s_cta_banco,s_usuario_alta) VALUES (?,?,?,?)";
        $stmt_INSERT = $db->prepare($query_INSERT);
        if (!($stmt_INSERT)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query prepare INSERT [$db->errno]: $db->error";
          exit_script($system_callback);
        }
        $stmt_INSERT->bind_param('ssss',$id_ben,$banco,$cuenta,$usuario);
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

        //$id_benef = $db->insert_id;

        $descripcion = "Se agrego bco/cta al Beneficiario: $id_ben Banco: $banco Cuenta: $cuenta";

        $clave = 'benef';
        $folio = $id_ben;
        require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

        $system_callback['code'] = 1;
        $system_callback['message'] = "Script called successfully!";
        exit_script($system_callback);


?>
