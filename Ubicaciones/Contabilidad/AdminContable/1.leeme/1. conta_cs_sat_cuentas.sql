
create table conta_cs_sat_cuentas(

s_nivel	char (1)	DEFAULT NULL,
pk_codAgrup	varchar (10)	NOT NULL 	PRIMARY KEY,
s_ctaNombre	varchar (300)	DEFAULT NULL,
s_clasificacion	varchar (50)	DEFAULT NULL,
s_ctaBalance	varchar (10)	DEFAULT NULL,
d_fechaInicioVigencia	date DEFAULT NULL,
s_activo	char (1)	DEFAULT '0',
n_id_partida	int DEFAULT NULL	);



