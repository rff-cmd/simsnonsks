<?php

$ref = $segmen3;

?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Cetak Izin Siswa</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="izin_siswa" id="izin_siswa" class="form-horizontal" >
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										if ($ref != "") {
											$sql=$select->list_izin_siswa($ref);			
											$izin_siswa_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$tanggal = date("d-m-Y", strtotime($izin_siswa_data->tanggal));
                                            $jam     = date("H", strtotime($izin_siswa_data->tanggal));
											$menit     = date("i", strtotime($izin_siswa_data->tanggal));
                                            
                                          
										}	
										
									?>
									<table class="table">
										<input type="hidden" id="replid" name="replid" value="<?php echo $ref ?>" >
										
										<tr>
											<td id="format_surat_id">
                                                <div class="box">
                                                    <div class="box-content box-nomargin">
                            							<textarea name="format_surat" id="format_surat" readonly="true" class='span12 cleditor'><?php echo $izin_siswa_data->format_surat ?></textarea>
                            						</div>
                                                </div>
                                            </td>
										</tr>
                                        
                                        
									</table>
									
									
								</div>								
							
						</div>	
						
								
										
						
						
						</form>
						
						<!--------------end Detail------------------ -->
					</div>
					
			</div>

		</div>
	</div>
</div>