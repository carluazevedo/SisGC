<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
		'registrar_entrada' => array(
				array(
						'field' => 'dt_num',
						'label' => '<strong>'.'Número DT'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'motorista_cpf',
						'label' => '<strong>'.'CPF'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'placa_trator',
						'label' => '<strong>'.'Trator'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'placa_reboque_1',
						'label' => '<strong>'.'Reboque 1'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'transp_nome',
						'label' => '<strong>'.'Nome'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'operacao_nome',
						'label' => '<strong>'.'Nome'.'</strong>',
						'rules' => 'required'
				)
		),
		'registrar_saida' => array(
				array(
						'field' => 'dt_num',
						'label' => '<strong>'.'Número DT'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'motorista_cpf',
						'label' => '<strong>'.'CPF'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'placa_trator',
						'label' => '<strong>'.'Trator'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'placa_reboque_1',
						'label' => '<strong>'.'Reboque 1'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'transp_nome',
						'label' => '<strong>'.'Nome'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'operacao_nome',
						'label' => '<strong>'.'Nome'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'notas_fiscais',
						'label' => '<strong>'.'Notas fiscais'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'valor',
						'label' => '<strong>'.'Valor total'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'peso',
						'label' => '<strong>'.'Peso total'.'</strong>',
						'rules' => 'required'
				),
				array(
						'field' => 'destinatario_cnpj',
						'label' => '<strong>'.'CNPJ'.'</strong>',
						'rules' => 'required'
				)
		)
);
/**
 * Método alternativo para personalizar delimitadores de erros
 */
#$config['error_prefix'] = '<p class="form-control-static">';
#$config['error_suffix'] = '</p>';
