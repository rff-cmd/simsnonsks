<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getdata":
		$receipt_type = $_POST["receipt_type"];	

		$cheque_date = date("d-m-Y");
		
		if($receipt_type == "giro") {
			

?>
			<!--<div class="form-group" id="receipttype">-->
				<?php /*
				<div class="form-group">
					<label for="text2" class="col-sm-3 control-label no-padding-right">Bank Account</label>
					<div class="col-lg-8">
						<select id="account_code" name="account_code" data-placeholder="..." class="chosen-select form-control" style="width: auto">
							<option value=""></option>
							<?php 
								select_coa($row_receipt->account_code) 
							?>	                            
						</select>
					</div>
				</div>*/ ?>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">BG Number</label>
					<div class="col-lg-5">
						<input type="text" id="cheque_no" name="cheque_no" class="form-control" value="<?php echo $row_receipt->cheque_no ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Bank Name</label>
					<div class="col-lg-5">
						<input type="text" id="bank_name" name="bank_name" class="form-control" value="<?php echo $row_receipt->bank_name ?>">
					</div>
				</div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right">BG Date</label>
                    <div class="col-lg-4">                      
                        <input type="text" id="cheque_date" name="cheque_date" class="form-control" data-mask="99-99-9999" value="<?php echo $cheque_date ?>">                     
                    </div>
                </div>
				
			<!--</div>-->
		
<?php			
			
		}
				
		if($receipt_type == "cheque") {

?>
			<!--<div class="form-group" id="receipttype">-->
				<div class="form-group">
					<label for="text2" class="col-sm-3 control-label no-padding-right">Bank Account</label>
					<div class="col-lg-8">
						<select id="account_code" name="account_code" data-placeholder="..." class="chosen-select form-control" style="width: auto">
							<option value=""></option>
							<?php 
								select_coa($row_receipt->account_code) 
							?>	                            
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Cheque Number</label>
					<div class="col-lg-5">
						<input type="text" id="cheque_no" name="cheque_no" class="form-control" value="<?php echo $row_receipt->cheque_no ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Bank Name</label>
					<div class="col-lg-5">
						<input type="text" id="bank_name" name="bank_name" class="form-control" value="<?php echo $row_receipt->bank_name ?>">
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
		
		
		if($receipt_type == "cash" || $receipt_type == "Tunai") {
?>
			<?php /*
			<div class="form-group" id="receipttype">
				<label for="text2" class="col-sm-3 control-label no-padding-right">Cash & Bank Account</label>
				<div class="col-lg-8">
					<select id="account_code" name="account_code" data-placeholder="..." class="chosen-select form-control" style="width: auto">
						<option value=""></option>
						<?php 
							select_coa($row_receipt->account_code) 
						?>	                            
					</select>
				</div>
			</div>*/ ?>

<?php			
		}
		
		if($receipt_type == "card") {
			
			$credit_card_expired = date("d-m-Y");
?>		
			<!--<div class="form-group" id="receipttype">-->
					<div class="form-group">
		                <label class="col-sm-3 control-label no-padding-right">Credit Card Type</label>
		                <div class="col-lg-8">
		                
		                <?php if ($ref=='') { ?>
		                  <select id="credit_card_code" name="credit_card_code" data-placeholder="..." class="chosen-select form-control-deselect" style="width: auto" >
		                    <option value=""></option>
		                    <?php 
		                    	combo_select_active("credit_card_type","code","name","active","1",$row_receipt->credit_card_code)
		                    ?>	                            
		                  </select>
		                <?php } else { ?>
		                 	<input type="hidden" id="credit_card_code" name="credit_card_code" class="form-control" readonly value="<?php echo $row_receipt->credit_card_code ?>">
		                 	
		                 	<select id="credit_card_code2" name="credit_card_code2" data-placeholder="..." class="chosen-select form-control-deselect" style="width: auto" disabled>
		                        <option value=""></option>
		                        <?php 
		                        	combo_select_active("credit_card_type","code","name","active","1",$row_receipt->credit_card_code)
		                        ?>	                            
		                    </select>
		                <?php } ?>
						</div>
					</div>				
				
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right">Credit Card Number</label>
						<div class="col-lg-5">
							<input type="text" id="credit_card_no" name="credit_card_no" class="form-control" value="<?php echo $row_receipt->credit_card_no ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right">Credit Holder Name</label>
						<div class="col-lg-5">
							<input type="text" id="credit_card_holder" name="credit_card_holder" class="form-control" value="<?php echo $row_receipt->credit_card_holder ?>">
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
		
		if($receipt_type == "transfer" || $receipt_type == "Bank") {

?>
			<!--<div class="form-group" id="paymenttype">-->
				<?php /*
				<div class="form-group">
					<label for="text2" class="col-sm-3 control-label no-padding-right">Bank Account</label>
					<div class="col-lg-8">
						<select id="account_code" name="account_code" data-placeholder="..." class="chosen-select form-control" style="width: auto">
							<option value=""></option>
							<?php 
								select_coa($row_receipt->account_code) 
							?>	                            
						</select>
					</div>
				</div>*/ ?>
											
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Bank Name</label>
					<div class="col-lg-5">
						<input type="text" id="bank_name" name="bank_name" class="form-control" value="<?php echo $row_receipt->bank_name ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">No. Rekening</label>
					<div class="col-lg-5">
						<input type="text" id="account_bank" name="account_bank" class="form-control" value="<?php echo $row_receipt->account_bank ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Nama Pemilik Rekening</label>
					<div class="col-lg-5">
						<input type="text" id="account_bank_name" name="account_bank_name" class="form-control" value="<?php echo $row_receipt->account_bank_name ?>">
					</div>
				</div>
				
			<!--</div>-->
		
<?php			
			
		}	
			
		break;
		
	default:
}
?>