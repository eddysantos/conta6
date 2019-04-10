<?php
  $query_borrarDetPol = "DELETE conta_t_polizas_det
                        WHERE  fk_id_poliza = ?";

  $stmt_borrarDetPol = $db->prepare($query_borrarDetPol);

  if (!($stmt_borrarDetPol)) {
    die("Error during query prepare borrarDetPol [$db->errno]: $db->error");
  }

  $stmt_borrarDetPol->bind_param('s',$id_poliza);
  
  if (!($stmt_borrarDetPol)) {
    die("Error during variables binding borrarDetPol [$stmt_borrarDetPol->errno]: $stmt_borrarDetPol->error");
  }

  if (!($stmt_borrarDetPol->execute())) {
    die("Error during query execute borrarDetPol [$stmt_borrarDetPol->errno]: $stmt_borrarDetPol->error");
  }
?>
