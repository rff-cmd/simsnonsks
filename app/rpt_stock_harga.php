<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
include_once ("include/inword.php");

include 'class/class.selectview.php';
include 'class/class.select.php';

$selectview = new selectview;
$select = new select;

$cetakall			= $_REQUEST['cetakall'];
$jml				= $_REQUEST['jml'];

$item_code_id = "";
if($cetakall == 1) {
	for($i=1; $i<=$jml; $i++) {
		$cetak 	= 	$_REQUEST[cetak_.$i];
		if($cetak == 1) {
			if($item_code_id == "") {
				$item_code_id 	= 	$_REQUEST[item_code_.$i];
			} else {
				$item_code_id 	= 	$item_code_id . "|" . $_REQUEST[item_code_.$i];
			}
		}
		
	}
} else {
	$cetak = 0;
	for($i=1; $i<=$jml; $i++) {
		$cetak 	= 	$_REQUEST[cetak_.$i];
		if($cetak == 1) {
			$item_code_id 	= 	$item_code_id . "|" . $_REQUEST[item_code_.$i];
		}
	}
	
	//$item_code_id	= $_REQUEST['item_code4'];
}

$countitem 	= explode("|",$item_code_id);
$jmldata = count($countitem);	

$item_code = "";

if(empty($item_code_id)) {
	$item_code = "'ndf'";	
}


for ($i=0; $i<=$jmldata; $i++) {
	
	if(!empty($countitem[$i])) {
		if($item_code == "") {
			$item_code = "'".$countitem[$i]."'";		
		} else {
			$item_code = $item_code . ", " . "'".$countitem[$i]."'";
		}
	}
}


?>

<head>
<title>Cetak Label</title>

</head>

<?php
$sql = $selectview->list_item_cetak_label($item_code);
$rows = $sql->rowCount();

$width = "100%";
if($rows == 1) {
	$width = "33%";
}

?>

<table width="<?php echo $width ?>" border="1" cellspacing="5" style="font-family: sans-serif; ">
		
	<?php
		$i = 1;
		
		$sql = $selectview->list_item_cetak_label($item_code);			
		while ($rpt_item_view=$sql->fetch(PDO::FETCH_OBJ)) {
			
			$sql2 = $selectview->list_price_last2($rpt_item_view->syscode, $rpt_item_view->uom_code_sales);
			$data_price = $sql2->fetch(PDO::FETCH_OBJ);
			
			$date = date("d-m-Y"); //, strtotime($data_price->date_of_record));
			
			/*if($rows > 1) {*/ 
	?>
	
				<td valign="top" style="border: 1px solid #000000">
					<table width="100%" border="0" style="font-family: sans-serif; font-size: 16px">
						<tr style="font-weight: bold;">
							<td align="left" colspan="3">
							<?php 
								echo substr($rpt_item_view->name,0,21)."<br>". 
									substr($rpt_item_view->name,21,21);
							?>
								
							</td>
						</tr>
						
						<?php if(strlen(trim($rpt_item_view->name)) <= 20) { ?>
						<tr>
							<td align="left" colspan="3">&nbsp;</td>	
						</tr>
						<?php } ?>
						<tr style="height: 40px">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px"><?php echo $rpt_item_view->old_code ?></td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px"><?php echo number_format($data_price->current_price,0,".",",") ?>/ <?php echo number_format($data_price->qty1,0,".",",") ?></td>		
						</tr>	
						<tr style="font-weight: bold">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px"><?php echo $date ?></td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px"><?php echo number_format($data_price->current_price1,0,".",",") ?>/ <?php echo number_format($data_price->qty2,0,".",",") ?></td>		
						</tr>
						<tr style="font-weight: bold">
							<td align="left" width="25%"></td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px"><?php echo number_format($data_price->current_price2,0,".",",") ?>/ <?php echo number_format($data_price->qty3,0,".",",") ?></td>		
						</tr>
						
						
					</table>
				</td>
	
	<?php
			/*} else {*/
	?>
				<?php /*
				<td valign="top" style="border: 1px solid #000000">
					<table width="100%" border="1" style="font-family: sans-serif; font-size: 14px">
						<tr style="font-weight: bold;">
							<td align="left" colspan="3"><?php echo $rpt_item_view->name ?></td>	
						</tr>
						<tr>
							<td align="left" colspan="3">&nbsp;</td>	
						</tr>
						<tr>
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px"><?php echo $rpt_item_view->old_code ?></td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px"><?php echo number_format($data_price->current_price,0,".",",") ?>/ <?php echo number_format($data_price->qty1,0,".",",") ?></td>		
						</tr>	
						<tr style="font-weight: bold">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px"><?php echo $date ?></td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px"><?php echo number_format($data_price->current_price1,0,".",",") ?>/ <?php echo number_format($data_price->qty2,0,".",",") ?></td>		
						</tr>
						<tr style="font-weight: bold">
							<td align="left" width="25%"></td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px"><?php echo number_format($data_price->current_price2,0,".",",") ?>/ <?php echo number_format($data_price->qty3,0,".",",") ?></td>		
						</tr>
						
						
					</table>
				</td>*/ ?>
	<?php
			//}
	
			if($i % 3 == 0){

				echo '<tr align="left">';

			}
			
			$i++;
			
		}
	?>
	
			<!--
	
	<tr style="font-weight: bold; background-color: #deecf3">
		<td colspan="1" align="right">TOTAL :</td>
		<td align="center"><?php echo number_format($alat, 0, ",", ",") ?></td>
		
		<td align="right"><?php echo number_format($total, 0, ",", ",") ?>&nbsp;</td>
	</tr>-->
</table>
