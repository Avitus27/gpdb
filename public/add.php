<?php
	require_once __DIR__.'/../bootstrap/autoload.php';
	use PHPAuth\Config;
	use PHPAuth\Auth;

	$dbh = MysqliDb::getInstance();
	$config = new PHPAuth\Config($dbh);
	$auth = new PHPAuth\Auth($dbh, $config);
?>
