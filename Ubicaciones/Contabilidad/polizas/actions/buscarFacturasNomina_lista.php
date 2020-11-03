<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';
$system_callback['data'] = '';

$regimen = trim($_POST['regimen']);

$query = "SELECT distinct a.pk_id_nomina,CONCAT(s_nombre,s_apellidoP,s_apellidoM) as nombre,fk_id_banco,s_CLABE,c.n_totalNeto,b.n_semana
          from conta_t_nom_cfdi a, conta_t_nom_captura b, conta_t_nom_captura_det c
          where a.fk_id_docNomina = pk_id_docNomina and c.fk_id_docNomina = b.pk_id_docNomina and
          b.fk_id_aduana = ? and fk_id_regimen = ? and
          s_UUID is not null and (fk_id_polizaPago = 0 or fk_id_polizaPago is null) and s_cancela_factura = 0 and fk_id_poliza > 0 and
          c.s_tipoElemento = 'totales'
          ORDER BY pk_id_nomina,s_nombre";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}

$stmt->bind_param('ss',$aduana,$regimen);
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
  $system_callback['data'] ="<p db-id=''>No se encontraron resultados</p>";
  $system_callback['message'] = "Script called successfully but there are no rows to display.";
  exit_script($system_callback);
}

while ($row = $rslt->fetch_assoc()) {
  $pk_id_nomina = $row['pk_id_nomina'];
  $nombre = $row['nombre'];
  $fk_id_banco = $row['fk_id_banco'];
  $s_CLABE = $row['s_CLABE'];
  $n_totalNeto = $row['n_totalNeto'];
  $n_semana = $row['n_semana'];

  $idFila = $pk_id_nomina;


  $system_callback['data'] .=
  "<tr class='row align-items-center elemento-nompendientesSueldos' id='$idFila'>
    <td class='col-md-1'><input type='text' id='nompendsem$idFila' class='efecto bt border-0 h22 nompend-semana' size='3' value='$n_semana' readonly></td>
    <td class='col-md-1'><input type='text' id='nompendbancf$idFila' class='efecto bt border-0 h22 nompend-banco' size='3' value='$fk_id_banco' readonly></td>
    <td class='col-md-2'><input type='text' id='nompendclav$idFila' class='efecto bt border-0 h22 nompend-clabe' size='10' value='$s_CLABE' readonly></td>
    <td class='col-md-1'><input type='text' id='nompend$idFila' class='efecto bt border-0 h22 nompend-factura' size='10' value='$pk_id_nomina' readonly></td>
    <td class='col-md-5'><input type='text' id='nompendnombre$idFila' class='efecto bt border-0 h22 nompend-nombre' size='10' value='$nombre' readonly></td>
    <td class='col-md-1'><input type='text' id='nompendneto$idFila' class='efecto bt border-0 h22 nompend-neto' size='10' value='$n_totalNeto' readonly></td>
    <td class='col-md-1'><input type='hidden' id='nompendregimen$idFila' class='efecto bt border-0 h22 nompend-regimen' size='10' value='$regimen' readonly>
      <div class='checkbox-xs'>
        <label>
        <input type='checkbox' data-toggle='toggle' class='checkbox-nompend nompend-check'>
        <input type='hidden' id='nompendpartida$idFila' class='efecto h22 nompend-partida' value=''>
        </label>
      </div>
    </td>
  </tr>";

}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



?>
