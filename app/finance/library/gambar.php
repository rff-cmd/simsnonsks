<?php
require_once('../include/config.php');
require_once('../include/db_functions.php');

$replid=$_REQUEST['replid'];
$table = $_REQUEST['table'];

OpenDb();
header("Content-type: image/jpeg");
$query = "SELECT foto FROM $table WHERE replid = '$replid'";

$result = QueryDb($query);
$num = @mysql_num_rows($result);
if ($row = mysql_fetch_array($result)) {
    if($row[foto]) {
        echo  $row[foto];
    }else {
    	$filename = "../images/ico/no_image.png";
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));

        echo  $contents;
    }
  }
//}
CloseDb();
?>