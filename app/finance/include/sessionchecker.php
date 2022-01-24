<?php
session_name("jbskeu");
session_start();

if (!isset($_SESSION['namakeuangan']))
{ 
	if (file_exists("index.php")) 
		$addr = "index.php";
	elseif (file_exists("../index.php")) 
		$addr = "../index.php";
	elseif(file_exists("../../index.php")) 
		$addr = "../../index.php";
	else	
		$addr = "../../../index.php"; ?> 
	<script language="javascript">
		if (self != self.top) 
		{
			top.window.location.href='<?php echo $addr?>';
		}
		else if (self.name != "")
		{
			opener.top.window.location.href='<?php echo $addr?>';
			window.close();
		}	
		else
		{
			window.location.href='<?php echo $addr?>';	
		}
	</script>
<?php	exit();
}  
?>