<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

  $semana = trim($_POST['semana']);
  $anio = trim($_POST['anio']);
  $idRegimen = trim($_POST['idRegimen']);

  if( $idRegimen == '09'){ $clave = 'nomHonorarios'; }
  if( $idRegimen == '02'){ $clave = 'nomSueldos'; }
  $descripcion = "Se elimino documento semana: $semana anio: $anio regimen: $idRegimen";


  #BORRAR
  $docNominaDelete = $_POST['docNominaDelete'];

  # si es para sustitucion
  $query_DNDrel="DELETE FROM conta_t_nom_cfdi_relacionada WHERE fk_id_docNomina = ?";
  $stmt_DNDrel = $db->prepare($query_DNDrel);
  if (!($stmt_DNDrel)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare DNDrel [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  # si ya tiene un folio de factura
  $query_DNDcfdi="DELETE FROM conta_t_nom_cfdi WHERE fk_id_docNomina = ?";
  $stmt_DNDcfdi = $db->prepare($query_DNDcfdi);
  if (!($stmt_DNDcfdi)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare DNDcfdi [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  # el detalle del documento
  $query_DNDcapDet="DELETE FROM conta_t_nom_captura_det WHERE fk_id_docNomina = ?";
  $stmt_DNDcapDet = $db->prepare($query_DNDcapDet);
  if (!($stmt_DNDcapDet)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare DNDcapDet [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  # el documento de captura
  $query_DNDcap="DELETE FROM conta_t_nom_captura WHERE pk_id_docNomina = ?";
  $stmt_DNDcap = $db->prepare($query_DNDcap);
  if (!($stmt_DNDcap)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare DNDcap [$db->errno]: $db->error";
    exit_script($system_callback);
  }


foreach ($docNominaDelete as $docNominaD) {
    $idDocNomina = $docNominaD['idDocNomina'];

    $stmt_DNDrel->bind_param('s',$idDocNomina);
    if (!($stmt_DNDrel)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding DNDrel [$stmt_DNDrel->errno]: $stmt_DNDrel->error";
      exit_script($system_callback);
    }
    if (!($stmt_DNDrel->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution DNDrel [$stmt_DNDrel->errno]: $stmt_DNDrel->error";
    }



    $stmt_DNDcfdi->bind_param('s',$idDocNomina);
    if (!($stmt_DNDcfdi)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding DNDcfdi [$stmt_DNDcfdi->errno]: $stmt_DNDcfdi->error";
      exit_script($system_callback);
    }
    if (!($stmt_DNDcfdi->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution DNDcfdi [$stmt_DNDcfdi->errno]: $stmt_DNDcfdi->error";
    }




    $stmt_DNDcapDet->bind_param('s',$idDocNomina);
    if (!($stmt_DNDcapDet)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding DNDcapDet [$stmt_DNDcapDet->errno]: $stmt_DNDcapDet->error";
      exit_script($system_callback);
    }
    if (!($stmt_DNDcapDet->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution DNDcapDet [$stmt_DNDcapDet->errno]: $stmt_DNDcapDet->error";
    }





    $stmt_DNDcap->bind_param('s',$idDocNomina);
    if (!($stmt_DNDcap)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding DNDcap [$stmt_DNDcap->errno]: $stmt_DNDcap->error";
      exit_script($system_callback);
    }
    if (!($stmt_DNDcap->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution DNDcap [$stmt_DNDcap->errno]: $stmt_DNDcap->error";
    }

    $folio = $idDocNomina;
    require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


}





  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);



?>
