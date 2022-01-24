function suggest(inputString, queryPHP){
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post(queryPHP, {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions').fadeIn();
				$('#suggestionsList').html(data);
				$('#country').removeClass('load');
			}
		});
	}
}

function fill(thisValue) {
	$('#accdcr').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fill2(thisValue) {	
	$('#acccde').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}
