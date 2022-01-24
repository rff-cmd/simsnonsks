<?php

echo '
   <Row>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Kelompok C (Pilihan Lintas Peminatan)</Data></Cell>
   </Row>';
   
   ##START GET NILAI
	$no = 0;
	
	//$sql=$selectview->list_siswa_krs($datasiswa->nis, 1);
	$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 4);
	while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
		
		$jumlah_sks = $jumlah_sks + $row_pelajaran_detail->sks;
		
		//pengetahuan
		$nilai_p = 0;
		$sqlnilai 	= $select->list_daftarnilai($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3);
		$data_nilai_p	= $sqlnilai->fetch(PDO::FETCH_OBJ);
		$nilai_p		= $data_nilai_p->uas;
		
		$jumlah_ukbm_upd = 0;
		$nilai_detail_p = 0;
		$nilai_detail_non_uas_p=0;
		$sqlndetail = $select->list_daftarnilai_detail($data_nilai_p->replid);
		//$jumlah_ukbm_upd = $sqlndetail->rowCount();
		while($datanilai_detail=$sqlndetail->fetch(PDO::FETCH_OBJ)) {
			if($datanilai_detail->nilai != "") {
				$jumlah_ukbm_upd++;
			}
			$nilai_detail_p = $nilai_detail_p + $datanilai_detail->nilai;
			$nilai_detail_non_uas_p = $nilai_detail_non_uas_p + $datanilai_detail->nilai;
		}
		
		if($jumlah_ukbm_upd > 0) {
			$nilai_detail_p = ( ($nilai_detail_p/$jumlah_ukbm_upd)*75)/100;	
			$nilai_detail_non_uas_p = $nilai_detail_non_uas_p/$jumlah_ukbm_upd;
		} else {
			$nilai_detail_p = 0;
			$nilai_detail_non_uas_p = 0;
		}
		
		if($nilai_p != "") {
			$nilai_p		= ($nilai_p*25)/100;
			$nilai_raport	= number_format($nilai_detail_p + $nilai_p,0,'.',',');
			$total_p		= $total_p + numberreplace($nilai_raport);
		} else {
			$nilai_p		= 0;
			$nilai_raport	= number_format($nilai_detail_non_uas_p,0,'.',',');				
			$total_p		= $total_p + $nilai_raport;
		}
		
		
		//-------/\--------
		
		//keterampilan
		$nilai_k = 0;
		$sqlnilai 	= $select->list_daftarnilai($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4);
		$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
		$nilai_k		= $data_nilai_k->uas;
		
		$jumlah_ukbm_upd = 0;
		$nilai_detail_k = 0;
		$nilai_detail_non_uas_k = 0;
		$sqlndetail = $select->list_daftarnilai_detail($data_nilai_k->replid);
		//$jumlah_ukbm_upd = $sqlndetail->rowCount();
		while($datanilai_detail=$sqlndetail->fetch(PDO::FETCH_OBJ)) {
			if($datanilai_detail->nilai != "") {
				$jumlah_ukbm_upd++;
			}
			$nilai_detail_k = $nilai_detail_k + $datanilai_detail->nilai;
			$nilai_detail_non_uas_k = $nilai_detail_non_uas_k + $datanilai_detail->nilai;
			
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
		
		$rata2 	= 	(($nilai_detail_p + $nilai_p) + ($nilai_detail_k + $nilai_k))/2;
		$rata2_beban = number_format($rata2 * $row_pelajaran_detail->sks,0,'.',',');
		$rata2	=	number_format($rata2,0,'.',',');
		$total_rata = $total_rata + numberreplace($rata2);
		$total_rata_beban = $total_rata_beban + numberreplace($rata2_beban);
		
		//get Predikat
		$sqlpredikat = $selectview->list_predikat_raport_1($_SESSION["idangkatan"]);
		$data_predikat = $sqlpredikat->fetch(PDO::FETCH_OBJ);
		$kkm			=	$data_predikat->kkm;
		$nilai_angka_a	=	$data_predikat->nilai_angka_a;
		$nilai_angka_a1	=	$data_predikat->nilai_angka_a1;
		$nilai_angka_b	=	$data_predikat->nilai_angka_b;
		$nilai_angka_b1	=	$data_predikat->nilai_angka_b1;
		$nilai_angka_c	=	$data_predikat->nilai_angka_c;
		$nilai_angka_c1	=	$data_predikat->nilai_angka_c1;
		$nilai_angka_d	=	$data_predikat->nilai_angka_d;
		$nilai_angka_d1	=	$data_predikat->nilai_angka_d1;
		
		//predikat pengetahuan
		$predikat_p = "";
		if($nilai_raport < $nilai_angka_d) {
			$predikat_p = "D";
		}
		if($nilai_raport >= $nilai_angka_c && $nilai_raport <= $nilai_angka_c1) {
			$predikat_p = "C";
		}
		if($nilai_raport >= $nilai_angka_b && $nilai_raport <= $nilai_angka_b1 ) {
			$predikat_p = "B";
		}
		if($nilai_raport >= $nilai_angka_a && $nilai_raport <= $nilai_angka_a1 ) {
			$predikat_p = "A";
		}
		
		//predikat keterampilan
		$predikat_k = "";
		if($nilai_raport_k < $nilai_angka_d) {
			$predikat_k = "D";
		}
		if($nilai_raport_k >= $nilai_angka_c && $nilai_raport_k <= $nilai_angka_c1) {
			$predikat_k = "C";
		}
		if($nilai_raport_k >= $nilai_angka_b && $nilai_raport_k <= $nilai_angka_b1 ) {
			$predikat_k = "B";
		}
		if($nilai_raport_k >= $nilai_angka_a && $nilai_raport_k <= $nilai_angka_a1 ) {
			$predikat_k = "A";
		}
	
	echo "<Row>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pelajaran_detail->kode_pelajaran."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pelajaran_detail->nama_pelajaran."</Data></Cell>";		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pelajaran_detail->kkm."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pelajaran_detail->kkm_terampil."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pelajaran_detail->sks."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$nilai_raport."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$predikat_p."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$nilai_raport_k."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$predikat_k."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$rata2."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$rata2_beban."</Data></Cell>";
	echo "</Row>";
	
		$no++;
	}
	
?>