<?php
session_start();
if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include('../app/include/sambung.php');
//include_once ("include/queryfunctions.php");
//include_once ("include/functions.php");

//require_once('include/errorhandler.php');
//require_once('include/sessionchecker.php');
//require_once('include/common.php');
//require_once('include/rupiah.php');
//require_once('include/config.php');
require_once('../app/finance/include/rupiah.php');
//require_once('include/sessioninfo.php');
//require_once('include/db_functions.php');
//require_once('include/getheader.php');

$dbpdo = DB::create();

$id 	= ""; //$_REQUEST["id"];
$ref 	= $_REQUEST["ref"];
$status = ""; //$_REQUEST["status"];

if(empty($ref)) {
	echo "Ma'af transaksi tidak ada";
	exit;
}

//OpenDb();
if ($status == "calon") 
{	
	$sqlstr = "SELECT p.replid AS id, p.idbesarjttcalon, b.besar, c.nopendaftaran, c.nama, j.nokas, 
				   j.transaksi, date_format(p.tanggal, '%d-%b-%Y') as tanggal, p.keterangan, p.jumlah, 
				   p.petugas, j.idtahunbuku 
			  FROM penerimaanjttcalon p, besarjttcalon b, jurnal j, calonsiswa c 
			 WHERE p.idbesarjttcalon = b.replid AND j.replid = p.idjurnal AND b.idcalon = c.replid AND p.replid = '$id'
		  ORDER BY p.tanggal, p.replid";
} 
else 
{
	$sqlstr = "SELECT p.replid AS id, p.idbesarjtt, b.besar, b.nis, s.nama, '' nokas, 
				   '' transaksi, date_format(p.tanggal, '%d-%b-%Y') as tanggal, p.keterangan, p.jumlah, 
				   p.petugas, b.info2 idtahunbuku, k.kelas, t.tingkat, p.idjenis_bayar 
			  FROM penerimaanjtt p, besarjtt b, siswa s, kelas k, tingkat t 
			 WHERE p.idbesarjtt = b.replid AND b.nis = s.nis and s.idkelas=k.replid and k.idtingkat=t.replid AND p.ref='$ref'
		  ORDER BY p.tanggal, p.replid";
	
	/*$sqlstr = "SELECT p.replid AS id, p.idbesarjtt, b.besar, b.nis, s.nama, j.nokas, 
				   j.transaksi, date_format(p.tanggal, '%d-%b-%Y') as tanggal, p.keterangan, p.jumlah, 
				   p.petugas, j.idtahunbuku, k.kelas, t.tingkat, p.idjenis_bayar 
			  FROM penerimaanjtt p, besarjtt b, jurnal j, siswa s, kelas k, tingkat t 
			 WHERE p.idbesarjtt = b.replid AND j.replid = p.idjurnal AND b.nis = s.nis and s.idkelas=k.replid and k.idtingkat=t.replid AND p.ref='$ref'
		  ORDER BY p.tanggal, p.replid";*/
		  
	// p.replid = '$id' 
} 

$sql = $dbpdo->query($sqlstr);
$row = $sql->fetch(PDO::FETCH_OBJ);
//$result = QueryDb($sql);
//$row = mysql_fetch_row($result);

$nokas = $row->nokas; //[5];
$transaksi = $row->transaksi; //[6];
$tanggal = $row->tanggal; //[7];
$jumlah = $row->jumlah; //[9];
$petugas = $row->petugas; //[10];
$nis = $row->nis; //[3];
$nama = $row->nama; //[4];
$total = $row->besar; //[2];
$idbesarjtt = $row->idbesarjtt; //[1];
$idtahunbuku = $row->idtahunbuku; //[11];
$keterangan = $row->keterangan; //[8];
$kelas = $row->kelas; //[12];
$tingkat = $row->tingkat; //[13];

/*get nama jenis bayar*/
$idjenis_bayar = $row->idjenis_bayar;
$sqlstr = "select nama from jenis_bayar where replid='$idjenis_bayar'";

$sql = $dbpdo->query($sqlstr);
$datajb = $sql->fetch(PDO::FETCH_OBJ);
$jenis_bayar = $datajb->nama;

$sqlstr = "SELECT date_format(now(), '%d-%m-%Y') as tanggal";
$sql = $dbpdo->query($sqlstr);
$row = $sql->fetch(PDO::FETCH_OBJ);

//$result = QueryDb($sql);
//$row = mysql_fetch_row($result);
$tglcetak = $row->tanggal; //[0];

$sqlstr = "SELECT sum(jumlah) jumlah FROM penerimaanjtt$status WHERE idbesarjtt$status = '$idbesarjtt'";
$sql = $dbpdo->query($sqlstr);
$row = $sql->fetch(PDO::FETCH_OBJ);

//$result = QueryDb($sql);
//$row = mysql_fetch_row($result);
$jumlahbayar = $row->jumlah; //[0];

$sqlstr = "SELECT departemen FROM tahunbuku WHERE replid='$idtahunbuku'";
$sql = $dbpdo->query($sqlstr);
$row = $sql->fetch(PDO::FETCH_OBJ);
//$result = QueryDb($sql);
//$row = @mysql_fetch_array($result);
$departemen=$row->departemen;

$sqlid = "SELECT * FROM identitas WHERE departemen='SMA'"; //$departemen
$sql = $dbpdo->query($sqlid);
$rowid = $sql->fetch(PDO::FETCH_OBJ);
//$resultid = QueryDb($sqlid); 
//$rowid = @mysql_fetch_object($resultid);
$namaid = $rowid->nama;
$alamat1id = $rowid->alamat1;
$te1p1id = "Telp. " . $rowid->telp1;

	
$sql_multi = "SELECT p.replid AS id, p.idbesarjtt, b.besar, b.nis, s.nama, '' nokas, 
	   '' transaksi, date_format(p.tanggal, '%d-%b-%Y') as tanggal, p.keterangan, p.jumlah, 
	   p.petugas, b.info2 idtahunbuku, dp.nama namadp 
  	FROM penerimaanjtt p, besarjtt b, siswa s, datapenerimaan dp 
 	WHERE p.idbesarjtt = b.replid AND b.nis = s.nis and b.idpenerimaan=dp.replid AND p.ref = '$ref' 
	ORDER BY p.tanggal, p.replid";

/*$sql_multi = "SELECT p.replid AS id, p.idbesarjtt, b.besar, b.nis, s.nama, j.nokas, 
	   j.transaksi, date_format(p.tanggal, '%d-%b-%Y') as tanggal, p.keterangan, p.jumlah, 
	   p.petugas, j.idtahunbuku, dp.nama namadp 
  	FROM penerimaanjtt p, besarjtt b, jurnal j, siswa s, datapenerimaan dp 
 	WHERE p.idbesarjtt = b.replid AND j.replid = p.idjurnal AND b.nis = s.nis and b.idpenerimaan=dp.replid AND p.ref = '$ref' 
	ORDER BY p.tanggal, p.replid";
	*/
$total = 0;

$data=array();

$i 		= 1;		
$size	= 300;
$sizeadd = 200; //100;
$results = $dbpdo->query($sql_multi);
//$rowid = $results->fetch(PDO::FETCH_OBJ);
$jmldata = $results->rowCount();

//$results	=	$koneksi->query($sql_multi);
//$jmldata1 = mysqli_num_rows($results);
$nokas = "";
while ($data2 = $results->fetch(PDO::FETCH_OBJ)) {	
	$nokas	=	$data2->namadp;	
	$jumlah	=	$data2->jumlah;
				
	$data[]=$i.';'.$nokas.';'.$jumlah;
	
	$total = $total + $data2->jumlah;
	
	$i++;	
	$size = $size + $sizeadd;
				
}


/*-------get data belum lunas----------*/
$sql_multi2 = "select b.nis, b.besar, SUM(p.jumlah) AS jumlah, (ifnull(b.besar,0) - SUM(ifnull(p.jumlah,0)) ) cicilan, c.nama, d.kelas, e.tingkat, f.nama namaterima, b.idpenerimaan, 0 id_pjtt, 0 nomor, g.virtualaccount  from datapenerimaan f left join besarjtt b on f.replid=b.idpenerimaan left join penerimaanjtt p on b.replid = p.idbesarjtt left join siswa c on b.nis=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid left join siswa_virtualaccount g on c.nis=g.nis where b.nis='$nis' AND b.info2 = '$idtahunbuku' and f.idkategori='JTT' GROUP BY b.nis, f.nama, b.idpenerimaan having (ifnull(b.besar,0) - sum(ifnull(b.potongan,0)) - SUM(ifnull(p.jumlah,0)) ) > 0 order by f.nourut ";
//echo $sql_multi2;
$res2 = $dbpdo->query($sql_multi2);
$jmldata1 = $res2->rowCount();

//$res2 = QueryDb($sql_multi2);
//$jmldata = mysqli_num_rows($res2);

$i = 1;
$total2 = 0;
while($row2 =$res2->fetch(PDO::FETCH_OBJ)) {
	
	$nama = $row2->nama; //[4];
	$tingkat = $row2->tingkat; //[6];
	$kelas = $row2->kelas; //[5];
	$namaterima = $row2->namaterima; //[7];
	$idpenerimaan2 = $row2->idpenerimaan; //[8];
	$id_pjtt = $row2->id_pjtt; //[9];
	$besar = $row2->besar; //[1];
	$jumlah = $row2->jumlah; //[2];
	$bcicilan = $row2->cicilan; //[3];
	$virtualaccount	=	$row2->virtualaccount;

	$data2[]=$i.';'.$namaterima.';'.$bcicilan;
	
	$i++;	
	$size = $size + $sizeadd;

	$total2 = $total2 + $bcicilan;	
}	
/*--------------------------------------/\---*/


//-----start PDF
require('../app/pdf/fpdf2.php');	  	
class PDF extends FPDF
{
	
	var $col=0;
	//Ordinate of column start
	var $y0;
	
	function Header()
	{
		//Page header
		global $namaid;
		global $alamat1id;
		global $te1p1id;
		global $title;
		global $nis;
		global $nama;
		global $kelas;
		global $ref;
		global $departemen;
		global $tanggal;
		global $jenis_bayar;
		global $virtualaccount;
		global $title2;
		
		$this->SetFont('Arial','',9);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		/*$this->Cell(50,3,$title,0,1,'R',false);
		$this->Cell(69,3,$alamat1id . ' ' . $te1p1id,0,1,'R',false);
		$this->Image('../img/logo.jpg', 8, 4, 8, 10, 'jpg', '');*/
		
		//$this->Ln(1);
		
		/*$this->Cell(0,3,$alamat1id . ' ' . $te1p1id,0,1,'C',true);
		$this->Ln(1);*/
		
		/*$this->Cell(20,3,$te1p1id,0,1,'L',true);
		$this->Ln(2);*/
		
		$this->SetLineWidth(0.2);
		$this->Line(85, 16, 10, 16);
		$this->Ln(1);
		
			
		$this->SetFont('Arial','',9);
		$w=$this->GetStringWidth($title2)+6;
		$this->SetX((90-$w)/2);
		//$this->SetDrawColor(0,80,180);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		//$this->SetLineWidth(1);
		
		
		$this->Cell($w,5,$title2,0,1,'C',true);		
		$this->Ln(2);
		
		//--set header
		/*$this->Cell(25,5,'Telah terima dari :',0,0,'L',false);*/
		/*$this->Cell(25,5,'No. :',0,0,'L',false);
		$this->Cell(25,5,$ref,0,0,'L',false);
		$this->Ln(5);*/
		
		$this->Cell(20,2,'No.',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$ref,0,1,'L',true);
		$this->Ln(2);
		
		/*$this->Cell(20,2,'Virtual Acc',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$virtualaccount,0,1,'L',true);
		$this->Ln(2);*/
		
		
		$this->Cell(20,2,'Tgl. Setoran',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$tanggal,0,1,'L',true);
		$this->Ln(2);
		
		$this->Cell(20,2,'Jenis Setoran',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$jenis_bayar,0,1,'L',true);
		$this->Ln(3);
		
		$this->Cell(20,2,'NIS',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$nis,0,1,'L',true);
		$this->Ln(2);
		
		$this->Cell(20,2,'Nama',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,substr($nama,0,28),0,1,'L',true);
		$this->Ln(2); 
		
		$this->Cell(20,2,'Unit',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2, $departemen,0,1,'L',true);
		$this->Ln(2);
		
		$this->Cell(20,2,'Kelas',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$kelas,0,1,'L',true);
		$this->Ln(3);
		
		//Save ordinate
		$this->y0=$this->GetY();
	}
	
	function Footer()
	{
		//Page footer
		$this->SetY(-15);
		$this->SetFont('Arial','I',9);
		$this->SetTextColor(128);
		//$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
		
	}

	var $B;
	var $I;
	var $U;
	var $HREF;
	
	
	function PDF($orientation='P',$unit='mm', $format='auto') 
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
		$cekdata = array();
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
	
	//Simple table
	//function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
	//$i=0;
	function BasicTable($header,$data)
	{
		//Header
		$i=0;				
		foreach($header as $col) {
			if ($i==0) { $this->Cell(8,7,$col,1,0,"C"); }
			if ($i==1) { $this->Cell(45,7,$col,1,0,"C"); }
			if ($i==2) { $this->Cell(22,7,$col,1,0,"C"); }
			$i++;
		}
		$this->Ln();
		
		//Data		
		foreach($data as $row)
		{	
			$i=0;
			foreach($row as $col) {
				
				if ($i==0) { $this->Cell(8,6,$col,1,0,"C"); }
				if ($i==1) { 
					if( substr($col,0,7) == "Program") {
						$col = "Prog. Khusus " . substr($col,15,20);
					}
					if( substr($col,0,8) == "Kegiatan") {
						$col = "Keg. Th. Ajaran " . substr($col,23,12);
					}
					$this->Cell(45,6,$col,1,0,"L"); 
				}
				if ($i==2) { 
					$jumlah = number_format($col,"0",".",",");
					$this->Cell(22,6,$jumlah,1,0,"R"); 
				}
				$i++;
			}
			$this->Ln();
			
		}	
		
		//-----set sub group
		global $total;
		global $terbilang;
		global $tanggalcetak;
		global $getuser;
		
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','',9);
		
		$this->Ln(2);
		$this->Cell(53,2,'Total',0,0,'R',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(20,2,$total,0,1,'R',true);
		$this->Ln(2);
		
		//$size = $size + $sizeadd;
		$this->SetFont('Arial','i',9);
		$this->Cell(5000,5,'Terbilang :',0,1,'L',true);
		//$this->Cell(5000,5,$terbilang,0,1,'L',true);
		$this->MultiCell(80, 5, $terbilang, 0, 'L', false);
		$this->Ln(5);
		
		//$size = $size + $sizeadd;
		$this->SetFont('Arial','',9);
		$this->Cell(39,2,'',0,0,'R',false);
		$this->Cell(96,2,$tanggalcetak,0,1,'L',true);		
		$this->Ln(2);
		
		//$size = $size + $sizeadd;
		
		$this->Cell(20,2,'Penyetor',0,0,'R',false);		
		$this->Cell(40,2,'Penerima',0,1,'R',false);		
		$this->Ln(8);
		
		//$size = $size + $sizeadd;
		$getuser = "(                               )";
		
		$this->Cell(25,2,'(____________)',0,0,'R',false);	
		$this->Cell(47,2,$getuser,0,1,'R',false);		
		$this->Ln(2);
		
				
	}
	
	
	/**
	* Biaya-biaya yang belum di bayar
	*/
	
    
	/*function BasicTable2($header2,$data2)
	{
		//Header
		global $jmldata1;
		
		//--biaya yang belum lunas
		$this->Cell(4,2,'',0,0,'R',false);
		$this->Cell(30,2,'Biaya-biaya yang belum lunas',0,1,'C',false);		
		$this->Ln(2);
		
		$i=0;				
		foreach($header2 as $col) {
			if ($i==0) { $this->Cell(10,7,$col,1,0,"C"); }
			if ($i==1) { $this->Cell(44,7,$col,1,0,"C"); }
			if ($i==2) { $this->Cell(25,7,$col,1,0,"C"); }
			$i++;
		}
		$this->Ln();
		
		//Data		
		foreach($data2 as $row)
		{	
			$i=0;
			foreach($row as $col) {
				
				if ($i==0) { $this->Cell(10,6,$col,1,0,"L"); }
				if ($i==1) { $this->Cell(44,6,$col,1,0,"L"); }
				if ($i==2) { 
					$jumlah = number_format($col,"0",".",",");
					$this->Cell(25,6,$jumlah,1,0,"R"); 
				}
				$i++;
			}
			$this->Ln();
			
		}	
		
		//-----set sub group
		global $total2;
		
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','',9);
		
		$this->Ln(2);
		$this->Cell(53,2,'Total',0,0,'R',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(20,2,$total2,0,1,'R',true);
		$this->Ln(2);
		
		//---------------------/\			
	} */
		
}
		
$pdf=new PDF();

$title2 = "BUKTI SETORAN";	
$title='SMAN 3 BANDUNG';
$pdf->SetTitle($title);	
$pdf->SetTitle($nis);	
$pdf->SetTitle($nama);

$terbilang = "(" . KalimatUang($total) . ")";
$pdf->SetTitle($terbilang);

$kelas = $tingkat . "/" . $kelas;
$pdf->SetTitle($kelas);
$total = number_format($total,"0",".",",");
$total2 = number_format($total2,"0",".",",");
$pdf->SetTitle($total);
$pdf->SetTitle($size);

$G_LOKASI = "Bandung";
$uid = $petugas; //$_SESSION["loginname"];
$tanggalcetak = $G_LOKASI . ", " . $tglcetak;
$getuser = "(". $uid . ")";

$header=array('No.','Pembayaran','Besarnya');
$header2=array('No.','Jenis Biaya','Besarnya');
//Data loading
//$data=$pdf->LoadData('poa.txt');

$data=$pdf->LoadData($data);
//$data2=$pdf->LoadData($data2);
$pdf->SetFont('Arial','',9);
$pdf->AddPage();

//if($jmldata > 0) {
	$pdf->BasicTable($header,$data);
//}


/*if($jmldata1 > 0) {
	$pdf->BasicTable2($header2,$data2);
}*/

/*$pdf->AddPage();
$pdf->ImprovedTable($header,$data);
$pdf->AddPage();
$pdf->FancyTable($header,$data);*/
$pdf->Output();
?>
