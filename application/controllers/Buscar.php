<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buscar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('identity')) redirect('auth');
		$this->load->model('buscar_model');
	}

	public function viagem($id)
	{
		$data['registros'] = $this->buscar_model->buscar_registro('reg_viagens', 'id', $id);
		if (isset($data['registros'])) $this->load->view('buscar/viagem', $data);
	}

	public function motorista()
	{
		$this->input->post('valor') OR exit(show_error('Acesso não permitido.', 403, '403 Forbidden'));
		$valor = $this->input->post('valor');
		if (preg_match('/\d{3}\.\d{3}\.\d{3}-\d{2}/', $valor)) {
			$motorista = $this->buscar_model->listar_registros('cad_motoristas', 'id,cpf,nome', 'cpf', $valor, true);
		} elseif (preg_match('/[^\d-]+/i', $valor)) {
			$motorista = $this->buscar_model->pesquisar_registros('cad_motoristas', 'nome', $valor, 'id,cpf,nome', true);
		}
		header("Content-Type: application/json; charset=UTF-8");
		if (isset($motorista)) {
			$jsonMotorista = json_encode($motorista, JSON_UNESCAPED_UNICODE);
			echo $jsonMotorista;
		} else {
			echo "[]";
		}
	}
}
