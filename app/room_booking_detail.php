<table id="dynamic-table" class="table table-striped table-bordered table-hover">

    <thead>
		<tr>            
			<td align="center" width="10%">No</td>
			<!--<td align="center">Nama Gedung</td>-->
			<td align="center">Nama Ruang</td>
			<!--<td align="center">Tipe Ruang</td>
			<td align="center">Fasilitas Ruang</td> -->
			<td align="center">Pilih</td>
			<td></td>
		</tr>
	</thead>
	    

	<tbody>
	        
	    <?php 
	    	$booked = $booked . " " . $from_time;
	    	$booked = date("d-m-Y H:i", strtotime($booked));
	    	
	    	$booked_finish = $booked_finish . " " . $to_time;
	    	$booked_finish = date("d-m-Y H:i", strtotime($booked_finish));
	    	
	    	$sql=$select->get_room_booking($_POST['submit']);
			$jmldata = $sql->rowCount();
	    	
	        $no = 0;
	        					
	    	while($row_chamber=$sql->fetch(PDO::FETCH_OBJ)) { 
			
			$sqlcheck = $select->get_room_booking_ready($row_chamber->ref, $_POST['submit'], $booked, $booked_finish);	
			$rows_room = $sqlcheck->rowCount();	    
			
			if($rows_room == 0) {  
	    ?>
	    
	    			<div class="hide">
	                    <input type="text" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
	                	
	                    <input type="text" id="room_ref_<?php echo $no; ?>" name="room_ref_<?php echo $no; ?>" value="<?php echo $row_chamber->ref; ?>">
	                </div>
	    							
	    			<tr style="background-color:ffffff;"> 
	    				<td align="center"><?php echo $no+1 ?>.</td>
	    				<!--<td><?php echo $row_chamber->build_name; ?></td>-->
	    				<td><?php echo $row_chamber->name; ?></td>
	    				<?php /*<td><?php echo $row_chamber->asset_type; ?></td>
	    				<td align="center">
	                    	<a style="font-size: 14px; font-weight: bold;" href="javascript:void(0);" name="Find" title="Detail Fasilitas" onClick=window.open("<?php echo $__folder ?>app/booking_view_facility.php?ref=<?php echo $row_chamber->ref ?>","Find","width=700,height=300,left=50,top=20,toolbar=0,status=0,scroll=1,scrollbars=no"); >
								<span class="green">
									<i class="ace-icon fa fa-external-link bigger-120"></i>
								</span>
							</a>
	                    </td>*/ ?>
	    				<td width="10%" align="center">
	    					<label class="pos-rel">
	    						<input type="checkbox" class="ace" id="registration_slc_<?php echo $no; ?>" name="registration_slc_<?php echo $no; ?>" value="1" ><span class="lbl"></span>
	    					</label>
	    					<!--<input type="checkbox" class="ace" id="registration_slc[]" name="registration_slc[]" value="1" ><span class="lbl"></span>-->
	    				</td>  
	    				<td></td>				
	    			</tr>
	            
				
	<?php 
			$no++;
			
				}
			
		} 

	?>
	    
	</tbody>
</table>