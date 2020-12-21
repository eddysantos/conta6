<?php
  $query_borrarTablas = "DROP TABLE IF EXISTS $lst_tablas ";

  $stmt_borrarTablas = $db->prepare($query_borrarTablas);

  if (!($stmt_borrarTablas)) {
    die("Error during query prepare borrarTablas [$db->errno]: $db->error");
  }

  #$stmt_borrarTablas->bind_param('s',$lst_tablas);

  if (!($stmt_borrarTablas)) {
    die("Error during variables binding borrarTablas [$stmt_borrarTablas->errno]: $stmt_borrarTablas->error");
  }

  if (!($stmt_borrarTablas->execute())) {
    die("Error during query execute borrarTablas [$stmt_borrarTablas->errno]: $stmt_borrarTablas->error");
  }
?>
