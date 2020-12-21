<?PHP
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/Resources/PHP/Utilities/initialScript.php';

	$poliza  = trim($_POST['id_poliza']);
  $cliente  = trim($_POST['id_cliente']);
  $nombre = trim($_POST['nombre']);
  $fecha_pol  = trim($_POST['fecha']);
	$tipo  = trim($_POST['tipo']);
	$referencia  = trim($_POST['referencia']);
  $factura  = trim($_POST['factura']);
  $ctagastos = trim($_POST['ctagastos']);
  $notaCred = trim($_POST['nc']);
  $saldo  = trim($_POST['saldo']);
  $pago  = trim($_POST['pago']);
  $cuenta = trim($_POST['cuenta']);
  $accion  = trim($_POST['accion']);
	$doc = 0;
  $gastoOficina = 0;
  $proveedor = 0;
	$anticipo = 0;
	$cheque = 0;
	$cargo = 0;
	$abono = 0;


  $id_poliza = $poliza;
  $fecha = $fecha_pol;
  $id_referencia = $referencia;
  $id_cliente = $cliente;
  $documento = $doc;


  $cta106 = '0106-'; #Cuentas y documentos por cobrar a corto plazo
	$cta108 = '0108-'; #CLIENTE
	$cta203 = '0203-'; #Documentos y cuentas por pagar a corto
	$busCta106 = strpos($cuenta, $cta106);
	$busCta108 = strpos($cuenta, $cta108);
	$busCta203 = strpos($cuenta, $cta203);

	if ($busCta106 !== false) {
		$desc = $nombre;
	}

	if ($busCta108 !== false || $busCta203 !== false) {
		$desc = "PAGO ".$nombre;
	}

  #************************************************
	#* BUSCO LA CUENTA 0208 DEL CLIENTE             *
	#************************************************
  $id_cliente = $cliente;
  require $root . '/Resources/PHP/actions/consultaCtas108y208_cliente.php';
  if( $rows_ctasCliente > 0 ){
    while($row_ctasCliente = $rslt_ctasCliente->fetch_assoc()){
      $cta = $row_ctasCliente['pk_id_cuenta'];
      if( strpos($cta,'0208-') !==  false ){ $idcta208 = $cta; }
    }
  }

  #******************************
  #* CALCULO PARA CARGO Y ABONO *
  #******************************

  if( $saldo < 0 ){
    if( $pago <> 0 ){
      $cargo = abs($pago);
    }else{
      $cargo = abs($saldo);
    }
  }

  if( $saldo > 0 ){
    if( $pago <> 0 ){
      $abono = abs($pago);
    }else{
      $abono = abs($saldo);
    }
  }


  if( $accion == "insertar" ){
    if( $factura > 0 ){
      $id_factura = $factura;
      require $root . '/Resources/PHP/actions/consultarFactura_idFactura.php';
      $metodoDePago = $row_consultaFactura['fk_c_MetodoPago'];
  		$Total_POCME = $row_consultaFactura['n_total_POCME'];
  		$Total_Pagos = $row_consultaFactura['n_total_pagos'];
  		$totalPagosCLT = $Total_POCME + $Total_Pagos;

      if( $metodoDePago == 'PPD' && $totalPagosCLT == 0 ){ #agregado 17-abril-2019

        $cuenta = $idcta208;
        require $root . '/Resources/PHP/actions/insertaDetallePoliza.php';
        $pk_partida = mysqli_insert_id($db);
		  }else{

        require $root . '/Resources/PHP/actions/insertaDetallePoliza.php';
        $pk_partida = mysqli_insert_id($db);

        if ($busCta108 !== false && $abono > 0){

  				$impPago = $abono;

  				#IVA no cobrado al 16%
          require $root . '/Resources/PHP/actions/consulta_ivaNoCobrado16.php';
          $rslt_ivaNoCobrado16 = $stmt_ivaNoCobrado16->get_result();

          if ($rslt_ivaNoCobrado16->num_rows > 0) {
            $row_ivaNoCobrado16 = $rslt_ivaNoCobrado16->fetch_assoc();
              $cargo = $row_ivaNoCobrado16['saldo'];
              $abono = 0;
              $cuenta = '0202-00007';
              require $root . '/Resources/PHP/actions/insertaDetallePoliza.php';
              $pk_partida = mysqli_insert_id($db);

              $cargo = 0;
              $abono = $row_ivaNoCobrado16['saldo'];
              $cuenta = '0202-00002';
              require $root . '/Resources/PHP/actions/insertaDetallePoliza.php';
              $pk_partida = mysqli_insert_id($db);
          }


          #IVA no cobrado al 8%
          require $root . '/Resources/PHP/actions/consulta_ivaNoCobrado8.php';
          $rslt_ivaNoCobrado8 = $stmt_ivaNoCobrado8->get_result();

          if ($rslt_ivaNoCobrado8->num_rows > 0) {
            $row_ivaNoCobrado8 = $rslt_ivaNoCobrado8->fetch_assoc();
              $cargo = $row_ivaNoCobrado8['saldo'];
              $abono = 0;
              $cuenta = '0202-00009';
              require $root . '/Resources/PHP/actions/insertaDetallePoliza.php';
              $pk_partida = mysqli_insert_id($db);

              $cargo = 0;
              $abono = $row_ivaNoCobrado8['saldo'];
              $cuenta = '0202-00008';
              require $root . '/Resources/PHP/actions/insertaDetallePoliza.php';
              $pk_partida = mysqli_insert_id($db);
          }


          #IVA retenido por cobrar
          require $root . '/Resources/PHP/actions/consulta_ivaRetenidoNoCobrado.php';
          $rslt_ivaRetenidoNoCobrado = $stmt_ivaRetenidoNoCobrado->get_result();

          if ($rslt_ivaRetenidoNoCobrado->num_rows > 0) {
            require $root . '/Resources/PHP/actions/consulta_saldoFactura.php';
            $rslt_saldoFactura = $stmt_saldoFactura->get_result();

            $porciento = 51;
  					$impFactura = $rslt_saldoFactura['saldo'];
  					$porcentajeFact = $impFactura*$porciento/100;

            if($impPago >= $impFactura && $impPago >= $porcentajeFact){
  						$rslt_ivaRetenidoNoCobrado = $stmt_ivaRetenidoNoCobrado->get_result();

  						$cargo = 0;
  						$abono = abs($rslt_ivaRetenidoNoCobrado['saldo']);
  						if( $abono > 0 ){
                #por cobrar
                $cuenta = '0216-00001';
                require $root . '/Resources/PHP/actions/insertaDetallePoliza.php';
                $pk_partida = mysqli_insert_id($db);

                #no cobrado
  							$cargo = abs($rslt_ivaRetenidoNoCobrado['saldo']);
  							$abono = 0;
                $cuenta = '0216-00002';
                require $root . '/Resources/PHP/actions/insertaDetallePoliza.php';
                $pk_partida = mysqli_insert_id($db);

  						}
  					}
          }


        }#if ($busCta108 !== false && $abono > 0){
      }#$metodoDePago == 'PUE'
    } #$factura > 0


    #******************************************************
    # PARA LA CUENTA DE GASTOS SE TOMA EL (SALDO DE LA FACTURA - PAGOS POR CUENTA DEL CLIENTE) 7,969.25	- 5,185.25 = 2,784.00
    #******************************************************
    if( $ctagastos > 0 ){

      $saldoCtaGastos = abs($row_consultaFactura['n_fac_saldo']);

      if( $busCta203 === false){
        if($total_consultaFactura > 0 ){
          $total = $saldoCtaGastos - $saldo;
          $cargo2 = 0;

          if( $saldoCtaGastos > 0 && $total > 0 ){
            $cargo = $cargo2;
            $abono = $total;
            $cuenta = $idcta208;
            require $root . '/Resources/PHP/actions/insertaDetallePoliza.php';
            $pk_partida = mysqli_insert_id($db);
          }
        }
      }

      if( $busCta203 !== false){
        if($total_consultaFactura > 0 ){
          $total = $saldoCtaGastos - $saldo;
          $cargo2 = 0;
          if( $saldoCtaGastos > 0 && $total > 0 ){
            $cargo = $cargo2;
            $abono = $total;
            $cuenta = $idcta208;
            require $root . '/Resources/PHP/actions/insertaDetallePoliza.php';
            $pk_partida = mysqli_insert_id($db);
          }

        }
      }

    }#$ctagastos > 0

    // INFORMACION ADICIONAL - Contabilidad Electrónica
    if( $notaCred > 0 ){
      require $root . '/Resources/PHP/actions/consultaNotaCreditoCapturaTimbrada.php';

      $tipoInf = 'CompNal';
      $RFC = $row_ncCaptTim['s_rfc'];
      $UUID_CFDI = $row_ncCaptTim['s_UUID'];
      $importe = $row_ncCaptTim['n_importeNC'];

      $fk_id_poliza = $poliza;
      $partidaDoc = $pk_partida;
      $UUID = $UUID_CFDI;
      $beneficiarioOpc = $nombre;
      $moneda = 'MXN';
      $tipoCamb = 1;
      require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
    }else{
      if( ($factura > 0 && $ctagastos == 0) || ($factura > 0 && $ctagastos > 0) ){
        $id_captura = $row_consultaFactura['pk_id_cuenta_captura'];
        require $root . '/Resources/PHP/actions/consultaFacturaTimbrada.php'; #$s_UUID

        $tipoInf = 'CompNal';
        $RFC = $row_consultaFactura['s_rfc'];
        $UUID_CFDI = $s_UUID;
        $importe = $row_consultaFactura['n_total_honorarios'];

        $fk_id_poliza = $poliza;
        $partidaDoc = $pk_partida;
        $UUID = $UUID_CFDI;
        $beneficiarioOpc = $nombre;
        $moneda = 'MXN';
        $tipoCamb = 1;
        require $root . '/Resources/PHP/actions/contaElect_insertaCompNal.php';
      }
    }
    // TERMINA INFORMACION ADICIONAL


    $system_callback['data'] = 'Generado';
    $system_callback['code'] = 1;
    $system_callback['message'] = "Script called successfully!";
    exit_script($system_callback);

    $descripcion = "Se agrego desde btnBuscarFacturas: Poliza: $poliza Referencia: $referencia Factura: $factura CtaGastos: $ctagastos Cuenta:$cuenta Cargo: $cargo Abono: $abono ";

  }#$accion == "insertar"


  if( $accion == "borrar" ){
    $queryBorrar = "DELETE FROM conta_t_polizas_det
                    WHERE fk_referencia = ? and fk_id_cuenta = ? AND d_fecha = ? and fk_factura = ? and n_cargo = ? and n_abono = ? and fk_id_poliza = ?";

    $stmtBorrar = $db->prepare($queryBorrar);
    if (!($stmtBorrar)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query prepare EX[$db->errno]: $db->error";
      exit_script($system_callback);
    }

    $stmtBorrar->bind_param('sssssss',$referencia,$cuenta,$fecha_pol,$factura,$cargo,$abono,$poliza);
    if (!($stmtBorrar)) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during variables binding EX[$stmtBorrar->errno]: $stmtBorrar->error";
      exit_script($system_callback);
    }

    if (!($stmtBorrar->execute())) {
      $system_callback['code'] = "500";
      $system_callback['message'] = "Error during query execution EX[$stmtBorrar->errno]: $stmtBorrar->error";
      exit_script($system_callback);
    }

    $system_callback['data'] = 'Borrado';
    $system_callback['code'] = 1;
    $system_callback['message'] = "Script called successfully!";
    exit_script($system_callback);

    $descripcion = "Se borro desde btnBuscarFacturas: Poliza: $poliza Referencia: $referencia Factura: $factura CtaGastos: $ctagastos Cuenta:$cuenta Cargo: $cargo Abono: $abono ";
  }

  $clave = 'polizas';
  $folio = $poliza;
  require $root . '/Resources/PHP/actions/registroAccionesBitacora.php';

?>
