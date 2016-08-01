<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viagens_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function listar($tabela, $colunas = '') {
		$this->db->select($colunas);
		$query = $this->db->get($tabela);

		return $query->result();
		/* return $query->result_array(); */
	}

	public function registrar($tabela, $dados) {
		$this->db->insert($tabela, $dados);

		if ($this->db->affected_rows() == '1') {
			return true;
		}

		return false;
	}

	public function buscar_registro($tabela, $id) {
		$this->db->where('id', $id);
		$query = $this->db->get($tabela);
		return $query->result();
	}

	public function remover($tabela, $id) {
		$this->db->where('id', $id);
		$this->db->delete($tabela);

		if ($this->db->affected_rows() == '1') {
			return true;
		}

		return false;		
	}

	/* < Funções para tratamento de exibição de dados > */
	public function usuario_atual() {
		$string = $this->session->userdata('identity');
		$exploded = explode('@', $string);
		$identidade = array_shift($exploded);

		return $identidade;
	}

	public function formata_data_mysql($data_mysql) {
		if ($data_mysql == 0) {
			return '-';
		} else {
			$data = date_format(date_create($data_mysql), 'd/m/Y H:i');
			return $data;
		}
	}

	public function status_viagem_tb($status) {
		$status_contexto = array('info','warning','success','danger');
		$status_texto    = array('NOVA VIAGEM','EM PÁTIO','FINALIZADA','CANCELADA');

		$status_retorno = sprintf('<td class="%s">%s</td>', $status_contexto[$status], $status_texto[$status]);

		return $status_retorno.PHP_EOL;
	}

	public function status_viagem_pn($status, $elemento) {
		$status_contexto = array('label-info','label-warning','label-success','label-danger');
		$status_texto    = array('NOVA VIAGEM','EM PÁTIO','FINALIZADA','CANCELADA');

		switch ($elemento) {
			case 'contexto':
				return $status_contexto[$status];
				break;
			case 'texto':
				return $status_texto[$status];
				break;
		}
	}
}
