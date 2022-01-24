<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getpustaka":
		$kodepustaka = $_POST["kodepustaka"];	
		
		$sqlpsutaka=$select->list_getpustaka($kodepustaka);
		$data_pustaka=$sqlpsutaka->fetch(PDO::FETCH_OBJ);
		$kodepustaka = $data_pustaka->kodepustaka;
		$judul = $data_pustaka->judul;
?>
        
		<td>
            <a href="javascript:void(0);" name="Find" title="Find" onClick=window.open("app/pinjam_buku_lup.php","Find","width=900,height=500,left=200,top=20,toolbar=0,status=0,scroll=1,scrollbars=no");><img src="img/icons/essen/16/search.png" /></a>
            
            <input type="text" name="kodepustaka" id="kodepustaka" onKeyPress="return focusNext('submitdetail',event)" onblur="loadHTMLPost2('app/pinjam_ajax.php','pustaka_id','getpustaka','kodepustaka')" style="width:120px; height:16px; " value="<?php echo $kodepustaka ?>">
                
        </td>
		<td><input type="text" readonly="" name="judul" id="judul" style="width:300px; height:16px; " value="<?php echo $judul ?>"></td>
		
		
<?php
		
		break;
		
	case "getpilihan":
		$pilihan = $_POST["pilihan"];	
		
		if($pilihan == 0) {
?>
			<td><input type="text" name="kodepustaka" id="kodepustaka" onKeyPress="return focusNext('submitdetail',event)" onblur="loadHTMLPost2('app/pinjam_ajax.php','pustaka_id','getpustaka','kodepustaka')" style="width:120px; height:16px; " value="<?php echo $kodepustaka ?>"></td>
			<td><input type="text" readonly="" name="judul" id="judul" style="width:300px; height:16px; " value="<?php echo $judul ?>"></td>
				
<?php
		} else {
?>			

			<td colspan="2">
				<select name="kodepustaka" id="kodepustaka" style="width:auto; height:27px; " />
					<option value=""></option>
					<?php select_daftarpustaka($kodepustaka); ?>
				</select>
				
			</td>

<?php
		}
				
		break;
			
	default:
	
}
?>
