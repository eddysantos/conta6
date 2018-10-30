<?PHP

  $query_acuseCancelaBitacora = "INSERT INTO conta_t_facturas_cfdi_edocancela
                                (s_tipoDoc,n_folio,s_estado,s_estatus_pac)values(?,?,?,?)";
                                
  $stmt_acuseCancelaBitacora = $db->prepare($query_acuseCancelaBitacora);
  if (!($stmt_acuseCancelaBitacora)) {
    die("Error during query prepare acuseCancelaBitacora [$db->errno]: $db->error");
  }
  $stmt_acuseCancelaBitacora->bind_param('ssss',$tipoDoc,$folio,$estado,$statusPAC);
  if (!($stmt_acuseCancelaBitacora)) {
    die("Error during variables binding acuseCancelaBitacora [$stmt_acuseCancelaBitacora->errno]: $stmt_acuseCancelaBitacora->error");
  }
  if (!($stmt_acuseCancelaBitacora->execute())) {
    die("Error during query execute acuseCancelaBitacora [$stmt_acuseCancelaBitacora->errno]: $stmt_acuseCancelaBitacora->error");
  }

?>
