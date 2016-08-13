<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buscar_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	 * Buscar Registro
	 *
	 * Busca um registro com base nos parâmetros informados e retorna o resultado
	 * em 'array' ou, por padrão, em 'object'.
	 *
	 * @param    string   $tabela             Nome da tabela
	 * @param    string   $criterio_where     Critério da cláusula 'WHERE'
	 * @param    mixed    $condicao_where     Condição da cláusula 'WHERE'
	 * @param    mixed    $colunas            Pode ser string ou array
	 * @param    bool     $resultado_matriz   Se falso 'object', se verdadeiro 'array'
	 * @return   Retorna o resultado em 'array' ou, por padrão, em 'object'
	 */
	public function buscar_registro($tabela, $criterio_where, $condicao_where, $colunas = '', $resultado_matriz = false) {
		$this->db->select($colunas);
		$this->db->where($criterio_where, $condicao_where);
		$query = $this->db->get($tabela);
		if ($resultado_matriz == false) {
			return $query->row();
		} elseif ($resultado_matriz == true) {
			return $query->row_array();
		}
	}
}
