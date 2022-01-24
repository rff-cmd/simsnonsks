<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ob_start();

include("app/include/sambung.php");
include("app/include/functions.php");
include("app/include/function_login.php");
//include("app/include/queryfunctions.php");

if (($_SESSION["logged"] == 1)) {
	header("Location: main.php");
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				
						
							<div class="center">
								<h4 class="blue" id="id-company-text">&copy; SMAN 3 BANDUNG</h4>
							</div>
							
							<div align="center">	
								<table align="center" width="50%" border="0" style="color: #ffffff; font-size: 14px">
									<tr>
										<td colspan="3" align="center">INFORMASI SEBELUM MELAKUKAN DAFTAR ULANG</td>
									</tr>
									<tr>
										<td colspan="3" align="center">TAHAP PERSIAPAN (SIAPKAN BERKAS-BERKAS BERIKUT)</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td></td>
										<td colspan="2" style="color: #ff0000">Silahkan login dengan NISN tanpa 00 (nol nol) didepannya</td></tr>
									<tr>
										<td></td>
										<td colspan="2">
											contoh : <br>
													NISN : 0078695478 <br>
               										ketik 78695478
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
										
									<tr>
										<td></td><td colspan="2">SIAPKAN BERKAS PERSYARATAN UMUM :</td></tr>
									<tr>
										<td></td>
										<td>a.</td><td>Scan Pdf File Kartu Keluarga</td>
									</tr>
									<tr>
										<td></td>
										<td>b.</td><td>Scan Pdf File Rapor dari Sem 1 s.d 5</td>
									</tr>
									<tr>
										<td></td>
										<td>c.</td><td>Pas foto siswa berwarna</td>
									</tr>
									<tr>
										<td></td>
										<td>d.</td><td>Scan KIP, KIS, BPJS, PKH, jika ada</td>
									</tr>
									<tr>
										<td></td>
										<td>e.</td><td>Surat Pernyataan Orangtua</td>
									</tr>
									<tr>
										<td colspan="3">&nbsp;</td>
									</tr>
									
									<!--<tr>
										<td>2.</td><td colspan="2">SIAPKAN BERKAS PERSYARATAN KHSUSUS (SIAPKAN BERKAS-BERKAS BERIKUT)</td></tr>
									<tr>
										<td></td><td colspan="2">Berkas yang berkaitan dengan jalur pendaftaran siswa</td></tr>
										
									<tr>
										<td></td>
										<td>a.</td><td>Surat Tugas Orangtua/SK TUgas Orangtua (Jalur Perpindahan)</td>
									</tr>
									<tr>
										<td></td>
										<td>b.</td><td>Sertifikat-Sertifikat lomba ( Jalur Perlombaan/Kejuaraan)</td>
									</tr>
									<tr>
										<td></td>
										<td>c.</td><td>KIS/KIP/PKH dll, pilih salah satu saja (Jalur KETM)</td>
									</tr>
									<tr>
										<td></td>
										<td>d.</td><td>Sertifikat Sertifikasi Guru/Surat Tugas Mengajar (Jalur Anak Guru)</td>
									</tr>
									<tr>
										<td></td>
										<td>e.</td><td>SK Tenaga Kesehatan Petugas Penanggulangan Covid-19 (Jalur Tenaga Kesehatan)</td>
									</tr>
									<tr>
										<td></td>
										<td>f.</td><td>Surat Keterangan Banyaknya Juzz (Jalur Tahfidz)</td>
									</tr>
									<tr>
										<td></td>
										<td>g.</td><td>Rapor (jalur prestasi nilai rapor)</td>
									</tr>-->
									<tr>
										<td colspan="3">&nbsp;</td>
									</tr>
									
									<tr>
										<td></td><td colspan="2">Catatan</td></tr>
									<tr>
										<td></td>
										<td>1.</td><td>Surat Pernyataan orangtua dapat diunduh pada Web SMAN 3 Bandung</td>
									</tr>
									<tr>
										<td></td>
										<td></td><td>http://sman3bdg.sch.id/daftar-ulang</td>
									</tr>
									<tr>
										<td></td>
										<td>2.</td><td>Berkas yang belum ada (Ijazah, SKHUN, Rekam BK, Kartu Golongan darah) silahkan di lewat saja</td>
									</tr>
									<tr>
										<td></td>
										<td>3.</td><td>Nilai UN tidak perlu diisi</td>
									</tr>
									<tr>
										<td></td>
										<td>4.</td><td>Nilai Rapor sem 3 s.d. 5 wajib diisi</td>
									</tr>
									<tr>
										<td></td>
										<td>5.</td><td>Klik Update jika sudah selesai mengisi data</td>
									</tr>
									<tr>
										<td></td>
										<td>6.</td><td>Jika ada kekurangan berkas-berkas akan dihubungi oleh Panitia</td>
									</tr>
									<tr>
										<td></td>
										<td>7.</td><td>Informasi yang sudah melakukan Daftar Ulang akan di publikasi pada Web SMAN 3 Bandung</td>
									</tr>
								</table>
								<!--<img src="assets/img/info.jpg" />-->
								<br>
								<a href="login" style="font-size: 34px; color: #ffffff">KLIK UNTUK MELANJUTKAN LOGIN</a>
							</div>


					</div><!-- /.col -->
				
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery.2.1.1.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			
			
			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });
			 
			});
		</script>
	</body>
</html>
