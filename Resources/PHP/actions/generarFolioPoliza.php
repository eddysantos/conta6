<?PHP

    $fechaDoc = date_format(date_create($fecha),'Y-m-d');

    if(!isset($mesPoliza)){
      $mesPoliza = date_format(date_create($fecha),'m');
    }

    mysqli_query($db,"INSERT INTO conta_t_polizas_mst (d_fecha,fk_usuario,fk_id_aduana,s_concepto,d_mes)
    		VALUES ('$fechaDoc','$usuario','$aduana','$concepto',$mesPoliza)");

    $nFolio = mysqli_insert_id($db);
?>
