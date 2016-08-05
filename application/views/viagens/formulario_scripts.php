<script>
$(document).ready(function(){
	$('#motorista_cpf').mask('000.000.000-00');
	$('#placa_trator, #placa_reboque_1, #placa_reboque_2').mask('SSS-0000');
	$('#valor').mask('000.000.000,00', {reverse: true});
	$('#peso').mask('000.000.000,000', {reverse: true});
	$('#destinatario_cnpj').mask('00.000.000/0000-00');
	$('#destinatario_cnpj').tooltip();
});

<?php if (isset($operacao) && $operacao == 'editar') :  ?>
document.getElementsByTagName('button')['registro'].name = 'gravar';
document.getElementsByTagName('button')['registro'].setAttribute('class', 'btn btn-info form-control');
<?php endif; ?>

var i_text = document.querySelectorAll('input[type=text]');
function converterCaixaAlta() {
	for (i = 0; i < i_text.length; i++) {
		i_text[i].value = i_text[i].value.toUpperCase();
	}
}
</script>