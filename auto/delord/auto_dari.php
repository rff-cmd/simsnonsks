<?php   
	include('../../app/include/sambung.php');
	
	if(isset($_POST['queryString'])) {
		$queryString = $_POST['queryString'];
		
		if(strlen($queryString) >0) {

			$query = mysql_query("select dstcde ctyfrm, dstdcr dstfrom from dst where act=1 and dstfrom=1 and dstdcr like '$queryString%'");
			
			if($query) {
			echo '<ul>';
				while ($result = mysql_fetch_object($query) ) {
					echo '<li onClick="fill(\''.addslashes($result->ctyfrm).'\'); fill2(\''.addslashes($result->dstfrom).'\');">'.$result->dstfrom . '</li>';
				}
			echo '</ul>';
				
			} else {
				echo 'OOPS we had a problem :(';
			}
		} else {
			// do nothing
		}
	} else {
		echo 'There should be no direct access to this script!';
	}
	
?>