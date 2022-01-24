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
	$sql2 = "select a.ref, a.ref2, a.date, a.status, a.client_code, a.ship_to, a.bill_to, a.due_date, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.employee_id, a.memo, a.currency_code, a.rate, a.discount, a.total, a.top, a.opening_balance, a.location_id, a.cash, a.deposit, a.taxable, a.photo_file, a.cash_amount, a.cash_voucher, a.bank_id, a.bank_amount, a.credit_card_code, a.card_amount, a.credit_card_no, a.credit_card_holder, a.change_amount, a.use_deposit, a.ref_rci, a.shift, a.client_member_code, a.printed, a.uid, a.dlu, a.adt_status, a.status_download, a.sysid from adt_sales_invoice a where ifnull(status_download,'') not like '%$whscode%' order by a.sysid";
	$sql2=$dbpdo->prepare($sql2);
	$sql2->execute();
	while ($data = $sql2->fetch(PDO::FETCH_OBJ)) { 
		$j++;
		
		$adt_status = $data->adt_status;
		
		if ($j == 1) {
			$itemdata = $data->ref;
			
			if($adt_status == "insert") {
				$values2 = $itemdata. "|" . $adt_status . "|" . "insert into sales_invoice (ref, ref2, date, status, top, due_date, client_code, ship_to, bill_to, tax_code, tax_rate, freight_cost, freight_account, currency_code, rate, employee_id, total, memo, opening_balance, cash, location_id, deposit, taxable, photo_file, cash_amount, cash_voucher, bank_id, bank_amount, credit_card_code, card_amount, credit_card_no, credit_card_holder, change_amount, shift, client_member_code, uid, dlu) values('$data->ref', '$data->ref2', '$data->date', '$data->status', '$data->top', '$data->due_date', '$data->client_code', '$data->ship_to', '$data->bill_to', '$data->tax_code', '$data->tax_rate', '$data->freight_cost', '$data->freight_account', '$data->currency_code', '$data->rate', '$data->employee_id', '$data->total', '$data->memo', 0, '$data->cash', '$data->location_id', '$data->deposit', '$data->taxable', '$data->photo_file', '$data->cash_amount', '$data->cash_voucher', '$data->bank_id', '$data->bank_amount', '$data->credit_card_code', '$data->card_amount', '$data->credit_card_no', '$data->credit_card_holder', '$data->change_amount', '$data->shift', '$data->client_member_code', '$data->uid', '$data->dlu')";
				
			}
			
			if($adt_status == "update") {
				$values2 = $itemdata. "|" . $adt_status . "|" . "update sales_invoice set ref2='$data->ref2', date='$data->date', client_code='$data->client_code', top='$data->top', due_date='$data->due_date', ship_to='$data->ship_to', bill_to='$data->bill_to', taxable='$data->taxable', tax_code='$data->tax_code', tax_rate='$data->tax_rate', freight_cost='$data->freight_cost', freight_account='$data->freight_account', currency_code='$data->currency_code', rate='$data->rate', employee_id='$data->employee_id', total='$data->total', memo='$data->memo', location_id='$data->location_id', deposit='$data->deposit', photo_file='$data->photo_file', cash_amount='$data->cash_amount', cash_voucher='$data->cash_voucher', bank_id='$data->bank_id', bank_amount='$data->bank_amount', credit_card_code='$data->credit_card_code', card_amount='$data->card_amount', credit_card_no='$data->credit_card_no', credit_card_holder='$data->credit_card_holder', change_amount='$data->change_amount', shift='$data->shift', client_member_code='$data->client_member_code', uid='$data->uid', dlu='$data->dlu' where ref='$data->ref'";
			}
			
			if($adt_status == "delete") {
				$values2 = $itemdata. "|" . $adt_status . "|" . "delete from sales_invoice where ref='$data->ref'";
			}
			
		} else {
			$itemdata = $data->ref;
			
			if($adt_status == "insert") {
				$values2 = $values2."~\n". $itemdata . "|" . $adt_status . "|" . "insert into sales_invoice (ref, ref2, date, status, top, due_date, client_code, ship_to, bill_to, tax_code, tax_rate, freight_cost, freight_account, currency_code, rate, employee_id, total, memo, opening_balance, cash, location_id, deposit, taxable, photo_file, cash_amount, cash_voucher, bank_id, bank_amount, credit_card_code, card_amount, credit_card_no, credit_card_holder, change_amount, shift, client_member_code, uid, dlu) values('$data->ref', '$data->ref2', '$data->date', '$data->status', '$data->top', '$data->due_date', '$data->client_code', '$data->ship_to', '$data->bill_to', '$data->tax_code', '$data->tax_rate', '$data->freight_cost', '$data->freight_account', '$data->currency_code', '$data->rate', '$data->employee_id', '$data->total', '$data->memo', 0, '$data->cash', '$data->location_id', '$data->deposit', '$data->taxable', '$data->photo_file', '$data->cash_amount', '$data->cash_voucher', '$data->bank_id', '$data->bank_amount', '$data->credit_card_code', '$data->card_amount', '$data->credit_card_no', '$data->credit_card_holder', '$data->change_amount', '$data->shift', '$data->client_member_code', '$data->uid', '$data->dlu')";
			}
			
			if($adt_status == "update") {
				$values2 = $values2."~\n". $itemdata . "|" . $adt_status . "|" . "update sales_invoice set ref2='$data->ref2', date='$data->date', client_code='$data->client_code', top='$data->top', due_date='$data->due_date', ship_to='$data->ship_to', bill_to='$data->bill_to', taxable='$data->taxable', tax_code='$data->tax_code', tax_rate='$data->tax_rate', freight_cost='$data->freight_cost', freight_account='$data->freight_account', currency_code='$data->currency_code', rate='$data->rate', employee_id='$data->employee_id', total='$data->total', memo='$data->memo', location_id='$data->location_id', deposit='$data->deposit', photo_file='$data->photo_file', cash_amount='$data->cash_amount', cash_voucher='$data->cash_voucher', bank_id='$data->bank_id', bank_amount='$data->bank_amount', credit_card_code='$data->credit_card_code', card_amount='$data->card_amount', credit_card_no='$data->credit_card_no', credit_card_holder='$data->credit_card_holder', change_amount='$data->change_amount', shift='$data->shift', client_member_code='$data->client_member_code', uid='$data->uid', dlu='$data->dlu' where ref='$data->ref'";
			}
			
			if($adt_status == "delete") {
				$values2 = $values2."~\n". $itemdata . "|" . $adt_status . "|" . "delete from sales_invoice where ref='$data->ref'";
			}
			
		}		
		
		/*update adt_sales_invoice (tanda sudah didownload)*/
		$qupdate = "update adt_sales_invoice set status_download=concat(ifnull(status_download,'')," . "'^" . $whscode . "') where ref ='$itemdata' and sysid='$data->sysid' ";
		$sql=$dbpdo->prepare($qupdate);
		$sql->execute();
		/*-----------------------/\---------------*/
					
	}
	
	$datacreate = "data_pos_".$location_id;
	$kirim=fopen("data_upload/" . $datacreate . ".txt","w");
	fputs($kirim, "$values2");
	fclose($kirim);
	
	
	
?>
