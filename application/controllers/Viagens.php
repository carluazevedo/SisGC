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
		/* Informações para 'header.php' */
		$data['titulo']         = $this->titulo;
		$data['incluir_header'] = array(link_tag('styles/custom.css'));
		$data['view']           = 'viagens/painel';

		/* Informações para 'footer.php' */
		$data['incluir_footer'] = array('<script src="'.base_url('scripts/assets_painel.js').'"></script>');

		/* Informações para 'view' */
		$data['titulo_pagina'] = 'Viagens registradas';

		/* Lógica do controlador */
		$data['viagens'] = $this->viagens_model->listar_obj('reg_viagens',
			'dt_num,status_viagem,entrada_data,saida_data,motorista_nome,placa_trator,placa_reboque_1,transp_nome,operacao_nome,operacao_unidade'
		);

		/* Conclusão */
		$this->load->view('templates/header', $data);
		$this->load->view('templates/footer');
	}

	public function registrar() {
		/* Informações para 'header.php' */
		$data['titulo']         = $this->titulo.' - Registrar';
		$data['incluir_header'] = array(link_tag('styles/custom.css'));

		/* Informações para 'footer.php' */
		$data['incluir_footer'] = array(
				'<script src="'.base_url('scripts/jquery-mask/jquery.mask.min.js').'"></script>',
				'<script src="'.base_url('scripts/assets_formulario.js').'"></script>'
		);

		/* Informações para 'view' */
		$data['titulo_pagina'] = 'Registrar viagem';
		$data['nav_registrar'] = true;

		/* Lógica do controlador */
		$data['status_viagem'] = 0;
		$data['alto_risco']    = 0; /* opções [ 0 || 1 ] */

		/* Validação de formulário */
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="form-control-static">', '</p>');

		if ($this->form_validation->run('registrar_entrada') == false) {
			$data['view'] = 'viagens/formulario';
		} else {
			$str_search = array('.', ',');
			$str_replace = array('', '.');
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
				'entrega_tipo'         => $this->input->post('entrega_tipo'),
				'mercadoria_tipo'      => $this->input->post('mercadoria_tipo'),
				'notas_fiscais'        => set_value('notas_fiscais'),
				'valor'                => str_replace($str_search, $str_replace, set_value('valor')),
				'peso'                 => str_replace($str_search, $str_replace, set_value('peso')),
				'destinatario_cnpj'    => set_value('destinatario_cnpj'),
				'destinatario_nome'    => set_value('destinatario_nome'),
				'destinatario_unidade' => set_value('destinatario_unidade'),
				'rota'                 => set_value('rota'),
				'observacoes'          => set_value('observacoes')
			);

			if ($this->viagens_model->registrar('reg_viagens', $dados_viagem) == TRUE) {
				
				redirect('viagens');
			}
		}

		/* Conclusão */
		$this->load->view('templates/header', $data);
		$this->load->view('templates/footer');
	}

	public function remover() {
		$this->viagens_model->remover();
	}
}
