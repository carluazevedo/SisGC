$('input[type=text]').on('keydown', function(e) {
	return e.which !== 13;
});

/* < Expressões regulares para validação de campos > */
var pattern_num = /\b\d{1}/;
var pattern_str = /\b[a-zA-Z]{1}/i;

/**
 * Objeto para realizar uma busca nos registros
 */
function buscarRegistro()
{
	this.campo_dados = '';
	this.elemento_erro = '';
	this.elemento_tabela = '';
	this.callback = '';
	this.resultado_busca = function() {
		if (this.campo_dados.value != '') {
			this.elemento_erro.innerHTML = '';
			ajaxPostResponse(site_url+'buscar/motorista', this.campo_dados.value, this.callback);
			if (this.elemento_tabela.tBodies[0] != undefined) {
				this.elemento_tabela.tBodies[0].remove();
			}
		} else {
			this.elemento_erro.innerHTML = 'Informe os dados necessários';
		}
	}
}

/* < Modal 'buscar-motorista' > */
buscar_motorista.addEventListener('click', function() {
	$('#modal-buscar-motorista').modal('toggle');
});
$('#modal-buscar-motorista').on('shown.bs.modal', function() {
	dados_motorista.focus();
});

var error_node  = document.querySelector('#modal-buscar-motorista .custom-error');
var buscarMotorista = new buscarRegistro();
buscarMotorista.campo_dados = dados_motorista;
buscarMotorista.elemento_erro = error_node;
buscarMotorista.elemento_tabela = tabela_resultados_motorista;
buscarMotorista.callback = resultadoBuscarMotorista;

dados_motorista.addEventListener('keydown', function(e) {
	if (e.which === 13) {
		buscarMotorista.resultado_busca();
	}
	if (pattern_num.test(dados_motorista.value) == true) {
		$('#dados_motorista').mask('AA0.000.000-00');
	} else if (pattern_str.test(dados_motorista.value) == true) {
		$('#dados_motorista').unmask();
	}
});
buscar_dados_motorista.addEventListener('click', function() {
	buscarMotorista.resultado_busca();
});

function resultadoBuscarMotorista(callback)
{
	dados_resultado = JSON.parse(callback);
	if (dados_resultado.length == 0) {
		error_node.innerHTML = 'Registro não encontrado';
	}
	if (dados_resultado.length >= 1) {
		tabela_resultados_motorista.createTBody();
		for (i = 0; i < dados_resultado.length; i++) {
			tabela_resultados_motorista.tBodies[0].insertRow(i);
			tabela_resultados_motorista.tBodies[0].rows[i].setAttribute('id', dados_resultado[i].id);
			tabela_resultados_motorista.tBodies[0].rows[i].insertCell(0);
			tabela_resultados_motorista.tBodies[0].rows[i].insertCell(1);
			tabela_resultados_motorista.tBodies[0].rows[i].cells[0].setAttribute('class', 'nome');
			tabela_resultados_motorista.tBodies[0].rows[i].cells[0].innerHTML = dados_resultado[i].nome;
			tabela_resultados_motorista.tBodies[0].rows[i].cells[1].setAttribute('class', 'cpf');
			tabela_resultados_motorista.tBodies[0].rows[i].cells[1].innerHTML = dados_resultado[i].cpf;
			tabela_resultados_motorista.tBodies[0].rows[i].addEventListener('click', this.selecionaRegistro);
		}
	}
}

function selecionaRegistro()
{
	motorista_cpf.value = this.querySelector('.cpf').innerHTML;
	motorista_nome.value = this.querySelector('.nome').innerHTML;
	$('#modal-buscar-motorista').modal('hide');
}

$('#modal-buscar-motorista').on('hidden.bs.modal', function() {
	$('#dados_motorista').val('');
	$('#modal-buscar-motorista .custom-error').html('');
});
/* < /Modal 'buscar-motorista' > */

$('#placa_trator, #placa_reboque_1, #placa_reboque_2').mask('SSS-0000');
$('#botao-reboque-2').click(function() {
	$('#informar-reboque-2').hide();
	$('#placa-reboque-2').show();
});
$('#valor').mask('000.000.000,00', {reverse: true});
$('#peso').mask('000.000.000,000', {reverse: true});
$('#destinatario_cnpj').mask('00.000.000/0000-00');
$('#destinatario_cnpj').tooltip();
