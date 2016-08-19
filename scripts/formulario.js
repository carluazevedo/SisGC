$(document).ready(function() {
	$('input[type=text]').on('keypress', function(e) {
		return e.which !== 13;
	});
	$('#motorista_cpf, #modal-buscar-motorista #cpf').mask('000.000.000-00');
	$('#placa_trator, #placa_reboque_1, #placa_reboque_2').mask('SSS-0000');
	$('#valor').mask('000.000.000,00', {reverse: true});
	$('#peso').mask('000.000.000,000', {reverse: true});
	$('#destinatario_cnpj').mask('00.000.000/0000-00');
	$('#destinatario_cnpj').tooltip();
	$('#buscar-motorista').click(function() {
		$('#modal-buscar-motorista').modal('toggle');
		$('#modal-buscar-motorista').on('shown.bs.modal', function() {
			$('#cpf').focus();
		});
		$('#modal-buscar-motorista').on('hidden.bs.modal', function() {
			$('#cpf, #nome').val('');
			$('#modal-buscar-motorista .custom-error').html('');
			$('#tabela-resultados tbody').remove()
		});
	});
});

function buscarMotorista(c)
{
	cpf_node = document.querySelector('#modal-buscar-motorista #cpf');
	nome_node = document.querySelector('#modal-buscar-motorista #nome');
	error_node = document.querySelector('#modal-buscar-motorista .custom-error');
	table_node = document.querySelector('#modal-buscar-motorista #tabela-resultados');
	if (cpf_node.value != '' || nome_node.value != '') {
		error_node.innerHTML = '';
		if (c == 'cpf') {
			ajaxPostResponse(site_url+'buscar/motorista', cpf_node.value, resultado);
		} else if (c == 'nome') {
			ajaxPostResponse(site_url+'buscar/motorista', nome_node.value, resultado);
		}
		function resultado(callback)
		{
			dados_motorista = JSON.parse(callback);
			/*
			if (dados_motorista[0] == undefined) {
				error_node.innerHTML = 'Registro não encontrado.';
			}
			if (dados_motorista.length == 1) {
			*/
			table_node.createTBody();
			table_node.tBodies[0].insertRow(0);
			table_node.tBodies[0].rows[0].insertCell(0);
			table_node.tBodies[0].rows[0].insertCell(1);
			table_node.tBodies[0].rows[0].cells[0].innerHTML = dados_motorista[0].nome;
			table_node.tBodies[0].rows[0].cells[1].innerHTML = dados_motorista[0].cpf;
			dados_motorista = '';
		}
		if (table_node.tBodies[0] != undefined) {
			table_node.tBodies[0].remove();
		}
	} else {
		error_node.innerHTML = 'Informe os dados necessários.';
	}
}
