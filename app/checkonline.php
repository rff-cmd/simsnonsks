<title>Online connectivity monitoring</title>
<article>
  <p>Current network status: <span id="status">checking...</span></p>
  <ol id="state"></ol>
</article>
<script>
	var statusElem  = document.getElementById('status'),
	    state               = document.getElementById('state');

	function online(event) {
	  statusElem.className = navigator.onLine ? 'online' : 'offline';
	  statusElem.innerHTML = navigator.onLine ? 'online' : 'offline';
	  state.innerHTML += '<li>New event: ' + event.type + '</li>';
	}

	addEvent(window, 'online', online);
	addEvent(window, 'offline', online);
	online({ type: 'ready' });
</script>