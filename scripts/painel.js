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
	ajaxGetResponse(site_url+'buscar/viagem/'+e.value, resultado);
	function resultado(callback)
	{
		node = document.querySelector('#modal-visualizar .modal-body');
		node.innerHTML = callback;
	}
}

function editarViagem(e)
{
	location.href = site_url+'viagens/editar/'+e.value;
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
			site_url+'viagens/remover/'+e.value
	);
}
