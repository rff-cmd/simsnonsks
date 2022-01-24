// JavaScript Document
//"js_auto/autosuggest.php"
function suggest(inputString,autosugest){
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {		
	$('#country').addClass('load');		
		$.post(autosugest, {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions').fadeIn();
				$('#suggestionsList').html(data);
				$('#country').removeClass('load');
			}
		});
	} 
}

function fill(thisValue) {	
	$('#kode').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fill2(thisValue) {	
	$('#kode2').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

/*function fill3(thisValue) {
	$('#vhccde').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fill4(thisValue) {
	$('#drvnme').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fill5(thisValue) {
	$('#dono').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}*/
