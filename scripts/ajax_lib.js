/**
 * Nesta função, 'callback' retorna o objeto 'XMLHttpRequest()' completo
 */
function ajax_get(url, callback)
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
 * Nesta função, 'callback' retorna apenas 'responseText'
 */
function ajax_get_response(url, callback)
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
