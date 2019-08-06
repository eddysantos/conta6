<?PHP
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';

  $fecha = trim($_POST['fecha']);
  $fechaFac = trim($_POST['fechaFac']);


  $fecha_generar = strtotime(date_format(date_create($fecha),"Y/m/d"));
  $fecha_factura = strtotime(date_format(date_create($fechaFac),"Y/m/d"));
  $fechaActual = date("Y/m/d");
  $fechaActual = strtotime(date_format(date_create($fechaActual),"Y/m/d"));
  $fecha_Actual = date_format(date_create($fechaActual),"Y/m/d");

  if( $fecha_generar >= $fecha_factura && $fecha_generar <= $fechaActual ){
    $system_callback['code'] = "1";
  	exit_script($system_callback);
	}else{
    #la fecha de un pago debe ser posterior o igual a la fecha de facturacion.
    #La fecha capturada no debe mayor a la fecha actual.
    #No se puede emitir un pago con fecha anterior a la de facturacion ni posterior a la fecha actual.
    if( $fecha_factura >= $fecha_generar){
      $mensaje = "Capture fecha posterior o igual a la de facturación";
    }elseif($fecha_generar >= $fechaActual ){
      $mensaje = "Capture fecha actual";
    }
    $system_callback['code'] = "500";
    $system_callback['message'] = $mensaje;
  	exit_script($system_callback);
	}


?>
