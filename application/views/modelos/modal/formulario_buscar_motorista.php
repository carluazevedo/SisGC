<!-- Modal 'buscar' -->
<div class="modal fade" id="modal-buscar-motorista" tabindex="-1" role="dialog" aria-labelledby="BuscarMotorista">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<span class="glyphicon glyphicon-search small"></span> Buscar registro
				</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="form-group">
							<label for="cpf">Informe o CPF ou Nome</label>
							<div class="input-group">
								<input type="text" class="form-control" id="cpf">
								<span class="input-group-btn">
									<button class="btn btn-primary" type="button" title="Buscar motorista" onclick="buscarMotorista()">
										<span class="glyphicon glyphicon-search small"></span> Buscar
									</button>
								</span>
							</div>
						</div><!-- /.form-group -->
						<p class="custom-error"></p>
						<table class="table table-condensed" id="tabela-resultados">
							<thead>
								<tr class="active">
									<th>NOME</th>
									<th>CPF</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal" id="fechar-busca">Fechar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /Modal 'buscar' -->
