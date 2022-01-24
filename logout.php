<?php	
	@session_start();

	/*include("app/include/sambung.php");*/
	
	//$sql = "update Users_Log set LogOut=getdate(), Active=0 where UserID='$_SESSION[userid]' and Active=1 ";
	//odbc_exec(condb,$sql);
	
	/*setcookie("data_login","",time()-60);*/
	//ob_start();
	@session_unset();
	@session_destroy();
	//header("Location: home.php");
?>	

<meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder ?>" />