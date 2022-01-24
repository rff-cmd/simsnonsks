<script type="text/javascript" src="<?php echo $__folder ?>js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='nip') {
			alert('NIP tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='nama') {
			alert('Nama Pegawai tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='bagian') {
			alert('Bagian tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='kelamin') {
			alert('Jenis Kelamin tidak boleh kosong!');				
		  }
		  
		  return false
		} 
										
	  }		 
	}	
</script>

<script>
	function formatangka(field) {
		 //a = rci.amt.value;	 
		 a = document.getElementById(field).value;
		 //alert(a);
		 b = a.replace(/[^\d-.]/g,""); //b = a.replace(/[^\d]/g,"");
		 c = "";
		 panjang = b.length;
		 j = 0;
		 for (i = panjang; i > 0; i--)
		 {
			 j = j + 1;
			 if (((j % 3) == 1) && (j != 1))
			 {
			 	c = b.substr(i-1,1) + "," + c;
			 } else {
			 	c = b.substr(i-1,1) + c;
			 }
		 }
		 //rci.amt.value = c;
		 c = c.replace(",.",".");
		 c = c.replace(".,",".");
		 document.getElementById(field).value = c;		
		 
	}
	
    function submitForm(tipe)
    {
		/*if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#delord_view").attr('action', 'app/delord_print.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
		if(tipe == 'find') {
			$("#laborder").attr('action', '')
				.attr('target', '_self');
			$("#laborder").submit();
		}
		
		if(tipe == 'list') {
			$("#dinasluar").attr('action', "main.php?menu=app&act=dinasluar_view")
				.attr('target', '_self');
			$("#dinasluar").submit();
		}
		
		/*if(tipe == 'excel') {
			$("#delord_view").attr('action', 'app/delord_xls.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
  		return false;	 
    }
		
</script>
<!--<script type="text/javascript" src="jsdynamic/jquery.min.js"></script>-->

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		//str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
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

<script type="text/javascript">
	<!--
	var request;
	var dest;
	
	function loadHTMLPost3(URL, destination, button, getId, getId2){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;
		str2 = getId2 + '=' + document.getElementById(getId2).value;
		
		var str = str + '&button=' + button;
		var str2 = str2 + '&button=' + button;
		var str = str + '&' + str2;
				
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
			
	//-->	 
	
</script>
            
                        
<div class="page-content">
      
	<div class="row">
		<div class="col-xs-12">
            
            <?php 
				$ref = $segmen3; //$_GET['search'];
				
				//jika saat add data, maka data setelah save kosong
				if ($_POST['submit'] == 'Save') { $ref = ''; }
				//-----------------------------------------------/\
				
				$ref2 = notran(date('y-m-d'), 'frmpegawai', '', '', ''); //---get no ref
						
				include("app/exec/insert_pegawai.php");
				
				if ($ref != "") {
					$sql=$select->list_pegawai($ref);			
					$pegawai=$sql->fetch(PDO::FETCH_OBJ);
					
					$replid 		= $pegawai->replid;
					$tgllahir		= date("d-m-Y", strtotime($pegawai->tgllahir));
					
					if($tgllahir=='01-01-1970') { $tgllahir = ''; }
					
					if($pegawai->nikah == "sudah") { $nikah = "checked"; }
					if($pegawai->nikah == "belum") { $nikah1 = "checked"; }
					
					$bagian		= 	str_replace(" ","|",$pegawai->bagian);
					
					$idjenis_sertifikasi = $pegawai->idjenis_sertifikasi;
					
					$tmt_cpns		= date("d-m-Y", strtotime($pegawai->tmt_cpns));
					if($tmt_cpns=='01-01-1970') { $tmt_cpns = ''; }
					
					$unit_cpns		= date("d-m-Y", strtotime($pegawai->unit_cpns));	
					if($unit_cpns=='01-01-1970') { $unit_cpns = ''; }	
					
					$tanggal_lahir_pasangan = date("d-m-Y", strtotime($pegawai->tanggal_lahir_pasangan));
					if($tanggal_lahir_pasangan=='01-01-1970') { $tanggal_lahir_pasangan = ''; }
					$tanggal_nikah	= date("d-m-Y", strtotime($pegawai->tanggal_nikah));	
					if($tanggal_nikah=='01-01-1970') { $tanggal_nikah = ''; }								
					$tanggal_pensiun = date("d-m-Y", strtotime($pegawai->tanggal_pensiun));	
					if($tanggal_pensiun=='01-01-1970') { $tanggal_pensiun = ''; }
					
					$tgllahir_usia = date("Y-m-d", strtotime($tgllahir));
					$usia = datediff($tgllahir_usia, date("Y-m-d"));
					$usia = $usia["years"];
					
					$tanggal_sk_tetap = date("d-m-Y", strtotime($pegawai->tanggal_sk_tetap));
					if($tanggal_sk_tetap=='01-01-1970') { $tanggal_sk_tetap = ''; }
					
				}	
			?>
            
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal" role="form" action="" method="post" name="pegawai" id="pegawai" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('bagian,nip,nama,kelamin');" >
            	
            	<input type="hidden" id="id" name="id" value="<?php echo $pegawai->replid ?>" >
				<input type="hidden" id="old_nip" name="old_nip" value="<?php echo $pegawai->nip ?>" >
				
				<div class="row">
					<div class="col-sm-6">
						<div class="row">
						
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bagian *)</label>
								<div class="col-sm-6">
									<select name="bagian" id="bagian" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_bagianpegawai($bagian); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Photo</label>
								<div class="col-sm-6">
									<input type="file" id="foto_file" name="foto_file" />
			                        <br />
			        				<?php if (!empty($pegawai->foto_file)) { ?>
			        					<img src="app/photo_pegawai/<?php echo $pegawai->foto_file; ?>" width="150" height="150" />
			        				<?php } ?>
			                        <input size="25" type="hidden" id="photo2" name="photo2" value="<?php echo $pegawai->foto_file; ?>">  
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">NIP *)</label>
								<div class="col-sm-6" id="nip_id">
									<?php if($ref == "") { ?>
										<input type="text" name="nip" id="nip" class="form-control" value="<?php echo $pegawai->nip; ?>" onblur="loadHTMLPost3('<?php echo $__folder ?>app/pegawai_ajax.php','nip_id','ceknip','old_nip','nip')" >
									<?php } else { ?>
										<input type="text" name="nip" id="nip" class="form-control" value="<?php echo $pegawai->nip; ?>" onblur="loadHTMLPost3('<?php echo $__folder ?>app/pegawai_ajax.php','nip_id','ceknip2','old_nip','nip')" >
									<?php } ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama *)</label>
								<div class="col-sm-6">
									<input type="text" id="nama" name="nama" class="form-control" value="<?php echo $pegawai->nama ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Panggilan</label>
								<div class="col-sm-6">
									<input type="text" id="panggilan" name="panggilan" class="form-control" value="<?php echo $pegawai->panggilan ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jenis Kelamin *)</label>
								<div class="col-sm-6">
									<select name="kelamin" id="kelamin" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_kelamin($pegawai->kelamin); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Gelar</label>
								<div class="col-sm-6">
									<input type="text" name="gelar" id="gelar" class="form-control" value="<?php echo $pegawai->gelar; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tempat Lahir</label>
								<div class="col-sm-6">
									<input type="text" id="tmplahir" name="tmplahir" class="form-control" value="<?php echo $pegawai->tmplahir ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Karpeg</label>
								<div class="col-sm-6">
									<input type="text" name="karpeg" id="karpeg" class="form-control" value="<?php echo $pegawai->karpeg; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal Lahir</label>
								<div class="col-sm-6">
									<input type="text" id="tgllahir" name="tgllahir" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $tgllahir ?>">
									&nbsp;&nbsp;Usia :&nbsp;<input type="text" name="usia" id="usia" readonly="" class="form-control" value="<?php echo $usia; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No. Peserta Sertifikasi</label>
								<div class="col-sm-6">
									<input type="text" name="no_sertifikasi" id="no_sertifikasi" class="form-control" value="<?php echo $pegawai->no_sertifikasi; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jenis Sertifikasi</label>
								<div class="col-sm-6">
									<select name="idjenis_sertifikasi" id="idjenis_sertifikasi" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_jenis_sertifikasi($idjenis_sertifikasi); ?>
									</select>
								</div>
							</div>
												
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">NIK</label>
								<div class="col-sm-6">
									<input type="text" name="nik" id="nik" class="form-control" value="<?php echo $pegawai->nik; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Agama</label>
								<div class="col-sm-6">
									<select name="agama" id="agama" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_agama($pegawai->agama); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Suku</label>
								<div class="col-sm-6">
									<select name="suku" id="suku" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_suku($pegawai->suku); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">NUPTK</label>
								<div class="col-sm-6">
									<input type="text" name="nuptk" id="nuptk" class="form-control" value="<?php echo $pegawai->nuptk; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Menikah</label>
								<div class="col-sm-6">
									<input type="radio" id="nikah" name="nikah" class="ace" value="sudah" <?php echo $nikah ?> ><span class="lbl">Sudah&nbsp;&nbsp;</span>
									<input type="radio" id="nikah1" name="nikah" class="ace" value="belum" <?php echo $nikah1 ?> ><span class="lbl">Belum</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jenis Identitas</label>
								<div class="col-sm-6">
									<select name="jenis_id" id="jenis_id" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_jenis_id($pegawai->jenis_id); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No Identitas</label>
								<div class="col-sm-6">
									<input type="text" name="noid" id="noid" class="form-control" value="<?php echo $pegawai->noid ?>">
								</div>
							</div>
												
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Alamat</label>
								<div class="col-sm-6">
									<textarea name="alamat" id="alamat" class="form-control" ><?php echo $pegawai->alamat ?></textarea>			
								</div>
							</div>
							
						</div>
					</div>
				
				
					<!--SETUP UJIAN NEGARA-->
					<div class="col-sm-6">
						<div class="row">
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">TMT di SMAN 3</label>
								<div class="col-sm-6">
									<input type="text" name="unit_cpns" id="unit_cpns" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $unit_cpns; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No. SK CPNS</label>
								<div class="col-sm-6">
									<input type="text" name="no_sk_masuk" id="no_sk_masuk" class="form-control" value="<?php echo $pegawai->no_sk_masuk; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">TMT SK CPNS</label>
								<div class="col-sm-6">
									<input type="text" name="tmt_cpns" id="tmt_cpns" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $tmt_cpns ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No. SK PNS</label>
								<div class="col-sm-6">
									<input type="text" name="no_sk_tetap" id="no_sk_tetap" class="form-control" value="<?php echo $pegawai->no_sk_tetap; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">TMT SK PNS</label>
								<div class="col-sm-6">
									<input type="text" name="tanggal_sk_tetap" id="tanggal_sk_tetap" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $tanggal_sk_tetap ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Status Pegawai</label>
								<div class="col-sm-6">
									<select name="idstatus_pegawai" id="idstatus_pegawai" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_status_pegawai($pegawai->idstatus_pegawai); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Banyak Jam ditempat lain</label>
								<div class="col-sm-6">
									<input type="text" name="jumlah_jam_ajar_lain" id="jumlah_jam_ajar_lain" class="form-control" value="<?php echo $pegawai->jumlah_jam_ajar_lain ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Desa/Kelurahan</label>
								<div class="col-sm-6">
									<input type="text" name="desa" id="desa" class="form-control" value="<?php echo $pegawai->desa; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kecamatan</label>
								<div class="col-sm-6">
									<input type="text" name="kecamatan" id="kecamatan" class="form-control" value="<?php echo $pegawai->kecamatan ?>">
								</div>
							</div>
							
												
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kode Pos</label>
								<div class="col-sm-6">
									<input type="text" name="kode_pos" id="kode_pos" class="form-control" value="<?php echo $pegawai->kode_pos; ?>" >
								</div>
							</div>
							
							
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">E-mail</label>
								<div class="col-sm-6">
									<input type="text" name="email" id="email" class="form-control" value="<?php echo $pegawai->email ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No. HP</label>
								<div class="col-sm-6">
									<input type="text" name="handphone" id="handphone" class="form-control" value="<?php echo $pegawai->handphone ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No. Telepon</label>
								<div class="col-sm-6">
									<input type="text" name="telpon" id="telpon" class="form-control" value="<?php echo $pegawai->telpon ?>">										
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Ibu Kandung</label>
								<div class="col-sm-6">
									<input type="text" name="nama_ibu" id="nama_ibu" class="form-control" value="<?php echo $pegawai->nama_ibu; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">NPWP</label>
								<div class="col-sm-6">
									<input type="text" name="npwp" id="npwp" class="form-control" value="<?php echo $pegawai->npwp; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Bank</label>
								<div class="col-sm-6">
										<input type="text" name="nama_bank" id="nama_bank" class="form-control" value="<?php echo $pegawai->nama_bank; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Unit Bank</label>
								<div class="col-sm-6">
									<input type="text" name="unit_bank" id="unit_bank" class="form-control" value="<?php echo $pegawai->unit_bank ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Pemilik Bank</label>
								<div class="col-sm-6" id="kecamatan">
									<input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control" value="<?php echo $pegawai->nama_pemilik ?>">
								</div>
							</div>				
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No Rekening</label>
								<div class="col-sm-6">
									<input type="text" name="no_rek" id="no_rek" class="form-control" value="<?php echo $pegawai->no_rek; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal Pensiun</label>
								<div class="col-sm-6">
									<input type="text" name="tanggal_pensiun" id="tanggal_pensiun" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $tanggal_pensiun ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Keterangan</label>
								<div class="col-sm-6">
									<textarea name="keterangan" id="keterangan" class="form-control"><?php echo $pegawai->keterangan ?></textarea>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<div class="space-4"></div>

				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
                        
                        <?php if (allowupd('frmpegawai')==1) { ?>
                            <?php if($ref!='') { ?>
    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
    						<?php } ?>
                        <?php } ?>
						
                        <?php if (allowadd('frmpegawai')==1) { ?>
    						<?php if($ref=='') { ?>
    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
    						<?php } ?>
                        <?php } ?>
                        
                        <?php if (allowdel('frmpegawai')==1) { ?>
                            &nbsp;
    						<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
                        <?php } ?>
                        
						&nbsp;
						<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('pegawai_view') ?>'" />
                                                
                                 
					</div>
				</div>

			</form>
            
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->


<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='<?php echo $__folder ?>assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo $__folder ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo $__folder ?>assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
  <script src="<?php echo $__folder ?>assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo $__folder ?>assets/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/chosen.jquery.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/fuelux.spinner.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/moment.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.knob.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.autosize.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-tag.min.js"></script>

<script src="<?php echo $__folder ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/dataTables.colVis.min.js"></script>

<!-- ace scripts -->
<script src="<?php echo $__folder ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		
		$('#id-disable-check').on('click', function() {
			var inp = $('#form-input-readonly').get(0);
			if(inp.hasAttribute('disabled')) {
				inp.setAttribute('readonly' , 'true');
				inp.removeAttribute('disabled');
				inp.value="This text field is readonly!";
			}
			else {
				inp.setAttribute('disabled' , 'disabled');
				inp.removeAttribute('readonly');
				inp.value="This text field is disabled!";
			}
		});
	
	
		if(!ace.vars['touch']) {
			$('.chosen-select').chosen({allow_single_deselect:true}); 
			//resize the chosen on window resize
	
			$(window)
			.off('resize.chosen')
			.on('resize.chosen', function() {
				$('.chosen-select').each(function() {
					 var $this = $(this);
					 $this.next().css({'width': $this.parent().width()});
				})
			}).trigger('resize.chosen');
			//resize chosen on sidebar collapse/expand
			$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
				if(event_name != 'sidebar_collapsed') return;
				$('.chosen-select').each(function() {
					 var $this = $(this);
					 $this.next().css({'width': $this.parent().width()});
				})
			});
	
	
			$('#chosen-multiple-style .btn').on('click', function(e){
				var target = $(this).find('input[type=radio]');
				var which = parseInt(target.val());
				if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
				 else $('#form-field-select-4').removeClass('tag-input-style');
			});
		}
	
	
		$('[data-rel=tooltip]').tooltip({container:'body'});
		$('[data-rel=popover]').popover({container:'body'});
		
		$('textarea[class*=autosize]').autosize({append: "\n"});
		$('textarea.limited').inputlimiter({
			remText: '%n character%s remaining...',
			limitText: 'max allowed : %n.'
		});
	
		$.mask.definitions['~']='[+-]';
		$('.input-mask-date').mask('99/99/9999');
		$('.input-mask-phone').mask('(999) 999-9999');
		$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
		$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
	
	
	
		$( "#input-size-slider" ).css('width','200px').slider({
			value:1,
			range: "min",
			min: 1,
			max: 8,
			step: 1,
			slide: function( event, ui ) {
				var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
				var val = parseInt(ui.value);
				$('#form-field-4').attr('class', sizing[val]).val('.'+sizing[val]);
			}
		});
	
		$( "#input-span-slider" ).slider({
			value:1,
			range: "min",
			min: 1,
			max: 12,
			step: 1,
			slide: function( event, ui ) {
				var val = parseInt(ui.value);
				$('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
			}
		});
	
	
		
		//"jQuery UI Slider"
		//range slider tooltip example
		$( "#slider-range" ).css('height','200px').slider({
			orientation: "vertical",
			range: true,
			min: 0,
			max: 100,
			values: [ 17, 67 ],
			slide: function( event, ui ) {
				var val = ui.values[$(ui.handle).index()-1] + "";
	
				if( !ui.handle.firstChild ) {
					$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
					.prependTo(ui.handle);
				}
				$(ui.handle.firstChild).show().children().eq(1).text(val);
			}
		}).find('span.ui-slider-handle').on('blur', function(){
			$(this.firstChild).hide();
		});
		
		
		$( "#slider-range-max" ).slider({
			range: "max",
			min: 1,
			max: 10,
			value: 2
		});
		
		$( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
			// read initial values from markup and remove that
			var value = parseInt( $( this ).text(), 10 );
			$( this ).empty().slider({
				value: value,
				range: "min",
				animate: true
				
			});
		});
		
		$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
	
		
		$('#photo , #photo_1, #photo_2, #photo_3, #photo_4').ace_file_input({
			no_file:'No File ...',
			btn_choose:'Choose',
			btn_change:'Change',
			droppable:false,
			onchange:null,
			thumbnail:false //| true | large
			//whitelist:'gif|png|jpg|jpeg'
			//blacklist:'exe|php'
			//onchange:''
			//
		});
		//pre-show a file name, for example a previously selected file
		//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
	
	
		$('#id-input-file-3').ace_file_input({
			style:'well',
			btn_choose:'Drop files here or click to choose',
			btn_change:null,
			no_icon:'ace-icon fa fa-cloud-upload',
			droppable:true,
			thumbnail:'small'//large | fit
			//,icon_remove:null//set null, to hide remove/reset button
			/**,before_change:function(files, dropped) {
				//Check an example below
				//or examples/file-upload.html
				return true;
			}*/
			/**,before_remove : function() {
				return true;
			}*/
			,
			preview_error : function(filename, error_code) {
				//name of the file that failed
				//error_code values
				//1 = 'FILE_LOAD_FAILED',
				//2 = 'IMAGE_LOAD_FAILED',
				//3 = 'THUMBNAIL_FAILED'
				//alert(error_code);
			}
	
		}).on('change', function(){
			//console.log($(this).data('ace_input_files'));
			//console.log($(this).data('ace_input_method'));
		});
		
		
		//$('#id-input-file-3')
		//.ace_file_input('show_file_list', [
			//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
			//{type: 'file', name: 'hello.txt'}
		//]);
	
		
		
	
		//dynamically change allowed formats by changing allowExt && allowMime function
		$('#id-file-format').removeAttr('checked').on('change', function() {
			var whitelist_ext, whitelist_mime;
			var btn_choose
			var no_icon
			if(this.checked) {
				btn_choose = "Drop images here or click to choose";
				no_icon = "ace-icon fa fa-picture-o";
	
				whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
				whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
			}
			else {
				btn_choose = "Drop files here or click to choose";
				no_icon = "ace-icon fa fa-cloud-upload";
				
				whitelist_ext = null;//all extensions are acceptable
				whitelist_mime = null;//all mimes are acceptable
			}
			var file_input = $('#id-input-file-3');
			file_input
			.ace_file_input('update_settings',
			{
				'btn_choose': btn_choose,
				'no_icon': no_icon,
				'allowExt': whitelist_ext,
				'allowMime': whitelist_mime
			})
			file_input.ace_file_input('reset_input');
			
			file_input
			.off('file.error.ace')
			.on('file.error.ace', function(e, info) {
				//console.log(info.file_count);//number of selected files
				//console.log(info.invalid_count);//number of invalid files
				//console.log(info.error_list);//a list of errors in the following format
				
				//info.error_count['ext']
				//info.error_count['mime']
				//info.error_count['size']
				
				//info.error_list['ext']  = [list of file names with invalid extension]
				//info.error_list['mime'] = [list of file names with invalid mimetype]
				//info.error_list['size'] = [list of file names with invalid size]
				
				
				/**
				if( !info.dropped ) {
					//perhapse reset file field if files have been selected, and there are invalid files among them
					//when files are dropped, only valid files will be added to our file array
					e.preventDefault();//it will rest input
				}
				*/
				
				
				//if files have been selected (not dropped), you can choose to reset input
				//because browser keeps all selected files anyway and this cannot be changed
				//we can only reset file field to become empty again
				//on any case you still should check files with your server side script
				//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
			});
		
		});
	
		$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
		.closest('.ace-spinner')
		.on('changed.fu.spinbox', function(){
			//alert($('#spinner1').val())
		}); 
		$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
		$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
		$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
	
		//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
		//or
		//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
		//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
	
	
		//datepicker plugin
		//link
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
	
		//or change it into a date range picker
		$('.input-daterange').datepicker({autoclose:true});
	
	
		//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
		$('input[name=date-range-picker]').daterangepicker({
			'applyClass' : 'btn-sm btn-success',
			'cancelClass' : 'btn-sm btn-default',
			locale: {
				applyLabel: 'Apply',
				cancelLabel: 'Cancel',
			}
		})
		.prev().on(ace.click_event, function(){
			$(this).next().focus();
		});
	
	
		$('#timepicker1').timepicker({
			minuteStep: 1,
			showSeconds: true,
			showMeridian: false
		}).next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		
		$('#date-timepicker1').datetimepicker().next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		
	
		$('#colorpicker1').colorpicker();
	
		$('#simple-colorpicker-1').ace_colorpicker();
		//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
		//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
		//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
		//picker.pick('red', true);//insert the color if it doesn't exist
	
	
		$(".knob").knob();
		
		
		var tag_input = $('#form-field-tags');
		try{
			tag_input.tag(
			  {
				placeholder:tag_input.attr('placeholder'),
				//enable typeahead by specifying the source array
				source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
				/**
				//or fetch data from database, fetch those that match "query"
				source: function(query, process) {
				  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
				  .done(function(result_items){
					process(result_items);
				  });
				}
				*/
			  }
			)
	
			//programmatically add a new
			var $tag_obj = $('#form-field-tags').data('tag');
			$tag_obj.add('Programmatically Added');
		}
		catch(e) {
			//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
			tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
			//$('#form-field-tags').autosize({append: "\n"});
		}
		
		
		/////////
		$('#modal-form input[type=file]').ace_file_input({
			style:'well',
			btn_choose:'Drop files here or click to choose',
			btn_change:null,
			no_icon:'ace-icon fa fa-cloud-upload',
			droppable:true,
			thumbnail:'large'
		})
		
		//chosen plugin inside a modal will have a zero width because the select element is originally hidden
		//and its width cannot be determined.
		//so we set the width after modal is show
		$('#modal-form').on('shown.bs.modal', function () {
			if(!ace.vars['touch']) {
				$(this).find('.chosen-container').each(function(){
					$(this).find('a:first-child').css('width' , '210px');
					$(this).find('.chosen-drop').css('width' , '210px');
					$(this).find('.chosen-search input').css('width' , '200px');
				});
			}
		})
		/**
		//or you can activate the chosen plugin after modal is shown
		//this way select element becomes visible with dimensions and chosen works as expected
		$('#modal-form').on('shown', function () {
			$(this).find('.modal-chosen').chosen();
		})
		*/
	
		
		
		$(document).one('ajaxloadstart.page', function(e) {
			$('textarea[class*=autosize]').trigger('autosize.destroy');
			$('.limiterBox,.autosizejs').remove();
			$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
		});
	
	});
</script>


				