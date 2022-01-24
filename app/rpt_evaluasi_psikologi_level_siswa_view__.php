<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/sambung.php");
//include_once ("include/functions.php");

include 'class/class.select.php';

$select = new select;

//$dbpdo = DB::create();


$nis		=	$_REQUEST['nis'];

$sql = $select->list_evaluasi_psikologi_persiswa($nis, $departemen, $idtingkat, $idkelas,  $idsemester);
$row_asset_trans=$sql->fetch(PDO::FETCH_OBJ);

$nis			=	$row_asset_trans->nis;
$nama_siswa    	=	$row_asset_trans->nama_siswa;
$kelas	    	=	$row_asset_trans->kelas;
$tingkat		=	$row_asset_trans->tingkat;


$address = "Jl. Pasir Impun";
if(!empty($dataunit->address1)) {
	$address = $dataunit->address1;	
}

$email = "tunas@yahoo.com";
if(!empty($dataunit->email)) {
	$email = $dataunit->email;
}

$phone = "022-7216940";
if(!empty($dataunit->phone1)) {
	$phone = $dataunit->phone1;
}
/*-------------------------------*/

/*---------print detail----------*/
$data		=	array();
$i 			= 	1;		
$size		= 	200;
$sizeadd 	= 	20;

$data[]=$i.';'.''.';'.'';
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
        global $nis;
        global $nama_siswa;
        global $kelas;        
        global $tingkat;
				
		$this->SetFont('arial','',11);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		/*$this->Cell(26,0,'',0,0,'L',false);
		$this->Cell(50,5,'TOKO AZAD',0,1,'L',false);
		$this->Image('../img/logo.jpg', 10, 5, 25, 15, 'jpg', '');
		//$this->Ln(1);
		
		$this->Cell(26,5,'',0,0,'L',false);
		$this->Cell(20,5,'DISTRIBUTOR KAIN',0,1,'L',false);
		//$this->Ln(1);
		
		$this->Cell(26,5,'',0,0,'L',false);
		$this->Cell(50,5,'Alamat Kantor :' . $address . 'Telp./Fax.: ' . $phone,0,1,'L',false);
		//$this->Ln(2);
		
		$this->Cell(26,5,'',0,0,'L',false);
		$this->Cell(20,5,$email,0,1,'L',false);
		//$this->Ln(2);
		
		$this->SetFont('arial','U',11);
		$this->Cell(145,5,'FAKTUR/INVOICE',0,0,'L',true);
		$this->Cell(50,5,'No : ' . $ref,0,1,'R',false);
		//$this->Ln(2);
		
		$this->SetFont('arial','',11);
		$this->Cell(34,5,'Nama',0,0,'L',true);
		$this->Cell(2,5,':',0,0,'L',false);
		$this->Cell(120,5,$penyewa,0,0,'L',false);
		$this->Cell(20,5,'Tanggal : ' . $tanggal,0,1,'L',false);
		//$this->Ln(2);
		
		$this->Cell(34,5,'HP/Telp.',0,0,'L',true);
		$this->Cell(2,5,':',0,0,'L',false);
		$this->Cell(50,5,$hp,0,1,'L',true);
		$this->Ln(2);
		*/
		//Save ordinate
		//$this->y0=$this->GetY();
	}
	
	
	function Footer()
	{
		//Page footer
		$this->SetY(-15);
		$this->SetFont('Arial','I',11);
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
		
		$this->FPDF($orientation,$unit,$format,$size); //$size = tinggi
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
				
		//-----set sub group
		global $terbilang;
		global $sub_total;
		global $freight_cost;
		global $discount2;
		global $deposit;
		global $total;
		global $grand_total;
		
		global $penyewa;
		global $petugas;
		
		/*$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		$this->SetFont('arial','',11);
		
		//$size = $size + $sizeadd;
        $freight_cost_tmp = $freight_cost;
        $deposit_tmp      = $deposit;
        
        $grand_total	=	number_format($grand_total,"0",",",".");
		
		$this->SetFont('arial','',11);
		$this->Cell(144,5,'Terbilang :',0,0,'L',false);
		$this->SetFont('arial','',11);
		$this->Cell(25,5,'Total',0,0,'R',false);
		$this->Cell(25,5,$grand_total,0,1,'R',false);
		$this->SetFont('arial','',10);
		$this->Cell(144,5,$terbilang,0,1,'L',true);	
		$this->SetFont('arial','',11);
		$this->Ln(5);
		//$size = $size + $sizeadd;
		
		//---------
		$this->SetFont('arial','',11);
		$this->Cell(95,5,'Penyewa',0,0,'C',true);
		$this->Cell(49,5,'Kasir',0,1,'C',true);	
		$this->Ln(10);
		
		$this->Cell(95,5,'( ' . $penyewa . ' )',0,0,'C',true);	
		$this->Cell(48,5,'( ' . $petugas . ' )',0,0,'C',true);	
		//$this->Ln(2);
		
		
		$size = $size + $sizeadd;
		
		
		$this->Ln(2);*/
		
				
	} 
	
	
		
}
//===========================				
$pdf=new PDF();

$title='FAKTUR / INVOICE';
$pdf->SetTitle($title);	
$pdf->SetTitle($nis);	
$pdf->SetTitle($nama);


//$terbilang = "(" . KalimatUang($total) . ")";
//$pdf->SetTitle($terbilang);

$kelas = $tingkat . "/" . $kelas;
$pdf->SetTitle($kelas);
//$total = number_format($total,"0",".",",");
//$total2 = number_format($total2,"0",".",",");
//$pdf->SetTitle($total);
$pdf->SetTitle($size);

$header=array('No');
//$header2=array('No.','Jenis Biaya','Besarnya');
//Data loading
//$data=$pdf->LoadData('poa.txt');

$data=$pdf->LoadData($data);
//$data2=$pdf->LoadData($data2);
$pdf->SetFont('arial','',11);
$pdf->AddPage();


$pdf->BasicTable($header,$data);
 
$pdf->Output();

?>