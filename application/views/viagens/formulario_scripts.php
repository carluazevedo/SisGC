<script>
$(document).ready(function() {
	$('#motorista_cpf').mask('000.000.000-00');
	$('#placa_trator, #placa_reboque_1, #placa_reboque_2').mask('SSS-0000');
	$('#valor').mask('000.000.000,00', {reverse: true});
	$('#peso').mask('000.000.000,000', {reverse: true});
	$('#destinatario_cnpj').mask('00.000.000/0000-00');
	$('#destinatario_cnpj').tooltip();
	$('#buscar-motorista').click(function() {
		$('#modal-buscar iframe[class=embed-responsive-item]').attr('src', 'http://localhost/sisgc-2/index.php/buscar/motorista');
		$('#modal-buscar').modal('toggle');
	});
	/*
	$('#modal-buscar').on('hidden.bs.modal', function() {
		$('#modal-buscar iframe[class=embed-responsive-item]').removeAttr('src');
	});
	*/
});

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

var i_text = document.querySelectorAll('input[type=text]');
function converterCaixaAlta() {
	for (i = 0; i < i_text.length; i++) {
		i_text[i].value = i_text[i].value.toUpperCase();
	}
}
</script>