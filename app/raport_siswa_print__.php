<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

//include_once ("include/queryfunctions.php");
include_once ("include/sambung.php");
include_once ("include/functions.php");
//include_once ("include/inword.php");

include 'class/class.select.php';
include 'class/class.selectview.php';

$select = new select;
$selectview = new selectview;

#-------------FILTER
$idsiswa	= $_REQUEST["idsiswa"];
$idsemester	= $_SESSION["semester_id"];

$sqlidentitas = $select->list_identitas();
$dataidentitas = $sqlidentitas->fetch(PDO::FETCH_OBJ);

$sqlsiswa = $select->list_siswa("", $idsiswa);
$datasiswa = $sqlsiswa->fetch(PDO::FETCH_OBJ);

$minat = "";
if($datasiswa->idminat == 1) {
	$minat = "Matematika dan Ilmu Pengetahuan Alam";
}
if($datasiswa->idminat == 2) {
	$minat = "Ilmu-ilmu Sosial";
}

$sqlsemester = $select->list_semester($idsemester);
$datasemester = $sqlsemester->fetch(PDO::FETCH_OBJ);

$sqldesc_predikat_spirit = $select->list_deskripsi_raport("", "", "Spritual", "");
$datadesc_predikat_spirit = $sqldesc_predikat_spirit->fetch(PDO::FETCH_OBJ);

$sqldesc_predikat_sosial = $select->list_deskripsi_raport("", "", "Sosial", "");
$datadesc_predikat_sosial = $sqldesc_predikat_sosial->fetch(PDO::FETCH_OBJ);
/*------------------------------------------*/

/*---------print header-----------*/
$nama_sekolah	=	$dataidentitas->nama;
$nama_semester	=	$datasemester->semester;
$alamat_sekolah	=	$dataidentitas->alamat1;
$nama_siswa		=	$datasiswa->nama;
$nis_siswa		=	$datasiswa->nis;
$sikap_spirit_a	=	$datadesc_predikat_spirit->sikap_a;
$sikap_sosial_a	=	$datadesc_predikat_sosial->sikap_a;
/*-------------------------------*/

/*---------print detail----------*/
$data			=	array();
$data2			=	array();
$data_kelompok	=	array();

$no = 0;

##START GET NILAI
//$sql=$selectview->list_siswa_krs($datasiswa->nis, 1);
$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 1);
while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
	
	$data_kelompok[]="Kelompok A (Umum)|Kelompok B (Umum)";
	
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
	
	
	$kode_pelajaran		=	$row_pelajaran_detail->kode_pelajaran;
	$nama_pelajaran		=	$row_pelajaran_detail->nama_pelajaran;
	$kkm				=	$row_pelajaran_detail->kkm;
	$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
	$sks				=	$row_pelajaran_detail->sks;
	
	$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2.';'.$rata2_beban;
	
	$data2[]=$kode_pelajaran.'|'.$nama_pelajaran.'|'.$kkm.'|'.$kkm_terampil.'|'.$sks.'|'.$nilai_raport.'|'.$predikat_p.'|'.$nilai_raport_k.'|'.$predikat_k.'|'.$rata2.'|'.$rata2_beban;
	
		
}
print_r($data);
/*-------------------------------------------*/
				

require('pdf/fpdf2.php');
	  	
class PDF extends FPDF
{
	
	var $col=0;
	//Ordinate of column start
	var $y0;
	
	function Header()
	{
		//Page header
		global $nama_sekolah;
		global $nama_semester;
		global $alamat_sekolah;
		global $nama_siswa;
		global $nis_siswa;
		global $sikap_spirit_a;
		global $sikap_sosial_a;
						
		$this->SetFont('Arial','',11);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		$this->Ln(5);
		//$this->Cell(200,3,'',0,0,'C',false);
		//$this->Cell(90,3,$company_name,0,1,'C',false);
		//$this->Image('../assets/img/logo.jpg', 88, 10, 45, 13, 'jpg', '');
		//$this->Ln(1);
		
		/*$this->Cell(46,3,'',0,0,'L',false);
		$this->Cell(20,3,$bussines_type,0,1,'L',false);
		$this->Ln(1);*/
		
		/*$this->Cell(46,3,'',0,0,'C',false);
		//$this->Cell(50,3,'Alamat Kantor :' . $address . ' Telp: ' . $phone,0,1,'L',false);
		$this->Cell(115,3,$address,0,1,'C',false);
		$this->Ln(2);
		
		$this->Cell(26,3,'',0,0,'L',false);
		$this->Cell(20,3,'',0,1,'L',false); //$email
		$this->Ln(2);
		
		$this->SetFont('Arial','',14);
		$this->Cell(200,5,'xxxxxxx',0,1,'C',true);
		//$this->Cell(50,5,'No : ' . $ref,0,1,'R',false);
		$this->Ln(2);*/
		
		$this->SetFont('Arial','',11);
		$this->Cell(44,3,'Nama Sekolah',0,0,'L',true);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(120,3,$nama_siswa,0,1,'L',false);
		$this->Ln(2);
		
		$this->SetFont('Arial','',11);
		$this->Cell(44,3,'Alamat',0,0,'L',true);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(120,3,$alamat_sekolah,0,1,'L',false);
		$this->Ln(2);
		
		$this->SetFont('Arial','',11);
		$this->Cell(44,3,'Nama Peserta Didik',0,0,'L',true);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(120,3,$nama_siswa,0,1,'L',false);
		$this->Ln(2);
		
		$this->SetFont('Arial','',11);
		$this->Cell(44,3,'Nomor Induk / NISN',0,0,'L',true);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(120,3,$nis_siswa,0,1,'L',false);
		$this->Ln(2);
		
		/*$this->Cell(34,2,'Alamat',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$address_client,0,1,'L',true);
		$this->Ln(2);
		
		$this->Cell(34,2,'No. Telepon',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$phone_vdr,0,1,'L',true);
		$this->Ln(2);*/
		
		//Save ordinate
		$this->y0=$this->GetY();
	}
	
	

	var $B;
	var $I;
	var $U;
	var $HREF;
	
	
	function PDF($orientation='P',$unit='mm', $format='a4') 
	{
		//Call parent constructor
		//$size = 300;
		global $size;
		global $sizeadd;
		
		$this->FPDF2($orientation,$unit,$format,$size); //$size = tinggi
		//Initialization
		$this->B=0;
		$this->I=0;
		$this->U=0;
		$this->HREF='';
		
	}

	//Load data
		
	function LoadData($file)
	{		
		//Read file lines
		//$lines=file($file);
		$lines=($file);
		$cekdata = $file[1];
		if( !empty($cekdata) )  {
			foreach($lines as $line) {
				$data[]=explode(';',$line);
			}
		} else {			
			$data[]=explode(';',$file[0]);
			
		}
			
		//foreach($lines as $data)
			//$data[]=explode(';',chop($line));
		return $data;
	} 
	
	function BasicTable($header,$data)
	{
		//Header
		$i=0;				
		foreach($header as $col) {
			if ($i==0) { $this->Cell(13,7,$col,1,0,"C"); }
			if ($i==1) { $this->Cell(75,7,$col,1,0,"C"); }
			if ($i==2) { $this->Cell(15,7,$col,1,0,"C"); }
			if ($i==3) { $this->Cell(25,7,$col,1,0,"C"); }
			if ($i==4) { $this->Cell(30,7,$col,1,0,"C"); }
			if ($i==5) { $this->Cell(30,7,$col,1,0,"C"); }
			$i++;
		}
		$this->Ln();
		
		
		//Data	
		global $data_kelompok;
		global $data_deposit;
		global $data2;
		global $total_dp;
		global $g_total;
		global $inv_amount;
		global $deposit_d;
		global $total_qty_po;
		global $sub_total_invoice;
		global $total_qty;
		global $sx_total;
		
		$total_qty = 0;
		for($z=0; $z<count($data_kelompok); $z++) {
			
			$this->Cell(80,7,$data_kelompok[$z],0,1,"L");
			
			$s_total = 0;
			$k = 0;
			for($s=0; $s<count($data2); $s++) {
				$exdata = explode('|', $data2[$s]);
				if($exdata[0] == $data_so[$z]) {
					$k++;
					
					$this->Cell(13,7,$k,1,0,"C"); //kode
					$this->Cell(75,7,$exdata[1],1,0,"L"); //nama
					$this->Cell(15,7,$exdata[2],1,0,"C"); //P
					$this->Cell(15,7,$exdata[3],1,0,"C"); //K
					$this->Cell(15,7,$exdata[4],1,0,"C"); //sks
					$this->Cell(15,7,$exdata[5],1,1,"C"); //angka(P)
					$this->Cell(15,7,$exdata[6],1,1,"C"); //predikat(P)
					$this->Cell(15,7,$exdata[7],1,1,"C"); //angka(K)
					$this->Cell(15,7,$exdata[8],1,1,"C"); //predikat(K)
					$this->Cell(15,7,$exdata[9],1,1,"C"); //rata2
					$this->Cell(15,7,$exdata[10],1,1,"C"); //rata2 * beban
				}
			}
			
			
			/*$this->Cell(155,5,'Sub Total :',0,0,'R');
			$this->Cell(14,5,'',0,0,'C');
			$this->Cell(19,5,number_format($sx_total,0,'.',','),0,1,'R'); //$sub_total_invoice[$z] //$sx_total $totald
			
			$sub_deposit = number_format($deposit_d,0,".",",");
			$this->Cell(155,5,'Uang Muka :',0,0,'R');
			$this->Cell(14,5,'',0,0,'C');
			$this->Cell(19,5,$sub_deposit,0,1,'R');
			$this->Ln();*/
			
			/*foreach($data as $row)
			{	
				$i=0;
				
				foreach($row as $col) {
					if ($i==0) { $this->Cell(13,7,$col,1,0,"C"); }
					if ($i==1) { $this->Cell(90,7,$col,1,0,"L"); }
					if ($i==2) { $this->Cell(25,7,$col,1,0,"R"); }
					if ($i==3) { $this->Cell(30,7,$col,1,0,"R"); }
					if ($i==4) { $this->Cell(30,7,$col,1,0,"R"); }
					$i++;
				}
				$this->Ln();
				
			}*/	
		}
		
		//-----set sub group
		/*global $terbilang;
		global $sub_total;
		global $total;
		global $grand_total;
		global $deposit_d;
		global $bank_charge;
		global $credit_amount;
		global $total_qty;
		global $client_name;
		global $petugas;
		
		global $total_qty_po;
		global $total_po;
		global $total_jahit;
		global $total_print;
		global $total_sj;
		global $total_sisa;
		global $sub_total_sisa;
		global $deposit;
		global $dateangsur;
		global $deposit_date;
		global $grand_total_invoice;
		
		global $g_total;
		
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','',11);
		
		//$size = $size + $sizeadd;
		$total_po		=	number_format($total_qty_po,"0",",",".");
		$total_jahit	=	number_format($total_jahit,"0",",",".");
		$total_print	=	number_format($total_print,"0",",",".");
		$total_sj		=	number_format($total_sj,"0",",",".");
		
		//set sisa
		if(numberreplace($total_sisa) < 0) {
			$total_sisa = "+ ". ($total_sisa * -1);
		} else if (numberreplace($total_sisa) == 0) {
			$total_sisa = $total_sisa;
		} else {
			$total_sisa = "- ".$total_sisa;
		}
		$total_sisa		=	$total_sisa; //number_format($total_sisa,"0",",",".");
		
		$this->Ln(1);
		$this->SetFont('Arial','',11);
		
		$total_qty = number_format($total_qty,0,'.',',');;
		$grand_total = number_format($g_total,0,'.',',');
		$this->Cell(100,5,'Total PO :',0,0,'R',false);
		$this->Cell(10,5,'',0,0,'C',true);
		$this->Cell(10,5,$total_qty,0,0,'R',true); //$total_qty_po
		
		$uang_muka = 0;
		for($t=0; $t<count($deposit_date); $t++) {
			if($data_deposit[$t] > 0) {
				$uang_muka = $uang_muka + $data_deposit[$t];
			}
		}
		$grand_total_invoice = $g_total - $uang_muka; //$grand_total_invoice - $uang_muka;
		
		$grand_total = number_format($grand_total_invoice,0,'.',','); //$g_total
		$this->Cell(35,5,'Grand Total :',0,0,'R',false);
		$this->Cell(19,5,'',0,0,'C',true);
		$this->Cell(14,5,$grand_total,0,1,'R',true);*/
		
		$size = $size + $sizeadd;
		
		/*$deposit = number_format($deposit_d,0,'.',',');
		$this->Cell(140,5,'Uang Muka :',0,0,'R',false);
		$this->Cell(19,5,'',0,0,'C',true);
		$this->Cell(29,5,$deposit,0,1,'R',true);*/
		
		/*for($t=0; $t<count($deposit_date); $t++) {
			if($data_deposit[$t] > 0) {
				$uang_muka = $uang_muka + $data_deposit[$t];
				
				$this->Cell(140,5,'Uang Muka'. $x . ' (' . date("d-m-Y", strtotime($deposit_date[$t])) . ')' ,0,0,'R',false);
				$this->Cell(19,5,'',0,0,'C',true);
				$this->Cell(29,5, number_format($data_deposit[$t],0,'.',','),0,1,'R',true);
			}
		}
		
		for($s=0; $s<count($dateangsur); $s++) {
			$x++;
			$this->Cell(140,5,'Angsuran ke-'. $x . ' (' . $dateangsur[$s] . ')' ,0,0,'R',false);
			$this->Cell(19,5,'',0,0,'C',true);
			$this->Cell(29,5, number_format($credit_amount[$s],0,'.',','),0,1,'R',true);
		}
		
		
		$grand_total = $grand_total_invoice; //numberreplace($g_total)-$sub_total_sisa; //numberreplace($g_total)-numberreplace($deposit)-$sub_total_sisa;
		$grand_total = number_format($grand_total,0,'.',',');
		$this->Cell(140,5,'Sisa :',0,0,'R',false);
		$this->Cell(19,5,'',0,0,'C',true);
		$this->Cell(29,5,$grand_total,0,1,'R',true);
		
		$this->SetFont('Arial','',10);
		$this->Cell(20,5,'',0,0,'L',true);	
		
		$this->SetFont('Arial','',11);
		
		$size = $size + $sizeadd;*/
		
		
		//-----------
		/*$this->SetFont('Arial','',9);
		$this->Cell(200,2,'- Barang yang sudah dibeli tidak boleh ditukar / dikembalikan, biaya retur 30% dari harga produk',0,1,'L',false);		
		$this->Ln(2);
		
		$size = $size + $sizeadd;
		
		$this->SetFont('Arial','',9);
		$this->Cell(200,2,'- Pembayaran dianggap lunas apabila cek sudah cair / transfer telah kami terima.',0,1,'L',false);		
		$this->Ln(2); */
		
		$this->Ln(2);
		
		$size = $size + $sizeadd;
		
		//---------
		$this->SetFont('Arial','',10);
		$this->Cell(60,5,'Mengetahui',0,0,'C',true);
		$this->Cell(60,5,'',0,0,'C',true);
		$this->Cell(60,5,'Kepala Sekolah',0,1,'C',true);	
		$this->Ln(15);
		
		$size = $size + $sizeadd;
		
		$this->Cell(60,5,'( ' . '..................................' . ' )',0,0,'C',true);	
		$this->Cell(60,5,' ' . '' . ' ',0,0,'C',true);	
		$this->Cell(60,5,'( ' . '..................................' . ' )',0,1,'C',true);	
		$this->Ln(2);
		
				
	} 
	
	
		
}
//===========================				
$pdf=new PDF();

$title='RAPORT SISWA';
$pdf->SetTitle($title);	
$pdf->SetTitle($nis);	
$pdf->SetTitle($nama);


//$terbilang = "(" . KalimatUang($total) . ")";
//$pdf->SetTitle($terbilang);

//$total = number_format($total,"0",".",",");
//$total2 = number_format($total2,"0",".",",");
//$pdf->SetTitle($total);
$pdf->SetTitle($size);

/*$G_LOKASI = "Bandung";
$uid = $petugas; //$_SESSION["loginname"];
$tanggalcetak = $G_LOKASI . ", " . $tglcetak;
$getuser = "(". $uid . ")";
*/

$header=array('No.','dua','tiga','1','5','6','7','8','9','10','12');
//$header2=array('No.','Jenis Biaya','Besarnya');
//Data loading
//$data=$pdf->LoadData('poa.txt');

$data=$pdf->LoadData($data);
//$data2=$pdf->LoadData($data2);
$pdf->SetFont('Arial','',11);
$pdf->AddPage();


//if($jmldata > 0) {
	$pdf->BasicTable($header,$data);
//} 

/*
if($jmldata1 > 0) {
	$pdf->BasicTable2($header2,$data2);
} */

/*$pdf->AddPage();
$pdf->ImprovedTable($header,$data);
$pdf->AddPage();
$pdf->FancyTable($header,$data);*/

$pdf->Output();

?>