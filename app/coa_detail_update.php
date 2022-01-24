<table id="simple-table" class="table table-striped table-bordered table-hover">

    <thead>
		<tr>            
			<th>Nama Cabang</th> 
			<th align="center">Pilih</th>
		</tr>
	</thead>
    

	<tbody>
        
    <?php 
    	
        $sql=$select->list_coa_brn($ref);
        $jmldata2 = $sql->rowCount();
    						
    	$no = 0;
		while($row_brn=$sql->fetch(PDO::FETCH_OBJ)) {
		$no++;
    ?>
        
        <input type="hidden" id="brncde_<?php echo $no; ?>" name="brncde_<?php echo $no; ?>" value="<?php echo $row_brn->brncde; ?>">
		<input type="hidden" id="brnold_<?php echo $no; ?>" name="brnold_<?php echo $no; ?>" value="<?php echo $row_brn->old; ?>">							
		<tr <?php if($row_brn->mslc==1) { ?>style="background-color:#CCFFCC;" <?php } else { ?>style="background-color:#ffffff;" <?php } ?> > 
			<td width="300"><?php echo $row_brn->brndcr; ?></td>
			<td align="center"><input type="checkbox" class="ace" id="brnslc_<?php echo $no; ?>" name="brnslc_<?php echo $no; ?>" value="1" <?php if($row_brn->mslc==1) echo "checked"; ?> ><span class="lbl"></span></td>
		</tr>
            
				
	<?php } ?>
    
	</tbody>
</table>