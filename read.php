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
		} else {
			$obj = mysql_fetch_object($rs);
		}
	} else {
		$result = 2;
	}

	if($result != 0){
		echo "{id:$id, result:$result}";
	} else {
		$json = json_encode($obj);
		echo "{\"id\":\"$id\", \"result\":\"$result\", json:$json}";
	}
?>