<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

/***********************************************
   CUENTAS DE PRIMER NIVEL - CUENTA MAESTRA
************************************************/
$accion = trim($_POST['accion']);



if( $accion == 'MST' ){

  $Tipo = trim($_POST['tipo']);
  $s_cta_nivel = '1';

  $query = "INSERT INTO conta_cs_cuentas_mst (pk_id_cuenta,
                        s_cta_desc,s_cta_tipo,s_cta_nivel,
                        fk_codAgrup,fk_id_naturaleza,s_usuario_alta)
            VALUES (?,?,?,?,?,?,?)";

  $stmt = $db->prepare($query);
  if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmt->bind_param('sssssss',$Cta_Mta,$Descripcion_Cta,$Tipo,$s_cta_nivel,$ctaSAT,$natur,$usuario);
  if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
    exit_script($system_callback);
  }

  if (!($stmt->execute())) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
    exit_script($system_callback);
  }


  $affected = $stmt->affected_rows;
  $system_callback['affected'] = $affected;
  $system_callback['datos'] = $_POST;

  if ($affected == 0) {
    $system_callback['code'] = 2;
    $system_callback['message'] = "El query no hizo ningún cambio a la base de datos";
    exit_script($system_callback);
  }


  $descripcion = "Se Genero la Cuenta Maestra: $Cta_Mta, $Descripcion_Cta";
  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  // exit_script($system_callback);

} // fin de agregar cuenta maestra de primer grado

function consultaTipo($db,$Cta_Mta){
  $sql_ctaTipo = mysqli_fetch_array(mysqli_query($db,"SELECT s_cta_tipo FROM conta_cs_cuentas_mst WHERE pk_id_cuenta = '$Cta_Mta'"));
  $Tipo = $sql_ctaTipo['s_cta_tipo'];
  return $Tipo;
}

function consultaCodAgrup($db,$Cta_Mta){
  $sql_ctaCodAgrup = mysqli_fetch_array(mysqli_query($db,"SELECT fk_codAgrup FROM conta_cs_cuentas_mst WHERE pk_id_cuenta = '$Cta_Mta'"));
  $codAgrup = $sql_ctaCodAgrup['fk_codAgrup'];
  return $codAgrup;
}

function consultaNaturaleza($db,$Cta_Mta){
  $sql_ctaNatur = mysqli_fetch_array(mysqli_query($db,"SELECT fk_id_naturaleza FROM conta_cs_cuentas_mst WHERE pk_id_cuenta = '$Cta_Mta'"));
  $naturaleza = $sql_ctaNatur['fk_id_naturaleza'];
  return $naturaleza;
}

function folioCtaDET($db,$Cta_Mta){
  $PARTE = substr($Cta_Mta,0,5);

  #--Se obtiene la ultima cuenta dada de alta
  $cta = mysqli_fetch_array(mysqli_query($db,"SELECT MAX(pk_id_cuenta) as pk_id_cuenta FROM conta_cs_cuentas_mst Where pk_id_cuenta like '$PARTE%'"));
  $ULTIMA_CTA = $cta['pk_id_cuenta'];

  #--Se Obtiene el numero de la cuenta
  $ULTIMA_CTA = substr($ULTIMA_CTA,5,10);

  #--Se obtiene el nuevo folio para la nueva cuenta
  $FOLIO = $ULTIMA_CTA + 1;
  $FOLIO = str_pad($FOLIO,5,"0",STR_PAD_LEFT);
  $CUENTA_DETALLE_ID = $PARTE.$FOLIO;

  return $CUENTA_DETALLE_ID;

}

/***********************************************
   CUENTAS DE SEGUNDO NIVEL - CUENTA DETALLE
************************************************/

if( $accion == 'DET' ){
  // $ctaSAT = trim($_POST['ctaSAT']);
  // $natur = trim($_POST['naturSAT']);
  // $Cta_Mta = trim($_POST['ctamaestra']);
  // $Descripcion_Cta = $_POST['concepto'];
  $s_cta_nivel = '2';
  $Tipo = consultaTipo($db,$Cta_Mta);
  $opcionCta = 'general';

  if( $Cta_Mta == '0206-00000' ){ $opcionCta = 'proveedor'; }
  if( $Cta_Mta == '0115-00000' ){ $opcionCta = 'deudores'; }
  if( $Cta_Mta == '0100-00000' || $Cta_Mta == '0101-00000' ){ $opcionCta = 'bancos'; }

	if( $opcionCta == 'general'){ # Alta de todas las cuentas

    $CUENTA_DETALLE_ID = folioCtaDET($db,$Cta_Mta);
    $query = "INSERT INTO conta_cs_cuentas_mst (pk_id_cuenta,s_cta_desc,s_cta_tipo,
                          s_cta_nivel,fk_codAgrup,fk_id_naturaleza,
                          s_usuario_alta,s_subctaDe)
              VALUES (?,?,?,?,?,?,?,?)";

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare GRAL [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    $stmt->bind_param('ssssssss',$CUENTA_DETALLE_ID,$Descripcion_Cta,$Tipo,$s_cta_nivel,$ctaSAT,$natur,$usuario,$Cta_Mta);
    if (!($stmt)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding GRAL [$stmt->errno]: $stmt->error";
      exit_script($system_callback);
    }
    if (!($stmt->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
      exit_script($system_callback);
    }
    $descripcion = "Se Generaro la Cuenta de Detalle: $CUENTA_DETALLE_ID  $Descripcion_Cta, de la cuenta MST $Cta_Mta";
  } // fin de cuenta general

  if( $opcionCta == 'proveedor' ){ # Alta de la cuenta de proveedor
		$prov = trim($_POST['prov']);
		$Cta_Mta_parte = '0206-';
		$CUENTA = $Cta_Mta_parte.str_pad($prov,5,"0",STR_PAD_LEFT);
		$CUENTA_tipo = consultaTipo($db,$Cta_Mta);
		$identificador_tipo = 'proveedor';

		$query = "INSERT INTO conta_cs_cuentas_mst(pk_id_cuenta,s_cta_desc,s_cta_tipo,
                          s_cta_nivel,s_cta_identificador,s_cta_identificador_tipo,
		                      fk_codAgrup,fk_id_naturaleza,s_usuario_alta,s_subctaDe)
			      	VALUES (?,?,?,?,?,?,?,?,?,?)";

		$stmt = $db->prepare($query);
	  if (!($stmt)) {
  		$system_callback['code'] = "500";
  		$system_callback['message'] = "Error during query prepare PROV [$db->errno]: $db->error";
  		exit_script($system_callback);
		}

		$stmt->bind_param('ssssssssss',$CUENTA,$Descripcion_Cta,$CUENTA_tipo,$s_cta_nivel,$prov,$identificador_tipo,$ctaSAT,$natur,$usuario,$Cta_Mta);
		if (!($stmt)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during variables binding PROV [$stmt->errno]: $stmt->error";
			exit_script($system_callback);
		}

		if (!($stmt->execute())) {
		  $system_callback['code'] = "500";
		  $system_callback['message'] = "Error during query execution PROV [$stmt->errno]: $stmt->error";
		  exit_script($system_callback);
		}
		$descripcion = "Se Generaro la Cuenta de Detalle: $CUENTA  $Descripcion_Cta, de la cuenta MST $Cta_Mta";
	}

	if( $opcionCta == 'deudores' ){ # Alta de cuentas de los deudores
	  $identID = trim($_POST['identID']);
	  $identTipo = trim($_POST['identTipo']);
    $CUENTA_DETALLE_ID = folioCtaDET($db,$Cta_Mta);

    $query = "INSERT INTO conta_cs_cuentas_mst(pk_id_cuenta,s_cta_desc,s_cta_tipo,s_cta_nivel,
                          s_cta_identificador_tipo,s_cta_identificador,fk_codAgrup,
                          fk_id_naturaleza,s_usuario_alta,s_subctaDe)
              VALUES (?,?,?,?,?,?,?,?,?,?)";

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare 0115 [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    $stmt->bind_param('ssssssssss',$CUENTA_DETALLE_ID,$Descripcion_Cta,$Tipo,$s_cta_nivel,$identTipo,$identID,$ctaSAT,$natur,$usuario,$Cta_Mta);
    if (!($stmt)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding 0115 [$stmt->errno]: $stmt->error";
      exit_script($system_callback);
    }
    if (!($stmt->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
      exit_script($system_callback);
    }
    $descripcion = "Se Generaro la Cuenta de Detalle: $CUENTA_DETALLE_ID  $Descripcion_Cta, de la cuenta MST $Cta_Mta";
  }


  if( $opcionCta == 'bancos' ){ # Alta de cuentas bancarias de la CIA
    $banSAT = trim($_POST['banSAT']);
	  $nomBcoExt = trim($_POST['nomBcoExt']);
    $noCuenta = trim($_POST['noCuenta']);
    $oficinaAsignar = trim($_POST['oficinaAsignar']);
    $obser = $_POST['obser'];
    $CUENTA_DETALLE_ID = folioCtaDET($db,$Cta_Mta);

    $query = "INSERT INTO conta_cs_cuentas_mst(pk_id_cuenta,s_cta_desc,fk_id_banco,s_ctaBancaria,fk_id_aduana,
                          s_cta_tipo,s_cta_nivel,fk_codAgrup,fk_id_naturaleza,s_usuario_alta,s_subctaDe)
              VALUES (?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = $db->prepare($query);
    if (!($stmt)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
      exit_script($system_callback);
    }

    $stmt->bind_param('sssssssssss',$CUENTA_DETALLE_ID,$Descripcion_Cta,$banSAT,$noCuenta,$oficinaAsignar,
	                                  $Tipo,$s_cta_nivel,$ctaSAT,$natur,$usuario,$Cta_Mta);
    if (!($stmt)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
      exit_script($system_callback);
    }

    if (!($stmt->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
      exit_script($system_callback);
    }

    $descripcion = "Se Generaro la Cuenta de Detalle: $CUENTA_DETALLE_ID  $Descripcion_Cta, de la cuenta MST $Cta_Mta";

	  # se agrega la cuenta de banco a la lista de bancos de la CIA
	  $CUENTA_DETALLE_ID = folioCtaDET($db,$Cta_Mta);

    mysqli_query($db,"INSERT INTO conta_cs_bancos_cia (fk_id_banco, s_nombre, s_RFC, s_ctaOri, fk_id_cuenta, fk_id_aduana, s_obervaciones, fk_usuario_alta) VALUES ('$banSAT', '$Descripcion_Cta', '$rfcCIA','$noCuenta','$CUENTA_DETALLE_ID','$oficinaAsignar','$obser','$usuario')");
  }


  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!".$descripcion;
  // exit_script($system_callback);
} // fin cuentas de segundo nivel



/***********************************************
   CUENTAS DE SEGUNDO NIVEL - CUENTAS DEL CLIENTE
************************************************/

if( $accion == 'cliente' ){

  $cliente = trim($_POST['cliente']);
  $identificador_tipo = 'cliente';
  $s_cta_nivel = '2';

	$sql_nomCliente = mysqli_fetch_array(mysqli_query($db,"SELECT s_nombre FROM conta_replica_clientes WHERE pk_id_cliente = '$cliente'"));
	$NOM_CLI = trim($sql_nomCliente['s_nombre']);

  for ($i = 1; $i <= 4; $i++) {
    if($i == 1){ $Cta_Mta = '0108-00000'; $Cta_Mta_parte = '0108-'; $codAgrup="105.01";}
		if($i == 2){ $Cta_Mta = '0208-00000'; $Cta_Mta_parte = '0208-'; $codAgrup="206.01";}
		if($i == 3){ $Cta_Mta = '0106-00000'; $Cta_Mta_parte = '0106-'; $codAgrup="106.01";}
		if($i == 4){ $Cta_Mta = '0203-00000'; $Cta_Mta_parte = '0203-'; $codAgrup="202.03";}

		$CUENTA = str_replace("CLT_","",$cliente);
		$CUENTA = $Cta_Mta_parte.str_pad($CUENTA,5,"0",STR_PAD_LEFT);
		$CUENTA_tipo = consultaTipo($db,$Cta_Mta);
		$naturaleza = consultaNaturaleza($db,$Cta_Mta);

		$query = "INSERT INTO conta_cs_cuentas_mst (pk_id_cuenta,s_cta_desc,s_cta_tipo,s_cta_nivel,s_cta_identificador,
                          s_cta_identificador_tipo,fk_codAgrup,fk_id_naturaleza,s_usuario_alta,s_subctaDe)
		        	VALUES (?,?,?,?,?,?,?,?,?,?)";

		$stmt = $db->prepare($query);
	  if (!($stmt)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
			exit_script($system_callback);
		}

		$stmt->bind_param('ssssssssss',$CUENTA,$NOM_CLI,$CUENTA_tipo,$s_cta_nivel,$cliente,$identificador_tipo,$codAgrup,$naturaleza,$usuario,$Cta_Mta);
		  if (!($stmt)) {
			$system_callback['code'] = "500";
			$system_callback['message'] = "Error during variables binding [$stmt->errno]: $stmt->error";
			exit_script($system_callback);
		}

		if (!($stmt->execute())) {
		  $system_callback['code'] = "500";
		  $system_callback['message'] = "Error during query execution [$stmt->errno]: $stmt->error";
		  exit_script($system_callback);
		}

		$descripcion = "Se Generaro la Cuenta de Detalle(108,208,106,203) del cliente: $cliente  $NOM_CLI";
	}

  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!".$descripcion;
}

//HISTORIAL
$clave = 'admonCtas';
$folio = $Cta_Mta;
require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

exit_script($system_callback);


?>
