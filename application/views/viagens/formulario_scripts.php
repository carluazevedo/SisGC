
<script>
const site_url = '<?php echo site_url('/'); ?>';

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
</script>