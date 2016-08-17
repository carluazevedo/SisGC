<script>
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
		ajax_get_response('<?php echo html_entity_decode(site_url('buscar&#47;motorista&#47;')); ?>', buscar_motorista_form);
		$('#modal-buscar').modal('toggle');
	});
});

function buscar_motorista_form(callback)
{
	node = document.querySelector('#modal-buscar .modal-body');
	node.innerHTML = callback;
}

function buscar_motorista()
{
	node = document.querySelector('#motorista-cpf-nome');
	error_node = document.querySelector('#modal-buscar .custom-error')
	if (node.value == '') {
		error_node.innerHTML = 'Informe o <strong>CPF</strong> do motorista.';
	} else {
		error_node.innerHTML = '';
		ajax_get_response('<?php echo html_entity_decode(site_url('buscar&#47;motorista&#47;')); ?>' + node.value, buscar_motorista_result);
		function buscar_motorista_result(callback)
		{
			node1 = document.querySelector('#motorista_cpf');
			node2 = document.querySelector('#motorista_nome');
			resultado = JSON.parse(callback);
			node1.value = resultado.cpf;
			node2.value = resultado.nome;
		}
	}
}

<?php if (isset($operacao) && $operacao == 'registrar') : ?>
notas_fiscais.disabled = true;
valor.disabled = true;
peso.disabled = true;
entrega_tipo.disabled = true;
mercadoria_tipo.disabled = true;
destinatario_cnpj.disabled = true;
rota.disabled = true;
<?php endif; ?>

<?php if (isset($operacao) && $operacao == 'editar') : ?>
document.getElementsByTagName('button')['registrar'].name = 'finalizar';
<?php endif; ?>

<?php if (isset($finalizar_status) && $finalizar_status == false) : ?>
$(document).ready(function() {
	$('#modal-editar').modal('show');
	$('#modal-editar').on('shown.bs.modal', function() {
		$('#editar').focus();
	});
	$('#ajuda').click(function() {
		$('#modal-ajuda').modal('toggle');
	});
});
<?php elseif (isset($finalizar_status) && $finalizar_status == true) : ?>
$(document).ready(function() {
	$('#modal-finalizar').modal('show');
	$('#modal-finalizar').on('shown.bs.modal', function() {
		$('#confirma-finalizar').focus();
	});
});
<?php endif; ?>

<?php if (isset($status_viagem) && $status_viagem == 2) : ?>
           dt_num.readOnly = true;
    motorista_cpf.readOnly = true;
     placa_trator.readOnly = true;
  placa_reboque_1.readOnly = true;
  placa_reboque_2.readOnly = true;
      transp_nome.readOnly = true;
    operacao_nome.readOnly = true;
    notas_fiscais.readOnly = true;
            valor.readOnly = true;
             peso.readOnly = true;
     entrega_tipo.disabled = true;
  mercadoria_tipo.disabled = true;
destinatario_cnpj.readOnly = true;
             rota.readOnly = true;
      observacoes.readOnly = true;
<?php endif; ?>

function preventEnter(e)
{
	if (event.which == 13 && e.type == 'text') {
		return false;
	}
}

function converterCaixaAlta()
{
	nodes = document.querySelectorAll('input[type=text]');
	for (i = 0; i < nodes.length; i++) {
		nodes[i].value = nodes[i].value.toUpperCase();
	}
}
</script>