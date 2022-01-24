<?php
	$delete = $segmen4; //$_REQUEST['mxKz'];
	if ($delete == "xm8r389xemx23xb2378e23") {
		include 'class/class.delete.php';
		$delete2=new delete;
		$delete2->delete_general_journal_in_detail($segmen5, $segmen6);
		
		$ref = $segmen5; //$_REQUEST['search'];
		
?>
		<meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('general_journal_in'); ?>/<?php echo $ref ?>" />
		
<?php
	}
?>

<script type="text/javascript">
	function hapus(ref, line) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			//document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('general_journal_in') ?>&search="+ ref +"&line="+ line +"&mxKz=xm8r389xemx23xb2378e23";
			
			document.location.href = "<?php echo obraxabrix('general_journal_in') ?>/xm8r389xemx23xb2378e23/"+ref+"/"+line+" ";
		}
	}
</script>


<?php
    $sql=$select->list_general_journal_in_detail($ref);
    $jmldata = $sql->rowCount();
    $i = $jmldata;
?>
<table>
	<tr>
        <td width="370">
			
			<?php if($ref == "") { ?>
				<select name="account_code" id="account_code" style="width:auto;" class="chosen-select form-control" onchange="loadHTMLPost3('app/general_journal_in_detail_ajax.php','account_code_ajax_<?php echo $i; ?>','getdata','account_code',<?php echo $i; ?>,'<?php echo $ref; ?>')" >
					<option value=""></option>
					<?php select_finance_type_list("", "in", "", "siswa"); ?>
				</select>
			<?php } else { ?>
				<select name="account_code" id="account_code" style="width:auto;" class="chosen-select form-control" onchange="loadHTMLPost3('../app/general_journal_in_detail_ajax.php','account_code_ajax_<?php echo $i; ?>','getdata','account_code',<?php echo $i; ?>,'<?php echo $ref; ?>')" >
				<option value=""></option>
				<?php select_finance_type_list("", "in", "", "siswa"); ?>
			</select>
			<?php } ?>
    				
		</td>
    </tr>
</table>
        	
        	
<table id="simple-table" class="table table-striped table-bordered table-hover">
	<thead> 
		<tr> 
			<td align="center">No.</td>
			<td align="center">Kode</td>
			<td align="center">Nama Pemasukan</td> 
			<td align="center">Memo</td>
			<!--<td>Debet</td>-->
			<td align="right">Jumlah</td>
			<td></td>
		</tr> 
	</thead> 
	<tbody> 
	<?php
		
		$i = 0;
		
		while($row_general_journal_in_detail=$sql->fetch(PDO::FETCH_OBJ)) {
			
						
	?>
		
		<input type="hidden" id="old_account_code_<?php echo $i; ?>" name="old_account_code_<?php echo $i; ?>"  class="form-control" value="<?php echo $row_general_journal_in_detail->account_code ?>" />
            				
        <input type="hidden" id="old_line_<?php echo $i; ?>" name="old_line_<?php echo $i; ?>"  class="form-control" value="<?php echo $row_general_journal_in_detail->line ?>" />
            				
		<tr> 
			<input type="hidden" id="account_code_<?php echo $i; ?>" name="account_code_<?php echo $i; ?>"  class="form-control" value="<?php echo $row_general_journal_in_detail->account_code ?>" />
			
			<td align="center">
				<?php echo $i + 1 ?>
			</td>
			
			<td>
				<?php echo $row_general_journal_in_detail->code ?>
			</td>
										
			<td>
				<?php echo $row_general_journal_in_detail->name ?>
			</td>
			
			<td align="right"><input type="text" id="memo_<?php echo $i; ?>" name="memo_<?php echo $i; ?>" autocomplete="off" style="width: 300px" value="<?php echo $row_general_journal_in_detail->memo ?>" ></td> 
			
			<!--<td align="right"><input align="right" type="text" id="debit_amount_<?php echo $i; ?>" name="debit_amount_<?php echo $i; ?>" value="<?php echo number_format($row_general_journal_in_detail->debit_amount,0,".",",") ?>" onkeyup="formatangka('debit_amount_<?php echo $i; ?>'), detailvalue('<?php echo $i; ?>', '<?php echo $jmldata-1 ?>')" autocomplete="off" style="text-align:right" ></td> -->
			<input align="right" type="hidden" id="credit_amount_<?php echo $i; ?>" name="credit_amount_<?php echo $i; ?>" value="<?php echo number_format($row_general_journal_in_detail->credit_amount,0,".",",") ?>" onkeyup="formatangka('credit_amount_<?php echo $i; ?>'), detailvalue('<?php echo $i; ?>', '<?php echo $jmldata-1 ?>')" autocomplete="off" style="text-align:right" >
			
			<td align="right"><input align="right" type="text" id="debit_amount_<?php echo $i; ?>" name="debit_amount_<?php echo $i; ?>" value="<?php echo number_format($row_general_journal_in_detail->debit_amount,0,".",",") ?>" onkeyup="formatangka('debit_amount_<?php echo $i; ?>'), detailvalue('<?php echo $i; ?>', '<?php echo $jmldata-1 ?>')" autocomplete="off" style="text-align:right" ></td> 
			
			<td>
				<input type="submit" id="submit" name="submit" class='btn btn-xs btn-primary' value="Update Detail">
		        
		        &nbsp;&nbsp;
				<a class="btn btn-xs btn-danger" href="JavaScript:hapus('<?php echo $row_general_journal_in_detail->ref ?>','<?php echo $row_general_journal_in_detail->line ?>')" >Delete Detail</a>
			</td>
			
		</tr> 
	<?php 
			$i++;
		
		} 
		
	?>
	
	<?php 
		/*$jmldata2 = 0;
		$x = $i;
		$jmldata2 = $jmldata2 + $jmldata;
		    
		for($i=$x; $i<=$jmldata2; $i++) {	*/
	?>
	
		<tr style="background-color:ffffff;" id="account_code_ajax_<?php echo $i; ?>" > 	
		        	
		</tr>

	<?php
	 //}
	?>

	<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $i; ?>" >
	
	</tbody> 
	
		
	<tr style="color: #07a336; font-size: 14px; font-weight: bold;">
		<td align="right" colspan="4">Total</td>
		<!--<td align="right" id="total_balance2"><input type="text" id="total_balance" name="total_balance" readonly="" onkeyup="formatangka('total_balance')" style="text-align:right" value="<?php echo number_format($row_general_journal_in->total_balance,0,".",",") ?>"></td>-->
		<input type="hidden" id="total_balance" name="total_balance" readonly="" onkeyup="formatangka('total_balance')" style="text-align:right" value="<?php echo number_format($row_general_journal_in->total_balance,0,".",",") ?>">
		<!--<td align="right" id="total_debit2"><input type="text" id="total_debit" name="total_debit" readonly="" onkeyup="formatangka('total_debit')" style="text-align:right" value="<?php echo number_format($row_general_journal_in->total_debit,0,".",",") ?>"></td>-->
		<input type="hidden" id="total_credit" name="total_credit" readonly="" onkeyup="formatangka('total_credit')" style="text-align:right" value="<?php echo number_format($row_general_journal_in->total_credit,0,".",",") ?>">
		<td align="right" id="total_debit2"><input type="text" id="total_debit" name="total_debit" readonly="" onkeyup="formatangka('total_debit')" style="text-align:right" value="<?php echo number_format($row_general_journal_in->total_debit,0,".",",") ?>"></td>
		<td></td>
	</tr>
	
</table>