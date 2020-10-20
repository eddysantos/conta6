<?php
/*
	include ("../conexion.php");
	$Fecha_Inicial = '2015-01-01';
	$Fecha_Final = '2015-01-31';
	$periodo = 'mensual';
*/
#finanacieros > edo de resultados
	if( $periodo == 'mensual' ){
		$tblBalanza = 'TEM_TBL_BALANZA';
		$tblSaldos = 'tem_tbl_sal';
		$tblMov = 'tem_tbl_mov';
		$tblSalIni = 'tem_tbl_saldos_iniciales';
		$tblCtasMes = 'tem_tbl_ctas_mes';
		$tblBal1 = 'tem_tbl_balanza_1';
	}
#financieros > balanza anual
	if( $periodo == 'procesoAnual' ){
		$tblBalanza = 'TEM_BALANZA_PROC';
		$tblSaldos = 'tem_tbl_salPROC';
		$tblMov = 'tem_tbl_movPROC';
		$tblSalIni = 'tem_tbl_saldos_inicialesPROC';
		$tblCtasMes = 'tem_tbl_ctas_mesPROC';
		$tblBal1 = 'tem_tbl_balanza_1PROC';
 	}
	if( $periodo == 'procMensual' ){
		$tblBalanza = 'TEM_BALANZA_'.$FImes;
		$tblSaldos = 'tem_tbl_sal'.$FImes;
		$tblMov = 'tem_tbl_mov'.$FImes;
		$tblSalIni = 'tem_tbl_saldos_iniciales'.$FImes;
		$tblCtasMes = 'tem_tbl_ctas_mes'.$FImes;
		$tblBal1 = 'tem_tbl_balanza_1'.$FImes;
 	}
#contabilidad > balanza comprobacion / contabilidadElectronica > balanza comprobacion XML
	if( $periodo == 'comprobacion' ){
		$tblBalanza = 'temconta_BCofac_'.$fechaActual;
		$tblSaldos = 'temconta_BCofac_sal_'.$fechaActual;
		$tblMov = 'temconta_BCofac_mov_'.$fechaActual;
		$tblSalIni = 'temconta_BCofac_salini_'.$fechaActual;
		$tblCtasMes = 'temconta_BCofac_ctasmes_'.$fechaActual;
		$tblBal1 = 'temconta_BCofac_balanza1_'.$fechaActual;
 	}

 #-- Calculamos los cargos y abonos para saldos iniciales de todas las cuentas
  mysqli_query($db,"CREATE TABLE $tblSaldos
	select a.fk_id_cuenta, SUM(a.n_cargo) as cargos, SUM(a.n_abono) as abonos
	from conta_t_polizas_det a
	INNER JOIN conta_t_polizas_mst b
	ON a.fk_id_poliza = b.pk_id_poliza
	where a.d_fecha < '$Fecha_Inicial' and b.fk_id_aduana = $Oficina
	group by a.fk_id_cuenta order by a.fk_id_cuenta");

  #-- Calculamos los cargos y abonos de todas las cuentas durante el periodo
  mysqli_query($db,"CREATE TABLE $tblMov
	select a.fk_id_cuenta, SUM(a.n_cargo) as cargos, SUM(a.n_abono) as abonos
	from conta_t_polizas_det a
	INNER JOIN conta_t_polizas_mst b
	ON a.fk_id_poliza = b.pk_id_poliza
	where a.d_fecha between '$Fecha_Inicial' and '$Fecha_Final' and b.fk_id_aduana = $Oficina
	group by a.fk_id_cuenta order by a.fk_id_cuenta");

  mysqli_query($db,"ALTER TABLE $tblMov ADD index idx_$tblMov(fk_id_cuenta)");
  mysqli_query($db,"ALTER TABLE $tblSaldos ADD index idx_$tblSaldos(fk_id_cuenta)");

  #-- Calculamos Saldos Iniciales de todas cuentas
  mysqli_query($db,"CREATE TABLE $tblSalIni
  select fk_id_cuenta,
      case
        when left(fk_id_cuenta, 2) = '01' then (cargos - abonos)
        when left(fk_id_cuenta, 2) = '05' then (cargos - abonos)
			  when left(fk_id_cuenta, 4) = '0610' then (cargos - abonos)
        else (abonos - cargos)
      end as sal_ini
  from $tblSaldos
  order by fk_id_cuenta");

  mysqli_query($db,"ALTER TABLE $tblSalIni ADD index idx_$tblSalIni(fk_id_cuenta)");

  #-- Cuentas que tienen movimiento en este mes.
  #-- drop table $tblCtasMes
  mysqli_query($db,"CREATE TABLE $tblCtasMes
	select a.fk_id_cuenta
	from conta_t_polizas_det a
	INNER JOIN conta_t_polizas_mst b
	ON a.fk_id_poliza = b.pk_id_poliza
	where a.d_fecha < '$Fecha_Inicial' and b.fk_id_aduana = $Oficina
	group by a.fk_id_cuenta order by a.fk_id_cuenta");

  mysqli_query($db,"ALTER TABLE $tblCtasMes ADD index idx_$tblCtasMes(fk_id_cuenta)");


  #-- Determinamos la cuentas que hacen falta, es decir las que no tienen cargos hasta este fecha
  mysqli_query($db,"insert into $tblSalIni
  select fk_id_cuenta, 0 as saldo
  from conta_t_polizas_det
  where fk_id_cuenta not in (
    select fk_id_cuenta
    from $tblCtasMes
    )
  and d_fecha between '$Fecha_Inicial' and '$Fecha_Final'
  group by fk_id_cuenta order by fk_id_cuenta");

	#Agrego las cuentas que no son de la oficina en ceros
	mysqli_query($link,"insert into $tblMov
	select fk_id_cuenta, 0 as n_cargo, 0 as n_abono
	from $tblCtasMes
	where fk_id_cuenta not in( select pol_cuenta from $tblMov )");



  #-- Evitamos los null
  mysqli_query($db,"CREATE TABLE $tblBal1
  select si.fk_id_cuenta, si.sal_ini,
      case
        when mv.cargos is null then 0
        else mv.cargos
      end as cargos,
      case
        when mv.abonos is null then 0
        else mv.abonos
      end as abonos
  from $tblMov as mv RIGHT JOIN $tblSalIni as si on mv.fk_id_cuenta = si.fk_id_cuenta
  order by si.fk_id_cuenta");

  mysqli_query($db,"ALTER TABLE $tblBal1 ADD index idx_$tblBal1(fk_id_cuenta)");

  #-- Calculamos el saldo final
  mysqli_query($db,"CREATE TABLE $tblBalanza
  select fk_id_cuenta, sal_ini, cargos, abonos,
      case
        when left(fk_id_cuenta,2) = '01' then (sal_ini+(cargos - abonos))
        when left(fk_id_cuenta,2) = '05' then (sal_ini+(cargos - abonos))
        when left(fk_id_cuenta,2) = '06' then (sal_ini+(cargos - abonos))
		when left(fk_id_cuenta,2) = '0610' then (sal_ini+(cargos - abonos))
        else (sal_ini-(cargos-abonos))
      end as sal_fin
  from $tblBal1");

  #-- Borramos las cuentas de mayor, ya que las calcularemos
  mysqli_query($db,"delete from $tblBalanza where right(fk_id_cuenta,5) = '00000'");
  #mysqli_query($db,"delete from $tblBalanza where sal_ini = 0 and cargos = 0 and abonos = 0 and sal_fin = 0");

  mysqli_query($db,"insert into $tblBalanza
  select concat(left(fk_id_cuenta,4),'-00000') as fk_id_cuenta , SUM(sal_ini), SUM(cargos), SUM(abonos), SUM(sal_fin)
  from $tblBalanza
  group by concat(left(fk_id_cuenta,4),'-00000') order by fk_id_cuenta");

	$lst_tablas = $tblSaldos.','.$tblMov.','.$tblSalIni.','.$tblCtasMes.','.$tblBal1;
	#require $root . '/Ubicaciones/Contabilidad/Reportes/actions/borrarTablas.php';
?>
