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
	
	
	function petikreplace($string="") {

		$string = str_replace("'","''",$string);
		
		return $string;	
	}
	
	if($whscode == "") {
		$sql2 = "select a.id, a.code, a.name, a.nonstock, a.costing_type, a.inventory_acccode, a.cogs_acccode, a.goodintransit_acccode, a.purchase_discount_acccode, a.workinprocess_acccode, a.consignment_acccode, a.location_id, a.active, a.uid, a.dlu, a.adt_status, a.sysid from adt_item_group a order by a.sysid";
	} else {
		$sql2 = "select a.id, a.code, a.name, a.nonstock, a.costing_type, a.inventory_acccode, a.cogs_acccode, a.goodintransit_acccode, a.purchase_discount_acccode, a.workinprocess_acccode, a.consignment_acccode, a.location_id, a.active, a.uid, a.dlu, a.adt_status, a.sysid from adt_item_group a where ifnull(a.status_download,'') not like '%$whscode%' order by a.sysid";
	}
	
	$sql2=$dbpdo->prepare($sql2);
	$sql2->execute();
	while ($data = $sql2->fetch(PDO::FETCH_OBJ)) {
		$j++;
		
		$adt_status = $data->adt_status;
		
		$item_group_name = petikreplace($data->name);
		
		if ($j == 1) {
			$itemdata = $data->id;
			
			if($adt_status == "insert") {
				$values2 = $itemdata. "|" . $adt_status . "|" . "insert into item_group (id, code, name, nonstock, costing_type, inventory_acccode, cogs_acccode, goodintransit_acccode, purchase_discount_acccode, workinprocess_acccode, consignment_acccode, location_id, active, uid, dlu) values ('$data->id', '$data->code', '$item_group_name', '$data->nonstock', '$data->costing_type', '$data->inventory_acccode', '$data->cogs_acccode', '$data->goodintransit_acccode', '$data->purchase_discount_acccode', '$data->workinprocess_acccode', '$data->consignment_acccode', '$data->location_id', '$data->active', '$data->uid', '$data->dlu')";				
			}
			
			if($adt_status == "update") {
				$values2 = $itemdata. "|" . $adt_status . "|" . "update item_group set code='$data->code', name='$item_group_name', nonstock='$data->nonstock', costing_type='$data->costing_type', inventory_acccode='$data->inventory_acccode', cogs_acccode='$data->cogs_acccode', goodintransit_acccode='$data->goodintransit_acccode', purchase_discount_acccode='$data->purchase_discount_acccode', workinprocess_acccode='$data->workinprocess_acccode', consignment_acccode='$data->consignment_acccode', location_id='$data->location_id', active='$data->active', uid='$data->uid', dlu='$data->dlu' where id='$data->id'";
			}
			
			if($adt_status == "delete") {
				$values2 = $itemdata. "|" . $adt_status . "|" . "delete from item_group where id='$data->id'";
			}
			
		} else {
			$itemdata = $data->id;
			$item_group_name = petikreplace($data->name);
			
			if($adt_status == "insert") {
				$values2 = $values2."~\n". $itemdata . "|" . $adt_status . "|" . "insert into item_group (id, code, name, nonstock, costing_type, inventory_acccode, cogs_acccode, goodintransit_acccode, purchase_discount_acccode, workinprocess_acccode, consignment_acccode, location_id, active, uid, dlu) values ('$data->id', '$data->code', '$item_group_name', '$data->nonstock', '$data->costing_type', '$data->inventory_acccode', '$data->cogs_acccode', '$data->goodintransit_acccode', '$data->purchase_discount_acccode', '$data->workinprocess_acccode', '$data->consignment_acccode', '$data->location_id', '$data->active', '$data->uid', '$data->dlu')";
			}
			
			if($adt_status == "update") {
				$values2 = $values2."~\n". $itemdata . "|" . $adt_status . "|" . "update item_group set code='$data->code', name='$item_group_name', nonstock='$data->nonstock', costing_type='$data->costing_type', inventory_acccode='$data->inventory_acccode', cogs_acccode='$data->cogs_acccode', goodintransit_acccode='$data->goodintransit_acccode', purchase_discount_acccode='$data->purchase_discount_acccode', workinprocess_acccode='$data->workinprocess_acccode', consignment_acccode='$data->consignment_acccode', location_id='$data->location_id', active='$data->active', uid='$data->uid', dlu='$data->dlu' where id='$data->id'";
			}
			
			if($adt_status == "delete") {
				$values2 = $values2."~\n". $itemdata . "|" . $adt_status . "|" . "delete from item_group where id='$data->id'";
			}
			
		}		
		
		/*update adt_item_group (tanda sudah didownload)*/
		$qupdate = "update adt_item_group set status_download=concat(ifnull(status_download,'')," . "'^" . $whscode . "') where id ='$itemdata' and sysid='$data->sysid' ";
		$sql=$dbpdo->prepare($qupdate);
		$sql->execute();
		/*-----------------------/\---------------*/
					
	}
	
	$datacreate = "data_item_group_".$location_id;
	$kirim=fopen("data_upload/" . $datacreate . ".txt","w");
	fputs($kirim, "$values2");
	fclose($kirim);
	
	
?>