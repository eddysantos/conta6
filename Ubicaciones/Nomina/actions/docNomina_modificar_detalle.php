<?PHP
//PERCEPCIONES ******************************************
$percepcion = $_POST['percepciones'];
foreach ($percepcion as $percep) {
  require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_variables.php';
  $tipoElemento = 'percepcion';
  $clasificacion = 'percepcion';

  $cta = $percep['cta'];
  $cve = $percep['cve'];
  $ordenRep = $percep['ordenRep'];

  $concepto	=	utf8_decode($percep['desc']);
  $importeGravado	=	$percep['gravado'];
  $importeExento	=	$percep['exento'];
  $idpartida = $percep['idpartida'];


  if( $idpartida > 0 ){
    require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_actualizar.php';
  }else{
    require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_insertar.php';
  }
}


$horasext = $_POST['horasextras'];
foreach ($horasext as $HE) {
  require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_variables.php';
  $tipoElemento = 'percepcion';
  $clasificacion = 'horasExtras';

  $cta = $HE['cta'];
  $cve = $HE['cve'];
  $ordenRep = $HE['ordenRep'];

  $concepto	=	utf8_decode($HE['desc']);
  $dias_horasExtra	=	$HE['dias'];
  $horasExtra	=	$HE['horas'];
  $importeGravado	=	$HE['gravado'];
  $importeExento	=	$HE['exento'];
  $importePagado	= $HE['gravado'] + $HE['exento'];
  $idpartida = $HE['idpartida'];

  if( $cta == '0530-00002' ){ $tipoHoras = '01'; } #DOBLES
  if( $cta == '0530-00003' ){ $tipoHoras = '02'; } #TRIPLES



  if( $idpartida > 0 ){
    require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_actualizar.php';
  }else{
    require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_insertar.php';
  }
}


$percepSepIndem = $_POST['percepSepIndem'];
foreach ($percepSepIndem as $sepIndem) {
  require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_variables.php';
  $tipoElemento = 'percepcion';
  $clasificacion = 'separacionIndemnizacion';

  $cta = $sepIndem['cta'];
  $cve = $sepIndem['cve'];
  $ordenRep = $sepIndem['ordenRep'];

  $concepto	=	utf8_decode($sepIndem['desc']);
  $importeGravado	=	$sepIndem['gravado'];
  $importeExento	=	$sepIndem['exento'];
  $idpartida = $sepIndem['idpartida'];


  if( $idpartida > 0 ){
    require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_actualizar.php';
  }else{
    require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_insertar.php';
  }
}


//OTROS PAGOS ******************************************
$otrospagos = $_POST['otrospagos'];
foreach ($otrospagos as $OP) {
  require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_variables.php';
  $tipoElemento = 'otrosPagos';
  $clasificacion = 'otrosPagos';

  $cta = $OP['cta'];
  $cve = $OP['cve'];
  $ordenRep = $OP['ordenRep'];

  $concepto	=	utf8_decode($OP['desc']);
  $importeExento	=	$OP['exento'];
  $subsidioCausado = $OP['subcausado'];

  $anio	=	$OP['anio'];
  $remanenteSalFav	=	$OP['saldofavor'];
  $idpartida = $OP['idpartida'];

  if( $idpartida > 0 ){
    require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_actualizar.php';
  }else{
    require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_insertar.php';
  }
}


//DEDUCCIONES ******************************************
$deduccion = $_POST['deducciones'];
foreach ($deduccion as $deduc) {
  require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_variables.php';
  $tipoElemento = 'deduccion';
  $clasificacion = 'deduccion';

  $cta = $deduc['cta'];
  $cve = $deduc['cve'];
  $ordenRep = $deduc['ordenRep'];

  $concepto	=	utf8_decode($deduc['desc']);
  $importeGravado	=	$deduc['gravado'];
  $importeExento	=	$deduc['exento'];
  $idpartida = $deduc['idpartida'];


  if( $idpartida > 0 ){
    require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_actualizar.php';
  }else{
    require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_insertar.php';
  }
}

$penalim = $_POST['penalim'];
foreach ($penalim as $PA) {
  require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_variables.php';
  $tipoElemento = 'deduccion';
  $clasificacion = 'desctoDespTotal';

  $cta = $PA['cta'];
  $cve = $PA['cve'];
  $ordenRep = $PA['ordenRep'];

  $concepto	=	utf8_decode($PA['desc']);
  $base	=	$PA['base'];
  $porcentaje = $PA['porcentaje'];
  $importeExento	=	$PA['exento'];
  $idpartida = $PA['idpartida'];


  if( $idpartida > 0 ){
    require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_actualizar.php';
  }else{
    require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_insertar.php';
  }
}




  //BORRAR ******************************************
  $borrar = $_POST['percepcionesDelete'];
  require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_borrar.php';

  $borrar = $_POST['otrospagosDelete'];
  require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_borrar.php';

  $borrar = $_POST['horasextrasDelete'];
  require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_borrar.php';

  $borrar = $_POST['percepSepIndemDelete'];
  require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_borrar.php';

  $borrar = $_POST['deduccionesDelete'];
  require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_borrar.php';

  $borrar = $_POST['penalimDelete'];
  require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_borrar.php';


  //TOTALES ******************************************
  $tipo = trim($_POST['tipo']);
  $indias = trim($_POST['indias']);
  $indescontar = trim($_POST['indescontar']);
  $inpagar = trim($_POST['inpagar']);
  $totvacaciones = trim($_POST['totvacaciones']);
  $totfaltas = trim($_POST['totfaltas']);
  $totpagar = trim($_POST['totpagar']);
  $totpercep = trim($_POST['totpercep']);
  $totdeduc = trim($_POST['totdeduc']);
  $tottotal = trim($_POST['tottotal']);
  $tototrospagos = trim($_POST['tototrospagos']);
  $totneto = trim($_POST['totneto']);
  $numAniosServicio	= trim($_POST['anioserv']);
  $ultimoSueldoMensOrd = trim($_POST['ultsuelmesord']);
  $ingresoAcumulable = trim($_POST['ingacum']);
  $ingresoNoAcumulable = trim($_POST['ingnoacum']);
  $totalPagado = trim($_POST['totalpagado']);

  require $root . '/conta6/Ubicaciones/Nomina/actions/docNomina_modificar_detalle_actualizar_totales.php';

?>
