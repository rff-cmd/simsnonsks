<?php
	@session_start();

	if (($_SESSION["logged"] == 0)) {
		echo 'Access denied';
		exit;
	}

	include_once ("../app/include/sambung.php");
	include_once ("../app/include/functions.php");
	include_once ("../app/include/inword.php");

	include_once ("../app/class/class.select.php");
	include_once ("../app/class/class.selectview.php");

	$select 	= new select;
	$selectview = new selectview;

	$dbpdo = DB::create();
	
    $fileName 	= $_FILES["file"]["tmp_name"];
    if($fileName == "") {
?>        
		<table align="center" style="font-size: 36px; color: #271aa4">
			<tr>
				<td align="center"><?php echo "File belum dipilih" ?></td>
			</tr>
		
		</table>
		
<?php
		exit;
	}
    
    $idtahunajaran	= $_REQUEST['idtahunajaran'];
    $departemen	= $_POST['departemen'];
	$idtingkat	= $_POST['idtingkat'];
	$idkelas	= $_POST['idkelas'];
	$idsemester= $_POST['semester_id'];
	$idpelajaran= $_POST['idpelajaran'];
	$idjeniskompetensi		= $_POST['idjeniskompetensi'];
	$iddasarpenilaian		= $_POST['iddasarpenilaian'];
	
	/*$sqlukbm 	 = $selectview->list_ukbm_pertemuan($idtingkat, $idpelajaran, $semester_id);
	$dataukbm 	 = $sqlukbm->fetch(PDO::FETCH_OBJ);*/ 
	$jumlah_ukbm1= 6; //$dataukbm->jumlah_ukbm;
	    
    if ($_FILES["file"]["size"] > 0) {
    	    	
    	$uid = "import";
		$dlu = date("Y-m-d H:i:s");
		$active = "1";
        
        //cek delimiter (, or ;)
        $filecek = fopen($fileName, "r");        
        $cekcolumn1 = fgetcsv($filecek, 10000, ";");
        $datacol = $cekcolumn1[0];
        //----------------------
       	
       	if (preg_match("/,/",$datacol) == 0) {
       		$file = fopen($fileName, "r");
        	$column1 = fgetcsv($file, 10000, ";");
		} 
		//echo $datacol;
		if (preg_match("/,/",$datacol) == 1) {
			$file = fopen($fileName, "r");
			$column1 = fgetcsv($file, 10000, ",");
		}
        
        $idmapel_xls = str_replace(',','',$column1[301]); //301
        
        if($idmapel_xls != $idpelajaran) {
?>        
			<table align="center" style="font-size: 36px; color: #ff0000">
				<tr>
					<td align="center"><?php echo "Nilai tidak dapat diproses, karena Mata Pelajaran tidak sesuai" ?></td>
				</tr>
				<tr>
					<td align="center"><?php echo "antara Data Excel dan Sistem" ?></td>
				</tr>
			
			</table>
			
<?php
			exit;
		}
        
        $jmlnilai = 0;
        $x = 0;
        if (preg_match("/,/",$datacol) == 0) {
        	while (($column = fgetcsv($file, 20000, ";")) !== FALSE) {
			
			//if ($jumlah_ukbm1 < 14) {
	        	for($y=1; $y<=( ($jumlah_ukbm1) + 1); $y++) {
	        		$nilai_n = substr($column[$y+3], 0, 1);
	        		
	        		if($nilai_n == "N"){
	        			$jmlnilai++;	
					}
				}
			/*} else {
				for($y=1; $y<=( ($jumlah_ukbm1) + 14); $y++) {
	        		$nilai_n = substr($column[$y+2], 0, 1);
	        		
	        		if($nilai_n == "N"){
	        			$jmlnilai++;	
					}
				}
			}*/
			
			if($x > 0) {
        		
        		//brand
	        	$no 		= $column[0]; 
				$nis 		= $column[1];
				$nama 		= $column[2];
				
				##cek data header (PENGETAHUAN)
				$iddasarpenilaian = 3;
				$sqlstr = "select replid from siswa where nis='$nis'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$datasiswa = $sql->fetch(PDO::FETCH_OBJ);
				$nis = $datasiswa->replid;
				
				$hadir 		= $column[24];
								
				if($nis != "") {
					$sqlstr = "select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.hadir, a.line from daftarnilai_pts a where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' order by a.replid";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata = $sql->rowCount();
					$datanilai = $sql->fetch(PDO::FETCH_OBJ);
					
					$id_daftarnilai = "";
					if($rowsdata == 0) {					
						$sqlstr = "insert into daftarnilai_pts (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, hadir, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$hadir', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$id_daftarnilai	=	$data->last_id;
					} else {
						$sqlstr = "update daftarnilai_pts set hadir='$hadir' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$id_daftarnilai = $datanilai->replid;
					}
					
					
					//delete daftarnilai_detail (untuk menghilangkan detail nilai salah input jumlah UKBM)
					$sqlstr_del="delete from daftarnilai_pts_detail where replid='$id_daftarnilai'";
					$sql_del=$dbpdo->prepare($sqlstr_del);
					$sql_del->execute();
					//----------------/\
					
					##detail  (PENGETAHUAN)
					$jumlah_ukbm	=	$jmlnilai; //$_POST["jumlah_ukbm"];
					$lne = 1;
					
					for($y=1; $y<=$jumlah_ukbm; $y++) {
						
						##cek data
						
						$nilai 		= trim($column[(3*$lne)]);
						$len_nilai	= strlen($nilai);
						$abs_max 	= floor($jumlah_ukbm/2)+1;
						
						/*if($nilai == "" || ($len_nilai == 1 && $nilai > 0) || $nilai > 100) {
							$nilai = "NULL";					
						}*/
						
						$line_det 	= $y; //$_POST[line_det.$y.$x];
						//$sqlstr = "select replid from daftarnilai_detail where replid='$id_daftarnilai' and line='$line_det'";
						$sqlstr="select a.replid, a.nilai, a.line from daftarnilai_pts_detail a left join daftarnilai_pts b on a.replid=b.replid where a.replid='$id_daftarnilai' and a.line='$line_det' and b.departemen='$departemen' and b.idtingkat='$idtingkat' and	b.idkelas='$idkelas' and b.idtahunajaran='$idtahunajaran' and b.idsemester='$idsemester' and	b.nis='$nis' and b.idkompetensi='$idkompetensi' and	b.idjeniskompetensi='$idjeniskompetensi' and b.iddasarpenilaian='$iddasarpenilaian' and b.idpelajaran='$idpelajaran' order by a.line";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdet = $sql->rowCount();
						//if($line_det <= ceil($jumlah_ukbm/2)) {
							if($rowsdet == 0) {
								$line = maxline('daftarnilai_pts_detail', 'line', 'replid', $id_daftarnilai, '');
								
								//$nilai 	= $nilai; //$_POST[n.$y.$x];
								$sqlstr = "insert into daftarnilai_pts_detail (replid, nilai, line) values ('$id_daftarnilai', '$nilai', '$line')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							} else {
								//$nilai 	= $_POST[n.$y.$x];
								$sqlstr = "update daftarnilai_pts_detail set nilai='$nilai' where replid='$id_daftarnilai' and line='$line_det'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
						//}
						
						
						$lne++;
					}
					
				}
				
				
				
				
				
				
				##===========================\/ KETERAMPILAN \/===============================
				
				##cek data header (KETERAMPILAN)
				$iddasarpenilaian = 4;
				$persen 		= 0;
				$persen1		= 0;
				$na				= 0;
				
				if($nis != "") {
					$sqlstr = "select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.hadir, a.line from daftarnilai_pts a where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' order by a.replid";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata = $sql->rowCount();
					$datanilai = $sql->fetch(PDO::FETCH_OBJ);
					
					$id_daftarnilai_pts = "";
					if($rowsdata == 0) {					
						$sqlstr = "insert into daftarnilai_pts (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, hadir, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$hadir', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$id_daftarnilai	=	$data->last_id;
					} else {
						$sqlstr = "update daftarnilai_pts set hadir='$hadir' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$id_daftarnilai = $datanilai->replid;
					}
					
					//delete daftarnilai_detail (untuk menghilangkan detail nilai salah input jumlah UKBM)
					$sqlstr_del="delete from daftarnilai_pts_detail where replid='$id_daftarnilai'";
					$sql_del=$dbpdo->prepare($sqlstr_del);
					$sql_del->execute();
					//----------------/\
					
					##detail  (KETERAMPILAN)
					$jumlah_ukbm	=	5; //$jmlnilai; //$_POST["jumlah_ukbm"];
					$lne = 1;
					for($y=1; $y<=$jumlah_ukbm; $y++) {
						
						##cek data
						
						$nilai 		= trim($column[(3*$lne)+1]);
						$len_nilai	= strlen($nilai);
						$abs_max 	= floor($jumlah_ukbm/2)+1;
												
						$line_det 	= $y; //$_POST[line_det.$y.$x];
						//$sqlstr = "select replid from daftarnilai_detail where replid='$id_daftarnilai' and line='$line_det'";
						$sqlstr="select a.replid, a.nilai, a.line from daftarnilai_pts_detail a left join daftarnilai_pts b on a.replid=b.replid where a.replid='$id_daftarnilai' and a.line='$line_det' and b.departemen='$departemen' and b.idtingkat='$idtingkat' and b.idkelas='$idkelas' and b.idtahunajaran='$idtahunajaran' and 	b.idsemester='$idsemester' and	b.nis='$nis' and b.idkompetensi='$idkompetensi' and	b.idjeniskompetensi='$idjeniskompetensi' and b.iddasarpenilaian='$iddasarpenilaian' and b.idpelajaran='$idpelajaran' order by a.line";
						
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdet = $sql->rowCount();
						
						//if($line_det <= ceil($jumlah_ukbm/2)) {
							if($rowsdet == 0) {
								$line = maxline('daftarnilai_pts_detail', 'line', 'replid', $id_daftarnilai, '');
								
								//$nilai 	= $nilai; //$_POST[n.$y.$x];
								$sqlstr = "insert into daftarnilai_pts_detail (replid, nilai, line) values ('$id_daftarnilai', '$nilai', '$line')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							} else {
								//$nilai 	= $_POST[n.$y.$x];
								$sqlstr = "update daftarnilai_pts_detail set nilai='$nilai' where replid='$id_daftarnilai' and line='$line_det'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
						//}
						
						$lne++;
						
					}
					
					
				}



				##===========================\/ TUGAS \/===============================
				
				##cek data header (TUGAS)
				$iddasarpenilaian = 7;
				$persen 		= 0;
				$persen1		= 0;
				$na				= 0;
				
				if($nis != "") {
					$sqlstr = "select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.hadir, a.line from daftarnilai_pts a where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' order by a.replid";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata = $sql->rowCount();
					$datanilai = $sql->fetch(PDO::FETCH_OBJ);
					
					$id_daftarnilai_pts = "";
					if($rowsdata == 0) {					
						$sqlstr = "insert into daftarnilai_pts (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, hadir, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$hadir', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$id_daftarnilai	=	$data->last_id;
					} else {
						$sqlstr = "update daftarnilai_pts set hadir='$hadir' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$id_daftarnilai = $datanilai->replid;
					}
					
					//delete daftarnilai_detail (untuk menghilangkan detail nilai salah input jumlah UKBM)
					$sqlstr_del="delete from daftarnilai_pts_detail where replid='$id_daftarnilai'";
					$sql_del=$dbpdo->prepare($sqlstr_del);
					$sql_del->execute();
					//----------------/\
					
					##detail  (TUGAS)
					$jumlah_ukbm	=	6; //$jmlnilai; //$_POST["jumlah_ukbm"];
					$lne = 1;
					for($y=1; $y<=$jumlah_ukbm; $y++) {
						
						##cek data
						
						$nilai 		= trim($column[(3*$lne)+2]);
						$len_nilai	= strlen($nilai);
						$abs_max 	= floor($jumlah_ukbm/2)+1;
												
						$line_det 	= $y; //$_POST[line_det.$y.$x];
						//$sqlstr = "select replid from daftarnilai_detail where replid='$id_daftarnilai' and line='$line_det'";
						$sqlstr="select a.replid, a.nilai, a.line from daftarnilai_pts_detail a left join daftarnilai_pts b on a.replid=b.replid where a.replid='$id_daftarnilai' and a.line='$line_det' and b.departemen='$departemen' and b.idtingkat='$idtingkat' and b.idkelas='$idkelas' and b.idtahunajaran='$idtahunajaran' and 	b.idsemester='$idsemester' and	b.nis='$nis' and b.idkompetensi='$idkompetensi' and	b.idjeniskompetensi='$idjeniskompetensi' and b.iddasarpenilaian='$iddasarpenilaian' and b.idpelajaran='$idpelajaran' order by a.line";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdet = $sql->rowCount();
						
						//if($line_det <= ceil($jumlah_ukbm/2)) {
							if($rowsdet == 0) {
								$line = maxline('daftarnilai_pts_detail', 'line', 'replid', $id_daftarnilai, '');
								
								//$nilai 	= $nilai; //$_POST[n.$y.$x];
								$sqlstr = "insert into daftarnilai_pts_detail (replid, nilai, line) values ('$id_daftarnilai', '$nilai', '$line')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							} else {
								//$nilai 	= $_POST[n.$y.$x];
								$sqlstr = "update daftarnilai_pts_detail set nilai='$nilai' where replid='$id_daftarnilai' and line='$line_det'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
						//}
						
						$lne++;
						
					}
					
					
				}
				
				
			}
			
			$x++;
			
        }
	  }
	  
	  
	  
	  
	  
	  
	  //===========================KOMA=============================
	   $x = 0;
	   if (preg_match("/,/",$datacol) == 1) {
        	while (($column = fgetcsv($file, 20000, ",")) !== FALSE) {
			
			//if ($jumlah_ukbm1 < 14) {
	        	for($y=1; $y<=( ($jumlah_ukbm1) + 1); $y++) {
	        		$nilai_n = substr($column[$y+3], 0, 1);
	        		
	        		if($nilai_n == "N"){
	        			$jmlnilai++;	
					}
				}
			/*} else {
				for($y=1; $y<=( ($jumlah_ukbm1) + 14); $y++) {
	        		$nilai_n = substr($column[$y+2], 0, 1);
	        		
	        		if($nilai_n == "N"){
	        			$jmlnilai++;	
					}
				}
			}*/
			if($x > 0) {
        		
        		//brand
	        	$no 		= $column[0]; 
				$nis 		= $column[1];
				$nama 		= $column[2];
				
				##cek data header (PENGETAHUAN)
				$iddasarpenilaian = 3;
				$sqlstr = "select replid from siswa where nis='$nis'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$datasiswa = $sql->fetch(PDO::FETCH_OBJ);
				$nis = $datasiswa->replid;
				
				$hadir 		= $column[24];
								
				if($nis != "") {
					$sqlstr = "select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.hadir, a.line from daftarnilai_pts a where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' order by a.replid";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata = $sql->rowCount();
					$datanilai = $sql->fetch(PDO::FETCH_OBJ);
					
					$id_daftarnilai = "";
					if($rowsdata == 0) {					
						$sqlstr = "insert into daftarnilai_pts (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, hadir, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$hadir', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$id_daftarnilai	=	$data->last_id;
					} else {
						$sqlstr = "update daftarnilai_pts set hadir='$hadir' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$id_daftarnilai = $datanilai->replid;
					}
					
					
					//delete daftarnilai_detail (untuk menghilangkan detail nilai salah input jumlah UKBM)
					$sqlstr_del="delete from daftarnilai_pts_detail where replid='$id_daftarnilai'";
					$sql_del=$dbpdo->prepare($sqlstr_del);
					$sql_del->execute();
					//----------------/\
					
					##detail  (PENGETAHUAN)
					$jumlah_ukbm	=	$jmlnilai; //$_POST["jumlah_ukbm"];
					$lne = 1;
					
					for($y=1; $y<=$jumlah_ukbm; $y++) {
						
						##cek data
						
						$nilai 		= trim($column[(3*$lne)]);
						$len_nilai	= strlen($nilai);
						$abs_max 	= floor($jumlah_ukbm/2)+1;
						
						/*if($nilai == "" || ($len_nilai == 1 && $nilai > 0) || $nilai > 100) {
							$nilai = "NULL";					
						}*/
						
						$line_det 	= $y; //$_POST[line_det.$y.$x];
						//$sqlstr = "select replid from daftarnilai_detail where replid='$id_daftarnilai' and line='$line_det'";
						$sqlstr="select a.replid, a.nilai, a.line from daftarnilai_pts_detail a left join daftarnilai_pts b on a.replid=b.replid where a.replid='$id_daftarnilai' and a.line='$line_det' and b.departemen='$departemen' and b.idtingkat='$idtingkat' and	b.idkelas='$idkelas' and b.idtahunajaran='$idtahunajaran' and b.idsemester='$idsemester' and	b.nis='$nis' and b.idkompetensi='$idkompetensi' and	b.idjeniskompetensi='$idjeniskompetensi' and b.iddasarpenilaian='$iddasarpenilaian' and b.idpelajaran='$idpelajaran' order by a.line";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdet = $sql->rowCount();
						//if($line_det <= ceil($jumlah_ukbm/2)) {
							if($rowsdet == 0) {
								$line = maxline('daftarnilai_pts_detail', 'line', 'replid', $id_daftarnilai, '');
								
								//$nilai 	= $nilai; //$_POST[n.$y.$x];
								$sqlstr = "insert into daftarnilai_pts_detail (replid, nilai, line) values ('$id_daftarnilai', '$nilai', '$line')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							} else {
								//$nilai 	= $_POST[n.$y.$x];
								$sqlstr = "update daftarnilai_pts_detail set nilai='$nilai' where replid='$id_daftarnilai' and line='$line_det'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
						//}
						
						
						$lne++;
					}
					
				}
				
				
				
				
				
				
				##===========================\/ KETERAMPILAN \/===============================
				
				##cek data header (KETERAMPILAN)
				$iddasarpenilaian = 4;
				$persen 		= 0;
				$persen1		= 0;
				$na				= 0;
				
				if($nis != "") {
					$sqlstr = "select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.hadir, a.line from daftarnilai_pts a where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' order by a.replid";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata = $sql->rowCount();
					$datanilai = $sql->fetch(PDO::FETCH_OBJ);
					
					$id_daftarnilai_pts = "";
					if($rowsdata == 0) {					
						$sqlstr = "insert into daftarnilai_pts (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, hadir, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$hadir', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$id_daftarnilai	=	$data->last_id;
					} else {
						$sqlstr = "update daftarnilai_pts set hadir='$hadir' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$id_daftarnilai = $datanilai->replid;
					}
					
					//delete daftarnilai_detail (untuk menghilangkan detail nilai salah input jumlah UKBM)
					$sqlstr_del="delete from daftarnilai_pts_detail where replid='$id_daftarnilai'";
					$sql_del=$dbpdo->prepare($sqlstr_del);
					$sql_del->execute();
					//----------------/\
					
					##detail  (KETERAMPILAN)
					$jumlah_ukbm	=	5; //$jmlnilai; //$_POST["jumlah_ukbm"];
					$lne = 1;
					for($y=1; $y<=$jumlah_ukbm; $y++) {
						
						##cek data
						
						$nilai 		= trim($column[(3*$lne)+1]);
						$len_nilai	= strlen($nilai);
						$abs_max 	= floor($jumlah_ukbm/2)+1;
												
						$line_det 	= $y; //$_POST[line_det.$y.$x];
						//$sqlstr = "select replid from daftarnilai_detail where replid='$id_daftarnilai' and line='$line_det'";
						$sqlstr="select a.replid, a.nilai, a.line from daftarnilai_pts_detail a left join daftarnilai_pts b on a.replid=b.replid where a.replid='$id_daftarnilai' and a.line='$line_det' and b.departemen='$departemen' and b.idtingkat='$idtingkat' and b.idkelas='$idkelas' and b.idtahunajaran='$idtahunajaran' and 	b.idsemester='$idsemester' and	b.nis='$nis' and b.idkompetensi='$idkompetensi' and	b.idjeniskompetensi='$idjeniskompetensi' and b.iddasarpenilaian='$iddasarpenilaian' and b.idpelajaran='$idpelajaran' order by a.line";
						
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdet = $sql->rowCount();
						
						//if($line_det <= ceil($jumlah_ukbm/2)) {
							if($rowsdet == 0) {
								$line = maxline('daftarnilai_pts_detail', 'line', 'replid', $id_daftarnilai, '');
								
								//$nilai 	= $nilai; //$_POST[n.$y.$x];
								$sqlstr = "insert into daftarnilai_pts_detail (replid, nilai, line) values ('$id_daftarnilai', '$nilai', '$line')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							} else {
								//$nilai 	= $_POST[n.$y.$x];
								$sqlstr = "update daftarnilai_pts_detail set nilai='$nilai' where replid='$id_daftarnilai' and line='$line_det'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
						//}
						
						$lne++;
						
					}
					
					
				}



				##===========================\/ TUGAS \/===============================
				
				##cek data header (TUGAS)
				$iddasarpenilaian = 7;
				$persen 		= 0;
				$persen1		= 0;
				$na				= 0;
				
				if($nis != "") {
					$sqlstr = "select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.hadir, a.line from daftarnilai_pts a where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' order by a.replid";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata = $sql->rowCount();
					$datanilai = $sql->fetch(PDO::FETCH_OBJ);
					
					$id_daftarnilai_pts = "";
					if($rowsdata == 0) {					
						$sqlstr = "insert into daftarnilai_pts (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, hadir, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$hadir', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$id_daftarnilai	=	$data->last_id;
					} else {
						$sqlstr = "update daftarnilai_pts set hadir='$hadir' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$id_daftarnilai = $datanilai->replid;
					}
					
					//delete daftarnilai_detail (untuk menghilangkan detail nilai salah input jumlah UKBM)
					$sqlstr_del="delete from daftarnilai_pts_detail where replid='$id_daftarnilai'";
					$sql_del=$dbpdo->prepare($sqlstr_del);
					$sql_del->execute();
					//----------------/\
					
					##detail  (TUGAS)
					$jumlah_ukbm	=	6; //$jmlnilai; //$_POST["jumlah_ukbm"];
					$lne = 1;
					for($y=1; $y<=$jumlah_ukbm; $y++) {
						
						##cek data
						
						$nilai 		= trim($column[(3*$lne)+2]);
						$len_nilai	= strlen($nilai);
						$abs_max 	= floor($jumlah_ukbm/2)+1;
												
						$line_det 	= $y; //$_POST[line_det.$y.$x];
						//$sqlstr = "select replid from daftarnilai_detail where replid='$id_daftarnilai' and line='$line_det'";
						$sqlstr="select a.replid, a.nilai, a.line from daftarnilai_pts_detail a left join daftarnilai_pts b on a.replid=b.replid where a.replid='$id_daftarnilai' and a.line='$line_det' and b.departemen='$departemen' and b.idtingkat='$idtingkat' and b.idkelas='$idkelas' and b.idtahunajaran='$idtahunajaran' and 	b.idsemester='$idsemester' and	b.nis='$nis' and b.idkompetensi='$idkompetensi' and	b.idjeniskompetensi='$idjeniskompetensi' and b.iddasarpenilaian='$iddasarpenilaian' and b.idpelajaran='$idpelajaran' order by a.line";
						
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdet = $sql->rowCount();
						
						//if($line_det <= ceil($jumlah_ukbm/2)) {
							if($rowsdet == 0) {
								$line = maxline('daftarnilai_pts_detail', 'line', 'replid', $id_daftarnilai, '');
								
								//$nilai 	= $nilai; //$_POST[n.$y.$x];
								$sqlstr = "insert into daftarnilai_pts_detail (replid, nilai, line) values ('$id_daftarnilai', '$nilai', '$line')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							} else {
								//$nilai 	= $_POST[n.$y.$x];
								$sqlstr = "update daftarnilai_pts_detail set nilai='$nilai' where replid='$id_daftarnilai' and line='$line_det'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
						//}
						
						$lne++;
						
					}
					
					
				}
				
				
			}
			
			$x++;
			
        }
        
        
	  }
	  
	  
	    
        
    }
    
    
//}
?>

<table align="center" style="font-size: 36px; color: #07581c">
	<tr>
		<td><?php echo "Upload Data Nilai Sukses..."; ?></td>
	</tr>
</table>

<?php
exit;

m_selesai:

?>

<table align="center" style="font-size: 36px; color: #ff0000">
	<tr>
		<td><?php echo "Upload Data gagal, Nilai harus 2(dua) digit semua !"; ?></td>
	</tr>
</table>

