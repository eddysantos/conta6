<?php
$query_ctasbancosCLT = "SELECT A.fk_id_banco,A.s_cta_banco,B.s_nombre,A.fk_usuario,A.d_fecha_alta,A.s_usuario_modifi,A.d_fecha_modifi,A.pk_id_banco_clt,A.s_nomBanExt
          FROM conta_cs_bancos_clientes A, conta_cs_sat_bancos B
          WHERE A.fk_id_banco = B.pk_id_banco AND A.fk_id_cliente = ? ORDER BY B.s_nombre";

$stmt_ctasbancosCLT = $db->prepare($query_ctasbancosCLT);
if (!($stmt_ctasbancosCLT)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare ctasbancosCLT [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt_ctasbancosCLT->bind_param('s', $id_cliente);
if (!($stmt_ctasbancosCLT)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding ctasbancosCLT [$stmt_ctasbancosCLT->errno]: $stmt_ctasbancosCLT->error";
  exit_script($system_callback);
}

if (!($stmt_ctasbancosCLT->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution ctasbancosCLT [$stmt_ctasbancosCLT->errno]: $stmt_ctasbancosCLT->error";
  exit_script($system_callback);
}

$rslt_ctasbancosCLT = $stmt_ctasbancosCLT->get_result();

if ($rslt_ctasbancosCLT->num_rows == 0) {
  $trCtasBancosCLT .= "<tr class='row mt-4 m-0 sub2 align-items-center'>
                        <td class='col-md-10 p-0 text-left'>No se encontraron resultados</td>
                      </tr>";
}

if ($rslt_ctasbancosCLT->num_rows > 0) {
  while ($row_ctasbancosCLT = $rslt_ctasbancosCLT->fetch_assoc()) {
    $ualta_ctasbancosCLT = $row_ctasbancosCLT['fk_usuario'];
    $falta_ctasbancosCLT = $row_ctasbancosCLT['d_fecha_alta'];
    $umodifi_ctasbancosCLT = $row_ctasbancosCLT['s_usuario_modifi'];
    $fmodifi_ctasbancosCLT = $row_ctasbancosCLT['d_fecha_modifi'];
    $idpartida_ctasbancosCLT = $row_ctasbancosCLT['pk_id_banco_clt'];
    $id_banco_ctasbancosCLT = $row_ctasbancosCLT['fk_id_banco'];
    $nomBanco_ctasbancosCLT = $row_ctasbancosCLT['s_nombre'];
    $nomBancoExt_ctasbancosCLT = $row_ctasbancosCLT['s_nomBanExt'];

    $trCtasBancosCLT .= "<tr class='row mt-4 m-0 sub2 align-items-center'>
      <td class='col-md-2 p-0 text-left' elemento-ctasbancosCLT>
        <a href='#' class='remove-ctasbancosCLT'><img class='icomediano ml-2' src='/Resources/iconos/002-trash.svg'></a>
        <input type='hidden' class='partidactasbancosCLT' value='$idpartida_ctasbancosCLT'>
      </td>
      <td class='col-md-2 p-0 text-left'>$id_banco_ctasbancosCLT $nomBanco_ctasbancosCLT $nomBancoExt_ctasbancosCLT</td>
      <td class='col-md-2 p-0 text-left'>$row_ctasbancosCLT[s_cta_banco]</td>
      <td class='col-md-2 p-0 text-left'>$ualta_ctasbancosCLT $falta_ctasbancosCLT</td>
      <td class='col-md-2 p-0 text-left'>$umodifi_ctasbancosCLT $fmodifi_ctasbancosCLT</td>
    </tr>";
  }
}

?>
