<?php
	@session_start();

	if (($_SESSION["logged"] == 0)) {
		echo 'Access denied';
		exit;
	}

	include_once ("../app/include/sambung.php");
	include_once ("../app/include/functions.php");
	include_once ("../app/include/inword.php");

	include_once ("../app/class/class.select.php");
	include_once ("../app/class/class.selectview.php");
?>

<!-- PAGE CONTENT BEGINS -->
<form class="form-horizontal" role="form" action="" method="post" name="daftarnilai_input" id="daftarnilai_input" enctype="multipart/form-data" >
	<div class="form-group">
		<div class="col-sm-3">
			<input type="submit" name="submit" class='btn btn-primary' value="Generate" >
		</div>
	</div>
</form>

<?php
if($_POST["submit"]) {
	$select 	= new select;
	$selectview = new selectview;

	$dbpdo = DB::create();
	
	##truncate cad05
	$sqldel="truncate cad05";
	$sqlresult=$dbpdo->prepare($sqldel);
	$sqlresult->execute();
	
	##update gugus=null
	$sqldel="update siswa set idgugus=null where alumni=2";
	$sqlresult=$dbpdo->prepare($sqldel);
	$sqlresult->execute();
	
	##get siswa berdasarkan nilai paling tinggi
	$sqlcek 	= 	"select a.replid, a.nis, a.nik, a.nisn, a.nama, a.kelamin, a.agama, sum(ifnull(b.nilai,0)) nilai from siswa a left join siswa_nilai_un b on a.replid=b.nis where a.alumni=2 group by a.replid order by sum(ifnull(b.nilai,0)) desc, a.nama"; 
	$sqlresult	=	$dbpdo->prepare($sqlcek);
	$sqlresult->execute();
	$insert = 0;
	$no=0;
	while($datasiswa = $sqlresult->fetch(PDO::FETCH_OBJ)) {
		
		$no++;
				
		$sqlcekx 	= 	"select num1 from cad05 where num1='$datasiswa->replid' and string2='$datasiswa->nik'";
		$sqlresultx	=	$dbpdo->prepare($sqlcekx);
		$sqlresultx->execute();
		$rows		=	$sqlresultx->rowCount();
		
		if($rows == 0) {
			echo $no.'. '.$datasiswa->nik.'>> '.$datasiswa->nama.'>> '.$datasiswa->nilai.'<br>';
			
			$nama_siswa = petikreplace($datasiswa->nama);
			$sqlstr="insert into cad05 (num1, string1, string2, string3, text1, text2) values('$datasiswa->replid', '$datasiswa->nisn', '$datasiswa->nik', '$nama_siswa', '$datasiswa->kelamin', '$datasiswa->agama')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
	}
	
	
	##set gugus
	$sqlstr="select replid, kapasitas_l, kapasitas_p from gugus order by replid";
	$sqlgugus=$dbpdo->prepare($sqlstr);
	$sqlgugus->execute();
	while($datagugus = $sqlgugus->fetch(PDO::FETCH_OBJ)) {
	
		##berdasarkan jenis kelamin (Laki-Laki)
		$sqlcek = "select a.replid, a.num1, a.string1, a.string2, a.string3, a.text1, a.text2 from cad05 a inner join siswa b on a.num1=b.replid where a.text1='L' and ifnull(b.idgugus,0)=0 order by a.replid, a.string3, a.text2 limit $datagugus->kapasitas_l"; 
		$sqlresult	=	$dbpdo->prepare($sqlcek);
		$sqlresult->execute();
		$insert = 0;
		$no=0;
		while($datasiswa = $sqlresult->fetch(PDO::FETCH_OBJ)) {
			
			$no++;
			
			echo $no.'. >>Laki-laki'.$datasiswa->string2.'>> '.$datasiswa->string3.'<br>';
					
			$sqlstr="update siswa set idgugus='$datagugus->replid' where replid='$datasiswa->num1'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		
		##berdasarkan jenis kelamin (Perempuan)
		$sqlcek = "select a.replid, a.num1, a.string1, a.string2, a.string3, a.text1, a.text2 from cad05 a inner join siswa b on a.num1=b.replid where a.text1='P' and ifnull(b.idgugus,0)=0 order by a.replid, a.string3, a.text2 limit $datagugus->kapasitas_p"; 
		$sqlresult	=	$dbpdo->prepare($sqlcek);
		$sqlresult->execute();
		$insert = 0;
		$no=0;
		while($datasiswa = $sqlresult->fetch(PDO::FETCH_OBJ)) {
			
			$no++;
			
			echo $no.'. >>Perempuan'.$datasiswa->string2.'>> '.$datasiswa->string3.'<br>';
					
			$sqlstr="update siswa set idgugus='$datagugus->replid' where replid='$datasiswa->num1'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
	}

?>    

	<table align="center" style="font-size: 36px; color: #07581c">
		<!--<tr>
			<td><?php echo "Jumlah Tambah Data : " . $insert; ?></td>
		</tr>-->
		<!--<tr>
			<td><?php echo "Jumlah Update Data : " . $insert; ?></td>
		</tr>-->
	</table>

<?php    
}
?>



