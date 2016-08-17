<script>
$(document).ready(function() {
	$('.acao-visualizar').click(function() {
		$('#modal-visualizar').modal('toggle');
	});

	$('.acao-remover').click(function() {
		$('#modal-remover').modal('toggle');
	});
});

function inserirLinhaTabela()
{
	t_length = document.querySelector('tbody tr').childElementCount;
	t_footer = document.querySelector('tfoot tr');

	for (t = 0; t < t_length; t++) {
		t_coluns = document.createElement('TD');
		t_footer.appendChild(t_coluns);
	}
}

inserirLinhaTabela();

function visualizarViagem(e)
{
	ajax_get('<?php echo html_entity_decode(site_url('buscar&#47;viagem&#47;')); ?>' + e.value, '#modal-visualizar .modal-body');
}

function editarViagem(e)
{
	location.href = '<?php echo html_entity_decode(site_url('viagens&#47;editar&#47;')); ?>' + e.value;
}

function removerViagem(e)
{
	document.getElementsByTagName('button')['remover'].value = 'ok';
	document.forms['remover-viagem'].setAttribute(
			'method',
			'post'
	);
	document.forms['remover-viagem'].setAttribute(
			'action',
			'<?php echo html_entity_decode(site_url('viagens&#47;remover&#47;')); ?>' + e.value
	);
}
</script>