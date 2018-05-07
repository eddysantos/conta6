create table conta_cs_sat_bancos(

pk_id_banco	varchar	(	4	)	NOT NULL 	PRIMARY KEY	,
s_nombre	varchar	(	50	)	DEFAULT NULL		,
s_descripcion	varchar	(	255	)	DEFAULT NULL		,
d_fechaInicioVigencia	timestamp				NOT NULL DEFAULT CURRENT_TIMESTAMP		,
s_activo	char	(	1	)	DEFAULT '0');