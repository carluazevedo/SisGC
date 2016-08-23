$('input[type=text]').on('keypress', function(e) {
	return e.which !== 13;
});

/* < Expressões regulares para validação de campos > */
var pattern_num = /\b\d{1}/;
var pattern_str = /\b[a-zA-Z]{1}/i;

/* < Modal 'buscar-motorista' > */
$('#buscar-motorista').click(function() {
	$('#modal-buscar-motorista').modal('toggle');
});
$('#modal-buscar-motorista').on('shown.bs.modal', function() {
	$('#dados-motorista').focus();
});
$('#modal-buscar-motorista').on('hidden.bs.modal', function() {
	$('#dados-motorista').val('');
	$('#modal-buscar-motorista .custom-error').html('');
	/* $('#tabela-resultados tbody').remove(); */
});
var dados_node  = document.querySelector('#modal-buscar-motorista #dados-motorista');
var error_node  = document.querySelector('#modal-buscar-motorista .custom-error');
var table_node  = document.querySelector('#modal-buscar-motorista #tabela-resultados');
dados_node.addEventListener('keydown', function(e) {
	if (e.which === 13) {
		buscarMotorista();
	}
	if (pattern_num.test(dados_node.value) == true) {
		$('#dados-motorista').mask('AA0.000.000-00');
	} else if (pattern_str.test(dados_node.value) == true) {
		$('#dados-motorista').unmask();
	}
});

function buscarMotorista()
{
	if (dados_node.value != '') {
		error_node.innerHTML = '';
		ajaxPostResponse(site_url+'buscar/motorista', dados_node.value, resultado);
		if (table_node.tBodies[0] != undefined) {
			table_node.tBodies[0].remove();
		}
	} else {
		error_node.innerHTML = 'Informe os dados necessários';
	}
}

function resultado(callback)
{
	dados_resultado = JSON.parse(callback);
	if (dados_resultado.length == 0) {
		error_node.innerHTML = 'Registro não encontrado';
	}
	if (dados_resultado.length >= 1) {
		table_node.createTBody();
		for (i = 0; i < dados_resultado.length; i++) {
			table_node.tBodies[0].insertRow(0);
			table_node.tBodies[0].rows[0].insertCell(0);
			table_node.tBodies[0].rows[0].insertCell(1);
			table_node.tBodies[0].rows[0].cells[0].innerHTML = dados_resultado[i].nome;
			table_node.tBodies[0].rows[0].cells[1].innerHTML = dados_resultado[i].cpf;
		}
	}
}
/* < /Modal 'buscar-motorista' > */

$('#placa_trator, #placa_reboque_1, #placa_reboque_2').mask('SSS-0000');
$('#valor').mask('000.000.000,00', {reverse: true});
$('#peso').mask('000.000.000,000', {reverse: true});
$('#destinatario_cnpj').mask('00.000.000/0000-00');
$('#destinatario_cnpj').tooltip();
