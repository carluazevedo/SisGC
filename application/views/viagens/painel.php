<?php $this->load->view('templates/navbar'); ?>
<!-- Modal 'visualizar' markup -->
<div class="modal fade bs-example-modal-lg" id="modal-visualizar" tabindex="-1" role="dialog" aria-labelledby="dicasModalVisualizar">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<small><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></small> Visualizar viagem
				</h4>
			</div>
			<div class="modal-body">
				<p></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /Modal 'visualizar' markup -->

<!-- Modal 'excluir' markup -->
<div class="modal fade bs-example-modal-sm" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="dicasModalExcluir">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<small><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></small> Excluir viagem
				</h4>
			</div>
			<div class="modal-body">
				<p>Deseja realmente excluir esta viagem?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-danger" onclick="excluirViagem()">Excluir</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /Modal 'excluir' markup -->
<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h1><?php echo $titulo_pagina; ?></h1>
				<div class="table-responsive">
					<table class="table table-condensed table-hover"><!-- table-bordered -->
						<thead>
							<tr class="active">
								<th>NÚMERO DT</th>
								<th>STATUS</th>
								<th>DATA ENTRADA</th>
								<th>DATA SAÍDA</th>
								<th>MOTORISTA</th>
								<th>TRATOR</th>
								<th>REBOQUE</th>
								<th>TRANSPORTADORA</th>
								<th>ORIGEM</th>
								<th colspan="3">AÇÕES</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($viagens as $col) : ?>
							<tr>
								<td><?php echo $col->dt_num; ?></td>
								<?php echo $this->viagens_model->status_viagem_tb($col->status_viagem); ?>
								<td><?php echo $this->viagens_model->formata_data_mysql($col->entrada_data); ?></td>
								<td><?php echo $this->viagens_model->formata_data_mysql($col->saida_data); ?></td>
								<td><?php echo $col->motorista_nome; ?></td>
								<td><?php echo $col->placa_trator; ?></td>
								<td><?php echo $col->placa_reboque_1; ?></td>
								<td><?php echo $col->transp_nome; ?></td>
								<td><?php echo $col->operacao_nome.' - '.$col->operacao_unidade; ?></td>
								<td class="text-center success" id="acao-visualizar">
									<a href="#" id="visualizar" data-toggle="modal" data-target="#modal-visualizar" title="Visualizar">
										<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
									</a>
								</td>
								<td class="text-center info" id="acao-editar">
									<a href="#" title="Editar">
										<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
									</a>
								</td>
								<td class="text-center danger" id="acao-excluir">
									<a href="#" id="excluir" data-toggle="modal" data-target="#modal-excluir" title="Excluir">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<!-- Última linha em branco da tabela -->
							<tr>
							</tr>
						</tfoot>
					</table>
				</div><!-- /.table-responsive -->
			</div><!-- /.col-sm-12 -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</section>

<script>
	function inserirLinhaTabela() {
		t_length = document.querySelector('tbody tr').childElementCount;
		t_footer = document.querySelector('tfoot tr');

		for (t = 0; t < t_length; t++) {
			t_coluns = document.createElement('TD');
			t_footer.appendChild(t_coluns);
		}
	}

	function excluirViagem() {
		location.href = '<?php echo site_url('viagens/excluir'); ?>';
	}

	/* Execução da função */
	inserirLinhaTabela();
</script>