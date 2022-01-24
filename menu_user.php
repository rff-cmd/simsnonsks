<?php if ( allow("frmregistrasi")==1 || allow("frmregistrasiview")==1 ) { ?>

	<li class="<?php echo $psb ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-list-alt"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "Registration"; } else { echo "PPDB"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
		
			<?php if ( allow("frmregistrasi")==1 ) { ?>
				<li class="<?php echo $registrasi_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('registrasi') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Registration"; } else { echo "Pendaftaran"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmregistrasiview")==1 ) { ?>
				<li class="<?php echo $registrasi_view_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('registrasi_view') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Registration List"; } else { echo "Data Pendaftaran"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
		</ul>
	</li>
<?php
}
?>	
			
			
			
<?php if ( allow("frmsiswa")==1 || allow("frmsiswa_list")==1 || allow("frmsiswa_baru")==1 || allow("frmkelas")==1 || allow("frmtingkat")==1 || allow("frmtahunajaran")==1 || allow("frmagama")==1 || allow("kenaikan")==1 || allow("penempatan")==1 || allow("barcode")==1 || allow("frmdepartemen")==1 || allow("frmangkatan")==1 || allow("kelulusan")==1 || allow("alumni_list")==1 || allow("pindah_kelas")==1 || allow("frmsiswa_ekstrakurikuler")==1 || allow("pelajaran_un_minat")==1 || allow("pelajaran_raport_minat")==1 || allow("penempatan_siswa_prioritas")==1 || allow("frmsiswa_terlambat")==1 || allow("frmsiswa_izin")==1 || allow("frmkejadian_lain")==1 || allow("frmguru_bk")==1 || allow("siswa_list2")==1 || allow("frmgugus")==1 || allow("frmsiswa_baru_list")==1 || allow("frminfonap")==1 || allow("frmsiswa_input_ekskul")==1 || allow("raport_siswa_cover")==1 || allow("frmalumni")==1 ) { ?>

	<?php if($_SESSION["tipe_user"] == "Siswa") { ?>
		<li class="<?php echo 'active open'; //$kesiswaan ?>">
	<?php } else { ?>
		<li class="<?php echo $kesiswaan ?>">
	<?php } ?>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-list-alt"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "Student"; } else { echo "Kesiswaan"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
		
			<?php if ( allow("kenaikan")==1 ) { ?>
				<li class="<?php echo $kenaikan_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kenaikan') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Increase Class"; } else { echo "Kenaikan Kelas"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php /*if ( allow("penempatan")==1 ) { ?>
				<li class="<?php echo $penempatan_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('penempatan') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Student Placement"; } else { echo "Penempatan Siswa"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php }*/ ?>
			
			<?php if ( allow("pindah_kelas")==1 ) { ?>
				<li class="<?php echo $pindah_kelas_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pindah_kelas') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Move Class"; } else { echo "Pindah Kelas"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("kelulusan")==1 ) { ?>
				<li class="<?php echo $kelulusan_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kelulusan') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Graduation"; } else { echo "Kelulusan"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmsiswa_baru")==1 ) { ?>
				<li class="<?php echo $siswa_baru_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_baru_list') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "New Student"; } else { echo "Edit Calon Siswa Baru"; } ?>
    				</a>
    				
    				
    				<b class="arrow"></b>
    			</li>    
			<?php } ?>
			
			<?php if ( allow("frmsiswa_baru_list")==1 ) { ?>
				<li class="<?php echo $siswa_baru_list_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_baru_list') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "New Student"; } else { echo "Daftar Siswa Baru"; } ?>
    				</a>
    				
    				
    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
            			
			<?php if ( allow("frmsiswa")==1 && $_SESSION["tipe_user"] != "Siswa" ) { ?>
				<li class="<?php echo $siswa_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Student"; } else { echo "Input Siswa"; } ?>
					</a>
					
					
					<b class="arrow"></b>
				</li>    
			<?php } ?>
			
			<?php if ( allow("frmsiswa_list")==1 ) { ?>
				<li class="<?php echo $siswa_list_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_list') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Student List"; } else { echo "Daftar Siswa"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("siswa_list2")==1 ) { ?>
				<li class="<?php echo $siswa_list2_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_list2') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Student Verification"; } else { echo "Daftar Siswa Terverifikasi"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmsiswa_input_ekskul")==1 ) { ?>
				<li class="<?php echo $siswa_input_ekskul_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_input_ekskul') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Extra Curricular Student"; } else { echo "Siswa Input Ekskul"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
            			
			<?php if ( allow("frmsiswa_ekstrakurikuler")==1 ) { ?>
				<li class="<?php echo $siswa_ekstrakurikuler_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_ekstrakurikuler_view') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Extra Curricular Student"; } else { echo "Siswa Ekstrakurikuler"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>			
			
			<?php if ( allow("frmgugus")==1 ) { ?>
				<li class="<?php echo $gugus_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('gugus') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Group"; } else { echo "Gugus MPLS"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
            			
			<?php if ( allow("frmtingkat")==1 ) { ?>
				<li class="<?php echo $tingkat_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('tingkat') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Level"; } else { echo "Tingkat/Jenjang"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmkelas")==1 ) { ?>
				<li class="<?php echo $kelas_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kelas') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Class"; } else { echo "Kelas"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmtahunajaran")==1 ) { ?>
				<li class="<?php echo $tahunajaran_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('tahunajaran') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "School Year"; } else { echo "Tahun Pelajaran"; } ?>
					</a>

					<b class="arrow"></b>
				</li>      
			<?php } ?>
			
			<?php if ( allow("frmagama")==1 ) { ?>
				<li class="<?php echo $agama_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('agama') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Religion"; } else { echo "Agama"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmsiswa_terlambat")==1 ) { ?>
				<li class="<?php echo $siswa_terlambat_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_terlambat') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Student Lates"; } else { echo "Siswa Terlambat"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmsiswa_izin")==1 ) { ?>
				<li class="<?php echo $siswa_izin_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_izin') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Student Absen"; } else { echo "Siswa Izin"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmkejadian_lain")==1 ) { ?>
				<li class="<?php echo $kejadian_lain_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kejadian_lain') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Other Accident"; } else { echo "Kejadian Lain"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmguru_bk")==1 ) { ?>
				<li class="<?php echo $guru_bk_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('guru_bk') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Teacher Consultant"; } else { echo "Guru BK"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("barcode")==1 ) { ?>
				<li class="<?php echo $barcode_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('barcode') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Student Barcode"; } else { echo "Barcode Siswa"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>

			<?php if ( allow("frmdepartemen")==1 ) { ?>
				<li class="<?php echo $departemen_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('department') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Department"; } else { echo "Unit"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmangkatan")==1 ) { ?>
				<li class="<?php echo $angkatan_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('angkatan') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Force"; } else { echo "Angkatan"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmalumni")==1 ) { ?>
				<li class="<?php echo $alumni_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('alumni') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Alumni Edit"; } else { echo "Edit Alumni"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
            			
			<?php if ( allow("alumni_list")==1 ) { ?>
				<li class="<?php echo $alumni_list_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('alumni_list') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Alumni List"; } else { echo "Daftar Alumni"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("raport_siswa_cover")==1 ) { ?>
				<li class="<?php echo $raport_siswa_cover_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('raport_siswa_cover_view') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Cover Report Student"; } else { echo "Cover Rapor Siswa"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
            			
			<?php if ( allow("pelajaran_un_minat")==1 ) { ?>
				<li class="<?php echo $pelajaran_un_minat_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pelajaran_un_minat') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Setup Mapel UN Minat"; } else { echo "Setup Mapel UN Minat"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("pelajaran_raport_minat")==1 ) { ?>
				<li class="<?php echo $pelajaran_raport_minat_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pelajaran_raport_minat') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Setup Raport Minat"; } else { echo "Setup Rapor Minat"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("penempatan_siswa_prioritas")==1 ) { ?>
				<li class="<?php echo $penempatan_siswa_prioritas_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('penempatan_siswa_prioritas') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Setup Penempatan Siswa Prioritas"; } else { echo "Setup Pengurutan/Tata Urut Penempatan Siswa"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frminfonap")==1 ) { ?>
				<li class="<?php echo $infonap_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('infonap') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Setup Maks. Nilai UN"; } else { echo "Setup Peminatan Nilai Ujian Mapel"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
            			
		</ul>
	</li>
<?php
}
?>


<!--AKADEMIK-->
<?php if ( allow("frmpelajaran")==1 || allow("frmsemester")==1 || allow("frmrpp")==1 || allow("frmkompetensi")==1 || allow("frmdasarpenilaian")==1 || allow("frmsiswa_krs")==1 || allow("siswa_krs_approved")==1 || allow("frmkartu_rencana_studi")==1 || allow("frmguru")==1 || allow("frmjadwal")==1 || allow("frmjam")==1 || allow("frmsoal")==1 || allow("frmsoal_select")==1 || allow("frmsoal_siswa")==1 || allow("frmpemetaan_kd")==1 || allow("frmpemetaan_kd_siswa")==1 || allow("frmukbm")==1 || allow("frmsoal_ukbm")==1 || allow("frmsoal_ukbm_select")==1 || allow("frmsoal_ukbm_siswa")==1 || allow("frmukbm_siswa")==1 || allow("ukbm_siswa_approved")==1 || allow("frmguru_ekskul")==1 || allow("frmguru_absen")==1 || allow("siswa_pertemuan_krs")==1 || allow("daftar_absensi")==1 ) { ?>

	<?php if($_SESSION["tipe_user"] == "Siswa") { ?>
		<li class="<?php echo 'active open'; //$akademik ?>">
	<?php } else { ?>
		<li class="<?php echo $akademik ?>">
	<?php } ?>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-tag"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "Curiculum"; } else { echo "Kurikulum"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			
			<?php if ( allow("frmpelajaran")==1 ) { ?>
				<li class="<?php echo $pelajaran_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pelajaran') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Lesson"; } else { echo "Mata Pelajaran"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>

			<?php /*if ( allow("frmsiswa_krs")==1 ) { ?>
				<li class="<?php echo $siswa_krs_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_krs') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Study Planning Card Student"; } else { echo "Input KRS"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php }*/ ?>
			
			<?php /*if ( allow("siswa_krs_approved")==1 ) { ?>
				<li class="<?php echo $siswa_krs_approved_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_krs_approved_view') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Study Planning Card Student Approved"; } else { echo "Approval Siswa KRS"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmkartu_rencana_studi")==1 ) { ?>
				<li class="<?php echo $kartu_rencana_studi_active ?>">
				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kartu_rencana_studi') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Study Planning Card"; } else { echo "KRS"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php }*/ ?>
			
			<?php if ( allow("siswa_pertemuan_krs")==1 ) { ?>	
				<li class="<?php echo $siswa_pertemuan_krs_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_pertemuan_krs') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Absensi List Siswa"; } else { echo "Daftar Absensi Siswa"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
    		
    		<?php if ( allow("daftar_absensi")==1 ) { ?>
    			<li class="<?php echo $daftar_absensi_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('daftar_absensi') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Absensi List"; } else { echo "Daftar Absensi"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>

			<?php if ( allow("frmguru")==1 ) { ?>
				<li class="<?php echo $guru_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('guru') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Teacher"; } else { echo "Guru Mata Pelajaran"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmguru_ekskul")==1 ) { ?>
				<li class="<?php echo $guru_ekskul_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('guru_ekskul') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Teacher Extra"; } else { echo "Guru Ekstrakurikuler"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
			
			<?php if ( allow("frmsemester")==1 ) { ?>
		        <li class="<?php echo $semester_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('semester') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Semester"; } else { echo "Semester"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
		               			
		    <?php if ( allow("frmrpp")==1 ) { ?>    
		        <li class="<?php echo $rpp_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpp') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "RPP"; } else { echo "RPP"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmkompetensi")==1 ) { ?>
				<li class="<?php echo $kompetensi_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kompetensi') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Competence"; } else { echo "Kompetensi"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmdasarpenilaian")==1 ) { ?>
				<li class="<?php echo $dasarpenilaian_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('dasarpenilaian') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Basis of Valuation"; } else { echo "Dasar Penilaian"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php /*if ( allow("frmjeniskompetensi")==1 ) { ?>
				<li class="<?php echo $jeniskompetensi_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jeniskompetensi') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Type of Competence"; } else { echo "Jenis Kompetensi"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php }*/ ?>
			
			<?php if ( allow("frmjadwal")==1 ) { ?>
				<li class="<?php echo $jadwal_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jadwal') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Schedule"; } else { echo "Jadwal"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmjam")==1 ) { ?>
				<li class="<?php echo $jam_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jam') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Jam"; } else { echo "Setup Jam"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpemetaan_kd_siswa")==1 ) { ?>
				<li class="<?php echo $pemetaan_kd_siswa_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pemetaan_kd_siswa') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Pemetaan KD Siswa"; } else { echo "Pemetaan KD Siswa"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmpemetaan_kd")==1 ) { ?>
				<li class="<?php echo $pemetaan_kd_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pemetaan_kd') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Pemetaan KD"; } else { echo "Pemetaan KD"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmsoal_siswa")==1 ) { ?>
				<li class="<?php echo $soal_siswa_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('soal_siswa') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Final Question Student"; } else { echo "Soal PAS Siswa"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmsoal_select")==1 ) { ?>
				<li class="<?php echo $soal_select_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('soal_select') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Final Question Selection"; } else { echo "Seleksi Soal PAS"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmsoal")==1 ) { ?>
				<li class="<?php echo $soal_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('soal') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Final Question Master"; } else { echo "Master Soal PAS"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmsoal_ukbm_siswa")==1 ) { ?>
				<li class="<?php echo $soal_ukbm_siswa_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('soal_ukbm_siswa') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Question UKBM Student"; } else { echo "Soal UKBM Siswa"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
    		
    		<?php if ( allow("ukbm_siswa_approved")==1 ) { ?>	
    			<li class="<?php echo $ukbm_siswa_approved_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('ukbm_siswa_approved') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Approved UKBM Student"; } else { echo "Approved Modul Belajar"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
            			
    		<?php if ( allow("frmukbm_siswa")==1 ) { ?>
    			<li class="<?php echo $ukbm_siswa_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('ukbm_siswa') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "UKBM Student"; } else { echo "UKBM Siswa"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
            			
			<?php if ( allow("frmsoal_ukbm_select")==1 ) { ?>	
				<li class="<?php echo $soal_ukbm_select_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('soal_ukbm_select') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Question UKBM Selection"; } else { echo "Seleksi Soal UKBM"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
            			
			<?php if ( allow("frmsoal_ukbm")==1 ) { ?>
				<li class="<?php echo $soal_ukbm_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('soal_ukbm') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Question UKBM Master"; } else { echo "Master Soal UKBM"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
    		
    		 <?php if ( allow("frmukbm")==1 ) { ?>
		    	<li class="<?php echo $ukbm_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('ukbm') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "UKBM"; } else { echo "Modul Ajar"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
    		
    		<?php if ( allow("frmguru_absen")==1 ) { ?>
				<li class="<?php echo $guru_absen_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('guru_absen') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Absen Guru"; } else { echo "Guru Tidak Hadir"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			
		</ul>
	</li>
<?php
}
?>
            	


<!--RAPOR-->
<?php if (allow("frmdaftarnilai")==1 || allow("raport_siswa")==1 || allow("raport_siswa_ledger")==1 || allow("frmpredikat_raport")==1 || allow("frmdeskripsi_raport")==1 || allow("frmsetup_siswa_khusus")==1 ) { ?>
	<li class="<?php echo $rapor ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-tag"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "Report"; } else { echo "Rapor"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			
			
			<?php if ( allow("frmdaftarnilai")==1 ) { ?>
				<li class="<?php echo $daftarnilai_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('daftarnilai_view') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Score List"; } else { echo "Input Nilai"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>

			<?php if ( allow("raport_siswa")==1 ) { ?>	
				<li class="<?php echo $raport_siswa_active ?>">
	        				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('raport_siswa_view') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Report Student"; } else { echo "Rapor Siswa"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("raport_siswa_ledger")==1 ) { ?>	
				<li class="<?php echo $raport_siswa_ledger_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('raport_siswa_ledger') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Report Ledger Student"; } else { echo "Rapor Siswa Leger"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpredikat_raport")==1 ) { ?>	
				<li class="<?php echo $predikat_raport_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('predikat_raport') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Setup Predikat Raport"; } else { echo "Setup Predikat Rapor"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmdeskripsi_raport")==1 ) { ?>	
				<li class="<?php echo $deskripsi_raport_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('deskripsi_raport') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Setup Description Raport"; } else { echo "Setup Deskripsi Rapor"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmsetup_siswa_khusus")==1 ) { ?>	
				<li class="<?php echo $setup_siswa_khusus_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('setup_siswa_khusus') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Setup Special Student"; } else { echo "Setup Siswa Khusus"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
		</ul>
	</li>
<?php } ?>


<!-- frmrekakun, frmdatapenerimaan, frmdatapengeluaran, frmbesarjtt, frmpenerimaanjtt, rpt_penerimaan -->

<!--KEUANGAN-->
<?php if ( allow("frmtahunbuku")==1 || allow("rpt_lunas")==1 || allow("frmreceipt")==1 || allow("frmgeneral_journal")==1 || allow("frmgeneral_journal_in")==1 || allow("frmfinance_type")==1 || allow("generate_ar")==1 || allow("frmcoa")==1 || allow("frmpurchase_inv")==1 || allow("purchase_inv_list")==1 || allow("frmpurchase_return")==1 || allow("frmgood_receipt")==1 || allow("frmpayment")==1 || allow("rpt_ar")==1 ) { ?>

	<li class="<?php echo $keuangan ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-pencil-square-o"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "Finance"; } else { echo "Keuangan"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>
	        
		<b class="arrow"></b>

		<ul class="submenu">
			
			<?php if ( allow("frmreceipt")==1 ) { ?>
				<li class="<?php echo $receipt_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('receipt') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Receipt"; } else { echo "Penerimaan Iuran Siswa"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>

			<?php if ( allow("rpt_ar")==1 ) { ?>
				<li class="<?php echo $rpt_ar_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_ar') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "AR Report"; } else { echo "Iuran Belum Lunas"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
			
			<?php if ( allow("frmgeneral_journal")==1 ) { ?>
				<li class="<?php echo $general_journal_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('general_journal') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Cash In/Out"; } else { echo "Kas Keluar"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmgeneral_journal_in")==1 ) { ?>
				<li class="<?php echo $general_journal_in_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('general_journal_in') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Cash In"; } else { echo "Kas Masuk"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
			
			<?php if ( allow("frmpurchase_inv")==1 ) { ?>
				<li class="<?php echo $purchase_inv_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('purchase_inv') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Purchase"; } else { echo "Pembelian"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("purchase_inv_list")==1 ) { ?>
				<li class="<?php echo $purchase_inv_list_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('purchase_inv_list') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Receipt Purchase List"; } else { echo "Penerimaan Pembelian"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmgood_receipt")==1 ) { ?>
				<li class="<?php echo $good_receipt_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('good_receipt_view') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Good Receipt List"; } else { echo "Daftar Penerimaan"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpurchase_return")==1 ) { ?>
				<li class="<?php echo $purchase_return_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('purchase_return') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Return Purchase"; } else { echo "Retur Pembelian"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpayment")==1 ) { ?>
				<li class="<?php echo $payment_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('payment') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Payment"; } else { echo "Pembayaran Hutang"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>

			<?php if ( allow("frmfinance_type")==1 ) { ?>
				<li class="<?php echo $finance_type_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('finance_type') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Finance Type"; } else { echo "Jenis Keuangan"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>

			<?php if ( allow("frmtahunbuku")==1 ) { ?>
				<li class="<?php echo $tahunbuku_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('tahunbuku') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Fiscal Year"; } else { echo "Tahun Buku"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmcoa")==1 ) { ?>
				<li class="<?php echo $coa_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('coa') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "CoA"; } else { echo "Rekening Perkiraan"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
				
			<?php /* if ( allow("frmrekakun")==1 ) { ?>
				<li class="<?php echo $rekakun_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rekakun') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "CoA"; } else { echo "Rekening Perkiraan"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmdatapenerimaan")==1 ) { ?>
				<li class="<?php echo $datapenerimaan_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('datapenerimaan') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Receipt Type"; } else { echo "Jenis Penerimaan"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmdatapengeluaran")==1 ) { ?>
				<li class="<?php echo $datapengeluaran_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('datapengeluaran') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Payment Type"; } else { echo "Jenis Pengeluaran"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmbesarjtt")==1 ) { ?>
				<li class="<?php echo $besarjtt_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('besarjtt_view') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Payment Setup"; } else { echo "Setup Pembayaran"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpenerimaanjtt")==1 ) { ?>
				<li class="<?php echo $penerimaanjtt_active ?>">
					<a href="#" onClick="JavaScript:tambahpenerimaan()">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Receipt"; } else { echo "Transaksi Penerimaan"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("rpt_penerimaan")==1 ) { ?>
				<li class="<?php echo $rpt_penerimaan_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_penerimaan') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Receipts Receipt"; } else { echo "Lap. Penerimaan"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } */ ?>

			<?php if ( allow("generate_ar")==1 ) { ?>
				<li class="<?php echo $generate_ar_active ?>">
					<a href="#"  onClick="JavaScript:generate_ar()">
						<i class="menu-icon fa fa-caret-right"></i>
						Generate Iuran Siswa
					</a>
					<b class="arrow"></b>
				</li>
			<?php } ?>
		</ul>
	</li>
<?php
}
?>
            	
            	  	


<!--PERPUSTAKAAN-->
<?php if ( allow("frmperpustakaan")==1 || allow("frmformat")==1 || allow("frmrak")==1 || allow("frmkatalog")==1 || allow("frmpenerbit")==1 || allow("frmpenulis")==1 || allow("frmpustaka")==1 || allow("frmpinjam")==1 || allow("frmkembali")==1 || allow("rpt_pinjam_telat")==1 || allow("frmkonfigurasi")==1 || allow("frmsupplier")==1 || allow("frmanggota")==1 || allow("frmperpustakaan")==1 || allow("chart_pengunjung")==1 || allow("chart_pinjam")==1 || allow("chart_rating_buku")==1 ) { ?>

	<li class="<?php echo $perpustakaan ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-pencil-square-o"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "Library"; } else { echo "Perpustakaan"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>
	        
		<b class="arrow"></b>

		<ul class="submenu">
			
			<!--<li class="<?php echo $rpt_penerimaan_active ?>">
				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_penerimaan') ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					<?php if ($_SESSION['bahasa']==1) { echo "Book Return"; } else { echo "Pengeluaran Barang"; } ?>
				</a>

				<b class="arrow"></b>
			</li>-->
			
			<?php if ( allow("frmformat")==1 ) { ?>
				<li class="<?php echo $format_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('format') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Format"; } else { echo "Format"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmrak")==1 ) { ?>
				<li class="<?php echo $rak_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rak') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Bin"; } else { echo "Rak"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmkatalog")==1 ) { ?>
				<li class="<?php echo $katalog_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('katalog') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Catalog"; } else { echo "Katalog"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpenerbit")==1 ) { ?>
				<li class="<?php echo $penerbit_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('penerbit') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Publisher"; } else { echo "Penerbit"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpenulis")==1 ) { ?>
				<li class="<?php echo $penulis_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('penulis') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Author"; } else { echo "Penulis"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpustaka")==1 ) { ?>
				<li class="<?php echo $pustaka_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pustaka') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Library"; } else { echo "Pustaka"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpinjam")==1 ) { ?>
				<li class="<?php echo $pinjam_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pinjam') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Lending Library"; } else { echo "Peminjaman Buku"; } ?>
					</a>

					<b class="arrow"></b>
				</li> 
			<?php } ?>
			
			<?php if ( allow("frmkembali")==1 ) { ?>
				<li class="<?php echo $kembali_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kembali') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Book Return"; } else { echo "Pengembalian Buku"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("rpt_pinjam_telat")==1 ) { ?>
				<li class="<?php echo $rpt_pinjam_telat_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_pinjam_telat') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Report Late Book Lending"; } else { echo "Lap. Peminjam Terlambat"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmkonfigurasi")==1 ) { ?>
				<li class="<?php echo $konfigurasi_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('konfigurasi') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Configuration"; } else { echo "Konfigurasi"; } ?>
					</a>

					<b class="arrow"></b>
				</li> 
			<?php } ?>
			
			<?php if ( allow("frmsupplier")==1 ) { ?>
				<li class="<?php echo $supplier_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('supplier') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Vendor"; } else { echo "Toko/Supplier"; } ?>
					</a>

					<b class="arrow"></b>
				</li>  
			<?php } ?>
			
			<?php if ( allow("frmanggota")==1 ) { ?>
				<li class="<?php echo $anggota_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('anggota') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Member"; } else { echo "Member"; } ?>
					</a>

					<b class="arrow"></b>
				</li> 
			<?php } ?>
			
			<?php if ( allow("frmperpustakaan")==1 ) { ?>
				<li class="<?php echo $daftarpustaka_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('perpustakaan') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Library Name"; } else { echo "Nama Perpustakaan"; } ?>
					</a>

					<b class="arrow"></b>
				</li>  
			<?php } ?>

			<?php if ( allow("chart_pengunjung")==1 ) { ?>
				<li class="<?php echo $chart_pengunjung_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('chart_pengunjung') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Grafik Pengunjung"; } else { echo "Grafik Pengunjung"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>

			<?php if ( allow("chart_pinjam")==1 ) { ?>
				<li class="<?php echo $chart_pinjam_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('chart_pinjam') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Grafik Peminjam"; } else { echo "Grafik Peminjam"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>

			<?php if ( allow("chart_rating_buku")==1 ) { ?>
				<li class="<?php echo $chart_rating_buku_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('chart_rating_buku') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Grafik Buku Sering Dipinjam"; } else { echo "Grafik Buku Sering Dipinjam"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>

		</ul>
	</li>
<?php
}
?>
            	


<!--KEPEGAWAIAN-->
<?php if ( allow("frmpegawai")==1 || allow("frmstatusguru")==1 || allow("pegawai_jabatan")==1 || allow("frmjabatan")==1 || allow("frmpangkat")==1 || allow("frmpegawai_pangkat")==1 || allow("frmjenis_sertifikasi")==1 || allow("frmstatus_pegawai")==1 || allow("frmkenaikan_gaji")==1 || allow("frmpegawai_pendidikan")==1 || allow("frmpegawai_keluarga")==1 || allow("frmpegawai_prestasi")==1 || allow("frmpegawai_skmengajar")==1 ) { ?>

	<li class="<?php echo $kepegawaian ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-pencil-square-o"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "Employment"; } else { echo "Kepegawaian"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>
	        
		<b class="arrow"></b>

		<ul class="submenu">
			
			<?php if ( allow("frmpegawai")==1 ) { ?>
				<li class="<?php echo $pegawai_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Staff"; } else { echo "Input PTK"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php /*if ( allow("frmstatusguru")==1 ) { ?>
				<li class="<?php echo $statusguru_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('statusguru') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Status of Teachers"; } else { echo "Status Guru"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php }*/ ?>
			
			<?php if ( allow("pegawai_jabatan")==1 ) { ?>
				<li class="<?php echo $pegawai_jabatan_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_jabatan') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Office Employee"; } else { echo "Jabatan Pegawai/PTK"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmjabatan")==1 ) { ?>
				<li class="<?php echo $jabatan_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jabatan') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Office"; } else { echo "Jabatan"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpangkat")==1 ) { ?>
				<li class="<?php echo $pangkat_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pangkat') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Rank"; } else { echo "Pangkat"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpegawai_pangkat")==1 ) { ?>
				<li class="<?php echo $pegawai_pangkat_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_pangkat') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Employees of Rank"; } else { echo "Kepangkatan Pegawai/PTK"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmjenis_sertifikasi")==1 ) { ?>
				<li class="<?php echo $jenis_sertifikasi_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jenis_sertifikasi') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Type of Certification"; } else { echo "Jenis Sertifikasi"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php /*if ( allow("frmstatus_pegawai")==1 ) { ?>
				<li class="<?php echo $status_pegawai_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('status_pegawai') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Staff Status"; } else { echo "Status Pegawai/PTK"; } ?>
					</a>

					<b class="arrow"></b>
				</li> 
			<?php }*/ ?>
			
			<?php if ( allow("frmkenaikan_gaji")==1 ) { ?>
				<li class="<?php echo $kenaikan_gaji_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kenaikan_gaji') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Salary Increases"; } else { echo "Kenaikan Gaji"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpegawai_pendidikan")==1 ) { ?>
				<li class="<?php echo $pegawai_pendidikan_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_pendidikan_') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Employee Education"; } else { echo "Pendidikan Pegawai/PTK"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpegawai_keluarga")==1 ) { ?>
				<li class="<?php echo $pegawai_keluarga_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_keluarga') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Family Employee"; } else { echo "Keluarga Pegawai/PTK"; } ?>
					</a>

					<b class="arrow"></b>
				</li> 
			<?php } ?>
			
			<?php if ( allow("frmpegawai_prestasi")==1 ) { ?>
				<li class="<?php echo $pegawai_prestasi_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_prestasi') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Employee Achievements"; } else { echo "Prestasi Pegawai/PTK"; } ?>
					</a>

					<b class="arrow"></b>
				</li>  
			<?php } ?>
			
			<?php if ( allow("frmpegawai_penghargaan")==1 ) { ?>
				<li class="<?php echo $pegawai_penghargaan_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_penghargaan') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Employee Appreciation"; } else { echo "Penghargaan Pegawai/PTK"; } ?>
					</a>

					<b class="arrow"></b>
				</li> 
			<?php } ?>
			
			<?php if ( allow("frmpegawai_skmengajar")==1 ) { ?>
				<li class="<?php echo $pegawai_skmengajar_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_skmengajar') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "SK Teaching"; } else { echo "SK Mengajar"; } ?>
					</a>

					<b class="arrow"></b>
				</li> 
			<?php } ?> 
			
		</ul>
	</li>
<?php
}
?>
            	


<!--BK (Bimbingan Konseling)-->
<?php if ( allow("frmjenis_pelanggaran")==1 || allow("frmjenis_prestasi")==1 || allow("frmpelanggaran_siswa")==1 || allow("frmkonseling_siswa")==1 || allow("frmjenis_izin")==1 || allow("frmizin_siswa")==1 || allow("rpt_izin_siswa")==1 || allow("rpt_konseling_siswa")==1 || allow("frmaspek_perkembangan")==1 || allow("frmassesmen_observasi")==1 || allow("frmaspek_psikologi")==1 || allow("frmaspek_psikologi_detail")==1 || allow("frmevaluasi_psikologi")==1 || allow("rpt_evaluasi_psikologi_level")==1 ) { ?>

	<li class="<?php echo $konseling ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-pencil-square-o"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "Consultation Counseling"; } else { echo "BK"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>
	        
		<b class="arrow"></b>

		<ul class="submenu">
			
			<?php if ( allow("frmjenis_pelanggaran")==1 ) { ?>
				<li class="<?php echo $jenis_pelanggaran_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jenis_pelanggaran') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Type of Violation"; } else { echo "Jenis Pelanggaran"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmjenis_prestasi")==1 ) { ?>
				<li class="<?php echo $jenis_prestasi_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jenis_prestasi') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Type of Accomplishment"; } else { echo "Jenis Prestasi"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpelanggaran_siswa")==1 ) { ?>
				<li class="<?php echo $pelanggaran_siswa_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pelanggaran_siswa') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Violation of Students"; } else { echo "Pelanggaran Siswa"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmkonseling_siswa")==1 ) { ?>
				<li class="<?php echo $konseling_siswa_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('konseling_siswa') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Counseling Students"; } else { echo "Konseling Siswa"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmjenis_izin")==1 ) { ?>
			<li class="<?php echo $jenis_izin_active ?>">
				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jenis_izin') ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					<?php if ($_SESSION['bahasa']==1) { echo "Type of Permission"; } else { echo "Jenis Izin"; } ?>
				</a>

				<b class="arrow"></b>
			</li>
			<?php } ?>
			
			<?php if ( allow("frmizin_siswa")==1 ) { ?>
				<li class="<?php echo $izin_siswa_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('izin_siswa') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Permit Students"; } else { echo "Izin Siswa"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("rpt_izin_siswa")==1 ) { ?>
				<li class="<?php echo $rpt_izin_siswa_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_izin_siswa') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Permit Students Report"; } else { echo "Lap. Izin Siswa"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<!--<li class="<?php echo $rpt_izin_siswa_surat_active ?>">
				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_izin_siswa_surat') ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					<?php if ($_SESSION['bahasa']==1) { echo "Permit Students Report"; } else { echo "Lap. Izin Siswa"; } ?>
				</a>

				<b class="arrow"></b>
			</li>-->
			
			<?php if ( allow("rpt_konseling_siswa")==1 ) { ?>
				<li class="<?php echo $rpt_konseling_siswa_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_konseling_siswa') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Counseling Students Report"; } else { echo "Lap. Konseling Siswa"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmassesmen_observasi")==1 ) { ?>
				<li class="<?php echo $assesmen_observasi_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('assesmen_observasi') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Observation Assemen"; } else { echo "Assemen Observasi"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmaspek_psikologi")==1 ) { ?>
				<li class="<?php echo $aspek_psikologi_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('aspek_psikologi') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Aspects of Psychology"; } else { echo "Jenis Aspek Psikologi"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmaspek_psikologi_detail")==1 ) { ?>
				<li class="<?php echo $aspek_psikologi_detail_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('aspek_psikologi_detail') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Aspects of Psychology Detail"; } else { echo "Aspek Psikologi Detail"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmevaluasi_psikologi")==1 ) { ?>
				<li class="<?php echo $evaluasi_psikologi_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('evaluasi_psikologi') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Evaluation Psychology"; } else { echo "Evaluasi Psikologi"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("rpt_evaluasi_psikologi_level")==1 ) { ?>
				<li class="<?php echo $rpt_evaluasi_psikologi_level_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_evaluasi_psikologi_level') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Evaluation Psychology Level Report"; } else { echo "Lap. Evaluasi Psikologi per Level"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
		</ul>
	</li>
<?php
}
?>
           	   

<!--PRESENSI-->
<?php if ( allow("frmpresensi_harian_siswa")==1 || allow("frmpresensi_absen_siswa")==1 || allow("frmpresensipelajaran")==1 || allow("rpt_presensi_harian_siswa")==1 || allow("rpt_presensi_siswa_pelajaran")==1 || allow("rpt_presensi_guru_pelajaran")==1 || allow("frmpresensi_general")==1 || allow("rpt_presensi_general")==1 || allow("frmpresensi_ukbm")==1 ) { ?>

	<li class="<?php echo $presensi ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-pencil-square-o"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "Presensi"; } else { echo "Presensi"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>
	        
		<b class="arrow"></b>

		<ul class="submenu">
			
			<?php if ( allow("frmpresensi_general")==1 ) { ?>
				<li class="<?php echo $presensi_general_active ?>">
    				<a href="#"  onClick="JavaScript:presensi_general()">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Presensi General"; } else { echo "Presensi PPK"; } ?>
    				</a>
    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmpresensi_ukbm")==1 ) { ?>
				<li class="<?php echo $presensi_ukbm_active ?>">
					<?php if($_SESSION["tipe_user"] == "Guru") { ?>
	    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('presensi_ukbm') ?>">
	    					<i class="menu-icon fa fa-caret-right"></i>
	    					<?php if ($_SESSION['bahasa']==1) { echo "Presensi KBM"; } else { echo "Presensi KBM"; } ?>
	    				</a>
	    			<?php } else { ?>
	    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('presensi_ukbm_filter') ?>">
	    					<i class="menu-icon fa fa-caret-right"></i>
	    					<?php if ($_SESSION['bahasa']==1) { echo "Presensi KBM"; } else { echo "Presensi KBM"; } ?>
	    				</a>
	    			<?php } ?>
    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmpresensi_harian_siswa")==1 ) { ?>
				<li class="<?php echo $presensi_harian_siswa_active ?>">
					<a href="#"  onClick="JavaScript:presensi_harian_siswa()">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Presensi Harian Siswa"; } else { echo "Presensi Harian Siswa"; } ?>
					</a>
					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpresensi_absen_siswa")==1 ) { ?>
				<li class="<?php echo $presensi_absen_siswa_active ?>">
					<a href="#"  onClick="JavaScript:presensi_absen_siswa()">
						<i class="menu-icon fa fa-caret-right"></i>
							Absensi Harian Siswa
					</a>
					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmpresensipelajaran")==1 ) { ?>
				<li class="<?php echo $presensipelajaran_active ?>">
					<a href="#" href="javascript:void(0);" name="Find" title="Presensi Siswa Pelajaran" onClick="presensipelajaran()">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Presensi Siswa Pelajaran"; } else { echo "Presensi KBM (Siswa)"; } ?>
					</a>
					
					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<!--<li class="<?php echo $presensipelajaran_active ?>">
				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('presensipelajaran') ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					<?php if ($_SESSION['bahasa']==1) { echo "Presensi Mapel"; } else { echo "Presensi Mapel"; } ?>
				</a>

				<b class="arrow"></b>
			</li>-->
			
			<?php if ( allow("rpt_presensi_general")==1 ) { ?>
				<li class="<?php echo $rpt_presensi_general_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_presensi_general') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "General Absensi Day Report"; } else { echo "Lap. Presensi Harian PTK"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("rpt_presensi_harian_siswa")==1 ) { ?>
				<li class="<?php echo $rpt_presensi_harian_siswa_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_presensi_harian_siswa') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Absensi Day Report"; } else { echo "Lap. Presensi Harian Siswa"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("rpt_presensi_siswa_pelajaran")==1 ) { ?>
				<li class="<?php echo $rpt_presensi_siswa_pelajaran_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_presensi_siswa_pelajaran') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Absensi Class Report"; } else { echo "Lap. Presensi KBM (Siswa)"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
    		
    		<?php if ( allow("rpt_presensi_guru_pelajaran")==1 ) { ?>
    			<li class="<?php echo $rpt_presensi_guru_pelajaran_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_presensi_guru_pelajaran') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Absensi Teacher Class Report"; } else { echo "Lap. Presensi KBM (Guru)"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
			
		</ul>
	</li>
<?php
}
?>


<!--ASSET-->
<?php if ( allow("frmmaterial")==1 || allow("frmitem_group")==1 || allow("frmbrand")==1 || allow("frmbuild")==1 || allow("frmasset_type")==1 || allow("frmroom")==1 || allow("frmroom_booking")==1 || allow("item_kir_view")==1 ) { ?>

	<li class="<?php echo $asset ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-desktop"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "Asset"; } else { echo "Sarana & Prasarana"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
		
			<?php if ( allow("frmroom_booking")==1 ) { ?>
				<li class="<?php echo $room_booking_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('room_booking_filter') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Booking Room-2"; } else { echo "Booking Ruang"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
            			
			<?php if ( allow("frmmaterial")==1 ) { ?>
				<li class="<?php echo $material_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('material') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Item Master"; } else { echo "Master Barang"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmitem_group")==1 ) { ?>
				<li class="<?php echo $item_group_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('item_group') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Item Group"; } else { echo "Kelompok Barang"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmbrand")==1 ) { ?>
				<li class="<?php echo $brand_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('brand') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Brand"; } else { echo "Merk Inventaris"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmbuild")==1 ) { ?>            			     
	            <li class="<?php echo $build_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('build') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Build Master"; } else { echo "Master Bangunan"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
            
            <?php if ( allow("frmroom")==1 ) { ?>
	            <li class="<?php echo $room_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('room') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Master Room"; } else { echo "Master Ruang"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
            									            			
			<!--<li class="<?php echo $asset_active ?>">
				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('asset') ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					<?php if ($_SESSION['bahasa']==1) { echo "Asset"; } else { echo "Sarana & Prasarana"; } ?>
				</a>

				<b class="arrow"></b>
			</li>-->
			
			<?php if ( allow("frmasset_type")==1 ) { ?>
				<li class="<?php echo $asset_type_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('asset_type') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Asset Type"; } else { echo "Jenis Inventaris"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>

			<?php /*if ( allow("item_kir_view")==1 ) { ?>
				<li class="<?php echo $item_kir_view_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('item_kir_view') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Bin Card"; } else { echo "Kartu KIR"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php }*/ ?>
			
		</ul>
	</li>
<?php
	}
?>
            	
            	

<!--SURAT MENYURAT-->
<?php if ( allow("frmkelompok_surat")==1 || allow("frmsurat_keluar")==1 || allow("frmsurat_masuk")==1 || allow("frmbuku_kunjungan")==1 || allow("chart_surat")==1 ) { ?>
	<li class="<?php echo $suratmenyurat ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-desktop"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "Documentation"; } else { echo "Surat Menyurat"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			
			<?php if ( allow("frmbuku_kunjungan")==1 ) { ?>
				<li class="<?php echo $buku_kunjungan_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('buku_kunjungan') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Guest Book"; } else { echo "Buku Tamu"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmsurat_masuk")==1 ) { ?>
				<li class="<?php echo $surat_masuk_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('surat_masuk') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Document In"; } else { echo "Surat Masuk"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmsurat_keluar")==1 ) { ?>
				<li class="<?php echo $surat_keluar_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('surat_keluar') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Document Out"; } else { echo "Surat Keluar"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("frmkelompok_surat")==1 ) { ?>
				<li class="<?php echo $kelompok_surat_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kelompok_surat') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Letter Group"; } else { echo "Kelompok Surat"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>

			<?php if ( allow("chart_surat")==1 ) { ?>
				<li class="<?php echo $chart_surat_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('chart_surat') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Letter In Graph"; } else { echo "Grafik Surat Masuk"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
		</ul>
	</li>
<?php
}
?>
            	
            	
<!--SYSTEM MANAGER-->
<?php if ( allow("frmcompany")==1 || allow("frmusr")==1 || allow("frmsetup_periode")==1 || allow("frmsetup_periode_raport")==1 || allow("frmsetup_periode_raport_pts")==1 ) { ?>

	<li class="<?php echo $pengaturan_system ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-desktop"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "System Setup"; } else { echo "Setup Sistem"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			
			<?php if ( allow("frmsetup_periode")==1 ) { ?>
				<li class="<?php echo $setup_periode_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('setup_periode') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Period Setup"; } else { echo "Setting Periode"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmsetup_periode_raport")==1 ) { ?>
				<li class="<?php echo $setup_periode_raport_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('setup_periode_raport') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Period Raport Setup"; } else { echo "Seting Titimangsa Rapor"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmsetup_periode_raport_pts")==1 ) { ?>
				<li class="<?php echo $setup_periode_raport_pts_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('setup_periode_raport_pts') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Period Raport PTS Setup"; } else { echo "Seting Titimangsa Rapor PTS"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("frmusr")==1 ) { ?>
				<li class="<?php echo $user_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('usr') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "User"; } else { echo "User"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php /*if ( allow("frmcompany")==1 ) { ?>
				<li class="<?php echo $company_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('company') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Company"; } else { echo "Setup Perusahaan"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php }*/ ?>
			
		</ul>
	</li>
	
<?php
}
?>


<!--REPORT-->
<?php if ( allow("rpt_sales_order")==1 || allow("rpt_sales_order_customer")==1 || allow("rpt_press")==1 || allow("rpt_damage")==1 || allow("rpt_counting")==1 || allow("rpt_sewing")==1 || allow("rpt_bincard")==1 || allow("rpt_stock_material")==1 || allow("rpt_sales_order_do")==1 ) { ?>

	<li class="<?php echo $report ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-file-o"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "Reports"; } else { echo "Laporan"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			
			<?php if ( allow("rpt_sales_order")==1 ) { ?>
				<li class="<?php echo $rpt_sales_order ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_sales_order') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "PO Report"; } else { echo "Lap. PO"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("rpt_sales_order_customer")==1 ) { ?>
			    <li class="<?php echo $rpt_sales_order_customer ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_sales_order_customer') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "PO per Customer Report"; } else { echo "Lap. PO per Customer"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("rpt_sales_order_do")==1 ) { ?>	
				<li class="<?php echo $rpt_sales_order_do_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_sales_order_do') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "PO Delivery Report"; } else { echo "Lap. PO Kirim"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
			
			<?php if ( allow("rpt_press")==1 ) { ?>
				<li class="<?php echo $rpt_press ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_press') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Press Report"; } else { echo "Lap. Press"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("rpt_counting")==1 ) { ?>	
				<li class="<?php echo $rpt_counting ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_counting') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Counting Report"; } else { echo "Lap. Counting"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
    		
    		<?php if ( allow("rpt_sewing")==1 ) { ?>	
    			<li class="<?php echo $rpt_sewing ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_sewing') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Sewing Report"; } else { echo "Lap. Jahit"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
			
			<?php if ( allow("rpt_damage")==1 ) { ?>
				<li class="<?php echo $rpt_damage ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_damage') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Damaged Report"; } else { echo "Lap. Cacat"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
			<?php } ?>
			
			<?php if ( allow("rpt_bincard")==1 ) { ?>
				<li class="<?php echo $rpt_bincard ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_bincard') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Bin Card Report"; } else { echo "Lap. Kartu Stok"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
    		
    		<?php if ( allow("rpt_stock_material")==1 ) { ?>	
    			<li class="<?php echo $rpt_stock_material_active ?>">
    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_stock_material') ?>">
    					<i class="menu-icon fa fa-caret-right"></i>
    					<?php if ($_SESSION['bahasa']==1) { echo "Material Stock Report"; } else { echo "Lap. Stok Kain"; } ?>
    				</a>

    				<b class="arrow"></b>
    			</li>
    		<?php } ?>
            			
    			
			<?php /*if ( allow("rpt_sales_item")==1 ) { ?>
				<li class="<?php echo $rpt_sales_item ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_sales_item') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Sales Report per Item"; } else { echo "Lap. Penjualan per Barang"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("rpt_sales_10")==1 ) { ?>
				<li class="<?php echo $rpt_sales_10 ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_sales_10') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Report Top 10 Item"; } else { echo "Lap. Penjualan 10 Barang Terbesar"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } ?>
			
			<?php if ( allow("rpt_profit_loss")==1 ) { ?>
				<li class="<?php echo $rpt_profit_loss_active ?>">
					<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_profit_loss') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						<?php if ($_SESSION['bahasa']==1) { echo "Report Profit & Loss"; } else { echo "Lap. Laba & Rugi"; } ?>
					</a>

					<b class="arrow"></b>
				</li>
			<?php } */ ?>
			
			
		</ul>
	</li>

<?php
}
?>


<!--DOWNLOAD/UPLOAD-->
<?php if ( allow("import_nilai_ujian")==1 ) { ?>

	<li class="<?php echo $download_upload ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-desktop"></i>
			<span class="menu-text">
				<?php if ($_SESSION['bahasa']==1) { echo "Download/Upload"; } else { echo "Download/Upload"; } ?>
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			
			
			<?php /*
			<li class="<?php echo $upload_download_active ?>">
				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('upload_download') ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					<?php if ($_SESSION['bahasa']==1) { echo "Upload/Download"; } else { echo "Upload/Download"; } ?>
				</a>

				<b class="arrow"></b>
			</li>
			
			<li class="<?php echo $backup_active ?>">
				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('backup') ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					<?php if ($_SESSION['bahasa']==1) { echo "Backup Database"; } else { echo "Backup Database"; } ?>
				</a>

				<b class="arrow"></b>
			</li>*/ ?>

			<li class="<?php echo $generate_import_nilai_ujian_active ?>">
				<a href="#"  onClick="JavaScript:generate_import_nilai_ujian()">
					<i class="menu-icon fa fa-caret-right"></i>
					Import Nilai Ujian
				</a>
				<b class="arrow"></b>
			</li>
			
		</ul>
	</li> 
<?php
	}
?>

                