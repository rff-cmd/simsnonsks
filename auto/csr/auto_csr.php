<?php   
	include('../../app/include/sambung.php');
	
	if(isset($_POST['queryString'])) {
		$queryString = $_POST['queryString'];
		
		if(strlen($queryString) >0) {			
			$query = mysql_query("select a.delordcde, b.clndcr, a.vhccde, a.drvnme, a.dono from delord a left join cln b on a.clncde=b.clncde where a.delordcde like '$queryString%' order by a.delordcde ");
			//sts='Released' and 
			if($query) {
			echo '<ul>';
				while ($result = mysql_fetch_object($query) ) {
					echo '<li onClick="fill(\''.addslashes($result->clndcr).'\'); fill2(\''.addslashes($result->delordcde).'\'); ">'.$result->dono.' | '.$result->delordcde.' | '.$result->clndcr.'</li>';
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