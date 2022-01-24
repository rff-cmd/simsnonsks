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

$item_code		= $_REQUEST['item_code'];
$location_id	= $_REQUEST['location_id'];
$uom_code		= $_REQUEST['uom_code'];
$date_from		= $_REQUEST['date_from'];
$date_to		= $_REQUEST['date_to'];
$item_group_id	= $_REQUEST['item_group_id'];
$item_subgroup_id		= $_REQUEST['item_subgroup_id'];
$all		= $_REQUEST['all'];

$filter = "";

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
    $sqlloc = $select->list_warehouse($location_id);
    $dataloc = $sqlloc->fetch(PDO::FETCH_OBJ);
	if($filter == "") {
		$filter = " Lokasi : ".$dataloc->name;
	} else {
		$filter = $filter." , Lokasi : ".$dataloc->name;
	}
}

if($uom_code != "") {
	if($filter == "") {
		$filter = " Satuan : ".$uom_code;
	} else {
		$filter = $filter." , Satuan : ".$uom_code;
	}
}

if($date_from != "") {
	if($filter == "") {
		$filter = " Tanggal : ".$date_from;
	} else {
		$filter = $filter." , Tanggal : ".$date_from;
	}
}

if($date_to != "") {
	if($filter == "") {
		$filter = " Tanggal : ".$date_to;
	} else {
		$filter = $filter." s/d Tanggal : ".$date_to;
	}
}

if($all != 0) {
	$filter = "Semua";
}

?>

<head>
<title>Report Stock</title>

</head>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family: Arial; font-size: 12px">
	<tr>
		<td align="left"><b>LAPORAN STOK KAIN</b></td>
	</tr>
	
	<tr>
		<td align="left"><i><?php echo $filter ?></i></td>
	</tr>
	
</table>

<br>


<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border:#ccc; font-family: Arial; font-size: 12px">	
	
	<tr align="center" style="font-weight: bold">
		<td>Kode</td>
		<td>Nama Kain</td>
		<td>Satuan</td>
		<td>Stok Akhir</td>		
	</tr>
	
	<?php
		$grand_total_qty = 0;
		$grand_total_value = 0;
		
		$sql = $selectview->rpt_stock($item_code, $location_id, $uom_code, $all, $item_group_id, $item_subgroup_id, $date_from, $date_to);	
		while($row_bincard=$sql->fetch(PDO::FETCH_OBJ)) {
			
			$qty = $row_bincard->qty;
			
            $sql3 = $selectview->rpt_bincard_openblc_item($row_bincard->item_code, $row_bincard->uom_code, $row_bincard->location_code, $date_from, $all);
			$data_opnblc = $sql3->fetch(PDO::FETCH_OBJ);
			$opnblc = $data_opnblc->opnblc;
            
            $total_qty = 0;
            $total_qty = $opnblc + $qty;
            
            
			$j++;
			
			if($j%2==1){
				$bgcolor	=	'style="background-color: #D9FFD0"';
			} else {
				$bgcolor	=	'style="background-color: #fff"';
			}
			
			##cek stok opname (jika ada maka query yg dipakai query ini)
			$sql1=$selectview->rpt_stock_stock_opname_limit1($row_bincard->item_code, $row_bincard->location_code, $row_bincard->uom_code, $all, $row_bincard->item_group_id, $row_bincard->item_subgroup_id, $date_from, $date_to, "stockopname");
			$data1=$sql1->fetch(PDO::FETCH_OBJ);
			$invoice_type=$data1->invoice_type;
			if($invoice_type == "stockopname") {
				$sql2=$selectview->rpt_check_stock_opname($row_bincard->item_code, $row_bincard->location_code, $row_bincard->uom_code, $all, $row_bincard->item_group_id, $row_bincard->item_subgroup_id, $date_from, $date_to);
				$data2=$sql2->fetch(PDO::FETCH_OBJ);
				$debit_qty = $data2->debit_qty;
				$credit_qty = 0;
				$total_qty = $data2->qty;
				
				$date_stok_opname = $data2->date;
				
				//cek qty setelah stock opname
				$sql_so = $selectview->rpt_stock_non_so($row_bincard->item_code, $row_bincard->location_code, $row_bincard->uom_code, $all, $row_bincard->item_group_id, $row_bincard->item_subgroup_id, $date_stok_opname, $date_to);	
				$row_bincard_so=$sql_so->fetch(PDO::FETCH_OBJ);
				$total_qty = $total_qty + $row_bincard_so->qty;
				
			} 
			##----------------/\--------------------
			
			
			##harga beli terakhir
			/*$sql_cost = $selectview->list_purchase_invoice_last_discount($row_bincard->item_code, $row_bincard->uom_code);
			$data_cost = $sql_cost->fetch(PDO::FETCH_OBJ);
			$unit_cost = $data_cost->unit_cost;
			$discount1 = $data_cost->discount1; //%
			$discount = ($unit_cost * $discount1)/100;
			$current_cost = $unit_cost - $discount;
			$total_cost = $current_cost * $total_qty;*/
			
			$grand_total_qty = $grand_total_qty + $total_qty;
			//$grand_total_value = $grand_total_value + $total_cost;
	?>
	
			<tr <?php echo $bgcolor; ?> >
				<td align="left" bgcolor="">&nbsp;<?php echo $row_bincard->old_code  ?></td>
				<td align="left">&nbsp;<?php echo $row_bincard->name ?></td>
				<td align="center">&nbsp;<?php echo $row_bincard->uom_code ?></td>
				<td align="right"><?php echo number_format($total_qty,"3",",",".") ?>&nbsp;</td>				
			</tr>
		
		
	<?php
	}
	?>
	
	
	<tr style="font-weight: bold">
		<td align="right" colspan="3">Grand Total&nbsp;</td>
		<td align="right"><?php echo number_format($grand_total_qty,"3",",",".") ?>&nbsp;</td>
	</tr>
	
	
</table>

