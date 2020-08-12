<?php
#http://localhost:88/conta6/ubicaciones/Contabilidad/anticipos/estadoCuenta/lst_anticipos.php?ID_Expedidor=CLT_7021&fechaInicial=2012-12-01&fechaFinal=2012-12-31
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/conta6/Resources/PHP/Databases/Conexion.php');

	 $expedidoA = trim($_GET['ID_Expedidor']);
	 $fechaInicial = trim($_GET['fechaInicial']);
	 $fechaFinal = trim($_GET['fechaFinal']);

$sql_Select = mysqli_query($db,"SELECT * FROM tbl_anticipos_mst WHERE id_Expedidor = '$expedidoA' and id_poliza > 0 and ant_fecha BETWEEN '$fechaInicial' and '$fechaFinal' ");
$totalSelect = mysqli_num_rows($sql_Select);

echo '<table width="auto" border="1" cellspacing="0" cellpadding="0">';
if ( $totalSelect > 0){
	while ($oRst_Select = mysqli_fetch_array($sql_Select)){
		$idAnticipo = $oRst_Select["id_anticipo"];
		$valor = number_format($oRst_Select["ant_valor"],2,'.',',');
		$fecha = date_format(date_create($oRst_Select["ant_fecha"]),"d/m/Y");

				echo '
				  <tr bgcolor="#C0C0C0">
					<td>ANTICIPO '.$idAnticipo.' </td>
					<td>'.$fecha.'</td>
					<td  align="right">'.$valor.'</td>
					<td></td>
				  </tr>';
		$sql_ANTDET = mysqli_query($db,"select * from TBL_ANTICIPOS_DET where id_anticipo = $idAnticipo");
		$totalANTDET = mysqli_num_rows($sql_ANTDET);
		if( $totalANTDET > 0 ){
			while ($oRst_ANTDET = mysqli_fetch_array($sql_ANTDET)){
				$id_referencia = trim($oRst_ANTDET["ant_referencia"]);
				$cargo = $oRst_ANTDET["ant_cargo"];
				$abono = $oRst_ANTDET["ant_abono"];
				$importe = number_format($cargo - $abono,2,'.',',');
				$cuenta = $oRst_ANTDET["ant_cuenta"];
				$antCliente = $oRst_ANTDET["ant_cliente"];
				$estado = '';

				/*********  BUSCANDO ANTICIPO EN FACTURAS MEX,USA */
				#APLICADO EN CFD O CFDI
				$sql_conCFDI = mysqli_query($db,"select id_cuenta, id_factura, UUID,id_poliza,pol_cancela
												from tbl_facturas_cfd
												where (no_anticipo_1=$idAnticipo or no_anticipo_2=$idAnticipo or no_anticipo_3=$idAnticipo or no_anticipo_4=$idAnticipo or no_anticipo_5=$idAnticipo or no_anticipo_6=$idAnticipo)
												and id_referencia = '$id_referencia'");

				$total_conCFDI = mysqli_num_rows($sql_conCFDI);
				if( $total_conCFDI == 0 ){

					#APLICADO EN FACTURA AMERICANA
					$sql_conFacAme = mysqli_query($db,"select * from tbl_cta_ame where id_cliente = '$antCliente' and id_referencia = '$id_referencia'");

					$total_conFacAme = mysqli_num_rows($sql_conFacAme);
					if( $total_conFacAme == 0 ){

						#APLICADO EN FACTURA IMPRESA
						$sql_conFacImpresa = mysqli_query($db,"select id_cuenta,id_poliza
															from tbl_facturas_mst
															where (no_anticipo_1=$idAnticipo or no_anticipo_2=$idAnticipo or no_anticipo_3=$idAnticipo)
															and id_referencia = '$id_referencia'");

						$total_conFacImpresa = mysqli_num_rows($sql_conFacImpresa);
						if( $total_conFacImpresa == 0 ){
							$estado = 'pendiente de aplicar';
						}
					}
				}

				/****************/

				echo '<tr>
						<td></td>
						<td>'.$id_referencia.'</td>
						<td align="right">'.$importe.'</td>
						<td>'.$estado.'</td>
					  </tr>';
			}
		}else{
			echo "<b>NO HAY DETALLES DE ESTE ANTICIPO</b>";
		}


	}
}else{
	echo '<p align="center"><font face="Trebuchet MS" size="2" align="center" >NO HAY DATOS</font></p>';
}
echo '</table>'; ?>
