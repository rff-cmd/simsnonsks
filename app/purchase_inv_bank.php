<?php /*
<tr>
	<td colspan="5" rowspan="4" align="right" style="font-size: 14px; font-weight: bold;">BAYAR :&nbsp;</td>
	<td align="right" style="font-size: 14px; font-weight: bold;">Bank Name&nbsp;</td>
	<td colspan="2">
		<select id="bank_id" name="bank_id" data-placeholder="..." class="form-control chzn-select-deselect" style="max-width: 300px" >
			<option value=""></option>
			<?php 
				select_bank($row_purchase_inv->bank_id) 
			?>	                            
		</select>
	</td>
	<td align="right">
		<input type="text" id="bank_amount" name="bank_amount" style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('bank_amount'), sub_total('<?php echo $jmldata ?>')" value="<?php echo $bank_amount ?>" >
	</td>
</tr>

<tr>
	<td align="right" style="font-size: 14px; font-weight: bold;">Credit Card&nbsp;</td>
	<td colspan="2">
		<select id="credit_card_code" name="credit_card_code" data-placeholder="..." class="form-control chzn-select-deselect" style="max-width: 300px" >
			<option value=""></option>
			<?php 
				combo_select_active("credit_card_type","code","name","active","1",$row_purchase_inv->credit_card_code)
			?>	                            
		</select>
	</td>
	<td align="right">
		<input type="text" id="card_amount" name="card_amount" style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('card_amount'), sub_total('<?php echo $jmldata ?>')" value="<?php echo $card_amount ?>" >
	</td>
</tr>

<tr>
	<td align="right" style="font-size: 14px; font-weight: bold;">Credit Card Number&nbsp;</td>
	<td colspan="2">
		<input type="text" id="credit_card_no" name="credit_card_no" class="form-control" value="<?php echo $row_purchase_inv->credit_card_no ?>" >
	</td>
</tr>

<tr>
	<td align="right" style="font-size: 14px; font-weight: bold;">Credit Holder Name&nbsp;</td>
	<td colspan="2">
		<input type="text" id="credit_card_holder" name="credit_card_holder" class="form-control" value="<?php echo $row_purchase_inv->credit_card_holder ?>" >
	</td>
</tr> */ ?>


<input type="hidden" id="card_amount" name="card_amount" style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('card_amount'), sub_total('<?php echo $jmldata ?>')" value="<?php echo $card_amount ?>" />

<input type="hidden" id="bank_amount" name="bank_amount" style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('bank_amount'), sub_total('<?php echo $jmldata ?>')" value="<?php echo $bank_amount ?>" />