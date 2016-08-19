$(document).ready(function() {
	$('input[type=text]').on('keypress', function(e) {
		return e.which !== 13;
	});
	$('#motorista_cpf').mask('000.000.000-00');
	$('#placa_trator, #placa_reboque_1, #placa_reboque_2').mask('SSS-0000');
	$('#valor').mask('000.000.000,00', {reverse: true});
	$('#peso').mask('000.000.000,000', {reverse: true});
	$('#destinatario_cnpj').mask('00.000.000/0000-00');
	$('#destinatario_cnpj').tooltip();
	$('#buscar-motorista').click(function() {
		$('#modal-buscar-motorista').modal('toggle');
	});
});

function buscarMotorista()
{
	node = document.querySelector('#modal-buscar-motorista #cpf');
	error_node = document.querySelector('#modal-buscar-motorista .custom-error');
	table_node = document.querySelector('#modal-buscar-motorista #tabela-resultados');
	if (node.value == '') {
		error_node.innerHTML = 'Informe o <strong>CPF</strong> do motorista.';
	} else {
		ajaxGetResponse(site_url+'buscar/motorista/'+node.value, resultado);
		error_node.innerHTML = '';
		table_node.hidden = false;
		function resultado(callback)
		{
			resultado = JSON.parse(callback);
			table_node.tBodies[0].insertRow(0);
			table_node.tBodies[0].rows[0].insertCell(0);
			table_node.tBodies[0].rows[0].insertCell(1);
			table_node.tBodies[0].rows[0].cells[0].innerHTML = resultado.nome;
			table_node.tBodies[0].rows[0].cells[1].innerHTML = resultado.cpf;
		}
	}
}
