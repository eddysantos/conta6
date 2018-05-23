<?PHP
$_SESSION['user_name'] = 'admado';
$usuario = $_SESSION['user_name'];
$oficina = 470;

$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Databases/conexion.php';
require $root . '/conta6/Resources/PHP/actions/consultaPermisos.php';
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

$fecha = trim($_POST['diafecha']);
$concepto = trim($_POST['diaconcepto']);

#'**********************************************
	#'* PERMITE GENERAR POLIZAS DE CUALQUIER FECHA *
	#'**********************************************
	//$oRst_permisos = mysqli_fetch_array(mysqli_query($db,"select generar_x_fecha_polizas from TBL_Empleados_Internet where usuario = '$usuario'"));

		#*******************
		#* FECHA DE CIERRE *
		#*******************
		$oRst_Cierre = mysqli_fetch_array(mysqli_query($db,"SELECT d_fecha_inicial,d_fecha_final
						  FROM conta_t_documento_cierre
						  WHERE fk_id_tipo = 4 AND fk_id_aduana = '$oficina'
						  ORDER BY pk_id_cierre DESC
						  LIMIT 1 "));

		$fecha_inicial = strtotime(date_format(date_create($oRst_Cierre["fecha_inicial"]),"Y/m/d"));
		$fecha_final = strtotime(date_format(date_create($oRst_Cierre["fecha_final"]),"Y/m/d"));
		$fecha_generar = strtotime(date_format(date_create($fecha),"Y/m/d"));

	if( $oRst_permisos["s_generar_x_fecha_polizas"] == 1 ) {
			generarPoliza($db,$concepto,$usuario,$oficina,$fecha);
 	}else{
		if( $fecha_generar >= $fecha_inicial and $fecha_generar <= $fecha_final ){
			generarPoliza($db,$concepto,$usuario,$oficina,$fecha);
		}else{
			$fecha_inicial = date_format(date_create($oRst_Cierre["fecha_inicial"]),"d-m-Y");
			$fecha_final = date_format(date_create($oRst_Cierre["fecha_final"]),"d-m-Y");
			echo "<b>Error - Fecha Incorrecta. Solo puede registrar del <br><b>".$fecha_inicial."<br>al<br>".$fecha_final;
	 	} #* FIN VALIDAR FECHA
	} #* FIN GENERAR CON CUALQUIER FECHA


	function generarPoliza($db,$concepto,$usuario,$oficina,$fecha){
    $fechaDoc = date_format(date_create($fecha),'Y-m-d');

  	mysqli_query($db,"INSERT INTO conta_t_polizas_mst (d_fecha,fk_usuario,fk_id_aduana,s_concepto)
  			VALUES ('$fechaDoc','$usuario','$oficina','$concepto')");

     echo $nFolio = mysqli_insert_id($db);


     $descripcion = "Se Genero la Poliza: $nFolio";
     $clave = 'polizas';
     $folio = $nFolio;
     require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';


	}

?>
