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
		if (isset($data['registros'])) {
			$this->load->view('buscar/viagem', $data);
		}
	}

	public function motorista()
	{
		$valor = $this->input->post('valor');
		if (preg_match('/\d{3}\.\d{3}\.\d{3}-\d{2}/', $valor)) {
			$motorista = $this->buscar_model->listar_registros('cad_motorista', 'cpf,nome', 'cpf', $valor, true);
		} elseif (preg_match('/[^\d\.\-]+/', $valor)) {
			$motorista = $this->buscar_model->pesquisar_registros('cad_motorista', 'nome', $valor, 'cpf,nome', true);
		}
		if (isset($motorista)) {
			header("Content-Type: application/json; charset=UTF-8");
			$jsonMotorista = json_encode($motorista, JSON_UNESCAPED_UNICODE);
			echo $jsonMotorista;
		} else {
			show_404('', false);
		}
	}
}
