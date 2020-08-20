<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Resources/PHP/Utilities/initialScript.php';

  $idDocNomina = trim($_POST['idDocNomina']);

  $query_borrarDocNominaDet = "DELETE FROM conta_t_nom_captura_det WHERE fk_id_docNomina = ?";
  $stmt_borrarDocNominaDet = $db->prepare($query_borrarDocNominaDet);
  if (!($stmt_borrarDocNominaDet)) {
    die("Error during query prepare borrarDocNominaDet [$db->errno]: $db->error");
  }
  $stmt_borrarDocNominaDet->bind_param('s',$idDocNomina);
  if (!($stmt_borrarDocNominaDet)) {
    die("Error during variables binding borrarDocNominaDet [$stmt_borrarDocNominaDet->errno]: $stmt_borrarDocNominaDet->error");
  }
  if (!($stmt_borrarDocNominaDet->execute())) {
    die("Error during query execute borrarDocNominaDet [$stmt_borrarDocNominaDet->errno]: $stmt_borrarDocNominaDet->error");
  }


  $query_borrarDocNomina = "DELETE FROM conta_t_nom_captura WHERE pk_id_docNomina = ?";
  $stmt_borrarDocNomina = $db->prepare($query_borrarDocNomina);
  if (!($stmt_borrarDocNomina)) {
    die("Error during query prepare borrarDocNomina [$db->errno]: $db->error");
  }
  $stmt_borrarDocNomina->bind_param('s',$idDocNomina);
  if (!($stmt_borrarDocNomina)) {
    die("Error during variables binding borrarDocNomina [$stmt_borrarDocNomina->errno]: $stmt_borrarDocNomina->error");
  }
  if (!($stmt_borrarDocNomina->execute())) {
    die("Error during query execute borrarDocNomina [$stmt_borrarDocNomina->errno]: $stmt_borrarDocNomina->error");
  }


  $descripcion = "Se elimino el documento: $idDocNomina";
  $clave = 'nomHonorarios';
  $folio = $idDocNomina;
  require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';


  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);

?>
