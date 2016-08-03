<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php

$hostname_localhost ="localhost";
$database_localhost ="test";
$username_localhost ="root";
$password_localhost ="";

$localhost = @mysql_connect($hostname_localhost,$username_localhost,$password_localhost)
or
trigger_error(mysqli_error(),E_USER_ERROR);

?>
<body>
</body>
</html>