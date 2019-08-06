<?php
	#-- ES USADO DESDE EL BTN_BUSCAR_FACTURAS EN POLIZAS DIARIO,ANTICIPOS Y CHEQUES
	mysqli_query($db,"DROP TABLE IF EXISTS $TBL");
	#mysqli_query($db,"DROP TABLE IF EXISTS TEMP_POLIZAS_CLIENTE_fac");

	#-- Filtro despues de la @Fecha_Inicial
	#--** FACTURAS O NOTAS DE CREDITO
	mysqli_query($db,"CREATE TABLE $TBL
	SELECT B.fk_id_cuenta,B.fk_referencia,B.fk_factura,B.fk_nc,B.fk_ctagastos,cast(SUM(B.n_cargo - B.n_abono) as decimal(10,2)) as saldo
	FROM conta_t_polizas_mst A,conta_t_polizas_det B
	WHERE B.fk_id_cliente = '$cliente' AND CAST(B.d_fecha AS DATE) <= '$fecha' AND A.s_cancela = 0 AND A.pk_id_poliza = B.fk_id_poliza AND
	B.fk_factura > 0 and B.fk_id_cuenta like '0108%' AND B.fk_nc >= 0
	group by B.fk_referencia,B.fk_factura,B.fk_nc");


	#--** CUENTAS DE GASTOS
	mysqli_query($db,"INSERT INTO $TBL
	SELECT B.fk_id_cuenta,B.fk_referencia,B.fk_factura,B.fk_nc,B.fk_ctagastos,cast(SUM(B.n_cargo - B.n_abono) as decimal(10,2)) as saldo
	FROM conta_t_polizas_mst A,conta_t_polizas_det B
	WHERE B.fk_id_cliente = '$cliente' AND CAST(B.d_fecha AS DATE) <= '$fecha' AND A.s_cancela = 0 AND A.pk_id_poliza = B.fk_id_poliza AND
	B.fk_factura > 0 and B.fk_id_cuenta like '0203%'
	group by B.fk_referencia,B.fk_factura,B.fk_nc");



	mysqli_query($db,"INSERT INTO $TBL
	SELECT B.fk_id_cuenta,B.fk_referencia,B.fk_factura,B.fk_nc,B.fk_ctagastos,cast(SUM(B.n_cargo - B.n_abono) as decimal(10,2)) as saldo
	FROM conta_t_polizas_mst A,conta_t_polizas_det B
	WHERE B.fk_id_cliente = '$cliente' AND CAST(B.d_fecha AS DATE) <= '$fecha' AND A.s_cancela = 0 AND A.pk_id_poliza = B.fk_id_poliza AND
	B.fk_factura > 0 and B.fk_id_cuenta like '0106%'
	group by B.fk_referencia,B.fk_factura,B.fk_nc");


?>
