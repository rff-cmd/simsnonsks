<script type="text/javascript" src="../js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='idpelajaran') {
			alert('Mata Pelajaran tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='file') {
			alert('File CSV belum di ambil!');				
		  }
		  
		  return false
		} 
										
	  }		 
	}
		
</script>


<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;	
		var str = str + '&button=' + button;
		
		if (window.XMLHttpRequest){
			request = new XMLHttpRequest();
			request.onreadystatechange = processStateChange;
			request.open("POST", URL, true);
			request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
			request.send(str);		
					
		} else if (window.ActiveXObject) {
			request = new ActiveXObject("Microsoft.XMLHTTP");
			if (request) {
				request.onreadystatechange = processStateChange;
				request.open("POST", URL, true);
				request.send();				
			}
		}
				
	}
	 
</script>

<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("../app/include/sambung.php");
include_once ("../app/include/functions.php");

include_once ("../app/class/class.select.php");
include_once ("../app/class/class.selectview.php");

$select 	= new select;
$selectview = new selectview;

$dbpdo = DB::create();

##cek data header (KETERAMPILAN)
$departemen		= "SMA";
$idtingkat		= $_POST['idtingkat']; //27-->X    28-->XI
$idkelas		= $_POST["idkelas"];
$idtahunajaran	= 0; //$_SESSION["idtahunajaran"]; //$_REQUEST["idtahunajaran"];
$idpelajaran	= $_POST["idpelajaran"];
$idsemester		= 20; //semeter genap
$idkompetensi	= 0;
$idjeniskompetensi 	= 1;
$iddasarpenilaian	= 4; //keterampilan

?>

<form class="form-horizontal" role="form" action="" method="post" name="daftarnilai_input" id="daftarnilai_input" enctype="multipart/form-data" onSubmit="return cekinput('idpelajaran,file');" >
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat *)</label>
		<div class="col-sm-3">
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('../app/daftar_nilai_ajax.php','kelas_id','getkelas','idtingkat')" >
				<option value=""></option>
				<?php select_tingkat_unit("SMA", $idtingkat); ?>
			</select>								
		</div>
	</div>
	   	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas *)</label>
		<div class="col-sm-3" id="kelas_id">
			<select name="idkelas" id="idkelas" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelas($idtingkat, $idkelas); ?>
			</select>								
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mata Pelajaran *)</label>
		<div class="col-sm-4">
			<select name="idpelajaran" id="idpelajaran" class="chosen-select form-control">
				<option value=""></option>
				<?php 
					//select_pelajaran_all($row_guru->idpelajaran); 
					select_pelajaran_krs($idpelajaran);
				?>
			</select>
		</div>
	</div>				
	<br>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
		<div class="col-sm-3">
			<input type="file" name="file" id="file" accept=".csv">
		</div>
	</div>
	
	<br>
	<div class="form-group">
		<div class="col-sm-3">
			<input type="submit" name="submit" class='btn btn-primary' value="Proses Import" >
		</div>
	</div>
</form>

<?php
if($_POST["submit"]) {
	$select 	= new select;
	$selectview = new selectview;

	$dbpdo = DB::create();

    $fileName 	= $_FILES["file"]["tmp_name"];
    
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
    	    	
    	//$file = fopen($fileName, "r");
    	
    	//cek delimiter (, or ;)
        $filecek = fopen($fileName, "r");        
        $cekcolumn1 = fgetcsv($filecek, 10000, ";");
        $datacol = $cekcolumn1[0];
        //----------------------
       	
       	if (preg_match("/,/",$datacol) == 0) {
       		$file = fopen($fileName, "r");
        	$column = fgetcsv($file, 10000, ";");
		} 
		//echo $datacol;
		if (preg_match("/,/",$datacol) == 1) {
			$file = fopen($fileName, "r");
			$column = fgetcsv($file, 10000, ",");
		}
		
        
        $jmlnilai = 0;
        $x = 1;
        $insert = 0;
        $update = 0;
        
        if (preg_match("/,/",$datacol) == 0) {
	        while (($column = fgetcsv($file, 20000, ";")) !== FALSE) {
	        	        	
	        	if($x > 0) {
	        		
					//$nama			=	petikreplace($column[0]);
					$nis			=	$column[0];
					//$kelas			= 	$column[2];
					$nilai			=	$column[1];
					$uid			=	"import";
					$dlu			=	date("Y-m-d H:i:s");
					
					if($nis != "") {
						
						
						$sqlstr = "select a.replid, a.idkelas, b.idtingkat  from siswa a left join kelas b on a.idkelas=b.replid where a.nis='$nis'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$data=$sql->fetch(PDO::FETCH_OBJ);
						
						
						/*echo 'ID : '.$data->replid.'>>NIS : '.$nis.'>>Nama : '.$nama.'>>Nilai'.$nilai.'<br>';
						echo 'ID Tingkat :'.$idtingkat.'>>Kelas :'.$data->idkelas.'>>ID Mapel :'.$idpelajaran.'>>ID Thn Ajaran :'.$_SESSION["idtahunajaran"].'>>ID Semester :'.$_SESSION["semester_id"]. '<br>';*/
						
						$iddasarpenilaian	=	3;
						
						//cek nilai
						$sqlstr = "select replid from daftarnilai where departemen='SMA' and idtingkat='$data->idtingkat' and idkelas='$data->idkelas' and idtahunajaran='$_SESSION[idtahunajaran]' and idsemester='$_SESSION[semester_id]' and nis='$data->replid' and idpelajaran='$idpelajaran' and iddasarpenilaian='$iddasarpenilaian'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdata = $sql->rowCount();
						
						$idjeniskompetensi	=	1;
						$uas				=	$nilai;
						if($rowsdata == 0) {
							
							$line = maxline('daftarnilai', 'line', 'departemen', 'SMA', '');
							
							$sqlstr = "insert into daftarnilai (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, uas, line) values('SMA', '$data->idtingkat', '$data->idkelas', '$_SESSION[idtahunajaran]', '$_SESSION[semester_id]', '$data->replid', 0, '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$uas', '$line')"; 
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							$insert++;
						} else {
							$sqlstr = "update daftarnilai set uas='$uas' where departemen='SMA' and idtingkat='$data->idtingkat' and idkelas='$data->idkelas' and idtahunajaran='$_SESSION[idtahunajaran]' and idsemester='$_SESSION[semester_id]' and nis='$data->replid' and idpelajaran='$idpelajaran' and iddasarpenilaian='$iddasarpenilaian'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							$update++;
						}
						
					}				
								
				}
				
				$x++;
				
	        }
		}
		
		
		//===========================KOMA=============================
		if (preg_match("/,/",$datacol) == 1) {
	        while (($column = fgetcsv($file, 20000, ",")) !== FALSE) {
					        	        	
	        	if($x > 0) {
	        		
					//$nama			=	petikreplace($column[0]);
					$nis			=	$column[0];
					//$kelas			= 	$column[2];
					$nilai			=	$column[1];
					$uid			=	"import";
					$dlu			=	date("Y-m-d H:i:s");
					
					if($nis != "") {
						
						
						$sqlstr = "select a.replid, a.idkelas, b.idtingkat  from siswa a left join kelas b on a.idkelas=b.replid where a.nis='$nis'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$data=$sql->fetch(PDO::FETCH_OBJ);
						
						
						/*echo 'ID : '.$data->replid.'>>NIS : '.$nis.'>>Nama : '.$nama.'>>Nilai'.$nilai.'<br>';
						echo 'ID Tingkat :'.$idtingkat.'>>Kelas :'.$data->idkelas.'>>ID Mapel :'.$idpelajaran.'>>ID Thn Ajaran :'.$_SESSION["idtahunajaran"].'>>ID Semester :'.$_SESSION["semester_id"]. '<br>';*/
						
						$iddasarpenilaian	=	3;
						
						//cek nilai
						$sqlstr = "select replid from daftarnilai where departemen='SMA' and idtingkat='$data->idtingkat' and idkelas='$data->idkelas' and idtahunajaran='$_SESSION[idtahunajaran]' and idsemester='$_SESSION[semester_id]' and nis='$data->replid' and idpelajaran='$idpelajaran' and iddasarpenilaian='$iddasarpenilaian'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdata = $sql->rowCount();
						
						$idjeniskompetensi	=	1;
						$uas				=	$nilai;
						if($rowsdata == 0) {
							
							$line = maxline('daftarnilai', 'line', 'departemen', 'SMA', '');
							
							$sqlstr = "insert into daftarnilai (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, uas, line) values('SMA', '$data->idtingkat', '$data->idkelas', '$_SESSION[idtahunajaran]', '$_SESSION[semester_id]', '$data->replid', 0, '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$uas', '$line')"; 
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							$insert++;
						} else {
							$sqlstr = "update daftarnilai set uas='$uas' where departemen='SMA' and idtingkat='$data->idtingkat' and idkelas='$data->idkelas' and idtahunajaran='$_SESSION[idtahunajaran]' and idsemester='$_SESSION[semester_id]' and nis='$data->replid' and idpelajaran='$idpelajaran' and iddasarpenilaian='$iddasarpenilaian'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							$update++;
						}
						
					}				
								
				}
				
				$x++;
				
	        }
		}
		
		
		
		
    }


?>    

<table align="center" style="font-size: 36px; color: #07581c">
	<tr>
		<td><?php echo "Jumlah Tambah Data : " . $insert; ?></td>
	</tr>
	<tr>
		<td><?php echo "Jumlah Update Data : " . $update; ?></td>
	</tr>
</table>

<?php    
}
?>


<?php
/*if($_POST["submit"]) {
	
	$persen 		= 0;
	$persen1		= 0;
	$na				= 0;

	if($idkelas == "") {
		$sqlsiswa = "select a.replid, a.idkelas, b.idtingkat, a.nis, a.nama from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where b.idtingkat='$idtingkat' ";
		$resultssiswa=$dbpdo->query($sqlsiswa);	
	}
	if($idkelas != "") {
		$sqlsiswa = "select a.replid, a.idkelas, b.idtingkat, a.nis, a.nama from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where b.idtingkat='$idtingkat' and a.idkelas='$idkelas'";
		$resultssiswa=$dbpdo->query($sqlsiswa);	
	}
	
	$no = 0;
	while ($row_siswa = $resultssiswa->fetch(PDO::FETCH_OBJ)){
		
		$nis		= $row_siswa->replid;
		$idkelas 	= $row_siswa->idkelas;
		
		if($nis != "") {
			
			$no++;
			
			if($idpelajaran == "") {
				echo $no.'. '.$row_siswa->nis.'  '.$row_siswa->nama.'<br>';
				
				##update jumlah nilai
				$iddasarpenilaian = 4;
				$sqlstr = "select sum(b.nilai) jumlah, a.replid, a.idpelajaran, c.nama from daftarnilai a left join daftarnilai_detail b on a.replid=b.replid left join pelajaran c on a.idpelajaran=c.replid where a.departemen='$departemen' and a.idtingkat='$idtingkat' and a.idkelas='$idkelas' and a.idtahunajaran='$idtahunajaran' and a.idsemester='$idsemester' and a.nis='$nis' and a.idkompetensi='$idkompetensi' and a.idjeniskompetensi='$idjeniskompetensi' and a.iddasarpenilaian='$iddasarpenilaian' group by b.replid, a.idpelajaran";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				while($datanilai1 = $sql->fetch(PDO::FETCH_OBJ)) {
					$nilai_sum 	= $datanilai1->jumlah;
					$idpelajaran = $datanilai1->idpelajaran;*/
					//============================
					/*$sqlstr = "select a.replid from daftarnilai a left join daftarnilai_detail b on a.replid=b.replid where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' and b.nilai is not null";
					$sql2=$dbpdo->prepare($sqlstr);
					$sql2->execute();
					$count_data_nilai = $sql2->rowCount();*/
					
					//keterampilan
					/*$nilai_k = 0;
					$sqlnilai 	= $selectview->list_daftarnilai2($nis, $idtingkat, $idkelas, "", $idsemester, $idpelajaran, 4);
					$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
					$nilai_k		= $data_nilai_k->uas;
					
					$jumlah_nilai	= $jumlah_nilai + $data_nilai_k->jumlah;
					
					$jumlah_nilai_detail_k = 0;
					$total_k = 0;
					$nilai_tertinggi= 0;
					$jumlah_ukbm_upd = 0;
					$nilai_detail_k = 0;
					$nilai_raport_k = 0;
					$nilai_raport_k_decimal = 0;
					$nilai_detail_non_uas_k = 0;
					$sqlndetail = $selectview->list_daftarnilai_detail($data_nilai_k->replid);
					//$jumlah_ukbm_upd = $sqlndetail->rowCount();
					while($datanilai_detail=$sqlndetail->fetch(PDO::FETCH_OBJ)) {
						if($datanilai_detail->nilai != "") {
							$jumlah_ukbm_upd++;
						}
						$jumlah_nilai_detail_k = $nilai_detail_k + $datanilai_detail->nilai;
						$nilai_detail_k = $nilai_detail_k + $datanilai_detail->nilai;
						$nilai_detail_non_uas_k = $nilai_detail_non_uas_k + $datanilai_detail->nilai;					
					}
					
					if($jumlah_ukbm_upd > 0) {
						$nilai_raport_k_decimal = number_format($jumlah_nilai_detail_k/$jumlah_ukbm_upd,1,'.',',');
					}
					
					if($jumlah_ukbm_upd > 0) {
						$nilai_detail_k = ( ($nilai_detail_k/$jumlah_ukbm_upd)*75)/100;	
						$nilai_detail_non_uas_k = $nilai_detail_non_uas_k/$jumlah_ukbm_upd;
					} else {
						$nilai_detail_k = 0;
						$nilai_detail_non_uas_k = 0;
					}
					
					if($nilai_k != "") {
						$nilai_k		= ($nilai_k*25)/100;
						$nilai_raport_k	= number_format($nilai_detail_k + $nilai_k,0,'.',',');
						$total_k		= $total_k + numberreplace($nilai_raport_k);
					} else {
						$nilai_k		= 0;
						$nilai_raport_k	= number_format($nilai_detail_non_uas_k,0,'.',',');				
						$total_k		= $total_k + $nilai_raport_k;					
					}
					
					//$rata2 	= 	(($nilai_detail_p + $nilai_p) + ($nilai_detail_k + $nilai_k))/2;
					$rata2 	= 	(($nilai_raport) + ($nilai_raport_k))/2;
					$rata2_beban = number_format($rata2 * $row_pelajaran_detail->sks,0,'.',',');
					$rata2	=	number_format($rata2,0,'.',',');
					$total_rata = $total_rata + numberreplace($rata2);
					$total_rata_beban = $total_rata_beban + numberreplace($rata2_beban);
					
					$sqlstr = "update daftarnilai set jumlah='$jumlah_nilai_detail_k', rata='$nilai_raport_k_decimal', na='$nilai_raport_k' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
					$sqlx=$dbpdo->prepare($sqlstr);
					$sqlx->execute();
					
					echo '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.$datanilai1->nama.'</b> : Jumlah='.$jumlah_nilai_detail_k.', Rata-Rata Nilai Harian='.$nilai_raport_k_decimal.', Nilai Raport='.$nilai_raport_k."<br>";
				}
				echo '<hr>';
				$idpelajaran = "";
			} else {
				
				echo $no.'. '.$row_siswa->nis.'  '.$row_siswa->nama.'<br>';
				//keterampilan
				$nilai_k = 0;
				$sqlnilai 	= $selectview->list_daftarnilai2($nis, $idtingkat, $idkelas, "", $idsemester, $idpelajaran, 4);
				$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
				$nilai_k		= $data_nilai_k->uas;
				
				$jumlah_nilai	= $jumlah_nilai + $data_nilai_k->jumlah;
				
				$jumlah_nilai_detail_k = 0;
				$total_k = 0;
				$nilai_tertinggi= 0;
				$jumlah_ukbm_upd = 0;
				$nilai_detail_k = 0;
				$nilai_raport_k = 0;
				$nilai_raport_k_decimal = 0;
				$nilai_detail_non_uas_k = 0;
				$sqlndetail = $selectview->list_daftarnilai_detail($data_nilai_k->replid);
				//$jumlah_ukbm_upd = $sqlndetail->rowCount();
				while($datanilai_detail=$sqlndetail->fetch(PDO::FETCH_OBJ)) {
					if($datanilai_detail->nilai != "") {
						$jumlah_ukbm_upd++;
					}
					$jumlah_nilai_detail_k = $nilai_detail_k + $datanilai_detail->nilai;
					$nilai_detail_k = $nilai_detail_k + $datanilai_detail->nilai;
					$nilai_detail_non_uas_k = $nilai_detail_non_uas_k + $datanilai_detail->nilai;					
				}
				
				if($jumlah_ukbm_upd > 0) {
					$nilai_detail_k = ( ($nilai_detail_k/$jumlah_ukbm_upd)*75)/100;	
					$nilai_detail_non_uas_k = $nilai_detail_non_uas_k/$jumlah_ukbm_upd;
					
					$nilai_raport_k_decimal = number_format($jumlah_nilai_detail_k/$jumlah_ukbm_upd,1,'.',',');
				} else {
					$nilai_detail_k = 0;
					$nilai_detail_non_uas_k = 0;
				}
				
				if($nilai_k != "") {
					$nilai_k		= ($nilai_k*25)/100;
					$nilai_raport_k	= number_format($nilai_detail_k + $nilai_k,0,'.',',');
					$total_k		= $total_k + numberreplace($nilai_raport_k);
				} else {
					$nilai_k		= 0;
					$nilai_raport_k	= number_format($nilai_detail_non_uas_k,0,'.',',');				
					$total_k		= $total_k + $nilai_raport_k;					
				}
				
				//$rata2 	= 	(($nilai_detail_p + $nilai_p) + ($nilai_detail_k + $nilai_k))/2;
				$rata2 	= 	(($nilai_raport) + ($nilai_raport_k))/2;
				$rata2_beban = number_format($rata2 * $row_pelajaran_detail->sks,0,'.',',');
				$rata2	=	number_format($rata2,0,'.',',');
				$total_rata = $total_rata + numberreplace($rata2);
				$total_rata_beban = $total_rata_beban + numberreplace($rata2_beban);
				
				$sqlmp = "select nama from pelajaran where replid='$idpelajaran'";
				$sqlmapel=$dbpdo->prepare($sqlmp);
				$sqlmapel->execute();
				$datanilai1=$sqlmapel->fetch(PDO::FETCH_OBJ);
				
				$sqlstr = "update daftarnilai set jumlah='$jumlah_nilai_detail_k', rata='$nilai_raport_k_decimal', na='$nilai_raport_k' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
				$sqlx=$dbpdo->prepare($sqlstr);
				$sqlx->execute();
				
				echo '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.$datanilai1->nama.'</b> : Jumlah='.$jumlah_nilai_detail_k.', Rata-Rata Nilai Harian='.$nilai_raport_k_decimal.', Nilai Raport='.$nilai_raport_k."<br>";
			}

		}
	}
}*/
	
?>
