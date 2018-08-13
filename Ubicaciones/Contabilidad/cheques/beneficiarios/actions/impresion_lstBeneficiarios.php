<?php
	$root = $_SERVER['DOCUMENT_ROOT'];
	//require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';


  require $root . '/conta6/Ubicaciones/barradenavegacion.php';



	$sql_Select = "SELECT * from conta_cs_beneficiarios order by s_nombre";
  $stmt = $db->prepare($sql_Select);
	if (!($stmt)) { die("Error during query prepare [$db->errno]: $db->error");	}
	if (!($stmt->execute())) { die("Error during query prepare [$stmt->errno]: $stmt->error"); }
	$rslt = $stmt->get_result();




?>

<div class="row m-0 submenuMed">
	<ul class="nav nav-pills nav-fill w-100">
		<li class="nav-item">
			<a  class="nav-link" id="submenuMed">BENEFICIARIOS</a>
		</li>
	</ul>
</div>


<div class="contorno">
	<table class="table text-center font12">
		<thead>
			<tr class="row sub2">
				<td class="col-md-2">ID_PROVEEDOR</td>
				<td class="col-md-4">NOMBRE</td>
				<td class="col-md-2">RFC</td>
				<td class="col-md-1">TaxID</td>
				<td class="col-md-3">Banco/Cuenta</td>
			</tr>

			<?php
			while( $rowMST = $rslt->fetch_assoc() ){
				$id_ben = $rowMST["pk_id_benef"];

				$sql_ben = "SELECT b.s_nombre , a.s_cta_banco
										FROM conta_cs_bancos_beneficiarios a, conta_cs_sat_bancos b
										WHERE a.fk_id_banco = b.pk_id_banco and a.fk_id_benef = ?";
				$stmt_ctas = $db->prepare($sql_ben);
				if (!($stmt_ctas)) { die("Error during query prepare [$db->errno]: $db->error");	}
				$stmt_ctas->bind_param('s', $id_ben);
				if (!($stmt_ctas)) { die("Error during query prepare [$stmt_ctas->errno]: $stmt_ctas->error");	}
				if (!($stmt_ctas->execute())) { die("Error during query prepare [$stmt_ctas->errno]: $stmt_ctas->error"); }
				$rslt_ctas = $stmt_ctas->get_result();
				if ($rslt_ctas->num_rows > 0) {
					 $listCtas = "";
					while( $rowctas = $rslt_ctas->fetch_assoc() ){

						$listCtas = $listCtas."<tr class='row'>
							<td class='col-md-6 text-right'>$rowctas[s_nombre] --</td>
							<td class='col-md-6 text-left'>$rowctas[s_cta_banco]</td>
						</tr>";
					}
				}

			?>
				<tr class="row borderojo">
					<td class="col-md-2"><?php echo $id_ben; ?></td>
					<td class="col-md-4"><?php echo trim($rowMST["s_nombre"]); ?></td>
					<td class="col-md-2"><?php echo trim($rowMST["s_rfc"]); ?></td>
					<td class="col-md-1"><?php echo trim($rowMST["s_taxid"]); ?></td>
					<td class="col-md-3">
						<table class="table text-center"><?php echo $listCtas; ?></table>
					</td>
				</tr>
			<?PHP
			}
			?>
		</thead>
	</table>
</div>


<!-- <table border="1" width="100%" id="table4" style="font-family: Trebuchet MS; font-size: 8pt; border-collapse:collapse; color:#000000" cellspacing="1" cellpadding="0" align="center">

	<tr bgcolor="#808080" align="center" style="color:#FFFFFF">
		<td>ID_PROVEEDOR</td>
		<td>NOMBRE</td>
		<td>RFC</td>
		<td>TaxID</td>
		<td>Banco/Cuenta</td>
	</tr>
<?php
while( $rowMST = $rslt->fetch_assoc() ){
	$id_ben = $rowMST["pk_id_benef"];

	$sql_ben = "SELECT b.s_nombre , a.s_cta_banco
							FROM conta_cs_bancos_beneficiarios a, conta_cs_sat_bancos b
							WHERE a.fk_id_banco = b.pk_id_banco and a.fk_id_benef = ?";
	$stmt_ctas = $db->prepare($sql_ben);
	if (!($stmt_ctas)) { die("Error during query prepare [$db->errno]: $db->error");	}
	$stmt_ctas->bind_param('s', $id_ben);
	if (!($stmt_ctas)) { die("Error during query prepare [$stmt_ctas->errno]: $stmt_ctas->error");	}
	if (!($stmt_ctas->execute())) { die("Error during query prepare [$stmt_ctas->errno]: $stmt_ctas->error"); }
	$rslt_ctas = $stmt_ctas->get_result();
	if ($rslt_ctas->num_rows > 0) {
		 $listCtas = "";
		while( $rowctas = $rslt_ctas->fetch_assoc() ){

			$listCtas = $listCtas."<tr align='center'>
				<td>$rowctas[s_nombre]</td>
				<td>$rowctas[s_cta_banco]</td>
			</tr>";
		}
	}

?>
	<tr align="center">
		<td><?php echo $id_ben; ?></td>
		<td><?php echo trim($rowMST["s_nombre"]); ?></td>
		<td><?php echo trim($rowMST["s_rfc"]); ?></td>
		<td><?php echo trim($rowMST["s_taxid"]); ?></td>
		<td><table><?php echo $listCtas; ?></table></td>
	</tr>
<?PHP
}
?>

</table> -->
<?php
require $root . '/conta6/Ubicaciones/footer.php';
?>
