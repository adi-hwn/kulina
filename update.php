<?php 
	header('Access-Control-Allow-Origin: *'); // REMOVE THIS!
	$link = mysql_connect('mysql4.gear.host', 'userdb5', 'udb5adm!n');
	mysql_query("USE userdb5");

	$result = 0; // 0 - OK, 1 - Not Found, 2 - ID unspecified
	if (isset($_POST[id]) isset($_POST[user_id]) and isset($_POST[product_id]) and isset($_POST[order_id]) and isset($_POST[rating]) and isset($_POST[review])) {
		$id = mysql_real_escape_string($_POST[id]);

		$uid = mysql_real_escape_string($_POST[user_id]);
		$pid = mysql_real_escape_string($_POST[product_id]);
		$oid = mysql_real_escape_string($_POST[order_id]);
		$rate = mysql_real_escape_string($_POST[rating]);
		$rev = mysql_real_escape_string($_POST[review]);

		$sql_s = "UPDATE user_review SET user_id='$uid', product_id='$pid', order_id='$oid', rating='$rate', review='$rev' WHERE id='$id'";
		$rs = mysql_query($sql_s);
	} else {
		$result = 2;
	}

	echo "{\"result\":\"$result\"}";
	//echo "{\"id\":\"$id\", \"result\":\"$result\"}";

	mysql_close($link);
?>