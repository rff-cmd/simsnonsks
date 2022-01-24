<style>
	#status {
	  position: fixed;
	  width: 100%;
	  font: bold 1em sans-serif;
	  color: #FFF;
	  padding: 0.5em;
	}

	#log {
	  padding: 2.5em 0.5em 0.5em;
	  font: 1em sans-serif;
	}

	.online {
	  background: green;
	}

	.offline {
	  background: red;
	}
</style>

<script>
	window.addEventListener('load', function() {
	  var status = document.getElementById("status");
	  //var log = document.getElementById("log");

	  function updateOnlineStatus(event) {
	    var condition = navigator.onLine ? "online" : "offline";

	    status.className = condition;
	    status.innerHTML = condition.toUpperCase();

		if(status.innerHTML == "online".toUpperCase()) {
			//alert("online");
			window.location = 'http://possp.sahabatputra.com';
		}
		
		if(status.innerHTML == "offline".toUpperCase()) {
			//alert("offline");
			window.location = 'http://localhost:8080/tokosahabat';
		}
	    //log.insertAdjacentHTML("beforeend", "Event: " + event.type + "; Status: " + condition);
	  }

	  window.addEventListener('online',  updateOnlineStatus);
	  window.addEventListener('offline', updateOnlineStatus);
	});
</script>

<div id="status"></div>
<!--<div id="log"></div>-->