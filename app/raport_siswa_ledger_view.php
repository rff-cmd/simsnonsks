<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
include 'class/class.select.php';
include 'class/class.selectview.php';
$select = new select;
$selectview = new selectview;

$idtahunajaran 	= $_REQUEST['idtahunajaran2'];
$semester_id= $_REQUEST['semester_id'];
$idtingkat	= $_REQUEST['idtingkat'];
$idkelas	= $_REQUEST['idkelas'];
$kelamin	= $_REQUEST['kelamin'];
$nama		= $_REQUEST['nama'];
$nis		= $_REQUEST['nis'];
$nik		= $_REQUEST['nik'];
$all		= $_REQUEST['all'];

if($_SESSION["adm"] == 0) {
	if($_SESSION["tipe_user"] == "Siswa") {
		$idtahunajaran 	= $_SESSION['idtahunajaran'];
		$semester_id= $_REQUEST['semester_id']; //$_SESSION["semester_id"];
		$idkelas	= $_SESSION["idkelas"];
		$idtingkat	= $_SESSION["idtingkat"];
		$nama 		= $_SESSION["nama"];	
		$nis		= $_SESSION['nis'];
		$nik		= $_SESSION['nik'];
		$all		= "";
		$all2 		= "";
	}
	
	if(!empty($_SESSION["idpegawai"])) {
		$sqlpeg = $select->list_pegawai($_SESSION["idpegawai"]);
		$datapeg = $sqlpeg->fetch(PDO::FETCH_OBJ);
		
		$sqlpa=$select->list_kelas("", "", $datapeg->nip);
		$datapa=$sqlpa->fetch(PDO::FETCH_OBJ);
				
		$semester_id= $_REQUEST['semester_id']; //$_SESSION["semester_id"];
		$idkelas	= $datapa->replid;
		$idtingkat 	= $datapa->idtingkat;
		$nama		= $_REQUEST['nama'];
		$nis		= $_REQUEST['nis'];
		$nik		= $_REQUEST['nik'];
		$all		= "";
		$all2 		= "";
	}
}

if($idtahunajaran == "") {
	$idtahunajaran = $_SESSION["idtahunajaran"];
}

?>

<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/font-awesome/4.2.0/css/font-awesome.min.css" />

<!-- page specific plugin styles -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/jquery-ui.custom.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/chosen.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/datepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/colorpicker.min.css" />


<!-- text fonts -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/fonts/fonts.googleapis.com.css" />

<!-- ace styles -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />


<!-- ace settings handler -->
<script src="../<?php echo $__folder ?>assets/js/ace-extra.min.js"></script>


<div class="page-content">						
	<div class="row">
		<div class="col-xs-12">
      <!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<div class="clearfix">
						<div class="pull-right tableTools-container"></div>
					</div>
					<!-- div.dataTables_borderWrap -->
					<div>
						
						<?php
							$numeric_semester = numeric_semester($idtingkat, $semester_id);
							$sqlso=$select->list_tingkat($idtingkat);
	    					$row_so=$sqlso->fetch(PDO::FETCH_OBJ);
	    					
	    					$sqlkelas=$select->list_kelas($idkelas);
	    					$row_kelas=$sqlkelas->fetch(PDO::FETCH_OBJ);
	    				?>
						<table class="table table-striped table-hover">
							<body>
								<tr>
		                        	<td width="15%">Semester</td>
		                        	<td width="2%">:</td>
		                        	<td><?php echo $numeric_semester ?></td>
		                        </tr>
		                        <tr>
		                        	<td width="15%">Tingkat/Kelas</td>
		                        	<td width="2%">:</td>
		                        	<td><?php echo $row_so->tingkat . ' ' . $row_kelas->kelas ?></td>
		                        </tr>
	                       </body>
	                    </table>
	                    
						<?php
							$pelajaran_id = array();
							
							$sql2=$selectview->list_kartu_rencana_studi('', '', $idtingkat, $semester_id, '', $idtahunajaran, 1); 				
							$rowsmp = $sql2->rowCount();
						?>
	                    
						<table class="table table-striped table-bordered table-hover" style="font-size: 14px">
							<thead>
								
								<tr>
		                        	<td align="center" rowspan="4">No.</td>
		                        	<td align="center" rowspan="4">NIS</td>
		                        	<td align="center" rowspan="4">NISN</td>
		                        	<td align="center" valign="bottom" rowspan="4">Nama</td>
		                        	<td align="center" colspan="<?php echo $rowsmp * 4 ?>">Mata Pelajaran</td>
		                        	<!--<td align="center" rowspan="4">Rangking</td>-->
		                        </tr>		                        
		                        <tr>
		                        	<?php 
                            			while($row_mapel=$sql2->fetch(PDO::FETCH_OBJ)) {
                            				$pelajaran_id[] = $row_mapel->pelajaran_id;
                            				
                            		?>
                            		
                            			<td colspan="4"><?php echo $row_mapel->nama_pelajaran ?></td>
                            		<?php
                            			}
                            		?>
		                        </tr>
		                        <tr>
		                        	<?php for($r=0; $r<$rowsmp; $r++) { ?>
			                        	<td align="center" colspan="2">P</td>
			                        	<td align="center" colspan="2">K</td>
		                        	<?php } ?>
		                        </tr>
		                        <tr>
		                        	<?php for($r=0; $r<$rowsmp*2; $r++) { ?>
			                        	<td align="center">Nilai</td>
			                        	<td align="center">Predikat</td>
		                        	<?php } ?>
		                        </tr>
	                       </thead>
                      
	                      	<tbody>
	                      		   						
	    	                    <?php
	    	                    	//get Predikat
									$sqlpredikat = $selectview->list_predikat_raport_1($_SESSION["idangkatan"]);
									$data_predikat = $sqlpredikat->fetch(PDO::FETCH_OBJ);
									$kkm			=	$data_predikat->kkm;
									$nilai_angka_a	=	$data_predikat->nilai_angka_a;
									$nilai_angka_a1	=	$data_predikat->nilai_angka_a1;
									$nilai_angka_b	=	$data_predikat->nilai_angka_b;
									$nilai_angka_b1	=	$data_predikat->nilai_angka_b1;
									$nilai_angka_c	=	$data_predikat->nilai_angka_c;
									$nilai_angka_c1	=	$data_predikat->nilai_angka_c1;
									$nilai_angka_d	=	$data_predikat->nilai_angka_d;
									$nilai_angka_d1	=	$data_predikat->nilai_angka_d1;
												
									$sql=$selectview->list_siswa($nis, '', $idtingkat, $idkelas, $nama, $all, 'SMA', $nik, $kelamin, 1);
									while($siswa_view=$sql->fetch(PDO::FETCH_OBJ)){
									
									$i++;
										if($siswa_view->kelamin == "P") {
											$kelamin = "Perempuan";
										} else {
											$kelamin = "Laki-laki";
										}
										
										$total_nilai_p = 0;										
								?>
                                            
                                    <tr>
                                        <td align="center"><?php echo $i ?></td>
                                        <td><?php echo $siswa_view->nis ?></td>
										<td><?php echo $siswa_view->nisn ?></td>
										<td><?php echo $siswa_view->nama ?></td>
										<?php for($r=0; $r<count($pelajaran_id); $r++) { ?>
											<!--Pengetahuan(Nilai)-->
				                        	<td align="center">
				                        		<?php 
				                        			$nilai_p = 0;
													$sqlnilai 	= $selectview->list_daftarnilai2($siswa_view->replid, $idtingkat, $idkelas, $idtahunajaran, $semester_id, $pelajaran_id[$r], 3);
													$data_nilai_p	= $sqlnilai->fetch(PDO::FETCH_OBJ);
													$nilai_p		= $data_nilai_p->na;
													if($nilai_p >0 ) {
														echo number_format($nilai_p,0,'.',','); 
														
														$total_nilai_p = $total_nilai_p + $nilai_p;
													}
				                        		?>		
				                        	</td>
				                        	
				                        	<!--Pengetahuan(Predikat)-->
				                        	<td align="center">
				                        		<?php 
				                        			if($nilai_p >0 ) {
					                        			$predikat_p = "";
														if($nilai_p < $nilai_angka_d) {
															$predikat_p = "D";
														}
														if($nilai_p >= $nilai_angka_c && $nilai_p <= $nilai_angka_c1) {
															$predikat_p = "C";
														}
														if($nilai_p >= $nilai_angka_b && $nilai_p <= $nilai_angka_b1 ) {
															$predikat_p = "B";
														}
														if($nilai_p >= $nilai_angka_a && $nilai_p <= $nilai_angka_a1 ) {
															$predikat_p = "A";
														}
														echo $predikat_p; 
													}
				                        		?>		
				                        	</td>
				                        	
				                        	<!--Keterampilan(Nilai)-->
				                        	<td align="center">
				                        		<?php 
				                        			$nilai_k = 0;
													$sqlnilai 	= $selectview->list_daftarnilai2($siswa_view->replid, $idtingkat, $idkelas, $idtahunajaran, $semester_id, $pelajaran_id[$r], 4);
													$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
													$nilai_k		= $data_nilai_k->na;
													if($nilai_k >0 ) {
														echo number_format($nilai_k,0,'.',','); 
													}
				                        		?>		
				                        	</td>
				                        	
				                        	<!--Keterampilan(Predikat)-->
				                        	<td align="center">
				                        		<?php 
				                        			if($nilai_k >0 ) {
					                        			$predikat_k = "";
														if($nilai_k < $nilai_angka_d) {
															$predikat_k = "D";
														}
														if($nilai_k >= $nilai_angka_c && $nilai_k <= $nilai_angka_c1) {
															$predikat_k = "C";
														}
														if($nilai_k >= $nilai_angka_b && $nilai_k <= $nilai_angka_b1 ) {
															$predikat_k = "B";
														}
														if($nilai_k >= $nilai_angka_a && $nilai_k <= $nilai_angka_a1 ) {
															$predikat_k = "A";
														}
														echo $predikat_k; 
													}
				                        		?>		
				                        	</td>
			                        	<?php } ?>
			                        	<!--<td><?php echo $total_nilai_p ?></td>-->
									</tr>
                                
                                <?php
                                    }
                                ?>
	                        
	                        
	                     		</tbody>
	                     		
	                     		<!--<tr>
	                                <td colspan="4" align="right">TOTAL</td>
	                                <td align="center"><?php echo number_format($total_qty_so,0,'.',',') ?></td>
	    	                    	<td align="center"><?php echo number_format($total_qty_so_verivication,0,'.',',') ?></td>
	    	                    	<td align="center"><?php echo number_format($total_qty_print,0,'.',',') ?></td>
	    	                    	<td align="center"><?php echo number_format($total_qty_press,0,'.',',') ?></td>
	    	                    	<td align="center"><?php echo number_format($total_qty_sewing,0,'.',',') ?></td>
	    	                    </tr>-->
							</table>
						</div>
					</div>
				</div>

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
