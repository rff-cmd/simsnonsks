<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "gettingkat":
		$departemen = $_POST["departemen"];	
			
?>		
		<option value=""></option>
		<?php select_tingkat_unit($departemen, ""); ?>
		

<?php	
		break;
		
	case "getkelas":
		$idtingkat = $_POST["idtingkat"];	
			
?>		
		<option value=""></option>
		<?php select_kelas($idtingkat, ""); ?>
		

<?php	
		break;
	
	case "getsiswa":
		$idkelas = $_POST["idkelas"];	
			
?>		
		<option value=""></option>
		<?php select_siswa($idkelas, ""); ?>
		

<?php	

		break;
		
	case "getdatasiswa":
		$idsiswa = $_POST["idsiswa"];	
		
		$sql = $select->list_siswa('',$idsiswa);		
		$data_siswa = $sql->fetch(PDO::FETCH_OBJ);	
?>		
		<td colspan="9">
			<table class="table">
				<tr>
					<td width="20%">Nama Panggilan</td>
					<td>&nbsp;&nbsp;</td>
					<td>:</td>
					<td width="30%"><?php echo $data_siswa->panggilan ?></td>
					
					<td>&nbsp;&nbsp;</td>
					
					<td width="20%">Tempat, Tanggal Lahir</td>
					<td>&nbsp;&nbsp;</td>
					<td>:</td>
					<td width="30%">
						<?php echo $data_siswa->tmplahir ?>, <?php echo $data_siswa->tgllahir ?>
					</td>											
				</tr>
					
				<tr>
					<td>Alamat</td>
					<td>&nbsp;&nbsp;</td>
					<td>:</td>
					<td><?php echo $data_siswa->alamatsiswa ?></td>
					
					<td>&nbsp;&nbsp;</td>
					
					<td>Anak ke-</td>
					<td>&nbsp;&nbsp;</td>
					<td>:</td>
					<td><?php echo $data_siswa->anakke ?></td>											
				</tr>
				
				<tr>
					<td>Nama Ayah</td>
					<td>&nbsp;&nbsp;</td>
					<td>:</td>
					<td><?php echo $data_siswa->namaayah ?></td>
					
					<td>&nbsp;&nbsp;</td>
					
					<td>Pekerjaan Ayah</td>
					<td>&nbsp;&nbsp;</td>
					<td>:</td>
					<td><?php echo $data_siswa->pekerjaan_ayah ?></td>											
				</tr>
				
				<tr>
					<td>Nama Ibu</td>
					<td>&nbsp;&nbsp;</td>
					<td>:</td>
					<td><?php echo $data_siswa->namaibu ?></td>
					
					<td>&nbsp;&nbsp;</td>
					
					<td>Pekerjaan Ibu</td>
					<td>&nbsp;&nbsp;</td>
					<td>:</td>
					<td><?php echo $data_siswa->pekerjaan_ibu ?></td>											
				</tr>
			</table>
		</td>
		

<?php	

		break;
		
        				
	default:
	
}
?>