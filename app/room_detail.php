<?php
	if($ref != "") {
		$ref2 = $ref;
	}
	$sql1=$select->list_room_detail($ref2);
	$jmldata = $sql1->rowCount();
 ?>
 
 <table class="table table-bordered table-condensed table-hover table-striped">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<th><?php if($lng==1) { echo 'No'; } else { echo 'No'; } ?></th>
			<th><?php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Aset'; } ?></th>
			<th><?php if($lng==1) { echo 'Brand'; } else { echo 'Merek'; } ?></th>
			<th><?php if($lng==1) { echo 'Qty'; } else { echo 'Jumlah'; } ?></th>
			<th><?php if($lng==1) { echo 'Edit/Delete'; } else { echo 'Edit/Hapus'; } ?></th>
			<th><?php if($lng==1) { echo 'Status'; } else { echo 'Status'; } ?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		
			$totalx = 0;
			$total2 = 0;
			$no = 0;
			while($row_client_bank_detail=$sql1->fetch(PDO::FETCH_OBJ)) { 
				
				$no++; 
		?>								
			
			<tr style="background-color:ffffff;" > 
				<td align="center">
					<?php echo $no ?>.
				</td>
				<td>
					<?php echo $row_client_bank_detail->item_name; ?>		
				</td>
				<td>
					<?php echo $row_client_bank_detail->brand; ?>		
				</td>
				<td align="center">
					<?php echo $row_client_bank_detail->qty ?>
				</td>
				<td align="center">
                                            
                    <?php //if (allowupd('frmclient_bank')==1) { ?>
						<a href="room_item.php?line=<?php echo $row_client_bank_detail->line ?>&search=<?php echo $row_client_bank_detail->ref ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
							<span class="green">
								<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
							</span>
						</a>
                    <?php //} ?>
                    
                    <?php //if (allowdel('frmclient_bank')==1) { ?>    
                        &nbsp;
						<a href="JavaScript:hapus_room_detail('<?php echo $row_client_bank_detail->ref ?>','<?php echo $row_client_bank_detail->line ?>')" class="tooltip-error" data-rel="tooltip" title="Delete">
							<span class="red">
								<i class="ace-icon fa fa-trash-o bigger-120"></i>
							</span>
						</a>
                    <?php //} ?>
                </td>
                <td align="center">
					<?php echo $row_client_bank_detail->status; ?>		
				</td>
				
			</tr>
			<?php 
										
				
			} 
			
			?>
							
	</tbody>
</table>