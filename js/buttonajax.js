var request;
var dest;

function loadHTML(URL, destination){
    dest = destination;
	if (window.XMLHttpRequest){
        request = new XMLHttpRequest();
        request.onreadystatechange = processStateChange;
        request.open("GET", URL, true);
        request.send(null);
    } else if (window.ActiveXObject) {
        request = new ActiveXObject("Microsoft.XMLHTTP");
        if (request) {
            request.onreadystatechange = processStateChange;
            request.open("GET", URL, true);
            request.send();
        }
    }
}

function processStateChange(){
    if (request.readyState == 4){
        contentDiv = document.getElementById(dest);
        if (request.status == 200){
            response = request.responseText;
            contentDiv.innerHTML = response;
        } else {
            contentDiv.innerHTML = "Error: Status "+request.status;
        }
    }
}



function loadHTMLPost(URL, destination){
    dest = destination;
	if (window.XMLHttpRequest){
        request = new XMLHttpRequest();
        request.onreadystatechange = processStateChange;
        request.open("POST", URL, true);
        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
      	request.setRequestHeader("Content-length", parameters.length);
      	request.setRequestHeader("Connection", "close");
		request.send("good");
    } else if (window.ActiveXObject) {
        request = new ActiveXObject("Microsoft.XMLHTTP");
        if (request) {
            request.onreadystatechange = processStateChange;
            request.open("POST", URL, true);
            request.send();
        }
    }
}


function loadHTMLPost_button(URL, destination, button){
    dest = destination;
	var str = 'button=' + button;

	if (window.XMLHttpRequest){
        request = new XMLHttpRequest();
        request.onreadystatechange = processStateChange;
        request.open("POST", URL, true);
        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		request.send(str);
    } else if (window.ActiveXObject) {
        request = new ActiveXObject("Microsoft.XMLHTTP");
        if (request) {
            request.onreadystatechange = processStateChange;
            request.open("POST", URL, true);
            request.send();
        }
    }
}

function loadHTMLPost_button2(URL, destination, button, getId){
    dest = destination;
	var str;
	//alert(document.getElementById(getId).value);
	str = getId + '=' + document.getElementById(getId).value;
	str = str + '&button=' + button;

	if (window.XMLHttpRequest){
        request = new XMLHttpRequest();
        request.onreadystatechange = processStateChange;
        request.open("POST", URL, true);
        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		request.send(str);
    } else if (window.ActiveXObject) {
        request = new ActiveXObject("Microsoft.XMLHTTP");
        if (request) {
            request.onreadystatechange = processStateChange;
            request.open("POST", URL, true);
            request.send();
        }
    }
}


function loadHTMLPost_idcheck(URL, destination, button, getId, getId2){
	dest = destination;	
	str = getId + '=' + document.getElementById(getId).value;
	str2 = getId2 + '=' + document.getElementById(getId2).value;
	
	var str = str + '&button=' + button;
	var str2 = str2 + '&button=' + button;
	var str = str + '&' + str2;
			
	if (window.XMLHttpRequest){
		request = new XMLHttpRequest();
		request.onreadystatechange = processStateChange;
		request.open("POST", URL, true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		request.send(str);		
	} else if (window.ActiveXObject) {
		request = new ActiveXObject("Microsoft.XMLHTTP");
		if (request) {
			request.onreadystatechange = processStateChange;
			request.open("POST", URL, true);
			request.send();
		}
	}
}
