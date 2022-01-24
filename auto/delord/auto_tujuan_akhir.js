// JavaScript Document
//"js_auto/autosuggest.php"
function suggesttujuanakhir(inputString){
	if(inputString.length == 0) {
		$('#suggestionstujuanakhir').fadeOut();
	} else {
	$('#countrytujuanakhir').addClass('loadtujuanakhir');
		$.post("auto/delord/auto_tujuan_akhir.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestionstujuanakhir').fadeIn();
				$('#suggestionstujuanakhirList').html(data);
				$('#countrytujuanakhir').removeClass('loadtujuanakhir');
			} 
		});
	}
}

function fill5(thisValue) {
	$('#ctyend').val(thisValue);
	setTimeout("$('#suggestionstujuanakhir').fadeOut();", 100);
}

function fill6(thisValue) {
	$('#dstend').val(thisValue);
	setTimeout("$('#suggestionstujuanakhir').fadeOut();", 100);
}

