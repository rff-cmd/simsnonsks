<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getclient":
		$newclient = $_POST["newclient"];	
		
		if ($newclient == 0) {
			
?>		
		
			<div id="new_client">
				<div class="form-group">
					<label class="control-label col-lg-4"></label>
					<div class="col-lg-8">
						<div class="checkbox">
							<label style="color: #0938f7">
								<input id="newclient" name="newclient" class="uniform" type="checkbox" onClick="loadHTMLPost2('app/pos_ajax.php','new_client','getclient','newclient')"  checked value="1"><b><?php if($_SESSION['bahasa']==1) { echo 'New Customer'; } else { echo 'Customer Baru'; } ?></b>
							</label>
						</div>

					</div>
				</div>
                  
				<div class="form-group">
                    <label class="control-label col-lg-4">Customer *)</label>
                    <div class="col-lg-8">
                    	 <input type="text" id="client_code" name="client_code" style="font-size: 12px" class="form-control" value="">
					</div>
				</div>
				
				<div class="form-group">
                    <label class="control-label col-lg-4"><?php if($_SESSION['bahasa']==1) { echo 'Phone'; } else { echo 'Telepon'; } ?> </label>
                    <div class="col-lg-8">
                    	 <input type="text" id="phone" name="phone" style="font-size: 12px" class="form-control" value="">
					</div>
				</div>
				
			</div>
		
		
<?php
		} else {
			
?>
			<div id="new_client">
				<div class="form-group">
					<label class="control-label col-lg-4"></label>
					<div class="col-lg-8">
						<div class="checkbox">
							<label style="color: #ff0000">
								<input id="newclient" name="newclient" class="uniform" type="checkbox" onClick="loadHTMLPost2('app/pos_ajax.php','new_client','getclient','newclient')" value="0" ><b><?php if($_SESSION['bahasa']==1) { echo 'New Customer'; } else { echo 'Customer Baru'; } ?></b>
							</label>
						</div>

					</div>
				</div>
                  
				<div class="form-group">
                    <label class="control-label col-lg-4">Customer *)</label>
                    <div class="col-lg-8">
                    	 <select id="client_code" name="client_code" data-placeholder="..." class="form-control chzn-select-deselect" style="max-width: 300px; font-size: 12px" onchange="loadHTMLPost2('app/cash_invoice_client_ajax.php','alamat','getalamat','client_code')" >
                          	<option value=""></option>
                            <?php 
                            	combo_select_active("client","syscode","name","active","1",$row_sales_order->client_code) 
                            ?>	
                                                      
                          </select>
					</div>
				</div>
			</div>
			
<?php			
		}
		break;
	
	case "getalamat":
	
		$client_code = $_POST["client_code"];	
		$sqlcln = "select address from client where syscode='$client_code' ";
		$sql=$dbpdo->prepare($sqlcln);
		$sql->execute();
		$data   = $sql->fetch(PDO::FETCH_OBJ);	
		
?>	
		
			<textarea id="ship_to" name="ship_to" style="font-size: 12px" class="form-control"><?php echo $data->address ?></textarea>
			
<?php	
		break;
			
	default:
	
}
?>