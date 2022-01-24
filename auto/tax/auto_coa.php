<?php   
	//include('../../app/include/sambung.php');
	include ("../../app/include/queryfunctions.php");
	include ("../../app/include/functions.php");
	
	if(isset($_POST['queryString'])) {
		$queryString = $_POST['queryString'];
		
		if(strlen($queryString) >0) {	
			if (user_admin()==0) {
				$uid = $_SESSION["loginname"];
				
				//-------cek nama cabang-------
				$where = " and b.brncde in (select ifnull(brncde,'') brncde from usr_dtl2 where usrid='$uid') ";
				
				$query=mysql_query("select distinct a.acccde, a.accdcr from coa a left join coa_dtl b on a.acccde=b.acccde where ifnull(a.ptb,0)=1 and a.act=1 " . $where . " and (a.acccde like '$queryString%' or a.accdcr like '%$queryString%') order by a.acccde ");
			} else {
				$query=mysql_query("select distinct a.acccde, a.accdcr from coa a where ifnull(a.ptb,0)=1 and a.act=1 and (a.acccde like '$queryString%' or a.accdcr like '%$queryString%') order by a.acccde ");
			}

			if($query) {
			echo '<ul>';
				while ($result = mysql_fetch_object($query) ) {
					echo '<li onClick="fill(\''.addslashes($result->accdcr).'\'); fill2(\''.addslashes($result->acccde).'\'); ">'.$result->acccde.'&nbsp;&nbsp;'.$result->accdcr. '</li>';
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