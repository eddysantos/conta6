ALTER TABLE `conta6`.`conta_t_nom_empleados`
MODIFY COLUMN `d_fechaNacido` date NULL DEFAULT NULL AFTER `s_apellidoM`,
MODIFY COLUMN `s_id_entfed` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `s_codigo`;

ALTER TABLE `conta6`.`conta_t_nom_empleados`
MODIFY COLUMN `fk_id_regimen` int(2) NULL DEFAULT NULL AFTER `fk_id_pago`;


ALTER TABLE `conta6`.`conta_t_nom_empleados`
MODIFY COLUMN `n_hrsExtra_dobles` int(11) NULL DEFAULT 0.00 AFTER `n_compensacion`,
MODIFY COLUMN `n_hrsExtra_triples` int(11) NULL DEFAULT 0.00 AFTER `n_hrsExtra_dobles_dias`,
MODIFY COLUMN `n_hrsExtra_simples` int(11) NULL DEFAULT 0.00 AFTER `n_hrsExtra_triples_dias`,
MODIFY COLUMN `n_hrsExtra_simples_dias` int(11) NULL DEFAULT 0.00 AFTER `n_hrsExtra_simples`;



ALTER TABLE `conta6`.`conta_t_nom_empleados`
-- MODIFY COLUMN `fk_id_riesgo` int(11) ZEROFILL NULL AFTER `fk_id_jornada`,
MODIFY COLUMN `fk_tipoIncapacidad` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' AFTER `n_incapacidad_dias`;


ALTER TABLE `conta6`.`conta_t_nom_empleados`
MODIFY COLUMN `n_hrsExtra_triples_dias` int(11) NULL DEFAULT 0 AFTER `n_hrsExtra_triples`;
