<?php

class protection{
	
	function soal_ukbm_siswa_approved($idsiswa='', $idukbm=''){		
		$dbpdo = DB::create();
		
		$sqlstr = "select replid from ukbm_siswa where idsiswa='$idsiswa' and idukbm='$idukbm' and ujian=1 and setuju=1 order by replid desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$rows = $sql->rowCount();
		
		if($rows == 0) {
			$aktif = 0;
		} else {
			$aktif = 1;
		}
		
		return $aktif;
		
	}
	
	function setup_periode($jenis='', $tanggal='', $aktif=0) {
		$dbpdo = DB::create();
		
		$tanggal = date("Y-m-d", strtotime($tanggal));
		
		$where  = " where jenis='$jenis' and tanggal<='$tanggal' and tanggal1>='$tanggal' and aktif=1 ";
				
		$sqlstr = "select tanggal, tanggal1 from setup_periode ".$where." order by replid desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$rows = $sql->rowCount();
		
		if($rows == 0) {
			$aktif = 0;
		} else {
			$aktif = 1;
		}
		
		return $aktif;
		
	}
	
	
	function setup_periode_tingkat($jenis='', $tanggal='', $aktif=0, $tingkat_id='') {
		$dbpdo = DB::create();
		
		$tanggal = date("Y-m-d", strtotime($tanggal));
		
		$where  = " where jenis='$jenis' and tanggal<='$tanggal' and tanggal1>='$tanggal' and aktif=1 and tingkat_id='$tingkat_id'";
		
		$sqlstr = "select tanggal, tanggal1 from setup_periode ".$where." order by replid desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$rows = $sql->rowCount();
		
		if($rows == 0) {
			$aktif = 0;
		} else {
			$aktif = 1;
		}
		
		return $aktif;
		
	}
	
	
	function setup_siswa_khusus($nis='', $jenis='', $tanggal='', $aktif=0) {
		$dbpdo = DB::create();
		
		$tanggal = date("Y-m-d", strtotime($tanggal));
		
		$sqlstr = "select a.tanggal, a.tanggal1 from setup_siswa_khusus a left join siswa b on a.idsiswa=b.replid where b.nis='$nis' and a.jenis='$jenis' and a.tanggal<='$tanggal' and a.tanggal1>='$tanggal' order by a.replid desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$rows = $sql->rowCount();
		
		if($rows == 0) {
			$aktif = 0;
		} else {
			$aktif = 1;
		}
		
		return $aktif;
		
	}

	
	function print_raport_siswa($idtingkat='', $idkelas='', $idsemester='', $idsiswa='', $iddasarpenilaian='') {
		$selectview = new selectview;
		
		$dbpdo = DB::create();
		
		$departemen		= "SMA";
		$idtahunajaran	= 0; //$_SESSION["idtahunajaran"]; //$_REQUEST["idtahunajaran"];
		$idpelajaran	= "";
		$idsemester		= 20; //semeter genap
		$idkompetensi	= 0;
		$idjeniskompetensi 	= 1;
		//$iddasarpenilaian	= 4; //keterampilan
		
		$ip_semester	= 75;
		$persen 		= 0;
		$persen1		= 0;
		$na				= 0;

		$sqlsiswa = "select a.replid, a.idkelas, b.idtingkat, a.nis, a.nama, a.idminat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where b.idtingkat='$idtingkat' and a.idkelas='$idkelas' and a.replid='$idsiswa'";
		$resultssiswa=$dbpdo->query($sqlsiswa);	
		
		$no = 0;
		while ($row_siswa = $resultssiswa->fetch(PDO::FETCH_OBJ)){
			
			$nis		= $row_siswa->replid;
			$idkelas 	= $row_siswa->idkelas;
			if($row_siswa->idminat == 1) {
				$peminatan = "MIPA";
			}
			if($row_siswa->idminat == 2) {
				$peminatan = "IPS";
			}
			
			if($nis != "") {
				
				$no++;
				
				##get jumlah nilai
				$iddasarpenilaian = 4;
				$sqlstr = "select sum(b.nilai) jumlah, a.replid, a.idpelajaran, c.nama from daftarnilai a left join daftarnilai_detail b on a.replid=b.replid left join pelajaran c on a.idpelajaran=c.replid left join kartu_rencana_studi d on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id where a.departemen='$departemen' and a.idtingkat='$idtingkat' and a.idkelas='$idkelas' and a.idtahunajaran='$idtahunajaran' and a.idsemester='$idsemester' and a.nis='$nis' and a.idkompetensi='$idkompetensi' and a.idjeniskompetensi='$idjeniskompetensi' and a.iddasarpenilaian='$iddasarpenilaian' and d.peminatan='$peminatan' and (c.minat='$peminatan' or ifnull(c.minat,'')='' ) group by b.replid, a.idpelajaran";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				while($datanilai1 = $sql->fetch(PDO::FETCH_OBJ)) {
					$nilai_sum 	= $datanilai1->jumlah;
					$idpelajaran = $datanilai1->idpelajaran;
					//============================
					
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
					
					//echo $datanilai1->nama.'>>'.$nilai_raport_k.'<br>';
					//$ip_semester = $nilai_raport_k;
					if( $nilai_raport_k != 0 && $nilai_raport_k < 75 ) {
						$ip_semester = $nilai_raport_k;
						goto mNext;
						//echo $datanilai1->nama.' : '.$ip_semester.'<br>';
					}
					
				}
				
				

			}
		}
	

		mNext:
		
		return $ip_semester;
	}
	
	
	function input_pas_mapel($idguru='', $idpelajaran='') {
		$dbpdo = DB::create();
		
		$sqlstr = "select replid from guru where nip='$idguru' and idpelajaran='$idpelajaran' and info1='1' order by replid limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$rows = $sql->rowCount();
		
		$input_pas = 0;
		if($rows == 0) {
			$input_pas = 0;
		} else {
			$input_pas = 1;
		}
		
		return $input_pas;
		
	}


	function protection_purchase_invoice($ref=''){
		
		$dbpdo = DB::create();
		
		$sqlstr		=	"select ref from good_receipt_detail where po_ref='$ref' limit 1";
		$sql		=	$dbpdo->prepare($sqlstr);
		$sql->execute();
		$rows 		= 	$sql->rowCount();
			
		return $rows;
		
	}
	

}
?>