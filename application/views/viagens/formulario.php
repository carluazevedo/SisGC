<?php $this->load->view('templates/navbar.php'); ?>
<!-- Modal 'editar' -->
<div class="modal fade bs-example-modal-sm" id="modal-editar" tabindex="-1" role="dialog" aria-labelledby="EditarViagem">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<small><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></small> Editar registro incompleto
				</h4>
			</div>
			<div class="modal-body">
				<p>Deseja confirmar a edição dos dados antes de finalizar a viagem?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" id="ajuda" title="Ajuda"><span class="glyphicon glyphicon-question-sign"></span></button>
				<button type="submit" class="btn btn-success" id="editar" name="editar" value="ok" form="registrar-viagem">Sim</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /Modal 'editar' -->

<!-- Modal 'ajuda' -->
<div class="modal fade" id="modal-ajuda" tabindex="-1" role="dialog" aria-labelledby="AjudaEditarViagem">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<small><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></small> Ajuda
				</h4>
			</div>
			<div class="modal-body">
				<p class="lead">Por que estou vendo esta mensagem?</p>
				<p>Isto acontece porque o formulário de registro está <strong>parcialmente preenchido</strong>.</p>
				<p>Se todos os campos estiverem preenchidos a viagem será <strong>finalizada</strong>, caso contrário aparecerá esta mensagem.</p>
				<p>
					Mas &mdash; <strong>para fins de correção</strong>, alterações feitas no registro podem ser gravadas antes de finalizar a viagem,
					bastando apenas confirmar a edição clicando em <strong>'Sim'</strong>.
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /Modal 'ajuda' -->

<!-- Modal 'finalizar' -->
<div class="modal fade bs-example-modal-sm" id="modal-finalizar" tabindex="-1" role="dialog" aria-labelledby="FinalizarViagem">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<small><span class="glyphicon glyphicon-save"></span></small> Finalizar viagem
				</h4>
			</div>
			<div class="modal-body">
				<p>Deseja realmente finalizar esta viagem?</p>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success" id="confirma-finalizar" name="confirma-finalizar" value="ok" form="registrar-viagem">Sim</button>
				<button type="submit" class="btn btn-primary" id="confirma-editar" name="confirma-editar" value="ok" form="registrar-viagem">Não</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /Modal 'finalizar' -->

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
					<h1><?php echo $titulo_pagina; ?></h1>
				</div>
				<?php if (isset($operacao) && $operacao == 'editar') : ?>
				<!-- Painel de informações -->
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-sm-3 col-md-2">
							<div>
								<span class="info-title">Status</span>
								<span class="label <?php echo $this->viagens_model->status_viagem_pn($status_viagem, 'contexto'); ?>">
									<?php echo $this->viagens_model->status_viagem_pn($status_viagem, 'texto'); ?>
								</span>
							</div>
						</div>

						<div class="col-sm-4 col-md-3">
							<div>
								<span class="info-title">Entrada</span>
								<span class="label label-default">
									<?php echo (isset($entrada_data) && $entrada_data != '-') ? $entrada_data : '00/00/0000 00:00' ; ?>
								</span>
							</div>
							<div>
								<span class="info-title">Usuário</span>
								<span class="label label-default">
									<a class="info-link" href="#">
										<?php echo (isset($entrada_usuario) && $entrada_usuario != '') ? $entrada_usuario : 'INDEFINIDO' ; ?>
									</a>
								</span>
							</div>
						</div>

						<div class="col-sm-4 col-md-3">
							<div>
								<span class="info-title">Saída</span>
								<span class="label label-default">
									<?php echo (isset($saida_data) && $saida_data != '-') ? $saida_data : '00/00/0000 00:00' ; ?>
								</span>
							</div>
							<div>
								<span class="info-title">Usuário</span>
								<span class="label label-default">
									<a class="info-link" href="#">
										<?php echo (isset($saida_usuario) && $saida_usuario != '') ? $saida_usuario : 'INDEFINIDO' ; ?>
									</a>
								</span>
							</div>
						</div>
						<?php if (isset($carga_risco) && $carga_risco == true) : ?>
						<div class="col-sm-4 col-md-3">
							<div>
								<span class="info-title">Risco</span>
								<span class="label label-danger">CARGA PERIGOSA</span>
							</div>
						</div>
						<?php endif; ?>
					</div><!-- /.panel-body -->
				</div><!-- /.panel-default -->
				<?php endif; ?>

				<?php if ($this->session->flashdata('sucesso') != null) : ?>
				<div class="alert alert-success alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<span class="glyphicon glyphicon-ok-sign"></span> <?php echo $this->session->flashdata('sucesso'); ?>
					<?php if ($this->session->flashdata('sem_opcao_voltar') != 'ok') : ?>
					<button class="btn btn-xs btn-success" onclick="location.href='<?php echo site_url('viagens'); ?>'">
						<small><span class="glyphicon glyphicon-arrow-left"></span></small> Voltar
					</button>
					<?php endif; ?>
				</div>
				<?php elseif ($this->session->flashdata('erro') != null) : ?>
				<div class="alert alert-warning alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<span class="glyphicon glyphicon-alert"></span> <?php echo $this->session->flashdata('erro'); ?>
					<?php if ($this->session->flashdata('sem_opcao_voltar') != 'ok') : ?>
					<button class="btn btn-xs btn-warning" onclick="location.href='<?php echo site_url('viagens'); ?>'">
						<small><span class="glyphicon glyphicon-arrow-left"></span></small> Voltar
					</button>
					<?php endif; ?>
				</div>
				<?php endif; ?>

				<!-- Formulário de registro -->
				<?php echo form_open('', array('class' => 'form-horizontal','id' => 'registrar-viagem' ,'onsubmit' => 'converterCaixaAlta()')); ?>
					<fieldset id="dt">
						<legend>DT</legend>
						<div class="form-group">
							<label for="dt_num" class="col-sm-2 control-label">Número DT</label>
							<div class="col-sm-3">
								<input type="text" name="dt_num" id="dt_num" class="form-control input-sm" value="<?php echo set_value('dt_num', $dt_num); ?>" autofocus/>
							</div>
							<div class="col-sm-5 col-md-4 custom-error">
								<?php echo form_error('dt_num'),PHP_EOL; ?>
							</div>
						</div><!-- /.form-group -->
					</fieldset><!-- DT -->

					<fieldset id="motorista">
						<legend>Motorista</legend>
							<div class="form-group row">
								<label for="motorista_cpf" class="col-sm-2 control-label">CPF</label>
								<div class="col-sm-4 col-md-3">
									<div class="input-group input-group-sm">
										<input type="text" name="motorista_cpf" id="motorista_cpf" class="form-control" maxlength="14" value="<?php echo set_value('motorista_cpf', $motorista_cpf); ?>" />
										<span class="input-group-btn">
											<button class="btn btn-default" type="button" title="Buscar cadastro" disabled><span class="glyphicon glyphicon-search"></span></button>
											<button class="btn btn-default" type="button" title="Editar cadastro" disabled><span class="glyphicon glyphicon-edit"></span></button>
										</span>
									</div>
								</div>

								<label for="motorista_nome" class="control-label sr-only">Nome</label>
								<div class="col-sm-4 col-md-3">
									<input type="text" name="motorista_nome" id="motorista_nome" class="form-control input-sm" placeholder="Nome" value="<?php echo set_value('motorista_nome', $motorista_nome); ?>" readonly/>
								</div>
								<div class="col-sm-4 col-md-3 custom-error">
									<?php echo form_error('motorista_cpf'),PHP_EOL; ?>
								</div>
							</div><!-- /.form-group .row -->
					</fieldset><!-- Motorista -->

					<fieldset id="veiculo">
						<legend>Veículo</legend>
						<div class="form-group">
							<label for="placa_trator" class="col-sm-2 control-label">Trator</label>
							<div class="col-sm-3">
								<input type="text" name="placa_trator" id="placa_trator" class="form-control input-sm" value="<?php echo set_value('placa_trator', $placa_trator); ?>" />
							</div>
							<div class="col-sm-5 col-md-4 custom-error">
								<?php echo form_error('placa_trator'),PHP_EOL; ?>
							</div>
						</div><!-- /.form-group -->

						<div class="form-group">
							<label for="placa_reboque_1" class="col-sm-2 control-label">Reboque 1</label>
							<div class="col-sm-3">
								<input type="text" name="placa_reboque_1" id="placa_reboque_1" class="form-control input-sm" value="<?php echo set_value('placa_reboque_1', $placa_reboque_1); ?>" />
							</div>
							<div class="col-sm-5 col-md-4 custom-error">
								<?php echo form_error('placa_reboque_1'),PHP_EOL; ?>
							</div>
						</div><!-- /.form-group -->

						<div class="form-group">
							<label for="placa_reboque_2" class="col-sm-2 control-label">Reboque 2</label>
							<div class="col-sm-3">
								<input type="text" name="placa_reboque_2" id="placa_reboque_2" class="form-control input-sm" value="<?php echo set_value('placa_reboque_2', $placa_reboque_2); ?>" />
							</div>
						</div><!-- /.form-group -->
					</fieldset><!-- Veículo -->

					<fieldset id="transportadora">
						<legend>Transportadora</legend>
						<div class="form-group row">
							<label for="transp_nome" class="col-sm-2 control-label">Nome</label>
							<div class="col-sm-3">
								<input type="text" name="transp_nome" id="transp_nome" class="form-control input-sm" value="<?php echo set_value('transp_nome', $transp_nome); ?>" />
							</div>

							<label for="transp_unidade" class="control-label sr-only">Unidade</label>
							<div class="col-sm-3">
								<input type="text" name="transp_unidade" id="transp_unidade" class="form-control input-sm" placeholder="Unidade" value="<?php echo set_value('transp_unidade', $transp_unidade); ?>" /><!-- readonly -->
							</div>
							<div class="col-sm-4 col-md-3 custom-error">
								<?php echo form_error('transp_nome'),PHP_EOL; ?>
							</div>
						</div><!-- /.form-group .row -->
					</fieldset><!-- Transportadora -->

					<fieldset id="operacao-origem">
						<legend>Operação de origem</legend>
						<div class="form-group row">
							<label for="operacao_nome" class="col-sm-2 control-label">Nome</label>
							<div class="col-sm-3">
								<input type="text" name="operacao_nome" id="operacao_nome" class="form-control input-sm" value="<?php echo set_value('operacao_nome', $operacao_nome); ?>" />
							</div>

							<label for="operacao_unidade" class="control-label sr-only">Unidade</label>
							<div class="col-sm-3">
								<input type="text" name="operacao_unidade" id="operacao_unidade" class="form-control input-sm" placeholder="Unidade" value="<?php echo set_value('operacao_unidade', $operacao_unidade); ?>" /><!-- readonly -->
							</div>
							<div class="col-sm-4 col-md-3 custom-error">
								<?php echo form_error('operacao_nome'),PHP_EOL; ?>
							</div>
						</div><!-- /.form-group .row -->
					</fieldset><!-- Operação de origem -->

					<fieldset id="entrega">
						<legend>Entrega</legend>
						<div class="form-group">
							<label for="notas_fiscais" class="col-sm-2 control-label">Notas fiscais</label>
							<div class="col-sm-3">
								<input type="text" name="notas_fiscais" id="notas_fiscais" class="form-control input-sm" value="<?php echo set_value('notas_fiscais', $notas_fiscais); ?>" />
							</div>
							<div class="col-sm-5 col-md-4 custom-error">
								<?php echo form_error('notas_fiscais'),PHP_EOL; ?>
							</div>
						</div><!-- /.form-group -->

						<div class="form-group">
							<label for="valor" class="col-sm-2 control-label">Valor total</label>
							<div class="col-sm-3">
								<input type="text" name="valor" id="valor" class="form-control input-sm" maxlength="14" value="<?php echo set_value('valor', $valor); ?>" />
							</div>
							<div class="col-sm-5 col-md-4 custom-error">
								<?php echo form_error('valor'),PHP_EOL; ?>
							</div>
						</div><!-- /.form-group -->

						<div class="form-group">
							<label for="peso" class="col-sm-2 control-label">Peso total</label>
							<div class="col-sm-3">
								<input type="text" name="peso" id="peso" class="form-control input-sm" maxlength="15" value="<?php echo set_value('peso', $peso); ?>" />
							</div>
							<div class="col-sm-5 col-md-4 custom-error">
								<?php echo form_error('peso'),PHP_EOL; ?>
							</div>
						</div><!-- /.form-group -->

						<div class="form-group">
							<label for="entrega_tipo" class="col-sm-2 control-label">Tipo de entrega</label>
							<div class="col-sm-3">
								<select name="entrega_tipo" id="entrega_tipo" class="form-control input-sm">
									<option value=""></option>
									<option value="ent_unic" <?php echo set_select('entrega_tipo', 'ent_unic', $ent_unic); ?>>ENTREGA ÚNICA</option>
									<option value="ent_frac" <?php echo set_select('entrega_tipo', 'ent_frac', $ent_frac); ?>>ENTREGA FRACIONADA</option>
									<option value="transfer" <?php echo set_select('entrega_tipo', 'transfer', $transfer); ?>>TRANSFERÊNCIA</option>
									<option value="circ_est" <?php echo set_select('entrega_tipo', 'circ_est', $circ_est); ?>>CIRCUITO ESTÁTICO</option>
								</select>
							</div>
							<div class="col-sm-5 col-md-4 custom-error">
								<?php echo form_error('entrega_tipo'),PHP_EOL; ?>
							</div>
						</div><!-- /.form-group -->

						<div class="form-group">
							<label for="mercadoria_tipo" class="col-sm-2 control-label">Tipo de mercadoria</label>
							<div class="col-sm-3">
								<select name="mercadoria_tipo" id="mercadoria_tipo" class="form-control input-sm">
									<option value=""></option>
									<option value="hpc" <?php echo set_select('mercadoria_tipo', 'hpc', $hpc); ?>>HPC</option>
									<option value="foods" <?php echo set_select('mercadoria_tipo', 'foods', $foods); ?>>FOODS</option>
									<option value="hpc_foods" <?php echo set_select('mercadoria_tipo', 'hpc_foods', $hpc_foods); ?>>HPC/FOODS</option>
								</select>
							</div>
							<div class="col-sm-5 col-md-4 custom-error">
								<?php echo form_error('mercadoria_tipo'),PHP_EOL; ?>
							</div>
						</div><!-- /.form-group -->
					</fieldset><!-- Entrega -->

					<fieldset id="destinatario">
						<legend>Destinatário</legend>
						<div class="form-group row">
							<label for="destinatario_cnpj" class="col-sm-2 control-label">CNPJ</label>
							<div class="col-sm-3">
								<input type="text" name="destinatario_cnpj" id="destinatario_cnpj" class="form-control input-sm" maxlength="18" value="<?php echo set_value('destinatario_cnpj', $destinatario_cnpj); ?>" data-toggle="tooltip" data-placement="top" title="Formato: 00.000.000/0000-00" />
							</div>

							<label for="destinatario_nome" class="control-label sr-only">Nome</label>
							<div class="col-sm-3">
								<input type="text" name="destinatario_nome" id="destinatario_nome" class="form-control input-sm" placeholder="Nome" value="<?php echo set_value('destinatario_nome', $destinatario_nome); ?>" /><!-- readonly -->
							</div>

							<label for="destinatario_unidade" class="control-label sr-only">Unidade</label>
							<div class="col-sm-3">
								<input type="text" name="destinatario_unidade" id="destinatario_unidade" class="form-control input-sm" placeholder="Unidade" value="<?php echo set_value('destinatario_unidade', $destinatario_unidade); ?>" /><!-- readonly -->
							</div>
							<div class="col-sm-offset-2 col-sm-5 col-md-4 custom-error">
								<?php echo form_error('destinatario_cnpj'),PHP_EOL; ?>
							</div>
						</div><!-- /.form-group .row -->

						<div class="form-group">
							<label for="rota" class="col-sm-2 control-label">Rota</label>
							<div class="col-sm-3">
								<input type="text" name="rota" id="rota" class="form-control input-sm" value="<?php echo set_value('rota', $rota); ?>" />
							</div>
						</div><!-- /.form-group -->
					</fieldset><!-- Destinatário -->

					<fieldset id="info-adicionais">
						<legend>Informações adicionais</legend>
						<div class="form-group">
							<label for="observacoes" class="col-sm-2 control-label">Observações</label>
							<div class="col-sm-3">
								<input type="text" name="observacoes" id="observacoes" class="form-control input-sm" value="<?php echo set_value('observacoes', $observacoes); ?>" />
							</div>
						</div><!-- /.form-group -->
					</fieldset><!-- Informações adicionais -->

					<!-- <div class="form-group row">
						<label class="control-label sr-only">Registrar</label>
						<div class="col-sm-offset-2 col-sm-3 col-md-2">
							<button type="submit" name="registrar" value="ok" class="btn btn-success form-control">
								<small><span class="glyphicon glyphicon-plus"></span></small> Registrar
							</button>
						</div>
						<div class="col-sm-3 col-md-2">
							<button type="button" class="btn btn-primary form-control" onclick="location.href='<?php #echo site_url('viagens'); ?>'">
								<small><span class="glyphicon glyphicon-arrow-left"></span></small> Voltar
							</button>
						</div>
					</div><!-- /.form-group -->
				<?php echo form_close('<!-- .form-horizontal -->').PHP_EOL; ?>
			</div><!-- /.col-sm-12 -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
<nav id="navbar-bottom" class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-form navbar-left">
			<button type="submit" class="btn btn-success form-control" id="registrar" name="registrar" value="ok" form="registrar-viagem">
			<?php if (isset($operacao) && $operacao == 'editar') : ?>
				<small><span class="glyphicon glyphicon-save"></span></small> Finalizar
			<?php else : ?>
				<small><span class="glyphicon glyphicon-plus"></span></small> Registrar
			<?php endif; ?>
			</button>
			<button type="button" class="btn btn-primary form-control" onclick="location.href='<?php echo site_url('viagens'); ?>'">
				<small><span class="glyphicon glyphicon-arrow-left"></span></small> Voltar
			</button>
		</div>
	</div>
</nav>