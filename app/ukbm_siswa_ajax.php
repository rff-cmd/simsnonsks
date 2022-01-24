<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

/*include '../app/class/class.selectview.php';
$selectview=new selectview;*/

$pilih = $_POST["button"];

switch ($pilih){
	case "getukbm":
		$idukbm		= $_POST["idukbm"];
		
		if($idukbm != "" || $idukbm != "0" ) {
		
			$sql = $select->list_ukbm($idukbm);
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$file_ukbm = $data->file_ukbm;
?>
			<?php if (!empty($file_ukbm)) { ?>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Download File UKBM</label>
					<div class="col-sm-5">
						<a class="label label-success" href="<?php echo $__folder ?>app/ukbm_download.php?ref=<?php echo $idukbm ?>" target="_blank" title="Download"><?php echo $file_ukbm; ?>
						</a>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mengajukan Ujian UKBM</label>
					<div class="col-sm-3">
						<input type="checkbox" id="ujian" name="ujian" class="ace" value="1"/><span class="lbl"></span>
					</div>
				</div>
			<?php } ?>
<?php			
		}
		
		
?>		
			

<?php		
		break;	
	
	default:
}
?>
