create table conta_cs_cuentas_mst(

pk_id_cuenta	varchar	(	15	)	NOT NULL 	PRIMARY KEY	,

s_cta_desc	varchar	(	100	)	DEFAULT NULL
fk_id_banco	varchar	(	4	)	DEFAULT NULL
s_ctaBancaria	varchar	(	18	)	DEFAULT NULL
s_cta_tipo	char	(	1	)	DEFAULT NULL
s_cta_nivel	char	(	1	)	DEFAULT NULL
s_cta_identificador	varchar	(	15	)	DEFAULT NULL
s_cta_identificador_tipo	varchar	(	15	)	DEFAULT NULL
s_cta_status	char	(	1	)	DEFAULT '1'
s_cta_actividad	char	(	1	)	DEFAULT '0'
fk_codAgrup	varchar	(	10	)	DEFAULT NULL
fk_id_naturaleza	varchar	(	2	)	DEFAULT NULL
fk_c_ClaveProdServ	char	(	8	)	DEFAULT NULL
s_subctaDe	varchar	(	10	)	DEFAULT NULL
d_fecha_alta	datetime				NOT NULL DEFAULT CURRENT_TIMESTAMP
s_usuario_alta	varchar	(	15	)	DEFAULT NULL
d_fecha_modifi	datetime				DEFAULT NULL
s_usuario_modifi	varchar	(	15	)	DEFAULT NULL;
