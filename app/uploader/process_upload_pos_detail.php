<?php
	@session_start();
	
	$location_id = $_GET['whs'];
	
	/*===========execute database*/
	include ("../../app/include/sambung_toko.php");
	$dbpdo2 = DB2::create2();
	
	
	##start process sales invoice detail------------
	$dataget_detail = "data_pos_detail_" . $location_id . ".txt";
	$myFile = $dataget_detail; //"data_item.txt";
	$hasil = fopen($myFile, 'r');
	//$data = fgets($hasil);
	
	if( filesize($myFile) > 0 ) {
		$sqlitem = fread($hasil, filesize($myFile));
		fclose($hasil);
	}
	
	
	if(!empty($sqlitem)) {
		$dataexplode = array();
		$i = 0;
		$itemdata = "";
		$dataexplode = explode("~", $sqlitem);
		for($i=0; $i<count($dataexplode); $i++) {
			
			$dataexplode1 = array();
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
	}
	/*----------------------/\-----------------------------*/
	
		
?>
