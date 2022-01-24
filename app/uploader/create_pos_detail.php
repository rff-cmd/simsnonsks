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
	$sql2 = "select a.ref, a.ref2, a.date, a.status, a.client_code, a.ship_to, a.bill_to, a.due_date, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.employee_id, a.memo, a.currency_code, a.rate, a.discount, a.total, a.top, a.opening_balance, a.location_id, a.cash, a.deposit, a.taxable, a.photo_file, a.cash_amount, a.bank_id, a.bank_amount, a.credit_card_code, a.card_amount, a.credit_card_no, a.credit_card_holder, a.change_amount, a.use_deposit, a.ref_rci, a.shift, a.client_member_code, a.printed, a.uid, a.dlu, a.adt_status, a.status_download, a.sysid from adt_sales_invoice a where ifnull(status_download,'') not like '%$whscode%' order by a.sysid";
	$sql2=$dbpdo->prepare($sql2);
	$sql2->execute();
	while ($data = $sql2->fetch(PDO::FETCH_OBJ)) { 
		$j++;
		
		$adt_status = $data->adt_status;
		
		if ($j == 1) {
			$itemdata = $data->ref;
			
			if($adt_status == "insert") {
				#detail-----------				
				$sqldet = "select a.ref, a.do_ref, a.so_ref, a.item_code, a.uom_code, a.qty, a.qty_rtn, a.qty_shp, a.unit_price, a.discount, a.discount3, a.amount, a.unit_price2, a.amount2, a.dummy, a.non_discount, a.line_item_do, a.line_item_so, a.line from sales_invoice_detail a where a.ref='$itemdata'";
				$sql3=$dbpdo->prepare($sqldet);
				$sql3->execute();
				while ($datadet = $sql3->fetch(PDO::FETCH_OBJ)) { 
					$x++;
					
					$line = $datadet->line;
					
					if ($x == 1) {
						$values_detail = $itemdata. "|" . $line . "|" . $adt_status . "|" . "insert into sales_invoice_detail(ref, do_ref, so_ref, item_code, uom_code, qty, qty_rtn, qty_shp, unit_price, discount, discount3, amount, unit_price2, amount2, dummy, non_discount, line_item_do, line_item_so, line) values ('$datadet->ref', '$datadet->do_ref', '$datadet->so_ref', '$datadet->item_code', '$datadet->uom_code', '$datadet->qty', '$datadet->qty_rtn', '$datadet->qty_shp', '$datadet->unit_price', '$datadet->discount', '$datadet->discount3', '$datadet->amount', '$datadet->unit_price2', '$datadet->amount2', '$datadet->dummy', '$datadet->non_discount', '$datadet->line_item_do', '$datadet->line_item_so', '$datadet->line')";
					} else {
						$values_detail = $values_detail."~\n". $itemdata . "|" . $line . "|" . $adt_status . "|" . "insert into sales_invoice_detail(ref, do_ref, so_ref, item_code, uom_code, qty, qty_rtn, qty_shp, unit_price, discount, discount3, amount, unit_price2, amount2, dummy, non_discount, line_item_do, line_item_so, line) values ('$datadet->ref', '$datadet->do_ref', '$datadet->so_ref', '$datadet->item_code', '$datadet->uom_code', '$datadet->qty', '$datadet->qty_rtn', '$datadet->qty_shp', '$datadet->unit_price', '$datadet->discount', '$datadet->discount3', '$datadet->amount', '$datadet->unit_price2', '$datadet->amount2', '$datadet->dummy', '$datadet->non_discount', '$datadet->line_item_do', '$datadet->line_item_so', '$datadet->line')";
					}
					
				}
				/*------/\---------*/
				
			}
			
			if($adt_status == "update") {
				#detail-----------
				$sqldet = "select a.ref, a.do_ref, a.so_ref, a.item_code, a.uom_code, a.qty, a.qty_rtn, a.qty_shp, a.unit_price, a.discount, a.discount3, a.amount, a.unit_price2, a.amount2, a.dummy, a.non_discount, a.line_item_do, a.line_item_so, a.line from sales_invoice_detail a where a.ref='$itemdata'";
				$sql4=$dbpdo->prepare($sqldet);
				$sql4->execute();
				while ($datadet = $sql4->fetch(PDO::FETCH_OBJ)) { 
					$x++;
					
					$line = $datadet->line;
					
					if ($x == 1) {
						$values_detail = $itemdata. "|" . $line . "|" . $adt_status . "|" . "update sales_invoice_detail set do_ref='$datadet->do_ref', so_ref='$datadet->so_ref', item_code='$datadet->item_code', uom_code='$datadet->uom_code', qty='$datadet->qty', qty_rtn='$datadet->qty_rtn', qty_shp='$datadet->qty_shp', unit_price='$datadet->unit_price', discount='$datadet->discount', discount3='$datadet->discount3', amount='$datadet->amount', unit_price2='$datadet->unit_price2', amount2='$datadet->amount2', dummy='$datadet->dummy', non_discount='$datadet->non_discount', line_item_do='$datadet->line_item_do', line_item_so='$datadet->line_item_so' where ref='$datadet->ref' and line='$datadet->line'";
					} else {
						$values_detail = $values_detail."~\n". $itemdata . "|" . $line . "|" . $adt_status . "|" . "update sales_invoice_detail set do_ref='$datadet->do_ref', so_ref='$datadet->so_ref', item_code='$datadet->item_code', uom_code='$datadet->uom_code', qty='$datadet->qty', qty_rtn='$datadet->qty_rtn', qty_shp='$datadet->qty_shp', unit_price='$datadet->unit_price', discount='$datadet->discount', discount3='$datadet->discount3', amount='$datadet->amount', unit_price2='$datadet->unit_price2', amount2='$datadet->amount2', dummy='$datadet->dummy', non_discount='$datadet->non_discount', line_item_do='$datadet->line_item_do', line_item_so='$datadet->line_item_so' where ref='$datadet->ref' and line='$datadet->line'";
					}
					
				}
				/*------/\---------*/
			}
			
			if($adt_status == "delete") {
				#detail
				$values_detail = $itemdata. "|" . $line . "|" . $adt_status . "|" . "delete from sales_invoice_detail where ref='$data->ref'";
			}
			
		} else {
			$itemdata = $data->ref;
			
			if($adt_status == "insert") {
				#detail-----------				
				$sqldet = "select a.ref, a.do_ref, a.so_ref, a.item_code, a.uom_code, a.qty, a.qty_rtn, a.qty_shp, a.unit_price, a.discount, a.discount3, a.amount, a.unit_price2, a.amount2, a.dummy, a.non_discount, a.line_item_do, a.line_item_so, a.line from sales_invoice_detail a where a.ref='$itemdata'";
				$sql5=$dbpdo->prepare($sqldet);
				$sql5->execute();
				while ($datadet = $sql5->fetch(PDO::FETCH_OBJ)) { 
					$x++;
					
					$line = $datadet->line;
					
					if ($x == 1) {
						$values_detail = $itemdata. "|" . $line . "|" . $adt_status . "|" . "insert into sales_invoice_detail(ref, do_ref, so_ref, item_code, uom_code, qty, qty_rtn, qty_shp, unit_price, discount, discount3, amount, unit_price2, amount2, dummy, non_discount, line_item_do, line_item_so, line) values ('$datadet->ref', '$datadet->do_ref', '$datadet->so_ref', '$datadet->item_code', '$datadet->uom_code', '$datadet->qty', '$datadet->qty_rtn', '$datadet->qty_shp', '$datadet->unit_price', '$datadet->discount', '$datadet->discount3', '$datadet->amount', '$datadet->unit_price2', '$datadet->amount2', '$datadet->dummy', '$datadet->non_discount', '$datadet->line_item_do', '$datadet->line_item_so', '$datadet->line')";
					} else {
						$values_detail = $values_detail."~\n". $itemdata . "|" . $line . "|" . $adt_status . "|" . "insert into sales_invoice_detail(ref, do_ref, so_ref, item_code, uom_code, qty, qty_rtn, qty_shp, unit_price, discount, discount3, amount, unit_price2, amount2, dummy, non_discount, line_item_do, line_item_so, line) values ('$datadet->ref', '$datadet->do_ref', '$datadet->so_ref', '$datadet->item_code', '$datadet->uom_code', '$datadet->qty', '$datadet->qty_rtn', '$datadet->qty_shp', '$datadet->unit_price', '$datadet->discount', '$datadet->discount3', '$datadet->amount', '$datadet->unit_price2', '$datadet->amount2', '$datadet->dummy', '$datadet->non_discount', '$datadet->line_item_do', '$datadet->line_item_so', '$datadet->line')";
					}
					
				}
				/*------/\---------*/
			}
			
			if($adt_status == "update") {
				#detail-----------
				$sqldet = "select a.ref, a.do_ref, a.so_ref, a.item_code, a.uom_code, a.qty, a.qty_rtn, a.qty_shp, a.unit_price, a.discount, a.discount3, a.amount, a.unit_price2, a.amount2, a.dummy, a.non_discount, a.line_item_do, a.line_item_so, a.line from sales_invoice_detail a where a.ref='$itemdata'";
				$sql6=$dbpdo->prepare($sqldet);
				$sql6->execute();
				while ($datadet = $sql6->fetch(PDO::FETCH_OBJ)) { 
					$x++;
					
					$line = $datadet->line;
					
					if ($x == 1) {
						$values_detail = $itemdata. "|" . $line . "|" . $adt_status . "|" . "update sales_invoice_detail set do_ref='$datadet->do_ref', so_ref='$datadet->so_ref', item_code='$datadet->item_code', uom_code='$datadet->uom_code', qty='$datadet->qty', qty_rtn='$datadet->qty_rtn', qty_shp='$datadet->qty_shp', unit_price='$datadet->unit_price', discount='$datadet->discount', discount3='$datadet->discount3', amount='$datadet->amount', unit_price2='$datadet->unit_price2', amount2='$datadet->amount2', dummy='$datadet->dummy', non_discount='$datadet->non_discount', line_item_do='$datadet->line_item_do', line_item_so='$datadet->line_item_so' where ref='$datadet->ref' and line='$datadet->line'";
					} else {
						$values_detail = $values_detail."~\n". $itemdata . "|" . $line . "|" . $adt_status . "|" . "update sales_invoice_detail set do_ref='$datadet->do_ref', so_ref='$datadet->so_ref', item_code='$datadet->item_code', uom_code='$datadet->uom_code', qty='$datadet->qty', qty_rtn='$datadet->qty_rtn', qty_shp='$datadet->qty_shp', unit_price='$datadet->unit_price', discount='$datadet->discount', discount3='$datadet->discount3', amount='$datadet->amount', unit_price2='$datadet->unit_price2', amount2='$datadet->amount2', dummy='$datadet->dummy', non_discount='$datadet->non_discount', line_item_do='$datadet->line_item_do', line_item_so='$datadet->line_item_so' where ref='$datadet->ref' and line='$datadet->line'";
					}
					
				}
				/*------/\---------*/
				
			}
			
			if($adt_status == "delete") {
				#detail
				$values_detail = $values_detail."~\n". $itemdata . "|" . $line . "|" . $adt_status . "|" . "delete from sales_invoice_detail where ref='$data->ref'";
			}
			
		}		
		
		/*update adt_sales_invoice (tanda sudah didownload)*/
		$qupdate = "update adt_sales_invoice set status_download=concat(ifnull(status_download,'')," . "'^" . $whscode . "') where ref ='$itemdata' and sysid='$data->sysid' ";
		$sql7=$dbpdo->prepare($qupdate);
		$sql7->execute();
		/*-----------------------/\---------------*/
					
	}
	
	$datacreate = "data_pos_detail_".$location_id;
	$kirim=fopen("data_upload/" . $datacreate . ".txt","w");
	fputs($kirim, "$values_detail");
	fclose($kirim);
	
	
?>