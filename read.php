<?php 
	header('Access-Control-Allow-Origin: *'); // REMOVE THIS!
	$link = mysql_connect('mysql4.gear.host', 'userdb5', 'udb5adm!n');
	mysql_query("USE userdb5");

	$result = 0; // 0 - OK, 1 - Not Found, 2 - ID unspecified
	$id = "undefined";
	if (isset($_GET[id])) {
		$id = mysql_real_escape_string($_GET[id]);

		$sql_s = "SELECT * FROM user_review WHERE id=$id";
		$rs = mysql_query($sql_s);
		
		if (mysql_num_rows($rs) == 0) {
			$result = 1;
		}
	} else {
		$result = 2;
	}

	echo "{id:$id, result:$result}";
	echo $rs;
?>