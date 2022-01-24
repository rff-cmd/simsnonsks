<?php
echo '
	<style>
	#result_'.$i.' {
		height:20px;
		font-size:12px;
		font-family:Arial, Helvetica, sans-serif;
		color:#333;
		padding:5px;
		margin-bottom:10px;
		background-color:#FFFF99;					
	}
	#country_'.$i.'{
		padding:3px;
		border:1px #CCC solid;
		font-size:12px;
	}
	.suggestionsBox_'.$i.' {
		position: absolute; 
		left: auto;
		top:auto;
		margin: 0px 0px 0px 0px;
		width: 300px;
		padding:0px;
		background-color:#409D47;
		border-top: 3px solid #999999;
		color: #fff;										
	}
	.suggestionList_'.$i.' {
		margin: 0px;
		padding: 0px;
	}
	.suggestionList_'.$i.' ul li {
		list-style:none;
		margin: 0px;
		padding: 6px;
		border-bottom:1px dotted #666;
		cursor: pointer;
	}
	.suggestionList_'.$i.' ul li:hover {
		background-color: #FC3;
		color:#000;
	}
	ul {
		font-family:Arial, Helvetica, sans-serif;
		font-size:11px;
		color:#FFF;
		padding:0;
		margin:0;
	}
	
	.load_'.$i.'{
	background-image:url(auto/loader.gif);
	background-position:right;
	background-repeat:no-repeat;
	}
	
	#suggest_'.$i.' {
		position:none;
	}
</style> ';

echo "
	<script>
		function suggest_".$i."(inputString, queryPHP){
		if(inputString.length == 0) {
			$('#suggestions_".$i."').fadeOut();
		} else {
		$('#country_".$i."').addClass('load_".$i."');".'
			$.post(queryPHP, {queryString: ""+inputString+""}, function(data){
				if(data.length >0) { '."
					$('#suggestions_".$i."').fadeIn();
					$('#suggestionsList_".$i."').html(data);
					$('#country_".$i."').removeClass('load');
				}
			});
		}
	}
	
	function fill_".$i."(thisValue) {
		$('#accdcr_".$i."').val(thisValue); ".'
		setTimeout("'."$('#suggestions_".$i."').fadeOut()".';", 100);
	}
	
	function fill2_'.$i.'(thisValue) { '."	
		$('#acccde_".$i."').val(thisValue); ".'
		setTimeout("'."$('#suggestions_".$i."').fadeOut()".';", 100);
	}
	
	</script>
';
?>