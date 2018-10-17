<?php
    $query_oficinaActiva = "SELECT * FROM conta_t_oficinas WHERE pk_id_aduana = $aduana";
    $stmt_oficinaActiva = $db->prepare($query_oficinaActiva);
    if (!($stmt_oficinaActiva)) { die("Error during query prepare [$db->errno]: $db->error"); }
    if (!($stmt_oficinaActiva->execute())) { die("Error during query prepare [$stmt_oficinaActiva->errno]: $stmt_oficinaActiva->error"); }
    $rslt_oficinaActiva = $stmt_oficinaActiva->get_result();
    $row_oficinaActiva = $rslt_oficinaActiva->fetch_assoc();

/* USAR
    $ex_calle = limpiarBlancos($row_oficinaActiva['s_Calle']);
    $ex_no_ext = limpiarBlancos($row_oficinaActiva['s_No_Ext']);
    $ex_no_int = limpiarBlancos($row_oficinaActiva['s_No_Int']);
    $ex_colonia = limpiarBlancos($row_oficinaActiva['s_colonia']);
    $ex_municipio = limpiarBlancos($row_oficinaActiva['s_municipio']);
    $ex_estado = limpiarBlancos($row_oficinaActiva['estado']);
    $ex_pais = limpiarBlancos($row_oficinaActiva['s_Pais']);
    $ex_cp = limpiarBlancos($row_oficinaActiva['s_codigo']);
    $lugarExpedicion = $ex_cp;
    $lugarExpedicionTxt = $ex_cp.' '.$ex_estado;
*/


?>
