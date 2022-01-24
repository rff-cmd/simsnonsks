 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<td width="5%" align="center"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></td> 
			<td align="center">Ekstrakurikuler</td>
			<td align="center">Pilih</td>
		</tr>
	</thead>
	<tbody>
		<?php 
			$id = 0;
			if($_SESSION["tipe_user"] == "Guru") {
				$sql1=$select->list_kelompok_ekstraurikuler(1);
			} else {
				$sql1=$select->list_kelompok_ekstraurikuler();
			}
			$jmldata_group=$sql1->rowCount();
			while($row_kelompok=$sql1->fetch(PDO::FETCH_OBJ)) {
				
		?>
				<input type="hidden" id="kelompok_id_<?php echo $id ?>" name="kelompok_id_<?php echo $id ?>" value="<?php echo $row_kelompok->cde; ?>" >
				<tr style="background-color:ffffff; font-weight: bold;" >
					<td align="left" colspan="4">				
						<?php echo $row_kelompok->dcr; ?>
					</td>
				</tr>
		<?php
				$j=0;
				$no = 0;
				$jmldata = 0;
				$sql=$select->list_ekstrakurikuler_pelajaran('', $row_kelompok->cde);
				$jmldata=$sql->rowCount();
				while($row_counting_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
											
		?>								
			
				<input type="hidden" id="pelajaran_id_<?php echo $no ?>" name="pelajaran_id_<?php echo $no ?>" value="<?php echo $row_counting_detail->pelajaran_id; ?>" >
				
				<tr style="background-color:ffffff;" > 
					
					<td align="center">				
						<?php echo $no + 1; ?>.
					</td>
					
					<td>
						<?php echo $row_counting_detail->nama; ?>		
					</td>
					
					<td align="center">
						
						<?php if($row_kelompok->cde == 1) { ?>
							<input type="radio" id="wajib" name="wajib" class="ace" value="<?php echo $row_counting_detail->pelajaran_id; ?>" checked="" /><span class="lbl"></span>
						<?php 
								$j++;
							} else { ?>	
							<div id="pilih_id<?php echo $no; ?>">								
								<input type="checkbox" id="pilih_<?php echo $no; ?>" name="pilih_<?php echo $no; ?>" style="text-align: right;" onclick="pilih_ekstra('<?php echo $jmldata; ?>')" class="ace" value="1" ><span class="lbl"></span>
							</div>
						<?php } ?>
					</td>
									
				</tr>
				
				<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
		<?php 
				$no++; 
			}		
			
			$id++;	
		} 
		
		?>
		
		<input type="hidden" id="jmldata_group" name="jmldata_group" value="<?php echo $jmldata_group; ?>" >
				
	</tbody>
</table>