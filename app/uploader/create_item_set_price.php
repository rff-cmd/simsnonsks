<?php
	include ("../../app/include/sambung.php");
	$dbpdo = DB::create();

	/*set location code*/
	$location_id = $_GET['whs']; // $_SESSION["location_id2"];
	$qwhs = "select code from warehouse where id='$location_id'";
	$sql=$dbpdo->prepare($qwhs);
	$sql->execute();
			
	$datawhs = $sql->fetch(PDO::FETCH_OBJ);
	$whscode = $datawhs->code;
	/*-------------/\---*/
	
	$j=0;	
	$itemdata = "";
	$values2 = "";
	
	if($whscode == "") {
		$sql2 = "select a.date, a.efective_from, a.item_code, a.uom_code, a.current_price, a.current_price1, a.current_price2, a.current_price3, a.last_price, a.date_of_record, a.location_id, a.non_discount, a.qty1, a.qty2, a.qty3, a.qty4, a.uid, a.dlu, a.adt_status, a.status_download, a.sysid from adt_set_item_price a order by a.sysid";
	} else {
		$sql2 = "select a.date, a.efective_from, a.item_code, a.uom_code, a.current_price, a.current_price1, a.current_price2, a.current_price3, a.last_price, a.date_of_record, a.location_id, a.non_discount, a.qty1, a.qty2, a.qty3, a.qty4, a.uid, a.dlu, a.adt_status, a.status_download, a.sysid from adt_set_item_price a where ifnull(status_download,'') not like '%$whscode%' order by a.sysid";
	}
	
	$sql2=$dbpdo->prepare($sql2);
	$sql2->execute();
	while ($data = $sql2->fetch(PDO::FETCH_OBJ)) { 
		$j++;
		
		$adt_status = $data->adt_status;
		
		$itemdata = $data->item_code;
		$uom_code = $data->uom_code;
		$date_of_record = $data->date_of_record;
		
		if ($j == 1) {
			
			if($adt_status == "insert") {
				$values2 = $itemdata. "|" . $uom_code . "|" . $date_of_record . "|" . $adt_status . "|" . "insert into set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu) values('$data->date', '$data->efective_from', '$data->item_code', '$data->uom_code', '$data->current_price', '$data->current_price1', '$data->current_price2', '$data->current_price3', '$data->last_price', '$data->date_of_record', '$data->location_id', '$data->non_discount', '$data->qty1', '$data->qty2', '$data->qty3', '$data->qty4', '$data->uid', '$data->dlu')";
			}
			
			if($adt_status == "update") {
				$values2 = $itemdata. "|" . $uom_code . "|" . $date_of_record . "|" . $adt_status . "|" . "update set_item_cost set efective_from='$data->efective_from_cost', uom_code='$data->uom_code', current_cost='$data->current_cost', last_cost='$data->last_cost', date_of_record='$data->date_of_record', location_id='$data->location_id_cost', uid='$data->uid', dlu='$data->dlu' where item_code='$data->item_code' and uom_code='$data->uom_code'";
				
			}
			
			if($adt_status == "delete") {
				$values2 = $itemdata. "|" . $uom_code . "|" . $date_of_record . "|" . $adt_status . "|" . "delete from set_item_price where item_code='$data->item_code' and uom_code='$data->uom_code' and date_of_record='$data->date_of_record'";
			}
			
		} else {
			$itemdata = $data->item_code;
			
			if($adt_status == "insert") {
				$values2 = $values2."~\n". $itemdata. "|" . $uom_code . "|" . $date_of_record . "|" . $adt_status . "|" . "insert into set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu) values('$data->date', '$data->efective_from', '$data->item_code', '$data->uom_code', '$data->current_price', '$data->current_price1', '$data->current_price2', '$data->current_price3', '$data->last_price', '$data->date_of_record', '$data->location_id', '$data->non_discount', '$data->qty1', '$data->qty2', '$data->qty3', '$data->qty4', '$data->uid', '$data->dlu')";
			}
			
			if($adt_status == "update") {
				$values2 = $values2."~\n". $itemdata. "|" . $uom_code . "|" . $date_of_record . "|" . $adt_status . "|" . "update set_item_cost set efective_from='$data->efective_from_cost', uom_code='$data->uom_code', current_cost='$data->current_cost', last_cost='$data->last_cost', date_of_record='$data->date_of_record', location_id='$data->location_id_cost', uid='$data->uid', dlu='$data->dlu' where item_code='$data->item_code' and uom_code='$data->uom_code'";
			}
			
			if($adt_status == "delete") {
				$values2 = $values2."~\n". $itemdata. "|" . $uom_code . "|" . $date_of_record . "|" . $adt_status . "|" . "delete from set_item_price where item_code='$data->item_code' and uom_code='$data->uom_code' and date_of_record='$data->date_of_record'";
			}
			
		}		
		
		/*update adt_item (tanda sudah didownload)*/
		$qupdate = "update adt_set_item_price set status_download=concat(ifnull(status_download,'')," . "'^" . $whscode . "') where item_code ='$itemdata' and sysid='$data->sysid' ";
		$sql=$dbpdo->prepare($qupdate);
		$sql->execute();
		/*-----------------------/\---------------*/
					
	}
	
	$datacreate = "data_set_item_price_".$location_id;
	$kirim=fopen("data_upload/" . $datacreate . ".txt","w");
	fputs($kirim, "$values2");
	fclose($kirim);
	
	
?>