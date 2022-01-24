<?php
session_start();
if(isset($_SESSION["mulai_waktu"])){
 $waktu = 60;
 }
else {
 $waktu = 0;
 }  
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>Hitung Mundur</title>
<link rel="stylesheet" href="jquery.countdown.css">
<style type="text/css">
#hitmundur { width: 240px; height: 45px; }
</style>
<script src="jquery.min.js"></script>
<script src="jquery.plugin.js"></script>
<script src="jquery.countdown.js"></script>


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

</head>
<body>
<h1>Hitung Mundur</h1>

<div id="hitmundur"></div>
</body>
</html>