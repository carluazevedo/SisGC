#########################
# CREATING DRIVER TABLE #
#########################

#
# Table structure for table 'cad_motorista'
#

CREATE TABLE IF NOT EXISTS `cad_motorista` (
	`id` int(10) NOT NULL,
	`cpf` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
	`nome` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

#
# Dumping data for table 'cad_motorista'
#

INSERT INTO `cad_motorista` (`id`, `cpf`, `nome`) VALUES
	(1, '015.495.174-80', 'JOÃO JOSÉ JOSIAS');
