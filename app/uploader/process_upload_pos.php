<?php
	@session_start();
	
	$location_id = $_GET['whs'];
	
	/*===========execute database*/
	include ("../../app/include/sambung_toko.php");
	$dbpdo2 = DB2::create2();
	
	$myFile = "data_pos_" . $location_id . ".txt";
	$hasil = fopen($myFile, 'r');
	//$data = fgets($hasil);
	
	$sqlitem = "";
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
	}
	/*----------------------/\-----------------------------*/
	
	
		
?>
