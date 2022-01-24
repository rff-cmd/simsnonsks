<h3 class="header smaller lighter green">Nilai Raport</h3>
<div class="tabbable tabs-below">
	<div class="tab-content">
		<div id="semester1" class="tab-pane in active">
			<p>
				<?php
						$no=0;
						$sql=$select->list_siswa_raprt($nis, 1, $row_siswa->replid);
						$jmldata = $sql->rowCount();
				 ?>
				 
				 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
					<thead>
						<tr>
							<th colspan="3" style="color: #ff0000">Silakan isi sesuai nilai mata pelajaran yang ada</th>
						</tr>
						<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
							<th width="5%"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></th> 
							<th>Mata Pelajaran</th>
							<th>Nilai</th>		
						</tr>
					</thead>
					<tbody>
						<?php 
							
							$no = 0;
							while($row_counting_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
								
								$nilai = "";
								$nilai = $row_counting_detail->nilai;				
						?>								
							
							<input type="hidden" id="jmldata_raport" name="jmldata_raport" value="<?php echo $jmldata; ?>" >
							
							<input type="hidden" id="replid_un_<?php echo $no ?>" name="replid_un_<?php echo $no ?>" value="<?php echo $row_counting_detail->replid; ?>" >
							<input type="hidden" id="nama_<?php echo $no ?>" name="nama_<?php echo $no ?>" value="<?php echo $row_counting_detail->nama; ?>" >
							
							<tr style="background-color:ffffff;" > 
								
								<td>				
									<input type="text" id="no_<?php echo $no ?>" name="no_<?php echo $no ?>" class="form-control" readonly="" value="<?php echo $no + 1; ?>" >			
									
								</td>
								
								<td>
									<?php echo $row_counting_detail->nama; ?>		
								</td>
								
								<td align="center">
									<input type="text" id="nilai_<?php echo $no; ?>" name="nilai_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('nilai_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $nilai ?>" >
								</td>
												
							</tr>
							<?php 
													
								$no++; 
							} 
							
							?>
										
					</tbody>
				</table>
			</p>
		</div>
		
		<div id="semester2" class="tab-pane">
			<p>
				<?php
						$no=0;
						$sql=$select->list_siswa_raprt($nis, 2, $row_siswa->replid);
						$jmldata = $sql->rowCount();
				 ?>
				 
				 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
					<thead>
						<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
							<th width="5%"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></th> 
							<th>Mata Pelajaran</th>
							<th>Nilai</th>		
						</tr>
					</thead>
					<tbody>
						<?php 
							
							$no = 0;
							while($row_counting_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
								
								$nilai = "";
								$nilai = $row_counting_detail->nilai;				
						?>								
							
							<input type="hidden" id="jmldata_raport1" name="jmldata_raport1" value="<?php echo $jmldata; ?>" >
							
							<input type="hidden" id="replid_un1_<?php echo $no ?>" name="replid_un1_<?php echo $no ?>" value="<?php echo $row_counting_detail->replid; ?>" >
							<input type="hidden" id="nama1_<?php echo $no ?>" name="nama1_<?php echo $no ?>" value="<?php echo $row_counting_detail->nama; ?>" >
							
							<tr style="background-color:ffffff;" > 
								
								<td>				
									<input type="text" id="no1_<?php echo $no ?>" name="no1_<?php echo $no ?>" class="form-control" readonly="" value="<?php echo $no + 1; ?>" >			
									
								</td>
								
								<td>
									<?php echo $row_counting_detail->nama; ?>		
								</td>
								
								<td align="center">
									<input type="text" id="nilai1_<?php echo $no; ?>" name="nilai1_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('nilai1_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $nilai ?>" >
								</td>
												
							</tr>
							<?php 
													
								$no++; 
							} 
							
							?>
										
					</tbody>
				</table>
			</p>
		</div>
		
		<div id="semester3" class="tab-pane">
			<p>
				<?php
						$no=0;
						$sql=$select->list_siswa_raprt($nis, 3, $row_siswa->replid);
						$jmldata = $sql->rowCount();
				 ?>
				 
				 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
					<thead>
						<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
							<th width="5%"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></th> 
							<th>Mata Pelajaran</th>
							<th>Nilai</th>		
						</tr>
					</thead>
					<tbody>
						<?php 
							
							$no = 0;
							while($row_counting_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
								
								$nilai = "";
								$nilai = $row_counting_detail->nilai;				
						?>								
							
							<input type="hidden" id="jmldata_raport2" name="jmldata_raport2" value="<?php echo $jmldata; ?>" >
							
							<input type="hidden" id="replid_un2_<?php echo $no ?>" name="replid_un2_<?php echo $no ?>" value="<?php echo $row_counting_detail->replid; ?>" >
							<input type="hidden" id="nama2_<?php echo $no ?>" name="nama2_<?php echo $no ?>" value="<?php echo $row_counting_detail->nama; ?>" >
							
							<tr style="background-color:ffffff;" > 
								
								<td>				
									<input type="text" id="no2_<?php echo $no ?>" name="no2_<?php echo $no ?>" class="form-control" readonly="" value="<?php echo $no + 1; ?>" >			
									
								</td>
								
								<td>
									<?php echo $row_counting_detail->nama; ?>		
								</td>
								
								<td align="center">
									<input type="text" id="nilai2_<?php echo $no; ?>" name="nilai2_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('nilai2_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $nilai ?>" >
								</td>
												
							</tr>
							<?php 
													
								$no++; 
							} 
							
							?>
										
					</tbody>
				</table>
			</p>
		</div>

		<div id="semester4" class="tab-pane">
			<p>
				<?php
						$jmldata = 0;
						$sql=$select->list_siswa_raprt($nis, 4, $row_siswa->replid);
						$jmldata = $sql->rowCount();
				 ?>
				 
				 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
					<thead>
						<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
							<th width="5%"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></th> 
							<th>Mata Pelajaran</th>
							<th>Nilai</th>		
						</tr>
					</thead>
					<tbody>
						<?php 
							
							$no = 0;
							while($row_counting_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
								
								$nilai = "";
								$nilai = $row_counting_detail->nilai;								
						?>								
							
							<input type="hidden" id="jmldata_raport3" name="jmldata_raport3" value="<?php echo $jmldata; ?>" >
							
							<input type="hidden" id="replid_un3_<?php echo $no ?>" name="replid_un3_<?php echo $no ?>" value="<?php echo $row_counting_detail->replid; ?>" >
							<input type="hidden" id="nama3_<?php echo $no ?>" name="nama3_<?php echo $no ?>" value="<?php echo $row_counting_detail->nama; ?>" >
							
							<tr style="background-color:ffffff;" > 
								
								<td>				
									<input type="text" id="no3_<?php echo $no ?>" name="no3_<?php echo $no ?>" class="form-control" readonly="" value="<?php echo $no + 1; ?>" >			
									
								</td>
								
								<td>
									<?php echo $row_counting_detail->nama; ?>		
								</td>
								
								<td align="center">
									<input type="text" id="nilai3_<?php echo $no; ?>" name="nilai3_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('nilai3_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $nilai ?>" >
								</td>
												
							</tr>
							<?php 
													
								$no++; 
							} 
							
							?>
										
					</tbody>
				</table>
			</p>
		</div>

		<div id="semester5" class="tab-pane">
			<p>
				<?php
						$jmldata = 0;
						$sql=$select->list_siswa_raprt($nis, 5, $row_siswa->replid);
						$jmldata = $sql->rowCount();
				 ?>
				 
				 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
					<thead>
						<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
							<th width="5%"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></th> 
							<th>Mata Pelajaran</th>
							<th>Nilai</th>		
						</tr>
					</thead>
					<tbody>
						<?php 
							
							$no = 0;
							while($row_counting_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
								
								$nilai = "";
								$nilai = $row_counting_detail->nilai;								
						?>								
							
							<input type="hidden" id="jmldata_raport4" name="jmldata_raport4" value="<?php echo $jmldata; ?>" >
							
							<input type="hidden" id="replid_un4_<?php echo $no ?>" name="replid_un4_<?php echo $no ?>" value="<?php echo $row_counting_detail->replid; ?>" >
							<input type="hidden" id="nama4_<?php echo $no ?>" name="nama4_<?php echo $no ?>" value="<?php echo $row_counting_detail->nama; ?>" >
							
							<tr style="background-color:ffffff;" > 
								
								<td>				
									<input type="text" id="no4_<?php echo $no ?>" name="no4_<?php echo $no ?>" class="form-control" readonly="" value="<?php echo $no + 1; ?>" >			
									
								</td>
								
								<td>
									<?php echo $row_counting_detail->nama; ?>		
								</td>
								
								<td align="center">
									<input type="text" id="nilai4_<?php echo $no; ?>" name="nilai4_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('nilai4_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $nilai ?>" >
								</td>
												
							</tr>
							<?php 
													
								$no++; 
							} 
							
							?>
										
					</tbody>
				</table>
			</p>
		</div>
	</div>

	<ul class="nav nav-tabs" id="myTab2">
		<li class="active">
			<a data-toggle="tab" href="#semester1">Semester-1</a>
		</li>
		
		<li>
			<a data-toggle="tab" href="#semester2">Semester-2</a>
		</li>
		
		<li>
			<a data-toggle="tab" href="#semester3">Semester-3</a>
		</li>

		<li>
			<a data-toggle="tab" href="#semester4">Semester-4</a>
		</li>

		<li>
			<a data-toggle="tab" href="#semester5">Semester-5</a>
		</li>
	</ul>
</div>