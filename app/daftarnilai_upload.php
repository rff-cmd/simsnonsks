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
	
	$sqlukbm 	 = $selectview->list_ukbm_pertemuan($idtingkat, $idpelajaran, $semester_id);
	$dataukbm 	 = $sqlukbm->fetch(PDO::FETCH_OBJ); 
	$jumlah_ukbm1= $dataukbm->jumlah_ukbm;
	    
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
			
			if ($jumlah_ukbm1 < 14) {
	        	for($y=1; $y<=( ($jumlah_ukbm1) + 9); $y++) {
	        		$nilai_n = substr($column[$y+2], 0, 1);
	        		
	        		if($nilai_n == "N"){
	        			$jmlnilai++;	
					}
				}
			} else {
				for($y=1; $y<=( ($jumlah_ukbm1) + 14); $y++) {
	        		$nilai_n = substr($column[$y+2], 0, 1);
	        		
	        		if($nilai_n == "N"){
	        			$jmlnilai++;	
					}
				}
			}
			
			if($x > 0) {
        		
        		//brand
	        	$no 		= $column[0]; 
				$nis 		= $column[1];
				$nama 		= $column[2];
				//$uts		= $column[($jmlnilai * 2) + 2];
				//$uas		= $column[($jmlnilai) + 3];
				
				if(allowlvl("frmdaftarnilai") == 2) { //LEVEL bisa edit dan lihat PAS
					$uas_p		= $column[($jumlah_ukbm1*2) + 3]; //$column[($jmlnilai) + 3];
					$uas_k		= $column[($jumlah_ukbm1*2) + 4];
				} else {
					$uas_p		= $column[300];
					$uas_k		= $column[301];
				}
				
				if($uas_p == "") {
					$uas_p = "NULL";
				}
				
				if($uas_k == "") {
					$uas_k = "NULL";
				}
				$sakit		= $column[($jumlah_ukbm1*2) + 5];
				$izin		= $column[($jumlah_ukbm1*2) + 6];
				$alpa		= $column[($jumlah_ukbm1*2) + 7];
				$dispensasi	= $column[($jumlah_ukbm1*2) + 8];
				$sikap		= strtoupper($column[($jumlah_ukbm1*2) + 9]);
				
				##cek data header (PENGETAHUAN)
				$iddasarpenilaian = 3;
				$sqlstr = "select replid from siswa where nis='$nis'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$datasiswa = $sql->fetch(PDO::FETCH_OBJ);
				$nis = $datasiswa->replid;
				
				$persen 		= 0;
				$persen1		= 0;
				$na				= 0;
				
				if($uts == "") {
					$uts = 0;
				}
				if($jumlah == "") {
					$jumlah = 0;
				}
				if($rata == "") {
					$rata = 0;
				}
				if($a == "") {
					$a = 0;
				}
				$uas_p = str_replace(',','.',$uas_p);
								
				if($nis != "") {
					$sqlstr = "select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.uts, a.jumlah, a.rata, a.persen, a.uas, a.persen1, a.na, a.a, a.line from daftarnilai a where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' order by a.replid";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata = $sql->rowCount();
					$datanilai = $sql->fetch(PDO::FETCH_OBJ);
					
					$id_daftarnilai = "";
					if($rowsdata == 0) {					
						$sqlstr = "insert into daftarnilai (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, n1, n2, n3, n4, uts, jumlah, rata, persen, uas, persen1, na, a, sakit, izin, alpa, dispensasi, sikap, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$n1', '$n2', '$n3', '$n4', '$uts', '$jumlah', '$rata', '$persen', $uas_p, '$persen1', '$na', '$a', '$sakit', '$izin', '$alpa', '$dispensasi', '$sikap', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$id_daftarnilai	=	$data->last_id;
					} else {
						$sqlstr = "update daftarnilai set uts='$uts', jumlah='$jumlah', rata='$rata', persen='$persen', uas=$uas_p, persen1='$persen1', na='$na', a='$a', sakit='$sakit', izin='$izin', alpa='$alpa', dispensasi='$dispensasi', sikap='$sikap' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$id_daftarnilai = $datanilai->replid;
					}
					
					
					//delete daftarnilai_detail (untuk menghilangkan detail nilai salah input jumlah UKBM)
					$sqlstr_del="delete from daftarnilai_detail where replid='$id_daftarnilai'";
					$sql_del=$dbpdo->prepare($sqlstr_del);
					$sql_del->execute();
					//----------------/\
					
					##detail  (PENGETAHUAN)
					$jumlah_ukbm	=	$jmlnilai; //$_POST["jumlah_ukbm"];
					$lne = 1;
					
					for($y=1; $y<=$jumlah_ukbm; $y++) {
						
						##cek data
						$lne++;
						$nilai 		= trim($column[(2*$lne)-1]);
						$len_nilai	= strlen($nilai);
						$abs_max 	= floor($jumlah_ukbm/2)+1;
						//echo '$nis='.$nis.'>>$nilai='.$nilai.'>>$abs_max='.$abs_max.'<br>';
						/*if ( ($len_nilai == 1 || $nilai > 100) && $y<=$abs_max && $nilai > 0 ) {							
						?>
								<script>
									alert("Proses dihentikan, Nilai harus 2(dua) digit semua !");
								</script>
						<?php		
								goto m_selesai;
						}*/
						
						if($nilai == "" || ($len_nilai == 1 && $nilai > 0) || $nilai > 100) {
							$nilai = "NULL";					
						}
						
						$line_det 	= $y; //$_POST[line_det.$y.$x];
						//$sqlstr = "select replid from daftarnilai_detail where replid='$id_daftarnilai' and line='$line_det'";
						$sqlstr="select a.replid, a.nilai, a.line from daftarnilai_detail a left join daftarnilai b on a.replid=b.replid where a.replid='$id_daftarnilai' and a.line='$line_det' and b.departemen='$departemen' and b.idtingkat='$idtingkat' and	b.idkelas='$idkelas' and b.idtahunajaran='$idtahunajaran' and 	b.idsemester='$idsemester' and	b.nis='$nis' and b.idkompetensi='$idkompetensi' and	b.idjeniskompetensi='$idjeniskompetensi' and b.iddasarpenilaian='$iddasarpenilaian' and b.idpelajaran='$idpelajaran' order by a.line";
						
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdet = $sql->rowCount();
						
						if($line_det <= ceil($jumlah_ukbm/2)) {
							if($rowsdet == 0) {
								$line = maxline('daftarnilai_detail', 'line', 'replid', $id_daftarnilai, '');
								
								//$nilai 	= $nilai; //$_POST[n.$y.$x];
								$sqlstr = "insert into daftarnilai_detail (replid, nilai, line) values ('$id_daftarnilai', $nilai, '$line')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							} else {
								//$nilai 	= $_POST[n.$y.$x];
								$sqlstr = "update daftarnilai_detail set nilai=$nilai where replid='$id_daftarnilai' and line='$line_det'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
						}
						
					}
					
					
					##update jumlah nilai
					$iddasarpenilaian = 3;
					$sqlstr = "select sum(b.nilai) jumlah from daftarnilai a left join daftarnilai_detail b on a.replid=b.replid where a.departemen='$departemen' and a.idtingkat='$idtingkat' and a.idkelas='$idkelas' and a.idtahunajaran='$idtahunajaran' and a.idsemester='$idsemester' and a.nis='$nis' and a.idkompetensi='$idkompetensi' and a.idjeniskompetensi='$idjeniskompetensi' and a.iddasarpenilaian='$iddasarpenilaian' and a.idpelajaran='$idpelajaran' and b.nilai is not null group by b.replid";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$datanilai1 = $sql->fetch(PDO::FETCH_OBJ);
					$nilai_sum 	= $datanilai1->jumlah;
					
					$sqlstr = "select a.replid from daftarnilai a left join daftarnilai_detail b on a.replid=b.replid where a.departemen='$departemen' and a.idtingkat='$idtingkat' and a.idkelas='$idkelas' and a.idtahunajaran='$idtahunajaran' and a.idsemester='$idsemester' and a.nis='$nis' and a.idkompetensi='$idkompetensi' and a.idjeniskompetensi='$idjeniskompetensi' and a.iddasarpenilaian='$iddasarpenilaian' and a.idpelajaran='$idpelajaran' and b.nilai is not null ";
					$sql2=$dbpdo->prepare($sqlstr);
					$sql2->execute();
					$count_data_nilai = $sql2->rowCount();
					
					if($count_data_nilai == 0) {
						$rata_raport	= 0;
					} else {
						$rata_raport	= $nilai_sum/$count_data_nilai;
					}
					
					if($uas_p == "NULL") {
						if($count_data_nilai == 0) {
							$rata = 0;
						} else {
							$rata		= number_format($nilai_sum/$count_data_nilai,2,'.',',');	
						}
					} else {
						$nilai_sum 	= $nilai_sum + $uas_p;
						$rata		= number_format($nilai_sum/($count_data_nilai + 1),2,'.',',');
						
						$persen1	= $uas_p * 0.25;
					}
					
					if($uas_p == "NULL") {
						$na				= $rata_raport;	
					} else {
						$persen 		= $rata_raport * 0.75;
						$na				= $persen + $persen1;						
					}
					
									
					$sqlstr = "update daftarnilai set jumlah='$nilai_sum', rata='$rata', na='$na' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
				
				
				
				
				
				
				##===========================\/ KETERAMPILAN \/===============================
				
				##cek data header (KETERAMPILAN)
				
			}
			
			$x++;
			
        }
	  }
	  
	  
	  
	  
	  
	  //===========================KOMA=============================
	  if (preg_match("/,/",$datacol) == 1) {
        	while (($column = fgetcsv($file, 20000, ",")) !== FALSE) {
		
        	
        	if ($jumlah_ukbm1 < 14) {
	        	for($y=1; $y<=( ($jumlah_ukbm1) + 9); $y++) {
	        		$nilai_n = substr($column[$y+2], 0, 1);
	        		
	        		if($nilai_n == "N"){
	        			$jmlnilai++;	
					}
				}
			} else {
				for($y=1; $y<=( ($jumlah_ukbm1) + 14); $y++) {
	        		$nilai_n = substr($column[$y+2], 0, 1);
	        		
	        		if($nilai_n == "N"){
	        			$jmlnilai++;	
					}
				}
			}
			
			if($x > 0) {
        		
        		//brand
	        	$no 		= $column[0]; 
				$nis 		= $column[1];
				$nama 		= $column[2];
				//$uts		= $column[($jmlnilai * 2) + 2];
				//$uas		= $column[($jmlnilai) + 3];
				if(allowlvl("frmdaftarnilai") == 2) { //LEVEL bisa edit dan lihat PAS
					$uas_p		= $column[($jumlah_ukbm1*2) + 3]; //$column[($jmlnilai) + 3];
					$uas_k		= $column[($jumlah_ukbm1*2) + 4];
				} else {
					$uas_p		= $column[300];
					$uas_k		= $column[301];
				}
				
				if($uas_p == "") {
					$uas_p = "NULL";
				}
				
				if($uas_k == "") {
					$uas_k = "NULL";
				}
				$sakit		= $column[($jumlah_ukbm1*2) + 5];
				$izin		= $column[($jumlah_ukbm1*2) + 6];
				$alpa		= $column[($jumlah_ukbm1*2) + 7];
				$dispensasi	= $column[($jumlah_ukbm1*2) + 8];
				$sikap		= strtoupper($column[($jumlah_ukbm1*2) + 9]);
				
				##cek data header (PENGETAHUAN)
				$iddasarpenilaian = 3;
				$sqlstr = "select replid from siswa where nis='$nis'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$datasiswa = $sql->fetch(PDO::FETCH_OBJ);
				$nis = $datasiswa->replid;
				
				$persen 		= 0;
				$persen1		= 0;
				$na				= 0;
				
				if($uts == "") {
					$uts = 0;
				}
				if($jumlah == "") {
					$jumlah = 0;
				}
				if($rata == "") {
					$rata = 0;
				}
				if($a == "") {
					$a = 0;
				}
				$uas_p = str_replace(',','.',$uas_p);
				
				if($nis != "") {
					$sqlstr = "select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.uts, a.jumlah, a.rata, a.persen, a.uas, a.persen1, a.na, a.a, a.line from daftarnilai a where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' order by a.replid";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata = $sql->rowCount();
					$datanilai = $sql->fetch(PDO::FETCH_OBJ);
					
					$id_daftarnilai = "";
					if($rowsdata == 0) {					
						$sqlstr = "insert into daftarnilai (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, n1, n2, n3, n4, uts, jumlah, rata, persen, uas, persen1, na, a, sakit, izin, alpa, dispensasi, sikap, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$n1', '$n2', '$n3', '$n4', '$uts', '$jumlah', '$rata', '$persen', $uas_p, '$persen1', '$na', '$a', '$sakit', '$izin', '$alpa', '$dispensasi', '$sikap', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$id_daftarnilai	=	$data->last_id;
					} else {
						$sqlstr = "update daftarnilai set uts='$uts', jumlah='$jumlah', rata='$rata', persen='$persen', uas=$uas_p, persen1='$persen1', na='$na', a='$a', sakit='$sakit', izin='$izin', alpa='$alpa', dispensasi='$dispensasi', sikap='$sikap' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$id_daftarnilai = $datanilai->replid;
					}
					
					
					//delete daftarnilai_detail (untuk menghilangkan detail nilai salah input jumlah UKBM)
					$sqlstr_del="delete from daftarnilai_detail where replid='$id_daftarnilai'";
					$sql_del=$dbpdo->prepare($sqlstr_del);
					$sql_del->execute();
					//----------------/\
					
					##detail  (PENGETAHUAN)
					$jumlah_ukbm	=	$jmlnilai; //$_POST["jumlah_ukbm"];
					$lne = 1;
					for($y=1; $y<=$jumlah_ukbm; $y++) {
						
						##cek data
						$lne++;
						$nilai 		= trim($column[(2*$lne)-1]);
						$len_nilai	= strlen($nilai);
						$abs_max 	= floor($jumlah_ukbm/2)+1;
						//echo $len_nilai.">>".$nilai."+++".$y.">>".$abs_max."<br>";
						/*if ( ($len_nilai == 1 || $nilai > 100) && $y<=$abs_max && $nilai > 0 ) {							
						?>
								<script>
									alert("Proses dihentikan, Nilai harus 2(dua) digit semua !");
								</script>
						<?php		
								goto m_selesai;
						}*/
						if($nilai == "" || ($len_nilai == 1 && $nilai > 0) || $nilai > 100) {
							$nilai = "NULL";
						}
						
						$line_det 	= $y; //$_POST[line_det.$y.$x];
						//$sqlstr = "select replid from daftarnilai_detail where replid='$id_daftarnilai' and line='$line_det'";
						$sqlstr="select a.replid, a.nilai, a.line from daftarnilai_detail a left join daftarnilai b on a.replid=b.replid where a.replid='$id_daftarnilai' and a.line='$line_det' and b.departemen='$departemen' and b.idtingkat='$idtingkat' and	b.idkelas='$idkelas' and b.idtahunajaran='$idtahunajaran' and 	b.idsemester='$idsemester' and	b.nis='$nis' and b.idkompetensi='$idkompetensi' and	b.idjeniskompetensi='$idjeniskompetensi' and b.iddasarpenilaian='$iddasarpenilaian' and b.idpelajaran='$idpelajaran' order by a.line";
						
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdet = $sql->rowCount();
						
						if($line_det <= ceil($jumlah_ukbm/2)) {
							if($rowsdet == 0) {
								$line = maxline('daftarnilai_detail', 'line', 'replid', $id_daftarnilai, '');
								
								//$nilai 	= $nilai; //$_POST[n.$y.$x];
								$sqlstr = "insert into daftarnilai_detail (replid, nilai, line) values ('$id_daftarnilai', $nilai, '$line')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							} else {
								//$nilai 	= $_POST[n.$y.$x];
								$sqlstr = "update daftarnilai_detail set nilai=$nilai where replid='$id_daftarnilai' and line='$line_det'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
						}
						
					}
					
					
					##update jumlah nilai
					$iddasarpenilaian = 3;
					$sqlstr = "select sum(b.nilai) jumlah from daftarnilai a left join daftarnilai_detail b on a.replid=b.replid where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' and b.nilai is not null group by b.replid ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$datanilai1 = $sql->fetch(PDO::FETCH_OBJ);
					$nilai_sum 	= $datanilai1->jumlah;
					
					$sqlstr = "select a.replid from daftarnilai a left join daftarnilai_detail b on a.replid=b.replid where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' and b.nilai is not null";
					
					//and a.n1=0
					$sql2=$dbpdo->prepare($sqlstr);
					$sql2->execute();
					$count_data_nilai = $sql2->rowCount();
					
					if($count_data_nilai == 0) {
						$rata_raport	= 0;
					} else {
						$rata_raport	= $nilai_sum/$count_data_nilai;
					}
					
					if($uas_p == "NULL") {
						if($count_data_nilai == 0) {
							$rata = 0;
						} else {
							$rata		= number_format($nilai_sum/$count_data_nilai,2,'.',',');	
						}
					} else {
						$nilai_sum 	= $nilai_sum + $uas_p;
						$rata		= number_format($nilai_sum/($count_data_nilai + 1),2,'.',',');
						
						$persen1	= $uas_p * 0.25;
					}
					
					if($uas_p == "NULL") {
						$na				= $rata_raport;	
					} else {
						$persen 		= $rata_raport * 0.75;
						$na				= $persen + $persen1;	
					}
					
					$sqlstr = "update daftarnilai set jumlah='$nilai_sum', rata='$rata', na='$na' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
				
				
				
				
				
				
				##===========================\/ KETERAMPILAN \/===============================
				
			}
			
			$x++;
			
        }
	  }
	  
	    
        
    }
    
    
//}
?>

<table align="center" style="font-size: 36px; color: #07581c">
	<tr>
		<td><?php echo "Upload Data Nilai Pengetahuan Sukses..."; ?></td>
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

