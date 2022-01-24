<?php
	$sql1=$select->list_client_bank($client_code, "", "");
	$jmldata = mysqli_num_rows($sql1);
 ?>
 
 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto; font-size: 11px">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<th><?php if($lng==1) { echo 'No'; } else { echo 'No'; } ?></th>
			<th><?php if($lng==1) { echo 'Client'; } else { echo 'Customer'; } ?></th>
			<th><?php if($lng==1) { echo 'Bank Name'; } else { echo 'Nama Bank'; } ?></th>
			<th><?php if($lng==1) { echo 'Account Bank'; } else { echo 'No. Rekening'; } ?></th>
			<th><?php if($lng==1) { echo 'Account Name'; } else { echo 'Nama Pemilik Bank'; } ?></th>
            <th><?php if($lng==1) { echo 'Branch'; } else { echo 'Cabang'; } ?></th>
			<th><?php if($lng==1) { echo 'Action'; } else { echo 'Action'; } ?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		
			$totalx = 0;
			$total2 = 0;
			$no = 0;
			while($row_client_bank_detail=$sql1->fetch_object()) { 
				
				$no++; 
		?>								
			
			<tr style="background-color:ffffff;" > 
				<td align="center">
					<?php echo $no ?>.
				</td>
				<td>
					<input type="text" id="client_name_<?php echo $no ?>" name="client_name_<?php echo $no ?>" class="form-control" readonly="" value="<?php echo $row_client_bank_detail->client_name; ?>" >		
				</td>
				<td>
					<input type="text" id="bank_name_<?php echo $no; ?>" name="bank_name_<?php echo $no; ?>" readonly="" class="form-control" value="<?php echo $row_client_bank_detail->bank_name ?>" >
				</td>
				<td>
					<input type="text" id="account_bank_<?php echo $no ?>" name="account_bank_<?php echo $no ?>" class="form-control" readonly="" value="<?php echo $row_client_bank_detail->account_bank; ?>" >		
				</td>
				<td>
					<input type="text" id="account_name_<?php echo $no; ?>" name="account_name_<?php echo $no; ?>" readonly="" class="form-control" value="<?php echo $row_client_bank_detail->account_name ?>" >
				</td>
				
				<td>
					<input type="text" id="bank_branch_<?php echo $no; ?>" name="bank_branch_<?php echo $no; ?>" readonly="" class="form-control" value="<?php echo $row_client_bank_detail->bank_branch ?>" >
				</td>
				<td>
                                            
                    <?php if (allowupd('frmclient_bank')==1) { ?>
						<a href="client_bank.php?line=<?php echo $row_client_bank_detail->line ?>&search=<?php echo $row_client_bank_detail->client_code ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
							<span class="green">
								<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
							</span>
						</a>
                    <?php } ?>
                    
                    <?php if (allowdel('frmclient_bank')==1) { ?>    
                        &nbsp;
						<a href="JavaScript:hapus_bank('<?php echo $row_client_bank_detail->client_code ?>','<?php echo $row_client_bank_detail->line ?>')" class="tooltip-error" data-rel="tooltip" title="Delete">
							<span class="red">
								<i class="ace-icon fa fa-trash-o bigger-120"></i>
							</span>
						</a>
                    <?php } ?>
                </td>
                
				
			</tr>
			<?php 
										
				
			} 
			
			?>
							
	</tbody>
</table>