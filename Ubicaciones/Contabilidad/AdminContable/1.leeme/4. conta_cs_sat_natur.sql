create table conta_cs_sat_natur	(
pk_id_naturaleza	varchar	(	2	)	NOT NULL 	PRIMARY KEY	,
s_naturaleza	varchar	(	100	)	DEFAULT NULL		,
d_fechaInicioVigencia	timestamp				NOT NULL DEFAULT CURRENT_TIMESTAMP	);