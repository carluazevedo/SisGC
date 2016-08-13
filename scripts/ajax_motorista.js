/* Requisição AJAX */
var xmlhttp = new XMLHttpRequest();
var buscar_cpf = '015.495.174-80';
var url = 'http://localhost/sisgc-2/index.php/buscar/motorista/' + buscar_cpf;

xmlhttp.onreadystatechange = function() {
	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		buscar_registro(xmlhttp.responseText);
	}
}

xmlhttp.open("GET", url, true);
xmlhttp.send();

function buscar_registro(resposta) {
	var dados_motorista = JSON.parse(resposta);
	motorista_cpf.value = dados_motorista.cpf;
	motorista_nome.value = dados_motorista.nome;
}
