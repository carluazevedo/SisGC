<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viagens_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function listar($tabela) {
		$this->db->select('dt_num,entrada_data,entrada_usuario,saida_data,saida_usuario');
		$query = $this->db->get($tabela);

		return $query->result(); /* return $query->result_array(); */
	}

	public function cadastrar($tabela, $dados) {
		$this->db->insert($tabela, $dados);

		if ($this->db->affected_rows() == '1') {
			return true;
		}

		return false;
	}

	public function usuario_atual() {
		$string = $this->session->userdata('identity');

		$identidade = explode('@', $string);
		return $identidade[0];
	}
}
