function suggest3(inputString, queryPHP){
	if(inputString.length == 0) {
		$('#suggestions3').fadeOut();
	} else {
	$('#country3').addClass('load');
		$.post(queryPHP, {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions3').fadeIn();
				$('#suggestionsList3').html(data);
				$('#country3').removeClass('load');
			}
		});
	}
}

function fill6(thisValue) {
	$('#accothdcr').val(thisValue);
	setTimeout("$('#suggestions3').fadeOut();", 100);
}

function fill7(thisValue) {	
	$('#accoth').val(thisValue);
	setTimeout("$('#suggestions3').fadeOut();", 100);
}
