<?PHP
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$system_callback = [];

$id_captura = trim($_POST['id_captura']);

$text = "%" . $id_captura . "%";
$query_ctaGastos = "SELECT A.fk_id_cuenta_captura,A.pk_id_factura, A.fk_referencia, A.fk_id_poliza, A.s_cancela_factura,B.fk_id_cliente, B.s_nombre
          FROM conta_t_facturas_cfdi A, conta_t_facturas_captura B
          WHERE A.fk_id_cuenta_captura = B.pk_id_cuenta_captura AND
                (A.pk_id_factura LIKE ? OR A.fk_referencia LIKE ? ) AND
                A.s_UUID is not null
          ORDER BY A.pk_id_factura ";

$stmt_ctaGastos = $db->prepare($query_ctaGastos);
if (!($stmt_ctaGastos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare ctaGastos [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_ctaGastos->bind_param('s',$text);
if (!($stmt_ctaGastos)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding ctaGastos [$stmt_ctaGastos->errno]: $stmt_ctaGastos->error";
	exit_script($system_callback);
}
if (!($stmt_ctaGastos->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution ctaGastos [$stmt_ctaGastos->errno]: $stmt_ctaGastos->error";
	exit_script($system_callback);
}

$rslt_ctaGastos = $stmt_ctaGastos->get_result();
$total_ctaGastos = $rslt_ctaGastos->num_rows;

while( $row_ctaGastos = $rslt_ctaGastos->fetch_assoc() ){

	$fk_id_cuenta_captura = $row['fk_id_cuenta_captura'];
  $id_factura = $row['pk_id_factura'];
  $cancela_factura = $row['s_cancela_factura'];
  $id_cliente = $row['fk_id_cliente'];

  if( $cancela_factura == 1 ){ $txt_cancela = "Si"; }else{ $txt_cancela = "No"; }

  if( $oRst_permisos['s_NC_Pgenerar'] == 1 && $cancela_factura == 0 ){
    $href = "<a href='#' onclick='genProfNC($fk_id_cuenta_captura,&#39;$id_cliente&#39;)'><img src='/conta6/Resources/iconos/rightred.svg'></a>";
  }else{ $href = ""; }

  $resultadoConsulta .=
  "<tr class='row borderojo font14'>
    <td class='col-md-1'>$id_factura</td>
    <td class='col-md-2'>$row[fk_referencia]</td>
    <td class='col-md-1'>$row[fk_id_poliza]</td>
    <td class='col-md-1'>$txt_cancela</td>
    <td class='col-md-6'>$id_cliente $row[s_nombre]</td>
    <td class='col-md-1 text-right'>".$href."</td>
   </tr>";









}//fin while

$system_callback['data'] = $resultadoConsulta;
$system_callback['code'] = 1;
$system_callback['message'] = "Script called successfully!";
exit_script($system_callback);



?>
