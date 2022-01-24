<?php
$post = $_POST[submit];

if ($post == "Save" ){
	$dbpdo = DB::create();
	
	//------cek username lama dan pass lama
	$sql = "Select usrid, pwd from usr where usrid='$_SESSION[loginname]' ";
	
	$results=$dbpdo->query($sql);	
	$user = $results->fetch(PDO::FETCH_OBJ);
		
	if ($user->usrid != $_POST["old_usrid"]) {
?>
		<div class="alert alert-error">
			<strong>User ID Lama tidak benar</strong>
		</div>
	
<?php		
	
		} else {
		
		//if ($user->pwd != md5($_POST["old_pwd"])) {
		if ($user->pwd != obraxabrix($_POST["old_pwd"], $_POST["old_usrid"])) {
?>
			<div class="alert alert-error">
				<strong>Password Lama tidak benar</strong>
			</div>
<?php	
		
			} else {
			//$fv->validateEmpty('loginname','Username baru harus diisi');
			//$fv->validateEmpty('pass','Password baru harus diisi');
			
			//--------cek user, sudah ada atau blm?
			$sql = "Select usrid from usr where usrid='$_POST[usrid]' ";
			
			$results=$dbpdo->query($sql);	
			$user = $results->fetch(PDO::FETCH_OBJ);
			//if (mysql_num_rows($results) == 1) {
			if ($user->usrid != "") {
				
				if ($user->usrid != $_POST["old_usrid"]) {
?>
					<div class="alert alert-error">
						<strong>User ID sudah ada yang pakai</strong>
					</div>
<?php			
				} else {
					
					$old_usrid=$_POST["old_usrid"];
				
					//$old_pwd=md5($_POST["old_pwd"]);
					$old_pwd=obraxabrix($_POST["old_pwd"], $_POST["old_usrid"]); //md5($_POST["old_pwd"]);
					$usrid=$_POST["usrid"];
					//$pwd=md5($_POST["pwd"]);	
					$pwd=obraxabrix($_POST["pwd"], $_POST["usrid"]); //md5($_POST["pwd"]);
					
					$sql = "Update usr Set usrid='$usrid', pwd='$pwd' Where usrid='$old_usrid' and pwd='$old_pwd' ";				
					$results=$dbpdo->prepare($sql);
					$results->execute();
					
					$sql = "Update usr_dtl Set usrid='$usrid' Where usrid='$old_usrid' ";	
					$results=$dbpdo->prepare($sql);	
					$results->execute();
					
					
					$sql = "Update usr_bup set usrid='$usrid', pwd='$_POST[pwd]' Where usrid='$old_usrid'";		
					$results=$dbpdo->prepare($sql);	
					$results->execute();
					
					if($results){
?>
						<div class="alert alert-success">
							<strong>Change User ID and Password successfully</strong>
						</div>
	<?php					
					}else{
	?>
						<div class="alert alert-error">
							<strong>Change User ID and Password Error Save</strong>
						</div>
	<?php		
					}	
					
				}
				
				
			 } else {			
			
				$old_usrid=$_POST["old_usrid"];
				
				//$old_pwd=md5($_POST["old_pwd"]);
				$old_pwd=obraxabrix($_POST["old_pwd"], $_POST["old_usrid"]); //md5($_POST["old_pwd"]);
				$usrid=$_POST["usrid"];
				//$pwd=md5($_POST["pwd"]);	
				$pwd=obraxabrix($_POST["pwd"], $_POST["usrid"]); //md5($_POST["pwd"]);
				
				$sql = "Update usr Set usrid='$usrid', pwd='$pwd' Where usrid='$old_usrid' and pwd='$old_pwd' ";				
				$results=$dbpdo->prepare($sql);
				$results->execute();
				
				$sql = "Update usr_dtl Set usrid='$usrid' Where usrid='$old_usrid' ";	
				$results=$dbpdo->prepare($sql);	
				$results->execute();
				
				
				$sql = "Update usr_bup set usrid='$usrid', pwd='$_POST[pwd]' Where usrid='$old_usrid'";		
				$results=$dbpdo->prepare($sql);	
				$results->execute();
				
				if($results){
?>
					<div class="alert alert-success">
						<strong>Change User ID and Password successfully</strong>
					</div>
<?php					
				}else{
?>
					<div class="alert alert-error">
						<strong>Change User ID and Password Error Save</strong>
					</div>
<?php		
				}	
	
			
			} 
		
		}
	
	} 
}
?>
