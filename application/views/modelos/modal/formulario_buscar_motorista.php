<!-- Modal 'buscar-motorista' -->
<div class="modal fade" id="modal-buscar-motorista" tabindex="-1" role="dialog" aria-labelledby="BuscarMotorista">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span class="glyphicon glyphicon-search small"></span> Buscar motorista
				</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="alert alert-success alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							<span class="glyphicon glyphicon-ok-sign small"></span> Informe o CPF <strong>OU</strong> o Nome do motorista.
						</div>
						<div class="form-group">
							<label for="cpf">CPF</label>
							<div class="input-group">
								<input type="text" class="form-control" id="cpf">
								<span class="input-group-btn">
									<button class="btn btn-primary" type="button" title="Buscar motorista pelo CPF" onclick="buscarMotorista('cpf')">
										<span class="glyphicon glyphicon-search small"></span> Buscar
									</button>
								</span>
							</div>
						</div><!-- /.form-group -->
						<div class="form-group">
							<label for="nome">Nome</label>
							<div class="input-group">
								<input type="text" class="form-control" id="nome">
								<span class="input-group-btn">
									<button class="btn btn-primary" type="button" title="Buscar motorista pelo Nome" onclick="buscarMotorista('nome')">
										<span class="glyphicon glyphicon-search small"></span> Buscar
									</button>
								</span>
							</div>
						</div><!-- /.form-group -->
						<p class="custom-error"></p>
						<div class="table-responsive">
							<table class="table table-hover table-condensed" id="tabela-resultados">
								<thead>
									<tr class="active">
										<th>NOME</th>
										<th>CPF</th>
									</tr>
								</thead>
							</table>
						</div>
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal" id="fechar-busca">Fechar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /Modal 'buscar-motorista' -->
