<?php
   	include("include/sambung.php");
	
	$dbpdo = DB::create();
	
    // membaca id file dari link
    $ref = $_REQUEST['ref'];
 	
    // membaca informasi file dari tabel berdasarkan id nya
    $query  = "select soal_file from soal_ukbm where replid='$ref'";
    $hasil  = $dbpdo->prepare($query);
    $hasil->execute();
    $data = $hasil->fetch(PDO::FETCH_OBJ);

	 // header yang menunjukkan jenis file yang akan didownload
	$exp = @explode(".",$data->soal_file);
	$tipe = $exp[1]; 
	//@header("Content-type: $tipe");
 
    // header yang menunjukkan nama file yang akan didownload
    $file = $data->soal_file;
    $size = @filesize($data->soal_file);
    /*@header("Content-Disposition: attachment; filename=".$file);
 
    // header yang menunjukkan ukuran file yang akan didownload
    //$size = filesize($data->soal_file);
	@header("Content-length:". "");
    
    //@header("Content-Disposition: $file");
   	// proses membaca isi file yang akan didownload dari folder 'data'
   	$fp  = @fopen("file_rpp/".$data->soal_file, 'r');
   	$content = @fread($fp, @filesize("file_rpp/".$data->soal_file));
   	@fclose($fp);
 	
   	// menampilkan isi file yang akan didownload
   	echo $content;
 
   	exit;*/
	
?>


<?php
//download.php
$filename=$file; //"revisi.jpg";
$file="soal_ukbm_photo/".$file;
$len = filesize($file); // Calculate File Size
ob_clean();
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public"); 
header("Content-Description: File Transfer");
//header("Content-Type:application/jpg"); // Send type of file
header("Content-Type: application/".$tipe);
$header="Content-Disposition: attachment; filename=$filename;"; // Send File Name
header($header );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".$len); // Send File Size
@readfile($file);
exit;

?>

