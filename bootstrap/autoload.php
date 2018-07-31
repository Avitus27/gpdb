<?php
	require_once(__DIR__."/../vendor/autoload.php"); // Loads anything that's been added via composer

	$dotenv = new Dotenv\Dotenv(__DIR__."/../"); // for .env
	$dotenv->load();
	$dotenv->required(['DB_HOST', 'DB_USER', 'DB_PASS', 'DB_BASE', 'GOOGLE_API_KEY', 'DB_PREFIX']);

	$host = $_ENV['DB_HOST'];
	$database = $_ENV['DB_BASE'];
	$user = $_ENV['DB_USER'];
	$pass = $_ENV['DB_PASS'];
	$prefix = $_ENV['DB_PREFIX'];
	$db = new MysqliDb($host, $user, $pass, $database);
	$db->setPrefix($prefix);
	dbObject::autoload("models");

	use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
	use Ivory\GoogleMap\Helper\Builder\MapHelperBuilder;
	use Ivory\GoogleMap\Map;
	use Ivory\GoogleMap\Base\Coordinate;

	$map = new Map();

	$googleApiKey = $_ENV['GOOGLE_API_KEY'];
	$mapHelper = MapHelperBuilder::create()->build();
	$apiHelper = ApiHelperBuilder::create()
		->setKey($googleApiKey)
		->build();

?>
