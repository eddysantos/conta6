<?PHP
      #TOTAL SUELDOS
			$sql_sumPercepcionesSueldos = mysqli_query($db,"SELECT sum(truncate(n_importeGravado,2) + truncate(n_importeExento,2)) as importeSueldos
														FROM conta_t_nom_captura_det
														WHERE fk_id_docNomina = $idDocNomina AND (s_clasificacion = 'percepcion' or s_clasificacion = 'horasExtras')");
			$sumPercepcionesSueldos = 0;
			$totalReg_sumPercepcionesSueldos = mysqli_num_rows($sql_sumPercepcionesSueldos);
			if( $totalReg_sumPercepcionesSueldos > 0 ){
				$oRst_sumPercepcionesSueldos = mysqli_fetch_array($sql_sumPercepcionesSueldos);
				if( !is_null($oRst_sumPercepcionesSueldos['importeSueldos']) ){
					$sumPercepcionesSueldos = $oRst_sumPercepcionesSueldos['importeSueldos'];
				}
			}

			#TOTAL SEPARACION INDEMNIZACION
			$sql_sumPercepcionesSepIndem = mysqli_query($db,"SELECT sum(truncate(n_importeGravado,2) + truncate(n_importeExento,2)) as importeSepIndem
														FROM conta_t_nom_captura_det
														WHERE fk_id_docNomina = $idDocNomina AND s_clasificacion = 'separacionIndemnizacion'");
			$sumPercepcionesSepIndem = 0;
			$totalReg_sumPercepcionesSepIndem = mysqli_num_rows($sql_sumPercepcionesSepIndem);
			if( $totalReg_sumPercepcionesSepIndem > 0 ){
				$oRst_sumPercepcionesSepIndem = mysqli_fetch_array($sql_sumPercepcionesSepIndem);
				if( !is_null($oRst_sumPercepcionesSepIndem['importeSepIndem']) ){
					$sumPercepcionesSepIndem = $oRst_sumPercepcionesSepIndem['importeSepIndem'];
				}
			}

			#DETALLE POR SEPARACION INDEMNIZACION
			$totalPagado = 0;
			$numAniosServicio = 0;
			$ultimoSueldoMensOrd = 0;
			$ingresoAcumulable = 0;
			$ingresoNoAcumulable = 0;

			if( $sumPercepcionesSepIndem > 0 ){
				$sql_detPercepcionesSepIndem = mysqli_query($db,"SELECT n_totalPagado, n_numAniosServicio, n_ultimoSueldoMensOrd, n_ingresoAcumulable,n_ingresoNoAcumulable
					FROM conta_t_nom_captura_det
					WHERE s_tipoElemento = 'totales' and fk_id_docNomina = $idDocNomina");

				$totalReg_detPercepcionesSepIndem = mysqli_num_rows($sql_detPercepcionesSepIndem);
				if( $totalReg_detPercepcionesSepIndem > 0 ){
					$oRst_detPercepcionesSepIndem = mysqli_fetch_array($sql_detPercepcionesSepIndem);
						$totalPagado = $oRst_detPercepcionesSepIndem['n_totalPagado'];
						$numAniosServicio = $oRst_detPercepcionesSepIndem['n_numAniosServicio'];
						$ultimoSueldoMensOrd = $oRst_detPercepcionesSepIndem['n_ultimoSueldoMensOrd'];
						$ingresoAcumulable = $oRst_detPercepcionesSepIndem['n_ingresoAcumulable'];
						$ingresoNoAcumulable = $oRst_detPercepcionesSepIndem['n_ingresoNoAcumulable'];
				}
			}

      #TOTAL PERCEPCIONES GRAVADO Y EXENTO
			$sql_sumPercepciones = mysqli_query($db,"SELECT sum(truncate(n_importeGravado,2)) as importeGravado, sum(truncate(n_importeExento,2)) as importeExento
														FROM conta_t_nom_captura_det
														WHERE fk_id_docNomina = $idDocNomina AND (s_clasificacion = 'percepcion' or s_clasificacion = 'horasExtras' or s_clasificacion = 'separacionIndemnizacion')");
			$sumPercepcionesImporteGravado = 0;
			$sumPercepcionesImporteExento = 0;
			$totalReg_sumPercepciones = mysqli_num_rows($sql_sumPercepciones);
			if( $totalReg_sumPercepciones > 0 ){
				$oRst_sumPercepciones = mysqli_fetch_array($sql_sumPercepciones);
				if( !is_null($oRst_sumPercepciones['importeGravado']) ){
					$sumPercepcionesImporteGravado = $oRst_sumPercepciones['importeGravado'];
				}
				if( !is_null($oRst_sumPercepciones['importeExento']) ){
					$sumPercepcionesImporteExento = $oRst_sumPercepciones['importeExento'];
				}
			}












      $sql_total = mysqli_fetch_array(mysqli_query($db,"SELECT truncate(n_totalPercepciones,2) as totalPercepciones, truncate(n_totalOtrosPagos,2) as totalOtrosPagos,
													truncate(n_totalDeducciones,2) as totalDeducciones, truncate(n_total,2) as total, truncate(n_totalNeto,2) as totalNeto
													FROM conta_t_nom_captura_det
													WHERE s_tipoElemento = 'totales' and fk_id_docNomina = $idDocNomina"));

			$sql_total_percepciones = mysqli_fetch_array(mysqli_query($db,"SELECT sum(truncate(n_importeGravado,2) + truncate(n_importeExento,2)) as totalPercepciones
													FROM conta_t_nom_captura_det
													WHERE fk_id_docNomina = $idDocNomina AND (s_clasificacion = 'percepcion' or s_clasificacion = 'horasExtras' or s_clasificacion = 'separacionIndemnizacion')"));

			#NOTA: a la suma de percepciones faltaria sumar el totalJubilacionPensionRetiro cuando existan registros.

			$sql_total_subtotal = mysqli_fetch_array(mysqli_query($db,"SELECT sum(truncate(n_importeGravado,2) + truncate(n_importeExento,2)) as subtotal
													FROM conta_t_nom_captura_det
													WHERE fk_id_docNomina = $idDocNomina AND (s_clasificacion = 'percepcion' or s_clasificacion = 'horasExtras' or s_clasificacion = 'separacionIndemnizacion' or s_tipoelEmento = 'otrosPagos')"));

			$sql_total_otrosPagos = mysqli_fetch_array(mysqli_query($db,"SELECT sum(truncate(n_importeGravado,2) + truncate(n_importeExento,2)) as totalOtrosPagos
													FROM conta_t_nom_captura_det
													WHERE fk_id_docNomina = $idDocNomina AND s_tipoelEmento = 'otrosPagos'"));


			$sql_total_deducciones = mysqli_fetch_array(mysqli_query($db,"SELECT sum(truncate(n_importeGravado,2) + truncate(n_importeExento,2)) as totalDeducciones
												FROM conta_t_nom_captura_det
												WHERE fk_id_docNomina = $idDocNomina AND s_tipoelEmento = 'deduccion'"));

			if( $sql_total_deducciones['totalDeducciones'] > 0 ){
					$totalDeducciones = $sql_total_deducciones['totalDeducciones'];
					$descuentos = $sql_total_deducciones['totalDeducciones'];
			}else{ $totalDeducciones = 0; $descuentos = 0; }

			$totalPercepciones = $sql_total_percepciones['totalPercepciones'];
			$totalOtrosPagos = $sql_total_otrosPagos['totalOtrosPagos'];

			$subtotal = $sql_total_subtotal['subtotal'];

			$total = number_format($subtotal - $descuentos,2,'.','');







			#TotalOtrasDeducciones
			$sql_sumDeducciones = mysqli_query($db,"SELECT sum(truncate(n_importeGravado,2)) as importeGravado, sum(truncate(n_importeExento,2)) as importeExento
												FROM  conta_t_nom_captura_det
												WHERE fk_id_docNomina = $idDocNomina AND s_tipoelemento = 'deduccion' and fk_claveSAT <> '002'");
			$totalReg_sumDeducciones = mysqli_num_rows($sql_sumDeducciones);
			$totalOtrasDeducciones = 0;
			if( $totalReg_sumDeducciones > 0 ){
				$oRst_sumDeducciones = mysqli_fetch_array($sql_sumDeducciones);
			 	$totalOtrasDeducciones = $oRst_sumDeducciones['importeGravado'] + $oRst_sumDeducciones['importeExento'];
			}

			#TotalImpuestosRetenidos
			$sql_sumDeduccionesISR=mysqli_query($db,"SELECT sum(truncate(n_importeGravado,2)) as importeGravado, sum(truncate(n_importeExento,2)) as importeExento
												FROM conta_t_nom_captura_det
												WHERE fk_id_docNomina = $idDocNomina AND s_tipoelemento = 'deduccion' and fk_claveSAT = '002'");
			$totalReg_sumDeduccionesISR = mysqli_num_rows($sql_sumDeduccionesISR);
			$totalOtrasDeduccionesISR = 0;
			if( $totalReg_sumDeduccionesISR > 0 ){
				$oRst_sumDeduccionesISR = mysqli_fetch_array($sql_sumDeduccionesISR);
			 	$totalOtrasDeduccionesISR = number_format($oRst_sumDeduccionesISR['importeGravado'] + $oRst_sumDeduccionesISR['importeExento'],2,'.','');
			}



?>
