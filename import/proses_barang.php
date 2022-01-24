<?php
// menggunakan class phpExcelReader
include "excel_reader2.php";
include("function.php");

// koneksi ke mysql
@mysql_connect("localhost", "root", "");
@mysql_select_db("tokosahabat");


function random($number) 
{
	if ($number)
	{
    	for($i=1;$i<=$number;$i++)
		{
       		$nr=rand(0,25);
       		$total=$total.$nr;
       	}
    	return $total;
	}
}


function petikreplace($string="") {

	$string = str_replace("'","''",$string);
	
	return $string;	
}

function numberreplace($string="0") {

	$string = str_replace(",","",(empty($string)) ? 0 : $string);
	
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
	$uid = "import";
	$dlu = date("Y-m-d H:i:s");
	$active = "1";
	
	$item_group_id = substr($data->val($i, 5),0,2);
	$nama_cat = $data->val($i, 6);
	//echo $item_group_id."<br>";
	$sqlcat = "select code from item_group where code='$item_group_id'";
	$queryrslt=mysql_query($sqlcat);
	$rowscat=mysql_num_rows($queryrslt);
	if($rowscat == 0) {
		
		if($item_group_id != "") {
			$sqlinscat="insert into item_group (code, name, active, uid, dlu) values ('$item_group_id', '$nama_cat', '$active', '$uid', '$dlu')";
			$querycat=mysql_query($sqlinscat);
			
			$strlast="select last_insert_id() cat_id";
			$rsltcat=mysql_query($strlast);
			$datacat=mysql_fetch_object($rsltcat);
			$item_group_id=$datacat->cat_id;
		}
		
	} else {
		$strlast="select id from item_group where code='$item_group_id'";
		$rsltcat=mysql_query($strlast);
		$datacat=mysql_fetch_object($rsltcat);
		$item_group_id=$datacat->id;
	}
	
	
	$code = $data->val($i, 5);
	$old_code = $data->val($i, 3);
	$name = petikreplace($data->val($i, 7));
	//$item_group_id="0";
	$item_subgroup_id="0";
	$item_type_code="0";
	$brand_id="0";
	$size_id="";
	$minimum_stock="0";
	$maximum_stock="0";
	$photo="";
	$uom = "pcs";
	$item_category_id = "2";
	
	
	$syscode = random(15);
	
	//set item price
	$date = date("Y-m-d");
	$efective_from = date("Y-m-d");
	$item_code = $syscode;
	$uom_code = $uom;
	$current_price = numberreplace($data->val($i, 9));
	$current_price1 = numberreplace($data->val($i, 10));
	$current_price2 = numberreplace($data->val($i, 11));
	$current_price3 = "0";
	$last_price = "0";
	$date_of_record = date("Y-m-d H:i:s");
	$location_id = "0";
	$non_discount = "0";
	$qty1 = numberreplace($data->val($i, 12));
	$qty2 = numberreplace($data->val($i, 13));
	$qty3 = numberreplace($data->val($i, 14));
	$qty4 = "0";
	
	//set item cost
	$current_cost = numberreplace($data->val($i, 8));
	$last_cost = "0";
    //echo $code."<br>";
	if (!empty($code))	 {
		
		$cekitem="select code from item where code='$code'";
		$qdata=mysql_query($cekitem);
		$rowsitem=mysql_num_rows($qdata);
		
		if($rowsitem == 0) {
			$query = "insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, active, uid, dlu, syscode) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom', '$uom', '$uom', '$minimum_stock', '$maximum_stock', '$photo', '$active', '$uid', '$dlu', '$syscode')";	   
		  //echo $query."<br>";
		  $hasil = mysql_query($query);	  
	  
		  //set item price
		  $strharga="insert into set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu) values ('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu')";
		  echo $strharga."<br>";
		  $hasil2 = mysql_query($strharga);
		  
		  //set item cost
		  $strcost="insert into set_item_cost (date, efective_from, item_code, uom_code, current_cost, last_cost, date_of_record, location_id, uid, dlu) values ('$date', '$efective_from', '$item_code', '$uom_code', '$current_cost', '$last_cost', '$date_of_record', '$location_id', '$uid', '$dlu')";
		  $hasil3 = mysql_query($strcost);
		} else {
			$query="update item set old_code='$old_code', name='$name', item_group_id='$item_group_id' where code='$code'";	
			$hasil = mysql_query($query);
		}
	  
	} 
	
  if ($hasil) {
  		$sukses++;
  }  else {
  	$gagal++;
  	
  	//echo $code . "---" . $name."<br>";
  }
  
}
 
// tampilan status sukses dan gagal
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang terupdate diimport : ".$gagal."</p>";
 
?>