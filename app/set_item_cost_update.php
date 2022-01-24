<!--Start Set Item Price-->
<?php
	
	$sql=$select->list_set_item_cost_last($location_id, $ref);
	$row_item_cost=$sql->fetch(PDO::FETCH_OBJ);
	
	$location_id_cost	=	$row_item_cost->location_id;
	$date_cost			=	date("d-m-Y", strtotime($row_item_cost->date));
	if($date_cost == "01-01-1970") {
		$date_cost	=	date("d-m-Y");
	}
	
	$efective_from_cost	=	date("d-m-Y", strtotime($row_item_cost->efective_from));
	if($efective_from_cost == "01-01-1970") {
		$efective_from_cost	=	date("d-m-Y", strtotime($date_cost));
	}
	$current_cost	=	number_format($row_item_cost->current_cost,2,".",",");
	
	$old_date_of_record = date("Y-m-d H:i:s", strtotime($row_item_cost->date_of_record));
	
?>

<input type="hidden" id="old_date_cost" name="old_date_cost" value="<?php echo $row_item_cost->date_of_record ?>">
	
<table border="0" width="100%" cellpadding="5">
	<tr>
		<td colspan="3" style="color: #1626e9; font-weight: bold; font-size: 14px">Setup Harga Pembelian</td>
	</tr>
	
	<tr>
	
		<input type="hidden" id="old_date_of_record" name="old_date_of_record" value="<?php echo $old_date_of_record ?>">
		
		<td width="20%">
			<label for="form-field-1" style="margin-left: 50px"><?php if($lng==1) { echo 'Location'; } else { echo 'Cabang/Lokasi'; } ?> </label>
		</td>
		<td>:</td>
		<td>
			<div class="col-sm-3">
				<select id="location_id_cost" name="location_id_cost" class="chosen-select form-control"  style="width: 100px">
	                <option value=""></option>
	                <?php 
	                	combo_select_active("warehouse","id","name","active","1",$location_id_cost);
	                ?>	
                                          
              	</select>
            </div>
		</td>
	</tr>
	
	<tr>
		<td width="20%">
			<label for="form-field-1" style="margin-left: 50px"><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?> *)</label>
		</td>
		<td>:</td>
		<td>
			<div class="col-sm-3">
				<input type="text" id="date_cost" name="date_cost" style="font-size: 12px; width: 100px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $date_cost ?>">
			</div>
		</td>
	</tr>
	
	<tr>
		<td width="20%">
			<label for="form-field-1" style="margin-left: 50px"><?php if($lng==1) { echo 'Efective Date'; } else { echo 'Tanggal Efektif'; } ?> *)</label>
		</td>
		<td>:</td>
		<td>
			<div class="col-sm-3">
				<input type="text" id="efective_from_cost" name="efective_from_cost" style="font-size: 12px; width: 100px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $efective_from_cost ?>">
			</div>
		</td>
	</tr>
	
	<tr>
		<td>
			<label for="form-field-1" style="margin-left: 50px">Harga Satuan</label>
		</td>
		<td>:</td>
		<td>					
			<div class="col-sm-3">					
				<input type="text" id="current_cost" name="current_cost" onkeyup="formatangka('current_cost')" style="text-align: right; width: 90px" value="<?php echo $current_cost ?>">
			</div>
		</td>
		
	</tr>
</table>
<!--End Set Item Price-->