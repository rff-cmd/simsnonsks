<?php
	include("main_set.php");
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>SIMS | SMAN 28 JAKARTA</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="/sman28jkt/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/sman28jkt/assets/font-awesome/4.2.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="/sman28jkt/assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="/sman28jkt/assets/css/chosen.min.css" />
		<link rel="stylesheet" href="/sman28jkt/assets/css/datepicker.min.css" />
		<link rel="stylesheet" href="/sman28jkt/assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="/sman28jkt/assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="/sman28jkt/assets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="/sman28jkt/assets/css/colorpicker.min.css" />
        

		<!-- text fonts -->
		<link rel="stylesheet" href="/sman28jkt/assets/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="/sman28jkt/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php //echo $__folder ?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php //echo $__folder ?>assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="/sman28jkt/assets/js/ace-extra.min.js"></script>

		<?php if ( $act == obraxabrix('chart_surat') || $act == obraxabrix('chart_pengunjung') || $act == obraxabrix('chart_pinjam') || $act == obraxabrix('chart_rating_buku')  ) { ?>
			<script src="/sman28jkt/app/chart/js/amcharts.js" type="text/javascript"></script>
		<?php } ?>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="/sman28jkt/assets/js/html5shiv.min.js"></script>
		<script src="/sman28jkt/assets/js/respond.min.js"></script>
		<![endif]-->
		
		<!----finance only------>
		<script src="app/finance/script/tooltips.js" language="javascript"></script>
		<script src="app/finance/script/tools.js" language="javascript"></script>
		<!------------------------->
		
		<script>
			function presensi_harian_siswa() 
{	
				newWindow('app/presensi_harian_siswa.php','Presensi Harian Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}

			function presensi_absen_siswa() 
			{	
				newWindow('app/presensi_absen_siswa.php','Presensi Absen Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			function presensipelajaran() 
{	
				window.open("app/presensipelajaran.php","Presensi Pelajaran Siswa","width=1000,height=500,left=50,top=10,toolbar=0,status=0,scroll=1,scrollbars=no");
				
			}
			
			function presensi_general() 
{	
				newWindow('app/presensi_general.php','Presensi Pegawai','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			function tambahpenerimaan() 
			{	
				newWindow('app/penerimaanjtt_add.php','Penerimaan','1000','1000','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function import_pemetaan_kd() 
{	
				newWindow('app/import_pemetaan_kd.php','Presensi Harian Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function import_user_guru() 
{	
				newWindow('app/import_user_guru.php','Import User Guru','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function generate_user_siswa() 
{	
				newWindow('app/generate_user_siswa.php','Generate User Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function generate_revisi_siswa() 
{	
				newWindow('app/generate_revisi_siswa.php','Generate Revisi Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function generate_update_nisn_siswa() 
{	
				newWindow('app/generate_update_nisn_siswa.php','Generate Update NISN Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function generate_pa_verifikasi() 
{	
				newWindow('app/generate_pa_verifikasi.php','Generate Menu Verifikasi','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function generate_ekskul_siswa() 
{	
				newWindow('app/generate_ekskul_siswa.php','Generate Update NISN Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//generate data
			function generate_nilai_rubah_formula() 
{	
				newWindow('app/daftar_nilai_update.php','Generate Update Nilai Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//generate data
			function generate_ekskul_pramuka() 
{	
				newWindow('app/generate_ekskul_pramuka.php','Generate Ekskul Pramuka','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function import_user_pa_ledger() 
{	
				newWindow('app/import_user_pa_ledger.php','Import User PA Ledger','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function copy_mapel_krs() 
{	
				newWindow('app/copy_mapel_krs.php','Copy Mata Pelajaran KRS','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function generate_user_siswa_baru() 
{	
				newWindow('app/generate_user_siswa_baru.php','Generate User Siswa Baru','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import_siswa_baru
			function import_siswa_baru() 
{	
				newWindow('app/import_siswa_baru.php','Upload Siswa Baru','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//generate data
			function generate_gugus_siswa_baru() 
{	
				newWindow('app/generate_gugus_siswa_baru.php','Generate Gugus Siswa Baru','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import_update_siswa
			function import_update_siswa() 
{	
				newWindow('app/import_update_siswa.php','Upload Update Data Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import_update_siswa_baru
			function import_update_siswa_baru() 
{	
				newWindow('app/import_update_siswa_baru.php','Upload Update Data Siswa Baru','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//generate_capital_name
			function generate_capital_name() 
{	
				newWindow('app/generate_capital_name.php','Update Capital Name','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//generate data siswa ke CAT
			function generate_siswa_ujian() 
{	
				newWindow('app/generate_siswa_ujian.php','Generate Siswa Ujian','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//generate data guru ke CAT
			function generate_guru_ujian() 
{	
				newWindow('app/generate_guru_ujian.php','Generate Guru Ujian','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//generate data mapel ke CAT
			function generate_mapel_ujian() 
{	
				newWindow('app/generate_mapel_ujian.php','Generate Mapel Ujian','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			
			//generate data nilai ujian
			function generate_import_nilai_ujian() 
{	
				newWindow('app/import_nilai_ujian.php','Import Nilai Ujian','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function generate_user_siswa_new() 
{	
				newWindow('app/generate_user_siswa_new.php','Generate User Siswa Baru-2','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function copy_mapel_krs_siswa() 
{	
				newWindow('app/copy_mapel_krs_siswa.php','Generate KRS Tingkat X','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function generate_acess_raport_siswa() 
{	
				newWindow('app/generate_acess_raport_siswa.php','Generate Menu Rapor','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//import data
			function generate_acess_raport_guru() 
{	
				newWindow('app/generate_acess_raport_guru.php','Generate Menu Rapor PA','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			//generate siswa baru kelas
			function generate_siswa_baru_kelas() 
{	
				newWindow('app/generate_siswa_baru_kelas.php','Pengkelasan Siswa Baru','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}

			//generate iuran siswa
			function generate_ar() 
{	
				newWindow('app/generate_ar.php','Generate Iuran Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}


			//generate iuran siswa
			function generate_nilai_leger() 
{	
				newWindow('app/generate_nilai_leger.php','Generate Nilai Leger Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
			}
			
			
		</script>
				
	</head>

	<body class="no-skin">
		
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			
            <?php require("header.php"); ?>
            

		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<?php if ($act != obraxabrix('main_menu') ) { ?>
				<div id="sidebar" class="sidebar responsive">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

				
					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
							<button class="btn btn-success">
								<i class="ace-icon fa fa-signal"></i>
							</button>

							<button class="btn btn-info">
								<i class="ace-icon fa fa-pencil"></i>
							</button>

							<button class="btn btn-warning">
								<i class="ace-icon fa fa-users"></i>
							</button>

							<button class="btn btn-danger">
								<i class="ace-icon fa fa-cogs"></i>
							</button>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- /.sidebar-shortcuts -->

					
	                <?php 
	                	require("menu.php"); 
	                ?>
	                
					
					<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
						<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
					
				</div>
			<?php } ?>

			<div class="main-content">
				<div class="main-content-inner">
					
					<?php if( $act != obraxabrix('pos') ) { ?>
						<div class="breadcrumbs" id="breadcrumbs">
							<script type="text/javascript">
								try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
							</script>

							<ul class="breadcrumb">
								    
	                            <li>
									<i class="ace-icon fa fa-home home-icon"></i>
									<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('main') ?>">Home</a>
								</li>
	                            <?php 
	                            	
	                            	##PPDB (Pendfataran Siswa Baru)
	                            	if ( $act == obraxabrix('registrasi') ) {  
	                                    echo '<li><a href="#">PPDB</a></li><li class="active">Pendaftaran</li>';
	                                }
	                                if ( $act == obraxabrix('registrasi_view') ) {  
	                                    echo '<li><a href="#">PPDB</a></li><li class="active">Daftar Pendaftaran</li>';
	                                }
	                                
	                                
	                            	##KESISWAAN
	                            	if ( $act == obraxabrix('pelajaran_un_minat') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Setup Mapel UN Minat</li>';
	                                }
	                                if ( $act == obraxabrix('pelajaran_raport_minat') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Setup Raport Minat</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_baru') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Siswa Baru</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_baru_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Siswa Baru</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_baru_list') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Siswa Baru</li>';
	                                }
	                                if ( $act == obraxabrix('siswa') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_list') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_list2') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Siswa Verifikasi</li>';
	                                }
	                                if ( $act == obraxabrix('gugus') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Gugus</li>';
	                                }
	                                if ( $act == obraxabrix('gugus_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Gugus</li>';
	                                }
	                                if ( $act == obraxabrix('tingkat') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Tingkat</li>';
	                                }
	                                if ( $act == obraxabrix('tingkat_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Tingkat</li>';
	                                }
	                                if ( $act == obraxabrix('kelas') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Kelas</li>';
	                                }
	                                if ( $act == obraxabrix('kelas_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Kelas</li>';
	                                }
	                                if ( $act == obraxabrix('tahunajaran') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Tahun Ajaran</li>';
	                                }
	                                if ( $act == obraxabrix('tahunajaran_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Tahun Ajaran</li>';
	                                }
	                                if ( $act == obraxabrix('agama') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Agama</li>';
	                                }
	                                if ( $act == obraxabrix('agama_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Agama</li>';
	                                }
	                                if ( $act == obraxabrix('angkatan') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Angkatan</li>';
	                                }
	                                if ( $act == obraxabrix('angkatan_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Angkatan</li>';
	                                }
	                                if ( $act == obraxabrix('penempatan_siswa_prioritas') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Setup Penempatan Siswa Prioritas</li>';
	                                }
	                                if ( $act == obraxabrix('penempatan_siswa_prioritas_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Setup Penempatan Siswa Prioritas</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_input_ekskul') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Siswa Input Ekskul</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_input_ekskul_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Siswa Ekskul</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_ekstrakurikuler') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Siswa Ekstra Kurikuler</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_ekstrakurikuler_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Siswa Ekstra Kurikuler</li>';
	                                }
	                                if ( $act == obraxabrix('guru_absen') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Guru Tidak Hadir</li>';
	                                }
	                                if ( $act == obraxabrix('guru_absen_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Guru Tidak Hadir</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_terlambat') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Siswa Terlambat</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_terlambat_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Siswa Terlambat</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_izin') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Siswa Izin</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_izin_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Siswa Izin</li>';
	                                }
	                                if ( $act == obraxabrix('kejadian_lain') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Kejadian Lain</li>';
	                                }
	                                if ( $act == obraxabrix('kejadian_lain_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Kejadian Lain</li>';
	                                }
	                                if ( $act == obraxabrix('guru_bk') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Guru BK</li>';
	                                }
	                                if ( $act == obraxabrix('guru_bk_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Guru BK</li>';
	                                }
	                                if ( $act == obraxabrix('guru_penugasan') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Guru Penugasan</li>';
	                                }
	                                if ( $act == obraxabrix('guru_penugasan_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Guru Penugasan</li>';
	                                }
	                                if ( $act == obraxabrix('gugus') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Gugus</li>';
	                                }
	                                if ( $act == obraxabrix('gugus_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Gugus</li>';
	                                }
	                                if ( $act == obraxabrix('infonap') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Setup Minat Nilai UN</li>';
	                                }
	                                if ( $act == obraxabrix('infonap_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Setup Minat Nilai UN</li>';
	                                }
	                                if ( $act == obraxabrix('raport_siswa_cover') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Cover Rapor Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('alumni') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Alumni</li>';
	                                }
	                                if ( $act == obraxabrix('alumni_list') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Alumni</li>';
	                                }
	                                if ( $act == obraxabrix('department') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Unit</li>';
	                                }
	                                if ( $act == obraxabrix('department_view') ) {  
	                                    echo '<li><a href="#">Kesiswaan</a></li><li class="active">Daftar Unit</li>';
	                                }
	                                
	                                
	                                
	                                /*KURIKULUM*/
	                                if ( $act == obraxabrix('pelajaran') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Mata Pelajaran</li>';
	                                }
	                                if ( $act == obraxabrix('pelajaran_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Mata Pelajaran</li>';
	                                }
	                                if ( $act == obraxabrix('kartu_rencana_studi') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Kartu Rencana Studi</li>';
	                                }
	                                if ( $act == obraxabrix('kartu_rencana_studi_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Kartu Rencana Studi</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_krs') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">KRS Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_krs_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar KRS Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_krs_approved') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Approval KRS Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('siswa_krs_approved_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Approval KRS Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('semester') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Semester</li>';
	                                }
	                                if ( $act == obraxabrix('semester_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Semester</li>';
	                                }
	                                if ( $act == obraxabrix('guru') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Guru Mata Pelajaran</li>';
	                                }
	                                if ( $act == obraxabrix('guru_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Guru Mata Pelajaran</li>';
	                                }
	                                if ( $act == obraxabrix('guru_ekskul') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Guru Ekstrakurikuler</li>';
	                                }
	                                if ( $act == obraxabrix('guru_ekskul_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Guru Ekstrakurikuler</li>';
	                                }
	                                if ( $act == obraxabrix('jam') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Setup Jam</li>';
	                                }
	                                if ( $act == obraxabrix('jam_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Setup Jam</li>';
	                                }
	                                if ( $act == obraxabrix('jadwal') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Jadwal</li>';
	                                }
	                                if ( $act == obraxabrix('jadwal_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Jadwal</li>';
	                                }
	                                if ( $act == obraxabrix('soal') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Master Soal PAS</li>';
	                                }
	                                if ( $act == obraxabrix('soal_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Master Soal PAS</li>';
	                                }
	                                if ( $act == obraxabrix('soal_select') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Seleksi Soal PAS</li>';
	                                }
	                                if ( $act == obraxabrix('soal_select_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Seleksi Soal PAS</li>';
	                                }
	                                if ( $act == obraxabrix('soal_siswa') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Soal PAS Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('soal_siswa_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Soal Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('pemetaan_kd') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Pemetaan KD</li>';
	                                }
	                                if ( $act == obraxabrix('pemetaan_kd_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Pemetaan KD</li>';
	                                }
	                                if ( $act == obraxabrix('pemetaan_kd_siswa') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Pemetaan KD Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('pemetaan_kd_siswa_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Pemetaan KD Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('rpp') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">RPP</li>';
	                                }
	                                if ( $act == obraxabrix('rpp_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar RPP</li>';
	                                }
	                                if ( $act == obraxabrix('ukbm') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Modul Ajar</li>';
	                                }
	                                if ( $act == obraxabrix('ukbm_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Modul Ajar</li>';
	                                }
	                                if ( $act == obraxabrix('soal_ukbm') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Master Soal UKBM</li>';
	                                }
	                                if ( $act == obraxabrix('soal_ukbm_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Master Soal UKBM</li>';
	                                }
	                                if ( $act == obraxabrix('soal_ukbm_select') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Seleksi Soal UKBM</li>';
	                                }
	                                if ( $act == obraxabrix('soal_ukbm_select_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Seleksi Soal UKBM</li>';
	                                }
	                                if ( $act == obraxabrix('soal_ukbm_siswa') || $act == obraxabrix('soal_ukbm_siswa_filter')  ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Soal UKBM Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('soal_ukbm_siswa_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Soal UKBM Siswa</li>';
	                                }
	                                
	                                if ( $act == obraxabrix('ukbm_siswa') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">UKBM Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('ukbm_siswa_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar UKBM Siswa</li>';
	                                }
	                                
	                                if ( $act == obraxabrix('ukbm_siswa_approved') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">UKBM Siswa Approved</li>';
	                                }
	                                
	                                if ( $act == obraxabrix('predikat_raport') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Setup Predikat Raport</li>';
	                                }
	                                if ( $act == obraxabrix('predikat_raport_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Setup Predikat Raport</li>';
	                                }
	                                
	                                if ( $act == obraxabrix('deskripsi_raport') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Setup Deskripsi Raport</li>';
	                                }
	                                if ( $act == obraxabrix('deskripsi_raport_view') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Setup Deskripsi Raport</li>';
	                                }
	                                
	                                if ( $act == obraxabrix('setup_siswa_khusus') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Setup Siswa Khusus</li>';
	                                } 
	                                if ( $act == obraxabrix('setup_siswa_khusus_view') ) { 
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Setup Siswa Khusus</li>';
	                                }
	                                
	                                if ( $act == obraxabrix('raport_siswa') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Raport Siswa</li>';
	                                }
	                                
	                                if ( $act == obraxabrix('raport_siswa_ledger') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Raport Siswa Ledger</li>';
	                                } 
	                                
	                                if ( $act == obraxabrix('siswa_pertemuan_krs') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Absensi Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('daftar_absensi') ) {  
	                                    echo '<li><a href="#">Kurikulum</a></li><li class="active">Daftar Absensi Siswa</li>';
	                                } 
	                                
	                                
	                                /*PRESENSI*/
	                                if ( $act == obraxabrix('presensi_harian_siswa') ) {  
	                                    echo '<li><a href="#">Presensi</a></li><li class="active">Presensi Harian Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('presensi_harian_siswa_view') ) {  
	                                    echo '<li><a href="#">Presensi</a></li><li class="active">Daftar Presensi Harian Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('presensipelajaran') ) {  
	                                    echo '<li><a href="#">Presensi</a></li><li class="active">Presensi Mapel</li>';
	                                }
	                                if ( $act == obraxabrix('presensi_ukbm') ) {  
	                                    echo '<li><a href="#">Presensi</a></li><li class="active">Presensi KBM</li>';
	                                }
	                                
	                                if ( $act == obraxabrix('presensi_ukbm_view') ) {  
	                                    echo '<li><a href="#">Presensi</a></li><li class="active">Daftar Presensi KBM</li>';
	                                }
	                                if ( $act == obraxabrix('presensi_ukbm_filter') ) {  
	                                    echo '<li><a href="#">Presensi</a></li><li class="active">Presensi KBM</li>';
	                                }
	                                if ( $act == obraxabrix('rpt_presensi_harian_siswa') ) {  
	                                    echo '<li><a href="#">Presensi</a></li><li class="active">Lap. Presensi Harian Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('rpt_presensi_siswa_pelajaran') ) {  
	                                    echo '<li><a href="#">Presensi</a></li><li class="active">Lap. Presensi Pelajaran Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('rpt_presensi_guru_pelajaran') ) {  
	                                    echo '<li><a href="#">Presensi</a></li><li class="active">Lap. Presensi Guru Pelajaran</li>';
	                                }
	                                if ( $act == obraxabrix('rpt_presensi_general') ) {  
	                                    echo '<li><a href="#">Presensi</a></li><li class="active">Lap. Presensi Harian Umum</li>';
	                                }
	                                	                                
	                                
	                                	                            	
	                            	/*UTILITY*/
	                                if ($act == '' ) {  
	                                    echo '<li><i class="ace-icon fa fa-home home-icon"></i><a href="#">Dashborad</a>
	    							      </li><li class="active">Dashboard</li>';
	                                } 
	                                if ( $act == obraxabrix('usr') ) {  
	                                    echo '<li><a href="#">Utility</a></li><li class="active">User</li>';
	                                } 
	                                if ( $act == obraxabrix('usr_view') ) { 
	                                    echo '<li><a href="#">Utility</a></li><li class="active">Daftar User</li>';
	                                } 
	                                if ( $act == obraxabrix('company') ) {  
	                                    echo '<li><a href="#">Utility</a></li><li class="active">Company</li>';
	                                } 
	                                if ( $act == obraxabrix('company_view') ) { 
	                                    echo '<li><a href="#">Utility</a></li><li class="active">Daftar Company</li>';
	                                } 
	                                if ( $act == obraxabrix('upload_download') ) { 
	                                    echo '<li><a href="#">Utility</a></li><li class="active">Upload/Download</li>';
	                                } 
	                                if ( $act == obraxabrix('backup') ) { 
	                                    echo '<li><a href="#">Utility</a></li><li class="active">Backup Database</li>';
	                                } 
	                                if ( $act == obraxabrix('setup_periode') ) {  
	                                    echo '<li><a href="#">Utility</a></li><li class="active">Setup Periode</li>';
	                                } 
	                                if ( $act == obraxabrix('setup_periode_view') ) { 
	                                    echo '<li><a href="#">Utility</a></li><li class="active">Daftar Setup Periode</li>';
	                                }
	                                if ( $act == obraxabrix('setup_periode_raport') ) {  
	                                    echo '<li><a href="#">Utility</a></li><li class="active">Setup Titimangsa Rapor</li>';
	                                } 
	                                if ( $act == obraxabrix('setup_periode_raport_view') ) { 
	                                    echo '<li><a href="#">Utility</a></li><li class="active">Daftar Setup Titimangsa Rapor</li>';
	                                }
	                                if ( $act == obraxabrix('setup_periode_raport_pts') ) {  
	                                    echo '<li><a href="#">Utility</a></li><li class="active">Setup Titimangsa Rapor PTS</li>';
	                                } 
	                                if ( $act == obraxabrix('setup_periode_raport_pts_view') ) { 
	                                    echo '<li><a href="#">Utility</a></li><li class="active">Daftar Setup Titimangsa Rapor PTS</li>';
	                                }
	                                
	                                
	                                /*ASSET*/
	                                if ( $act == obraxabrix('material') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Master Barang</li>';
	                                }
	                                if ( $act == obraxabrix('material_view') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Daftar Master Barang</li>';
	                                }
	                                if ( $act == obraxabrix('asset') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Sarana & Prasaran</li>';
	                                }
	                                if ( $act == obraxabrix('asset_view') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Daftar Sarana & Prasaran</li>';
	                                }
	                                if ( $act == obraxabrix('asset_type') ) {  
	                                    echo '<li><a href="#">Sarana & Prasaran</a></li><li class="active">Jenis Sarana & Prasaran</li>';
	                                }
	                                if ( $act == obraxabrix('asset_type_view') ) {  
	                                    echo '<li><a href="#">Sarana & Prasaran</a></li><li class="active">Daftar Jenis Sarana & Prasaran</li>';
	                                }
	                                if ( $act == obraxabrix('item_group') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Kelompok Barang</li>';
	                                }
	                                if ( $act == obraxabrix('item_group_view') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Daftar Kelompok Barang</li>';
	                                }
	                                if ( $act == obraxabrix('brand') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Merk/Model Inventaris</li>';
	                                }
	                                if ( $act == obraxabrix('brand_view') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Daftar Merk/Model Inventaris</li>';
	                                }
	                                if ( $act == obraxabrix('build') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Master Bangunan</li>';
	                                }
	                                if ( $act == obraxabrix('build_view') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Daftar Master Bangunan</li>';
	                                }
	                                if ( $act == obraxabrix('room') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Master Ruang</li>';
	                                }
	                                if ( $act == obraxabrix('room_view') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Daftar Master Ruang</li>';
	                                }
	                                if ( $act == obraxabrix('room_booking') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Booking Ruang</li>';
	                                }
	                                if ( $act == obraxabrix('room_booking_view') ) {  
	                                    echo '<li><a href="#">Sarana & Prasarana</a></li><li class="active">Daftar Booking Ruang</li>';
	                                }
	                                
	                                
	                                
	                                /*SURAT MENYURAT*/
	                                if ( $act == obraxabrix('surat_masuk') ) {  
	                                    echo '<li><a href="#">Surat Menyurat</a></li><li class="active">Surat Masuk</li>';
	                                }
	                                if ( $act == obraxabrix('surat_masuk_view') ) {  
	                                    echo '<li><a href="#">Surat Menyurat</a></li><li class="active">Daftar Surat Masuk</li>';
	                                }
	                                if ( $act == obraxabrix('surat_keluar') ) {  
	                                    echo '<li><a href="#">Surat Menyurat</a></li><li class="active">Surat Keluar</li>';
	                                }
	                                if ( $act == obraxabrix('surat_keluar_view') ) {  
	                                    echo '<li><a href="#">Surat Menyurat</a></li><li class="active">Daftar Surat Keluar</li>';
	                                }
	                                if ( $act == obraxabrix('kelompok_surat') ) {  
	                                    echo '<li><a href="#">Surat Menyurat</a></li><li class="active">Kelompok Surat</li>';
	                                }
	                                if ( $act == obraxabrix('kelompok_surat_view') ) {  
	                                    echo '<li><a href="#">Surat Menyurat</a></li><li class="active">Daftar Kelompok Surat</li>';
	                                }
	                                if ( $act == obraxabrix('buku_kunjungan') ) {  
	                                    echo '<li><a href="#">Surat Menyurat</a></li><li class="active">Buku Kunjungan</li>';
	                                }
	                                if ( $act == obraxabrix('buku_kunjungan_view') ) {  
	                                    echo '<li><a href="#">Surat Menyurat</a></li><li class="active">Daftar Buku Kunjungan</li>';
	                                }
	                                if ( $act == obraxabrix('chart_surat') ) {  
	                                    echo '<li><a href="#">Surat Menyurat</a></li><li class="active">Grafik Surat Masuk</li>';
	                                }


									// KEUANGAN
									if ( $act == obraxabrix('finance_type') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Jenis Keuangan</li>';
	                                } 
	                                if ( $act == obraxabrix('finance_type_view') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Jenis Keuangan List</li>';
	                                }
	                                if ( $act == obraxabrix('general_journal') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Pengeluaran Kas</li>';
	                                }
	                                if ( $act == obraxabrix('general_journal_view') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Daftar Pengeluaran Kas</li>';
	                                }
	                                if ( $act == obraxabrix('general_journal_in') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Pemasukan Kas</li>';
	                                }
	                                if ( $act == obraxabrix('general_journal_in_view') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Daftar Pemasukan Kas</li>';
	                                }
									if ( $act == obraxabrix('receipt') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Penerimaan Iuran Siswa</li>';
	                                }
	                                if ( $act == obraxabrix('receipt_view') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Daftar Penerimaan Iuran Siswa</li>';
	                                }
									if ( $act == obraxabrix('coa') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Rekening Perkiraan</li>';
	                                }
	                                if ( $act == obraxabrix('coa_view') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Daftar Rekening Perkiraan</li>';
	                                }
									if ( $act == obraxabrix('purchase_inv') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Pembelian</li>';
	                                }
	                                if ( $act == obraxabrix('purchase_inv_view') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Daftar Pembelian</li>';
	                                }
	                                if ( $act == obraxabrix('purchase_inv_list') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Daftar Pembelian</li>';
	                                }

									if ( $act == obraxabrix('good_receipt') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Penerimaan</li>';
	                                }
	                                if ( $act == obraxabrix('good_receipt_view') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Daftar Penerimaan</li>';
	                                }
									if ( $act == obraxabrix('payment') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Pembayaran Hutang</li>';
	                                } 
	                                if ( $act == obraxabrix('payment_view') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Pembayaran Hutang List</li>';
	                                }
	                                if ( $act == obraxabrix('rpt_ar') ) {  
	                                    echo '<li><a href="#">Keuangan</a></li><li class="active">Iuran Belum Lunas</li>';
	                                }
	                                
	                            ?>
	                            
	                            
							</ul><!-- /.breadcrumb -->
	                                                
							<!--<div class="nav-search" id="nav-search">
								<form class="form-search">
									<span class="input-icon">
										<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
										<i class="ace-icon fa fa-search nav-search-icon"></i>
									</span>
								</form>
							</div>--><!-- /.nav-search -->
						</div>
					<?php } ?>

                    	
					<?php
                        
                        if ($act == '' ) { include_once("dashboard.php"); }
                        if ($act == obraxabrix('main') ) { include_once("dashboard.php"); }
                        if ($act == obraxabrix('main_menu') ) { include_once("main_menu.php"); }
                        if ($act == obraxabrix('logout')) { include_once("logout.php"); }
                        
                        ##utility
                        if ($act == obraxabrix('usr') ) { include_once("app/usr.php"); }
		                if ($act == obraxabrix('usr_view')) { include_once("app/usr_view.php"); }
                        if ($act == obraxabrix('usr_change') ) { include_once("app/usr_change.php"); }
                        if ($act == obraxabrix('company') ) { include_once("app/company.php"); }
		                if ($act == obraxabrix('company_view')) { include_once("app/company_view.php"); }
		                if ($act == obraxabrix('upload_download')) { include_once("app/upload_download.php"); }
		                if ($act == obraxabrix('backup')) { include_once("app/backup.php"); }
		                if ($act == obraxabrix('setup_periode') ) { include_once("app/setup_periode.php"); }
		                if ($act == obraxabrix('setup_periode_view')) { include_once("app/setup_periode_view.php"); }
		                if ($act == obraxabrix('setup_periode_raport') ) { include_once("app/setup_periode_raport.php"); }
		                if ($act == obraxabrix('setup_periode_raport_view')) { include_once("app/setup_periode_raport_view.php"); }
		                if ($act == obraxabrix('setup_periode_raport_pts') ) { include_once("app/setup_periode_raport_pts.php"); }
		                if ($act == obraxabrix('setup_periode_raport_pts_view')) { include_once("app/setup_periode_raport_pts_view.php"); }
                        
						if ($act == obraxabrix('siswa_baru')) { include_once("app/siswa_baru.php"); }	
						if ($act == obraxabrix('siswa_baru_view')) { include_once("app/siswa_baru_view.php"); }
						if ($act == obraxabrix('siswa_baru_list')) { include_once("app/siswa_baru_list.php"); }
						if ($act == obraxabrix('siswa')) { include_once("app/siswa.php"); }	
						if ($act == obraxabrix('siswa_view')) { include_once("app/siswa_view.php"); }
						if ($act == obraxabrix('siswa_list')) { include_once("app/siswa_list.php"); }
						if ($act == obraxabrix('alumni')) { include_once("app/alumni.php"); }
						if ($act == obraxabrix('alumni_list')) { include_once("app/alumni_list.php"); }
						/*if ($act == obraxabrix('usr')) { include_once("app/usr.php"); }
						if ($act == obraxabrix('usr_view')) { include_once("app/usr_view.php"); }
						if ($act == obraxabrix('chgpwd')) { include_once("app/gantipassword.php"); }*/
						if ($act == obraxabrix('siswa_list2')) { include_once("app/siswa_list2.php"); }
						
						##PPDB
						if ($act == obraxabrix('registrasi')) { include_once("app/registrasi.php"); }
						if ($act == obraxabrix('registrasi_view')) { include_once("app/registrasi_view.php"); }
						
						##kesiswaan
						if ($act == obraxabrix('prosespenerimaansiswa')) { include_once("app/prosespenerimaansiswa.php"); }
						if ($act == obraxabrix('prosespenerimaansiswa_view')) { include_once("app/prosespenerimaansiswa_view.php"); }
						if ($act == obraxabrix('kelompokcalonsiswa')) { include_once("app/kelompokcalonsiswa.php"); }
						if ($act == obraxabrix('kelompokcalonsiswa_view')) { include_once("app/kelompokcalonsiswa_view.php"); }	
						if ($act == obraxabrix('pelajaran_un_minat')) { include_once("app/pelajaran_un_minat.php"); }
						if ($act == obraxabrix('pelajaran_raport_minat')) { include_once("app/pelajaran_raport_minat.php"); }
						if ($act == obraxabrix('department')) { include_once("app/department.php"); }
						if ($act == obraxabrix('department_view')) { include_once("app/department_view.php"); }
						if ($act == obraxabrix('tingkat')) { include_once("app/tingkat.php"); }
						if ($act == obraxabrix('tingkat_view')) { include_once("app/tingkat_view.php"); }
						if ($act == obraxabrix('kelas')) { include_once("app/kelas.php"); }
						if ($act == obraxabrix('kelas_view')) { include_once("app/kelas_view.php"); }
						if ($act == obraxabrix('tahunajaran')) { include_once("app/tahunajaran.php"); }
						if ($act == obraxabrix('tahunajaran_view')) { include_once("app/tahunajaran_view.php"); }
						if ($act == obraxabrix('agama')) { include_once("app/agama.php"); }
						if ($act == obraxabrix('agama_view')) { include_once("app/agama_view.php"); }
						if ($act == obraxabrix('tahunbuku')) { include_once("app/tahunbuku.php"); }
						if ($act == obraxabrix('tahunbuku_view')) { include_once("app/tahunbuku_view.php"); }
						if ($act == obraxabrix('rekakun')) { include_once("app/rekakun.php"); }
						if ($act == obraxabrix('rekakun_view')) { include_once("app/rekakun_view.php"); }
						if ($act == obraxabrix('datapenerimaan')) { include_once("app/datapenerimaan.php"); }
						if ($act == obraxabrix('datapenerimaan_view')) { include_once("app/datapenerimaan_view.php"); }
						if ($act == obraxabrix('penempatan_siswa_prioritas')) { include_once("app/penempatan_siswa_prioritas.php"); }
						if ($act == obraxabrix('penempatan_siswa_prioritas_view')) { include_once("app/penempatan_siswa_prioritas_view.php"); }
						if ($act == obraxabrix('siswa_input_ekskul')) { include_once("app/siswa_input_ekskul.php"); }
						if ($act == obraxabrix('siswa_input_ekskul_view')) { include_once("app/siswa_input_ekskul_view.php"); }
						if ($act == obraxabrix('siswa_ekstrakurikuler')) { include_once("app/siswa_ekstrakurikuler.php"); }
						if ($act == obraxabrix('siswa_ekstrakurikuler_view')) { include_once("app/siswa_ekstrakurikuler_view.php"); }
						if ($act == obraxabrix('gugus')) { include_once("app/gugus.php"); }
						if ($act == obraxabrix('gugus_view')) { include_once("app/gugus_view.php"); }
						if ($act == obraxabrix('infonap')) { include_once("app/infonap.php"); }
						if ($act == obraxabrix('infonap_view')) { include_once("app/infonap_view.php"); }
						if ($act == obraxabrix('raport_siswa_cover_view')) { include_once("app/raport_siswa_cover_view.php"); }
						if ($act == obraxabrix('receipt')) { include_once("app/receipt.php"); }
						if ($act == obraxabrix('receipt_view')) { include_once("app/receipt_view.php"); }
						if ($act == obraxabrix('finance_type') ) { include_once("app/finance_type.php"); }
		                if ($act == obraxabrix('finance_type_view')) { include_once("app/finance_type_view.php"); }
		                if ($act == obraxabrix('general_journal') ) { include_once("app/general_journal.php"); }
		                if ($act == obraxabrix('general_journal_view') ) { include_once("app/general_journal_view.php"); }
		                if ($act == obraxabrix('general_journal_in') ) { include_once("app/general_journal_in.php"); }
		                if ($act == obraxabrix('general_journal_in_view') ) { include_once("app/general_journal_in_view.php"); }
						if ($act == obraxabrix('coa') ) { include_once("app/coa.php"); }
		                if ($act == obraxabrix('coa_view')) { include_once("app/coa_view.php"); }
						if ($act == obraxabrix('purchase_inv') ) { include_once("app/purchase_inv.php"); }
		                if ($act == obraxabrix('purchase_inv_view') ) { include_once("app/purchase_inv_view.php"); }
		                if ($act == obraxabrix('purchase_inv_list') ) { include_once("app/purchase_inv_list.php"); }
						if ($act == obraxabrix('good_receipt') ) { include_once("app/good_receipt.php"); }
		                if ($act == obraxabrix('good_receipt_view') ) { include_once("app/good_receipt_view.php"); }
						if ($act == obraxabrix('payment') ) { include_once("app/payment.php"); }
		                if ($act == obraxabrix('payment_view') ) { include_once("app/payment_view.php"); }
		                if ($act == obraxabrix('rpt_ar') ) { include_once("app/rpt_ar.php"); }
						
						##keuangan
						if ($act == obraxabrix('datapengeluaran')) { include_once("app/datapengeluaran.php"); }
						if ($act == obraxabrix('datapengeluaran_view')) { include_once("app/datapengeluaran_view.php"); }
						if ($act == obraxabrix('besarjtt')) { include_once("app/besarjtt.php"); }
						if ($act == obraxabrix('besarjtt_view')) { include_once("app/besarjtt_view.php"); }
						if ($act == obraxabrix('perpustakaan')) { include_once("app/perpustakaan.php"); }
						if ($act == obraxabrix('perpustakaan_view')) { include_once("app/perpustakaan_view.php"); }
						
						##perpustakaan
						if ($act == obraxabrix('format')) { include_once("app/format.php"); }
						if ($act == obraxabrix('format_view')) { include_once("app/format_view.php"); }
						if ($act == obraxabrix('rak')) { include_once("app/rak.php"); }
						if ($act == obraxabrix('rak_view')) { include_once("app/rak_view.php"); }
						if ($act == obraxabrix('katalog')) { include_once("app/katalog.php"); }
						if ($act == obraxabrix('katalog_view')) { include_once("app/katalog_view.php"); }
						if ($act == obraxabrix('penerbit')) { include_once("app/penerbit.php"); }
						if ($act == obraxabrix('penerbit_view')) { include_once("app/penerbit_view.php"); }
						if ($act == obraxabrix('penulis')) { include_once("app/penulis.php"); }
						if ($act == obraxabrix('penulis_view')) { include_once("app/penulis_view.php"); }
						if ($act == obraxabrix('pustaka')) { include_once("app/pustaka.php"); }
						if ($act == obraxabrix('pustaka_view')) { include_once("app/pustaka_view.php"); }
						if ($act == obraxabrix('pinjam')) { include_once("app/pinjam.php"); }
						if ($act == obraxabrix('pinjam_view')) { include_once("app/pinjam_view.php"); }
						if ($act == obraxabrix('kembali')) { include_once("app/kembali.php"); }
						if ($act == obraxabrix('kembali_view')) { include_once("app/kembali_view.php"); }
						if ($act == obraxabrix('konfigurasi')) { include_once("app/konfigurasi.php"); }
						if ($act == obraxabrix('konfigurasi_view')) { include_once("app/konfigurasi_view.php"); }
						if ($act == obraxabrix('chart_pengunjung')) { include_once("app/chart/chart_pengunjung.php"); }
						if ($act == obraxabrix('chart_pinjam')) { include_once("app/chart/chart_pinjam.php"); }
						if ($act == obraxabrix('chart_rating_buku')) { include_once("app/chart/chart_rating_buku.php"); }
						
						if ($act == obraxabrix('kenaikan')) { include_once("app/kenaikan.php"); }
						if ($act == obraxabrix('kenaikan_view')) { include_once("app/kenaikan_view.php"); }
						if ($act == obraxabrix('pindah_kelas')) { include_once("app/pindah_kelas.php"); }
						if ($act == obraxabrix('kelulusan')) { include_once("app/kelulusan.php"); }
						if ($act == obraxabrix('kelulusan_view')) { include_once("app/kelulusan_view.php"); }
						if ($act == obraxabrix('penempatan')) { include_once("app/penempatan.php"); }
						if ($act == obraxabrix('pegawai')) { include_once("app/pegawai.php"); }
						if ($act == obraxabrix('pegawai_view')) { include_once("app/pegawai_view.php"); }
						if ($act == obraxabrix('statusguru')) { include_once("app/statusguru.php"); }
						if ($act == obraxabrix('statusguru_view')) { include_once("app/statusguru_view.php"); }
						if ($act == obraxabrix('pegawai_jabatan')) { include_once("app/pegawai_jabatan.php"); }
						if ($act == obraxabrix('pegawai_jabatan_view')) { include_once("app/pegawai_jabatan_view.php"); }
						if ($act == obraxabrix('jabatan')) { include_once("app/jabatan.php"); }
						if ($act == obraxabrix('jabatan_view')) { include_once("app/jabatan_view.php"); }
						
						if ($act == obraxabrix('guru_absen')) { include_once("app/guru_absen.php"); }
						if ($act == obraxabrix('guru_absen_view')) { include_once("app/guru_absen_view.php"); }
						if ($act == obraxabrix('siswa_terlambat')) { include_once("app/siswa_terlambat.php"); }
						if ($act == obraxabrix('siswa_terlambat_view')) { include_once("app/siswa_terlambat_view.php"); }
						if ($act == obraxabrix('siswa_izin')) { include_once("app/siswa_izin.php"); }
						if ($act == obraxabrix('siswa_izin_view')) { include_once("app/siswa_izin_view.php"); }
						if ($act == obraxabrix('kejadian_lain')) { include_once("app/kejadian_lain.php"); }
						if ($act == obraxabrix('kejadian_lain_view')) { include_once("app/kejadian_lain_view.php"); }
						if ($act == obraxabrix('guru_bk')) { include_once("app/guru_bk.php"); }
						if ($act == obraxabrix('guru_bk_view')) { include_once("app/guru_bk_view.php"); }
						if ($act == obraxabrix('guru_penugasan')) { include_once("app/guru_penugasan.php"); }
						if ($act == obraxabrix('guru_penugasan_view')) { include_once("app/guru_penugasan_view.php"); }
						
						//-------BK
						if ($act == obraxabrix('jenis_pelanggaran')) { include_once("app/jenis_pelanggaran.php"); }
						if ($act == obraxabrix('jenis_pelanggaran_view')) { include_once("app/jenis_pelanggaran_view.php"); }
						if ($act == obraxabrix('jenis_prestasi')) { include_once("app/jenis_prestasi.php"); }
						if ($act == obraxabrix('jenis_prestasi_view')) { include_once("app/jenis_prestasi_view.php"); }
						if ($act == obraxabrix('pelanggaran_siswa')) { include_once("app/pelanggaran_siswa.php"); }
						if ($act == obraxabrix('pelanggaran_siswa_view')) { include_once("app/pelanggaran_siswa_view.php"); }
						if ($act == obraxabrix('konseling_siswa')) { include_once("app/konseling_siswa.php"); }
						if ($act == obraxabrix('konseling_siswa_view')) { include_once("app/konseling_siswa_view.php"); }
					    if ($act == obraxabrix('jenis_izin')) { include_once("app/jenis_izin.php"); }
						if ($act == obraxabrix('jenis_izin_view')) { include_once("app/jenis_izin_view.php"); }
					    if ($act == obraxabrix('izin_siswa')) { include_once("app/izin_siswa.php"); }
						if ($act == obraxabrix('izin_siswa_view')) { include_once("app/izin_siswa_view.php"); }
						if ($act == obraxabrix('aspek_perkembangan')) { include_once("app/aspek_perkembangan.php"); }
						if ($act == obraxabrix('aspek_perkembangan_view')) { include_once("app/aspek_perkembangan_view.php"); }
						if ($act == obraxabrix('assesmen_observasi')) { include_once("app/assesmen_observasi.php"); }
						if ($act == obraxabrix('assesmen_observasi_view')) { include_once("app/assesmen_observasi_view.php"); }
						if ($act == obraxabrix('aspek_psikologi')) { include_once("app/aspek_psikologi.php"); }
						if ($act == obraxabrix('aspek_psikologi_view')) { include_once("app/aspek_psikologi_view.php"); }
						if ($act == obraxabrix('aspek_psikologi_detail')) { include_once("app/aspek_psikologi_detail.php"); }
						if ($act == obraxabrix('aspek_psikologi_detail_view')) { include_once("app/aspek_psikologi_detail_view.php"); }
						if ($act == obraxabrix('evaluasi_psikologi')) { include_once("app/evaluasi_psikologi.php"); }
						if ($act == obraxabrix('evaluasi_psikologi_view')) { include_once("app/evaluasi_psikologi_view.php"); }
						if ($act == obraxabrix('rpt_evaluasi_psikologi_level')) { include_once("app/rpt_evaluasi_psikologi_level.php"); }
						
						
						##Presensi Harian
						if ($act == obraxabrix('presensi_harian_siswa')) { include_once("app/presensi_harian_siswa.php"); }
						if ($act == obraxabrix('presensi_harian_siswa_view')) { include_once("app/presensi_harian_siswa_view.php"); }
						if ($act == obraxabrix('presensi_ukbm_filter')) { include_once("app/presensi_ukbm_filter.php"); }
						if ($act == obraxabrix('presensi_ukbm')) { include_once("app/presensi_ukbm.php"); }
						if ($act == obraxabrix('presensi_ukbm_view')) { include_once("app/presensi_ukbm_view.php"); }
						if ($act == obraxabrix('presensipelajaran')) { include_once("app/presensipelajaran.php"); }
						if ($act == obraxabrix('rpt_presensi_harian_siswa')) { include_once("app/rpt_presensi_harian_siswa.php"); }
						if ($act == obraxabrix('rpt_presensi_siswa_pelajaran')) { include_once("app/rpt_presensi_siswa_pelajaran.php"); }
						if ($act == obraxabrix('rpt_presensi_guru_pelajaran')) { include_once("app/rpt_presensi_guru_pelajaran.php"); }
						if ($act == obraxabrix('rpt_presensi_general')) { include_once("app/rpt_presensi_general.php"); }
						
						
					    if ($act == obraxabrix('barcode')) { include_once("app/barcode.php"); }
					    if ($act == obraxabrix('pangkat')) { include_once("app/pangkat.php"); }
						if ($act == obraxabrix('pangkat_view')) { include_once("app/pangkat_view.php"); }
						if ($act == obraxabrix('pegawai_pangkat')) { include_once("app/pegawai_pangkat.php"); }
						if ($act == obraxabrix('pegawai_pangkat_view')) { include_once("app/pegawai_pangkat_view.php"); }
						if ($act == obraxabrix('jenis_sertifikasi')) { include_once("app/jenis_sertifikasi.php"); }
						if ($act == obraxabrix('jenis_sertifikasi_view')) { include_once("app/jenis_sertifikasi_view.php"); }
						if ($act == obraxabrix('status_pegawai')) { include_once("app/status_pegawai.php"); }
						if ($act == obraxabrix('status_pegawai_view')) { include_once("app/status_pegawai_view.php"); }
						if ($act == obraxabrix('kenaikan_gaji')) { include_once("app/kenaikan_gaji.php"); }
						if ($act == obraxabrix('kenaikan_gaji_view')) { include_once("app/kenaikan_gaji_view.php"); }
						if ($act == obraxabrix('pegawai_pendidikan')) { include_once("app/pegawai_pendidikan.php"); }
						if ($act == obraxabrix('pegawai_pendidikan_view')) { include_once("app/pegawai_pendidikan_view.php"); }
						if ($act == obraxabrix('pegawai_keluarga')) { include_once("app/pegawai_keluarga.php"); }
						if ($act == obraxabrix('pegawai_keluarga_view')) { include_once("app/pegawai_keluarga_view.php"); }
						if ($act == obraxabrix('supplier')) { include_once("app/supplier.php"); }
						if ($act == obraxabrix('supplier_view')) { include_once("app/supplier_view.php"); }
						if ($act == obraxabrix('pegawai_prestasi')) { include_once("app/pegawai_prestasi.php"); }
						if ($act == obraxabrix('pegawai_prestasi_view')) { include_once("app/pegawai_prestasi_view.php"); }
						if ($act == obraxabrix('pegawai_penghargaan')) { include_once("app/pegawai_penghargaan.php"); }
						if ($act == obraxabrix('pegawai_penghargaan_view')) { include_once("app/pegawai_penghargaan_view.php"); }
						if ($act == obraxabrix('pegawai_skmengajar')) { include_once("app/pegawai_skmengajar.php"); }
						if ($act == obraxabrix('pegawai_skmengajar_view')) { include_once("app/pegawai_skmengajar_view.php"); }
						if ($act == obraxabrix('usr_reminder')) { include_once("app/usr_reminder.php"); }
						
						//kurikulum
						if ($act == obraxabrix('pelajaran')) { include_once("app/pelajaran.php"); }
						if ($act == obraxabrix('pelajaran_view')) { include_once("app/pelajaran_view.php"); }
						if ($act == obraxabrix('siswa_ekstrakurikuler')) { include_once("app/siswa_ekstrakurikuler.php"); }
						if ($act == obraxabrix('siswa_ekstrakurikuler_view')) { include_once("app/siswa_ekstrakurikuler_view.php"); }
						if ($act == obraxabrix('semester')) { include_once("app/semester.php"); }
						if ($act == obraxabrix('semester_view')) { include_once("app/semester_view.php"); }
						if ($act == obraxabrix('angkatan')) { include_once("app/angkatan.php"); }
						if ($act == obraxabrix('angkatan_view')) { include_once("app/angkatan_view.php"); }
						if ($act == obraxabrix('ukbm')) { include_once("app/ukbm.php"); }
						if ($act == obraxabrix('ukbm_view')) { include_once("app/ukbm_view.php"); }
						if ($act == obraxabrix('rpp')) { include_once("app/rpp.php"); }
						if ($act == obraxabrix('rpp_view')) { include_once("app/rpp_view.php"); }
						if ($act == obraxabrix('kompetensi')) { include_once("app/kompetensi.php"); }
						if ($act == obraxabrix('kompetensi_view')) { include_once("app/kompetensi_view.php"); }
						if ($act == obraxabrix('dasarpenilaian')) { include_once("app/dasarpenilaian.php"); }
						if ($act == obraxabrix('dasarpenilaian_view')) { include_once("app/dasarpenilaian_view.php"); }
						if ($act == obraxabrix('jeniskompetensi')) { include_once("app/jeniskompetensi.php"); }
						if ($act == obraxabrix('jeniskompetensi_view')) { include_once("app/jeniskompetensi_view.php"); }
						if ($act == obraxabrix('daftarnilai_view')) { include_once("app/daftarnilai_view.php"); }
						if ($act == obraxabrix('kartu_rencana_studi')) { include_once("app/kartu_rencana_studi.php"); }
						if ($act == obraxabrix('kartu_rencana_studi_view')) { include_once("app/kartu_rencana_studi_view.php"); }
						if ($act == obraxabrix('siswa_krs')) { include_once("app/siswa_krs.php"); }
						if ($act == obraxabrix('siswa_krs_view')) { include_once("app/siswa_krs_view.php"); }
						if ($act == obraxabrix('siswa_krs_approved')) { include_once("app/siswa_krs_approved.php"); }
						if ($act == obraxabrix('siswa_krs_approved_view')) { include_once("app/siswa_krs_approved_view.php"); }
						if ($act == obraxabrix('guru')) { include_once("app/guru.php"); }
						if ($act == obraxabrix('guru_view')) { include_once("app/guru_view.php"); }
						if ($act == obraxabrix('guru_ekskul')) { include_once("app/guru_ekskul.php"); }
						if ($act == obraxabrix('guru_ekskul_view')) { include_once("app/guru_ekskul_view.php"); }
						if ($act == obraxabrix('jadwal')) { include_once("app/jadwal.php"); }
						if ($act == obraxabrix('jadwal_view')) { include_once("app/jadwal_view.php"); } 
						if ($act == obraxabrix('jam')) { include_once("app/jam.php"); }
						if ($act == obraxabrix('jam_view')) { include_once("app/jam_view.php"); }
						if ($act == obraxabrix('soal')) { include_once("app/soal.php"); }
						if ($act == obraxabrix('soal_view')) { include_once("app/soal_view.php"); }
						if ($act == obraxabrix('soal_select')) { include_once("app/soal_select.php"); }
						if ($act == obraxabrix('soal_select_view')) { include_once("app/soal_select_view.php"); }
						if ($act == obraxabrix('soal_siswa')) { include_once("app/soal_siswa.php"); }
						if ($act == obraxabrix('soal_siswa_view')) { include_once("app/soal_siswa_view.php"); }
						if ($act == obraxabrix('pemetaan_kd')) { include_once("app/pemetaan_kd.php"); }
						if ($act == obraxabrix('pemetaan_kd_view')) { include_once("app/pemetaan_kd_view.php"); }
						if ($act == obraxabrix('pemetaan_kd_siswa')) { include_once("app/pemetaan_kd_siswa.php"); }
						if ($act == obraxabrix('pemetaan_kd_siswa_view')) { include_once("app/pemetaan_kd_siswa_view.php"); }
						if ($act == obraxabrix('soal_ukbm')) { include_once("app/soal_ukbm.php"); }
						if ($act == obraxabrix('soal_ukbm_view')) { include_once("app/soal_ukbm_view.php"); }
						if ($act == obraxabrix('soal_ukbm_select')) { include_once("app/soal_ukbm_select.php"); }
						if ($act == obraxabrix('soal_ukbm_select_view')) { include_once("app/soal_ukbm_select_view.php"); }
						if ($act == obraxabrix('soal_ukbm_siswa')) { include_once("app/soal_ukbm_siswa.php"); }
						if ($act == obraxabrix('soal_ukbm_siswa_filter')) { include_once("app/soal_ukbm_siswa_filter.php"); }
						if ($act == obraxabrix('soal_ukbm_siswa_view')) { include_once("app/soal_ukbm_siswa_view.php"); }
						if ($act == obraxabrix('ukbm_siswa')) { include_once("app/ukbm_siswa.php"); }
						if ($act == obraxabrix('ukbm_siswa_view')) { include_once("app/ukbm_siswa_view.php"); }
						if ($act == obraxabrix('ukbm_siswa_approved')) { include_once("app/ukbm_siswa_approved.php"); }
						if ($act == obraxabrix('predikat_raport')) { include_once("app/predikat_raport.php"); }
						if ($act == obraxabrix('predikat_raport_view')) { include_once("app/predikat_raport_view.php"); }
						if ($act == obraxabrix('deskripsi_raport')) { include_once("app/deskripsi_raport.php"); }
						if ($act == obraxabrix('deskripsi_raport_view')) { include_once("app/deskripsi_raport_view.php"); }
						if ($act == obraxabrix('setup_siswa_khusus')) { include_once("app/setup_siswa_khusus.php"); }
						if ($act == obraxabrix('setup_siswa_khusus_view')) { include_once("app/setup_siswa_khusus_view.php"); }
						if ($act == obraxabrix('raport_siswa')) { include_once("app/raport_siswa.php"); }
						if ($act == obraxabrix('raport_siswa_view')) { include_once("app/raport_siswa_view.php"); }
						if ($act == obraxabrix('raport_siswa_ledger')) { include_once("app/raport_siswa_ledger.php"); }
						if ($act == obraxabrix('siswa_pertemuan_krs')) { include_once("app/siswa_pertemuan_krs.php"); }
						if ($act == obraxabrix('daftar_absensi')) { include_once("app/daftar_absensi.php"); }
						
						
						##perpustakaan
						if ($act == obraxabrix('anggota')) { include_once("app/anggota.php"); }
						if ($act == obraxabrix('anggota_view')) { include_once("app/anggota_view.php"); }
						if ($act == obraxabrix('daftarpustaka')) { include_once("app/daftarpustaka.php"); }
						if ($act == obraxabrix('daftarpustaka_view')) { include_once("app/daftarpustaka_view.php"); }
						
						##keuangan
						if ($act == obraxabrix('penerimaanjtt')) { include_once("app/penerimaanjtt_update.php"); }

						##Asset
						if ($act == obraxabrix('asset')) { include_once("app/asset.php"); }
						if ($act == obraxabrix('asset_view')) { include_once("app/asset_view.php"); }
						if ($act == obraxabrix('asset_type')) { include_once("app/asset_type.php"); }
						if ($act == obraxabrix('asset_type_view')) { include_once("app/asset_type_view.php"); }
						if ($act == obraxabrix('material')) { include_once("app/material.php"); }
						if ($act == obraxabrix('material_view')) { include_once("app/material_view.php"); }
						if ($act == obraxabrix('item_group')) { include_once("app/item_group.php"); }
						if ($act == obraxabrix('item_group_view')) { include_once("app/item_group_view.php"); }
						if ($act == obraxabrix('brand')) { include_once("app/brand.php"); }
						if ($act == obraxabrix('brand_view')) { include_once("app/brand_view.php"); }
						if ($act == obraxabrix('build')) { include_once("app/build.php"); }
						if ($act == obraxabrix('build_view')) { include_once("app/build_view.php"); }
						if ($act == obraxabrix('room')) { include_once("app/room.php"); }
						if ($act == obraxabrix('room_view')) { include_once("app/room_view.php"); }
						if ($act == obraxabrix('room_booking_filter')) { include_once("app/room_booking_filter.php"); }
						if ($act == obraxabrix('room_booking')) { include_once("app/room_booking.php"); }
						if ($act == obraxabrix('room_booking_view')) { include_once("app/room_booking_view.php"); }
						
						
						##surat menyurat
						if ($act == obraxabrix('kelompok_surat')) { include_once("app/kelompok_surat.php"); }
						if ($act == obraxabrix('kelompok_surat_view')) { include_once("app/kelompok_surat_view.php"); }
						if ($act == obraxabrix('surat_keluar')) { include_once("app/surat_keluar.php"); }
						if ($act == obraxabrix('surat_keluar_view')) { include_once("app/surat_keluar_view.php"); }
						if ($act == obraxabrix('surat_masuk')) { include_once("app/surat_masuk.php"); }
						if ($act == obraxabrix('surat_masuk_view')) { include_once("app/surat_masuk_view.php"); }
						if ($act == obraxabrix('buku_kunjungan')) { include_once("app/buku_kunjungan.php"); }
						if ($act == obraxabrix('buku_kunjungan_view')) { include_once("app/buku_kunjungan_view.php"); }
						if ($act == obraxabrix('chart_surat')) { include_once("app/chart/chart_surat.php"); }
						
						#grafik
						if ($act == obraxabrix('kinerjagrafik','kinerjagrafik')) { include_once("app/kinerjagrafik.php"); }
						
						if ($act == 'kinerjadkgrafik_detail') { include_once("app/kinerjadkgrafik_detail.php"); }
						
						#report
						if ($act == obraxabrix('rpt_penerimaan')) { include_once("app/rpt_penerimaan.php"); }
						if ($act == obraxabrix('rpt_pinjam_telat')) { include_once("app/rpt_pinjam_telat.php"); }
						if ($act == obraxabrix('rpt_izin_siswa')) { include_once("app/rpt_izin_siswa.php"); }    
						if ($act == obraxabrix('rpt_izin_siswa_surat')) { include_once("app/rpt_izin_siswa_surat.php"); }    
						if ($act == obraxabrix('rpt_konseling_siswa')) { include_once("app/rpt_konseling_siswa.php"); }
						if ($act == obraxabrix('rpt_lunas')) { include_once("app/rpt_lunas.php"); }
	
	
		                
		                /*##audit trail
                        if ($act == obraxabrix('adt_sales_order') ) { include_once("app/adt_sales_order.php"); }
                        if ($act == obraxabrix('adt_sales_order_verification') ) { include_once("app/adt_sales_order_verification.php"); }
                        if ($act == obraxabrix('adt_printing') ) { include_once("app/adt_printing.php"); }
                        if ($act == obraxabrix('adt_press') ) { include_once("app/adt_press.php"); }
                        if ($act == obraxabrix('adt_counting') ) { include_once("app/adt_counting.php"); }
                        if ($act == obraxabrix('adt_sewing') ) { include_once("app/adt_sewing.php"); }
                        if ($act == obraxabrix('adt_delivery_order') ) { include_once("app/adt_delivery_order.php"); }*/
                    
                    ?>

                        
				</div>
			</div><!-- /.main-content -->
            
            
			<?php require("footer.php"); ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		        
        
	</body>
</html>
