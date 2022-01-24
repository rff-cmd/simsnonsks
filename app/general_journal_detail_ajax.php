<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");
//include_once ("../app/class/class.select.print.php");
include_once ("../app/class/class.select.php");

//$select_print =	new select_print;
$select	=	new select;

$pilih = $_POST["button"];

$exp = explode("|",$pilih,7);
$pilih = $exp[0];
$kodex = $exp[1];
$ref   = $exp[2];

switch ($pilih){
	case "getdata":
		
		$location_id 	= 	$_POST['location_id'];
		$kode 			= 	$_POST['account_code'];	
		
		$i = $kodex;
		
		$sql_loc 	= $select->list_warehouse($location_id);
		$row_loc 	= $sql_loc->fetch(PDO::FETCH_OBJ); 
		$location_name = $row_loc->name;
		
		$sql 	= $select->list_finance_type($kode);
		$row_general_journal_detail = $sql->fetch(PDO::FETCH_OBJ); 
		
		//cek item code
		if( $ref == "" ) { $ref = "ndfxx"; }
		
		/*$sql2 = $select->list_general_journal_detail($ref, $kode);
		$row_item = $sql2->fetch(PDO::FETCH_OBJ);
		$rows = $sql2->rowCount();
		*/
		//if($location_id != '') {
			
?>		
			<input type="hidden" id="location_id_<?php echo $i; ?>" name="location_id_<?php echo $i; ?>"  class="form-control" value="<?php echo $location_id ?>" />
			
			<input type="hidden" id="account_code_<?php echo $i; ?>" name="account_code_<?php echo $i; ?>"  class="form-control" value="<?php echo $row_general_journal_detail->id ?>" />
			
			<td align="center">
				<?php echo $i+1 ?>
			</td>
			
			<!--<td>
				<?php echo $location_name ?>
			</td>-->
										
			<td>
				<?php echo $row_general_journal_detail->name ?>
			</td>
			
			<td align="right"><input type="text" id="memo_<?php echo $i; ?>" name="memo_<?php echo $i; ?>" autocomplete="off" value="<?php echo $row_general_journal_detail->memo ?>" style="width: 300px" ></td> 
			
			<!--<td align="right"><input type="text" id="debit_amount_<?php echo $i; ?>" name="debit_amount_<?php echo $i; ?>" value="<?php echo number_format($row_general_journal_detail->debit_amount,0,".",",") ?>" onkeyup="formatangka('debit_amount_<?php echo $i; ?>'), detailvalue('<?php echo $i; ?>', '<?php echo $i ?>')" autocomplete="off" style="text-align:right" ></td>--> 
			<input type="hidden" id="debit_amount_<?php echo $i; ?>" name="debit_amount_<?php echo $i; ?>" value="<?php echo number_format($row_general_journal_detail->debit_amount,0,".",",") ?>" onkeyup="formatangka('debit_amount_<?php echo $i; ?>'), detailvalue('<?php echo $i; ?>', '<?php echo $i ?>')" autocomplete="off" style="text-align:right" >
			
			<td align="right"><input type="text" id="credit_amount_<?php echo $i; ?>" name="credit_amount_<?php echo $i; ?>" value="<?php echo number_format($row_general_journal_detail->unit_cost,0,".",",") ?>" onkeyup="formatangka('credit_amount_<?php echo $i; ?>'), detailvalue('<?php echo $i; ?>', '<?php echo $i ?>')" autocomplete="off" style="text-align:right" ></td>
			
			
			<td>
				<input type="submit" id="submit" name="submit" class='btn btn-xs btn-primary' value="Save Detail">
		        
		        <!--&nbsp;&nbsp;
				<input type="submit" id="submit" name="submit" class="btn btn-xs btn-danger" value="Delete Detail">-->
			</td>
		
<?php
		//} else {
?>
			<!--<td colspan="8" style="color: #ff0000; font-size: 14px">
				Unit belum dipilih !
			</td>-->
<?php			
		//}
		
		break;
			
	default:
}
?>