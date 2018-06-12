<?php
	require_once(__DIR__."/../vendor/autoload.php"); // Loads anything that's been added via composer
	$dotenv = new Dotenv\Dotenv(__DIR__."/../"); // for .env
	$dotenv->load();
	$dotenv->required(['DB_HOST', 'DB_USER', 'DB_PASS', 'DB_BASE']);
	$host = $_ENV['DB_HOST']; $database = $_ENV['DB_BASE'];
	$user = $_ENV['DB_USER']; $pass = $_ENV['DB_PASS'];
	$db = new MysqliDb($host, $user, $pass, $database);
	$db->setPrefix('gpdb_');
?>
