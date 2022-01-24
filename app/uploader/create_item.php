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
		$sql2 = "select a.code, a.old_code, a.name, a.item_group_id, a.item_subgroup_id, a.item_type_code, a.item_category_id, a.brand_id, a.size_id, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, a.minimum_stock, a.maximum_stock, a.photo, a.consigned, a.active, a.uid, a.dlu, a.syscode, a.adt_status, a.sysid from adt_item a order by a.sysid";
	} else {
		$sql2 = "select a.code, a.old_code, a.name, a.item_group_id, a.item_subgroup_id, a.item_type_code, a.item_category_id, a.brand_id, a.size_id, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, a.minimum_stock, a.maximum_stock, a.photo, a.consigned, a.active, a.uid, a.dlu, a.syscode, a.adt_status, a.sysid from adt_item a where ifnull(status_download,'') not like '%$whscode%' order by a.sysid";
	}
	
	$sql2=$dbpdo->prepare($sql2);
	$sql2->execute();
	while ($data = $sql2->fetch(PDO::FETCH_OBJ)) {
		$j++;
		
		$adt_status = $data->adt_status;
		
		$item_name = petikreplace($data->name);
		
		if ($j == 1) {
			$itemdata = $data->syscode;
			
			if($adt_status == "insert") {
				$values2 = $itemdata. "|" . $adt_status . "|" . "insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode) values ('$data->code', '$data->old_code', '$item_name', '$data->item_group_id', '$data->item_subgroup_id', '$data->item_type_code', '$data->item_category_id', '$data->brand_id', '$data->size_id', '$data->uom_code_stock', '$data->uom_code_sales', '$data->uom_code_purchase', '$data->minimum_stock', '$data->maximum_stock', '$data->photo', '$data->consigned', '$data->active', '$data->uid', '$data->dlu', '$data->syscode')";
			}
			
			if($adt_status == "update") {
				$values2 = $itemdata. "|" . $adt_status . "|" . "update item set code='$data->code', old_code='$data->old_code', name='$item_name', item_group_id='$data->item_group_id', item_subgroup_id='$data->item_subgroup_id', item_type_code='$data->item_type_code', item_category_id='$data->item_category_id', brand_id='$data->brand_id', size_id='$data->size_id', uom_code_stock='$data->uom_code_stock', uom_code_sales='$data->uom_code_sales', uom_code_purchase='$data->uom_code_purchase', minimum_stock='$data->minimum_stock', maximum_stock='$data->maximum_stock', photo='$data->photo', consigned='$data->consigned', active='$data->active', uid='$data->uid', dlu='$data->dlu' where syscode='$data->syscode'";
			}
			
			if($adt_status == "delete") {
				$values2 = $itemdata. "|" . $adt_status . "|" . "delete from item where syscode='$data->syscode'";
			}
			
		} else {
			$itemdata = $data->syscode;
			$item_name = petikreplace($data->name);
			
			if($adt_status == "insert") {
				$values2 = $values2."~\n". $itemdata . "|" . $adt_status . "|" . "insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode) values ('$data->code', '$data->old_code', '$item_name', '$data->item_group_id', '$data->item_subgroup_id', '$data->item_type_code', '$data->item_category_id', '$data->brand_id', '$data->size_id', '$data->uom_code_stock', '$data->uom_code_sales', '$data->uom_code_purchase', '$data->minimum_stock', '$data->maximum_stock', '$data->photo', '$data->consigned', '$data->active', '$data->uid', '$data->dlu', '$data->syscode')";
			}
			
			if($adt_status == "update") {
				$values2 = $values2."~\n". $itemdata . "|" . $adt_status . "|" . "update item set code='$data->code', old_code='$data->old_code', name='$item_name', item_group_id='$data->item_group_id', item_subgroup_id='$data->item_subgroup_id', item_type_code='$data->item_type_code', item_category_id='$data->item_category_id', brand_id='$data->brand_id', size_id='$data->size_id', uom_code_stock='$data->uom_code_stock', uom_code_sales='$data->uom_code_sales', uom_code_purchase='$data->uom_code_purchase', minimum_stock='$data->minimum_stock', maximum_stock='$data->maximum_stock', photo='$data->photo', consigned='$data->consigned', active='$data->active', uid='$data->uid', dlu='$data->dlu' where syscode='$data->syscode'";
			}
			
			if($adt_status == "delete") {
				$values2 = $values2."~\n". $itemdata . "|" . $adt_status . "|" . "delete from item where syscode='$data->syscode'";
			}
			
		}		
		
		/*update adt_item (tanda sudah didownload)*/
		$qupdate = "update adt_item set status_download=concat(ifnull(status_download,'')," . "'^" . $whscode . "') where syscode ='$itemdata' and sysid='$data->sysid' ";
		$sql=$dbpdo->prepare($qupdate);
		$sql->execute();
		/*-----------------------/\---------------*/
					
	}
	
	$datacreate = "data_item_".$location_id;
	$kirim=fopen("data_upload/" . $datacreate . ".txt","w");
	fputs($kirim, "$values2");
	fclose($kirim);
	
	
?>