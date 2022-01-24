<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$pilih = $_POST["button"];

switch ($pilih){
	
    case "getkota":
		$kode_provinsi	= $_POST["kode_provinsi"];
		
?>		
			
            <select name="kode_kota" id="kode_kota" class="chosen-select form-control" onchange="loadHTMLPost1('app/setup_instansi_kodecheck.php','kode_kecamatan_id','getkecamatan','kode_kota')" style="width:auto; height:27px; " >
				<option value=""></option>
				<?php select_kota($kode_provinsi, $setup_instansi_data->kode_kota); ?>
			</select>
			
<?php
				
		break;	
        
    case "getkecamatan":
		$kode_kota	= $_POST["kode_kota"];
		
?>		
			
            <select name="kode_kecamatan" id="kode_kecamatan" class="chosen-select form-control" onchange="loadHTMLPost1('app/setup_instansi_kodecheck.php','kode_desa_id','getdesa','kode_kecamatan')" style="width:auto; height:27px; " >
				<option value=""></option>
				<?php select_kecamatan($kode_kota, $setup_instansi_data->kode_kecamatan); ?>
			</select>
			
<?php
				
		break;
	
    case "getdesa":
		$kode_kecamatan	= $_POST["kode_kecamatan"];
		
?>		
			
            <select name="kode_desa" id="kode_desa" class="chosen-select form-control" style="width:auto; height:27px; " >
				<option value=""></option>
				<?php select_desa($kode_kecamatan, $setup_instansi_data->kode_desa); ?>
			</select>
			
<?php
				
		break;
        
	default:
}
?>