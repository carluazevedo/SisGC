/**
 * Nesta função, 'callback' retorna o objeto 'XMLHttpRequest()' completo usando o método 'GET'
 */
function ajaxGet(url, callback)
{
	var new_request = false;
	    new_request = new XMLHttpRequest();
	if (new_request) {
		new_request.onreadystatechange = function ()
		{
			if (new_request.readyState == 4 && new_request.status == 200) {
				callback(new_request);
			}
		}
		new_request.open('GET', url, true);
		new_request.send(null);
	}
}

/**
 * Nesta função, 'callback' retorna apenas 'responseText' usando o método 'GET'
 */
function ajaxGetResponse(url, callback)
{
	var new_request = false;
	new_request = new XMLHttpRequest();
	if (new_request) {
		new_request.onreadystatechange = function ()
		{
			if (new_request.readyState == 4 && new_request.status == 200) {
				callback(new_request.responseText);
			}
		}
		new_request.open('GET', url, true);
		new_request.send(null);
	}
}

/**
 * Nesta função, 'callback' retorna apenas 'responseText' usando o método 'POST'
 */
function ajaxPostResponse(url, params, callback)
{
	var new_request = false;
	new_request = new XMLHttpRequest();
	if (new_request) {
		new_request.onreadystatechange = function ()
		{
			if (new_request.readyState == 4 && new_request.status == 200) {
				callback(new_request.responseText);
			}
		}
		new_request.open('POST', url, true);
		new_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		new_request.send('valor='+params);
	}
}
