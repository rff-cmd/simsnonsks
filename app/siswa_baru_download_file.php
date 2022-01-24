<?php
	include("include/sambung.php");
	
	$dbpdo = DB::create();
	
    // membaca id file dari link
    $ref = $_REQUEST['ref'];
 	
    // membaca informasi file dari tabel berdasarkan id nya
    $query  = "select file_jalurmasuk from siswa where replid='$ref'";
    $hasil  = $dbpdo->prepare($query);
    $hasil->execute();
    $data = $hasil->fetch(PDO::FETCH_OBJ);

	 // header yang menunjukkan jenis file yang akan didownload
	$exp = @explode(".",$data->file_jalurmasuk);
	$tipe = $exp[1]; 
	//@header("Content-type: $tipe");
 
    // header yang menunjukkan nama file yang akan didownload
    $file = $data->file_jalurmasuk;
    $size = @filesize($data->file_jalurmasuk);
	
	//$filename="ORL-1019-00002_products_main.jpg";
	$file="file_jalurmasuk/".$file;
	//$len = @filesize($file); // Calculate File Size

	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($file));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: private');
	header('Pragma: private');
	header('Content-Length: ' . filesize($file));
	ob_clean();
	flush();
	readfile($file);

	exit;

	
?>

