<table border="0" style="border: 0px solid #ccc">
	<?php 
		$i = 0;
		$sql = $select->list_aspek_perkembangan('');
		while($data_aspek=$sql->fetch(PDO::FETCH_OBJ)) { 	
		
	?>
	

		<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $i + 1; ?>" />
		<input type="hidden" id="idaspek_perkembangan_<?php echo $i ?>" name="idaspek_perkembangan_<?php echo $i ?>" value="<?php echo $data_aspek->replid ?>" />
				
		<tr>
			<td>
                <div class="box">
                	<b><?php echo $data_aspek->aspek ?></b><br><br>
                    <div class="box-content box-nomargin">
					<textarea name="hasil_<?php echo $i ?>" id="hasil_<?php echo $i ?>" class='span12 cleditor'><?php echo $assesmen_observasi_data->hasil ?></textarea>
				</div>
                </div>
            </td>
		</tr>
		
		<tr>
			<td>
                <div class="box">
                	<b>Saran Penanganan</b><br><br>
                    <div class="box-content box-nomargin">
					<textarea name="saran_<?php echo $i ?>" id="saran_<?php echo $i ?>" class='span12 cleditor'><?php echo $assesmen_observasi_data->hasil ?></textarea>
				</div>
                </div>
            </td>
		</tr>
		
		<tr>
			<td colspan="1"><hr style="border: 1px solid green"></td>
		</tr>
		
				
	<?php 
			$i++;
		} 
	?>
</table>
