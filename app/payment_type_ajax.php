<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getdata":
		$payment_type = $_POST["payment_type"];	

		$cheque_date = date("d-m-Y");
		
		if($payment_type == "giro") {
			

?>
			<!--<div class="form-group" id="paymenttype">
				<div class="form-group">
					<label for="text2" class="col-sm-3 control-label no-padding-right">Bank Account</label>
					<div class="col-sm-5">
						<select id="account_code" name="account_code" data-placeholder="..." class="chosen-select form-control" style="width: auto">
							<option value=""></option>
							<?php 
								select_coa($row_payment->account_code) 
							?>	                            
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">BG Number</label>
					<div class="col-sm-5">
						<input type="text" id="cheque_no" name="cheque_no" class="form-control" value="<?php echo $row_payment->cheque_no ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Bank Name</label>
					<div class="col-sm-5">
						<input type="text" id="bank_name" name="bank_name" class="form-control" value="<?php echo $row_payment->bank_name ?>">
					</div>
				</div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right">BG Date</label>
                    <div class="col-lg-4">                      
                        <input type="text" id="cheque_date" name="cheque_date" class="form-control" data-mask="99-99-9999" value="<?php echo $cheque_date ?>">                     
                    </div>
                </div>
                				
			</div> -->
		
<?php			
			
		}
				
		if($payment_type == "cheque") {

?>
			<!--<div class="form-group" id="paymenttype">-->
				<div class="form-group">
					<label for="text2" class="col-sm-3 control-label no-padding-right">Bank Account</label>
					<div class="col-sm-5">
						<select id="account_code" name="account_code" data-placeholder="..." class="chosen-select form-control" style="width: auto">
							<option value=""></option>
							<?php 
								select_coa($row_payment->account_code) 
							?>	                            
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Cheque Number</label>
					<div class="col-sm-5">
						<input type="text" id="cheque_no" name="cheque_no" class="form-control" value="<?php echo $row_payment->cheque_no ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Bank Name</label>
					<div class="col-sm-5">
						<input type="text" id="bank_name" name="bank_name" class="form-control" value="<?php echo $row_payment->bank_name ?>">
					</div>
				</div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right">Cheque Date</label>
                    <div class="col-lg-4">                      
                        <input type="text" id="cheque_date" name="cheque_date" class="form-control" data-mask="99-99-9999" value="<?php echo $cheque_date ?>">                     
                    </div>
                </div>
				
			<!--</div>-->
		
<?php			
			
		}
		
		
		if($payment_type == "cash") {
?>
			<div class="form-group">
				<label for="text2" class="col-sm-3 control-label no-padding-right">Cash & Bank Account</label>
				<div class="col-sm-5">
					<select id="account_code" name="account_code" data-placeholder="..." class="chosen-select form-control" style="width: auto">
						<option value=""></option>
						<?php 
							select_coa($row_payment->account_code) 
						?>	                            
					</select>
				</div>
			</div>

<?php			
		}
		
		if($payment_type == "card") {
			
			$credit_card_expired = date("d-m-Y");
?>		
			<!--<div class="form-group" id="paymenttype">-->
					<div class="form-group">
		                <label class="col-sm-3 control-label no-padding-right">Credit Card Type</label>
		                <div class="col-sm-5">
		                
		                <?php if ($ref=='') { ?>
		                  <select id="credit_card_code" name="credit_card_code" data-placeholder="..." class="cchosen-select form-control" style="width: auto" >
		                    <option value=""></option>
		                    <?php 
		                    	combo_select_active("credit_card_type","code","name","active","1",$row_payment->credit_card_code)
		                    ?>	                            
		                  </select>
		                <?php } else { ?>
		                 	<input type="hidden" id="credit_card_code" name="credit_card_code" class="form-control" readonly value="<?php echo $row_payment->credit_card_code ?>">
		                 	
		                 	<select id="credit_card_code2" name="credit_card_code2" data-placeholder="..." class="cchosen-select form-control" style="width: auto" disabled>
		                        <option value=""></option>
		                        <?php 
		                        	combo_select_active("credit_card_type","code","name","active","1",$row_payment->credit_card_code)
		                        ?>	                            
		                    </select>
		                <?php } ?>
						</div>
					</div>				
				
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right">Credit Card Number</label>
						<div class="col-sm-5">
							<input type="text" id="credit_card_no" name="credit_card_no" class="form-control" value="<?php echo $row_payment->credit_card_no ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right">Credit Holder Name</label>
						<div class="col-sm-5">
							<input type="text" id="credit_card_holder" name="credit_card_holder" class="form-control" value="<?php echo $row_payment->credit_card_holder ?>">
						</div>
					</div>
					
					<div class="form-group">
	                    <label class="col-sm-3 control-label no-padding-right">Expiration Date</label>
	                    <div class="col-lg-4">                      
	                        <input type="text" id="credit_card_expired" name="credit_card_expired" class="form-control" data-mask="99-99-9999" value="<?php echo $credit_card_expired ?>">                     
	                    </div>
	                </div>
			<!--</div>-->
		
<?php	
			}
			
		if($payment_type == "transfer") {

?>
			<!--<div class="form-group" id="paymenttype">-->
				<div class="form-group">
					<label for="text2" class="col-sm-3 control-label no-padding-right">Bank Account</label>
					<div class="col-sm-5">
						<select id="account_code" name="account_code" data-placeholder="..." class="chosen-select form-control" style="width: auto">
							<option value=""></option>
							<?php 
								select_coa($row_payment->account_code) 
							?>	                            
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Bank Name</label>
					<div class="col-sm-5">
						<input type="text" id="bank_name" name="bank_name" class="form-control" value="<?php echo $row_payment->bank_name ?>">
					</div>
				</div>
				
				
			<!--</div>-->
		
<?php			
			
		}
		
				
		break;
		
	default:
}
?>