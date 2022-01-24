<?php
function getDepartemen($access) {
	if ($access == "ALL") {
		$sql = "SELECT departemen FROM departemen WHERE aktif=1 ORDER BY urutan";
		$result = QueryDb($sql);
		$i = 0;
		while($row = mysql_fetch_row($result)) {
			$dep[$i] = $row[0];
			$i++;
		}
	} else {
		$dep[0] = $access;
	}
	return $dep;
}
?>