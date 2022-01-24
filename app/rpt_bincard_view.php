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

$selectview = new selectview;

$item_code		= $_REQUEST['item_code'];
$location_id	= $_REQUEST['location_id'];
$uom_code		= $_REQUEST['uom_code'];
$item_group_id	= $_REQUEST['item_group_id'];
$date_from		= $_REQUEST['date_from'];
$date_to		= $_REQUEST['date_to'];
$all			= $_REQUEST['all'];

$filter = "";

if($item_code != "") {
	if($filter == "") {
		$filter = " Nama Barang : ".$item_code;
	} else {
		$filter = $filter." , Nama Barang : ".$item_code;
	}
}

if($location_id != "") {
	if($filter == "") {
		$filter = " Lokasi : ".$location_id;
	} else {
		$filter = $filter." , Lokasi : ".$location_id;
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
<title>Bin Card Report</title>

</head>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family: Arial; font-size: 11px">
	<tr>
		<td align="left"><b>LAPORAN KARTU STOK</b></td>
	</tr>
	
	<tr>
		<td align="left"><i><?php echo "" ?></i></td>
	</tr>
	
</table>

<br>


<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border:#ccc; font-family: Arial; font-size: 11px">	
	
	<tr align="center" style="font-weight: bold">
		<td>Kode Barang</td>
		<td>Barcode</td>
		<td>Nama Barang</td>
		<td>Satuan</td>		
	</tr>
	
	<?php
		$sql = $selectview->rpt_item_bincard($item_code, $uom_code, $all, $item_group_id);	
		while($row_bincard2=$sql->fetch(PDO::FETCH_OBJ)) {
			
			$sql3 = $selectview->rpt_bincard_openblc_item($row_bincard2->item_code, $row_bincard2->uom_code, $location_id, $date_from, $all);
			$data_opnblc = $sql3->fetch(PDO::FETCH_OBJ);
			$opnblc = $data_opnblc->opnblc;
	?>
	
		<tr style="background-color: #f1feb4">
			<td align="left">&nbsp;<?php echo $row_bincard2->code  ?></td>
			<td align="left">&nbsp;<?php echo $row_bincard2->old_code  ?></td>
			<td align="left">&nbsp;<?php echo $row_bincard2->item_name ?></td>
			<td align="left">&nbsp;<?php echo $row_bincard2->uom_name ?></td>
							
		</tr>
		
		<tr style="font-style: italic; background-color: #d2facf">
			<td align="right">Tanggal&nbsp;&nbsp;</td>
			<td>No. Transaksi</td>
			<td>Lokasi</td>
			<td>Transaksi</td>
			<td>Qty Masuk</td>
			<td>Qty Keluar</td>
			<td>Jumlah Qty</td>
		</tr>
		
		<tr>
			<td align="right" colspan="6">Qty Awal&nbsp;</td>	
			<td align="right"><?php echo number_format($opnblc,"0",",",".") ?>&nbsp;</td>
		</tr>
			
		<?php
			$i = 0;
			$total_debit = 0;
			$total_credit = 0;
			$total_qty = 0;
			$grand_total_qty = 0;
			$qty_tmp = 0;
			
			$sql2 = $selectview->rpt_bincard($row_bincard2->item_code, $location_id, $row_bincard2->uom_code, $date_from, $date_to, $all);	
			while($row_bincard=$sql2->fetch(PDO::FETCH_OBJ)) {
				
				$debit_qty = $row_bincard->debit_qty;
				$total_debit = $total_debit + $debit_qty;
				
				$credit_qty = $row_bincard->credit_qty;
				$total_credit = $total_credit + $credit_qty;
				
				if($i == 0) {
					$total_qty = $total_qty + $opnblc + $debit_qty - $credit_qty;	
				} else {
					$total_qty = $total_qty + $debit_qty - $credit_qty;
				}
				
				$qty_tmp = $total_qty;
				
				$i++;
				
				$transaction = $row_bincard->invoice_type;
				if($transaction == "cash_invoice") { $transaction = "Penjualan Tunai"; }
				if($transaction == "delivery_order") { $transaction = "Surat Jalan"; }
				if($transaction == "inbound") { 
					if($credit_qty <> 0) {
						$transaction = "Pengeluaran Barang (Pindah Gudang)"; 
					} else {
						$transaction = "Penerimaan Barang (Pindah Gudang)";
					}
				}
				if($transaction == "outbound") { 
					if($debit_qty <> 0) {
						$transaction = "Penerimaan Barang (Pindah Gudang)"; 
					} else {
						$transaction = "Pengeluaran Barang (Pindah Gudang)"; 
					}					
				}
				if($transaction == "packing") { $transaction = "Perakitan Barang (Pembuatan Barang)"; }
				if($transaction == "sales_return") { $transaction = "Pengembalian Penjualan"; }
				if($transaction == "delivery_return") { $transaction = "Pengembalian Pengiriman"; }
				if($transaction == "good_receipt") { $transaction = "Penerimaan Barang (Good Receipt)"; }
				if($transaction == "good_return") { $transaction = "Pengembalian Penerimaan(Good Return)"; }
				if($transaction == "purchase_quick") { $transaction = "Pembelian Cepat"; }
				if($transaction == "purchase_makloon") { $transaction = "Pembelian Makloon"; }
				if($transaction == "purchase_return") { $transaction = "Purchase Return"; }
				if($transaction == "stockopname") { $transaction = "Stock Opname"; }
                if($transaction == "pos_invoice") { $transaction = "Penjualan Toko"; }
                if($transaction == "cashier") { $transaction = "Penjualan Kasir"; }
                if($transaction == "pos") { $transaction = "Penjualan Toko"; }
                if($transaction == "purchase_inv") { $transaction = "Pembelian"; }
                if($transaction == "press") { $transaction = "Pemakaian Press"; }
                
				
                $style = "";
                $valign = "";
                if($transaction == "Stock Opname") {
                	
                	$valign = 'valign="top" ';
                	$style = $valign. 'style="font-size: 14px; color:#ff0600; font-weight: bold;"';
                	
                	
                	$sqlso1 = $selectview->rpt_bincard_stok_opname($row_bincard->item_code, $row_bincard->location_code, $row_bincard->uom_code, $row_bincard->date, $all);
					$dataso1 = $sqlso1->fetch(PDO::FETCH_OBJ);
					$debit_qty = $dataso1->qty;
					$credit_qty = 0;
					$total_qty = $dataso1->qty;
					
					$qty_tmp = $qty_tmp - $total_qty - $dataso1->qty;
				}
				
				
				
			?>
			
				<tr>
					<td align="right"><?php echo date("d-m-Y", strtotime($row_bincard->date)) ?>&nbsp;&nbsp;</td>
					<td align="left">&nbsp;<?php echo substr($row_bincard->invoice_no,0,20) ?></td>
					<td align="left">&nbsp;<?php echo $row_bincard->location_name ?></td>
					
					<?php 
						if($transaction == "Stock Opname") {
					?>
							<td <?php echo $style ?> ><?php echo $transaction ?><br>
								Selisih Stock Opname
							</td>
					<?php } else { ?>
							<td <?php echo $style ?> >&nbsp;<?php echo $transaction ?></td>
					<?php } ?>
					
					<td align="right" <?php echo $style ?> ><?php echo number_format($debit_qty,"3",",",".") ?>&nbsp;</td>
					<td align="right" <?php echo $style ?> ><?php echo number_format($credit_qty,"3",",",".") ?>&nbsp;</td>
					
					<?php 
						if($transaction == "Stock Opname") {
					?>
							<td align="right" <?php echo $style ?> ><?php echo number_format($total_qty,"3",",",".") ?>
								<br>
								<?php echo number_format($qty_tmp,"3",",",".") ?>&nbsp;
							</td>
					<?php } else { ?>
							<td align="right" <?php echo $style ?> ><?php echo number_format($total_qty,"3",",",".") ?>&nbsp;</td>
					<?php } ?>
				</tr>
				
			<?php
			}
			
				//$grand_total_qty = $opnblc + $total_debit - $total_credit;
				
				if($transaction == "Stock Opname") {
					$grand_total_qty = $total_qty; //$dataso->qty;
					$total_debit = $total_qty; //$dataso->qty;
					$total_credit = 0;
					
				} else {
					if($total_qty > 0) {
						$grand_total_qty = $total_qty;
						$total_debit = $total_qty;
						$total_credit = 0;
					} else if($total_qty < 0) {
						$grand_total_qty = $total_qty;
						$total_debit = 0;
						$total_credit = $total_qty * -1;
					} else {
						$grand_total_qty = $total_debit - $total_credit + $opnblc;
						/*$total_debit = 0;
						$total_credit = 0;*/
						
					}
					
					
				}
			?>
			
			<tr style="font-weight: bold; font-size: 14px; color: #0404f9">
				<td align="right" colspan="4">Total&nbsp;</td>
				<td align="right"><?php echo number_format($total_debit,"3",",",".") ?>&nbsp;</td>
				<td align="right"><?php echo number_format($total_credit,"3",",",".") ?>&nbsp;</td>
				<td align="right"><?php echo number_format($grand_total_qty,"3",",",".") ?>&nbsp;</td>
			</tr>
	
		
	<?php
	}
	?>
	
</table>

