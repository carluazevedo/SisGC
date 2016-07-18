<?php $this->load->view('templates/navbar'); ?>
<section>
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
					<td class="text-center info" id="acao-editar">
						<a href="#" title="Editar">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
					</td>
					<td class="text-center danger" id="acao-remover">
						<a href="#" title="Remover">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						</a>
					</td>
					<td class="text-center success" id="acao-visualizar">
						<a href="#" title="Remover">
							<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<!-- Última linha em branco da tabela -->
				<tr>
					<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
			</tfoot>
		</table>
	</div><!-- .table-responsive -->
</section>