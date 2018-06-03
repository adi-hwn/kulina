<html>
	<body>
		<?php 
			if (isset($_POST[’username’]) and isset($_POST[’password’])) {
				$username = mysql_real_escape_string($_POST[’username’]);

				$sql_s = "SELECT * FROM users WHERE username=’$username’ and pw=’$password’";
				$rs = mysql_query($sql_s);
				
				if (mysql_num_rows($rs) > 0) {
					echo "Login successful!";
				} else {
					echo "Incorrect username or password";
				}
			}
		?>
	</body>
</html>