<?php


$system_callback = [];

$text = "%" . $buscar . "%";
$query = "SELECT * FROM conta_t_notacredito_captura
          WHERE ( fk_referencia LIKE ?  OR pk_id_cuenta_captura_nc LIKE ? ) AND fk_id_aduana = ? and
                pk_id_cuenta_captura_nc NOT IN( SELECT fk_id_cuenta_captura_nc FROM conta_t_notacredito_cfdi )
          ORDER BY pk_id_cuenta_captura_nc ";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('sss', $text, $text, $aduana);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

if (!($stmt->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
  exit_script($system_callback);
}

$rslt = $stmt->get_result();

if ($rslt->num_rows == 0) {
  $system_callback['code'] = 1;
  $system_callback['data'] =
  "<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $id_captura = $row['pk_id_cuenta_captura_nc'];
  $id_cliente = $row['fk_id_cliente'];

  $href_cancela = '';  $href_modifica = ''; $href_consulta = ''; $href_imprime = ''; $href_timbrar = '';
  if( $oRst_permisos['s_NC_Pcancelar'] == 1 ){
    $href_cancela = "<a href='#' onclick='cancelaProfNC($id_captura)'><img class='icochico' src='/Resources/iconos/002-trash.svg'></a>";
  }

  if( $oRst_permisos['s_NC_Pmodificar'] == 1  ){
    $href_modifica = "<a href='#' class='' onclick='modificaProfNC($id_captura,&#39;$id_cliente&#39;)'><img class='icochico' src='/Resources/iconos/003-edit.svg'></a>";
  }

  if( $oRst_permisos['s_NC_Pconsultar'] == 1  ){
    $href_consulta = "<a href='#' class='ml-1' onclick='consultaProfNC($id_captura,&#39;consulta&#39;)'><img class='icochico' src='/Resources/iconos/magnifier.svg'></a>";
    $href_imprime = "<a href='#' class='ml-1' onclick='imprimeProfNC($id_captura)'><img class='icochico' src='/Resources/iconos/printer.svg'></a>";
  }

  if( $oRst_permisos['s_NC_timbrar'] == 1  ){
    $href_timbrar = "<a href='#' class='ml-1' onclick='consultaProfNC($id_captura,&#39;timbrar&#39;)'><img class='icochico' src='/Resources/iconos/timbrar.svg'></a>";
  }

  $resultadoConsulta .=
  "<tr class='row borderojo font14 align-items-center'>
    <td class='col-md-1'>".$href_cancela."</td>
    <td class='col-md-1'>$id_captura</td>
    <td class='col-md-2'>$row[fk_referencia]</td>
    <td class='col-md-1'>$row[fk_id_factura]</td>
    <td class='col-md-6'>$id_cliente $row[s_nombre]</td>
    <td class='col-md-1'>".
      $href_modifica.' '.
      $href_consulta.' '.
      $href_imprime.' '.
      $href_timbrar."
    </td>
   </tr>";
}


 ?>
