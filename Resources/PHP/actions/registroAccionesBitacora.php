<?PHP

    mysqli_query($conn,"INSERT INTO conta_bitacora (fk_usuario,fk_id_operacion,s_folio,s_descripcion) values ('$usuario','$clave','$folio','$descripcion')");

?>
