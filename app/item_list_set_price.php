<!--Start Set Item Price-->
<?php
	
	//$sql=$select->list_set_item_price_last($location_id, $code);
	//$row_item_price=$sql->fetch(PDO::FETCH_OBJ);
	
	$location_id	=	$dataitem->location_id;
	$date			=	date("d-m-Y", strtotime($dataitem->date));
	if($date == "01-01-1970") {
		$date	=	"";
	}
	$efective_from	=	date("d-m-Y", strtotime($dataitem->efective_from));
	if($efective_from == "01-01-1970") {
		$efective_from	=	"";
	}
	$qty1			=	number_format($dataitem->qty1,2,".",",");
	$qty2			=	number_format($dataitem->qty2,2,".",",");
	$qty3			=	number_format($dataitem->qty3,2,".",",");
	$qty4			=	number_format($dataitem->qty4,2,".",",");
	$current_price	=	number_format($dataitem->current_price,2,".",",");
	$current_price1	=	number_format($dataitem->current_price1,2,".",",");
	$current_price2	=	number_format($dataitem->current_price2,2,".",",");
	$current_price3	=	number_format($dataitem->current_price3,2,".",",");
	
	/*if($row_item_cost->current_cost > 0) {
		$current_price_persen  = (($row_item_price->current_price - $row_item_cost->current_cost)/$row_item_cost->current_cost) * 100;
		if($current_price_persen < 0) { $current_price_persen = 0; }
		
		$current_price1_persen  = (($row_item_price->current_price1 - $row_item_cost->current_cost)/$row_item_cost->current_cost) * 100;
		if($current_price1_persen < 0) { $current_price1_persen = 0; }
		
		$current_price2_persen  = (($row_item_price->current_price2 - $row_item_cost->current_cost)/$row_item_cost->current_cost) * 100;
		if($current_price2_persen < 0) { $current_price2_persen = 0; }
		
		$current_price3_persen  = (($row_item_price->current_price3 - $row_item_cost->current_cost)/$row_item_cost->current_cost) * 100;
		if($current_price3_persen < 0) { $current_price3_persen = 0; }
	}*/
	
	$old_date_of_record1 = date("Y-m-d H:i:s", strtotime($row_item_price->date_of_record));
	
?>
	
<table border="0" width="100%" cellpadding="5">
	
	<tr>
		<td colspan="3" style="color: #1626e9; font-weight: bold; font-size: 14px">Setup Harga Penjualan</td>
	</tr>	
	<tr>
		<input type="hidden" id="old_date_of_record1" name="old_date_of_record1" value="<?php echo $old_date_of_record1 ?>">
		
		<td width="20%">
			<label for="form-field-1" style="margin-left: 50px"><?php if($lng==1) { echo 'Location'; } else { echo 'Cabang/Lokasi'; } ?> </label>
		</td>
		<td>&nbsp;</td>
		<td>
			<div class="col-sm-3">
				<select id="location_id" name="location_id" class="chosen-select form-control"  style="width: 200px">
	                <option value=""></option>
	                <?php 
	                	combo_select_active("warehouse","id","name","active","1",$location_id);
	                ?>	
                                          
              	</select>
            </div>
		</td>
	</tr>
	
	<tr>
		<td width="20%">
			<label for="form-field-1" style="margin-left: 50px"><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?> *)</label>
		</td>
		<td>&nbsp;</td>
		<td>
			<div class="col-sm-3">
				<input type="text" id="date" name="date" style="font-size: 12px; width: 100px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $date ?>">
			</div>
		</td>
	</tr>
	
	<tr>
		<td width="20%">
			<label for="form-field-1" style="margin-left: 50px"><?php if($lng==1) { echo 'Efective Date'; } else { echo 'Tanggal Efektif'; } ?> *)</label>
		</td>
		<td>&nbsp;</td>
		<td>
			<div class="col-sm-3">
				<input type="text" id="efective_from" name="efective_from" style="font-size: 12px; width: 100px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $efective_from ?>">
			</div>
		</td>
	</tr>
	
	<tr>
		<td>
			<label for="form-field-1" style="margin-left: 50px">Kelompok Qty</label>
		</td>
		<td>&nbsp;</td>
		<td>
			<div class="col-sm-2">										
				<input type="text" id="qty1" name="qty1" onkeyup="formatangka('qty1')" style="text-align: right; width: 90px" value="<?php echo $qty1 ?>">
				>=
			</div>
			
			<div class="col-sm-2">
				<input type="text" id="qty2" name="qty2" onkeyup="formatangka('qty2')" style="text-align: right; width: 90px" value="<?php echo $qty2 ?>">
				>=
			</div>
			
			<div class="col-sm-2">
				<input type="text" id="qty3" name="qty3" onkeyup="formatangka('qty2')" style="text-align: right; width: 90px" value="<?php echo $qty3 ?>">
				
			</div>
			
			<?php /*
			<div class="col-sm-2">
				<input type="text" id="qty4" name="qty4" onkeyup="formatangka('qty2')" style="text-align: right; width: 90px" value="<?php echo $qty4 ?>">
			</div>*/ ?>
		</td>
		
	</tr>
	
	<tr>
		<td>
			<label for="form-field-1" style="margin-left: 50px">Harga Satuan</label>
		</td>
		<td>&nbsp;</td>
		<td>				
			<div class="col-sm-2">						
				<input type="text" id="current_price" name="current_price" onkeyup="formatangka('current_price')" style="text-align: right; width: 90px" value="<?php echo $current_price ?>"><!--&nbsp;<?php echo number_format($current_price_persen,2,".",",") ?>%-->
			</div>
			
			<div class="col-sm-2">
				<input type="text" id="current_price1" name="current_price1" onkeyup="formatangka('current_price1')" style="text-align: right; width: 90px" value="<?php echo $current_price1 ?>"><!--&nbsp;<?php echo number_format($current_price1_persen,2,".",",") ?>%-->
			</div>
			
			<div class="col-sm-2">
				<input type="text" id="current_price2" name="current_price2" onkeyup="formatangka('current_price2')" style="text-align: right; width: 90px" value="<?php echo $current_price2 ?>"><!--&nbsp;<?php echo number_format($current_price2_persen,2,".",",") ?>%-->
			</div>
			
			<?php /*
			<div class="col-sm-2">
				<input type="text" id="current_price3" name="current_price3" onkeyup="formatangka('current_price3')" style="text-align: right; width: 90px" value="<?php echo $current_price3 ?>">&nbsp;<?php echo number_format($current_price3_persen,2,".",",") ?>%
			</div>*/ ?>
		</td>
		
	</tr>
</table>
<!--End Set Item Price-->