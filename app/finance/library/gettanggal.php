<?php
require_once('../include/config.php');
require_once('../include/db_functions.php');
require_once('../include/common.php');

$th = $_REQUEST['tahun'];
$bln = $_REQUEST['bulan'];
$tgl = $_REQUEST['tgl'];
$namatgl = $_REQUEST['namatgl'];
$namabln = $_REQUEST['namabln'];

if ($bln == 4 || $bln == 6|| $bln == 9 || $bln == 11) 
	$n = 30;
else if ($bln == 2 && $th % 4 <> 0) 
	$n = 28;
else if ($bln == 2 && $th % 4 == 0) 
	$n = 29;
else 
	$n = 31;

?>
<select name="<?php echo $namatgl?>" id="<?php echo $namatgl?>"  onKeyPress="return focusNext('<?php echo $namabln?>', event)" onFocus="panggil('<?php echo $namatgl?>')">
    <option value="">[Tgl]</option>  
<?php 	for($i=1;$i<=$n;$i++){ ?>      
    <option value="<?php echo $i?>" <?php echo IntIsSelected($tgl, $i)?>><?php echo $i?></option>
<?php	} ?>           
</select>