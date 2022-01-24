<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");
include_once ("../app/class/class.selectview.php");

$pilih = $_POST["button"];
$selectview = new selectview;

switch ($pilih){
	case "getdata":
		$dbpdo = DB::create();
		
		$kode 			= $_POST['item_code2'];	
		$location_id	= $_POST['location_id'];
		$location_id2	= $_POST['location_id2'];
		if($location_id2 == "") {
			$location_id2 = $location_id;
		}
		
		$no = $kodex;
		$sqlstr 	= "select syscode, uom_code_purchase uom_code from item where (code='$kode' or old_code='$kode') limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 	= $sql->fetch(PDO::FETCH_OBJ); 
		
		$item_code 	= $data->syscode;
		$uom_code	= $data->uom_code;
		
		/*$sqlcost = "select b.current_cost, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' order by b.date_of_record desc limit 1 ";
		$sql=$dbpdo->prepare($sqlcost);
		$sql->execute();
		$datacost 	= $sql->fetch(PDO::FETCH_OBJ);*/ 
		
		$current_cost 	= $selectview->list_purchase_invoice_last_cost($item_code, $uom_code);
		//$current_cost	= number_format($current_cost,2,".",",");
		$item_name		= ""; //$datacost->name;
		//$non_discount	= $datacost->non_discount;
		
		/*$amount			= numberreplace($current_cost) * 1;
		$amount			= number_format($amount,2,".",",");*/
		
		if($item_name == "") {
			$sqlcost = "select a.name from item a where a.syscode='$item_code' ";
			$sql=$dbpdo->prepare($sqlcost);
			$sql->execute();
			$datacost 	= $sql->fetch(PDO::FETCH_OBJ); 
			
			$item_name		= $datacost->name;
		}
		
		//get discount terakhir dr pembelian
		$discount1 = 0;
		$discount = 0;
		$sqldisc = $selectview->list_purchase_invoice_last_discount($item_code, $uom_code);
		$datadisc = $sqldisc->fetch(PDO::FETCH_OBJ); 
		$discount1 = $datadisc->discount1;
		$discount = $datadisc->discount;
		
		$amount			= (numberreplace($current_cost) * 1) - $discount;
		$amount			= number_format($amount,2,".",",");
		$current_cost	= number_format($current_cost,2,".",",");
		
		$discount1			= number_format($discount1,2,".",",");
		$discount			= number_format($discount,2,".",",");
		
		
?>		
		<!--<tr style="background-color:ffffff;" id="item_ajax2_<?php echo $no; ?>" > -->
		
			<!--
			<td>
				<select id="item_code" name="item_code" data-placeholder="..." class="form-control chzn-select-deselect" style="width: auto; font-size: 11px" onchange="loadHTMLPost3('app/purchase_inv_invoice_detail_ajax.php','item_ajax','getdata','item_code',<?php echo $no; ?>)" >
					<option value=""></option>
					<?php 
						select_item($item_code)
					?>	

				</select>	
			</td>-->
			
			<input type="hidden" id="item_code" name="item_code" style="font-size: 11px; width: 100px" class="form-control" onKeyPress="return focusNext('submit_det',event)" value="<?php echo $item_code ?>" />			
			<input type="hidden" id="non_discount" name="non_discount" value="<?php echo $non_discount; ?>" />
			<input type="hidden" id="location_id2" name="location_id2" value="<?php echo $location_id2; ?>" />
			<!--<input type="hidden" id="discount3_1_det" name="discount3_1_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_1_det'), detailvalue2('persen')" value="" />-->
    		<input type="hidden" id="discount3_2_det" name="discount3_2_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_2_det'), detailvalue2('persen')" value="" />
    		<input type="hidden" id="discount3_3_det" name="discount3_3_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_3_det'), detailvalue2('persen')" value="" />
    		<!--<input type="hidden" id="discount_det" name="discount_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" readonly="" value="" />-->
			
			
			
			
			<input type="text" id="item_code2" name="item_code2" style="width: 150px" onKeyPress="return focusNext('submit_det',event)" onchange="loadHTMLPost3('app/purchase_inv_detail_ajax.php','item_ajax','getdata','item_code2','location_id2')" value="<?php echo $kode ?>" >
		
			<input type="text" id="item_name" name="item_name" readonly="" style="width: auto; min-width: 300px" value="<?php echo $item_name ?>" >
		
			<select id="uom_code" name="uom_code" style="height: 35px; width: auto;">
				<option value=""></option>
				<?php 
					select_uom($uom_code) 
				?>
			</select>
			
			<input type="text" id="size" name="size" style="text-align: right; font-size: 11px; width: 60px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('size')" value="" >
			
			<?php /*
			<input type="hidden" id="unit_cost" name="unit_cost" style="text-align: right; font-size: 11px; width: 100px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('unit_cost'), detailvalue2('persen')" value="<?php echo $current_cost ?>" >		
			
			<input type="hidden" id="discount3_1_det" name="discount3_1_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_1_det'), detailvalue2('persen')" value="<?php echo $discount1 ?>" >
			
			<input type="hidden" id="discount_det" name="discount_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount_det'), detailvalue2('nominal')" value="<?php echo $discount ?>" >
			
			<input type="hidden" id="amount" name="amount" readonly="" style="text-align: right; font-size: 11px; width: 100px" class="form-control" onkeyup="formatangka('amount')" value="<?php echo $amount ?>" >
			*/ ?>
			
			<?php /*
				<input type="text" id="qty" name="qty" style="text-align: right; font-size: 11px; width: 60px" class="form-control" autofocus="" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('qty'), detailvalue2('persen')" value="1" >
			
				<input type="text" id="unit_cost" name="unit_cost" style="text-align: right; font-size: 11px; width: 100px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('unit_cost'), detailvalue2('persen')" value="<?php echo $current_cost ?>" >
			
            
            <td align="center" id="discount3_1_det_id">
    			<input type="text" id="discount3_1_det" name="discount3_1_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_1_det'), detailvalue2('persen')" value="<?php echo $discount1 ?>" >
    		</td>
    		
            <td align="center" id="discount_det_id">
            	<!--<input type="text" id="discount_det" name="discount_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" readonly="" value="" >-->
				<input type="text" id="discount_det" name="discount_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount_det'), detailvalue2('nominal')" value="<?php echo $discount ?>" >
			</td>
			
			<td align="center" id="amount_det">
				<input type="text" id="amount" name="amount" readonly="" style="text-align: right; font-size: 11px; width: 100px" class="form-control" onkeyup="formatangka('amount')" value="<?php echo $amount ?>" >
			</td>
			
			<td>
				&nbsp;<input type="submit" id="submit_det" name="submit" class="btn btn-metis-2 btn-sm" value="Save Detail">
			</td>
			*/ ?>
		
		<!--</tr>-->
<?php
		
		break;	
		
	
	case "getdata2": //enter
		$dbpdo = DB::create();
		
		$kode 			= $_POST['item_code'];	
		$location_id	= $_POST['location_id'];
		
		$no = $kodex;
		$sqlstr = "select code, syscode, uom_code_sales uom_code from item where syscode='$kode' limit 1";
		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 	= $sql->fetch(PDO::FETCH_OBJ); 
		
		$item_code 	= $kode; //$data->syscode;
		$item_code2 = $data->code;
		$uom_code	= $data->uom_code;
		
		/*$sqlcost = "select b.current_cost, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' order by b.date_of_record desc limit 1 "; //and location_id='$location_id' 
		$sql=$dbpdo->prepare($sqlcost);
		$sql->execute();
		$datacost 	= $sql->fetch(PDO::FETCH_OBJ);*/
		
		$current_cost 	= $selectview->list_purchase_invoice_last_cost($item_code, $uom_code);
		$current_cost	= number_format($current_cost,2,".",",");
		$item_name		= ""; //$datacost->name;
		//$non_discount	= $datacost->non_discount;
		
		$amount			= numberreplace($current_cost) * 1;
		$amount			= number_format($amount,2,".",",");
		
		if($item_name == "") {
			$sqlcost = "select a.name from item a where a.syscode='$item_code' ";
			$sql=$dbpdo->prepare($sqlcost);
			$sql->execute();
			$datacost 	= $sql->fetch(PDO::FETCH_OBJ);
			
			$item_name		= $datacost->name;
		}
		
?>		
			<input type="hidden" id="item_code" name="item_code" style="font-size: 11px; width: 60px" class="form-control" onKeyPress="return focusNext('submit_det',event)" value="<?php echo $item_code ?>" />			
			<input type="hidden" id="non_discount" name="non_discount" value="<?php echo $non_discount; ?>" />
			<!--<input type="hidden" id="discount3_1_det" name="discount3_1_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_1_det'), detailvalue2('persen')" value="" />-->
    		<input type="hidden" id="discount3_2_det" name="discount3_2_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_2_det'), detailvalue2('persen')" value="" />    		
    		<input type="hidden" id="discount3_3_det" name="discount3_3_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_3_det'), detailvalue2('persen')" value="" />    		
    		<!--<input type="hidden" id="discount_det" name="discount_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" readonly="" value="" />-->
    			
			
			<td align="left">
				<input type="text" id="item_code2" name="item_code2" style="font-size: 11px; width: 100px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onchange="loadHTMLPost2('app/purchase_inv_detail_ajax.php','item_ajax','getdata','item_code2')" value="<?php echo $item_code2 ?>" >
			</td>
			
			<td align="left">
				<input type="text" id="item_name" name="item_name" readonly="" style="font-size: 11px; width: auto; min-width: 200px" class="form-control" value="<?php echo $item_name ?>" >
			</td>
			
			<td>
				<select id="uom_code" name="uom_code" class="form-control" style="height: 35px; width: auto; font-size: 11px">
					<option value=""></option>
					<?php 
						select_uom($uom_code) 
					?>
				</select>	
			</td>
			
			<!--<td>
				<input type="text" id="size" name="size" style="text-align: right; font-size: 11px; width: 60px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('size')" value="" >
			</td>-->
			<td align="center">
				<input type="text" id="qty" name="qty" style="text-align: right; font-size: 11px; width: 60px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('qty'), detailvalue2('persen')" value="1" >
			</td>
			<td align="center">
				<input type="text" id="unit_cost" name="unit_cost" style="text-align: right; font-size: 11px; width: 100px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('unit_cost'), detailvalue2('persen')" value="<?php echo $current_cost ?>" >
			</td>
			
			<?php /*
            
    		
    		<td align="center" id="discount3_2_det_id">
    			<input type="text" id="discount3_2_det" name="discount3_2_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_2_det'), detailvalue2('persen')" value="" >
    		</td>
    		
    		<td align="center" id="discount3_3_det_id">
    			<input type="text" id="discount3_3_det" name="discount3_3_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_3_det'), detailvalue2('persen')" value="" >
    		</td>*/ ?>
    		
    		<td align="center" id="discount3_1_det_id">
    			<input type="text" id="discount3_1_det" name="discount3_1_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_1_det'), detailvalue2('persen')" value="" >
    		</td>
    		
    		<td align="center" id="discount_det_id">
    			<!--<input type="text" id="discount_det" name="discount_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" readonly="" value="" >-->
				<input type="text" id="discount_det" name="discount_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount_det'), detailvalue2('nominal')" value="" >
			</td>
            
			<td align="center" id="amount_det">
				<input type="text" id="amount" name="amount" readonly="" style="text-align: right; font-size: 11px; width: 100px" class="form-control" onkeyup="formatangka('amount')" value="<?php echo $amount ?>" >
			</td>
			
			<td>
				&nbsp;<input type="submit" id="submit_det" name="submit" class="btn btn-metis-2 btn-sm" value="Save Detail">
			</td>
		
		<!--</tr>-->
<?php
		
		break;
		
		
	case "getdata_det":
		$dbpdo = DB::create();
		
		$kode 			= $_POST['item_code3'];	
		$location_id	= $_POST['location_id'];
		$location_id2	= $_POST['location_id2'];
		if($location_id2 == "") {
			$location_id2 = $location_id;
		}
		
		$no = $kodex;
		$sqlstr 	= "select syscode, uom_code_purchase uom_code from item where (code='$kode' or old_code='$kode') limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 	= $sql->fetch(PDO::FETCH_OBJ); 
		
		$item_code 	= $data->syscode;
		$uom_code	= $data->uom_code;
		
		
		$current_cost 	= $selectview->list_purchase_invoice_last_cost($item_code, $uom_code);
		//$current_cost	= number_format($current_cost,2,".",",");
		$item_name		= ""; //$datacost->name;
		//$non_discount	= $datacost->non_discount;
		
		
		if($item_name == "") {
			$sqlcost = "select a.name from item a where a.syscode='$item_code' ";
			$sql=$dbpdo->prepare($sqlcost);
			$sql->execute();
			$datacost 	= $sql->fetch(PDO::FETCH_OBJ); 
			
			$item_name		= $datacost->name;
		}
		
		//get discount terakhir dr pembelian
		$discount1 = 0;
		$discount = 0;
		$sqldisc = $selectview->list_purchase_invoice_last_discount($item_code, $uom_code);
		$datadisc = $sqldisc->fetch(PDO::FETCH_OBJ); 
		$discount1 = $datadisc->discount1;
		$discount = $datadisc->discount;
		
		$amount			= (numberreplace($current_cost) * 1) - $discount;
		$amount			= number_format($amount,2,".",",");
		$current_cost	= number_format($current_cost,2,".",",");
		
		$discount1			= number_format($discount1,2,".",",");
		$discount			= number_format($discount,2,".",",");
		
		
?>		
		
			<input type="hidden" id="item_code" name="item_code" style="font-size: 11px; width: 100px" class="form-control" onKeyPress="return focusNext('submit_det',event)" value="<?php echo $item_code ?>" />			
			<input type="hidden" id="non_discount" name="non_discount" value="<?php echo $non_discount; ?>" />
			<input type="hidden" id="location_id2" name="location_id2" value="<?php echo $location_id2; ?>" />
			<!--<input type="hidden" id="discount3_1_det" name="discount3_1_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_1_det'), detailvalue2('persen')" value="" />-->
    		<input type="hidden" id="discount3_2_det" name="discount3_2_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_2_det'), detailvalue2('persen')" value="" />
    		<input type="hidden" id="discount3_3_det" name="discount3_3_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_3_det'), detailvalue2('persen')" value="" />
    		<!--<input type="hidden" id="discount_det" name="discount_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" readonly="" value="" />-->
			
			
			
			
			<input type="text" id="item_code3" name="item_code3" style="width: 150px" onKeyPress="return focusNext('submit_det',event)" onchange="loadHTMLPost3('app/purchase_inv_detail_ajax.php','item_ajax','getdata_det','item_code2','location_id2')" value="<?php echo $kode ?>" >
		
			<input type="text" id="item_name" name="item_name" readonly="" style="width: auto; min-width: 300px" value="<?php echo $item_name ?>" >
		
			<select id="uom_code" name="uom_code" style="height: 35px; width: auto;">
				<option value=""></option>
				<?php 
					select_uom($uom_code) 
				?>
			</select>
			
<?php
		
		break;	
		
	
	default:
}
?>