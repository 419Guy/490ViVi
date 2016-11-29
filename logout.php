<html>
<body>
<?php
		session_start();
		session_destroy();
		echo "You have logged out";
		header ("Refresh: 1; url=index.html");
?>
</html>
