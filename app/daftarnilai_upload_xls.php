<?php
	@session_start();

	if (($_SESSION["logged"] == 0)) {
		echo 'Access denied';
		exit;
	}
	
	include_once ("../import/excel_reader2.php");
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
	
	// membaca file excel yang diupload
	$data = new Spreadsheet_Excel_Reader($_FILES['file']['tmp_name']);

	// membaca jumlah baris dari data excel
	$baris = $data->rowcount($sheet_index=0);
	    
    //if ($_FILES["file"]["size"] > 0) {
    $x = 4;
	for ($i=1; $i<=$baris; $i++)
	{	    	
    	$uid = "import";
		$dlu = date("Y-m-d H:i:s");
		$active = "1";
        
        //$file = fopen($fileName, "r");
        
        //$column1 = fgetcsv($file, 10000, ",");
        $idmapel_xls = $data->val($i, 301); //$column1[301]; //301
        echo $idmapel_xls; exit;
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
        while (($column = fgetcsv($file, 20000, ",")) !== FALSE) {
        	
        	for($y=1; $y<=( ($jumlah_ukbm1) + 9); $y++) {
        		$nilai_n = substr($column[$y+2], 0, 1);
        		if($nilai_n == "N"){
        			$jmlnilai++;	
				}
			}
			
			if($x > 0) {
        		
        		//brand
	        	$no 		= $column[0]; 
				$nis 		= $column[1];
				$nama 		= $column[2];
				//$uts		= $column[($jmlnilai * 2) + 2];
				//$uas		= $column[($jmlnilai) + 3];
				$uas_p		= $column[($jumlah_ukbm1*2) + 3]; //$column[($jmlnilai) + 3];
				
				if($uas_p == "") {
					$uas_p = "NULL";
				}
				$uas_k		= $column[($jumlah_ukbm1*2) + 4];
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
						$nilai 		= $column[(2*$lne)-1];
						$len_nilai	= strlen($nilai);
						if($nilai == "" || $len_nilai == 1 || $nilai > 100) {
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
					$sqlstr = "select sum(b.nilai) jumlah from daftarnilai a left join daftarnilai_detail b on a.replid=b.replid where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' group by b.replid";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$datanilai1 = $sql->fetch(PDO::FETCH_OBJ);
					$nilai_sum 	= $datanilai1->jumlah;
					
					$sqlstr = "select a.replid from daftarnilai a left join daftarnilai_detail b on a.replid=b.replid where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' and b.nilai is not null";
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
				$iddasarpenilaian = 4;
				$persen 		= 0;
				$persen1		= 0;
				$na				= 0;
				
				if($nis != "") {
					$sqlstr = "select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.uts, a.jumlah, a.rata, a.persen, a.uas, a.persen1, a.na, a.a, a.line from daftarnilai a where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' order by a.replid";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata = $sql->rowCount();
					$datanilai = $sql->fetch(PDO::FETCH_OBJ);
					
					$id_daftarnilai = "";
					if($rowsdata == 0) {					
						$sqlstr = "insert into daftarnilai (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, n1, n2, n3, n4, uts, jumlah, rata, persen, uas, persen1, na, a, sakit, izin, alpa, dispensasi, sikap, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$n1', '$n2', '$n3', '$n4', '$uts', '$jumlah', '$rata', '$persen', $uas_k, '$persen1', '$na', '$a', '$sakit', '$izin', '$alpa', '$dispensasi', '$sikap', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$id_daftarnilai	=	$data->last_id;
					} else {
						$sqlstr = "update daftarnilai set uts='$uts', jumlah='$jumlah', rata='$rata', persen='$persen', uas=$uas_k, persen1='$persen1', na='$na', a='$a', sakit='$sakit', izin='$izin', alpa='$alpa', dispensasi='$dispensasi', sikap='$sikap' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$id_daftarnilai = $datanilai->replid;
					}
					
					//delete daftarnilai_detail (untuk menghilangkan detail nilai salah input jumlah UKBM)
					$sqlstr_del="delete from daftarnilai_detail where replid='$id_daftarnilai'";
					$sql_del=$dbpdo->prepare($sqlstr_del);
					$sql_del->execute();
					//----------------/\
					
					##detail  (KETERAMPILAN)
					$jumlah_ukbm	=	$jmlnilai; //$_POST["jumlah_ukbm"];
					$lne = 0;
					for($y=1; $y<=$jumlah_ukbm; $y++) {
						
						##cek data
						$lne++;
						$nilai 		= $column[(2*$lne)+2];
						$len_nilai	= strlen($nilai);
						if($nilai == "" || $len_nilai == 1 || $nilai > 100) {
							$nilai = "NULL";
						}
						
						$line_det 	= $y; //$_POST[line_det.$y.$x];
						//$sqlstr = "select replid from daftarnilai_detail where replid='$id_daftarnilai' and line='$line_det'";
						$sqlstr="select a.replid, a.nilai, a.line from daftarnilai_detail a left join daftarnilai b on a.replid=b.replid where a.replid='$id_daftarnilai' and a.line='$line_det' and b.departemen='$departemen' and b.idtingkat='$idtingkat' and b.idkelas='$idkelas' and b.idtahunajaran='$idtahunajaran' and 	b.idsemester='$idsemester' and	b.nis='$nis' and b.idkompetensi='$idkompetensi' and	b.idjeniskompetensi='$idjeniskompetensi' and b.iddasarpenilaian='$iddasarpenilaian' and b.idpelajaran='$idpelajaran' order by a.line";
						
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
					$iddasarpenilaian = 4;
					$sqlstr = "select sum(b.nilai) jumlah, a.replid from daftarnilai a left join daftarnilai_detail b on a.replid=b.replid where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' group by b.replid";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$datanilai1 = $sql->fetch(PDO::FETCH_OBJ);
					$nilai_sum 	= $datanilai1->jumlah;
					
					##cari nilai tertinggi
					/*$nilai_tertinggi = 0;
					$sqlstr = "select ifnull(nilai,0) nilai from daftarnilai_detail where replid='$datanilai1->replid'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					while($datatertinggi = $sql->fetch(PDO::FETCH_OBJ)) {
						if($nilai_tertinggi < $datatertinggi->nilai) {
							$nilai_tertinggi = $datatertinggi->nilai;
						}
					}
					
					$rata_raport1	= $nilai_tertinggi;
					
					if($uas_k != "NULL") {
						if($nilai_tertinggi < $uas_k) {
							$nilai_tertinggi = $uas_k;
						}
						
						$persen1 = $uas_k * 0.25;
					}
					$rata		= number_format($nilai_tertinggi,0,'.',',');
					
					if($uas_k == "NULL") {
						$na				= $$rata_raport1;
					} else {						
						$persen 		= $rata_raport1 * 0.75;					
						$na				= $persen + $persen1;
					}*/					
					
					//============================
					$sqlstr = "select a.replid from daftarnilai a left join daftarnilai_detail b on a.replid=b.replid where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' and b.nilai is not null";
					$sql2=$dbpdo->prepare($sqlstr);
					$sql2->execute();
					$count_data_nilai = $sql2->rowCount();
					
					if($count_data_nilai == 0) {
						$rata_raport1	= 0;
					} else {
						$rata_raport1	= $nilai_sum/$count_data_nilai;
					}
					
					if($uas_k == "NULL") {
						if($count_data_nilai == 0) {
							$rata = 0;
						} else {
							$rata		= number_format($nilai_sum/$count_data_nilai,2,'.',',');	
						}
					} else {
						$nilai_sum 	= $nilai_sum + $uas_k;
						$rata		= number_format($nilai_sum/($count_data_nilai + 1),2,'.',',');
						
						$persen1	= $uas_k * 0.25;
					}
					
					if($uas_k == "NULL") {
						$na				= $rata_raport1;	
					} else {
						$persen 		= $rata_raport1 * 0.75;
						$na				= $persen + $persen1;						
					}
					
					
					
					$sqlstr = "update daftarnilai set jumlah='$nilai_sum', rata='$rata', na='$na' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				
				}
				
			}
			
			$x++;
			
        }
    }
    
    
//}
?>

<table align="center" style="font-size: 36px; color: #07581c">
	<tr>
		<td><?php echo "Upload Data Nilai Sukses..."; ?></td>
	</tr>
	
</table>

