<?php 
	header('Access-Control-Allow-Origin: *'); // REMOVE THIS!

	$result = 0; // 0 - OK, 1 - Not Found, 2 - ID unspecified
	if (isset($_POST[’id’])) {
		$id = mysql_real_escape_string($_POST[’id’]);

		$sql_s = "SELECT * FROM users WHERE id=’$id’";
		$rs = mysql_query($sql_s);
		
		if (mysql_num_rows($rs) == 0) {
			$result = 1;
		}
	} else {
		$result = 2;
	}

	$output = "{result:" + $result;
	$output += "}";
	echo $output;
?>