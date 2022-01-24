<script type="text/javascript" src="<?php echo $__folder ?>js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='tanggal') {
			alert('Tanggal tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='nopendaftaran') {
			alert('No Pendaftaran tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='nama') {
			alert('Nama Lengkap tidak boleh kosong!');				
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
</script>

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
				if ($_POST['submit'] == 'Simpan') { $ref = ''; }
				//-----------------------------------------------/\
				
				$ref2 = notran(date('y-m-d'), 'frmregistrasi', '', '', ''); //---get no ref
				
				include("app/exec/insert_registrasi.php"); 
				
				$tanggal	= date("d-m-Y");
				$almayah = "";
				$almibu = "";
				$tgllahir = "";
				$kebutuhan_khusus_chk1 = "checked";
				
				if ($ref != "") {
					$sql=$select->list_registrasi($ref);			
					$registrasi=$sql->fetch(PDO::FETCH_OBJ);
					
					$ref2 	= $registrasi->nopendaftaran;
					$replid = $registrasi->replid;
					
					if($registrasi->almayah == 1) {
						$almayah = "checked";
					}
					if($registrasi->almibu == 1) {
						$almibu = "checked";
					}
					
					$tgllahir = date("d-m-Y", strtotime($registrasi->tgllahir));
					if($tgllahir == "01-01-1970") {
						$tgllahir = "";
					}
					
					if($registrasi->kebutuhan_khusus_chk == 1) { 
						$kebutuhan_khusus_chk = "checked"; 
					} else {
						$kebutuhan_khusus_chk = "";
					}
					if($registrasi->kebutuhan_khusus_chk == 2) { 
						$kebutuhan_khusus_chk1 = "checked"; 
					} else {
						$kebutuhan_khusus_chk1 = ""; 
					}
					
					$butuhkhususayah = "";
					if($registrasi->butuhkhususayah == 1) {
						$butuhkhususayah = "checked";
					}
					
				}		
			?>
            
			<!-- PAGE CONTENT BEGINS -->
			<form action="" method="post" name="registrasi" id="registrasi" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('tanggal,nopendaftaran,nama,kelamin');">
            	
            	<input type="hidden" id="replid" name="replid" value="<?php echo $registrasi->replid ?>" >
            					
				<div class="col-sm-6">
					<div class="widget-box">
						<div class="widget-header widget-header-flat">
							<h4 class="widget-title">Identitas Peserta Didik (Wajib diisi)</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main">
								<div class="row">
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Unit</label>
										<div class="col-sm-3">
											<select name="departemen" id="departemen" class="chosen-select form-control" >
												<option value=""></option>
												<?php select_departemen($registrasi->departemen); ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No. Pendaftaran</label>
										<div class="col-sm-4">
											<input type="text" name="nopendaftaran" id="nopendaftaran" class="form-control" readonly value="<?php echo $ref2; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jenis Pendaftaran</label>
										<div class="col-sm-6">
											<select name="idproses" id="idproses" class="chosen-select form-control"/>
												<option value=""></option>
												<?php select_jenispendaftaran($registrasi->idproses); ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal</label>
										<div class="col-sm-6">
											<input type="text" id="tanggal" name="tanggal" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $tanggal ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jalur Masuk</label>
										<div class="col-sm-4">
											<select name="idkelompok" id="idkelompok" class="chosen-select form-control" >
												<option value=""></option>
												<?php select_jalurmasuk2($registrasi->idkelompok); ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Photo</label>
										<div class="col-sm-6">
											<input type="file" id="foto_file" name="foto_file" />
					                        <br />
					        				<?php if (!empty($registrasi->foto_file)) { ?>
					        					<img src="<?php echo $__folder ?>app/file_foto/<?php echo $registrasi->foto_file; ?>" width="150" height="150" />
					        				<?php } ?>
					                        <input size="25" type="hidden" id="photo2" name="photo2" value="<?php echo $registrasi->foto_file; ?>">  
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama *)</label>
										<div class="col-sm-6">
											<input type="text" id="nama" name="nama" class="form-control" value="<?php echo $registrasi->nama ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Panggilan</label>
										<div class="col-sm-6">
											<input type="text" id="panggilan" name="panggilan" class="form-control" value="<?php echo $registrasi->panggilan ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tempat Lahir</label>
										<div class="col-sm-6">
											<input type="text" id="tmplahir" name="tmplahir" class="form-control" value="<?php echo $registrasi->tmplahir ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal Lahir</label>
										<div class="col-sm-6">
											<input type="text" id="tgllahir" name="tgllahir" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $tgllahir ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jenis Kelamin</label>
										<div class="col-sm-6">
											<select name="kelamin" id="kelamin" class="chosen-select form-control" >
												<option value=""></option>
												<?php select_kelamin($registrasi->kelamin); ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">NISN </label>
										<div class="col-sm-6" id="nisn_id">
											<?php if($ref == '') { ?>
												<input type="text" id="nisn" name="nisn" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_nis_ajax.php','nisn_id','ceknisn','replid','nisn')" value="<?php echo $registrasi->nisn ?>">
											<?php } else { ?>
												<input type="text" id="nisn" name="nisn" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_nis_ajax_update.php','nisn_id','ceknisn','replid','nisn')" value="<?php echo $registrasi->nisn ?>">
											<?php } ?>
											<a href="https://nisn.data.kemdikbud.go.id/" target="_blank">Cek NISN</a>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">NO SERI IJASAH</label>
										<div class="col-sm-6" id="noijazah_id">
											<input type="text" id="noijazah" name="noijazah" class="form-control" value="<?php echo $registrasi->noijazah ?>">
											<?php /*if($ref == '') { ?>
												<input type="text" id="noijazah" name="noijazah" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_noijazah_ajax.php','noijazah_id','ceknoijazah','replid','noijazah')" value="<?php echo $registrasi->noijazah ?>">
											<?php } else { ?>
												<input type="text" id="noijazah" name="noijazah" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_noijazah_ajax_update.php','noijazah_id','ceknoijazah','replid','noijazah')" value="<?php echo $registrasi->noijazah ?>">
											<?php }*/ ?>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Ijasah</label>
										<div class="col-sm-6">
											<select name="tahunijazah" id="tahunijazah" class="chosen-select form-control" >
												<option value=""></option>
												<?php tahun_select($registrasi->tahunijazah); ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">NOMOR SERI SKHUN</label>
										<div class="col-sm-6" id="skhun_id">
											<input type="text" id="skhun" name="skhun" class="form-control" value="<?php echo $registrasi->skhun ?>">
											<?php /*if($ref == '') { ?>
												<input type="text" id="skhun" name="skhun" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_skhun_ajax.php','skhun_id','cekskhun','replid','skhun')" value="<?php echo $registrasi->skhun ?>">
											<?php } else { ?>
												<input type="text" id="skhun" name="skhun" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_skhun_ajax_update.php','skhun_id','cekskhun','replid','skhun')" value="<?php echo $registrasi->skhun ?>">
											<?php }*/ ?>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun SKUN</label>
										<div class="col-sm-6">
											<select name="tahunskhun" id="tahunskhun" class="chosen-select form-control" >
												<option value=""></option>
												<?php tahun_select($registrasi->tahunskhun); ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No Ujian Nasional</label>
										<div class="col-sm-6">
											<input type="text" id="noujian" name="noujian" class="form-control" value="<?php echo $registrasi->noujian ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No. Induk Kependudukan (NIK)</label>
										<div class="col-sm-6">
											<input type="text" id="nik" name="nik" class="form-control" value="<?php echo $registrasi->nik ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Agama</label>
										<div class="col-sm-6">
											<select name="agama" id="agama" class="chosen-select form-control" >
												<option value=""></option>
												<?php select_agama($registrasi->agama); ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Berkebutuhan Khusus</label>
										<div class="col-sm-6">
											<input type="radio" id="kebutuhan_khusus_chk" name="kebutuhan_khusus_chk" class="ace" value="1" <?php echo $kebutuhan_khusus_chk ?> ><span class="lbl">YA&nbsp;&nbsp;</span>
											<input type="radio" id="kebutuhan_khusus_chk1" name="kebutuhan_khusus_chk" class="ace" value="2" <?php echo $kebutuhan_khusus_chk1 ?> ><span class="lbl">TIDAK</span>
											<br>
											*) Jika YA, sebutkan
											<input type="text" name="kebutuhan_khusus" id="kebutuhan_khusus" class="form-control" value="<?php echo $registrasi->kebutuhan_khusus; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Alamat Tempat Tinggal</label>
										<div class="col-sm-6">
											<input type="text" name="alamatsiswa" id="alamatsiswa" class="form-control" value="<?php echo $registrasi->alamatsiswa; ?>" >
											 /
											RT : <input type="text" name="rt" id="rt" class="form-control" value="<?php echo $registrasi->rt; ?>" >
											RW : <input type="text" name="rw" id="rw" class="form-control" value="<?php echo $registrasi->rw; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelurahan/Desa</label>
										<div class="col-sm-6">
											<input type="text" name="kelurahan" id="kelurahan" class="form-control" value="<?php echo $registrasi->kelurahan ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kode Pos Siswa</label>
										<div class="col-sm-6">
											<input type="text" name="kodepossiswa" id="kodepossiswa" class="form-control" value="<?php echo $registrasi->kodepossiswa; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kecamatan</label>
										<div class="col-sm-6">
											<input type="text" name="kecamatan" id="kecamatan" class="form-control" value="<?php echo $registrasi->kecamatan; ?>" >
										</div>
									</div>	
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kabupaten/Kota</label>
										<div class="col-sm-6">
											<input type="text" name="kabupaten" id="kabupaten" class="form-control" value="<?php echo $registrasi->kabupaten; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Provinsi</label>
										<div class="col-sm-6">
											<input type="text" name="provinsi" id="provinsi" class="form-control" value="<?php echo $registrasi->provinsi; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Alat Transportasi ke Sekolah</label>
										<div class="col-sm-6">
											<select name="transportasi_kode" id="transportasi_kode" class="chosen-select form-control" />
												<option value=""></option>
												<?php select_transportasi($registrasi->transportasi_kode); ?>
											</select>
											(Lainnya sebutkan)
											<input type="text" name="transportasi" id="transportasi" sclass="form-control" value="<?php echo $registrasi->transportasi; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jenis Tinggal</label>
										<div class="col-sm-6">
											<select name="idjenis_tinggal" id="idjenis_tinggal" class="chosen-select form-control" >
												<option value=""></option>
												<?php select_jenistinggal($registrasi->idjenis_tinggal); ?>
											</select>
											&nbsp;
											Bersama Wali (sebutkan hubungan keluarga)
											<input type="text" name="jenis_tinggal" id="jenis_tinggal" sclass="form-control" value="<?php echo $registrasi->jenis_tinggal ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No. Telp. Rumah/HP Siswa</label>
										<div class="col-sm-6">
											<input type="text" name="telponsiswa" id="telponsiswa" class="form-control" value="<?php echo $registrasi->telponsiswa; ?>" >/
											<input type="text" name="hpsiswa" id="hpsiswa" class="form-control" value="<?php echo $registrasi->hpsiswa; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">E-mail Pribadi</label>
										<div class="col-sm-6">
											<input type="text" name="emailsiswa" id="emailsiswa" class="form-control" value="<?php echo $registrasi->emailsiswa; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Apakah Sebagai Penerima KPS</label>
										<div class="col-sm-6">
											<input type="checkbox" name="kps" id="kps" class="ace" value="1" <?php echo $kps ?> >
											<br>
											NO. KPS
											<input type="text" name="nokps" id="nokps" class="form-control" value="<?php echo $registrasi->nokps; ?>" ><i style="font-size: 8px">*) KPS= Kartu Perlindungan Sosial</i>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">NO. KIP</label>
										<div class="col-sm-6">
											<input type="text" name="nokip" id="nokip" class="form-control" value="<?php echo $registrasi->nokip; ?>" >
											<br>
											NO. KKS
											<input type="text" name="nokks" id="nokks" class="form-control" value="<?php echo $registrasi->nokks; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Cita-Cita</label>
										<div class="col-sm-6">
											<select name="citacita" id="citacita" class="chosen-select form-control" />
												<option value=""></option>
												<?php select_citacita($registrasi->citacita); ?>
											</select>
											<br>
											Lainnya (sebutkan)
											<input type="text" name="citacita_lain" id="citacita_lain" class="form-control" value="<?php echo $registrasi->citacita_lain ?>">
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="widget-box">
						<div class="widget-header widget-header-flat">
							<h4 class="widget-title">Data Ayah Kandung</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main">
								<div class="row">
										
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Ayah</label>
										<div class="col-sm-6">
											<input type="text" name="namaayah" id="namaayah" class="form-control" value="<?php echo $registrasi->namaayah ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Lahir</label>
										<div class="col-sm-6">
											<select name="tahunayah" id="tahunayah" class="chosen-select form-control" />
												<option value=""></option>
												<?php tahun_select($registrasi->tahunayah); ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Almarhum</label>
										<div class="col-sm-6">
											<input type="checkbox" name="almayah" id="almayah" class="ace" value="1" <?php echo $almayah ?> ><span class="lbl"></span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Alamat Lengkap Ayah</label>
										<div class="col-sm-6">
											<input type="text" name="alamatortu" id="alamatortu" class="form-control" value="<?php echo $registrasi->alamatortu; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kode Pos Ayah</label>
										<div class="col-sm-6">
											<input type="text" name="kodeposortu" id="kodeposortu" class="form-control" value="<?php echo $registrasi->kodeposortu; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">HP Ayah</label>
										<div class="col-sm-6">
											<input type="text" name="hportu" id="hportu" class="form-control" value="<?php echo $registrasi->hportu; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Berkebutuhan Khusus</label>
										<div class="col-sm-6">
											<input type="checkbox" name="butuhkhususayah" id="butuhkhususayah" class="ace" value="1" <?php echo $butuhkhususayah ?> ><span class="lbl"></span>
											<br>
											<input type="text" name="butuhkhususketayah" id="butuhkhususketayah" class="form-control" value="<?php echo $registrasi->butuhkhususketayah; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pekrjaan Ayah</label>
										<div class="col-sm-6">
											<select name="pekerjaanayah" id="pekerjaanayah" class="chosen-select form-control" />
												<option value=""></option>
												<?php select_jenispekerjaan_ayah($registrasi->pekerjaanayah); ?>
											</select>
											<br>
											Lain-Lain (sebutkan)
											<input type="text" name="pekerjaanayah_lain" id="pekerjaanayah_lain" class="form-control" value="<?php echo $registrasi->pekerjaanayah_lain; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pendidikan Ayah</label>
										<div class="col-sm-6">
											<select name="pendidikanayah" id="pendidikanayah" class="chosen-select form-control" />
												<option value=""></option>
												<?php select_pendidikan($registrasi->pendidikanayah); ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Penghasilan Ayah Bulanan</label>
										<div class="col-sm-6">
											<select name="penghasilanayah_kode" id="penghasilanayah_kode" class="chosen-select form-control" />
												<option value=""></option>
												<?php select_penghasilan($registrasi->penghasilanayah_kode); ?>
											</select>
											<br>
											Lainnya (sebutkan)
											<input type="text" name="penghasilanayah" id="penghasilanayah" class="form-control" onkeyup="formatangka('penghasilanayah')" value="<?php echo $registrasi->penghasilanayah ?>">
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
														
				
				<div class="col-sm-6">
					<div class="widget-box">
						<div class="widget-header widget-header-flat">
							<h4 class="widget-title">Data Ibu Kandung</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main">
								<div class="row">
								
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Ibu</label>
										<div class="col-sm-6">
											<input type="text" name="namaibu" id="namaibu" class="form-control" value="<?php echo $registrasi->namaibu ?>"></td>
											<br>
											Tahun Lahir
											<select name="tahunibu" id="tahunibu" class="chosen-select form-control"/>
												<option value=""></option>
												<?php tahun_select($registrasi->tahunibu); ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Almarhum</label>
										<div class="col-sm-6">
											<input type="checkbox" name="almibu" id="almibu" class="ace" value="1" <?php echo $almibu ?> ><span class="lbl"></span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Alamat Ibu</label>
										<div class="col-sm-6">
											<input type="text" name="alamatibu" id="alamatibu" class="form-control" value="<?php echo $registrasi->alamatibu; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kode Ibu</label>
										<div class="col-sm-6">
											<input type="text" name="kodeposibu" id="kodeposibu" class="form-control" value="<?php echo $registrasi->kodeposibu; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">HP Ibu</label>
										<div class="col-sm-6">
											<input type="text" name="hpibu" id="hpibu" class="form-control" value="<?php echo $registrasi->hpibu; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Berkebutuhan Khusus</label>
										<div class="col-sm-6">
											<input type="checkbox" name="butuhkhususibu" id="butuhkhususibu" class="ace" value="1" <?php echo $butuhkhususibu ?> ><span class="lbl"></span>
											<br>
											<input type="text" name="butuhkhususketibu" id="butuhkhususketibu" class="form-control" value="<?php echo $registrasi->butuhkhususketibu; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pekrjaan Ibu</label>
										<div class="col-sm-6">
											<select name="pekerjaanibu" id="pekerjaanibu" class="chosen-select form-control" />
												<option value=""></option>
												<?php select_jenispekerjaan($registrasi->pekerjaanibu); ?>
											</select>
											<br>
											Lain-Lain (sebutkan)
											<input type="text" name="pekerjaanibu_lain" id="pekerjaanibu_lain" class="form-control" value="<?php echo $registrasi->pekerjaanibu_lain; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pendidikan Ibu</label>
										<div class="col-sm-6">
											<select name="pendidikanibu" id="pendidikanibu" class="chosen-select form-control" />
												<option value=""></option>
												<?php select_pendidikan($registrasi->pendidikanibu); ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Penghasilan Ibu Bulanan</label>
										<div class="col-sm-6">
											<select name="penghasilanibu_kode" id="penghasilanibu_kode" class="chosen-select form-control" />
												<option value=""></option>
												<?php select_penghasilan($registrasi->penghasilanibu_kode); ?>
											</select>
											Lainnya (sebutkan)
											<input type="text" name="penghasilanibu" id="penghasilanibu" class="form-control" onkeyup="formatangka('penghasilanibu')" value="<?php echo $registrasi->penghasilanibu ?>">
										</div>
									</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>
								
				
				<div class="col-sm-6">
					<div class="widget-box">
						<div class="widget-header widget-header-flat">
							<h4 class="widget-title">Data Wali</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main">
								<div class="row">
								
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Wali</label>
										<div class="col-sm-6">
											<input type="text" name="wali" id="wali" class="form-control" value="<?php echo $registrasi->wali ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Lahir Wali</label>
										<div class="col-sm-6">
											<select name="tahunwali" id="tahunwali" class="chosen-select form-control" />
												<option value=""></option>
												<?php tahun_select($registrasi->tahunwali); ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pekerjaan Wali</label>
										<div class="col-sm-6">
											<select name="pekerjaanwali" id="pekerjaanwali" class="chosen-select form-control" />
												<option value=""></option>
												<?php select_jenispekerjaan($registrasi->pekerjaanwali); ?>
											</select>
											Lain-Lain (sebutkan)
											<input type="text" name="pekerjaanwali_lain" id="pekerjaanwali_lain" class="form-control" value="<?php echo $registrasi->pekerjaanwali_lain; ?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pendidikan Wali</label>
										<div class="col-sm-6">
											<select name="pendidikanwali" id="pendidikanwali" class="chosen-select form-control" />
												<option value=""></option>
												<?php select_pendidikan($registrasi->pendidikanwali); ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Penghasilan Wali</label>
										<div class="col-sm-6">
											<input type="text" name="penghasilanwali" id="penghasilanwali" class="form-control" onkeyup="formatangka('penghasilanwali')" value="<?php echo $registrasi->penghasilanwali ?>">
										</div>
									</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>				
								
				<div class="col-sm-6">
					<div class="widget-box">
						<div class="widget-header widget-header-flat">
							<h4 class="widget-title">Data Periodik</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main">
								<div class="row">
								
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tinggi Badan</label>
										<div class="col-sm-6">
											<input type="text" name="tinggi" id="tinggi" class="form-control" onkeyup="formatangka('tinggi')" value="<?php echo $registrasi->tinggi ?>">&nbsp;cm
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Berat Badan</label>
										<div class="col-sm-6">
											<input type="text" name="berat" id="berat" class="form-control" onkeyup="formatangka('berat')" value="<?php echo $registrasi->berat ?>">&nbsp;kg
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Golongan Darah</label>
										<div class="col-sm-6">
											<select name="darah" id="darah" class="chosen-select form-control" />
												<option value=""></option>
												<?php select_goldarah($registrasi->darah); ?>
											</select>
											&nbsp;&nbsp;
											File Fotokopi <input type="file" id="file_darah" name="file_darah" >
											<input type="hidden" id="file_darah2" name="file_darah2" value="<?php echo $registrasi->file_darah; ?>" >
											
											<?php if($registrasi->file_darah != '') { ?>
												&nbsp;&nbsp;
												<a class="label label-success" href="<?php echo $__folder ?>app/registrasi_download_darah.php?replid=<?php echo $registrasi->replid ?>" target="_blank" style="background-color: #0b28f4" >Download File</a>
											<?php } ?>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jarak Tempat Tinggal ke Sekolah</label>
										<div class="col-sm-6">
											<input type="text" name="jaraksekolah" id="jaraksekolah" class="form-control" value="<?php echo $registrasi->jaraksekolah ?>"> &nbsp;<i>meter</i>
											Lebih dari 1 km, sebutkan :
											<input type="text" name="jarak_km" id="jarak_km" class="form-control" onkeyup="formatangka('jarak_km')" value="<?php echo $registrasi->jarak_km ?>">&nbsp;Km
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Waktu Tempuh Berangkat ke Sekolah</label>
										<div class="col-sm-6">
											<input type="text" name="waktutempuh" id="waktutempuh" class="form-control" value="<?php echo $registrasi->waktutempuh ?>">&nbsp;<i>menit</i>
											Lebih dari 60 menit, sebutkan :
											<input type="text" name="waktutempuh_menit" id="waktutempuh_menit" class="form-control" onkeyup="formatangka('waktutempuh_menit')" value="<?php echo $registrasi->waktutempuh_menit ?>">&nbsp;Menit
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jumlah Saudara Kandung</label>
										<div class="col-sm-6">
											<input type="text" name="jsaudara" id="jsaudara" class="form-control" onkeyup="formatangka('jsaudara')" value="<?php echo $registrasi->jsaudara; ?>" >
										</div>
									</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<?php /*				
				<div class="col-sm-6">
					<div class="widget-box">
						<div class="widget-header widget-header-flat">
							<h4 class="widget-title">Catatan Prestasi</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main">
								<div class="row">
								
									<div class="form-group">
										<?php 
											if(empty($ref)) {
												include("siswa_nilai_un.php");
											} else {
												include("siswa_nilai_un_update.php");
											} 
										?>
									</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="widget-box">
						<div class="widget-header widget-header-flat">
							<h4 class="widget-title">Beasiswa</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main">
								<div class="row">
								
									<div class="form-group">
										<?php 
											if(empty($ref)) {
												include("siswa_raport.php");
											} else {
												include("siswa_raport_update.php");
											}									 
										?>
									</div>
								
								</div>
							</div>
						</div>
					</div>
				</div> */ ?>
				
				
				<!-- /.row -->
	              
				<div class="space-4"></div>
				<div class="col-sm-12">
					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
	                        
	                        <?php if (allowupd('frmsiswa')==1) { ?>
	                            <?php if($ref!='') { ?>
	    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
	    						<?php } ?>
	                        <?php } ?>
							
	                        <?php if (allowadd('frmsiswa')==1) { ?>
	    						<?php if($ref=='') { ?>
	    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
	    						<?php } ?>
	                        <?php } ?>
	                        
	                        <?php if (allowdel('frmsiswa')==1) { ?>
	                            &nbsp;
	    						<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
	                        <?php } ?>
	                        
							&nbsp;
							<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('registrasi_view') ?>'" />
	                                                
	                                 
						</div>
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


				