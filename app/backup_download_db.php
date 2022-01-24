<?php
session_start();

$date = date("Y-m-d");
$filedb = $_SESSION['filedownload']; // 'db-backup-' . $date . '-' . time();
$fileszie = filesize("database_backup/".$filedb);


#*****download data*****
// header yang menunjukkan jenis file yang akan didownload
header("Content-type: ".'sql');

// header yang menunjukkan nama file yang akan didownload
header("Content-Disposition: attachment; filename=".$filedb);

// header yang menunjukkan ukuran file yang akan didownload
header("Content-length: ".$fileszie);

// proses membaca isi file yang akan didownload dari folder 'data'
$fp  = fopen("database_backup/".$filedb, 'r');
$content = fread($fp, filesize('database_backup/'.$filedb));
fclose($fp);

unset($_SESSION['filedownload']);

// menampilkan isi file yang akan didownload
echo $content;

exit;
#***********************


?>