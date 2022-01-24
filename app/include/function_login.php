<?php

function Login(){
	$dbpdo = DB::create();
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	
    $_SESSION['bahasa'] = 0; //1;
	    
	if($username && $password) {
	  $pas = @md5(@md5(@md5(@md5(@md5(@md5(@md5($password.$username.@strlen($password.$username)*15)))))));
	  $sql_cek = "select pwd from usr where usrid='$username' and pwd='$pas' and act=1";
	  $hasil_cek = $dbpdo->query($sql_cek);
	  $data_cek = $hasil_cek->fetch(PDO::FETCH_OBJ);
	 
	  if (!empty($data_cek->pwd)) {	  	  		
		  //$conn=@mysql_connect(HOST,USER,PASS) or die ("Whoops");
		  $password = @md5(@md5(@md5(@md5(@md5(@md5(@md5($password.$username.@strlen($password.$username)*15)))))));
		  $sql = "select id, usrid from usr where usrid='$username' and pwd='$password' and act=1"; 
		  $r = $dbpdo->query($sql);
		  $rr = $r->fetch(PDO::FETCH_OBJ);
		  		  
		  if($rr->usrid != ""){
				//@mysql_close($conn);
				
				$sql="select a.id, a.pwd, a.usrid, a.adm, a.photo, a.departemen, a.idpegawai, a.tipe_user, ifnull(a.ganti_pwd_no,0) ganti_pwd_no from usr a where a.usrid='$username' and a.pwd='$password' and a.act=1";
				$password_r = $dbpdo->query($sql);
				$password_d = $password_r->fetch(PDO::FETCH_OBJ);
				
				$_SESSION["employee"]=$password_d->usrid; // ." ". $password['sname'];
				$_SESSION["loginname"]=$password_d->usrid;
				$_SESSION["userid"]=$password_d->usrid;
				$_SESSION["adm"]=$password_d->adm;
				$_SESSION["photo"]=$password_d->photo;
				$password=$password_d->pwd;	
				$_SESSION["id_user"]=$password_d->id;
				$_SESSION["idpegawai"]=$password_d->idpegawai;
				$_SESSION["tipe_user"]=$password_d->tipe_user;
				$_SESSION["ganti_pwd_no"]=$password_d->ganti_pwd_no;
				$_SESSION["departemen"]=$password_d->departemen;
				
				//get tahunajaran
				$sqlstr="select replid, tahunajaran from tahunajaran where departemen='$password_d->departemen' and aktif=1 and info2=1 order by ts desc limit 1";
				$rsltta=$dbpdo->query($sqlstr);
				$datata=$rsltta->fetch(PDO::FETCH_OBJ);		
				$_SESSION["idtahunajaran"]=$datata->replid;
				$_SESSION["tahunajaran"]=$datata->tahunajaran;
				
				//get angkatan
				$sqlstr="select replid from angkatan where departemen='$password_d->departemen' and aktif=1 limit 1";
				$rsltang=$dbpdo->query($sqlstr);
				$datangk=$rsltang->fetch(PDO::FETCH_OBJ);		
				$_SESSION["idangkatan"]=$datangk->replid;
					
				if($password_d->tipe_user == "Pegawai" || $password_d->tipe_user == "Guru") {
					//$sqlepy="select nip, nama from pegawai where replid='$password_d->idpegawai' ";
					$sqlepy="select b.replid idguru, a.nip, a.nama from pegawai a left join guru b on a.replid=b.nip where a.replid='$password_d->idpegawai' ";
					$rsltepy=$dbpdo->query($sqlepy);
					$dataepy=$rsltepy->fetch(PDO::FETCH_OBJ);		
					$_SESSION["nama"]=$dataepy->nama;
					$_SESSION["nip"]=$dataepy->nip;
					$_SESSION["idguru"]=$dataepy->idguru;
				}
				
								
				if($password_d->tipe_user == "Siswa") {
					$sqlepy="select a.replid idsiswa, a.nis, a.nik, a.nama, a.idkelas, b.idtingkat, b.kelas, c.tingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where a.replid='$password_d->idpegawai' ";
					$rsltepy=$dbpdo->query($sqlepy);
					$dataepy=$rsltepy->fetch(PDO::FETCH_OBJ);		
					$_SESSION["nama"]=$dataepy->nama;
					$_SESSION["idkelas"]=$dataepy->idkelas;
					$_SESSION["idtingkat"]=$dataepy->idtingkat;
					$_SESSION["kelas"]=$dataepy->kelas;
					$_SESSION["tingkat"]=$dataepy->tingkat;
					$_SESSION["nis"]=$dataepy->nis;
					$_SESSION["nik"]=$dataepy->nik;
					$_SESSION["idsiswa"]=$dataepy->idsiswa;
				}
				
				$departemen = $password_d->departemen;
				$sqlstr="select replid semester_id, semester, departemen from semester where departemen='$departemen' and aktif=1 order by semester limit 1";
				$rsltepy=$dbpdo->query($sqlstr);
				$dataepy=$rsltepy->fetch(PDO::FETCH_OBJ);		
				$_SESSION["idsemester"]=$dataepy->replid;
				$_SESSION["semester_id"]=$dataepy->semester_id;
								
				/*$sqlwhs="select code location_code from warehouse where id='$dataepy->location_id' ";
				$rsltwhs=$dbpdo->query($sqlwhs);
				$datawhs=$rsltwhs->fetch(PDO::FETCH_OBJ);
				$_SESSION["location"]=$datawhs->location_code;*/
				
				//******************************************************************
				//*Not the best option but produce the required results - unencrypted password saved to a cookie
				//******************************************************************
				##semntara di lock (2017-04-04) setcookie("data_login","$username $password",time()+60*30);  // Set the cookie named 'candle_login' with the value of the username (in plain text) and the password (which has been encrypted and serialized.)
				##semntara di lock (2017-04-04) setcookie("data_login","$username $password");
				$_SESSION["logged"]=1;
											
				//echo $_SESSION["loginname"]; exit;
				
				//if($_SESSION["Captcha"]!=$_POST["nilaicaptcha"]){
					/*echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Invalid Captcha Code</font></center>";*/
					//$_SESSION["Captcha"]="";
					
					//$msg = "<meta http-equiv=\"Refresh\" content=\"0;url=./main.php\">"; 
					//header("Location: main.php");
					
				/*} else {*/
					
				?>	
					<meta http-equiv="Refresh" content="0;url=<?php echo obraxabrix('main') ?>" />
				
				<?php	
					exit;
					
				//} 								
								
				//
				
				/*echo "<script type='text/javascript'>";
				echo "window.location = 'main.php'";
				echo "</script>";  */
		  }else{
				$passed = new PDO("mysql:host=$host;dbname=$mydb, $userdb, $passdb");													
		  }
			
			//@mysql_select_db(DB);
			if (!$passed) {		
			
				if($_SESSION["Captcha"] == "")	{	
					echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Invalid Captcha Code</font></center>"; 
				} else {
					echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Invalid User Name or Password</font></center>";
				}    
				$_SESSION["logged"]=0;
				$_SESSION["userid"]="";
				
			/*} else if($_SESSION["Captcha"]!=$_POST["nilaicaptcha"]){
				echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Invalid Captcha Code</font></center>";     
				$_SESSION["logged"]=0;
				$_SESSION["userid"]="";*/								
			}else{
				$sql="select a.id, a.pwd, a.usrid, a.adm, a.photo, a.departemen, a.idpegawai, a.tipe_user, ifnull(a.ganti_pwd_no,0) ganti_pwd_no from usr a where a.usrid='$username' and a.pwd='$password' and a.act=1";
				$password_r=$dbpdo->query($sql);
				$password_d=$password_r->fetch(PDO::FETCH_OBJ);
				
				$_SESSION["employee"]=$password_d->usrid; // ." ". $password->sname;
				$_SESSION["loginname"]=$password_d->usrid;
				$_SESSION["userid"]=$password_d->usrid;
				$_SESSION["adm"]=$password_d->adm;
				$_SESSION["photo"]=$password_d->photo;
				$password=$password_d->pwd;
				$_SESSION["id_user"]=$password_d->id;
				$_SESSION["idpegawai"]=$password_d->idpegawai;
				$_SESSION["tipe_user"]=$password_d->tipe_user;
				$_SESSION["ganti_pwd_no"]=$password_d->ganti_pwd_no;
				$_SESSION["departemen"]=$password_d->departemen;
				
				//get tahunajaran
				$sqlstr="select replid, tahunajaran from tahunajaran where departemen='$password_d->departemen' and aktif=1 and info2=1 order by ts desc limit 1";
				$rsltta=$dbpdo->query($sqlstr);
				$datata=$rsltta->fetch(PDO::FETCH_OBJ);		
				$_SESSION["idtahunajaran"]=$datata->replid;
				$_SESSION["tahunajaran"]=$datata->tahunajaran;
				
				//get angkatan
				$sqlstr="select replid from angkatan where departemen='$password_d->departemen' and aktif=1 limit 1";
				$rsltang=$dbpdo->query($sqlstr);
				$datangk=$rsltang->fetch(PDO::FETCH_OBJ);		
				$_SESSION["idangkatan"]=$datangk->replid;
					
				if($password_d->tipe_user == "Pegawai" || $password_d->tipe_user == "Guru") {
					$sqlepy="select nip, nama from pegawai where replid='$password_d->idpegawai' ";
					$rsltepy=$dbpdo->query($sqlepy);
					$dataepy=$rsltepy->fetch(PDO::FETCH_OBJ);		
					$_SESSION["nama"]=$dataepy->nama;
					$_SESSION["nip"]=$dataepy->nip;
				}
				
				if($password_d->tipe_user == "Siswa") {
					$sqlepy="select a.replid idsiswa, a.nis, a.nik, a.nama, a.idkelas, b.idtingkat, b.kelas, c.tingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where a.replid='$password_d->idpegawai' ";
					$rsltepy=$dbpdo->query($sqlepy);
					$dataepy=$rsltepy->fetch(PDO::FETCH_OBJ);		
					$_SESSION["nama"]=$dataepy->nama;
					$_SESSION["idkelas"]=$dataepy->idkelas;
					$_SESSION["idtingkat"]=$dataepy->idtingkat;
					$_SESSION["kelas"]=$dataepy->kelas;
					$_SESSION["tingkat"]=$dataepy->tingkat;
					$_SESSION["nis"]=$dataepy->nis;
					$_SESSION["nik"]=$dataepy->nik;
					$_SESSION["idsiswa"]=$dataepy->idsiswa;
				}
				
				$departemen = $password_d->departemen;
				$sqlstr="select replid semester_id, semester, departemen from semester where departemen='$departemen' and aktif=1 order by semester limit 1";
				$rsltepy=$dbpdo->query($sqlstr);
				$dataepy=$rsltepy->fetch(PDO::FETCH_OBJ);		
				$_SESSION["idsemester"]=$dataepy->replid;
				$_SESSION["semester_id"]=$dataepy->semester_id;
				
				//******************************************************************
				//*Not the best option but produce the required results - unencrypted password saved to a cookie
				//******************************************************************
				##semntara di lock (2017-04-04) setcookie("data_login","$username $password",time()+60*30);  // Set the cookie named 'candle_login' with the value of the username (in plain text) and the password (which has been encrypted and serialized.)
				##semntara di lock (2017-04-04) setcookie("data_login","$username $password");
				$_SESSION["logged"]=1;
								
				$msg = "<meta http-equiv=\"Refresh\" content=\"0;url=./main.php\">"; //put index.php	
				
			}
		} else {
			echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Invalid User Name or Password</font></center>";     
			$_SESSION["logged"]=0;
			$_SESSION["userid"]="";
		}
		
	}else{
		echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Enter your UserName and Password <br />to login on to the system</font></center>";
		$_SESSION["logged"]=0;
	}
	
	if($msg) echo $msg; 
}
?>