<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

  $tipoInf = $_POST['tipoInf'];
  $fk_id_poliza = $_POST['id_poliza'];
  $partidaDoc = $_POST['partidaDoc'];
  if(isset($_POST['tipo'])){
    $tipo = $_POST['tipo']; # ant,che, pol ...
  }

  /*
  $accion = $_POST['accion'];
  $bancoO = $_POST['bancoO'];
  $ctaBancoO = $_POST['ctaBancoO'];
  $bancoD = $_POST['bancoD'];
  $ctaBancoD = $_POST['ctaBancoD'];
  $fecha = $_POST['fecha'];
  $fecha = date_format(date_create($fecha),'Y-m-d');
  $beneficiario = $_POST['Beneficiario'];
  $RFCopc = $_POST['RFCopc'];
  $id_partida = $_POST['id_partida'];
  $fechaActual = date("Y-m-s H:i:s");
  $id_cheque = $_POST['numCheque'];
  $observaciones = $_POST['observaciones'];
  $bancoExt = $_POST['bancoExt'];
  $bancoDestExt = $_POST['bancoDestExt'];
  $serie = $_POST['serie'];
  $folio = $_POST['folio'];
  $NumFactExt = $_POST['NumFactExt'];
  $TaxID = $_POST['TaxID'];
  $metPago = $_POST['metPago'];
  */
  
  if( $tipoInf == "CompNal" ){
    # CONTROL INTERNO: $beneficiarioOpc, $RFCopc, $observaciones
    $UUID = $_POST['UUID'];
    $RFC = $_POST['RFC'];
    $importe = $_POST['importe'];
    $beneficiarioOpc = $_POST['BeneficiarioOpc'];
    $moneda = $_POST['moneda'];
    $tipoCamb = $_POST['tipoCamb'];


    require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
    $rsltCOMPNAL = $stmtCOMPNAL->get_result();

    $system_callback['code'] = 1;
    $system_callback['message'] = "Script called successfully!";
    exit_script($system_callback);


		$descripcion = "$tipoInf, InfAdPartida PartidaDoc:$partidaDoc, Tipo:$tipo, UUID:$UUID, RFC:$RFC, Beneficiario:$beneficiarioOpc, Monto:$importe, TipoCambio:$tipoCamb, Moneda:$moneda";
	}

  if( $tipoInf == "Cheque" ){
    $idbanco = trim($_POST['idbanco']);
		$idcta = $_POST['idcta'];
		$nomExtj = $_POST['nomExtj'];
		$tipoCamb = $_POST['tc'];
		$moneda = $_POST['moneda'];
		$cheque = $_POST['cheque'];
		$importe = $_POST['importe'];
		$fecha = $_POST['fecha'];
		$beneficiario = $_POST['benef'];
		$rfcbenef = $_POST['rfcbenef'];

    if( $moneda == '' ){ $moneda = 'MXN'; }
    if( $tipoCamb == "" ){ $tipoCamb = 1; }

    require $root . '/Resources/PHP/actions/contaElect_insertaCheque.php';
    $rsltCHEQUE = $stmtCHEQUE->get_result();

    $system_callback['code'] = 1;
    $system_callback['message'] = "Script called successfully!";
    exit_script($system_callback);

	  $descripcion = "$tipoInf, InfAdPartida PartidaDoc:$partidaDoc, Tipo:$tipo, IDBANC:$idbanco, CTA:$idcta, Beneficiario:$beneficiario, RFC:$rfcbenef Cheque:$cheque Monto:$importe, Fecha:$fecha TipoCambio:$tipoCamb, Moneda:$moneda NomBancExtj:$nomExtj";

  }

  if( $tipoInf == "CompExt" ){
    $tax = $_POST['tax'];
		$razsocial = $_POST['razsocial'];
		$fact = $_POST['fact'];
		$moneda = $_POST['moneda'];
		$tipoCamb = $_POST['tc'];
		$importe = $_POST['total'];

    require $root . '/Resources/PHP/actions/contaElect_insertaCompExt.php';
    $rsltCompExt = $stmtCompExt->get_result();

    $system_callback['code'] = 1;
    $system_callback['message'] = "Script called successfully!";
    exit_script($system_callback);

    $descripcion = "$tipoInf, InfAdPartida PartidaDoc:$partidaDoc, tipo:$tipo, TaxID:$tax, Nombre:$razsocial, Factura:$fact, Moneda:$moneda TipoCambio:$tipoCamb, Monto:$importe";

  }

  if( $tipoInf == "OtrMetodoPago" ){
    $formaPago = $_POST['formaPago'];
    $fecha = $_POST['fecha'];
    $importe = $_POST['importe'];
    $moneda = $_POST['moneda'];
    $tipoCamb = $_POST['tc'];
    $nombre = $_POST['nombre'];
    $rfc = $_POST['rfc'];

    require $root . '/Resources/PHP/actions/contaElect_insertaOtrMetodoPago.php';
    $rsltOtrMetodoPago = $stmtOtrMetodoPago->get_result();

    $system_callback['code'] = 1;
    $system_callback['message'] = "Script called successfully!";
    exit_script($system_callback);

    $descripcion = "$tipoInf, InfAdPartida PartidaDoc:$partidaDoc, tipo:$tipo, FormaPago:$formaPago, Fecha:$fecha, Nombre:$nombre, RFC:$rfc, Monto:$importe, Moneda:$moneda, TipoCambio:$tc";

  }

  if( $tipoInf == "Transferencia" ){
    $partidaPol = $partidaDoc;
    $tipo = $tipo;
    $tipoDetalle = $tipoInf;
    $ctaOri = $_POST['ctabanco_o'];
    $BancoOri = $_POST['idbanco_o'];
    $BancoOriExt = $_POST['nomBancExtj_o'];
    $CtaDest = $_POST['ctabanco_d'];
    $BancoDest = $_POST['idbanco_d'];
    $BancoDestExt = $_POST['nomBancExtj_d'];
    $fecha = $_POST['fecha'];
    $Beneficiario = $_POST['razonsocial_d'];
    $RFC =	$_POST['rfc_d'];
    $monto = $_POST['importe'];
    $moneda = $_POST['moneda'];
    $TipCamb = $_POST['tc'];
    $BeneficiarioOpc = $_POST['razonsocial_o'];
    $RFCopc = $_POST['rfc_o'];
    $usuario_modifi = $usuario;
    $observ = $_POST['obser'];

    require $root . '/Resources/PHP/actions/contaElect_insertaTransferencia.php';
    $rsltOtrMetodoPago = $stmtOtrMetodoPago->get_result();

    $system_callback['code'] = 1;
    $system_callback['message'] = "Script called successfully!";
    exit_script($system_callback);

    $descripcion = "$tipoInf, InfAdPartida PartidaDoc:$partidaDoc, tipo:$tipo, Fecha:$fecha, Monto:$importe, Moneda:$moneda, TipoCambio:$tc";
  }

  $clave = 'contaElect';
  $folio = $fk_id_poliza;
  require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

?>
