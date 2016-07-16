#########################
# CREATING DRIVER TABLE #
#########################

#
# Table structure for table 'cad_motorista'
#

CREATE TABLE IF NOT EXISTS `cad_motorista` (
	`id` int(8) NOT NULL,
	`cpf` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
	`nome` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

#
# Dumping data for table 'cad_motorista'
#

INSERT INTO `cad_motorista` (`id`, `cpf`, `nome`) VALUES
	(1, '01549517480', 'JOÃO JOSÉ JOSIAS');
