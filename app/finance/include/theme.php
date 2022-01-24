<?php
function GetThemeDir() 
{
	/*OpenDb();
	
	$sql_tema="Select theme from hakakses where login='".SI_USER_ID()."' AND modul='KEUANGAN' ";
	$hasil=QueryDb($sql_tema);
	$row_tema=mysql_fetch_array($hasil);
	$row_tema2=mysql_num_rows($hasil);
	
	if ($row_tema2==0)
		$theme=3;
	else
		$theme=$row_tema['theme'];

	CloseDb(); */
	
	//if ($theme == 1) {
		return "finance/images/default/";
	/*} elseif ($theme == 2) {
		return "../keuangan/theme/pink/";
	} elseif ($theme == 3) {
		return "../keuangan/images/default/";
	} elseif ($theme == 4) {
		return "../keuangan/theme/apple/";
	} elseif ($theme == 5) {
		return "../keuangan/theme/vista/";
	} elseif ($theme == 6) {
		return "../keuangan/theme/kopi/";
	} elseif ($theme == 7) {
		return "../keuangan/theme/wood/";
	} elseif ($theme == 8) {
		return "../keuangan/theme/gold/";
	} elseif ($theme == 9) {
		return "../keuangan/theme/granite/";
	}*/
}
?>