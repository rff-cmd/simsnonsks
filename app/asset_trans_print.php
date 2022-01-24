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

$petugas		=	$_SESSION["loginname"];
$ref			= 	$_REQUEST['ref'];

$sql = $selectview->list_asset_trans($ref);
$row_asset_trans=$sql->fetch_object();

$ref			=	$row_asset_trans->ref;
$asset_name    	=	$row_asset_trans->asset_name;
$tanggal		=	date("d-m-Y", strtotime($row_asset_trans->tanggal));
$penyewa		=	$row_asset_trans->penyewa;
$alamat       	=	$row_asset_trans->alamat;
$hp        		=	$row_asset_trans->hp;
$akhir_sewa		=	date("d-m-Y", strtotime($row_asset_trans->akhir_sewa));

$harga_sewa 	= 	$row_asset_trans->harga_sewa;
$grand_total 	= 	$harga_sewa; //$total - $deposit;

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
$sqlunit = $select->list_company();
$dataunit = mysql_fetch_object($sqlunit);

$address = "Jl. Tasikmalaya";
if(!empty($dataunit->address1)) {
	$address = $dataunit->address1;	
}

$email = "tokoazad@yahoo.com";
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
$size		= 	500;
$sizeadd 	= 	20;

$qty        =   1;
$uom_code	=	"pcs";
$item_name	=	$asset_name;
$unit_price	=	number_format($harga_sewa,"0",",",".");

$data[]=$qty.';'.$uom_code.';'.$item_name.';'.$unit_price;

$i++;	
$size = $size + $sizeadd;


$terbilang		=	num_to_words($grand_total, 'rupiah', 0, '');
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
        global $address;
        global $phone;
        global $email;
        
        global $ref;
		global $asset_name;
		global $tanggal;
		global $penyewa;
		global $alamat;
		global $hp;
		global $akhir_sewa;
				
		$this->SetFont('arial','',11);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		$this->Cell(26,0,'',0,0,'L',false);
		$this->Cell(50,5,'TOKO AZAD',0,1,'L',false);
		$this->Image('../assets/img/logo.jpg', 10, 5, 25, 15, 'jpg', '');
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
		
		//Save ordinate
		//$this->y0=$this->GetY();
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
		//Header
		$i=0;				
		foreach($header as $col) {
			if ($i==0) { $this->Cell(13,6,$col,1,0,"C"); }
			if ($i==1) { $this->Cell(14,6,$col,1,0,"C"); }
			if ($i==2) { $this->Cell(122,6,$col,1,0,"C"); }
			if ($i==3) { $this->Cell(45,6,$col,1,0,"C"); }
            
			$i++;
		}
		$this->Ln();
		
		
		//Data		
		foreach($data as $row)
		{	
			$i=0;
			foreach($row as $col) {
				
				if ($i==0) { $this->Cell(13,6,$col,1,0,"C"); }
				if ($i==1) { $this->Cell(14,6,$col,1,0,"C"); }
				if ($i==2) { $this->Cell(122,6,$col,1,0,"L"); }
				if ($i==3) { $this->Cell(45,6,$col,1,0,"R"); }
                
				$i++;
			}
			$this->Ln();
			
		}	
		
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
		
		$this->SetFillColor(255,255,255);
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
		
		
		//-----------
		/*$this->SetFont('arial','',11);
		$this->Cell(200,5,'- Barang yang sudah dibeli tidak boleh ditukar / dikembalikan, biaya retur 30% dari harga produk',0,1,'L',false);		
		$this->Ln(0); */
		
		//$size = $size + $sizeadd;
		
		/*
		$this->SetFont('arial','',11);
		$this->Cell(200,5,'- Pembayaran dianggap lunas apabila cek sudah cair / transfer telah kami terima.',0,1,'L',false);		
		$this->Ln(0);
		*/
		
		//$size = $size + $sizeadd;
		
		//---------
		/*$this->SetFont('arial','',11);
		$this->Cell(95,5,'Pelanggan',0,0,'C',true);
		$this->Cell(95,5,'Petugas',0,1,'C',true);	
		$this->Ln(2);
		
		$size = $size + $sizeadd;
		
		$this->Cell(95,5,'( ' . $client_name . ' )',0,0,'C',true);	
		$this->Cell(95,5,'( ' . $petugas . ' )',0,1,'C',true);	
		*/
		$this->Ln(2);
		
				
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

/*$G_LOKASI = "Bandung";
$uid = $petugas; //$_SESSION["loginname"];
$tanggalcetak = $G_LOKASI . ", " . $tglcetak;
$getuser = "(". $uid . ")";
*/

$header=array('Qty','Satuan','Nama Barang','Harga Sewa');
//$header2=array('No.','Jenis Biaya','Besarnya');
//Data loading
//$data=$pdf->LoadData('poa.txt');

$data=$pdf->LoadData($data);
//$data2=$pdf->LoadData($data2);
$pdf->SetFont('arial','',11);
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