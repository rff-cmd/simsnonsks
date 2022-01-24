function suggest4(inputString, queryPHP){
	if(inputString.length == 0) {
		$('#suggestions4').fadeOut();
	} else {
	$('#country4').addClass('load');
		$.post(queryPHP, {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions4').fadeIn();
				$('#suggestionsList4').html(data);
				$('#country4').removeClass('load');
			}
		});
	}
}

function fill4(thisValue) {
	$('#accroundeddcr').val(thisValue);
	setTimeout("$('#suggestions4').fadeOut();", 100);
}

function fill5(thisValue) {	
	$('#accrounded').val(thisValue);
	setTimeout("$('#suggestions4').fadeOut();", 100);
}
