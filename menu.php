<?php
@session_start();

if ($act == '' ) {  
    $dashboard = "active open";
} 


##psb
$psb = '';
if ( $act == obraxabrix('registrasi') ) {  
    $psb = "active open";
    $registrasi_active = "active";
}
if ( $act == obraxabrix('registrasi_view') ) {  
    $psb = "active open";
    $registrasi_view_active = "active";
}
if ( $act == obraxabrix('prosespenerimaansiswa') || $act == obraxabrix('prosespenerimaansiswa_view') ) {  
    $psb = "active open";
    $prosespenerimaansiswa_active = "active";
}
if ( $act == obraxabrix('kelompokcalonsiswa') || $act == obraxabrix('kelompokcalonsiswa_view') ) {  
    $psb = "active open";
    $kelompokcalonsiswa_active = "active";
}


##kesiswaan
$kesiswaan = '';
if ( $act == obraxabrix('siswa') || $act == obraxabrix('siswa_view')) {  
	$kesiswaan = "active open";
	$siswa_active = "active";
}
if ( $act == obraxabrix('siswa_list') ) {  
	$kesiswaan = "active open";
	$siswa_list_active = "active";
}
if ( $act == obraxabrix('siswa_list2') ) {  
	$kesiswaan = "active open";
	$siswa_list2_active = "active";
}
if ( $act == obraxabrix('tingkat') || $act == obraxabrix('tingkat_view') ) {  
	$kesiswaan = "active open";
	$tingkat_active = "active";
}
if ( $act == obraxabrix('kelas') || $act == obraxabrix('kelas_view') ) {  
	$kesiswaan = "active open";
	$kelas_active = "active";
}
if ( $act == obraxabrix('tahunajaran') || $act == obraxabrix('tahunajaran_view') ) {  
	$kesiswaan = "active open";
	$tahunajaran_active = "active";
}
if ( $act == obraxabrix('agama') || $act == obraxabrix('agama_view') ) {  
	$kesiswaan = "active open";
	$agama_active = "active";
}
if ( $act == obraxabrix('kenaikan') || $act == obraxabrix('kenaikan_view') ) {  
	$kesiswaan = "active open";
	$kenaikan_active = "active";
}
if ( $act == obraxabrix('penempatan') ) {  
	$kesiswaan = "active open";
	$penempatan_active = "active";
}
if ( $act == obraxabrix('barcode') ) {  
	$kesiswaan = "active open";
	$barcode_active = "active";
}
if ( $act == obraxabrix('department') || $act == obraxabrix('department_view') ) {  
	$kesiswaan = "active open";
	$departemen_active = "active";
}
if ( $act == obraxabrix('angkatan') || $act == obraxabrix('angkatan_view') ) {  
	$kesiswaan = "active open";
	$angkatan_active = "active";
}
if ( $act == obraxabrix('kelulusan') || $act == obraxabrix('kelulusan_view') ) {  
	$kesiswaan = "active open";
	$kelulusan_active = "active";
}
if ( $act == obraxabrix('alumni_list') ) {  
	$kesiswaan = "active open";
	$alumni_list_active = "active";
}
if ( $act == obraxabrix('alumni') ) {  
	$kesiswaan = "active open";
	$alumni_active = "active";
}
if ( $act == obraxabrix('pindah_kelas') ) {  
	$kesiswaan = "active open";
	$pindah_kelas_active = "active";
}
if ( $act == obraxabrix('pelajaran_un_minat') ) {  
	$kesiswaan = "active open";
	$pelajaran_un_minat_active = "active";
}
if ( $act == obraxabrix('pelajaran_raport_minat') ) {  
	$kesiswaan = "active open";
	$pelajaran_raport_minat_active = "active";
}
if ( $act == obraxabrix('penempatan_siswa_prioritas') || $act == obraxabrix('penempatan_siswa_prioritas_view') ) {  
	$kesiswaan = "active open";
	$penempatan_siswa_prioritas_active = "active";
}
if ( $act == obraxabrix('siswa_input_ekskul') || $act == obraxabrix('siswa_input_ekskul_view') ) {  
	$kesiswaan = "active open";
	$siswa_input_ekskul_active = "active";
}
if ( $act == obraxabrix('siswa_ekstrakurikuler') || $act == obraxabrix('siswa_ekstrakurikuler_view') ) {  
	$kesiswaan = "active open";
	$siswa_ekstrakurikuler_active = "active";
}
if ( $act == obraxabrix('guru_absen') || $act == obraxabrix('guru_absen_view')) {  
	$kesiswaan = "active open";
	$guru_absen_active = "active";
}
if ( $act == obraxabrix('siswa_terlambat') || $act == obraxabrix('siswa_terlambat_view')) {  
	$kesiswaan = "active open";
	$siswa_terlambat_active = "active";
}
if ( $act == obraxabrix('siswa_izin') || $act == obraxabrix('siswa_izin_view')) {  
	$kesiswaan = "active open";
	$siswa_izin_active = "active";
}
if ( $act == obraxabrix('kejadian_lain') || $act == obraxabrix('kejadian_lain_view')) {  
	$kesiswaan = "active open";
	$kejadian_lain_active = "active";
}
if ( $act == obraxabrix('guru_bk') || $act == obraxabrix('guru_bk_view')) {  
	$kesiswaan = "active open";
	$guru_bk_active = "active";
}
if ( $act == obraxabrix('guru_penugasan') || $act == obraxabrix('guru_penugasan_view')) {  
	$kesiswaan = "active open";
	$guru_penugasan_active = "active";
}
if ( $act == obraxabrix('siswa_baru') || $act == obraxabrix('siswa_baru_view')) {  
	$kesiswaan = "active open";
	$siswa_baru_active = "active";
}
if ( $act == obraxabrix('gugus') || $act == obraxabrix('gugus_view') ) {  
	$kesiswaan = "active open";
	$gugus_active = "active";
}
if ( $act == obraxabrix('siswa_baru_list')) {  
	$kesiswaan = "active open";
	$siswa_baru_list_active = "active";
}
if ( $act == obraxabrix('infonap') || $act == obraxabrix('infonap_view') ) {  
	$kesiswaan = "active open";
	$infonap_active = "active";
}
if ( $act == obraxabrix('raport_siswa_cover_view') ) {  
	$kesiswaan = "active open";
	$raport_siswa_cover_active = "active";
}



##akademik
$akademik = "";
if ( $act == obraxabrix('pelajaran') || $act == obraxabrix('pelajaran_view') ) {  
	$akademik = "active open";
	$pelajaran_active = "active";
}
if ( $act == obraxabrix('semester') || $act == obraxabrix('semester_view') ) {  
	$akademik = "active open";
	$semester_active = "active";
}
if ( $act == obraxabrix('ukbm') || $act == obraxabrix('ukbm_view') ) {  
	$akademik = "active open";
	$ukbm_active = "active";
}
if ( $act == obraxabrix('rpp') || $act == obraxabrix('rpp_view') ) {  
	$akademik = "active open";
	$rpp_active = "active";
}
if ( $act == obraxabrix('kompetensi') || $act == obraxabrix('kompetensi_view') ) {  
	$akademik = "active open";
	$kompetensi_active = "active";
}
if ( $act == obraxabrix('dasarpenilaian') || $act == obraxabrix('dasarpenilaian_view') ) {  
	$akademik = "active open";
	$dasarpenilaian_active = "active";
}
if ( $act == obraxabrix('jeniskompetensi') || $act == obraxabrix('jeniskompetensi_view') ) {  
	$akademik = "active open";
	$jeniskompetensi_active = "active";
}

if ( $act == obraxabrix('kartu_rencana_studi') || $act == obraxabrix('kartu_rencana_studi_view') ) {  
	$akademik = "active open";
	$kartu_rencana_studi_active = "active";
}
if ( $act == obraxabrix('siswa_pertemuan_krs') ) {  
	$akademik = "active open";
	$siswa_pertemuan_krs_active = "active";
}
if ( $act == obraxabrix('siswa_krs') || $act == obraxabrix('siswa_krs_view') ) {  
	$akademik = "active open";
	$siswa_krs_active = "active";
}
if ( $act == obraxabrix('siswa_krs_approved') || $act == obraxabrix('siswa_krs_approved_view') ) {  
	$akademik = "active open";
	$siswa_krs_approved_active = "active";
}
if ( $act == obraxabrix('guru') || $act == obraxabrix('guru_view') ) {  
	$akademik = "active open";
	$guru_active = "active";
}
if ( $act == obraxabrix('guru_ekskul') || $act == obraxabrix('guru_ekskul_view') ) {  
	$akademik = "active open";
	$guru_ekskul_active = "active";
}
if ( $act == obraxabrix('jam') || $act == obraxabrix('jam_view') ) {  
	$akademik = "active open";
	$jam_active = "active";
}
if ( $act == obraxabrix('jadwal') || $act == obraxabrix('jadwal_view') ) {  
	$akademik = "active open";
	$jadwal_active = "active";
}
if ( $act == obraxabrix('soal') || $act == obraxabrix('soal_view') ) {  
	$akademik = "active open";
	$soal_active = "active";
}

if ( $act == obraxabrix('soal_ukbm') || $act == obraxabrix('soal_ukbm_view') ) {  
	$akademik = "active open";
	$soal_ukbm_active = "active";
}
if ( $act == obraxabrix('soal_select') || $act == obraxabrix('soal_select_view') ) {  
	$akademik = "active open";
	$soal_select_active = "active";
}
if ( $act == obraxabrix('soal_ukbm_select') || $act == obraxabrix('soal_ukbm_select_view') ) {  
	$akademik = "active open";
	$soal_ukbm_select_active = "active";
}
if ( $act == obraxabrix('soal_siswa') || $act == obraxabrix('soal_siswa_view') ) {  
	$akademik = "active open";
	$soal_siswa_active = "active";
}
if ( $act == obraxabrix('soal_ukbm_siswa') || $act == obraxabrix('soal_ukbm_siswa_view') ) {  
	$akademik = "active open";
	$soal_ukbm_siswa_active = "active";
}
if ( $act == obraxabrix('pemetaan_kd') || $act == obraxabrix('pemetaan_kd_view') ) {  
	$akademik = "active open";
	$pemetaan_kd_active = "active";
}
if ( $act == obraxabrix('pemetaan_kd_siswa') || $act == obraxabrix('pemetaan_kd_siswa_view') ) {  
	$akademik = "active open";
	$pemetaan_kd_siswa_active = "active";
}
if ( $act == obraxabrix('ukbm_siswa') || $act == obraxabrix('ukbm_siswa_view') ) {  
	$akademik = "active open";
	$ukbm_siswa_active = "active";
}
if ( $act == obraxabrix('ukbm_siswa_approved') ) {  
	$akademik = "active open";
	$ukbm_siswa_approved_active = "active";
}
if ( $act == obraxabrix('daftar_absensi') ) {  
	$akademik = "active open";
	$daftar_absensi_active = "active";
}

//daftarnilai_view, raport_siswa_view, raport_siswa_ledger, predikat_raport, deskripsi_raport, setup_siswa_khusus
##Rapor
$rapor = "";
if ( $act == obraxabrix('setup_siswa_khusus') || $act == obraxabrix('setup_siswa_khusus_view') ) {  
	$rapor = "active open";
	$setup_siswa_khusus_active = "active";
}
if ( $act == obraxabrix('deskripsi_raport') || $act == obraxabrix('deskripsi_raport_view') ) {  
	$rapor = "active open";
	$deskripsi_raport_active = "active";
}
if ( $act == obraxabrix('predikat_raport') || $act == obraxabrix('predikat_raport_view') ) {  
	$rapor = "active open";
	$predikat_raport_active = "active";
}
if ( $act == obraxabrix('daftarnilai_view') ) {  
	$rapor = "active open";
	$daftarnilai_active = "active";
}
if ( $act == obraxabrix('raport_siswa') || $act == obraxabrix('raport_siswa_view') ) {  
	$rapor = "active open";
	$raport_siswa_active = "active";
}

if ( $act == obraxabrix('raport_siswa_ledger') ) {  
	$rapor = "active open";
	$raport_siswa_ledger_active = "active";
}
            			
            			


##keuangan
$keuangan = "";
if ( $act == obraxabrix('receipt') || $act == obraxabrix('receipt_view') ) {  
	$keuangan = "active open";
	$receipt_active = "active";
}

if ( $act == obraxabrix('finance_type') || $act == obraxabrix('finance_type_view') ) {  
    $keuangan = "active open";
    $finance_type_active = "active";
}
if ( $act == obraxabrix('general_journal') || $act == obraxabrix('general_journal_view') ) {  
    $keuangan = "active open";
    $general_journal_active = "active";
}
if ( $act == obraxabrix('general_journal_in') || $act == obraxabrix('general_journal_in_view') ) {  
    $keuangan = "active open";
    $general_journal_in_active = "active";
}

if ( $act == obraxabrix('tahunbuku') || $act == obraxabrix('tahunbuku_view') ) {  
	$keuangan = "active open";
	$tahunbuku_active = "active";
}
if ( $act == obraxabrix('rekakun') || $act == obraxabrix('rekakun_view') ) {  
	$keuangan = "active open";
	$rekakun_active = "active";
}
if ( $act == obraxabrix('datapenerimaan') || $act == obraxabrix('datapenerimaan_view') ) {  
	$keuangan = "active open";
	$datapenerimaan_active = "active";
}
if ( $act == obraxabrix('datapengeluaran') || $act == obraxabrix('datapengeluaran_view') ) {  
	$keuangan = "active open";
	$datapengeluaran_active = "active";
}
if ( $act == obraxabrix('besarjtt') || $act == obraxabrix('besarjtt_view') ) {  
	$keuangan = "active open";
	$besarjtt_active = "active";
}
if ( $act == obraxabrix('penerimaanjtt') || $act == obraxabrix('penerimaanjtt_view') ) {  
	$keuangan = "active open";
	$penerimaanjtt_active = "active";
}
if ( $act == obraxabrix('rpt_penerimaan') || $act == obraxabrix('rpt_lunas') ) {  
	$keuangan = "active open";
	$rpt_penerimaan_active = "active";
}
if ( $act == obraxabrix('generate_ar') ) {  
	$keuangan = "active open";
	$generate_ar_active = "active";
}
if ( $act == obraxabrix('coa') || $act == obraxabrix('coa_view') ) {  
    $keuangan = "active open";
    $coa_active = "active";
}
if ( $act == obraxabrix('purchase_inv') || $act == obraxabrix('purchase_inv_view') ) {  
    $keuangan = "active open";
    $purchase_inv_active = "active";
}
if ( $act == obraxabrix('purchase_inv_list') ) {  
    $keuangan = "active open";
    $purchase_inv_list_active = "active";
}
if ( $act == obraxabrix('purchase_return') || $act == obraxabrix('purchase_return_view') ) {  
    $keuangan = "active open";
    $purchase_return_active = "active";
}
if ( $act == obraxabrix('good_receipt') || $act == obraxabrix('good_receipt_view') ) {  
    $keuangan = "active open";
    $good_receipt_active = "active";
}
if ( $act == obraxabrix('payment') || $act == obraxabrix('payment_view') ) {  
    $keuangan = "active open";
    $payment_active = "active";
}
if ( $act == obraxabrix('rpt_ar') ) {  
	$keuangan = "active open";
	$rpt_ar_active = "active";
}

##perpustakaan
$perpustakaan = "";
if ( $act == obraxabrix('perpustakaan') || $act == obraxabrix('perpustakaan_view') ) {  
	$perpustakaan = "active open";
	$rpt_penerimaan_active = "active";
}
if ( $act == obraxabrix('format') || $act == obraxabrix('format_view') ) {  
	$perpustakaan = "active open";
	$format_active = "active";
}
if ( $act == obraxabrix('rak') || $act == obraxabrix('rak_view') ) {  
	$perpustakaan = "active open";
	$rak_active = "active";
}
if ( $act == obraxabrix('katalog') || $act == obraxabrix('katalog_view') ) {  
	$perpustakaan = "active open";
	$katalog_active = "active";
}
if ( $act == obraxabrix('penerbit') || $act == obraxabrix('penerbit_view') ) {  
	$perpustakaan = "active open";
	$penerbit_active = "active";
}
if ( $act == obraxabrix('penulis') || $act == obraxabrix('penulis_view') ) {  
	$perpustakaan = "active open";
	$penulis_active = "active";
}
if ( $act == obraxabrix('pustaka') || $act == obraxabrix('pustaka_view') ) {  
	$perpustakaan = "active open";
	$pustaka_active = "active";
}
if ( $act == obraxabrix('pinjam') || $act == obraxabrix('pinjam_view') ) {  
	$perpustakaan = "active open";
	$pinjam_active = "active";
}
if ( $act == obraxabrix('kembali') || $act == obraxabrix('kembali_view') ) {  
	$perpustakaan = "active open";
	$kembali_active = "active";
}
if ( $act == obraxabrix('rpt_pinjam_telat') ) {  
	$perpustakaan = "active open";
	$rpt_pinjam_telat_active = "active";
}
if ( $act == obraxabrix('konfigurasi') || $act == obraxabrix('konfigurasi_view') ) {  
	$perpustakaan = "active open";
	$konfigurasi_active = "active";
}
if ( $act == obraxabrix('supplier') || $act == obraxabrix('supplier_view') ) {  
	$perpustakaan = "active open";
	$supplier_active = "active";
}
if ( $act == obraxabrix('anggota') || $act == obraxabrix('anggota_view') ) {  
	$perpustakaan = "active open";
	$anggota_active = "active";
}
if ( $act == obraxabrix('daftarpustaka') || $act == obraxabrix('daftarpustaka_view') ) {  
	$perpustakaan = "active open";
	$daftarpustaka_active = "active";
}
if ( $act == obraxabrix('chart_pengunjung') ) {  
	$perpustakaan = "active open";
	$chart_pengunjung_active = "active";
}
if ( $act == obraxabrix('chart_pinjam') ) {  
	$perpustakaan = "active open";
	$chart_pinjam_active = "active";
}
if ( $act == obraxabrix('chart_rating_buku') ) {  
	$perpustakaan = "active open";
	$chart_rating_buku_active = "active";
}


##kepegawaian
$kepegawaian = "";
if ( $act == obraxabrix('pegawai') || $act == obraxabrix('pegawai_view') ) {  
	$kepegawaian = "active open";
	$pegawai_active = "active";
}
if ( $act == obraxabrix('pegawai') || $act == obraxabrix('pegawai_view')) {
	$kepegawaian = "active open";
	$pegawai_active = "active";
}
if ( $act == obraxabrix('statusguru') || $act == obraxabrix('statusguru_view')) {
	$kepegawaian = "active open";
	$statusguru_active = "active";	
}
if ($act == obraxabrix('pegawai_jabatan') || $act == obraxabrix('pegawai_jabatan_view')) {
	$kepegawaian = "active open";
	$pegawai_jabatan_active = "active";	
}
if ( $act == obraxabrix('jabatan') || $act == obraxabrix('jabatan_view') ) {
	$kepegawaian = "active open";
	$jabatan_active = "active";	
}
if ( $act == obraxabrix('pangkat') || $act == obraxabrix('pangkat_view') ) {
	$kepegawaian = "active open";
	$pangkat_active = "active";	
}
if ( $act == obraxabrix('pegawai_pangkat') || $act == obraxabrix('pegawai_pangkat_view') ) {
	$kepegawaian = "active open";
	$pegawai_pangkat_active = "active";	
}
if ( $act == obraxabrix('jenis_sertifikasi') || $act == obraxabrix('jenis_sertifikasi_view') ) {
	$kepegawaian = "active open";
	$jenis_sertifikasi_active = "active";	
}
if ( $act == obraxabrix('status_pegawai') || $act == obraxabrix('status_pegawai_view') ) {
	$kepegawaian = "active open";
	$status_pegawai_active = "active";	
}
if ( $act == obraxabrix('kenaikan_gaji') || $act == obraxabrix('kenaikan_gaji_view') ) {
	$kepegawaian = "active open";
	$kenaikan_gaji_active = "active";	
}
if ( $act == obraxabrix('pegawai_pendidikan') || $act == obraxabrix('pegawai_pendidikan_view') ) {
	$kepegawaian = "active open";
	$pegawai_pendidikan_active = "active";	
}
if ( $act == obraxabrix('pegawai_keluarga') || $act == obraxabrix('pegawai_keluarga_view') ) {
	$kepegawaian = "active open";
	$pegawai_keluarga_active = "active";	
}
if ( $act == obraxabrix('pegawai_prestasi') || $act == obraxabrix('pegawai_prestasi_view') ) {
	$kepegawaian = "active open";
	$pegawai_prestasi_active = "active";	
}
if ( $act == obraxabrix('pegawai_penghargaan') || $act == obraxabrix('pegawai_penghargaan_view') ) {
	$kepegawaian = "active open";
	$pegawai_penghargaan_active = "active";	
}
if ( $act == obraxabrix('pegawai_skmengajar') || $act == obraxabrix('pegawai_skmengajar_view') ) {
	$kepegawaian = "active open";
	$pegawai_skmengajar_active = "active";	
}


##konseling
$konseling = "";
if ( $act == obraxabrix('jenis_pelanggaran') || $act == obraxabrix('jenis_pelanggaran_view') ) {
	$konseling = "active open";
	$jenis_pelanggaran_active = "active";	
}
if ( $act == obraxabrix('jenis_prestasi') || $act == obraxabrix('jenis_prestasi_view') ) {
	$konseling = "active open";
	$jenis_prestasi_active = "active";	
}
if ( $act == obraxabrix('pelanggaran_siswa') || $act == obraxabrix('pelanggaran_siswa_view') ) {
	$konseling = "active open";
	$pelanggaran_siswa_active = "active";	
}
if ( $act == obraxabrix('konseling_siswa') || $act == obraxabrix('konseling_siswa_view') ) {
	$konseling = "active open";
	$konseling_siswa_active = "active";	
}
if ( $act == obraxabrix('jenis_izin') || $act == obraxabrix('jenis_izin_view') ) {
	$konseling = "active open";
	$jenis_izin_active = "active";	
}
if ( $act == obraxabrix('izin_siswa') || $act == obraxabrix('izin_siswa_view') ) {
	$konseling = "active open";
	$izin_siswa_active = "active";	
}
if ( $act == obraxabrix('rpt_izin_siswa') ) {
	$konseling = "active open";
	$rpt_izin_siswa_active = "active";	
}
if ( $act == obraxabrix('rpt_izin_siswa_surat') ) {
	$konseling = "active open";
	$rpt_izin_siswa_surat_active = "active";	
}
if ( $act == obraxabrix('rpt_konseling_siswa') ) {
	$konseling = "active open";
	$rpt_konseling_siswa_active = "active";	
}
if ( $act == obraxabrix('assesmen_observasi') || $act == obraxabrix('assesmen_observasi_view') ) {
	$konseling = "active open";
	$assesmen_observasi_active = "active";	
}
if ( $act == obraxabrix('aspek_psikologi') || $act == obraxabrix('aspek_psikologi_view') ) {
	$konseling = "active open";
	$aspek_psikologi_active = "active";	
}
if ( $act == obraxabrix('aspek_psikologi_detail') || $act == obraxabrix('aspek_psikologi_detail_view') ) {
	$konseling = "active open";
	$aspek_psikologi_detail_active = "active";	
}
if ( $act == obraxabrix('evaluasi_psikologi') || $act == obraxabrix('evaluasi_psikologi_view') ) {
	$konseling = "active open";
	$evaluasi_psikologi_active = "active";	
}
if ( $act == obraxabrix('rpt_evaluasi_psikologi_level') ) {
	$konseling = "active open";
	$rpt_evaluasi_psikologi_level_active = "active";	
}

##presensi
$presensi = '';
if ( $act == obraxabrix('presensi_general') || $act == obraxabrix('presensi_general_view') ) {  
    $presensi = "active open";
    $presensi_general_active = "active";
}
if ( $act == obraxabrix('presensi_ukbm') || $act == obraxabrix('presensi_ukbm_view') || $act == obraxabrix('presensi_ukbm_filter') ) {  
    $presensi = "active open";
    $presensi_ukbm_active = "active";
}
if ( $act == obraxabrix('presensi_harian_siswa') || $act == obraxabrix('presensi_harian_siswa_view') ) {  
    $presensi = "active open";
    $presensi_harian_siswa_active = "active";
}
if ( $act == obraxabrix('rpt_presensi_harian_siswa') ) {  
	$presensi = "active open";
    $rpt_presensi_harian_siswa_active = "active";
}
if ( $act == obraxabrix('presensipelajaran') ) {  
	$presensi = "active open";
    $presensipelajaran_siswa_active = "active";
}
if ( $act == obraxabrix('rpt_presensi_siswa_pelajaran') ) {  
	$presensi = "active open";
    $rpt_presensi_siswa_pelajaran_active = "active";
}
if ( $act == obraxabrix('rpt_presensi_guru_pelajaran') ) {  
	$presensi = "active open";
    $rpt_presensi_guru_pelajaran_active = "active";
}
if ( $act == obraxabrix('rpt_presensi_general') ) {  
	$presensi = "active open";
    $rpt_presensi_general_active = "active";
}


##asset
$asset = '';
if ( $act == obraxabrix('asset') || $act == obraxabrix('asset_view') ) {  
    $asset = "active open";
    $asset_active = "active";
}
if ( $act == obraxabrix('asset_type') || $act == obraxabrix('asset_type_view') ) {  
    $asset = "active open";
    $asset_type_active = "active";
}
if ( $act == obraxabrix('material') || $act == obraxabrix('material_view') ) {  
    $asset = "active open";
    $material_active = "active";
}
if ( $act == obraxabrix('item_group') || $act == obraxabrix('item_group_view') ) {  
    $asset = "active open";
    $item_group_active = "active";
}
if ( $act == obraxabrix('brand') || $act == obraxabrix('brand_view') ) {  
    $asset = "active open";
    $brand_active = "active";
}
if ( $act == obraxabrix('build') || $act == obraxabrix('build_view') ) {  
    $asset = "active open";
    $build_active = "active";
}
if ( $act == obraxabrix('room') || $act == obraxabrix('room_view') ) {  
    $asset = "active open";
    $room_active = "active";
}
if ( $act == obraxabrix('room_booking_view') || $act == obraxabrix('room_booking') || $act == obraxabrix('room_booking_filter') ) {  
    $asset = "active open";
    $room_booking_active = "active";
}
if ( $act == obraxabrix('item_kir_view') ) {  
    $asset = "active open";
    $item_kir_view_active = "active";
}


##surat menyurat
$suratmenyurat = '';
if ( $act == obraxabrix('kelompok_surat') || $act == obraxabrix('kelompok_surat_view') ) {  
    $suratmenyurat = "active open";
    $kelompok_surat_active = "active";
}
if ( $act == obraxabrix('surat_keluar') || $act == obraxabrix('surat_keluar_view') ) {  
    $suratmenyurat = "active open";
    $surat_keluar_active = "active";
}
if ( $act == obraxabrix('surat_masuk') || $act == obraxabrix('surat_masuk_view') ) {  
    $suratmenyurat = "active open";
    $surat_masuk_active = "active";
}
if ( $act == obraxabrix('buku_kunjungan') || $act == obraxabrix('buku_kunjungan_view') ) {  
    $suratmenyurat = "active open";
    $buku_kunjungan_active = "active";
}
if ( $act == obraxabrix('chart_surat') ) {  
    $suratmenyurat = "active open";
    $chart_surat_active = "active";
}


//=====>Modul Pengaturan
if ( $act == obraxabrix('usr') ) {  
    $pengaturan_system = "active open";
    $user_active = "active";
} 
if ( $act == obraxabrix('usr_view') ) { 
    $pengaturan_system = "active open";
    $user_active = "active"; 
} 
if ( $act == obraxabrix('company') || $act == obraxabrix('company_view') ) {  
    $pengaturan_system = "active open";
    $company_active = "active";
}
if ( $act == obraxabrix('setup_periode') || $act == obraxabrix('setup_periode_view') ) {  
    $pengaturan_system = "active open";
    $setup_periode_active = "active";
}
if ( $act == obraxabrix('setup_periode_raport') || $act == obraxabrix('setup_periode_raport_view') ) {  
    $pengaturan_system = "active open";
    $setup_periode_raport_active = "active";
}
if ( $act == obraxabrix('setup_periode_raport_pts') || $act == obraxabrix('setup_periode_raport_pts_view') ) {  
    $pengaturan_system = "active open";
    $setup_periode_raport_pts_active = "active";
}



/*download/upload*/
if ( $act == obraxabrix('upload_download') ) { 
    $download_upload = "active open";
    $upload_download_active = "active"; 
}
if ( $act == obraxabrix('backup') ) { 
    $download_upload = "active open";
    $backup_active = "active"; 
}

                                
?>

<ul class="nav nav-list">
	<li class="">
		<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('main') ?>">
			<i class="menu-icon fa fa-tachometer"></i>
			<span class="menu-text"> Dashboard </span>
		</a>

		<b class="arrow"></b>
	</li>
    
    
      <?php
      
      if( $_SESSION["adm"] == 1) {
		
      ?>
      

      			<!--PPDB-->
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
            			<li class="<?php echo $registrasi_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('registrasi') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Registration"; } else { echo "Pendaftaran"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $registrasi_view_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('registrasi_view') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Registration List"; } else { echo "Data Pendaftaran"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<!--<li class="<?php echo $prosespenerimaansiswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('prosespenerimaansiswa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Process Registration"; } else { echo "Proses PSB"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $kelompokcalonsiswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kelompokcalonsiswa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Prastudent Group"; } else { echo "Kelompok Calon Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>-->
            			
            		</ul>
            	</li>
            	
            	
            	
                <!--KESISWAAN-->
                <li class="<?php echo $kesiswaan ?>">
            		<a href="#" class="dropdown-toggle">
            			<i class="menu-icon fa fa-list-alt"></i>
            			<span class="menu-text">
            				<?php if ($_SESSION['bahasa']==1) { echo "Student"; } else { echo "Kesiswaan"; } ?>
            			</span>

            			<b class="arrow fa fa-angle-down"></b>
            		</a>

            		<b class="arrow"></b>

            		<ul class="submenu">
            			<li class="<?php echo $kenaikan_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kenaikan') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Increase Class"; } else { echo "Kenaikan Kelas"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $penempatan_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('penempatan') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Student Placement"; } else { echo "Penempatan Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $pindah_kelas_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pindah_kelas') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Move Class"; } else { echo "Pindah Kelas"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $kelulusan_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kelulusan') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Graduation"; } else { echo "Kelulusan"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $siswa_baru_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_baru') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "New Student"; } else { echo "Input Calon Siswa Baru"; } ?>
            				</a>
            				
            				
            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $siswa_baru_list_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_baru_list') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "New Student"; } else { echo "Daftar Siswa Baru"; } ?>
            				</a>
            				
            				
            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $siswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Student"; } else { echo "Siswa"; } ?>
            				</a>
            				
            				
            				<b class="arrow"></b>
            			</li>            			
            			<li class="<?php echo $siswa_list_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_list') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Student List"; } else { echo "Daftar Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $siswa_list2_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_list2') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Student Verification"; } else { echo "Daftar Siswa Terverifikasi"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $siswa_input_ekskul_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_input_ekskul') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Extra Curricular Student"; } else { echo "Siswa Input Ekskul"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $siswa_ekstrakurikuler_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_ekstrakurikuler_view') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Extra Curricular Student"; } else { echo "Siswa Ekstrakurikuler"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $gugus_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('gugus') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Group"; } else { echo "Gugus MPLS"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $tingkat_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('tingkat') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Level"; } else { echo "Tingkat/Jenjang"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $kelas_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kelas') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Class"; } else { echo "Kelas"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $tahunajaran_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('tahunajaran') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "School Year"; } else { echo "Tahun Pelajaran"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>      
            			<li class="<?php echo $agama_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('agama') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Religion"; } else { echo "Agama"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $siswa_terlambat_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_terlambat') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Student Lates"; } else { echo "Siswa Terlambat"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $siswa_izin_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_izin') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Student Absen"; } else { echo "Siswa Izin"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $kejadian_lain_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kejadian_lain') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Other Accident"; } else { echo "Kejadian Lain"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>   
            			<li class="<?php echo $guru_bk_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('guru_bk') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Teacher Consultant"; } else { echo "Guru BK"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			         			
            			<li class="<?php echo $barcode_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('barcode') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Student Barcode"; } else { echo "Barcode Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $departemen_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('department') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Department"; } else { echo "Unit"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $angkatan_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('angkatan') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Force"; } else { echo "Angkatan"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $alumni_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('alumni') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Alumni Edit"; } else { echo "Edit Alumni"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $alumni_list_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('alumni_list') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Alumni List"; } else { echo "Daftar Alumni"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $raport_siswa_cover_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('raport_siswa_cover_view') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Cover Report Student"; } else { echo "Cover Rapor Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $pelajaran_un_minat_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pelajaran_un_minat') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Setup Mapel UN Minat"; } else { echo "Setup Mapel UN Minat"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $pelajaran_raport_minat_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pelajaran_raport_minat') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Setup Raport Minat"; } else { echo "Setup Rapor Minat"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $penempatan_siswa_prioritas_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('penempatan_siswa_prioritas') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Setup Penempatan Siswa Prioritas"; } else { echo "Setup Pengurutan /Tata Urut Penempatan Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			<li class="<?php echo $infonap_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('infonap') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Setup Minat Nilai UN"; } else { echo "Setup Peminatan Nilai Ujian Mapel"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            		</ul>
            	</li>
            
                
                <!--AKADEMIK-->
                <li class="<?php echo $akademik ?>">
            		<a href="#" class="dropdown-toggle">
            			<i class="menu-icon fa fa-tag"></i>
            			<span class="menu-text">
            				<?php if ($_SESSION['bahasa']==1) { echo "Curiculum"; } else { echo "Kurikulum"; } ?>
            			</span>

            			<b class="arrow fa fa-angle-down"></b>
            		</a>

            		<b class="arrow"></b>

            		<ul class="submenu">
            			
            			<li class="<?php echo $pelajaran_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pelajaran') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Lesson"; } else { echo "Mata Pelajaran"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

						<!-- <li class="<?php echo $siswa_krs_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_krs') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Study Planning Card Student"; } else { echo "Input KRS"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li> -->
            			
            			<?php /*
            			<li class="<?php echo $siswa_krs_approved_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_krs_approved_view') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Study Planning Card Student Approved"; } else { echo "Approval Siswa KRS"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
						<li class="<?php echo $kartu_rencana_studi_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kartu_rencana_studi') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Study Planning Card"; } else { echo "KRS"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>*/ ?>
            			
            			<li class="<?php echo $daftar_absensi_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('daftar_absensi') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Absensi List"; } else { echo "Daftar Absensi"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $siswa_pertemuan_krs_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('siswa_pertemuan_krs') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Absensi List Siswa"; } else { echo "Daftar Absensi Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

						<li class="<?php echo $guru_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('guru') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Teacher"; } else { echo "Guru Mata Pelajaran"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $guru_ekskul_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('guru_ekskul') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Teacher Extra"; } else { echo "Guru Ekstrakurikuler"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
                        <li class="<?php echo $semester_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('semester') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Semester"; } else { echo "Semester"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
                        
                        <li class="<?php echo $rpp_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpp') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "RPP"; } else { echo "RPP"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $kompetensi_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kompetensi') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Competence"; } else { echo "Kompetensi"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $dasarpenilaian_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('dasarpenilaian') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Basis of Valuation"; } else { echo "Dasar Penilaian"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			

            			<!--<li class="<?php echo $jeniskompetensi_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jeniskompetensi') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Type of Competence"; } else { echo "Jenis Kompetensi"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>-->
            			
            			
            			<li class="<?php echo $jadwal_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jadwal') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Schedule"; } else { echo "Jadwal"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $jam_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jam') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Jam"; } else { echo "Setup Jam"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $pemetaan_kd_siswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pemetaan_kd_siswa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Pemetaan KD Siswa"; } else { echo "Pemetaan KD Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $pemetaan_kd_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pemetaan_kd') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Pemetaan KD"; } else { echo "Pemetaan KD"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<?php /*
            			<li class="<?php echo $soal_siswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('soal_siswa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Final Question Student"; } else { echo "Soal PAS Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			            			
            			<li class="<?php echo $soal_select_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('soal_select') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Final Question Selection"; } else { echo "Seleksi Soal PAS"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $soal_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('soal') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Final Question Master"; } else { echo "Master Soal PAS"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			
            			<li class="<?php echo $soal_ukbm_siswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('soal_ukbm_siswa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Question UKBM Student"; } else { echo "Soal UKBM Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>*/ ?>
            			
            			<li class="<?php echo $ukbm_siswa_approved_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('ukbm_siswa_approved') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Approved UKBM Student"; } else { echo "Approved Modul Belajar"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $ukbm_siswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('ukbm_siswa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "UKBM Student"; } else { echo "UKBM Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<?php /*
            			<li class="<?php echo $soal_ukbm_select_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('soal_ukbm_select') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Question UKBM Selection"; } else { echo "Seleksi Soal UKBM"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $soal_ukbm_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('soal_ukbm') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Question UKBM Master"; } else { echo "Master Soal UKBM"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>*/ ?>
            			
            			<li class="<?php echo $ukbm_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('ukbm') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "UKBM"; } else { echo "Modul Ajar"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $guru_absen_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('guru_absen') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Absen Guru"; } else { echo "Guru Tidak Hadir"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $guru_penugasan_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('guru_penugasan') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Teacher Training"; } else { echo "Penugasan Guru"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            		</ul>
            	</li>


            	<!--RAPOR-->
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
            			
            			
            			<li class="<?php echo $daftarnilai_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('daftarnilai_view') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Score List"; } else { echo "Input Nilai"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

            			<li class="<?php echo $raport_siswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('raport_siswa_view') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Report Student"; } else { echo "Rapor Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $raport_siswa_ledger_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('raport_siswa_ledger') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Report Ledger Student"; } else { echo "Leger Rapor Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $predikat_raport_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('predikat_raport') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Setup Predikat Raport"; } else { echo "Setup Predikat Rapor"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $deskripsi_raport_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('deskripsi_raport') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Setup Description Raport"; } else { echo "Setup Deskripsi Rapor"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $setup_siswa_khusus_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('setup_siswa_khusus') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Setup Special Student"; } else { echo "Setup Siswa Khusus"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            		</ul>
            	</li>

            	
                
                
                <!--KEUANGAN-->
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
						<li class="<?php echo $receipt_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('receipt') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Receipt"; } else { echo "Penerimaan Iuran Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

            			<li class="<?php echo $rpt_ar_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_ar') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "AR Report"; } else { echo "Iuran Belum Lunas"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

						<li class="<?php echo $general_journal_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('general_journal') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Cash Out"; } else { echo "Kas Keluar"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $general_journal_in_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('general_journal_in') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Cash In"; } else { echo "Kas Masuk"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

						<li class="<?php echo $purchase_inv_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('purchase_inv') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Purchase"; } else { echo "Pembelian"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $purchase_inv_list_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('purchase_inv_list') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Receipt Purchase List"; } else { echo "Penerimaan Pembelian"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
						<li class="<?php echo $good_receipt_active ?>">
							<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('good_receipt_view') ?>">
								<i class="menu-icon fa fa-caret-right"></i>
								<?php if ($_SESSION['bahasa']==1) { echo "Good Receipt List"; } else { echo "Daftar Penerimaan"; } ?>
							</a>

							<b class="arrow"></b>
						</li>
						
            			<li class="<?php echo $purchase_return_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('purchase_return') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Return Purchase"; } else { echo "Retur Pembelian"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

						<li class="<?php echo $payment_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('payment') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Payment"; } else { echo "Pembayaran Hutang"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

            			<li class="<?php echo $finance_type_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('finance_type') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Finance Type"; } else { echo "Jenis Keuangan"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

            			<li class="<?php echo $tahunbuku_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('tahunbuku') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Fiscal Year"; } else { echo "Tahun Buku"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

						<li class="<?php echo $coa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('coa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "CoA"; } else { echo "Rekening Perkiraan"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
						<?php /*
            			<li class="<?php echo $rekakun_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rekakun') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "CoA"; } else { echo "Rekening Perkiraan"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $datapenerimaan_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('datapenerimaan') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Receipt Type"; } else { echo "Jenis Penerimaan"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $datapengeluaran_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('datapengeluaran') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Payment Type"; } else { echo "Jenis Pengeluaran"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $besarjtt_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('besarjtt_view') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Payment Setup"; } else { echo "Setup Pembayaran"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $penerimaanjtt_active ?>">
            				<a href="#" onClick="JavaScript:tambahpenerimaan()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Receipt"; } else { echo "Transaksi Penerimaan"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $rpt_penerimaan_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_penerimaan') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Receipts Receipt"; } else { echo "Lap. Penerimaan"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>*/ ?>

						<li class="<?php echo $generate_ar_active ?>">
            				<a href="#"  onClick="JavaScript:generate_ar()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate Iuran Siswa
            				</a>
            				<b class="arrow"></b>
            			</li>
            		</ul>
            	</li>
            	
            	
            	
            	<!--PERPUSTAKAAN-->
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
            			
            			<!-- <li class="<?php echo $rpt_penerimaan_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_penerimaan') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Book Return"; } else { echo "Pengeluaran Barang"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li> -->
            			
            			<li class="<?php echo $format_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('format') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Format"; } else { echo "Format"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $rak_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rak') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Bin"; } else { echo "Rak"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $katalog_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('katalog') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Catalog"; } else { echo "Katalog"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $penerbit_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('penerbit') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Publisher"; } else { echo "Penerbit"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $penulis_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('penulis') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Author"; } else { echo "Penulis"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $pustaka_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pustaka') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Library"; } else { echo "Pustaka"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $pinjam_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pinjam') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Lending Library"; } else { echo "Peminjaman Buku"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li> 
            			
            			<li class="<?php echo $kembali_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kembali') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Book Return"; } else { echo "Pengembalian Buku"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $rpt_pinjam_telat_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_pinjam_telat') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Report Late Book Lending"; } else { echo "Lap. Peminjam Terlambat"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $konfigurasi_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('konfigurasi') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Configuration"; } else { echo "Konfigurasi"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li> 
            			
            			<li class="<?php echo $supplier_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('supplier') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Vendor"; } else { echo "Toko/Supplier"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>  
            			
            			<li class="<?php echo $anggota_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('anggota') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Member"; } else { echo "Member"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li> 
            			
            			<li class="<?php echo $daftarpustaka_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('perpustakaan') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Library Name"; } else { echo "Nama Perpustakaan"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>  

            			<li class="<?php echo $chart_pengunjung_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('chart_pengunjung') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Grafik Pengunjung"; } else { echo "Grafik Pengunjung"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

            			<li class="<?php echo $chart_pinjam_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('chart_pinjam') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Grafik Peminjam"; } else { echo "Grafik Peminjam"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

            			<li class="<?php echo $chart_rating_buku_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('chart_rating_buku') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Grafik Buku Sering Dipinjam"; } else { echo "Grafik Buku Sering Dipinjam"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            		</ul>
            	</li>

     	
     			<!--KEPEGAWAIAN-->
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
            			
            			<li class="<?php echo $pegawai_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Staff"; } else { echo "Input PTK"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $statusguru_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('statusguru') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Status of Teachers"; } else { echo "Status Guru"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<!--<li class="<?php echo $pegawai_jabatan_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_jabatan') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Office Employee"; } else { echo "Pegawai/PTK Jabatan"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>-->
            			
            			<li class="<?php echo $jabatan_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jabatan') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Office"; } else { echo "Jabatan"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $pangkat_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pangkat') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Rank"; } else { echo "Pangkat"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<!--<li class="<?php echo $pegawai_pangkat_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_pangkat') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Employees of Rank"; } else { echo "Kepangkatan Pegawai/PTK"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>-->
            			
            			<li class="<?php echo $jenis_sertifikasi_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jenis_sertifikasi') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Type of Certification"; } else { echo "Jenis Sertifikasi"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $status_pegawai_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('status_pegawai') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Staff Status"; } else { echo "Status Pegawai/PTK"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li> 
            			
            			<!--<li class="<?php echo $kenaikan_gaji_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kenaikan_gaji') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Salary Increases"; } else { echo "Kenaikan Gaji"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>-->
            			
            			<!--<li class="<?php echo $pegawai_pendidikan_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_pendidikan_') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Employee Education"; } else { echo "Pendidikan Pegawai/PTK"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>-->
            			
            			<!--<li class="<?php echo $pegawai_keluarga_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_keluarga') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Family Employee"; } else { echo "Keluarga Pegawai/PTK"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li> -->
            			
            			<!--<li class="<?php echo $pegawai_prestasi_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_prestasi') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Employee Achievements"; } else { echo "Prestasi Pegawai/PTK"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li> --> 
            			
            			<!--<li class="<?php echo $pegawai_penghargaan_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_penghargaan') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Employee Appreciation"; } else { echo "Penghargaan Pegawai/PTK"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>--> 
            			
            			<!--<li class="<?php echo $pegawai_skmengajar_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pegawai_skmengajar') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "SK Teaching"; } else { echo "SK Mengajar"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>-->  
            			
            		</ul>
            	</li>
     	
     			
     			<!--BK (Bimbingan Konseling)-->
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
            			
            			<li class="<?php echo $jenis_pelanggaran_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jenis_pelanggaran') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Type of Violation"; } else { echo "Jenis Pelanggaran"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $jenis_prestasi_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jenis_prestasi') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Type of Accomplishment"; } else { echo "Jenis Prestasi"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $pelanggaran_siswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pelanggaran_siswa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Violation of Students"; } else { echo "Pelanggaran Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $konseling_siswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('konseling_siswa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Counseling Students"; } else { echo "Konseling Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $jenis_izin_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('jenis_izin') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Type of Permission"; } else { echo "Jenis Izin"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $izin_siswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('izin_siswa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Permit Students"; } else { echo "Izin Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $rpt_izin_siswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_izin_siswa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Permit Students Report"; } else { echo "Lap. Izin Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<!--<li class="<?php echo $rpt_izin_siswa_surat_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_izin_siswa_surat') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Permit Students Report"; } else { echo "Lap. Izin Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>-->
            			
            			<li class="<?php echo $rpt_konseling_siswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_konseling_siswa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Counseling Students Report"; } else { echo "Lap. Konseling Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $assesmen_observasi_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('assesmen_observasi') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Observation Assemen"; } else { echo "Assemen Observasi"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $aspek_psikologi_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('aspek_psikologi') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Aspects of Psychology"; } else { echo "Jenis Aspek Psikologi"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $aspek_psikologi_detail_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('aspek_psikologi_detail') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Aspects of Psychology Detail"; } else { echo "Aspek Psikologi Detail"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $evaluasi_psikologi_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('evaluasi_psikologi') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Evaluation Psychology"; } else { echo "Evaluasi Psikologi"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $rpt_evaluasi_psikologi_level_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_evaluasi_psikologi_level') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Evaluation Psychology Level Report"; } else { echo "Lap. Evaluasi Psikologi per Level"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            		</ul>
            	</li>
            	
            	
            	<!--PRESENSI-->
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
            			
            			<li class="<?php echo $presensi_general_active ?>">
            				<a href="#"  onClick="JavaScript:presensi_general()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Presensi General"; } else { echo "Presensi PPK"; } ?>
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $presensi_ukbm_active ?>">
		    				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('presensi_ukbm_filter') ?>">
		    					<i class="menu-icon fa fa-caret-right"></i>
		    					<?php if ($_SESSION['bahasa']==1) { echo "Presensi KBM"; } else { echo "Presensi KBM"; } ?>
		    				</a>
		    				<b class="arrow"></b>
		    			</li>
    			
            			<li class="<?php echo $presensi_harian_siswa_active ?>">
            				<a href="#"  onClick="JavaScript:presensi_harian_siswa()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Presensi Harian Siswa"; } else { echo "Presensi Harian Siswa"; } ?>
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $presensi_absen_siswa_active ?>">
            				<a href="#"  onClick="JavaScript:presensi_absen_siswa()">
            					<i class="menu-icon fa fa-caret-right"></i>
            						Absensi Harian Siswa
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $presensipelajaran_active ?>">
            				<a href="#" href="javascript:void(0);" name="Find" title="Presensi KBM (Siswa)" onClick="presensipelajaran()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Presensi KBM (Siswa)"; } else { echo "Presensi KBM (Siswa)"; } ?>
            				</a>
            				
            				<b class="arrow"></b>
            			</li>
            			
            			<!--<li class="<?php echo $presensipelajaran_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('presensipelajaran') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Presensi Mapel"; } else { echo "Presensi Mapel"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>-->
            			
            			<li class="<?php echo $rpt_presensi_general_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_presensi_general') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "General Absensi Day Report"; } else { echo "Lap. Presensi Harian PTK"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $rpt_presensi_harian_siswa_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_presensi_harian_siswa') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Absensi Day Report"; } else { echo "Lap. Presensi Harian Siswa"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $rpt_presensi_siswa_pelajaran_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_presensi_siswa_pelajaran') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Absensi Class Report"; } else { echo "Lap. Presensi KBM (Siswa)"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $rpt_presensi_guru_pelajaran_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_presensi_guru_pelajaran') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Absensi Teacher Class Report"; } else { echo "Lap. Presensi KBM (Guru)"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            		</ul>
            	</li>
   
   				<!--ASSET-->
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
            			
            			<li class="<?php echo $room_booking_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('room_booking_filter') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Booking Room"; } else { echo "Booking Ruang"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $material_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('material') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Item Master"; } else { echo "Master Barang"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $item_group_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('item_group') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Item Group"; } else { echo "Kelompok Barang"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $brand_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('brand') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Brand"; } else { echo "Merk Inventaris"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $build_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('build') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Build Master"; } else { echo "Master Bangunan"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $room_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('room') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Master Room"; } else { echo "Master Ruang"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<!--<li class="<?php echo $asset_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('asset') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Asset"; } else { echo "Sarana & Prasarana"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>-->
            			
            			<li class="<?php echo $asset_type_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('asset_type') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Asset Type"; } else { echo "Jenis Inventaris"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

            			<!-- <li class="<?php echo $item_kir_view_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('item_kir_view') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php //if ($_SESSION['bahasa']==1) { echo "Bin Card"; } else { echo "Kartu KIR"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li> -->

            			
            		</ul>
            	</li>
            	
            	
            	<!--SURAT MENYURAT-->
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
            			
            			<li class="<?php echo $buku_kunjungan_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('buku_kunjungan') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Guest Book"; } else { echo "Buku Tamu"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $surat_masuk_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('surat_masuk') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Document In"; } else { echo "Surat Masuk"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $surat_keluar_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('surat_keluar') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Document Out"; } else { echo "Surat Keluar"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $kelompok_surat_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('kelompok_surat') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Letter Group"; } else { echo "Kelompok Surat"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>

            			<li class="<?php echo $chart_surat_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('chart_surat') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Letter In Graph"; } else { echo "Grafik Surat Masuk"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			
            		</ul>
            	</li>
            	
            	
                <!--SYSTEM MANAGER-->
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
            			
            			<li class="<?php echo $setup_periode_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('setup_periode') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Period Setup"; } else { echo "Setting Periode"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $setup_periode_raport_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('setup_periode_raport') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Period Raport Setup"; } else { echo "Seting Titimangsa Rapor"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $setup_periode_raport_pts_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('setup_periode_raport_pts') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Period Raport PTS Setup"; } else { echo "Seting Titimangsa Rapor PTS"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $user_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('usr') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "User"; } else { echo "User"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<!--<li class="<?php echo $company_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('company') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Company"; } else { echo "Setup Perusahaan"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>-->

            			
            		</ul>
            	</li>
            	
            	
            	
                <!--AUDIT TRAIL-->
                <!--<li class="<?php echo $audit_trail ?>">
            		<a href="#" class="dropdown-toggle">
            			<i class="menu-icon fa fa-file-o"></i>
            			<span class="menu-text">
            				<?php if ($_SESSION['bahasa']==1) { echo "Audit Trail"; } else { echo "Audit Trail"; } ?>
            			</span>

            			<b class="arrow fa fa-angle-down"></b>
            		</a>

            		<b class="arrow"></b>

            		<ul class="submenu">
            			
            			<li class="<?php echo $adt_sales_order_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('adt_sales_order') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Log PO"; } else { echo "Log PO"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			
            		</ul>
            	</li>-->
            	
                
                <!--DOWNLOAD/UPLOAD-->
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
            			
            			
						<!--<li class="<?php echo $upload_download_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('upload_download') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Upload/Download"; } else { echo "Upload/Download"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>-->
            			
            			<li class="<?php echo $backup_active ?>">
            				<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('backup') ?>">
            					<i class="menu-icon fa fa-caret-right"></i>
            					<?php if ($_SESSION['bahasa']==1) { echo "Backup Database"; } else { echo "Backup Database"; } ?>
            				</a>

            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $import_pemetaan_kd_active ?>">
            				<a href="#"  onClick="JavaScript:import_pemetaan_kd()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Upload Pemetaan KD
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $import_user_guru_active ?>">
            				<a href="#"  onClick="JavaScript:import_user_guru()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Upload User Guru
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_user_siswa_active ?>">
            				<a href="#"  onClick="JavaScript:generate_user_siswa()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate User Siswa
            				</a>
            				<b class="arrow"></b>
            			</li>

						<li class="<?php echo $generate_revisi_siswa_active ?>">
            				<a href="#"  onClick="JavaScript:generate_revisi_siswa()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate Revisi NIS Siswa
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_update_nisn_active ?>">
            				<a href="#"  onClick="JavaScript:generate_update_nisn_siswa()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate Revisi NISN Siswa
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_pa_verifikasi_active ?>">
            				<a href="#"  onClick="JavaScript:generate_pa_verifikasi()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate Menu Verifikasi Siswa
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_ekskul_siswa_active ?>">
            				<a href="#"  onClick="JavaScript:generate_ekskul_siswa()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate Ekskul Siswa
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_ekskul_pramuka_active ?>">
            				<a href="#"  onClick="JavaScript:generate_ekskul_pramuka()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate Ekskul Pramuka
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_nilai_rubah_formula_active ?>">
            				<a href="#"  onClick="JavaScript:generate_nilai_rubah_formula()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate Update Nilai Keterampilan
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $import_user_pa_ledger_active ?>">
            				<a href="#"  onClick="JavaScript:import_user_pa_ledger()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Upload User PA Ledger
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $copy_mapel_krs_active ?>">
            				<a href="#"  onClick="JavaScript:copy_mapel_krs()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Copy Mata Pelajaran KRS
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_user_siswa_baru_active ?>">
            				<a href="#"  onClick="JavaScript:generate_user_siswa_baru()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate User Siswa Baru
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_user_siswa_new_active ?>">
            				<a href="#"  onClick="JavaScript:generate_user_siswa_new()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate User Siswa Tingkat-X
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $import_siswa_baru_active ?>">
            				<a href="#"  onClick="JavaScript:import_siswa_baru()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Upload Siswa Baru
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_gugus_siswa_baru_active ?>">
            				<a href="#"  onClick="JavaScript:generate_gugus_siswa_baru()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate Gugus Siswa Baru
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_siswa_baru_kelas_active ?>">
            				<a href="#"  onClick="JavaScript:generate_siswa_baru_kelas()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Pengkelasan Siswa Baru
            				</a>
            				<b class="arrow"></b>
            			</li>
            			            			
            			<li class="<?php echo $import_update_siswa_active ?>">
            				<a href="#"  onClick="JavaScript:import_update_siswa()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Upload Update Data Siswa (dari DAPODIK)
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $import_update_siswa_baru_active ?>">
            				<a href="#"  onClick="JavaScript:import_update_siswa_baru()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Upload Update NIS Data Siswa Baru
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_capital_name_active ?>">
            				<a href="#"  onClick="JavaScript:generate_capital_name()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Update Capital Name
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_siswa_ujian_active ?>">
            				<a href="#"  onClick="JavaScript:generate_siswa_ujian()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Eksport Data Siswa ke Ujian
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_guru_ujian_active ?>">
            				<a href="#"  onClick="JavaScript:generate_guru_ujian()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Eksport Data Guru ke Ujian
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_mapel_ujian_active ?>">
            				<a href="#"  onClick="JavaScript:generate_mapel_ujian()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Eksport Data Mapel ke Ujian
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_import_nilai_ujian_active ?>">
            				<a href="#"  onClick="JavaScript:generate_import_nilai_ujian()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Import Nilai Ujian
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $copy_mapel_krs_siswa_active ?>">
            				<a href="#"  onClick="JavaScript:copy_mapel_krs_siswa()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate KRS Tingkat X
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_acess_raport_siswa_active ?>">
            				<a href="#"  onClick="JavaScript:generate_acess_raport_siswa()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate Menu Rapor Siswa
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            			<li class="<?php echo $generate_acess_raport_guru_active ?>">
            				<a href="#"  onClick="JavaScript:generate_acess_raport_guru()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate Menu Rapor PA
            				</a>
            				<b class="arrow"></b>
            			</li>

            			<li class="<?php echo $generate_nilai_leger_active ?>">
            				<a href="#"  onClick="JavaScript:generate_nilai_leger()">
            					<i class="menu-icon fa fa-caret-right"></i>
            					Generate Nilai LEGER
            				</a>
            				<b class="arrow"></b>
            			</li>
            			
            		</ul>
            	</li>
                
                
    <?php
    
    ##menu user
    } else {
		
		include("menu_user.php");
		
	}
    ?>
</ul><!-- /.nav-list -->