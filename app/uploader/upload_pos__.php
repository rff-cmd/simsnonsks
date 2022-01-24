<?php
	@session_start();
	
	$location_id = $_SESSION["location_id2"];
	
	/*===========start download */
	$dataget = "data_pos_" . $location_id . ".txt";
	
	$ch = curl_init("http://localhost:8080/tokosahabat/app/uploader/create_pos.php?whs=$location_id"); //localhost
	//$ch = curl_init("http://possp.sahabatputra.com/app/uploader/create_pos.php?whs=$location_id"); //online
	curl_exec($ch);
	
	ini_set('max_execution_time', 0);
	/*set time out menjadi unlimit agar download tidak gagal di tengah jalan karena time out */
	
	$url  = "http://localhost:8080/tokosahabat/app/uploader/data_upload/".$dataget; //localhost
	//$url  = "http://possp.sahabatputra.com/app/uploader/data_upload/".$dataget; //url online file yang ada di download
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
	
	
	/*===========start download detail*/
	$dataget_detail = "data_pos_detail_" . $location_id . ".txt";
	
	$ch = curl_init("http://localhost:8080/tokosahabat/app/uploader/create_pos_detail.php?whs=$location_id"); //localhost
	//$ch = curl_init("http://possp.sahabatputra.com/app/uploader/create_pos.php?whs=$location_id"); //online
	curl_exec($ch);
	
	ini_set('max_execution_time', 0);
	/*set time out menjadi unlimit agar download tidak gagal di tengah jalan karena time out */
	
	$url  = "http://localhost:8080/tokosahabat/app/uploader/data_upload/".$dataget_detail; //localhost
	//$url  = "http://possp.sahabatputra.com/app/uploader/data_upload/".$dataget; //url online file yang ada di download
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
	
	
	##start process sales invoice------------
	$myFile = $dataget; //"data_item.txt";
	$hasil = fopen($myFile, 'r');
	//$data = fgets($hasil);
	
	if( filesize($myFile) > 0 ) {
		$sqlitem = fread($hasil, filesize($myFile));
		fclose($hasil);
	}
	
	
	$i = 0;
	$itemdata = "";
	$dataexplode = explode("~", $sqlitem);
	for($i=0; $i<count($dataexplode); $i++) {
		
		$dataexplode1 = explode("|", $dataexplode[$i]);
		
		if($dataexplode1[1] == "insert") {
			$qcheck = "select ref from sales_invoice where ref='$dataexplode1[0]'";
			$sql1=$dbpdo2->prepare($qcheck);
			$sql1->execute();
			$rowscheck = $sql1->rowCount();
					
			if ($rowscheck == 0) {
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
	/*----------------------/\-----------------------------*/
	
	
	##start process sales invoice detail------------
	$myFile = $dataget_detail; //"data_item.txt";
	$hasil = fopen($myFile, 'r');
	//$data = fgets($hasil);
	
	if( filesize($myFile) > 0 ) {
		$sqlitem = fread($hasil, filesize($myFile));
		fclose($hasil);
	}
	
	
	$i = 0;
	$itemdata = "";
	$dataexplode = explode("~", $sqlitem);
	for($i=0; $i<count($dataexplode); $i++) {
		
		$dataexplode1 = explode("|", $dataexplode[$i]);
		
		if($dataexplode1[2] == "insert") {
			$qcheck = "select ref from sales_invoice_detail where ref='$dataexplode1[0]' and line='$dataexplode1[1]'";
			$sql1=$dbpdo2->prepare($qcheck);
			$sql1->execute();
			$rowscheck = $sql1->rowCount();
					
			if ($rowscheck == 0) {
				$sqlins = $dataexplode1[3];
				$sql2=$dbpdo2->prepare($sqlins);
				$sql2->execute();
			}
		} else {
			$sqlins = $dataexplode1[3];
			$sql3=$dbpdo2->prepare($sqlins);
			$sql3->execute();
		}
		
		
	}
	/*----------------------/\-----------------------------*/
		
	
?>

<div align="center" style="color: #f2f814; background-color: #2d0000; margin-top: 50px; height: auto; font-size: 24px; font-family: Arial">DOWNLOAD DATA POS SUKSES</div>
