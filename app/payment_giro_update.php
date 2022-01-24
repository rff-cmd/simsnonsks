<?php
	$sql=$select->list_payment_giro($ref);
	$jmldatabg = $sql->rowCount();
?>

<?php if($jmldatabg > 0) { ?>
	<table id="simple-table" class="table table-striped table-bordered table-hover" />
	<thead>
		<tr> 
			<th>Bank Account</th>
			<th>BG Number/No. Rekening</th>
			<th>Bank Name</th>
			<th>BG/Cheque Date (exp. 2017-12-01)</th>					
			<th>Amount</th>		
		</tr>
	</thead>
	<tbody>
		<?php 
				$nobg = 0;
				while($row_payment_giro=$sql->fetch(PDO::FETCH_OBJ)) {	
			?>
			
			<tr style="background-color:ffffff;"> 
				<td>
					<select id="account_code_<?php echo $nobg ?>" name="account_code_<?php echo $nobg ?>" data-placeholder="..." class="chosen-select form-control" style="width: auto; font-size: 10px">
						<option value=""></option>
						<?php 
							select_coa($row_payment_giro->account_code) 
						?>	                            
					</select>	
				</td>
				<td>
					<input type="text" id="cheque_no_<?php echo $nobg ?>" name="cheque_no_<?php echo $nobg ?>" class="form-control" value="<?php echo $row_payment_giro->cheque_no ?>">	
				</td>
				<td>
					<input type="text" id="bank_name_<?php echo $nobg ?>" name="bank_name_<?php echo $nobg ?>" class="form-control" value="<?php echo $row_payment_giro->bank_name ?>">	
				</td>
				<td align="center">
					<!--<input type="text" id="cheque_date_<?php echo $nobg ?>" name="cheque_date_<?php echo $nobg ?>" class="form-control" data-mask="99-99-9999" value="<?php echo $cheque_date ?>">-->
	                <input type="text" id="cheque_date_<?php echo $nobg ?>" name="cheque_date_<?php echo $nobg ?>" class="form-control" value="<?php echo $cheque_date ?>">
				</td>
	            <td>
					<input type="text" id="amountbg_<?php echo $nobg ?>" name="amountbg_<?php echo $nobg ?>" class="form-control" onkeyup="formatangka('amountbg_<?php echo $nobg; ?>'), detailvalue('<?php echo $nobg ?>', '<?php echo $jmldatabg ?>')" style="text-align: right" value="<?php echo $row_payment_giro->amountbg ?>">	
				</td>
	            
			</tr>
			
			<?php 
			
				$nobg++;
				
				} 
				
			?>
			
			<input type="hidden" id="jmldatabg" name="jmldatabg" value="<?php echo $nobg; ?>" >
	</tbody>        

<?php
}
?>
