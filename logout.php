<html>
	<head>But sir, you forgot you hat.</head>
	<body>

<?php
define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './phpBB3/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

       $user->session_kill();

$user->session_begin();
$auth->acl($user->data);
$user->setup('');

header("Location: index.php");
die();
?>
		<a href=index.php>Click here to return to login page</a>
	</body>
		</html>
