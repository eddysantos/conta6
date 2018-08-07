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

$id_cheque = trim($_POST['cheque']);
$cuentaMST = trim($_POST['cuentaMST']);
$importe = trim($_POST['importe']);
//$id_cliente = trim($_POST['id_cliente']);
$idDocumento = 'chequeMST';

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


// Inserto los Datos principales del cheque en la poliza ****************************************************
$queryMST = "INSERT INTO conta_t_polizas_det
(fk_id_poliza,
  fk_cheque,
  fk_id_cuenta,
  d_fecha,
  fk_tipo,
  s_desc,
  n_cargo,
  n_abono,
  s_idDocumento,
  fk_idRegistro,
  fk_usuario)
SELECT $nFolio,
pk_id_cheque,
fk_id_cuentaMST,
d_fechache,
$tipo,
'$cta_desc',
0,
n_valor,
'$idDocumento',
pk_idcheque_folControl,
'$usuario'
FROM conta_t_cheques_mst WHERE pk_id_cheque = $id_cheque and fk_id_cuentaMST = '$cuentaMST'";

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


// Inserto el detalle del cheque en la póliza
$idDocumento = 'chequeDET';
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
fk_id_cliente,
s_folioCFDIext,
fk_anticipo,
fk_id_cheque,
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
FROM conta_t_cheques_det WHERE fk_id_cheque = $id_cheque and fk_id_cuentaM = '$cuentaMST'";
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


// el folio de la poliza se asigna al cheque
$queryMST_up = "update conta_t_cheques_mst set fk_id_poliza = ? WHERE pk_id_cheque = ? AND fk_id_cuentaMST = ?";
$stmtMST_up = $db->prepare($queryMST_up);
if (!($stmtMST_up)) { die("Error during query prepare [$db->errno]: $db->error");	}
$stmtMST_up->bind_param('sss',$nFolio,$id_cheque,$cuentaMST);
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

$descripcion = "Se Genero la Poliza: $nFolio del Cheque: $id_cheque CuentaM: $cuentaMST";
$clave = 'cheques';
$folio = $id_cheque;
require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


#'**************** DETALLE EN PARTIDAS DE LA POLIZA - CONTABILIDAD ELECTRONICA *******************************
# SE REGISTRA LOS DATOS DE LOS CFDI (FACTURAS, NOTAS DE CREDITO, PAGOS,NOMINA)

/* pendiente de terminar */
/*
  $queryCLT = "SELECT * FROM conta_replica_clientes WHERE pk_id_cliente = ?";
  $stmtCLT = $db->prepare($queryCLT);
  if (!($stmtCLT)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }
  $stmtCLT->bind_param('s',$id_cliente);
  if (!($stmtCLT)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmtCLT->errno]: $stmtCLT->error";
    exit_script($system_callback);
  }
  if (!($stmtCLT->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmtCLT->errno]: $stmtCLT->error";
    exit_script($system_callback);
  }
  $rsltCLT = $stmtCLT->get_result();
  $rowCLT = $rsltCLT->fetch_assoc();
	$rfcOri = trim($rowCLT["s_rfc"]);
	$benefOri = trim($rowCLT["s_nombre"]);


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
    $partidaDoc = $rowPOL['pk_partida'];
    $tipo = $rowPOL['fk_tipo'];
		$factura = $rowPOL['fk_factura'];
		$notaCred = $rowPOL['fk_nc'];
		$referencia = $rowPOL['fk_referencia'];
		$poliza = $rowPOL['fk_id_poliza'];
    $tipoDetalle = 'Transferencia';

		// Transferencia
    $queryTRANSFER = "INSERT INTO conta_t_polizas_det_contaelec
    (fk_id_poliza,fk_partidaPol,fk_tipo,s_tipoDetalle,s_BancoOri,s_ctaOri,s_BancoDest,s_CtaDest,d_fecha,s_Beneficiario,s_RFC,n_monto,s_usuario_modifi,s_BeneficiarioOpc,s_RFCopc)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmtTRANSFER = $db->prepare($queryTRANSFER);
    if (!($stmtTRANSFER)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
      exit_script($system_callback);
    }
    $stmtTRANSFER->bind_param('sssssssssssssss',$poliza,$partidaDoc, $tipo,$tipoDetalle,$bcoOri,$ctaOri,$bcoDest,$ctaDest,$fecha,$benefOri,$rfcOri,$importe,$usuario,$nombreCIA,$rfcCIA);
    if (!($stmtTRANSFER)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding [$stmtTRANSFER->errno]: $stmtTRANSFER->error";
      exit_script($system_callback);
    }
    if (!($stmtTRANSFER->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution [$stmtTRANSFER->errno]: $stmtTRANSFER->error";
      exit_script($system_callback);
    }
    $rsltTRANSFER = $stmtTRANSFER->get_result();

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
//  }





  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);


?>
