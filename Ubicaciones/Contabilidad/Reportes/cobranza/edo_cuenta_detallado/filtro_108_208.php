<?php
#http://localhost:88/Ubicaciones/Contabilidad/Reportes/cobranza/edo_cuenta_detallado/filtro_108_208.php?numreporte=10&Fecha_Inicial=2018-01-01&Fecha_Final=2020-08-31&id_cliente=CLT_7664
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';

$id_cliente = trim($_GET['id_cliente']);
$Fecha_Final = trim($_GET['Fecha_Final']);
$Fecha_Final = date_format(date_create($Fecha_Final),"Y/m/d H:i:s");
$Fecha_Inicial = trim($_GET['Fecha_Inicial']);
$Fecha_Inicial = date_format(date_create($Fecha_Inicial),"Y/m/d H:i:s");
$numreporte = trim($_GET['numreporte']);

require $root . '/Ubicaciones/Contabilidad/Reportes/actions/consultaPermisosReportes.php';
if (  $oRst_permisos['s_contabilidad_todos'] == 1 || $rslt_permisosReportes->num_rows > 0) {

  require $root . '/Resources/PHP/actions/consultaCtas108y208_cliente.php';
  while ($row_ctasCliente = $rslt_ctasCliente->fetch_assoc()) {
    $id_cuenta = $row_ctasCliente[pk_id_cuenta];
    $parte = substr($id_cuenta,0,4);
    if( $parte == '0108' ){ $cta108 = $id_cuenta; }
    if( $parte == '0208' ){ $cta208 = $id_cuenta; }
  }

  $fechaActual = date("YmdHis");
  $tem_ant_cta108 = 'temconta_ant_cta108'.'_'.$fechaActual;
  $tem_sum_ant_cta108 = 'temconta_sum_ant_cta108'.'_'.$fechaActual;
  $tem_ref_igual_cero_cta108 = 'temconta_ref_igual_cero_cta108'.'_'.$fechaActual;
  $tem_ref_igual_unocinco_cta108 = 'temconta_ref_igual_unocinco_cta108'.'_'.$fechaActual;
  $tem_det_igual_cero_cta108 = 'temconta_det_igual_cero_cta108'.'_'.$fechaActual;
  $tem_total_ant_108 = 'temconta_total_ant_108'.'_'.$fechaActual;
  $tem_ant_ref_cta108 = 'temconta_ant_ref_cta108'.'_'.$fechaActual;
  $tem_id_ant_108 = 'temconta_id_ant_108'.'_'.$fechaActual;
  $tem_det_ant_108 = 'temconta_det_ant_108'.'_'.$fechaActual;
  $tem_ant_cta208 = 'temconta_ant_cta208'.'_'.$fechaActual;
  $tem_sum_ant_cta208 = 'temconta_sum_ant_cta208'.'_'.$fechaActual;
  $tem_ref_igual_cero_cta208 = 'temconta_ref_igual_cero_cta208'.'_'.$fechaActual;
  $tem_ref_igual_cero_cta208_det = 'temconta_ref_igual_cero_cta208_det'.'_'.$fechaActual;
  $tem_det_igual_cero_cta208 = 'temconta_det_igual_cero_cta208'.'_'.$fechaActual;
  $tem_ant_ref_cta208 = 'temconta_ant_ref_cta208'.'_'.$fechaActual;
  $tem_id_ant_208 = 'temconta_id_ant_208'.'_'.$fechaActual;
  $tem_resumen_cta208 = 'temconta_resumen_cta208'.'_'.$fechaActual;
  $tem_relacion = 'temconta_relacion'.'_'.$fechaActual;


  #MAHLE SISTEMAS DE FILTRACION DE MEXICO, S.A. DE C.V.
  if( $Cliente == "CLT_6326" or $Cliente == "CLT_6375" or $Cliente == "CLT_6840" or $Cliente == "CLT_7664"){
    $consultaCuentas108 = " (a.fk_id_cuenta = '0108-06326' or a.fk_id_cuenta = '0108-06375' or a.fk_id_cuenta = '0108-06840') ";
    $consultaCuentas208 = " (a.fk_id_cuenta = '0208-06326' or a.fk_id_cuenta = '0208-06375' or a.fk_id_cuenta = '0208-06840') ";
  }else{
    $consultaCuentas108 = " a.fk_id_cuenta = '$cta108' ";
    $consultaCuentas208 = " a.fk_id_cuenta = '$cta208' ";
  }

  #--------------------------------------------- ANALISIS DE LA 108 ---------------------------------------------------------------------------------------------------------------

  #***** DETALLE DE POLIZAS CTA 0108
  mysqli_query($db,"CREATE TABLE $tem_ant_cta108 (
    SELECT a.*
    FROM conta_t_polizas_det a
    INNER JOIN conta_t_polizas_mst b
    	ON a.fk_id_poliza = b.pk_id_poliza
    WHERE $consultaCuentas108 AND a.d_fecha Between '$Fecha_Inicial' And '$Fecha_Final' and (b.s_cancela is null or b.s_cancela = 0))");

  #***** SUMAS AGRUPADAS POR REFERENCIA
  mysqli_query($db,"CREATE TABLE  $tem_sum_ant_cta108 (
  SELECT SUM(a.n_cargo - a.n_abono)as cargo_abono,a.fk_referencia
  FROM $tem_ant_cta108
  group by a.fk_referencia order by cargo_abono)");

  #***** SEPARO REGISTROS QUE EN SUMA(CARGO - ABONO)=0
  mysqli_query($db,"CREATE TABLE $tem_ref_igual_cero_cta108 (select * from $tem_sum_ant_cta108 where CAST(cargo_abono AS decimal(10,2)) = 0 order by fk_referencia)");


  #***** SEPARO REGISTROS QUE EN SUMA(CARGO - ABONO)=1.5
  #** VAN AL FINAL DEL REPORTE PARA REVISAR
  mysqli_query($db,"CREATE TABLE $tem_ref_igual_unocinco_cta108 (select * from $tem_sum_ant_cta108 where CAST(cargo_abono AS decimal(10,2)) = 1.5 order by fk_referencia)");


  #***** BORRO REGISTROS QUE EN SUMA(CARGO - ABONO)=0 SIGNIFICA QUE SON FACTURAS QUE ESTAN PAGADAS
  mysqli_query($db,"DELETE from $tem_sum_ant_cta108 where CAST(cargo_abono AS decimal(10,2)) = 0");



#********** HACER RESTRICCION POR REFERENCIA Y ANTICIPO
  #***** SEPARO LOS REGISTROS QUE SEAN IGUAL EN REFERENCIA
  mysqli_query($db,"CREATE TABLE $tem_det_igual_cero_cta108(select * from $tem_ant_cta108 where fk_referencia in(select fk_referencia from $tem_ref_igual_cero_cta108 ))");

  #***** BORRO LOS REGISTROS QUE SEAN IGUAL EN REFERENCIA
  mysqli_query($db,"DELETE from $tem_ant_cta108 where fk_referencia in(select fk_referencia from $tem_ref_igual_cero_cta108 )");
#***************************


  #***** SUMA DE ABONOS, AGRUPO POR ANTICIPOS
  mysqli_query($db,"CREATE TABLE $tem_total_ant_108 (select fk_anticipo, SUM(n_abono) as n_abono from $tem_ant_cta108 group by fk_anticipo order by abs(fk_anticipo))");


  #***** SACO NUMEREOS DE ANTICIPO DE LAS REFERENCIAS
  mysqli_query($db,"CREATE TABLE $tem_ant_ref_cta108 (select distinct A.fk_anticipo,a.fk_referencia from $tem_ant_cta108 a,  $tem_sum_ant_cta108 b where a.$pol_tipo = 3 and a.fk_referencia = b.fk_referencia and A.fk_anticipo > 0)");


  #***** SACO EL VALOR DEL ANTICIPO
  mysqli_query($db,"CREATE TABLE $tem_id_ant_108 (select a.* from conta_t_anticipos_mst a where a.pk_id_anticipo in( select distinct fk_anticipo from $tem_ant_ref_cta108 ))");

  #***** SACO EL DETALLE DE LOS ANTICIPOS DE LAS POLIZAS
  mysqli_query($db,"CREATE TABLE $tem_det_ant_108 (select a.* from conta_t_polizas_det a, $tem_id_ant_108 b where a.fk_anticipo = b.pk_id_anticipo AND a.d_fecha Between '$Fecha_Inicial' And '$Fecha_Final') ");


  #--------------------------------------------- ANALISIS DE LA 208 ---------------------------------------------------------------------------------------------------------------

  #***** DETALLE DE POLIZAS CTA 0208
   mysqli_query($db,"CREATE TABLE $tem_ant_cta208 (
     SELECT a.*
     FROM conta_t_polizas_det a
     INNER JOIN conta_t_polizas_mst b
       ON a.fk_id_poliza = b.pk_id_poliza
     WHERE $consultaCuentas208 AND a.d_fecha Between '$Fecha_Inicial' And '$Fecha_Final' and (b.s_cancela is null or b.s_cancela = 0))");

  #***** SUMAS AGRUPADAS POR REFERENCIA
  mysqli_query($db,"CREATE TABLE  $tem_sum_ant_cta208 (
  SELECT SUM(a.n_cargo - a.n_abono)as cargo_abono,a.fk_referencia,a.fk_anticipo
  FROM $tem_ant_cta208
  group by a.fk_referencia,a.fk_anticipo
  order by cargo_abono)");


  #***** CONSULTO Y GUARDO LOS REGISTROS QUE EN SUMA(CARGO - ABONO)=0, SIGNIFICA QUE SON ANTICIPOS APLICADOS
  mysqli_query($db,"CREATE TABLE $tem_ref_igual_cero_cta208 (select * from $tem_sum_ant_cta208 where CAST(cargo_abono AS decimal(10,2)) = 0 order by fk_referencia)");

  #***** SEPARO EL DETALLE DE LOS REGISTROS DE ANTICIPOS APLICADOS
  mysqli_query($db,"CREATE TABLE $tem_ref_igual_cero_cta208_det (SELECT A.* FROM $tem_ant_cta208 A, $tem_ref_igual_cero_cta208 B where a.fk_referencia =b.fk_referencia and a.fk_anticipo = b.fk_anticipo) ");



  #***** BORRO EN LA TABLA PRINCIPAL LOS REGISTROS QUE EN SUMA(CARGO - ABONO)=0, SIGNIFICA QUE SON ANTICIPOS APLICADOS
  mysqli_query($db,"DELETE from $tem_sum_ant_cta208 where CAST(cargo_abono AS decimal(10,2)) = 0 ");


#********** HACER RESTRICCION POR REFERENCIA Y ANTICIPO
  #***** CONSULTO LOS REGISTROS QUE SEAN IGUAL EN REFERENCIA Y ANTICIPO DE LOS QUE ESTAN APLICADOS
  mysqli_query($db,"CREATE TABLE $tem_det_igual_cero_cta208 (select a.* from  $tem_ant_cta208 a, $tem_ref_igual_cero_cta208 b where a.fk_referencia = b.fk_referencia and a.fk_anticipo = b.fk_anticipo)");

  #***** BORRO LOS REGISTROS QUE SEAN IGUAL EN REFERENCIA  Y  ANTICIPOS DE LOS QUE ESTAN APLICADOS
	mysqli_query($db,"DELETE from $tem_ant_cta208 where pk_partida in(select pk_partida from $tem_det_igual_cero_cta208 )");
#***************************


 	#***** SACO NUMEREOS DE ANTICIPO DE LAS REFERENCIAS
	mysqli_query($db,"CREATE TABLE $tem_ant_ref_cta208 (select a.fk_referencia,a.fk_anticipo from $tem_ant_cta208 a, $tem_sum_ant_cta208 b where a.fk_referencia = b.fk_referencia)");


	#***** SACO EL VALOR DE LOS ANTICIPOS
	mysqli_query($db,"CREATE TABLE $tem_id_ant_208 (select a.* from conta_t_anticipos_mst a where a.pk_id_anticipo in( select distinct fk_anticipo from $tem_ant_ref_cta208 ))");

	#***** SACO EL DETALLE DE LOS ANTICIPOS DE POLIZAS
	mysqli_query($db,"CREATE TABLE $tem_resumen_cta208 (select a.* from conta_t_polizas_det a, $tem_id_ant_208 b where a.fk_anticipo = b.pk_id_anticipo and a.fk_id_cuenta like '0208%' AND a.d_fecha Between '$Fecha_Inicial' And '$Fecha_Final') ");

#--------------------------------------------- UNION ANALISIS DE LA 108 Y 208 ---------------------------------------------------------------------------------------------------------------
  mysqli_query($db,"CREATE TABLE $tem_relacion select * from $tem_ant_cta208 union select * from $tem_ant_cta108");

  $lst_tablas = $tem_ant_cta108.','.$tem_sum_ant_cta108.','.$tem_ref_igual_cero_cta108.','.
    $tem_ref_igual_unocinco_cta108.','.$tem_det_igual_cero_cta108.','.$tem_total_ant_108.','.
    $tem_ant_ref_cta108.','.$tem_id_ant_108.','.$tem_det_ant_108.','.$tem_ant_cta208.','.
    $tem_sum_ant_cta208.','.$tem_ref_igual_cero_cta208.','.$tem_ref_igual_cero_cta208_det.','.
    $tem_det_igual_cero_cta208.','.$tem_ant_ref_cta208.','.$tem_id_ant_208.','.$tem_resumen_cta208.','.$tem_relacion;

  require $root . '/Ubicaciones/Contabilidad/Reportes/actions/borrarTablas.php';


}

?>
