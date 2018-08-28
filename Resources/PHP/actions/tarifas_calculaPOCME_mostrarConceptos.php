<?PHP
$query_Conceptos = "SELECT A.*,B.*
                  FROM conta_tem_tarifas_calculodetalle A, contame_tarifas_conceptos B
                  WHERE A.fk_id_tarifa = $calculoTarifa AND A.fk_id_cliente = '$cliente' AND
                      A.fk_id_concepto = B.fk_id_conceptoHon AND B.s_cobro_automatico = 1 AND B.fk_id_cliente = '$cliente'
                  ORDER BY A.fk_id_concepto limit 8 ";

$stmt_Conceptos = $db->prepare($query_Conceptos);
if (!($stmt_Conceptos)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_Conceptos->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_Conceptos->errno]: $stmt_Conceptos->error";
  exit_script($system_callback);
}

$rslt_Conceptos = $stmt_Conceptos->get_result();


?>
