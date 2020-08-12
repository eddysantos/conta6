ALTER TABLE `conta6`.`conta_cs_imss`
ADD COLUMN `n_inferior_b` decimal(18, 2) NULL AFTER `n_porcentaje`,
ADD COLUMN `n_superior_b` decimal(18, 2) NULL AFTER `n_inferior_b`,
ADD COLUMN `n_cuota_b` decimal(18, 2) NULL AFTER `n_superior_b`;
