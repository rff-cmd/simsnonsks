// JavaScript Document
//"js_auto/autosuggest.php"
function suggest(inputString){
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("auto/delord/auto_dari.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions').fadeIn();
				$('#suggestionsList').html(data);
				$('#country').removeClass('load');
			} 
		});
	}
}

function fill(thisValue) {
	$('#ctyfrm').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fill2(thisValue) {
	$('#dstfrom').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

