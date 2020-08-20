<?PHP
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Resources/PHP/Utilities/initialScript.php';

  $fecha = trim($_POST['fecha']);
  $cuenta = trim($_POST['cuenta']);
  $cheque = trim($_POST['cheque']);
  $importe = trim($_POST['importe']);
  $concepto = trim($_POST['concepto']);
  $opcion = trim($_POST['opcion']);
  $idOrd  = trim($_POST['id_expedidor']);

  $fechaDoc = date_format(date_create($fecha),'Y-m-d');

  //revisando cheque duplicado
  $queryChequeExiste = "SELECT * FROM conta_t_cheques_mst WHERE pk_id_cheque = ? AND fk_id_cuentaMST = ?";

  $stmtChequeExiste = $db->prepare($queryChequeExiste);
  if (!($stmtChequeExiste)) {
  	$system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare EX[$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmtChequeExiste->bind_param('ss', $cheque,$cuenta);
  if (!($stmtChequeExiste)) {
  	$system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding EX[$stmtChequeExiste->errno]: $stmtChequeExiste->error";
    exit_script($system_callback);
  }

  if (!($stmtChequeExiste->execute())) {
  	$system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution EX[$stmtChequeExiste->errno]: $stmtChequeExiste->error";
    exit_script($system_callback);
  }

  $rsltChequeExiste = $stmtChequeExiste->get_result();
  $rowsChequeExiste = $rsltChequeExiste->num_rows;

  if ($rsltChequeExiste->num_rows > 0) {
    $system_callback['code'] = "500";
    $system_callback['data'] ="EL CHEQUE $cheque YA EXISTE CON LA CUENTA $cuenta";
    $system_callback['message'] = "Cheque Existe";
    exit_script($system_callback);
  }

  //nombre y rfc correspondiente
  if( $opcion == "BEN" ){ $queryDatosOrdenante = "SELECT s_nombre,s_rfc FROM conta_cs_beneficiarios WHERE pk_id_benef = ?" ;}
  if( $opcion == "CLT" ){ $queryDatosOrdenante = "SELECT s_nombre,s_rfc FROM conta_replica_clientes WHERE pk_id_cliente = ?" ;}
  if( $opcion == "EMPL" ){ $queryDatosOrdenante = "SELECT CONCAT(s_nombre,' ',s_apellidoP,' ',s_apellidoM) AS s_nombre, s_rfc FROM conta_cs_empleados where pk_id_empleado = ?" ;}
  if( $opcion == "PROV" ){ $queryDatosOrdenante = "SELECT s_nombre,s_rfc FROM conta_cs_proveedores WHERE pk_id_proveedor = ?" ;}
  $stmtDatosOrdenante = $db->prepare($queryDatosOrdenante);
  if (!($stmtDatosOrdenante)) { die("Error during query prepare [$db->errno]: $db->error");	}
  $stmtDatosOrdenante->bind_param('s',$idOrd);
  if (!($stmtDatosOrdenante)) { die("Error during query prepare [$stmtDatosOrdenante->errno]: $stmtDatosOrdenante->error");	}
  if (!($stmtDatosOrdenante->execute())) { die("Error during query prepare [$stmtDatosOrdenante->errno]: $stmtDatosOrdenante->error"); }
  $rsltDatosOrdenante = $stmtDatosOrdenante->get_result();
  $rowDatosOrdenante = $rsltDatosOrdenante->fetch_assoc();
  $nomOrd = $rowDatosOrdenante['s_nombre'];
  $rfcOrd = $rowDatosOrdenante['s_rfc'];

  //guardando cheque
  $queryInsert = "INSERT INTO conta_t_cheques_mst (pk_id_cheque,fk_id_cuentaMST,d_fechache,s_tipoOrdenante,fk_idOrd,s_nomOrd,n_valor,fk_usuario,fk_id_aduana,s_concepto,s_rfc )
                  VALUES(?,?,?,?,?,?,?,?,?,?,?)";

  $stmtInsert = $db->prepare($queryInsert);
  if (!($stmtInsert)) {
  	$system_callback['code'] = "500";
    $system_callback['message'] = "Error during query prepare EX[$db->errno]: $db->error";
    exit_script($system_callback);
  }

  $stmtInsert->bind_param('sssssssssss',$cheque,$cuenta,$fechaDoc,$opcion,$idOrd,$nomOrd,$importe,$usuario,$aduana,$concepto,$rfcOrd);
  if (!($stmtInsert)) {
  	$system_callback['code'] = "500";
    $system_callback['message'] = "Error during variables binding EX[$stmtInsert->errno]: $stmtInsert->error";
    exit_script($system_callback);
  }

  if (!($stmtInsert->execute())) {
  	$system_callback['code'] = "500";
    $system_callback['message'] = "Error during query execution EX[$stmtInsert->errno]: $stmtInsert->error";
    exit_script($system_callback);
  }

  //$nFolio = $db->insert_id;
  $nFolio = $cheque;


  $descripcion = "Se Genero el Cheque: $nFolio cuentaMST:$cuenta Concepto: $concepto Fecha: $fechaDoc Valor: $importe ExpedidoA: $opcion $idOrd $nomOrd $rfcOrd";
  $clave = 'cheques';
  $folio = $nFolio;
  require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';


  $system_callback['data'] .= $nFolio;
  $system_callback['code'] = 1;
  $system_callback['message'] = "Script called successfully!";
  exit_script($system_callback);

?>
