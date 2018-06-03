<html>
	<body>
		<?php 
			header('Access-Control-Allow-Origin: *'); // REMOVE THIS!
			if (isset($_POST[’id’])) {
				$id = mysql_real_escape_string($_POST[’id’]);

				$sql_s = "SELECT * FROM users WHERE id=’$id’";
				$rs = mysql_query($sql_s);
				
				if (mysql_num_rows($rs) > 0) {
					echo "ID Found!";
				} else {
					echo "ID Not Found";
				}
			} else {
				echo "ID Not Specified";
			}
		?>
	</body>
</html>