 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto; font-size: 12px">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<td align="center" width="20%">Jam Ke-</td>
			<?php
				$no = 0;
				$sqlhari = $select->list_jam("", $hari, "");
				while($data_hari = $sqlhari->fetch(PDO::FETCH_OBJ)) {
			?>
					<td align="center"><?php echo $data_hari->jamke ?></td>
			<?php
					$no++;
				}
			?>
		</tr>
		
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<td align="center">Kelas</td>
			<?php
				$sqlhari = $select->list_jam("", $hari, "");
				while($data_hari = $sqlhari->fetch(PDO::FETCH_OBJ)) {
					
					$bgcolor = "";
					if($data_hari->istirahat == 1) {
						$bgcolor = "color: #ff0000";
					} 
			?>
					<td align="center" style="<?php echo $bgcolor ?>">
						<?php 
							if($data_hari->istirahat == 1) {
								echo "Istirahat";
							} else {
								echo $data_hari->jam1 . '-' . $data_hari->jam2;
							}
						?>							
					</td>
			<?php
				}
			?>
		</tr>
	</thead>
	
	<tbody>
		
		<?php
			$no = 0;
			$jmldata = 0;
			$sql=$select->list_kelas("", $idtingkat);
			$jmldata=$sql->rowCount();
			while($row_kelas_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
										
		?>								
			
				<input type="hidden" id="nip_<?php echo $no ?>" name="nip_<?php echo $no ?>" value="<?php echo $row_kelas_detail->replid; ?>" >
				
				<tr style="background-color:ffffff;" > 
					
					<td>
						<input type="hidden" id="idkelas_<?php echo $no ?>" name="idkelas_<?php echo $no ?>" class="form-control" style="width: 100px" value="<?php echo $row_kelas_detail->replid; ?>" >	
						<?php echo $row_kelas_detail->tingkat . " " . $row_kelas_detail->kelas; ?>
					</td>	
					
					<?php
						$j=0;
						$sqlhari = $select->list_jam("", $hari, "");
						while($data_hari = $sqlhari->fetch(PDO::FETCH_OBJ)) {
							
							$sqljadwal = $select->list_jadwal($row_kelas_detail->replid, $idguru, '', $hari, $data_hari->replid);
							$data_jdl = $sqljadwal->fetch(PDO::FETCH_OBJ);
							
					?>
							<td align="center" style="font-size: 14px; font-weight: bold;">
								<input type="hidden" id="jamke_<?php echo $j.$no ?>" name="jamke_<?php echo $j.$no ?>" value="<?php echo $data_hari->jamke; ?>" >
								<?php 
									if($data_jdl->kode_guru == "") {
										if($data_hari->istirahat == 0) { 									
								?>
									<a href="javascript:void(0);" name="Find" title="Input Jadwal" onClick="jadwal_input('<?php echo $hari ?>','<?php echo $idtingkat ?>','<?php echo $row_kelas_detail->replid ?>','<?php echo $idguru ?>','<?php echo $data_hari->replid ?>')"><img src="assets/img/plus.png" /></a>
								<?php 
										}
									}  else {
										if($data_hari->istirahat == 0) {
									?>
											<a href="javascript:void(0);" name="Find" title="Input Jadwal" onClick="jadwal_update('<?php echo $hari ?>','<?php echo $idtingkat ?>','<?php echo $row_kelas_detail->replid ?>','<?php echo $idguru ?>','<?php echo $data_hari->replid ?>','<?php echo $data_jdl->replid ?>')" style="color: #ff0000" >
									<?php
											echo $data_jdl->kode_guru;
									?>
											</a>
									<?php
										}
									}
								?>		
							</td>
					<?php
							$j++;
						}
					?>
							
				</tr>
				
		<?php 
				$no++; 
			}
		
		?>
		
		<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
				
	</tbody>
</table>