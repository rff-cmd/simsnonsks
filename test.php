<?php //localhost

define("HOST", "192.168.1.4");
define("PORT", 3306);
define("USER", "kasir3");
define("PASS", "1qaz2wsx");
define("DB", "tokosahabat");

$host=HOST; 
$userdb=USER;
$passdb=PASS;
$mydb=DB;
$condb=@mysql_connect($host,$userdb,$passdb);

if(@mysql_select_db($mydb,$condb)) {
	echo "sukses";
} else {
	echo "gagal";
}

?>