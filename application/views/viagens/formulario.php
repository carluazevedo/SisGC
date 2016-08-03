<?php $this->load->view('templates/navbar.php'); ?>
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

				<!-- Formulário de registro -->
				<?php echo form_open('', array('class' => 'form-horizontal','id' => 'registro' ,'onsubmit' => 'converterCaixaAlta()')); ?>
					<fieldset id="dt">
						<legend>DT</legend>
						<div class="form-group">
							<label for="dt_num" class="col-sm-2 control-label">Número DT</label>
							<div class="col-sm-3">
								<input type="text" name="dt_num" id="dt_num" class="form-control input-sm" value="<?php echo set_value('dt_num', $dt_num); ?>" />
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
								<div class="col-sm-3">
									<input type="text" name="motorista_cpf" id="motorista_cpf" class="form-control input-sm" maxlength="14" value="<?php echo set_value('motorista_cpf', $motorista_cpf); ?>" />
								</div>

								<label for="motorista_nome" class="control-label sr-only">Nome</label>
								<div class="col-sm-3">
									<input type="text" name="motorista_nome" id="motorista_nome" class="form-control input-sm" placeholder="Nome" value="<?php echo set_value('motorista_nome', $motorista_nome); ?>" /><!-- readonly -->
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
							<label for="notas_fiscais" class="col-sm-2 control-label">Notas fiscais</label>
							<div class="col-sm-3">
								<input type="text" name="notas_fiscais" id="notas_fiscais" class="form-control input-sm" value="<?php echo set_value('notas_fiscais', $notas_fiscais); ?>" />
							</div>
							<div class="col-sm-5 col-md-4 custom-error">
								<?php echo form_error('notas_fiscais'),PHP_EOL; ?>
							</div>
						</div><!-- /.form-group -->

						<div class="form-group">
							<label for="entrega_tipo" class="col-sm-2 control-label">Tipo de entrega</label>
							<div class="col-sm-3">
								<select name="entrega_tipo" class="form-control input-sm">
									<option value=""></option>
									<option value="ent_unic" <?php echo set_select('entrega_tipo', 'ent_unic', $ent_unic); ?>>ENTREGA ÚNICA</option>
									<option value="ent_frac" <?php echo set_select('entrega_tipo', 'ent_frac', $ent_frac); ?>>ENTREGA FRACIONADA</option>
									<option value="transfer" <?php echo set_select('entrega_tipo', 'transfer', $transfer); ?>>TRANSFERÊNCIA</option>
									<option value="circ_est" <?php echo set_select('entrega_tipo', 'circ_est', $circ_est); ?>>CIRCUITO ESTÁTICO</option>
								</select>
							</div>
						</div><!-- /.form-group -->

						<div class="form-group">
							<label for="mercadoria_tipo" class="col-sm-2 control-label">Tipo de mercadoria</label>
							<div class="col-sm-3">
								<select name="mercadoria_tipo" class="form-control input-sm">
									<option value=""></option>
									<option value="hpc" <?php echo set_select('mercadoria_tipo', 'hpc', $hpc); ?>>HPC</option>
									<option value="foods" <?php echo set_select('mercadoria_tipo', 'foods', $foods); ?>>FOODS</option>
									<option value="hpc_foods" <?php echo set_select('mercadoria_tipo', 'hpc_foods', $hpc_foods); ?>>HPC/FOODS</option>
								</select>
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
								<input type="text" name="destinatario_nome" id="destinatario_nome" class="form-control input-sm" placeholder="Nome" readonly value="<?php echo set_value('destinatario_nome', $destinatario_nome); ?>" />
							</div>

							<label for="destinatario_unidade" class="control-label sr-only">Unidade</label>
							<div class="col-sm-3">
								<input type="text" name="destinatario_unidade" id="destinatario_unidade" class="form-control input-sm" placeholder="Unidade" readonly value="<?php echo set_value('destinatario_unidade', $destinatario_unidade); ?>" />
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
							<div class="col-sm-5 col-md-4 custom-error">
								<?php echo form_error('rota'),PHP_EOL; ?>
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
<nav id="navbar-bottom" class="navbar navbar-inverse navbar-fixed-bottom">
	<div class="container-fluid">
		<div class="navbar-form navbar-left">
			<button type="submit" class="btn btn-success form-control" form="registro" value="ok" name="<?php echo (isset($operacao) && $operacao == 'editar') ? 'gravar' : 'registrar' ; ?>">
			<?php if (isset($operacao) && $operacao == 'editar') : ?>
				<small><span class="glyphicon glyphicon-ok"></span></small> Gravar
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
<!-- <?php print_r($_POST); ?> -->