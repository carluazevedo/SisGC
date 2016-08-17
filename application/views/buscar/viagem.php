<?php
$titulos = array(
		'Número DT:',
		'Status da viagem:',
		'Data de entrada:',
		'Data de saída:',
		'Carga de alto risco:',
		'Carga escoltada:',
		'Nome do motorista:',
		'CPF do motorista:',
		'Placa do trator:',
		'Placa do reboque 1:',
		'Placa do reboque 2:',
		'Transportadora:',
		'Origem:',
		'Valor total:',
		'Peso total:',
		'Notas fiscais:',
		'Tipo de entrega:',
		'Tipo de mercadoria:',
		'Destinatário:',
		'CNPJ:',
		'Rota:',
		'Observações:'
);
$dados = array(
		$registros->dt_num,
		$this->buscar_model->status_viagem_pn($registros->status_viagem, 'texto'),
		$registros->entrada_data,
		$registros->saida_data,
		$registros->carga_risco,
		$registros->carga_escolta,
		$registros->motorista_nome,
		$registros->motorista_cpf,
		$registros->placa_trator,
		$registros->placa_reboque_1,
		$registros->placa_reboque_2,
		$registros->transp_nome,
		$registros->operacao_nome,
		$registros->valor,
		$registros->peso,
		$registros->notas_fiscais,
		$registros->entrega_tipo,
		$registros->mercadoria_tipo,
		$registros->destinatario_nome,
		$registros->destinatario_cnpj,
		$registros->rota,
		$registros->observacoes
);
$dados_length = count($dados);
?>
<table class="table table-condensed table-hover small">
<?php for ($i = 0; $i < $dados_length; $i++) : ?>
	<tr>
		<td><?php echo $titulos[$i]; ?></td>
		<td><?php echo $dados[$i]; ?></td>
	</tr>
<?php endfor; ?>
</table>
