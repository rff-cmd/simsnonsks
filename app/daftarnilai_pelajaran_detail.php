<div class="row">
	<div class="col-xs-12">
		<div class="clearfix">
			<div class="pull-right tableTools-container"></div>
		</div>
		<!-- div.dataTables_borderWrap -->
		<div>
			<table id="dynamic-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
                        <th class="center" style="font-weight:bold ">No.</th>
                        <!--<th style="font-weight:bold ">Unit &nbsp;&nbsp;</th>-->
						<th style="font-weight:bold ">Kode &nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Mata Pelajaran &nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Sifat/Tipe &nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Tipe Ekstrakurikuler &nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Input/Edit Nilai &nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Detail Nilai &nbsp;&nbsp;</th>
                            
					</tr>
				</thead>

				<tbody>
                    <?php			
						$i = 0;
						$sql=$select->list_pelajaran("ndf", "", "");
			            while($pelajaran_view=$sql->fetch(PDO::FETCH_OBJ)){
						
						$sifat = "";
						if($pelajaran_view->sifat == 1) {
								$sifat	=	"Wajib";
							}
							if($pelajaran_view->sifat == 0) {
								$sifat	=	"Ekstra Kurikuler";
							}
							
							$ekstra_sifat = "";
							if($pelajaran_view->ekstra_sifat == 1) {
								$ekstra_sifat	=	"Ekstrakurikuler Wajib";
							}
					$i++;
							
					?>
                                
                            <tr>
                                <td><?php echo $i ?></td>
                                <!--<td><?php echo $pelajaran_view->departemen ?></td>-->
								<td><?php echo $pelajaran_view->kode ?></td>
								<td><?php echo $pelajaran_view->nama ?></td>
								<td><?php echo $sifat ?></td>
								<td><?php echo $ekstra_sifat ?></td>
								<td><?php echo $pelajaran_view->keterangan ?></td>
								<td>
									<a href="javascript:void(0);" name="Find" title="Input Nilai" onClick="daftarnilai_input('<?php echo $pelajaran_view->replid ?>','<?php echo $idtingkat ?>','<?php echo $idkelas ?>','<?php echo $semester_id ?>','<?php echo $iddasarpenilaian ?>')"><img src="assets/img/plus.png" /></a>
								</td>
                                <td>
                                	<a href="javascript:void(0);" name="Find" title="Detail Nilai" onClick="jadwal_input('<?php echo $hari ?>','<?php echo $idtingkat ?>','<?php echo $row_kelas_detail->replid ?>','<?php echo $idguru ?>','<?php echo $data_hari->replid ?>')"><img src="assets/img/plus.png" /></a>
                                </td>								
								
							</tr>
                        
                        <?php
                            }
                        ?>
                        
				</tbody>
			</table>
		</div>
	</div>
</div>