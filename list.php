<?php 
	header('Access-Control-Allow-Origin: *'); // REMOVE THIS!
	$link = mysql_connect('mysql4.gear.host', 'userdb5', 'udb5adm!n');
	mysql_query("USE userdb5");

	$result = 0; // 0 - OK, 1 - Not Found, 2 - ID unspecified
	$qty = 0;
	if (isset($_GET[qty])) {
		$qty = mysql_real_escape_string($_GET[qty]);

		$sql_s = "SELECT id FROM user_review LIMIT $qty";
		$rs = mysql_query($sql_s);
	} else {
		$result = 2;
	}

	if($result != 0){
		echo "{\"result\":\"$result\"}";
	} else {
		$list_str = "";
		while ($row = mysql_fetch_array($rs, MYSQL_NUM)) {
		    $list_str += "$row[0],";  
		}
		echo "{\"result\":\"$result\", \"list_str\":\"$list_str\"}";
	}

	mysql_close($link);
?>