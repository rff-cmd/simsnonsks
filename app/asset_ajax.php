<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$pilih = $_POST["button"];
switch ($pilih){
	case "getkota":
	
		$provinsi_kode = $_POST["provinsi_kode"];	
		
?>		
		<select id="kota_kode" name="kota_kode" class="chosen-select form-control" style="width: auto" onchange="loadHTMLPost2('app/asset_ajax.php','kecamatan_id','getkecamatan','kota_kode')" >
            <option value=""></option>
            <?php 
            	select_kota($provinsi_kode,$row_asset->kota_kode);
            ?>	                            
        </select>
		
<?php
		break;
		
	
	case "getkecamatan":
	
		$kota_kode = $_POST["kota_kode"];	
		
?>		
		<select id="kecamatan_kode" name="kecamatan_kode" class="chosen-select form-control" style="width: auto" onchange="loadHTMLPost2('app/asset_ajax.php','desa_id','getdesa','kecamatan_kode')" >
            <option value=""></option>
            <?php 
            	select_kecamatan($kota_kode,$row_asset->kecamatan_kode)
            ?>	                            
        </select>
		
<?php
		break;
		
	
	case "getdesa":
	
		$kecamatan_kode = $_POST["kecamatan_kode"];	
		
?>		
		<select id="desa_kode" name="desa_kode" class="chosen-select form-control" tabindex="2" style="width: auto">
            <option value=""></option>
            <?php 
            	select_desa($kecamatan_kode,$row_asset->desa_kode) 
            ?>	                            
        </select>
		
<?php
		break;
		
		
	default:
}
?>