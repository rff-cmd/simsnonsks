<?php
// menggunakan class phpExcelReader
include "excel_reader2.php";
include("function.php");

// koneksi ke mysql
@mysql_connect("localhost", "root", "");
@mysql_select_db("samson");


function random($number) 
{
	if ($number)
	{
    	for($i=1;$i<=$number;$i++)
		{
       		$nr=rand(0,9);
       		$total=$total.$nr;
       	}
    	return $total;
	}
}


function petikreplace($string="") {

	$string = str_replace("'","''",$string);
	
	return $string;	
}

// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;
 
// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
$x = 4;
for ($i=2; $i<=$baris; $i++)
{    
	$x++;
	$acc_code = $data->val($i, 1);
	$name = petikreplace($data->val($i, 2));
	$acc_type = $data->val($i, 3);
	$subacc_code = $data->val($i, 4);
	$postable = $data->val($i, 5);
	$opening_balance_date = date("Y-m-d");
	
	$uid = "admin";
	$dlu = date("Y-m-d H:i:s");
	//$syscode = random(9);
    echo $acc_code."<br>";
	if (!empty($acc_code))	 {
	  $query = "insert into coa (acc_code, name, acc_type, postable, subacc_code, opening_balance, opening_balance_date, current_balance, currency_code, currency_rate, currency_exchange_id, level, active, uid, dlu, syscode) values('$acc_code', '$name', '$acc_type', '$postable', '', '0', '$opening_balance_date', '0', '0', '0', '0', '$level', '1', '$uid', '$dlu', '$syscode')";	   
	  //$hasil = mysql_query($query);	  
	  
	  if(!empty($subacc_code)) {
			$sqlsub  = "select syscode from coa where acc_code='$subacc_code' ";
			$resultsub = mysql_query($sqlsub);
			$datasub = mysql_fetch_object($resultsub);	
			
			$sqlupd = "update coa set subacc_code='$datasub->syscode' where acc_code='$acc_code' ";
			mysql_query($sqlupd);
	  }
	  
	  
	} 
	
  if ($hasil) $sukses++;
  else $gagal++;
}
 
// tampilan status sukses dan gagal
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang terupdate diimport : ".$gagal."</p>";
 
?>