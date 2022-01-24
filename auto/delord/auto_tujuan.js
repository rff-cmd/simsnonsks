// JavaScript Document
//"js_auto/autosuggest.php"
function suggesttujuan(inputString){
	if(inputString.length == 0) {
		$('#suggestionstujuan').fadeOut();
	} else {
	$('#countrytujuan').addClass('loadtujuan');
		$.post("auto/delord/auto_tujuan.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestionstujuan').fadeIn();
				$('#suggestionstujuanList').html(data);
				$('#countrytujuan').removeClass('loadtujuan');
			} 
		});
	}
}

function fill3(thisValue) {
	$('#ctyto').val(thisValue);
	setTimeout("$('#suggestionstujuan').fadeOut();", 100);
}

function fill4(thisValue) {
	$('#dstto').val(thisValue);
	setTimeout("$('#suggestionstujuan').fadeOut();", 100);
}

