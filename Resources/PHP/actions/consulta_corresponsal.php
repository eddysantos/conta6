<?PHP
$query_consultaCorresponsal = "SELECT pk_id_corresp,s_nombre from conta_t_corresponsales where fk_id_cliente = '$id_cliente'";

$stmt_consultaCorresponsal = $db->prepare($query_consultaCorresponsal);
if (!($stmt_consultaCorresponsal)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

if (!($stmt_consultaCorresponsal->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmt_consultaCorresponsal->errno]: $stmt_consultaCorresponsal->error";
  exit_script($system_callback);
}

$rslt_consultaCorresponsal = $stmt_consultaCorresponsal->get_result();

if ($rslt_consultaCorresponsal->num_rows == 0) {
  $consultaCorresponsal = "NO ES CORRESPONSAL";
}

if ($rslt_consultaCorresponsal->num_rows > 0) {
  while ($row_consultaCorresponsal = $rslt_consultaCorresponsal->fetch_assoc()) {
    $idcorresp = trim($row_consultaCorresponsal['pk_id_corresp']);
    $nombrecorresp =  trim($row_consultaCorresponsal['s_nombre']);

    $consultaCorresponsal .= "<tr class='row'>
      <td class='col-md-4 p-0'><input class='efecto h22 border-0' type='text' value='$idcorresp'></td>
      <td class='col-md-4 p-0'><input class='efecto h22 border-0' type='text' size='100' value='$nombrecorresp'></td>
    </tr>";
  }
}

?>
