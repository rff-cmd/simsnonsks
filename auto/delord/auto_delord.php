<?php   
	include('../../app/include/sambung.php');
	
	if(isset($_POST['queryString'])) {
		$queryString = $_POST['queryString'];
		
		if(strlen($queryString) >0) {

			$query = mysql_query("select clndcr,clncde from cln where clndcr like '$queryString%'");
			
			if($query) {
			echo '<ul>';
				while ($result = mysql_fetch_object($query) ) {
					echo '<li onClick="fill(\''.addslashes($result->clndcr).'\'); fill2(\''.addslashes($result->clncde).'\');">'.$result->clncde.'&nbsp;&nbsp;'.$result->clndcr.'</li>';
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