<script type="text/javascript" src="js/buttonajax.js"></script>

<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('rpt_konseling_siswa') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
	}
</script>

<script>
    function submitForm(tipe)
    {
    	
		if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#rpt_konseling_siswa_view").attr('action', 'app/rpt_konseling_siswa_print.php')
			   .attr('target', '_BLANK');
			$("#rpt_konseling_siswa_view").submit();
			
		} 
		
		if(tipe == 'find') {
			$("#rpt_konseling_siswa_view").attr('action', '')
				.attr('target', '_self');
			$("#rpt_konseling_siswa_view").submit();
		}
		
		if(tipe == 'excel') {
			$("#rpt_konseling_siswa_view").attr('action', 'app/rpt_konseling_siswa_xls.php')
			   .attr('target', '_BLANK');
			$("#rpt_konseling_siswa_view").submit();
		}
		
  		return false;	 
    }
    
    function cetaknota(ref) 
	{	
		newWindow('app/kuitansijtt_multi.php?ref='+ ref +' ','Nota','800','500','resizable=1,scrollbars=1,status=0,toolbar=0');
	}
    //http://localhost/sekolahsma2/app/kuitansijtt_multi.php?ref=RCP-0716-00003
		
</script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		
		var str = str + '&button=' + button;
		
		
		if (window.XMLHttpRequest){
			request = new XMLHttpRequest();
			request.onreadystatechange = processStateChange;
			request.open("POST", URL, true);
			request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
			request.send(str);		
					
		} else if (window.ActiveXObject) {
			request = new ActiveXObject("Microsoft.XMLHTTP");
			if (request) {
				request.onreadystatechange = processStateChange;
				request.open("POST", URL, true);
				request.send();				
			}
		}
				
	}
	 
</script>

<?php
include 'class/class.select.view.php';
$select_view = new select_view;

$find  		= $_POST['submit'];
if($find == '') {
	
	$daritgl = date("d-m-Y");
	$ketgl	 = date("d-m-Y");
	
} else {
		
	$daritgl	= $_REQUEST['daritgl'];
	$ketgl		= $_REQUEST['ketgl'];
	$idtingkat	= $_REQUEST['idtingkat'];
	$idkelas	= $_REQUEST['idkelas'];
	$nama		= $_REQUEST['nama'];
	$all		= $_REQUEST['all'];
	
    if ($all == 1) {
        $all = "checked";
    }
}
		
?>


<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Filter</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="rpt_konseling_siswa_view" id="rpt_konseling_siswa_view" class="form-horizontal">
								<div>
									
									<table class="table" border="0">
										<tr>
											<td>Dari Tanggal</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="daritgl" class='datepick' id="daritgl" style="" value="<?php echo $daritgl ?>"></td>
											
											<td>&nbsp;&nbsp;</td>
											<td>s/d Tanggal</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="ketgl" class='datepick' id="ketgl" style="" value="<?php echo $ketgl ?>"></td>
											
										</tr>
										
										<tr>
											<td>Unit *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen" id="departemen" class="cho" style="width:100px;   font-size:12px; padding:0px; " onchange="loadHTMLPost2('app/rpt_konseling_siswa_ajax.php','idtingkat','gettingkat','departemen')" />
													<option value="">...</option>
													<?php select_departemen($departemen); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Tingkat</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idtingkat" id="idtingkat" style="min-width: 178px; height:27px; font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/rpt_konseling_siswa_ajax.php','idkelas','getkelas','idtingkat')" />
													<option value=""></option>
													<?php select_tingkat_unit($departemen, $idtingkat); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Kelas</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idkelas" id="idkelas" style="min-width: 178px; height:27px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php select_kelas($idtingkat, $idkelas); ?>
												</select>
											</td>
											
										</tr>
										
										<tr>
											<td>Nama</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="nama" id="nama" style="width:150px;  font-size:12px " value="<?php echo $nama ?>">
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Semua</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="all" name="all" value="1" <?php echo $all ?> />
											</td>											
										</tr>
										
										<tr>
											<td colspan="7">&nbsp;</td>
										</tr>
										
										<tr>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Preview" onclick="submitForm('find')" >
											</td>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Cetak" onclick="submitForm('print')" >
											</td>
											<!--<td></td>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Ekspor Excel" onclick="submitForm('excel')" >
											</td>-->											
										</tr>
										
									</table>
									
								</div>								
							</form>
						</div>	
					</div>
					
					<div class="box">
						<div class="box-head tabs">
							<h3>LAPORAN KONSELING SISWA</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
							
							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<div style="overflow:auto; ">
										<!--<table class="table" class='table table-striped dataTable table-bordered' style="font-size:11px; width:4000px ">-->
										
										<table class="table" class='table table-striped dataTable table-bordered' style="font-size:11px; ">
											<thead>
												<tr>
                                                    <th style="font-weight:bold ">Tanggal &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kelas &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Jenis Konseling &nbsp;&nbsp;</th>
													<!--<th style="font-weight:bold ">Konseling &nbsp;&nbsp;</th>-->
                                                    <!--<th style="font-weight:bold ">Solusi &nbsp;&nbsp;</th>-->
													<th style="font-weight:bold ">Petugas BK &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Download File &nbsp;&nbsp;</th>
																							
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$total = 0;
													
													$sql=$select_view->list_rpt_konseling_siswa($daritgl, $ketgl, $idtingkat, $idkelas, $nama, $all, $departemen);			
													
													while ($rpt_konseling_siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$tanggal = date("d-m-Y", strtotime($rpt_konseling_siswa_view->tanggal));	
														$kelas = $rpt_konseling_siswa_view->tingkat . '-' . $rpt_konseling_siswa_view->kelas;
                                                        $jenis_konseling = $rpt_konseling_siswa_view->idjenis_konseling;
                                                        if($jenis_konseling == 0) {
                                                            $jenis_konseling = "Kasus";
                                                        }
                                                        if($jenis_konseling == 1) {
                                                            $jenis_konseling = "Prestasi";
                                                        }
														
												?>
													
													<tr>
														<td><?php echo $tanggal ?></td>
                                                        <td><?php echo $rpt_konseling_siswa_view->nis ?></td>
														<td><?php echo $rpt_konseling_siswa_view->nama_siswa ?></td>
														<td><?php echo $kelas ?></td>
                                                        <td><?php echo $jenis_konseling ?></td>
														<!--<td><?php echo $rpt_konseling_siswa_view->konseling ?></td>
                                                        <td><?php echo $rpt_konseling_siswa_view->solusi ?></td>-->
														<td><?php echo $rpt_konseling_siswa_view->nama_pegawai ?></td>
														<td>
															<?php if($rpt_konseling_siswa_view->data_file != "") { ?>
																<a class="label label-success" href="app/konseling_siswa_download.php?ref=<?php echo $rpt_konseling_siswa_view->ref ?>" target="_blank" title="Download">Download
																</a>
															<?php } ?>
														</td>
														
													</tr>
																										
												<?php
												}
												?>
												
												
											</tbody>
											
										</table>	
										
										
										</div>
										
										
										<br>
									</div>
							</div>
						</div>
						
				</div>
			</div>

		</div>
	</div>
</div>