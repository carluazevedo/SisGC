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
		$colunas = array(
				'id',
				'dt_num',
				'status_viagem',
				'entrada_data',
				'saida_data',
				'motorista_nome',
				'placa_trator',
				'placa_reboque_1',
				'transp_nome',
				'operacao_nome',
				'operacao_unidade'
		);
		$data['registros'] = $this->viagens_model->listar_registros('reg_viagens', $colunas);

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
		$data['operacao']      = 'registrar';

		/* Lógica do controlador */
		$data['dt_num']               = '';
		$data['motorista_cpf']        = '';
		$data['motorista_nome']       = '';
		$data['placa_trator']         = '';
		$data['placa_reboque_1']      = '';
		$data['placa_reboque_2']      = '';
		$data['transp_nome']          = '';
		$data['transp_unidade']       = '';
		$data['operacao_nome']        = '';
		$data['operacao_unidade']     = '';
		$data['ent_unic']             = '';
		$data['ent_frac']             = '';
		$data['transfer']             = '';
		$data['circ_est']             = '';
		$data['hpc']                  = '';
		$data['foods']                = '';
		$data['hpc_foods']            = '';
		$data['notas_fiscais']        = '';
		$data['valor']                = '000';
		$data['peso']                 = '0000';
		$data['destinatario_cnpj']    = '';
		$data['destinatario_nome']    = '';
		$data['destinatario_unidade'] = '';
		$data['rota']                 = '';
		$data['observacoes']          = '';

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

	public function editar($id = '') {
		/* Informações para 'header.php' */
		$data['titulo']         = $this->titulo.' - Editar';
		$data['incluir_header'] = array(link_tag('styles/custom.css'));
		$data['view']           = 'viagens/formulario';

		/* Informações para 'footer.php' */
		$data['incluir_footer'] = array(
				'<script src="'.base_url('scripts/jquery-mask/jquery.mask.min.js').'"></script>',
				'<script src="'.base_url('scripts/assets_formulario.js').'"></script>'
		);

		/* Informações para 'view' */
		$data['titulo_pagina'] = 'Editar viagem';
		$data['operacao']      = 'editar';

		/* Lógica do controlador */
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="form-control-static">', '</p>');

		if ($this->form_validation->run('registrar_saida') == false) {
			$data['view'] = 'viagens/formulario';
		}

		$reg = $this->viagens_model->buscar_registro('reg_viagens', $id);
		if (isset($reg)) {
			$data['status_viagem']        = $reg->status_viagem;
			$data['entrada_data']         = $this->viagens_model->formata_data_mysql($reg->entrada_data);
			$data['entrada_usuario']      = $reg->entrada_usuario;
			$data['saida_data']           = $this->viagens_model->formata_data_mysql($reg->saida_data);
			$data['saida_usuario']        = $reg->saida_usuario;
			$data['carga_risco']          = $reg->carga_risco;
			$data['carga_escolta']        = $reg->carga_escolta;
			$data['dt_num']               = $reg->dt_num;
			$data['motorista_cpf']        = $reg->motorista_cpf;
			$data['motorista_nome']       = $reg->motorista_nome;
			$data['placa_trator']         = $reg->placa_trator;
			$data['placa_reboque_1']      = $reg->placa_reboque_1;
			$data['placa_reboque_2']      = $reg->placa_reboque_2;
			$data['transp_nome']          = $reg->transp_nome;
			$data['transp_unidade']       = $reg->transp_unidade;
			$data['operacao_nome']        = $reg->operacao_nome;
			$data['operacao_unidade']     = $reg->operacao_unidade;
			$data['notas_fiscais']        = $reg->notas_fiscais;
			$data['valor']                = $reg->valor;
			$data['peso']                 = $reg->peso;
			$data['destinatario_cnpj']    = $reg->destinatario_cnpj;
			$data['destinatario_nome']    = $reg->destinatario_nome;
			$data['destinatario_unidade'] = $reg->destinatario_unidade;
			$data['rota']                 = $reg->rota;
			$data['observacoes']          = $reg->observacoes;
			switch ($reg->entrega_tipo) {
				case 'ent_unic': $data['ent_unic'] = true; break;
				case 'ent_frac': $data['ent_frac'] = true; break;
				case 'transfer': $data['transfer'] = true; break;
				case 'circ_est': $data['circ_est'] = true; break;
			}
			switch ($reg->mercadoria_tipo) {
				case 'hpc': $data['hpc'] = true; break;
				case 'foods': $data['foods'] = true; break;
				case 'hpc_foods': $data['hpc_foods'] = true; break;
			}
		}

		/* Conclusão */
		$this->load->view('templates/header', $data);
		$this->load->view('templates/footer');
	}

	public function remover($id = '') {
		$data['id'] = $id;
		
		if ($this->input->post('remover') == 'ok' && $this->viagens_model->remover('reg_viagens', $id) == true) {
			redirect('viagens');
		} else {
			$data['retorno'] = 'Falha ao remover registro.';
			$this->load->view('viagens/remover', $data);
		}
	}
}
