<?php
   	include("include/sambung.php");
	
	$dbpdo = DB::create();
	
    // membaca id file dari link
    $ref = $_REQUEST['ref'];
 	
    // membaca informasi file dari tabel berdasarkan id nya
    $query  = "select data_file from assesmen_observasi where ref='$ref'";
    $hasil  = $dbpdo->prepare($query);
    $hasil->execute();
    $data = $hasil->fetch(PDO::FETCH_OBJ);

	 // header yang menunjukkan jenis file yang akan didownload
	$exp = explode(".",$data->data_file);
	$tipe = $exp[1]; 
    header("Content-type: $tipe");
 
    // header yang menunjukkan nama file yang akan didownload
    $file = $data->data_file;
    header("Content-Disposition: attachment; filename=".$file);
 
    // header yang menunjukkan ukuran file yang akan didownload
    //$size = filesize($data->data_file);
	header("Content-length:". "");
    
    //header("Content-Disposition: $file");
   	// proses membaca isi file yang akan didownload dari folder 'data'
   	$fp  = fopen("file_assesment/".$data->data_file, 'r');
   	$content = fread($fp, filesize("file_assesment/".$data->data_file));
   	fclose($fp);
 	
   	// menampilkan isi file yang akan didownload
   	echo $content;
 
   	exit;
	
?>