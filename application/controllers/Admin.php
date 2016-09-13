<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public $titulo = 'SisGC';

	public function __construct() {
		parent::__construct();
		if (!$this->session->has_userdata('identity')) redirect('auth');

		$this->load->model('viagens_model');
	}

	public function index() {
		/* Informações para 'cabecalho.php' */
		$data['titulo']  = $this->titulo.'- Administração';
		$data['incluir'] = array(link_tag('styles/geral.css'));
		$data['view']    = 'admin/painel';

		/* Informações para 'view' */
		$data['titulo_pagina'] = 'Painel do Administrador';

		$this->load->view('modelos/cabecalho', $data);
		$this->load->view('modelos/rodape');
	}
}