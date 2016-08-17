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

	public function motorista($cpf = '')
	{
		if ($cpf != '') {
			header("Content-Type: application/json; charset=UTF-8");
			$motorista = $this->buscar_model->buscar_registro('cad_motorista', 'cpf', $cpf, 'cpf,nome', true);
			if (isset($motorista)) {
				$jsonMotorista = json_encode($motorista, JSON_UNESCAPED_UNICODE);
				echo $jsonMotorista;
			}
		} else {
			$this->load->view('buscar/motorista');
		}
	}
}