<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("../app/include/sambung.php");
include_once ("../app/include/functions.php");

include_once ("../app/class/class.select.php");
include_once ("../app/class/class.selectview.php");

$select 	= new select;
$selectview = new selectview;

$dbpdo 		= DB::create();
$dbpdo_uji 	= DB_UJI::create_uji();

$departemen		= "SMA";
$idtingkat2		= $_POST['idtingkat2']; 
?>

<!-- PAGE CONTENT BEGINS -->
<form class="form-horizontal" role="form" action="" method="post" name="daftarnilai_input" id="daftarnilai_input" enctype="multipart/form-data" >
	
	<div class="form-group">
		<div class="col-sm-3">
			<input type="submit" name="submit" class='btn btn-primary' value="Proses" >
		</div>
	</div>
</form>

<?php
if($_POST["submit"]) {
	$sqlsiswa = "select distinct b.nip, b.nama from guru a left join pegawai b on a.nip=b.replid";
	$resultssiswa=$dbpdo->query($sqlsiswa);
	while ($row_siswa = $resultssiswa->fetch(PDO::FETCH_OBJ)){
		
		$nama		= petikreplace($row_siswa->nama);
		$nip		= $row_siswa->nip;
		
		if($nip != "") {
			
			$sqlcek 	= 	"select nip from m_guru where nip='$nip'";
			$sqlresult	=	$dbpdo_uji->prepare($sqlcek);
			$sqlresult->execute();
			$rows = $sqlresult->rowCount();
			
			if($rows == 0) {
				$sqlstr = "insert into m_guru (nip, nama) values ('$nip', '$nama')";
				$sql=$dbpdo_uji->prepare($sqlstr);
				$sql->execute();
				
				$ekskul++;
			} else {
				$sqlstr = "update m_guru set nama='$nama' where nim='$nis'";
				$sql=$dbpdo_uji->prepare($sqlstr);
				$sql->execute();
				
				$ekskul2++;
			}
			
		}
	}
}
	
?>


<table align="center" style="font-size: 36px; color: #07581c">
	<tr>
		<td><?php echo "Jumlah Tambah Data-1 : " . $ekskul; ?></td>
	</tr>
	<tr>
		<td><?php echo "Jumlah Update Data-2 : " . $ekskul2; ?></td>
	</tr>
</table>