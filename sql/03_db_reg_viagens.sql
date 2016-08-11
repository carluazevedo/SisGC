##########################
# CREATING LOADING TABLE #
##########################

#
# Table structure for table 'reg_viagens'
#

CREATE TABLE IF NOT EXISTS `reg_viagens` (
	`id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
	`status_viagem` tinyint(1) NOT NULL COMMENT 'STATUS',
	`entrada_data` datetime NOT NULL COMMENT 'DATA ENTRADA',
	`entrada_usuario` varchar(64) NOT NULL COMMENT 'USUÁRIO ENTRADA',
	`saida_data` datetime NOT NULL COMMENT 'DATA SAÍDA',
	`saida_usuario` varchar(64) NOT NULL COMMENT 'USUÁRIO SAÍDA',
	`carga_risco` tinyint(1) NOT NULL COMMENT 'RISCO',
	`carga_escolta` tinyint(1) NOT NULL COMMENT 'ESCOLTA',
	`dt_num` varchar(64) NOT NULL COMMENT 'NÚMERO DT',
	`motorista_cpf` varchar(14) NOT NULL COMMENT 'CPF',
	`motorista_nome` varchar(128) NOT NULL COMMENT 'MOTORISTA',
	`placa_trator` varchar(8) NOT NULL COMMENT 'TRATOR',
	`placa_reboque_1` varchar(8) NOT NULL COMMENT 'REBOQUE 1',
	`placa_reboque_2` varchar(8) DEFAULT NULL COMMENT 'REBOQUE 2',
	`transp_nome` varchar(128) NOT NULL COMMENT 'TRANSPORTADORA',
	`transp_unidade` varchar(64) NOT NULL COMMENT 'UNIDADE',
	`operacao_nome` varchar(128) NOT NULL COMMENT 'ORIGEM',
	`operacao_unidade` varchar(64) NOT NULL COMMENT 'UNIDADE',
	`notas_fiscais` varchar(128) NULL COMMENT 'NOTAS FISCAIS',
	`valor` decimal(11,2) NULL COMMENT 'VALOR',
	`peso` decimal(11,3) NULL COMMENT 'PESO',
	`entrega_tipo` varchar(20) NULL COMMENT 'ENTREGA',
	`mercadoria_tipo` varchar(10) NULL COMMENT 'MERCADORIA',
	`destinatario_cnpj` varchar(18) NULL COMMENT 'CNPJ',
	`destinatario_nome` varchar(128) NULL COMMENT 'CLIENTE',
	`destinatario_unidade` varchar(64) NULL COMMENT 'UNIDADE',
	`rota` varchar(256) NULL COMMENT 'ROTA',
	`observacoes` varchar(256) NOT NULL COMMENT 'OBSERVAÇÕES',
	PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;
