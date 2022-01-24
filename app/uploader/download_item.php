<?php
	@session_start();
	
	$location_id = "12"; //$_SESSION["location_id2"];
	
	$dataget = "data_item_" . $location_id . ".txt";
	
	/*===========start download */
	//$ch = curl_init("http://localhost:8080/tokosahabat/app/uploader/create_item.php?whs=$location_id"); //localhost
	$ch = curl_init("http://possp.sahabatputra.com/app/uploader/create_item.php?whs=$location_id"); //online
	curl_exec($ch);
	
	ini_set('max_execution_time', 0);
	/*set time out menjadi unlimit agar download tidak gagal di tengah jalan karena time out */
	
	//$url  = "http://localhost:8080/tokosahabat/app/uploader/data_upload/".$dataget; //localhost
	$url  = "http://possp.sahabatputra.com/app/uploader/data_upload/".$dataget; //url online file yang ada di download
	$path = new SplFileInfo($url); //fungsi untuk mendapatkan nama file dari URL secara otomatis
	$nama = $path->getFilename(); //fungsi untuk mendapatkan nama file dari URL secara otomatis	 
	$fp = fopen($nama, 'w');
	/*menuliskan hasil download kedalam sebuah file agar tidak memakan memory yang besar */
	
	//inisialisasi CURL
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_FILE, $fp);
	 	 
	//eksekusi download file
	$data = curl_exec($ch);
	curl_close($ch); //close koneksi CURL
	fclose($fp); //close file
	

	#set item price-------------------------------------------\/
	$dataget2 = "data_set_item_price_" . $location_id . ".txt";
	
	//$ch = curl_init("http://localhost:8080/tokosahabat/app/uploader/create_item_set_price.php?whs=$location_id"); //localhost
	$ch = curl_init("http://possp.sahabatputra.com/app/uploader/create_item_set_price.php?whs=$location_id"); //online
	curl_exec($ch);
	
		
	ini_set('max_execution_time', 0);
	/*set time out menjadi unlimit agar download tidak gagal di tengah jalan karena time out */
	
	//$url  = "http://localhost:8080/tokosahabat/app/uploader/data_upload/".$dataget2; //localhost
	$url  = "http://possp.sahabatputra.com/app/uploader/data_upload/".$dataget2; //url online file yang ada di download
	$path = new SplFileInfo($url); //fungsi untuk mendapatkan nama file dari URL secara otomatis
	$nama = $path->getFilename(); //fungsi untuk mendapatkan nama file dari URL secara otomatis	 
	$fp = fopen($nama, 'w');
	/*menuliskan hasil download kedalam sebuah file agar tidak memakan memory yang besar */
	
	//inisialisasi CURL
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_FILE, $fp);
	 	 
	//eksekusi download file
	$data = curl_exec($ch);
	curl_close($ch); //close koneksi CURL
	fclose($fp); //close file
	
	
	
	##download item group
	$dataget3 = "data_item_group_" . $location_id . ".txt";
	
	//$ch = curl_init("http://localhost:8080/tokosahabat/app/uploader/create_item.php?whs=$location_id"); //localhost
	$ch = curl_init("http://possp.sahabatputra.com/app/uploader/create_item_group.php?whs=$location_id"); //online
	curl_exec($ch);
	
	ini_set('max_execution_time', 0);
	/*set time out menjadi unlimit agar download tidak gagal di tengah jalan karena time out */
	
	//$url  = "http://localhost:8080/tokosahabat/app/uploader/data_upload/".$dataget; //localhost
	$url  = "http://possp.sahabatputra.com/app/uploader/data_upload/".$dataget3; //url online file yang ada di download
	$path = new SplFileInfo($url); //fungsi untuk mendapatkan nama file dari URL secara otomatis
	$nama = $path->getFilename(); //fungsi untuk mendapatkan nama file dari URL secara otomatis	 
	$fp = fopen($nama, 'w');
	/*menuliskan hasil download kedalam sebuah file agar tidak memakan memory yang besar */
	
	//inisialisasi CURL
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_FILE, $fp);
	 	 
	//eksekusi download file
	$data = curl_exec($ch);
	curl_close($ch); //close koneksi CURL
	fclose($fp); //close file
	
	
	
		

	/*===========execute database local*/
	include ("../../app/include/sambung_toko.php");
	$dbpdo2 = DB2::create2();
	
	
	$myFile = $dataget; //"data_item.txt";
	$hasil = fopen($myFile, 'r');
	//$data = fgets($hasil);
	
	$sqlitem = "";
	if( filesize($myFile) > 0 ) {
		$sqlitem = fread($hasil, filesize($myFile));
		fclose($hasil);
	}
	
	if($sqlitem != "") {
			$dataexplode = array();
			$i = 0;
			$itemdata = "";
			$dataexplode = explode("~", $sqlitem);
			for($i=0; $i<count($dataexplode); $i++) {
				
				$dataexplode1 = array();
				$dataexplode1 = explode("|", $dataexplode[$i]);
				
				if($dataexplode1[1] == "insert") {
					$syscode = trim($dataexplode1[0]);
					$qcheck = "select syscode from item where syscode='$syscode'";
					
					$sql1=$dbpdo2->prepare($qcheck);
					$sql1->execute();
					$rowscheck = $sql1->rowCount();
					if ( $rowscheck == 0 && !empty($syscode) ) {
						
						$sqlins = $dataexplode1[2];
						$sql2=$dbpdo2->prepare($sqlins);
						$sql2->execute();
						
					}
				} else {
					$sqlins = $dataexplode1[2];
					$sql3=$dbpdo2->prepare($sqlins);
					$sql3->execute();
				}
				
				
			}
	}
	/*----------------------/\-----------------------------*/
	
	
	#set item price proces-------------------------
	$myFile = $dataget2; //"data_item.txt";
	$hasil = fopen($myFile, 'r');
	//$data = fgets($hasil);
	
	$sqlitem = "";
	if( filesize($myFile) > 0 ) {
		$sqlitem = fread($hasil, filesize($myFile));
		fclose($hasil);
	}
	
	
	$dataexplode	=	array();
	
	if($sqlitem != "") {
			$i = 0;
			$itemdata = "";
			$dataexplode = explode("~", $sqlitem);
			for($i=0; $i<count($dataexplode); $i++) {
				
				$dataexplode1 = array();
				
				$dataexplode1 = explode("|", $dataexplode[$i]);
				
				if($dataexplode1[3] == "insert") {
					
					$syscode2 = trim($dataexplode1[0]);
					
					$qcheck = "select item_code from set_item_price where item_code='$syscode2' and uom_code='$dataexplode1[1]'"; //and date_of_record='$dataexplode1[2]'
					$sql1=$dbpdo2->prepare($qcheck);
					$sql1->execute();
					$rowscheck = $sql1->rowCount();
					
					if ($rowscheck == 0 && !empty($syscode2) ) {
						$sqlins = $dataexplode1[4];
						$sql2=$dbpdo2->prepare($sqlins);
						$sql2->execute();
					}
				} else {
					$sqlins = $dataexplode1[4];
					$sql3=$dbpdo2->prepare($sqlins);
					$sql3->execute();
				}
				
				
			}
	}
	/*----------------------/\-----------------------------*/
	
	
	##download item group
	//include("download_item_group.php");
	$myFile = $dataget3; //"data_item.txt";
	$hasil = fopen($myFile, 'r');
	//$data = fgets($hasil);
	
	$sqlitem = "";
	if( filesize($myFile) > 0 ) {
		$sqlitem = fread($hasil, filesize($myFile));
		fclose($hasil);
	}
	
	if($sqlitem != "") {
			$dataexplode = array();
			$i = 0;
			$itemdata = "";
			$dataexplode = explode("~", $sqlitem);
			for($i=0; $i<count($dataexplode); $i++) {
				
				$dataexplode1 = array();
				$dataexplode1 = explode("|", $dataexplode[$i]);
				
				if($dataexplode1[1] == "insert") {
					$id = trim($dataexplode1[0]);
					$qcheck = "select id from item_group where id='$id'";
					
					$sql1=$dbpdo2->prepare($qcheck);
					$sql1->execute();
					$rowscheck = $sql1->rowCount();
					if ( $rowscheck == 0 && !empty($id) ) {
						
						$sqlins = $dataexplode1[2];
						$sql2=$dbpdo2->prepare($sqlins);
						$sql2->execute();
						
					}
				} else {
					$sqlins = $dataexplode1[2];
					$sql3=$dbpdo2->prepare($sqlins);
					$sql3->execute();
				}
				
				
			}
	}
	/*----------------------/\-----------------------------*/
	
	
	
	
?>

<div align="center" style="color: #f2f814; background-color: #2d0000; margin-top: 50px; height: auto; font-size: 24px; font-family: Arial">DOWNLOAD DATA ITEM SUKSES</div>
