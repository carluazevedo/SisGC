#########################
# CREATING DRIVER TABLE #
#########################

#
# Table structure for table 'cad_motorista'
#

CREATE TABLE IF NOT EXISTS `cad_motorista` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`cpf` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
	`nome` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;
