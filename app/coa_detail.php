<table id="simple-table" class="table table-striped table-bordered table-hover">

    <thead>
		<tr>            
			<th>Nama Cabang</th> 
			<th align="center">Pilih</th>
		</tr>
	</thead>
    

	<tbody>
        
    <?php 
    	
    	$sql=$select->list_brn();
		$jmldata2 = $sql->rowCount();
    						
    	$no = 0;
		while($row_brn=$sql->fetch(PDO::FETCH_OBJ)) { 
		$no++;
    ?>
        
        <input type="hidden" id="jmldata2" name="jmldata2" value="<?php echo $jmldata2; ?>" >
        <input type="hidden" id="brncde_<?php echo $no; ?>" name="brncde_<?php echo $no; ?>" value="<?php echo $row_brn->brncde; ?>">
								
		<tr style="background-color:ffffff;"> 
			<td width="300"><?php echo $row_brn->brndcr; ?></td>
			<td align="center">
                <input type="checkbox" class="ace" style="width:100px;" id="brnslc_<?php echo $no; ?>" name="brnslc_<?php echo $no; ?>" value="1" ><span class="lbl"></span>
            </td>
		</tr> 
            
				
	<?php } ?>
    
	</tbody>
</table>