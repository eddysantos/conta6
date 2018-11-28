<?PHP
  $query_datosRefProv = "SELECT B.pk_id_prov,B.s_nombre,B.s_calle,B.s_no_ext,B.s_no_int,B.s_codigo,B.s_pais,B.s_entidad,B.s_ciudad,B.s_telefono,B.s_fax,A.*
                        FROM conta_replica_referencias A, conta_replica_proveedores B
                        WHERE A.pk_referencia = ? AND A.fk_id_proveedor = B.pk_id_prov AND a.fk_id_cliente = b.fk_id_cliente";

  $stmt_datosRefProv = $db->prepare($query_datosRefProv);
  if (!($stmt_datosRefProv)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmt_datosRefProv->bind_param('s',$id_referencia);
  if (!($stmt_datosRefProv)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt_datosRefProv->errno]: $stmt_datosRefProv->error";
    exit_script($system_callback);
  }
  if (!($stmt_datosRefProv->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt_datosRefProv->errno]: $stmt_datosRefProv->error";
    exit_script($system_callback);
  }
  $rslt_datosRefProv = $stmt_datosRefProv->get_result();
  $rows_datosRefProv = $rslt_datosRefProv->num_rows;


?>
