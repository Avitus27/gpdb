<?php
	require_once(__DIR__."/../vendor/autoload.php"); // Loads anything that's been added via composer
	$dotenv = new Dotenv\Dotenv(__DIR__."/../"); // for .env
	$dotenv->load();

?>
