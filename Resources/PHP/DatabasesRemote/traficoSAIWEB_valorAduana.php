<?php


require $root . '/conta6/Resources/PHP/Databases/conexion.php';
require $root . '/conta6/Resources/PHP/DatabasesRemote/conexionADUANET.php';


$sql_referenciasPedimento = mysqli_query($aduanet,"SELECT AT001.N001VALADU valor_aduana FROM AT001 WHERE AT001.C001REFPED = '$id_referencia'");
$oRst_referenciasPedimento = mysqli_fetch_array($sql_referenciasPedimento);
$valAduana_aduanet = trim($oRst_referenciasPedimento['valor_aduana']);

	# actualizando valor_aduana
	$query_actValAdu=" UPDATE conta_replica_referencias
										 SET n_valor_aduana = ?
										 WHERE fk_referencia = ?";

	 $stmt_actValAdu = $db->prepare($query_actValAdu);
	 if (!($stmt_actValAdu)) {
		 $system_callback['code'] = "500";
		 $system_callback['message'] = "Error during query prepare actValAdu [$db->errno]: $db->error";
		 exit_script($system_callback);
	 }

	 $stmt_actValAdu->bind_param('ss', $valAduana_aduanet,$id_referencia);


	 if (!($stmt_actValAdu)) {
		 $system_callback['code'] = "500";
		 $system_callback['message'] = "Error during variables binding actValAdu [$stmt_actValAdu->errno]: $stmt_actValAdu->error";
		 exit_script($system_callback);
	 }

	 if (!($stmt_actValAdu->execute())) {
		 $system_callback['code'] = "500";
		 $system_callback['message'] = "Error during query execution actValAdu [$stmt_actValAdu->errno]: $stmt_actValAdu->error";
		 //exit_script($system_callback);
	 }

	 #echo "SE ACTUALIZARON TODAS LOS PEDIMENTOS";
?>
