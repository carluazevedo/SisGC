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
		/* Informações para 'cabecalho.php' */
		$data['titulo']            = $this->titulo;
		$data['incluir_cabecalho'] = array(link_tag('styles/custom.css'));
		$data['view']              = 'viagens/painel';
		/* Informações para 'view' */
		$data['titulo_pagina'] = 'Viagens registradas';
		/* Informações para 'rodape.php' */
		$data['incluir_rodape'] = array('<script src="'.base_url('scripts/ajax_lib.js').'"></script>');
		$data['scripts_rodape'] = 'viagens/painel_scripts';
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
		$this->load->view('modelos/cabecalho', $data);
		$this->load->view('modelos/rodape', $data);
	}

	public function registrar()
	{
		/* Informações para 'cabecalho.php' */
		$data['titulo']         = $this->titulo.' - Registrar';
		$data['incluir_cabecalho'] = array(link_tag('styles/custom.css'));
		/* Informações para 'view' */
		$data['titulo_pagina'] = 'Registrar viagem';
		$data['nav_registrar'] = true;
		$data['operacao']      = 'registrar';
		/* Informações para 'rodape.php' */
		$data['incluir_rodape'] = array(
			'<script src="'.base_url('scripts/jquery-mask/jquery.mask.min.js').'"></script>',
			'<script src="'.base_url('scripts/ajax_motorista.js').'"></script>'
		);
		$data['scripts_rodape'] = 'viagens/formulario_scripts';
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
				redirect('viagens/editar/'.$ultimo_id.'/1');
			else :
				$data['view'] = 'viagens/formulario';
			endif;
		}
		/* Conclusão */
		$this->load->view('modelos/cabecalho', $data);
		$this->load->view('modelos/rodape', $data);
	}

	public function editar($id, $status_viagem = '')
	{
		/* Informações para 'cabecalho.php' */
		$data['titulo']         = $this->titulo.' - Editar';
		$data['incluir_cabecalho'] = array(link_tag('styles/custom.css'));
		$data['view']           = 'viagens/formulario';
		/* Informações para 'view' */
		$data['titulo_pagina'] = 'Editar viagem';
		$data['operacao']      = 'editar';
		/* Informações para 'rodape.php' */
		$data['incluir_rodape'] = array('<script src="'.base_url('scripts/jquery-mask/jquery.mask.min.js').'"></script>');
		$data['scripts_rodape'] = 'viagens/formulario_scripts';
		/* Lógica do controlador */
		/* ->Preenchimento dos valores dos campos */
		$dados = $this->viagens_model->preencher_valores('reg_viagens', 'id', $id);
		$dados_length = count($dados);
		$dados_keys = array_keys($dados);
		$dados_vals = array_values($dados);
		for ($i = 0; $i < $dados_length; $i++) {
			$data[$dados_keys[$i]] = $dados_vals[$i];
		}
		/* ->Validação de formulário */
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="form-control-static">', '</p>');
		/* ->Finalizar viagem */
		if ($this->input->post('finalizar') == 'ok' && $this->form_validation->run('registrar_saida') == false) {
			if ($data['status_viagem'] == 2) {
				$this->session->set_flashdata('erro', '<strong>Atenção:</strong> Viagem já finalizada.');
				redirect('viagens/editar/'.$id.'/'.$data['status_viagem']);
			} else {
				$data['finalizar_status'] = false; /* Ativa o 'modal-editar' */
				$this->session->set_flashdata('sem_opcao_voltar', 'ok');
				$this->session->set_flashdata('erro', '<strong>Atenção:</strong> Verificar campos não preenchidos.');
				$data['view'] = 'viagens/formulario';
			}
		} elseif ($this->input->post('finalizar') == 'ok' && $this->form_validation->run('registrar_saida') == true) {
			if ($data['status_viagem'] == 2) {
				$this->session->set_flashdata('erro', '<strong>Atenção:</strong> Viagem já finalizada.');
				redirect('viagens/editar/'.$id.'/'.$data['status_viagem']);
			} else {
				$data['finalizar_status'] = true; /* Ativa o 'modal-finalizar' */
				$data['view'] = 'viagens/formulario';
			}
		}
		if ($this->input->post('confirma-finalizar') == 'ok' && $data['status_viagem'] == 1) {
			$str_search = array('.', ',');
			$str_replace = array('', '.');
			$dados_viagem = array(
					'status_viagem'        => 2,
					'saida_data'           => date('Y-m-d H:i:s'),
					'saida_usuario'        => $this->viagens_model->usuario_atual(),
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
				redirect('viagens/editar/'.$id.'/2');
			} elseif ($this->viagens_model->editar_registro('reg_viagens', $id, $dados_viagem) == false) {
				$this->session->set_flashdata('erro', '<strong>Atenção:</strong> Viagem não finalizada.');
				redirect('viagens/editar/'.$id.'/'.$data['status_viagem']);
			}
		}
		/* ->Editar viagem */
		if (($this->input->post('editar') == 'ok' || $this->input->post('confirma-editar') == 'ok') && $this->form_validation->run('registrar_entrada') == false) {
			$data['view'] = 'viagens/formulario';
		} elseif (($this->input->post('editar') == 'ok' || $this->input->post('confirma-editar') == 'ok') && $this->form_validation->run('registrar_entrada') == true) {
			$str_search = array('.', ',');
			$str_replace = array('', '.');
			$dados_viagem = array(
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
				redirect('viagens/editar/'.$id.'/'.$data['status_viagem']);
			} elseif ($this->viagens_model->editar_registro('reg_viagens', $id, $dados_viagem) == false) {
				$this->session->set_flashdata('erro', '<strong>Atenção:</strong> Não houve alterações no registro.');
				redirect('viagens/editar/'.$id.'/'.$data['status_viagem']);
			}
		}
		/* Conclusão */
		$this->load->view('modelos/cabecalho', $data);
		$this->load->view('modelos/rodape', $data);
	}

	public function remover($id)
	{
		if ($this->input->post('remover') == 'ok' && $this->viagens_model->remover('reg_viagens', $id) == true) :
			$this->session->set_flashdata('sucesso', 'Viagem removida com sucesso.');
			redirect('viagens');
		else :
			show_404('', FALSE);
		endif;
	}
}
