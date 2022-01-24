<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "Lap_BinCard.xls";

header("Content-Type: application/xls");
header("Content-Disposition: attachment;filename=".$namafile." ");

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
include_once ("include/function_excel.php");

include 'class/class.selectview.php';

$selectview = new selectview;

$item_code		= $_REQUEST['item_code'];
$location_id	= $_REQUEST['location_id'];
$uom_code		= $_REQUEST['uom_code'];
$item_group_id	= $_REQUEST['item_group_id'];
$date_from		= $_REQUEST['date_from'];
$date_to		= $_REQUEST['date_to'];
$all		= $_REQUEST['all'];


echo '
<?xml version="1.0" encoding="iso-8859-1"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 

 <Styles>
  <Style ss:ID="judul">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
	<Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
  </Style>
  <Style ss:ID="kepala">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#ffffff" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="badan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>  
  
  <Style ss:ID="numberkanan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="0"/>
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
  </Style>
  
  <Style ss:ID="badankanan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
  </Style>
  
 </Styles>
 <Worksheet ss:Name="BinCard">

  <Table>
   <Column ss:Index="1" ss:Width="100"/>
   <Column ss:Index="2" ss:Width="150"/>
   <Column ss:Index="3" ss:Width="250"/>
   <Column ss:Index="4" ss:Width="200"/>
   
   <Row>
    <Cell ss:MergeAcross="3" ss:StyleID="judul"><Data ss:Type="String">LAPORAN KARTU STOK</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="3" ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>';

	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kode Barang</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Barcode</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Barang</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Satuan</Data></Cell>';
	echo '</Row>';
	
	$sql = $selectview->rpt_bincard_item($item_code, $location_id, $uom_code, $all, $item_group_id);	
	while($row_bincard2=$sql->fetch(PDO::FETCH_OBJ)) {
		
		$sql3 = $selectview->rpt_bincard_openblc_item($row_bincard2->item_code, $row_bincard2->uom_code, $location_id, $date_from, $all);
		$data_opnblc = $sql3->fetch(PDO::FETCH_OBJ);
		$opnblc = $data_opnblc->opnblc;
		
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_bincard2->code."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_bincard2->old_code."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_bincard2->item_name."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_bincard2->uom_name."</Data></Cell>";
		echo "</Row>\n";
		
		echo '<Row>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tanggal</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. Transaksi</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Lokasi</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Transaksi</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Qty Masuk</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Qty Keluar</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jumlah Qty</Data></Cell>';
		echo '</Row>';
		
		echo '<Row>';
		echo '<Cell ss:MergeAcross="5" ss:StyleID="numberkanan"><Data ss:Type="String">Qty Awal</Data></Cell>';
		echo "<Cell ss:StyleID=\"numberkanan\"><Data ss:Type=\"String\">".$opnblc."</Data></Cell>";	
		echo '</Row>';
		
		
		$i = 0;
		$total_debit = 0;
		$total_credit = 0;
		$total_qty = 0;
		$grand_total_qty = 0;
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
			$i++;
			
			$transaction = $row_bincard->invoice_type;
			if($transaction == "cash_invoice") { $transaction = "Penjualan Tunai"; }
			if($transaction == "delivery_order") { $transaction = "Surat Jalan"; }
			if($transaction == "inbound") { $transaction = "Penerimaan Barang (Pindah Gudang)"; }
			if($transaction == "outbound") { $transaction = "Pengeluaran Barang (Pindah Gudang)"; }
			if($transaction == "packing") { $transaction = "Perakitan Barang (Pembuatan Barang)"; }
			if($transaction == "sales_return") { $transaction = "Pengembalian Penjualan"; }
			if($transaction == "delivery_return") { $transaction = "Pengembalian Pengiriman"; }
			if($transaction == "good_receipt") { $transaction = "Penerimaan Barang (Good Receipt)"; }
			if($transaction == "good_return") { $transaction = "Pengembalian Penerimaan(Good Return)"; }
			if($transaction == "purchase_quick") { $transaction = "Pembelian Cepat"; }
			if($transaction == "purchase_return") { $transaction = "Purchase Return"; }
			if($transaction == "stockopname") { $transaction = "Stock Opname"; }
            if($transaction == "pos_invoice") { $transaction = "Penjualan Toko"; }
            if($transaction == "cashier") { $transaction = "Penjualan Kasir"; }
            if($transaction == "pos") { $transaction = "Penjualan Toko"; }
            if($transaction == "purchase_inv") { $transaction = "Pembelian"; }
            if($transaction == "press") { $transaction = "Pemakaian Press"; }
            
            if($transaction == "Stock Opname") {
            	$sqlso1 = $selectview->rpt_bincard_stok_opname($row_bincard->item_code, $row_bincard->location_code, $row_bincard->uom_code, $row_bincard->date, $all);
				$dataso1 = $sqlso1->fetch(PDO::FETCH_OBJ);
				$debit_qty = $dataso1->qty;
				$credit_qty = 0;
				$total_qty = $dataso1->qty;
			}
		
			echo '<Row>';
			echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">'.date("d-m-Y", strtotime($row_bincard->date)).'</Data></Cell>';
			echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">'.$row_bincard->invoice_no.'</Data></Cell>';
			echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">'.$row_bincard->location_name.'</Data></Cell>';
			echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">'.$transaction.'</Data></Cell>';
			echo "<Cell ss:StyleID=\"numberkanan\"><Data ss:Type=\"String\">".$debit_qty."</Data></Cell>";
			echo "<Cell ss:StyleID=\"numberkanan\"><Data ss:Type=\"String\">".$credit_qty."</Data></Cell>";
			echo "<Cell ss:StyleID=\"numberkanan\"><Data ss:Type=\"String\">".$total_qty."</Data></Cell>";	
			echo '</Row>';
			
		}
		
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
				/*$grand_total_qty = $opnblc;
				$total_debit = 0;
				$total_credit = 0;*/
			}
			
		}
		
		echo '<Row>';
		echo '<Cell ss:MergeAcross="3" ss:StyleID="badankanan"><Data ss:Type="String">Total</Data></Cell>';
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".$total_debit."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".$total_credit."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".$grand_total_qty."</Data></Cell>";	
		echo '</Row>';
		
				
	}

	/*
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tangggal</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. Invoice</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Customer</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Total</Data></Cell>';
	echo '</Row>';
	
	$grand_total = 0;
	$sql=$selectview->rpt_sales_invoice_day($date_from, $date_to, $all);
	while($row_sales_invoice=fetch_object($sql)) {
		
		$total = $row_sales_invoice->total;
		$grand_total = $grand_total + $total;
		
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".date("d-m-Y", strtotime($row_sales_invoice->date))."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_sales_invoice->ref."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_sales_invoice->client_name."</Data></Cell>";
		echo "<Cell ss:StyleID=\"numberkanan\"><Data ss:Type=\"String\">".number_format($total,"0",".",",")."</Data></Cell>";		
		echo "</Row>\n";
		
	}
	
		echo "<Row>";
		echo "<Cell ss:MergeAcross='2' ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">GRAND TOTAL&nbsp;</Data></Cell>";	
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($grand_total,0,".",",")."</Data></Cell>";
		echo "</Row>\n"; */

echo '
  </Table>

 </Worksheet>
</Workbook>';
?>

