<table id="dynamic-table" class="table table-striped table-bordered table-hover">

    <thead>
		<tr>            
			<td align="center" width="10%">No</td>
			<!--<td align="center">Nama Gedung</td>-->
			<td align="center">Nama Ruang</td>
			<td align="center">Pilih</td>
			<td align="center">Hapus</td>
		</tr>
	</thead>
	    

	<tbody>
	    
	    <?php 
		$sql=$select->list_room_booking_detail($ref);
			$jmldata = $sql->rowCount();
		
	        $no = 0;						
		while($row_registration_detail=$sql->fetch(PDO::FETCH_OBJ)) { 	
			
	?>
		
		<div class="hide">
	            <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
	            
	            <input type="hidden" id="room_ref_<?php echo $no; ?>" name="room_ref_<?php echo $no; ?>" value="<?php echo $row_registration_detail->room_ref; ?>">
				<input type="hidden" id="old_<?php echo $no; ?>" name="old_<?php echo $no; ?>" value="<?php echo $row_registration_detail->old; ?>">
			</div>
			
			<tr <?php if($row_registration_detail->slc==1) { ?>style="background-color:#094416; color: #ffffff" <?php } ?>> 
				<td align="center"><?php echo $no+1 ?>.</td>
				<!--<td><?php echo $row_registration_detail->build_name; ?></td>-->
				<td><?php echo $row_registration_detail->name; ?></td>
				<?php /*<td><?php echo $row_registration_detail->asset_type; ?></td>
				<td align="center">
	            	<a style="font-size: 14px; font-weight: bold;" href="javascript:void(0);" name="Find" title="Detail Fasilitas" onClick=window.open("<?php echo $__folder ?>app/booking_view_facility.php?ref=<?php echo $row_registration_detail->room_ref ?>","Find","width=700,height=300,left=50,top=20,toolbar=0,status=0,scroll=1,scrollbars=no"); >
						<span class="green">
							<i class="ace-icon fa fa-external-link bigger-120"></i>
						</span>
					</a>
	            </td>*/ ?>
				<td align="center">
					
					<?php if($row_registration_detail->slc==1) { ?>
						<span class="red">
							<i class="ace-icon fa fa-check-square-o bigger-150"></i>
						</span>								
	            		<input type="hidden" id="registration_slc_<?php echo $no; ?>" name="registration_slc_<?php echo $no; ?>" value="1" >		                		
					<?php } else { ?>									
						<input type="checkbox" class="ace" id="registration_slc_<?php echo $no; ?>" name="registration_slc_<?php echo $no; ?>" value="1" <?php if($row_registration_detail->slc==1) echo "checked"; ?> ><span class="lbl"></span>
					<?php } ?>
				</td>
				<td align="center">
					<?php if($row_registration_detail->slc==1) { ?>
						<input type="checkbox" class="ace" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" value="1"><span class="lbl"></span>
					<?php } ?>
				</td>
				
			</tr>
	        
	<?php 
			$no++;
		} 

	?>
	    
	    
	</tbody>
</table>