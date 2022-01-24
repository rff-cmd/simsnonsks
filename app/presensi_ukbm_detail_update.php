<table id="dynamic-table" class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<td width="5%" align="center"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></td> 
			<td align="center">NIS</td>
			<td align="center">Nama</td>
			<td align="center">Hadir</td>
			<td align="center">Dispensasi</td>
			<td align="center">Sakit</td>
			<td align="center">Izin</td>
			<td align="center">Alpa</td>
		</tr>
	</thead>
	
	<tbody>
		
		<?php	
			
			$no = 0;
			//$sql=$select->list_presensi_ukbm_detail('', '', $idtingkat, $idkelas);
			$sql=$select->list_presensi_ukbm_siswa('', '', $idtingkat, $idkelas, $nama, $all, 'SMA');
			while($row_siswa_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
				
				$sql2=$select->list_presensi_ukbm_detail($segmen3, $row_siswa_detail->replid, $idtingkat, $idkelas, $row_siswa_detail->tanggal);
				$row_siswa_detail2=$sql2->fetch(PDO::FETCH_OBJ);
			
				$hadir 		= "checked";
				$dispensasi = "";
				$sakit		= "";
				$izin		= "";
				$alpa		= "";
				
				if($row_siswa_detail2->dispensasi == 1) {
					$dispensasi = "checked";
				} else if($row_siswa_detail2->sakit == 1) {
					$sakit = "checked";
				} else if($row_siswa_detail2->izin == 1) {
					$izin = "checked";
				} else if($row_siswa_detail2->alpa == 1) {
					$alpa = "checked";
				} 
				
		?>								
			
				<div class="hide">
					<input type="text" id="idsiswa_<?php echo $no ?>" name="idsiswa_<?php echo $no ?>" value="<?php echo $row_siswa_detail->replid; ?>" >
				</div>
				
				<tr> 
					<td align="center"><?php echo $no+1 ?></td>
					<td><?php echo $row_siswa_detail->nis ?></td>
					<td><?php echo $row_siswa_detail->nama ?></td>
					<td align="center">
						<input type="radio" id="absena_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="hadir" <?php echo $hadir ?> /><span class="lbl"></span>
					</td>
					<td align="center">
						<input type="radio" id="absenb_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="dispensasi" <?php echo $dispensasi ?> /><span class="lbl"></span>
					</td>
					<td align="center">
						<input type="radio" id="absenc_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="sakit" <?php echo $sakit ?> /><span class="lbl"></span>
					</td>
					<td align="center">
						<input type="radio" id="absend_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="izin" <?php echo $izin ?> /><span class="lbl"></span>
					</td>
					<td align="center">
						<input type="radio" id="absene_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="alpa" <?php echo $alpa ?> /><span class="lbl"></span>
					</td>
				</tr>
				
				
		<?php 
				$no++; 
			}			
		?>
				<div class="hide">
					<input type="text" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
				</div>
						
	</tbody>
</table>