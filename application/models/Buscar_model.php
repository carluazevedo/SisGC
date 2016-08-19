<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buscar_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * Listar Registros
	 *
	 * Lista registros com base nos parâmetros informados e retorna os resultados
	 * em 'array' ou, por padrão, em 'object'.
	 *
	 * @param    string   $tabela             Nome da tabela
	 * @param    mixed    $colunas            Pode ser string ou array
	 * @param    string   $criterio_where     Se informado, critério da cláusula 'WHERE'
	 * @param    mixed    $condicao_where     Se informado, condição da cláusula 'WHERE'
	 * @param    bool     $resultado_matriz   Se falso 'object', se verdadeiro 'array'
	 * @return   Retorna os resultados em 'array' ou, por padrão, em 'object'
	 */
	public function listar_registros($tabela, $colunas = '', $criterio_where = '', $condicao_where = '', $resultado_matriz = false)
	{
		$this->db->select($colunas);
		if ($criterio_where != '' && $condicao_where != '') {
			$this->db->where($criterio_where, $condicao_where);
		}
		$query = $this->db->get($tabela);
		if ($resultado_matriz == false) {
			return $query->result();
		} elseif ($resultado_matriz == true) {
			return $query->result_array();
		}
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
	public function buscar_registro($tabela, $criterio_where, $condicao_where, $colunas = '', $resultado_matriz = false)
	{
		$this->db->select($colunas);
		$this->db->where($criterio_where, $condicao_where);
		$query = $this->db->get($tabela);
		if ($resultado_matriz == false) {
			return $query->row();
		} elseif ($resultado_matriz == true) {
			return $query->row_array();
		}
	}

	/**
	 * Pesquisar Registros
	 *
	 * Pesquisa registros com base nos parâmetros informados e retorna os resultados
	 * em 'array' ou, por padrão, em 'object', utilizando a cláusula 'LIKE' para
	 * corresponder com string parcial.
	 *
	 * @param    string   $tabela             Nome da tabela
	 * @param    string   $criterio_where     Critério da cláusula 'LIKE'
	 * @param    mixed    $condicao_where     Condição da cláusula 'LIKE'
	 * @param    mixed    $colunas            Pode ser string ou array
	 * @param    bool     $resultado_matriz   Se falso 'object', se verdadeiro 'array'
	 * @return   Retorna o resultado em 'array' ou, por padrão, em 'object'
	 */
	public function pesquisar_registros($tabela, $criterio_like, $condicao_like, $colunas = '', $resultado_matriz = false)
	{
		$this->db->select($colunas);
		$this->db->like($criterio_like, $condicao_like, 'after');
		$query = $this->db->get($tabela);
		if ($resultado_matriz == false) {
			return $query->result();
		} elseif ($resultado_matriz == true) {
			return $query->result_array();
		}
	}

	/* Funções para tratamento de exibição de dados */
	public function usuario_atual()
	{
		$string = $this->session->userdata('identity');
		$exploded = explode('@', $string);
		$identidade = array_shift($exploded);
		return $identidade;
	}
	
	public function formata_data_mysql($data_mysql)
	{
		if ($data_mysql == 0) {
			return '-';
		} else {
			$data = date_format(date_create($data_mysql), 'd/m/Y H:i');
			return $data;
		}
	}
	
	public function status_viagem_tb($status)
	{
		$status_contexto = array('info','warning','success','danger');
		$status_texto    = array('NOVA VIAGEM','EM PÁTIO','FINALIZADA','CANCELADA');
		$status_retorno  = sprintf('<td class="%s">%s</td>', $status_contexto[$status], $status_texto[$status]);
		return $status_retorno.PHP_EOL;
	}
	
	public function status_viagem_pn($status, $elemento)
	{
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
