<h3 class="header smaller lighter green">Mata Pelajaran</h3>
<div class="tabbable tabs-below">
	<div class="tab-content">
	
		<?php
			//get siswa
			$sqlsiswa = $selectview->list_siswa($nis, "", "", "", "", "", "");
			$datasiwa = $sqlsiswa->fetch(PDO::FETCH_OBJ);
			$idtingkat= $datasiwa->idtingkat;
			$peminatan= $datasiwa->idminat;
			
			//get peminatan
			$sqlminat = $selectview->list_peminatan($peminatan);
			$dataminat= $sqlminat->fetch(PDO::FETCH_OBJ);
			$nama_minat = $dataminat->nama;
				
				if( $idtingkat == 27 && $_SESSION["semester_id"]==24) {		
					include("siswa_krs_semester1.php");
				}
				
				if( $idtingkat == 27 && $_SESSION["semester_id"]==20) {
					include("siswa_krs_semester2.php");
				}
			
				if( $idtingkat == 28 && $_SESSION["semester_id"]==24) {
					include("siswa_krs_semester3.php");
				}
				
				if( $idtingkat == 28 && $_SESSION["semester_id"]==20) {
					include("siswa_krs_semester4.php");
				}
			
				if($idtingkat == 46 && $_SESSION["semester_id"]==24) {
					include("siswa_krs_semester5.php");
				}
				
				if($idtingkat == 46 && $_SESSION["semester_id"]==20) {
					include("siswa_krs_semester6.php");
				}
			
		?>
		
	</div>

	<ul class="nav nav-tabs" id="myTab2">
		<li <?php if( $idtingkat == 27 && $_SESSION["semester_id"]==24) { ?>class="active" <?php } ?>>
			<a data-toggle="tab" href="#semester1">Semester ke-1</a>
		</li>

		<li <?php if( $idtingkat == 27 && $_SESSION["semester_id"]==20) { ?>class="active" <?php } ?>>
			<a data-toggle="tab" href="#semester2">Semester ke-2</a>
		</li>

		<li <?php if( $idtingkat == 28 && $_SESSION["semester_id"]==24) { ?>class="active" <?php } ?>>
			<a data-toggle="tab" href="#semester3">Semester ke-3</a>
		</li>
		
		<li <?php if( $idtingkat == 28 && $_SESSION["semester_id"]==20) { ?>class="active" <?php } ?>>
			<a data-toggle="tab" href="#semester4">Semester ke-4</a>
		</li>
		
		<li <?php if($idtingkat == 46 && $_SESSION["semester_id"]==24) { ?>class="active" <?php } ?>>
			<a data-toggle="tab" href="#semester5">Semester ke-5</a>
		</li>
		
		<li <?php if($idtingkat == 46 && $_SESSION["semester_id"]==20) { ?>class="active" <?php } ?>>
			<a data-toggle="tab" href="#semester6">Semester ke-6</a>
		</li>
	</ul>
</div>