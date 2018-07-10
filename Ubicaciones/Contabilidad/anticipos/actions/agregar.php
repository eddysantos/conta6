<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

  $id_anticipo = trim($_POST['anticipo']);
  $fecha = trim($_POST['fecha']);
  $referencia = trim($_POST['referencia']);
  $cuenta = trim($_POST['cuenta']);
  $id_cliente = trim($_POST['cliente']);
  $cargo = trim($_POST['cargo']);
  $abono = trim($_POST['abono']);
  $id_poliza = trim($_POST['id_poliza']);
  $desc = trim($_POST['descrip']);

  $query = "INSERT INTO conta_t_anticipos_det (fk_id_anticipo,d_fecha,fk_referencia,fk_id_cuenta,fk_id_cliente,s_desc,n_cargo,n_abono,fk_usuario)
            VALUES (?,?,?,?,?,?,?,?,?)";

  $stmt = $db->prepare($query);
  if (!($stmt)) {
    $system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmt->bind_param('sssssssss',$id_anticipo,$fecha,$referencia,$cuenta,$id_cliente,$desc,$cargo,$abono,$usuario);
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
  $partidaAnticipo = $db->insert_id;
/*
  $affected = $stmt->affected_rows;
  $system_callback['affected'] = $affected;
  $system_callback['datos'] = $_POST;
  $system_callback['datos'] = $partidaAnticipo;

  if ($affected == 0) {
    $system_callback['code'] = 2;
    $system_callback['message'] = "El query no hizo ningún cambio a la base de datos";
    exit_script($system_callback);
  }
*/


  $descripcion = "Se Inserto Detalle Anticipo: $id_anticipo Cta: $cuenta Ref:$referencia Clt:$id_cliente Des:$desc Cargo:$cargo Abono:$abono";

  $clave = 'anticipos';
  $folio = $id_anticipo;
  require $root . '/conta6/Resources/PHP/actions/registroAccionesBitacora.php';



  if( $id_poliza > 0 ){

    $idDocumento = 'anticipoDET';
    $queryDET = "INSERT INTO conta_t_polizas_det
    (fk_id_poliza,fk_id_cuenta,d_fecha,fk_tipo,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_anticipo,fk_cheque,fk_ctagastos,fk_factura,
    fk_pago,fk_nc,s_desc,n_cargo,n_abono,s_idDocumento,fk_idRegistro,fk_usuario)
    SELECT $id_poliza,fk_id_cuenta,d_fecha,fk_tipo,fk_referencia,fk_id_cliente,s_folioCFDIext,fk_id_anticipo,fk_cheque,fk_ctagastos,fk_factura,
    fk_pago,fk_nc,s_desc,n_cargo,n_abono,'$idDocumento',pk_partida,'$usuario'
    FROM conta_t_anticipos_det WHERE pk_partida = $partidaAnticipo";
    $stmtDET = $db->prepare($queryDET);
    if (!($stmtDET)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
      exit_script($system_callback);
    }
    if (!($stmtDET->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution [$stmtDET->errno]: $stmtDET->error";
      exit_script($system_callback);
    }
    $partidaPoliza = $db->insert_id;
    $rsltDET = $stmtDET->get_result();



    #'**************** DETALLE EN PARTIDAS DE LA POLIZA - CONTABILIDAD ELECTRONICA *******************************

      $queryCLT = "SELECT * FROM conta_replica_clientes WHERE pk_id_cliente = ?";
      $stmtCLT = $db->prepare($queryCLT);
      if (!($stmtCLT)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmtCLT->bind_param('s',$id_cliente);
      if (!($stmtCLT)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding [$stmtCLT->errno]: $stmtCLT->error";
        exit_script($system_callback);
      }
      if (!($stmtCLT->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution [$stmtCLT->errno]: $stmtCLT->error";
        exit_script($system_callback);
      }
      $rsltCLT = $stmtCLT->get_result();
      $rowCLT = $rsltCLT->fetch_assoc();
    	$rfcOri = trim($rowCLT["s_rfc"]);
    	$benefOri = trim($rowCLT["s_nombre"]);


      $queryANT = "SELECT * FROM conta_t_anticipos_mst WHERE pk_id_anticipo = ?";
      $stmtANT = $db->prepare($queryANT);
      if (!($stmtANT)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmtANT->bind_param('s',$id_anticipo);
      if (!($stmtANT)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding [$stmtANT->errno]: $stmtANT->error";
        exit_script($system_callback);
      }
      if (!($stmtANT->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution [$stmtANT->errno]: $stmtANT->error";
        exit_script($system_callback);
      }
      $rsltANT = $stmtANT->get_result();
      $rowANT = $rsltANT->fetch_assoc();
      $id_poliza = $rowANT["fk_id_poliza"];
      $bcoDest = $rowANT["s_bancoDest"];
    	$bcoOri = $rowANT["s_bancoOri"];
    	$ctaDest = $rowANT["s_ctaDest"];
    	$ctaOri = $rowANT["s_ctaOri"];


      $queryPOL = "SELECT * FROM conta_t_polizas_det WHERE fk_id_poliza = ? AND pk_partida = ?";
      $stmtPOL = $db->prepare($queryPOL);
      if (!($stmtPOL)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
        exit_script($system_callback);
      }
      $stmtPOL->bind_param('ss',$id_poliza,$partidaPoliza);
      if (!($stmtPOL)) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during variables binding [$stmtPOL->errno]: $stmtPOL->error";
        exit_script($system_callback);
      }
      if (!($stmtPOL->execute())) {
        $system_callback['code'] = "500";
        $system_callback['message'] = "Error during query execution [$stmtPOL->errno]: $stmtPOL->error";
        exit_script($system_callback);
      }
      $rsltPOL = $stmtPOL->get_result();
      //while($rowPOL = $rsltPOL->fetch_assoc()){
        $rowPOL = $rsltPOL->fetch_assoc();
        $partidaDoc = $rowPOL['pk_partida'];
        $tipo = $rowPOL['fk_tipo'];
    		$factura = $rowPOL['fk_factura'];
    		$notaCred = $rowPOL['fk_nc'];
    		$referencia = $rowPOL['fk_referencia'];
    		$id_poliza = $rowPOL['fk_id_poliza'];
        $tipoDetalle = 'Transferencia';

    		// Transferencia
        $queryTRANSFER = "INSERT INTO conta_t_polizas_det_contaelec
        (fk_id_poliza,fk_partidaPol,fk_tipo,s_tipoDetalle,s_BancoOri,s_ctaOri,s_BancoDest,s_CtaDest,d_fecha,s_Beneficiario,s_RFC,n_monto,s_usuario_modifi,s_BeneficiarioOpc,s_RFCopc)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmtTRANSFER = $db->prepare($queryTRANSFER);
        if (!($stmtTRANSFER)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query prepare [$db->errno]: $db->error";
          exit_script($system_callback);
        }
        $stmtTRANSFER->bind_param('sssssssssssssss',$id_poliza,$partidaDoc, $tipo,$tipoDetalle,$bcoOri,$ctaOri,$bcoDest,$ctaDest,$fecha,$benefOri,$rfcOri,$importe,$usuario,$nombreCIA,$rfcCIA);
        if (!($stmtTRANSFER)) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during variables binding [$stmtTRANSFER->errno]: $stmtTRANSFER->error";
          exit_script($system_callback);
        }
        if (!($stmtTRANSFER->execute())) {
          $system_callback['code'] = "500";
          $system_callback['message'] = "Error during query execution [$stmtTRANSFER->errno]: $stmtTRANSFER->error";
          exit_script($system_callback);
        }
        $rsltTRANSFER = $stmtTRANSFER->get_result();
      //}

  }
  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);



?>
