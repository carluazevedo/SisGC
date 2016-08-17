function ajax_get(url, query)
{
	var new_request = false;
	new_request = new XMLHttpRequest();
	if (new_request) {
		var node = document.querySelector(query);
		new_request.open('GET', url, true);
		new_request.onreadystatechange = function ()
		{
			if (new_request.readyState == 4 && new_request.status == 200) {
				node.innerHTML = new_request.responseText;
			}
		}
		new_request.send(null);
	}
}