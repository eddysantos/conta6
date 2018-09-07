<?PHP
/*
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$almacen=211;
$valor=22538.88;
$peso = 25.73;
$dias=10;
$tipo = 'IMP';
$calculoTarifa= 368301 ;
$usuario ='admado';
$volumen=25.73;
*/

$custodia = 0;
$manejo = 0;
$almacenaje = 0;
$maniobras = 0;

$query_consultaConcALMACEN = "SELECT pk_id_concepto,fk_id_almacen,s_descripcion,fk_id_tipo,fk_id_cuenta
                              from conta_tarifas_conceptos
                              where fk_id_almacen = ? ";

$stmt_consultaConcALMACEN = $db->prepare($query_consultaConcALMACEN);
if (!($stmt_consultaConcALMACEN)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
	exit_script($system_callback);
}
$stmt_consultaConcALMACEN->bind_param('s',$almacen);
if (!($stmt_consultaConcALMACEN)) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during variables binding [$stmt_consultaConcALMACEN->errno]: $stmt_consultaConcALMACEN->error";
	exit_script($system_callback);
}
if (!($stmt_consultaConcALMACEN->execute())) {
	$system_callback['code'] = "500";
	$system_callback['message'] = "Error during query execution [$stmt_consultaConcALMACEN->errno]: $stmt_consultaConcALMACEN->error";
	exit_script($system_callback);
}

$rslt_consultaConcALMACEN = $stmt_consultaConcALMACEN->get_result();

while ($row_consultaConcALMACEN = $rslt_consultaConcALMACEN->fetch_assoc()) {
  $id_concepto = $row_consultaConcALMACEN["pk_id_concepto"];
  $descripcion = $row_consultaConcALMACEN["s_descripcion"];
	$tipoCalculo = $row_consultaConcALMACEN["fk_id_tipo"];
  $fk_id_cuenta = $row_consultaConcALMACEN['fk_id_cuenta'];

  #--Custodia de Aeropuerto
	if( $tipoCalculo == 1 ){

	 	$query_calc301 = "SELECT n_importe_1,n_factor_1,n_factor_2,n_factor_3
                      FROM conta_tarifas
                      WHERE fk_id_almacen = ?  AND fk_id_concepto = ? AND s_imp_exp = ? AND
                            n_lim_inferior <= ? AND n_lim_superior >= ?";

		$stmt_calc301 = $db->prepare($query_calc301);
		if (!($stmt_calc301)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
			exit_script($system_callback);
		}
		$stmt_calc301->bind_param('sssss',$almacen,$id_concepto,$tipo,$valor,$valor);
		if (!($stmt_calc301)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during variables binding [$stmt_calc301->errno]: $stmt_calc301->error";
			exit_script($system_callback);
		}
		if (!($stmt_calc301->execute())) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query execution [$stmt_calc301->errno]: $stmt_calc301->error";
			exit_script($system_callback);
		}
		$rslt_calc301 = $stmt_calc301->get_result();
		if ($rslt_calc301->num_rows > 0) {

			$row_calc301 = $rslt_calc301->fetch_assoc();

      $Valor_Custodia = $row_calc301["n_importe_1"];
			$FACTOR_1 = $row_calc301["n_factor_1"];
			$Factor_2 = $row_calc301["n_factor_2"];
			$Factor_3 = $row_calc301["n_factor_3"];

      if( $Valor_Custodia > 0 ){
				   #--Calcula las Semanas para saber si cobra un porcentaje por semana o fraccion adicional. la primer semana es libre
				   $Semanas = 0;

				   if( $dias > 7 ){ $Semanas = round(($dias - 7) / 7) + 1; }

				   #--Calcula si hay Costo Adicional por Semana
				   if( $Semanas > 0 ){
					  $Porcentaje_adicional = $Semanas * $Factor_3;
				   }else{
					  $Porcentaje_adicional = 0;
				   }

				   #--Obtiene el Valor mas Alto de la tabla
				   $consul = mysqli_fetch_array(mysqli_query($db,"SELECT MAX(n_lim_inferior) as Valor_Max FROM conta_tarifas WHERE fk_id_concepto = '$id_concepto'"));
				   $Valor_Max = $consul["Valor_Max"];

				   if( $valor > round($Valor_Max) ){
					  $Valor_DIFerencia = ($valor - round($Valor_Max)) / $Factor_2;

					  if( $Valor_DIFerencia <> round($Valor_DIFerencia) ){
						 $Valor_DIFerencia = round($Valor_DIFerencia) + 1;
					  }

					  $Valor_Factor = ($Valor_DIFerencia * $FACTOR_1) + $Valor_Custodia;
					  $Valor_Custodia = $Valor_Factor;
					  $Porcentaje_adicional = $Porcentaje_adicional * $Valor_Custodia;
					  $Valor_Custodia = $Valor_Custodia + $Porcentaje_adicional;
				   }

				   $IMPORTE = $Valor_Custodia;

			}else{ $IMPORTE = 0; }

			if( is_null($IMPORTE) ){ $IMPORTE = 0; }

      $custodia = redondear_dos_decimal($IMPORTE);
		}
	}//fin 1

  #--Busca el Concepto de Manejo de Aeropuerto
	if( $tipoCalculo == 2 ){
		$consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_importe_1  FROM conta_tarifas WHERE fk_id_almacen = $almacen AND fk_id_concepto = '$id_concepto' AND s_imp_exp = '$tipo' AND n_lim_inferior <= $peso AND n_lim_superior >= $peso"));
		$IMPORTE = $consul["n_importe_1"];

		if( $IMPORTE > 0 ){

			#--Obtiene el Valor mas Alto de la tabla
			$consul = mysqli_fetch_array(mysqli_query($db,"select MAX(n_lim_inferior) as n_lim_inferior FROM conta_tarifas WHERE fk_id_concepto = '$id_concepto'"));
			$Valor_Max = $consul["n_lim_inferior"];
			if( $peso > round($Valor_Max) ){
				$consul2 = mysqli_fetch_array(mysqli_query($db,"SELECT  n_factor_1  FROM conta_tarifas WHERE fk_id_almacen = $almacen AND fk_id_concepto = '$id_concepto' AND s_imp_exp = '$tipo' AND n_lim_inferior <= $peso AND n_lim_superior >= $peso"));
				$FACTOR_1 = $consul2["n_factor_1"];
				$Valor_DIFerencia = $peso - $Valor_Max;
				$IMPORTE = $IMPORTE + ($Valor_DIFerencia * $FACTOR_1);
			}
		}else{ $IMPORTE = 0 ; }
    $manejo = redondear_dos_decimal($IMPORTE);
	} // fin 2


  #--Busca el Concepto de Almacenaje de Aeropuerto
  if( $tipoCalculo == 3 ){
    $IMPORTE = 0;
    if($dias >= 3 ){
      #--APLICAN 2 DIAS LIBRES, NO SE COBRA EL ALMACENAJE
      $dias = $dias - 2;

      if($almacen <> 8 ){
        $consul = mysqli_fetch_array(mysqli_query($db,"SELECT MAX(n_factor_3) as n_factor_3 FROM conta_tarifas WHERE fk_id_almacen = $almacen AND fk_id_concepto =  '$id_concepto' AND s_imp_exp = '$tipo'"));
        $Cargo_Minimo = $consul["n_factor_3"];
        if( is_null($Cargo_Minimo) ){ $Cargo_Minimo = 0; }

        $consul2 = mysqli_fetch_array(mysqli_query($db,"SELECT n_factor_1 FROM conta_tarifas WHERE fk_id_almacen = $almacen AND fk_id_concepto = '$id_concepto' AND s_imp_exp = '$tipo' AND n_lim_inferior <= $peso AND n_lim_superior >= $peso AND n_inf_dia <= $dias and n_sup_dia >= $dias"));
        $FACTOR_1 = $consul2["n_factor_1"];
        if( $FACTOR_1 > 0 ){
          $IMPORTE = ($peso * $FACTOR_1) * $dias;
        }else{ $IMPORTE = 0; }

        if( $IMPORTE < $Cargo_Minimo ){ $IMPORTE = $Cargo_Minimo; }
      }else{
        $consul2 = mysqli_fetch_array(mysqli_query($db,"SELECT n_factor_1,n_importe_1 FROM conta_tarifas WHERE fk_id_almacen = $almacen AND fk_id_concepto = '$id_concepto' AND s_imp_exp = '$tipo' AND (n_inf_dia <= $dias and n_sup_dia >= $dias) AND (lim_inferior <= $peso AND n_lim_superior >= $peso)"));
        $FACTOR_1 = $consul2["n_factor_1"];
        $IMPORTE_1 = $FACTOR_1 = $consul2["n_importe_1"];
        $IMPORTE = $IMPORTE_1+( $peso * $FACTOR_1 * $dias);
        if( is_null($IMPORTE) ){ $IMPORTE = 0; }
      }

    }
    $almacenaje = redondear_dos_decimal($IMPORTE);
  }


  #--Busca los Conceptos Un Solo Registro y un Solo importe
  if( $tipoCalculo == 4 ){
    $consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_importe_1 FROM conta_tarifas WHERE fk_id_concepto = '$id_concepto'"));
    $IMPORTE = $consul["n_importe_1"];

  }


  #--Busca los Conceptos Un Solo Registro sin Importe
  if( $tipoCalculo == 5 ){
    //mysqli_query($db,"UPDATE TBL_VALORES_PROFORMA SET Importe = 0 WHERE fk_id_concepto = '$id_concepto' AND ID_Proforma = $calculoTarifa");
  }


  #--Busca los Conceptos Un Solo Registro con Importe y una Faccion (Factor2)
  if( $tipoCalculo == 6 ){
    $sql_consul = mysqli_query($db,"SELECT n_factor_2,n_importe_1 FROM conta_tarifas WHERE fk_id_almacen = $almacen AND fk_id_concepto = '$id_concepto' AND s_imp_exp = '$tipo'");
    $totalReg = mysqli_num_rows($sql_consul);

    if( $totalReg > 0 ) {
      $consul = mysqli_fetch_array($sql_consul);
      $FACTOR_61 = $consul["n_factor_2"];
      $FRACCION_61 = $peso / $FACTOR_61;
      $FRACCION_61 = round($FRACCION_61) + 1;
      $IMPORTE = $consul["n_importe_1"] * $FRACCION_61;

    }
  }//fin 6


  #--Busca los Conceptos que tengan varios registros con 1 Limite Dia Inferior y 1 Dia Superior  y una Fraccion (Factor 2)
  if( $tipoCalculo == 7 ){
    $sql_consul = mysqli_query($db,"SELECT n_factor_2,n_importe_1 FROM conta_tarifas WHERE fk_id_almacen = $almacen AND fk_id_concepto = '$id_concepto' AND s_imp_exp = '$tipo' AND n_inf_dia <= $dias AND n_sup_dia >= $dias");
    $totalReg = mysqli_num_rows($sql_consul);

    if( $totalReg > 0 ) {
      $consul = mysqli_fetch_array($sql_consul);
      $FACTOR_2 = $consul["n_factor_2"];
      $FRACCION = $peso / $FACTOR_2;
      $FRACCION = round($FRACCION) + 1;
      $IMPORTE = $consul["n_importe_1"] * $FRACCION;

    }
  }	//fin 7

  #--Busca los Conceptos que tengan varios registros con 1 Limite Dia Inferior y 1 Dia Superior  y una Fraccion (Factor 2)
  if( $tipoCalculo == 8 ){
    $consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_importe_1 FROM conta_tarifas WHERE fk_id_almacen = $almacen AND fk_id_concepto = '$id_concepto' AND s_imp_exp = '$tipo'"));
    $IMPORTE = $consul["n_importe_1"];
    $Dias_Mas = $dias - 5;

    if( $Dias_Mas < 0 ){
      $IMPORTE = 0;
    }else{
      $IMPORTE = $IMPORTE * $Dias_Mas;
    }

  }//fin8


  #--UN SOLO REGISTRO CON IMPORTE Y UN CARGO MINIMO
  if( $tipoCalculo == 9 ){
    $consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_importe_1,n_factor_1,n_lim_superior FROM conta_tarifas WHERE fk_id_almacen = $almacen AND fk_id_concepto = '$id_concepto' AND s_imp_exp = '$tipo'"));
    $IMPORTE = $consul["n_importe_1"];
    $MINIMO = $consul["n_factor_1"];
    $POR_CADA = $consul["n_lim_superior"];

    $TANTOS_PESO = round($peso)/$POR_CADA;
    $RESTO_PESO = round($peso) % $POR_CADA;

    if( $RESTO_PESO > 0	){
       $TANTOS_PESO = $TANTOS_PESO + 1;
    }


    $TANTOS_VOLUMEN = round($VOLUMEN)/$POR_CADA;
    $RESTO_VOLUMEN = round($VOLUMEN) % $POR_CADA;

    if( $RESTO_VOLUMEN > 0 ){
       $TANTOS_VOLUMEN = $TANTOS_VOLUMEN + 1;
    }

    if($TANTOS_PESO >= $TANTOS_VOLUMEN ){
       $TANTOS = $TANTOS_PESO;
    }

    if($TANTOS_VOLUMEN >= $TANTOS_PESO ){
       $TANTOS = $TANTOS_VOLUMEN;
    }


    $IMPORTE = $IMPORTE * $TANTOS;

    if($IMPORTE >= $MINIMO ){
       $IMPORTE = $IMPORTE;
    }else{
       $IMPORTE = $MINIMO;
    }

  }//fin 9


  #--UN CONCEPTO CON IMPORTE POR CADA X KG (5 DIAS LIBRES)
  if( $tipoCalculo == 10 ){
    $dias_LIBRES = 5;

    $consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_lim_superior,n_importe_1 FROM conta_tarifas WHERE fk_id_almacen = $almacen AND fk_id_concepto = '$id_concepto' AND s_imp_exp = '$tipo'"));
    $POR_CADA = $consul["n_lim_superior"];
    $IMPORTE = $consul["n_importe_1"];

    $TANTOS_PESO = round($peso)/$POR_CADA;
    $RESTO_PESO = round($peso) % $POR_CADA;

    if($RESTO_PESO <= $POR_CADA ){
       $TANTOS_PESO = ($TANTOS_PESO) + 1;
    }else{
       $TANTOS_PESO = ($TANTOS_PESO) + 2;
    }

    $dias = $dias - $dias_LIBRES;

    if($dias > 0 ){
      $IMPORTE = ($IMPORTE * $TANTOS_PESO) * $dias;
    }else{
      $IMPORTE = 0;
    }


  }// fin 10

  #-- Un solo registro con importe fijo y cuota por tonelada o fracci�n
  if( $tipoCalculo == 11 ){

    $consul = mysqli_fetch_array(mysqli_query($db,"SELECT n_lim_superior,n_importe_1,n_factor_2 FROM conta_tarifas WHERE fk_id_almacen = $almacen AND fk_id_concepto = '$id_concepto' AND s_imp_exp = '$tipo'"));
    $POR_CADA = $consul["n_lim_superior"];
    $IMPORTE = $consul["n_importe_1"];
    $CUOTA = $consul["n_factor_2"];

    $TANTOS_PESO = round($peso)/$POR_CADA;
    $RESTO_PESO = round($peso) % $POR_CADA;


    if($RESTO_PESO > 0 ){
       $TANTOS_PESO = $TANTOS_PESO + 1;
    }


    $TANTOS_VOLUMEN = round($VOLUMEN)/$POR_CADA;
    $RESTO_VOLUMEN = round($VOLUMEN) % $POR_CADA;

    if($RESTO_VOLUMEN > 0 ){
       $TANTOS_VOLUMEN = $TANTOS_VOLUMEN + 1;
    }

    if($TANTOS_PESO >= $TANTOS_VOLUMEN ){
       $TANTOS = $TANTOS_PESO;
    }

    if($TANTOS_VOLUMEN >= $TANTOS_PESO ){
       $TANTOS = $TANTOS_VOLUMEN;
    }


    $IMPORTE = ($CUOTA * $TANTOS) + $IMPORTE;


  }//fin 11


  #--Un solo registro con importe fijo por tonelada o fraccion con un cargo minimo
  if( $tipoCalculo == 12 ){
    $sql_consul = mysqli_query($db,"SELECT  n_factor_1,n_importe_1,importe_2  FROM conta_tarifas WHERE fk_id_almacen = $almacen AND fk_id_concepto = '$id_concepto' AND s_imp_exp = '$tipo'");
    $totalReg = mysqli_num_rows($sql_consul);

    if( $totalReg > 0 ){
      $consul = mysqli_fetch_array(mysqli_query($db,"SELECT  n_factor_1,n_importe_1,importe_2  FROM conta_tarifas WHERE fk_id_almacen = $almacen AND fk_id_concepto = '$id_concepto' AND s_imp_exp = '$tipo'"));
      $POR_CADA = $consul["n_factor_1"];
      $IMPORTE = $consul["n_importe_1"];
      $MINIMO = $consul["importe_2"];

      $TANTOS_PESO = round($peso)/$POR_CADA;
      $RESTO_PESO = round($peso) % $POR_CADA;

      if($RESTO_PESO > 0 ){
         $TANTOS_PESO = $TANTOS_PESO + 1;
      }

      $IMPORTE = $IMPORTE * $TANTOS_PESO;

      if($IMPORTE >= $MINIMO ){
        $IMPORTE = $IMPORTE;
      }else{
        $IMPORTE = $MINIMO;
      }

    }
  }//fin 12



  //guardo tarifa
  $s_tipoDoc = 'ctaGastos';
  $s_seccion = 'almacen';
  if( $IMPORTE > 0 ){

    $query_insertConcepAlmacen = "INSERT INTO conta_tem_tarifas_calculoDetalle(
                                            fk_id_concepto,
                                            fk_id_tipo,
                                            s_descripcion,
                                            fk_id_almacen,
                                            fk_id_tarifa,
                                            fk_usuario,
                                            s_seccion,
                                            n_importe,
                                            fk_id_cuenta
                                          )values(?,?,?,?,?,?,?,?,?)";

    $stmt_insertConcepAlmacen = $db->prepare($query_insertConcepAlmacen);
    if (!($stmt_insertConcepAlmacen)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    $stmt_insertConcepAlmacen->bind_param('sssssssss',$id_concepto,
                                                  $tipoCalculo,
                                                  $descripcion,
                                                  $almacen,
                                                  $calculoTarifa,
                                                  $usuario,
                                                  $s_seccion,
                                                  $IMPORTE,
                                                  $fk_id_cuenta);
    if (!($stmt_insertConcepAlmacen)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding [$stmt_insertConcepAlmacen->errno]: $stmt_insertConcepAlmacen->error";
      exit_script($system_callback);
    }
    if (!($stmt_insertConcepAlmacen->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution [$stmt_insertConcepAlmacen->errno]: $stmt_insertConcepAlmacen->error";
      exit_script($system_callback);
    }
  }//fin guardar





}//fin while conceptos


?>
