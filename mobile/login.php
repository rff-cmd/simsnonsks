<?php
//header('Content-type: application/json');

include_once ("../app/include/sambung.php");

$response = array("status" => false);

if(isset($_POST['email']) && isset($_POST['password']) ) {
	
	$dbpdo = DB::create();
	
	//receiving the post param
	$username	=	$_POST["username"];
	$password	=	$_POST["password"];
	
	//get user by password
	$pas 		= @md5(@md5(@md5(@md5(@md5(@md5(@md5($password.$username.@strlen($password.$username)*15)))))));
	$sql_cek 	= "select uid, pwd from usr where usrid='$username' and pwd='$pas' and act=1";
	$hasil_cek 	= $dbpdo->query($sql_cek);
	$countuser	= $hasil_cek->rowCount();
	$data_cek = $hasil_cek->fetch(PDO::FETCH_OBJ);
	  
	if($countuser > 0) {
		$response["status"]		=	true;
		$response["user"]["uid"]=	$data_cek->uid;
		$response["user"]["pwd"]=	$data_cek->pwd;	
		
		echo json_encode($response);
	} else {
		$response["status"]			=	false;
		$response["message"]	=	"User atau Password tidak benar !!!";
		
		echo json_encode($response);
	}
	
}	

?>
