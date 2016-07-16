<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viagens extends CI_Controller {

	public $titulo = 'SisGC';

	public function __construct() {
		parent::__construct();
		if (!$this->session->has_userdata('identity')) redirect('auth');

		$this->load->model('viagens_model');
	}

	public function index() {
		/* Informações básicas para visualização */
		$data['titulo']         = $this->titulo;
		$data['titulo_pagina']  = 'Sistema de Gestão de Cargas';
		$data['incluir']        = array(link_tag('styles/custom/geral.css'));
		$data['view']           = 'viagens/painel';

		/* Lógica do controlador */
		$data['viagens'] = $this->viagens_model->listar('cad_cargas');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/footer');
	}

	public function cadastrar() {
		/* Informações básicas para visualização */
		$data['titulo']        = $this->titulo.' - Cadastrar';
		$data['titulo_pagina'] = 'Cadastrar viagem';
		$data['incluir']       = array(link_tag('styles/custom/geral.css'));
		$data['nav_cadastrar'] = true;

		/* Lógica do controlador */
		$data['status_viagem'] = 0;
		$data['status_rotulo'] = array('label-info','label-warning','label-success','label-danger');
		$data['status_texto']  = array('NOVA VIAGEM','EM PÁTIO','FINALIZADA','CANCELADA');
		$data['alto_risco']    = 0; /* opções [1 || 0] */

		/* Validação de formulário */
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="form-control-static">', '</p>');

		if ($this->form_validation->run('cadastrar_entrada') == false) {
			$data['view'] = 'viagens/cadastrar';
		} else {
			$dados_viagem = array(
					'status_viagem'        => 1,
					'entrada_data'         => date('Y-m-d H:i:s'),
					'entrada_usuario'      => $this->viagens_model->usuario_atual(),
					'saida_data'           => '0000-00-00 00:00:00',
					'saida_usuario'        => '',
					'carga_risco'          => 0,
					'carga_escolta'        => 0,
					'dt_num'               => set_value('dt_num'),
					'motorista_cpf'        => set_value('motorista_cpf'),
					'motorista_nome'       => set_value('motorista_nome'),
					'placa_trator'         => set_value('placa_trator'),
					'placa_reboque_1'      => set_value('placa_reboque_1'),
					'placa_reboque_2'      => set_value('placa_reboque_2'),
					'transp_nome'          => set_value('transp_nome'),
					'transp_unidade'       => set_value('transp_unidade'),
					'operacao_nome'        => set_value('operacao_nome'),
					'operacao_unidade'     => set_value('operacao_unidade'),
					'entrega_tipo'         => set_select('entrega_tipo'),
					'mercadoria_tipo'      => set_select('mercadoria_tipo'),
					'notas_fiscais'        => set_value('notas_fiscais'),
					'valor'                => set_value('valor'),
					'peso'                 => set_value('peso'),
					'destinatario_cnpj'    => set_value('destinatario_cnpj'),
					'destinatario_nome'    => set_value('destinatario_nome'),
					'destinatario_unidade' => set_value('destinatario_unidade'),
					'rota'                 => set_value('rota'),
					'observacoes'          => set_value('observacoes')
			);

			if ($this->viagens_model->cadastrar('cad_cargas', $dados_viagem) == TRUE) {
				
				redirect('viagens');
			}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/footer');
	}
}