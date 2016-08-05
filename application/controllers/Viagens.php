<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viagens extends CI_Controller {

	public $titulo = 'SisGC';

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('identity')) redirect('auth');
		$this->load->model('viagens_model');
	}

	public function index()
	{
		/* Informações para 'header.php' */
		$data['titulo']         = $this->titulo;
		$data['incluir_header'] = array(link_tag('styles/custom.css'));
		$data['view']           = 'viagens/painel';
		/* Informações para 'view' */
		$data['titulo_pagina'] = 'Viagens registradas';
		/* Informações para 'footer.php' */
		$data['scripts_footer'] = 'viagens/painel_scripts';
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
		$this->load->view('templates/footer', $data);
	}

	public function registrar()
	{
		/* Informações para 'header.php' */
		$data['titulo']         = $this->titulo.' - Registrar';
		$data['incluir_header'] = array(link_tag('styles/custom.css'));
		/* Informações para 'view' */
		$data['titulo_pagina'] = 'Registrar viagem';
		$data['nav_registrar'] = true;
		$data['operacao']      = 'registrar';
		/* Informações para 'footer.php' */
		$data['incluir_footer'] = array('<script src="'.base_url('scripts/jquery-mask/jquery.mask.min.js').'"></script>');
		$data['scripts_footer'] = 'viagens/formulario_scripts';
		/* Lógica do controlador */
		/* ->Inicialização dos valores dos campos */
		$dados = $this->viagens_model->inicializar_valores();
		$dados_length = count($dados);
		$dados_keys = array_keys($dados);
		$dados_vals = array_values($dados);
		for ($i = 0; $i < $dados_length; $i++) {
			$data[$dados_keys[$i]] = $dados_vals[$i];
		}
		/* ->Validação de formulário */
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
				'dt_num'               => $this->input->post('dt_num'),
				'motorista_cpf'        => $this->input->post('motorista_cpf'),
				'motorista_nome'       => $this->input->post('motorista_nome'),
				'placa_trator'         => $this->input->post('placa_trator'),
				'placa_reboque_1'      => $this->input->post('placa_reboque_1'),
				'placa_reboque_2'      => $this->input->post('placa_reboque_2'),
				'transp_nome'          => $this->input->post('transp_nome'),
				'transp_unidade'       => $this->input->post('transp_unidade'),
				'operacao_nome'        => $this->input->post('operacao_nome'),
				'operacao_unidade'     => $this->input->post('operacao_unidade'),
				'notas_fiscais'        => $this->input->post('notas_fiscais'),
				'valor'                => str_replace($str_search, $str_replace, $this->input->post('valor')),
				'peso'                 => str_replace($str_search, $str_replace, $this->input->post('peso')),
				'entrega_tipo'         => $this->input->post('entrega_tipo'),
				'mercadoria_tipo'      => $this->input->post('mercadoria_tipo'),
				'destinatario_cnpj'    => $this->input->post('destinatario_cnpj'),
				'destinatario_nome'    => $this->input->post('destinatario_nome'),
				'destinatario_unidade' => $this->input->post('destinatario_unidade'),
				'rota'                 => $this->input->post('rota'),
				'observacoes'          => $this->input->post('observacoes')
			);
			if ($this->input->post('registrar') == 'ok' && $this->viagens_model->registrar('reg_viagens', $dados_viagem) == true) :
				$this->session->set_flashdata('sucesso', 'Viagem registrada com sucesso.');
				$ultimo_id = $this->viagens_model->ultimo_id();
				redirect('viagens/editar/'.$ultimo_id);
			else :
				$data['view'] = 'viagens/formulario';
			endif;
		}
		/* Conclusão */
		$this->load->view('templates/header', $data);
		$this->load->view('templates/footer');
	}

	public function editar($id)
	{
		/* Informações para 'header.php' */
		$data['titulo']         = $this->titulo.' - Editar';
		$data['incluir_header'] = array(link_tag('styles/custom.css'));
		$data['view']           = 'viagens/formulario';
		/* Informações para 'view' */
		$data['titulo_pagina'] = 'Editar viagem';
		$data['operacao']      = 'editar';
		/* Informações para 'footer.php' */
		$data['incluir_footer'] = array('<script src="'.base_url('scripts/jquery-mask/jquery.mask.min.js').'"></script>',);
		$data['scripts_footer'] = 'viagens/formulario_scripts';
		/* Lógica do controlador */
		/* ->Preenchimento dos valores dos campos */
		$dados = $this->viagens_model->preencher_valores('reg_viagens', $id);
		$dados_length = count($dados);
		$dados_keys = array_keys($dados);
		$dados_vals = array_values($dados);
		for ($i = 0; $i < $dados_length; $i++) {
			$data[$dados_keys[$i]] = $dados_vals[$i];
		}
		/* ->Validação de formulário */
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="form-control-static">', '</p>');
		if ($this->input->post('gravar') == 'ok') {
			if ($this->form_validation->run('registrar_entrada') == false) {
				$data['view'] = 'viagens/formulario';
			} else {
				$str_search = array('.', ',');
				$str_replace = array('', '.');
				$dados_viagem = array(
					'carga_risco'          => $this->input->post('carga_risco'),
					'carga_escolta'        => $this->input->post('carga_escolta'),
					'dt_num'               => $this->input->post('dt_num'),
					'motorista_cpf'        => $this->input->post('motorista_cpf'),
					'motorista_nome'       => $this->input->post('motorista_nome'),
					'placa_trator'         => $this->input->post('placa_trator'),
					'placa_reboque_1'      => $this->input->post('placa_reboque_1'),
					'placa_reboque_2'      => $this->input->post('placa_reboque_2'),
					'transp_nome'          => $this->input->post('transp_nome'),
					'transp_unidade'       => $this->input->post('transp_unidade'),
					'operacao_nome'        => $this->input->post('operacao_nome'),
					'operacao_unidade'     => $this->input->post('operacao_unidade'),
					'notas_fiscais'        => $this->input->post('notas_fiscais'),
					'valor'                => str_replace($str_search, $str_replace, $this->input->post('valor')),
					'peso'                 => str_replace($str_search, $str_replace, $this->input->post('peso')),
					'entrega_tipo'         => $this->input->post('entrega_tipo'),
					'mercadoria_tipo'      => $this->input->post('mercadoria_tipo'),
					'destinatario_cnpj'    => $this->input->post('destinatario_cnpj'),
					'destinatario_nome'    => $this->input->post('destinatario_nome'),
					'destinatario_unidade' => $this->input->post('destinatario_unidade'),
					'rota'                 => $this->input->post('rota'),
					'observacoes'          => $this->input->post('observacoes')
				);
				if ($this->viagens_model->editar_registro('reg_viagens', $id, $dados_viagem) == true) {
					$this->session->set_flashdata('sucesso', 'Viagem alterada com sucesso.');
					$data['view'] = 'viagens/formulario';
				} elseif ($this->viagens_model->editar_registro('reg_viagens', $id, $dados_viagem) == false) {
					$this->session->set_flashdata('erro', 'Não houve alterações no registro.');
					$data['view'] = 'viagens/formulario';
				}
			}
		} elseif ($this->input->post('finalizar') == 'ok') {
			if ($this->form_validation->run('registrar_saida') == false) {
				$data['view'] = 'viagens/formulario';
			} else {
				$str_search = array('.', ',');
				$str_replace = array('', '.');
				$dados_viagem = array(
					'status_viagem'        => 2,
					'saida_data'         => date('Y-m-d H:i:s'),
					'saida_usuario'      => $this->viagens_model->usuario_atual(),
					'carga_risco'          => $this->input->post('carga_risco'),
					'carga_escolta'        => $this->input->post('carga_escolta'),
					'dt_num'               => $this->input->post('dt_num'),
					'motorista_cpf'        => $this->input->post('motorista_cpf'),
					'motorista_nome'       => $this->input->post('motorista_nome'),
					'placa_trator'         => $this->input->post('placa_trator'),
					'placa_reboque_1'      => $this->input->post('placa_reboque_1'),
					'placa_reboque_2'      => $this->input->post('placa_reboque_2'),
					'transp_nome'          => $this->input->post('transp_nome'),
					'transp_unidade'       => $this->input->post('transp_unidade'),
					'operacao_nome'        => $this->input->post('operacao_nome'),
					'operacao_unidade'     => $this->input->post('operacao_unidade'),
					'notas_fiscais'        => $this->input->post('notas_fiscais'),
					'valor'                => str_replace($str_search, $str_replace, $this->input->post('valor')),
					'peso'                 => str_replace($str_search, $str_replace, $this->input->post('peso')),
					'entrega_tipo'         => $this->input->post('entrega_tipo'),
					'mercadoria_tipo'      => $this->input->post('mercadoria_tipo'),
					'destinatario_cnpj'    => $this->input->post('destinatario_cnpj'),
					'destinatario_nome'    => $this->input->post('destinatario_nome'),
					'destinatario_unidade' => $this->input->post('destinatario_unidade'),
					'rota'                 => $this->input->post('rota'),
					'observacoes'          => $this->input->post('observacoes')
				);
				if ($this->viagens_model->editar_registro('reg_viagens', $id, $dados_viagem) == true) {
					$this->session->set_flashdata('sucesso', 'Viagem finalizada com sucesso.');
					$data['view'] = 'viagens/formulario';
				} elseif ($this->viagens_model->editar_registro('reg_viagens', $id, $dados_viagem) == false) {
					$this->session->set_flashdata('erro', 'Viagem não finalizada.');
					$data['view'] = 'viagens/formulario';
				}
			}
		}
		/* Conclusão */
		$this->load->view('templates/header', $data);
		$this->load->view('templates/footer');
	}

	public function finalizar($id)
	{
		$data['id'] = $id;
		$this->load->view('viagens/teste', $data);
	}

	public function visualizar($id)
	{
		$data['registros'] = $this->viagens_model->buscar_registro('reg_viagens', $id);
		if (isset($data['registros'])) {
			$this->load->view('viagens/visualizar', $data);
		}
	}

	public function remover($id)
	{
		if ($this->input->post('remover') == 'ok' && $this->viagens_model->remover('reg_viagens', $id) == true) :
			$this->session->set_flashdata('remover_sucesso', 'Viagem removida com sucesso.');
			redirect('viagens');
		else :
			show_404('', FALSE);
		endif;
	}
}
