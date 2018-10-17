<?PHP

    $fechaDoc = date_format(date_create($fecha),'Y-m-d');

    mysqli_query($db,"INSERT INTO conta_t_polizas_mst (d_fecha,fk_usuario,fk_id_aduana,s_concepto)
    		VALUES ('$fechaDoc','$usuario','$aduana','$concepto')");

    $nFolio = mysqli_insert_id($db);
?>
