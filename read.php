<?php 
	header('Access-Control-Allow-Origin: *'); // REMOVE THIS!
	$link = mysql_connect('mysql4.gear.host', 'userdb5', 'udb5adm!n');

	$result = 0; // 0 - OK, 1 - Not Found, 2 - ID unspecified
	if (isset($_GET[’id’])) {
		$id = mysql_real_escape_string($_GET[’id’]);

		$sql_s = "SELECT * FROM users WHERE id=’$id’";
		$rs = mysql_query($sql_s);
		
		if (mysql_num_rows($rs) == 0) {
			$result = 1;
		}
	} else {
		$result = 2;
	}

	echo "{result:'$result'}";
	echo $rs;
?>