<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

/*include '../app/class/class.select.php';
$select=new select;*/

$pilih = $_POST["button"];
switch ($pilih){
	case "getdata":
		$asset_ref = $_POST["asset_ref"];	
			
?>		
		
		  <select id="ref" name="ref" class="chosen-select form-control"  style="max-width: 300px; font-size: 12px;" >
          	<option value=""></option>
            <?php 
                //select_room($ref) 
                select_room_asset($asset_ref, $ref)
            ?>	
                                      
          </select>
		
<?php
		break;
		
	default:
}
?>