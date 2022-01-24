<?php
session_start();
$waktu = 60;
?>

<link rel="stylesheet" href="app/timer/jquery.countdown.css">
<style type="text/css">
#hitmundur { width: 240px; height: 45px; }
</style>
<script src="app/timer/jquery.min.js"></script>
<script src="app/timer/jquery.plugin.js"></script>
<script src="app/timer/jquery.countdown.js"></script>

<script type="text/javascript">
function waktuHabis(){
	alert("Waktu anda habis!!!");
	}		
function hampirHabis(periods){
	if($.countdown.periodsToSeconds(periods) == 30){
		$(this).css({color:"red"});
		}
	}
$(function(){
	
	var sisa_waktu =  <?php echo $waktu ?>;
	
	var TimeOut = sisa_waktu;
	$("#hitmundur").countdown({
		until: TimeOut,
		compact:true,
		onExpiry:waktuHabis,
		onTick: hampirHabis
		});	
	})
</script>

<div id="hitmundur"></div>
