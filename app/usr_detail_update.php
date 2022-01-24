<div class="col-sm-7">
	<div class="widget-box">
		<div class="widget-header">
			<h4 class="widget-title">Hak Akses</h4>
		</div>
        
        <table id="simple-table" class="table table-striped table-bordered table-hover">

            <thead>
        		<tr>            
        			<th>Menu</th> 
					<th align="center">Pilih</th> 
					<th align="center">Input</th> 
					<th align="center">Edit</th> 
					<th align="center">Delete</th>
					<th align="center">Level</th>
        		</tr>
        	</thead>
            

        	<tbody>
            
            <?php 
        		$sql=$select->list_usrrgh($ref);
				$jmldata = $sql->rowCount();
        		
                $no = 0;						
        		while($row_usrfrm=$sql->fetch(PDO::FETCH_OBJ)) { 	
        		
        		$no++;
        	?>
        	
                <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
                
                <input type="hidden" id="usr_frmcde_<?php echo $no; ?>" name="usr_frmcde_<?php echo $no; ?>" value="<?php echo $row_usrfrm->frmcde; ?>">
				<input type="hidden" id="usr_old_<?php echo $no; ?>" name="usr_old_<?php echo $no; ?>" value="<?php echo $row_usrfrm->old; ?>">
				<tr <?php if($row_usrfrm->mslc==1) { ?>style="background-color:#CCFFCC;" <?php } ?>> 
					<td width="200"><?php echo $row_usrfrm->frmnme; ?></td>
					<td align="center"><input type="checkbox" class="ace" id="usr_slc_<?php echo $no; ?>" name="usr_slc_<?php echo $no; ?>" value="1" <?php if($row_usrfrm->mslc==1) echo "checked"; ?> ><span class="lbl"></span></td>
					<td align="center"><input type="checkbox" class="ace" id="usr_add_<?php echo $no; ?>" name="usr_add_<?php echo $no; ?>" value="1" <?php if($row_usrfrm->madd==1) echo "checked"; ?> ><span class="lbl"></span></td>
					<td align="center"><input type="checkbox" class="ace" id="usr_edt_<?php echo $no; ?>" name="usr_edt_<?php echo $no; ?>" value="1" <?php if($row_usrfrm->medt==1) echo "checked"; ?> ><span class="lbl"></span></td>
					<td align="center"><input type="checkbox" class="ace" id="usr_dlt_<?php echo $no; ?>" name="usr_dlt_<?php echo $no; ?>" value="1" <?php if($row_usrfrm->mdel==1) echo "checked"; ?> ><span class="lbl"></span></td>
					<td>
						<select id="usr_lvl_<?php echo $no; ?>" name="usr_lvl_<?php echo $no; ?>" >
							<option value="0" selected>Pilih Level</option>
							<?php select_level($row_usrfrm->lvl); ?>
						</select>
					</td>
				</tr>
                
        	<?php } ?>
            
            
        	</tbody>
        </table>
    
    </div>
</div>