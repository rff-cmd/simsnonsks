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

include 'class/class.selectview.php';
//include 'class/class.select.php';

$selectview = new selectview;
//$select = new select;

$petugas		=	$_SESSION["loginname"];
$ref			= 	$_REQUEST['ref'];

$sql = $selectview->list_payment($ref);
$row_payment=$sql->fetch(PDO::FETCH_OBJ);

$ref			=	$row_payment->ref;
$contact_code	=	$row_payment->contact_code;
	
$contact_name	=	$row_payment->contact_name;
$address_vdr	=	$row_payment->address;
$phone_vdr		=	$row_payment->phone;

$date			=	date("d-m-Y", strtotime($row_payment->date));

$total 			= 	$row_payment->total;
$round_amount	= 	$row_payment->round_amount;
$bank_charge	=	$row_payment->bank_charge;
$grand_total 	= 	$total; //$total - $deposit;

/*-----------terbilang---------------*/
function get_num_name($num){  
    switch($num){  
        case 1:return 'satu';  
        case 2:return 'dua';  
        case 3:return 'tiga';  
        case 4:return 'empat';  
        case 5:return 'lima';  
        case 6:return 'enam';  
        case 7:return 'tujuh';  
        case 8:return 'delapan';  
        case 9:return 'sembilan';  
    }  
}  

function num_to_words($number, $real_name, $decimal_digit, $decimal_name){  
    $res = '';  
    $real = 0;  
    $decimal = 0;  

    if($number == 0)  
        return 'Nol'.(($real_name == '')?'':' '.$real_name);  
    if($number >= 0){  
        $real = floor($number);  
        $decimal = round($number - $real, $decimal_digit);  
    }else{  
        $real = ceil($number) * (-1);  
        $number = abs($number);  
        $decimal = $number - $real;  
    }  
    $decimal = (int)str_replace('.','',$decimal);  

    $unit_name[1] = 'ribu';  
    $unit_name[2] = 'juta';  
    $unit_name[3] = 'milliar';  
    $unit_name[4] = 'trilliun';  

    $packet = array();  

    $number = strrev($real);  
    $packet = str_split($number,3);  

    for($i=0;$i<count($packet);$i++){  
        $tmp = strrev($packet[$i]);  
        $unit = $unit_name[$i];  
        if((int)$tmp == 0)  
            continue;  
        $tmp_res = '';  
        if(strlen($tmp) >= 2){  
            $tmp_proc = substr($tmp,-2);  
            switch($tmp_proc){  
                case '10':  
                    $tmp_res = 'sepuluh';  
                    break;  
                case '11':  
                    $tmp_res = 'sebelas';  
                    break;  
                case '12':  
                    $tmp_res = 'dua belas';  
                    break;  
                case '13':  
                    $tmp_res = 'tiga belas';  
                    break;  
                case '15':  
                    $tmp_res = 'lima belas';  
                    break;  
                case '20':  
                    $tmp_res = 'dua puluh';  
                    break;  
                case '30':  
                    $tmp_res = 'tiga puluh';  
                    break;  
                case '40':  
                    $tmp_res = 'empat puluh';  
                    break;  
                case '50':  
                    $tmp_res = 'lima puluh';  
                    break;  
                case '70':  
                    $tmp_res = 'tujuh puluh';  
                    break;  
                case '80':  
                    $tmp_res = 'delapan puluh';  
                    break;  
                default:  
                    $tmp_begin = substr($tmp_proc,0,1);  
                    $tmp_end = substr($tmp_proc,1,1);  

                    if($tmp_begin == '1')  
                        $tmp_res = get_num_name($tmp_end).' belas';  
                    elseif($tmp_begin == '0')  
                        $tmp_res = get_num_name($tmp_end);  
                    elseif($tmp_end == '0')  
                        $tmp_res = get_num_name($tmp_begin).' puluh';  
                    else{  
                        if($tmp_begin == '2')  
                            $tmp_res = 'dua puluh';  
                        elseif($tmp_begin == '3')  
                            $tmp_res = 'tiga puluh';  
                        elseif($tmp_begin == '4')  
                            $tmp_res = 'empat puluh';  
                        elseif($tmp_begin == '5')  
                            $tmp_res = 'lima puluh';  
                        elseif($tmp_begin == '6')  
                            $tmp_res = 'enam puluh';  
                        elseif($tmp_begin == '7')  
                            $tmp_res = 'tujuh puluh';  
                        elseif($tmp_begin == '8')  
                            $tmp_res = 'delapan puluh';  
                        elseif($tmp_begin == '9')  
                            $tmp_res = 'sembilan puluh';  

                        $tmp_res = $tmp_res.' '.get_num_name($tmp_end);  
                    }  
                    break;  
            }  

            if(strlen($tmp) == 3){  
                $tmp_begin = substr($tmp,0,1);  
                $space = '';  
                if(substr($tmp_res,0,1) != ' ' && $tmp_res != '')  
                    $space = ' ';  
                if($tmp_begin != 0){  
                    if($tmp_begin == 1)  
                        $tmp_res = 'seratus'.$space.$tmp_res;  
                    else  
                        $tmp_res = get_num_name($tmp_begin).' ratus'.$space.$tmp_res;  
                }  
            }  
        }else  
            $tmp_res = get_num_name($tmp);  

        $space = '';  
        if(substr($res,0,1) != ' ' && $res != '')  
            $space = ' ';  

        if($tmp_res == 'satu' && $unit == 'ribu')  
            $res = 'se'.$unit.$space.$res;  
        else  
            $res = $tmp_res.' '.$unit.$space.$res;  
    }  

    $space = '';  
    if(substr($res,-1) != ' ' && $res != '')  
        $space = ' ';  
    $res .= $space.$real_name;  

    if($decimal > 0)  
        $res .= ' '.num_to_words($decimal, '', 0, '').' '.$decimal_name;  
    return ucfirst($res);  
}  
/*------------------------------------------*/

/*---------print header-----------*/
$sqlcmp=$selectview->list_identitas();
$row_company=$sqlcmp->fetch(PDO::FETCH_OBJ);

$company_name = $row_company->nama;
$bussines_type= "Pendidikan";

// $sqlunit = $selectview->list_warehouse($_SESSION["location_sp"]);
// $dataunit = $sqlunit->fetch(PDO::FETCH_OBJ);

$address = $row_company->alamat1; //"Jl. Sample No. 21, Bandung";
$email = $row_company->email; //"nadhif@programmer.net";
$phone = $row_company->telp1; //"0813-38251798";
/*-------------------------------*/

/*---------print detail----------*/
$data		=	array();
$i 			= 	1;		
$size		= 	500;
$sizeadd 	= 	20;

$sql2 = $selectview->list_payment_detail($ref);
while($row_payment_detail=$sql2->fetch(PDO::FETCH_OBJ)) {

	$invoice_type	=	$row_payment_detail->invoice_type;
	$invoice_no		=	$row_payment_detail->invoice_no;
	$invoice_date	=	date("d-m-Y", strtotime($row_payment_detail->invoice_date));
	$amount_due		=	$row_payment_detail->amount_due;
	$amount 		= 	$row_payment_detail->amount_paid;
	$sub_total 		= 	$sub_total + $row_payment_detail->amount_paid;
	
	$total2 		= 	$total2 + $row_payment_detail->credit_amount;
	
	if ($invoice_type == "cash") {
		$invoice_type = "Cash";
	}
	if ($invoice_type == "giro") {
		$invoice_type = "Bilyet & Giro";
	}
	if ($invoice_type == "cheque") {
		$invoice_type = "Cheque";
	}
	if ($invoice_type == "card") {
		$invoice_type = "Credit Card";
	}
	if ($invoice_type == "transfer") {
		$invoice_type = "Transfer";
	}
	if ($invoice_type == "PIN" || $invoice_type == "POV") {
		$invoice_type = "Pembayaran Invoice";
	}
	
	
	$memo	=	$row_payment_detail->memo;
	$unit_cost	=	number_format($unit_cost,"0",",",".");
	$discount	=	0; //number_format($row_payment_detail->discount,"0",",",".");
	$amount_due	= 	number_format($amount_due,"0",",",".");
	$amount		=	number_format($amount,"0",",",".");
	$data[]=$i.';'.$invoice_no.';'.$invoice_date.';'.$invoice_type.';'.$amount_due.';'.$amount;
	
	$i++;	
	$size = $size + $sizeadd;

}


$terbilang		=	num_to_words($total, 'rupiah', 0, '');
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
		global $company_name;
		global $bussines_type;
		
		global $address;
		global $phone;
		global $email;
		
		global $ref;
		global $contact_name;
		global $address_vdr;
		global $date;
		global $phone_vdr;
				
		$this->SetFont('Arial','',11);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		$this->Cell(26,3,'',0,0,'L',false);
		$this->Cell(50,3,$company_name,0,1,'L',false);
		$this->Image('../assets/img/logo.jpg', 10, 5, 20, 20, 'jpg', '');
		$this->Ln(1);
		
		// $this->Cell(26,3,'',0,0,'L',false);
		// $this->Cell(20,3,$bussines_type,0,1,'L',false);
		// $this->Ln(1);
		
		$this->Cell(26,3,'',0,0,'L',false);
		$this->Cell(50,3,'Alamat Kantor :' . $address . 'Telp./Fax.: ' . $phone,0,1,'L',false);
		$this->Ln(2);
		
		$this->Cell(26,3,'',0,0,'L',false);
		$this->Cell(20,3,$email,0,1,'L',false);
		$this->Ln(4);
		
		$this->SetFont('Arial','U',11);
		$this->Cell(145,5,'PEMBAYARAN (PAYMENT)',0,0,'L',true);
		$this->Cell(50,5,'No : ' . $ref,0,1,'R',false);
		$this->Ln(2);
		
		$this->SetFont('Arial','',11);
		$this->Cell(34,2,'Nama',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(120,2,$contact_name,0,0,'L',false);
		$this->Cell(20,2,'Tanggal : ' . $date,0,1,'L',false);
		$this->Ln(2);
		
		$this->Cell(34,2,'Alamat',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$address_vdr,0,1,'L',true);
		$this->Ln(2);
		
		$this->Cell(34,2,'No. Telepon',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$phone_vdr,0,1,'L',true);
		$this->Ln(2);
		
		//Save ordinate
		$this->y0=$this->GetY();
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
			if ($i==1) { $this->Cell(42,7,$col,1,0,"C"); }
			if ($i==2) { $this->Cell(23,7,$col,1,0,"C"); }
			if ($i==3) { $this->Cell(56,7,$col,1,0,"C"); }
			if ($i==4) { $this->Cell(30,7,$col,1,0,"C"); }
			if ($i==5) { $this->Cell(30,7,$col,1,0,"C"); }
			$i++;
		}
		$this->Ln();
		
		
		//Data		
		foreach($data as $row)
		{	
			$i=0;
			foreach($row as $col) {
				
				if ($i==0) { $this->Cell(13,6,$col,1,0,"C"); }
				if ($i==1) { $this->Cell(42,6,$col,1,0,"L"); }
				if ($i==2) { $this->Cell(23,6,$col,1,0,"L"); }
				if ($i==3) { $this->Cell(56,6,$col,1,0,"L"); }
				if ($i==4) { $this->Cell(30,6,$col,1,0,"R"); }
				if ($i==5) { $this->Cell(30,6,$col,1,0,"R"); }
				$i++;
			}
			$this->Ln();
			
		}	
		
		//-----set sub group
		global $terbilang;
		global $sub_total;
		global $total;
		global $grand_total;
		global $round_amount;
		global $bank_charge;
		
		global $contact_name;
		global $petugas;
		
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','',11);
		
		//$size = $size + $sizeadd;
		$sub_total		=	number_format($sub_total,"0",",",".");
		$round_amount	=	number_format($round_amount,"0",",",".");
		$total			=	number_format($total,"0",",",".");
		$bank_charge	=	number_format($bank_charge,"0",",",".");
		$grand_total	=	number_format($grand_total,"0",",",".");
		
		$this->Ln(1);
		$this->SetFont('Arial','',10);
		$this->Cell(144,5,'Terbilang :',0,0,'L',true);
		$this->SetFont('Arial','',11);
		
		$size = $size + $sizeadd;		
		$this->Cell(20,5,'Sub Total',0,0,'R',false);
		$this->Cell(30,5,$sub_total,0,1,'R',true);
		
		$this->SetFont('Arial','',10);
		$this->Cell(20,5,$terbilang,0,0,'L',true);	
		
		$this->SetFont('Arial','',11);
		
		if($round_amount != 0 && $bank_charge > 0) {
			$size = $size + $sizeadd;
			$this->Cell(144,5,'Pembulatan',0,0,'R',false);
			$this->Cell(30,5,$round_amount,0,1,'R',true);
			
			$size = $size + $sizeadd;
			$this->Cell(164,5,'Pot. Bank',0,0,'R',false);
			$this->Cell(30,5,$bank_charge,0,1,'R',true);
			
			$size = $size + $sizeadd;
			$this->Cell(164,5,'Total',0,0,'R',false);
			$this->Cell(30,5,$total,0,1,'R',false);
		}
				
		if($round_amount == 0 && $bank_charge > 0) {
			$size = $size + $sizeadd;
			$this->Cell(144,5,'Pot. Bank',0,0,'R',false);
			$this->Cell(30,5,$bank_charge,0,1,'R',true);
			
			$size = $size + $sizeadd;
			$this->Cell(164,5,'Total',0,0,'R',false);
			$this->Cell(30,5,$total,0,1,'R',false);
		}
		
		if($round_amount != 0 && $bank_charge == 0) {
			$size = $size + $sizeadd;
			$this->Cell(144,5,'Pembulatan',0,0,'R',false);
			$this->Cell(30,5,$round_amount,0,1,'R',true);
			
			$size = $size + $sizeadd;
			$this->Cell(164,5,'Total',0,0,'R',false);
			$this->Cell(30,5,$total,0,1,'R',false);
		}
		
		if($round_amount == 0 && $bank_charge == 0) {
			$size = $size + $sizeadd;
			$this->Cell(144,5,'Total',0,0,'R',false);
			$this->Cell(30,5,$total,0,1,'R',false);
		}
		
		
		
		/*$this->Cell(144,5,'',0,0,'L',true);	
		$this->Cell(25,5,'Uang Muka',0,0,'R',false);
		$this->Cell(25,5,$deposit,0,1,'R',false);
		
		$this->Cell(144,5,'',0,0,'L',true);	
		$this->Cell(25,5,'Sisa',0,0,'R',false);
		$this->Cell(25,5,$grand_total,0,1,'R',false);		
		$this->Ln(5);
		*/
		
		$size = $size + $sizeadd;
		
		
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
		$this->Cell(95,5,'Penerima',0,0,'C',true);
		$this->Cell(95,5,'Petugas',0,1,'C',true);	
		$this->Ln(10);
		
		$size = $size + $sizeadd;
		
		$this->Cell(95,5,'( ' . $contact_name . ' )',0,0,'C',true);	
		$this->Cell(95,5,'( ' . $petugas . ' )',0,1,'C',true);	
		$this->Ln(2);
		
				
	} 
	
	
		
}
//===========================				
$pdf=new PDF();

$title='PEMBAYARAN (PAYMENT)';
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
$uid = $petugas; //$_SESSION["loginname_sp"];
$tanggalcetak = $G_LOKASI . ", " . $tglcetak;
$getuser = "(". $uid . ")";
*/

$header=array('No.','No. Invoice','Tanggal','Transaksi','Piutang','Dibayar');
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