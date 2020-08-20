<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$cliente = trim($_POST['cliente']);
$fecha = trim($_POST['fecha']);
$id_poliza = trim($_POST['id_poliza']);
$tipo = trim($_POST['tipo']);

$TBL = "temp_polizas_cliente";
require $root . '/Ubicaciones/Contabilidad/actions/buscarFacturas.php';


$query = "SELECT * FROM temp_polizas_cliente where saldo <> 0 ORDER BY abs(fk_factura) desc";

$stmt = $db->prepare($query);
if (!($stmt)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
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
  $fk_id_cuenta = $row['fk_id_cuenta'];
  $fk_referencia = $row['fk_referencia'];
  $fk_factura = $row['fk_factura'];
  $fk_nc = $row['fk_nc'];
  $fk_ctagastos = $row['fk_ctagastos'];
  $saldo = $row['saldo'];

  if( $fk_factura > 0 ){ $fk_factura2 = $fk_factura; }else{ $fk_factura2 = 0; }
  if( $fk_ctagastos > 0 ){ $fk_ctagastos2 = $fk_ctagastos; }else{ $fk_ctagastos2 = 0; }
  if( $fk_nc > 0 ){ $fk_nc2 = $fk_nc; }else{ $fk_nc2 = 0; }

  $idRegistro = $fk_id_cuenta.$fk_factura2.$fk_referencia.$fk_nc2.$fk_ctagastos2;
  $idFila = $fk_factura.$fk_nc.$fk_ctagastos;


#<input type='checkbox' data-toggle='toggle' onclick='genera_registro(&#39;$fk_referencia&#39;,&#39;$fk_factura2&#39;,&#39;$saldo&#39;,&#39;Chk_$idRegistro&#39;,&#39;pago_$idRegistro&#39;,$fk_nc2,&#39;$idRegistro&#39;,$fk_ctagastos2,&#39;$fk_id_cuenta&#39;,&#39;$cliente&#39;)'>
  $system_callback['data'] .=
  "<tr class='row align-items-center elemento-facpendientes' id='$idFila'>
    <td class='col-md-2'><input type='text' id='facpendref$idFila' class='efecto bt border-0 h22 facpend-referencia' size='10' value='$fk_referencia' readonly></td>
    <td class='col-md-1'><input type='text' id='facpendfac$idFila' class='efecto bt border-0 h22 facpend-factura' size='10' value='$fk_factura2' readonly></td>
    <td class='col-md-1'><input type='text' id='facpendctagastos$idFila' class='efecto bt border-0 h22 facpend-ctagastos' size='10' value='$fk_ctagastos2' readonly></td>
    <td class='col-md-1'><input type='text' id='facpendnc$idFila' class='efecto bt border-0 h22 facpend-nc' size='10' value='$fk_nc2' readonly></td>
    <td class='col-md-2'><input type='text' id='facpendsaldo$idFila' class='efecto bt border-0 h22 facpend-saldo' size='10' value='$saldo' readonly></td>
    <td class='col-md-2'><input type='text' id='facpendpago$idFila' class='efecto h22 facpend-pago' onchange='validaIntDec(this);'></td>
    <td class='col-md-1 text-right'>
      <div class='custom-control custom-switch'>
        <input type='checkbox' class='custom-control-input checkbox-facpend facpend-check' id='generada$idFila'>
        <label class='custom-control-label' for='generada$idFila'></label>
      </div>
      <input type='hidden' id='facpendpartida$idFila' class='efecto h22 facpend-partida' value=''>
    </td>
    <td class='col-md-2'><input type='text' id='facpendcta$idFila' class='efecto bt border-0 h22 facpend-cta' size='10' value='$fk_id_cuenta' readonly></td>
  </tr>";


}

$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



?>
