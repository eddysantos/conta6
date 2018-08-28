<?PHP


    # LISTA DE CONCEPTOS
    if( $cobrarFlete == 'no'){
      $query_deleteHNS12 = "DELETE FROM conta_tem_tarifas_calculodetalle
                            WHERE fk_id_tarifa = $calculoTarifa AND fk_id_concepto IN(
                                        SELECT fk_id_conceptoHon
                                        FROM contame_tarifas_conceptos
                                        WHERE fk_id_conceptoCta = 'HNS_12' AND fk_id_cliente = '$cliente' AND s_concepto_esp LIKE '%FLETE%')";

      $stmt_deleteHNS12 = $db->prepare($query_deleteHNS12);
      if (!($stmt_deleteHNS12)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
        exit_script($system_callback);
      }

      if (!($stmt_deleteHNS12->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution [$stmt_deleteHNS12->errno]: $stmt_deleteHNS12->error";
        exit_script($system_callback);
      }

    }

    if( $entradas <= 1){
      # HNS_8 ENTRADAS ADICIONALES
      $query_deleteHNS8 = "DELETE FROM conta_tem_tarifas_calculodetalle
                          WHERE fk_id_tarifa = $calculoTarifa AND fk_id_concepto IN(
                                    SELECT fk_id_conceptoHon
                                    FROM contame_tarifas_conceptos
                                    WHERE fk_id_conceptoCta = 'HNS_8' AND fk_id_cliente = '$cliente')";

      $stmt_deleteHNS8 = $db->prepare($query_deleteHNS8);
      if (!($stmt_deleteHNS8)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
        exit_script($system_callback);
      }

      if (!($stmt_deleteHNS8->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution [$stmt_deleteHNS8->errno]: $stmt_deleteHNS8->error";
        exit_script($system_callback);
      }

    }


    if( $inbond == 'NO' ){
      $query_deleteHNS4 = "DELETE FROM conta_tem_tarifas_calculodetalle
                          WHERE fk_id_tarifa = $calculoTarifa AND fk_id_concepto IN(
                                SELECT fk_id_conceptoHon FROM contame_tarifas_conceptos
                                WHERE fk_id_conceptoCta = 'HNS_4' AND fk_id_cliente = '$cliente')";

      $stmt_deleteHNS4 = $db->prepare($query_deleteHNS4);
      if (!($stmt_deleteHNS4)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
        exit_script($system_callback);
      }

      if (!($stmt_deleteHNS4->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution [$stmt_deleteHNS4->errno]: $stmt_deleteHNS4->error";
        exit_script($system_callback);
      }
    }

    if( $shipper == '0' ){
      $query_deleteHNS7 = "DELETE FROM conta_tem_tarifas_calculodetalle
                          WHERE fk_id_tarifa = $calculoTarifa AND fk_id_concepto IN(
                                  SELECT fk_id_conceptoHon FROM contame_tarifas_conceptos
                                  WHERE fk_id_conceptoCta = 'HNS_7' AND fk_id_cliente = '$cliente')";

      $stmt_deleteHNS7 = $db->prepare($query_deleteHNS7);
      if (!($stmt_deleteHNS7)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
        exit_script($system_callback);
      }

      if (!($stmt_deleteHNS7->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution [$stmt_deleteHNS7->errno]: $stmt_deleteHNS7->error";
        exit_script($system_callback);
      }
    }
    /*if( $reexpedicion == 'NO' ){
      mysqli_query($link,"DELETE FROM conta_tem_tarifas_calculodetalle WHERE fk_id_tarifa = $calculoTarifa AND fk_id_concepto IN(
      SELECT fk_id_conceptoHon FROM contame_tarifas_conceptos  WHERE fk_id_conceptoCta = 'HNS_6' AND fk_id_cliente = '$cliente');");
    }*/



?>
