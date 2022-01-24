<div class="col-sm-5">
	<div class="widget-box">
		<div class="widget-header">
			<h4 class="widget-title">Tampilkan Dashboard</h4>
		</div>
        
        <table id="simple-table" class="table table-striped table-bordered table-hover">

            <thead>
        		<tr>            
        			<th>Nama Dashboard</th> 
					<th align="center">Pilih</th>
        		</tr>
        	</thead>
            

        	<tbody>
                
            <?php 
            	
            	$sql=$select->list_usr_reminder();
				$jmldata2 = $sql->rowCount();
            	
                $no = 0;					
            	while($row_reminder=$sql->fetch(PDO::FETCH_OBJ)) { 
        		$no++;
            ?>
            
                    <input type="hidden" id="jmldata2" name="jmldata2" value="<?php echo $jmldata2; ?>" >
                    <input type="hidden" id="reminder_id_<?php echo $no; ?>" name="reminder_id_<?php echo $no; ?>" value="<?php echo $row_reminder->reminder_id; ?>">
							
					<tr style="background-color:ffffff;"> 
						<td width="300"><?php echo $row_reminder->nama; ?></td>
						<td align="center"><input type="checkbox" class="ace" id="slc_rmd_<?php echo $no; ?>" name="slc_rmd_<?php echo $no; ?>" value="1" ><span class="lbl"></span></td>
					</tr>
            
        	<?php } ?>
            
        	</tbody>
        </table>

    </div>
</div>