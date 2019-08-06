<?PHP
/*
$tipo = trim($_POST['diatipo']);
$aduana = trim($_POST['diaaduana']);
$fecha = trim($_POST['diafecha']);
$concepto = trim($_POST['diaconcepto']);
*/
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/actions/generarFolioPolizaGeneral.php';

//$nFolio número de Póliza
//$rfcCIA
//$nombreCIA

$anticipo = trim($_POST['anticipo']);
$cuentaMST = trim($_POST['cuentaMST']);
$importe = trim($_POST['importe']);
$id_cliente = trim($_POST['id_cliente']);
$idDocumento = 'anticipoMST';

$system_callback = [];

//consulto el nombre de la cuenta contable
$querynomCta = "SELECT ifnull(s_cta_identificador,'0') as id_cliente,s_cta_desc
                                from conta_cs_cuentas_mst
                                where pk_id_cuenta = ? ";
$stmtnomCta = $db->prepare($querynomCta);
if (!($stmtnomCta)) { die("Error during query prepare nomCta [$db->errno]: $db->error"); }
$stmtnomCta->bind_param('s',$cuentaMST);
if (!($stmtnomCta)) { die("Error during query prepare nomCta [$stmtnomCta->errno]: $stmtnomCta->error"); }
if (!($stmtnomCta->execute())) { die("Error during query execute nomCta [$stmtnomCta->errno]: $stmtnomCta->error"); }
$rsltnomCta = $stmtnomCta->get_result();
$rownomCta = $rsltnomCta->fetch_assoc();
$cta_desc = trim($rownomCta['s_cta_desc']);



$queryMST = "INSERT INTO conta_t_polizas_det
(fk_id_poliza,
  fk_id_cuenta,
  d_fecha,
  fk_tipo,
  fk_id_cliente,
  fk_anticipo,
  s_desc,
  n_cargo,
  n_abono,
  s_idDocumento,
  fk_idRegistro,
  fk_usuario)
SELECT $nFolio,
fk_id_cuentaMST,
d_fecha,
$tipo,
fk_id_cliente_antmst,
pk_id_anticipo,
'$cta_desc',
n_valor,
0,
'$idDocumento',
pk_id_anticipo,
'$usuario'
FROM conta_t_anticipos_mst WHERE pk_id_anticipo = $anticipo";

$stmtMST = $db->prepare($queryMST);
if (!($stmtMST)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
if (!($stmtMST->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmtMST->errno]: $stmtMST->error";
  exit_script($system_callback);
}
$rsltMST = $stmtMST->get_result();



$idDocumento = 'anticipoDET';
$queryDET = "INSERT INTO conta_t_polizas_det
(fk_id_poliza,
  fk_id_cuenta,
  d_fecha,
  fk_tipo,
  fk_referencia,
  fk_id_cliente,
  s_folioCFDIext,
  fk_anticipo,
  fk_cheque,
  fk_ctagastos,
  fk_factura,
  fk_pago,
  fk_nc,
  s_desc,
  n_cargo,
  n_abono,
  s_idDocumento,
  fk_idRegistro,
  fk_usuario)
SELECT $nFolio,
fk_id_cuenta,
d_fecha,
fk_tipo,
fk_referencia,
fk_id_cliente_antdet,
s_folioCFDIext,
fk_id_anticipo,
fk_cheque,
fk_ctagastos,
fk_factura,
fk_pago,
fk_nc,
s_desc,
n_cargo,
n_abono,
'$idDocumento',
pk_partida,
'$usuario'
FROM conta_t_anticipos_det WHERE fk_id_anticipo = $anticipo";
$stmtDET = $db->prepare($queryDET);
if (!($stmtDET)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
  exit_script($system_callback);
}
if (!($stmtDET->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmtDET->errno]: $stmtDET->error";
  exit_script($system_callback);
}
$rsltDET = $stmtDET->get_result();


$queryMST_up = "update conta_t_anticipos_mst set fk_id_poliza = ? WHERE pk_id_anticipo = ?";
$stmtMST_up = $db->prepare($queryMST_up);
if (!($stmtMST_up)) { die("Error during query prepare [$db->errno]: $db->error");	}
$stmtMST_up->bind_param('ss',$nFolio,$anticipo);
if (!($stmtMST_up)) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during variables binding [$stmtMST->errno]: $stmtMST->error";
  exit_script($system_callback);
}
if (!($stmtMST_up->execute())) {
  $system_callback['code'] = "500";
  $system_callback['message'] = "Error during query execution [$stmtMST_up->errno]: $stmtMST_up->error";
  exit_script($system_callback);
}
$rsltMST_up = $stmtMST_up->get_result();

$descripcion = "Se Genero la Poliza: $nFolio del Anticipo: $anticipo Cuenta: $cuentaMST";
$clave = 'anticipos';
$folio = $nFolio;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


#'**************** DETALLE EN PARTIDAS DE LA POLIZA - CONTABILIDAD ELECTRONICA *******************************

  require $root . '/conta6/Resources/PHP/actions/consultaDatosCliente.php';



  $queryANT = "SELECT * FROM conta_t_anticipos_mst WHERE pk_id_anticipo = ?";
  $stmtANT = $db->prepare($queryANT);
  if (!($stmtANT)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmtANT->bind_param('s',$anticipo);
  if (!($stmtANT)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmtANT->errno]: $stmtANT->error";
    exit_script($system_callback);
  }
  if (!($stmtANT->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmtANT->errno]: $stmtANT->error";
    exit_script($system_callback);
  }
  $rsltANT = $stmtANT->get_result();
  $rowANT = $rsltANT->fetch_assoc();
  $poliza = $rowANT["fk_id_poliza"];
  $bcoDest = $rowANT["s_bancoDest"];
	$bcoOri = $rowANT["s_bancoOri"];
	$ctaDest = $rowANT["s_ctaDest"];
	$ctaOri = $rowANT["s_ctaOri"];


  $queryPOL = "SELECT * FROM conta_t_polizas_det WHERE fk_id_poliza = ?";
  $stmtPOL = $db->prepare($queryPOL);
  if (!($stmtPOL)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmtPOL->bind_param('s',$poliza);
  if (!($stmtPOL)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmtPOL->errno]: $stmtPOL->error";
    exit_script($system_callback);
  }
  if (!($stmtPOL->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmtPOL->errno]: $stmtPOL->error";
    exit_script($system_callback);
  }
  $rsltPOL = $stmtPOL->get_result();
  while($rowPOL = $rsltPOL->fetch_assoc()){
    $factura = $rowPOL['fk_factura'];
		$notaCred = $rowPOL['fk_nc'];
		$referencia = $rowPOL['fk_referencia'];
		$poliza = $rowPOL['fk_id_poliza'];


		// Transferencia
    require $root . '/conta6/Resources/PHP/actions/consultaDatosCliente.php';

    $fk_id_poliza = $poliza;
    $partidaPol = $rowPOL['pk_partida'];
    $tipo = $rowPOL['fk_tipo'];
    $tipoDetalle = 'Transferencia';
    $ctaOri = $ctaOri;
    $BancoOri = $bcoOri;
    $BancoOriExt = '';
    $CtaDest = $ctaDest;
    $BancoDest = $bcoDest;
    $BancoDestExt = '';
    $fecha = $fecha;
    $Beneficiario = $benefOri;
    $RFC = $rfcOri;
    $monto = $importe;
    $moneda = 'MXN';
    $TipCamb = 1;
    $BeneficiarioOpc = $nombreCIA;
    $RFCopc = $rfcCIA;
    $usuario_modifi = $usuario;
    $observ = '';
    
    require $root . '/conta6/Resources/PHP/actions/contaElect_insertaTransferencia.php';

    /* FALTA TERMINAR
  		// CFDI CompNal
  		if( $factura > 0 || $notaCred > 0 ){
  			if( $notaCred > 0 ){
  				$oRst_datosNC = mysqli_fetch_array( mysqli_query($link,"SELECT Fac_RFC,UUID,Total_Honorarios
  																				FROM TBL_NOTACREDITO_CFDI
  																				WHERE ID_NC = $notaCred and Id_Referencia = '$referencia' "));
  				$tipoDetalle = 'CompNal';
  				$RFC = $oRst_datosNC['Fac_RFC'];
  				$UUID_CFDI = $oRst_datosNC['UUID'];
  				$monto = $oRst_datosNC['Total_Honorarios'];
  			}else{
  				if( $factura > 0 && $notaCred == 0 ){
  					$oRst_datosFactura = mysqli_fetch_array( mysqli_query($link,"SELECT Fac_RFC,UUID,Total_Honorarios
  																				FROM TBL_FACTURAS_CFD
  																				WHERE id_factura = $factura and id_referencia = '$referencia' "));
  					$tipoDetalle = 'CompNal';
  					$RFC = $oRst_datosFactura['Fac_RFC'];
  					$UUID_CFDI = $oRst_datosFactura['UUID'];
  					$monto = $oRst_datosFactura['Total_Honorarios'];
  				}
  			}
  			mysqli_query($link,"INSERT INTO TBL_POLIZAS_DET_PARTIDA (partidaDoc,tipo,tipoDetalle,RFC,UUID_CFDI,monto,usuario_alta)values
  			($partidaDoc,$tipo,'CompNal','$RFC','$UUID_CFDI',$monto,'$usuario')");
  		}
    */
  }

  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);


?>
