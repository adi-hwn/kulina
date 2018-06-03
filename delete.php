<?php 
	//header('Access-Control-Allow-Origin: *'); // REMOVE THIS!
	$link = mysql_connect('mysql4.gear.host', 'userdb5', 'udb5adm!n');
	mysql_query("USE userdb5");

	$result = 0; // 0 - OK, 1 - Not Found, 2 - ID unspecified
	if (isset($_POST[id])) {
		$id = mysql_real_escape_string($_POST[id]);

		$sql_s = "DELETE FROM user_review WHERE id='$id'";
		$rs = mysql_query($sql_s);
	} else {
		$result = 2;
	}

	echo "{\"result\":\"$result\"}";
	//echo "{\"id\":\"$id\", \"result\":\"$result\"}";

	mysql_close($link);
?>