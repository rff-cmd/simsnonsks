 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<td width="5%" align="center"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></td> 
			<td align="center">Kode Guru</td>
			<td align="center">NIP</td>
			<td align="center">Nama</td>
			<td align="center">Keterangan</td>
			<td align="center">Pilih</td>
		</tr>
	</thead>
	<tbody>
		
		<?php
			$j=0;
			$no = 0;
			$jmldata = 0;
			$sql=$select->list_guru_pelajaran_update($row_guru->idpelajaran);
			$jmldata=$sql->rowCount();
			while($row_guru_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
				
				$pilih = "";
				if($row_guru_detail->kode != "") {
					$pilih = "checked";
				}						
		?>								
			
				<input type="hidden" id="nip_<?php echo $no ?>" name="nip_<?php echo $no ?>" value="<?php echo $row_guru_detail->replid; ?>" >
				<input type="hidden" id="urutan_<?php echo $no ?>" name="urutan_<?php echo $no ?>" value="<?php echo $row_guru_detail->urutan; ?>" >
				<input type="hidden" id="replid_<?php echo $no ?>" name="replid_<?php echo $no ?>" value="<?php echo $row_guru_detail->replid; ?>" >
				
				<tr style="background-color:ffffff;" > 
					
					<td align="center">				
						<?php echo $no + 1; ?>.
					</td>
					
					<td>
						<input type="text" id="kode_<?php echo $no ?>" name="kode_<?php echo $no ?>" class="form-control" style="width: 100px" value="<?php echo $row_guru_detail->kode; ?>" >	
					</td>
					
					<td>
						<?php echo $row_guru_detail->nip; ?>		
					</td>
					
					<td>
						<?php echo $row_guru_detail->nama; ?>		
					</td>
					
					<td>
						<input type="text" id="keterangan_<?php echo $no ?>" name="keterangan_<?php echo $no ?>" class="form-control" value="<?php echo $row_guru_detail->keterangan; ?>" >	
					</td>
					
					<td align="center">
						<input type="checkbox" id="pilih_<?php echo $no; ?>" name="pilih_<?php echo $no; ?>" style="text-align: right;" class="ace" value="1" <?php echo $pilih ?> ><span class="lbl"></span>
					</td>
									
				</tr>
				
		<?php 
				$no++; 
			}
		
		?>
		
		<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
				
	</tbody>
</table>