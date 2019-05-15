<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

# CONTROL INTERNO: $beneficiarioOpc, $RFCopc, $observaciones

  #$usuario = $_POST['usuario'];
  $partidaDoc = $_POST['partidaDoc'];
  $accion = $_POST['accion'];
  $bancoO = $_POST['bancoO'];
  $ctaBancoO = $_POST['ctaBancoO'];
  $bancoD = $_POST['bancoD'];
  $ctaBancoD = $_POST['ctaBancoD'];
  $fecha = $_POST['fecha'];
  $fecha = date_format(date_create($fecha),'Y-m-d');
  $beneficiario = $_POST['Beneficiario'];
  $beneficiarioOpc = $_POST['BeneficiarioOpc'];
  $RFC = $_POST['RFC'];
  $RFCopc = $_POST['RFCopc'];
  $importe = $_POST['importe'];
  $tipoInf = $_POST['tipoInf'];
  $tipo = $_POST['tipo'];
  $UUID = $_POST['UUID'];
  $id_partida = $_POST['id_partida'];
  $fechaActual = date("Y-m-s H:i:s");
  $id_cheque = $_POST['numCheque'];
  $observaciones = $_POST['observaciones'];
  $tipoCamb = $_POST['tipoCamb'];
  $moneda = $_POST['moneda'];
  $bancoExt = $_POST['bancoExt'];
  $bancoDestExt = $_POST['bancoDestExt'];
  $serie = $_POST['serie'];
  $folio = $_POST['folio'];
  $NumFactExt = $_POST['NumFactExt'];
  $TaxID = $_POST['TaxID'];
  $metPago = $_POST['metPago'];

  $fk_id_poliza = $_POST['id_poliza'];

  if( $tipoInf == "CompNal" ){
    require $root . '/conta6/Resources/PHP/actions/contaElect_insertaCompNal.php';
		$descripcion = "$tipoInf, InfAdPartida partidaDoc:$partidaDoc, tipo:$tipo, UUID:$UUID, RFC:$RFC, Beneficiario:$beneficiarioOpc, monto:$importe, tipoCambio:$tipoCamb, moneda:$moneda";
	}




  $clave = 'contaElect';
  $folio = $fk_id_poliza;
  require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';

?>
