<?php
include_once ("../include/queryfunctions.php");
include_once ("../include/functions.php");


if(isset($_POST['queryString'])) {
	
	$dbpdo = DB::create();
	
	$queryString = $_POST['queryString'];
	
	if(strlen($queryString) >0) {
		
		$sql="select a.kodepustaka, b.judul from daftarpustaka a left join pustaka b on a.pustaka=b.replid where a.status=1 and a.kodepustaka not in (select kodepustaka from pinjam where (status=0 or status=1)) and (a.kodepustaka like '%$queryString%' or b.judul like '%$queryString%') order by a.kodepustaka";
        $query = $dbpdo->query($sql);
		if($query) {
		echo '<ul>';
			while ($result2 = $query->fetch(PDO::FETCH_OBJ)) {
				echo '<li onClick="fill(\''.addslashes($result2->kodepustaka).'\'); fill2(\''.addslashes($result2->judul).'\');">'.$result2->kodepustaka.'&nbsp;&nbsp;'.$result2->judul.'</li>';
			}
		echo '</ul>';
			
		} else {
			echo 'OOPS we had a problem :(';
		}
	} else {
		// do nothing
	}
}
	
?>