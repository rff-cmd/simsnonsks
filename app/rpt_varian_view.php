<?php
@session_start();

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

$from_date				= $_REQUEST['from_date'];
$to_date				= $_REQUEST['to_date'];
$item_code				= $_REQUEST['item_code'];
$uom_code				= $_REQUEST['uom_code'];
$vendor_code			= $_REQUEST['vendor_code'];
$item_group_id			= $_REQUEST['item_group_id'];
$item_subgroup_id		= $_REQUEST['item_subgroup_id'];
$location_id			= $_REQUEST['location_id'];
$all		= $_REQUEST['all'];

$filter = "";

if($from_date != "") {
    
    $from_date_filetr = date("d-m-Y", strtotime($from_date));
    
	if($filter == "") {
		$filter = " Tanggal : ".$from_date_filetr;
	} else {
		$filter = $filter." s/d Tanggal : ".$from_date_filetr;
	}
}

if($to_date != "") {
    
    $to_date_filetr = date("d-m-Y", strtotime($to_date));
    
	if($filter == "") {
		$filter = " Tanggal : ".$to_date_filetr;
	} else {
		$filter = $filter." s/d Tanggal : ".$to_date_filetr;
	}
}

if($vendor_code != "") {
    $sqlitem = $select->list_vendor($vendor_code);
    $dataitem = $sqlitem->fetch(PDO::FETCH_OBJ);
	if($filter == "") {
		$filter = " Supplier : ".$dataitem->name;
	} else {
		$filter = $filter." , Supplier : ".$dataitem->name;
	}
}

if($item_code != "") {
    $sqlitem = $select->list_item($item_code);
    $dataitem = $sqlitem->fetch(PDO::FETCH_OBJ);
	if($filter == "") {
		$filter = " Nama Barang : ".$dataitem->name;
	} else {
		$filter = $filter." , Nama Barang : ".$dataitem->name;
	}
}

if($location_id != "") {
    $sqlitem = $select->list_warehouse($location_id);
    $dataitem = $sqlitem->fetch(PDO::FETCH_OBJ);
	if($filter == "") {
		$filter = " Gudang : ".$dataitem->name;
	} else {
		$filter = $filter." , Gudang : ".$dataitem->name;
	}
}

if($uom_code != "") {
	if($filter == "") {
		$filter = " Satuan : ".$uom_code;
	} else {
		$filter = $filter." , Satuan : ".$uom_code;
	}
}

if($item_group_id != "") {
    $sqlitem = $select->list_item_group($item_group_id);
    $dataitem = $sqlitem->fetch(PDO::FETCH_OBJ);
	if($filter == "") {
		$filter = " Kelompok Barang : ".$dataitem->name;
	} else {
		$filter = $filter." , Kelompok Barang : ".$dataitem->name;
	}
}

if($all != 0) {
	$filter = "Semua";
}

?>

<head>
<title>Report Stock</title>

</head>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family: Arial; font-size: 14px">
	<tr>
		<td align="left"><b>LAPORAN PERBANDINGAN HARGA</b></td>
	</tr>
	
	<tr>
		<td align="left"><i><?php echo $filter ?></i></td>
	</tr>
	
</table>

<br>


<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border:#ccc; font-family: Arial; font-size: 14px">	
	
	<tr align="center" style="font-weight: bold; height: 50px; background-color: #d7e3c1">
		<th>No.</th>
		<th>Kelompok</th>
        <th>Kode</th>
    	<!--<th>Barcode</th>-->
    	<th>Nama Barang</th>
    	<th>GD</th>
    	<th>Qty</th>
    	<th>Satuan</th>
		<td>Harga Jual</td>
		<td>Harga Beli Sebelum</td>
		<td>Harga Beli</td>
		<td>Ket.</td>
		<td>% LR</td>
	</tr>
	
	<?php
		
		$sqlvdr = $selectview->rpt_varian_supplier($from_date, $to_date, $item_code, $uom_code, $item_group_id, $item_subgroup_id, $vendor_code, $location_id, $all);
		while($row_varian_vdr=$sqlvdr->fetch(PDO::FETCH_OBJ)) {
	?>
	
		<tr>
			<td colspan="12" style="font-weight: bold; font-size: 16px; background-color: #edfab4; height: 30px">
				
				NOTA PEMBELIAN :  <?php echo $row_varian_vdr->ref ?> <br>
				SUPPLIER : <?php echo $row_varian_vdr->vendor_name ?>
				
			</td>
		</tr>
		
			
			<?php	
				$j = 0;
				$sql = $selectview->rpt_varian($from_date, $to_date, $item_code, $uom_code, $item_group_id, $item_subgroup_id, $row_varian_vdr->vendor_code, $location_id, $all, $row_varian_vdr->ref);	
				while($row_varian=$sql->fetch(PDO::FETCH_OBJ)) {
					
		            //$current_cost = $selectview->list_purchase_invoice_last_cost($row_varian->syscode, $row_varian->uom_code_sales);
		            /*$current_price = $selectview->list_price_last($row_varian->syscode, $row_varian->uom_code_sales);
		            
					$variant = 0;
					$variant = $current_price - $current_cost;*/
					$ket = "";
					$cost_sebelum = $selectview->list_purchase_invoice_before_last_cost($row_varian->syscode, $row_varian->uom_code, $from_date);
					if($cost_sebelum < $row_varian->unit_cost) {
						$ket = "+";
					} else if($cost_sebelum == $row_varian->unit_cost) {
						$ket = "=";
					} else if($cost_sebelum > $row_varian->unit_cost) {
						$ket = "-";
					}
					
					
					//get item qty
					$item_qty = "";
					$item_price = "";
					$sqlitem = $selectview->list_qty_price_last($row_varian->syscode, $row_varian->uom_code);
					$dataitem = $sqlitem->fetch(PDO::FETCH_OBJ);
					$item_qty = number_format($dataitem->qty1,"2",",",".") . 
								"<br>" . number_format($dataitem->qty2,"2",",",".") . 
								"<br>" . number_format($dataitem->qty3,"2",",",".");
					$item_price = number_format($dataitem->current_price,"2",",",".") . 
								"&nbsp;<br>" . number_format($dataitem->current_price1,"2",",",".") . 
								"&nbsp;<br>" . number_format($dataitem->current_price2,"2",",",".");
								
					//----------% LR
					$lr_1 = 0;
					$awal1 = 0;
					$lr_2 = 0;
					$awal2 = 0;
					$lr_3 = 0;
					$awal3 = 0;
					$total_lr = "";
					
					$awal1 = $dataitem->current_price - $row_varian->unit_cost; //harga jual - harga beli skg
					if($row_varian->unit_cost > 0) {
						$lr_1 = ($awal1/$row_varian->unit_cost)*100;
					} else {
						$lr_1 = 0;
					}
					
					$awal2 = $dataitem->current_price1 - $row_varian->unit_cost; //harga jual - harga beli skg
					if($row_varian->unit_cost > 0) {
						$lr_2 = ($awal2/$row_varian->unit_cost)*100;
					} else {
						$lr_2 = 0;
					}
					
					$awal3 = $dataitem->current_price2 - $row_varian->unit_cost; //harga jual - harga beli skg
					if($row_varian->unit_cost > 0) {
						$lr_3 = ($awal3/$row_varian->unit_cost)*100;
					} else {
						$lr_3 = 0;
					}
					
					$total_lr = number_format($lr_1,"2",",",".") . 
								"&nbsp;<br>" . number_format($lr_2,"2",",",".") . 
								"&nbsp;<br>" . number_format($lr_3,"2",",",".");
					//------------------/\
					            
					$j++;
					
					if($j%2==1){
						$bgcolor	=	'style="background-color: #D9FFD0"';
					} else {
						$bgcolor	=	'style="background-color: #fff"';
					}
			?>
			
					<tr <?php echo $bgcolor; ?> >
						<td align="center" bgcolor="">&nbsp;<?php echo $j  ?>.</td>
						<td align="left" bgcolor="">&nbsp;<?php echo $row_varian->item_group_name  ?></td>
						<td align="left" bgcolor="">&nbsp;<?php echo $row_varian->code  ?></td>
						<!--<td align="left" bgcolor="">&nbsp;<?php echo $row_varian->old_code  ?></td>-->
						<td align="left">&nbsp;<?php echo $row_varian->item_name ?></td>
						<td align="left" bgcolor="">&nbsp;<?php echo $row_varian->loc_code  ?></td>
						<td align="right"><?php echo number_format($row_varian->qty,"2",",",".") ?>&nbsp;</td>
						<td align="center">
							<?php echo $row_varian->uom_code; ?><br>
							<?php echo $item_qty; ?>	
						</td>
						<td align="right" style="color: #ff0000">
							<?php echo $item_price ?>&nbsp;
						</td>
						<td align="right" valign="top"><?php echo number_format($cost_sebelum,"2",",",".") ?>&nbsp;</td>
						<td align="right" valign="top"><?php echo number_format($row_varian->unit_cost,"2",",",".") ?>&nbsp;</td>								
						<td align="center" style="font-size: 26; font-weight: bold;"><?php echo $ket ?></td>
						<td align="right"><?php echo $total_lr ?>&nbsp;</td>
					</tr>
				
				<!--
				<tr style="font-weight: bold">
					<td align="right" colspan="4">Total&nbsp;</td>
					<td align="right"><?php echo number_format($total_debit,"0",",",".") ?>&nbsp;</td>
					<td align="right"><?php echo number_format($total_credit,"0",",",".") ?>&nbsp;</td>
					<td align="right"><?php echo number_format($grand_total_qty,"0",",",".") ?>&nbsp;</td>
				</tr>-->
			
				
			<?php
				}
			?>
				
		
	<?php
	
	}
	?>
	
</table>

