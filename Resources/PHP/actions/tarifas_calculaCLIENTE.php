<?PHP
/*
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$almacen=211;
$valor=87464.70;
$peso = 15.4;
$dias=8;
$tipo = 'IMP';
$calculoTarifa= 368301 ;
$usuario ='admado';
$volumen=15;
$oficina = 470;
$cliente= 'CLT_7619';
*/

$honorarios = 0;
$factor_honorarios = 0;
$descuento = 0;

$query_consultaConcCLT = "SELECT DISTINCT A.pk_id_concepto,A.fk_id_cliente,A.s_descripcion,A.fk_id_tipo,A.fk_c_ClaveProdServ,A.fk_id_cuenta
FROM conta_tarifas_conceptos A, conta_tarifas B
WHERE A.pk_id_concepto = B.fk_id_concepto AND A.fk_id_cliente  = ? AND A.fk_id_aduana = ?  AND B.s_imp_exp = ? ";

$stmt_consultaConcCLT = $db->prepare($query_consultaConcCLT);
if (!($stmt_consultaConcCLT)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaConcCLT->bind_param('sss',$cliente,$aduana,$tipo);
if (!($stmt_consultaConcCLT)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaConcCLT->errno]: $stmt_consultaConcCLT->error";
	exit_script($system_callback);
}
if (!($stmt_consultaConcCLT->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaConcCLT->errno]: $stmt_consultaConcCLT->error";
	exit_script($system_callback);
}

$rslt_consultaConcCLT = $stmt_consultaConcCLT->get_result();

while ($row_consultaConcCLT = $rslt_consultaConcCLT->fetch_assoc()) {
  $ID_CONCEPTO_CURSOR = $row_consultaConcCLT["pk_id_concepto"];
  $descripcion = $row_consultaConcCLT["s_descripcion"];
	$tipo_CURSOR = $row_consultaConcCLT["fk_id_tipo"];
	$ClaveProdServ = $row_consultaConcCLT["fk_c_ClaveProdServ"];
	$fk_id_cuenta = $row_consultaConcCLT["fk_id_cuenta"];

  #--Busca... los conceptos con Varios Registros con 1 Limite Inferior, 1 Limite Superior y 1 Importe
	if( $tipo_CURSOR == 101 ){
	    $consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_importe_1 FROM conta_tarifas WHERE fk_id_cliente = '$cliente' AND fk_id_concepto = '$ID_CONCEPTO_CURSOR' AND s_imp_exp = '$tipo' AND n_lim_inferior <= $valor AND n_lim_superior >= $valor"));
	    $IMPORTE = $consul['n_importe_1'];
	}


	#--Busca... los Conceptos con Un Solo Registro y un Solo importe
	if( $tipo_CURSOR == 102 ){
	    $consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_importe_1 FROM conta_tarifas WHERE fk_id_concepto = '$ID_CONCEPTO_CURSOR' AND s_imp_exp = '$tipo'"));
		  $IMPORTE = $consul['n_importe_1'];
	}

	#--Busca... Exclusivo para Honorarios con un Cargo Minimo
	 if( $tipo_CURSOR == 103 ){

		$consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_importe_1,n_factor_1,n_factor_2 from conta_tarifas WHERE fk_id_concepto = '$ID_CONCEPTO_CURSOR' AND s_imp_exp = '$tipo'"));
		$IMPORTE = $consul['n_importe_1'];
		$FACTOR_1 = $consul['n_factor_1'];

		$BASEHONORAIOS = ($valor * $FACTOR_1)/100;
		if( $BASEHONORAIOS > $IMPORTE ){ $IMPORTE = $BASEHONORAIOS; }
		//echo $ID_CONCEPTO_CURSOR;
		#usado en el formato de captura
		$honorarios = $consul['n_importe_1'];
		$factor_honorarios = $consul['n_factor_1'];
		$descuento = $consul['n_factor_2'];
	}

	#--Busca los Conceptos Varios Registros con 1 Lim. Inf., 1 Lim. Sup., Imp y un  Factor
	if( $tipo_CURSOR == 104 ){

	   $consul = mysqli_fetch_array(mysqli_query($db,"Select n_factor_1 FROM conta_tarifas WHERE fk_id_cliente = '$cliente' AND fk_id_concepto = '$ID_CONCEPTO_CURSOR' AND s_imp_exp = '$tipo' AND n_lim_inferior <= $peso AND n_lim_superior >= $peso"));
	   $FACTOR_1 = $consul["n_factor_1"];
	   if(  $FACTOR_1 > 0 ){

	      $consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_importe_1 FROM conta_tarifas WHERE fk_id_cliente = '$cliente' AND fk_id_concepto = '$ID_CONCEPTO_CURSOR' AND s_imp_exp = '$tipo' AND n_lim_inferior <= $peso AND n_lim_superior >= $peso"));
		    $IMPORTE = $consul['n_importe_1'];

	      $TOTAL_MAYOR = $peso * $FACTOR_1;
	      if( $TOTAL_MAYOR >= $IMPORTE ){
			       $IMPORTE = $TOTAL_MAYOR;
	      }
	      if( $TOTAL_MAYOR <= $IMPORTE ){
				      $IMPORTE = $IMPORTE;
	      }
	   }

	   if( is_null($FACTOR_1) ){

	      $consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_importe_1 FROM conta_tarifas WHERE fk_id_cliente = '$cliente' AND fk_id_concepto = '$ID_CONCEPTO_CURSOR' AND s_imp_exp = '$tipo' AND n_lim_inferior <= $peso AND n_lim_superior >= $peso"));
		    $IMPORTE = $consul['n_importe_1'];
	   }
	   $IMPORTE;
	}

	#--Varios Registros con 1 Lim. Inf, 1 Lim. Sup. y un importe por peso
	if( $tipo_CURSOR == 105 ){

	    $consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_importe_1 FROM conta_tarifas WHERE fk_id_cliente = '$cliente' AND fk_id_concepto = '$ID_CONCEPTO_CURSOR' AND s_imp_exp = '$tipo' AND n_lim_inferior <= $peso AND n_lim_superior >= $peso"));
	    $IMPORTE = $consul['n_importe_1'];
	}

	#-- Exclusivo para Honorarios con un Cargo Minimo y un descuento
	 if( $tipo_CURSOR == 106 ){

		$consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_importe_1,n_factor_1,n_factor_2 from conta_tarifas WHERE fk_id_concepto = '$ID_CONCEPTO_CURSOR' AND s_imp_exp = '$tipo' AND n_lim_inferior <= $valor AND n_lim_superior >= $valor"));
		$IMPORTE = $consul["n_importe_1"];
		$FACTOR_1 = $consul["n_factor_1"];
		$DESCUENTO = $consul["n_factor_2"];

		$BASEHONORAIOS = ($valor * $FACTOR_1);
		$DESCUENTO = $BASEHONORAIOS * $DESCUENTO;
		$BASEHONORAIOS = ($BASEHONORAIOS - $DESCUENTO)/100;
		if( $BASEHONORAIOS > $IMPORTE ){ $IMPORTE = $BASEHONORAIOS; }

		#usado en el formato de captura
		$honorarios = $consul['n_importe_1'];
		$factor_honorarios = $consul['n_factor_1'];
		$descuento = $consul['n_factor_2'];
	}

	#--Exclusivo para Honorarios con un Cargo Minimo y un Maximo
	 if( $tipo_CURSOR == 107 ){

		$consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_importe_1,n_factor_1,n_importe_2 from conta_tarifas WHERE fk_id_concepto = '$ID_CONCEPTO_CURSOR' AND s_imp_exp = '$tipo'"));
		$IMPORTE = $consul["n_importe_1"];
		$FACTOR_1 = $consul["n_factor_1"];
		$IMPORTE_MAX = $consul["n_importe_2"];

		$BASEHONORAIOS = ($valor * $FACTOR_1)/100;
		if( $BASEHONORAIOS <= $IMPORTE ){ $IMPORTE = $IMPORTE; }
		if( $BASEHONORAIOS >= $IMPORTE ){ $IMPORTE = $IMPORTE_MAX; }

	 }




  //guardo tarifa
  $s_tipoDoc = 'ctaGastos';
  $s_seccion = 'cliente';
  if( $IMPORTE > 0 ){

    $query_insertConcepCLT = "INSERT INTO conta_tem_tarifas_calculoDetalle(
                                            fk_id_concepto,
                                            fk_id_tipo,
                                            s_descripcion,
                                            fk_id_cliente,
                                            fk_id_tarifa,
                                            fk_usuario,
                                            s_seccion,
                                            n_importe,
																						fk_c_ClaveProdServ,
																						fk_id_cuenta
                                          )values(?,?,?,?,?,?,?,?,?,?)";

    $stmt_insertConcepCLT = $db->prepare($query_insertConcepCLT);
    if (!($stmt_insertConcepCLT)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    $stmt_insertConcepCLT->bind_param('ssssssssss',$id_concepto,
                                                  $tipo_CURSOR,
                                                  $descripcion,
                                                  $cliente,
                                                  $calculoTarifa,
                                                  $usuario,
                                                  $s_seccion,
                                                  $IMPORTE,
																									$ClaveProdServ,
																									$fk_id_cuenta);
    if (!($stmt_insertConcepCLT)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding [$stmt_insertConcepCLT->errno]: $stmt_insertConcepCLT->error";
      exit_script($system_callback);
    }
    if (!($stmt_insertConcepCLT->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution [$stmt_insertConcepCLT->errno]: $stmt_insertConcepCLT->error";
      exit_script($system_callback);
    }
  }//fin guardar




}//fin while





?>
