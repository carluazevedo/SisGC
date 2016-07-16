<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viagens_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function listar_obj($tabela, $colunas = '') {
		$this->db->select($colunas);
		$query = $this->db->get($tabela);

		return $query->result();
	}

	public function listar_arr($tabela, $colunas = '') {
		$this->db->select($colunas);
		$query = $this->db->get($tabela);

		return $query->result_array();
	}

	public function cadastrar($tabela, $dados) {
		$this->db->insert($tabela, $dados);

		if ($this->db->affected_rows() == '1') {
			return true;
		}

		return false;
	}

	/**
	 * Funções para tratamento de exibição de dados
	 */
	public function usuario_atual() {
		$string = $this->session->userdata('identity');

		$identidade = explode('@', $string);

		return $identidade[0];
	}

	public function formata_data_mysql($data_mysql) {
		if ($data_mysql == 0) {
			return '-';
		} else {
			$data = date_format(date_create($data_mysql), 'd/m/Y H:i:s');
			return $data;
		}
	}

	public function status_viagem_tb($status) {
		$status_contexto = array('info','warning','success','danger');
		$status_texto    = array('NOVA VIAGEM','EM PÁTIO','FINALIZADA','CANCELADA');

		$status_retorno = sprintf('<td class="%s">%s</td>', $status_contexto[$status], $status_texto[$status]);

		return $status_retorno.PHP_EOL;
	}
}
