create table conta_cs_sat_claveprodserv	(
pk_c_ClaveProdServ	varchar	(	8	)	NOT NULL 	PRIMARY KEY	,
s_descripcion	varchar	(	250	)	DEFAULT NULL		,
d_fechaInicioVigencia	date				DEFAULT NULL		,
s_activo	char	(	1	)	DEFAULT '0' );		
