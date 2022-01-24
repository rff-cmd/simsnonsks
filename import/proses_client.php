<?php
// menggunakan class phpExcelReader
include "excel_reader2.php";
include("function.php");

// koneksi ke mysql
@mysql_connect("localhost", "root", "");
@mysql_select_db("samson_ol");


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
for ($i=1; $i<=$baris; $i++)
{    
	$x++;
	
	$kode = $data->val($i, 1);
	$client_type = $data->val($i, 5);
	
	
	if (!empty($client_type))	 {
	  $query = "update client2 set client_type='$client_type' where code='$kode'";	   
	  $hasil = mysql_query($query);	  
	  
	  echo $kode . '/' . $client_type . "<br>";
	} 
	
  if ($hasil) $sukses++;
  else $gagal++;
}
 
// tampilan status sukses dan gagal
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang terupdate diimport : ".$gagal."</p>";
 
?>